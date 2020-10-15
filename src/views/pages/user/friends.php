<?php $this->renderPartial('header', ['user' => $user]) ?>

<?php $this->renderPartial('flash', ['flash' => $flash]) ?>

<section class="container main">

    <?php $this->renderPartial('sidebar', ['activeMenu' => 'friends']) ?>

    <section class="feed">

        <?php
            $this->renderPartial('profile/profile-details', [
                'profile' => $profile,
                'user' => $user,
                'following' => $following
            ])
        ?>
        
        <div class="row">
            <div class="column">                
                <div class="box">
                    <div class="box-body">
                        <div class="tabs">
                            <div class="tab-item" data-for="followers">
                                Seguidores
                            </div>
                            <div class="tab-item active" data-for="following">
                                Seguindo
                            </div>
                        </div>
                        <div class="tab-content">
                            <div class="tab-body" data-item="followers">
                                <div class="full-friend-list">

                                    <?php foreach ($profile->followers as $follower): ?>
                                        <div class="friend-icon">
                                            <a href="<?= "$base/profile/{$follower->getId()}" ?>">
                                                <div class="friend-icon-avatar">
                                                    <img src="<?= "$base/media/avatars/{$follower->getAvatar()}" ?>" />
                                                </div>
                                                <div class="friend-icon-name">
                                                    <?= $follower->getName() ?>
                                                </div>
                                            </a>
                                        </div>
                                    <?php endforeach;?>
                                    
                                </div>
                            </div>
                            <div class="tab-body" data-item="following">                                
                                <div class="full-friend-list">

                                    <?php foreach ($profile->following as $follow): ?>
                                        <div class="friend-icon">
                                            <a href="<?= "$base/profile/{$follow->getId()}" ?>">
                                                <div class="friend-icon-avatar">
                                                    <img src="<?= "$base/media/avatars/{$follow->getAvatar()}" ?>" />
                                                </div>
                                                <div class="friend-icon-name">
                                                    <?= $follow->getName() ?>
                                                </div>
                                            </a>
                                        </div>
                                    <?php endforeach;?>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>                
        </div>
    </section>
</section>

<?php $this->renderPartial('footer') ?>
