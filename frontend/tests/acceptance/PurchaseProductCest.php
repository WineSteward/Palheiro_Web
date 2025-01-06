<?php


namespace frontend\tests\Acceptance;

use frontend\tests\AcceptanceTester;

class PurchaseProductCest
{
    public function _before(AcceptanceTester $I)
    {
        $I->login('miguel', '123456789');
    }

    protected function formQuantity($quantidade)
    {
        return [
            'quantidade' => $quantidade,
        ];
    }

    protected function formMethods($metodoExpedicaoId, $metodoPagamentoId)
    {
        return [
            'metodoExpedicaoId' => $metodoExpedicaoId,
            'metodoPagamentoId' => $metodoPagamentoId
        ];
    }

    public function PurchaseProduct(AcceptanceTester $I)
    {
        $I->click('Produtos');
        $I->wait(2);

        $I->click(['css' => 'li[data-filter=".Frutas"]']); 
        $I->dontSee('Cenoura', 'a');
        $I->click(['xpath' => '//button[@id="1"]']);

        $I->wait(2);
        $I->seeElement('input', ['name' => 'quantidade']);
        $I->seeElement('input', ['value' => '1']);
        $I->submitForm('#form-id-1', $this->formQuantity(2));

        $I->wait(2);
        $I->seeFlashSuccess('Carrinho atualizado com sucesso.');
        $I->seeElement('input', ['name' => 'quantidade']);
        $I->seeElement('input', ['value' => '2']);
        $I->click(['css' => 'a.primary-btn']);

        $I->wait(2);
        $I->seeElement('input[type=radio][name=metodoExpedicaoId][value="1"]');
        $I->seeElement('input[type=radio][name=metodoPagamentoId][value="1"]');
        $I->checkOption('input[type=radio][name=metodoExpedicaoId][value="1"]');
        $I->checkOption('input[type=radio][name=metodoPagamentoId][value="1"]');
        $I->seeOptionIsSelected('input[type=radio][name=metodoExpedicaoId]', '1');
        $I->seeOptionIsSelected('input[type=radio][name=metodoPagamentoId]', '1');
        $metodoExpedicaoText = $I->grabTextFrom('//label[input[@name="metodoExpedicaoId" and @value="1"]]');
        $metodoPagamentoText = $I->grabTextFrom('//label[input[@name="metodoPagamentoId" and @value="1"]]');
        $I->click('Continuar');

        $I->wait(2);
        $I->see('Confirmação da Compra', 'h1');
        $I->see($metodoExpedicaoText);
        $I->see($metodoPagamentoText);
        $I->scrollTo('(//button[contains(@class, "btn-success")])[1]');
        $I->wait(2);
        $I->click('#btn-comprar');

        $I->wait(2);
        $I->seeFlashSuccess('Compra concluída com sucesso!');
    }
}
