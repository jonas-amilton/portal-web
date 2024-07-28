<?php
namespace app\repositories\interfaces;

interface UserRepositoryInterface
{
    public function getUsersByIds($userId);
    public function isAdmin($userId);
}