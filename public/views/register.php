<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/register.css">
    <title>Register</title>
</head>
<body>
    <div class="container">
        <div class="login-container">
            <form id="register" action="registerAdd" method="POST" ENCTYPE="multipart/form-data">
                <?php if(isset($messages)) {
                    foreach ($messages as $message){
                        echo $message;
                    }
                }
                ?>
                <input name="name" type="text" placeholder="name">
                <input name="surname" type="text" placeholder="surname">
                <input name="username" type="text" placeholder="username">
                <input name="password" type="password" placeholder="password">
                <input name="confirmedPassword" type="password" placeholder="password">
                <button type="submit">Submit</button>
            </form>
        </div>
        <div class="logo">
            <img src="public/img/logo.svg">
        </div>
    </div>
</body>