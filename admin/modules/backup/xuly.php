<?php
    include("../../connect.php");

    if (isset($_GET['maSV'])) {
        // Xử lý xóa sinh viên
        $maSV = $_GET['maSV'];

        if (isset($_GET['action']) && $_GET['action'] == 'delete') {
            // Xác nhận xóa sinh viên
            $sql = "SELECT * FROM sinhvien WHERE maSV = '$maSV' LIMIT 1";
            $query = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_array($query)) {
                unlink('../qlSV/image/' . $row['hinhAnh']);
            }
            $sql_delete_sinhvien = "DELETE FROM sinhvien WHERE maSV = $maSV";
            $sql_delete_taikhoan = "DELETE FROM user WHERE taikhoan = $maSV";
            $sql_delete_diachi = "DELETE FROM province WHERE id = $maSV";
            mysqli_query($conn, $sql_delete_sinhvien);
            mysqli_query($conn, $sql_delete_taikhoan);
            mysqli_query($conn, $sql_delete_diachi);
            echo "<script>alert('Xóa sinh viên thành công!'); window.location.href='../../index.php?action=mautinrac&query=rac';</script>";
        } else {
            // Khôi phục sinh viên
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
                    $sql_khoiphuc_taikhoan = "UPDATE user SET isDeleted = 0 WHERE taikhoan = '$maSV'";
                    mysqli_query($conn, $sql_khoiphuc);
                    mysqli_query($conn, $sql_khoiphuc_taikhoan);
                    echo "<script>alert('Khôi phục sinh viên thành công!'); window.location.href='../../index.php?action=qlsv&query=lietke';</script>";
                } else {
                    echo "<script>alert('Mã lớp của sinh viên đã bị xóa. Bạn vui lòng khôi phục lớp trước!'); window.location.href='../../index.php?action=mautinrac&query=rac';</script>";
                }
            } else {
                echo "<script>alert('Sinh viên không tồn tại hoặc đã được khôi phục!'); window.location.href='../../index.php?action=mautinrac&query=rac';</script>";
            }
        }
    } elseif (isset($_GET['maLop'])) {
        // Xử lý xóa hoặc khôi phục lớp học
        $maLop = $_GET['maLop'];

        if (isset($_GET['action']) && $_GET['action'] == 'delete') {
            // Kiểm tra xem lớp học còn sinh viên hay không
            $sql_kiemtra_sinhvien = "SELECT * FROM sinhvien WHERE maLop = '$maLop'";
            $query_kiemtra_sinhvien = mysqli_query($conn, $sql_kiemtra_sinhvien);

            if (mysqli_num_rows($query_kiemtra_sinhvien) > 0) {
                // Nếu còn sinh viên trong lớp
                echo "<script>
                        if (confirm('Lớp học này đang có sinh viên. Bạn có chắc muốn xóa tất cả sinh viên và lớp học này không?')) {
                            window.location.href = 'xuly.php?action=deleteAll&maLop=$maLop';
                        } else {
                            window.location.href = '../../index.php?action=qlsv&query=lietke';
                        }
                    </script>";
            } else {
                // Xóa lớp học nếu không còn sinh viên
                $sql_delete_lop = "DELETE FROM lophoc WHERE maLop = '$maLop'";
                mysqli_query($conn, $sql_delete_lop);
                echo "<script>alert('Xóa lớp học thành công!'); window.location.href='../../index.php?action=mautinrac&query=rac';</script>";
            }
        } elseif (isset($_GET['action']) && $_GET['action'] == 'deleteAll') {
            // Xóa tất cả sinh viên trong lớp và lớp học
            $sql_delete_sinhvien = "DELETE FROM sinhvien WHERE maLop = '$maLop'";
            mysqli_query($conn, $sql_delete_sinhvien);
            // Xoá tài khoản
            $sql_getbyIdClass = "SELECT maSV FROM sinhvien WHERE maLop = '$maLop'"; // Đảm bảo $maLop là chuỗi hoặc số hợp lệ
            $query = mysqli_query($conn, $sql_getbyIdClass);

            // Kiểm tra xem truy vấn có thành công không
            if (!$query) {
                die("Lỗi truy vấn SQL: " . mysqli_error($conn)); // Hiển thị lỗi chi tiết
            }

            // Tiếp tục xử lý nếu truy vấn thành công
            while ($row = mysqli_fetch_assoc($query)) {
                $id = $row['maSV']; // Chú ý: maSV phải chính xác với tên cột trong cơ sở dữ liệu
                $sql_delete_taikhoan = "DELETE FROM user WHERE taikhoan = '$id'";
                mysqli_query($conn, $sql_delete_taikhoan);
            }

            $sql_delete_lop = "DELETE FROM lophoc WHERE maLop = '$maLop'";
            mysqli_query($conn, $sql_delete_lop);
            echo "<script>alert('Xóa tất cả sinh viên và lớp học thành công!'); window.location.href='../../index.php?action=mautinrac&query=rac';</script>";
        } else {
            // Khôi phục lớp học
            $sql_lop = "SELECT * FROM lophoc WHERE maLop = '$maLop' AND isDeleted = 1";
            $query_lop = mysqli_query($conn, $sql_lop);
            $row_lop = mysqli_fetch_assoc($query_lop);

            if ($row_lop) {
                $sql_khoiphuc = "UPDATE lophoc SET isDeleted = 0 WHERE maLop = '$maLop'";
                mysqli_query($conn, $sql_khoiphuc);
                echo "<script>alert('Khôi phục lớp học thành công!'); window.location.href='../../index.php?action=mautinrac&query=rac';</script>";
            }
        }
    }
?>
