<?php

namespace mirocow\alias\admin\controllers;

use mirocow\alias\models\UrlAlias;
use mirocow\alias\models\UrlAliasSearch;
use Yii;
use yii\base\Exception;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Request;

/**
 * UrlAliasController implements the CRUD actions for UrlAlias model.
 */
class UrlAliasController extends Controller
{
    /**
     * @var string
     */
    protected $urlManagerComponentName = 'urlManager';

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all UrlAlias models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UrlAliasSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new UrlAlias model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new UrlAlias();

        if(\Yii::$app->request->isPost) {

            $this->prepareModel($model);

            if ($model->save()) {
                return $this->redirect(['update', 'id' => $model->id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing UrlAlias model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if(\Yii::$app->request->isPost) {

            $this->prepareModel($model);

            if ($model->save()) {
                return $this->redirect(['update', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function prepareModel($model)
    {
        $model->load(Yii::$app->request->post());

        $info = parse_url($model->alias);

        if(empty($info['path'])){
            throw new Exception('Route path is wrong');
        }

        $model->alias = $info['path'] . (isset($info['query'])? "?{$info['query']}": '');

        $info = parse_url($model->route);

        if(empty($info['path']) && empty($model->route)){
            throw new Exception('Route path is wrong');
        }

        $query = [];

        if(isset($info['query']) && is_string($info['query'])) {
            if (function_exists('mb_parse_str')) {
                mb_parse_str($info['query'], $query);
            } else {
                parse_str($info['query'], $query);
            }
        }

        /** @var Request $request */
        $request = \Yii::createObject([
            'class' => Request::class,
            'pathInfo' => $info['path'],
            'url' =>  $info['path'] . (isset($info['query'])? "?{$info['query']}": ''),
            'queryParams' => $query,
        ]);

        /** @var array $result */
        $result = Yii::$app->get($this->urlManagerComponentName)->parseRequest($request);

        if ($result !== false) {
            list($route, $params) = $result;
            if($model->route <> $route) {
                $model->route = $route;
                $model->params = $request->getQueryParams();
                $model->source = $request->getUrl();
            }
        }
    }

    /**
     * Deletes an existing UrlAlias model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the UrlAlias model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return UrlAlias the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UrlAlias::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
