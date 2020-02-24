<head>
    <link rel="stylesheet" href="<?php ROOT_URL; ?>/assets/css/bootstrap.css">
    <link rel="stylesheet" href="<?php ROOT_URL; ?>/assets/css/LoginRegisterStyle.css">
</head>

<form class="form-signin" method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
    <h1 class="h3 mb-3 font-weight-normal">Register Form</h1>

    <label for="inputUsername" class="sr-only">Username</label>
    <input type="text" name="username" id="inputUsername" class="form-control" placeholder="Username" required>

    <label for="inputEmail" class="sr-only">Email address</label>
    <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>

    <label for="inputPassword" class="sr-only">Password</label>
    <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>


    <button class="btn btn-lg btn-primary btn-block" name="submit" type="submit" value="Submit">Register</button>
    <p class="mt-5 mb-3 text-muted">&copy; 2020</p>
</form>
