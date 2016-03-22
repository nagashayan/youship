<?php
/* @var $this yii\web\View */

$this->title = 'Lorry App';
?>
<div class="site-index">



    <?php //print_r($order); 
    // print_r($orderinfo); 
    ?>

    <div class="row">
        <div class="col-xs-6"><h4>View Order: #<?= $order->id ?></h4></div>
        <div class="col-xs-6"><h4>Status: <?= ($order->status == 1) ? 'Active' : 'Disabled'; ?></h4></div>
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
        <div class="col-xs-3">Breakable: <?= ($orderinfo->breakable == 1) ? 'Yes' : 'No'; ?></div>
        <div class="col-xs-3">Wooden: <?= ($orderinfo->wooden == 1) ? 'Yes' : 'No'; ?></div>
        <div class="col-xs-3">Packed: <?= ($orderinfo->packed == 1) ? 'Yes' : 'No'; ?></div>
        <div class="col-xs-3">Package Type: <?= $orderinfo->packagetype ?></div>
    </div>

    <div class="row">
        <div class="col-xs-12">Map</div>

    </div>

    <?php if ($order->offerprice != "" && $order->offerprice > 0) { ?>
        <div class="row">
            <div class="col-xs-6">Customer Quote</div>
            <div class="col-xs-6"><?= $order->offerprice; ?></div>
        </div>
    <?php } ?>

    <?php if (count($quotelog) > 0)
        foreach ($quotelog as $quote) {
            ?>
            <div class="row">
                <div class="col-xs-6"><?= ucfirst($quote->quote_from); ?> Quote</div>
                <div class="col-xs-6"><?= $quote->offer_price; ?></div>
            </div>
        <?php } ?>
    
<?php //if first time order
            if ($order->offerprice == "" && $order->offerprice == 0 && count($quotelog) == 0) { ?>
        <div class="row">
            <form action="<?= BACKENDURL ?>/site/update-quote-log" method="post">
                <label>Your Quote
                    <input type="hidden" name="Quotelog[order_id]" value="<?= $order->id; ?>" />
                    <input type="number" name="Quotelog[offer_price]" />
                    <input type="hidden" name="Quotelog[quote_from]" value="operator"/>
                    <input type='submit' value="Submit"/>
                </label>
            </form>

        </div>
    <?php } else if (($order->offerprice > 0 && count($quotelog) == 0) || (count($quotelog) > 0 && $quotelog[count($quotelog) - 1]->quote_from == 'customer')) {
       //if not first time quote and last quote was from customer, operator can either accept or quote ?>
        <div class="row">
            <div class="col-xs-12">
    <?php if (count($quotelog) < 4) { //if less than 4 operator can quote or accept ?>
                <form action="<?= BACKENDURL ?>/site/update-quote-log" method="post">
                    <label>Your Quote
                        <input type="hidden" name="Quotelog[order_id]" value="<?= $order->id; ?>" />
                        <input type="number" name="Quotelog[offer_price]" />
                        <input type="hidden" name="Quotelog[quote_from]" value="operator"/>
                        <input type='submit' value="Submit"/>
                    </label>
                </form>
                <input type="submit" value="Accept"/>

    <?php } 
    
    else if($order->status == STATUS_OPEN){  //if more than 4 and status is open still than he can just accept or reject?>
                <form action="<?= BACKENDURL ?>/site/operator-decision" method="post">
                    <input type="hidden" name="accept"/>
                    <input type="hidden" name="order_id" value="<?= $order->id; ?>" />
                    
                    <input type="submit" value="Accept"/>
                </form>
                <form action="<?= BACKENDURL ?>/site/operator-decision" method="post">
                    <input type="hidden" name="reject"/>
                    <input type="hidden" name="order_id" value="<?= $order->id; ?>" />
                   
                    <input type="submit" value="Reject"/>
                </form>


        <?php }
        
        else{ //if decision is made  ?>
            <span><?= $order->status == STATUS_ACCEPT? "Accepted" : "Rejected"?></span>
            <?php if($order->status == STATUS_ACCEPT ){ ?>
            
            <div class="row"><div class="col-xs-12">Customer Information</div></div>
            <?php if(isset($user)){ ?>
            <div class="row"><div class="col-xs-12"><?= "Name  ". $user->company_name;?></div></div>
            <div class="row"><div class="col-xs-12"><?= "Phone Number  ". $user->company_phone;?></div></div>
            <?php }
            else{
                echo "Sorry, User has not updated his profile. He shall contact you directly";
            }
            
            } ?>
      <?php  }
        ?>
            </div>
        </div>
    <?php } else { //echo 'here';
        ?>
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
<?php } ?>
</div>
