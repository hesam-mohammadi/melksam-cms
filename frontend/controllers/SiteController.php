<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use frontend\models\Property;
use frontend\models\PropertySearch;


/**
 * Site controller
 */
class SiteController extends Controller
{
  public $successUrl = '';
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
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
            'auth' => [
                'class' => 'yii\authclient\AuthAction',
                'successCallback' => [$this, 'successCallback'],
            ],
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
      $query= Property::find()->where(['status' => 1]);
      $model = new Property();
      $provider= new ActiveDataProvider([
        'query' => $query,
        // 'Pagination' => [
        //   'pageSize' => 10,
        // ],

      ]);
      return $this->render('index', ['dataProvider' => $provider]);
    }

    public function actionSearch()
    {
      $searchModel = new PropertySearch();
      $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

      return $this->render('/property/archive', [
          'searchModel' => $searchModel,
          'dataProvider' => $dataProvider,
      ]);
    }

    /**
     * Logs in a user.
     *
     * @return mixed
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
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionFav()
    {
      return $this->render('favorite-listings');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
          if ($user = $model->signup()) {
            $email = \Yii::$app->mailer->compose()
            ->setTo($user->email)
            ->setFrom([\Yii::$app->params['supportEmail'] => \Yii::$app->name . ' robot'])
            ->setSubject('فعالسازی ثبت نام')
            ->setHtmlBody('
            <!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
            <!--[if IE 9 ]><html lang="en" class="ie9"><![endif]-->
                <head>
                    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1">
                    <meta http-equiv="X-UA-Compatible" content="IE=edge">
                    <meta name="format-detection" content="telephone=no">
                    <title>Roost Material Design Real Estate</title>
                    <link href="https://cdn.rawgit.com/rastikerdar/vazir-font/v7.0.0/dist/font-face.css" rel="stylesheet" type="text/css" />
                    <!-- Client specific styles - DO NOT REMOVE -->
                    <style type="text/css">
                        body {
                            margin: 0;
                            padding: 0;
                            -ms-text-size-adjust: 100%;
                            -webkit-text-size-adjust: 100%;
                        }

                        table {
                            border-spacing: 0;
                        }

                        table td {
                            border-collapse: collapse;
                        }

                        .appleLinks a {
                            color:#b4b4b4;
                            text-decoration: none;
                        }

                        .backgroundTable {
                            margin:0 auto;
                            padding:0;
                            width:100%;!important;
                        }

                        .ExternalClass {
                            width: 100%;
                        }

                        .ExternalClass,
                        .ExternalClass p,
                        .ExternalClass span,
                        .ExternalClass font,
                        .ExternalClass td,
                        .ExternalClass div {
                            line-height: 100%;
                        }

                        .ReadMsgBody {
                            width: 100%;
                            background-color: #ebebeb;
                        }

                        table {
                            mso-table-lspace: 0pt;
                            mso-table-rspace: 0pt;
                        }

                        table td {
                            border-collapse: collapse;
                        }

                        img {
                            -ms-interpolation-mode: bicubic;
                        }

                        .yshortcuts a {
                            border-bottom: none !important;
                        }

                        @media screen and (max-width: 714px) {
                            .force-row,
                            .container,
                            .tweet-col,
                            .ecxtweet-col {
                                width: 100% !important;
                                max-width: 100% !important;
                            }

                            .container {
                                padding-top: 0 !important;
                                padding-bottom: 0 !important;
                            }
                        }
                        .ios-footer a {
                            color: #aaaaaa !important;
                            text-decoration: underline;
                        }
                    </style>

                <body bgcolor="#eeeeee" style="margin:0; padding:0; -webkit-font-smoothing: antialiased; background-color: #eeeeee; direction: rtl;" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" >

                    <table border="0" width="100%" height="100%" cellpadding="0" cellspacing="0">
                        <tr>
                            <td align="center" valign="top">

                                <table bgcolor="#ffffff" border="0" width="650" cellpadding="0" cellspacing="0" class="container" style="width:650px; max-width:650px; background-color: #ffffff;">
                                <tr>
                                    <td>
                                        <a href="listing-mail.html">
                                            <img src="https://cdn.elegantthemes.com/blog/wp-content/uploads/2015/12/realestateplugins.jpg" width="650" alt="">
                                        </a>
                                    </td>
                                </tr>
                                    <tr>
                                        <td width="100%" border="0" style="padding-top:20px;padding-right:20px;padding-left:20px;background-color:#ffffff">
                                            <table border="0" width="100%" cellpadding="0" cellspacing="0">


                                                <tr>
                                                    <td>
                                                        <p style="font-family:Vazir, sans-serif;font-size:18px; color: #000000; text-align: center; margin-bottom: 0; padding-bottom: 0;">فقط یه قدم دیگه باقی مونده ...</p>
                                                    </td>
                                                </tr>

                                                <tr><td valign="top" width="100%" style="line-height: 30px; font-size: 0" height="30;">&nbsp;</td></tr>

                                                <tr>
                                                    <td style="font-family: Vazir, sans-serif; font-size: 13px; color: #545454; text-align: center; line-height: 20px;">
                                                    از اینکه در ' . \Yii::$app->name . ' ثبت نام کردید از شما متشکریم. <br/> جهت تکمیل ثبت نام خود لطفا روی دکمه زیر کلیک کنید:
                                                    </td>
                                                </tr>

                                                <tr><td valign="top" width="100%" style="line-height: 60px; font-size: 0" height="60;">&nbsp;</td></tr>

                                                <tr>
                                                    <td style="text-align: center;">
                                                        <a href="'.\Yii::$app->urlManager->createAbsoluteUrl(['site/confirm','id'=>$user->id,'key'=>$user->auth_key]).'" style="font-family: Arial, sans-serif; font-size: 13px; color: #ffffff !important;text-decoration:none !important; line-height: 100%; padding-bottom: 12px; padding-right: 20px; padding-left: 20px; padding-top: 14px; border-radius: 2px; background-color: #4595e7;">
                                                            <font color="#fff">فعالسازی حساب کاربری</font>
                                                        </a>
                                                        <a href="listing-mail.html" style="text-decoration: none;"></a>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>

                                    <tr><td valign="top" width="100%" style="line-height: 70px; font-size: 0" height="70;">&nbsp;</td></tr>

                                    <tr>
                                        <td align="left" style="font-family:Arial, sans-serif;font-size:13px;">
                                            <table border="0" width="100%" bgcolor="#f5f5f5" cellpadding="0" cellspacing="0" style="width:100%;background-color:#f5f5f5">
                                                <tr>
                                                    <td valign="top" style="padding-left:30px;padding-right:30px;padding-bottom:30px;padding-top:30px;font-family:Arial,sans-serif;font-size:13px;text-align:center">
                                                        <a href="listing-mail.html" style="color: #848484 !important;text-decoration:none !important"><font color="#848484">Roost Material Design Real Estate</font></a>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>

                </body>
            </html>
            ')
            ->send();
            if($email){
              \Yii::$app->getSession()->setFlash('signup_success','حالا ایمیل خودتون رو چک کنید');
            }
            else{
            \Yii::$app->getSession()->setFlash('signup_failed','Failed, contact Admin!');
            }
            return $this->render('success-signup',['id' => $user->id]);
            }
            }


        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    public function actionSuccessSignup() {
      return $this->render('success-signup');
    }

    public function actionConfirm($id, $key)
    {
            $user = \common\models\User::find()->where([
            'id'=>$id,
            'auth_key'=>$key,
            'status'=>0,
            ])->one();
            if(!empty($user)){
            $user->status=10;
            $user->save();
            Yii::$app->getSession()->setFlash('confirm_success',' :) به حساب کاربریتون هم وارد شدید');
            }
            else{
            Yii::$app->getSession()->setFlash('cofirm_warning','خطا در تایید ثبت نام لطفا دوباره امتحان کنید!');
            }
            \Yii::$app->user->login($user);
            return $this->goHome();
            }

    public function actionResendConfirmEmail($id)
    {
          $usermodel = \common\models\User::find()->where([
            'status'=>0,
            'id'=>$id,
          ])->one();

          if(!empty($usermodel)){
            $email = \Yii::$app->mailer->compose()
            ->setTo($usermodel->email)
            ->setFrom([\Yii::$app->params['supportEmail'] => \Yii::$app->name . ' robot'])
            ->setSubject('فعالسازی ثبت نام')
            ->setHtmlBody('
            <!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
            <!--[if IE 9 ]><html lang="en" class="ie9"><![endif]-->
                <head>
                    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1">
                    <meta http-equiv="X-UA-Compatible" content="IE=edge">
                    <meta name="format-detection" content="telephone=no">
                    <title>Roost Material Design Real Estate</title>
                    <link href="https://cdn.rawgit.com/rastikerdar/vazir-font/v7.0.0/dist/font-face.css" rel="stylesheet" type="text/css" />
                    <!-- Client specific styles - DO NOT REMOVE -->
                    <style type="text/css">
                        body {
                            margin: 0;
                            padding: 0;
                            -ms-text-size-adjust: 100%;
                            -webkit-text-size-adjust: 100%;
                        }

                        table {
                            border-spacing: 0;
                        }

                        table td {
                            border-collapse: collapse;
                        }

                        .appleLinks a {
                            color:#b4b4b4;
                            text-decoration: none;
                        }

                        .backgroundTable {
                            margin:0 auto;
                            padding:0;
                            width:100%;!important;
                        }

                        .ExternalClass {
                            width: 100%;
                        }

                        .ExternalClass,
                        .ExternalClass p,
                        .ExternalClass span,
                        .ExternalClass font,
                        .ExternalClass td,
                        .ExternalClass div {
                            line-height: 100%;
                        }

                        .ReadMsgBody {
                            width: 100%;
                            background-color: #ebebeb;
                        }

                        table {
                            mso-table-lspace: 0pt;
                            mso-table-rspace: 0pt;
                        }

                        table td {
                            border-collapse: collapse;
                        }

                        img {
                            -ms-interpolation-mode: bicubic;
                        }

                        .yshortcuts a {
                            border-bottom: none !important;
                        }

                        @media screen and (max-width: 714px) {
                            .force-row,
                            .container,
                            .tweet-col,
                            .ecxtweet-col {
                                width: 100% !important;
                                max-width: 100% !important;
                            }

                            .container {
                                padding-top: 0 !important;
                                padding-bottom: 0 !important;
                            }
                        }
                        .ios-footer a {
                            color: #aaaaaa !important;
                            text-decoration: underline;
                        }
                    </style>

                <body bgcolor="#eeeeee" style="margin:0; padding:0; -webkit-font-smoothing: antialiased; background-color: #eeeeee; direction: rtl;" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" >

                    <table border="0" width="100%" height="100%" cellpadding="0" cellspacing="0">
                        <tr>
                            <td align="center" valign="top">

                                <table bgcolor="#ffffff" border="0" width="650" cellpadding="0" cellspacing="0" class="container" style="width:650px; max-width:650px; background-color: #ffffff;">
                                <tr>
                                    <td>
                                        <a href="listing-mail.html">
                                            <img src="https://cdn.elegantthemes.com/blog/wp-content/uploads/2015/12/realestateplugins.jpg" width="650" alt="">
                                        </a>
                                    </td>
                                </tr>
                                    <tr>
                                        <td width="100%" border="0" style="padding-top:20px;padding-right:20px;padding-left:20px;background-color:#ffffff">
                                            <table border="0" width="100%" cellpadding="0" cellspacing="0">


                                                <tr>
                                                    <td>
                                                        <p style="font-family:Vazir, sans-serif;font-size:18px; color: #000000; text-align: center; margin-bottom: 0; padding-bottom: 0;">فقط یه قدم دیگه باقی مونده ...</p>
                                                    </td>
                                                </tr>

                                                <tr><td valign="top" width="100%" style="line-height: 30px; font-size: 0" height="30;">&nbsp;</td></tr>

                                                <tr>
                                                    <td style="font-family: Vazir, sans-serif; font-size: 13px; color: #545454; text-align: center; line-height: 20px;">
                                                    از اینکه در ' . \Yii::$app->name . ' ثبت نام کردید از شما متشکریم. <br/> جهت تکمیل ثبت نام خود لطفا روی دکمه زیر کلیک کنید:
                                                    </td>
                                                </tr>

                                                <tr><td valign="top" width="100%" style="line-height: 60px; font-size: 0" height="60;">&nbsp;</td></tr>

                                                <tr>
                                                    <td style="text-align: center;">
                                                        <a href="'.\Yii::$app->urlManager->createAbsoluteUrl(['site/confirm','id'=>$usermodel->id,'key'=>$usermodel->auth_key]).'" style="font-family: Arial, sans-serif; font-size: 13px; color: #ffffff !important;text-decoration:none !important; line-height: 100%; padding-bottom: 12px; padding-right: 20px; padding-left: 20px; padding-top: 14px; border-radius: 2px; background-color: #4595e7;">
                                                            <font color="#fff">فعالسازی حساب کاربری</font>
                                                        </a>
                                                        <a href="listing-mail.html" style="text-decoration: none;"></a>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>

                                    <tr><td valign="top" width="100%" style="line-height: 70px; font-size: 0" height="70;">&nbsp;</td></tr>

                                    <tr>
                                        <td align="left" style="font-family:Arial, sans-serif;font-size:13px;">
                                            <table border="0" width="100%" bgcolor="#f5f5f5" cellpadding="0" cellspacing="0" style="width:100%;background-color:#f5f5f5">
                                                <tr>
                                                    <td valign="top" style="padding-left:30px;padding-right:30px;padding-bottom:30px;padding-top:30px;font-family:Arial,sans-serif;font-size:13px;text-align:center">
                                                        <a href="listing-mail.html" style="color: #848484 !important;text-decoration:none !important"><font color="#848484">Roost Material Design Real Estate</font></a>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>

                </body>
            </html>
            ')
            ->send();
            if($email){
              \Yii::$app->getSession()->setFlash('resend_success','حالا ایمیل خودتون رو چک کنید');
            }
            else{
            \Yii::$app->getSession()->setFlash('resend_failed','لطفا در صورت مشکل با پشتیبانی سایت تماس بگیرید.');
            }


            return $this->render('success-signup', ['id' => $id]);
          }
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success_reset', 'حالا ایمیل خودتون رو چک کنید');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('warning_reset', 'متاسفانه نشد که کلمه عبورتون رو بازیابی کنیم، لطفا دوباره امتحان کنید.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success_password_saved', ':) حالا میتونید وارد حساب کاربری خودتون بشید ');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
    public function successCallback($client)
{
    $attributes = $client->getUserAttributes();
    // user login or signup comes here
    /*
    Kalo di die(print_r($attributes));
    maka akan keluar
    Array ( [id] => https://www.google.com/accounts/o8/id?id=AItOawkSN3ecyrQAUOVyy9kuX-2oq-hahagake [namePerson/first] => Hafid [namePerson/last] => Mukhlasin [pref/language] => en [contact/email] => milisstudio@gmail.com [first_name] => Hafid [last_name] => Mukhlasin [email] => milisstudio@gmail.com [language] => en )

    Nah data ini bisa kita gunakan untuk check apakah si user udah terdaftar ato belum..
    */

    $user = \common\models\User::find()
        ->where([
            'email'=>$attributes['email'],
        ])
        ->one();
    if(!empty($user)){
        Yii::$app->user->login($user);
    }
    else{
        //Simpen disession attribute user dari Google
        $session = Yii::$app->session;
        $session['attributes']=$attributes;
        // redirect ke form signup, dengan mengset nilai variabell global successUrl
        $this->successUrl = \yii\helpers\Url::to(['signup']);
    }

}
public function onAuthSuccess($client)
    {
       $attributes = $client->getUserAttributes();

        /** @var Auth $auth */
        $auth = Auth::find()->where([
            'source' => $client->getId(),
            'source_id' => $attributes['id'],
        ])->one();

        if (Yii::$app->user->isGuest) {
            if ($auth) { // login
                $user = $auth->user;
                Yii::$app->user->login($user);
            } else { // signup
                if (User::find()->where(['email' => $attributes['email']])->exists()) {
                    Yii::$app->getSession()->setFlash('error', [
                        Yii::t('app', "User with the same email as in {client} account already exists but isn't linked to it. Login using email first to link it.", ['client' => $client->getTitle()]),
                    ]);
                } else {
                    $password = Yii::$app->security->generateRandomString(6);
                    $user = new User([
                        'username' => $attributes['login'],
                        'email' => $attributes['email'],
                        'password' => $password,
                    ]);
                    $user->generateAuthKey();
                    $user->generatePasswordResetToken();
                    $transaction = $user->getDb()->beginTransaction();
                    if ($user->save()) {
                        $auth = new Auth([
                            'user_id' => $user->id,
                            'source' => $client->getId(),
                            'source_id' => (string)$attributes['id'],
                        ]);
                        if ($auth->save()) {
                            $transaction->commit();
                            Yii::$app->user->login($user);
                        } else {
                            print_r($auth->getErrors());
                        }
                    } else {
                        print_r($user->getErrors());
                    }
                }
            }
        } else { // user already logged in
            if (!$auth) { // add auth provider
                $auth = new Auth([
                    'user_id' => Yii::$app->user->id,
                    'source' => $client->getId(),
                    'source_id' => $attributes['id'],
                ]);
                $auth->save();
            }
        }
    }
}
