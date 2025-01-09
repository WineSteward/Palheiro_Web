<?php


namespace frontend\tests\Functional;

use frontend\tests\FunctionalTester;

class UpdateLinhaCarrinhoCest
{
    public function _before(FunctionalTester $I)
    {
        $I->amLoggedInAs(2);

    }

    protected function formParams($quantidade)
    {
        return [
            'FormId1[quantidade]' => $quantidade,
        ];
    }

    public function UpdateLinhaCarrinhoQuantidade(FunctionalTester $I)
    {
        $I->amOnPage('/');
        $I->click('Produtos');
        $I->click('#1');
        $I->seeFlashSuccess('Produto adicionado com sucesso.');
        $I->submitForm('#form-id-1', $this->formParams(5));
        $I->seeFlashSuccess('Carrinho atualizado com sucesso.');
    }
}
