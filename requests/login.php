<?php
session_start();

include('core/login.class.php');
$log= new Login();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $obj=json_decode(file_get_contents("php://input"), true);
    $results = (array) $obj;
    
    if(isset($results['name'])){
        $x=$log->google_log($results['name'],$results['email'],$results['pic'],$results['time']);
        if($x['state']==1){
            $_SESSION['userId']=$x['memId'];
            $_SESSION['user']=$x['memId'];
            $_SESSION['user']=$x['memId'];
        }else{}

        echo json_encode($x);
    }elseif(isset($_POST['username'])){
        $x=$log->check_username($_POST['username']);
        $resp=array();
        if($x==1){
            $resp['av']=false;
            $resp['state']=false;
        }else{
            $resp['av']=!false;
            $resp['state']=!false;
        }
        echo json_encode($resp);
    }else if(isset($_POST['save'])){
        $x=$log->save_user($_POST['name'],$_POST['email'],$_POST['pice'],$_POST['unm'],$_POST['pass'],$_POST['time']);
        if($x['state']==1){
            $_SESSION['userId']=$x['memId'];
            $_SESSION['user']=$x['memId'];
            $_SESSION['user']=$x['memId'];
        }else{}

        
        echo json_encode($x);
    }
        
}
?>