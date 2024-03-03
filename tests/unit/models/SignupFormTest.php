<?php
namespace test\unit\models;
use app\models\SignupForm;
use app\models\User;
class SignupFormTest extends \Codeception\Test\Unit
{
    public function testRules()
    {
        $model = new SignupForm();

        // Test valid data
        $model->username = 'testuser';
        $model->email = 'test@example.com';
        $model->password = 'testpassword';
        $this->assertTrue($model->validate());
        
        //test length user name
        $model->username = '12';
        $this->assertTrue($model->validate());

        $model->username = str_repeat('a',255);
        $this->assertTrue($model->validate());

        $model->username = '1';
        $this->assertFalse($model->validate());
        
        $model->username = str_repeat('a',256);
        $this->assertFalse($model->validate());

        // Test missing username
        $model->username = null;
        $this->assertFalse($model->validate());

        // Test missing email
        $model->username = 'testuser';
        $model->email = null;
        $this->assertFalse($model->validate());

        // Test missing password
        $model->email = 'test@example.com';
        $model->password = null;
        $this->assertFalse($model->validate());

        // Test invalid email
        $model->password = 'testpassword';
        $model->email = 'invalidemail';
        $this->assertFalse($model->validate());

        // Test username length less than 2
        $model->email = 'test@example.com';
        $model->username = 'a';
        $this->assertFalse($model->validate());

        // Test username length greater than 255
        $model->username = str_repeat('a', 256);
        $this->assertFalse($model->validate());

        // Test password length less than 6
        $model->username = 'testuser';
        $model->password = '12345';
        $this->assertFalse($model->validate());
    }

    public function testSignup()
    {
        $model = new SignupForm();        
        $model->username = 'testuser';
        $model->email = 'test@example.com';
        $model->password = 'testpassword';
        

        // Test successful signup
        // $this->assertInstanceOf(User::class, $user);
        // $this->assertEquals('testuser', $user->username);
        // $this->assertEquals('test@example.com', $user->email);

        // Test failed signup (username already exists)
        // $model->username = 'testuser'; // Existing username
        // $model->email = 'newemail@example.com';
        // $model->password = 'testpassword';
        // $this->assertNull($model->signup());

        // // Test failed signup (email already exists)        
        // $model->username = 'newuser';
        // $model->email = 'test@example.com'; // Existing email
        // $model->password = 'testpassword';
        // $this->assertNull($model->signup());

        //insert database success
        // $newUser = User::findByUsername($model->username);
        // $this->assertNotEmpty($newUser->username);

        //fail
        $model->username ="";
        $user = $model->signup();
        $this->assertNull($user);
    }
}