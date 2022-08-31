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
                        $("#users-data").html("");
                        $.parseJSON(data).forEach(element => {
                            $("#users-data").append(
                                \'<div class="col-md-4 mb-3">\' +
                                \'    <div class="card card-body \'+ (element.im_done == 1 ? \'text-bg-success\' : \'\') +\'">\' +
                                \'        <h3 class="card-title \'+ (element.im_done == 1 ? \'text-white\' : \'\') +\'">\'+ element.first_name + \' \' + element.last_name +\'</h2>\' +
                                \'        <p>شماره سیستم: \'+ element.system_number +\'</p>\' +
                                \'        <p>ساعت انجام: \'+ (element.im_done == 1 ? element.updated_at.split(" ")[1] : \'انجام نشده\') +\'</p>\' +
                                \'    </div>\' +
                                \'</div>\'
                            )
                        });
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
        function resetAll() {
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