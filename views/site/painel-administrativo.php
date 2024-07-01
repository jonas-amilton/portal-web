<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\PainelAdministrativo $model */

use app\models\Users;
use yii\bootstrap5\Html;

$this->title = 'Painel Administrativo';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>

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
            <?php foreach ($messages as $message) : ?>
            <tr>
                <td><?= Html::encode($message->id) ?></td>
                <td><?= Html::encode(Users::getUsernameById($message->user_id)) ?></td>
                <td><?= Html::encode($message->message) ?></td>
                <td><?= Html::encode($message->created_at) ?></td>
                <td><?= Html::encode($message->status) ?></td>
                <td>
                    <?= Html::a(
                            'Alterar Status',
                            [
                                'site/update-status',
                                'id' => $message->id
                            ],
                            [
                                'class' => 'btn btn-primary'
                            ]
                        ) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>