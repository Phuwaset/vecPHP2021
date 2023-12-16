<hr>
<center>
    <h3><b>เพื่อนของเรา</b></h3>
</center>
<hr>
<form action="" method="post">
    <div class="row" style="margin-left: 15%;">
        <div class="col-sm-9"><input type="text" name="search" class="form-control" placeholder="ค้นหา"></div>
        <div class="col-sm-3"><input type="submit" name="btn_search" class="btn btn-primary" value="ค้นหา"></div>
    </div>
</form>
<hr>
<?php
$id = $_SESSION['ID'];
if (isset($_GET['id']) and isset($_GET['action'])) {
    $f = $_GET['id'];
    if ($_GET['action'] == "add") {
        query_sql($con, "insert into friend_db (friend_me,friend_friend,friend_status)values('$id','$f','0')");
    } else if ($_GET['action'] == "cancle") {
        query_sql($con, "delete from friend_db where friend_me = '$id' and friend_friend = '$f'");
    } else if ($_GET['action'] == "delfriend") {
        query_sql($con, "delete from friend_db where friend_me = '$id' and friend_friend = '$f'");
        query_sql($con, "delete from friend_db where friend_me = '$f' and friend_friend = '$id'");
    } else if ($_GET['user_time']){
        query_sql($con,"update user_db set user_time = ''");
    }
}
?>

<table class="table table-bordered">
    <tr>
        <td width="20%"></td>
        <td width="60%"></td>
        <td width="10%"></td>
        <td width="10%"></td>
    </tr>

    <?php
    if (isset($_POST['btn_search'])) {
        $key = $_POST['search'];
        $result = query_sql($con, "select * from user_db where (user_id !='$id' and user_status !='9')and user_fname like '%$key%'");
    } else {
        $result = query_sql($con, "select * from user_db where user_id !='$id' and user_status !='9'");
    }
    while ($row = mysqli_fetch_array($result)) {
    ?>
        <td align="center">
            <?php
            if (empty($row['user_img'])) {
                $img = "login4.png";
            } else {
                $img = $row['user_img'];
            }
            ?>
            <center>
                <div style="height:80px;width:80px;border-radius:100%;
                background-image:url('../image/<?php echo $img; ?>');
                background-size:cover;background-position:center;"></div>
            </center>
        </td>
        <td><?php echo $row['user_fname'] . ' ' . $row['user_lname']; ?><br>
        </td>

        <?php
        $friend = $row['user_id'];
        $row2 = query_row($con, "select * from friend_db where friend_me = '$id' and friend_friend = '$friend'");
        if (isset($row2)) {
            if ($row2['friend_status'] == "0") {
                $status = 2;
            } else {
                $status = 3;
            }
        } else {
            $status = 1;
        }
        if ($status == 1) { ?>
            <td colspan="2" align="center"><a href="?page=friend&id=<?php echo $friend; ?>&action=add" class="btn btn-success">เพิ่มเพื่อน</a>
        
            </td>
        <?php } else if ($status == "2") { ?>
            <td><a href="#" class="btn btn-secondary">ส่งคำขอ</a></td>
            <td><a href="?page=friend&id=<?php echo $friend; ?>&action=cancle" class="btn btn-danger">ยกเลิกคำขอ</a></td>
        <?php } else if ($status == "3") { ?>
            <td><a href="#" class="btn btn-primary">เพื่อน</a></td>
            <td><a href="?page=friend&id=<?php echo $friend; ?>&action=delfriend" class="btn btn-danger">ยกเลิกเพื่อน</a></td>
        <?php } ?>
        </tr>
    <?php } ?>

</table>