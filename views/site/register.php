<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\Users $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use yii\helpers\Url;

$this->title = 'Cadastro';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to login:</p>

    <div class="row">
        <div class="col-lg-5">

            <?php $form = ActiveForm::begin([
                'id' => 'login-form',
                'fieldConfig' => [
                    'template' => "{label}\n{input}\n{error}",
                    'labelOptions' => ['class' => 'col-lg-1 col-form-label mr-lg-3'],
                    'inputOptions' => ['class' => 'col-lg-3 form-control'],
                    'errorOptions' => ['class' => 'col-lg-7 invalid-feedback'],
                ],
            ]); ?>

            <?= $form->field($model, 'username')
                ->textInput(
                    [
                        'autofocus' => true,
                        'placeholder' => 'Nome do Usuário'
                    ]
                ) ?>

            <?= $form->field($model, 'password')
                ->passwordInput(
                    ['placeholder' => 'Senha']
                ) ?>


            <div class="form-group">
                <div>
                    <?= Html::submitButton('Cadastro', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>
            </div>

            <?php ActiveForm::end(); ?>


        </div>
    </div>
    <div class="text-center">
        <a href="<?php echo Url::toRoute('site/login'); ?>">REALIZAR LOGIN</a>
    </div>
</div>