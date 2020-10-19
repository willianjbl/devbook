<div class="box feed-new">
    <div class="box-body">
        <div class="feed-new-editor m-10 row">
            <div class="feed-new-avatar">
                <img src="<?= "$base/media/avatars/{$user->getAvatar()}" ?>" />
            </div>
            <div class="feed-new-input-placeholder">O que você está pensando, <?= $user->getName() ?>?</div>
            <div class="feed-new-input" contenteditable="true"></div>
            <div class="feed-new-picture">
                <img src="<?= "$base/assets/images/photo.png" ?>" />
                <input type="file" name="post-picture" id="post-picture" accept="image/png, image/jpeg, image/jpg, image/bmp">
            </div>
            <div class="feed-new-send">
                <img src="<?= "$base/assets/images/send.png" ?>" />
            </div>
            <form id="feed-new-form" method="POST" action="<?= "$base/post/new" ?>">
                <input type="hidden" name="body">
            </form>
        </div>
    </div>
</div>

<script src="<?= "$base/assets/js/view/feed/feed-post.js" ?>"></script>
