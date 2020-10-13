<?php $this->render('../partials/header', ['user' => $user]) ?>

<div class="flash <?= "flash-{$flash['status']}" ?? '' ?>" style="<?= (!empty($flash['message']))? 'display:block' : '' ?>">
    <?= $flash['message'] ?? '' ?>
</div>

<section class="container main">

    <?php $this->render('../partials/sidebar', ['activeMenu' => 'friends']) ?>

    <section class="feed">
        <?php
            $this->render('../partials/profile/profile-details', [
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
                                    <div class="friend-icon">
                                        <a href="">
                                            <div class="friend-icon-avatar">
                                                <img src="media/avatars/avatar.jpg" />
                                            </div>
                                            <div class="friend-icon-name">
                                                Bonieky
                                            </div>
                                        </a>
                                    </div>

                                    <div class="friend-icon">
                                        <a href="">
                                            <div class="friend-icon-avatar">
                                                <img src="media/avatars/avatar.jpg" />
                                            </div>
                                            <div class="friend-icon-name">
                                                Bonieky
                                            </div>
                                        </a>
                                    </div>

                                    <div class="friend-icon">
                                        <a href="">
                                            <div class="friend-icon-avatar">
                                                <img src="media/avatars/avatar.jpg" />
                                            </div>
                                            <div class="friend-icon-name">
                                                Bonieky
                                            </div>
                                        </a>
                                    </div>

                                    <div class="friend-icon">
                                        <a href="">
                                            <div class="friend-icon-avatar">
                                                <img src="media/avatars/avatar.jpg" />
                                            </div>
                                            <div class="friend-icon-name">
                                                Bonieky
                                            </div>
                                        </a>
                                    </div>

                                    <div class="friend-icon">
                                        <a href="">
                                            <div class="friend-icon-avatar">
                                                <img src="media/avatars/avatar.jpg" />
                                            </div>
                                            <div class="friend-icon-name">
                                                Bonieky
                                            </div>
                                        </a>
                                    </div>

                                    <div class="friend-icon">
                                        <a href="">
                                            <div class="friend-icon-avatar">
                                                <img src="media/avatars/avatar.jpg" />
                                            </div>
                                            <div class="friend-icon-name">
                                                Bonieky
                                            </div>
                                        </a>
                                    </div>

                                    <div class="friend-icon">
                                        <a href="">
                                            <div class="friend-icon-avatar">
                                                <img src="media/avatars/avatar.jpg" />
                                            </div>
                                            <div class="friend-icon-name">
                                                Bonieky
                                            </div>
                                        </a>
                                    </div>

                                    <div class="friend-icon">
                                        <a href="">
                                            <div class="friend-icon-avatar">
                                                <img src="media/avatars/avatar.jpg" />
                                            </div>
                                            <div class="friend-icon-name">
                                                Bonieky
                                            </div>
                                        </a>
                                    </div>
                                </div>

                            </div>
                            <div class="tab-body" data-item="following">
                                
                                <div class="full-friend-list">
                                    <div class="friend-icon">
                                        <a href="">
                                            <div class="friend-icon-avatar">
                                                <img src="media/avatars/avatar.jpg" />
                                            </div>
                                            <div class="friend-icon-name">
                                                Bonieky
                                            </div>
                                        </a>
                                    </div>

                                    <div class="friend-icon">
                                        <a href="">
                                            <div class="friend-icon-avatar">
                                                <img src="media/avatars/avatar.jpg" />
                                            </div>
                                            <div class="friend-icon-name">
                                                Bonieky
                                            </div>
                                        </a>
                                    </div>

                                    <div class="friend-icon">
                                        <a href="">
                                            <div class="friend-icon-avatar">
                                                <img src="media/avatars/avatar.jpg" />
                                            </div>
                                            <div class="friend-icon-name">
                                                Bonieky
                                            </div>
                                        </a>
                                    </div>

                                    <div class="friend-icon">
                                        <a href="">
                                            <div class="friend-icon-avatar">
                                                <img src="media/avatars/avatar.jpg" />
                                            </div>
                                            <div class="friend-icon-name">
                                                Bonieky
                                            </div>
                                        </a>
                                    </div>

                                    <div class="friend-icon">
                                        <a href="">
                                            <div class="friend-icon-avatar">
                                                <img src="media/avatars/avatar.jpg" />
                                            </div>
                                            <div class="friend-icon-name">
                                                Bonieky
                                            </div>
                                        </a>
                                    </div>

                                    <div class="friend-icon">
                                        <a href="">
                                            <div class="friend-icon-avatar">
                                                <img src="media/avatars/avatar.jpg" />
                                            </div>
                                            <div class="friend-icon-name">
                                                Bonieky
                                            </div>
                                        </a>
                                    </div>

                                    <div class="friend-icon">
                                        <a href="">
                                            <div class="friend-icon-avatar">
                                                <img src="media/avatars/avatar.jpg" />
                                            </div>
                                            <div class="friend-icon-name">
                                                Bonieky
                                            </div>
                                        </a>
                                    </div>

                                    <div class="friend-icon">
                                        <a href="">
                                            <div class="friend-icon-avatar">
                                                <img src="media/avatars/avatar.jpg" />
                                            </div>
                                            <div class="friend-icon-name">
                                                Bonieky
                                            </div>
                                        </a>
                                    </div>

                                    <div class="friend-icon">
                                        <a href="">
                                            <div class="friend-icon-avatar">
                                                <img src="media/avatars/avatar.jpg" />
                                            </div>
                                            <div class="friend-icon-name">
                                                Bonieky
                                            </div>
                                        </a>
                                    </div>

                                    <div class="friend-icon">
                                        <a href="">
                                            <div class="friend-icon-avatar">
                                                <img src="media/avatars/avatar.jpg" />
                                            </div>
                                            <div class="friend-icon-name">
                                                Bonieky
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>                
        </div>
    </section>
</section>

<?php $this->render('../partials/footer') ?>
