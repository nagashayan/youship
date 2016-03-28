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
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h3>Place your order</h3>
                <div class="order-info-form">
                    <?php
                    $form = ActiveForm::begin([
                              
                    ]);
                    ?>
                    <div class="row">
                        <div class="col-xs-12 col-lg-9"> 
                            <?= $form->field($ordermodel, 'title')->textInput(['maxlength' => true]) ?>

                            <?= $form->field($ordermodel, 'description')->textArea(['maxlength' => true]) ?>
                        </div>
                    </div>

                    <div class="row">
                       
                        <div class="col-xs-4 col-lg-3 gps-img-parent">
                            <?= $form->field($ordermodel, 'pickuplocation')->textInput(['maxlength' => true]);?>
                            <img class="gps-symbol" onclick="getLocation('#orders-pickuplocation')" src="<?=DOMAINURL;?>/images/gps.png"/>
                        </div>
                        <div class="col-xs-4 col-lg-3">
                            <?=
                            $form->field($ordermodel, 'pickuplocationtype')->textInput(['maxlength' => true])->dropDownList(
                                    ['residential' => 'Residential', 'office' => 'Office']
                            );
                            ?>
                        </div>
                        <div class="col-xs-4 col-lg-3">
                            <div class="form-group field-orders-pickupdate1 required ">
                                <label class="control-label" for="orders-pickupdate1">Pickup Date</label>
                                <?=
                                DatePicker::widget([
                                    'name' => 'pickupdate1',
                                    'id' => 'datepicker1',
                                    'value' => date('d-M-Y', strtotime('+2 days')),
                                    'options' => ['placeholder' => 'Select issue date ...'],
                                    'pluginOptions' => [
                                        'format' => 'dd-M-yyyy',
                                        'todayHighlight' => true
                                    ]
                                ]);
                                ?>

                            </div>
                        </div>
                    </div>
                    <!-- <div class="form-group field-orders-pickupdate2 ">
                         <label class="control-label" for="orders-pickupdate2">Pickup Date</label>
                         <? DatePicker::widget([
                     'name' => 'pickupdate2', 
                     'value' => date('d-M-Y', strtotime('+4 days')),
                     'options' => ['placeholder' => 'Select issue date ...'],
                     'pluginOptions' => [
                         'format' => 'dd-M-yyyy',
                         'todayHighlight' => true
                     ]
                     ]);
                     ?>
                         
                     </div>
                     
                     
                     
                 
                     <? $form->field($ordermodel, 'pickupcond')->textInput(['maxlength' => true]) ->dropDownList(
                             ['before'=>'Before','after'=>'After','between'=>'Between']
                            
                         );
                  ?>
                    -->
                    <div class="row">
                        <div class="col-xs-4 col-lg-3 gps-img-parent">
                            <?= $form->field($ordermodel, 'deliverylocation')->textInput(['maxlength' => true]) ?>
                            <img class="gps-symbol" onclick="getLocation('#orders-deliverylocation')" src="<?=DOMAINURL;?>/images/gps.png"/>
                        </div>
                        <div class="col-xs-4 col-lg-3">
                            <?=
                            $form->field($ordermodel, 'deliverylocationtype')->textInput(['maxlength' => true])->dropDownList(
                                    ['residential' => 'Residential', 'office' => 'Office']
                            );
                            ?>
                        </div>
                        <div class="col-xs-4 col-lg-3">
                            <div class="form-group field-orders-deliverydate1 required ">
                                <label class="control-label" for="orders-deliverydate1">Delivery Date</label>
                                <?=
                                DatePicker::widget([
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
                        </div>
                    </div>
                    <!--  <div class="form-group field-orders-deliverydate2  ">
                          <label class="control-label" for="orders-deliverydate2">Delivery Date</label>
                          <? DatePicker::widget([
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
                  
                      <? $form->field($ordermodel, 'deliverycond')->textInput(['maxlength' => true])->dropDownList(
                              ['before'=>'Before','after'=>'After','between'=>'Between']
                             
                          ); ?>
                  
                      
                  
                    <!--  order info -->

                    <div class="row">
                        <div class="col-xs-4 col-lg-3">

                            <?= $form->field($orderinfomodel, 'width')->textInput()->label("Width (In inches)") ?>
                        </div>
                        <div class="col-xs-4 col-lg-3">
                            <?= $form->field($orderinfomodel, 'height')->textInput()->label("Height (In inches)") ?>
                                                    </div>
                                                    <div class="col-xs-3">
                            <?= $form->field($orderinfomodel, 'length')->textInput()->label("Length (In inches)") ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-4 col-lg-3">
                            <?= $form->field($orderinfomodel, 'weight')->textInput()->label("Weight (in Kg)") ?>
                        </div>
                        <div class="col-xs-4 col-lg-3">
                            <?=
                            $form->field($orderinfomodel, 'breakable')->textInput()->dropDownList(
                                    ['0' => 'No', '1' => 'Yes']
                            );
                            ?>
                        </div>
                        <div class="col-xs-4 col-lg-3">
                            <?=
                            $form->field($orderinfomodel, 'wooden')->textInput()->dropDownList(
                                    ['0' => 'No', '1' => 'Yes']
                            );
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-4 col-lg-3">
                            <?=
                            $form->field($orderinfomodel, 'packed')->textInput()->dropDownList(
                                    ['0' => 'No', '1' => 'Yes']
                            );
                            ?>
                        </div>
                        <div class="col-xs-4 col-lg-3">
                            <?=
                            $form->field($orderinfomodel, 'packagetype')->textInput(['maxlength' => true])->dropDownList(
                                    ['woodenitem' => 'Wooden Item', 'glass' => 'Glass']
                            );
                            ?>

                        </div>
                        <div class="col-xs-4 col-lg-3">
                            <?= $form->field($ordermodel, 'offerprice')->textInput() ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <?= Html::submitButton($ordermodel->isNewRecord ? 'Place Order' : 'Update Order', ['class' => $ordermodel->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                    </div>

            <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    var locid = "";
   window.onload = function() {
   $("#pickupcurrentloc").change(function(){
     console.log("changed");
     if($('#pickupcurrentloc').is(":checked")){
         console.log("checked");
     }
     else{
         console.log("unchecked");
     }
   });
   



}; 
function getLocation(id) {
    locid = id;
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(getReverseGeocodingData);
    } else {
        $(locid).val( "Geolocation is not supported by this browser.");
    }
}
function showPosition(address) {
    
    $(locid).val(address);
    
}
function getReverseGeocodingData(position) {
    var lat = position.coords.latitude;
    var lng = position.coords.longitude;
    
    var latlng = new google.maps.LatLng(lat, lng);
    // This is making the Geocode request
    var geocoder = new google.maps.Geocoder();
    geocoder.geocode({ 'latLng': latlng }, function (results, status) {
        if (status !== google.maps.GeocoderStatus.OK) {
            console.log(status);
        }
        // This is checking to see if the Geoeode Status is OK before proceeding
        if (status == google.maps.GeocoderStatus.OK) {
            console.log(results);
            var address = (results[0].formatted_address);
            console.log(address);
            showPosition(address);
        }
    });
}
  
    </script>