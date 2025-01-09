<?php

namespace frontend\tests\Unit;

use common\models\Categoria;
use frontend\tests\UnitTester;

class CategoriaTest extends \Codeception\Test\Unit
{

    protected UnitTester $tester;
    protected $categoria;

    protected function _before()
    {
        $this->categoria = new Categoria();
    }

    public function testCategoriaValidationNome()
    {            
        $this->categoria->nome = "Categoria Nome";
        expect($this->categoria->validate(['nome']))->toBeTrue();
        
        $this->categoria->nome = null;
        expect($this->categoria->validate(['nome']))->toBeFalse();
        
        $this->categoria->nome = "TOOOOOOOOOOOOOOOOOOO LONGGGGGGGGGGGGG";
        expect($this->categoria->validate(['nome']))->toBeFalse();

        $this->categoria->nome = 10;
        expect($this->categoria->validate(['nome']))->toBeFalse();
    }

    public function testCategoriaAddToDatabase()
    {
        $this->categoria->nome = "Frutos Secos";
        
        $this->categoria->save();

        $this->tester->seeRecord('common\models\categoria', ['nome' => 'Frutos Secos']);
    }

    public function testCategoriaCanChangeNome()
    {
        $id = $this->tester->haveRecord('common\models\categoria', ['nome' => 'Frutos Secos']);

        $this->categoria = Categoria::findOne($id);
        
        $this->categoria->nome = "Bebidas";
        $this->categoria->save();
        
        $this->tester->seeRecord('common\models\categoria', ['nome' => 'Bebidas']); 
        $this->tester->dontSeeRecord('common\models\categoria', ['nome' => 'Frutos Secos']); 
    }

    public function testCategoriaDeleteFromDatabase()
    {
        $this->categoria->nome = "Frutos Secos";
        
        $this->categoria->save();

        $this->tester->seeRecord('common\models\categoria', ['nome' => 'Frutos Secos']);

        $this->categoria->delete();

        $this->tester->dontSeeRecord('common\models\categoria', ['nome' => 'Frutos Secos']);
    }

}






