<?php
class user extends Controller{
    protected function login()
    {
        $viewModel = new UserModel();
        $this->ReturnView($viewModel->login(), false);
        return;
    }

    protected function register()
    {
        $viewModel = new UserModel();
        $this->ReturnView($viewModel->register(), false);
    }

    protected function logout()
    {
        unset($_SESSION['is_logged_in']);
        unset($_SESSION['user_data']);
        session_destroy();
        header('Location: '.ROOT_URL);
    }




}