<hr>
<center>
    <h3><b>ยืนยันคำขอเพื่อน</b></h3>
</center>
<hr>
<?php 
    $id = $_SESSION['ID'];
    if(isset($_GET['id'])and isset($_GET['action'])){
        $f = $_GET['id'];
        if($_GET['action'] == "accept"){
            query_sql($con,"delete from friend_db where friend_me = '$f' and friend_friend = '$id'");
            query_sql($con,"insert into friend_db (friend_me,friend_friend,friend_status)values('$id','$f','1')");
            query_sql($con,"insert into friend_db (friend_me,friend_friend,friend_status)values('$f','$id','1')");
        }else if($_GET['action'] == "cancle"){
            query_sql($con,"delete from friend_db where friend_me = '$f' and friend_friend = '$id'");
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
        $result2 = query_sql($con,"select * from friend_db where friend_friend = '$id' and friend_status = '0'");
        while($row2 = mysqli_fetch_array($result2)){
            $uid = $row2['friend_me'];
            $row = query_row($con,"select * from user_db where user_id = '$uid'");
            $friend = $row['user_id'];
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
        <td><?php echo $row['user_fname'] . ' ' . $row['user_lname']; ?></td>

        <td><a href="?page=addfriend&id=<?php echo $friend; ?>&action=accept" class="btn btn-success">ยืนยันคำขอ</a></td>
        <td><a href="?page=addfriend&id=<?php echo $friend; ?>&action=cancle" class="btn btn-danger">ปฏิเสธคำขอ</a></td>
            </tr>
        <?php } ?>

</table>