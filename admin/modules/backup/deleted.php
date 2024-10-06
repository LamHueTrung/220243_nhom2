<?php
    if (isset($_POST['search'])) {
        $SearchText = $_POST['SearchText'];
        // Ghép nối họ và tên để tìm kiếm đầy đủ họ tên
        $sql_sinhvien = "SELECT * FROM sinhvien 
                WHERE isDeleted = 1 
                AND (CONCAT(hoLot, ' ', tenSV) LIKE '%$SearchText%' 
                OR maSV LIKE '%$SearchText%' 
                OR maLop LIKE '%$SearchText%' 
                OR gioiTinh LIKE '%$SearchText%')";
    } else {
        $sql_sinhvien = "SELECT * FROM sinhvien WHERE isDeleted = 1";
    }
    $query_sinhvien = mysqli_query($conn, $sql_sinhvien);

    $sql_lop = "SELECT * FROM lophoc WHERE isDeleted = 1";
    $query_lop = mysqli_query($conn, $sql_lop);

    ?>
    <div class="container mt-5">
        <h2 class="text-center">Danh Sách Đã Xóa</h2>
        <ul class="nav nav-tabs" id="deletedTabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="sinhvien-tab" data-toggle="tab" href="#sinhvien" role="tab" aria-controls="sinhvien" aria-selected="true">Sinh Viên Đã Xóa</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="lop-tab" data-toggle="tab" href="#lop" role="tab" aria-controls="lop" aria-selected="false">Lớp Đã Xóa</a>
            </li>
        </ul>
        <div class="tab-content mt-3">
            <!-- Danh sách sinh viên đã xóa -->
            <div class="tab-pane fade show active" id="sinhvien" role="tabpanel" aria-labelledby="sinhvien-tab">
                <div class="card">
                    <div class="card-header">
                        <h3>Danh Sách Sinh Viên Đã Xóa</h3>
                    </div>
                    <div class="card-header">
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
                                <th scope="col">Mã SV</th>
                                <th scope="col">Họ và Tên</th>
                                <th scope="col">Ngày Sinh</th>
                                <th scope="col">Giới Tính</th>
                                <th scope="col">Lớp</th>
                                <th scope="col">Thao Tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row_sinhvien = mysqli_fetch_assoc($query_sinhvien)) { ?>
                                <tr>
                                    <td><?php echo $row_sinhvien['maSV']; ?></td>
                                    <td><?php echo $row_sinhvien['hoLot'] . " " . $row_sinhvien['tenSV']; ?></td>
                                    <td><?php echo $row_sinhvien['ngaySinh']; ?></td>
                                    <td><?php echo $row_sinhvien['gioiTinh']; ?></td>
                                    <td><?php echo $row_sinhvien['maLop']; ?></td>
                                    <td>
                                        <a onclick="return confirm('Bạn có chắc muốn khôi phục sinh viên <?php echo $row_sinhvien['tenSV']; ?> không')" href="modules/backup/xuly.php?maSV=<?php echo $row_sinhvien['maSV']; ?>" class="btn btn-sm btn-success">Khôi phục</a>
                                        <a onclick="return confirm('Bạn có chắc muốn xóa sinh viên <?php echo $row_sinhvien['tenSV']; ?> không?')" href="modules/backup/xuly.php?action=delete&maSV=<?php echo $row_sinhvien['maSV']; ?>" class="btn btn-sm btn-danger">Xóa</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Danh sách lớp học đã xóa -->
            <div class="tab-pane fade" id="lop" role="tabpanel" aria-labelledby="lop-tab">
                <div class="card">
                    <div class="card-header">
                        <h3>Danh Sách Lớp Đã Xóa</h3>
                    </div>
                    <table class="table table-bordered table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">Mã Lớp</th>
                                <th scope="col">Tên Lớp</th>
                                <th scope="col">Ghi Chú</th>
                                <th scope="col">Thao Tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row_lop = mysqli_fetch_assoc($query_lop)) { ?>
                                <tr>
                                    <td><?php echo $row_lop['maLop']; ?></td>
                                    <td><?php echo $row_lop['tenLop']; ?></td>
                                    <td><?php echo $row_lop['ghiChu']; ?></td>
                                    <td>
                                        <a onclick="return confirm('Bạn có chắc muốn khôi phục lớp <?php echo $row_lop['maLop']; ?> không')" href="modules/backup/xuly.php?maLop=<?php echo $row_lop['maLop']; ?>" class="btn btn-sm btn-success">Khôi phục</a>
                                        <a onclick="return confirm('Bạn có chắc muốn xóa lớp <?php echo $row_lop['maLop']; ?> không?')" href="modules/backup/xuly.php?action=delete&maLop=<?php echo $row_lop['maLop']; ?>" class="btn btn-sm btn-danger">Xóa</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
