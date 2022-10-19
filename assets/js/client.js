function report(id){
    localStorage.setItem("reportId",id);
    $('#myReport').modal('show');
}

function deletepost(id){
    localStorage.setItem("delId",id);
    $('#myDelete').modal('show');
}

function deletemain(){
    //var f=localStorage.getItem('delId');
    $.ajax({
        type:"POST",
        url:"./requests/topic.php",
        data:{
            'time': d.getTime(),
            'deleteId':localStorage.getItem('delId'),
            'delete':true
        },
        success:function(data){
            var resp=JSON.parse(data);
            console.log(resp);
            if(!resp.err){
                if(resp.result.one){
                    $('#myDelete').modal('hide');
                    $('.'+resp.result.post).slideUp();
                }else{
                    console.warn('Post was not deleted');
                }
            }else{
                console.warn('Error sending delete request');
            }
                
        }
    });    
}

function parent(id,t){
    var r=$(t).parent('div').parent('div').parent('div').parent('div');
    r.addClass('bg-danger');
    r.remove();
    console.log(r);
}

function clean(str){
    return str.replace(/[^a-zA-Z0-9\-]/g, '');
}

function clean_encode(str){
    var enc=btoa(str);
    return enc.replace(/[^a-zA-Z0-9\-]/g, '');
}

function clean_decode(str){
    var enc=atob(str);
    return enc.replace(/[^a-zA-Z0-9\-]/g, '');
}

function bring(asd,us,t){
    //alert('asd');
    $('#post').val(asd);
    $('#allComments').html('<div class="spinner"></div>');
    var s=$(t).children().clone();
    s.find('.submenu-toggle').remove();
    $('#expandedposts').html(s);
    $('#expandedposts').prepend('<div class="col-xs-12 col-sm-12 col-md-12 pd-0"><img src="https://images.unsplash.com/photo-1531427186611-ecfd6d936c79?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=500&q=60" class="pd-0 prof-img" style="width:70px;height:70px;" /><strong class="f-18">'+us+'</strong></div>');
    $("#expandedposts").append($(t).next().clone());
    var x=bringComments(asd,x=>{
      var resp=JSON.parse(x);
      let htm='';
      let submen='';
      $.each(resp, function(key,resp){
        htm+='<div id="opinion" class="col-xs-12 col-md-12 col-sm-12 pd-0 bd"> <div class="col-xs-12 col-sm-12 col-md-12 pd-0"> <img src="https://images.unsplash.com/photo-1531427186611-ecfd6d936c79?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=500&q=60" class="pd-0 prof-img" style="width:70px;height:70px;" /> <strong class="f-18">'+resp.username+'</strong> <div class="pull-right pd-10 submenu-toggle" date-toggle="submenu" onclick="asd(this,event)"> <span class="pd-5 f-22 glyphicon glyphicon-option-vertical"></span> <div class="submenu-close submenu submenu-rt col-xs-5 col-sm-4 col-md-3"> <div><span class="glyphicon glyphicon-trash"></span> View More</div> <div>Option 1</div> <div>Option 1</div> </div> </div> </div> <div class="col-xs-9 col-sm-9 col-md-10 pd-0"> </div> <div class="col-xs-12 col-sm-12 col-md-12"> <p class="f-18 md-top-20"> '+resp.comment+' </p> </div> <div class="col-xs-12 col-sm-12 col-md-12 pd-10 f-22"> <div class="pull-left pd-10"> <span class="glyphicon glyphicon-share-alt"></span> </div> <div class="pull-right pd-10"> <span class="pointer" onclick="vote(&apos;'+resp.id+'&apos;,false)"> <span class="glyphicon glyphicon-download"></span> </span> &nbsp;&nbsp;&nbsp; <span class="pointer" onclick="vote(&apos;'+resp.id+'&apos;,true)"> <span class="cl-blue glyphicon glyphicon-upload"></span> <span class="f-18">239</span> </span> </div> </div> </div>';
      });
      $('#allComments').html(htm);
    });
    //console.log(x);
  }
  
  
  
  function bringComments(post,call){
    $.ajax({
        type:'POST',
        url:"./requests/profile.php",
        data:{
          post:post,
          getComments:true
        },
        success:function(data){
          call(data);
        }
      })
  }
  
  function get_votes(){
    //brings votes
    $.ajax({
      type:'POST',
      url:"./requests/topic.php",
      data:{
        'getLikes':true
      },
      success:function(data){
        //var resp=JSON.parse(data);
        localStorage.setItem("myLikes", JSON.stringify(data));
      }
    });
  }
  


function auto_grow(element) {
  element.style.height = "5px";
  element.style.height = (element.scrollHeight)+"px";
}