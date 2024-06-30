<?php

use yii\helpers\Url;

class SuporteCest
{
    public function ensureThatSuporteWorks(AcceptanceTester $I)
    {
        $I->amOnPage(Url::toRoute('/site/suporte'));
        $I->see('Suporte', 'h1');
    }
}
