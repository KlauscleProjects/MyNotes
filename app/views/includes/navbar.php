<body class="hold-transition layout-top-nav">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand-md navbar-light navbar-dark">
            <div class="container">
                <a href="<?php echo URLROOT; ?>/pages/index" class="navbar-brand">
                    <img src="<?php echo URLROOT; ?>/assets/img/notes_logo.png" alt="MyNotes" class="brand-image img-circle elevation-3" style="opacity: .8">
                    <span class="brand-text font-weight-light"><?php echo SITENAME; ?></span>
                </a>

                <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Right navbar links -->
                <div class="collapse navbar-collapse order-3" id="navbarCollapse">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a href="<?php echo URLROOT; ?>/users/register" class="nav-link">Register</a>
                        </li>
                        <?php if (isset($_SESSION['user_id'])) : ?>
                            <li class="nav-item">
                                <a href="<?php echo URLROOT; ?>/users/logout" class="nav-link">Logout</a>
                            </li>
                        <?php else : ?>
                            <li class="nav-item">
                                <a href="<?php echo URLROOT; ?>/users/login" class="nav-link">Login</a>
                            </li>
                        <?php endif; ?>

                    </ul>
                </div>
            </div>
        </nav> <!-- end of top nav -->