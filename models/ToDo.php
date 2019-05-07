<?php

namespace app\models;

use Yii;

class ToDo extends \yii\db\ActiveRecord
{
    public function rules()
    {
        return [
            [['title', 'description'], 'required'],
            ['title','string','min'=>2,'max'=>290],
            ['description','string','min'=>2,'max'=>290]
        ];
    }

    public static function tableName()
    {
        return 'todo';
    }

    public static function getAll()
    {
        $data = self::find()->where(['id_user' => Yii::$app->user->getId()])->all();
        return $data;
    }

    public static function getOne($id)
    {
        $data = self::find()->where(['id'=>$id])->one();
        return $data;
    }
}