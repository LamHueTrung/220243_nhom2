<?php
include("../../connect.php");

if (isset($_GET['maSV'])) {
    // khôi phục sinh viên
    $maSV = $_GET['maSV'];

    $sql_sinhvien = "SELECT * FROM sinhvien WHERE maSV = '$maSV' AND isDeleted = 1";
    $query_sinhvien = mysqli_query($conn, $sql_sinhvien);
    $row_sinhvien = mysqli_fetch_assoc($query_sinhvien);

    if ($row_sinhvien) {
        $maLop = $row_sinhvien['maLop'];

        $sql_lop = "SELECT * FROM lophoc WHERE maLop = '$maLop' AND isDeleted = 0";
        $query_lop = mysqli_query($conn, $sql_lop);

        if (mysqli_num_rows($query_lop) > 0) {
            // Khôi phục sinh viên
            $sql_khoiphuc = "UPDATE sinhvien SET isDeleted = 0 WHERE maSV = '$maSV'";
            mysqli_query($conn, $sql_khoiphuc);
            echo "<script>alert('Khôi phục sinh viên thành công!'); window.location.href='../../index.php?action=mautinrac&query=rac';</script>";
        } else {
            echo "<script>alert('Mã lớp của sinh viên đã bị xóa. Bạn vui lòng khôi phục lớp trước!'); window.location.href='../../index.php?action=mautinrac&query=rac';</script>";
        }
    } else {
        echo "<script>alert('Sinh viên không tồn tại hoặc đã được khôi phục!'); window.location.href='../../index.php?action=mautinrac&query=rac';</script>";
    }
} elseif (isset($_GET['maLop'])) {
    //khôi phục lớp học
    $maLop = $_GET['maLop'];

    $sql_lop = "SELECT * FROM lophoc WHERE maLop = '$maLop' AND isDeleted = 1";
    $query_lop = mysqli_query($conn, $sql_lop);
    $row_lop = mysqli_fetch_assoc($query_lop);

    if ($row_lop) {
        $sql_khoiphuc = "UPDATE lophoc SET isDeleted = 0 WHERE maLop = '$maLop'";
        mysqli_query($conn, $sql_khoiphuc);
        echo "<script>alert('Khôi phục lớp học thành công!'); window.location.href='../../index.php?action=mautinrac&query=rac';</script>";
    }
}
?>
