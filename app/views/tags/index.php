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
        <div class="container-fluid">
            <div class="row d-flex justify-content-center">
                <div class="col-md-7">
                    <div class="card card-primary card-outline">
                        <form action="<?php echo URLROOT; ?>/tags/add" method="post">
                            <div class="card-body">
                                <div class="form-group">
                                    <div class="input-group input-group">
                                        <input type="text" name="tag_title" class="form-control" placeholder="Create a tag title" required>
                                        <span class="input-group-append">
                                            <button type="submit" class="btn btn-primary">Save</button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table id="myTable" class="table table-bordered table-stripe table-hover">
                            <thead class="text-center">
                                <th>Tag ID</th>
                                <th>Tag Title</th>
                                <th>Actions</th>
                            </thead>
                            <tbody>
                                <?php foreach ($data['tags'] as $tag) : ?>
                                    <?php if ($tag->user_id == $_SESSION['user_id']) : ?>
                                        <tr>
                                            <td><?php echo $tag->tag_id; ?></td>
                                            <td><?php echo $tag->tag_title; ?></td>
                                            <td class="text-center py-0 align-middle">
                                                <div class="btn-group btn-group-sm">
                                                    <a href="<?php echo URLROOT; ?>/tags/edit/<?php echo $tag->tag_id; ?>" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                                    <button type="button" class="btn btn-danger" onclick="deleteTag('<?php echo URLROOT; ?>/tags/delete/',<?php echo $tag->tag_id; ?>)"><i class="fas fa-trash"></i></button>


                                                </div>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
    </section>

</div>

<?php require APPROOT . '/views/includes/dashboard_footer.php'; ?>
<?php require APPROOT . '/views/includes/footer.php'; ?>