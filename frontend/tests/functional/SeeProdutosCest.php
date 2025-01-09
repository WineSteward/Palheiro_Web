<?php


namespace frontend\tests\Functional;

use frontend\tests\FunctionalTester;

class SeeProdutosCest
{
    public function _before(FunctionalTester $I)
    {
        $I->amLoggedInAs(2);
    }

    public function checkSeeAllProdutos(FunctionalTester $I)
    {
        $I->amOnPage('/');
        $I->click('Produtos');
        $I->see('Maça Royal Gala', 'a');
        $I->see('Cenoura', 'a');
    }
}
