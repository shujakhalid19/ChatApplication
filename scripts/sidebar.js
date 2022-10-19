var hash = window.location.hash;

var x = window.matchMedia("(max-width: 700px)")
x.addListener(myFunction)
    
    if (window.history && window.history.pushState) {
        $(window). on('popstate', function(event) { 
          hash = window.location.hash;
          console.log(hash);
           if(hash=='#home'){
            myFunction(x,false,'msgBox');//if true then show
            $('#search_col').val('');
             myChat();
           }else if(hash=="#touch"){
            myFunction(x,false,'right-bar');//if true then show
            myFunction(x,true,'msgBox');
           }else if(hash=='#profile'){
            //alert('asd');
            //myFunction(x,false,'msgBox');//if true then show
            myFunction(x,true,'right-bar');//if true then show
          }else{
            myFunction(x,false,'right-bar');//if true then show
            myFunction(x,!true,'msgBox');
          }
         
         });
        //page reload 
        if(hash=='#profile'){
            myFunction(x,true,'right-bar');//if true then show
        }else if(hash=="#touch"){
            alert('qqqqasd');
           }else if(hash=='#home'){
            //alert('qasd');
          myChat();  
        }else{
        }
    }

    function myFunction(x,type,elem) {
        if (x.matches) { // If media query matches
            (type) ? $('.'+elem).show() : $('.'+elem).hide();
        } else {
            //large device
            //document.body.style.backgroundColor = "pink";
        }
    }
      