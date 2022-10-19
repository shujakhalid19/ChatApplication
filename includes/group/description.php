
<?php
    if(!isset($_POST['name'])){

    }else{

    
?>
<!-- <img src="<?=$_POST['im'];?>" style="width:50%; height:240px;object-fit:cover;position:absolute;margin:0px;z-index:+8888;left:0;
right:0;
margin-left:auto;
margin-right:auto;" />
<img src="<?=$_POST['im'];?>" style="width:100%; height:240px;border:2px solid #b2bb;object-fit:cover;filter:blur(10px);" /> -->

<img src="<?=$_POST['im'];?>" style="width:100%; height:140px;border:2px solid #404040;object-fit:cover;;" />


                <div class="col-xs-12 col-sm-4 col-md-12 md-top-20 pd-10">
                    
                    <h4 class="b"><?=$_POST['name'];?>
                    <span class="indicator f-22 pull-right"><i class="fa fa-spin fa-spinner"></i></span>
                    <!-- <button id="join_gc" data-key="<?=$_POST['key'];?>" class="pull-right btn btn-md btn-primary">Join</button> -->
                    </h4>
                    <span style="color:#a5a9b4">#<?=$_POST['category'];?></span>
                    
                    <p><br/><?=$_POST['description'];?></p>
                    
                    
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 pd-10">
                  <h5 style="color:#a5a9b4">Members</h5>
                  <div id="members" class="pd-0"></div>
                </div>


    <div id="myEdit" class="modal fade in" role="dialog">
      <div class="modal-dialog modal-md" style="z-index:+99999;">
    
        <!-- Modal content-->
        <div class="modal-content" style="background-color:#202020;color:#fff;border-color:#000;z-index:+99999;">
          <div class="modal-header" style="border-color:#000;">
            <button type="button" class="close" data-dismiss="modal">×</button>
            <h3 class="modal-title">Edit Group</h3>
          </div>
          <div class="modal-body">
            <form id="editgc" method="POST">
              <div class="form-group">
                <label>Group Name</label>
                <div class="msg hide md-btm-10"></div>
                <input id="egn" name="egn" type="text" class="form-control bg-input" placeholder="eg: john23doe"  style="height: 40px;" autocomplete="off" required />
                
              </div>
              <div class="form-group">
                <label>Description</label>
                <div class="msg hide md-btm-10"></div>
                <textarea id="egd" name='egd' class=" bg-input form-control" oninput="auto_grow(this)"></textarea>
                
            </div>
            </form>
          </div>
          <div class="modal-footer" style="border-color:#000;">
            <button id="edSub" type="submit" disabled  form="editgc" class="btn btn-success">Save</button>
            <span type="button" class="btn cl-blue" data-dismiss="modal">Cancel</span>
          </div>
        </div>
    
      </div>
    </div> 
    
    <script>
      
      var room='<?=$_POST['key'];?>';
      var cls='<?=$_POST['md'];?>';
      var gname='<?=$_POST['name'];?>';
      var gdes='<?=$_POST['description'];?>';
      
        $(function(){
            //room members
            $("#egn").val(gname);
            $("#egd").val(gdes);

            $("#egn").on('keyup',function(e){
              if(this.value!==gname && this.value!==(gname+" ") && this.value!=="" && this.value!==" "){
                console.warn(this.value)
                $('#edSub').attr("disabled", false);
              }else{
                $('#edSub').attr("disabled", true);
              }
            })

            $("#egd").on('keyup',function(e){
              if(this.value!==gdes && this.value!==(gdes+" ") && this.value!=="" && this.value!==" "){
                $('#edSub').attr("disabled", false);
              }else{
                $('#edSub').attr("disabled", true);
              }
            })

            $(document).on('click','.mod',function(e){
              $('.popover').popover('hide');

              $("#myEdit").modal('show');
            });

            $(document).on('click','.del',function(e){
              $('.popover').popover('hide');
              $("#myDelete").modal('show');
            });

            $.ajax({type:"POST",url:'requests/groups.php',data:{'mem':true,'room':room},
              success:function(data){
                resp=JSON.parse(data);
                let leavebtn;
                if(resp.admin){
                  console.warn(resp);
                    //show edit btn
                  //leavebtn='<button id="edit_gc" data-toggle="modal" data-target="#myEdit" class="btn btn-md btn-primary">Edit</button>&nbsp;&nbsp;&nbsp;&nbsp;<button id="leave_gc" class="btn btn-md btn-silent">Joined</button>';
                  leavebtn='<a href="page.php?g='+room+'"><span class="f-18" ><i class="fa fa-cog"></i></span></a>&nbsp;&nbsp;&nbsp;&nbsp;<button id="leave_gc" class="btn btn-md btn-silent">Joined</button>';
                }else{
                  leavebtn='<button id="leave_gc" class="btn btn-md btn-silent">Joined</button>';
                }
                //console.warn(resp);
                if(resp.state){
                  let h='';
                  var j=false;
                  if(resp.results){
                    $.each(resp.results,function(key,index){
                      if(resp.user==index.user) j=true;
                      h+='<div id="users" data-toggle="modal" data-target="#myDelete" data-order="iefnai" class="text-center pointer col-xs-3 col-sm-12 col-md-'+cls+' pd-0 md-top-20"> <img src="'+index.imguri+'" class="prof-img" style="width: 70px;height: 70px;"> <div>'+index.username+'</div> </div>';
                    });
                  }
                    

                  (j)? $(".indicator").html(leavebtn) : $(".indicator").html('<button id="join_gc" data-key="'+room+'" class="pull-right btn btn-md btn-primary">Join</button>');

                  $('#members').append(h);
                }else if(!resp.result){
                  $(".indicator").html('<button id="join_gc" data-key="'+room+'" class="pull-right btn btn-md btn-primary">Join</button>');
                }
              }
            });


        })

        
      </script>
                <?php
    }
                ?>


