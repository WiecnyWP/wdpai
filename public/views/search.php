<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/hau.css">
    <link rel="stylesheet" type="text/css" href="public/css/search.css">
    <script src="https://kit.fontawesome.com/ad422f1a5c.js" crossorigin="anonymous"></script>
    <title>Search</title>
</head>
<body>
    <div class="search-container">
        <div class="navigation">
            <div class="item"><img src="public/img/hau.png"></div>
            <div class="search">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input name="name" type="text">
            </div>
        </div>
        <div class="navigation-mobile">
            <div class="item"><a href="#"><i class="fa-solid fa-h"></i></a></div>
            <div class="search">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input name="name" type="text">
            </div>
        </div> 
        <section class="projects">
            <div id="project-1">
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
            <div id="project-2">
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
            <div id="project-3">
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
            <div id="project-4">
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
            <div id="project-5">
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
            <div id="project-6">
                <img src="public/uploads/<?= $art->getImage() ?>">
                <div class="description">
                    <p><?= $art->getType() ?></p>
                    <p><?= $art->getName() ?></p>
                    <p><?= $art->getCity() ?></p>
                </div>
                <div class="star-wrapper">
                    <a href="#" class="fas fa-star s1"></a>
                    <a href="#" class="fas fa-star s2"></a>
                    <a href="#" class="fas fa-star s3"></a>
                    <a href="#" class="fas fa-star s4"></a>
                    <a href="#" class="fas fa-star s5"></a>
                </div>
            </div>
        </section> 
    </div> 
</body>