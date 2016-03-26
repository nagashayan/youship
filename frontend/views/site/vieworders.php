<?php

/* @var $this yii\web\View */

$this->title = 'Order placed';
?>
<div class="site-index">
    <div class="container">
    <div class="row">
        <div class="col-xs-12">
    <h2>All your orders</h2>
    <?php if(isset($error)) { ?>
    <div class="danger"><?= $error;?></div>
    <?php } ?>
    <?php if((count($model) > 0)) { //print_r($model); ?>
         <table class="table table-hover">
    <thead>
      <tr>
        
        <th>Your Last Quote</th>
        <th>Operator Last Quote</th>
        <th>Last Update</th>
        <th>New Quote</th>
        <th>Status</th>
        <th>View</th>
        <th>Edit</th>        
        <th>Delete</th>
      </tr>
    </thead>
    <tbody>
    <?php foreach($model as $order){ ?>
        <tr>
            
            
            <td><?php $price = $order->getLastCustomerQuote($order->id); echo ($price == false) ? $order->offerprice : ($price == "") ? " - " : $price;?></td>
            
            <td><?= $operatorquote = $order->getLastOperatorQuote($order->id);?></td>
            
            <td><?= $order->updatedon;?></td>
            
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
