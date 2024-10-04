<?php
	include("../../connect.php");

	//Lấy dữ liệu từ form
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

	if(isset($_POST['add']) && $valid) {
        $sql_kiemtra = "SELECT * FROM lophoc WHERE maLop = '$ma'";
        $result = mysqli_query($conn, $sql_kiemtra);
        // Nếu mã lớp chưa tồn tại thì thực hiện thêm lớp
        $sql_them = "INSERT INTO lophoc (maLop, tenLop, ghiChu) VALUES ('$ma', '$ten', '$ghichu')";
        if(mysqli_num_rows($result) > 0) {
            // Nếu mã lớp đã tồn tại
            echo "<script>
            alert('Mã lớp đã tồn tại. Vui lòng nhập mã khác!');
            window.location.href = '../../index.php?action=qllop&query=them';
            </script>";
        } else {
            if(mysqli_query($conn, $sql_them)) {
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
    } elseif (isset($_POST['edit'])) {
        // Lấy dữ liệu lớp học cũ nếu trường nào bỏ trống hoặc chỉ có khoảng trắng
        $sql_get_old = "SELECT * FROM lophoc WHERE maLop = '$_GET[malop]'";
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
        $QueryStudentClass = "SELECT * FROM sinhvien WHERE maLop ='$IdClass'";
        $result = mysqli_query($conn, $QueryStudentClass);

        // Kiểm tra nếu người dùng đã xác nhận xóa
        if (isset($_GET['confirm']) && $_GET['confirm'] == 'yes') {
            // Nếu người dùng đã xác nhận, xóa lớp và sinh viên
            $DeleteQuery = "DELETE FROM sinhvien WHERE maLop = '$IdClass'; DELETE FROM lophoc WHERE maLop = '$IdClass'";
            if (mysqli_multi_query($conn, $DeleteQuery)) {
                echo "<script>
                    alert('Xóa lớp và sinh viên thành công.');
                    window.location.href = '../../index.php?action=qllop&query=lietke';
                </script>";
            } else {
                echo "<script>
                    alert('Có lỗi xảy ra khi xóa lớp và sinh viên.');
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
            $DeleteQuery = "DELETE FROM lophoc WHERE maLop = '$IdClass'";
            if (mysqli_query($conn, $DeleteQuery)) {
                echo "<script>
                    alert('Xóa lớp thành công.');
                    window.location.href     = '../../index.php?action=qllop&query=lietke';
                </script>";
            } else {
                echo "<script>
                    alert('Có lỗi xảy ra khi xóa lớp.');
                    window.location.href = '../../index.php?action=qllop&query=lietke';
                </script>";
            }
        }
    }

	//Đóng kết nối
	$conn->close();
?>
