// Initializes FriendlyAuth.
function FriendlyAuth() {
    this.checkSetup();


    this.userPic = document.getElementById('user-pic');
    this.userName = document.getElementById('user-name');
    this.signInButton = document.getElementById('sign-in');
    //this.signOutButton = document.getElementById('sign-out');
    this.signInSnackbar = document.getElementById('must-signin-snackbar');
  
  //this.signOutButton.addEventListener('click', this.signOut.bind(this));
  this.signInButton.addEventListener('click', this.signIn.bind(this));
  this.initFirebase();
}

// Sets up shortcuts to Firebase features and initiate firebase auth.
FriendlyAuth.prototype.initFirebase = function() {
    // Shortcuts to Firebase SDK features.
    this.auth = firebase.auth();
    // Initiates Firebase auth and listen to auth state changes.
    this.auth.onAuthStateChanged(this.onAuthStateChanged.bind(this));
  };
  

// Signs-in Friendly Chat.
FriendlyAuth.prototype.signIn = function() {
    // Sign in Firebase using popup auth and Google as the identity provider.
    
    //var provider= new firebase.auth().signInAnonymously();
    //this.auth.signInWithPopup(provider)
    var provider = new firebase.auth.GoogleAuthProvider();
    this.auth.signInWithPopup(provider);
  };
  
  // Signs-out of Friendly Chat.
  FriendlyAuth.prototype.signOut = function() {
    //signout Firebase
    this.auth.signOut();
  };
  
  // Triggers when the auth state change for instance when the user signs-in or signs-out.
  FriendlyAuth.prototype.onAuthStateChanged = function(user) {
      
    if (user) { // User is signed in!
      // Get profile pic and user's name from the Firebase user object.
      var profilePicUrl = user.photoURL;   
      var userName = user.displayName;        
  
      // Set the user's profile pic and name.
      //this.userPic.style.backgroundImage = 'url(' + profilePicUrl + ')';
        this.userPic.src =profilePicUrl;
      this.userName.textContent = userName;
  
      // Show user's profile and sign-out button.
      this.userName.removeAttribute('hidden');
      this.userPic.classList.remove('hide');
        
      //this.signOutButton.removeAttribute('hidden');
      //this.signOutButton.classList.remove('hide');
  
      // Hide sign-in button.
      //this.signInButton.setAttribute('hidden', 'true');
      this.signInButton.classList.add('hide');
  
      // We load currently existing chant messages.
      this.saveUser(user);
    } else { // User is signed out!
        
      // Hide user's profile and sign-out button.
      this.userName.setAttribute('hidden', 'true');
      this.userPic.setAttribute('hidden', 'true');
      //this.signOutButton.setAttribute('hidden', 'true');
        
      //this.signOutButton.classList.add('hide');
  
      // Show sign-in button.
      this.signInButton.classList.remove('hide');
      //this.signInButton.removeAttribute('hidden');

    }
  };
  
  // Returns true if user is signed-in. Otherwise false and displays a message.
  FriendlyAuth.prototype.checkSignedInWithMessage = function() {
    // Return true if the user is signed in Firebase
    if (this.auth.currentUser) {
      return true;
    }
  
    // Display a message to the user using a Toast.
    var data = {
      message: 'You must sign-in first',
      timeout: 2000
    };
    this.signInSnackbar.MaterialSnackbar.showSnackbar(data);
    return false;
  };

  // Checks that the Firebase SDK has been correctly setup and configured.
FriendlyAuth.prototype.checkSetup = function() {
    if (!window.firebase || !(firebase.app instanceof Function) || !window.config) {
      console.warn('You have not configured and imported the Firebase SDK. ' +
          'Make sure you go through the codelab setup instructions.');
    } else if (config.storageBucket === '') {
        console.warn('Your Firebase Storage bucket has not been enabled. Sorry about that. This is ' +
          'actually a Firebase bug that occurs rarely. ' +
          'Please go and re-generate the Firebase initialisation snippet (step 4 of the codelab) ' +
          'and make sure the storageBucket attribute is not empty. ' +
          'You may also need to visit the Storage tab and paste the name of your bucket which is ' +
          'displayed there.');
    }
  };

FriendlyAuth.prototype.saveUser=function(user){
    var d=new Date();
    var arr={
        'name':user.displayName,
        'email':user.email,
        'pic':user.photoURL,
        'time':d.getTime()
    }
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            // Typical action to be performed when the document is ready:
            //document.getElementById("demo").innerHTML = xhttp.responseText;
            //console.log(xhttp.responseText);
            var resp=JSON.parse(xhttp.responseText);
            if(resp.state){
                //initial user 4km9puyot5v13k2 time:1614874810140
                sessionStorage.setItem('im',resp.img);
                window.location='chat.php';
            }else{
                //user not registered
                localStorage.setItem('g',JSON.stringify(arr));
                $('div .userfm ').removeClass('hide');
                
            }
        }
    };
    
    xhttp.open("POST", 'requests/login.php',true);
    xhttp.setRequestHeader("Content-type", "application/json")
    xhttp.send(JSON.stringify(arr));
}

window.onload = function() {
    window.friendlyAuth = new FriendlyAuth();
  };
  