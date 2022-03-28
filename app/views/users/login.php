<?php require APPROOT . '/views/includes/header.php'; ?>
<div class="container">
    <div class="card card-outline card-primary m-4">
        <div class="card-header text-center">
            <p class="h1">LOGIN</p>
        </div>
        <div class="card-primary">
            <div class="card-body">
                <p>Please fill in your credentials to login</p>
                <form action="<?php echo URLROOT; ?>/users/login" method="post">
                    <div class="form-group">
                        <label for="email">Email: <sup>*</sup></label>
                        <input type="email" name="email" id="" class="form-control form-control-lg <?php echo (!empty($data['error_email'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['email']; ?>">
                        <span class="invalid-feedback"> <?php echo $data['error_email']; ?></span>
                    </div>
                    <div class="form-group">
                        <label for="password">Password: <sup>*</sup></label>
                        <input type="password" name="password" id="" class="form-control form-control-lg <?php echo (!empty($data['error_password'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['password']; ?>">
                        <span class="invalid-feedback"> <?php echo $data['error_password']; ?></span>
                    </div>

                    <div class="row">
                        <div class="col">
                            <input type="submit" value="Login" class="btn btn-success btn-block">
                        </div>
                        <div class="col">
                            <a href="<?php echo URLROOT; ?>/users/register" class="btn btn-light btn-block">No account? Register</a>
                        </div>
                    </div>
                </form>
            </div>
        </div> <!-- /.card primary-->
    </div>
</div>

<?php require APPROOT . '/views/includes/footer.php'; ?>