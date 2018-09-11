<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model mirocow\alias\models\UrlAlias */

$this->title = 'Create Url Alias';
$this->params['breadcrumbs'][] = ['label' => 'Url Aliases', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="url-alias-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
