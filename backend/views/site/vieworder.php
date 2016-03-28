<?php
/* @var $this yii\web\View */

$this->title = 'Lorry App';
$thisoperatorquoted = false;
$thisoperatorquotedcount = 0;
?>
<div class="site-index view-order">

<div class="row">
        <div class="col-xs-12">
    
    <?php if(!isset($error)) { ?>
            <div class="row"><div class="col-xs-6"><h2>Order Details</h2></div>
            <div class="col-xs-6"><h2>Status: <?= ($order->status == 1) ? 'Active' : (($order->status == 2) ? 'Order Completed' : 'Disabled'); ?></h2></div>
        </div>
     
     <div class="row info-div"><div class="col-xs-12"><div class="row"><div class="col-xs-12"><strong>Title</strong></div></div><div class="row"><div class="col-xs-12"><?= $order->title;?></div></div></div></div>
     <div class="row info-div"><div class="col-xs-12"><div class="row"><div class="col-xs-12"><strong>Description</strong></div></div><div class="row"><div class="col-xs-12"><?= $order->description;?></div></div></div></div>
     
     <div class="row info-div"><div class="col-xs-12"><div class="row"><div class="col-xs-12"><strong>Pickup Address</strong></div></div><div class="row"><div class="col-xs-12"><?= $order->pickuplocation;?></div></div></div></div>
     <div class="row info-div"><div class="col-xs-12"><div class="row"><div class="col-xs-12"><strong>Delivery Address</strong></div></div><div class="row"><div class="col-xs-12"><?= $order->deliverylocation;?></div></div></div></div>
     <div class="row info-div"><div class="col-xs-6 col-sm-4"><div class="row"><div class="col-xs-12"><strong>Pickup Date</strong></div></div><div class="row"><div class="col-xs-12"><?= explode(" ",$order->pickupdate1)[0];?></div></div></div>
         <div class="col-xs-6 col-sm-4"><div class="row"><div class="col-xs-12"><strong>Delivery Date</strong></div></div><div class="row"><div class="col-xs-12"><?= explode(" ",$order->deliverydate1)[0];?></div></div></div>
     </div>
      <div class="row info-div">
          <div class="col-xs-3 col-sm-2"><div class="row"><div class="col-xs-12"><strong>Width</strong></div></div><div class="row"><div class="col-xs-12"><?= $orderinfo->width." inch";?></div></div></div>
         <div class="col-xs-3 col-sm-2"><div class="row"><div class="col-xs-12"><strong>Height</strong></div></div><div class="row"><div class="col-xs-12"><?= $orderinfo->height." inch";?></div></div></div>
         <div class="col-xs-3 col-sm-2"><div class="row"><div class="col-xs-12"><strong>Length</strong></div></div><div class="row"><div class="col-xs-12"><?= $orderinfo->length." inch";?></div></div></div>
         <div class="col-xs-3 col-sm-2"><div class="row"><div class="col-xs-12"><strong>Weight</strong></div></div><div class="row"><div class="col-xs-12"><?= $orderinfo->weight." Kg";?></div></div></div>
     </div>
      <div class="row info-div">
          <div class="col-xs-4 col-sm-2"><div class="row"><div class="col-xs-12"><strong>Breakable</strong></div></div><div class="row"><div class="col-xs-12"><?= ($orderinfo->breakable == 1) ? 'Yes' : 'No'; ?></div></div></div>
         <div class="col-xs-4 col-sm-2"><div class="row"><div class="col-xs-12"><strong>Wooden</strong></div></div><div class="row"><div class="col-xs-12"><?= ($orderinfo->wooden == 1) ? 'Yes' : 'No'; ?></div></div></div>
         <div class="col-xs-4 col-sm-2"><div class="row"><div class="col-xs-12"><strong>Packed</strong></div></div><div class="row"><div class="col-xs-12"><?= ($orderinfo->packed == 1) ? 'Yes' : 'No'; ?></div></div></div>
     </div>
     <div class="row info-div">
          <div class="col-xs-6 col-sm-4"><div class="row"><div class="col-xs-12"><strong>Package Type</strong></div></div><div class="row"><div class="col-xs-12"><?= $orderinfo->packagetype ?></div></div></div>
            <?php if ($order->offerprice != "" && $order->offerprice > 0) { ?>
         <div class="col-xs-6 col-sm-4"><div class="row"><div class="col-xs-12"><strong>Offer Price</strong></div></div><div class="row"><div class="col-xs-12"><?= $order->offerprice;?></div></div></div>
            <?php } ?>
     </div>
     
    <?php } 
    else { ?>
    <h4><?= $error;?></h4>
    <?php } ?>
    
        </div>
    </div>
    <h4>Quotes</h4>
    <?php if (count($quotelog) > 0)
        foreach ($quotelog as $quote) {
        if($quote->operator_id == Yii::$app->user->id || $quote->quote_from == "customer"){
            $thisoperatorquoted = true;
            
            if($quote->operator_id == Yii::$app->user->id){
                $thisoperatorquotedcount++;
            }
            
            ?>
    
            <div class="row sub-info-div">
                <div class="col-xs-4 col-sm-2"><?= ucfirst($quote->quote_from); ?> Quote</div>
                <div class="col-xs-4 col-sm-2"><?= $quote->offer_price; ?></div>
            </div>
        <?php }
        } ?>
    
<?php //if first time order
        if(($order->status != 2))
            if (($order->offerprice == "" && $order->offerprice == 0 && count($quotelog) == 0) || $thisoperatorquoted == false) { ?>
        <div class="row">
            <form action="<?= BACKENDURL ?>/site/update-quote-log" method="post">
                <label>Your Quote
                    <input type="hidden" name="Quotelog[order_id]" value="<?= $order->id; ?>" />
                    <input type="number" name="Quotelog[offer_price]" />
                    <input type="hidden" name="Quotelog[quote_from]" value="operator"/>
                    <input type="hidden" name="Quotelog[operator_id]" value="<?= Yii::$app->user->id;?>"/>
                    <input class="btn btn-default" type='submit' value="Submit"/>
                </label>
            </form>

        </div>
    <?php } else if (($order->offerprice > 0 && count($quotelog) == 0) || (count($quotelog) > 0 && $quotelog[count($quotelog) - 1]->quote_from == 'customer') ) {
       //if not first time quote and last quote was from customer, operator can either accept or quote ?>
        <div class="row">
            <div class="col-xs-12">
    <?php if ($thisoperatorquotedcount < 4) { //if less than 4 quotes made by operator then  operator can quote or accept ?>
                <form action="<?= BACKENDURL ?>/site/update-quote-log" method="post">
                    <label>Your Quote
                        <input type="hidden" name="Quotelog[order_id]" value="<?= $order->id; ?>" />
                        <input type="number" name="Quotelog[offer_price]" />
                        <input type="hidden" name="Quotelog[quote_from]" value="operator"/>
                        <input type="hidden" name="Quotelog[quote_from]" value="operator"/>
                        <input type="hidden" name="Quotelog[operator_id]" value="<?= Yii::$app->user->id;?>"/>
                        <input class="btn btn-default" type='submit' value="Submit"/>
                    </label>
                </form>
                <form action="<?= BACKENDURL ?>/site/operator-decision" method="post">
                    <input type="hidden" name="accept"/>
                    <input type="hidden" name="order_id" value="<?= $order->id; ?>" />
                    <input type="hidden" name="operator_id" value="<?= Yii::$app->user->id;?>"/>
                    <input class="btn btn-primary" type="submit" value="Accept"/>
                </form>

    <?php } 
    
    else if($order->status == STATUS_OPEN){  //if more than 4 and status is open still than he can just accept or reject?>
                <form action="<?= BACKENDURL ?>/site/operator-decision" method="post">
                    <input type="hidden" name="accept"/>
                    <input type="hidden" name="order_id" value="<?= $order->id; ?>" />
                    <input type="hidden" name="operator_id" value="<?= Yii::$app->user->id;?>"/>
                    <input class="btn btn-primary" type="submit" value="Accept"/>
                </form>
                <form action="<?= BACKENDURL ?>/site/operator-decision" method="post">
                    <input type="hidden" name="reject"/>
                    <input type="hidden" name="order_id" value="<?= $order->id; ?>" />
                    <input type="hidden" name="operator_id" value="<?= Yii::$app->user->id;?>"/>
                    <input class="btn btn-danger" type="submit" value="Reject"/>
                </form>


        <?php }
        
        ?>
            </div>
        </div>
    <?php } else { //echo 'here'; ?>
        
    <div class="row">
        <div class="col-xs-12"><span>Awaiting customer reply</span></div>
    </div>
       
        <!-- <div class="row">
            
             <form action="<?= BACKENDURL ?>/site/update-quote-log" method="post">
                <label>Your Quote
                    <input type="hidden" name="Quotelog[order_id]" value="<?= $order->id; ?>" />
                    <input type="number" name="Quotelog[offer_price]" />
                    <input type="hidden" name="Quotelog[quote_from]" value="operator"/>
                    <input type='submit' value="Submit"/>
                </label>
            </form>
            
            
        </div> -->
<?php }
        
        if($order->status == 2 && $order->accepted_operator == Yii::$app->user->id){ //if decision is made  ?>
        <div class="well">
        <div class="info-div"><label>Final Status: </label>&nbsp;&nbsp;<?= $order->status == STATUS_ACCEPT? "Accepted" : "Rejected"?></div>
            <?php if($order->status == STATUS_ACCEPT ){ ?>
            
        <div class="row"><div class="col-xs-12"><h4>Customer Information</h4></div></div>
            <?php if(isset($user)){ ?>
        <div class="row"><div class="col-xs-4">Name:</div><div class="col-lg-8"><?= $user->company_name;?></div></div>
            <div class="row"><div class="col-xs-4">Phone Number:</div><div class="col-lg-8"><?=  $user->company_phone;?></div></div>
            <div class="row"><div class="col-xs-4">Email:</div><div class="col-lg-8"><?=  $user->company_email;?></div></div>
            <div class="row"><div class="col-xs-4">Other Info: </div><div class="col-lg-8"><?=  $user->contact_info;?></div></div>
            <?php }
            else{
                echo "Sorry, User has not updated his profile. He/She shall contact you directly";
            }
            
            } ?>
        </div>
      <?php  } ?>
</div>
