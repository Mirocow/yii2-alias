<?php

namespace mirocow\alias\models;

use yii\db\ActiveRecord;
use yii\helpers\Json;

/**
 * This is the model class for table "url_alias".
 *
 * @property integer $id
 * @property string $alias
 * @property string $route
 * @property string $params
 * @property integer $status
 * @property string $hash
 * @property string $redirect
 * @property integer $redirect_code
 * @property string $source
 */
class UrlAlias extends ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_PASSIVE = 0;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%url_alias}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['alias', 'route', 'hash'], 'required'],
            [['status', 'redirect_code'], 'integer'],
            [['alias', 'route', 'params', 'redirect', 'source'], 'string', 'max' => 255],
            [['hash'], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'alias' => 'Alias',
            'route' => 'Route',
            'params' => 'Params',
            'status' => 'Status',
            'hash' => 'Hash',
            'redirect' => 'Url redirect',
            'redirect_code' => 'Url redirect status code',
            'source' => 'Source path',
        ];
    }

    public function beforeValidate()
    {
        if(is_array($this->params)) {
            $this->params = Json::encode($this->params);

            $hash = md5($this->params);

            if($this->hash <> $hash) {
                $this->hash = $hash;
            }
        }

        return parent::beforeValidate();
    }

    /**
     * @param string $route
     * @param string $params
     * @return self
     */
    public static function getAliasByRouteWithParams($route, $params, $status = self::STATUS_ACTIVE)
    {
        return self::getDb()->cache(function () use ($route, $params, $status) {
            return self::find()->where([
                'route' => $route,
                'hash' => md5(Json::encode($params)),
                'status' => $status,
            ])->one();
        }, 10);
    }

    /**
     * @param string $alias
     * @return self
     */
    public static function getRouteByAlias($alias, $status = self::STATUS_ACTIVE)
    {
        return self::getDb()->cache(function () use ($alias, $status) {
            return self::find()->where([
                'alias' => $alias,
                'status' => $status,
            ])->one();
        }, 10);
    }

    /**
     * @return string
     */
    public function getRoute()
    {
        return $this->route;
    }

    /**
     * @return mixed
     */
    public function getParams()
    {
        if(is_string($this->params)) {
            return Json::decode($this->params);
        }
    }

}