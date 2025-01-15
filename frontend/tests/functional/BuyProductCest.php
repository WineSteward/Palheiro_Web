<?php


namespace frontend\tests\Functional;

use frontend\tests\FunctionalTester;

class BuyProductCest
{
    public function _before(FunctionalTester $I)
    {
        $I->amLoggedInAs(2);
    }

    public function tryToBuyProduct(FunctionalTester $I)
    {
        $I->amOnPage('/');
        $I->click('Produtos');
        $I->see('Maça Royal Gala', 'a');
        $I->click('#1');
        $I->see('Produto adicionado com sucesso.');
        $I->click('Ir para Checkout');
        $I->selectOption('input[type=radio][name=metodoExpedicaoId]', '1');
        $I->selectOption('input[type=radio][name=metodoPagamentoId]', '1');
        $I->click('Continuar');
        $I->see('Confirmação da Compra');
        $I->click('Finalizar Compra');
        $I->see('Compra concluída com sucesso!');
    }
}
