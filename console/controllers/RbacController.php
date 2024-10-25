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
        $viewProdutos->description = 'User can view Produtos';
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



        //ViewMarcas
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


        
/*         // add "createPost" permission
        $createPost = $auth->createPermission('createPost');
        $createPost->description = 'Create a post';
        $auth->add($createPost);

        // add "updatePost" permission
        $updatePost = $auth->createPermission('updatePost');
        $updatePost->description = 'Update post';
        $auth->add($updatePost);

        // add "author" role and give this role the "createPost" permission
        $author = $auth->createRole('author');
        $auth->add($author);
        $auth->addChild($author, $createPost);

        // add "admin" role and give this role the "updatePost" permission
        // as well as the permissions of the "author" role
        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $updatePost);
        $auth->addChild($admin, $author);

        // Assign roles to users. 1 and 2 are IDs returned by IdentityInterface::getId()
        // usually implemented in your User model.
        $auth->assign($author, 2);
        $auth->assign($admin, 1);
 */
    }
}