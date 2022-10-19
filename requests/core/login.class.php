<?php

class Login{
    private $server="localhost";
    private $username="root";
    private $pass="";
    private $db="friendlyChat1";
    private $conn;

    function __construct(){
        $server = $this->server;
        $username = $this->username;
        $pass = $this->pass;
        $db = $this->db;
        $this->conn=mysqli_connect($server,$username,$pass,$db);
        
    }
    
    function auth($data,$sql){
        $d=$this->conn;
        $res=$d->query($sql);
        if($res->num_rows>0){
            $row=$res->fetch_assoc();
            return $row['keyUnique'];
        }else{
            return 0;
        }
    }
    
     function check($data,$sql){
        $d=$this->conn;
        $res=$d->query($sql);
        if($res->num_rows>0){
            $row=$res->fetch_assoc();
            return 1;
        }else{
            return 0;
        }
    }

    function insert($data,$sql){
        $d=$this->conn;
        if($res=$d->query($sql)){ //inserted
            //return $d->insert_id;
            return 1;
        }else{
            return $d->error;
        }
    }

    function str_rand(int $length = 15){
        $ascii_codes = range(48, 57) + range(97, 122);
        $codes_lenght = (count($ascii_codes)-1);
        shuffle($ascii_codes);
        $string = '';
        for($i = 1; $i <= $length; $i++){
            $previous_char = $char ?? '';
            $char = chr($ascii_codes[random_int(0, $codes_lenght)]);
            while($char == $previous_char){
                $char = chr($ascii_codes[random_int(0, $codes_lenght)]);
            }
            $string .= $char;
        }
        return $string;
    }

    
    function login($username,$password){
        $sql="SELECT * FROM users WHERE username='$username' AND password='$password'";
        return $this->auth($username,$sql);
    }
    
    function check_username($username){
        $sql="SELECT timestamp FROM users WHERE username='$username'";
        return $this->check($username,$sql);
    }

    function google_log($name,$email,$imageUrl,int $t){
        $resp=array();
        $sql="SELECT * FROM users WHERE email='$email'";
        $check=$this->auth($name,$sql);
        if ($check===0) {
            //registration pending..
            $resp['state']=0;
            $resp['signup']=false;

            
        }else{
            //already registered
            $resp['state']=1;
            $resp['err']=false;
            $resp['signup']=false;
            $resp['mem']=true;
            $resp['memId']=$check;
            $resp['user']=$name;
            $resp['email']=$email;
            $resp['img']=$imageUrl;


        }
        return $resp;
    }
    
    function save_user($name,$email,$pic,$username,$pass,$time){
        $id=$this->str_rand();
        
        $sql="INSERT INTO `users`(`keyUnique`, `name`, `email`, `imguri`,`username`,`pass`,  `timestamp`) VALUES ('$id','$name','$email','$pic','$username','$pass',$time)";
        $x=$this->insert('a',$sql);
        //    $x=1;
        if($x!==0){
            $resp['state']=1;
            $resp['err']=false;
            $resp['signup']=true;
            $resp['mem']=true;
            $resp['memId']=$id;
            $resp['user']=$name;
            $resp['email']=$email;
            $resp['img']=$pic;

            //return 1;
        }else{
            $resp['state']=0;
            $resp['err']=true;
            $resp['signup']=false;

        }
        return $resp;
    }
    
   
    
}

//$reg= new Register();
//$reg -> check();
?>