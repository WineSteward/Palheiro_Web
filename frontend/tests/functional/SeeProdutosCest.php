<?php


namespace frontend\tests\Functional;

use frontend\tests\FunctionalTester;

class SeeProdutosCest
{
    public function _before(FunctionalTester $I)
    {
        $I->amLoggedInAs(3);
    }

    public function tryToTest(FunctionalTester $I)
    {
        $I->amOnPage('/');
        $I->click('Produtos');
    }
}
