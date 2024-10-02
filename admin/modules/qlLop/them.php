    <div class="card">
        <div class="card-header bg-secondary text-white text-center">
            <h3>Thêm Lớp</h3>
        </div>
        <div class="card-body">
            <form action="modules/qlLop/xuly.php" method="POST">
                <div class="form-group">
                    <label for="categoryName">Mã Lớp:</label>
                    <input type="text" class="form-control" name="txtMa" placeholder="Nhập mã lớp" required>
                </div>
                <div class="form-group">
                    <label for="categoryName">Tên Lớp:</label>
                    <input type="text" class="form-control" name="txtTen" placeholder="Nhập tên lớp" required>
                </div>
                <div class="form-group">
                    <label for="categoryName">Ghi Chú:</label>
                    <input type="text" class="form-control" name="txtghichu" placeholder="Nhập ghi chú" required>
                </div>
                <div class="form-group">
                    <input class="btn btn-sm btn-success" type="submit" name="add" value="Thêm">
                </div>
            </form>
        </div>
    </div>