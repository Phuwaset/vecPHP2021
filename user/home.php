<?php
include('../asset/connect.php');
if (!isset($_SESSION['ID'])) {
    header('location:../index.php');
}
$id = $_SESSION['ID'];
$row = query_row($con, "select * from user_db where  user_id = '$id'");
$name = $row['user_fname'] . ' ' . $row['user_lname'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <title>ระบบสื่อสังคมออนไลน์</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a href="#" class="navbar-brand"><img src="../image/language.png" width="50px" height="50px" style="border-radius: 100%;background-color:#fff;" alt=""></a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-items">
                        <a href="home.php" class="nav-link active" aria-current="page">หน้าหลัก</a>
                    </li>
                    <li class="nav-items">
                        <a href="?page=friend" class="nav-link active">เพื่อนของเรา</a>
                    </li>
                    <li class="nav-items">
                        <a href="?page=addfriend" class="nav-link active">คำขอเพื่อน</a>
                    </li>
                </ul>
                <a href="?page=edit_profile" class="nav-link active" style="color: #fff;margin-left:-16px;">เเก้ไขข้อมูลส่วนตัว</a>
                <a href="#" class="nav-link active" style="color: #fff;margin-left:-16px;"><b><?php echo 'ยินดีต้อนรับ ' . $name; ?></b></a>
                <a href="?page=logout" class="nav-link active" style="color: #fff;margin-left:-16px;">ออกสู่ระบบ</a>
            </div>
        </div>
    </nav>
    <div class="container">
        <?php
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        } else {
            $page = "home";
        }
        switch ($page) {
            case 'friend':
                include('friend.php');
                break;
            case 'addfriend':
                include('addfriend.php');
                break;
            case 'edit_profile':
                include('edit_profile.php');
                break;
            case 'logout':
                include('logout.php');
                break;
            case 'edit_feed':
                include('edit_feed.php');
                break;
            case 'delete_feed':
                include('delete_feed.php');
                break;
            default:
                include('feed.php');
        }
        ?>
    </div>
    <script src="../js/bootstrap.min.js"></script>
</body>

</html>