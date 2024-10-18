<?php
    $sql_lop = "SELECT * FROM lophoc";
    $query_lop = mysqli_query($conn, $sql_lop);
?>
<div class="card">
        <div class="card-header bg-secondary text-white text-center">
            <h3>Thêm Sinh Viên</h3>
        </div>
        <div class="card-body">
            <form action="modules/qlSV/xuly.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="categoryName">Mã Sinh Viên:</label>
                    <input type="text" class="form-control" name="txtmasv" placeholder="Nhập mã sinh viên" >
                </div>
                <div class="form-group">
                    <label for="categoryName">Họ:</label>
                    <input type="text" class="form-control" name="txtho" placeholder="Nhập họ sinh viên" >
                </div>
                <div class="form-group">
                    <label for="categoryName">Tên:</label>
                    <input type="text" class="form-control" name="txtten" placeholder="Nhập tên sinh viên" >
                </div>
                <div class="form-group">
                    <label for="categoryName">Ngày Sinh:</label>
                    <input type="date" class="form-control" name="txtngaysinh" placeholder="Nhập ngày sinh" >
                </div>
                <div class="form-group">
                    <label for="categoryName">Giới Tính:</label>
                    <select class="form-control" name="txtgioitinh" >
                        <option value="Nam">Nam</option>
                        <option value="Nữ">Nữ</option>
                        <option value="Khác">Khác</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="categoryName">Email:</label>
                    <input type="text" class="form-control" name="txtemail" placeholder="Nhập email" >
                </div>
                <div class="form-group">
                    <label for="categoryName">Số điện thoại:</label>
                    <input type="number" class="form-control" name="txtsodienthoai" placeholder="Nhập số điện thoại" >
                </div>
                <div class="form-group">
                    <label for="categoryName">Địa chỉ:</label>
                    <input type="text" class="form-control" name="txtdiachi" placeholder="Nhập địa chỉ" >
                </div>
                <div class="form-group">
                    <label>Chọn file hình ảnh:</label>
                    <input type="file" name="txthinhanh">
                </div>
                <div class="form-group">
                        <label for="">Lớp:</label>
                        <select class="form-control" name= "txtmalop">
                            <?php
                                foreach($query_lop as $row){?>
                                    <option><?php echo $row['maLop']?></option>
                            <?php }?>
                        </select>
                    </div>
                <div class="form-group">
                    <input class="btn btn-sm btn-success" type="submit" name="add" value="Thêm">
                </div>
                <div class="form-group">
                    <label>Chọn file CSV:</label>
                    <input type="file" name="csvFile">
                    <input class="btn btn-sm btn-primary" type="submit" name="add" value="Thêm sinh viên">
                </div>
            </form>
        </div>
    </div>