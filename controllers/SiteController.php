<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Pais;
use app\models\PostFiles;
use app\models\Posts;
use app\models\UploadForm;
use app\models\Users;
use yii\web\UploadedFile;
use yii\data\Pagination;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
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
     * @return string
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['site/login']);
        }

        try {
            $modelUploadForm = new UploadForm();
            $modelPost = new Posts();

            if (Yii::$app->request->isPost) {
                $modelPost->load(Yii::$app->request->post());
                $modelUploadForm->imageFile = UploadedFile::getInstance($modelUploadForm, 'imageFile');

                // Validação e salvamento do arquivo
                if ($modelUploadForm->upload()) {
                    $modelPost->publication_date = date('Y-m-d H:i:s');
                    $modelPost->user_id = Yii::$app->user->identity->id;

                    if ($modelPost->validate() && $modelPost->save()) {
                        // Salvamento do arquivo relacionado
                        $postFile = new PostFiles();
                        $postFile->post_id = $modelPost->id;
                        $postFile->filename = $modelUploadForm->imageFile->baseName . '.' . $modelUploadForm->imageFile->extension;
                        $postFile->extensao = $modelUploadForm->imageFile->extension;
                        $postFile->publication_date = date('Y-m-d H:i:s');

                        if ($postFile->save()) {
                            Yii::$app->session->setFlash('success', 'Publicação e arquivo criados com sucesso.');
                        } else {
                            Yii::$app->session->setFlash('error', 'Erro ao salvar informações do arquivo.');
                        }

                        return $this->redirect(['site/index']);
                    }
                }
            }

            return $this->render('index', [
                'modelUploadForm' => $modelUploadForm,
                'modelPost' => $modelPost
            ]);
        } catch (\Throwable $e) {
            echo "Erro" . $e->getMessage();
            return false;
        }
    }


    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionRegister()
    {
        $model = new Users();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['site/login']);
        }

        return $this->render('register', [
            'model' => $model
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['site/login']);
        }

        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['site/login']);
        }

        return $this->render('about');
    }
}
