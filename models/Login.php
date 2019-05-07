<?php

namespace  app\models;

use yii\base\Model;

class Login extends Model
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
            ['password','validatePassword']
        ];
    }

    public function validatePassword($attribute,$params)
    {
        if(!$this->hasErrors()) //no errors in validation
        {
            $user = $this->getUser(); //get user for next compare of password
            if(!$user || !$user->validatePassword($this->password))
            {
                $this->addError($attribute, 'Login or password is incorrect');
            }
        }
    }

    public function getUser()
    {
        return User::findOne(['login'=>$this->login]);
    }
}