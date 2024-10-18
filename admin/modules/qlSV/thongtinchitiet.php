<?php
    $sql = "SELECT * FROM sinhvien, lophoc WHERE sinhvien.maLop = lophoc.maLop and maSV ='$_GET[masv]' LIMIT 1";
    $query = mysqli_query($conn, $sql);
?>
<div class="container mt-5">
    <div class="row">
        <?php
            while($row = mysqli_fetch_assoc($query)){
?> 
      <!-- Profile Picture -->
        <div class="col-md-4 text-center">
            <img src="modules/qlSV/image/<?php echo $row['hinhAnh'];?>" class="rounded-square img-thumbnail" alt="Student Profile Picture" <?php echo $row['hinhAnh'];?>>
            <h3 class="mt-3"><?php echo $row['hoLot'] . " " . $row['tenSV'];?></h3>
            <p class="text-muted"><?php echo $row['maSV'];?></p>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>Thông tin cá nhân</h4>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><strong>Mã lớp: </strong><?php echo $row['maLop'];?></li>
                        <li class="list-group-item"><strong>Tên lớp: </strong><?php echo $row['tenLop'];?></li>
                        <li class="list-group-item"><strong>Ngày sinh: </strong><?php echo $row['ngaySinh'];?> </li>
                        <li class="list-group-item"><strong>Giới tính: </strong><?php echo $row['gioiTinh'];?></li>
                        <li class="list-group-item"><strong>Email: </strong><?php echo $row['email'];?></li>
                        <li class="list-group-item"><strong>Số điện thoại: </strong><?php echo ($row['soDT'])?></li>
                        <li class='list-group-item'><strong>Địa chỉ: </strong><?php echo $row['diaChi'] ?></li>
                    </ul>
                </div>
            </div>
        <?php } ?>
            <div class="text-right">
                <a href="./index.php?action=qlsv&query=lietke" class="btn btn-primary">Quay lại</a>
            </div>
<!--         
        <div class="card mt-4">
            <div class="card-header">
                <h4>Statistics</h4>
            </div>
            <div class="card-body">
                <div class="row text-center">
                <div class="col-md-4">
                    <h5>GPA</h5>
                    <p>3.8</p>
                </div>
                <div class="col-md-4">
                    <h5>Completed Courses</h5>
                    <p>40</p>
                </div>
                <div class="col-md-4">
                    <h5>Projects</h5>
                    <p>10</p>
                </div>
            </div>
          </div>
        </div>
        -->
        </div>
    </div>
</div>
