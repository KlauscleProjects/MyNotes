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
            <?php flash('the_message'); ?>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">

                <?php if (count($data['notes']) > 0) : ?>
                    <?php foreach ($data['notes'] as $note) : ?>
                        <?php if ($note->user_id == $_SESSION['user_id']) : ?>
                            <div class="col-md-3">
                                <div class="card bg-gradient-secondary">
                                    <div class="card-header">
                                        <b>
                                            <?php echo $note->note_title; ?>
                                        </b>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" onclick="restoreNote('<?php echo URLROOT; ?>/archives/restore/',<?php echo $note->note_id; ?>)"><i class="fas fa-solid fa-file-arrow-up"></i></button>

                                            <button type="button" class="btn btn-tool" onclick="delete_note('<?php echo URLROOT; ?>/archives/delete/',<?php echo $note->note_id; ?>)"><i class="fas fa-times"></i></button>
                                        </div>
                                    </div>
                                    <a href="<?php echo URLROOT; ?>/archives/edit/<?php echo $note->note_id; ?>" class="note-body">
                                        <div class="card-body" style="color: black">
                                            <?php if (strlen($note->note_body) > 50) : ?>
                                                <?php echo substr($note->note_body, 0, 120) . '...'; ?>
                                            <?php else : ?>
                                                <?php echo $note->note_body; ?>
                                            <?php endif; ?>
                                        </div>
                                    </a>
                                    <div class="card-footer">
                                        <?php foreach ($data['tags'] as $tag) : ?>
                                            <?php if ($tag->tag_id == $note->tag_id) : ?>
                                                <span class="badge badge-info"><?php echo $tag->tag_title; ?></span>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php else : ?>
                    <div class="card card-body mb-3">
                        <div class="bg-light p-2 mb-3">
                            <h3 class='center'>No notes</h3>
                        </div>
                    </div>
                <?php endif; ?>

            </div>
    </section>

</div>

<?php require APPROOT . '/views/includes/dashboard_footer.php'; ?>
<?php require APPROOT . '/views/includes/footer.php'; ?>