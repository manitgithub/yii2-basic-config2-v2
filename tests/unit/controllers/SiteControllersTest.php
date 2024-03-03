<?php

namespace tests\unit\controllers;

use app\controllers\SiteController;
use yii\web\Request;

use Yii;

class SiteControllersTest extends \Codeception\Test\Unit
{
    private $model;
    // tests
    public function testActionIndex()
    {
        $controller = new SiteController('site', Yii::$app);
        $response = $controller->actionIndex();
        $this->assertStringContainsString('Congratulations!', $response);
        $this->assertStringContainsString('Get started with Yii', $response);
        $this->assertStringNotContainsString('Go to About', $response);
    }

    public function testActionSingupUser()
    {
        $requert_mock = $this->createMock(Request::class);
        $requert_mock->method('post')->willReturn([
            'SignupForm' => [
                'username' => 'test',
                'email' => 'dev01@gmail',
                'password' => '123456',
            ]
        ]);

        Yii::$app->set('request', $requert_mock);

        $controller = new SiteController('site', Yii::$app);
        $response = $controller->actionSignup();

        $this->assertArrayHasKey('response', $response);
        $this->assertEquals('Ok', $response['response']);
    }


    public function testActionSingupUserFail()
    {
        $requert_mock = $this->createMock(Request::class);
        $requert_mock->method('post')->willReturn([
            'SignupForm' => [
                'username' => 'test',
                'email' => 'dev01@gmail',
            ]
        ]);

        Yii::$app->set('request', $requert_mock);

        $controller = new SiteController('site', Yii::$app);
        $response = $controller->actionSignup();

        $this->assertArrayHasKey('response', $response);
        $this->assertEquals('Error', $response['response']);
    }
}
