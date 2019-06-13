<?php

namespace  app\models;

use yii\base\Model;

class Login extends Model
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
            ['password','validatePassword']
        ];
    }

    public function validatePassword($attribute,$params)
    {
        if(!$this->hasErrors()) //no errors in validation
        {
            $user = $this->getUser(); //get user for next compare of password
            if(!$user || !$user->validatePassword($this->password) || $user->status == 0)
            {
                $this->addError($attribute, 'Wrong email or password or account is not confirmed');
            }
        }
    }

    public function getUser()
    {
        return User::findOne(['email'=>$this->email]);
    }
}