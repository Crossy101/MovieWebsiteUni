<head>
    <link rel="stylesheet" href="<?php ROOT_URL; ?>/assets/css/bootstrap.css">
    <link rel="stylesheet" href="<?php ROOT_URL; ?>/assets/css/LoginRegisterStyle.css">
</head>

<form class="form-signin">
    <img class="mb-4" src="https://getbootstrap.com/docs/4.0/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
    <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
    <label for="inputUsername" class="sr-only">Username</label>
    <input type="text" name="username" id="inputUsername" class="form-control" placeholder="Username" required>
    <label for="inputPassword" class="sr-only">Password</label>
    <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
    <button class="btn btn-lg btn-primary btn-block" type="submit" value="Submit">Sign in</button>
    <p class="mt-5 mb-3 text-muted">&copy; 2020</p>
</form>
