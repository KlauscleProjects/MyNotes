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
                <p>Create your new password here.</p>
                <form action="<?php echo URLROOT; ?>/forgotpasswords/resetpassword/<?php echo $data['selector']; ?>/<?php echo $data['validator']; ?>" method="post">
                    <div class="form-group">
                        <label for="password">Password: <sup>*</sup></label>
                        <input type="password" name="password" id="" class="form-control form-control-lg <?php echo (!empty($data['error_password'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['password']; ?>">
                        <span class="invalid-feedback"><?php echo $data['error_password']; ?></span>
                    </div>
                    <div class="form-group">
                        <label for="confirm_password">Confirm Password: <sup>*</sup></label>
                        <input type="password" name="confirm_password" id="" class="form-control form-control-lg <?php echo (!empty($data['error_confirm_password'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['confirm_password']; ?>">
                        <span class="invalid-feedback"><?php echo $data['error_confirm_password']; ?></span>
                    </div>
                    <div class="row">
                        <div class="col">
                            <input type="submit" value="Confirm" class="btn btn-primary btn-block">
                        </div>
                    </div>
                </form>
            </div>
        </div> <!-- /.card primary-->
    </div>
</div>

<?php require APPROOT . '/views/includes/footer.php'; ?>