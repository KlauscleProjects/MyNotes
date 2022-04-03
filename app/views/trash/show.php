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
                    <div class="card card-gray-dark card-outline">
                        <div class="card-body">
                            <div class="form-group">
                                <h3><?php echo $data['note_title']; ?></h3>
                            </div>
                            <div class="form-group">
                                <textarea id="compose-textarea" name="note_body" class="form-control" style="height: 300px" readonly><?php echo $data['note_body']; ?></textarea>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="float-left">
                                <?php foreach ($data['tags'] as $tag) : ?>
                                    <?php if ($tag->tag_id == $data['tag_id']) : ?>
                                        <h5><span class="badge badge-info"><?php echo $tag->tag_title; ?></span></h5>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                            <div class="float-right">
                                <?php if (empty($data['edited_at'])) : ?>
                                    <i>Created <?php echo $data['created_at']; ?></i>
                                <?php else : ?>
                                    <i>Edited <?php echo $data['edited_at']; ?></i>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
    </section>

</div>

<?php require APPROOT . '/views/includes/dashboard_footer.php'; ?>
<?php require APPROOT . '/views/includes/footer.php'; ?>