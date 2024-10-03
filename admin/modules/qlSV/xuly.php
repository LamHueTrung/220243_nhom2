<?php
    include("../../connect.php");

	$masv = $_POST["txtmasv"];
	$hosv = $_POST["txtho"];
	$tensv = $_POST["txtten"];
    $ngaysinh = $_POST["txtngaysinh"];
    $gioitinh = $_POST["txtgioitinh"];
    $email = $_POST["txtemail"];
    $sodienthoai = $_POST["txtsodienthoai"];
    $diachi = $_POST["txtdiachi"];
    $malop = $_POST["txtmalop"];

    $hinhanh = $_FILES['txthinhanh']['name'];
    $hinhanhtam = $_FILES['txthinhanh']['tmp_name'];

    if(isset($_POST['add'])){
        $sql_them = "INSERT INTO sinhvien (maSV, hoLot, tenSV, ngaySinh, gioiTinh, maLop, email, soDT, diaChi, hinhAnh)
        VALUES ('$masv', '$hosv', '$tensv', '$ngaysinh', '$gioitinh', '$malop', '$email', '$sodienthoai', '$diachi', '$hinhanh')";
        mysqli_query($conn, $sql_them);
        move_uploaded_file($hinhanhtam, 'image/' .$hinhanh);
        header('location: ../../index.php?action=qlsv&query=lietke');
    }elseif(isset($_POST['edit'])){
        $id = $_POST['masv'];  // Lấy masv từ POST
        if($hinhanh!=''){
            move_uploaded_file($hinhanhtam,'image/'.$hinhanh);
            $sql = "UPDATE sinhvien SET maSV = '$masv', hoLot = '$hosv', tenSV = '$tensv', ngaySinh = '$ngaysinh', gioiTinh = '$gioitinh', maLop = '$malop' , email = '$email', soDT = '$sodienthoai', diaChi = '$diachi' , hinhAnh = '$hinhanh' 
            WHERE maSV = '$id'";  
            $sql_slt = "SELECT * FROM sinhvien where maSV = '$id' LIMIT 1";
            $query = mysqli_query($conn, $sql_slt);
            while($row = mysqli_fetch_array($query)){
                unlink('image/'.$row['hinhAnh']);
            }
        }else{
            $sql = "UPDATE sinhvien SET maSV = '$masv', hoLot = '$hosv', tenSV = '$tensv', ngaySinh = '$ngaysinh', gioiTinh = '$gioitinh', maLop = '$malop' , email = '$email', soDT = '$sodienthoai', diaChi = '$diachi'
            WHERE maSV = '$id' ";
        }
        mysqli_query($conn, $sql);
        header('location: ../../index.php?action=qlsv&query=lietke');
    }else{
        $id = $_GET['masv'];
        $sql = "SELECT * FROM sinhvien WHERE maSV = '$id' LIMIT 1";
        $query = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_array($query)){
            unlink('image/'.$row['hinhAnh']);
        }
        $sql_xoa = "DELETE FROM sinhvien WHERE maSV = $id";
        mysqli_query($conn, $sql_xoa);
        header('location: ../../index.php?action=qlsv&query=lietke');
    }
    //Đóng kết nối
	$conn->close();
?>