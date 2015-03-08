<?php

class HomeController extends Controller
{

    public function index()
    {

        $session = new Session();
        $connected = $session->isConnected();

        if ($connected) {
            $wars = new Wars;
            $wars = $wars->getAll();

            $app = $this->app;
            $this->app->render('layout/header.php');
            $this->app->render('home.php', compact('app', 'wars'));
            $this->app->render('layout/footer.php');
        } else {
            $this->app->render('login.php');
        }
    }

    public function login()
    {
        if (isset($_POST['username']) && isset($_POST['password'])) {
            $user = new User();
            $test = $user->getUser($_POST['username'], $_POST['password']);
            if ($test) {
                $session = new Session();
                $session->connection();
                $this->app->response->redirect($this->app->urlFor('home'));
            } else {
                $this->app->flash('error', 'Les identifiants sont érronés');
                $this->app->response->redirect($this->app->urlFor('home'));
            }
        } else {

        }
    }

    public function logout()
    {
        $session = new Session();
        $session->destroy('user');
        $this->app->response->redirect($this->app->urlFor('home'));
    }
}