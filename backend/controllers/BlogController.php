<?php

namespace backend\controllers;

use Yii;
use yii\helpers\Json;
use yii\web\Response;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use backend\models\BlogCategory;
use backend\models\BlogPosts;
use backend\models\BlogPictures;
/**
 * BlogController implements the CRUD actions for BlogPosts model.
 */
class BlogController extends Controller
{

      public function actions()
    {

      return [
          'browse-images' => [
              'class' => 'bajadev\ckeditor\actions\BrowseAction',
              'quality' => 80,
              'maxWidth' => 800,
              'maxHeight' => 800,
              'useHash' => true,
              'url' => Yii::$app->params['frontendUrl'].'/frontend/web/uploads/blog/',
              'path' => Yii::getAlias('@frontend').'/web/uploads/blog/',
          ],
          'upload-images' => [
              'class' => 'bajadev\ckeditor\actions\UploadAction',
              'quality' => 80,
              'maxWidth' => 800,
              'maxHeight' => 800,
              'useHash' => true,
              'url' => Yii::$app->params['frontendUrl'].'/frontend/web/uploads/blog/',
              'path' => Yii::getAlias('@frontend').'/web/uploads/blog/',
          ],
      ];
    }
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
                      'allow' => true,
                      'roles' => ['مشاور'],
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
     * Lists all BlogPosts models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => BlogPosts::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single BlogPosts model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new BlogPosts model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
      // print_r($_POST['status']);
      // die();
        $model = new BlogPosts();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->user_id = Yii::$app->user->id;
            (!isset($_POST['status']))  ? $model->status = 0 : $model->status = $_POST['status'];
            $model->save();
            $modelPic = new BlogPictures();
            $ranStr = Yii::$app->security->generateRandomString($length = 9);
            $model->featured_img = UploadedFile::getInstances($model, 'featured_img');
            if ($model->featured_img) {
                foreach ($model->featured_img as $file) {
                    $name = trim($file->baseName, '_-\t\n\r\0\x0B""');
                    $file->saveAs(Yii::getAlias('@upload').'/frontend/web/uploads/blog/' . $name . $ranStr . '.' . $file->extension);
                    $modelPic->src = 'uploads/blog/'.$name.$ranStr.'.jpg';
                    $modelPic->user_id = Yii::$app->user->id;
                    $modelPic->blog_id = $model->id;
                    $modelPic->save();
                }
            }

            return $this->redirect(['view', 'id' => $model->id]);
        } else {

            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing BlogPosts model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
          $modelPic = new BlogPictures();
          $ranStr = Yii::$app->security->generateRandomString($length = 9);
          $model->featured_img = UploadedFile::getInstances($model, 'featured_img');
          if ($model->featured_img) {
              foreach ($model->featured_img as $file) {
                  $name = trim($file->baseName, '_-\t\n\r\0\x0B""');
                  $file->saveAs(Yii::getAlias('@upload').'/frontend/web/uploads/blog/' . $name . $ranStr . '.' . $file->extension);
                  $modelPic->src = 'uploads/blog/'.$name.$ranStr.'.jpg';
                  $modelPic->user_id = Yii::$app->user->id;
                  $modelPic->blog_id = $model->id;
                  $modelPic->save();
              }
          }
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing BlogPosts model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionCategory()
    {
      $model = new \backend\models\BlogCategory();
      $dataProvider = new ActiveDataProvider([
          'query' => BlogCategory::find(),
      ]);
      return $this->render('category', [
        'model' => $model,
        'dataProvider' => $dataProvider
      ]);
    }

    public function actionCreate_cat()
    {
      $cat_model = new BlogCategory();

            if (Yii::$app->request->isAjax) {
                $cat_model->name = $_POST['BlogCategory']['name'];
                $cat_model->status = 1;
                // print_r($_POST['BlogCategory']['name']);
                // die();
                $cat_model->save();

                Yii::$app->response->format = Response::FORMAT_JSON;
                if ($cat_model->save()) {
                  $res = array(
                      'body'    => 'عملیات با موفقیت انجام شد!',
                      'success' => true,
                  );
                }
                return $res;
            }
    }

    public function actionEdit_cat()
    {
      // validate if there is a editable input saved via AJAX
    if (Yii::$app->request->post('hasEditable')) {
        // instantiate your book model for saving
        // print_r($_POST);
        // die();
        $catId = Yii::$app->request->post('editableKey');
        $model = BlogCategory::findOne($catId);

        // store a default json response as desired by editable
        $out = Json::encode(['output'=>'', 'message'=>'']);

        // fetch the first entry in posted data (there should only be one entry
        // anyway in this array for an editable submission)
        // - $posted is the posted data for Book without any indexes
        // - $post is the converted array for single model validation
        $posted = current($_POST['BlogCategory']);
        $post = ['BlogCategory' => $posted];

        // load model like any single model validation
        if ($model->load($post)) {
        // can save model or do something before saving model
        $model->save();

        // custom output to return to be displayed as the editable grid cell
        // data. Normally this is empty - whereby whatever value is edited by
        // in the input by user is updated automatically.
        $output = '';

        // specific use case where you need to validate a specific
        // editable column posted when you have more than one
        // EditableColumn in the grid view. We evaluate here a
        // check to see if buy_amount was posted for the Book model
        if (isset($posted['name'])) {
        $output = $model->name;
        }

        // similarly you can check if the name attribute was posted as well
        // if (isset($posted['name'])) {
        // $output = ''; // process as you need
        // }
        $out = Json::encode(['output'=>$output, 'message'=>'']);
        }
        // return ajax json encoded response and exit
        echo $out;
        return;
    }

    // non-ajax - render the grid by default
    return $this->render('category', [
        'dataProvider' => $dataProvider,
        'searchModel' => $searchModel
    ]);
    }

    public function actionDelete_cat($id)
    {
        $pr = BlogCategory::findOne($id);
        $pr->delete();

        if (!Yii::$app->request->isAjax) {
          return $this->redirect(['category']);
        }

    }

    public function actionEdit_status() {
      // Check if there is an Editable ajax request
      if (isset($_POST['hasEditable'])) {
        $id = $_POST['editableKey'];
        $index = $_POST['editableIndex'];
        $value = $_POST['BlogCategory'][$index]['status'];
        $social = BlogCategory::find()->where(['id' => $id])->one();
        // print_r($_POST);
        $social['status'] = $value;
        $social->save();

        $out = Json::encode(['output'=>$value, 'message'=>'']);
      }
      echo $out;
      return;
    }


    /**
     * Finds the BlogPosts model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BlogPosts the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BlogPosts::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionDelsingle($key){
      $find_ax = BlogPictures::findOne(['id' => $key]);
      if ($find_ax != null){
        $find_ax->delete();
          unlink(Yii::getAlias('@frontend').'/web/'.$find_ax->src);
      }
      echo json_encode(['redirect'=>'_form',]);
    }
}
