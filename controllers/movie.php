<?php
class movie extends Controller{
    //This function is for when the user requests the Movie Index Page
    protected function Index()
    {
        $viewModel = new MovieModel();
        $this->ReturnView($viewModel->Index(), true);
    }

    //This function is for when the user requests the GetMovie Page
    protected function GetMovie()
    {
        $id = $_GET['id'];
        if(is_null($id))
            header('Location: '.ROOT_URL);

        $viewModel = new MovieModel();
        $this->ReturnView($viewModel->GetMovie($id), true);
    }

    //This function is for when the user requests the AddMovie Page
    protected function AddMovie()
    {
        $viewModel = new MovieModel();
        $this->ReturnView($viewModel->AddMovie(), true);
    }

    //This function is for when the user requests the AddGenre Page
    protected function AddGenre()
    {
        $viewModel = new MovieModel();
        $this->ReturnView($viewModel->AddGenre(), true);
    }

    //This function is for when the user requests the EditMovie Page
    protected function EditMovie()
    {
        $id = $_GET['id'];
        $viewModel = new MovieModel();
        $this->ReturnView($viewModel->EditMovie($id), true);
    }

}