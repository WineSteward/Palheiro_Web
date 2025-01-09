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
        $this->valornutricional->nome = "Z";
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
        $this->valornutricional->nome = "Z";
        
        $this->valornutricional->save();

        $this->tester->seeRecord('common\models\valornutricional', ['nome' => 'Z']);
    }

    public function testValorNutricionalCanChangeNome()
    {
        $id = $this->tester->haveRecord('common\models\valornutricional', ['nome' => 'Z']);

        $this->valornutricional = Valornutricional::findOne($id);
        
        $this->valornutricional->nome = "Y";
        $this->valornutricional->save();
        
        $this->tester->seeRecord('common\models\valornutricional', ['nome' => 'Y']); 
        $this->tester->dontSeeRecord('common\models\valornutricional', ['nome' => 'Z']); 
    }

    public function testValorNutricionalDeleteFromDatabase()
    {
        $this->valornutricional->nome = "Z";
        
        $this->valornutricional->save();

        $this->tester->seeRecord('common\models\valornutricional', ['nome' => 'Z']);

        $this->valornutricional->delete();

        $this->tester->dontSeeRecord('common\models\valornutricional', ['nome' => 'Z']);
    }
}
