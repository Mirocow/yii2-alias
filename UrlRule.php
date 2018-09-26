<?php

namespace mirocow\alias;

use mirocow\alias\models\UrlAlias;
use mirocow\seocore\models\UrlMeta;
use yii\web\View;
use Yii;

/**
 * Custom url rule
 */
class UrlRule extends \yii\web\UrlRule
{
    /**
     * @var string
     */
    public $pattern = '';

    /**
     * @var string
     */
    public $route = '';

    /**
     * @inheritdoc
     * @param \yii\web\UrlManager $manager
     * @param \yii\web\Request $request
     * @return array|bool
     */
    public function parseRequest($manager, $request)
    {
        $pathInfo = $request->getPathInfo();
        /** @var UrlAlias $urlAlias */
        $urlAlias = UrlAlias::getRouteByAlias($pathInfo);
        if (is_object($urlAlias)) {
            if ($urlAlias->redirect) {
                Yii::$app->response->redirect(
                    $urlAlias->redirect,
                    $urlAlias->redirect_code
                );
                Yii::$app->end();
            } else {
                return [$urlAlias->getRoute(), $urlAlias->getParams()];
            }
        }

        return parent::parseRequest($manager, $request);
    }

    /**
     * @inheritdoc
     * @param \yii\web\UrlManager $manager
     * @param string $route
     * @param array $params
     * @return string|bool
     */
    public function createUrl($manager, $route, $params)
    {
        $urlAlias = UrlAlias::getAliasByRouteWithParams($route, $params);
        if (is_object($urlAlias)) {
            return $urlAlias->attributes['alias'];
        }

        return parent::createUrl($manager, $route, $params);
    }

}