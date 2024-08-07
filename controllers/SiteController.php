<?php

namespace app\controllers;

use app\repositories\UserRepository;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\PostFiles;
use app\models\Posts;
use app\models\PostSearch;
use app\models\SupportMessages;
use app\models\UploadForm;
use app\models\Users;
use yii\web\UploadedFile;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;

class SiteController extends Controller
{

    private $userRepository;
    protected $isAdmin;

    public function __construct($id, $module, UserRepository $userRepository, $config = [])
    {
        $this->userRepository = $userRepository;
        // Armazena globalmente se usuário logado é admin.
        Yii::$app->params['isAdmin'] = $this->userRepository->isAdmin(Yii::$app->user->id);
        // Seta no atributo o resultado do método isAdmin.
        $this->isAdmin = Yii::$app->params['isAdmin'];

        parent::__construct($id, $module, $config);
    }

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

            $posts = Posts::find()->with('postFiles')->all();

            $searchModel = new PostSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('index', [
                'modelUploadForm' => $modelUploadForm,
                'modelPost' => $modelPost,
                'posts' => $posts,
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        } catch (\Throwable $e) {
            echo "Erro" . $e->getMessage();
            return false;
        }
    }

    public function actionDelete($id, $filename)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['site/login']);
        }

        $posts = Posts::findOne($id); // Carrega o post pelo ID
        $postFiles = PostFiles::findOne($id);

        if (!$posts) {
            throw new NotFoundHttpException('O post não foi encontrado.');
        }

        if (!$postFiles) {
            throw new NotFoundHttpException('O arquivo não foi encontrado.');
        }

        // Verifica se o usuário tem permissão para excluir o post
        // Permiti apenas que o autor do post o exclua
        if ($posts->user_id !== Yii::$app->user->id) {
            throw new ForbiddenHttpException('Você não tem permissão para excluir este post.');
        }

        if ($posts->id !== $postFiles->post_id) {
            throw new ForbiddenHttpException('Arquivo não está vinculado ao post.');
        }

        // Apaga o post no banco de dados
        $posts->delete();

        // Apaga os dados do arquivo no banco de dados
        $postFiles->delete();

        // Apaga o arquivo
        UploadForm::delete($filename);

        Yii::$app->session->setFlash('success', 'O post foi excluído com sucesso.');

        return $this->redirect(['site/index']);
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
     * Displays Painel Administrativo page.
     *
     * @return Response|string
     */
    public function actionPainelAdministrativo()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['site/login']);
        }


        if (!($this->isAdmin)) {
            Yii::$app->session->setFlash('error', 'Você não tem permissão para acessar esta página.');
            Yii::debug('Usuário não é administrador. Redirecionando para a página inicial.');
            return $this->redirect(['site/index']);
        }

        $messages = SupportMessages::find()->all();
        $userIds = array_map(fn($message) => $message->user_id, $messages);

        return $this->render('painel-administrativo', [
            'messages' => $messages,
            'users' => $this->userRepository->getUsersByIds($userIds)
        ]);
    }


    /**
     * Displays suporte page.
     *
     * @return string
     */
    public function actionSuporte()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['site/login']);
        }

        $modelSuporte = new SupportMessages();

        if ($modelSuporte->load(Yii::$app->request->post())) {
            $modelSuporte->user_id = Yii::$app->user->id;
            if ($modelSuporte->save()) {
                Yii::$app->session->setFlash('success', 'Mensagem enviada com sucesso.');
                return $this->redirect(['suporte']);
            }
        }

        $messages = SupportMessages::find()->all();
        $userIds = array_map(fn($message) => $message->user_id, $messages);

        return $this->render('suporte', [
            'modelSuporte' => $modelSuporte,
            'messages' => $messages,
            'users' => $this->userRepository->getUsersByIds($userIds)
        ]);
    }

    // Ação para atualizar o status
    public function actionUpdateStatus($id)
    {
        $modelSuporte = $this->findModel($id);

        if ($modelSuporte->load(Yii::$app->request->post()) && $modelSuporte->save()) {
            Yii::$app->session->setFlash('success', 'Status atualizado com sucesso.');
            return $this->redirect(['painel-administrativo']);
        }

        return $this->render('update-status', [
            'modelSuporte' => $modelSuporte,
        ]);
    }

    // Método para encontrar o modelo pelo ID
    protected function findModel($id)
    {
        if (($modelSuporte = SupportMessages::findOne($id)) !== null) {
            return $modelSuporte;
        }

        throw new NotFoundHttpException('A página solicitada não existe.');
    }
}