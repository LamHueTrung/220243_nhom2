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
                <input type="text" class="form-control" name="txtmasv" placeholder="Nhập mã sinh viên" required>
            </div>
            <div class="form-group">
                <label for="categoryName">Họ:</label>
                <input type="text" class="form-control" name="txtho" placeholder="Nhập họ sinh viên" required>
            </div>
            <div class="form-group">
                <label for="categoryName">Tên:</label>
                <input type="text" class="form-control" name="txtten" placeholder="Nhập tên sinh viên" required>
            </div>
            <div class="form-group">
                <label for="categoryName">Ngày Sinh:</label>
                <input type="date" class="form-control" name="txtngaysinh" required>
            </div>
            <div class="form-group">
                <label for="categoryName">Giới Tính:</label>
                <select class="form-control" name="txtgioitinh" required>
                    <option value="Nam">Nam</option>
                    <option value="Nữ">Nữ</option>
                    <option value="Khác">Khác</option>
                </select>
            </div>
            <div class="form-group">
                <label for="categoryName">Email:</label>
                <input type="email" class="form-control" name="txtemail" placeholder="Nhập email" required>
            </div>
            <div class="form-group">
                <label for="categoryName">Số điện thoại:</label>
                <input type="number" class="form-control" name="txtsodienthoai" placeholder="Nhập số điện thoại" required>
            </div>
            <!-- Phần chọn Tỉnh/Thành phố, Quận/Huyện, Phường/Xã -->
            <div class="form-group">
                <label for="province">Tỉnh/Thành phố:</label>
                <select class="form-control" id="province" name="province_id" required>
                    <option value="">Chọn Tỉnh/Thành phố</option>
                </select>
                <input type="hidden" name="province_name" id="province_name">
            </div>
            <div class="form-group">
                <label for="district">Quận/Huyện:</label>
                <select class="form-control" id="district" name="district_id" required>
                    <option value="">Chọn Quận/Huyện</option>
                </select>
                <input type="hidden" name="district_name" id="district_name">
            </div>
            <div class="form-group">
                <label for="ward">Phường/Xã:</label>
                <select class="form-control" id="ward" name="ward_id" required>
                    <option value="">Chọn Phường/Xã</option>
                </select>
                <input type="hidden" name="ward_name" id="ward_name">
            </div>
            <div class="form-group">
                <label for="categoryName">Địa chỉ cụ thể:</label>
                <input type="text" class="form-control" name="txtdiachi" placeholder="Nhập địa chỉ cụ thể" required>
            </div>
            <div class="form-group">
                <label>Chọn file hình ảnh:</label>
                <input type="file" name="txthinhanh">
            </div>
            <div class="form-group">
                <label for="">Lớp:</label>
                <select class="form-control" name="txtmalop">
                    <?php foreach($query_lop as $row){ ?>
                        <option><?php echo $row['maLop']?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <input class="btn btn-sm btn-success" type="submit" name="add" value="Save">
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
