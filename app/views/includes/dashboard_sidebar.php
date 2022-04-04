<body class="hold-transition sidebar-mini layout-fixed">

    <div class="wrapper">

        <nav class="main-header navbar navbar-expand-md navbar-light navbar-dark">

            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <ul class="navbar-nav ml-auto">
            </ul>
        </nav>

        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="#" class="brand-link">
                <img src="<?php echo URLROOT; ?>/assets/img/notes_logo.png" alt="MyNotes" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">MyNotes</span>
            </a>

            <div class="sidebar">
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="<?php echo URLROOT; ?>/assets/img/male-avatar05.png" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="<?php echo URLROOT; ?>/users/account/<?php echo $_SESSION['user_id']; ?>" class="d-block"><?php echo $_SESSION['user_fname']; ?></a>
                    </div>
                </div>

                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item">
                            <a href="<?php echo URLROOT; ?>/notes/index" class="nav-link">
                                <i class="nav-icon fas fa-sticky-note"></i>
                                <p> Notes </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo URLROOT; ?>/notes/add" class="nav-link">
                                <i class="nav-icon fas fa-regular fa-square-plus"></i>
                                <p> Add Note </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo URLROOT; ?>/archives/index" class="nav-link">
                                <i class="nav-icon fas fa-archive"></i>
                                <p> Archive </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo URLROOT; ?>/tags/index" class="nav-link">
                                <i class="nav-icon fas fa-solid fa-tag"></i>
                                <p> Tags </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo URLROOT; ?>/trashes/index" class="nav-link">
                                <i class="nav-icon fas fa-solid fa-trash"></i>
                                <p> Trash </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo URLROOT; ?>/users/logout" class="nav-link">
                                <i class="nav-icon fas fa-solid fa-right-from-bracket"></i>
                                <p> Sign Out </p>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside> <!-- end of aside -->