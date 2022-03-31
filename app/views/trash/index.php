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
                                            <i class="fa-solid fa-trash-can-xmark"></i>
                                        </div>
                                    </div>

                                    <div class="card-body" data-toggle="modal" data-target="#modal-default">
                                        <?php if (strlen($note->note_body) > 50) : ?>
                                            <?php echo substr($note->note_body, 0, 120) . '...'; ?>
                                        <?php else : ?>
                                            <?php echo $note->note_body; ?>
                                        <?php endif; ?>
                                    </div>

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

                        <!-- modal -->
                        <div class="modal fade" id="modal-default">
                            <div class="modal-dialog">
                                <div class="modal-content bg-gray-dark">
                                    <div class="modal-header">
                                        <h4 class="modal-title"><?php echo $note->note_title; ?></h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p><?php echo $note->note_body; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end moodal -->
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