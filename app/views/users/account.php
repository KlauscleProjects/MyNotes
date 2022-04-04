<?php require APPROOT . '/views/includes/header.php'; ?>
<?php require APPROOT . '/views/includes/dashboard_sidebar.php'; ?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?php echo $data['page_title']; ?></h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid col-md-6">
            <div class="card card-outline card-primary">
                <div class="card-primary">
                    <form action="<?php echo URLROOT; ?>/users/account/<?php echo $_SESSION['user_id']; ?>" method="post">
                        <div class="card-body">
                            <p>You can edit your information here.</p>
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
                            <div class="float-right">
                                <button type="submit" class="btn btn-primary"><i class="far fa-save"></i> Save</button>
                            </div>
                        </div>
                    </form>
                </div> <!-- /.card primary-->
            </div>
        </div>
    </section>

</div>

<?php require APPROOT . '/views/includes/dashboard_footer.php'; ?>
<?php require APPROOT . '/views/includes/footer.php'; ?>