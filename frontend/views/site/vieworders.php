<?php

/* @var $this yii\web\View */

$this->title = 'Order placed';
?>
<div class="site-index">
    <div class="container">
    <div class="row">
        <div class="col-xs-6">
    <h2>All your orders</h2>
    <?php if(isset($error)) { ?>
    <div class="danger"><?= $error;?></div>
    <?php } ?>
    <?php if((count($model) > 0)) { //print_r($model); ?>
         <table class="table table-hover">
    <thead>
      <tr>
        <th>Order Date</th>
        <th>View</th>
        <th>Delete</th>
        
      </tr>
    </thead>
    <tbody>
    <?php foreach($model as $order){ ?>
        <tr><td><?= $order->updatedon;?></td>
            <td><a href="<?= DOMAINURL?>/site/view-order?id=<?= $order->id;?>"><i class="fa fa-eye"></i></a></td>
        <td><a href="<?= DOMAINURL?>/site/deleteorder/<?= $order->id;?>" title="Delete" aria-label="Delete"
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
