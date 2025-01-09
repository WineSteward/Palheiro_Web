<?php


namespace frontend\tests\Functional;

use frontend\tests\FunctionalTester;

class AddLinhaCarrinhoCest
{

    public function _before(FunctionalTester $I)
    {
        $I->amLoggedInAs(2);
    }

    public function AddLinhaCarrinho(FunctionalTester $I)
    {
        $I->amOnPage('/');
        $I->see('Logout (cliente_teste)');
        $I->click('Produtos');
        $I->see('Categorias');
        $I->click('#1');
        $I->seeFlashSuccess('Produto adicionado com sucesso.');
        $I->seeElement('input', ['name' => 'quantidade']);
        $I->seeElement('input', ['value' => '1']);
    }

    public function AddLinhaCarrinhoNoStock(FunctionalTester $I)
    {
        $I->amOnPage('/');
        $I->see('Logout (cliente_teste)');
        $I->click('Produtos');
        $I->see('Categorias');
        $I->click('#2');
        $I->seeCurrentUrlEquals('/index-test.php/produto/show?id=2');
        $I->seeFlashError('Quantidade desejada excede o stock existente');
    }
}
