<?php

namespace frontend\controllers;

use Yii;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\Orders;
use common\models\OrderInfo;
use yii\data\ActiveDataProvider;

/**
 * Site controller
 */
class SiteController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup','view-order','delete-order','update-order','place-order'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout','view-order','delete-order','update-order','place-order'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                    'delete' => ['post'],
                    'update-customer-quote'=>['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions() {
        return [
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
    public function actionIndex() {
        return $this->render('index');
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin() {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            $user = \common\models\User::find()->where("id = ".Yii::$app->user->getId())->one();
           
            if($user->operator)
                return $this->goBack(BACKENDURL);
            
            return $this->goHome();
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
    public function actionLogout() {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact() {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending email.');
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
    public function actionAbout() {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup() {
        $model = new SignupForm();
        
        if ($model->load(Yii::$app->request->post())) { 
            
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
                    'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset() {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
               
                 $model = new LoginForm();
                return $this->render('login', [
                    'model' => $model,'msg'=>'Check your email for further instructions.'
        ]);
            } else {
                 $model = new LoginForm();
                return $this->render('login', [
                    'model' => $model,'error'=>'Sorry, we are unable to reset password for email provided.'
                ]);
                
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
    public function actionResetPassword($token) {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            
             $model = new LoginForm();
                return $this->render('login', [
                    'model' => $model,'msg'=>'New password was saved.'
                ]);
           

            return $this->goHome();
        }

        return $this->render('resetPassword', [
                    'model' => $model,
        ]);
    }

    /**
     * 
     * creating new order by customer
     */
    public function actionPlaceOrder() {
        if (!Yii::$app->user->isGuest) {
            $ordermodel = new Orders();
            $orderinfomodel = new OrderInfo();
            //set required fields
            $ordermodel->status = 1;

            $ordermodel->userid = Yii::$app->user->id;
            if ($ordermodel->load(Yii::$app->request->post()) && $orderinfomodel->load(Yii::$app->request->post())) {
                $ordermodel->pickupcond = "on";
                $ordermodel->deliverycond = "on";
                $ordermodel->pickupdate1 = Yii::$app->request->post('pickupdate1');
                $ordermodel->deliverydate1 = Yii::$app->request->post('deliverydate1');

                if ($ordermodel->save()) {
                    $orderinfomodel->order_id = $ordermodel->id;
                    $orderinfomodel->save();
                    return $this->render('afterorder');
                }
                //print_r($ordermodel->getErrors());
                //print_r($orderinfomodel->getErrors());
            }
            return $this->render('orderform', [
                        'ordermodel' => $ordermodel, 'orderinfomodel' => $orderinfomodel
            ]);
        } else {
            return $this->render('error', [
                        'errormsg' => ACCESSDENIED
            ]);
        }
    }

    /**
     * 
     * update new order by customer
     */
    public function actionUpdateOrder($id) {
        if (!Yii::$app->user->isGuest) {
            $ordermodel = Orders::find()->where("id = $id")->one();
            if ($ordermodel != "" && $ordermodel->userid == Yii::$app->user->id){
            if (isset($ordermodel->id)) { 
                $orderinfomodel = OrderInfo::find()->where("order_id = $ordermodel->id")->one();

                if (isset($orderinfomodel->id)) {
                    
                    if ($ordermodel->load(Yii::$app->request->post()) && $orderinfomodel->load(Yii::$app->request->post())
                            && $ordermodel->save() && $orderinfomodel->save()) {
                            return $this->render('afterorder');
                    }
                    else{
                        //print_r($ordermodel->getErrors());
                        //print_r($orderinfomodel->getErrors());
                    }
                    return $this->render('orderform', [
                                'ordermodel' => $ordermodel, 'orderinfomodel' => $orderinfomodel
                    ]);
                }
            }
            }
        }
        return $this->render('error', [ 'name'=>'Error',
                    'message' => ACCESSDENIED
        ]);
    }

    /**
     * see all your orders
     */
    public function actionViewOrder($id = null) {
       $user = null;
        if ($id) {
           
            
            $model = Orders::find()->where("id = $id")->one();
            
            if (isset($model->id)) {
                $model1 = OrderInfo::find()->where("order_id = $model->id")->one();
            }
            
            if ($model == "" || $model->userid != Yii::$app->user->id){
                 $message = ACCESSDENIED;
                 return $this->render('error', [
                        'name' => 'Error', 'message'=>$message
            ]);
            }
               
          

            return $this->render('vieworder', [
                        'model' => $model, 'model1' => $model1,'user'=>$user
            ]);
        }
        else {
            //echo 'showing all' . Yii::$app->user->id;
            //get all orders by current user
            $model = Orders::find()->where("userid = " . Yii::$app->user->id)->orderBy('updatedon')->all();
            return $this->render('vieworders', [
                        'model' => $model
            ]);
        }
    }

    /**
     * for deleting the order
     */
    public function actionDeleteorder($id) {
        $error = null;
        $model = Orders::find()->where("id = $id")->one();
        if (isset($model->id)) {
            $model1 = OrderInfo::find()->where("order_id = $model->id")->one();
        }
        if ($model == "")
            $error = "Invalid Order Id!";
        else if ($model->userid != Yii::$app->user->id)
            $error = "Access is denied";
        else {
            //delete it 
            $model1->delete();
            $model->delete();
        }
        $this->goBack();
    }
    
    /**
     * update customer quote
     */
    public function actionUpdateCustomerQuote(){ 
    
        if(Yii::$app->request->post('id') != "" && Yii::$app->request->post('offerprice') != ""){
            $id = Yii::$app->request->post('id');
            $offer_price = Yii::$app->request->post('offerprice');
            $model = Orders::find()->where("id = $id")->one();
            if ($model != "" && $model->userid == Yii::$app->user->id){
               //check if customer price is less than all other quotes
               $quotes = \common\models\Quotelog::find()->where("order_id = $model->id")->orderBy("offer_price asc")->one();
               //echo $quotes->offer_price;die();
               if($offer_price >= $quotes->offer_price){
                   echo "enter again";
               }
               else{
               $quotemodel =  new \common\models\Quotelog();
               $quotemodel->order_id = $model->id;
               $quotemodel->offer_price = $offer_price;
               $quotemodel->quote_from = "customer";
               
               $quotemodel->save();
               //print_r($quotemodel->getErrors());
            }
            }
        }
    }
    
    /**
     * 
     * resets  order as new order
     */
    public function actionResetOrder($id) {
        if (!Yii::$app->user->isGuest) {
            
            $ordermodel = Orders::find()->where("id = $id")->one();
            if ($ordermodel != "" && $ordermodel->userid == Yii::$app->user->id){
            if (isset($ordermodel->id)) { 
                

                  $ordermodel->accepted_operator = null;
                  $ordermodel->status = STATUS_OPEN;
                  $ordermodel->save();
                  
                  //delete all quote logs
                  \common\models\Quotelog::deleteAll("order_id = $ordermodel->id");
                   $this->goBack();
                
            }
            }
        }
        return $this->render('error', [ 'name'=>'Error',
                    'message' => ACCESSDENIED
        ]);
    }
    
    
    /**
     * whether customer accepts  decision will be save here
     */
    public function actionCustomerDecision(){
        
        if(Yii::$app->request->post('order_id') != ""){
         
        $id = Yii::$app->request->post('order_id'); 
        
        $accept = true;
        $reject = false;
        if(Yii::$app->request->post('reject') != ""){
            $accept = false;
            $reject = true;
        }
        $order = \common\models\Orders::find()->where("id = $id")->one();
        //get all quote info from quote log table
        
        if($accept){ 
            //get quote details
            $quotelog = \common\models\Quotelog::find()->where("order_id = $id and quote_from = 'operator'")->orderBy("offer_price")->one();
            if(isset($quotelog->operator_id)){
                $order->status = STATUS_ACCEPT;
                $order->accepted_operator = $quotelog->operator_id;
                $order->accepted_by = "customer";
                $order->save();
               
            }

        }
        /*else{
            $order->status = STATUS_REJECT;
        }*/
        
        
        return $this->redirect('view-order');
        }
        
    }
    
 

}
