<?php

namespace  app\models;

use Yii;
use yii\base\Model;
use yii\helpers\Url;

class Signup extends Model
{
    public $email;
    public $password;

    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['email','password'],'required'],
            ['email','email'],
            ['email','unique','targetClass'=>'app\models\User'],
            ['password','string','min'=>2,'max'=>10]
        ];
    }

    /**
     * @return bool
     */
    public function signup()
    {
        $user = new User();
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->token = uniqid();
        $user->status = 0;
        $this->mail_subscription_activation($user->email, $user->token);
        return $user->save(); //true or false
    }

    public static function mail_subscription_activation ($email, $cod){

        $absoluteHomeUrl = Url::home(true); //http://ваш сайт
        $serverName = Yii::$app->request->serverName; //ваш сайт без http
        $url = $absoluteHomeUrl.'activation/'.$cod;

        $msg = "Здравствуйте! Спасибо за оформление подписки на сайте $serverName!  Вам осталось только подтвердить свой e-mail. Для этого перейдите по ссылке $url";

        $msg_html  = "<html><body style='font-family:Arial,sans-serif;'>";
        $msg_html .= "<h2 style='font-weight:bold;border-bottom:1px dotted #ccc;'>Здравствуйте! Спасибо за оформление подписки на сайте <a href='". $absoluteHomeUrl ."'>$serverName</a></h2>\r\n";
        $msg_html .= "<p><strong>Вам осталось только подтвердить свой e-mail.</strong></p>\r\n";
        $msg_html .= "<p><strong>Для этого перейдите по ссылке </strong><a href='". $url."'>$url</a></p>\r\n";
        $msg_html .= "</body></html>";

        Yii::$app->mailer->compose()
            ->setFrom('TodoList.adm@yandex.ru') //не надо указывать если указано в common\config\main-local.php
            ->setTo($email) // кому отправляем - реальный адрес куда придёт письмо формата asdf @asdf.com
            ->setSubject('Подтверждение подписки.') // тема письма
            ->setTextBody($msg) // текст письма без HTML
            ->setHtmlBody($msg_html) // текст письма с HTML
            ->send();
    }

    public function confirm($token){
        $user = $this->getUserByToken($token);
        if ($user != null){
            $user->token = '';
            $user->status = 1;
            return $user->save();
        }
        else return false;
    }
    public function getUser()
    {
        return User::findOne(['email'=>$this->email]);
    }
    public function getUserByToken($token)
    {
        return User::findOne(['token'=>$token]);
    }
}