<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */

use yii\bootstrap5\Html;
use yii\helpers\Url;

$this->title = 'Painel Administrativo';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>

    <p><a href="<?= Url::to(['/users']) ?>">Gerenciar usuários</a></p>

    <h2>Mensagens do suporte</h2>
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