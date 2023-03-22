<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/hau.css">
    <link rel="stylesheet" type="text/css" href="public/css/search.css">
    <script src="https://kit.fontawesome.com/ad422f1a5c.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="./public/js/search.js" defer></script>
    <title>Search</title>
</head>
<body>
    <div class="search-container">
        <div class="navigation">
            <div class="item"><img src="public/img/hau.png" onclick="window.location.href='hau'"></div>
            <div class="search">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input name="name" type="text" placeholder="Search">
            </div>
        </div>
        <div class="navigation-mobile">
            <div class="item"><a href="hau"><i class="fa-solid fa-h"></i></a></div>
            <div class="search">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input name="name" type="text" placeholder="Search">
            </div>
        </div> 
        <section class="projects">
            <?php foreach ($arts as $a): ?>
            <div id="project-1">
                <img src="public/uploads/<?= $a->getImage() ?>">
                <div class="description">
                    <p><?= $a->getType() ?></p>
                    <p><?= $a->getName() ?></p>
                    <p><?= $a->getCity() ?></p>
                </div>
                <div class="star-wrapper">
                    <a href="#" class="fas fa-star s1"></a>
                    <a href="#" class="fas fa-star s2"></a>
                    <a href="#" class="fas fa-star s3"></a>
                    <a href="#" class="fas fa-star s4"></a>
                    <a href="#" class="fas fa-star s5"></a>
                </div>
            </div>
            <?php endforeach; ?>
            <!--
            <div id="project-6">
                <img src="public/img/angel.jpg">
                <div class="description">
                    <p>text</p>
                    <p>text</p>
                    <p>text</p>
                </div>
                <div class="star-wrapper">
                    <a href="#" class="fas fa-star s1"></a>
                    <a href="#" class="fas fa-star s2"></a>
                    <a href="#" class="fas fa-star s3"></a>
                    <a href="#" class="fas fa-star s4"></a>
                    <a href="#" class="fas fa-star s5"></a>
                </div>
            </div>
            -->
        </section> 
    </div> 
</body>

<template id="project-template">
    <div id="">
        <img src="">
        <div class="description">
            <p id="p1">type</p>
            <p id="p2">name</p>
            <p id="p3">city</p>
        </div>
        <div class="star-wrapper">
            <a href="#" class="fas fa-star s1"></a>
            <a href="#" class="fas fa-star s2"></a>
            <a href="#" class="fas fa-star s3"></a>
            <a href="#" class="fas fa-star s4"></a>
            <a href="#" class="fas fa-star s5"></a>
        </div>
    </div>
</template>
