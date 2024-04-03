<?php $this->layout("layouts/default", ["title" => APPNAME]) ?>

<?php $this->start("page") ?>
<div class="container">
    <section id="inner" class="inner-section section">
        <div class="container">

            <!-- SECTION HEADING -->
            <h2 class="section-heading text-center wow fadeIn text-uppercase my-3" data-wow-duration="1s">Cập nhật sản phẩm</h2>
            <div class="row">
                <div class="col-md-6 col-md-offset-3 text-center">
                    <p class="wow fadeIn" data-wow-duration="2s"></p>
                </div>
            </div>

            <div class="inner-wrapper row">
                <div class="col-md-12 d-flex justify-content-center">

                    <form name="frm" id="frm" action="/manage/update/<?= $this->e($product->ma_san_pham) ?>" method="post" class="col-md-6 col-md-offset-3 p-5 mb-5 bg-body border border-2" enctype="multipart/form-data">

                        <!-- Name -->
                        <div class="form-group mb-3<?= isset($errors['ten_san_pham']) ? ' has-error' : '' ?>">
                            <label class="fw-bold" for="name">Tên Sản Phẩm</label>
                            <input type="text" name="ten_san_pham" class="form-control border border-1 border-secondary" maxlen="255" id="name" placeholder="Nhập tên" value="<?= isset($old_value['ten_san_pham']) ? $this->e($old_value['ten_san_pham']) : $this->e($product->ten_san_pham) ?>" style="background-color: #F3F6FF;" />

                            <?php if (isset($errors_update['ten_san_pham'])) : ?>
                                <span class="help-block text-danger">
                                    <strong><?= $this->e($errors_update['ten_san_pham']) ?></strong>
                                </span>
                            <?php endif ?>
                        </div>

                        <!-- Price -->
                        <div class="form-group mb-3<?= isset($errors['gia_san_pham']) ? ' has-error' : '' ?>">
                            <label class="fw-bold" for="price">Giá Sản Phẩm</label>
                            <input type="number" name="gia_san_pham" class="form-control border border-1 border-secondary" id="price" placeholder="Nhập giá" value="<?= isset($old_value['gia_san_pham']) ? $this->e($old_value['gia_san_pham']) : $this->e($product['gia_san_pham']) ?>" style="background-color: #F3F6FF;" />

                            <?php if (isset($errors['gia_san_pham'])) : ?>
                                <span class="help-block text-danger">
                                    <strong><?= $this->e($errors['gia_san_pham']) ?></strong>
                                </span>
                            <?php endif ?>
                        </div>

                        <!-- Quantity -->
                        <div class="form-group mb-3<?= isset($errors['so_luong']) ? ' has-error' : '' ?>">
                            <label class="fw-bold" for="quantity">Số Lượng Sản Phẩm</label>
                            <input type="number" name="so_luong" class="form-control border border-1 border-secondary" id="quantity" placeholder="Nhập số lượng" value="<?= isset($old_value['so_luong']) ? $this->e($old_value['so_luong']) : $this->e($product['so_luong']) ?>" style="background-color: #F3F6FF;" />

                            <?php if (isset($errors['so_luong'])) : ?>
                                <span class="help-block text-danger">
                                    <strong><?= $this->e($errors['so_luong']) ?></strong>
                                </span>
                            <?php endif ?>
                        </div>

                        <!-- Discount Percent -->
                        <div class="form-group mb-3<?= isset($errors['khuyen_mai']) ? ' has-error' : '' ?>">
                            <label class="fw-bold" for="discount-percent">Phần Trăm Khuyến Mãi (%)</label>
                            <input type="number" name="khuyen_mai" class="form-control border border-1 border-secondary" id="discount-percent" placeholder="Nhập phần trăm khuyến mãi" value="<?= isset($old_value['khuyen_mai']) ? $this->e($old_value['khuyen_mai']) : $this->e($product['khuyen_mai']) ?>" style="background-color: #F3F6FF;" />

                            <?php if (isset($errors['khuyen_mai'])) : ?>
                                <span class="help-block text-danger">
                                    <strong><?= $this->e($errors['khuyen_mai']) ?></strong>
                                </span>
                            <?php endif ?>
                        </div>

                        <!-- Image -->
                        <div class="form-group mb-3<?= isset($errors['hinh_anh']) ? ' has-error' : '' ?>">
                            <label class="fw-bold" for="image">Ảnh Sản Phẩm</label>
                            <input type="file" name="hinh_anh" class="form-control border border-1 border-secondary" id="image" placeholder="Nhập ảnh" style="background-color: #F3F6FF;" />

                            <?php if (isset($errors['hinh_anh'])) : ?>
                                <span class="help-block text-danger">
                                    <strong><?= $this->e($errors['hinh_anh']) ?></strong>
                                </span>
                            <?php endif ?>
                        </div>
                        <div class="preview-image mb-3 border border-2" style="width: 110px">
                            <img src="/img/product/<?= $this->e($product['hinh_anh']) ?>" id="preview-image" width="100px">
                        </div>

                        <!-- Type -->
                        <div class="form-group mb-3<?= isset($errors['ma_loai_san_pham']) ? ' has-error' : '' ?>">
                            <label class="fw-bold" for="type">Mã Loại Sản Phẩm</label>
                            <select name="ma_loai_san_pham" class="form-select border border-1 border-secondary" id="type" style="background-color: #F3F6FF;">
                                <?php foreach ($loai_sp as $type) : ?>
                                    <option value="<?= isset($type['ma_loai_san_pham']) ? $this->e($type['ma_loai_san_pham']) : '' ?>" <?= isset($old_value['ma_loai_san_pham']) ? ($type['ma_loai_san_pham'] == $old_value['ma_loai_san_pham'] ? 'selected' : '')
                                                                                                                                            : ($type['ma_loai_san_pham'] == $product['ma_loai_san_pham'] ? 'selected' : '') ?>>
                                        <?= $this->e($type['ten_loai_san_pham']) ?>
                                    </option>
                                <?php endforeach ?>
                            </select>

                            <?php if (isset($errors['ma_loai_san_pham'])) : ?>
                                <span class="help-block text-danger">
                                    <strong><?= $this->e($errors['ma_loai_san_pham']) ?></strong>
                                </span>
                            <?php endif ?>
                        </div>


                        <!-- Description -->
                        <div class="form-group mb-3<?= isset($errors['mo_ta_san_pham']) ? ' has-error' : '' ?>">
                            <label class="fw-bold" for="description">Mô Tả Sản Phẩm </label>
                            <textarea name="mo_ta_san_pham" id="description" class="form-control border border-1 border-secondary" rows="4" placeholder="Nhập mô tả (tối đa: 500 ký tự)" style="background-color: #F3F6FF;"><?= isset($old_value['mo_ta_san_pham']) ? $this->e($old_value['mo_ta_san_pham']) : $this->e($product['mo_ta_san_pham']) ?></textarea>
                            <?php if (isset($errors['mo_ta_san_pham'])) : ?>
                                <span class="help-block text-danger">
                                    <strong><?= $this->e($errors['mo_ta_san_pham']) ?></strong>
                                </span>
                            <?php endif ?>
                        </div>

                        <!-- Submit -->
                        <button type="submit" name="submit" id="submit" class="btn btn-primary me-2">Cập Nhật</button>
                        <a href="/management" id="cancel-update" class="btn bg-secondary text-white fw-bold">Hủy</a>
                    </form>

                </div>
            </div>

        </div>
    </section>
</div>

<script>
    $(document).ready(function() {
        $('body').css('background-color', '#F3F6FF');
    });

    //Image Reader
    function readURL(input) {
        if (input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(event) {
                $('.preview-image').empty();
                $('.preview-image').append("<img src='" + event.target.result + "' id='preview-image' width='100px'>");
                $('.preview-image').addClass("border border-2");
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#image").change(function() {
        readURL(this);
    });
</script>
<?php $this->stop() ?>