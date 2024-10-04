<?php
    $sql = "SELECT * FROM sinhvien WHERE maSV ='$_GET[masv]' LIMIT 1";
    $query = mysqli_query($conn, $sql);
?>
<div class="card">
        <div class="card-header bg-secondary text-white text-center">
            <h3>Thêm Sinh Viên</h3>
        </div>
        <div class="card-body">
            <form action="modules/qlSV/xuly.php" method="POST" enctype="multipart/form-data">
                <?php
                    while($row = mysqli_fetch_assoc($query)){
                ?>
                    <div class="form-group">
                        <label for="categoryName">Mã Sinh Viên:</label>
                        <input type="text" class="form-control" name="txtmasv" value="<?php echo $row['maSV']; ?>" readonly>
                    </div>
                        <input type="hidden" name="masv" value="<?php echo $row['maSV']; ?>"> <!-- Đảm bảo mssv đc giữ lại khi gui đi -->
                    <div class="form-group">
                        <label for="categoryName">Họ:</label>
                        <input type="text" class="form-control" name="txtho" value="<?php echo $row['hoLot'] ?>" >
                    </div>
                    <div class="form-group">
                        <label for="categoryName">Tên:</label>
                        <input type="text" class="form-control" name="txtten" value="<?php echo $row['tenSV'] ?>" >
                    </div>
                    <div class="form-group">
                        <label for="categoryName">Ngày Sinh:</label>
                        <input type="date" class="form-control" name="txtngaysinh" value="<?php echo $row['ngaySinh'] ?>" >
                    </div>
                    <div class="form-group">
                        <label for="categoryName">Giới Tính:</label>
                        <select class="form-control" name="txtgioitinh" >
                            <?php
                                if($row['gioiTinh'] == "Nam"){ ?>
                                    <option value="Nữ">Nữ</option>
                                    <option value="Nam" selected>Nam</option>
                                    <option value="Khác">Khác</option>
                            <?php } elseif($row['gioiTinh'] == "Nữ"){ ?>
                                    <option value="Nữ" selected>Nữ</option>
                                    <option value="Nam">Nam</option>
                                    <option value="Khác">Khác</option>
                            <?php } else { ?>
                                    <option value="Nữ">Nữ</option>
                                    <option value="Nam">Nam</option>
                                    <option value="Khác" selected>Khác</option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="categoryName">Email:</label>
                        <input type="text" class="form-control" name="txtemail" value="<?php echo $row['email'] ?>" >
                    </div>
                    <div class="form-group">
                        <label for="categoryName">Số điện thoại:</label>
                        <input type="tel" class="form-control" name="txtsodienthoai" value="<?php echo $row['soDT'] ?>" >
                    </div>
                    <div class="form-group">
                        <label for="categoryName">Địa chỉ:</label>
                        <input type="text" class="form-control" name="txtdiachi" value="<?php echo $row['diaChi'] ?>" >
                    </div>
                    <div class="form-group">
                        <label>Chọn file hình ảnh:</label>
                        <input type="file" name="txthinhanh" value="<?php echo $row['hinhAnh'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="">Lớp</label>
                            <select class="form-control" name = "txtmalop">
                                <?php
                                    $sql_lop = "SELECT * FROM lophoc ORDER BY maLop DESC";
                                    $query_lop = mysqli_query($conn, $sql_lop);
                                    while($row_lop = mysqli_fetch_array($query_lop)){ 
                                        if($row_lop['maLop'] == $row['maLop']){  ?>
                                            <option selected value="<?php echo $row_lop['maLop']?>"><?php echo $row_lop['maLop']?></option>
                                        <?php
                                        }else{ ?>
                                            <option value="<?php echo $row_lop['maLop']?>"><?php echo $row_lop['maLop']?></option>
                                        <?php
                                        } 
                                    } ?>
                            </select>
                    </div>
                    <?php } ?>
                    <div class="form-group">
                    <input onclick = "return confirm('Bạn có thực sự muốn sửa không?')" class="btn btn-sm btn-success" type="submit" name="edit" value="Save">
                    </div>
            </form>
        </div>
    </div>