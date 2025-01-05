<?php

namespace frontend\tests\functional;

use common\models\Userprofile;
use frontend\tests\FunctionalTester;

class SignupCest
{
    protected $formId = '#submit-form';

    public function _before(FunctionalTester $I)
    {
        $I->amOnRoute('site/signup');
    }

    public function signupWithEmptyFields(FunctionalTester $I)
    {
        $I->see('Signup', 'h2');
        $I->submitForm($this->formId, []);
        $I->see('Username cannot be blank.', '.help-block');
        $I->see('Email cannot be blank.', '.help-block');
        $I->see('Password cannot be blank.', '.help-block');
        $I->see('Nif cannot be blank.', '.help-block');
        $I->see('Morada cannot be blank.', '.help-block');
        $I->see('Codigo Postal cannot be blank.', '.help-block');   
    }

    public function signupWithWrongEmail(FunctionalTester $I)
    {
        $I->submitForm(
            $this->formId, [
            'SignupFormUser[username]'  => 'andreia',
            'SignupFormUser[email]'     => 'ttttt',
            'SignupFormUser[password]'  => 'tester_password',
            'SignupFormUserProfile[nif]' => '987654321',
            'SignupFormUserProfile[morada]' => 'Morada teste',
            'SignupFormUserProfile[codigoPostal]' => '1234-123'
        ]
        );
        $I->dontSee('Username cannot be blank.', '.help-block');
        $I->dontSee('Email cannot be blank.', '.help-block');
        $I->dontSee('Password cannot be blank.', '.help-block');
        $I->dontSee('Nif cannot be blank.', '.help-block');
        $I->dontSee('Morada cannot be blank.', '.help-block');
        $I->dontSee('Codigo Postal cannot be blank.', '.help-block');
        $I->see('Email is not a valid email address.', '.help-block');
    }

    public function signupWithEmailAlreadyInUse(FunctionalTester $I)
    {
        $I->submitForm(
            $this->formId, [
            'SignupFormUser[username]'  => 'andreia',
            'SignupFormUser[email]'     => 'miguel@email.com',
            'SignupFormUser[password]'  => '12312312',
            'SignupFormUserProfile[nif]' => '987654321',
            'SignupFormUserProfile[morada]' => 'Morada teste',
            'SignupFormUserProfile[codigoPostal]' => '1234-123'
        ]
        );

        $I->dontSee('Username cannot be blank.', '.help-block');
        $I->dontSee('Email cannot be blank.', '.help-block');
        $I->dontSee('Password cannot be blank.', '.help-block');
        $I->dontSee('Nif cannot be blank.', '.help-block');
        $I->dontSee('Morada cannot be blank.', '.help-block');
        $I->dontSee('Codigo Postal cannot be blank.', '.help-block');
        $I->see('This email address has already been taken', '.help-block');
    
    }

    public function signupWithUsernameAlreadyInUse(FunctionalTester $I)
    {
        $I->submitForm(
            $this->formId, [
            'SignupFormUser[username]'  => 'miguel',
            'SignupFormUser[email]'     => 'andreia@email.com',
            'SignupFormUser[password]'  => '21123',
            'SignupFormUserProfile[nif]' => '987654321',
            'SignupFormUserProfile[morada]' => 'Morada teste',
            'SignupFormUserProfile[codigoPostal]' => '1234-123'
        ]
        );

        $I->dontSee('Username cannot be blank.', '.help-block');
        $I->dontSee('Email cannot be blank.', '.help-block');
        $I->dontSee('Password cannot be blank.', '.help-block');
        $I->dontSee('Nif cannot be blank.', '.help-block');
        $I->dontSee('Morada cannot be blank.', '.help-block');
        $I->dontSee('Codigo Postal cannot be blank.', '.help-block');
        $I->see('This username has already been taken', '.help-block');
    
    }

    public function signupSuccessfully(FunctionalTester $I)
    {
        $I->submitForm(
            $this->formId, [
            'SignupFormUser[username]'  => 'tester',
            'SignupFormUser[email]'     => 'tester@email.com',
            'SignupFormUser[password]'  => 'tester_password',
            'SignupFormUserProfile[nif]' => '987654321',
            'SignupFormUserProfile[morada]' => 'Morada teste',
            'SignupFormUserProfile[codigoPostal]' => '1234-123'
        ]
        );

        $I->seeRecord(Userprofile::class, [
            'nif' => '987654321',
            'morada' => 'Morada teste',
            'codigoPostal' => '1234-123'
        ]);

        $I->seeRecord('common\models\User', [
            'username' => 'tester',
            'email' => 'tester@email.com',
            'status' => \common\models\User::STATUS_ACTIVE
        ]);

        $I->see('O seu registo foi concluido com sucesso!');
    }
}
