<?php


namespace backend\tests\Unit;

use backend\tests\UnitTester;
use common\models\Tarefa;

class TarefaTest extends \Codeception\Test\Unit
{

    protected UnitTester $tester;

    protected function _before()
    {
        $this->tarefa = new Tarefa();
    }

    
    public function testTarefaValidationDescricao()
    {
        $this->tarefa->descricao = "Tarefa valida";
        expect($this->tarefa->validate(['descricao']))->toBeTrue();
        
        $this->tarefa->descricao = null;
        expect($this->tarefa->validate(['descricao']))->toBeFalse();
        
        $this->tarefa->descricao = "TOOOOOOOOOOOOOOOOOOO LONGGGGGGGGgggggggggggggggggGGGGG";
        expect($this->tarefa->validate(['descricao']))->toBeFalse();

        $this->tarefa->descricao = 10;
        expect($this->tarefa->validate(['descricao']))->toBeFalse();
    }

    public function testTarefaValidationFeito()
    {
        $this->tarefa->feito = 1;
        expect($this->tarefa->validate(['feito']))->toBeTrue();
        
        $this->tarefa->feito = null;
        expect($this->tarefa->validate(['feito']))->toBeFalse();
        
        $this->tarefa->feito = "wrong type";
        expect($this->tarefa->validate(['feito']))->toBeFalse();
    }

    public function testTarefaValidationUserprofileId()
    {
        $this->tarefa->userprofile_id = 'wrong type';
        expect($this->tarefa->validate(['userprofile_id']))->ToBeFalse();

        $this->tarefa->userprofile_id = 999; //donest exist
        expect($this->tarefa->validate(['userprofile_id']))->ToBeFalse();

        $this->tarefa->userprofile_id = 12.21; //wrong type
        expect($this->tarefa->validate(['userprofile_id']))->ToBeFalse();

        $this->tarefa->userprofile_id = null; //null
        expect($this->tarefa->validate(['userprofile_id']))->ToBeFalse();

        $this->tarefa->userprofile_id = 1;
        expect($this->tarefa->validate(['userprofile_id']))->ToBeTrue();
    }

    public function testTarefaAddToDatabase()
    {
        $this->tarefa->descricao = "Esta descricao";
        $this->tarefa->feito = 0;
        $this->tarefa->userprofile_id = 1;
        
        $this->tarefa->save();

        $this->tester->seeRecord(Tarefa::class, ['descricao' => 'Esta descricao']);
    }

     public function testCategoriaCanChangeFeito()
    {
        $id = $this->tester->haveRecord(Tarefa::class, ['descricao' => 'Esta descricao', 'feito' => 0, 'userprofile_id' => 1]);

        $this->tarefa = Tarefa::findOne($id);
        
        $this->tarefa->feito = 1;
        $this->tarefa->save();
        
        $this->tester->seeRecord(Tarefa::class, ['descricao' => 'Esta descricao', 'feito' => 1]); 
        $this->tester->dontSeeRecord(Tarefa::class, ['descricao' => 'Esta descricao', 'feito' => 0]); 
    }

    public function testTarefaDeleteFromDatabase()
    {
        $this->tarefa->descricao = "Esta descricao";
        $this->tarefa->feito = 0;
        $this->tarefa->userprofile_id = 1;
        
        $this->tarefa->save();

        $this->tester->seeRecord(Tarefa::class, ['descricao' => 'Esta descricao']);

        $this->tarefa->delete();

        $this->tester->dontSeeRecord(Tarefa::class, ['descricao' => 'Esta descricao', 'feito' => 1]); 
    } 
}
