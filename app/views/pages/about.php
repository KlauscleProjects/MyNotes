<?php require APPROOT . '/views/includes/header.php'; ?>
<?php require APPROOT . '/views/includes/navbar.php'; ?>
<div class="container">

    <div class="jumbotron jumbotron-flud text-center m-5">
        <div class="container"></div>
        <h1 class="display-3"><?php echo SITENAME; ?></h1>
        <p class="lead"><?php echo $data['description']; ?></p>
        <p class="lead"><?php echo $_ENV['APP_VERSION'] ?></p>
        <p class="lead">Developed by: Axcle L. Viray<p>
    </div>

</div>
<?php require APPROOT . '/views/includes/footer.php'; ?>