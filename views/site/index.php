<?php

/** @var yii\web\View $this */

$this->title = 'Comunidade Conectada';
?>

<div class="container mb-2">
    <h1>
        Olá, <?= Yii::$app->user->identity->username; ?> qual a novidade de hoje?
    </h1>
    <div class="input-group input-group-lg">
        <span class="input-group-text" id="inputGroup-sizing-lg">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search"
                viewBox="0 0 16 16">
                <path
                    d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
            </svg>
        </span>
        <input type="text" placeholder="Pesquisar por publicações..." class="form-control"
            aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg">
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-4">
            <div class="card">
                <img src="<?= Yii::getAlias('@images') . '/01.jpg'; ?>" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                        card's
                        content.</p>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card">
                <img src="<?= Yii::getAlias('@images') . '/02.jpg'; ?>" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                        card's
                        content.</p>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card">
                <img src="<?= Yii::getAlias('@images') . '/03.jpg'; ?>" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                        card's
                        content.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-4">
            <div class="card">
                <img src="<?= Yii::getAlias('@images') . '/04.jpg'; ?>" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                        card's
                        content.</p>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card">
                <img src="<?= Yii::getAlias('@images') . '/05.jpg'; ?>" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                        card's
                        content.</p>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card">
                <img src="<?= Yii::getAlias('@images') . '/06.jpg'; ?>" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                        card's
                        content.</p>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card">
                <img src="<?= Yii::getAlias('@images') . '/07.jpg'; ?>" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                        card's
                        content.</p>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card">
                <img src="<?= Yii::getAlias('@images') . '/08.jpg'; ?>" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                        card's
                        content.</p>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card">
                <img src="<?= Yii::getAlias('@images') . '/09.jpg'; ?>" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                        card's
                        content.</p>
                </div>
            </div>
        </div>
    </div>
</div>