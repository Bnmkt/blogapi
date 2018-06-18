<?php if ($data["data"]["featured"]): ?>
    <div class="jumbotron p-3 p-md-5 text-white rounded bg-dark">
        <div class="col-md-6 px-0">
            <h1 class="display-4 font-italic"><?= $data["data"]["featured"][0]->title ?></h1>
            <p class="lead my-3"><?= $data["data"]["featured"][0]->body ?></p>
            <p class="lead mb-0"><a href="/api.php?a=show&r=post&id=<?= $data[" class="text-white font-weight-bold">Continue reading...</a></p>
            <img class="card-img-right flex-auto d-none d-lg-block" src="<?= $data["data"]["featured"][0]->thumb ?>"
                 alt="Card image cap">
        </div>
    </div>

    <div class="row mb-2">
        <div class="col-md-6">
            <div class="card flex-md-row mb-4 box-shadow h-md-250">
                <div class="card-body d-flex flex-column align-items-start">
                    <strong class="d-inline-block mb-2 text-primary">World</strong>
                    <h3 class="mb-0">
                        <a class="text-dark" href="/api.php?a=show&r=post&id=<?= $data["><?= $data["data"]["featured"][1]->title ?>t</a>
                    </h3>
                    <div class="mb-1 text-muted">Nov 12</div>
                    <p class="card-text mb-auto"><?= $data["data"]["featured"][1]->body ?></p>
                    <a href="/api.php?a=show&r=post&id=<?= $data[">Continue reading</a>
                </div>
                <img class="card-img-right flex-auto d-none d-lg-block" src="<?= $data["data"]["featured"][1]->thumb ?>"
                     alt="Card image cap">
            </div>
        </div>
        <div class="col-md-6">
            <div class="card flex-md-row mb-4 box-shadow h-md-250">
                <div class="card-body d-flex flex-column align-items-start">
                    <strong class="d-inline-block mb-2 text-success">Design</strong>
                    <h3 class="mb-0">
                        <a class="text-dark" href="/api.php?a=show&r=post&id=<?= $data["><?= $data["data"]["featured"][2]->title ?></a>
                    </h3>
                    <div class="mb-1 text-muted">Nov 11</div>
                    <p class="card-text mb-auto"><?= $data["data"]["featured"][2]->body ?></p>
                    <a href="/api.php?a=show&r=post&id=<?= $data[">Continue reading</a>
                </div>
                <img class="card-img-right flex-auto d-none d-lg-block" data-src="<?= $data["data"]["featured"][2]->thumb ?>"
                     alt="Card image cap">
            </div>
        </div>
    </div>
<?php endif; ?>