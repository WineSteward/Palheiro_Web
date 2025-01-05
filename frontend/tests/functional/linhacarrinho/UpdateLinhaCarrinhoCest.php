<?php


namespace frontend\tests\Functional;

use frontend\tests\FunctionalTester;

class UpdateLinhaCarrinhoCest
{
    public function _before(FunctionalTester $I)
    {
        $I->amLoggedInAs(3);

    }

    protected function formParams($quantidade, $linha_id)
    {
        return [
            'FormId1[quantidade]' => $quantidade,
            'FormId1[linha_id]' => $linha_id,
        ];
    }

    public function UpdateLinhaCarrinhoQuantidade(FunctionalTester $I)
    {
        $I->amOnPage('/');
        $I->click('Produtos');
        $I->click('#1');
        $I->seeFlashSuccess('Produto adicionado com sucesso.');
        $linha_id = $I->grabValueFrom('input[name=linha_id]');
        $I->submitForm('#form-id-1', $this->formParams(5, $linha_id));
        $I->seeFlashSuccess('Carrinho atualizado com sucesso.');
    }
}
