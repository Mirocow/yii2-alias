<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel mirocow\alias\models\UrlAliasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Url Aliases';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="url-alias-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php //echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Url Alias', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'alias',
            'route',
            'status',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}{delete}',
                'headerOptions' => ['width' => '50px'],
            ],
        ],
    ]); ?>
</div>
