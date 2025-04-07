<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>login-signup</title>
    <link rel="stylesheet" href="<?= $_ENV["BASE_URL"]."assets/css/auth.css"  ?>">
</head>

<body>

    <div id="background">
        <div id="panel-box">
            <div class="panel">
                <div class="auth-form on" id="login">
                    <div id="form-title">Log In</div>
                    <form action="<?= site_uri("auth.php?action=login") ?>" method="POST">
                        <input name="username" type="text" required="required" placeholder="username" />
                        <input name="password" type="password" required="required" placeholder="password" />
                        <button type="submit">Log In</button>
                    </form>
                </div>
                <div class="auth-form" id="signup">
                    <div id="form-title">Register</div>
                    <form action="<?= site_uri("auth.php?action=register") ?>" method="POST">
                        <input name="username" type="text" required="required" placeholder="username" />
                        <input name="password" type="password" required="required" placeholder="password" />
                        <input name="email" type="email" required="required" placeholder="email" />
                        <button type="Submit">Sign Up</button>
                    </form>
                </div>
            </div>
            <div class="panel">
                <div id="switch">Sign Up</div>
                <div id="image-overlay"></div>
                <div id="image-side"></div>
            </div>
        </div>
    </div>

    <script src='https://code.jquery.com/jquery-3.3.1.min.js'></script>
    <script src="<?= $_ENV["BASE_URL"]."assets/scripts/script.js"  ?>"></script>

</body>

</html>
