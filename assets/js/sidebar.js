
if (window.history && window.history.pushState) {

//if (window.history.pushState) {
      
      var flag=true;  
      var ftype;         

      $(window).on('popstate', function () {
          var type=window.location.hash.substr(1);
//          console.warn(type);
          if(flag){
              
              console.log(type);
              switch(type){
                  case 'new':
                      ftype=type;
                      on('newTopic');
                      break;
                  case 'right-bar':
                      ftype=type;
                      on('right-bar');
                     break;
                  case 'Details':
                      ftype=type;
                      on('Details');
                     break;
                   case 'FullPost':
                        ftype=type;
                        on('FullPost');
                    break;
              }
              
          }else{
              console.log('close'+ftype);
              switch(ftype){
                  case 'new':
                     off('newTopic');
                     break;
                  case 'gallery':
                    off('gallery');
                     break;
                  case 'Details':
                    off('Details');
                    break;
                  case 'FullPost':
                    off('FullPost');
                    break;
              }
              
          }

          flag=!flag;

      });

  }


function on(type){
        //history.pushState("on", document.title, window.location.pathname+ window.location.search);
        //window.location.href="#on";
    $('body').css('overflow','hidden');
    document.getElementById(type).style.display = "block";
}

function off(type) {
    $('body').css('overflow','auto');

        
  document.getElementById(type).style.display = "none";
}

          