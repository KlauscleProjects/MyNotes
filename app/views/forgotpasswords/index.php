<?php require APPROOT . '/views/includes/header.php'; ?>
<?php require APPROOT . '/views/includes/navbar.php'; ?>
<div class="container">
    <div class="card card-outline card-primary m-4">
        <div class="card-header text-center">
            <p class="h1"><?php echo $data['page_title']; ?></p>
        </div>
        <div class="card-primary">
            <div class="card-body">
                <?php flash('the_message'); ?>
                <p>Send reset code to your email.</p>
                <form action="<?php echo URLROOT; ?>/forgotpasswords/index" method="post">
                    <div class="form-group">
                        <label for="email">Email: <sup>*</sup></label>
                        <input type="email" name="email" id="" class="form-control form-control-lg <?php echo (!empty($data['error_email'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['email']; ?>">
                        <span class="invalid-feedback"> <?php echo $data['error_email']; ?></span>
                    </div>
                    <div class="row">
                        <div class="col">
                            <input type="submit" value="Send reset code" class="btn btn-primary btn-block">
                        </div>
                    </div>
                </form>
            </div>
        </div> <!-- /.card primary-->
    </div>
</div>

<?php require APPROOT . '/views/includes/footer.php'; ?>