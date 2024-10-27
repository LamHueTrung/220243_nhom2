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
                    <?php 
                        $sql_select_diachi = "SELECT * FROM province WHERE id = '$_GET[masv]' LIMIT 1"; 
                        $result_diachi = mysqli_query($conn, $sql_select_diachi);
                        $row_diachi = mysqli_fetch_assoc($result_diachi);
                        $id_province = $row_diachi['id_province'];
                        $id_district = $row_diachi['id_district'];
                        $id_ward = $row_diachi['id_ward'];
                        
                        // URL API của VNAppMobile
                        $api_ward_url = "https://vapi.vnappmob.com/api/province/ward/$id_district";
                            
                        // Gửi yêu cầu GET đến API
                        $response_ward = file_get_contents($api_ward_url);
                        if ($response_ward !== false) {
                            // Chuyển đổi JSON thành mảng PHP
                            $data = json_decode($response_ward, true);
                
                            foreach($data['results'] as $result) {
                                if (isset($result['ward_id'])) {
                                    $ward_id = $result['ward_id'];
                                    if($ward_id == $id_ward) {
                                        $echoWard = $result['ward_name'];
                                    }
                                }
                            }   
                        }
                        // URL API của VNAppMobile
                        $api_district_url = "https://vapi.vnappmob.com/api/province/district/$id_province";
                
                        // Gửi yêu cầu GET đến API
                        $response_district = file_get_contents($api_district_url);
                        if ($response_district !== false) {
                            // Chuyển đổi JSON thành mảng PHP
                            $data = json_decode($response_district, true);
                
                            foreach($data['results'] as $result) {
                                if (isset($result['district_id'])) {
                                    $district_id = $result['district_id'];
                                    if($district_id == $id_district) {
                                        $echoDistrict = $result['district_name'] ;
                                    }
                                }
                            }   
                        }

                        // URL API của VNAppMobile
                        $api_url = "https://api.vnappmob.com/api/province";
                
                        // Gửi yêu cầu GET đến API
                        $response = file_get_contents($api_url);
                        if ($response !== false) {
                            // Chuyển đổi JSON thành mảng PHP
                            $data = json_decode($response, true);
                
                            foreach($data['results'] as $result) {
                                if (isset($result['province_id'])) {
                                    $province_id = $result['province_id'];
                                    if($province_id == $id_province) {
                                        $echoProvince = $result['province_name'];
                                    }
                                }
                            }   
                        }
                    ?>
                    <div class="form-group">
                        <label for="province">Tỉnh/Thành phố:</label>
                        <select class="form-control" id="province" name="province_id" required>
                            <option value="<?php echo $id_province?>"><?php echo $echoProvince?></option>
                        </select>
                        <input type="hidden" name="province_name" id="province_name">
                    </div>
                    <div class="form-group">
                        <label for="district">Quận/Huyện:</label>
                        <select class="form-control" id="district" name="district_id" required>
                            <option value="<?php echo $id_district?>"><?php echo $echoDistrict?></option>
                        </select>
                        <input type="hidden" name="district_name" id="district_name">
                    </div>
                    <div class="form-group">
                        <label for="ward">Phường/Xã:</label>
                        <select class="form-control" id="ward" name="ward_id" required>
                            <option value="<?php echo $id_ward?>"><?php echo $echoWard?></option>
                        </select>
                        <input type="hidden" name="ward_name" id="ward_name">
                    </div>
                    <div class="form-group">
                        <label for="categoryName">Địa chỉ cụ thể:</label>
                        <input type="text" class="form-control" name="txtdiachi" placeholder="Nhập địa chỉ cụ thể" value="<?php echo $row_diachi['diachicuthe']; ?>" required>
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
    <script>
        
// Gọi API để load danh sách Tỉnh/Thành phố, Quận/Huyện, Phường/Xã
document.addEventListener("DOMContentLoaded", function () {
    // Load danh sách Tỉnh/Thành phố
    fetch('https://vapi.vnappmob.com/api/province/')
        .then(response => response.json())
        .then(data => {
            let provinceSelect = document.getElementById('province');
            data.results.forEach(province => {
                    provinceSelect.innerHTML += `<option value="${province.province_id}">${province.province_name}</option>`;
            });
        });

    // Khi chọn Tỉnh/Thành phố
    document.getElementById('province').addEventListener('change', function () {
        let provinceId = this.value;
        let provinceName = this.options[this.selectedIndex].text;
        document.getElementById('province_name').value = provinceName; // Lưu tên Tỉnh/Thành phố

        // Load danh sách Quận/Huyện
        fetch(`https://vapi.vnappmob.com/api/province/district/${provinceId}`)
            .then(response => response.json())
            .then(data => {
                let districtSelect = document.getElementById('district');
                districtSelect.innerHTML = '<option value="">Chọn Quận/Huyện</option>';
                data.results.forEach(district => {
                    districtSelect.innerHTML += `<option value="${district.district_id}">${district.district_name}</option>`;
                });

                // Reset danh sách Phường/Xã
                let wardSelect = document.getElementById('ward');
                wardSelect.innerHTML = '<option value="">Chọn Phường/Xã</option>';
            });
    });

    // Khi chọn Quận/Huyện
    document.getElementById('district').addEventListener('change', function () {
        let districtId = this.value;
        let districtName = this.options[this.selectedIndex].text;
        document.getElementById('district_name').value = districtName; // Lưu tên Quận/Huyện

        // Load danh sách Phường/Xã
        fetch(`https://vapi.vnappmob.com/api/province/ward/${districtId}`)
            .then(response => response.json())
            .then(data => {
                let wardSelect = document.getElementById('ward');
                wardSelect.innerHTML = '<option value="">Chọn Phường/Xã</option>';
                data.results.forEach(ward => {
                    wardSelect.innerHTML += `<option value="${ward.ward_id}">${ward.ward_name}</option>`;
                });
            });
    });

    // Khi chọn Phường/Xã
    document.getElementById('ward').addEventListener('change', function () {
        let wardName = this.options[this.selectedIndex].text;
        document.getElementById('ward_name').value = wardName; // Lưu tên Phường/Xã
    });
});
</script>