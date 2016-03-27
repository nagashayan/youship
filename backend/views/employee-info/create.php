<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\EmployeeInfo */

$this->title = 'Add Employee';
$this->params['breadcrumbs'][] = ['label' => 'Employee Infos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="employee-info-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
