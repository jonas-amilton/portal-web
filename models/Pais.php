<?php

namespace app\models;

use yii\db\ActiveRecord;

class Pais extends ActiveRecord
{

    public static function getPaises()
    {
        // obtém todas as linhas da tabela pais e as ordena pela coluna "nome"
        $paises = Pais::find()->orderBy('nome')->all();

        return $paises;
    }

    public static function getPaisBrasil()
    {
        // obtém a linha cuja chave primária é "BR"
        $pais = Pais::findOne('BR');

        return $pais;
    }

    public static function setNamePaisForBrasil()
    {
        $pais = Pais::getPaisBrasil();
        // altera o nome do país para "Brazil" e o salva no banco de dados
        $pais->nome = 'Brazil';
        $pais->save();
    }
}