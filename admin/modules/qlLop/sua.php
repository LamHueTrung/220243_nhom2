<?php 
    $sql = "SELECT * FROM lophoc WHERE maLop='$_GET[malop]' LIMIT 1";
    $query = mysqli_query($conn, $sql);
?>

<div class="card">
        <div class="card-header bg-secondary text-white text-center">
            <h3>Sua Lớp</h3>
        </div>
        <div class="card-body">
            <form action="modules/qlLop/xuly.php?malop=<?php echo $_GET['malop'] ?>" method="POST">
                <?php
                    while($row = mysqli_fetch_assoc($query)){
                ?>
            
                <div class="form-group">
                    <label for="categoryName">Mã Lớp: </label>
                    <input type="text" class="form-control" name="txtMa" value="<?php echo $row['maLop'];?>" readonly>
                </div>
                <div class="form-group">
                    <label for="categoryName">Tên Lớp: </label>
                    <input type="text" class="form-control" name="txtTen" value="<?php echo $row['tenLop'];?>" required>
                </div>
                <div class="form-group">
                    <label for="categoryName">Ghi Chú </label>
                    <input type="text" class="form-control" name="txtghichu" value="<?php echo $row['ghiChu'];?>" required>
                </div>
                <div class="form-group">
                    <input onclick = "return confirm('Bạn có thực sự muốn sửa không?')" class="btn btn-sm btn-success" type="submit" name="edit" value="Edit">
                </div>
                <?php } ?>
            </form>
        </div>
    </div>