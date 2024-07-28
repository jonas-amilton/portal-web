<?php
namespace app\repositories;

use app\models\Users;
use app\repositories\interfaces\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    /**
     * Obtém usuários pelo ID.
     * @param array[] $userIds
     * @return string|null
     */
    public function getUsersByIds($userIds)
    {
        $users = Users::find()
            ->where(['id' => $userIds])
            ->indexBy('id')
            ->all();

        return $users;
    }

    /**
     * Retorna o administrador pelo ID
     * @param int $userId ID do usuário
     * @return string|null Administrador ou null se não encontrado
     */
    public function isAdmin($userId)
    {
        $user = Users::findOne($userId);
        return $user && $user->isAdmin;
    }
}