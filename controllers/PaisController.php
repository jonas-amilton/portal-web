<?php

namespace app\controllers;

use yii\web\Controller;
use app\models\Pais;
use yii\data\Pagination;

class PaisController extends Controller
{
    /**
     * Displays index.
     *
     * @return string
     */
    public function actionIndex()
    {

        $query = Pais::find();

        $paginacao = new Pagination([
            'defaultPageSize' => 5,
            'totalCount' => $query->count(),
        ]);

        $paises = $query->orderBy('nome')
            ->offset($paginacao->offset)
            ->limit($paginacao->limit)
            ->all();

        return $this->render('index', [
            'todosPaises' => Pais::getPaises(),
            'paisBrasil' => Pais::getPaisBrasil(),
            'paises' => $paises,
            'paginacao' => $paginacao,
        ]);
    }
}