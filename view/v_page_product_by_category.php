<div class="row mt-5">
    <div class="col-sm-1"></div>
    <div class="col-sm-10">
        <h1>Danh mục: <?= $list_product_by_category['0']['TenDM']?></h1>
    </div>
    <div class="col-sm-1"></div>
</div>
<div class="row mt-5">
    <div class="col-sm-1"></div>
    <div class="col-sm-10">
    </div>
    <div class="col-sm-1"></div>
</div>
<div class="row mt-5">
    <div class="col-sm-1"></div>
    <div class="col-sm-10">
        <div class="row">
            <?php foreach ($list_product_by_category as $data) : ?>
                <div class="col-sm-3 mb-3">
                    <div class="card">
                        <img src="<?=$base_url?>/upload/product/<?= $data['HinhAnh'] ?>" class="card-img-top" alt="...">
                        <div class="">
                            <h5 class="card-title product-hidden-text"><?= $data['TenSP'] ?></h5>
                            <p class="card-text">
                            <p class="text-warning fw-bold"><?= $data['gia'] ?> đ</p>
                            </p>
                            <div class="mb-2 text-end">
                            <a href="<?=$base_url?>index.php?mod=page&act=detail&id=<?=$data['MaSP']?>" class="text-black"><i class="fa-solid fa-circle-info fa-2xl pointer"></i></a>
                                <a href="" class="text-black"><i class="fa-solid fa-cart-shopping fa-xl mx-2 pointer"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="col-sm-1"></div>
    </div>
    <div class="row mt-5">
        <div class="col-sm-1"></div>
        <div class="col-sm-10">
            <div class="row">
            </div>
        </div>
        <div class="col-sm-1"></div>
    </div>
    <div class="row mt-3">
        <div class="col-sm-1"></div>
        <div class="col-sm-10">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item">
                        <a class="page-link text-black" href="#" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <?php for ($i = 1; $i <= $number_page; $i++) : ?>
                        <li class="page-item"><a class="page-link text-black <?=($page == $i)?'active-warning':''?> <?=($i > $page +2 || $i < $page - 2)?'display-none':''?>" href="index.php?mod=page&act=category&page=<?= $i ?>"><?= $i ?></a></li>
                    <?php endfor; ?>
                    <li class="page-item">
                        <a class="page-link text-black" href="#" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
        <div class="col-sm-1"></div>
    </div>

    <script src="bootstrap-5.3.2-dist/js/bootstrap.bundle.min.js"></script>
    </body>

    </html>