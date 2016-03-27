<?php

/* @var $this yii\web\View */

$this->title = 'Order placed';
?>
<div class="site-index">
    <div class="container">
    <div class="row">
        <div class="col-xs-12">
            <h2>All your orders</h2>&nbsp;<button class="btn btn-primary pull-right refresh-btn">Refresh</button>
    <?php if(isset($error)) { ?>
    <div class="danger"><?= $error;?></div>
    <?php } ?>
    <?php if((count($model) > 0)) { //print_r($model); ?>
         <table class="table table-hover">
    <thead>
      <tr>
        
        <th>Your Last Quote</th>
        <th>Operator Last Quote</th>
       
        <th>New Quote</th>
        <th>Status</th>
        <th>View</th>
        <th>Edit</th>        
        <th>Delete</th>
        <th>Reset</th>
      </tr>
    </thead>
    <tbody>
    <?php foreach($model as $order){ ?>
        <tr>
            
            
            <td><?php $price = $order->getLastCustomerQuote($order->id); echo ($price == false) ? $order->offerprice : ($price == "") ? " - " : $price;?></td>
            
            <td><?= $operatorquote = $order->getLastOperatorQuote($order->id);?></td>
            
           
            
            <td><input type="number" data-id="<?= $order->id?>" class="new-offer-price" <?= (!$order->getCustomerQuoteStatus($order) ? "disabled" : "")?>/></td>
            <td><?= ($order->status == 1) ? 'Active' : ($order->status == 2) ? 'Order Completed' : 'Disabled'; ?></td>
            
            <td><a href="<?= DOMAINURL?>/site/view-order?id=<?= $order->id;?>"><i class="fa fa-eye"></i></a></td>
            
            <td><a href="<?= DOMAINURL?>/site/update-order?id=<?= $order->id;?>"><i class="fa fa-pencil"></i></a></td>
            
            <td>
                <a href="<?= DOMAINURL?>/site/deleteorder/<?= $order->id;?>" title="Delete" aria-label="Delete"
                   data-confirm="Are you sure you want to delete this item?" data-method="post" data-pjax="0">
                    <i class="fa fa-trash-o"></i>
                </a>
            </td>
            <td> <a href="<?= DOMAINURL?>/site/reset-order?id=<?= $order->id;?>"
                    data-confirm="Are you sure you want to reset this order? reseting will start bidding system from scratch" data-method="post"><span class="glyphicon glyphicon-repeat"></span></a> </td>
        </tr>
    <?php } ?>
    </tbody>
         </table>
    <?php } 
    else { ?>
    <h4>You have no recent orders!</h4>
    <?php } ?>
    
        </div>
    </div>
    </div>
</div>
<script type="text/javascript">
    /*every 5 min trigger refresh btn*/
    
    setInterval(function(){ $( ".refresh-btn" ).trigger( "click" ); }, 300000);
</script>