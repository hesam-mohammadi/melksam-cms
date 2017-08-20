<?php
namespace frontend\models;

use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // ['username', 'trim'],
            // ['username', 'required'],
            // ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'این نام کاربری قبلا ثبت شده'],
            // ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'این ایمیل قبلا ثبت شده'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
     public function signup()
 {
     if ($this->validate()) {
         $user = new User();
         $auth = new \backend\models\AuthAssignment();
        //  $user->username = $this->username;
         $user->email = $this->email;
         $user->setPassword($this->password);
         $user->generateAuthKey();
         $user->status = 0;
         if ($user->save()) {
             $auth->item_name = 'کاربر';
             $auth->user_id = strval($user->id);
             $auth->save();
             return $user;
         }
     }

     return null;
 }
  public function mailbody()
  {
    if ($user = $this->signup()) {
  echo  '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
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
                                <a href="">
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
    </html>';
  }
  }
}
