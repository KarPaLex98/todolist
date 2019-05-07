<?php

namespace  app\models;

use yii\base\Model;

class Signup extends Model
{
    public $login;
    public $password;

    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['login','password'],'required'],
            ['login','string','min'=>2,'max'=>10],
            ['login','unique','targetClass'=>'app\models\User'],
            ['password','string','min'=>2,'max'=>10]
        ];
    }

    /**
     * @return bool
     */
    public function signup()
    {
        $user = new User();
        $user->login = $this->login;
        $user->setPassword($this->password);
        return $user->save(); //true or false
    }
}