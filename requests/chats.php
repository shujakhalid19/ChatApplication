<?php
session_start();

include('core/chat.class.php');
$ch= new Chat();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $obj=json_decode(file_get_contents("php://input"), true);
    $results = (array) $obj;
    $file = file_get_contents('php://input');
    if(isset($_POST['search'])){
        $q=$ch->cleanSpecialCharacters($_POST['search']);
        $t=$_POST['time'];
        if($q==""){
           echo 'asd'.$q;
        }else{
           echo json_encode($ch->search_app($q));
        }
  
     }elseif(isset($_POST['friend'])){
         $u1=$_SESSION['userId'];
         $u2=$_POST['friend'];
         $t=$_POST['time'];

         $x=$ch->add_to_chat($u1,$u2,$t);
         echo json_encode($x);
     }elseif(isset($_POST['chatList'])){
        $u1=$_SESSION['userId'];
        //$u1='4ls68u94tm1pn85';
        echo json_encode($ch->myList($u1));
     }elseif(isset($_POST['friendship'])){
         $u1=$_SESSION['userId'];
         $u2=$_POST['friendship'];
         $x=$ch->check_friend($u1,$u2);
         if($x==""){
            $resp=array(
               'state'=>false,
               'results'=>[]
            );
         }else{
            $resp=array(
               'state'=>true,
               'results'=>$x
            );
         }
         echo json_encode($resp);
     }elseif(isset($results['d'])){
        echo $ch->update_list($results['p'],$results['d']);
    }elseif(isset($_FILES['fileToUpload'])){
        
        //echo $_FILES['fileToUpload']['name'];
                $file=$_FILES['fileToUpload']['name'];
                $k=$ch->str_rand(6);
      
                    $s='fileToUpload';

                    $disttype='users/'.$k.'/'.$_POST['p'].'/media';
                    $final="../uploads/".$disttype.'/';

                    $arrayName = array('ar'=>$disttype);
                  //echo $_POST['hostelId'];
                    //echo json_encode($arrayName);
                    echo json_encode($ch->appUpload($file,$s,$final,$k));
         
            
    }elseif(isset($results['user_det']) && $results['user_det']){
        $user=$_SESSION['userId'];
        $resp=array();
        $x=$ch->about_me($user);
        if($x==""){
            $resp['state']=false;
        }else{
            $resp['state']=true;   
            $resp['result']=$x[0];
        }
        echo json_encode($resp);
    }elseif(isset($_POST['new_name'])){
        $user=$_SESSION['userId'];
        $new_name=$_POST['new_name'];
        $new_uname=$_POST['new_username'];
        $x=$ch->check_username($user,$new_uname);
        $resp=array();
        if($x===1){
            //username taken
            $resp['state']=true;
            $resp['s']=false;
            //'Username already taken';
        }else{
            $y=$ch->profile_update_one($user,$new_name,$new_uname);
            if($y===1){
                $resp['state']=true;
                $resp['s']=true;
                $resp['name']=$new_name;
                $resp['username']=$new_uname;
            }else{
                $resp['state']=false;
                $resp['s']=false;
                //update failed
            }
        }
            
        echo json_encode($resp);
    }elseif(isset($_POST['th'])){
        if($_POST['th']=="dark"){
            $_SESSION['th']='dark';
        }else{
            unset($_SESSION['th']);
        }
        if(isset($_SESSION['th'])){
            echo 'OK';
        }
    }elseif(isset($_FILES['audio_data']['name'])){
        $size = $_FILES['audio_data']['size']; //the size in bytes
        $input = $_FILES['audio_data']['tmp_name']; //temporary name that PHP gave to the uploaded file
        //$output = $_FILES['audio_data']['name'].".wav"; //letting the client control the filename is a rather bad idea
        
            $file=$_FILES['audio_data']['name'].".wav";
            $k=$ch->str_rand(6);
      
            $s='audio_data';

            $disttype='users/'.$k.'/'.$_POST['p'].'/media';
            $final="../uploads/".$disttype.'/';

            $arrayName = array('ar'=>$disttype);
            //echo $_POST['hostelId'];
            //echo $ch->appUpload($file,$s,$final,$k);
            echo json_encode($ch->appUpload($file,$s,$final,$k));

    }
    
    
    
}


?>