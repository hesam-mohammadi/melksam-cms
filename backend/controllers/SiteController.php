<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Json;
use yii\web\Response;
use yii\data\ActiveDataProvider;
use yii\widgets\ActiveForm;
use yii\web\UploadedFile;
use common\models\LoginForm;
use backend\models\Province;
use backend\models\City;
use backend\models\Region;
use backend\models\DealingType;
use backend\models\PropertyView;
use backend\models\FloorCovering;
use backend\models\Cabinet;
use backend\models\VilaType;
use backend\models\Facilities;
use backend\models\Options;
use backend\models\SocialOptions;
use backend\models\SiteLogo;
/**
 * Site controller
 */
class SiteController extends Controller
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
                        'actions' => ['baseinfo', 'options', 'edit_options', 'edit_socials', 'edit_status', 'upload', 'delsingle'],
                        'roles' => ['admin'],
                        'allow' => true,
                    ],

                    [
                        'actions' => ['index','logout', 'subcity'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['login'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $this->layout = 'dashboard';

        $userModel = new \backend\models\User();
        $prModel = new \backend\models\Property();
        $inboxModel = new \backend\models\Inbox();
        $userModel = new \backend\models\User();

        $users = $userModel->countUsers();
        $properties = $prModel->countProperties();
        $messages = $inboxModel->countMessages();

        $latestpr = $prModel->latest5Properties();
        $latestmsg = $inboxModel->latest5Messages();
        $latestuser = $userModel->latest5Users();

        return $this->render('index', [
          'users' => $users,
          'properties' => $properties,
          'messages' => $messages,
          'latestpr' => $latestpr,
          'latestmsg' => $latestmsg,
          'latestuser' => $latestuser,
        ]);
    }

   public function actionInit()
   {
       $auth = Yii::$app->authManager;


      //  // add "createPost" permission
      //  $createPost = $auth->createPermission('Propertylist');
      //  $createPost->description = '';
      //  $auth->add($createPost);


      //  // add "updatePost" permission
      //  $updatePost = $auth->createPermission('updatePost');
      //  $updatePost->description = 'Update post';
      //  $auth->add($updatePost);
       //
       //
      //  // add "author" role and give this role the "createPost" permission
      //  $author = $auth->createRole('author');
      //  $auth->add($author);
      //  $auth->addChild($author, $createPost);
       //
       //
       // add "admin" role and give this role the "updatePost" permission
       // as well as the permissions of the "author" role
       $admin = $auth->createRole('admin');
       $agent = $auth->createRole('agent');
      //  $auth->add($admin);
      //  $auth->addChild($admin, $updatePost);
      //  $auth->addChild($admin, $agent);
      $auth->assign($admin, 1);
       //
       //
      //  // Assign roles to users. 1 and 2 are IDs returned by IdentityInterface::getId()
      //  // usually implemented in your User model.
      //  $auth->assign($author, 2);
      //  $auth->assign($admin, 1);
   }


    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
    * BaseInfo action.
    *
    * Showing property info settings
    */
    public function actionBaseinfo()
    {

        $province_model = new Province();
        $city_model = new City();
        $region_model = new Region();
        $dealing_model = new DealingType();
        $view_model = new PropertyView();
        $cover_model = new FloorCovering();
        $cabinet_model = new Cabinet();
        $vila_model = new VilaType();
        $facilities_model = new Facilities();

        $province = new ActiveDataProvider([
            'query' => Province::find(),
        ]);

        $city = new ActiveDataProvider([
            'query' => City::find(),
        ]);

        $region = new ActiveDataProvider([
            'query' => Region::find(),
        ]);

        $dealing_type = new ActiveDataProvider([
            'query' => DealingType::find(),
        ]);

        $property_view = new ActiveDataProvider([
            'query' => PropertyView::find(),
        ]);

        $floor_covering = new ActiveDataProvider([
            'query' => FloorCovering::find(),
        ]);

        $cabinet = new ActiveDataProvider([
            'query' => Cabinet::find(),
        ]);

        $vila_type = new ActiveDataProvider([
            'query' => VilaType::find(),
        ]);

        $facilities = new ActiveDataProvider([
            'query' => Facilities::find(),
        ]);


        return $this->render('baseInfo', [
            'provinceProvider' => $province,
            'cityProvider' => $city,
            'regionProvider' => $region,
            'dealingProvider' => $dealing_type,
            'viewProvider' => $property_view,
            'coverProvider' => $floor_covering,
            'vilaProvider' => $vila_type,
            'cabinetProvider' => $cabinet,
            'facilitiesProvider' => $facilities,
            'province_model' => $province_model,
            'city_model' => $city_model,
            'region_model' => $region_model,
            'dealing_model' => $dealing_model,
            'view_model' => $view_model,
            'cover_model' => $cover_model,
            'cabinet_model' => $cabinet_model,
            'vila_model' => $vila_model,
            'facilities_model' => $facilities_model,
        ]);
    }

    public function actionCreate_province()
    {
      $province_model = new Province();

            if (Yii::$app->request->isAjax) {
                $province_model->name = $_POST['Province']['name'];
                $province_model->save();

                Yii::$app->response->format = Response::FORMAT_JSON;
                if ($province_model->save()) {
                  $res = array(
                      'body'    => 'عملیات با موفقیت انجام شد!',
                      'success' => true,
                  );
                }
                return $res;
            }
    }

    public function actionEdit_province() {
      // validate if there is a editable input saved via AJAX
    if (Yii::$app->request->post('hasEditable')) {
        // instantiate your book model for saving
        $provinceId = Yii::$app->request->post('editableKey');
        $model = Province::findOne($provinceId);

        // store a default json response as desired by editable
        $out = Json::encode(['output'=>'', 'message'=>'']);

        // fetch the first entry in posted data (there should only be one entry
        // anyway in this array for an editable submission)
        // - $posted is the posted data for Book without any indexes
        // - $post is the converted array for single model validation
        $posted = current($_POST['Province']);
        $post = ['Province' => $posted];

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
    return $this->render('index', [
        'dataProvider' => $dataProvider,
        'searchModel' => $searchModel
    ]);
    }
//
//     // Else return to rendering a normal view
//     return $this->render('view', ['model'=>$model]);
// }

public function actionDelete_province($id)
{
    $pr = Province::findOne($id);
    $pr->delete();

    if (!Yii::$app->request->isAjax) {
      return $this->redirect(['index']);
    }

}

    public function actionCreate_city()
    {
      $city_model = new City();

            if (Yii::$app->request->isAjax) {
                $city_model->name = $_POST['City']['name'];
                $city_model->province_id = $_POST['Province']['name'];
                $city_model->save();

                Yii::$app->response->format = Response::FORMAT_JSON;
                if ($city_model->save()) {
                  $res = array(
                      'body'    => 'عملیات با موفقیت انجام شد!',
                      'success' => true,
                  );
                }
                return $res;
            }
    }

    public function actionSubcity()
    {
      $out = [];
    if (isset($_POST['depdrop_parents'])) {
        $parents = $_POST['depdrop_parents'];
        if ($parents != null) {
            $cat_id = $parents[0];
            $out = City::find()->where(['province_id' => $cat_id ])->select(['id','name'])->all();
            // the getSubCatList function will query the database based on the
            // cat_id and return an array like below:
            // [
            //    ['id'=>'<sub-cat-id-1>', 'name'=>'<sub-cat-name1>'],
            //    ['id'=>'<sub-cat_id_2>', 'name'=>'<sub-cat-name2>']
            // ]
            echo \yii\helpers\Json::encode(['output'=> $out]);
            return;
        }
    }
    echo Json::encode(['output'=>'', 'selected'=>'']);
    }

    public function actionProd() {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $ids = $_POST['depdrop_parents'];
            $parent_id = empty($ids[0]) ? null : $ids[0];
            $subcat_id = empty($ids[1]) ? null : $ids[1];
            if ($subcat_id != null) {
                // $data = Category::getProdList($subcat_id);
                $data = Region::find()->where(['city_id'=>$subcat_id])
                ->select(['id','name'])->all();

                /**
                 * the getProdList function will query the database based on the
                 * cat_id and sub_cat_id and return an array like below:
                 *  [
                 *      'out'=>[
                 *          ['id'=>'<prod-id-1>', 'name'=>'<prod-name1>'],
                 *          ['id'=>'<prod_id_2>', 'name'=>'<prod-name2>']
                 *       ],
                 *       'selected'=>'<prod-id-1>'
                 *  ]
                 */
                echo Json::encode(['output'=>$data, 'selected'=>'']);
                return;
            }
        }
        echo Json::encode(['output'=>'', 'selected'=>'']);
    }

    public function actionEdit_city() {
      // validate if there is a editable input saved via AJAX
    if (Yii::$app->request->post('hasEditable')) {
        // instantiate your book model for saving
        $cityId = Yii::$app->request->post('editableKey');
        $model = City::findOne($cityId);

        // store a default json response as desired by editable
        $out = Json::encode(['output'=>'', 'message'=>'']);

        // fetch the first entry in posted data (there should only be one entry
        // anyway in this array for an editable submission)
        // - $posted is the posted data for Book without any indexes
        // - $post is the converted array for single model validation
        $posted = current($_POST['City']);
        $post = ['City' => $posted];

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
        if (isset($posted['province_id'])) {
        $output = $model->province->name;
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
    return $this->render('index', [
        'dataProvider' => $dataProvider,
        'searchModel' => $searchModel
    ]);
    }


    public function actionDelete_city($id)
    {
        $pr = City::findOne($id);
        $pr->delete();

        if (!Yii::$app->request->isAjax) {
          return $this->redirect(['index']);
        }

    }


    public function actionCreate_region()
    {
      $region_model = new Region();

            if (Yii::$app->request->isAjax) {
                $region_model->name = $_POST['Region']['name'];
                $region_model->city_id = $_POST['City']['name'];
                $region_model->save();

                Yii::$app->response->format = Response::FORMAT_JSON;
                if ($region_model->save()) {
                  $res = array(
                      'body'    => 'عملیات با موفقیت انجام شد!',
                      'success' => true,
                  );
                }
                return $res;
            }
    }

    public function actionEdit_region()
    {
      // validate if there is a editable input saved via AJAX
    if (Yii::$app->request->post('hasEditable')) {
        // instantiate your book model for saving
        $regionId = Yii::$app->request->post('editableKey');
        $model = Region::findOne($regionId);

        // store a default json response as desired by editable
        $out = Json::encode(['output'=>'', 'message'=>'']);

        // fetch the first entry in posted data (there should only be one entry
        // anyway in this array for an editable submission)
        // - $posted is the posted data for Book without any indexes
        // - $post is the converted array for single model validation
        $posted = current($_POST['Region']);
        $post = ['Region' => $posted];

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
    return $this->render('index', [
        'dataProvider' => $dataProvider,
        'searchModel' => $searchModel
    ]);
    }

    public function actionDelete_region($id)
    {
        $pr = Region::findOne($id);
        $pr->delete();

        if (!Yii::$app->request->isAjax) {
          return $this->redirect(['index']);
        }

    }

    public function actionCreate_dealing()
    {
      $dealing_model = new DealingType();

            if (Yii::$app->request->isAjax) {
                $dealing_model->name = $_POST['DealingType']['name'];
                $dealing_model->save();

                Yii::$app->response->format = Response::FORMAT_JSON;
                if ($dealing_model->save()) {
                  $res = array(
                      'body'    => 'عملیات با موفقیت انجام شد!',
                      'success' => true,
                  );
                }
                return $res;
            }
    }

    public function actionEdit_dealing()
    {
      // validate if there is a editable input saved via AJAX
    if (Yii::$app->request->post('hasEditable')) {
        // instantiate your book model for saving
        $dealingId = Yii::$app->request->post('editableKey');
        $model = DealingType::findOne($dealingId);

        // store a default json response as desired by editable
        $out = Json::encode(['output'=>'', 'message'=>'']);

        // fetch the first entry in posted data (there should only be one entry
        // anyway in this array for an editable submission)
        // - $posted is the posted data for Book without any indexes
        // - $post is the converted array for single model validation
        $posted = current($_POST['DealingType']);
        $post = ['DealingType' => $posted];

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
    return $this->render('index', [
        'dataProvider' => $dataProvider,
        'searchModel' => $searchModel
    ]);
    }

    public function actionDelete_dealing($id)
    {
        $pr = DealingType::findOne($id);
        $pr->delete();

        if (!Yii::$app->request->isAjax) {
          return $this->redirect(['index']);
        }

    }

    public function actionCreate_view()
    {
            $view_model = new PropertyView();
            if (Yii::$app->request->isAjax) {
                $view_model->name = $_POST['PropertyView']['name'];
                $view_model->save();

                Yii::$app->response->format = Response::FORMAT_JSON;
                if ($view_model->save()) {
                  $res = array(
                      'body' => 'عملیات با موفقیت انجام شد!',
                      'success' => true,
                  );
                }
                return $res;
            }
    }

    public function actionEdit_view()
    {
      // validate if there is a editable input saved via AJAX
    if (Yii::$app->request->post('hasEditable')) {
        // instantiate your book model for saving
        $viewId = Yii::$app->request->post('editableKey');
        $model = PropertyView::findOne($viewId);

        // store a default json response as desired by editable
        $out = Json::encode(['output'=>'', 'message'=>'']);

        // fetch the first entry in posted data (there should only be one entry
        // anyway in this array for an editable submission)
        // - $posted is the posted data for Book without any indexes
        // - $post is the converted array for single model validation
        $posted = current($_POST['PropertyView']);
        $post = ['PropertyView' => $posted];

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
    return $this->render('index', [
        'dataProvider' => $dataProvider,
        'searchModel' => $searchModel
    ]);
    }

    public function actionDelete_view($id)
    {
        $pr = PropertyView::findOne($id);
        $pr->delete();

        if (!Yii::$app->request->isAjax) {
          return $this->redirect(['index']);
        }

    }

    public function actionCreate_cover()
    {
            $cover_model = new FloorCovering();
            if (Yii::$app->request->isAjax) {
                $cover_model->name = $_POST['FloorCovering']['name'];
                $cover_model->save();

                Yii::$app->response->format = Response::FORMAT_JSON;
                if ($cover_model->save()) {
                  $res = array(
                      'body' => 'عملیات با موفقیت انجام شد!',
                      'success' => true,
                  );
                }
                return $res;
            }
    }

    public function actionEdit_cover()
    {
      // validate if there is a editable input saved via AJAX
    if (Yii::$app->request->post('hasEditable')) {
        // instantiate your book model for saving
        $coverId = Yii::$app->request->post('editableKey');
        $model = FloorCovering::findOne($coverId);

        // store a default json response as desired by editable
        $out = Json::encode(['output'=>'', 'message'=>'']);

        // fetch the first entry in posted data (there should only be one entry
        // anyway in this array for an editable submission)
        // - $posted is the posted data for Book without any indexes
        // - $post is the converted array for single model validation
        $posted = current($_POST['FloorCovering']);
        $post = ['FloorCovering' => $posted];

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
    return $this->render('index', [
        'dataProvider' => $dataProvider,
        'searchModel' => $searchModel
    ]);
    }

    public function actionDelete_cover($id)
    {
        $pr = FloorCovering::findOne($id);
        $pr->delete();

        if (!Yii::$app->request->isAjax) {
          return $this->redirect(['index']);
        }

    }

    public function actionCreate_cabinet()
    {
            $cabinet_model = new Cabinet();
            if (Yii::$app->request->isAjax) {
                $cabinet_model->name = $_POST['Cabinet']['name'];
                $cabinet_model->save();

                Yii::$app->response->format = Response::FORMAT_JSON;
                if ($cabinet_model->save()) {
                  $res = array(
                      'body' => 'عملیات با موفقیت انجام شد!',
                      'success' => true,
                  );
                }
                return $res;
            }
    }

    public function actionEdit_cabinet()
    {
      // validate if there is a editable input saved via AJAX
    if (Yii::$app->request->post('hasEditable')) {
        // instantiate your book model for saving
        $cabinetId = Yii::$app->request->post('editableKey');
        $model = Cabinet::findOne($cabinetId);

        // store a default json response as desired by editable
        $out = Json::encode(['output'=>'', 'message'=>'']);

        // fetch the first entry in posted data (there should only be one entry
        // anyway in this array for an editable submission)
        // - $posted is the posted data for Book without any indexes
        // - $post is the converted array for single model validation
        $posted = current($_POST['Cabinet']);
        $post = ['Cabinet' => $posted];

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
    return $this->render('index', [
        'dataProvider' => $dataProvider,
        'searchModel' => $searchModel
    ]);
    }

    public function actionDelete_cabinet($id)
    {
        $pr = Cabinet::findOne($id);
        $pr->delete();

        if (!Yii::$app->request->isAjax) {
          return $this->redirect(['index']);
        }

    }

    public function actionCreate_vila()
    {
            $vila_model = new VilaType();
            if (Yii::$app->request->isAjax) {
                $vila_model->name = $_POST['VilaType']['name'];
                $vila_model->save();

                Yii::$app->response->format = Response::FORMAT_JSON;
                if ($vila_model->save()) {
                  $res = array(
                      'body' => 'عملیات با موفقیت انجام شد!',
                      'success' => true,
                  );
                }
                return $res;
            }
    }

    public function actionEdit_vila()
    {
      // validate if there is a editable input saved via AJAX
    if (Yii::$app->request->post('hasEditable')) {
        // instantiate your book model for saving
        $vilaId = Yii::$app->request->post('editableKey');
        $model = VilaType::findOne($vilaId);

        // store a default json response as desired by editable
        $out = Json::encode(['output'=>'', 'message'=>'']);

        // fetch the first entry in posted data (there should only be one entry
        // anyway in this array for an editable submission)
        // - $posted is the posted data for Book without any indexes
        // - $post is the converted array for single model validation
        $posted = current($_POST['VilaType']);
        $post = ['VilaType' => $posted];

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
    return $this->render('index', [
        'dataProvider' => $dataProvider,
        'searchModel' => $searchModel
    ]);
    }

    public function actionDelete_vila($id)
    {
        $pr = VilaType::findOne($id);
        $pr->delete();

        if (!Yii::$app->request->isAjax) {
          return $this->redirect(['index']);
        }

    }

    public function actionCreate_facilities()
    {
            $faccilities_model = new Facilities();
            if (Yii::$app->request->isAjax) {
              $faccilities_model->name = $_POST['Facilities']['name'];
              $faccilities_model->css_class = $_POST['css_class'];
              $faccilities_model->save();

                Yii::$app->response->format = Response::FORMAT_JSON;
                if ($faccilities_model->save()) {
                  $res = array(
                      'body' => 'عملیات با موفقیت انجام شد!',
                      'success' => true,
                  );
                }
                return $res;
            }
    }

    public function actionEdit_facilities()
    {
      // validate if there is a editable input saved via AJAX
    if (Yii::$app->request->post('hasEditable')) {
        // instantiate your book model for saving
        $facilitiesId = Yii::$app->request->post('editableKey');
        $model = Facilities::findOne($facilitiesId);

        // store a default json response as desired by editable
        $out = Json::encode(['output'=>'', 'message'=>'']);

        // fetch the first entry in posted data (there should only be one entry
        // anyway in this array for an editable submission)
        // - $posted is the posted data for Book without any indexes
        // - $post is the converted array for single model validation
        $posted = current($_POST['Facilities']);
        $post = ['Facilities' => $posted];

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
    return $this->render('index', [
        'dataProvider' => $dataProvider,
        'searchModel' => $searchModel
    ]);
    }

    public function actionDelete_facilities($id)
    {
        $pr = Facilities::findOne($id);
        $pr->delete();

        if (!Yii::$app->request->isAjax) {
          return $this->redirect(['index']);
        }

    }

    public function actionOptions()
    {
      $options = new ActiveDataProvider([
          'query' => Options::find(),
      ]);

      $socails = new ActiveDataProvider([
          'query' => SocialOptions::find(),
      ]);

      $modelLogo = new SiteLogo();

      return $this->render('options', [
        'dataProvider' => $options,
        'socailProvider' => $socails,
        'modelLogo' => $modelLogo
      ]);
    }

    public function actionEdit_options() {
      // Check if there is an Editable ajax request
      if (isset($_POST['hasEditable'])) {
        $id = $_POST['editableKey'];
        $index = $_POST['editableIndex'];
        $value = $_POST['Options'][$index]['option_value'];
        $model = Options::find()->where(['option_id' => $id])->one();
        $model['option_value'] = $value;
        $model->save();
        $out = Json::encode(['output'=>$value, 'message'=>'']);
      }
      echo $out;
      return;
  }

  public function actionEdit_socials() {
    // Check if there is an Editable ajax request
    if (isset($_POST['hasEditable'])) {
      $id = $_POST['editableKey'];
      $index = $_POST['editableIndex'];
      $value = $_POST['SocialOptions'][$index]['value'];
      $social = SocialOptions::find()->where(['id' => $id])->one();
      // print_r($value);
      $social['value'] = $value;
      $social->save();

      $out = Json::encode(['output'=>$value, 'message'=>'']);
    }
    echo $out;
    return;
}

public function actionEdit_status() {
  // Check if there is an Editable ajax request
  if (isset($_POST['hasEditable'])) {
    $id = $_POST['editableKey'];
    $index = $_POST['editableIndex'];
    $value = $_POST['SocialOptions'][$index]['status'];
    $social = SocialOptions::find()->where(['id' => $id])->one();
    // print_r($_POST);
    $social['status'] = $value;
    $social->save();

    $out = Json::encode(['output'=>$value, 'message'=>'']);
  }
  echo $out;
  return;
}

public function actionUpload() {
      $model = new SiteLogo();
      $exceed =  SiteLogo::find()->exists();
      if(count($exceed) == 1){
          echo 'شما فقط مجاز به ارسال یک فایل می باشید. برای ادامه عملیات باید فایل فعلی را حذف کنید!';
          echo json_encode(['error']);
          return;
      }
      if (Yii::$app->request->isPost) {
        $ranStr = Yii::$app->security->generateRandomString($length = 9);
        $model->src = UploadedFile::getInstances($model, 'src');
        if ($model->src) {
        foreach ($model->src as $file) {
            $name = trim($file->baseName, '_-\t\n\r\0\x0B""');
            $file->saveAs(Yii::getAlias('@frontend').'/web/img/' . $name . $ranStr . '.' . $file->extension);
            $model->src = 'frontend/web/img/'.$name.$ranStr.'.jpg';
            $model->save();
        }
        return true;
        }
      }
      }


public function actionDelsingle($key){
  $find_ax = SiteLogo::findOne(['id' => $key]);
  $dir_pic = str_replace("frontend","",$find_ax->src);
  // echo Json::encode(['output'=>\Yii::getAlias('@frontend').$dir_pic, 'message'=>'']);
  // return;
  if ($find_ax != null){
    $find_ax->delete();
      unlink(\Yii::getAlias('@frontend').$dir_pic);
  }
  echo json_encode(['redirect'=>'_form',]);
}



}
