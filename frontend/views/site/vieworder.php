<?php

/* @var $this yii\web\View */

$this->title = 'Order placed';
?>
<div class="site-index">
    <div class="container">
    <div class="row">
        <div class="col-xs-8">
    
    <?php if(!isset($error)) { ?>
     <h2>Your order #<?= $model->id;?></h2>
     <div class="row"><div class="col-xs-8"><div class="row"><div class="col-xs-12"><strong>Title</strong></div></div><div class="row"><div class="col-xs-12"><?= $model->title;?></div></div></div></div>
     <div class="row"><div class="col-xs-8"><div class="row"><div class="col-xs-12"><strong>Description</strong></div></div><div class="row"><div class="col-xs-12"><?= $model->description;?></div></div></div></div>
     
     <div class="row"><div class="col-xs-8"><div class="row"><div class="col-xs-12"><strong>Pickup Address</strong></div></div><div class="row"><div class="col-xs-12"><?= $model->pickuplocation;?></div></div></div></div>
     <div class="row"><div class="col-xs-8"><div class="row"><div class="col-xs-12"><strong>Delivery Address</strong></div></div><div class="row"><div class="col-xs-12"><?= $model->deliverylocation;?></div></div></div></div>
     <div class="row"><div class="col-xs-4"><div class="row"><div class="col-xs-12"><strong>Pickup Date</strong></div></div><div class="row"><div class="col-xs-12"><?= $model->pickupdate1;?></div></div></div>
         <div class="col-xs-4"><div class="row"><div class="col-xs-12"><strong>Delivery Date</strong></div></div><div class="row"><div class="col-xs-12"><?= $model->deliverydate1;?></div></div></div>
     </div>
      <div class="row">
          <div class="col-xs-2"><div class="row"><div class="col-xs-12"><strong>Width</strong></div></div><div class="row"><div class="col-xs-12"><?= $model1->width;?></div></div></div>
         <div class="col-xs-2"><div class="row"><div class="col-xs-12"><strong>Height</strong></div></div><div class="row"><div class="col-xs-12"><?= $model1->height;?></div></div></div>
         <div class="col-xs-2"><div class="row"><div class="col-xs-12"><strong>Length</strong></div></div><div class="row"><div class="col-xs-12"><?= $model1->length;?></div></div></div>
     </div>
      <div class="row">
          <div class="col-xs-2"><div class="row"><div class="col-xs-12"><strong>Breakable</strong></div></div><div class="row"><div class="col-xs-12"><?= $model1->breakable;?></div></div></div>
         <div class="col-xs-2"><div class="row"><div class="col-xs-12"><strong>Wooden</strong></div></div><div class="row"><div class="col-xs-12"><?= $model1->wooden;?></div></div></div>
         <div class="col-xs-2"><div class="row"><div class="col-xs-12"><strong>Packed</strong></div></div><div class="row"><div class="col-xs-12"><?= $model1->packed;?></div></div></div>
     </div>
     <div class="row">
          <div class="col-xs-4"><div class="row"><div class="col-xs-12"><strong>Package Type</strong></div></div><div class="row"><div class="col-xs-12"><?= $model1->packagetype;?></div></div></div>
         <div class="col-xs-4"><div class="row"><div class="col-xs-12"><strong>Offer Price</strong></div></div><div class="row"><div class="col-xs-12"><?= $model->offerprice;?></div></div></div>
         
     </div>
     
    <?php } 
    else { ?>
    <h4><?= $error;?></h4>
    <?php } ?>
    
        </div>
    </div>
    </div>
</div>
