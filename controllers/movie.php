<?php
class movie extends Controller{
    protected function Index()
    {
        $viewModel = new MovieModel();
        $this->ReturnView($viewModel->Index(), true);
    }
}