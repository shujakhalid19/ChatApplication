
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Unopinion</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
      
    <link rel="manifest" href="manifest.json">
    <link rel="apple-touch-icon" href="assets/icons/96.png">
    <meta name="apple-mobile-web-app-status-bar" content="#202020"><!--FFE1C4-->
    <meta name="theme-color" content="#202020">
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0/css/all.min.css">
    <link rel="stylesheet" href="styles/main.css">
    <link rel="stylesheet" href="styles/ui.css">
    <!-- <link rel="stylesheet" href="styles/test-main.css"> -->
    <style>


      .ac{
        border:2px solid cornflowerblue;
      }
        
        /* Hide scrollbar for Chrome, Safari and Opera */
div::-webkit-scrollbar {
  display: none;
}

/* Hide scrollbar for IE, Edge and Firefox */
div {
  -ms-overflow-style: none;  /* IE and Edge */
  scrollbar-width: none;  /* Firefox */
}
    </style>    


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
      <script>
      $(document).keyup(function(e) {
        if (e.key === "Escape") { // escape key maps to keycode `27`
            window.location.reload()
        }
      });
      </script>
</head>
<body style="th-light">
      <div class="container-fluid">
        
        <div class="row">
            <div class='col-xs-12 col-sm-4 col-md-3 bd-rt pd-0' style='height:100vh;overflow-hidden;'>
              <h3 class="b col-xs-12 col-sm-12 col-md-12">
                  <a href="chat.php"><i class="fa fa-arrow-left"></i> &nbsp;&nbsp;Settings</a>
              </h3>
          
              <div class='col-xs-12 col-sm-12 col-md-12 pd-5 md-top-10 md-top-20' >
                  <div class='col-xs-12 col-sm-12 col-md-12 bd-btm f-18 md-top-10' onclick='myFunction(x,"#Account",false)'>
                      <i class="fa fa-user-circle"></i> Account
                      <span class='pull-right fa fa-chevron-right'></span>
                  </div>
                  
                  <div class='col-xs-12 col-sm-12 col-md-12 bd-btm f-18 md-top-20'>
                      <i class="fa fa-lock"></i> Privacy
                      <span class='pull-right fa fa-chevron-right'></span>
                  </div>
                  <div class='col-xs-12 col-sm-12 col-md-12 bd-btm f-18 md-top-40' onclick='myFunction(x,"#Appearance",false)'>
                      <i class="fa fa-magic"></i> Appearance
                      <span class='pull-right fa fa-chevron-right'></span>
                  </div>
                  
                  
              </div>
            </div>
            
            <div class='msgBox col-xs-12 col-sm-8 col-md-9' style="overflow-y:scroll;">
               <h3>Account</h3>
                <div id='arena' style="overflow-y:scroll;padding-bottom:100px;">
         
                    
                    
                    
                </div>
                
            </div>
            

        </div>
      </div>
</body>
<script>
    var d=new Date();
  $(function(){
    var hash = window.location.hash;
    
    if(hash){
      myFunction(x,hash,true);
    }


    $(document).on('keydown input','#unm',function(event){
            switch (event.which) {
            //case 8:  // Backspace
            case 9:  // Tab
            case 13: // Enter
            case 32:return false;  // Space
            //case 37:// Left
            case 38: // Up
            //case 39: // Right
            case 40: // Down
            case 191:return false;  // /
            break;
            default:
            var regex = new RegExp("^[a-zA-Z0-9.,]+$");
            var key = event.key;
            if (!regex.test(key)) {
                event.preventDefault();
                return false;
            }
            break;
        }
        })

        $(document).on('click','#dark',function(){
          $.ajax({
            type:"POST",
            url:"requests/chats.php",
            data:{
              th:'dark'
            },
            success:function(data){
              console.log(data);
            }
          })
        })

        $(document).on('click','#light',function(){
          $.ajax({
            type:"POST",
            url:"requests/chats.php",
            data:{
              th:'light'
            },
            success:function(data){
              console.log(data);
            }
          })
        })
      
        //$("#regForm").on('submit', function(event){
          $(document).on('submit','#regForm',function(event){
            event.preventDefault();        
              
            var s=$('#unm').val();
            
            var form=$(this);
            // var x=JSON.parse(localStorage.getItem('g'));
            /*formData.append('name',x.name);
            formData.append('email',x.email);
            formData.append('pice',x.pic);
            formData.append('time',x.time);*/
            if(s.length == 0){
                $("#unm").addClass('dg-input');
                $(".msg").removeClass('hide').text("Field cannot be left empty");
                return false;
            }
            var regex = new RegExp("^[a-zA-Z0-9.,]+$");
            s=s.replace(/[A-Z|&;!#!*=` $%@^"/'<>(){}\! \[\[\],+-]/g,"");
            $('#unm').val(s);
              
            
            
            $.ajax({
              type:"POST",
              url:"requests/chats.php",
              data:form.serialize(),
              success:function(data){
                var resp=JSON.parse(data);
                if(resp.state && !resp.s){
                  $('.unm-err').removeClass('hide');
                }else if(resp.state && resp.s){
                  $('.unm-err').addClass('hide');
                  $('.name').text(resp.name);
                }
              }

            });
          })
          
    
      
  });
  
function user(call){
    var arr={
        user_det:true
    }
    
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            // Typical action to be performed when the document is ready:
            //document.getElementById("demo").innerHTML = xhttp.responseText;
            //console.log(xhttp.responseText);
            call(xhttp.responseText)
            
        }
    };
    
    xhttp.open("POST", 'requests/chats.php',true);
    xhttp.setRequestHeader("Content-type", "application/json")
    xhttp.send(JSON.stringify(arr));
}    
    
    function myFunction(x,type='Account',y) {
      
      //if (x.matches) { // If media query matches
        if(!y){
          window.location.hash=type;
        }
        user(call=>{
        var resp=JSON.parse(call);
            if(resp.state===true){
                
                view(type);
                $('.email').text(resp.result.email);$('.name').text(resp.result.name).val(resp.result.name);$('.prof-img').attr('src',resp.result.imguri);$("#unm").val(resp.result.username);
            }
        })  
        
        
        $('.msgBox').show();
        
      //} else {
        //document.body.style.backgroundColor = "pink";
      //}
}

var x = window.matchMedia("(max-width: 700px)")

x.addListener(myFunction) // Attach listener function on state changes

window.onpopstate = function() {
    // $('.view-overlay').empty().append('<div class="view-close">x</div>').hide();
    // $('html,body').css("overflow","auto");
    // window.history.pushState('page1', "previous title", "previous url");
    // document.title = "previous title";
    if(window.matchMedia("(max-width: 500px)").matches){
      $('.msgBox').hide();
    }else{

    }
      
}

function view(type){
  let g='';
  console.log(type);
  switch(type){
    case '#Account':
      //g='<div class="col-xs-12 col-sm-12 col-md-8 md-top-20"> <form id="regForm" method="POST"> <div class="ok alert alert-success hide">Account created :)</div> <div class="err alert alert-danger hide">Account was not created ! :(</div> <div class="col-xs-12 col-sm-6 col-md-5"> <strong class="f-12">Name</strong> <input type="text" name="name" placeholder="Name" class="form-control"> <span id="inc_email" class="f-12 cl-red hide">Invalid email address</span> </div> <div class="col-xs-12 col-sm-6 col-md-5"> <strong class="f-12">Username</strong> <input type="text" name="username" placeholder="eg; John Doe" class="form-control"> <span id="taken" class="f-12 cl-blue hide">Username already taken</span> </div> <div class="col-xs-12 col-sm-6 col-md-5 md-top-20"> <strong class="f-12">Phone</strong> <input type="text" name="ph" placeholder="" class="form-control"> <span id="inc_email" class="f-12 cl-red hide">Invalid email address</span> </div> </form> </div> ';
      g=' <div class="col-xs-12 col-sm-12 col-md-12 md-top-20 pd-0" style="padding-bottom:0px;"> <div class="col-xs-12 col-sm-12 col-md-3 text-center pd-0"> <img src="https://i.pravatar.cc/150?img=13" class="prof-img" style="width: 90px;height: 90px;" /> <div class="col-xs-12 col-sm-6 col-md-12 md-btm-20"> <h6 class="cl-blue b">Change Picture</h6> <input type="hidden" name="ph" placeholder="" class="form-control"> <span id="inc_email" class="f-12 cl-red hide">Invalid email address</span> </div> <h4 class="name">Shujakhalid</h4> <p class="f-12 text-muted em">shujakhalid26@gmail.com</p> </div> <form id="regForm" method="POST" class="col-xs-12 col-sm-12 col-md-5"> <div class="md-top-0"> <strong class="f-12">Name</strong> <input type="text" name="new_name" placeholder="Name" class="name form-control bg-input"> <span id="inc_email" class="f-12 cl-red hide">Invalid email address</span> </div> <div class="md-top-20"> <strong class="f-12">Username</strong> <input type="text" id="unm" name="new_username" placeholder="eg; John Doe" class="form-control bg-lav"> <span id="taken" class="f-12 unm-err hide">Username already taken</span> </div> <button id="submit" type="submit"  class="btn btn-md btn-success pull-right md-top-20">Save</button></form>\
          <div class="col-xs-12 col-sm-12 col-md-5"><div class="md-top-40"> <strong class="f-12">Phone</strong> <input type="text" name="ph" placeholder="" class="form-control bg-input"> <span id="inc_email" class="f-12 cl-red hide">Invalid email address</span> </div> <div class="md-top-40"> <strong class="f-12">PIN</strong> <div style="font-size:10px;">Create password to protect your chats.</div> <input type="text" name="ph" placeholder="" class="form-control bg-lav"> <span id="inc_email" class="f-12 cl-red hide">Invalid email address</span> </div> <div class="md-top-20"> <strong class="f-12">PIN</strong> <input type="text" name="ph" placeholder="" class="form-control bg-lav"> <span id="inc_email" class="f-12 cl-red hide">Invalid email address</span> </div></div></div>'
      break;
    case '#Appearance':
      g='<div class="col-xs-12 col-sm-12 col-md-12 pd-0 md-top-30"> <div class="col-xs-4 col-sm-3 col-md-2"> <div  id="light" class="ac" style="width:100px;height:100px;background-color:#e6e6fa91;border-radius:14px;"></div> <h3>&nbsp;Light</h3> </div> <div class="col-xs-4 col-sm-3 col-md-2"> <div id="dark" style="width:100px;height:100px;background-color:#404040;border-radius:14px;"></div> <h3>&nbsp;&nbsp;Dark</h3> </div> </div>';
      break;
  }
  document.getElementById('arena').innerHTML=g;
}

  
</script>
    <script>
  
    
        
    </script>

</html>