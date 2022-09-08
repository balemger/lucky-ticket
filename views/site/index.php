<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\TicketForm $model */
/** @var $numberOfTickets */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'The lucky ticket';
?>
<div class="site-index">
    <div class="body-content">
        <?php $form = ActiveForm::begin(['id' => 'ticket-form']); ?>
            <div class="row">
                <div class="col-4">
                    <?= $form->field($model, 'nFrom')->widget(\yii\widgets\MaskedInput::class, [
                        'mask' => '999999',
                        'clientOptions' => [
                            'alias' =>  'decimal'
                        ],
                    ]) ?>
                </div>
                <div class="col-4">
                    <?= $form->field($model, 'nTo')->widget(\yii\widgets\MaskedInput::class, [
                        'mask' => '999999',
                        'clientOptions' => [
                            'alias' =>  'decimal'
                        ],
                    ]) ?>
                </div>
                <div class="col-12">
                    <div class="form-group mt-2">
                        <?= Html::submitButton('Run', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                    </div>
                </div>
            </div>
        <?php ActiveForm::end(); ?>
        <div class="col-lg-12 mt-3">
            <p>Number of tickets: <?php
                echo "<pre>";
                var_dump($numberOfTickets2);
                var_dump($numberOfTickets);
                ?></p>
        </div>
    </div>
</div>
