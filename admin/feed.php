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
        <div style="height:150px;width:150px;border-radius:100%;background-image:url('../image/<?php echo $img; ?>');
        background-size:cover;background-position:center"></div>
        <br>
        <h3><b><?php echo $row['user_fname'] . " " . $row['user_lname']; ?></b></h3>
        <hr>
    </div>
    <div class="col-sm-6">
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
                            <a href="?page=edit_feed&action=feed&id=<?php echo $feed_id; ?>">
                                <img src="../image/edit.png" alt="" width="20px"> </a>
                        </td>
                        <td width="10%">
                            <a href="?page=delete_feed&action=feed&id=<?php echo $feed_id; ?>">
                                <img src="../image/delete.png" alt="" width="20px"></a>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3"> <?php echo $rofeed['feed_dct']; ?> <br>
                            <small><?php $d = date_create($rofeed['feed_date']);
                                    echo date_format($d, "D d M Y") ?></small>
                        </td>
                    </tr>
                </table> <br>
                <?php $img = $rofeed['feed_img'];
                if (!empty($img)) { ?>
                    <img src="../image/<?php echo $img; ?>" width="100%" style="border-radius:5%">
                <?php } ?>
                <br>
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
                                <div style="height:50px;width:50px;border-radius:100%;background-image:url('../image/<?php echo $img; ?>');background-size:cover;background-position:center"></div>
                            </td>
                            <td width="20%"><small><b><?php echo $rowuser3['user_fname'] . " " . $rowuser3['user_lname']; ?></b></small></td>
                            <td width="40%"><?php echo $rocom['comment_dct']; ?></td>
                            <td width="20%"><small><?php $d1 = date_create($rocom['comment_date']);
                            echo date_format($d1, "D d M Y") ?></small></td>
                            <td width="5%"><a href="?page=edit_feed&action=comment&id=<?php echo $com_id; ?>">
                                    <img src="../image/edit.png" alt="" width="20px"></a>
                            </td>
                            <td width="5%"><a href="?page=delete_feed&action=comment&id=<?php echo $com_id; ?>">
                                    <img src="../image/delete.png" alt="" width="20px"></a>
                            </td>
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
            <h4><b>เพื่อน</b></h4>
        </center>
        <hr style="color:red">
        <?php
        $result2 = query_sql($con, "select * from friend_db where friend_me = '$id' and friend_status='1'");
        while ($row2 = mysqli_fetch_array($result2)) {
            $uid = $row2['friend_friend'];
            $row = query_row($con, "select * from user_db where user_id='$uid'");
            print_r($row);
            $friend = $row['user_id'];
        ?>
            <tr>
                <td>
                    <?php if (empty($row['user_img'])) {
                        $img = "login4.png";
                    } else {
                        $img = $row['user_img'];
                    } ?>
                    <center><div style="height:50px;width:50px;border-radius:100%;background-image:url('../image/<?php echo $img; ?>');
                    background-size:cover;background-position:center"></div>
                </td>
                <td>
                    <b><?php echo $row['user_fname'] . " " . $row['user_lname']; ?></b></center>
                </td>
            </tr>
            <br>
        <?php } ?>
    </div>
</div>