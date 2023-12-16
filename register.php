<?php
include("asset/connect.php");
if (isset($_POST['rs'])) {
    if (empty($_POST['pw'])) {
        echo "<script>alert('กรุณาลงข้อมูลให้ครบถ้วน')</script>";
    } else if ($_POST['pw'] == $_POST['repw']) {
        $name = $_POST['name'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $bd = $_POST['bd'];
        $sex = $_POST['sex'];
        $em = $_POST['em'];
        $pw = $_POST['pw'];
        query_sql($con, "insert into user_db (user_email,user_password,user_fname,user_lname,user_bd,user_sex,user_status)
            values('$em','$pw','$fname','$lname','$bd','$sex','0')");
        echo "<script>alert('ลงทะเบียนสำเร็จ')</script>";
        $row = query_row($con, "select * from user_db order by user_id desc");
        header('location:upload_img.php?id=' . $row['user_id']);
    } else {
        echo "<script>alert('เเก้ไขข้อมูลไม่สำเร็จหรือรหัสผ่านไม่ตรงกัน')</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>ระบบสื่อสังคมออนไลน์</title>
    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body{
            background: rgb(219, 226, 226);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="sign-up">
            <div class="col-md-6 offset-md-3">
                <form action="" class="mt-5 border p-5 bg-light shadow" enctype="multipart/form-data" style="border-radius: 20px;" method="post">
                <h3 class="mb-5 text-secondary"><b>ลงทะเบียนเข้าใช้งาน</b></h3>
                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label for="">ชื่อ</label>
                        <input type="text" name="fname" class="form-control" placeholder="ชื่อ">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="">นามสกุล</label>
                        <input type="text" name="lname" class="form-control" placeholder="นามสกุล">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="">วันเกิด</label>
                        <input type="date" name="bd" class="form-control">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="">เพศ</label>
                        <select name="sex" id="" class="form-control">
                            <option value="0">ไม่ระบุเพศ</option>
                            <option value="1">ชาย</option>
                            <option value="2">หญิง</option>
                        </select>
                    </div>
                    <div class="mb-3 col-md-12">
                        <label for="">อีเมล</label>
                        <input type="email" name="em" class="form-control" placeholder="ตัวอย่าง @gmail.com">
                    </div>
                    <div class="mb-3 col-md-12">
                        <label for="">รหัสผ่าน</label>
                        <input type="password" name="pw" class="form-control" placeholder="รหัสผ่าน">
                    </div>
                    <div class="mb-3 col-md-12">
                        <label for="">ยืนยันรหัสผ่าน</label>
                        <input type="password" name="repw" class="form-control" placeholder="ยืนยันรหัสผ่าน">
                    </div>
                    <div class="mb-3 col-md-12">
                        <br>
                        <input type="submit" name="rs" class="btn btn-primary form-control" value="ลงทะเบียน">
                    </div>
                </div>
            </form>
            <p class="mt-3 text-secondary text-center"><b>ลงทะเบียนเรียบร้อยเเล้วใช่หรือไม่ , กลับเข้าสู่ผู้ใช้งานระบบ <a href="index.php">คลิก</a></b></p>
            </div>
            </div>
        </div>
    </div>
<script src="js/bootstrap.min.js"></script>
</body>
</html>