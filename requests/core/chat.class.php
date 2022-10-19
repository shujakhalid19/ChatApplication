<?php

class Chat{
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

    function clean_encode($string) {
        $string=base64_encode($string);
        $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
        #.replace(/[^\w\s]/gi, '')
        return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
    }

    function check($data,$sql){
        $d=$this->conn;
        $res=$d->query($sql);
        if($res->num_rows>0){
            return 1;
        }else{
            return 0;
        }
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

    function insert($data,$sql){
        $d=$this->conn;
        if($res=$d->query($sql)){ //inserted
            return 1;//$d->insert_id
        }else{
            return $d->error;//$d->error
        }
    }

     function update($data,$sql){
        $d=$this->conn;
        if($res=$d->query($sql)){ //inserted
            return 1;
        }else{
            return 0;//$d->error
        }
    }


      function select($data,$sql){
        $d=$this->conn;
        $res=$d->query($sql);
        if($res->num_rows>0){

            while($row=$res->fetch_assoc()){
                $arr[]=$row;
            }
            
            return $arr;

        }else{
            return 0;//$d->error
        }
    }

    function secure_select($data,$sql,$datatype){
        $db=$this->conn;
        $stmt=$db->prepare($sql);
        if($data!=0 && $datatype!='u'){
            $stmt->bind_param($datatype, $data);
        }
        $stmt->execute();

        $res=$stmt->get_result();
        $arr=array();
        while($row=$res->fetch_assoc())
        {
            $arr[]=$row;
        }

        return $arr;
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

    function check_username($user,$username){
        $sql="SELECT `state` FROM users WHERE username='$username' AND keyUnique!='$user'";
        return $this->check($username,$sql);
    }


    function search_app($q){
        $sql="SELECT * FROM users WHERE username LIKE '$q%' LIMIT 4";
        //return $sql;
        return $this->select('a',$sql);
    }

    function myList($u1){
        //$sql="SELECT chats.keyUnique,users.name,email,imguri FROM chats INNER JOIN users ON chats.user2=users.keyUnique  WHERE user1='$u1' OR user2='$u1'";
        $frn='';
        $sql="SELECT chats.keyUnique,user1,user2 FROM chats  WHERE user1='$u1' OR user2='$u1' ORDER BY chats.timestamp DESC";
        $res=$this->select('a',$sql);
        if($res!==0){
            
        
            foreach($res as $x){
                if($x['user1']==$u1){
                    $frn=$x['user2'];
                }else{
                    $frn=$x['user1'];
                }
                $sql="SELECT `id`, `keyUnique`, `name`, `email`, `imguri`, `timestamp`, `state` FROM `users` WHERE keyUnique='$frn'";
                $y[]=$this->select('a',$sql)[0];
                $p[]=$x['keyUnique'];

            }
            $resp=array(
            'prom'=>$p,
            'result'=>$y
        );
        
        }else{
            $resp=array(
            'prom'=>false,
            'result'=>false
            );
        }
        return $resp;

    }
    
    function update_list($prom,$t){
        $sql="UPDATE `chats` SET `timestamp`=$t WHERE keyUnique='$prom'";
        return $this->update('a',$sql);
    }

    function check_friend($u1,$u2){
        $sql="SELECT chats.keyUnique,users.name,email,imguri FROM chats INNER JOIN users ON chats.user1=users.keyUnique  WHERE (user1='$u1' AND user2='$u2') OR (user1='$u2' AND user2='$u1')";
        return $this->select('a',$sql);
    }
    
    function about_me($user){
        $sql="SELECT `name`,`username`, `email`, `imguri` FROM `users` WHERE keyUnique='$user'";
        return $this->select('a',$sql);
    }

    function profile_update_one($user,$new_name,$new_uname){
        //updated name and username
        $sql="UPDATE `users` SET `name`='$new_name',`username`='$new_uname' WHERE keyUnique='$user'";
        return $this->update('a',$sql);
    }

    function add_to_chat($u1,$u2,$t){
        $resp=array();
        $sql="SELECT * FROM chats WHERE (user1='$u1' AND user2='$u2') OR (user1='$u2' AND user2='$u1')";
        $check=$this->auth('asd',$sql);
        if ($check==0) {
            $id=$this->str_rand();
            $sql="INSERT INTO `chats`(`keyUnique`, `user1`, `user2`, `timestamp`) VALUES ('$id','$u1','$u2',$t)";
            $x=$this->insert('a',$sql);
            if($x!==0){
                $resp['state']=1;
                $resp['added']=true;
                $resp['err']=false;
                $resp['promise']=$id;
            }else{
                $resp['state']=0;
                $resp['added']=false;
                $resp['err']=true;
            }
        }else{
            $resp['state']=1;
            $resp['added']=false;
            $resp['err']=false;
            $resp['promise']=$check;

        }

        return $resp;
    }
    
     function appUpload($file,$s,$disttype,$key){
        if (!is_dir($disttype)) {
            mkdir($disttype, 0777, true);
        }

        $temp = pathinfo($file, PATHINFO_EXTENSION);
        //return $temp;
        $type= $this->set_type($temp);

        $newfilename=uniqid().".".$temp;
        $target=basename($newfilename);

        $tmp_name = $_FILES[$s]['tmp_name'];
        $resp=array(
            'status' => false,
            'upload' => false,
            'key' =>'',
            'file'=>'no',
            'type'=>$disttype
        );

        $final=$disttype.$target;

        if(move_uploaded_file($tmp_name,$final)){
            $resp['status']=true;
            $resp['upload']=true;
            $resp['key']=$key;
            $resp['file']=$newfilename;
        }else{

        }
        return $resp;
}



    function simple_upload($file,$s,$direct){
       //error_reporting(0);
        //return "err";
        if (!is_dir($direct)) {
            mkdir($direct, 0777, true);
        }
        $target_dir=$direct."/";
        $target_file = $target_dir . basename($file);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image

        //$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        $check = getimagesize($_FILES[$s]["tmp_name"]);
        if($check !== false) {
          //return "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
    //        return "File is not an image.";
            return 34;
            $uploadOk = 0;
        }
        if ($_FILES[$s]["size"] > 5000000) {
           //return "Sorry, your file is too large.";
            return 92;
            $uploadOk = 0;
        }
        // Check if file already exists
        if (file_exists($target_file)) {
   //        return "Sorry, file already exists.";
            $img=basename( $_FILES[$s]["name"]);
            return $img;
            $uploadOk = 0;
        }
        // Check file size

        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" && $imageFileType != "JPG" && $imageFileType != "JPEG" ) {
           //return "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            return 88;
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {

           //return "Sorry, your file was not uploaded.";
            return 0;
        // if everything is ok, try to upload file
        } else {
            if(move_uploaded_file($_FILES[$s]["tmp_name"], $target_file)){
                //return "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
                $img=basename($_FILES[$s]["name"]);
                return $img;
            }else{
                return 0;
            }
        }
    }

    function set_type($temp){
        if ($temp == "jpg" || $temp == "png" || $temp == "jpeg"
        || $temp == "gif" || $temp == "JPG" || $temp == "JPEG") {
            $t= 'image';
        }elseif($temp == "mp4" || $temp == "ogv" || $temp == "wmv" || $temp == "avi") {
            $t= 'video';
        }elseif($temp == "mp3" || $temp == "ogg" || $temp == "wav") {
            $t= 'audio';
        }else{
            $t= 'inval';
        }

        return $t;
    }


    function cleanSpecialCharacters($string) {
        $string = str_replace(' ', '_', $string); // Replaces all spaces with _.
        return preg_replace('/[^A-Za-z0-9.\-_]/', "", $string); // Removes special chars.
    }

}

//$reg= new Register();
//$reg -> check();
?>