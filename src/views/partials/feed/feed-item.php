<?php foreach ($feed as $feedItem): ?>
    <div class="box feed-item" data-id="<?= $feedItem->getId() ?>">
        <div class="box-body">
            <div class="feed-item-head row mt-20 m-width-20">
                <div class="feed-item-head-photo">
                    <a href="<?= "$base/profile/{$feedItem->user->getId()}" ?>"><img src="<?= $base ?>/media/avatars/<?= $feedItem->user->getAvatar() ?>" /></a>
                </div>
                <div class="feed-item-head-info">
                    <a href="<?= "$base/profile/{$feedItem->user->getId()}" ?>"><span class="fidi-name"><?= $feedItem->user->getName() ?></span></a>
                    <span class="fidi-action">

                        <?php
                            switch ($feedItem->getType()) {
                                case 'text':
                                    echo 'fez um post';
                                    break;
                                case 'picture':
                                    echo 'publicou uma foto';
                                    break;
                            }
                        ?>

                    </span>
                    <br/>
                    <span class="fidi-date"><?= (new \DateTime($feedItem->getCreatedAt()))->format('d/m/Y H:i:s') ?></span>
                </div>
                <div class="feed-item-head-btn">
                    <img src="<?= $base ?>/assets/images/more.png" />
                </div>
            </div>
            <div class="feed-item-body mt-10 m-width-20">

               <?= nl2br($feedItem->getBody()) ?>
               
            </div>
            <div class="feed-item-buttons row mt-20 m-width-20">
                <div class="like-btn <?= ($feedItem->liked)? 'on' : '' ?>"><?= $feedItem->likesCount ?></div>
                <div class="msg-btn"><?= count($feedItem->comments) ?></div>
            </div>
            <div class="feed-item-comments">
                
                <?php if (count($feedItem->comments) > 0): ?>
                    <?php foreach ($feedItem->comments as $comment): ?>
                        <div class="fic-item row m-height-10 m-width-20">
                            <div class="fic-item-photo">
                                <a href="<?= "$base/profile/{$comment->user->getId()}" ?>"><img src="<?= $base ?>/media/avatars/<?= $comment->user->getAvatar() ?>" /></a>
                            </div>
                            <div class="fic-item-info">
                                <a href="<?= "$base/profile/{$comment->user->getId()}" ?>"><?= $comment->user->getName() ?></a>
                                <?= nl2br($comment->getBody()) ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>

                <div class="feed-item-comments-area"></div>
                <div class="fic-answer row m-height-10 m-width-20">
                    <div class="fic-item-photo">
                        <a href="<?= "$base/profile/{$user->getId()}" ?>"><img src="<?= $base ?>/media/avatars/<?= $user->getAvatar() ?>" /></a>
                    </div>
                    <input type="text" class="fic-item-field" placeholder="Escreva um comentário" />
                </div>

            </div>
        </div>
    </div>
<?php endforeach; ?>