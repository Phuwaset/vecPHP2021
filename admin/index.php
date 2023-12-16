<?php
include("../asset/connect.php");
error_reporting(0);
if (isset($_POST['login'])) {
    $em = $_POST['em'];
    $pw = $_POST['pw'];
    $row = query_row($con, "select * from user_db where user_email = '$em' and user_password = '$pw' ");

    if ($row['user_id'] != '') {
        if ($row['user_status'] == '9') {
            $_SESSION['ID'] = $row['user_id'];
            header('location:home.php');
        } else {
            echo "<script>alert('เฉพาะผู้ดูเเลระบบ!')</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <title>ระบบสื่อสังคมออนไลน์</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: rgb(219, 226, 226);
            margin-top: 120px;
        }

        .row {
            background: #fff;
            border-radius: 30px;
            box-shadow: 12px 12px 12px grey;
        }

        .row1 {
            height: 100%;
            background: #b02a37;
            border-radius: 30px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        img {
            background-color: #fff;
            border-radius: 100%;
        }

        span {
            color:#b02a37;
        }
        hr{
            color: #b02a37;
        }

        .btn1 {
            background: #b02a37;;
            border: none;
            outline: none;
            height: 50px;
            width: 100%;
            color: #fff;
            border-radius: 5px;
        }

        .btn1:hover {
            background: #fff;
            border: 1px solid;
            color:#b02a37;
        }
        @media screen and (max-width:990px) {
            body {
                margin-top: 10px;
            }

            img {
                margin-top: 0px;
                margin: 30px;
                width: 200px;
            }
        }
    </style>
</head>

<body>
    <section class="Form my-4 mx-5">
        <div class="container">
            <div class="row g-0">
                <div class="col-lg-5">
                    <div class="row1">
                    <img src="../image/vec_Logo-Big-test.png" width="50%" height="50%" alt="">
                    </div>
                </div>
                <div class="col-lg-7 pt-5 px-5">
                    <center>
                        <h3 class="font-weight-bold py-3"><b><span>ยินดีต้อนรับ </span>ผู้ดูเเลระบบ</b>
                            <hr>
                        </h3>
                        <h5><b>ระบบสื่อสังคมออนไลน์</b></h5><br>
                        <form action="" enctype="multipart/form-data" class="align-self-center" method="post">
                            <div class="form-row">
                                <div class="col-lg-7">
                                    <input type="email" name="em" class="form-control my-3 p-3" placeholder="กรอกอีเมล">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-lg-7">
                                    <input type="password" name="pw" class="form-control my-3 p-3" placeholder="กรอกรหัสผ่าน">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-lg-7">
                                    <button class="btn1 mt-3 mb-5" type="submit" name="login">เข้าสู่ระบบ</button>
                                </div>
                            </div>
                        </form>
                        <p><b>กลับเข้าสู่ผู้ใช้งานระบบ <a href="../index.php">คลิก</a></b></p>
                        <br>
                </div>
            </div>
        </div>
    </section>
    <script src="../js/bootstrap.min.js"></script>
</body>

</html>