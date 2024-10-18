<div class="content">
    <?php
        if(isset($_GET['action']) && $_GET['query']){
            $tam = $_GET['action'];
            $query = $_GET['query'];
        }else{
            $tam = '';
            $query = '';
        }
        if($tam == 'qllop' && $query == 'lietke'){
            include('modules/qlLop/lietke.php');
        }elseif($tam == 'qllop' && $query == 'them'){
            include('modules/qlLop/them.php');
        }elseif($tam == 'qllop' && $query == 'sua'){
            include('modules/qlLop/sua.php');
        }elseif($tam == 'qlsv' && $query == 'lietke'){
            include('modules/qlSV/lietke.php');
        }elseif($tam == 'qlsv' && $query == 'them'){
            include('modules/qlSV/them.php');
        }elseif($tam == 'qlsv' && $query == 'sua'){
            include('modules/qlSV/sua.php');
        }elseif($tam == 'qllop' && $query == 'showup'){
            include('modules/qlLop/showup.php');
        }elseif($tam == 'qlsv' && $query == 'thongtin'){
            include('modules/qlSV/thongtinchitiet.php');
        }elseif($tam == 'mautinrac' && $query == 'rac'){
            include('modules/backup/deleted.php');        
        }elseif($tam == 'taotk' && $query == 'giangvien' ){
            include('../admin/signup.php');
        }
    ?>
</div>