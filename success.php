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
                <center><img src="image/like1.PNG" width="70%" style="border-radius: 20px;" id="previewImg" alt=""><hr></center>
                <div class="row">

                    <div class="mb-3 col-md-12">
                        <center><h5><b>อัพโหลดรูปภาพประจำตัวสำเร็จ</b></h5></center>
                        <hr>
                    </div>
                    <div class="mb-3 col-md-12">
                     
                        <a href="index.php" class="btn btn-outline-success form-control">กลับเข้าสู่ผู้ใช้งานระบบ</a>
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