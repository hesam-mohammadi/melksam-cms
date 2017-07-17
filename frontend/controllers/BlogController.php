<?php
namespace frontend\controllers;
use yii\data\ActiveDataProvider;
use frontend\models\BlogPosts;
use frontend\models\BlogCategory;
class BlogController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $query = BlogPosts::find()->where(['status' => 1]);
        $cats = BlogCategory::find()->where(['status' => 1])->all();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 4,
            ],
        ]);
        return $this->render('index', [
          'query' => $query,
          'dataProvider' => $dataProvider,
          'cats' => $cats,
        ]);
    }

    public function actionArchive($id)
    {
      $query = BlogPosts::find()->where(['cat_id' => $id])->andWhere(['status' => 1]);
      $cats = BlogCategory::find()->where(['status' => 1])->all();
      $dataProvider = new ActiveDataProvider([
          'query' => $query,
          'pagination' => [
              'pageSize' => 4,
          ],
      ]);
      return $this->render('archive', [
        'query' => $query,
        'dataProvider' => $dataProvider,
        'cats' => $cats,
      ]);
    }

    public function actionView($id)
    {
      $modelPost = new BlogPosts();
      $model= BlogPosts::find()->where(['id' => $id])->one();
      $pictures = \backend\models\BlogPictures::find()->where(['blog_id' => $id])->one();
      $similar = $modelPost->findSimilarPosts($id);
      $dataProvider = new ActiveDataProvider([
          'query'=>$similar,
          'pagination'=>false,
          'sort'=> ['defaultOrder' => ['created_at' => SORT_DESC]]
      ]);
      return $this->render('view', [
        'model' => $model,
        'pictures' => $pictures,
        'dataProvider' => $dataProvider,
      ]);
    }

}
