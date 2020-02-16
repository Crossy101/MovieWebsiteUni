<html lang="en">
    <head>
        <title>MovieInfo</title>

        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>

    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="<?php echo ROOT_URL; ?>">MovieInfo</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-item nav-link active" href="#">Home <span class="sr-only">(current)</span></a>
                </div>
            </div>
            <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
                <ul class="navbar-nav ml-auto">
                    <?php if(isset($_SESSION['is_logged_in'])) : ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php ROOT_URL?>">Welcome <?php echo $_SESSION['user_data']['name'] ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php ROOT_URL?>/user/logout">Logout</a>
                        </li>
                    <?php else : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php ROOT_URL?>/user/login">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php ROOT_URL?>/user/register">Register</a>
                    </li>
                    <?php endif; ?>
                </ul>
            </div>
        </nav>

        <div class="container-fluid">
                <?php
                    //Require the body of the view
                    require($view);
                ?>
        </div>

        <footer class="container">
            <p>&copy; MovieInfo 2020</p>
        </footer>

        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    </body>
</html>