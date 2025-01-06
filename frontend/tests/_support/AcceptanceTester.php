<?php

declare(strict_types=1);

namespace frontend\tests;

use yii\helpers\Url;

/**
 * Inherited Methods
 * @method void wantTo($text)
 * @method void wantToTest($text)
 * @method void execute($callable)
 * @method void expectTo($prediction)
 * @method void expect($prediction)
 * @method void amGoingTo($argumentation)
 * @method void am($role)
 * @method void lookForwardTo($achieveValue)
 * @method void comment($description)
 * @method void pause($vars = [])
 *
 * @SuppressWarnings(PHPMD)
*/
class AcceptanceTester extends \Codeception\Actor
{
    use _generated\AcceptanceTesterActions;


    public function seeFlashSuccess($message)
    {
        $this->see($message, '.alert-success');
    }

    public function seeFlashError($message)
    {
        $this->see($message, '.alert-danger');
    }

    public function seeValidationError($message)
    {
        $this->see($message, '.invalid-feedback');
    }

    public function dontSeeValidationError($message)
    {
        $this->dontSee($message, '.invalid-feedback');
    }
    
    public function login($name, $password)
    {
        $I = $this;
        $I->amOnPage('site/login');
        $I->wait(3);
        $I->submitForm('#login-form', [
            'LoginForm[username]' => $name,
            'LoginForm[password]' => $password
        ]);
        $I->wait(3);
        $I->see($name, '.navbar');
    }
}
