<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <link rel="stylesheet" type="text/css" href="../css/login.css">
    <title>Login</title>
</head>
<body>
<?php
    session_start();
    include('./connect.php');

    if(isset($_POST['dangnhap'])){
        $taikhoan = $_POST['username'];
        $matkhau = md5($_POST['password']);

        // Kiểm tra tài khoản trong bảng admin
        $sql_admin = "SELECT * FROM admin WHERE username='$taikhoan' AND password='$matkhau' LIMIT 1";
        $result_admin = mysqli_query($conn, $sql_admin);
        if(mysqli_num_rows($result_admin) > 0) {
            $_SESSION['dangnhap'] = $taikhoan;
            echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Đăng nhập thành công',
                    text: 'Bạn đang đăng nhập bằng tài khoản admin!',
                    allowOutsideClick: false
                }).then(function() {
                    window.location = 'index.php';
                });
            </script>";
        } else {
            // Kiểm tra tài khoản trong bảng user
            $sql_user = "SELECT * FROM user WHERE taikhoan='$taikhoan' AND matkhau='$matkhau' AND isDeleted = 0 LIMIT 1";
            $result_user = mysqli_query($conn, $sql_user);
            if(mysqli_num_rows($result_user) > 0) {
                $row_user = mysqli_fetch_assoc($result_user);
                $loaitk = $row_user['loaitk'];
                $_SESSION['dangnhap'] = $taikhoan;
                if($loaitk == 0) {
                    echo "<script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Đăng nhập thành công',
                            text: 'Bạn đang đăng nhập bằng tài khoản sinh viên!',
                            allowOutsideClick: false
                        }).then(function() {
                            window.location = 'index.php';
                        });
                    </script>";
                } elseif($loaitk == 1) {
                    echo "<script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Đăng nhập thành công',
                            text: 'Bạn đang đăng nhập bằng tài khoản giảng viên!',
                            allowOutsideClick: false
                        }).then(function() {
                            window.location = 'index.php';
                        });
                    </script>";
                }
            } else {
                $error_message = 'Tài khoản hoặc mật khẩu không hợp lệ !';
            }
        }
    }
?>

<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="login-form">
                    <h3 class="text-center mb-4">Đăng nhập</h3>
                    <form action="login.php" method="POST">
                        <?php if (!empty($error_message)): ?>
                            <div class="alert alert-danger" role="alert">
                                <strong>Lỗi:</strong> <?= $error_message ?>
                            </div>
                        <?php endif; ?>
                        <div class="form-group">
                            <label for="username">Tên đăng nhập:</label>
                            <input id="username" type="text" class="form-control" name="username" placeholder="Tài khoản">
                        </div>
                        <div class="form-group">
                            <label for="password">Mật khẩu:</label>
                            <input id="password" type="password" class="form-control" name="password" placeholder="Mật khẩu">
                        </div>
                        <button type="submit" name="dangnhap" class="btn btn-primary btn-block">Đăng nhập</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
