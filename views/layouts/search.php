<?php $this->layout("layouts/default", ["title" => APPNAME]) ?>

<?php $this->start("page") ?>

<main class="container">
    <?php
    echo '<h4 class="ps-5 my-5">Kết quả tìm kiếm từ khóa "' . $_POST['search'] . '": </h4>';
    echo '<div class="row m-0">';
    foreach ($result as $rs) {
        echo '<div class="col-sm-6 col-md-6 col-lg-4 mb-3">';
        if ($rs->khuyen_mai > 0) echo '<div class="badge">' . $rs->khuyen_mai . '% </div>';
        echo
        '<div class="card">
                            <a href="/detail?masp=' . $rs->ma_san_pham . '"><img class="card-img-top" src="img/product/';
        echo $rs->hinh_anh . '" width="100%" ></a>';
        echo '<div class="card-body text-center">
                                <h5 class="card-title"><a class="fw-bold" style="color:#af5329" href="/detail?masp=' . $rs->ma_san_pham . '">' . $rs->ten_san_pham . '</a></h5>
                                <div class="row">
                                <div class="col p-0">
                                <p style="color:#af5329" class="fw-bold"> 💵' . number_format($rs->gia_san_pham * (100 - $rs->khuyen_mai) / 100, 0, '.', ',') . ' VNĐ</p></div>';
        if ($rs->khuyen_mai > 0) echo '<div class="col p-0"><span class="text-primary"><del>' . number_format($rs->gia_san_pham, 0, '.', ',') . ' VNĐ</del></span></div>';
        echo '</div><button class="btn btn-link"><i class="fa fa-plus-circle" style="color:#ec4276; font-size:24px;"></i></button></div></div></div>';
    }
    ?>

</main>
<?php $this->stop() ?>