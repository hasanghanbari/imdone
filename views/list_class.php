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
            <h2 class="mb-5">لیست کلاس ها</h2>
            <div class="table-responsive">
                <table class="table table-bordered">
                <?php echo $data_head; ?>
                <?php echo $data_body; ?>
                </table>
            </div>
        </div>
    </section>
</div>
<?php
require_once 'footer.php';
?>