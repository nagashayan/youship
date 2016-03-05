<?php

/* @var $this yii\web\View */

$this->title = 'Lorry App';
?>
<div class="site-index">

    <h2>Latest Orders</h2>
    
    
   <table class="table table-hover">
    <thead>
      <tr>
        <th>From</th>
        <th>To</th>
        <th>Offer Price</th>
        <th>View details</th>
      </tr>
    </thead>
    <tbody>
    
    <?php foreach($orderfeed as $order){ ?>
        
      <tr>
        <td><?= $order->pickuplocation?></td>
        <td><?= $order->deliverylocation?></td>
        <td><?= $order->offerprice?></td>
        <td><a href="<?= BACKENDURL?>/site/view-complete-order?id=<?= $order->id;?>">View Details</a></td>
        
      </tr>
        
    <?php  } ?>
</tbody>
</table>
</div>
