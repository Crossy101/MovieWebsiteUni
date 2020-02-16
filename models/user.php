<?php
class UserModel extends Model {
    public function login()
    {
        return;
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
