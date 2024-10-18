<?php
    include("../../connect.php");

    // Lấy dữ liệu từ form
    $ma = isset($_POST["txtMa"]) ? trim($_POST["txtMa"]) : '';
    $ten = isset($_POST["txtTen"]) ? trim($_POST["txtTen"]) : '';
    $ghichu = isset($_POST["txtghichu"]) ? trim($_POST["txtghichu"]) : '';

    // Kiểm tra validator
    $valid = true;
    $error = '';

    // Kiểm tra mã lớp không chứa ký tự tiếng Việt
    if (!empty($ma) && !preg_match("/^[a-zA-Z0-9]+$/", $ma)) {
        $valid = false;
        $error = "Mã lớp không được chứa ký tự tiếng Việt và chỉ bao gồm chữ cái và số.";
    }

    // Kiểm tra tên lớp không phải là chuỗi trống hoặc có nhiều khoảng trắng
    if (!empty($ten) && preg_match("/^\s+$/", $ten)) {
        $valid = false;
        $error = "Tên lớp không được là khoảng trắng.";
    }

    if (isset($_POST['add']) && $valid) {
        // Kiểm tra xem có file CSV được tải lên không
        if (isset($_FILES['csvFile']) && $_FILES['csvFile']['error'] == 0) {
            $fileName = $_FILES['csvFile']['tmp_name'];
            // Mở file CSV
            if (($handle = fopen($fileName, 'r')) !== FALSE) {
                // Đọc tiêu đề (nếu có)
                fgetcsv($handle);
    
                // Đọc từng dòng dữ liệu
                while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                    $maLop = trim($data[0]);  // Lấy mã lớp từ file CSV
                    $tenLop = trim($data[1]); // Lấy tên lớp từ file CSV
                    $ghiChu = trim($data[2]); // Lấy ghi chú từ file CSV
    
                    // Kiểm tra xem mã lớp đã tồn tại chưa
                    $sql_kiemtra = "SELECT * FROM lophoc WHERE maLop = '$maLop' AND isDeleted = 0";
                    $result = mysqli_query($conn, $sql_kiemtra);
    
                    if (mysqli_num_rows($result) == 0) {
                        // Nếu mã lớp chưa tồn tại, thêm lớp
                        $sql_them = "INSERT INTO lophoc (maLop, tenLop, ghiChu) VALUES ('$maLop', '$tenLop', '$ghiChu')";
                        mysqli_query($conn, $sql_them);
                    } else {
                        echo "Mã lớp $maLop đã tồn tại!<br>";
                    }
                }
    
                // Đóng file CSV
                fclose($handle);
    
                echo "<script>
                    alert('Thêm dữ liệu từ file CSV thành công!');
                    window.location.href = '../../index.php?action=qllop&query=lietke';
                </script>";
            } else {
                echo "<script>alert('Không thể mở file CSV.');</script>";
            }
        }else{
            $sql_kiemtra = "SELECT * FROM lophoc WHERE maLop = '$ma' AND isDeleted = 0";
            $result = mysqli_query($conn, $sql_kiemtra);
            
            // Nếu mã lớp chưa tồn tại thì thực hiện thêm lớp
            $sql_them = "INSERT INTO lophoc (maLop, tenLop, ghiChu) VALUES ('$ma', '$ten', '$ghichu')";
            
            if (mysqli_num_rows($result) > 0) {
                // Nếu mã lớp đã tồn tại
                echo "<script>
                    alert('Mã lớp đã tồn tại. Vui lòng nhập mã khác!');
                    window.location.href = '../../index.php?action=qllop&query=them';
                </script>";
            } else {
                if (mysqli_query($conn, $sql_them)) {
                    echo "<script>
                        alert('Thêm lớp thành công!');
                        window.location.href = '../../index.php?action=qllop&query=lietke';
                    </script>";
                } else {
                    echo "<script>
                        alert('Có lỗi xảy ra khi thêm lớp!');
                        window.location.href = '../../index.php?action=qllop&query=lietke';
                    </script>";
                }
            }
        }
    } elseif (isset($_POST['edit'])) {
        // Lấy dữ liệu lớp học cũ nếu trường nào bỏ trống hoặc chỉ có khoảng trắng
        $sql_get_old = "SELECT * FROM lophoc WHERE maLop = '$_GET[malop]' AND isDeleted = 0";
        $result_old = mysqli_query($conn, $sql_get_old);
        $row_old = mysqli_fetch_assoc($result_old);

        // Nếu dữ liệu mới trống hoặc chỉ có khoảng trắng, lấy giá trị cũ
        $ten = (!empty($ten) && !preg_match("/^\s+$/", $ten)) ? $ten : $row_old['tenLop'];
        $ghichu = (!empty($ghichu) && !preg_match("/^\s+$/", $ghichu)) ? $ghichu : $row_old['ghiChu'];

        // Cập nhật thông tin lớp
        $sql_update = "UPDATE lophoc SET tenLop = '$ten', ghiChu = '$ghichu' WHERE maLop = '$_GET[malop]'";
        mysqli_query($conn, $sql_update);
        header('location: ../../index.php?action=qllop&query=lietke');
    } elseif (!$valid) {
        echo "<script>
            alert('$error');
            window.location.href = '../../index.php?action=qllop&query=them';
        </script>";
    } else {
        $IdClass = $_GET['malop'];
        // Kiểm tra xem có sinh viên nào trong lớp không
        $QueryStudentClass = "SELECT * FROM sinhvien WHERE maLop ='$IdClass' AND isDeleted = 0";
        $result = mysqli_query($conn, $QueryStudentClass);

        // Kiểm tra nếu người dùng đã xác nhận xóa
        if (isset($_GET['confirm']) && $_GET['confirm'] == 'yes') {
            // Cập nhật trạng thái isDeleted cho lớp và sinh viên
            $DeleteQuery = "UPDATE sinhvien SET isDeleted = 1 WHERE maLop = '$IdClass'; 
                            UPDATE lophoc SET isDeleted = 1 WHERE maLop = '$IdClass'";
            if (mysqli_multi_query($conn, $DeleteQuery)) {
                echo "<script>
                    alert('Xóa lớp và sinh viên thành công.');
                    window.location.href = '../../index.php?action=qllop&query=lietke';
                </script>";
            } else {
                echo "<script>
                    alert('Có lỗi xảy ra khi thực hiện delete.');
                    window.location.href = '../../index.php?action=qllop&query=lietke';
                </script>";
            }
            exit();
        }

        // Nếu lớp có sinh viên, hỏi người dùng xem có muốn xóa không
        if (mysqli_num_rows($result) > 0) {
            echo "<script>
                var confirmDelete = confirm('Lớp này có sinh viên. Bạn có chắc chắn muốn xóa cả lớp và sinh viên không?');
                if (confirmDelete) {
                    window.location.href = '?malop=$IdClass&confirm=yes';
                } else {
                    window.location.href = '../../index.php?action=qllop&query=lietke';
                }
            </script>";
        } else {
            // Nếu không có sinh viên, chỉ xóa lớp
            $DeleteQuery = "UPDATE lophoc SET isDeleted = 1 WHERE maLop = '$IdClass'";
            if (mysqli_query($conn, $DeleteQuery)) {
                echo "<script>
                    alert('Xóa lớp thành công.');
                    window.location.href = '../../index.php?action=qllop&query=lietke';
                </script>";
            } else {
                echo "<script>
                    alert('Có lỗi xảy ra khi xóa lớp.');
                    window.location.href = '../../index.php?action=qllop&query=lietke';
                </script>";
            }
        }
    }

    // Đóng kết nối
    $conn->close();
?>
