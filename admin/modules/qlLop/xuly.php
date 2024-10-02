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
        $id = $_GET['malop'];
        $sql1 = " DELETE sinhvien
        FROM sinhvien
        JOIN lophoc ON sinhvien.maLop = lophoc.maLop
        WHERE lophoc.maLop = '$id'";

        mysqli_query($conn, $sql1);

        $sql2 = "DELETE FROM lophoc WHERE maLop = '$id'";
        mysqli_query($conn, $sql2);
         
        header('location: ../../index.php?action=qllop&query=lietke');
    }
	//Đóng kết nối
	$conn->close();
?>