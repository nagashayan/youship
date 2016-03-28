<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Profile;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProfileController implements the CRUD actions for Profile model.
 */
class ProfileController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Profile models.
     * @return mixed
     */
    public function actionIndex()
    {
        $id = Yii::$app->user->getId();
        $create = true;
        $dataProvider = new ActiveDataProvider([
            'query' => Profile::find()->where("user_id = $id"),
        ]);
       
        if(Profile::find()->where("user_id = $id")->count() >= 1){
            $create = false; 
        }
        return $this->render('index', [
            'dataProvider' => $dataProvider,'create'=>$create
        ]);
    }

    /**
     * Displays a single Profile model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {   
        $model =  $this->findModel($id);
        if($model->user_id == Yii::$app->user->getId()){
        return $this->render('view', [
            'model' => $model,
        ]);
        }
        else{
             $message = ACCESSDENIED;
                 return $this->render('/site/error', [
                        'name' => 'Error', 'message'=>$message ]);
        }
    }

    /**
     * Creates a new Profile model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Profile();
        $model->user_id = Yii::$app->user->getId();
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Profile model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model =  $this->findModel($id);
        if($model->user_id == Yii::$app->user->getId()){
       

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
        }
        else{
             $message = ACCESSDENIED;
                 return $this->render('site/error', [
                        'name' => 'Error', 'message'=>$message ]);
        }
    }

    /**
     * Deletes an existing Profile model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $data =  $this->findModel($id);
        if($data->user_id == Yii::$app->user->getId()){
        $data->delete();

        return $this->redirect(['index']);
        }
        else{
             $message = ACCESSDENIED;
                 return $this->render('/site/error', [
                        'name' => 'Error', 'message'=>$message ]);
        }
    }

    /**
     * Finds the Profile model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Profile the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Profile::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
