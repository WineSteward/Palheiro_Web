<?php
namespace console\controllers;

use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;
        $auth->removeAll();

        //View Produtos
        $viewProdutos = $auth->createPermission('viewProdutos');
        $viewProdutos->description = 'User can viewProdutos';
        $auth->add($viewProdutos);
        
        //Create Produtos
        $createProdutos = $auth->createPermission('createProdutos');
        $createProdutos->description = 'User can create Produtos';
        $auth->add($createProdutos);

        //Edit Produtos
        $editProdutos = $auth->createPermission('editProdutos');
        $editProdutos->description = 'User can edit Produtos';
        $auth->add($editProdutos);

        //Delete Produtos
        $deleteProdutos = $auth->createPermission('deleteProdutos');
        $deleteProdutos->description = 'User can delete Produtos';
        $auth->add($deleteProdutos);

        //View Categorias
        $viewCategorias = $auth->createPermission('viewCategorias');
        $viewCategorias->description = 'User can view Categorias';
        $auth->add($viewCategorias);

        //Create Categorias
        $createCategorias = $auth->createPermission('createCategorias');
        $createCategorias->description = 'User can create Categorias';
        $auth->add($createCategorias);

        //Edit Categorias
        $editCategorias = $auth->createPermission('editCategorias');
        $editCategorias->description = 'User can edit Categorias';
        $auth->add($editCategorias);

        //Delete Categorias
        $deleteCategorias = $auth->createPermission('deleteCategorias');
        $deleteCategorias->description = 'User can delete Categorias';
        $auth->add($deleteCategorias);

        //View Marcas
        $viewMarcas = $auth->createPermission('viewMarcas');
        $viewMarcas->description = 'User can view Marcas';
        $auth->add($viewMarcas);

        //Create Marcas
        $createMarcas = $auth->createPermission('createMarcas');
        $createMarcas->description = 'User can create Marcas';
        $auth->add($createMarcas);

        //Edit Marcas
        $editMarcas = $auth->createPermission('editMarcas');
        $editMarcas->description = 'User can edit Marcas';
        $auth->add($editMarcas);

        //Delete Marcas
        $deleteMarcas = $auth->createPermission('deleteMarcas');
        $deleteMarcas->description = 'User can delete Marcas';
        $auth->add($deleteMarcas);


        //View Ivas
        $viewIvas = $auth->createPermission('viewIvas');
        $viewIvas->description = 'User can view Ivas';
        $auth->add($viewIvas);

        //Create Ivas
        $createIvas = $auth->createPermission('createIvas');
        $createIvas->description = 'User can create Ivas';
        $auth->add($createIvas);

        //Edit Ivas
        $editIvas = $auth->createPermission('editIvas');
        $editIvas->description = 'User can edit Ivas';
        $auth->add($editIvas);

        //Delete Ivas
        $deleteIvas = $auth->createPermission('deleteIvas');
        $deleteIvas->description = 'User can delete Ivas';
        $auth->add($deleteIvas);



        //View Imagens
        $viewImagens = $auth->createPermission('viewImagens');
        $viewImagens->description = 'User can view Imagens';
        $auth->add($viewImagens);

        //Create Imagens
        $createImagens = $auth->createPermission('createImagens');
        $createImagens->description = 'User can create Imagens';
        $auth->add($createImagens);

        //Edit Imagens
        $editImagens = $auth->createPermission('editImagens');
        $editImagens->description = 'User can edit Imagens';
        $auth->add($editImagens);

        //Delete Imagens
        $deleteImagens = $auth->createPermission('deleteImagens');
        $deleteImagens->description = 'User can delete Imagens';
        $auth->add($deleteImagens);



        //View LinhasCarrinho
        $viewLinhasCarrinho = $auth->createPermission('viewLinhasCarrinho');
        $viewLinhasCarrinho->description = 'User can view LinhasCarrinho';
        $auth->add($viewLinhasCarrinho);

        //Create LinhasCarrinho
        $createLinhasCarrinho = $auth->createPermission('createLinhasCarrinho');
        $createLinhasCarrinho->description = 'User can create LinhasCarrinho';
        $auth->add($createLinhasCarrinho);

        //Edit LinhasCarrinho
        $editLinhasCarrinho = $auth->createPermission('editLinhasCarrinho');
        $editLinhasCarrinho->description = 'User can edit LinhasCarrinho';
        $auth->add($editLinhasCarrinho);

        //Delete LinhasCarrinho
        $deleteLinhasCarrinho = $auth->createPermission('deleteLinhasCarrinho');
        $deleteLinhasCarrinho->description = 'User can delete LinhasCarrinho';
        $auth->add($deleteLinhasCarrinho);



        //View Carrinho
        $viewCarrinho = $auth->createPermission('viewCarrinho');
        $viewCarrinho->description = 'User can view Carrinho';
        $auth->add($viewCarrinho);

        //Create Carrinho
        $createCarrinho = $auth->createPermission('createCarrinho');
        $createCarrinho->description = 'User can create Carrinho';
        $auth->add($createCarrinho);



        //View Descontos
        $viewDescontos = $auth->createPermission('viewDescontos');
        $viewDescontos->description = 'User can view Descontos';
        $auth->add($viewDescontos);

        //Create Descontos
        $createDescontos = $auth->createPermission('createDescontos');
        $createDescontos->description = 'User can create Descontos';
        $auth->add($createDescontos);

        //Edit Descontos
        $editDescontos = $auth->createPermission('editDescontos');
        $editDescontos->description = 'User can edit Descontos';
        $auth->add($editDescontos);

        //Delete Descontos
        $deleteDescontos = $auth->createPermission('deleteDescontos');
        $deleteDescontos->description = 'User can delete Descontos';
        $auth->add($deleteDescontos);



        //View MetodosExpedicao
        $viewMetodosExpedicao = $auth->createPermission('viewMetodosExpedicao');
        $viewMetodosExpedicao->description = 'User can view MetodosExpedicao';
        $auth->add($viewMetodosExpedicao);

        //Create MetodosExpedicao
        $createMetodosExpedicao = $auth->createPermission('createMetodosExpedicao');
        $createMetodosExpedicao->description = 'User can create MetodosExpedicao';
        $auth->add($createMetodosExpedicao);

        //Edit MetodosExpedicao
        $editMetodosExpedicao = $auth->createPermission('editMetodosExpedicao');
        $editMetodosExpedicao->description = 'User can edit MetodosExpedicao';
        $auth->add($editMetodosExpedicao);

        //Delete MetodosExpedicao
        $deleteMetodosExpedicao = $auth->createPermission('deleteMetodosExpedicao');
        $deleteMetodosExpedicao->description = 'User can delete MetodosExpedicao';
        $auth->add($deleteMetodosExpedicao);
        



        //View MetodosPagamento
        $viewMetodosPagamento = $auth->createPermission('viewMetodosPagamento');
        $viewMetodosPagamento->description = 'User can view MetodosPagamento';
        $auth->add($viewMetodosPagamento);

        //Create MetodosPagamento
        $createMetodosPagamento = $auth->createPermission('createMetodosPagamento');
        $createMetodosPagamento->description = 'User can create MetodosPagamento';
        $auth->add($createMetodosPagamento);

        //Edit MetodosPagamento
        $editMetodosPagamento = $auth->createPermission('editMetodosPagamento');
        $editMetodosPagamento->description = 'User can edit MetodosPagamento';
        $auth->add($editMetodosPagamento);

        //Delete MetodosPagamento
        $deleteMetodosPagamento = $auth->createPermission('deleteMetodosPagamento');
        $deleteMetodosPagamento->description = 'User can delete MetodosPagamento';
        $auth->add($deleteMetodosPagamento);



        //View Faturas
        $viewFaturas = $auth->createPermission('viewFaturas');
        $viewFaturas->description = 'User can view Faturas';
        $auth->add($viewFaturas);

        //Create Faturas
        $createFaturas = $auth->createPermission('createFaturas');
        $createFaturas->description = 'User can create Faturas';
        $auth->add($createFaturas);

        //Edit Faturas
        $editFaturas = $auth->createPermission('editFaturas');
        $editFaturas->description = 'User can edit Faturas';
        $auth->add($editFaturas);

        //Delete Faturas
        $deleteFaturas = $auth->createPermission('deleteFaturas');
        $deleteFaturas->description = 'User can delete Faturas';        
        $auth->add($deleteFaturas);


        //View LinhasFatura
        $viewLinhasFatura = $auth->createPermission('viewLinhasFatura');
        $viewLinhasFatura->description = 'User can view LinhasFatura';
        $auth->add($viewLinhasFatura);

        //Create LinhasFatura
        $createLinhasFatura = $auth->createPermission('createLinhasFatura');
        $createLinhasFatura->description = 'User can createLinhasFatura';
        $auth->add($createLinhasFatura);

        //Edit LinhasFatura
        $editLinhasFatura = $auth->createPermission('editLinhasFatura');
        $editLinhasFatura->description = 'User can edit LinhasFatura';
        $auth->add($editLinhasFatura);

        //Delete LinhasFatura
        $deleteLinhasFatura = $auth->createPermission('deleteLinhasFatura');
        $deleteLinhasFatura->description = 'User can delete LinhasFatura';
        $auth->add($deleteLinhasFatura);



        //View Listas
        $viewListas = $auth->createPermission('viewListas');
        $viewListas->description = 'User can view Listas';
        $auth->add($viewListas);

        //Create Listas
        $createListas = $auth->createPermission('createListas');
        $createListas->description = 'User can createListas';
        $auth->add($createListas);

        //Edit Listas
        $editListas = $auth->createPermission('editListas');
        $editListas->description = 'User can edit Listas';
        $auth->add($editListas);

        //Delete Listas
        $deleteListas = $auth->createPermission('deleteListas');
        $deleteListas->description = 'User can delete Listas';
        $auth->add($deleteListas);



        //View Listas
        $viewTarefas = $auth->createPermission('viewTarefas');
        $viewTarefas->description = 'User can view Tarefas';
        $auth->add($viewTarefas);

        //Create Tarefas
        $createTarefas = $auth->createPermission('createTarefas');
        $createTarefas->description = 'User can createTarefas';
        $auth->add($createTarefas);

        //Edit Tarefas
        $editTarefas = $auth->createPermission('editTarefas');
        $editTarefas->description = 'User can edit Tarefas';
        $auth->add($editTarefas);

        //Delete Tarefas
        $deleteTarefas = $auth->createPermission('deleteTarefas');
        $deleteTarefas->description = 'User can delete Tarefas';
        $auth->add($deleteTarefas);

        // create all the roles
        $client = $auth->createRole('client');
        $admin = $auth->createRole('admin');
        $employee = $auth->createRole('employee');

        $auth->add($client);
        $auth->add($admin);
        $auth->add($employee);

        $auth->addChild($admin, $employee);

        // associate all the roles with their permissions

        $auth->addChild($client, $viewTarefas);
        $auth->addChild($admin, $viewTarefas);

        $auth->addChild($admin, $createTarefas);
        
        $auth->addChild($client, $editTarefas);
        $auth->addChild($admin, $editTarefas);
        
        $auth->addChild($admin, $deleteTarefas);






        $auth->addChild($client, $viewProdutos);
        $auth->addChild($employee, $viewProdutos);

        $auth->addChild($employee, $createProdutos);
        
        $auth->addChild($employee, $editProdutos);
        
        $auth->addChild($admin, $deleteProdutos);



        $auth->addChild($client, $viewCategorias);
        $auth->addChild($employee, $viewCategorias);

        $auth->addChild($employee, $createCategorias);
        
        $auth->addChild($employee, $editCategorias);

        $auth->addChild($admin, $deleteCategorias);


        $auth->addChild($client, $viewMarcas);
        $auth->addChild($employee, $viewMarcas);
        
        $auth->addChild($employee, $createMarcas);

        $auth->addChild($employee, $editMarcas);
        
        $auth->addChild($admin, $deleteMarcas);

        
        $auth->addChild($client, $viewIvas);
        $auth->addChild($employee, $viewIvas);
        
        $auth->addChild($employee, $createIvas);

        $auth->addChild($employee, $editIvas);

        $auth->addChild($admin, $deleteIvas);


        $auth->addChild($client, $viewImagens);
        $auth->addChild($employee, $viewImagens);

        $auth->addChild($employee, $createImagens);

        $auth->addChild($employee, $editImagens);

        $auth->addChild($admin, $deleteImagens);


        $auth->addChild($client, $viewLinhasCarrinho);

        $auth->addChild($client, $createLinhasCarrinho);

        $auth->addChild($client, $editLinhasCarrinho);

        $auth->addChild($client, $deleteLinhasCarrinho);


        $auth->addChild($client, $viewCarrinho);

        $auth->addChild($client, $createCarrinho);

 
        $auth->addChild($employee, $viewDescontos);

        $auth->addChild($employee, $createDescontos);

        $auth->addChild($employee, $editDescontos);

        $auth->addChild($admin, $deleteDescontos);



        $auth->addChild($client, $viewMetodosExpedicao);
        $auth->addChild($employee, $viewMetodosExpedicao);

        $auth->addChild($employee, $createMetodosExpedicao);

        $auth->addChild($employee, $editMetodosExpedicao);

        $auth->addChild($admin, $deleteMetodosExpedicao);


        $auth->addChild($client, $viewMetodosPagamento);
        $auth->addChild($employee, $viewMetodosPagamento);

        $auth->addChild($employee, $createMetodosPagamento);

        $auth->addChild($employee, $editMetodosPagamento);

        $auth->addChild($admin, $deleteMetodosPagamento);

 
        $auth->addChild($client, $viewFaturas);
        $auth->addChild($employee, $viewFaturas);

        $auth->addChild($client, $createFaturas);

        $auth->addChild($admin, $editFaturas);

        $auth->addChild($admin, $deleteFaturas);

 
        $auth->addChild($client, $viewLinhasFatura);
        $auth->addChild($employee, $viewLinhasFatura);

        $auth->addChild($client, $createLinhasFatura);

        $auth->addChild($admin, $editLinhasFatura);

        $auth->addChild($admin, $deleteLinhasFatura);
 

        $auth->addChild($client, $viewListas);

        $auth->addChild($client, $createListas);

        $auth->addChild($client, $editListas);

        $auth->addChild($client, $deleteListas);

        $auth->assign($admin, 1);
        $auth->assign($client, 2);
    }
}