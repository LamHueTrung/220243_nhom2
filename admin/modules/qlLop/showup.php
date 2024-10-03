<?php
    $sql_lophoc = "SELECT *FROM lophoc where maLop = '$_GET[malop]' ";
    $querylophoc = mysqli_query($conn, $sql_lophoc) ;
    $row_title = mysqli_fetch_assoc($querylophoc);  
    $sql = "SELECT * FROM sinhvien where maLop = '$_GET[malop]' ";
    $query = mysqli_query($conn, $sql);
?>
<div class="card">
        <div class="card-header ">
            <h3>Danh Sinh Viên:<?php echo $row_title ['maLop']?></h3>
            <a class = "btn btn-primary" href = "index.php?action=qlsv&query=them">Thêm mới</a> 
        </div>
        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Mã sinh viên</th>
                    <th scope="col">Họ tên</th>
                    <th scope="col">Ngày sinh</th>
                    <th scope="col">Giói tính</th>
                    <th scope="col">Mã Lớp</th>
                    <th scope="col">Thao tác</th>
                </tr>
            </thead>
            <tbody>
            <?php while($row = mysqli_fetch_array($query)){?>
                <tr>
                <td><a class="btn " href="index.php?action=qlsv&query=thongtin&masv=<?php echo $row['maSV'] ?>"><b><?php echo $row['maSV'] ?></b></a></td>
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