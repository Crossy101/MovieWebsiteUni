<?php
class movie extends Controller{
    protected function Index()
    {
        $viewModel = new ShareModel();
        $this->ReturnView($viewModel->Index(), true);
    }
}