<?php 
namespace backend\models;

use common\models\Imagem;
use Yii;
use yii\base\Model;
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
                //validations

                //check if folder exists
                
                //if yes, proceed to save the img to that folder

                //if no, create a folder and save the img
                $path = 'frontend/web/img/product/' . Yii::$app->getSecurity()->generateRandomString() . '.' . $file->extension;
                $file->saveAs($path);
                
                $imagem = new Imagem();
                $imagem->ficheiro = $path;
                $imagem->produto_id = $produto_id;

            }
            return true;
        }
        else 
        {
            return false;
        }
    }
}