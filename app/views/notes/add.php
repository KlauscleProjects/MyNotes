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
            <div class="row">

                <div class="col-md-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Compose New Note</h3>
                        </div>
                        <form action="<?php echo URLROOT; ?>/notes/add" method="post">
                            <div class="card-body">
                                <div class="form-group">
                                    <input type="text" name="note_title" class="form-control" placeholder="Note Title" required>
                                </div>
                                <div class="form-group">
                                    <textarea id="compose-textarea" name="note_body" class="form-control" style="height: 300px"> </textarea>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="float-right">
                                    <button type="reset" class="btn btn-secondary"><i class="fas fa-redo"></i> Reset</button>
                                    <button type="submit" class="btn btn-primary"><i class="far fa-save"></i> Save</in>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
    </section>

</div>

<?php require APPROOT . '/views/includes/dashboard_footer.php'; ?>
<?php require APPROOT . '/views/includes/footer.php'; ?>