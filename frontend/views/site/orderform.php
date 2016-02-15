<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $ordermodel common\models\Orders */
/* @var $orderinfomodel common\models\OrderInfo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="orders-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($ordermodel, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($ordermodel, 'description')->textInput(['maxlength' => true]) ?>

    

    <?= $form->field($ordermodel, 'offerprice')->textInput() ?>

    <?= $form->field($ordermodel, 'pickuplocation')->textInput(['maxlength' => true]) ?>

    <?= $form->field($ordermodel, 'pickuplocationtype')->textInput(['maxlength' => true])->dropDownList(
            ['residential'=>'Residential','office'=>'Office']           
        ); ?>
    
    <div class="form-group field-orders-pickupdate1 required ">
        <label class="control-label" for="orders-pickuplocationtype">Pickup Date</label>
        <?= DatePicker::widget([
    'name' => 'pickupdate1', 
    'value' => date('d-M-Y', strtotime('+2 days')),
    'options' => ['placeholder' => 'Select issue date ...'],
    'pluginOptions' => [
        'format' => 'dd-M-yyyy',
        'todayHighlight' => true
    ]
    ]);
    ?>
        
    </div>
    
    <div class="form-group field-orders-pickupdate2 ">
        <label class="control-label" for="orders-pickupdate2">Pickup Date</label>
        <?= DatePicker::widget([
    'name' => 'pickupdate2', 
    'value' => date('d-M-Y', strtotime('+2 days')),
    'options' => ['placeholder' => 'Select issue date ...'],
    'pluginOptions' => [
        'format' => 'dd-M-yyyy',
        'todayHighlight' => true
    ]
    ]);
    ?>
        
    </div>
    
    
    

    <?= $form->field($ordermodel, 'pickupcond')->textInput(['maxlength' => true]) ->dropDownList(
            ['before'=>'Before','after'=>'After','between'=>'Between']
           
        );
 ?>

    <?= $form->field($ordermodel, 'deliverylocation')->textInput(['maxlength' => true]) ?>

    <?= $form->field($ordermodel, 'deliverylocationtype')->textInput(['maxlength' => true])->dropDownList(
            ['residential'=>'Residential','office'=>'Office']
           
        ); ?>
    
    <div class="form-group field-orders-deliverydate1 required ">
        <label class="control-label" for="orders-deliverydate2">Delivery Date</label>
        <?= DatePicker::widget([
    'name' => 'deliverydate1', 
    'value' => date('d-M-Y', strtotime('+2 days')),
    'options' => ['placeholder' => 'Select issue date ...'],
    'pluginOptions' => [
        'format' => 'dd-M-yyyy',
        'todayHighlight' => true
    ]
    ]);
    ?>
        
    </div>
    
    <div class="form-group field-orders-deliverydate2  ">
        <label class="control-label" for="orders-deliverydate2">Delivery Date</label>
        <?= DatePicker::widget([
    'name' => 'deliverydate2', 
    'value' => date('d-M-Y', strtotime('+2 days')),
    'options' => ['placeholder' => 'Select issue date ...'],
    'pluginOptions' => [
        'format' => 'dd-M-yyyy',
        'todayHighlight' => true
    ]
    ]);
    ?>
        
    </div>

    <?= $form->field($ordermodel, 'deliverycond')->textInput(['maxlength' => true])->dropDownList(
            ['before'=>'Before','after'=>'After','between'=>'Between']
           
        ); ?>

    

    <!--  order info -->
    
    

    <?= $form->field($orderinfomodel, 'width')->textInput() ?>

    <?= $form->field($orderinfomodel, 'height')->textInput() ?>

    <?= $form->field($orderinfomodel, 'length')->textInput() ?>

    <?= $form->field($orderinfomodel, 'weight')->textInput() ?>

    <?= $form->field($orderinfomodel, 'breakable')->textInput()->dropDownList(
            ['0'=>'No','1'=>'Yes']
           
        ); ?>

    <?= $form->field($orderinfomodel, 'wooden')->textInput()->dropDownList(
            ['0'=>'No','1'=>'Yes']
           
        ); ?>

    <?= $form->field($orderinfomodel, 'packed')->textInput()->dropDownList(
            ['0'=>'No','1'=>'Yes']
           
        ); ?>

    <?= $form->field($orderinfomodel, 'packagetype')->textInput(['maxlength' => true])->dropDownList(
            ['woodenitem'=>'Wooden Item','glass'=>'Glass']
           
        ); ?>

    
    
    
    
    <div class="form-group">
        <?= Html::submitButton('Place Order',['class' => $ordermodel->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
