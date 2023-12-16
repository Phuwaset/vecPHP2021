<?php
error_reporting(0);
$id = $_GET['id'];
if ($_GET['action'] == "feed") {
    query_sql($con, "delete from feed_db where feed_id='$id'");
} else if ($_GET['action'] == "comment") {
    query_sql($con, "delete from comment_db where comment_id='$id'");
}


if (isset($_POST['save_feed'])) {
    $id = $_SESSION['ID'];
    $feeddct = $_POST['feed_dct'];
    $imgall = "";
    $date = date("Y-m-d H:i:s");




    if (!empty($_FILES['file']['name'])) {
        foreach ($_FILES['file']['tmp_name'] as $key => $val) {
            $img = "";
            $new_img = date("U") . $key;
            $file = $_FILES['file']['name'][$key];
            $typ = explode(".", $file);
            $img = $new_img . "." . $typ[count($typ) - 1];
            move_uploaded_file($_FILES['file']['tmp_name'][$key], "../image/$img");
            chmod("../image/$img", 0777);
            $imgall .= $img . ",";
        }
    }
    query_sql($con, "insert into feed_db (feed_dct,feed_img,feed_date,user_id)values('$feeddct','$imgall','$date','$id')");
}
if (isset($_POST['save_comment'])) {
    $feedid = $_POST['feed_id'];
    $comment = $_POST['comment'];
    $id = $_SESSION['ID'];
    $date = date("Y-m-d H:i:s");
    query_sql($con, "insert into comment_db (comment_dct,comment_date,user_id,feed_id)values('$comment','$date','$id','$feedid')");
}
if (isset($_POST['save_edit_feed'])) {
    $id = $_POST['id'];
    $feed = $_POST['feed'];




    if (!empty($_FILES['file']['name'])) {
        $imgall = '';
        foreach ($_FILES['file']['tmp_name'] as $key => $val) {
            $img = '';
            $new_img = date("U").$key;
            $file = $_FILES['file']['name'][$key];
            $typ = explode(".", $file);
            $img = $new_img . "." . $typ[count($typ) - 1];
            move_uploaded_file($_FILES['file']['tmp_name'][$key], "../image/$img");
            chmod("../image/$img", 0777);
            $imgall .= $img . ",";
        }
    } else {
        $img = $_POST['old_img'];
    }







    query_sql($con, "update feed_db set feed_dct='$feed',feed_img='$imgall' where feed_id='$id'");
    header('location:home.php');
}
if (isset($_POST['save_edit_comment'])) {
    $id = $_POST['id'];
    $comment = $_POST['comment'];
    query_sql($con, "update comment_db set comment_dct='$comment' where comment_id='$id'");
    header('location:home.php');
}

?>
<br>
<div class="row">
    <div class="col-sm-3" align="center">
        <?php
        $id = $_SESSION['ID'];
        $row = query_row($con, "select * from user_db where user_id = '$id'");
        if (empty($row['user_img'])) {
            $img = "login4.png";
        } else {
            $img = $row['user_img'];
        } ?>
        <br>
        <div style="height:150px;width:150px;border-radius:100%;background-image:url('../image/<?php echo $img; ?>');
        background-size:cover;background-position:center"></div>
        <br>
        <h3><b><?php echo $row['user_fname'] . '  ' . $row['user_lname']; ?></b></h3>
        <hr>
        <h3><b>ส่งคำขอเพื่อน</b></h3>.
        <div class="row">
            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Obcaecati reiciendis, sunt voluptatem voluptas, aspernatur ratione, ducimus beatae quisquam vel enim numquam. In molestiae tempora reiciendis iste praesentium fugiat corporis? Labore, praesentium inventore! Ratione rerum obcaecati dignissimos! Dicta laudantium mollitia, debitis, eligendi similique quos voluptatum rerum esse eos error dolorum sequi eum nihil fugit libero voluptatem voluptas accusantium maiores ex aspernatur nemo reprehenderit molestiae. Minus exercitationem facere quo minima est ab aperiam rerum similique a corrupti fugiat temporibus numquam non, eos et eaque molestias sapiente vel magni officiis. Iusto placeat sunt, ab quidem ratione nostrum, veritatis, adipisci neque cumque fugit quos.
        </div>
    </div>
    <div class="col-sm-6">
        <div class="card">
            <div class="card-body">
                <form action="" method="post" enctype="multipart/form-data">
                    <textarea rows="2" placeholder="คุณคิดอะไรอยู่" required class="form-control" name="feed_dct"></textarea>
                    <br>
                    <input type="file" name="file[]" id="" class="form-control" multiple="multiple">
                    <br>
                    <input type="submit" name="save_feed" value="โพสต์" class="btn btn-primary btn-block form-control">
                </form>
            </div>
        </div>
        <br>

        <?php
        $refeed = query_sql($con, "select * from feed_db order by feed_date desc");
        while ($rofeed = mysqli_fetch_array($refeed)) {
            $uid2 = $rofeed['user_id'];
            $rowuser2 = query_row($con, "select * from user_db where user_id='$uid2'");
            $feed_id = $rofeed['feed_id'];
        ?>
            <div class="card" style="border-radius:10px;">
                <table border="0">
                    <br>
                    <tr>
                        <td rowspan="2" width="20%" align="center">
                            <?php
                            if (empty($rowuser2['user_img'])) {
                                $img = "login4.png";
                            } else {
                                $img = $rowuser2['user_img'];
                            } ?>
                            <div style="height:80px;width:80px;border-radius:100%;background-image:url('../image/<?php echo $img; ?>');
                            background-size:cover;background-position:center"></div>
                        </td>
                        <td width="60%"><b><?php echo $rowuser2['user_fname'] . " " . $rowuser2['user_lname']; ?></b></td>
                        <td width="10%">
                            <?php if ($id == $uid2) { ?><a data-bs-toggle="modal" data-bs-target="#editfeed<?php echo $feed_id; ?>">
                                    <img src="../image/edit.png" alt="" width="20px">
                                </a>
                            <?php } ?>
                        </td>
                        <td width="10%">
                            <?php if ($id == $uid2) { ?><a data-bs-toggle="modal" data-bs-target="#delfeed<?php echo $feed_id; ?>">
                                    <img src="../image/delete.png" alt="" width="20px"></a>
                            <?php } ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3"> <?php echo $rofeed['feed_dct']; ?> <br>
                            <small><?php echo datediff($rofeed['feed_date'])
                                    ?></small>
                        </td>
                    </tr>
                </table> <br>
                <div class="row">
                    <?php $img = $rofeed['feed_img'];
                    if (!empty($img)) {
                        $imgname = explode(",", $img);
                        //print_r($imgname);
                        $i = 0;
                        while ($i < count($imgname) - 1) {
                    ?>

                            <div class="col">
                                <img src="../image/<?php echo $imgname[$i]; ?>" width="100%" style="border-radius:5%">
                            </div>
                    <?php $i++;
                        }
                    } ?>
                </div>
                <br>
                <h6 style="margin-left : 25px ">ความคิดเห็น</h6>
                <form action="" method="post">
                    <input type="hidden" name="feed_id" value="<?php echo $rofeed['feed_id']; ?>">
                    <div class="row">
                        <div class="col-1"></div>
                        <div class="col-9">
                            <input type="text" name="comment" id="" class="form-control">
                        </div>
                        <div class="col-2">
                            <input type="submit" name="save_comment" value="โพสต์" class="btn btn-primary ">
                        </div>
                    </div>
                </form>
                <hr>

                <?php
                $rofid = $rofeed['feed_id'];
                $recom = query_sql($con, "select * from comment_db where feed_id ='$rofid' order by comment_date desc");
                while ($rocom = mysqli_fetch_array($recom)) {
                    $uid3 = $rocom['user_id'];
                    $com_id = $rocom['comment_id'];
                    $rowuser3 = query_row($con, "select * from user_db where user_id='$uid3'");
                ?>
                    <table>
                        <tr>

                            <td width="10%" align="center">
                                <?php
                                if (empty($rowuser3['user_img'])) {
                                    $img = "login4.png";
                                } else {
                                    $img = $rowuser3['user_img'];
                                } ?>
                                <div style="height:50px;width:50px;border-radius:100%;background-image:url('../image/<?php echo $img; ?>');
                                background-size:cover;background-position:center"></div>
                            </td>
                            <td width="20%"><small><b><?php echo $rowuser3['user_fname'] . " " . $rowuser3['user_lname']; ?></b></small></td>
                            <td width="40%"><?php echo $rocom['comment_dct']; ?></td>
                            <td width="20%"><small style="padding: 15%;"><?php echo datediff($rocom['comment_date']); ?></small></td>
                            <td width="5%"><?php if ($id == $uid3) { ?><a data-bs-toggle="modal" data-bs-target="#editcomment<?php echo $com_id; ?>">
                                        <img src="../image/edit.png" alt="" width="20px"></a><?php } ?></td>
                            <td width="5%"><?php if ($id == $uid3) { ?><a data-bs-toggle="modal" data-bs-target="#delcomment<?php echo $com_id; ?>">
                                        <img src="../image/delete.png" alt="" width="20px"></a><?php } ?></td>
                        </tr>
                    </table>
                    <hr>
                <?php } ?>
            </div>
            <br>
        <?php } ?>
    </div>
    <div class="col-sm-3">
        <center>
            <h3><b>คนที่คุณอาจรู้จัก</b></h3>
        </center>
        <hr>
        <div class="row">
            <?php
            $result2 = query_sql($con, "select * from user_db where user_id != '$id' and user_status != '9' and user_id not in (select friend_friend from friend_db where friend_me ='$id')");
            while ($row2 = mysqli_fetch_array($result2)) {

            ?>
                <div class="col-sm-3">
                    <?php if (empty($row2['user_img'])) {
                        $img = "login4.png";
                    } else {
                        $img = $row2['user_img'];
                    } ?>
                    <center>
                        <div style="height:50px;width:50px;border-radius:100%;background-image:url('../image/<?php echo $img; ?>');
                    background-size:cover;background-position:center"></div>
                        <b><?php echo $row2['user_fname'] . " " . $row2['user_lname']; ?></b>
                    </center>
                </div>
                <br>
            <?php } ?>
        </div>
        <hr>
        <center>
            <h3><b>เพื่อน</b></h3>
        </center>
        <hr>
        <div class="row">
            <?php
            $result2 = query_sql($con, "select * from friend_db where friend_me = '$id' and friend_status='1'");
            while ($row2 = mysqli_fetch_array($result2)) {
                $uid = $row2['friend_friend'];
                $row = query_row($con, "select * from user_db where user_id='$uid'");
                //print_r($row);
                $friend = $row['user_id'];
            ?>
                <div class="col-sm-3">
                    <?php if (empty($row['user_img'])) {
                        $img = "login4.png";
                    } else {
                        $img = $row['user_img'];
                    } ?>
                    <center>
                        <div style="height:50px;width:50px;border-radius:100%;background-image:url('../image/<?php echo $img; ?>');
                    background-size:cover;background-position:center"></div>
                        <b><?php echo $row['user_fname'] . " " . $row['user_lname']; ?></b>
                    </center>
                </div>
                <br>
            <?php } ?>
        </div>
    </div>
</div>

<!--- feed modal for del -->
<?php
$refeed = query_sql($con, "select * from feed_db order by feed_date desc");
while ($rofeed = mysqli_fetch_array($refeed)) {
?>
    <div class="modal fade" id="delfeed<?php echo $rofeed['feed_id']; ?>" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">ยืนยันการลบ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" align='center'>
                    <img src="../image/del.PNG" alt="">
                    <p>คุณต้องการลบ <?php echo $rofeed['feed_dct']; ?> ใช่หรือไม่ ?</p><br>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <a href="?action=feed&id=<?php echo $rofeed['feed_id']; ?>" class="btn btn-danger">ยืนยันการลบ</a>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<!--- commend modal for del -->
<?php
$recom = query_sql($con, "select * from comment_db");
while ($rocom = mysqli_fetch_array($recom)) {
?>
    <div class="modal fade" id="delcomment<?php echo $rocom['comment_id']; ?>" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">ยืนยันการลบ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" align='center'>
                    <img src="../image/del.PNG" alt="">
                    <p>คุณต้องการลบ <?php echo $rocom['comment_dct']; ?> ใช่หรือไม่ ?</p><br>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <a href="?&action=comment&id=<?php echo $rocom['comment_id']; ?>" class="btn btn-danger">ยืนยันการลบ</a>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<!--- feed modal for edit -->
<?php
$refeed = query_sql($con, "select * from feed_db order by feed_date desc");
while ($rofeed = mysqli_fetch_array($refeed)) {
?>
    <div class="modal fade" id="editfeed<?php echo $rofeed['feed_id']; ?>" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">ยืนยันการแก้ไข</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" enctype="multipart/form-data">

                        <h5><b>แก้ไขฟีด</b></h5>

                        <input type="text" name="feed" class="form-control" value="<?php echo $rofeed['feed_dct']; ?>">
                        <hr>
                        <h5><b>แก้ไขรูปภาพ</b></h5>
                        <input type="hidden" name="id" value="<?php echo $rofeed['feed_id']; ?>">
                        <input type="hidden" name="old_img" value="<?php echo $rofeed['feed_img']; ?>">
                        <input type="file" name="file[]" class="form-control" multiple="multiple">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <input type="submit" value="แก้ไข" name="save_edit_feed" class="btn btn-primary">

                </div>
                </form>
            </div>
        </div>
    </div>
<?php } ?>

<!---comment modal for edit -->
<?php
$recom = query_sql($con, "select * from comment_db");
while ($rocom = mysqli_fetch_array($recom)) {
?>
    <div class="modal fade" id="editcomment<?php echo $rocom['comment_id']; ?>" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">ยืนยันการแก้ไข</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" align='center'>
                    <form method="post">
                        <hr>
                        <h5 align="center"><b>แก้ไขความคิดเห็น</b></h5>
                        <hr>
                        <input type="hidden" name="id" value="<?php echo $rocom['comment_id']; ?>">
                        <input type="text" name="comment" class="form-control" value="<?php echo $rocom['comment_dct']; ?>">
                        <br>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <input type="submit" value="แก้ไข" name="save_edit_comment" class="btn btn-primary btn-block ">
                </div>
                </form>
            </div>
        </div>
    </div>
<?php } ?>