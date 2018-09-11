<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model mirocow\alias\models\UrlAlias */

$this->title = 'Update Url Alias: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Url Aliases', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="url-alias-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
