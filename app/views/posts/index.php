<?php require APPROOT . '/views/includes/header.php'; ?>
<?php flash('post_message'); ?>
<div class="row mb-3">
    <div class="col-md-6">
        <h1>Posts</h1>
    </div>
    <div class="col-md-6">
        <a href="<?php echo URLROOT; ?>/posts/add" class="btn btn-primary pull-right">
            <i class="fa fa-pencil"></i>Add Post
        </a>
    </div>
</div>
<?php if (count($data['posts']) > 0) : ?>
    <?php foreach ($data['posts'] as $post) : ?>
        <div class="card card-body mb-3">
            <h4 class="card-title">
                <?php echo $post->title; ?>
            </h4>
            <div class="bg-light p-2 mb-3">
                Written by <?php echo $post->name; ?> on <?php echo $post->postCreatedAt; ?>
            </div>
            <p class="card-text"><?php echo $post->body; ?></p>
            <a href="<?php echo URLROOT; ?>/posts/show/<?php echo $post->postId; ?>" class="btn btn-dark">More</a>
        </div>
    <?php endforeach; ?>
<?php else : ?>
    <div class="card card-body mb-3">
        <div class="bg-light p-2 mb-3">
            <h3 class='center'>No Posts</h3>
        </div>
    </div>
<?php endif; ?>
<?php require APPROOT . '/views/includes/footer.php'; ?>