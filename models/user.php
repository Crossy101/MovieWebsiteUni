<?php
class UserModel extends Model {
    //This function is for when the user tries to login to the website
    public function login()
    {
        //Sanitize Post
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        if($post['submit'])
        {
            $this->CreateQuery('SELECT * FROM users WHERE username = :username');
            $this->bind(':username', $post['username']);
            $this->Execute();

            $row = $this->ResultSingle();
            if($row)
            {
                if(password_verify($post['password'], $row['password']))
                {
                    $_SESSION['is_logged_in'] = true;
                    $_SESSION['user_data'] = array(
                        "id" => $row['id'],
                        'name' => $row['username'],
                        'admin' => $row['admin']
                    );

                    $this->LogMessage(LoggerCodes::Info, "User ".$_SESSION['user_data']['name']." logged in.");
                    header('Location: '.ROOT_URL."/movie");
                }
                else
                {
                    $this->LogMessage(LoggerCodes::Error, "User ".$post['username']." failed to login.");
                }
            }  else {
                $this->LogMessage(LoggerCodes::Error, "User ".$post['username']." failed to login.");
            }
        }
    }

    //This function is for when the user registers on the website
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
            $this->Execute();

            if($this->lastInsertID())
            {
                $this->LogMessage(LoggerCodes::Info, "User ".$post['username']." registered account.");
                header('Location: '.ROOT_URL."/");
            }
        }
    }

    //This function is for when the user logs out of the website
    public function logout()
    {
        $this->LogMessage(LoggerCodes::Info, "User ".$_SESSION['user_data']['name']." logged out.");
        unset($_SESSION['is_logged_in']);
        unset($_SESSION['user_data']);
        session_destroy();
        header('Location: '.ROOT_URL);
    }

}
