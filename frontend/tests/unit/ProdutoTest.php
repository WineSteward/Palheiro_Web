<?php


namespace frontend\tests\Unit;

use common\models\Produto;
use frontend\tests\UnitTester;

class ProdutoTest extends \Codeception\Test\Unit
{

    protected UnitTester $tester;
    protected $produto;

    protected function _before()
    {
        $this->produto = new Produto();
    }

    public function testProdutoValidationValorNutriocionalId()
    {
        $this->produto->valornutricional_id = 1;
        expect($this->produto->validate(['valornutricional_id']))->toBeTrue();

        $this->produto->valornutricional_id = null;
        expect($this->produto->validate(['valornutricional_id']))->toBeFalse();

        $this->produto->valornutricional_id = 120;
        expect($this->produto->validate(['valornutricional_id']))->toBeFalse();

        $this->produto->valornutricional_id = "String type";
        expect($this->produto->validate(['valornutricional_id']))->toBeFalse();

    }

    public function testProdutoValidationMarcaId()
    {
        $this->produto->marca_id = 1;
        expect($this->produto->validate(['marca_id']))->toBeTrue();

        $this->produto->marca_id = null;
        expect($this->produto->validate(['marca_id']))->toBeFalse();

        $this->produto->marca_id = 120;
        expect($this->produto->validate(['marca_id']))->toBeFalse();

        $this->produto->marca_id = "String type";
        expect($this->produto->validate(['marca_id']))->toBeFalse();

    }

    public function testProdutoValidationIvaId()
    {
        $this->produto->iva_id = 1;
        expect($this->produto->validate(['iva_id']))->toBeTrue();

        $this->produto->iva_id = null;
        expect($this->produto->validate(['iva_id']))->toBeFalse();

        $this->produto->iva_id = 120;
        expect($this->produto->validate(['iva_id']))->toBeFalse();

        $this->produto->iva_id = "String type";
        expect($this->produto->validate(['iva_id']))->toBeFalse();

    }

    public function testProdutoValidationCategoriaId()
    {
        $this->produto->categoria_id = 1;
        expect($this->produto->validate(['categoria_id']))->toBeTrue();

        $this->produto->categoria_id = null;
        expect($this->produto->validate(['categoria_id']))->toBeFalse();

        $this->produto->categoria_id = 120;
        expect($this->produto->validate(['categoria_id']))->toBeFalse();

        $this->produto->categoria_id = "String type";
        expect($this->produto->validate(['categoria_id']))->toBeFalse();

    }

    public function testProdutoValidationDescricao()
    {
        $this->produto->descricao = "Esta descricao";
        expect($this->produto->validate(['descricao']))->toBeTrue();

        $this->produto->descricao = null;
        expect($this->produto->validate(['descricao']))->toBeFalse();

        $this->produto->descricao = 12;
        expect($this->produto->validate(['descricao']))->toBeFalse();

        $this->produto->descricao = "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum";
        expect($this->produto->validate(['descricao']))->toBeFalse();

    }

    public function testProdutoValidationQuantidade()
    {
        $this->produto->quantidade = 2;
        expect($this->produto->validate(['quantidade']))->toBeTrue();

        $this->produto->quantidade = null;
        expect($this->produto->validate(['quantidade']))->toBeFalse();

        $this->produto->quantidade = 1.2;
        expect($this->produto->validate(['quantidade']))->toBeFalse();

        $this->produto->quantidade = -12;
        expect($this->produto->validate(['quantidade']))->toBeFalse();

        $this->produto->quantidade = "String type";
        expect($this->produto->validate(['quantidade']))->toBeFalse();

    }

    public function testProdutoValidationPreco()
    {
        $this->produto->preco = 2;
        expect($this->produto->validate(['preco']))->toBeTrue();

        $this->produto->preco = null;
        expect($this->produto->validate(['preco']))->toBeFalse();

        $this->produto->preco = -12;
        expect($this->produto->validate(['preco']))->toBeFalse();

        $this->produto->preco = "String type";
        expect($this->produto->validate(['preco']))->toBeFalse();

    }

    public function testProdutoValidationNome()
    {
        $this->produto->nome = "Alface";
        expect($this->produto->validate(['nome']))->toBeTrue();

        $this->produto->nome = null;
        expect($this->produto->validate(['nome']))->toBeFalse();
        
        $this->produto->nome = "TOOOOOOOOOOOOOOOOOOO LONGGGGGGGGGGGGG";
        expect($this->produto->validate(['nome']))->toBeFalse();

        $this->produto->nome = 10;
        expect($this->produto->validate(['nome']))->toBeFalse();
    }

    public function testProdutoAddToDatabase()
    {
        $this->produto->nome = "Alface";
        $this->produto->preco = 2;
        $this->produto->quantidade = 10;
        $this->produto->descricao = "Alface verde e fresca";
        $this->produto->categoria_id = 1;
        $this->produto->marca_id = 1;
        $this->produto->iva_id = 1;
        $this->produto->valornutricional_id = 1;
        
        $this->produto->save();

        $this->tester->seeRecord('common\models\produto', ['nome' => 'Alface']);
    }

    public function testProdutoCanChangeNome()
    {
        $id = $this->tester->haveRecord('common\models\produto', [
            'nome' => 'Cebola',
            'preco' => 2,
            'quantidade' => 10,
            'descricao' => "Cebola dos orientes",
            'categoria_id' => 1,
            'marca_id' => 1,
            'iva_id' => 1,
            'valornutricional_id' => 1    
        ]);

        $this->produto = Produto::findOne($id);
        
        $this->produto->nome = "Cebola Roxa";
        $this->produto->save();
        
        $this->tester->seeRecord('common\models\produto', ['nome' => 'Cebola Roxa']); 
        $this->tester->dontSeeRecord('common\models\produto', ['nome' => 'Cebola']); 
    }

    public function testProdutoCanChangePreco()
    {
        $id = $this->tester->haveRecord('common\models\produto', [
            'nome' => 'Cebola',
            'preco' => 2,
            'quantidade' => 10,
            'descricao' => "Cebola dos orientes",
            'categoria_id' => 1,
            'marca_id' => 1,
            'iva_id' => 1,
            'valornutricional_id' => 1    
        ]);

        $this->produto = Produto::findOne($id);
        
        $this->produto->preco = 3;
        $this->produto->save();
        
        $this->tester->seeRecord('common\models\produto', ['nome' => 'Cebola', 'preco' => 3]); 
        $this->tester->dontSeeRecord('common\models\produto', ['nome' => 'Cebola', 'preco' => 2]); 
    }

    public function testProdutoCanChangeQuantidade()
    {
        $id = $this->tester->haveRecord('common\models\produto', [
            'nome' => 'Cebola',
            'preco' => 2,
            'quantidade' => 10,
            'descricao' => "Cebola dos orientes",
            'categoria_id' => 1,
            'marca_id' => 1,
            'iva_id' => 1,
            'valornutricional_id' => 1    
        ]);

        $this->produto = Produto::findOne($id);
        
        $this->produto->quantidade = 20;
        $this->produto->save();
        
        $this->tester->seeRecord('common\models\produto', ['nome' => 'Cebola', 'quantidade' => 20]); 
        $this->tester->dontSeeRecord('common\models\produto', ['nome' => 'Cebola', 'quantidade' => 10]); 
    }

    public function testProdutoCanChangeDescricao()
    {
        $id = $this->tester->haveRecord('common\models\produto', [
            'nome' => 'Cebola',
            'preco' => 2,
            'quantidade' => 10,
            'descricao' => "Cebola dos orientes",
            'categoria_id' => 1,
            'marca_id' => 1,
            'iva_id' => 1,
            'valornutricional_id' => 1    
        ]);

        $this->produto = Produto::findOne($id);
        
        $this->produto->descricao = "Cebola criada em estufa";
        $this->produto->save();
        
        $this->tester->seeRecord('common\models\produto', ['nome' => 'Cebola', 'descricao' => "Cebola criada em estufa"]); 
        $this->tester->dontSeeRecord('common\models\produto', ['nome' => 'Cebola', 'descricao' => "Cebola dos orientes"]); 
    }
    
    public function testProdutoCanChangeCategoriaId()
    {
        $id = $this->tester->haveRecord('common\models\produto', [
            'nome' => 'Cebola',
            'preco' => 2,
            'quantidade' => 10,
            'descricao' => "Cebola dos orientes",
            'categoria_id' => 1,
            'marca_id' => 1,
            'iva_id' => 1,
            'valornutricional_id' => 1    
        ]);

        $this->produto = Produto::findOne($id);
        
        $this->produto->categoria_id = 2;
        $this->produto->save();
        
        $this->tester->seeRecord('common\models\produto', ['nome' => 'Cebola', 'categoria_id' => 2]); 
        $this->tester->dontSeeRecord('common\models\produto', ['nome' => 'Cebola', 'categoria_id' => 1]); 
    }

    public function testProdutoCanChangeMarcaId()
    {
        $id = $this->tester->haveRecord('common\models\produto', [
            'nome' => 'Cebola',
            'preco' => 2,
            'quantidade' => 10,
            'descricao' => "Cebola dos orientes",
            'categoria_id' => 1,
            'marca_id' => 1,
            'iva_id' => 1,
            'valornutricional_id' => 1    
        ]);

        $this->produto = Produto::findOne($id);
        
        $this->produto->marca_id = 2;
        $this->produto->save();
        
        $this->tester->seeRecord('common\models\produto', ['nome' => 'Cebola', 'marca_id' => 2]); 
        $this->tester->dontSeeRecord('common\models\produto', ['nome' => 'Cebola', 'marca_id' => 1]); 
    }

    public function testProdutoCanChangeIvaId()
    {
        $id = $this->tester->haveRecord('common\models\produto', [
            'nome' => 'Cebola',
            'preco' => 2,
            'quantidade' => 10,
            'descricao' => "Cebola dos orientes",
            'categoria_id' => 1,
            'marca_id' => 1,
            'iva_id' => 1,
            'valornutricional_id' => 1    
        ]);

        $this->produto = Produto::findOne($id);
        
        $this->produto->iva_id = 2;
        $this->produto->save();
        
        $this->tester->seeRecord('common\models\produto', ['nome' => 'Cebola', 'iva_id' => 2]); 
        $this->tester->dontSeeRecord('common\models\produto', ['nome' => 'Cebola', 'iva_id' => 1]); 
    }

    public function testProdutoCanChangeValorNutricionalId()
    {
        $id = $this->tester->haveRecord('common\models\produto', [
            'nome' => 'Cebola',
            'preco' => 2,
            'quantidade' => 10,
            'descricao' => "Cebola dos orientes",
            'categoria_id' => 1,
            'marca_id' => 1,
            'iva_id' => 1,
            'valornutricional_id' => 1    
        ]);

        $this->produto = Produto::findOne($id);
        
        $this->produto->valornutricional_id = 2;
        $this->produto->save();
        
        $this->tester->seeRecord('common\models\produto', ['nome' => 'Cebola', 'valornutricional_id' => 2]); 
        $this->tester->dontSeeRecord('common\models\produto', ['nome' => 'Cebola', 'valornutricional_id' => 1]); 
    }

    
    public function testProdutoDeleteFromDatabase()
    {
        $id = $this->tester->haveRecord('common\models\produto', [
            'nome' => 'Cebola',
            'preco' => 2,
            'quantidade' => 10,
            'descricao' => "Cebola dos orientes",
            'categoria_id' => 1,
            'marca_id' => 1,
            'iva_id' => 1,
            'valornutricional_id' => 1    
        ]);

        $this->produto = Produto::findOne($id);
        
        $this->tester->seeRecord('common\models\produto', ['nome' => 'Cebola']);

        $this->produto->delete();

        $this->tester->dontSeeRecord('common\models\produto', ['nome' => 'Cebola']);
    }
}
