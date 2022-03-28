<?php require APPROOT . '/views/includes/header.php'; ?>
<div class="row">
    <div class="col-md-6 mx-auto">
        <div class="card card-body bg-light mt-5">
            <h2>Create An Account</h2>
            <p>Please fill out this form to register with us</p>
            <form action="<?php echo URLROOT; ?>/users/register" method="post">
                <div class="form-group">
                    <label for="name">First Name: <sup>*</sup></label>
                    <input type="text" name="fname" id="" class="form-control form-control-lg <?php echo (!empty($data['error_fname'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['fname']; ?>">
                    <span class="invalid-feedback"><?php echo $data['error_fname']; ?></span>
                </div>
                <div class="form-group">
                    <label for="name">Last Name: <sup>*</sup></label>
                    <input type="text" name="lname" id="" class="form-control form-control-lg <?php echo (!empty($data['error_lname'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['lname']; ?>">
                    <span class="invalid-feedback"><?php echo $data['error_lname']; ?></span>
                </div>
                <div class="form-group">
                    <label for="email">Email: <sup>*</sup></label>
                    <input type="email" name="email" id="" class="form-control form-control-lg <?php echo (!empty($data['error_email'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['email']; ?>">
                    <span class="invalid-feedback"><?php echo $data['error_email']; ?></span>
                </div>
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
                        <input type="submit" value="Register" class="btn btn-success btn-block">
                    </div>
                    <div class="col">
                        <a href="<?php echo URLROOT; ?>/users/login" class="btn btn-light btn-block">Have an account? Login</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php require APPROOT . '/views/includes/footer.php'; ?>