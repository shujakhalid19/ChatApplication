<?php
session_start();

include('core/group.class.php');
$gp= new Group();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    if(isset($_POST['gname'])){
        $u=$gp->str_rand();
        $user=$_SESSION['userId'];
        $gname=$_POST['gname'];
        $cat=$_POST['category'];
        $des=$_POST['description'];
        $time=$_POST['time'];

        $disttype='groups/'.$u.'/'.$gp->clean_encode($gname).'/pfp';
        $final="../uploads/".$disttype.'/';
        

        $file=$_FILES['fileToUploadapp']['name'];
        $s='fileToUploadapp';
        $temp = pathinfo($file, PATHINFO_EXTENSION);
        $type=$gp->set_type($temp);
        if($type=="image"){
            $uploadData=$gp->appUpload($file,$s,$final,'appIcon');
            if($uploadData['status']){
                $x=$gp->save_group($u,$gname,$cat,$des,$time,$uploadData['filetype']);
                if($x==1){
                    $y=$gp->new_mem($user,$u,$time,1);
                    //echo $y;
                    
                    if($y==1){
                        $x=array(
                            'status' => true,
                            'upload' => true,
                            'mem'=>true,
                            'y'=>$y,
                            'file'=>$uploadData['final'],
                        );
                    }else{
                        $x=array(
                            'status' => true,
                            'upload' => true,
                            'mem'=>false,
                            'y'=>$y,
                            'file'=>$uploadData['final'],
                        );
                    }
                        
                }else{
                    $x=array(
                        'status' => !true,
                        'upload' => !true,
                        'msg'=>'Unable to save group'
                    );
                }
            }
        }else{
            $x=array(
                'status' => false,
                'upload' => false,
                'msg'=>'Invalid file format',
                'filetype'=>$type
            );
        }
            

        
        echo json_encode($x);
        
        //echo $x;

    }elseif(isset($_POST['pop'])){
        echo json_encode($gp->pop_groups());
    }elseif(isset($_POST['join'])){
        $resp=array();
        if(isset($_SESSION['userId'])){
            $user=$_SESSION['userId'];
            $time=$_POST['time'];
            $x=$gp->check_mem($user,$_POST['key']);
            //also check if user is banned or not ;not yet added
            
            if($x==1){
                $resp['state']=true;
                $resp['mem']=true;
                $resp['added']=false;

            }elseif($x==0){
                //not a mem of group
                $x=$gp->new_mem($user,$_POST['key'],$time,0);
                //user added if 1
                if($x==1){
                    $resp['state']=true;
                    $resp['mem']=true;
                    $resp['added']=true;
                }else{
                    $resp['state']=true;
                    $resp['mem']=false;
                    $resp['added']=false;
                }
            }
        }else{
            $resp['state']=false;
            $resp['mem']=false;
            $resp['log']=false;
        }

        echo json_encode($resp);
    }elseif(isset($_POST['myGroups'])){
        $resp=array();
        if(isset($_SESSION['userId'])){
            $user=$_SESSION['userId'];
            $x=$gp->my_groups($user);
            if(!empty($x)){
                $resp['state']=true;
                $resp['results']=$x;
            }else{
                $resp['state']=false;
            }
        }else{
            $resp['state']=false;
            $resp['log']=false;
        }
        echo json_encode($resp);
    }elseif(isset($_POST['mem'])){
        $resp=array();
        if(isset($_POST['room'])){
            $rm=$_POST['room'];
            $x=$gp->rm_mems($rm);
            if(!empty($x)){
                if($x[0]['user']==$_SESSION['userId']){
                    $resp['admin']=true;
                }else{
                    $resp['admin']=false;
                }
                
                $resp['state']=true;
                $resp['results']=$x;
                $resp['user']=$_SESSION['userId'];
                $resp['user']=$_SESSION['userId'];
            }else{
                $resp['state']=false;
                $resp['results']=false;
            }
        }else{
            $resp['state']=true;
            $resp['err']=true;
        }
        echo json_encode($resp);
    }else if(isset($_POST['egn'])){
        $newG=$_POST['egn'];
        $group= $_POST['gp'];
        $user=$_SESSION['userId'];
        $resp=array();
        $x=$gp->check_owner($group,$user);
        if($x==1){
            $x=$gp->update_gname($_POST['gp'],$newG);
            if($x==1){
                $resp['state']=true;
                $resp['set']=true;
                $resp['new']=$newG;
            }else{
                $resp['state']=!true;
                $resp['set']=!true;
                $resp['err']='Failed to update';
            }
        }else{
            $resp['state']=!true;
            $resp['set']=!true;
            $resp['err']='Only admins have the authority to update group name';
        }
        echo json_encode($resp);
    }elseif(isset($_POST['changeImage'])){
        $disttype='groups/'.$_POST['room'].'/pfp';
        $final="../uploads/".$disttype.'/';
        $resp=array();
        
        $file=$_FILES['fileToUploadapp']['name'];
        $s='fileToUploadapp';
        $temp = pathinfo($file, PATHINFO_EXTENSION);
        $type=$gp->set_type($temp);
        //echo $type;
        if($type=="image"){
            if (file_exists($final.'/appIcon.'.$_POST['exten'])) {
                $del=unlink($final.'/appIcon.'.$_POST['exten']);
            }else{
                $del=true;
            }
            $uploadData=$gp->appUpload($file,$s,$final,'appIcon');
            if($uploadData['status']==true){
                //update extrension
                
                $x=$gp->update_icontType($temp,$_POST['room']);
                    
                if($x==1){
                    $resp['state']=true;
                    $resp['upload']=true;
                    $resp['file']=$uploadData['file'];
                    $resp['exten']=$temp;
                    $resp['del']=$del;
                }else{
                    $resp['state']=false;
                    $resp['upload']=true;
                    $resp['exten']=$temp;
                }
            }else{
                $resp['state']=false;
                $resp['upload']=false;
                $resp['msg']="File not uploaded";
            }
            
        }else{
            $resp['state']=false;
            $resp['upload']=false;
            $resp['msg']="File must be an image";
        }

        echo json_encode($resp);
        
    }
}
?>