<?php 
    ob_start();
    session_start();
    $server = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'php2022';
    $con = mysqli_connect($server,$username,$password,$database);
    //if($con){echo 'connect';}
    mysqli_query($con,'set names utf8');

    function query_sql($con,$sql){
        $result = mysqli_query($con,$sql)or die(mysqli_error($con));
        return $result;
    }
    function query_row($con,$sql){
        $result = mysqli_query($con,$sql)or die(mysqli_error($con));
        $row =  mysqli_fetch_array($result);
        return $row;
    }
    function sex($id){
        if($id == '1'){
            return 'ผู้ชาย';
        }elseif($id == '2'){
            return 'ผู้หญิง';
        }else{
            return 'ไม่ระบุเพศ';
        }
    }
    function status($id){
        if($id == '1'){
            return 'ผู้ใช้งานระบบ';
        }elseif($id == '9'){
            return 'ผู้ดูแลระบบ';
        }else{
            return 'ไม่มีข้อมูลในระบบ';
        }
    }
    function datediff($str){
        $d = strtotime($str);
        $now = strtotime(date("Y-m-d H:i:s"));
        
        $day = ($now - $d) / (60*60*24);
        $hour = ($now - $d) / (60*60);
        $min = ($now - $d) / 60;
        
        
        if($hour > 24 ){
            return date("D d M  Y ",$d )."( ".round($day)." day ago )";
        }else if($min > 59 ){
            return date("D d M Y ",$d)."( ".round($hour)." hour ago )";
        }else{
            return date("D d M Y ",$d)."( ".round($min)." min ago )";
        }
    }
?>