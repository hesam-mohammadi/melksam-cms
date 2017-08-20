<?php
namespace backend\controllers;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Response;
use backend\models\Tasks;
use backend\models\TaskCategory;
use backend\models\TasksSearch;

class TasksController extends \yii\web\Controller
{
  public function behaviors()
  {
      return [
        'access' => [
            'class' => AccessControl::className(),
            'rules' => [
                [
                    'allow' => true,
                    'roles' => ['@'],
                ],
            ],
        ],
      ];
  }

    public function actionIndex()
    {
        $this->layout = 'task';
        $task = new Tasks();
        $cats = TaskCategory::find()->all();
        $catModel = new TaskCategory();

        if ($task->load(\Yii::$app->request->post()) && $task->validate()) {
          $task->createTask();
          return $this->refresh();
        }

        else {
          $dataProvider = new ActiveDataProvider([
              'query' => Tasks::find()->where(['user_id' => Yii::$app->user->identity->id])->OrderBy(['created_at' => SORT_DESC]),
          ]);
          return $this->render('index', [
            'dataProvider' => $dataProvider,
            'task' => $task,
            'cats' => $cats,
            'catModel' => $catModel
          ]);
        }
    }
    public function actionSearch()
    {
      $this->layout = 'task';
      $searchModel = new TasksSearch();
      $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);
      $task = new Tasks();
      $cats = TaskCategory::find()->all();
      $catModel = new TaskCategory();

      return $this->render('index', [
          'searchModel' => $searchModel,
          'dataProvider' => $dataProvider,
          'task' => $task,
          'cats' => $cats,
          'catModel' => $catModel

      ]);
    }

    public function actionUpdate($id)
    {
      $model = $this->findModel($id);

      if ($model->load(Yii::$app->request->post()) && $model->save()) {
          return $this->redirect(['index']);
      } else {
          return $this->render('update', [
              'model' => $model,
          ]);
      }

    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionStatus()
    {
      if (Yii::$app->request->isAjax) {
          $model = $this->findModel($_POST['id']);
          ($model->status == 0) ?  $model->status = 1 : $model->status = 0;
          $model->save();
          Yii::$app->response->format = Response::FORMAT_JSON;
          if ($model->save()) {
            $res = array(
                'body'    => 'عملیات با موفقیت انجام شد!',
                'success' => true,
            );
          }
          return $res;
      }
    }

    public function actionCreate_label()
    {
      $catModel = new TaskCategory();

            if (Yii::$app->request->isAjax) {
                $catModel->title = $_POST['TaskCategory']['title'];
                $catModel->save();
                Yii::$app->response->format = Response::FORMAT_JSON;
                if ($catModel->save()) {
                  $res = array(
                      'body'    => 'عملیات با موفقیت انجام شد!',
                      'success' => true,
                  );
                }
                return $res;
            }
    }

    protected function findModel($id)
    {
        if (($model = Tasks::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
