<?php

/* @var $this yii\web\View */

$this->title = 'Lorry App';
?>
<div class="site-index">

    
    
    <?php //print_r($order); 
   // print_r($orderinfo); ?>
    
    <div class="row">
        <div class="col-xs-6"><h4>View Order: #<?= $order->id?></h4></div>
        <div class="col-xs-6"><h4>Status: <?= ($order->status == 1) ? 'Active' : 'Disabled';?></h4></div>
    </div>
    
    <div class="row">
        <div class="col-xs-12">Title: <?= $order->title ?></div>
       
    </div>
    
    
    <div class="row">
        
        <div class="col-xs-4">Description: <?= $order->description ?></div>
        
    </div>
    
    <div class="row">
        <div class="col-xs-4">Pickup Point: <?= $order->pickuplocation ?></div>
        <div class="col-xs-4">Delivery Point: <?= $order->deliverylocation ?></div>
        <div class="col-xs-4">Approx KM's: <?= "43" ?></div>
    </div>
    
    
    <div class="row">
        <div class="col-xs-4">Pickup Date: <?= $order->pickupdate1 ?></div>
        <div class="col-xs-4">Delivery Date: <?= $order->deliverydate1 ?></div>
        
    </div>
    
    <div class="row">
        <div class="col-xs-12"><h4>Product Dimensions</h4></div>
       
    </div>
    
    <div class="row">
        <div class="col-xs-3">Height: <?= $orderinfo->height ?></div>
        <div class="col-xs-3">Width: <?= $orderinfo->width ?></div>
        <div class="col-xs-3">Length: <?= $orderinfo->length ?></div>
        <div class="col-xs-3">Weight: <?= $orderinfo->weight ?></div>
    </div>
    
    <div class="row">
        <div class="col-xs-3">Breakable: <?= ($orderinfo->breakable == 1) ? 'Yes' : 'No';?></div>
        <div class="col-xs-3">Wooden: <?= ($orderinfo->wooden == 1) ? 'Yes' : 'No';?></div>
        <div class="col-xs-3">Packed: <?= ($orderinfo->packed == 1) ? 'Yes' : 'No';?></div>
        <div class="col-xs-3">Package Type: <?= $orderinfo->packagetype ?></div>
    </div>
    
    <div class="row">
        <div class="col-xs-12">Map</div>
       
    </div>
    
    <?php if($order->offerprice != "" && $order->offerprice > 0){ ?>
    <div class="row">
        <div class="col-xs-6">Customer Quote</div>
        <div class="col-xs-6"><?= $order->offerprice;?></div>
        </div>
    <?php } ?>
    
    <?php if(count($quotelog) > 0)
        foreach($quotelog as $quote){ ?>
        <div class="row">
            <div class="col-xs-6"><?= ucfirst($quote->quote_from);?> Quote</div>
        <div class="col-xs-6"><?= $quote->offer_price;?></div>
        </div>
    <?php } ?>
    
    <?php if($order->offerprice == "" && $order->offerprice == 0 && count($quotelog) == 0 ){ ?>
    <div class="row">
        <form action="<?= BACKENDURL ?>/site/update-quote-log" method="post">
            <label>Your Quote
                <input type="hidden" name="Quotelog[order_id]" value="<?= $order->id;?>" />
                <input type="number" name="Quotelog[offer_price]" />
                <input type="hidden" name="Quotelog[quote_from]" value="operator"/>
                <input type='submit' value="Submit"/>
            </label>
        </form>
       
    </div>
    <?php }
    else if(($order->offerprice > 0 && count($quotelog) == 0) || (count($quotelog) > 0 && $quotelog[count($quotelog) - 1]->quote_from == 'customer')){ ?>
    <div class="row">
        <?php if(count($quotelog) < 4) { ?>
        <form action="<?= BACKENDURL ?>/site/update-quote-log" method="post">
            <label>Your Quote
                <input type="hidden" name="Quotelog[order_id]" value="<?= $order->id;?>" />
                <input type="number" name="Quotelog[offer_price]" />
                <input type="hidden" name="Quotelog[quote_from]" value="operator"/>
                <input type='submit' value="Submit"/>
            </label>
        </form>
        <input type="submit" value="Accept"/>
        
        <?php }else{ ?>
        <input type="submit" value="Accept"/>
        <input type="submit" value="Reject"/>
        <?php } ?>
    </div>
    <?php } 
    else { echo 'here';?>
    <!-- <div class="row">
        
         <form action="<?= BACKENDURL ?>/site/update-quote-log" method="post">
            <label>Your Quote
                <input type="hidden" name="Quotelog[order_id]" value="<?= $order->id;?>" />
                <input type="number" name="Quotelog[offer_price]" />
                <input type="hidden" name="Quotelog[quote_from]" value="operator"/>
                <input type='submit' value="Submit"/>
            </label>
        </form>
        
        
    </div> -->
    <?php } ?>
</div>
