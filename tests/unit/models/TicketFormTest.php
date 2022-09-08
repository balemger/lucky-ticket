<?php

namespace tests\unit\models;

use app\models\TicketForm;
use yii\mail\MessageInterface;

class TicketFormTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    public $tester;

    public function testLuckyTicketCount()
    {
        $model = new TicketForm();

        $model->attributes = [
            'nFrom' => -1,
            'nTo' => 999999,
        ];
        verify($model->getLuckyTicketCount())->equals(0);

        $model->attributes = [
            'nFrom' => 123321,
            'nTo' => 13,
        ];
        verify($model->getLuckyTicketCount())->equals(0);

        $model->attributes = [
            'nFrom' => 123456,
            'nTo' => 123456,
        ];
        verify($model->getLuckyTicketCount())->equals(1);

        $model->attributes = [
            'nFrom' => 1,
            'nTo' => 999999,
        ];
        verify($model->getLuckyTicketCount())->equals(110889);

        $model->attributes = [
            'nFrom' => 1,
            'nTo' => 888888,
        ];
        verify($model->getLuckyTicketCount())->equals(98556);

        $model->attributes = [
            'nFrom' => 123321,
            'nTo' => 345642,
        ];
        verify($model->getLuckyTicketCount())->equals(24679);
    }
}
