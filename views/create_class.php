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
            <h2 class="mb-5">افزودن کلاس</h2>
            <form action="../action/class/create" method="post" class="form-row">
                <div class="col-md-6">
                    <div class="form-group mb-4">
                        <label for="code">کد:</label>
                        <input type="text" class="form-control ltr" name="code" id="code" required>
                    </div>
                    <div class="form-group mb-4">
                        <label for="title">عنوان:</label>
                        <input type="text" class="form-control" name="title" id="title" required>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="active" id="status1" value="1" checked>
                        <label class="form-check-label" for="status1">
                            فعال
                        </label>
                    </div>
                    <div class="form-check mb-4">
                        <input class="form-check-input" type="radio" name="active" id="status2" value="0">
                        <label class="form-check-label" for="status2">
                            غیرفعال
                        </label>
                    </div>
                    <button class="btn btn-success" type="submit">ثبت</button>
                </div>
            </form>
        </div>
    </section>
</div>
<?php
require_once 'footer.php';
?>