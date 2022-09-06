<?php
$style = '<link href="'. GetUrl() .'assets/css/styles.css" rel="stylesheet">';
require_once 'header.php';
?>
<!-- Page Content-->
<div class="container-fluid p-0">
    <?php require_once 'navbar.php' ?>
    <!-- About-->
    <!-- Experience-->
    <section class="resume-section" id="experience">
        <div class="resume-section-content">
            <h2 class="mb-5">
                <?php 
                echo $class_name;
                if ($admin_login) {
                    echo '
                        <button class="btn btn-success" onclick="resetAll()">دوباره</button>
                    ';
                }
                if ($user_login) {
                    echo '
                        <button class="btn btn-success" onclick="done()">انجام دادم</button>
                    ';
                }
                ?>
            </h2>
            <?php
            if ($show_user_login) {
                echo '
                <div class="user-login-form row">
                    <form action="./users/register" method="post" class="col-md-4">
                        <input type="hidden" class="form-control" name="class_code" required value="'. $class_code .'">
                        <div class="form-group mt-3">
                            <label class="form-control-placeholder" for="first_name">نام</label>
                            <input type="text" class="form-control" name="first_name" required>
                        </div>
                        <div class="form-group mt-3">
                            <label class="form-control-placeholder" for="last_name">نام خانوادگی</label>
                            <input type="text" class="form-control" name="last_name" required>
                        </div>
                        <div class="form-group mt-3">
                            <label class="form-control-placeholder" for="system_number">شماره سیستم</label>
                            <input type="text" class="form-control" name="system_number" required>
                        </div>
                        <div class="form-group mt-4">
                            <button type="submit" class="form-control btn btn-primary rounded submit px-3">ورود</button>
                        </div>
                    </form>
                </div>
                ';
            }
            ?>
            <div id="users-data" class="row"></div>
        </div>
    </section>
</div>
<script>
    
    <?php
    if ($admin_login || $user_login) {
        echo '
        function getUsers() {
            $.ajax({
                url: "'. GetUrl() .'users/list/'. $class_id .'",
                success: function(data) {
                    if (data != "") {
                        if ($("#users-data").html() == "") {
                            $.parseJSON(data).forEach(element => {
                                checkAlert(element.im_done);
                                $("#users-data").append(
                                    \'<div class="col-md-4 mb-3" id="element-\'+ element.hash_id +\'">\' +
                                    \'    <div class="card card-body \'+ (element.im_done == 1 ? \'text-bg-success\' : \'\') +\'" id="card">\' +
                                    \'        <h3 class="card-title \'+ (element.im_done == 1 ? \'text-white\' : \'\') +\'" id="title">\'+ element.first_name + \' \' + element.last_name +\'</h2>\' +
                                    \'        <p>شماره سیستم: \'+ element.system_number +\'</p>\' +
                                    \'        <p id="done-time">ساعت انجام: \'+ (element.im_done == 1 ? element.updated_at.split(" ")[1] : \'انجام نشده\') +\'</p>\' +
                                    \'    </div>\' +
                                    \'</div>\'
                                )
                            });
                        }
                        else {
                            $.parseJSON(data).forEach(element => {
                                checkAlert(element.im_done);
                                if (element.im_done == 1) {
                                    $(\'#element-\'+ element.hash_id +\' #card\').addClass("text-bg-success");
                                    $(\'#element-\'+ element.hash_id +\' #title\').addClass("text-white");
                                    $(\'#element-\'+ element.hash_id +\' #done-time\').html(\'ساعت انجام: \'+ element.updated_at.split(" ")[1]);
                                }
                                else {
                                    $(\'#element-\'+ element.hash_id +\' #card\').removeClass("text-bg-success");
                                    $(\'#element-\'+ element.hash_id +\' #title\').removeClass("text-white");
                                    $(\'#element-\'+ element.hash_id +\' #done-time\').html("ساعت انجام: انجام نشده ");
                                }
                            });
                        }
                    }
                }

            });
        }
        getUsers();
        setInterval(getUsers, 1000);
        ';
    }
    if ($admin_login) {
        echo'
        function checkAlert(imdone) {
            if (imdone == 1) {
                const alert = localStorage.getItem("alert");
                if (!alert) {
                    var audio = new Audio("assets/sound/alert.mp3");
                    audio.play();
                    localStorage.setItem("alert", true);
                }
            }
        }
        function resetAll() {
            localStorage.removeItem("alert");
            $.ajax({
                type: "POST",
                url: "'. GetUrl() .'users/undone",
                data: {
                    code: '. $class_code .'
                },
                success: function(data) {
                    console.log(data);
                    getUsers();
                }
    
            });
        }';
    }
    if ($user_login) {
        echo'
        function checkAlert(imdone) {
            // hi
        }
        function done() {
            $.ajax({
                type: "POST",
                url: "'. GetUrl() .'users/done/'. $class_code .'",
                success: function(data) {
                    console.log(data);
                    getUsers();
                }
    
            });
        }';
    }
    ?>
</script>
<?php
require_once 'footer.php';
?>