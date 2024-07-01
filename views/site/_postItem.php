<?php

use yii\helpers\Html;

/* @var $model app\models\Posts */

?>

<div class="post-item card mb-3">
    <div class="row g-0">
        <div class="col-md-4">
            <?php foreach ($model->postFiles as $file) : ?>
            <img src="<?= Yii::getAlias('@showImages/') . $file->filename; ?>" class="img-fluid rounded-start"
                alt="<?= 'Imagem de ' . $model->title; ?>">
            <?php endforeach; ?>
        </div>
        <div class="col-md-8">
            <div class="card-body">
                <h5 class="card-title"><?= Html::encode($model->title) ?></h5>
                <p class="card-text"><?= nl2br(Html::encode($model->content)) ?></p>
                <p class="card-text"><strong>Autor:</strong> <?= Html::encode($model->user->username) ?></p>
                <p class="card-text"><small class="text-body-secondary">Publicado em
                        <?= Html::encode($model->publication_date) ?></small></p>
                <?php if (Yii::$app->user->identity->id === $model->user_id) : ?>
                <?= Html::a('Apagar Publicação', [
                        'site/delete',
                        'id' => $model->id,
                        'filename' => $file->filename,
                    ], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => 'Tem certeza que deseja excluir este post?',
                            'method' => 'post',
                        ],
                    ]) ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>