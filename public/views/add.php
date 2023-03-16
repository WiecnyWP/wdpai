<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/hau.css">
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <script src="https://kit.fontawesome.com/ad422f1a5c.js" crossorigin="anonymous"></script>
    <title>Add</title>
</head>
<body>
    <div class="container-add">
        <div class="navigation">
            <div class="item"><img src="public/img/hau.png"></div>
            <div class="item"><a href="#">Work of art</a></div>
            <div class="item"><a href="#">Search</a></div>
            <div class="item"><a href="#">Add</a></div>
            <div class="item"><button>Logout</button></div>
        </div>
        <div class="navigation-mobile">
            <div class="item"><a href="#"><i class="fa-solid fa-h"></i></a></div>
            <div class="item"><a href="#"><i class="fa-solid fa-paintbrush"></i></a></div>
            <div class="item"><a href="#"><i class="fa-solid fa-magnifying-glass"></i></a></div>
            <div class="item"><a href="#"><i class="fa-solid fa-plus"></i></a></div>
            <div class="item"><a href="#"><i class="fa-sharp fa-solid fa-arrow-right-from-bracket"></i></a></div>
        </div>
        <div class="content">
            <div class="login-container">
                <form id="add" action="add" method="POST" ENCTYPE="multipart/form-data">
                    <?php if(isset($messages)) {
                        foreach ($messages as $message){
                            echo $message;
                        }
                    }
                    ?>
                    <input name="type" type="text" placeholder="type">
                    <input name="name" type="text" placeholder="name">
                    <input name="city" type="text" placeholder="city">
                    <input name="file" type="file" placeholder="image">
                    <button type="submit">Add</button>
                </form>
            </div>
            <div class="logo">
                <img src="public/img/logo.svg">
            </div> 
        </div>
    </div>
</body>