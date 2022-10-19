
<?php
if(!isset($_GET['g'])){
}else{
    $r=$_GET['g'];
    session_start();
    include('requests/core/group.class.php');
    $gp= new Group();    
    $x=$gp->check_owner($r,$_SESSION['userId']);
    if($x==1){
        $det=$gp->group_info($r);
        //print_r($det);
        //$img="uploads/groups/".$r.'/'.$gp->clean_encode($det['gname']).'/pfp/appIcon.'.$det['iconType'];
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Group Name</title>
    <link rel="apple-touch-icon" href="assets/icons/96.png">
    <meta name="apple-mobile-web-app-status-bar" content="#202020"><!--FFE1C4-->
    <meta name="theme-color" content="#202020">
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0/css/all.min.css">
    <link rel="stylesheet" href="styles/main.css">
    <!-- <link rel="stylesheet" href="styles/test-main.css"> -->
        <script src="assets/js/client.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    
    
    <link rel="stylesheet" href="styles/ui.css">
    <style>
        .switch {
          position: relative;
          display: inline-block;
          width: 51px;
          height: 25px;
        }
        
        .switch input { 
          opacity: 0;
          width: 0;
          height: 0;
        }
        
        .slider {
          position: absolute;
          cursor: pointer;
          top: 0;
          left: 0;
          right: 0;
          bottom: 0;
          background-color: #ccc;
          -webkit-transition: .4s;
          transition: .4s;
        }
        
        .slider:before {
          position: absolute;
          content: "";
          height: 25px;
          width: 25px;
          top:0px;
          left: 0px;
          bottom: 0px;
          background-color: white;
          -webkit-transition: .4s;
          transition: .4s;
        }
        
        input:checked + .slider {
          background-color: #2196F3;
        }

        .btn-info{
          background-color: #2196F3;
        }
        
        input:focus + .slider {
          box-shadow: 0 0 1px #2196F3;
        }
        
        input:checked + .slider:before {
          -webkit-transform: translateX(25px);
          -ms-transform: translateX(25px);
          transform: translateX(25px);
        }
        
        /* Rounded sliders */
        .slider.round {
          border-radius: 34px;
        }
        
        .slider.round:before {
          border-radius: 50%;
        }
        </style>
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



body,.msgBox,.right-bar{
            background-color:#101010;color:#fff;
          }        
          .bd,.bd-top,.bd-lt,.bd-btm,.bd-rt{
            border-color:#202020;
          }

          .bg-lav{ /* used on search */
    border-color:#505050;
    color:#f3f3f3;
    background-color: #404040;
}

          .bg-grey{
            background-color:#202020;
          }

          textarea{
            background-color:transparent;
          }

        input,textarea:focus{
          outline: none;
        }          

        .nav-tabs>li.active>a, .nav-tabs>li.active>a:focus, .nav-tabs>li.active>a:hover {
          background-color:transparent;
          color:#fff;
          border-color:#101010;
          border-bottom:2px solid #b2bb;
        }
        
        .nav-tabs{
          border-color:#000;
        }

        .h-full{
            height:100vh;
        }

        .m > .name{
            color:cornflowerblue;
        }

        .panel-default,.list-group,.panel-default, .list-group, .dropdown-menu>li>a {
                            background-color:#202020;
                            color:#fff;
                            border:none;
                          }

                          

    </style>    
  <script>
    const room="<?=$r;?>";
    const gname="<?=$det['gname'];?>";
    const desc="<?=$det['description'];?>";
    const ext="<?=$det['iconType'];?>";
    var path='uploads/groups/'+room+'/pfp/appIcon.';
    
    $(document).keyup(function(e) {
      if (e.key === "Escape") { // escape key maps to keycode `27`
          window.location.reload()
      }
    });
    </script>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12 col-sm-3 col-md-3 h-full bd-rt pd-top-0">
                <div class="col-xs-12 col-sm-12 col-md-12 md-top-20">
                    <h4 class="b"><i class="fa fa-arrow-left"></i> Test Group
                        <span class="pull-right"><i class="fa fa-cog"></i></span>
                    </h4>
                    <h6 class="b text-muted">#testgroup</h6>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 md-top-20">
                  <div class="pointer col-xs-12 col-sm-12 col-md-12 md-top-10"  onclick='myFunction(x,"#Account",false)'>
                    <h5 class="b text-muted">General</h5>
                  </div>
                  <div class="pointer col-xs-12 col-sm-12 col-md-12 md-top-10"  onclick='myFunction(x,"#Themes",false)'>
                    <h5 class="b text-muted">Themes</h5>
                  </div>
                  <div class="pointer col-xs-12 col-sm-12 col-md-12 md-top-10"  onclick='myFunction(x,"#Members",false)'>
                    <h5 class="b text-muted">Members</h5>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-12 md-top-10">
                    <h5 class="b text-muted">Bans</h5>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-12 md-top-10">
                    <h5 class="b text-muted">Invites</h5>
                  </div>
                  <div id="app"></div>
                </div>  
            </div>
            <div class="msgBox col-xs-12 col-sm-8 col-md-7 h-full pd-top-30">
              <div id="arena">
                <h3 class="pd-lt-10">General</h3>
                <div class="col-xs-12 col-sm-12 col-md-2 pd-0 md-top-20 text-center">
                    
                     <img src="https://flevix.com/wp-content/uploads/2019/07/Untitled-2.gif" class="gpimg prof-img" style="width:100px;height:100px;"> 
                     <h5 class=" cl-blue b pointer"  onclick="trigimage(0)"><i class="fa fa-edit"></i> Change</h5>
                     <form id="newgpimg" method="POST">
                        <input name="fileToUploadapp" type="file" id="imgFile" style="opacity:0;" />
                    </form>

                </div>
                <div class="col-xs-12 col-sm-12 col-md-9 md-top-20">
                   <div class="col-xs-12 col-sm-12 col-md-12 pd-0">
                       <form id="gnameform" method="POST">
                            <label class="text-muted f-12">Group Name</label> <br/> 
                            <div class="bd col-xs-12 f-12 col-sm-12 col-md-7 bg-grey pd-5" > <input id="egn" type="text" value="<?=$det['gname'];?>" style="background-color: transparent; height:30px;border:none;" /> &nbsp;&nbsp; <button id="edSub" class="pull-right btn btn-md btn-silent">Change</button> </div>
                        </form>
                   </div>
                   <br/> 
                   <div class="col-xs-12 col-sm-12 col-md-12 pd-0 ">
                      <div class="text-muted f-12 md-top-20">Description</div>
                      <div class="col-xs-12 f-12 col-sm-12 col-md-12 bg-grey md-top-10 pd-10" > <textarea id="egd" class="bd bg-grey" placeholder="Your Description" style="width:100%;resize: none;"></textarea> <button class="pull-right btn btn-md btn-silent">Change</button> </div>
                   </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 bd-top md-top-30 pd-top-30">
                   <h5>
                      Invite only 
                      <div class="pull-right">
                         <div id="toggler">
                            <!-- Rounded switch --> <label class="switch"> <input id="toggle" type="checkbox"> <span class="slider round"></span> </label> 
                         </div>
                      </div>
                   </h5>
                   <h5 class="text-muted">Group will no longer appear in searches,users will join using invite links only</h5>
                </div>
                <div class=" col-xs-12 col-sm-12 col-md-12 bd-top md-top-30">
                   <h5>Invite Link</h5>
                   <h5 class="text-muted">Invite your friends using the link below.</h5>
                   <div class="col-xs-11 col-sm-11 col-md-11 pd-5 bg-grey text-muted b">example.com/invite/?q=sdsdasdasd</div>
                    <button class="pull-right btn btn-sm btn-info">Copy</button>
                    
                </div>          
              </div>
                
            </div>
            <div class="hide col-xs-12 col-sm-12 col-md-2 bd-lt h-full">
                asd
            </div>
        </div>
    </div>
</body>
<script>
  $(document).ready(function(){
    var hash = window.location.hash;
    var image=path+ext;
    $(".gpimg").attr('src',image);
    if(hash){
      
       myFunction(x,hash,true)
    }else{
      (x.matches)?  false : myFunction(x,'#Account',true);
      
    }

    $(document).on('click','#promote',function(){
      var s=$(this).attr('aria-target');
      alert(s);
    })

    //var gname="Test Group";
    $(document).on('keyup',"#egn",function(e){
        var inp='';
              if(this.value!==gname && this.value!==(gname+" ") && this.value!=="" && this.value!==" "){
                //console.warn(this.value)
                $('#edSub').removeClass("btn-silent").addClass('btn-primary').attr("disabled", !true).attr("type", 'submit');
              }else{
                $('#edSub').removeClass("btn-primary").addClass('btn-silent').attr("disabled", true).removeAttr("type")
                //$('#edSub').attr("disabled", true);
              }
            })
    //$('#toggle').attr('checked', true);;
    $('#toggle').change(function(){
        if(this.checked) {
            alert("ON");
    
        }else{
          alert("OFF");
        }
        
        $('#textbox1').val(this.checked);        
    });

    $(document).on('submit','#gnameform',function(e){
      e.preventDefault();
      var formData = new FormData(this);
      formData.append('gp',room)
      $.ajax({type:"POST",url:"requests/groups.php",
        type:"POST",
        url:"requests/groups.php",
        data:formData,
        cache: false,
        contentType: false,
        processData: false,
        success:function(data){
          console.warn(data);
        }})
    })

  })

  function myFunction(x,type='Account',y) {
    
      if (x.matches) { // If media query matches

        if(!y){
          window.location.hash=type;
        }
        view(type);
        // user(call=>{
        // var resp=JSON.parse(call);
        //     if(resp.state===true){
                
                //view(type);
        //         $('.email').text(resp.result.email);$('.name').text(resp.result.name).val(resp.result.name);$('.prof-img').attr('src',resp.result.imguri);$("#unm").val(resp.result.username);
        //     }
        // })  
        
        
        $('.msgBox').show();
        
      } else {
        //alert(type);
        window.location.hash=type;
        view(type);
        //document.body.style.backgroundColor = "pink";
      }
}

var x = window.matchMedia("(max-width: 500px)")

x.addListener(myFunction) // Attach listener function on state changes

window.onpopstate = function() {
    // $('.view-overlay').empty().append('<div class="view-close">x</div>').hide();
    // $('html,body').css("overflow","auto");
    // window.history.pushState('page1', "previous title", "previous url");
    // document.title = "previous title";
    if(window.matchMedia("(max-width: 500px)").matches){
      
      $('.msgBox').hide();
    }else{
      alert(hash);
    }
      
}

function view(type){
  let g='';
  //console.log(type);
  switch(type){
    case '#Account':
      g='';
      break;
    case '#Themes':
      g='<h3 class="pd-lt-10">Themes</h3> <div class="col-xs-12 col-sm-12 col-md-12 bg-grey pd-10"> <!-- <h4>Outspoken</h4> --> <div class="col-xs-12 col-sm-12 col-md-12 md-top-0 bg-grey"> <div class="message-container m visible"> <div class="name"> <span>shujakhalid</span> </div> <div class="message">Hello world</div> </div> </div> <div class="col-xs-12 col-sm-12 col-md-12 md-top-0 bg-grey"> <div class="message-container visible"> <div class="name"> <span>johnDoe</span> </div> <div class="message">Hello world</div> </div> </div> </div>';
      break;
    case "#Members":
      var mem='';
      let own,adm='';
      
      // getMem(s=>{
      //   console.warn(s);
      // }).then(c=>{
      //   console.warn('aa',c);
        // call=>{
        // //console.log(call);
        // $.each(call.results,function(k,i){
        //   if(i.rank==1){
            
        //     own='<div class="col-xs-12 col-sm-12 col-md-12 md-top-30"><div class="pd-0 bd" style="display: flex;"> <img src="https://i.pravatar.cc/150?img=60" class="prof-img" style="width:60px;height:60px;"/> <div class="f-12 md-top-10" style="flex:1;">Master Admin <span class="f-10 btn btn-xs btn-silent b fa fa-crown"></span> <br/> <span class="f-10 text-muted pd-0">@shujakhalid</span> </div> <div class="pull-right md-top-20 pointer dropdown-toggle" type="button" data-toggle="collapse" href="#collapse1"> <div><i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;</div> </div> </div> <div id="collapse1" class="bd panel-collapse collapse"> <div class="panel-body"> <h6 class="text-muted">Last seen <span class="text-muted pull-right">2 hours ago</span> </h6> <div class="md-top-30"> <h6 class="pull-right"> <span class="text-success">Promote</span> &nbsp;&nbsp;&nbsp;&nbsp; <span class="text-success">Demote</span> &nbsp;&nbsp;&nbsp;&nbsp; <span class="text-danger">Remove</span> </h6> </div> </div> </div> </div> ';
            
        //   }
        // }
      //});
      
      
      $.ajax({type:"POST",url:'requests/groups.php',async: false, data:{'mem':true,'room':room},
      success:function(data){
          resp=JSON.parse(data);
          var s='';
          if(resp.state){
            $.each(resp.results, function(k,index){
              console.log(index)
              if(index.rank==1){
                own='<div class="col-xs-12 col-sm-12 col-md-12 md-top-30"><div class="pd-0 bd" style="display: flex;"> <img src="'+index.imguri+'" class="prof-img" style="width:60px;height:60px;"/> <div class="f-12 md-top-10" style="flex:1;">'+index.username+'<span class="f-10 btn btn-xs btn-silent b fa fa-crown"></span> <br/> <span class="f-10 text-muted pd-0">@masteradmin</span> </div> <div class="pull-right md-top-20 pointer dropdown-toggle" type="button" data-toggle="collapse" href="#collapse'+k+'"> <div><i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;</div> </div> </div> <div id="collapse'+k+'" class="bd panel-collapse collapse"> <div class="panel-body"> <h6 class="text-muted">Last seen <span class="text-muted pull-right">2 hours ago</span> </h6> <div class="md-top-30"> <h6 class="pull-right"> <span class="text-success">Promote</span> &nbsp;&nbsp;&nbsp;&nbsp; <span class="text-success">Demote</span> &nbsp;&nbsp;&nbsp;&nbsp; <span class="text-danger">Remove</span> </h6> </div> </div> </div> </div> ';
              }else{
                adm+='<div class="md-top-30"> <div class=" pd-0 bd" style="display: flex;"> <img src="'+index.imguri+'" class="prof-img" style="width:60px;height:60px;"/> <div class="f-12 md-top-10" style="flex:1;">'+index.username+'<span class="f-10 btn btn-xs btn-silent b fa fa-crown"></span> <br/> <span class="f-10 text-muted pd-0">@shujakhalid</span> </div> <div class="pull-right md-top-20 pointer dropdown-toggle" type="button" data-toggle="collapse" href="#collapse'+k+'"> <div><i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;</div> </div> </div> <div id="collapse'+k+'" class="bd panel-collapse collapse"> <div class="panel-body"> <h6 class="text-muted">Rank <span class="text-muted pull-right">Admin</span> </h6> <div class="md-top-30"> <h6 class="pull-right"> <span class="prm text-success" id="promote" aria-target="'+index.user+'">Promote</span> &nbsp;&nbsp;&nbsp;&nbsp; <span class="text-success">Demote</span> &nbsp;&nbsp;&nbsp;&nbsp; <span class="text-danger">Remove</span> </h6> </div> </div> </div> </div> ';
                
              }
            });
          }
        }
      });
         
      //console.warn(own);
      g='<h4 class="pd-lt-10 b">Members</h4> <div class="col-xs-12 col-sm-12 col-md-6 md-top-30 pd-0"> <h5 class="text-muted">232 Members</h5> </div> <div class="col-xs-12 col-sm-12 col-md-6 md-top-30"> <div class="bg-input col-xs-4 col-sm-4 col-md-8 pull-right pd-5"> <input type="search" class="bg-input f-12" placeholder="Search Members" > <span class="text-muted pull-right"><i class="fa fa-search"></i></span> </div> </div>'+own+'</div><div class="col-xs-12 col-sm-12 col-md-12 pd-0 md-top-30"> <h5 class="text-muted">Moderators</h5> <br/> '+adm+'</div><div class="col-xs-12 col-sm-12 col-md-12 pd-0 md-top-30"> <h5 class="text-muted">Members</h5> <br/> <div class="col-xs-12 col-sm-12 col-md-12 bd" style="display: flex;"> <img src="https://i.pravatar.cc/150?img=60" class="prof-img" style="width:60px;height:60px;"/> <div class="f-15 md-top-10" style="flex:1;">Shuja Khalid </div> <div class="pull-right md-top-20"> <button class="btn btn-sm btn-silent">Promote</button> <button class="btn btn-sm btn-silent">Remove</button> </div> </div> </div>';
     
  }
  document.getElementById('arena').innerHTML=g;
}

</script>
<script>
 function trigimage() {
    $("#imgFile").trigger('click');
  }

function validate(){
  var fl=document.getElementById("imgFile");
  var nm=$("#egn").val();
  //var cat=$("#unm").val();

  if( fl.files.length == 0 ){
    console.log("no files selected");
    return false;
  }else if(nm=="" || nm==" " || nm==null){
    console.log("Fields cannot be left empty!");
    return false;
  }else{
    return true;
  }

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
            $('.preview > div').addClass('hide');
            $('.preview > img').removeClass('hide');
            $('.preview > img').attr('src', e.target.result);
            //$('.image_selector').replaceWith("<div class='pull-right image_deselector pd-10' onclick='triggerOff()'><span class='glyphicon glyphicon-remove text-muted f-22'></span></div>");
            //$('#blah').attr('src', e.target.result);
            //$("#attach_img").html('<img src="' + e.target.result + '" id="blah" alt="image not rendered"><div id="imgAt" style="display:inline-block;width:50px;height:50px;background-color:#fff;text-align:center;padding-top:15px;" class="f-15" onclick="trigimage()"><i class="fa fa-redo-alt"></i></div>');
        }

        reader.readAsDataURL(input.files[0]);
    }
}



$("#imgFile").change(function() {
    //readURL(this);
    $('#newgpimg').submit();
});

$(document).on('submit','#newgpimg',changeImage);

function changeImage(event){
    event.preventDefault();
    $('.gpimg').attr('src','https://flevix.com/wp-content/uploads/2019/07/Untitled-2.gif');
    if(validate()){
        //ok
          var formData = new FormData(this);
          formData.append('changeImage',true);
          formData.append('room',room);
          formData.append('exten',ext);
          
          $.ajax({
            xhr: function() {
              var xhr = new window.XMLHttpRequest();
              xhr.upload.addEventListener("progress", function(evt) {

                  if (evt.lengthComputable) {
                      var percentComplete = (evt.loaded / evt.total) * 100;
                      //Do something with upload progress here
                      $('.progress-bar').animate({
                          width: percentComplete+"%",
                          opacity: 1
                        }, 1000 );
                      
                  }
            }, false);
            return xhr;
          },
              type:"POST",
              url:"requests/groups.php",
              data:formData,
              success:function(data){
                  var resp=JSON.parse(data);
                  console.warn(resp);
                  $('.gpimg').attr('src',path+resp.exten+"?s="+(new Date()).getTime());
                  
              },
              cache: false,
              contentType: false,
              processData: false

          });  


      }else{
        //no
        console.warn('BI');
      }
}

async function getMema(call){
  //$('#own').html('asdsd');
  //return "HELLO";
    let prom=new Promise(function(resolve,rej){
    //return new Promise(async function(resolve,rej){
      $.ajax({type:"POST",url:'requests/groups.php', data:{'mem':true,'room':room},
      success:function(data){
          resp=JSON.parse(data);
          resolve(resp);
        }
      });
    })
  //})
  return await call(prom);
}




function getMem(call){
  //$('#own').html('asdsd');
  //return "HELLO";
    //let prom=new Promise(function(resolve,rej){
    
      $.ajax({type:"POST",url:'requests/groups.php',async: false, data:{'mem':true,'room':room},
      success:function(data){
          resp=JSON.parse(data);
          return resp;
        }
      });
    
  //})
  //return await prom;
}

</script>
</html>
<?php
        }
    }
?>