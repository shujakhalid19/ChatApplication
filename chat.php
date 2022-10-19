<?php
session_start();
if(!isset($_SESSION['userId'])){
  header('Location:login.html');
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Unopinion</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    
    <link rel="manifest" href="manifest.json">
    <link rel="icon" type="image/png" href="assets/icons/sq_512.png"/>
    <link rel="apple-touch-icon" href="assets/icons/sq_96.png">
    <meta name="apple-mobile-web-app-status-bar" content="#202020"><!--FFE1C4-->
    <meta name="theme-color" content="#202020">
    <script src="assets/js/app.js"></script>
    <script src="assets/js/client.js"></script>
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0/css/all.min.css">
    <link rel="stylesheet" href="styles/main.css">
    <link rel="stylesheet" href="styles/ui.css">
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <!-- <link rel="stylesheet" href="styles/test-main.css"> -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js" integrity="sha512-XtmMtDEcNz2j7ekrtHvOVR4iwwaD6o/FUJe6+Zq+HgcCsk3kj4uSQQR8weQ2QVj1o0Pk6PwYLohm206ZzNfubg==" crossorigin="anonymous"></script>
    <script src="https://cdn.rawgit.com/mattdiamond/Recorderjs/08e7abd9/dist/recorder.js"></script>
    <script src="https://unpkg.com/wavesurfer.js"></script>

    
    <style>
      <?php
        if(isset($_SESSION['th'])){
          if($_SESSION['th']=='dark'){
      ?>
      <?php
          }
        }
      ?>
      
        .imgtxt{
            font-size: 18px;
            font-weight: bold;
            padding-bottom:10px;
        }
        
        .m > .name{
            color:cornflowerblue;
        }
        
        #blah{
            width:100%;
            height: auto;
            object-fit: cover;
        }

        #imgAt{
          position: absolute;
          width:20px;height:20px;
          background-color:transparent;
          margin-top:0px;
          margin-left: 95px;
          margin-bottom:0px;
          text-align: right;
          cursor: pointer;
        }


        #messages::-webkit-scrollbar {
          
  display: none;
}

/* Hide scrollbar for IE, Edge and Firefox */
#messages {
  -ms-overflow-style: none;  /* IE and Edge */
  scrollbar-width: none;  /* Firefox */
  

}
        
        #messages{
            padding-bottom:200px;
        }
        
        .chat-box{
            display: flex;
            flex-direction: column-reverse;
        }
 
        
                .btn-send{
            background-color: transparent;
            color:cornflowerblue;
            border:none;
        }
        
        textarea{
             resize: none;
    overflow: hidden;
    min-height: 5px;
    max-height: 100px;
        }
        
        textarea:focus{
            outline:none;
        }

        /* BUBBLE */

.container-fluid{
  overflow-x:hidden;
}
div::-webkit-scrollbar {
    width: 0;  /* Remove scrollbar space */
    background: transparent;  /* Optional: just make scrollbar invisible */
}
/* Optional: show position indicator in red */
div::-webkit-scrollbar-thumb {
    background:#20202011;
}html,body{
  overflow-x: hidden;
  overflow-y: auto;
}

.popover-content,.popover-content > ul{
  background-color:#404040 !important;
}

.modal-backdrop{
            z-index:+99;
          }
          /* //BUBBLE */
    

    </style>
      <script> 
  
        $(document).ready(function() { 
 
          //$("[data-toggle=popover]").each(function(i, obj) {
            //$('body').popover(popOverSettings);
// $(this).popover({
//   html: true,
//   content: function() {
//     var id = $(this).attr('id')
//     return $('#popover-content-' + id).html();
//   }
// });
          //});
          $(this).popover({
    container: 'body',
    html: true,
    //selector: '[rel="popover"]', //Sepcify the selector here
    selector:'[data-toggle=popover]',
    content: function() {
      var id = $(this).attr('id')
      //alert(id);
      return $('#popover-content-' + id).html();
      //return $(this).parent().find('#popover-content-' + id).html();
    }
});

$('#box').on('scroll', function () {
        var $container = $(this);
        $(this).find('.popover').each(function () {
            $(this).css({
                top:  - $container.scrollTop()
            });
        });
    });
          
          $('.accs').attr('src',sessionStorage.getItem('im'));

          $('#usergroups').slick({
            infinite: false,
            speed: 300,
            adaptiveHeight: false,
            slidesToShow: 1.2,
            prevArrow: false,
            nextArrow: false,
            slidesToScroll: 1,
            //autoplaySpeed: 1500,
            arrows: false,
            dots: false,
            //pauseOnHover: false,
            responsive: [
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 1.2,
                    },
                },
                {
                    breakpoint: 520,
                    settings: {
                        slidesToShow: 1,
                    },
                },

                {
                    breakpoint: 420,
                    settings: {
                        slidesToShow: 1.2,
                        dots:false,

                    },
                },
            ],
          });
        }); 
    </script> 
  </head>
<body>
    <div class="container-fluid">
        
        <div class="row">
            <div class='col-xs-12 col-sm-4 col-md-3 bd-rt pd-0' style='height:100vh;overflow-y:scroll;overflow-x:hidden;'>
            <h3 class="b col-xs-2 col-sm-2 col-md-2">
                Search
              </h3>
              <div class="pull-right">
                <a href="groups.html">
                  <span style="width:20px;height:20px;color:#eee;padding:10px;">
                    <i style="background-color:#404040;border-radius:50%;" class="pd-10 f-18 fa fa-users"></i>
                    &nbsp;
                  </span>
                </a>
                <a href="account.php"><img src="https://placeholder.com/60/FFFFFF/000000/?text=S" class='prof-img accs' style='width:60px;height:60px;'/></a>
              </div>
                
              
              <form id='search' method="POST" class="col-xs-12 col-sm-12 col-md-12 md-top-10">
                <div class="form-group has-feedback">
                    <input id='search_col' type="text" name='search' class="form-control bg-lav" placeholder="Search for a blogging website.." style="height:40px;border-width:0px 0px 2px 1px;border-radius:12px;" autocomplete="off" title="Three letter country code" />
                    <i class="glyphicon glyphicon-search form-control-feedback"></i>
                </div>
                <input type="submit" 
                  style="position: absolute; left: -9999px; width: 1px; height: 1px;"
                  tabindex="-1" />
              </form>
              <div class="col-xs-12">
                
                <div>
                    <style>
                        .xx{
  display: flex;
  overflow-x: auto;
  padding-right:100px;
}

.xx>div{
  width: 120px;
  flex-shrink: 0;
  height: 170px;
}

.xx::-webkit-scrollbar {
    width: 0;  /* Remove scrollbar space */
    background: transparent;  /* Optional: just make scrollbar invisible */
}
/* Optional: show position indicator in red */
.xx::-webkit-scrollbar-thumb {
    background:#20202011;
}

                    </style>
                  <h5 style="color:#a5a9b4;">Group<span class="pull-right fa fa-plus"></span></h5>
                  
                  

                  <div id="myGroups" class="xx" >
                      <!-- <div id="users" data-order='iefnai' class="pointer col-xs-12 col-sm-12 col-md-12 pd-0 md-top-20" >
                        <div class="col-xs-3 col-sm-4 col-md-3 pd-0 "> 
                            <img src="https://images.generated.photos/1oRWlVCn0vDc6PrWwiSBN3O45qRY0ONRSX8UDzEfOhw/rs:fit:256:256/Z3M6Ly9nZW5lcmF0/ZWQtcGhvdG9zL3Yz/XzA2NjEzMTEuanBn.jpg" class="prof-img" style="width: 70px;height: 70px;">
                         </div>
                      </div>

                      <div id="users" data-order='iefnai' class="pointer col-xs-12 col-sm-12 col-md-12 pd-0 md-top-20" >
                        <div class="col-xs-3 col-sm-4 col-md-3 pd-0 "> 
                            <img src="https://generated.photos/vue-static/home/hero/2.png" class="prof-img" style="width: 70px;height: 70px;">
                         </div>
                      </div>

                      <div id="users" data-order='iefnai' class="pointer col-xs-12 col-sm-12 col-md-12 pd-0 md-top-20" >
                        <div class="col-xs-3 col-sm-4 col-md-3 pd-0 "> 
                            <img src="https://randomuser.me/api/portraits/men/11.jpg" class="prof-img" style="width: 70px;height: 70px;">

                         </div>
                      </div>

                      <div id="users" data-order='iefnai' class="pointer col-xs-12 col-sm-12 col-md-12 pd-0 md-top-20" >
                        <div class="col-xs-3 col-sm-4 col-md-3 pd-0 "> 
                            <img src="https://randomuser.me/api/portraits/men/12.jpg" class="prof-img" style="width: 70px;height: 70px;">

                         </div>
                      </div>

                      <div id="users" data-order='iefnai' class="pointer col-xs-12 col-sm-12 col-md-12 pd-0 md-top-20" >
                        <div class="col-xs-3 col-sm-4 col-md-3 pd-0 "> 
                            <img src="https://generated.photos/vue-static/home/hero/3.png" class="prof-img" style="width: 70px;height: 70px;">

                         </div>
                      </div>

                      <div id="users" data-order='iefnai' class="pointer col-xs-12 col-sm-12 col-md-12 pd-0 md-top-20" >
                        <div class="col-xs-3 col-sm-4 col-md-3 pd-0 "> 
                            <img src="https://lh3.googleusercontent.com/a-/AOh14GjGiEF0xwirsnYn6-C-EJevwgAfCqzZ3uVljrBSAA=s96-c" class="prof-img" style="width: 70px;height: 70px;">

                         </div>
                      </div> -->

                  </div>
                 
                </div>
                
<!-- //END GROUPS -->
                    
                
            </div>  

            <div  class="col-xs-12 col-sm-12 col-md-12 bd-btm md-top-30">
                <h5 style="color:#a5a9b4;" title="Header" data-toggle="popover" data-placement="right" data-html="true" data-content="Content">My Chats </h5>
                

                <div id='res'></div>
                <div style="width:100%;height:300px;baclground-color:red;"></div>
            </div>
              
            <div class="col-xs-12 col-sm-12 col-md-12 bd-btm md-top-10" style="position:absolute;top:auto;bottom:0px;">
              <!-- <ul class="nav nav-tabs" style="display:flex;justify-content:space-around;">
  <li class="active"><a href="#">Chats</a></li>
  <li><a href="#">Groups</a></li>
  <li><a href="#">Status</a></li>
  <li><a href="#">Calls</a></li>
</ul> -->
            </div>
          </div>
            <div class='msgBox col-xs-12 col-sm-5 col-md-6  pd-0'>
                <div hidden class='col-xs-12 col-sm-12 col-md-12 pd-0' style="height:auto;">
                  
                <div class='col-xs-2 col-sm-12 col-md-1 pd-0 xs-pull-right'>
                    <a href="#profile">
                        <img id="mainImg1" src='images/profile_placeholder.png' class='prof-img' style="width: 60px;height: 60px;" />
                    </a>
                  </div>  
                  <div id="mainChat" class='col-xs-9 col-sm-12 col-md-11 pd-0 pd-lt-10'>
                    <h4>Azam
                    
                    </h4>
                    <p class='f-12 cl-blue'>Online</p>
                    
                  </div>
                  
                </div>
                  <div id="box" class="pd-0 col-xs-12 col-sm-12 col-md-12 chat-box bd"  style='overflow-y:scroll;'>
                    <div id="first-time" class="hide col-xs-12 col-sm-12 col-md-12 text-center">
                      <img id="mainImg2" src='images/profile_placeholder.png' class='prof-img' style="width: 110px;height:110px;" />
                      <h3>Add user to chatlist</h3>
                      <form id='addNew' method="POST">
                          <input type='hidden' id='friend' name='friend'>
                          <button type='submit' class='btn btn-md btn-success'>Add Friend</button>
                      </form>
                          
                    </div>
                    <div id="messages" class="pd-10">
                        <div class="message-container">
                          <div class="name">shuja</div>
                          <div class="message">Hello</div>
                        </div>
                    </div>
                      
                  </div>
                  <!--<div id='msg-inp' class='col-xs-12 col-sm-12 col-md-11 pd-0 ' style='position:absolute;top:auto;bottom:0px;'>
                    <form id="message-form" action="#">
                      <div class="col-xs-12" style="display: flex;">
                        <input class="mdl-textfield__input form-control" autocomplete="off" type="text" id="message" style="width:100%;height:40px;">
                        <button id="submit" type="submit" class="btn btn-md btn-primary pull-right">
                          Send
                        </button>
                      </div>
                      
                    </form>
                  </div>-->
                    <div hidden id='msg-inp' class='col-xs-12 col-sm-12 col-md-12 pd-0 bd bg-grey' style='position:absolute;top:auto;bottom:0px;z-index:+99;'>
                         <div class='preview hide col-xs-12 col-sm-12 col-md-12 md-btm-10'>
                             <!--<div style="position:absolute;width:40px;height:40px;background-color: aqua;margin:0px 10px 0px 110px;">&times;</div>-->
                             <div id="imgAt" class="f-15" onclick="triggerOff()"><i class="fa fa-times"></i></div>
                             <img src="" style="width:100px;height:100px;border-radius:14px;object-fit: cover;" alt="Image not selected"/>
                             
                        </div>

                        <div class='preview_bl hide col-xs-12 col-sm-12 col-md-12 md-btm-10'>
                        </div>
                        <div class="preview_ml hide">
                        <div class="col-xs-12 text-muted" style="border-radius:14px;padding:20px 0px 10px 4px;">
                              <span class="pointer" onclick="iniRecording(this)" style="font-size:24px;">
                                <i class="fa fa-microphone"></i></span>
                                
                                &nbsp;&nbsp;&nbsp;&nbsp;
                                <span class="mic-info">Click on the mic to start recording</span>
                                <span id="play" class="pull-right"></span>
                                <div id="waveform"></div>
                                
                              <span class="pull-right" onclick="blastOff()">
                                &nbsp;&nbsp;<i class="fa fa-times"></i>
                              </span>
                            </div>
                        </div>
                    
                    <form id="message-form" class="col-xs-12 col-sm-12 col-md-12 pd-0" action="#">
                      <div class="col-xs-12" style="display: flex;">
                        <input name="fileToUpload" type="file" id="imgFile" style="position: absolute; opacity:0;margin-top: -1000px;" />
                        <input type='hidden' id='conf-inp'>
                        <!--<input class="mdl-textfield__input form-control" autocomplete="off" type="text" id="message" style="width:100%;height:40px;">-->
                        <textarea id="message"  style="width:100%;height:20px;border:none;padding:5px;" placeholder="Message.."  oninput="auto_grow(this)"></textarea>
                        <button id="submit" type="submit" class="btn-send pull-right">
                          Send
                        </button>
                      </div>
                      
                    </form>
                     <div class="col-xs-12 col-sm-12 col-md-12 f-18 pd-5 md-top-10 bg-grey f-22">
                          <span onclick="trigimage()"><i class="fa fa-image"></i></span>
                          &nbsp;&nbsp;&nbsp;&nbsp;
                         <span onclick="set_explode()">🎉</span>
                         &nbsp;&nbsp;&nbsp;&nbsp;
                         <span onclick="setMic()"><i class="fa fa-microphone"></i></span>
                      </div>
                    
                  </div>
                
            </div>

            <div class="right-bar col-xs-12 col-sm-12 col-md-3 pd-0" style="height: 100vh;">
              
                
            </div>
           
     
                          
        </div>
    </div>
    
</body>

    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.3.3/dist/confetti.browser.min.js"></script>
    <script src="scripts/explode.js"></script>
    <script>
    $.ajax({type:"POST",url:'requests/groups.php',data:{'myGroups':true},
        success:function(data){
          var resp=JSON.parse(data);    
          if(resp.state){
            let h='';
            $.each(resp.results,function(key,i){
              //console.log('aa',index);
                var image='uploads/groups/'+i.keyUnique+'/pfp/appIcon.'+i.iconType;
                console.warn(image);
                //h+='<div id="group" data-hold="'+i.keyUnique+'" onclick="openChat(&apos;'+i.prom+'&apos;,&apos;'+image+'&apos;,&apos;'+i.gname+'&apos;,&apos;'+i.category+'&apos;,&apos;g&apos;,this)" class="pointer col-xs-6 col-sm-12 col-md-6 pd-0 md-top-10 md-btm-10"> <div class="col-xs-3 col-sm-4 col-md-3"> <img src="'+image+'" class="" style="width:30px;height:30px;" /> </div> <div class="col-xs-9 col-sm-4 col-md-9 md-top-10"> <strong class="f-12">'+i.gname+'</strong> </div> </div> ';
                h+='<div id="group" data-hold="'+i.keyUnique+'" onclick="openChat(&apos;'+i.prom+'&apos;,&apos;'+image+'&apos;,&apos;'+i.gname+'&apos;,&apos;'+i.category+'&apos;,&apos;g&apos;,this)" class="pd-10 pointer" style="margin-right:10px;"><img src="'+image+'" style="width:100px;height:100px;border:2px solid #404040;object-fit:cover;"><h6 class="b">'+i.gname+'</h6><span style="color:#a5a9b4">#test</span></div>';
            })
            $("#myGroups").html(h);
          }
        }
    });
</script>
<script>
    var d=new Date();
    window.location.hash='#home';
    window.sessionStorage.setItem('device','<?=$_SESSION["userId"];?>');
    $(function(){
      //console.warn('device:'+window.sessionStorage.getItem('device'));
   



        $('#search').on('submit',function(e){
          e.preventDefault();
          window.location.hash='#search';
          var s=$('#search_col').val();
          console.log(clean(s));
        
           var formData = $(this);
           $('#res').html('<h2 class="text-center cl-blue"><i class="fa fa-spin fa-spinner"></i></h2>');
            $.ajax({
                type:"POST",
                url:'requests/chats.php',
                data:formData.serialize() + '&' + $.param({
                'time': d.getTime(),
                }),
                success:function(data){
                var resp=JSON.parse(data);
                //console.log(resp);
                if( $.isArray(resp) || resp.length){
                    let h='';
                    $.each(resp, function(k,i){
                    console.log(i);
                    h+='<div id="users" class="pointer col-xs-12 col-sm-12 col-md-12 pd-0" onclick="addUser(&apos;AddNew&apos;,&apos;'+i.keyUnique+'&apos;,&apos;'+i.imguri+'&apos;,&apos;'+i.name+'&apos;,&apos;'+i.email+'&apos;)" > <div class="col-xs-3 col-sm-12 col-md-3 pd-0 "> <img src="'+i.imguri+'" class="prof-img" style="width: 70px;height: 70px;" /> </div> <div class="col-xs-9 col-sm-12 col-md-9 pd-0 "> <h4>'+i.name+'<span class="pull-right"><i class="glyphicon glyphicon-option-vertical"></i></span> </h4> <p class="f-12">'+i.email+'</p> </div> </div>';
                    })
                    $('#res').html(h);
                }else{
                    $('#res').html('<h2 class="text-center"><br /> No results found.</h2>');
                }
                }
            })
        });


        $('#addNew').on('submit',function(e){
          e.preventDefault();
          var s=$('#friend').val();
          console.log(clean(s));
          localStorage.setItem("prime", '');
           var formData = $(this);
           $('#res').html('<h2 class="text-center cl-blue"><i class="fa fa-spin fa-spinner"></i></h2>');
            $.ajax({
                type:"POST",
                url:'requests/chats.php',
                data:formData.serialize() + '&' + $.param({
                'time': d.getTime(),
                }),
                success:function(data){
                    var resp=JSON.parse(data);
                    if(resp.state==1){

                      $("#first-time").remove();
                      $('#msg-inp').removeClass('hide');
                      localStorage.setItem('prime',resp.promise);
                      myChat();
                    }
                
                }
            })
        });
        
        

        
    })

function addUser(tag,id,img,name,em){

    $("#messages").html('');
    $('#mainChat > h4').text(name);
    $('#mainImg1 , #mainImg2').attr('src',img);
    $('#friend').val(id);
    checkFriend(id);

    window.location.hash = '#'+tag;
    myFunction(x) // Call listener function at run time
}

function checkFriend(id){
  $.ajax({
    type:"POST",
    url:"requests/chats.php",
    data:{
      'friendship':id
    },
    success:function(data){
      var resp=JSON.parse(data);
      
      if(resp.state){
        //console.log(resp.results[0].keyUnique);
        localStorage.setItem('prime',resp.results[0].keyUnique);
        $("#box").addClass('chat-box');
        $("#first-time").addClass('hide');
        $('#msg-inp').removeClass('hide');
        friendlyChat.loadMessages();
      }else{
        
        console.log('resp');
        $("#box").removeClass('chat-box');
        $("#first-time").removeClass('hide');  
        $('#msg-inp').addClass('hide');
        
      }
    }
  })
}


function openChat(id,img,name,em,type,elem){
    var s=$('.msgBox > div:eq(0),.msgBox > div:eq(2)').attr('hidden',false);
    $('#first-time').addClass('hide');
    $("#box").addClass('chat-box');
    $('#mainChat > h4').text(name);
    $('#mainImg1 , #mainImg2').attr('src',img);
    $('#friend').val(id);
    localStorage.setItem("prime", id);
    window.location.hash = '#touch';
    //myFunction(x) // Call listener function at run time
    friendlyChat.loadMessages();
    
    if(type=='g'){
      var q=$(elem).attr('data-hold');
      $.ajax({type:"POST",url:'includes/group/description.php',data:{'name':name,'category':em,'description':'ds','key':q,'md':4,'im':img},
        success:function(data){
          $('.right-bar').html(data);  
        }
      });
    }else if(type=='c'){
      $('.right-bar').html('  <div class="col-xs-12 col-sm-12 col-md-12 pd-top-12 text-center"><img src="'+img+'" class="prof-img" style="width:110px;height: 110px;" /></div>  <div class="col-xs-12 col-sm-12 col-md-12 text-center"><h3>'+name+'</h3><p class="f-12 text-muted">@'+em+'</p></div><div class="col-xs-12 col-sm-12 col-md-12"><h5 class="text-muted b">Chat Themes</h5><div class="appCard md-top-20" style="justify-content: space-evenly;"><div style="width:50px;height:50px;background-color:palevioletred;"></div><div style="width:50px;height:50px;background-color:cadetblue;"></div><div style="border:2px solid cornflowerblue;width:50px;height:50px;background-color:#202020;"></div><div style="width:50px;height:50px;background-color:#a5a9b4;"></div></div><div class="md-top-20"><div class="pointer md-top-40 b cl-blue"><i class="fa fa-comments"></i> Start a group</div><div class="pointer text-danger md-top-40 b"><i class="fa fa-info-circle"></i> Report</div></div><div>');
    }
}

// function myFunction(x) {
//   if (x.matches) { // If media query matches
//     $('.msgBox').show();
//   } else {
//     //document.body.style.backgroundColor = "pink";
//   }
// }

//var x = window.matchMedia("(max-width: 700px)")

//x.addListener(myFunction) // Attach listener function on state changes

function myChat(){
  //alert('asd');
    $.ajax({
        type:"POST",
        url:"requests/chats.php",
        data:{
            'chatList':true
        },
        success:function(data){
            var resp=JSON.parse(data);
            console.log(resp);
            if( $.isArray(resp.result) || resp.result.length){
                    let h='';
                    $.each(resp.result, function(k,i){
                    console.log(i);
                    h+='<div id="users" class="pointer col-xs-12 col-sm-12 col-md-12 pd-0" onclick="openChat(&apos;'+resp.prom[k]+'&apos;,&apos;'+i.imguri+'&apos;,&apos;'+i.name+'&apos;,&apos;'+i.email+'&apos;,&apos;c&apos;,this)" > <div class="col-xs-3 col-sm-4 col-md-3 pd-0 "> <img src="'+i.imguri+'" class="prof-img" style="width: 60px;height: 60px;" /> </div> <div class="col-xs-9 col-sm-8 col-md-9 pd-0 "> <h5>'+i.name+'<span class="pull-right"><i class="glyphicon glyphicon-option-vertical"></i></span> </h5> <p class="f-12">'+i.email+'</p> </div> </div>';
                    })
                    $('#res').html(h);
                }else{
                    $('#res').html('<h2 class="text-center"><br /> No results found.</h2>');
                }
        }
    })
}


function clean(str){
    return str.replace(/[^a-zA-Z0-9\-]/g, '');
}
    
    
    

</script>
<script src="https://www.gstatic.com/firebasejs/8.2.9/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.2.9/firebase-auth.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.2.9/firebase-database.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.2.9/firebase-storage.js"></script>
<script>
  // Your web app's Firebase configuration
  // For Firebase JS SDK v7.20.0 and later, measurementId is optional
  var firebaseConfig = {
    apiKey: "AIzaSyA9u7OczwCe73M8lbGwFrTjDsasNis0H5I",
    authDomain: "webchat-439a6.firebaseapp.com",
    projectId: "webchat-439a6",
    databaseURL: "https://webchat-439a6-default-rtdb.firebaseio.com",
    storageBucket: "webchat-439a6.appspot.com",
    messagingSenderId: "534912297138",
    appId: "1:534912297138:web:4f5775c362a823015b01ab",
    measurementId: "G-HQMR39F7TW"
  };
  //testfirebaseapp-726ec"
  // Initialize Firebase
  firebase.initializeApp(firebaseConfig);
  //firebase.analytics();
</script>
<script src="scripts/chat.js"></script>
    <script>
         
        function trigimage() {
        $("#imgFile").trigger('click');
    }
    
    function triggerOff(){
        $("#imgFile").val("");
        $('.preview').addClass('hide');
        $('.preview').attr('src', '');
        $('.image_deselector').replaceWith("<div class='pull-right image_selector pd-10' onclick='trigimage()'><span class='glyphicon glyphicon-picture text-muted f-22'></span></div>");
    }

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();


            reader.onload = function(e) {
                //console.warn(e.target.result);
                $('.preview').removeClass('hide');
                $('.preview > img').attr('src', e.target.result);
                //$('.image_selector').replaceWith("<div class='pull-right image_deselector pd-10' onclick='triggerOff()'><span class='glyphicon glyphicon-remove text-muted f-22'></span></div>");
                //$('#blah').attr('src', e.target.result);
                //$("#attach_img").html('<img src="' + e.target.result + '" id="blah" alt="image not rendered"><div id="imgAt" style="display:inline-block;width:50px;height:50px;background-color:#fff;text-align:center;padding-top:15px;" class="f-15" onclick="trigimage()"><i class="fa fa-redo-alt"></i></div>');
            }

            reader.readAsDataURL(input.files[0]);
        }
    }



    $("#imgFile").change(function() {
        readURL(this);
    });
       
    
    function openGroup(){
      //this function needs to be merged into openChat func later;
      $('.msgBox > div:eq(0),.msgBox > div:eq(2)').attr('hidden',false);
      $('#first-time').addClass('hide');
      $("#box").addClass('chat-box');
      $('#mainChat > h4').text('Group NAME');
      $('#mainImg1 , #mainImg2').attr('src',img);
      //$('#friend').val(id);
      //localStorage.setItem("prime", id);
      window.location.hash = '#touch';
    }



    
    
    </script>
<script src="scripts/sidebar.js"></script>
<script src="scripts/recordapp.js"></script>    
</html>