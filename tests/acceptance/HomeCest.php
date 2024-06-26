<?php

use yii\helpers\Url;

class HomeCest
{
    public function ensureThatHomePageWorks(AcceptanceTester $I)
    {
        $I->amOnPage(Url::toRoute('/site/index'));
        $I->see('Comunidade Conectada');

        $I->seeLink('Suporte');
        $I->click('Suporte');
        $I->wait(2); // wait for page to be opened

        $I->see('This is the Suporte page.');
    }
}