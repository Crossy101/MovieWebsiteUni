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



}