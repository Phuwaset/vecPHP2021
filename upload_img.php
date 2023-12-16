<?php
include("asset/connect.php");
if (isset($_POST['up_img'])) {
    if (empty($_FILES['file']['name'])) {
        echo "<script>alert('กรุณาลงรูปภาพ')</script>";
    } else {
        $new_img = date("U");
        $file = $_FILES['file']['name'];
        $typ = explode(".", $file);
        $img = $new_img . "." . $typ[count($typ) - 1];

        copy($_FILES['file']['tmp_name'], "image/$img");
        chmod("image/$img", 0777);
        $id = $_GET['id'];
        query_sql($con, "update user_db set user_img = '$img' where user_id = '$id' ");
        
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
                <form action="" class="mt-5 border p-4 bg-light shadow" enctype="multipart/form-data" style="border-radius: 20px;" method="post">
                <center><img src="image/login4.png" width="70%" style="border-radius: 20px;" id="previewImg" alt=""><hr></center>
                <div class="row">

                    <div class="mb-3 col-md-12">
                        <label for="">อัพโหลดรูปภาพประจำตัว <span style="color:red;">*</span></label>
                        <input type="file" name="file" class="form-control" id="inputImg">
                    </div>
                    <div class="mb-3 col-md-12">
                     
                        <input type="submit" name="up_img" class="btn btn-primary form-control" value="อัพโหลดรูปภาพ">
                    </div>
                </div>
            </form>
            </div>
            </div>
        </div>
    </div>
    <script>
        let inputImg = document.getElementById('inputImg');
        let previewImg = document.getElementById('previewImg');
        inputImg.onchange = evt => {
            const [file] = inputImg.files;
            if (file) {
                previewImg.src = URL.createObjectURL(file);
            }
        }
    </script>
<script src="js/bootstrap.min.js"></script>

</body>
</html>