<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Signup;
use app\models\Login;
use app\models\ToDo;

class SiteController extends Controller
{
    public function actionIndex()
    {
        //var_dump(Yii::$app->user->identity);die();
        return $this->render('index');
    }

    public function actionLogout()
    {
        if(!Yii::$app->user->isGuest)
        {
            Yii::$app->user->logout();
            return $this->redirect(['login']);
        }
    }

    public function actionSignup()
    {
        $model = new Signup();

        if(isset($_POST['Signup']))
        {
            $model->attributes = Yii::$app->request->post('Signup');
            if ($model->validate() && $model->signup())
            {
                return $this->goHome();
            }
        }
        return $this->render('signup',['model' =>$model]);
    }
    public function actionLogin()
    {
        if(!Yii::$app->user->isGuest)
        {
            return $this->goHome();
        }

        $login_model = new Login();

        if ( Yii::$app->request->post('Login'))
        {
            $login_model->attributes = Yii::$app->request->post('Login');
            if ($login_model->validate())
            {
                Yii::$app->user->login($login_model->getUser());
                return $this->goHome();
            }
        }

        return $this->render('login',['login_model'=>$login_model]);
    }

    public function actionTodo()
    {
        $array = Todo::getAll();
        $model_todo = new ToDo();

        if ($_POST['Create'])
        {
            $model_todo->title = $_POST['ToDo']['title'];
            $model_todo->description = $_POST['ToDo']['description'];
            $model_todo->id_user = Yii::$app->user->getId();
            $model_todo->is_done = false;
            if ($model_todo->validate() && $model_todo->save())
            {
                return $this->redirect(['site/todo']);
            }
        }
        return $this->render('todo', ['model_todo2'=>$array, 'model_todo'=>$model_todo]);
    }


    public function actionDelete($id)
    {
        $model_tod = ToDo::getOne($id);
        $model_tod -> delete();
        return $this->redirect(['site/todo']);
    }

    public function actionDone($id){
        $model = ToDo::getOne($id);
        $model->is_done = !$model->is_done;
        if ($model->validate() && $model->save())
        {
            return $this->redirect(['site/todo']);
        }
    }

    public function actionEdit($id){
        $model = ToDo::getOne($id);

        if ($_POST['Edit'])
        {
            $model->title = $_POST['ToDo']['title'];
            $model->description = $_POST['ToDo']['description'];
            if ($model->validate() && $model->save())
            {
                return $this->redirect(['site/todo']);
            }
        }
        return $this->render('edit', ['model_todo'=>$model]);
    }


    public function actionCreate()
    {
        //$array = ToDo::getOne
    }
}
