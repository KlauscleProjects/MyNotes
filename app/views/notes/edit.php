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
                            <h3 class="card-title">Edit your note</h3>
                        </div>
                        <form action="<?php echo URLROOT; ?>/notes/edit/<?php echo $data['note_id']; ?>" method="post">
                            <div class="card-body">
                                <div class="form-group">
                                    <input type="text" name="note_title" class="form-control" placeholder="Note Title" value="<?php echo $data['note_title']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <textarea id="compose-textarea" name="note_body" class="form-control" style="height: 300px"><?php echo $data['note_body']; ?></textarea>
                                </div>
                                <div class="form-group">
                                    <?php if (count($data['tagsByUser']) > 0) : ?>
                                        <select class="custom-select" name="tag_id">
                                            <option value="0">-</option>
                                            <?php foreach ($data['tags'] as $tag) : ?>
                                                <?php if ($tag->user_id == $_SESSION['user_id']) : ?>
                                                    <?php if ($data['tag_id'] == $tag->tag_id) : ?>
                                                        <option value="<?php echo $tag->tag_id ?>" selected><?php echo $tag->tag_title ?></option>
                                                    <?php else : ?>
                                                        <option value="<?php echo $tag->tag_id ?>"><?php echo $tag->tag_title ?></option>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </select>
                                    <?php else : ?>
                                        <input type="text" class="form-control" placeholder="No tags list" readonly>
                                    <?php endif; ?>
                                </div>
                                <div class="float-right">
                                    <?php if (empty($data['edited_at'])) : ?>
                                        <i>Created <?php echo $data['created_at']; ?></i>
                                    <?php else : ?>
                                        <i>Edited <?php echo $data['edited_at']; ?></i>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="float-right">
                                    <button type="submit" class="btn btn-primary"><i class="far fa-save"></i> Save</button>
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