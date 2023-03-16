<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <title>Login</title>
</head>
<body>
    <div class="container">
        <div class="login-container">
            <form class="login" action="login" method="POST">
                <div class="messages">
                    <?php if(isset($messages)) {
                        foreach ($messages as $message){
                            echo $message;
                        }
                    }
                    ?>
                </div>
                <input name="username" type="text" placeholder="username">
                <input name="password" type="password" placeholder="password">
                <a href="#">not started? click here to register</a>
                <button type="submit">Login</button>
            </form>
        </div>
        <div class="logo">
            <img src="public/img/logo.svg">
        </div>
    </div>
</body>