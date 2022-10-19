function FriendlyChat() {
    this.checkSetup();
  //console.log('a');
    // Shortcuts to DOM Elements.
    this.messageList = document.getElementById('messages');
    this.messageForm = document.getElementById('message-form');
    this.messageInput = document.getElementById('message');
    this.messageConff=document.getElementById('conf-inp');
    //this.mediaImage=document.getElementById('imgFile');
    this.mediaImage=document.getElementById("imgFile"); 
    this.submitButton = document.getElementById('submit');
    this.userPic = document.getElementById('user-pic');
    this.userName = document.getElementById('user-name');
    this.lastMessage='';
    
      
    this.date=new Date();
  //  this.signOutButton = document.getElementById('sign-out');
  
    // Saves message on form submit.
    this.messageForm.addEventListener('submit', this.saveMessage.bind(this));
    //this.signOutButton.addEventListener('click', this.signOut.bind(this));
    //this.signInButton.addEventListener('click', this.signIn.bind(this));
  
    // Toggle for the button.
    var buttonTogglingHandler = this.toggleButton.bind(this);
    this.messageInput.addEventListener('keyup', buttonTogglingHandler);
    this.messageInput.addEventListener('change', buttonTogglingHandler);
  
    // Events for image upload.
    
    this.initFirebase();
  }

// Sets up shortcuts to Firebase features and initiate firebase auth.
FriendlyChat.prototype.initFirebase = function() {
    // Shortcuts to Firebase SDK features.
    this.auth = firebase.auth();
    this.database = firebase.database();
    //this.storage = firebase.storage();
    // Initiates Firebase auth and listen to auth state changes.
    this.auth.onAuthStateChanged(this.onAuthStateChanged.bind(this));
  };
  

  FriendlyChat.prototype.onAuthStateChanged = function(user) {
    if (user) { // User is signed in!
      // Get profile pic and user's name from the Firebase user object.
      //var profilePicUrl = user.photoURL;   
      //var userName = user.displayName;        
  
      // Set the user's profile pic and name.
      //this.userPic.style.backgroundImage = 'url(' + profilePicUrl + ')';
      //this.userName.textContent = userName;
  
      // Show user's profile and sign-out button.
      //this.userName.removeAttribute('hidden');
      //this.userPic.removeAttribute('hidden');
      //this.signOutButton.removeAttribute('hidden');
  
      // Hide sign-in button.
      //this.signInButton.setAttribute('hidden', 'true');
  
      // We load currently existing chant messages.
      //this.loadMessages();
    } else { // User is signed out!
      // Hide user's profile and sign-out button.
      //this.userName.setAttribute('hidden', 'true');
      //this.userPic.setAttribute('hidden', 'true');
      //this.signOutButton.setAttribute('hidden', 'true');
  
      // Show sign-in button.
      //this.signInButton.removeAttribute('hidden');
    }
  };

  // Saves a new message on the Firebase DB.
FriendlyChat.prototype.saveMessage = function(e) {
    e.preventDefault();
    // Check that the user entered a message and is signed in.
    if (this.messageInput.value && this.checkSignedInWithMessage()) {

      var currentUser = this.auth.currentUser;
        if(this.mediaImage.files[0]){
            //console.warn(this.mediaImage.files[0].name);
            //var formData = new FormData(this.mediaImage);
            var file = this.mediaImage.files[0];
            this.uploadImg(file,call=>{
                if(call.status && call.upload){
                    this.messagesRef.child(localStorage.getItem('prime')).push({
                        name: currentUser.displayName,
                        text: this.messageInput.value,
                        d:window.sessionStorage.getItem('device'),
                        imgKey:call.key,
                        file:call.file,
                        timestamp:this.date.getTime(),          
                      }).then(function(snap) {
                          //Update Chatlist andClear message text field and SEND button state.
                          //console.warn(snap.key);
                          //this.lastMessage = snap.key;
                          this.updateChat(localStorage.getItem('prime'));
                          FriendlyChat.resetMaterialTextfield(this.messageInput);
                          this.toggleButton();

                  }.bind(this)).catch(function(error) {
                    console.error('Error writing new message to Firebase Database', error);
                  });
                
                }else{
                        console.warn('');No
                }
            });
        }else if(this.messageConff.value==1){
         this.messagesRef.child(localStorage.getItem('prime')).push({
           conf:this.messageConff.value,
                name: currentUser.displayName,
                text: this.messageInput.value + ' 🎉',
                d:window.sessionStorage.getItem('device'),
                timestamp:this.date.getTime(),          
            }).then(function(snap) {
            // Update Chatlist andClear message text field and SEND button state.
              //this.lastMessage = snap.key;
              this.updateChat(localStorage.getItem('prime'));
              FriendlyChat.resetMaterialTextfield(this.messageInput);
              this.toggleButton();

          }.bind(this)).catch(function(error) {
            console.error('Error writing new message to Firebase Database', error);
          });
        }else if(this.messageConff.value==2){
            //sendAudio();
            console.warn('BBBBBBB');
         }else{
            //saving text message
            
            this.messagesRef.child(localStorage.getItem('prime')).push({
                        name: currentUser.displayName,
                        text: this.messageInput.value,
                        d:window.sessionStorage.getItem('device'),
                        timestamp:this.date.getTime(),          
                    }).then(function(snap) {
                    // Update Chatlist andClear message text field and SEND button state.
                      //this.lastMessage = snap.key;
                      this.updateChat(localStorage.getItem('prime'));
                      FriendlyChat.resetMaterialTextfield(this.messageInput);
                      this.toggleButton();

                  }.bind(this)).catch(function(error) {
                    console.error('Error writing new message to Firebase Database', error);
                  });
        }
    }
    
            
      // Add a new message entry to the Firebase Database.
      //console.warn(currentUser);
    /**/
        /*this.messagesRef.child(localStorage.getItem('prime')).push({
        name: currentUser.displayName,
        text: this.messageInput.value,
        d:window.sessionStorage.getItem('device'),
        timestamp:this.date.getTime(),*/
    /**/
          /*name: currentUser.displayName,
        text: this.messageInput.value,
        prom:localStorage.getItem("prime"),
        d:window.sessionStorage.getItem('device'),  */
        
          
        //photoUrl: currentUser.photoURL || '/images/profile_placeholder.png'
    /**/
        /*  }).then(function() {
        // Update Chatlist andClear message text field and SEND button state.
          this.updateChat(localStorage.getItem('prime'));
        FriendlyChat.resetMaterialTextfield(this.messageInput);
        this.toggleButton();
        
      }.bind(this)).catch(function(error) {
        console.error('Error writing new message to Firebase Database', error);
      });*/
    /**/
    
  }
    
    FriendlyChat.prototype.uploadImg=function(file,call){
        var formData = new FormData();
        formData.append("fileToUpload", file);
        formData.append("p", localStorage.getItem('prime'));
        $.ajax({
           url: "requests/chats.php",
           type: "POST",
           data: formData,
           processData: false,
           contentType: false,
           success: function(response) {
               var resp=JSON.parse(response);
               call(resp);
               //return this.saveImageMessage(resp).bind(this);;
               
           },
           error: function(jqXHR, textStatus, errorMessage) {
               console.log(errorMessage); // Optional
           }
        });
        
    }
  
  // Returns true if user is signed-in. Otherwise false and displays a message.
  FriendlyChat.prototype.checkSignedInWithMessage = function() {
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
  
  // Resets the given MaterialTextField.
  FriendlyChat.resetMaterialTextfield = function(element) {
    element.value = '';
    element.parentNode.MaterialTextfield.boundUpdateClassesHandler();
  };
  
  // Template for messages.
  FriendlyChat.MESSAGE_TEMPLATE =
      '<div class="message-container">' +
        '<div class="name"></div>' +
        '<div class="message"></div>' +
      '</div>';
  
// Loads chat messages history and listens for upcoming ones.
FriendlyChat.prototype.loadMessages = function() {
  
  var pp=localStorage.getItem('prime');
  this.messageList.innerHTML='';
    // Reference to the /messages/ database path.
    this.messagesRef = this.database.ref('messages');
    console.warn('pp: '+pp);
    // Make sure we remove all previous listeners.
    //console.warn('aa ',);
    
    // Loads the last 20 messages and listen for new ones.
    var setMessage = function(data) {
      //console.warn('prime: '+localStorage.getItem('prime'));
      //console.warn(data.val());
      var val = data.val();
      var cls='';
      //var id=data.ref.path.pieces_[2];
      var id=data.key;
      
      (val.d===window.sessionStorage.getItem('device')) ? (val.name='Me',cls='m') : (val.name,cls='n');
      if(pp==localStorage.getItem('prime')){
        this.displayMessage(id,pp, cls,val.name, val.text, val.imgKey, val.file,val.conf,val.type);
      }
        

    }.bind(this);
    //this.messagesRef.child(localStorage.getItem('prime')).limitToLast(20).on('child_added', setMessage);
    //this.messagesRef.child(localStorage.getItem('prime')).limitToLast(20).on('child_changed', setMessage);
    this.messagesRef.off();
    //this.messagesRef.off();
    this.messagesRef.child(pp).limitToLast(12).on('child_added', setMessage);
    this.messagesRef.child(pp).limitToLast(20).on('child_changed', setMessage);
    //this.messagesRef.child(localStorage.getItem('prime')).limitToLast(20).on('child_changed', snap=>{
      //$('#'+snap.key).append('<div class="text-muted f-12">Opened</div>');
    //});
    
  };

  FriendlyChat.prototype.displayMessage = function(id,key,cls, name, text, picUrl, imageUri, cft,mediaType) {
    
    var div = document.getElementById(id);
      
    // If an element for that message does not exists yet we create it.
    if (!div) {
    
        var container = document.createElement('div');
        container.innerHTML = FriendlyChat.MESSAGE_TEMPLATE;
        div = container.firstChild;
        div.setAttribute('id', id);
        div.classList.add(cls);
        this.messageList.appendChild(div);
    
    }
    // if (picUrl) {
    //   div.querySelector('.pic').style.backgroundImage = 'url(' + picUrl + ')';
    // }
    var popId=this.guidGenerator();
    //div.querySelector('.name').textContent = name;
    
    var els=div.querySelector('.name');
    //els.innerHTML='<span class="a3fa">'+name+'</span>';
    var attrs={"data-toggle": "popover",'data-container':'body','data-placement':'right','data-html':'true','id':popId};
    var sss=document.createElement('span');
    sss.innerHTML=name;
    //var ss='<span class="a3fa">'+name+'</span>';
    //var el=div.querySelector('name');//.setAttribute('data-toggle','popover');
    $.each(attrs, function(key,index){
      //console.log(key+" ,"+index)
      sss.setAttribute(key,index);
    });
      //console.warn(sss);
     //var plainText = ss.outerHTML;  // <- Change made here
     //pTag.innerHTML = plainText;
      //div.querySelector('name').setAttribute(key, attrs[key]);
      
    //console.warn('asdsdasdasdasd:'+this.guidGenerator());
    els.innerHTML = sss.outerHTML+'<div id="popover-content-'+popId+'" class="hide"><div class="pointer pd-top-10"><i class="fa fa-user"></i>&nbsp;&nbsp; <span class="pointer ">View Profile</span></div><div class="pd-top-10"><i class="fa fa-comment"></i>&nbsp;&nbsp; <span class="pointer">Add to Chatlist</span></div><div class="pd-top-10"><i class="fa fa-minus"></i>&nbsp;&nbsp; <span class="pointer"> Remove</span></div><div class="pd-top-10"><i class="fa fa-info"></i>&nbsp;&nbsp;  <span class="pointer">Report</span></div></div>';
    //div.querySelector('.name').appendChild=;
    //console.warn('asd');
    var messageElement = div.querySelector('.message');
    if (text) { // If the message is text.
      
        messageElement.textContent = text;
        // Replace all line breaks by <br>.
        messageElement.innerHTML = messageElement.innerHTML.replace(/\n/g, '<br>');
      
    }
    if(mediaType=="audiofile"){
      console.warn(picUrl);
      var wavesurfer = [];
      var aud = document.createElement('div');
      
      aud.style.backgroundColor='#404040';
      aud.style.display='block';
      aud.style.width='100%';
      aud.style.height='100px';
      //var knownId=this.guidGenerator();
      aud.setAttribute('id','audio-container');
      var imageText = document.createElement('div');
      imageText.className = "imgtxt";
      var caud=document.createElement('div');
      caud.className = "wave";
      let knownId=this.guidGenerator();
      caud.setAttribute('id',knownId);

      var control=document.createElement('div');
      control.classList.add("text-right");

      var bt=document.createElement('button');
      bt.classList.add('btn','btn-md','btn-primary','player');
      bt.textContent="Play";
      
      //bt.onclick=wavesurfer.playPause.bind(wavesurfer);;
      
      //document.getElementById('play').innerHTML=;
    
      aud.innerHTML=caud.outerHTML;
      
      imageText.innerText=text;
      wavesurfer[knownId] = WaveSurfer.create({
        container: aud,
        waveColor: '#D9DCFF',
        progressColor: '#4353FF',
        cursorColor: '#4353FF',
        barWidth: 3,
        barRadius: 3,
        cursorWidth: 1,
        height: 100,
        barGap: 3
      });
      wavesurfer[knownId].load('uploads/users/'+picUrl+'/'+localStorage.getItem('prime')+'/media/'+imageUri);
      
      //bt.onclick=
     bt.addEventListener('click',function(e){
      wavesurfer[knownId].playPause(wavesurfer);
      console.warn('uploads/users/'+picUrl+'/'+localStorage.getItem('prime')+'/media/'+imageUri)
     },false);
      
      //this.setImageUrl('uploads/users/'+picUrl+'/'+localStorage.getItem('prime')+'/media/'+imageUri, aud);
      control.appendChild(bt);
      messageElement.innerHTML = '';
      messageElement.appendChild(imageText);
      messageElement.appendChild(control);    
      messageElement.appendChild(aud);
      
    }
    if(cft==1){
      if(name=='Me'){
        console.warn('1');
        // Make sure we remove all previous listeners.
        //messagesRef.off();
        
        //var bt=document.createElement('button');
        //bt.classList.add('btn', 'btn-pill');//className = "btn btn-pill";
        //bt.textContent = 'Open';
        
        
        
      }else{
      console.warn('2'+name);
      var messagesRef = this.database.ref('messages').child(localStorage.getItem('prime')).child(id);
      // Make sure we remove all previous listeners.
      //messagesRef.off();
  
      var bt=document.createElement('button');
      bt.classList.add('btn', 'btn-pill');//className = "btn btn-pill";
      bt.textContent = 'Open';
      var st = document.createElement('div');
      st.classList.add('f-12', 'text-muted','md-top-10');
      bt.onclick=function(){
        bt.replaceWith(text);
        st.innerText='opened';
        messageElement.appendChild(st);
        explode();
        //console.log(localStorage.getItem('prime'));
        //this.messagesRef = this.database.ref('messages');
        messagesRef.update({'conf':0});
      };

      messageElement.innerHTML = '';
      messageElement.appendChild(bt);
    }
        

    }else if(cft==0){
      if(name=='Me'){
        console.warn('1.2');
        $('#'+id).append('<div class="text-muted f-12">Opened</div>');  
        
      }else{
        console.warn('2.2');
        
      // Replace all line breaks by <br>.
        // var st = document.createElement('div');
        // st.innerText='🎉 opened';
        // st.classList.add('f-12', 'text-muted','md-top-10');
        
        // messageElement.appendChild(st);
      }
    }
      if (mediaType=="image") { // If the message is an image.
      //console.log('Image+ '+text);  
      var image = document.createElement('img');
      var imageText = document.createElement('div');
      imageText.className = "imgtxt";
      imageText.innerText=text;
      image.addEventListener('load', function() {
        this.messageList.scrollTop = this.messageList.scrollHeight;
      }.bind(this));
      
      this.setImageUrl('uploads/users/'+picUrl+'/'+localStorage.getItem('prime')+'/media/'+imageUri, image);
      messageElement.innerHTML = '';
      messageElement.appendChild(imageText);
      messageElement.appendChild(image);
    }
    // Show the card fading-in.
    setTimeout(function() {div.classList.add('visible')}, 1);
    this.messageList.scrollTop = this.messageList.scrollHeight;
    this.messageInput.focus();
  };


  // Sets the URL of the given img element with the URL of the image stored in Firebase Storage.
FriendlyChat.prototype.setImageUrl = function(imageUri, imgElement) {
    imgElement.src = imageUri;
    
    // If the image is a Firebase Storage URI we fetch the URL.
    if (imageUri.startsWith('gs://')) {
      imgElement.src = FriendlyChat.LOADING_IMAGE_URL; // Display a loading image first.
      this.storage.refFromURL(imageUri).getMetadata().then(function(metadata) {
        imgElement.src = metadata.downloadURLs[0];
      });
    } else {
      imgElement.src = imageUri;
    }
  };
  
  
  FriendlyChat.prototype.guidGenerator=function() {
    var S4 = function() {
       return (((1+Math.random())*0x10000)|0).toString(16).substring(1);
    };
    return (S4()+S4()+S4()+S4()+S4());
    //return (S4()+S4()+"-"+S4()+"-"+S4()+"-"+S4()+"-"+S4()+S4()+S4());
}

  FriendlyChat.prototype.toggleButton = function() {
    if (this.messageInput.value) {
      this.submitButton.removeAttribute('disabled');
    } else {
      this.submitButton.setAttribute('disabled', 'true');
    }
  };

FriendlyChat.prototype.updateChat=function(pr){
    var arr={
        p:pr,
        d:this.date.getTime()
    }
    
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            // Typical action to be performed when the document is ready:
            //document.getElementById("demo").innerHTML = xhttp.responseText;
            //console.log(xhttp.responseText);
            
        }
    };
    
    xhttp.open("POST", 'requests/chats.php',true);
    xhttp.setRequestHeader("Content-type", "application/json")
    xhttp.send(JSON.stringify(arr));
}
  
  // Checks that the Firebase SDK has been correctly setup and configured.
FriendlyChat.prototype.checkSetup = function() {
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
  
  window.onload = function() {
    window.friendlyChat = new FriendlyChat();
  };
  
  