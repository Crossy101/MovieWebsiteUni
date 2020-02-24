<?php
class Home extends Controller{
    //This function is for when the user requests the Index Home page
    protected function Index()
    {
        $viewModel = new HomeModel();
        $this->ReturnView($viewModel->Index(), true);
    }
}