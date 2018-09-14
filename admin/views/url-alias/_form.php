<?php

use mirocow\alias\models\UrlAlias;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model mirocow\alias\models\UrlAlias */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="url-alias-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="panel panel-default">
        <div class="panel-heading">Url alias</div>
        <div class="panel-body">
            <?= $form->field($model, 'alias')->textInput(['maxlength' => true])
                ->hint('Example: http://sile.loc/about, about, about/page-1.html', ['class'=>'form-text text-muted']) ?>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">System route with params</div>
        <div class="panel-body">
            <?= $form->field($model, 'route')->textInput(['maxlength' => true])
                ->hint('Example: http://sile.loc/search?param=1&param=2, site/search', ['class'=>'form-text text-muted']) ?>

            <?= $form->field($model, 'params')->textarea(['maxlength' => true])
                ->hint('Json format', ['class'=>'form-text text-muted']) ?>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">Redirect</div>
        <div class="panel-body">
            <?= $form->field($model, 'redirect')->textInput(['maxlength' => true])
                ->hint('Example: Example: http://sile.loc/search?param=1&param=2', ['class'=>'form-text text-muted']) ?>

            <?= $form->field($model, 'redirect_code')->textInput(['maxlength' => true, 'value' => $model->redirect_code? $model->redirect_code: 302]) ?>
        </div>
    </div>

    <?= $form->field($model, 'status')->dropDownList([UrlAlias::STATUS_ACTIVE => 'Active', UrlAlias::STATUS_PASSIVE => 'Passive']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
