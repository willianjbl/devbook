<?php $this->render('../partials/header', ['user' => $user]) ?>

<div class="flash <?= "flash-{$flash['status']}" ?? '' ?>" style="<?= (!empty($flash['message']))? 'display:block' : '' ?>">
    <?= $flash['message'] ?? '' ?>
</div>

<section class="container main">

    <?php $this->render('../partials/sidebar', ['activeMenu' => 'profile']) ?>

    <section class="feed">
        <div class="row">
            <div class="box flex-1 border-top-flat">
                <div class="box-body">
                    <div class="profile-cover" style="background-image: url('<?= $base ?>/media/covers/<?= $profile->getCover() ?>') "></div>
                    <div class="profile-info m-20 row">
                        <div class="profile-info-avatar">
                            <img src="<?= $base ?>/media/avatars/<?= $profile->getAvatar() ?>" />
                        </div>
                        <div class="profile-info-name">
                            <div class="profile-info-name-text"><?= $profile->getName() ?></div>
                            <div class="profile-info-location"><?= $profile->getCity() ?></div>
                        </div>
                        <div class="profile-info-data row">

                            <?php if ($user->getId() !== $profile->getId()): ?>
                                <div class="profile-info-item m-width-20">
                                    <a class="button" href="<?= "$base/profile/{$profile->getId()}/follow" ?>"><?= $following ? 'Deixar de Seguir' : 'Seguir' ?></a>
                                </div>
                            <?php endif; ?>

                            <div class="profile-info-item m-width-20">
                                <div class="profile-info-item-n"><?= count($profile->followers) ?></div>
                                <div class="profile-info-item-s">Seguidores</div>
                            </div>
                            <div class="profile-info-item m-width-20">
                                <div class="profile-info-item-n"><?= count($profile->following) ?></div>
                                <div class="profile-info-item-s">Seguindo</div>
                            </div>
                            <div class="profile-info-item m-width-20">
                                <div class="profile-info-item-n"><?= count($profile->pictures) ?></div>
                                <div class="profile-info-item-s">Fotos</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            
        <div class="row">
            <div class="column side pr-5">
                <div class="box">
                    <div class="box-body">
                        <div class="user-info-mini">
                            <img src="<?= $base ?>/assets/images/calendar.png" />
                            <?php
                                $birthDate = new \DateTime($profile->getBirthDate());
                                $currentDate = new \DateTime();
                                echo "{$birthDate->format('d/m/Y')} ({$birthDate->diff($currentDate)->y})";
                            ?>
                        </div>

                        <?php if (!empty($profile->getCity())): ?>
                        <div class="user-info-mini">
                            <img src="<?= $base ?>/assets/images/pin.png" />
                            <?= $profile->getCity() ?>, Brasil
                        </div>
                        <?php endif; ?>

                        <?php if (!empty($profile->getWork())): ?>
                        <div class="user-info-mini">
                            <img src="<?= $base ?>/assets/images/work.png" />
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
                                <a href="<?= $base ?>/following">ver todos</a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="box-body friend-list">

                        <?php if (count($profile->following) > 0): ?>
                            <?php for ($i = 0; $i <= 9; $i++): ?>
                                <?php if (isset($profile->following[$i])): ?> 
                                    <div class="friend-icon">
                                        <a href="<?= $base ?>/profile/<?= $profile->following[$i]->getId() ?>">
                                            <div class="friend-icon-avatar">
                                                <img src="<?= $base ?>/media/avatars/<?= $profile->following[$i]->getAvatar() ?>" />
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

                <?php if ($profile->getId() ==- $user->getId()): ?>
                    <?php $this->render('../partials/feed/feed-post', ['user' => $user]) ?>
                <?php endif; ?>
                
                <?php if (count($profile->pictures) > 0): ?>
                    <div class="box">
                        <div class="box-header m-10">
                            <div class="box-header-text">
                                Fotos
                                <span>(<?= count($profile->pictures) ?>)</span>
                            </div>
                            <div class="box-header-buttons">
                                <a href="<?= $base ?>/pictures">ver todos</a>
                            </div>
                        </div>
                    
                        <div class="box-body row m-20">
                            <?php for ($i = 0; $i <= 4; $i++): ?>
                                <?php if (isset($profile->pictures[$i])): ?>
                                    <div class="user-photo-item">
                                        <a href="#modal-<?= $profile->pictures[$i]->getId() ?>" rel="modal:open">
                                            <img src="<?= $base ?>/media/uploads/<?= $profile->pictures[$i]->getBody() ?>" />
                                        </a>
                                        <div id="modal-<?= $profile->pictures[$i]->getId() ?>" style="display:none">
                                            <img src="<?= $base ?>/media/uploads/<?= $profile->pictures[$i]->getBody() ?>" />
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endfor; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <?php $this->render('../partials/feed/feed-item', ['user' => $user, 'feed' => $feed['posts']]) ?>
                
                <?php \src\helpers\PageHelper::pagination("$base/profile/{$profile->getId()}", $feed['pageCount'], $feed['currentPage']) ?>
            </div>
        </div>
    </section>
</section>

<?php $this->render('../partials/footer'); ?>
