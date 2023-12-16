<hr>
<center>
    <h2>
        <b>รายงานผู้ใช้ระบบ</b>
    </h2>
</center>
<hr>
<table class="table table-bordder table-hover">
    <thead align='center'>
        <th scope='col'>ลำดับ</th>
        <th scope='col'>รูปภาพ</th>
        <th scope='col'>ชื่อจริง</th>
        <th scope='col'>นามสกุล</th>
        <th scope='col'>วันเกิด</th>
        <th scope='col'>เพศ</th>
        <th scope='col'>อีเมล</th>
        <th scope='col'>สถานะ</th>

    </thead>
    <?php
    $i = 1;
    $result = query_sql($con, "select * from user_db where user_status = '$id'");
    while ($row = mysqli_fetch_array($result)) { ?>
        <tr align="center">
            <td><?php echo $i; ?></td>
            <td> <?php
                    if (empty($row['user_img'])) {
                        $img = "login4.png";
                    } else {
                        $img = $row['user_img'];
                    } ?>
                <div style="height:80px;width:80px;border-radius:100%;background-image:url('../image/<?php echo $img; ?>');
        background-size:cover;background-position:center">
            </td>
            <td><?php echo $row['user_fname']; ?></td>
            <td><?php echo $row['user_lname']; ?></td>
            <td><?php $d = date_create($row['user_bd']);
                echo date_format($d, 'D d M Y'); ?></td>
            <td><?php echo sex($row['user_sex']); ?></td>
            <td><?php echo $row['user_email']; ?></td>
            <td><?php echo status($row['user_status']); ?></td>
        </tr>
    <?php $i++;
    }
    ?>
</table>