<?php

namespace backend\models;

use common\models\Carrinho;
use common\models\User;
use Yii;
use yii\base\Model;
use common\models\Userprofile;

/**
 * Signup form
 */
class SignupFormUserProfile extends Model
{
    public $nif;
    public $morada;
    public $morada2;
    public $codigoPostal;
    public $user_id;
    public $carrinho_id;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nif', 'morada', 'codigoPostal'], 'required'],
            [['user_id', 'carrinho_id'], 'integer'],
            [['nif', 'morada', 'morada2', 'codigoPostal'], 'string', 'max' => 30],
            ['nif', 'string', 'min' => 9, 'max' => 9, 'tooShort' => 'NIF must be exactly 9.', 'tooLong' => 'NIF must be exactly 9.'],
            ['nif', 'unique', 'targetClass' => Userprofile::class],
            ['morada', 'string', 'min' => 2, 'max' => 30],
            ['morada2', 'string', 'min' => 2, 'max' => 30],
            ['codigoPostal', 'string', 'min' => 8, 'max' => 8],
            ['user_id', 'unique'],
            ['carrinho_id', 'unique'],
            ['carrinho_id', 'exist', 'skipOnError' => true, 'targetClass' => Carrinho::class, 'targetAttribute' => ['carrinho_id' => 'id']],
            ['user_id', 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function signup($user_id, $carrinho)
    {

        if (!$this->validate())
        {
            return null;
        }
        
        $userprofile = new Userprofile();

        $userprofile->nif = $this->nif;
        $userprofile->morada = $this->morada;
        $userprofile->morada2 = $this->morada2;
        $userprofile->codigoPostal = $this->codigoPostal;
        $userprofile->user_id = $user_id;
        $userprofile->carrinho_id = $carrinho->id;

        // setting the user as a client
        $auth = Yii::$app->authManager;
        $clientRole = $auth->getRole('client');
        $auth->assign($clientRole, $user_id);
        
        return $userprofile->save();
    }
}
