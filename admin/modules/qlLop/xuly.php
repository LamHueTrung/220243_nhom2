<?php
	include("../../connect.php");

	//Lấy dữ liệu từ form
	$ma = $ten = $ghichu =  "";
	if(!empty($_POST["txtMa"])&&!empty($_POST["txtTen"])&&!empty($_POST["txtghichu"]))
	{
		$ma = $_POST["txtMa"];
		$ten = $_POST["txtTen"];
		$ghichu = $_POST["txtghichu"];
	}
	if(isset($_POST['add'])){
        $sql_them = "INSERT INTO lophoc (maLop, tenLop, ghiChu)VALUES ('$ma', '$ten', '$ghichu')";
        mysqli_query($conn, $sql_them);
        header('location: ../../index.php?action=qllop&query=lietke');
    }elseif(isset($_POST['edit'])){
        $sql = "UPDATE lophoc SET  tenLop = '$ten', ghiChu = '$ghichu'
            Where maLop = '$_GET[malop]'";
            mysqli_query($conn, $sql);
            header('location: ../../index.php?action=qllop&query=lietke');
    }else{
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


        // $id = $_GET['malop'];
        // $sql1 = " DELETE sinhvien
        // FROM sinhvien
        // JOIN lophoc ON sinhvien.maLop = lophoc.maLop
        // WHERE lophoc.maLop = '$id'";

        // mysqli_query($conn, $sql1);

        // $sql2 = "DELETE FROM lophoc WHERE maLop = '$id'";
        // mysqli_query($conn, $sql2);
         
        // 
    }
	//Đóng kết nối
	$conn->close();
?>