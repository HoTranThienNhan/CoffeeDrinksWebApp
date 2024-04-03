<?php $this->layout("layouts/default", ["title" => APPNAME]) ?>
<?php $this->start("page") ?>

<main>
    <div class="container mb-5">

        <div class="row pt-5 ">
            <div class="col-sm-12 col-md-12 col-lg-6 text-center">
                <img width="80%" src="img/product/<?php echo $product->hinh_anh ?>" />
            </div>
            <div class="col-sm-10 col-md-12 col-lg-5 pb-2 mt-5">
                <h1 class="pb-3 mb-3"><?= $product->ten_san_pham ?></h1>
                <div class="row">
                    <h4 class="col-4 text-danger"><?= number_format($product->gia_khuyen_mai, 0, '.', ',') ?> VNĐ</h4>
                    <del class="col mt-1 p-0 text-secondary"><?= number_format($product->gia_san_pham, 0, '.', ',') ?>VNĐ</del>
                </div>

                <p><?= $product->mo_ta_san_pham ?></p>
                <hr>

                <div class="row">
                    <p class="fw-bold col-3">SỐ LƯỢNG</p>
                    <p class="col px-0 text-muted">Kho: <?= $product->so_luong ?></p>
                </div>
                
                <form action="/addCart" method="POST">
                    <div><input class="col-2 text-center" type="number" value="1" min="1" max="<?= $product->so_luong ?>" name="so-luong"> </div>
                    <input class=" btn btn-danger col-6 mt-3" type="submit" name="addCart" value="THÊM VÀO GIỎ HÀNG"></input>
                    <input type="hidden" name="masp" value="<?= $product->ma_san_pham ?>">
                </form>

            </div>
        </div>
    </div>
</main>
<?php $this->stop() ?>