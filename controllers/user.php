<?php
class user extends Controller{
    //This function is for when the user requests the login page
    protected function login()
    {
        $viewModel = new UserModel();
        $this->ReturnView($viewModel->login(), false);
        return;
    }

    //This function is for when the user requests the register page
    protected function register()
    {
        $viewModel = new UserModel();
        $this->ReturnView($viewModel->register(), false);
    }

    //This function is for when the user requests the logout page
    protected function logout()
    {
        $viewModel = new UserModel();
        $this->ReturnView($viewModel->logout(), false);
    }
}