<?php $this->layout("layouts/default", ["title" => APPNAME]) ?>

<?php $this->start("page") ?>

<main class="container text-center pb-5">
    <div class=" py-4">
        <img src="/img/done.png" width="200px" alt="">
    </div>
    <div class="py-2">
        <h4 class="fw-bold my-2">Đăng ký mua hàng thành công</h4>
        <p>Cảm ơn quý khách đã gửi đăng ký mua hàng đến Highlight Coffee</p>
    </div>
    <div style="padding-left: 280px; padding-right: 280px">
        <p>Bộ phận phụ trách sẽ liên hệ cho anh (chị) trong thời gian sớm nhất có thể. Trong trường hợp khẩn cấp
            vui lòng gọi đến Hotline: <b class="text-danger">1900 86 86 86</b></p>
        <p>Chân thành cảm ơn!</p>
    </div>
    <a href="/payHistory" class="btn btn-primary">Xem Hóa Đơn</a>
</main>
<?php $this->stop() ?>