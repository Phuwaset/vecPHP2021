<?php 
    $id = $_SESSION['ID'];
    if(isset($_POST['update_rs'])){
        if($_POST['pw'] == $_POST['repw']){
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $bd = $_POST['bd'];
            $sex = $_POST['sex'];
            $pw = $_POST['pw'];
            query_sql($con,"update user_db set user_fname = '$fname' , user_lname = '$lname' , user_bd = '$bd' , user_sex = '$sex' , 
            user_password = '$pw' where user_id = '$id'");
            header('refresh:0');
        }else{
            echo "<script>alert('เเก้ไขข้อมูลไม่สำเร็จ หรือ รหัสผ่านไม่ตรงกัน')</script>";
        }
    }
    if(isset($_POST['update_img'])){
        if(empty($_FILES['file']['name'])){
            echo "<script>alert('กรุณาอัพโหลดรูปภาพ!')</script>";
        }else{
            $new_img = date("U");
            $file = $_FILES['file']['name'];
            $typ = explode(".",$file);
            $img = $new_img.".".$typ[count($typ)-1];

            copy($_FILES['file']['tmp_name'],"../image/$img");
            chmod("../image/$img",0777);

            query_sql($con,"update user_db set user_img = '$img' where user_id = '$id' ");
            header('refresh:0');
        }
    }
?>

<div class="container">
    <div class="row">
        <div class="col"></div>
        <div class="col">
            <div style="height: 5vh;"></div>
            <center><h3><b>เเก้ไขข้อมูลส่วนตัว</b></h3><hr></center>
            <form action="" enctype="multipart/form-data" method="post">
                <label for="">ชื่อ</label>
                <input type="text" name="fname" class="form-control" value="<?php echo $row['user_fname'];?>">
                <label for="">นามสกุล</label>
                <input type="text" name="lname" class="form-control" value="<?php echo $row['user_lname'];?>">
                <label for="">วันเกิด</label>
                <input type="date" name="bd" class="form-control" value="<?php echo $row['user_bd'];?>">
                <label for="">เพศ</label>
                    <select name="sex" id="" class="form-control">
                            <option value="0" <?php if($row['user_sex'] == "0"){echo 'selected';} ?>>ไม่ระบุเพศ</option>
                            <option value="1" <?php if($row['user_sex'] == "1"){echo 'selected';} ?>>ชาย</option>
                            <option value="2" <?php if($row['user_sex'] == "2"){echo 'selected';} ?>>หญิง</option>
                        </select>
                <label for="">รหัสผ่าน</label>
                <input type="password" name="pw" class="form-control" value="<?php echo $row['user_password'];?>">
                <label for="">ยืนยันรหัสผ่าน</label>
                <input type="password" name="repw" class="form-control" value="<?php echo $row['user_password'];?>">
                <br>
                <input type="submit" name="update_rs" class="btn btn-primary form-control" value="เเก้ไขข้อมูล">
            </form>
        </div>
        <div class="col"></div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col"></div>
        <div class="col">
            <div style="height:5vh;"></div>
            <center>
                <h3><b>เเก้ไขรูปภาพส่วนตัว</b></h3>
                <hr>
            </center>
            <form action="" enctype="multipart/form-data" method="post">
                <?php
                if (empty($row['user_img'])) {
                    $img = "login4.png";
                } else {
                    $img = $row['user_img'];
                }
                ?>
            </form>
            <center>
                <div style="height:250px;width:250px;border-radius:100%;
                background-image:url('../image/<?php echo $img; ?>');
                background-size:cover;background-position:center;"></div>
            </center>
            <hr>
            <form action="" enctype="multipart/form-data" method="post">
                <label for="">เเก้ไขรูปภาพโปรไฟล์</label>
                <input type="file" name="file" class="form-control">
                <br>
                <input type="submit" name="update_img" class="btn btn-primary form-control" value="เเก้ไขรูปภาพ">
            </form>
        </div>
        <div class="col"></div>
        <div style="height:5vh;"></div>
    </div>
</div>