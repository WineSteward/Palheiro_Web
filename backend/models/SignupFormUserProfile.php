<?php

namespace backend\models;

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


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['nif', 'trim'],
            ['nif', 'required'],
            ['nif', 'unique', 'targetClass' => '\common\models\Userprofile', 'message' => 'This nif has already been taken.'],
            ['nif', 'string', 'min' => 5, 'max' => 9],

            ['morada', 'required'],
            ['morada', 'string', 'min' => 2, 'max' => 30],

            ['morada2', 'string', 'min' => 2, 'max' => 30],

            ['codigoPostal', 'trim'],
            ['codigoPostal', 'required'],
            ['codigoPostal', 'string', 'min' => 8, 'max' => 8],

        ];
    }

    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function signup($user_id, $carrinho)
    {
        if (!$this->validate()) {
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
