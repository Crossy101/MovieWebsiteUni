<?php
class Users extends Controller{
    protected function Index()
    {
        $viewModel = new UserModel();
        $this->ReturnView($viewModel->Index(), true);
    }
}