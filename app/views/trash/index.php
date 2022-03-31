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

                <?php if (count($data['notes']) > 0) : ?>
                    <?php foreach ($data['notes'] as $note) : ?>
                        <?php if ($note->user_id == $_SESSION['user_id']) : ?>
                            <div class="col-md-3">
                                <div class="card bg-gray-dark">
                                    <div class="card-header">
                                        <b>
                                            <?php echo $note->note_title; ?>
                                        </b>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" onclick="restoreNote('<?php echo URLROOT; ?>/trashes/restore/',<?php echo $note->note_id; ?>)"><i class="fas fa-solid fa-trash-arrow-up"></i></button>
                                            <button type="button" class="btn btn-tool" onclick="deleteNotePermanently('<?php echo URLROOT; ?>/trashes/delete/',<?php echo $note->note_id; ?>)"><i class="fas fa-times"></i></button>
                                        </div>
                                    </div>
                                    <a href="<?php echo URLROOT; ?>/trashes/show/<?php echo $note->note_id; ?>" class="note-body">
                                        <div class="card-body">
                                            <?php if (strlen($note->note_body) > 50) : ?>
                                                <?php echo substr($note->note_body, 0, 120) . '...'; ?>
                                            <?php else : ?>
                                                <?php echo $note->note_body; ?>
                                            <?php endif; ?>
                                        </div>
                                    </a>
                                    <div class="card-footer">
                                        <div class="float-right">
                                            <?php if (empty($note->edited_at)) : ?>
                                                <i>Created <?php echo $note->noteCreatedAt; ?></i>
                                            <?php else : ?>
                                                <i>Edited <?php echo $note->edited_at; ?></i>
                                            <?php endif; ?>
                                        </div>
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