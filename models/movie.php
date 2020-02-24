<?php
class MovieModel extends Model {
    //This function is for when the user searches for a movie or gets the default Index Movie Page
    public function Index($search_name = "", $search_genre = 0)
    {
        if(!isset($_SESSION['is_logged_in']))
            header('Location: '.ROOT_URL);

        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        if($post['submit'])
        {
            $search_name = $post['search_name'];
            $search_genre = $post['search_genre'];
        }

        $this->CreateQuery('SELECT * FROM genres');
        $allGenres = $this->ResultSet();

        if($search_name == "" && $search_genre == 0) {
            $this->CreateQuery('SELECT * FROM movies');
            $allMovies['allMovies'] = $this->ResultSet();

            $allMovies['allGenres'] = $allGenres;
            $this->LogMessage(LoggerCodes::Info, "User ".$_SESSION['user_data']['name']." has searched for every movie.");
            return $allMovies;
        }
        else
        {
            $this->CreateQuery('SELECT * FROM movies WHERE movie_name LIKE :searched_name');
            $this->bind(':searched_name', "%".$search_name."%");
            $searchedMovies = $this->ResultSet();

            $allMovies = array();
            $allMovies['allMovies'] = array();

            if($search_genre != 0)
            {
                    foreach ($searchedMovies as $curMovie)
                    {
                        if($curMovie['genre_id'] == $search_genre)
                        {
                            array_push($allMovies['allMovies'], $curMovie);
                        }
                    }
            }
            else
            {
                $allMovies['allMovies'] = $searchedMovies;
            }

            $this->LogMessage(LoggerCodes::Info, "User ".$_SESSION['user_data']['name']." has searched for the movie title: ".$post['search_name']. " and searched genreID ".$post['search_genre']);
            $allMovies['allGenres'] = $allGenres;
            return $allMovies;
        }
    }

    //This function is for when the gets a specific movie from the index movie page
    public function GetMovie($id)
    {
        if(!isset($_SESSION['is_logged_in']))
            header('Location: '.ROOT_URL);

        $this->CreateQuery("SELECT * FROM movies WHERE id = :movie_id");
        $this->bind(':movie_id', $id);
        $this->Execute();
        $movie =  $this->ResultSingle();

        $this->CreateQuery("SELECT * FROM genres WHERE id = :movie_genre");
        $this->bind(':movie_genre', $movie['genre_id']);
        $this->Execute();
        $movieGenre =  $this->ResultSingle();

        $movie['genre_id'] = $movieGenre['genre_name'];

        return $movie;
    }

    //This function is for when the Admin wants to add a movie
    public function AddMovie()
    {
        if(!isset($_SESSION['is_logged_in']))
            header('Location: '.ROOT_URL);

        if($_SESSION['user_data']['admin'] == false)
            header('Location: '.ROOT_URL);

        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        // Check if image file is a actual image or fake image
        if($post['submit'])
        {
            $target_dir = "assets/movieImages/";
            $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }

            if (file_exists($target_file)) {
                echo "Sorry, file already exists.";
                $uploadOk = 0;
            }

            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
                echo "Sorry, only JPG, JPEG and PNG files are allowed.";
                $uploadOk = 0;
            }

            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
            } else {
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                    echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            }

            $this->CreateQuery('SELECT * FROM genres WHERE genre_name = :post_genre');
            $this->bind(':post_genre', $post['movieGenre']);
            $this->Execute();
            $genreRow = $this->ResultSingle();

            $this->CreateQuery('INSERT INTO movies (movie_name, movie_description, genre_id, image_name) VALUES(:movie_name, :movie_description, :genre_id, :image_name)');
            $this->bind(':movie_name', $post['movieName']);
            $this->bind(':movie_description', $post['movieDescription']);
            $this->bind(':genre_id', $genreRow['id']);
            $this->bind(':image_name', $_FILES["fileToUpload"]["name"]);
            $this->Execute();

            if($this->lastInsertID())
            {
                $this->LogMessage(LoggerCodes::Info, "User ".$post['username']." created a genre named: ".$post['movieGenre']);
                header('Location: '.ROOT_URL."/movie");
            }
        }

        $this->CreateQuery('SELECT * FROM genres');
        $allGenres = $this->ResultSet();
        return $allGenres;
    }

    //This function is for when the Admin wants to edit the movie details
    public function EditMovie($id)
    {
        if(!isset($_SESSION['is_logged_in']))
            header('Location: '.ROOT_URL);

        if($_SESSION['user_data']['admin'] == false)
            header('Location: '.ROOT_URL);

        if(isset($_POST))
        {
            $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            if($post['submit'])
            {
                $movieID = $post['movieID'];
                $movieName = $post['movieName'];
                $movieDescription = $post['movieDescription'];
                $movieGenre = $post['movieGenre'];

                $this->CreateQuery('SELECT * FROM genres WHERE genre_name = :post_genre');
                $this->bind(':post_genre', $movieGenre);
                $this->Execute();
                $movieGenreID = $this->ResultSingle();

                $this->CreateQuery('SELECT * FROM movies WHERE id = :movie_id');
                $this->bind(':movie_id', $id);
                $this->Execute();
                $foundMovie = $this->ResultSingle();

                if(!is_null($foundMovie))
                {
                    $this->CreateQuery('UPDATE movies SET movie_name = :movie_name, movie_description = :movie_description, genre_id = :genre_id WHERE id = :movie_id;');
                    $this->bind(":movie_id", $movieID);
                    $this->bind(":movie_name", $movieName);
                    $this->bind(":movie_description", $movieDescription);
                    $this->bind(":genre_id", $movieGenreID['id']);
                    $this->Execute();
                    $this->LogMessage(LoggerCodes::Info, "User ".$_SESSION['user_data']['name']." edited the movie: ".$post['movieName']);
                }
                header('Location: '.ROOT_URL."/movie");
            }
        }

        $this->CreateQuery("SELECT * FROM movies WHERE id = :movie_id");
        $this->bind(':movie_id', $id);
        $this->Execute();
        $movie =  $this->ResultSingle();

        $this->CreateQuery("SELECT * FROM genres");
        $this->bind(':movie_genre', $movie['genre_id']);
        $this->Execute();
        $allMovieGenres =  $this->ResultSet();

        $movie['movieGenres'] = $allMovieGenres;

        return $movie;
    }

    //This function is for when the Admin wants to add a new Movie Genre
    public function AddGenre()
    {
        if(!isset($_SESSION['is_logged_in']))
            header('Location: '.ROOT_URL);

        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        if($post['submit'])
        {
            $this->CreateQuery('INSERT INTO genres (genre_name) VALUES(:genre)');
            $this->bind(':genre', $post['movieGenre']);
            $this->Execute();

            if($this->lastInsertID())
            {
                $this->LogMessage(LoggerCodes::Info, "User ".$post['username']." created a genre named: ".$post['movieGenre']);
                header('Location: '.ROOT_URL."/movie");
            }
        }
    }
}