<?php if (isset($_GET['action'])) {
    $id = $_GET['id'];
    if (isset($_POST['save_feed'])) {
        $feed = $_POST['feed'];
        if (!empty($_FILES['file']['name'])) {
            $new_img = date("U");
            $file = $_FILES['file']['name'];
            $typ = explode(".", $file);
            $img = $new_img . "." . $typ[count($typ) - 1];

            copy($_FILES['file']['tmp_name'], "../image/$img");
            chmod("../image/$img", 0777);
        } else {
            $img = $_POST['old_img'];
        }
        query_sql($con, "update feed_db set feed_dct='$feed',feed_img='$img' where feed_id='$id'");
        header('location:home.php');
    }
    if (isset($_POST['save_comment'])) {
        $comment = $_POST['comment'];
        query_sql($con, "update comment_db set comment_dct='$comment' where comment_id='$id'");
        header('location:home.php');
    }
    if ($_GET['action'] == "feed") {
        $row = query_row($con, "select * from feed_db where feed_id='$id'");
?>
        <form method="post" enctype="multipart/form-data">
            <hr>
            <h3 align="center"><b>แก้ไขฟีด</b></h3>
            <hr>
            <input type="text" name="feed" class="form-control" value="<?php echo $row['feed_dct']; ?>">
            <hr>
            <h3 align="center"><b>แก้ไขรูปภาพ</b></h3>
            <hr>
            <input type="hidden" name="old_img" value="<?php echo $row['feed_img']; ?>">
            <input type="file" name="file" class="form-control">
            <br>
            <input type="submit" value="แก้ไข" name="save_feed" class="btn btn-danger btn-block form-control">
        </form>
    <?php } else if ($_GET['action'] == "comment") {
        $row = query_row($con, "select * from comment_db where comment_id='$id'");
    ?>
        <form method="post">
            <hr>
            <h3 align="center"><b>แก้ไขความคิดเห็น</b></h3>
            <hr>
            <input type="text" name="comment" class="form-control" value="<?php echo $row['comment_dct']; ?>">
            <br>
            <input type="submit" value="แก้ไข" name="save_comment" class="btn btn-danger btn-block form-control">
        </form>
<?php  }
}
?>

