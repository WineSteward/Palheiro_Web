<?php 
namespace backend\models;

use common\models\Imagem;
use Yii;
use yii\base\Model;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;

class UploadForm extends Model
{
    /**
     * @var UploadedFile[]
     */
    public $imageFiles;

    public function rules()
    {
        return [
            [['imageFiles'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg', 'maxFiles' => 4],
        ];
    }
    
    public function upload($produto_id)
    {
        if ($this->validate()) 
        {
            foreach ($this->imageFiles as $file) 
            {

                $imageFolder = Yii::getAlias('@web/products/');

                
                if (file_exists($imageFolder))
                {
                    $path = Yii::$app->getSecurity()->generateRandomString() . '.' . $file->extension;
                    
                    $file->saveAs('products/' . $path);
                    
                    $imagem = new Imagem();
                    $imagem->ficheiro = $path;
                    $imagem->produto_id = $produto_id;
                    
                    $imagem->save();
                }
                else
                {
                    FileHelper::createDirectory($imageFolder);

                    $path = Yii::$app->getSecurity()->generateRandomString() . '.' . $file->extension;
                    $file->saveAs($path);
                    
                    $imagem = new Imagem();
                    $imagem->ficheiro = $path;
                    $imagem->produto_id = $produto_id;
                }
                

            }
            return true;
        }
        else 
        {
            return false;
        }
    }
}