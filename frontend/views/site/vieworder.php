<?php

/* @var $this yii\web\View */

$this->title = 'Order placed';
?>
<div class="site-index">
    <div class="container order-details">
    <div class="row">
        <div class="col-xs-10">
    
    <?php if(!isset($error)) { ?>
     <h2>Order Details</h2>
     <div class="row info-div"><div class="col-xs-12"><div class="row"><div class="col-xs-12"><strong>Title</strong></div></div><div class="row"><div class="col-xs-12"><?= $model->title;?></div></div></div></div>
     <div class="row info-div"><div class="col-xs-12"><div class="row"><div class="col-xs-12"><strong>Description</strong></div></div><div class="row"><div class="col-xs-12"><?= $model->description;?></div></div></div></div>
     
     <div class="row info-div"><div class="col-xs-12"><div class="row"><div class="col-xs-12"><strong>Pickup Address</strong></div></div><div class="row"><div class="col-xs-12"><?= $model->pickuplocation;?></div></div></div></div>
     <div class="row info-div"><div class="col-xs-12"><div class="row"><div class="col-xs-12"><strong>Delivery Address</strong></div></div><div class="row"><div class="col-xs-12"><?= $model->deliverylocation;?></div></div></div></div>
     <div class="row info-div"><div class="col-xs-4"><div class="row"><div class="col-xs-12"><strong>Pickup Date</strong></div></div><div class="row"><div class="col-xs-12"><?= explode(" ",$model->pickupdate1)[0];?></div></div></div>
         <div class="col-xs-4"><div class="row"><div class="col-xs-12"><strong>Delivery Date</strong></div></div><div class="row"><div class="col-xs-12"><?= explode(" ",$model->deliverydate1)[0];?></div></div></div>
     </div>
      <div class="row info-div">
          <div class="col-xs-2"><div class="row"><div class="col-xs-12"><strong>Width</strong></div></div><div class="row"><div class="col-xs-12"><?= $model1->width." inch";?></div></div></div>
         <div class="col-xs-2"><div class="row"><div class="col-xs-12"><strong>Height</strong></div></div><div class="row"><div class="col-xs-12"><?= $model1->height." inch";?></div></div></div>
         <div class="col-xs-2"><div class="row"><div class="col-xs-12"><strong>Length</strong></div></div><div class="row"><div class="col-xs-12"><?= $model1->length." inch";?></div></div></div>
         <div class="col-xs-2"><div class="row"><div class="col-xs-12"><strong>Weight</strong></div></div><div class="row"><div class="col-xs-12"><?= $model1->weight." Kg";?></div></div></div>
     </div>
      <div class="row info-div">
          <div class="col-xs-2"><div class="row"><div class="col-xs-12"><strong>Breakable</strong></div></div><div class="row"><div class="col-xs-12"><?= ($model1->breakable == 1) ? 'Yes' : 'No'; ?></div></div></div>
         <div class="col-xs-2"><div class="row"><div class="col-xs-12"><strong>Wooden</strong></div></div><div class="row"><div class="col-xs-12"><?= ($model1->wooden == 1) ? 'Yes' : 'No'; ?></div></div></div>
         <div class="col-xs-2"><div class="row"><div class="col-xs-12"><strong>Packed</strong></div></div><div class="row"><div class="col-xs-12"><?= ($model1->packed == 1) ? 'Yes' : 'No'; ?></div></div></div>
     </div>
     <div class="row info-div">
          <div class="col-xs-4"><div class="row"><div class="col-xs-12"><strong>Package Type</strong></div></div><div class="row"><div class="col-xs-12"><?= $model1->packagetype ?></div></div></div>
            <?php if ($model->offerprice != "" && $model->offerprice > 0) { ?>
         <div class="col-xs-4"><div class="row"><div class="col-xs-12"><strong>Offer Price</strong></div></div><div class="row"><div class="col-xs-12"><?= $model->offerprice;?></div></div></div>
            <?php } ?>
     </div>
     
    <?php } 
    else { ?>
    <h4><?= $error;?></h4>
    <?php } ?>
    
        </div>
    </div>
    </div>
</div>
<script type="text/javascript">
    /*every 5 min trigger refresh btn*/
        setInterval(function(){ $( ".refresh-btn" ).trigger( "click" ); }, 300000);
</script>