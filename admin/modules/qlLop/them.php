    <div class="card">
        <div class="card-header bg-secondary text-white text-center">
            <h3>Thêm Lớp</h3>
        </div>
        <div class="card-body">
            <form action="modules/qlLop/xuly.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="categoryName">Mã Lớp:</label>
                    <input type="text" class="form-control" name="txtMa" placeholder="Nhập mã lớp" >
                </div>
                <div class="form-group">
                    <label for="categoryName">Tên Lớp:</label>
                    <input type="text" class="form-control" name="txtTen" placeholder="Nhập tên lớp" >
                </div>
                <div class="form-group">
                    <label for="categoryName">Ghi Chú:</label>
                    <input type="text" class="form-control" name="txtghichu" placeholder="Nhập ghi chú" >
                </div>
                <div class="form-group">
                    <input class="btn btn-sm btn-success" type="submit" name="add" value="Thêm">
                </div>
                <div class="form-group">
                    <label>Chọn file CSV:</label>
                    <input type="file" name="csvFile">
                    <input class="btn btn-sm btn-primary" type="submit" name="add" value="Thêm lớp">
                </div>
            </form>
        </div>
    </div>