<?php
    $sql = "SELECT * FROM lophoc WHERE isDeleted = 0";
    $query = mysqli_query($conn, $sql);
?>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Danh Sách Lớp</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Mã lớp</th>
                        <th>Tên lớp</th>
                        <th>Ghi chú</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = mysqli_fetch_assoc($query)){ ?>
                    <tr  style="cursor: pointer;">
                        <th><?php echo $row['maLop'] ?></th>
                        <td><?php echo $row['tenLop'] ?></td>
                        <td><?php echo $row['ghiChu'] ?></td>
                        <td>
                            <a href="?action=qllop&query=sua&malop=<?php echo $row['maLop']?>" class="btn btn-sm btn-success " type="submit">Sửa</a>
                            <a onclick="return confirm('Bạn có chắc muốn xóa không?')" href="modules/qlLop/xuly.php?malop=<?php echo $row['maLop']; ?>" class="btn btn-sm btn-danger " name="delete" type="submit">Xóa</a>
                            <a onclick="window.location.href='index.php?action=qllop&query=showup&malop=<?php echo $row['maLop']?>';" class="btn btn-sm btn-info" name="getbyidst" type="submit">Xem</a>
                        </td>
                    </tr>
                <?php } ?>
                    
                </tbody>
            </table>
        </div>
    </div>
</div>
