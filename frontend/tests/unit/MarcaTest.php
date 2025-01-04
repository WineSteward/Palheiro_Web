<?php


namespace frontend\tests\Unit;

use common\models\Marca;
use frontend\tests\UnitTester;

class MarcaTest extends \Codeception\Test\Unit
{

    protected UnitTester $tester;
    protected $marca;

    protected function _before()
    {
        $this->marca = new Marca();
    }

    public function testMarcaValidationNome()
    {            
        $this->marca->nome = "Marca Nome";
        expect($this->marca->validate(['nome']))->toBeTrue();
        
        $this->marca->nome = null;
        expect($this->marca->validate(['nome']))->toBeFalse();
        
        $this->marca->nome = "TOOOOOOOOOOOOOOOOOOO LONGGGGGGGGGGGGG";
        expect($this->marca->validate(['nome']))->toBeFalse();

        $this->marca->nome = 10;
        expect($this->marca->validate(['nome']))->toBeFalse();
    }

    public function testMarcaAddToDatabase()
    {
        $this->marca->nome = "ABC LDA";
        
        $this->marca->save();

        $this->tester->seeRecord('common\models\marca', ['nome' => 'ABC LDA']);
    }

    public function testMarcaCanChangeNome()
    {
        $id = $this->tester->haveRecord('common\models\marca', ['nome' => 'ABC LDA']);

        $this->marca = Marca::findOne($id);
        
        $this->marca->nome = "XYZ LDA";
        $this->marca->save();
        
        $this->tester->seeRecord('common\models\marca', ['nome' => 'XYZ LDA']); 
        $this->tester->dontSeeRecord('common\models\marca', ['nome' => 'ABC LDA']); 
    }

    public function testMarcaDeleteFromDatabase()
    {
        $this->marca->nome = "ABC LDA";
        
        $this->marca->save();

        $this->tester->seeRecord('common\models\marca', ['nome' => 'ABC LDA']);

        $this->marca->delete();

        $this->tester->dontSeeRecord('common\models\marca', ['nome' => 'ABC LDA']);
    }
}
