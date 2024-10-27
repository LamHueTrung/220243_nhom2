<?php
    $sql = "SELECT * FROM sinhvien, lophoc WHERE sinhvien.maLop = lophoc.maLop and maSV ='$_GET[masv]' LIMIT 1";
    $query = mysqli_query($conn, $sql);
?>
<div class="container mt-5">
    <div class="row">
        <?php
            while($row = mysqli_fetch_assoc($query)){
?> 
      <!-- Profile Picture -->
        <div class="col-md-4 text-center">
            <img src="modules/qlSV/image/<?php echo $row['hinhAnh'];?>" class="rounded-square img-thumbnail" alt="Student Profile Picture" <?php echo $row['hinhAnh'];?>>
            <h3 class="mt-3"><?php echo $row['hoLot'] . " " . $row['tenSV'];?></h3>
            <p class="text-muted"><?php echo $row['maSV'];?></p>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>Thông tin cá nhân</h4>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><strong>Mã lớp: </strong><?php echo $row['maLop'];?></li>
                        <li class="list-group-item"><strong>Tên lớp: </strong><?php echo $row['tenLop'];?></li>
                        <li class="list-group-item"><strong>Ngày sinh: </strong><?php echo $row['ngaySinh'];?> </li>
                        <li class="list-group-item"><strong>Giới tính: </strong><?php echo $row['gioiTinh'];?></li>
                        <li class="list-group-item"><strong>Email: </strong><?php echo $row['email'];?></li>
                        <li class="list-group-item"><strong>Số điện thoại: </strong><?php echo ($row['soDT'])?></li>
                        <li class='list-group-item'><strong>Địa chỉ: </strong>
                        <?php 
                            $id_diachi = $row['diaChi'];
                            $id_sinhvien = $row['maSV'];
                            $sql_select_diachi = "SELECT * FROM province WHERE id = '$id_sinhvien' LIMIT 1"; 
                            $result_diachi = mysqli_query($conn, $sql_select_diachi);
                            
                            if ($result_diachi && mysqli_num_rows($result_diachi) > 0) {
                                while ($row_diachi = mysqli_fetch_assoc($result_diachi)) {
                                    // Truy xuất id từ cơ sở dữ liệu
                                    $id_province = $row_diachi['id_province'];
                                    $id_district = $row_diachi['id_district'];
                                    $id_ward = $row_diachi['id_ward'];
                            
                                    echo $row_diachi['diachicuthe'] .' - ';

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
                                                    echo $result['ward_name'] .' - ';
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
                                                    echo $result['district_name'] .' - ';
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
                                                    echo $result['province_name'];
                                                }
                                            }
                                        }   
                                    }
                                }
                            } else {
                                echo "Không tìm thấy địa chỉ của sinh viên.";
                            }
                            
                        ?>
                    </li>
                    </ul>
                </div>
            </div>
        <?php } ?>
            <div class="text-right">
                <a href="./index.php?action=qlsv&query=lietke" class="btn btn-primary">Quay lại</a>
            </div>
<!--         
        <div class="card mt-4">
            <div class="card-header">
                <h4>Statistics</h4>
            </div>
            <div class="card-body">
                <div class="row text-center">
                <div class="col-md-4">
                    <h5>GPA</h5>
                    <p>3.8</p>
                </div>
                <div class="col-md-4">
                    <h5>Completed Courses</h5>
                    <p>40</p>
                </div>
                <div class="col-md-4">
                    <h5>Projects</h5>
                    <p>10</p>
                </div>
            </div>
          </div>
        </div>
        -->
        </div>
    </div>
</div>
