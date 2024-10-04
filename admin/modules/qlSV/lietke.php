<?php
    if (isset($_POST['search'])) {
        $SearchText = $_POST['SearchText'];
        // Ghép nối họ và tên để tìm kiếm đầy đủ họ tên
        $sql = "SELECT * FROM sinhvien WHERE (CONCAT(hoLot, ' ', tenSV) LIKE '%$SearchText%') 
                OR maSV LIKE '%$SearchText%' 
                OR maLop LIKE '%$SearchText%' 
                OR gioiTinh LIKE '%$SearchText%'";
    } else {
        $sql = "SELECT * FROM sinhvien";
    }
    $query = mysqli_query($conn, $sql);
?>

<div class="card">
        <div class="card-header ">
            <h3>Danh Sách Sinh Viên</h3>
            <a class = "btn btn-primary mb-3" href = "index.php?action=qlsv&query=them">Thêm mới</a>
            <form action="" method = "POST">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Search" name = "SearchText">
                    <div class="input-group-append">
                        <button class="btn btn-success" type="submit" name="search">Tìm kiếm</button>
                    </div>
                </div>
            </form> 
        </div>
        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Mã sinh viên</th>
                    <th scope="col">Họ tên</th>
                    <th scope="col">Ngày sinh</th>
                    <th scope="col">Giới tính</th>
                    <th scope="col">Mã Lớp</th>
                    <th scope="col">Thao tác</th>
                </tr>
            </thead>
            <tbody>
            <?php while($row = mysqli_fetch_assoc($query)){?>
                <tr onclick="window.location.href='index.php?action=qlsv&query=thongtin&masv=<?php echo $row['maSV'] ?>';" style="cursor: pointer;">
                    <td><?php echo $row['maSV'] ?></td>
                    <td><?php echo $row['hoLot'] . " " . $row['tenSV']; ?></td>
                    <td><?php echo $row['ngaySinh']?></td>
                    <td><?php echo $row['gioiTinh']?></td>
                    <th><?php echo $row['maLop']?></th>
                    <td>
                        <a href="?action=qlsv&query=sua&masv=<?php echo $row['maSV'] ?>" class="btn btn-sm btn-primary" class="btn btn-sm btn-danger" type="submit" >Edit</a>
                        <a onclick = "return confirm('Bạn có thực sự muốn xóa không?')" href="modules/qlSV/xuly.php?masv=<?php echo $row['maSV']; ?>" class="btn btn-sm btn-danger" type="submit">Delete</a>
                    </td>
                </tr>
            <?php } ?> 
            </tbody>
        </table>
    </div>