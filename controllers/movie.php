<?php
class movie extends Controller{
    protected function Index()
    {
        $viewModel = new MovieModel();
        $this->ReturnView($viewModel->Index(), true);
    }

    protected function GetMovie()
    {
        $id = $_GET['id'];
        if(is_null($id))
            header('Location: '.ROOT_URL);

        $viewModel = new MovieModel();
        $this->ReturnView($viewModel->GetMovie($id), true);
    }

    protected function AddMovie()
    {
        $viewModel = new MovieModel();
        $this->ReturnView($viewModel->AddMovie(), true);
    }

    protected function AddGenre()
    {
        $viewModel = new MovieModel();
        $this->ReturnView($viewModel->AddGenre(), true);
    }

    protected function EditMovie()
    {
        $id = $_GET['id'];
        $viewModel = new MovieModel();
        $this->ReturnView($viewModel->EditMovie($id), true);
    }

}