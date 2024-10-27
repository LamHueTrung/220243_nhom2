<?php
    if (isset($_POST['search'])) {
        $SearchText = $_POST['SearchText'];
        // Ghép nối họ và tên để tìm kiếm đầy đủ họ tên
        $sql = "SELECT * FROM sinhvien 
                WHERE isDeleted = 0 
                AND (CONCAT(hoLot, ' ', tenSV) LIKE '%$SearchText%' 
                OR maSV LIKE '%$SearchText%' 
                OR maLop LIKE '%$SearchText%' 
                OR gioiTinh LIKE '%$SearchText%')";
    } else {
        $sql = "SELECT * FROM sinhvien WHERE isDeleted = 0";
    }
    $query = mysqli_query($conn, $sql);
?>


    <div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Danh Sách Sinh Viên</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Mã sinh viên</th>
                        <th>Họ tên</th>
                        <th>Ngày sinh</th>
                        <th>Giới tính</th>
                        <th>Mã Lớp</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = mysqli_fetch_assoc($query)){ ?>
                    <tr  style="cursor: pointer;">
                        <th><?php echo $row['maSV'] ?></th>
                        <td><?php echo $row['hoLot'] . " " . $row['tenSV']; ?></td>
                        <td><?php echo $row['ngaySinh']?></td>
                        <td><?php echo $row['gioiTinh']?></td>
                        <th><?php echo $row['maLop']?></th>
                        <td>
                            <a href="?action=qlsv&query=sua&masv=<?php echo $row['maSV'] ?>" class="btn btn-sm btn-success " type="submit" >Sửa</a>
                            <a onclick = "return confirm('Bạn có thực sự muốn xóa không?')" href="modules/qlSV/xuly.php?masv=<?php echo $row['maSV']; ?>" class="btn btn-sm btn-danger" type="submit">Xóa</a>
                            <a onclick="window.location.href='index.php?action=qlsv&query=thongtin&masv=<?php echo $row['maSV'] ?>';" class="btn btn-sm btn-info" type="submit">Xem</a>
                        </td>
                    </tr>
                <?php } ?>
                    
                </tbody>
            </table>
        </div>
    </div>
</div>