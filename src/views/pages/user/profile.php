<?php $this->renderPartial('header', ['user' => $user]) ?>
<?php $this->renderPartial('flash', ['flash' => $flash]) ?>

<section class="container main">

    <?php $this->renderPartial('sidebars/menu', ['activeMenu' => 'profile']) ?>

    <section class="feed">

        <?php
            $this->renderPartial('profile/profile-details', [
                'profile' => $profile,
                'user' => $user,
                'following' => $following
            ])
        ?>
            
        <div class="row">
            <div class="column side pr-5">
                <div class="box">
                    <div class="box-body">
                        <div class="user-info-mini">
                            <img src="<?= "$base/assets/images/calendar.png" ?>" />
                            <?= \src\helpers\DateHelper::brazilianDateConvert($profile->getBirthDate()) . " ({$profile->idade})"; ?>
                        </div>

                        <?php if (!empty($profile->getCity())): ?>
                            <div class="user-info-mini">
                                <img src="<?= "$base/assets/images/pin.png" ?>" />
                                <?= $profile->getCity() ?>, Brasil
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($profile->getWork())): ?>
                            <div class="user-info-mini">
                                <img src="<?= "$base/assets/images/work.png" ?>" />
                                <?= $profile->getWork() ?>
                            </div>
                        <?php endif; ?>

                    </div>
                </div>

                <div class="box">
                    <div class="box-header m-10">
                        <div class="box-header-text">
                            Seguindo
                            <span>(<?= count($profile->following) ?>)</span>
                        </div>
                        <div class="box-header-buttons">
                            <?php if (count($profile->following) > 0): ?>
                                <a href="<?= "$base/profile/{$profile->getId()}/friends" ?>">ver todos</a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="box-body friend-list">

                        <?php if (count($profile->following) > 0): ?>
                            <?php for ($i = 0; $i <= 9; $i++): ?>
                                <?php if (isset($profile->following[$i])): ?> 
                                    <div class="friend-icon">
                                        <a href="<?= "$base/profile/{$profile->following[$i]->getId()}" ?>">
                                            <div class="friend-icon-avatar">
                                                <img src="<?= "$base/media/avatars/{$profile->following[$i]->getAvatar()}" ?>" />
                                            </div>
                                            <div class="friend-icon-name">
                                                <?= $profile->following[$i]->getName() ?>
                                            </div>
                                        </a>
                                    </div>
                                <?php endif; ?>
                            <?php endfor; ?>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
            
            <div class="column pl-5">

                <?php if ($profile->getId() === $user->getId()): ?>
                    <?php $this->renderPartial('feed/feed-post', ['user' => $user]) ?>
                <?php endif; ?>
                
                <?php if (count($profile->pictures) > 0): ?>
                    <div class="box">
                        <div class="box-header m-10">
                            <div class="box-header-text">
                                Fotos
                                <span>(<?= count($profile->pictures) ?>)</span>
                            </div>
                            <div class="box-header-buttons">
                                <a href="<?= "$base/profile/{$profile->getId()}/pictures" ?>">ver todos</a>
                            </div>
                        </div>
                    
                        <div class="box-body row m-20">
                            <?php for ($i = 0; $i <= 4; $i++): ?>
                                <?php if (isset($profile->pictures[$i])): ?>
                                    <div class="user-photo-item">
                                        <a href="<?= "$base/media/uploads/{$profile->pictures[$i]->getBody()}" ?>" class="glightbox" data-gallery="Minha Galeria">
                                            <img src="<?= "$base/media/uploads/{$profile->pictures[$i]->getBody()}" ?>" alt="<?= "$base/media/uploads/{$profile->pictures[$i]->getBody()}" ?>">
                                        </a>
                                    </div>
                                <?php endif; ?>
                            <?php endfor; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <?php $this->renderPartial('feed/feed-item', ['user' => $user, 'feed' => $feed['posts']]) ?>                
                <?php \src\helpers\PageHelper::pagination("$base/profile/{$profile->getId()}", $feed['pageCount'], $feed['currentPage']) ?>
                
            </div>
        </div>
    </section>
</section>

<?php $this->renderPartial('footer'); ?>
