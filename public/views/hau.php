<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/hau.css">
    <link rel="stylesheet" type="text/css" href="public/css/add.css">
    <script src="https://kit.fontawesome.com/ad422f1a5c.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="./public/js/search.js" defer></script>
    <script type="text/javascript" src="./public/js/logout.js" defer></script>
    <title>Hau</title>
</head>
<body>
    <?php if(!isset($_COOKIE["id_user"])){ header("Location: login"); } ?>
    <div class="container">
        <div class="navigation">
            <div class="item"><img src="public/img/hau.png" onclick="window.location.href='hau'"></div>
            <div class="item"><a href="workofart">Work of art</a></div>
            <div class="item"><a href="search">Search</a></div>
            <div class="item"><a href="add">Add</a></div>
            <div class="item"><button id="logout">Logout</button></div>
        </div>
        <div class="navigation-mobile">
            <div class="item"><a href="hau"><i class="fa-solid fa-h"></i></a></div>
            <div class="item"><a href="workofart"><i class="fa-solid fa-paintbrush"></i></a></div>
            <div class="item"><a href="search"><i class="fa-solid fa-magnifying-glass"></i></a></div>
            <div class="item"><a href="add"><i class="fa-solid fa-plus"></i></a></div>
            <div class="item"><a id="logoutMobile"><i class="fa-sharp fa-solid fa-arrow-right-from-bracket"></i></a></div>
        </div>
        <div class="content">
            <div class="text">
                <p>History Around Us is a web application for lovers of history, it contains a collection of sculptures, paintings and antiques from various eras. Users from all over the world can rate visited facilities and share their impressions.</p>
            </div>
            <div class="logo">
                <img src="public/img/logo.svg">
            </div>
        </div>    
    </div>
</body>