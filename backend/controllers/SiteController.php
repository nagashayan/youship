<?php
namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use common\models\LoginForm;
use yii\filters\VerbFilter;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index','view-complete-order','update-quote-log','profile'],
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
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {
        $orderfeed = \common\models\Orders::find()->where('status = 1')->orderBy('updatedon desc')->all();
        return $this->render('index',['orderfeed'=>$orderfeed]);
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
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

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
    
    public function actionViewCompleteOrder($id){
        echo $id;
        
        $order = \common\models\Orders::find()->where("id = $id")->one();
        $orderinfo = \common\models\OrderInfo::find()->where("order_id = $id")->one();
        
        //get all quote info from quote log table
        $quotelog = \common\models\Quotelog::find()->where("order_id = $id")->all();
        return $this->render('vieworder',['order'=>$order,'orderinfo'=>$orderinfo,
            'quotelog'=>$quotelog]);
        
    }
    
    /**
     * create new record in quote log to store all quotes
     * 
     */
    
    public function actionUpdateQuoteLog(){
        $model = new \common\models\Quotelog();
       // print_r($model->load(Yii::$app->request->post())); print_r($model); die();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view-complete-order', 'id' => $model->order_id]);
        } else {
            print_r($model->getErrors());
        }
    }
    
    public function actionProfile(){
        
        $model = new \common\models\User();
        $id = 
        $user = \common\models\User::find()->where("id = $id")->one();
        $profile = \common\models\Profile::find()->where("user_id = $user->id")->one();
        
        
        
    }
}
