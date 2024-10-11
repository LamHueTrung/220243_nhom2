<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <title>Login</title>
</head>
<body>
    <?php
        session_start();
        include('./connect.php');
        if(isset($_POST['dangnhap'])){
            $taikhoan = $_POST['username'];
            $matkhau = md5($_POST['password']);
            $sql = "SELECT * FROM admin WHERE username='".$taikhoan."' AND password='".$matkhau."' LIMIT 1";
            $row = mysqli_query($conn,$sql);
            $count = mysqli_num_rows($row);
            if($count>0){
                $_SESSION['dangnhap'] = $taikhoan;
                header("Location: index.php");
            }else{
                $error_message='Tài khoản hoặc mật khẩu không hợp lệ !';
            }
        }
    ?>
    <div class="container">
        <div class="row justify-content-center align-items-center" style="height: 100vh;">
            <div class="col-md-6 col-lg-4">
                <div class="card border-0 shadow-lg rounded-lg bg-light">
                    <div class="card-header bg-primary text-white text-center">
                    <h3 class="m-0">Đăng Nhập</h3>
                    </div>
                    <div class="card-body">
                        <form action="login.php" method="POST">
                            <?php if (!empty($error_message)): ?>
                                <div class="alert alert-danger" role="alert">
                                    <strong>ERROR:</strong> <?= $error_message ?>
                                </div>
                            <?php endif; ?>
                            <div class="form-group">
                                <label for="username">Tên đăng nhập:</label>
                                <input id="username" type="text" class="form-control" name="username" placeholder="Enter your username">
                            </div>
                            <div class="form-group">
                                <label for="password">Mật khẩu:</label>
                                <input id="password" type="password" class="form-control" name="password" placeholder="Enter your password">
                            </div>
                            <button type="submit" name="dangnhap" class="btn btn-primary btn-block">Đăng nhập</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>