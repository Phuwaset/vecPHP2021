<?php if (isset($_GET['action'])) {
    $id = $_GET['id'];
    if ($_GET['action'] == "feed") {
        query_sql($con, "delete from feed_db where feed_id='$id'");
    } else if ($_GET['action'] == "comment") {
        query_sql($con, "delete from comment_db where comment_id='$id'");
    }
    header('location:home.php');
}
?>