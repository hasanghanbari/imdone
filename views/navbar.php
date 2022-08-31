<?php
echo '
<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top" id="sideNav">
    <a class="navbar-brand js-scroll-trigger" href="#page-top">
        <span class="d-block d-lg-none">انجام دادم</span>
        <span class="d-none d-lg-block"><img class="img-fluid img-profile rounded-circle mx-auto mb-2" src="'. GetUrl() .'assets/img/profile.jpg" alt="..." /></span>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav">
            <li class="nav-item"><a class="nav-link js-scroll-trigger" href="'. GetUrl() .'">خانه</a></li>';
            if (count(GetAdmin(false)) > 0) {
                echo '
                <li class="nav-item"><a class="nav-link js-scroll-trigger" href="'. GetUrl() .'class/create">ایجاد کلاس</a></li>
                <li class="nav-item"><a class="nav-link js-scroll-trigger" href="'. GetUrl() .'class/list">لیست کلاس ها</a></li>
                <li class="nav-item"><a class="nav-link js-scroll-trigger" href="'. GetUrl() .'logout">خروج</a></li>
                ';
            }
            else {
                echo'
                <li class="nav-item"><a class="nav-link js-scroll-trigger" href="'. GetUrl() .'login">ورود</a></li>
                ';
            }
            echo '
        </ul>
    </div>
</nav>

';
?>