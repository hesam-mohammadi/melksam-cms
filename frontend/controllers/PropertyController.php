<?php
namespace frontend\controllers;
use yii\data\ActiveDataProvider;
use frontend\models\Property;
use backend\models\Inbox;
use frontend\models\PropertySearch;

class PropertyController extends \yii\web\Controller
{
    public function actionListingDetail($id)
    {
      $inbox = new Inbox();
      if ($inbox->load(\Yii::$app->request->post()) && $inbox->validate()) {
        $inbox->sendMessage($id);
        return $this->refresh();
      }
      else {
        $modelProperty = new Property();
        $pictures = $modelProperty->findPictures($id);
        $similar = $modelProperty->findSimilarProperties($id);
        $dataProvider = new ActiveDataProvider([
            'query'=>$similar,
            'pagination'=>false,
            'sort'=> ['defaultOrder' => ['created_at' => SORT_DESC]]
        ]);
        return $this->render('listing-detail', [
            'model' => $this->findModel($id),
            'pictures' => $pictures,
            'inbox' => $inbox,
            'dataProvider'=>$dataProvider,
        ]);
      }

    }

    public function actionSearch()
    {
      $searchModel = new PropertySearch();
      $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);

      return $this->render('/property/archive', [
          'searchModel' => $searchModel,
          'dataProvider' => $dataProvider,

      ]);
    }


    public function actionFav() {
        if(\Yii::$app->request->isAjax) {
            $cookies = \Yii::$app->response->cookies;
            $reqcookies = \Yii::$app->request->cookies;

            if ($reqcookies->has('fav-'.$_POST['id'])) {
              $cookies->remove('fav-'.$_POST['id']);
              unset($cookies['fav-'.$_POST['id']]);
              // \Yii::$app->cache->flush();
              $alert = 'removed';
            }
            else {
              $cookies->add(new \yii\web\Cookie([
                  'name' => 'fav-'.$_POST['id'],
                  'value' => $_POST['id'],
              ]));
              $alert = 'success';
            }

          \Yii::$app->response->format = \yii\web\response::FORMAT_JSON;
          return [
            'alert' => $alert
          ];
        }
        else {
        die();
        }
    }

    protected function findModel($id)
    {
        if (($model = Property::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


}
