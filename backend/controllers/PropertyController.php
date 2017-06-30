<?php

namespace backend\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\imagine\Image;
use backend\models\Property;
use backend\models\Pictures;

/**
 * PropertyController implements the CRUD actions for Property model.
 */
class PropertyController extends Controller
{
    /**
     * @inheritdoc
     */

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                    'subcat' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Property models.
     * @return mixed
     */
    public function actionIndex()
    {
        if(\Yii::$app->user->can('agent')) {
          $dataProvider = new ActiveDataProvider([
              'query' => Property::find(),
          ]);
        }
        else {
          $dataProvider = new ActiveDataProvider([
            'query' => Property::find()->where(['user_id' => \Yii::$app->user->id]),
          ]);
        }

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Property model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
      $model = $this->findModel($id);
      if(\Yii::$app->user->can('admin') || $model->user->id == \Yii::$app->user->id) {

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
     * Creates a new Property model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */

    public function actionCreate()
    {
        $model = new Property();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }


    /**
     * Updates an existing Property model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $modelpic = new Pictures();

        $dealing_type = $model->findAllDealingType();
        $document_type = $model->findAllDocumentType();
        $view = $model->findAllView();
        $cabinet = $model->findAllCabinet();
        $floor_covering = $model->findAllFloorCovering();
        $province_list = $model->findAllProvince();
        $property_type = $model->findAllPropertyType();
        $facilities = $model->findAllFacilities();
        $vila_type = $model->findAllVilaType();

        if(\Yii::$app->user->can('admin') || $model->user->id == \Yii::$app->user->id) {
          if ($model->load(Yii::$app->request->post()) && $model->save()) {
              $facility = $_POST['Property']['facilities_id'];
              $facilities_id = implode(',', $facility);
              $model->facilities_id = $facilities_id;
              $model->save();

              $modelpic = Pictures::find()->where(['user_id'=> Yii::$app->user->id])->andWhere(['agahi_id' => null])->all();
              foreach($modelpic as $ax){
                  $ax->agahi_id = $model->id;
                  $ax->save();
              }

              return $this->redirect(['view', 'id' => $model->id]);
          } else {
              return $this->render('update', [
                  'model' => $model,
                  'modelpic' => $modelpic,
                  'dealing_type' => $dealing_type,
                  'document_type' => $document_type,
                  'view' => $view,
                  'cabinet' => $cabinet,
                  'floor_covering' => $floor_covering,
                  'province_list' => $province_list,
                  'property_type' => $property_type,
                  'facilities' => $facilities,
                  'vila_type' => $vila_type,
              ]);
          }
        }
        else {
          Yii::$app->getSession()->setFlash('error', 'شما اجازه دسترسی به صفحه مورد نظر را ندارید!');
          return Yii::$app->getResponse()->redirect('index');
        }
    }

    public function actionCreate_apartment()
    {
        $model = new Property();
        $modelpic = new Pictures();
        $model->scenario = 'create_apartment';

        $dealing_type = $model->findAllDealingType();
        $document_type = $model->findAllDocumentType();
        $view = $model->findAllView();
        $cabinet = $model->findAllCabinet();
        $floor_covering = $model->findAllFloorCovering();
        $province_list = $model->findAllProvince();
        $property_type = $model->findAllPropertyType();
        $facilities = $model->findAllFacilities();

        $model->property_type_id = 1;
        $model->user_id = Yii::$app->user->id;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {

          $facility = $_POST['Property']['facilities_id'];
          $facilities_id = implode(',', $facility);

          $model->number_of_rooms = $_POST['Property']['number_of_rooms'];
          $model->geographical_pos = $_POST['Property']['geographical_pos'];
          $model->number_of_parkings = $_POST['Property']['number_of_parkings'];
          $model->telephone_line_count = $_POST['Property']['telephone_line_count'];
          $model->facilities_id = $facilities_id;
          $model->status = 0;
          $model->save();

          $find_ax = Pictures::find()->where(['user_id' => Yii::$app->user->id])->andWhere(['agahi_id' => null])->all();
          foreach($find_ax as $ax) {
              $ax->agahi_id = $model->id;
              $ax->save();
          }

          return $this->redirect(['view', 'id' => $model->id]);
        }
        else {
            return $this->render('create', [
                'model' => $model,
                'modelpic' => $modelpic,
                'dealing_type' => $dealing_type,
                'document_type' => $document_type,
                'view' => $view,
                'cabinet' => $cabinet,
                'floor_covering' => $floor_covering,
                'province_list' => $province_list,
                'property_type' => $property_type,
                'facilities' => $facilities,
            ]);
        }
    }

    public function actionCreate_villa()
    {
          $model = new Property();
          $modelpic = new Pictures();
          $model->scenario = 'create_villa';
          $dealing_type = $model->findAllDealingType();
          $document_type = $model->findAllDocumentType();
          $view = $model->findAllView();
          $cabinet = $model->findAllCabinet();
          $floor_covering = $model->findAllFloorCovering();
          $province_list = $model->findAllProvince();
          $property_type = $model->findAllPropertyType();
          $facilities = $model->findAllFacilities();
          $vila_type = $model->findAllVilaType();

          $model->user_id = Yii::$app->user->id;
          $model->property_type_id = 2;
          if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $facility = $_POST['Property']['facilities_id'];
            $facilities_id = implode(',', $facility);

            $model->number_of_rooms = $_POST['Property']['number_of_rooms'];
            $model->geographical_pos = $_POST['Property']['geographical_pos'];
            $model->number_of_parkings = $_POST['Property']['number_of_parkings'];
            $model->telephone_line_count = $_POST['Property']['telephone_line_count'];
            $model->facilities_id = $facilities_id;
            $model->status = 0;
            $model->save();

            $find_ax = Pictures::find()->where(['user_id' => Yii::$app->user->id])->andWhere(['agahi_id' => null])->all();
            foreach($find_ax as $ax) {
                $ax->agahi_id = $model->id;
                $ax->save();
            }
            return $this->redirect(['view', 'id' => $model->id]);
          }
          else {
              return $this->render('create', [
                  'model' => $model,
                  'modelpic' => $modelpic,
                  'dealing_type' => $dealing_type,
                  'document_type' => $document_type,
                  'view' => $view,
                  'cabinet' => $cabinet,
                  'floor_covering' => $floor_covering,
                  'province_list' => $province_list,
                  'property_type' => $property_type,
                  'facilities' => $facilities,
                  'vila_type' => $vila_type,
              ]);
          }

    }

    public function actionCreate_complex()
    {
          $model = new Property();
          $modelpic = new Pictures();

          $dealing_type = $model->findAllDealingType();
          $document_type = $model->findAllDocumentType();
          $view = $model->findAllView();
          $cabinet = $model->findAllCabinet();
          $floor_covering = $model->findAllFloorCovering();
          $province_list = $model->findAllProvince();
          $property_type = $model->findAllPropertyType();
          $facilities = $model->findAllFacilities();

          $model->user_id = Yii::$app->user->id;
          $model->property_type_id = 3;

          if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $facility = $_POST['Property']['facilities_id'];
            $facilities_id = implode(',', $facility);

            $model->geographical_pos = $_POST['Property']['geographical_pos'];
            $model->number_of_parkings = $_POST['Property']['number_of_parkings'];
            $model->telephone_line_count = $_POST['Property']['telephone_line_count'];
            $model->facilities_id = $facilities_id;
            $model->status = 0;
            $model->save();

            $find_ax = Pictures::find()->where(['user_id' => Yii::$app->user->id])->andWhere(['agahi_id' => null])->all();
            foreach($find_ax as $ax) {
                $ax->agahi_id = $model->id;
                $ax->save();
            }
            return $this->redirect(['view', 'id' => $model->id]);
          }
          else {
              return $this->render('create', [
                  'model' => $model,
                  'modelpic' => $modelpic,
                  'dealing_type' => $dealing_type,
                  'document_type' => $document_type,
                  'view' => $view,
                  'cabinet' => $cabinet,
                  'floor_covering' => $floor_covering,
                  'province_list' => $province_list,
                  'property_type' => $property_type,
                  'facilities' => $facilities,
              ]);
          }

    }

    public function actionCreate_store()
    {
          $model = new Property();
          $modelpic = new Pictures();

          $dealing_type = $model->findAllDealingType();
          $document_type = $model->findAllDocumentType();
          $view = $model->findAllView();
          $cabinet = $model->findAllCabinet();
          $floor_covering = $model->findAllFloorCovering();
          $province_list = $model->findAllProvince();
          $property_type = $model->findAllPropertyType();
          $facilities = $model->findAllFacilities();

          $model->user_id = Yii::$app->user->id;
          $model->property_type_id = 4;

          if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $facility = $_POST['Property']['facilities_id'];
            $facilities_id = implode(',', $facility);

            $model->geographical_pos = $_POST['Property']['geographical_pos'];
            $model->number_of_parkings = $_POST['Property']['number_of_parkings'];
            $model->telephone_line_count = $_POST['Property']['telephone_line_count'];
            $model->facilities_id = $facilities_id;
            $model->status = 0;
            $model->save();

            $find_ax = Pictures::find()->where(['user_id' => Yii::$app->user->id])->andWhere(['agahi_id' => null])->all();
            foreach($find_ax as $ax) {
                $ax->agahi_id = $model->id;
                $ax->save();
            }
            return $this->redirect(['view', 'id' => $model->id]);
          }
          else {
              return $this->render('create', [
                  'model' => $model,
                  'modelpic' => $modelpic,
                  'dealing_type' => $dealing_type,
                  'document_type' => $document_type,
                  'view' => $view,
                  'cabinet' => $cabinet,
                  'floor_covering' => $floor_covering,
                  'province_list' => $province_list,
                  'property_type' => $property_type,
                  'facilities' => $facilities,
              ]);
          }

    }

    public function actionCreate_land()
    {
          $model = new Property();
          $modelpic = new Pictures();

          $dealing_type = $model->findAllDealingType();
          $document_type = $model->findAllDocumentType();
          $view = $model->findAllView();
          $cabinet = $model->findAllCabinet();
          $floor_covering = $model->findAllFloorCovering();
          $province_list = $model->findAllProvince();
          $property_type = $model->findAllPropertyType();
          $facilities = $model->findAllFacilities();

          $model->user_id = Yii::$app->user->id;
          $model->property_type_id = 5;

          if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $facility = $_POST['Property']['facilities_id'];
            $facilities_id = implode(',', $facility);

            $model->geographical_pos = $_POST['Property']['geographical_pos'];
            $model->facilities_id = $facilities_id;
            $model->status = 0;
            $model->save();

            $find_ax = Pictures::find()->where(['user_id' => Yii::$app->user->id])->andWhere(['agahi_id' => null])->all();
            foreach($find_ax as $ax) {
                $ax->agahi_id = $model->id;
                $ax->save();
            }
            return $this->redirect(['view', 'id' => $model->id]);
          }
          else {
              return $this->render('create', [
                  'model' => $model,
                  'modelpic' => $modelpic,
                  'dealing_type' => $dealing_type,
                  'document_type' => $document_type,
                  'view' => $view,
                  'cabinet' => $cabinet,
                  'floor_covering' => $floor_covering,
                  'province_list' => $province_list,
                  'property_type' => $property_type,
                  'facilities' => $facilities,
              ]);
          }

    }

    public function actionCreate_farm()
    {
          $model = new Property();
          $modelpic = new Pictures();
          $model->scenario = 'create_farm';

          $dealing_type = $model->findAllDealingType();
          $document_type = $model->findAllDocumentType();
          $view = $model->findAllView();
          $cabinet = $model->findAllCabinet();
          $floor_covering = $model->findAllFloorCovering();
          $province_list = $model->findAllProvince();
          $property_type = $model->findAllPropertyType();
          $facilities = $model->findAllFacilities();

          $model->user_id = Yii::$app->user->id;
          $model->property_type_id = 6;

          if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $facility = $_POST['Property']['facilities_id'];
            $facilities_id = implode(',', $facility);

            $model->facilities_id = $facilities_id;
            $model->status = 0;
            $model->save();

            $find_ax = Pictures::find()->where(['user_id' => Yii::$app->user->id])->andWhere(['agahi_id' => null])->all();
            foreach($find_ax as $ax) {
                $ax->agahi_id = $model->id;
                $ax->save();
            }
            return $this->redirect(['view', 'id' => $model->id]);
          }
          else {
              return $this->render('create', [
                  'model' => $model,
                  'modelpic' => $modelpic,
                  'dealing_type' => $dealing_type,
                  'document_type' => $document_type,
                  'view' => $view,
                  'cabinet' => $cabinet,
                  'floor_covering' => $floor_covering,
                  'province_list' => $province_list,
                  'property_type' => $property_type,
                  'facilities' => $facilities,
              ]);
          }
    }

    public function actionCreate_damdari()
    {
          $model = new Property();
          $modelpic = new Pictures();
          $model->scenario = 'create_damdari';

          $dealing_type = $model->findAllDealingType();
          $document_type = $model->findAllDocumentType();
          $view = $model->findAllView();
          $cabinet = $model->findAllCabinet();
          $floor_covering = $model->findAllFloorCovering();
          $province_list = $model->findAllProvince();
          $property_type = $model->findAllPropertyType();
          $facilities = $model->findAllFacilities();

          $model->user_id = Yii::$app->user->id;
          $model->property_type_id = 7;

          if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $facility = $_POST['Property']['facilities_id'];
            $facilities_id = implode(',', $facility);

            $model->facilities_id = $facilities_id;
            $model->status = 0;
            $model->save();

            $find_ax = Pictures::find()->where(['user_id' => Yii::$app->user->id])->andWhere(['agahi_id' => null])->all();
            foreach($find_ax as $ax) {
                $ax->agahi_id = $model->id;
                $ax->save();
            }
            return $this->redirect(['view', 'id' => $model->id]);
          }
          else {
              return $this->render('create', [
                  'model' => $model,
                  'modelpic' => $modelpic,
                  'dealing_type' => $dealing_type,
                  'document_type' => $document_type,
                  'view' => $view,
                  'cabinet' => $cabinet,
                  'floor_covering' => $floor_covering,
                  'province_list' => $province_list,
                  'property_type' => $property_type,
                  'facilities' => $facilities,
              ]);
          }
    }

    public function actionCreate_factory()
    {
          $model = new Property();
          $modelpic = new Pictures();
          $model->scenario = 'create_factory';

          $dealing_type = $model->findAllDealingType();
          $document_type = $model->findAllDocumentType();
          $view = $model->findAllView();
          $cabinet = $model->findAllCabinet();
          $floor_covering = $model->findAllFloorCovering();
          $province_list = $model->findAllProvince();
          $property_type = $model->findAllPropertyType();
          $facilities = $model->findAllFacilities();

          $model->user_id = Yii::$app->user->id;
          $model->property_type_id = 8;

          if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $facility = $_POST['Property']['facilities_id'];
            $facilities_id = implode(',', $facility);

            $model->facilities_id = $facilities_id;
            $model->status = 0;
            $model->save();

            $find_ax = Pictures::find()->where(['user_id' => Yii::$app->user->id])->andWhere(['agahi_id' => null])->all();
            foreach($find_ax as $ax) {
                $ax->agahi_id = $model->id;
                $ax->save();
            }
            return $this->redirect(['view', 'id' => $model->id]);
          }
          else {
              return $this->render('create', [
                  'model' => $model,
                  'modelpic' => $modelpic,
                  'dealing_type' => $dealing_type,
                  'document_type' => $document_type,
                  'view' => $view,
                  'cabinet' => $cabinet,
                  'floor_covering' => $floor_covering,
                  'province_list' => $province_list,
                  'property_type' => $property_type,
                  'facilities' => $facilities,
              ]);
          }
    }

    public function actionUpload() {
          $model = new Property();
          $modelPic = new Pictures();
          if (Yii::$app->request->isPost) {
            $ranStr = Yii::$app->security->generateRandomString($length = 9);
            $model->file = UploadedFile::getInstances($model, 'file');

            if ($model->file) {
            foreach ($model->file as $file) {
                $name = trim($file->baseName, '_-\t\n\r\0\x0B""');
                $file->saveAs(Yii::getAlias('@frontend').'/web/uploads/' . $name . $ranStr . '.' . $file->extension);

                Image::thumbnail(Yii::getAlias('@frontend').'/web/uploads/' . $name . $ranStr . '.' . $file->extension, 259, 172)
                ->save(Yii::getAlias('@frontend').'/web/uploads/' . $name . $ranStr . '259x172' . '.' . $file->extension, ['quality' => 80]);

                Image::thumbnail(Yii::getAlias('@frontend').'/web/uploads/' . $name . $ranStr . '.' . $file->extension, 274, 182)
                ->save(Yii::getAlias('@frontend').'/web/uploads/' . $name . $ranStr . '274x182' . '.' . $file->extension, ['quality' => 80]);

                Image::thumbnail(Yii::getAlias('@frontend').'/web/uploads/' . $name . $ranStr . '.' . $file->extension, 751, 348)
                ->save(Yii::getAlias('@frontend').'/web/uploads/' . $name . $ranStr . '751x348' . '.' . $file->extension, ['quality' => 80]);
            }
            $modelPic->user_id = Yii::$app->user->id;
            $modelPic->src = 'frontend/web/uploads/'.$name.$ranStr.'.jpg,frontend/web/uploads/'.$name.$ranStr.'259x172.jpg,frontend/web/uploads/'.$name.$ranStr.'274x182.jpg,frontend/web/uploads/'.$name.$ranStr.'751x348.jpg';
            $modelPic->save();

            return true;
          }
          }
    }

    public function actionDelsingle($key){
      $find_ax = Pictures::findOne(['id' => $key]);
      if ($find_ax != null){
        $find_ax->delete();

        $dir_pic = str_replace("frontend","",$find_ax->src);
        $pics = explode(',', $dir_pic);
        foreach($pics as $pic) {
          unlink(Yii::getAlias('@frontend').$pic);
        }
      }
      echo json_encode(['redirect'=>'_form',]);
    }

    public function actionSubcat() {
      $out = [];
    if (isset($_POST['depdrop_parents'])) {
        $parents = $_POST['depdrop_parents'];
        if ($parents != null) {
            $cat_id = $parents[0];
            $out = City::find()->where(['province_id' => $cat_id ])->all();
            // the getSubCatList function will query the database based on the
            // cat_id and return an array like below:
            // [
            //    ['id'=>'<sub-cat-id-1>', 'name'=>'<sub-cat-name1>'],
            //    ['id'=>'<sub-cat_id_2>', 'name'=>'<sub-cat-name2>']
            // ]
            echo \yii\helpers\Json::encode(['output'=> $out, 'selected'=>'']);
            return;
        }
    }
    echo Json::encode(['output'=>'', 'selected'=>'']);
}

public function actionProd() {
    $out = [];
    if (isset($_POST['depdrop_parents'])) {
        $ids = $_POST['depdrop_parents'];
        // $cat_id = empty($ids[0]) ? null : $ids[0];
        $subcat_id = empty($ids[1]) ? null : $ids[1];
        if ($cat_id != null) {
           $rglist = Region::find()->where(['city_id' => $subcat_id ])->asArray()->select(['id','name'])->all();
           $data = $rglist;
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

           echo Json::encode(['output'=>$data['out'], 'selected'=>$data['selected']]);
           return;
        }
    }
    echo Json::encode(['output'=>'', 'selected'=>'']);
}

    /**
     * Deletes an existing Property model.
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
     * Finds the Property model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Property the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Property::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
