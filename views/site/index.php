<?php

/** @var yii\web\View $this */

$this->title = 'Comunidade Conectada';

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\widgets\ListView;
?>

<div class="container mb-2">
    <h1>
        Olá, <?= Yii::$app->user->identity->username; ?> qual a novidade de hoje?
    </h1>
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

    <?= $form->field($modelPost, 'title')->textInput(['maxlength' => true]) ?>
    <?= $form->field($modelPost, 'content')->textarea(['rows' => 6]) ?>
    <?= $form->field($modelUploadForm, 'imageFile')->fileInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Publicar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end() ?>

    <div class="posts-index">

        <?php echo $this->render('_search', ['model' => $searchModel]); ?>

        <h1>Feed</h1>

        <?php if (!empty($searchModel->attributes)) : ?>
        <?= ListView::widget([
                'dataProvider' => $dataProvider,
                'itemView' => '_postItem',
            ]); ?>
        <?php endif; ?>

    </div>

</div>

</div>