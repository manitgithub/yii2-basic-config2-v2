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
}
