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
            <div class="sidebar">
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="../../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">Alexander Pierce</a>
                    </div>
                </div>

                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item">
                            <a href="../widgets.html" class="nav-link">
                                <i class="nav-icon fas fa-home"></i>
                                <p> Home </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo URLROOT; ?>/notes/index" class="nav-link">
                                <i class="nav-icon fas fa-sticky-note" style="color: #9c6c0c;"></i>
                                <p> Notes </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo URLROOT; ?>/notes/add" class="nav-link">
                                <i class="nav-icon fas fa-sticky-note" style="color: #9c6c0c;"></i>
                                <p> Add Note </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo URLROOT; ?>/archives/index" class="nav-link">
                                <i class="nav-icon fas fa-archive" style="color: #9c6c0c;"></i>
                                <p> Archive </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo URLROOT; ?>/tags/index" class="nav-link">
                                <i class="nav-icon fas fa-solid fa-tag" style="color: #9c6c0c;"></i>
                                <p> Tags </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo URLROOT; ?>/users/logout" class="nav-link">
                            <i class="nav-icon fas fa-solid fa-right-from-bracket" style="color: #9c6c0c;"></i>
                                <p> Sign Out </p>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1><?php echo $data['title']; ?></h1>
                        </div>
                    </div>
                </div>
            </section>

            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">

                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Title</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    Start creating your amazing application!
                                </div>


                            </div>

                        </div>
                    </div>
                </div>
            </section>

        </div>

        <footer class="main-footer">
            <div class="float-right d-none d-sm-inline">
                v3.1.0
            </div>
            <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
        </footer>

    </div>