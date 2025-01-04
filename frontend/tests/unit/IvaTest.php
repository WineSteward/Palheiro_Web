<?php


namespace frontend\tests\Unit;

use common\models\Iva;
use frontend\tests\UnitTester;
use Codeception\Attribute\Skip;

class IvaTest extends \Codeception\Test\Unit
{

    protected UnitTester $tester;
    protected $iva;

    protected function _before()
    {
        $this->iva = new Iva();
    }

    public function testIvaValidationVigor()
    {            
        $this->iva->vigor = 1;
        expect($this->iva->validate(['vigor']))->toBeTrue();
        
        $this->iva->vigor = null;
        expect($this->iva->validate(['vigor']))->toBeFalse();
        
        $this->iva->vigor = "String";
        expect($this->iva->validate(['vigor']))->toBeFalse();

        $this->iva->vigor = 10.123;
        expect($this->iva->validate(['vigor']))->toBeFalse();
    }

    public function testIvaValidationValorPorcentagem()
    {            
        $this->iva->valorPorcentagem = 20;
        expect($this->iva->validate(['valorPorcentagem']))->toBeTrue();
        
        $this->iva->valorPorcentagem = null;
        expect($this->iva->validate(['valorPorcentagem']))->toBeFalse();
        
        $this->iva->valorPorcentagem = "String";
        expect($this->iva->validate(['valorPorcentagem']))->toBeFalse();

        $this->iva->valorPorcentagem = 10.123;
        expect($this->iva->validate(['valorPorcentagem']))->toBeFalse();
    }

    public function testIvaAddToDatabase()
    {
        $this->iva->vigor = 1;
        $this->iva->valorPorcentagem = 10;
        $this->iva->save();

        $this->tester->seeRecord('common\models\iva', ['valorPorcentagem' => 10]);
    }

    public function testIvaCanChangeVigor()
    {
        $id = $this->tester->haveRecord('common\models\iva', ['vigor' => 1, 'valorPorcentagem' => 10]);

        $this->iva = Iva::findOne($id);
        
        $this->iva->vigor = 0;
        $this->iva->save();
        
        $this->tester->seeRecord('common\models\iva', ['vigor' => 0, 'valorPorcentagem' => 10]); 
        $this->tester->dontSeeRecord('common\models\iva', ['vigor' => 1, 'valorPorcentagem' => 10]); 
    }

    public function testIvaCanChangeValorPorcentagem()
    {
        $id = $this->tester->haveRecord('common\models\iva', ['vigor' => 1, 'valorPorcentagem' => 10]);

        $this->iva = Iva::findOne($id);
        
        $this->iva->valorPorcentagem = 20;
        $this->iva->save();
        
        $this->tester->seeRecord('common\models\iva', ['vigor' => 1, 'valorPorcentagem' => 20]); 
        $this->tester->dontSeeRecord('common\models\iva', ['vigor' => 1, 'valorPorcentagem' => 10]); 
    }

    public function testIvaDeleteFromDatabase()
    {
        $this->iva->vigor = 1;
        $this->iva->valorPorcentagem = 20;
        $this->iva->save();

        $this->tester->seeRecord('common\models\iva', ['vigor' => 1, 'valorPorcentagem' => 20]); 

        $this->iva->delete();

        $this->tester->dontSeeRecord('common\models\iva', ['vigor' => 1, 'valorPorcentagem' => 20]); 
    }
}
