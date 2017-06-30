<?php

namespace backend\controllers;

use Yii;
use backend\models\Inbox;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * InboxController implements the CRUD actions for Inbox model.
 */
class InboxController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
          'access' => [
              'class' => AccessControl::className(),
              'rules' => [
                  [
                      'actions' => ['index','view'],
                      'roles' => ['@'],
                      'allow' => true,
                  ],
                  [
                      'actions' => ['update','delete'],
                      'roles' => ['admin'],
                      'allow' => true,
                  ],
              ],
          ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Inbox models.
     * @return mixed
     */
    public function actionIndex()
    {
      if(\Yii::$app->user->can('agent')) {
        $dataProvider = new ActiveDataProvider([
            'query' => Inbox::find(),
        ]);
      }
      else {
        $model = new Inbox();
        $dataProvider = new ActiveDataProvider([
            'query' => $model->findUserMessages(),
        ]);
      }

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Inbox model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        if(\Yii::$app->user->can('admin') || $model->property->user->id == \Yii::$app->user->id) {
          $model->status = 1;
          $model->save();
          return $this->render('view', [
              'model' => $model,
          ]);
        }
        else {
          Yii::$app->getSession()->setFlash('error', 'شما اجازه دسترسی به صفحه مورد نظر را ندارید!');
          return Yii::$app->getResponse()->redirect('index');
        }

    }

    /**
     * Creates a new Inbox model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Inbox();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Inbox model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Inbox model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Inbox model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Inbox the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Inbox::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
