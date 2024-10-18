<?php
    include("../../connect.php");

    $masv = isset($_POST["txtmasv"]) ? trim($_POST["txtmasv"]) : '';
    $hosv = isset($_POST["txtho"]) ? trim($_POST["txtho"]) : '';
    $tensv = isset($_POST["txtten"]) ? trim($_POST["txtten"]) : '';
    $ngaysinh = isset($_POST["txtngaysinh"]) ? trim($_POST["txtngaysinh"]) : '';
    $gioitinh = isset($_POST["txtgioitinh"]) ? trim($_POST["txtgioitinh"]) : '';
    $email = isset($_POST["txtemail"]) ? trim($_POST["txtemail"]) : '';
    $sodienthoai = isset($_POST["txtsodienthoai"]) ? trim($_POST["txtsodienthoai"]) : '';
    $diachiCuThe = isset($_POST["txtdiachi"]) ? trim($_POST["txtdiachi"]) : '';

    $province_id = $_POST['province_id'];
    $province_name = $_POST['province_name'];

    $district_id = $_POST['district_id'];
    $district_name = $_POST['district_name'];

    $ward_id = $_POST['ward_id'];
    $ward_name = $_POST['ward_name'];

    $malop = isset($_POST["txtmalop"]) ? trim($_POST["txtmalop"]) : '';

    // Image handling
    $allowed_extensions = ['png', 'jpg', 'jpeg', 'svg', 'webp'];
    $hinhanh = isset($_FILES['txthinhanh']['name']) && !empty($_FILES['txthinhanh']['name']) ? $_FILES['txthinhanh']['name'] : 'profile.png';
    $hinhanhtam = isset($_FILES['txthinhanh']['tmp_name']) ? $_FILES['txthinhanh']['tmp_name'] : '';

    // Validator flags
    $valid = true;
    $error = '';

    // Check file extension if an image is uploaded
    if ($hinhanh != 'profile.png') {
        $file_extension = strtolower(pathinfo($hinhanh, PATHINFO_EXTENSION));
        if (!in_array($file_extension, $allowed_extensions)) {
            $valid = false;
            $error .= "Chỉ chấp nhận các định dạng hình ảnh: png, jpg, jpeg, svg, webp. ";
        }
    }

    // Kiểm tra mã sinh viên chỉ chứa số
    if (!empty($masv) && !preg_match("/^\d+$/", $masv)) {
        $valid = false;
        $error .= "Mã sinh viên chỉ được chứa số. ";
    }

    // Kiểm tra ngày sinh hợp lý dựa trên mã lớp
    $current_year = date("Y");
    $birth_year = date("Y", strtotime($ngaysinh));

    if (!empty($malop)) {
        if (strpos($malop, 'DA24') === 0 && ($current_year - $birth_year) < 18) {
            $valid = false;
            $error .= "Sinh viên khóa DA24 phải từ 18 tuổi trở lên. ";
        } elseif (strpos($malop, 'DA23') === 0 && ($current_year - $birth_year) < 19) {
            $valid = false;
            $error .= "Sinh viên khóa DA23 phải từ 19 tuổi trở lên. ";
        } elseif (strpos($malop, 'DA22') === 0 && ($current_year - $birth_year) < 20) {
            $valid = false;
            $error .= "Sinh viên khóa DA22 phải từ 20 tuổi trở lên. ";
        } elseif (strpos($malop, 'DA21') === 0 && ($current_year - $birth_year) < 21) {
            $valid = false;
            $error .= "Sinh viên khóa DA21 phải từ 21 tuổi trở lên. ";
        }
    }

    // Kiểm tra số điện thoại đúng định dạng (bắt đầu bằng số 0, 10 hoặc 11 chữ số)
    if (!empty($sodienthoai) && !preg_match("/^0\d{9,10}$/", $sodienthoai)) {
        $valid = false;
        $error .= "Số điện thoại phải bắt đầu bằng số 0 và có 10 hoặc 11 chữ số. ";
    }

    // Kiểm tra email đúng định dạng
    if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $valid = false;
        $error .= "Email không hợp lệ. ";
    }
    //add
    if(isset($_POST['add']) && $valid) {
        if (is_uploaded_file($_FILES['csvFile']['tmp_name'])) {
            $csvFile = fopen($_FILES['csvFile']['tmp_name'], 'r');
    
            // Bỏ qua dòng đầu tiên nếu nó chứa tiêu đề
            fgetcsv($csvFile);
    
            // Lặp qua tệp CSV và chèn dữ liệu vào cơ sở dữ liệu
            while (($data = fgetcsv($csvFile, 1000, ",")) !== FALSE) {
                // Trích xuất dữ liệu CSV thành các biến
                $masv = $data[0]; 
                $hosv = $data[1];
                $tensv = $data[2];
                $ngaysinh = $data[3];
                $gioitinh = $data[4];
                $malop = $data[5];
                $email = $data[6];
                $sodienthoai = $data[7];
                $diachi = $data[8];
                $hinhanh = $data[9];
    
                // Kiểm tra xem sinh viên đã tồn tại trong cơ sở dữ liệu chưa
                $sql_kiemtra = "SELECT * FROM sinhvien WHERE maSV = '$masv'";
                $result = mysqli_query($conn, $sql_kiemtra);
    
                if (mysqli_num_rows($result) == 0) {
                    // Nếu không tồn tại, thực hiện câu truy vấn
                    $sql_them = "INSERT INTO sinhvien (maSV, hoLot, tenSV, ngaySinh, gioiTinh, maLop, email, soDT, diaChi, hinhAnh)
                    VALUES ('$masv', '$hosv', '$tensv', '$ngaysinh', '$gioitinh', '$malop', '$email', '$sodienthoai', '$diachi', '$hinhanh')";
                    mysqli_query($conn, $sql_them);
    
                    // Di chuyển tệp hình ảnh nếu được tải lên và nó không phải là mặc định
                    if ($hinhanh != 'profile.png') {
                        move_uploaded_file($hinhanhtam, 'image/' . $hinhanh);
                    }
                }
            }
            fclose($csvFile);
            echo "<script>alert('Import CSV thành công!'); window.location.href = '../../index.php?action=qlsv&query=lietke';</script>";
        } else {
            echo "<script>alert('Vui lòng chọn tệp CSV!'); window.location.href = '../../index.php?action=qlsv&query=them';</script>";
        }
        // Kiểm tra mã sinh viên đã tồn tại chưa
        $sql_kiemtra = "SELECT * FROM sinhvien WHERE maSV = '$masv'";
        $result = mysqli_query($conn, $sql_kiemtra);
        if (mysqli_num_rows($result) > 0) {
            // Nếu mã sinh viên đã tồn tại
            echo "<script>
            alert('Mã sinh viên đã tồn tại. Vui lòng nhập mã khác!');
            window.location.href = '../../index.php?action=qlsv&query=them';
            </script>";
        } else {
            // Tạo chuỗi địa chỉ
            $diachi = "$diachiCuThe - $province_name - $district_name - $ward_name"; // Cập nhật ở đây
            // Insert new student
            $sql_them = "INSERT INTO sinhvien (maSV, hoLot, tenSV, ngaySinh, gioiTinh, maLop, email, soDT, diaChi, hinhAnh)
            VALUES ('$masv', '$hosv', '$tensv', '$ngaysinh', '$gioitinh', '$malop', '$email', '$sodienthoai', '$diachi', '$hinhanh')";
            mysqli_query($conn, $sql_them);
    
            // Only move the uploaded file if a valid image file is uploaded
            if ($hinhanh != 'profile.png') {
                move_uploaded_file($hinhanhtam, 'image/' . $hinhanh);
            }
    
            // Insert into taikhoan with default password
            $matkhau_macdinh = password_hash($masv, PASSWORD_DEFAULT); // Mã hóa mật khẩu mặc định
            $sql_taikhoan = "INSERT INTO user (taikhoan, matkhau) VALUES ('$masv', '$matkhau_macdinh')";
            mysqli_query($conn, $sql_taikhoan);
    
            header('location: ../../index.php?action=qlsv&query=lietke');
        }
    // edit
    } elseif (isset($_POST['edit'])) {
        $id = $_POST['masv'];  // Lấy mã sinh viên từ POST

        $sql_get_old = "SELECT * FROM sinhvien WHERE maSV = '$id' LIMIT 1";
        $result_old = mysqli_query($conn, $sql_get_old);
        $row_old = mysqli_fetch_assoc($result_old);

        $hosv = !empty($hosv) ? $hosv : $row_old['hoLot'];
        $tensv = !empty($tensv) ? $tensv : $row_old['tenSV'];
        $ngaysinh = !empty($ngaysinh) ? $ngaysinh : $row_old['ngaySinh'];
        $gioitinh = !empty($gioitinh) ? $gioitinh : $row_old['gioiTinh'];
        $email = !empty($email) ? $email : $row_old['email'];
        $sodienthoai = !empty($sodienthoai) ? $sodienthoai : $row_old['soDT'];
        $diachi = !empty($diachi) ? $diachi : $row_old['diaChi'];
        $malop = !empty($malop) ? $malop : $row_old['maLop'];

        if ($hinhanh != 'profile.png') {
            move_uploaded_file($hinhanhtam, 'image/' . $hinhanh);
            $sql = "UPDATE sinhvien SET maSV = '$masv', hoLot = '$hosv', tenSV = '$tensv', ngaySinh = '$ngaysinh', gioiTinh = '$gioitinh', maLop = '$malop', email = '$email', soDT = '$sodienthoai', diaChi = '$diachi', hinhAnh = '$hinhanh' WHERE maSV = '$id'";
            $sql_slt = "SELECT * FROM sinhvien WHERE maSV = '$id' LIMIT 1";
            $query = mysqli_query($conn, $sql_slt);
            while ($row = mysqli_fetch_array($query)) {
                unlink('image/' . $row['hinhAnh']);
            }
        } else {
            $sql = "UPDATE sinhvien SET maSV = '$masv', hoLot = '$hosv', tenSV = '$tensv', ngaySinh = '$ngaysinh', gioiTinh = '$gioitinh', maLop = '$malop', email = '$email', soDT = '$sodienthoai', diaChi = '$diachi' WHERE maSV = '$id'";
        }

        mysqli_query($conn, $sql);
        header('location: ../../index.php?action=qlsv&query=lietke');
    } elseif (!$valid) {
        echo "<script>
            alert('$error');
            window.location.href = '../../index.php?action=qlsv&query=them';
        </script>";
    // delete
    } else {
        $id = $_GET['masv'];
        $sql_xoa = "UPDATE sinhvien SET isDeleted = 1 WHERE maSV = '$id'";
        mysqli_query($conn, $sql_xoa);
        header('location: ../../index.php?action=qlsv&query=lietke');
    }

    // Close connection
    $conn->close();
?>
