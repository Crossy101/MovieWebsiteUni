<?php
class User extends Controller{
    protected function Index()
    {
        $viewModel = new UserModel();
        $this->ReturnView($viewModel->Index(), true);
    }

    protected function Login()
    {
        $viewModel = new UserModel();
        $this->ReturnView($viewModel->Login(), true);
        return;
    }

    protected function Register()
    {
        return;
    }

}