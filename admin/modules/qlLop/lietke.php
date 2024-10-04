<?php
    $sql = "SELECT * FROM lophoc";
    $query = mysqli_query($conn, $sql);
?>
<div class="card">
    <div class="card-header">
        <h3>Danh Sách Lớp</h3>
        <a class="btn btn-primary" href="index.php?action=qllop&query=them">Thêm mới</a> 
    </div>
    <table class="table table-bordered table-hover">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Mã lớp</th>
                <th scope="col">Tên lớp</th>
                <th scope="col">Ghi chú</th>
                <th scope="col">Thao tác</th>
            </tr>
        </thead>
        <tbody>
        <?php while($row = mysqli_fetch_assoc($query)){ ?>
            <tr onclick="window.location.href='index.php?action=qllop&query=showup&malop=<?php echo $row['maLop']?>';" style="cursor: pointer;">
                <th><?php echo $row['maLop'] ?></th>
                <td><?php echo $row['tenLop'] ?></td>
                <td><?php echo $row['ghiChu'] ?></td>
                <td>
                    <a href="?action=qllop&query=sua&malop=<?php echo $row['maLop']?>" class="btn btn-sm btn-primary" type="submit">Edit</a>
                    <a onclick="return confirm('Nếu xóa lớp này thì tất cả sinh viên trong lớp này sẽ bị xóa. Bạn có chắc muốn xóa không?')" href="modules/qlLop/xuly.php?malop=<?php echo $row['maLop']; ?>" class="btn btn-sm btn-danger" type="submit">Delete</a>
                </td>
            </tr>
        <?php } ?> 
        </tbody>
    </table>
</div>

