<?php

class Group{
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
            return $d->error;//
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

    function save_group($u,$gname,$cat,$des,$time,$icontype){
        $prom=$this->str_rand();
        $sql="INSERT INTO `groups`(`keyUnique`, `prom`, `gname`, `category`,`iconType`, `description`, `timestamp`) VALUES ('$u','$prom','$gname','$cat','$icontype','$des',$time)";
        return $this->insert('a',$sql);
    }

    function pop_groups(){
        $sql="SELECT `keyUnique`, `gname`, `category`, `iconType`,`description`, `timestamp` FROM `groups` WHERE `state`!=1 ";
        return $this->select('a',$sql);
    }

    function group_info($group){
        $sql="SELECT groups.gname,iconType,groups.description FROM groups WHERE groups.keyUnique='$group'";
        return $this->select('a',$sql)[0];
    }

    function my_groups($user){
        $sql="SELECT members.group,groups.keyUnique,gname,prom,category,iconType FROM members INNER JOIN groups ON members.group=groups.keyUnique WHERE members.user='$user'";
        //return $sql;
        return $this->select('a',$sql);
    }

    function update_icontType($temp,$group){
        $sql="UPDATE groups SET iconType='$temp' WHERE groups.keyUnique='$group'";
        return $this->update('a',$sql);
    }

    function check_mem($user,$group){
        $sql="SELECT `id` FROM `members` WHERE members.group='$group' AND members.user='$user'";
        return $this->check('a',$sql);
    }

    function new_mem($user,$group,$time,$rank){
        $u=$this->str_rand();
        $sql="INSERT INTO `members`(`keyUnique`, `group`, `user`,`rank`, `timestamp`) VALUES ('$u','$group','$user',$rank,$time)";
        //return $sql;
        return $this->insert('a',$sql);
    }

    function rm_mems($rm){
        $sql="SELECT members.`user`, `rank`,users.username,users.imguri FROM `members` INNER JOIN users ON members.user=users.keyUnique WHERE members.group='$rm' AND members.banned=0 ORDER BY members.rank DESC";
        //return $sql;
        return $this->select('a',$sql); 
    }

    function check_owner($gp,$user){
        $sql="SELECT members.user FROM members WHERE members.group='$gp' AND members.user='$user' AND members.rank=1";
        //return $sql;
        return $this->check('a',$sql);
    }

    function update_gname($group,$egn){
        $sql="UPDATE groups SET gname='$egn' WHERE groups.keyUnique='$group'";
        return $this->update('a',$sql);
    }

    function appUpload($file,$s,$disttype,$imgName){
        if (!is_dir($disttype)) {
            mkdir($disttype, 0777, true);
        }

        $temp = pathinfo($file, PATHINFO_EXTENSION);
        $type= $this->set_type($temp);
        $newfilename=$imgName.".".$temp;
        $target=basename($newfilename);

        $tmp_name = $_FILES[$s]['tmp_name'];
        $resp=array(
            'status' => false,
            'upload' => false,
            'file'=>'no',
            'type'=>$disttype,
            'filetype'=>$temp
        );
        
        $final=$disttype.$target;

        if(move_uploaded_file($tmp_name,$final)){
            $resp['status']=true;
            $resp['upload']=true;
            $resp['file']=$target;
            $resp['final']=$final;
            
            //$this->convertImage($target, $final,80);
            $this->resizer($target, $final,$imgName,200,200);
            
            //list($width, $height) = getimagesize($final); 
            //$tn = imagecreatetruecolor($width, $height);

          //$tn = imagecreatetruecolor($width, $height);
            //$resp['compress_images'] = $this->resizer($target, $final,4);
        }else{

        }
        return $resp;
    }

    function asdasdappUpload($file,$s,$disttype,$imgName){
        if (!is_dir($disttype)) {
            mkdir($disttype, 0777, true);
        }

        $temp = pathinfo($file, PATHINFO_EXTENSION);
        $type= $this->set_type($temp);
        $newfilename=$imgName.".".$temp;
        $target=basename($newfilename);

        $tmp_name = $_FILES[$s]['tmp_name'];
        $resp=array(
            'status' => false,
            'upload' => false,
            'file'=>'no',
            'type'=>$disttype,
            'filetype'=>$temp
        );

        
        
        $final=$disttype.$target;


        if(move_uploaded_file($tmp_name,$final)){
            $image = imagecreatefromgif($final);
            $thumb = imagecreatetruecolor($newwidth, $newheight);
            //$source = imagecreatefromjpeg($image);

            // Resize
            imagecopyresized($thumb, $image, 0, 0, 0, 0, $newwidth, $newheight, $ow, $oh);
            imagejpeg($thumb, $destination);
            $resp['status']=true;
            $resp['upload']=true;
            $resp['file']=$target;
            $resp['final']=$final;
            
            //$this->convertImage($target, $final,80);
            $this->resizer($target, $final,$imgName,200,200);
            
            //list($width, $height) = getimagesize($final); 
            //$tn = imagecreatetruecolor($width, $height);

          //$tn = imagecreatetruecolor($width, $height);
            //$resp['compress_images'] = $this->resizer($target, $final,4);
        }else{

        }
        return $resp;
    }
    

    function resizer_appUpload($file,$s,$disttype,$imgName,$newW,$newH){
        if (!is_dir($disttype)) {
            mkdir($disttype, 0777, true);
        }

        $temp = pathinfo($file, PATHINFO_EXTENSION);
        $type= $this->set_type($temp);
        $newfilename=$imgName.".".$temp;
        $target=basename($newfilename);

        $tmp_name = $_FILES[$s]['tmp_name'];
        $resp=array(
            'status' => false,
            'upload' => false,
            'file'=>'no',
            'type'=>$disttype,
            'filetype'=>$temp
        );
        
        $final=$disttype.$target;

        if(move_uploaded_file($tmp_name,$final)){
            $resp['status']=true;
            $resp['upload']=true;
            $resp['file']=$target;
            $resp['final']=$final;
            //$this->convertImage($target, $final,80);
            $resp['final']=$this->resizer($target, $final,$imgName,$newW,$newH);
            
            //list($width, $height) = getimagesize($final); 
            //$tn = imagecreatetruecolor($width, $height);

          //$tn = imagecreatetruecolor($width, $height);
            //$resp['compress_images'] = $this->resizer($target, $final,4);
        }else{

        }
        return $resp;
    }


    function resizer($source, $destination,$imgName, $newwidth,$newheight) {

        $info = getimagesize($destination);
        $ow = $info[0];
        $oh = $info[1];
        if ($info['mime'] == 'image/jpeg') 
            $image = imagecreatefromjpeg($destination);
    
        elseif ($info['mime'] == 'image/gif') 
            $image = imagecreatefromgif($destination);
    
        elseif ($info['mime'] == 'image/png') 
            $image = imagecreatefrompng($destination);
    
        //imagejpeg($image, $destination, $quality);
        //imagescale( $image , 100 , 100 );
        

        // Load
            $thumb = imagecreatetruecolor($newwidth, $newheight);
            //$source = imagecreatefromjpeg($image);

            // Resize
            imagecopyresized($thumb, $image, 0, 0, 0, 0, $newwidth, $newheight, $ow, $oh);
            return imagejpeg($thumb, $destination,99);

    
            return $destination;
    }

    function set_type($temp){
        if ($temp == "jpg" || $temp == "png" || $temp == "jpeg"
        || $temp == "gif" || $temp == "JPG" || $temp == "JPEG") {
            $t= 'image';
        }elseif($temp == "mp4" || $temp == "ogv" || $temp == "wmv" || $temp == "avi") {
            $t= 'video';
        }else{
            $t= 'inval';
        }

        return $t;
    }



}
?>