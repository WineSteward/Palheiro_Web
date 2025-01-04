<?php


namespace frontend\tests\Unit;

use common\models\Valornutricional;
use frontend\tests\UnitTester;

class ValorNutricionalTest extends \Codeception\Test\Unit
{

    protected UnitTester $tester;
    protected $valornutricional;

    protected function _before()
    {
        $this->valornutricional = new Valornutricional();
    }

    public function testValorNutricionalValidationNome()
    {            
        $this->valornutricional->nome = "C";
        expect($this->valornutricional->validate(['nome']))->toBeTrue();
        
        $this->valornutricional->nome = null;
        expect($this->valornutricional->validate(['nome']))->toBeFalse();
        
        $this->valornutricional->nome = "TOOOOOOOOOOOOOOOOOOO LONGGGGGGGGGGGGG";
        expect($this->valornutricional->validate(['nome']))->toBeFalse();

        $this->valornutricional->nome = 10;
        expect($this->valornutricional->validate(['nome']))->toBeFalse();
    }

    public function testValorNutricionalAddToDatabase()
    {
        $this->valornutricional->nome = "C";
        
        $this->valornutricional->save();

        $this->tester->seeRecord('common\models\valornutricional', ['nome' => 'C']);
    }

    public function testValorNutricionalCanChangeNome()
    {
        $id = $this->tester->haveRecord('common\models\valornutricional', ['nome' => 'C']);

        $this->valornutricional = Valornutricional::findOne($id);
        
        $this->valornutricional->nome = "D";
        $this->valornutricional->save();
        
        $this->tester->seeRecord('common\models\valornutricional', ['nome' => 'D']); 
        $this->tester->dontSeeRecord('common\models\valornutricional', ['nome' => 'C']); 
    }

    public function testValorNutricionalDeleteFromDatabase()
    {
        $this->valornutricional->nome = "C";
        
        $this->valornutricional->save();

        $this->tester->seeRecord('common\models\valornutricional', ['nome' => 'C']);

        $this->valornutricional->delete();

        $this->tester->dontSeeRecord('common\models\valornutricional', ['nome' => 'C']);
    }
}
