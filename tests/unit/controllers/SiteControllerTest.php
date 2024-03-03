<?php
namespace test\unit\Controllers;
use app\controller\SiteController;
use Yii;

class SiteControllerTest extends \Codeception\Test\Unit
{
    public function testActionIndex(){
        $controller = new SiteController('site',Yii::$app);
        $response = $controller->actionIndex();

        $this->assertStringContainsString('Congratulations!',$response);
        $this->assertStringNotContainsString('Go to the login page',$response);
    }

    // public function testActionSignupUserSuccess(){
    //     $request_mock = $this -> createMock(Request::class);
    //     $request_mock->method('post')->willReturn(
    //         'SingupForm' => [
    //             'username' => 'dev01',
    //             'email' => 'dev01@mail.com',
    //             'password' => '123456'
    //         ]        
    //         );
    //     Yii::$app->set('request',$request_mock);
    //     $controller = new SiteController('site',Yii::$app);
    //     $response = $controller
    // }
}

