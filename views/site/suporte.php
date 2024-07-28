<?php

/** @var yii\web\View $this */

use yii\widgets\ActiveForm;
use yii\helpers\Html;

$this->title = 'Enviar mensagem de suporte';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="support-message-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($modelSuporte, 'message')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton(
            'Enviar mensagem ao suporte',
            [
                'class' => 'btn btn-success'
            ]
        ) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Usuário</th>
            <th>Mensagem</th>
            <th>Data de Criação</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($messages as $message): ?>
        <tr>
            <td><?= Html::encode($message->id) ?></td>
            <td><?= Html::encode($users[$message->user_id]->username ?? 'Usuário desconhecido') ?></td>
            <td><?= Html::encode($message->message) ?></td>
            <td><?= Html::encode($message->created_at) ?></td>
            <td><?= Html::encode($message->status) ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>