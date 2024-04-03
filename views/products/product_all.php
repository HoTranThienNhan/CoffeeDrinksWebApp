<?php $this->layout("layouts/default", ["title" => APPNAME]) ?>

<?php $this->start("page") ?>
<div class="container-fluid page-header h-100 pt-5 fs-5" style="background-color:#c9b8ff;">
    <marquee class="my-3 neonText" behavior=”alternate”>Giao hàng toàn quốc Highlight Coffee® giao hàng toàn quốc, không giới hạn giá trị đơn hàng.</marquee>
</div>

<div class="container py-5">
    <div class="row">
        <div class="col-12 col-sm-3">
            <div class="card bg-light mb-3">
                <div class="card-header bg-primary text-white fw-bold"><i class="fa fa-list"></i> THỰC ĐƠN </div>
                <ul class="list-group category_block">
                    <form action="/product" method="POST">
                        <li class="list-group-item"><button class="btn productBtn <?= isset($_POST['sale']) ? 'active' : ''; ?>" name="sale">Khuyến Mãi HOT <?= isset($_POST['sale']) ? '<span class="fs-3"> 🔥</span>' : ''; ?></button></li>
                        <li class="list-group-item"><button class="btn productBtn <?= isset($_POST['cafe']) ? 'active' : ''; ?>" name="cafe">Cà Phê <?= isset($_POST['cafe']) ? '<span class="fs-3">🧋</span>' : ''; ?></button></li>
                        <li class="list-group-item"><button class="btn productBtn <?= isset($_POST['tra']) ? 'active' : ''; ?>" name="tra">Trà <?= isset($_POST['tra']) ? '<span class="fs-4"> 🍃</span>' : ''; ?></button></li>
                        <li class="list-group-item"><button class="btn productBtn <?= isset($_POST['khac']) ? 'active' : ''; ?>" name="khac">Cà Phê Đóng Gói <?= isset($_POST['khac']) ? '<span class="fs-4"> ☕</span>' : ''; ?></button></li>
                        <li class="list-group-item"><button class="btn productBtn <?= isset($_POST['all']) ? 'active' : ''; ?>" name="all">Tất Cả Sản Phẩm <?= isset($_POST['all']) ? '<span class="fs-4"> 🌈</span>' : ''; ?></button></li>
                    </form>
                </ul>
            </div>
            <div class="card bg-light mb-3">
                <div class="card-header bg-primary text-white fw-bold"><i class="fa fa-list"></i> SẮP XẾP THEO </div>
                <ul class="list-group category_block">
                    <form class="text-right" role="search" action="/product" method="POST">
                        <select class="form-select form-select-sm w-75 my-3 mx-2" style="display: inline" name="sort">
                            <option selected>Giá</option>
                            <option value="1">Giá: Thấp đến Cao</option>
                            <option value="2">Giá: Cao đến Thấp</option>
                            <option value="3">Sản phẩm mới nhất</option>
                        </select>
                        <button type="submit" name="filter" class="btn btn-primary btn-sm my-2 mt-1">Lọc</button>
                    </form>
                </ul>
            </div>
        </div>
        <div class="col">
            <div class="row" id='product'>
                <?php
                if (isset($products)) {
                    foreach ($products as $product) {
                        echo '<div class="col-sm-6 col-md-6 col-lg-4 mb-3">';
                        if ($product->khuyen_mai > 0) echo '<div class="badge">' . $product->khuyen_mai . '% </div>';
                        echo
                        '<div class="card">
                            <a href="/detail?masp=' . $product->ma_san_pham . '"><img class="card-img-top" src="img/product/';
                        echo $product->hinh_anh . '" width="100%" ></a>';
                        echo '<div class="card-body text-center">
                                <h5 class="card-title"><a class="fw-bold" style="color:#af5329" href="/detail?masp=' . $product->ma_san_pham . '">' . $product->ten_san_pham . '</a></h5>
                                <div class="row">
                                <div class="col p-0">
                                <p style="color:#af5329" class="fw-bold"> 💵' . number_format($product->gia_san_pham * (100 - $product->khuyen_mai) / 100, 0, '.', ',') . ' VNĐ</p></div>';
                        if ($product->khuyen_mai > 0) echo '<div class="col p-0"><span class="text-primary"><del>' . number_format($product->gia_san_pham, 0, '.', ',') . ' VNĐ</del></span></div>';
                        echo '</div><form  action="/addCart" method="POST"><input type="hidden" value="1"  name="so-luong">
                        <input type="hidden" name="masp" value="' .$product->ma_san_pham . '">
                         <button class="btn btn-link"><i class="fa fa-plus-circle" style="color:#ec4276; font-size:24px;"></i></button></form></div></div></div>';
                    }
                } ?>

                <!-- <div class="card">
                        
                    </div> -->
            </div>
        </div>
    </div>

</div>

<?php $this->stop() ?>