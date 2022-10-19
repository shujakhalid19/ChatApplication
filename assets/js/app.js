if('serviceWorker' in navigator){
  navigator.serviceWorker.register('assets/js/aw.js')
    .then(reg => console.log('service worker registered'))
    .catch(err => console.log('service worker not registered', err));
}

const requestNotificationPermission = async () => {
    
    const permission = await window.Notification.requestPermission();
    // value of permission can be 'granted', 'default', 'denied'
    // granted: user has accepted the request
    // default: user has dismissed the notification permission popup by clicking on x
    // denied: user has denied the request.
    if(permission !== 'granted'){
        throw new Error('Permission not granted for Notification');
    }else{
        
    }
}

//notifyMe();
function notifyMe() {
    
  // Let's check if the browser supports notifications
  if (!("Notification" in window)) {
    alert("This browser does not support desktop notification");
  }

  // Let's check whether notification permissions have already been granted
  else if (Notification.permission === "granted") {
      
    // If it's okay let's create a notification
    //var notification = new Notification('Shuja');
        
        var obj= {
          body: 'Buzz! Buzz!',
          icon: '../images/touch/chrome-touch-icon-192x192.png',
          vibrate: [200, 100, 200, 100, 200, 100, 200],
          tag: 'vibration-sample'
        };
      
       var notification = new Notification('Notification title', {
   icon: 'http://cdn.sstatic.net/stackexchange/img/logos/so/so-icon.png',
   body: 'Hey there! You\'ve been notified!',
   onclick:function(event) {
      alert('OK')
    }
  });
      
      
  }

  // Otherwise, we need to ask the user for permission
  else if (Notification.permission !== "denied") {
    Notification.requestPermission().then(function (permission) {
      // If the user accepts, let's create a notification
      if (permission === "granted") {
          
        var notification = new Notification("Hi there!");
          
          
      }
    });
  }

  // At last, if the user has denied notifications, and you
  // want to be respectful there is no need to bother them any more.
}

const main = async () => {
  const permission = await requestNotificationPermission()
  
}
 main();// we will not call main in the beginning.