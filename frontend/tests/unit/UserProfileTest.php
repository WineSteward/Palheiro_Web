<?php


namespace frontend\tests\Unit;

use common\models\Carrinho;
use common\models\User;
use common\models\Userprofile;
use frontend\tests\UnitTester;

class UserTest extends \Codeception\Test\Unit
{

    protected UnitTester $tester;
    protected $profile;
    protected $user;
    protected $carrinho;

    protected function _before()
    {
        $id = $this->tester->haveRecord(User::class, [
            'username' => 'teste_user',
            'email' => "user_teste@email.com",
            'password' => "123456789"
        ]);

        $carrinho_id = $this->tester->haveRecord(Carrinho::class, [
            'total' => 0
        ]);

        $this->user = User::findOne($id);

        $this->carrinho = Carrinho::findOne($carrinho_id);

        $this->profile = new Userprofile();
    }

    public function testUserProfileValidationNIF()
    {
        $this->profile->nif = '111111111'; //already assigned
        expect($this->profile->validate(['nif']))->ToBeFalse();

        $this->profile->nif = '1111111111111111111111111111111'; //to long
        expect($this->profile->validate(['nif']))->ToBeFalse();

        $this->profile->nif = 'string'; //wrong type
        expect($this->profile->validate(['nif']))->ToBeFalse();

        $this->profile->nif = 123; //wrong type
        expect($this->profile->validate(['nif']))->ToBeFalse();

        $this->profile->nif = 12.21; //wrong type
        expect($this->profile->validate(['nif']))->ToBeFalse();

        $this->profile->nif = null; //null
        expect($this->profile->validate(['nif']))->ToBeFalse();

        $this->profile->nif = '852852852';
        expect($this->profile->validate(['nif']))->ToBeTrue();
    }

    public function testUserProfileValidationMorada()
    {
        $this->profile->morada = 'TOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOO LOOOOOOOOOOOOOOOONG'; //to long
        expect($this->profile->validate(['morada']))->ToBeFalse();

        $this->profile->codigoPostal = '1'; //to short
        expect($this->profile->validate(['morada']))->ToBeFalse();

        $this->profile->morada = 123; //wrong type
        expect($this->profile->validate(['morada']))->ToBeFalse();

        $this->profile->morada = 12.21; //wrong type
        expect($this->profile->validate(['morada']))->ToBeFalse();

        $this->profile->morada = null; //null
        expect($this->profile->validate(['morada']))->ToBeFalse();

        $this->profile->morada = 'Morada da Rua';
        expect($this->profile->validate(['morada']))->ToBeTrue();
    }

    public function testUserProfileValidationMorada2()
    {
        $this->profile->morada2 = 'TOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOO LOOOOOOOOOOOOOOOONG'; //to long
        expect($this->profile->validate(['morada2']))->ToBeFalse();

        $this->profile->codigoPostal = 'a'; //to short
        expect($this->profile->validate(['morada2']))->ToBeFalse();

        $this->profile->morada2 = 123; //wrong type
        expect($this->profile->validate(['morada2']))->ToBeFalse();

        $this->profile->morada2 = 12.21; //wrong type
        expect($this->profile->validate(['morada2']))->ToBeFalse();

        $this->profile->morada2 = null; //null
        expect($this->profile->validate(['morada2']))->ToBeTrue();

        $this->profile->morada2 = 'Morada da Rua';
        expect($this->profile->validate(['morada2']))->ToBeTrue();
    }

    public function testUserProfileValidationCodigoPostal()
    {
        $this->profile->codigoPostal = 'TOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOO LOOOOOOOOOOOOOOOONG'; //to long
        expect($this->profile->validate(['codigoPostal']))->ToBeFalse();

        $this->profile->codigoPostal = '1'; //to short
        expect($this->profile->validate(['codigoPostal']))->ToBeFalse();

        $this->profile->codigoPostal = 123; //wrong type
        expect($this->profile->validate(['codigoPostal']))->ToBeFalse();

        $this->profile->codigoPostal = 12.21; //wrong type
        expect($this->profile->validate(['codigoPostal']))->ToBeFalse();

        $this->profile->codigoPostal = null; //null
        expect($this->profile->validate(['codigoPostal']))->ToBeFalse();

        $this->profile->codigoPostal = '1234-123';
        expect($this->profile->validate(['codigoPostal']))->ToBeTrue();
    }

    public function testUserProfileValidationUserId()
    {
        $this->profile->user_id = 'wrong type';
        expect($this->profile->validate(['user_id']))->ToBeFalse();

        $this->profile->user_id = 999; //donest exist
        expect($this->profile->validate(['user_id']))->ToBeFalse();

        $this->profile->user_id = 12.21; //wrong type
        expect($this->profile->validate(['user_id']))->ToBeFalse();

        $this->profile->user_id = null; //null
        expect($this->profile->validate(['user_id']))->ToBeFalse();

        $this->profile->user_id = $this->user->id;
        expect($this->profile->validate(['user_id']))->ToBeTrue();
    }

    public function testUserProfileValidationCarrinhoId()
    {
        $this->profile->carrinho_id = 'wrong type';
        expect($this->profile->validate(['carrinho_id']))->ToBeFalse();

        $this->profile->carrinho_id = 999; //donest exist
        expect($this->profile->validate(['carrinho_id']))->ToBeFalse();

        $this->profile->carrinho_id = 12.21; //wrong type
        expect($this->profile->validate(['carrinho_id']))->ToBeFalse();

        $this->profile->carrinho_id = null; //null
        expect($this->profile->validate(['carrinho_id']))->ToBeFalse();

        $this->profile->carrinho_id = $this->carrinho->id;
        expect($this->profile->validate(['carrinho_id']))->ToBeTrue();
    }

    public function testUserProfileAddToDatabase()
    {
        $this->profile->morada = "morada nova";
        $this->profile->codigoPostal = "2134-123";
        $this->profile->nif = "753753753";
        $this->profile->user_id = $this->user->id;
        $this->profile->carrinho_id = $this->carrinho->id;

        $this->profile->save();

        $this->tester->seeRecord(Userprofile::class, [
            'morada' => 'morada nova',
            'codigoPostal' => '2134-123',
            'nif' => '753753753',
            'user_id' => $this->user->id,
            'carrinho_id' => $this->carrinho->id
        ]);
    }

    public function testUserProfileCanChangeMorada()
    {
        $id = $this->tester->haveRecord(Userprofile::class, [
            'morada' => 'morada velha',
            'codigoPostal' => '2134-123',
            'nif' => '753753753',
            'user_id' => $this->user->id,
            'carrinho_id' => $this->carrinho->id
        ]);

        $this->profile = Userprofile::findOne($id);

        $this->profile->morada = "morada nova";
        $this->profile->save();

        $this->tester->seeRecord(Userprofile::class, [
            'morada' => 'morada nova',
            'codigoPostal' => '2134-123',
            'nif' => '753753753',
            'user_id' => $this->user->id,
            'carrinho_id' => $this->carrinho->id
        ]);

        $this->tester->dontSeeRecord(Userprofile::class, [
            'morada' => 'morada velha',
            'codigoPostal' => '2134-123',
            'nif' => '753753753',
            'user_id' => $this->user->id,
            'carrinho_id' => $this->carrinho->id
        ]);
    }

    public function testUserProfileCanChangeMorada2()
    {
        $id = $this->tester->haveRecord(Userprofile::class, [
            'morada' => 'morada velha',
            'morada2' => 'morada2 velha',
            'codigoPostal' => '2134-123',
            'nif' => '753753753',
            'user_id' => $this->user->id,
            'carrinho_id' => $this->carrinho->id
        ]);

        $this->profile = Userprofile::findOne($id);

        $this->profile->morada2 = "morada2 nova";
        $this->profile->save();

        $this->tester->seeRecord(Userprofile::class, [
            'morada' => 'morada velha',
            'morada2' => 'morada2 nova',
            'codigoPostal' => '2134-123',
            'nif' => '753753753',
            'user_id' => $this->user->id,
            'carrinho_id' => $this->carrinho->id
        ]);

        $this->tester->dontSeeRecord(Userprofile::class, [
            'morada' => 'morada velha',
            'morada2' => 'morada2 velha',
            'codigoPostal' => '2134-123',
            'nif' => '753753753',
            'user_id' => $this->user->id,
            'carrinho_id' => $this->carrinho->id
        ]);
    }

    public function testUserProfileCanChangeCodigoPostal()
    {
        $id = $this->tester->haveRecord(Userprofile::class, [
            'morada' => 'morada velha',
            'codigoPostal' => '9999-999',
            'nif' => '753753753',
            'user_id' => $this->user->id,
            'carrinho_id' => $this->carrinho->id
        ]);

        $this->profile = Userprofile::findOne($id);

        $this->profile->codigoPostal = "1111-111";
        $this->profile->save();

        $this->tester->seeRecord(Userprofile::class, [
            'morada' => 'morada velha',
            'codigoPostal' => '1111-111',
            'nif' => '753753753',
            'user_id' => $this->user->id,
            'carrinho_id' => $this->carrinho->id
        ]);

        $this->tester->dontSeeRecord(Userprofile::class, [
            'morada' => 'morada velha',
            'codigoPostal' => '9999-999',
            'nif' => '753753753',
            'user_id' => $this->user->id,
            'carrinho_id' => $this->carrinho->id
        ]);
    }

    public function testUserprofileDeleteFromDatabase()
    {
        $this->profile->morada = "morada nova";
        $this->profile->codigoPostal = "2134-123";
        $this->profile->nif = "753753753";
        $this->profile->user_id = $this->user->id;
        $this->profile->carrinho_id = $this->carrinho->id;

        $this->profile->save();

        $this->tester->seeRecord(Userprofile::class, [
            'morada' => 'morada nova',
            'codigoPostal' => '2134-123',
            'nif' => '753753753',
            'user_id' => $this->user->id,
            'carrinho_id' => $this->carrinho->id
        ]);

        $this->profile->delete();

        $this->tester->dontSeeRecord(Userprofile::class, [
            'morada' => 'morada nova',
            'codigoPostal' => '2134-123',
            'nif' => '753753753',
            'user_id' => $this->user->id,
            'carrinho_id' => $this->carrinho->id
        ]);
    }
}
