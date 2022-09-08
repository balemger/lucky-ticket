<?php

namespace app\controllers;

use app\models\TicketForm;
use Yii;
use yii\web\Controller;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ]
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $numberOfTickets = 'XXX';
        $numberOfTickets2 = '';
        $model = new TicketForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $numberOfTickets = $model->getLuckyTicketCount();
            $numberOfTickets2 = $model->getMathLuckyTicketCount();
        }
        return $this->render('index', [
            'model' => $model,
            'numberOfTickets' => $numberOfTickets,
            'numberOfTickets2' => $numberOfTickets2,
        ]);
    }
}
