<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Orders */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="orders-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'offerprice')->textInput() ?>

    <?= $form->field($model, 'pickuplocation')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pickuplocationtype')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pickupdate1')->textInput() ?>

    <?= $form->field($model, 'pickupdate2')->textInput() ?>

    <?= $form->field($model, 'pickupcond')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'deliverylocation')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'deliverylocationtype')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'deliverydate1')->textInput() ?>

    <?= $form->field($model, 'deliverydate2')->textInput() ?>

    <?= $form->field($model, 'deliverycond')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'createdon')->textInput() ?>

    <?= $form->field($model, 'updatedon')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
