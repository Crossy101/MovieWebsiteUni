<?php
class UserModel extends Model {
    public function login()
    {
        //Sanitize Post
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        if($post['submit'])
        {
            $this->CreateQuery('SELECT * FROM users WHERE username = :username');
            $this->bind(':username', $post['username']);
            $this->execute();

            $row = $this->ResultSingle();
            print_r($row);
            if($row)
            {
                if(password_verify($post['password'], $row['password']))
                {
                    $_SESSION['is_logged_in'] = true;
                    $_SESSION['user_data'] = array(
                        "id" => $row['id'],
                        'name' => $row['username']
                    );

                    //header('Location: '.ROOT_URL);
                }
                else
                {
                    echo "Incorrect Login!";
                }
            }  else {
                echo "Incorrect Login!";
            }

        }
    }

    public function register()
    {
        //Sanitize Post
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        if($post['submit'])
        {

            $this->CreateQuery('INSERT INTO users (username, email, password) VALUES(:username, :email, :password)');
            $this->bind(':username', $post['username']);
            $this->bind(':email', $post['email']);
            $this->bind(':password', password_hash($post['password'], PASSWORD_BCRYPT));
            $this->execute();

            echo $post['username'];
            echo $post['email'];
            echo $post['password'];

            if($this->lastInsertID())
            {
                header('Location: '.ROOT_URL."/");
            }
        }
    }

}
