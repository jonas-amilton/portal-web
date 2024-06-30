<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $modelSuporte app\models\SupportMessage */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Atualizar Status: ' . $modelSuporte->id;
$this->params['breadcrumbs'][] = ['label' => 'Mensagens de Suporte', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $modelSuporte->id, 'url' => ['view', 'id' => $modelSuporte->id]];
$this->params['breadcrumbs'][] = 'Atualizar Status';
?>
<div class="support-message-update-status">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="support-message-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($modelSuporte, 'status')->dropDownList([
            'Pendente' => 'Pendente',
            'Em progresso' => 'Em progresso',
            'Resolvido' => 'Resolvido',
        ]) ?>

        <div class="form-group">
            <?= Html::submitButton('Atualizar', ['class' => 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>