<?php 
    include("./connect.php");

    // Lấy dữ liệu từ form
    $username = isset($_POST["username"]) ? trim($_POST["username"]) : '';
    $password = isset($_POST["password"]) ? trim($_POST["password"]) : '';
    $type = 1;
    
    if (isset($_POST['dangky'])) {

        // Kiểm tra xem username đã tồn tại chưa
        $sql_check = "SELECT * FROM user WHERE taikhoan = '$username'";
        $result_check = mysqli_query($conn, $sql_check);

        if (mysqli_num_rows($result_check) > 0) {
            // Nếu tên tài khoản đã tồn tại
            echo "<script>
            alert('Tên tài khoản đã tồn tại. Vui lòng chọn tên khác!');
            window.location.href = 'index.php';
            </script>";
        } else {
            // Insert into user with hashed password
            $matkhau_macdinh = password_hash($password, PASSWORD_DEFAULT); // Mã hóa mật khẩu
            $sql_taikhoan = "INSERT INTO user (taikhoan, matkhau, loaitk) VALUES ('$username', '$matkhau_macdinh', $type)";

            if (mysqli_query($conn, $sql_taikhoan)) {
                // Nếu thêm thành công, trả về thông báo success
                echo "<script>
                alert('Đăng ký thành công!');
                window.location.href = 'index.php';
                </script>";
            } else {
                // Nếu có lỗi xảy ra trong quá trình thêm
                echo "<script>
                alert('Đã xảy ra lỗi khi đăng ký. Vui lòng thử lại!');
                window.location.href = 'index.php?action=taotk&query=giangvien';
                </script>";
            }
        }
    }
?>
