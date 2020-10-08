<?php $this->render('../partials/header', ['user' => $user]) ?>

<div class="flash <?= "flash-{$flash['status']}" ?? '' ?>" style="<?= (!empty($flash['message']))? 'display:block' : '' ?>">
    <?= $flash['message'] ?? '' ?>
</div>

<section class="container main">
    <aside class="mt-10">
        <nav>
            <a href="<?= $base ?>">
                <div class="menu-item active">
                    <div class="menu-item-icon">
                        <img src="<?= $base ?>/assets/images/home-run.png" width="16" height="16" />
                    </div>
                    <div class="menu-item-text">
                        Home
                    </div>
                </div>
            </a>
            <a href="<?= $base ?>/profile">
                <div class="menu-item">
                    <div class="menu-item-icon">
                        <img src="<?= $base ?>/assets/images/user.png" width="16" height="16" />
                    </div>
                    <div class="menu-item-text">
                        Meu Perfil
                    </div>
                </div>
            </a>
            <a href="<?= $base ?>/friends">
                <div class="menu-item">
                    <div class="menu-item-icon">
                        <img src="<?= $base ?>/assets/images/friends.png" width="16" height="16" />
                    </div>
                    <div class="menu-item-text">
                        Amigos
                    </div>
                    <div class="menu-item-badge">
                        33
                    </div>
                </div>
            </a>
            <a href="<?= $base ?>/pictures">
                <div class="menu-item">
                    <div class="menu-item-icon">
                        <img src="<?= $base ?>/assets/images/photo.png" width="16" height="16" />
                    </div>
                    <div class="menu-item-text">
                        Fotos
                    </div>
                </div>
            </a>
            <div class="menu-splitter"></div>
            <a href="<?= $base ?>/settings">
                <div class="menu-item">
                    <div class="menu-item-icon">
                        <img src="<?= $base ?>/assets/images/settings.png" width="16" height="16" />
                    </div>
                    <div class="menu-item-text">
                        Configurações
                    </div>
                </div>
            </a>
            <a href="<?= $base ?>/signout">
                <div class="menu-item">
                    <div class="menu-item-icon">
                        <img src="<?= $base ?>/assets/images/power.png" width="16" height="16" />
                    </div>
                    <div class="menu-item-text">
                        Sair
                    </div>
                </div>
            </a>
        </nav>
    </aside>
    <section class="feed mt-10">        
        <div class="row">
            <div class="column pr-5">

                <?php $this->render('../partials/feed/feed-post', ['user' => $user]) ?>

                <?php $this->render('../partials/feed/feed-item', ['user' => $user, 'feed' => $feed['posts']]) ?>

                <div class="feed-pagination">
                    <?php for($i = 1; $i < $feed['pageCount'] + 1; $i++): ?>
                        <a class="<?= ($i == $feed['currentPage'])? 'active' : '' ?>" href="<?= $base ?>?page=<?= $i ?>"><?= $i ?></a>
                    <?php endfor; ?>
                </div>
            </div>
            <div class="column side pl-5">
                <div class="box banners">
                    <div class="box-header">
                        <div class="box-header-text">Patrocinios</div>
                        <div class="box-header-buttons">
                            
                        </div>
                    </div>
                    <div class="box-body">
                        <a href=""><img src="https://alunos.b7web.com.br/media/courses/php-nivel-1.jpg" /></a>
                        <a href=""><img src="https://alunos.b7web.com.br/media/courses/laravel-nivel-1.jpg" /></a>
                    </div>
                </div>
                <div class="box">
                    <div class="box-body m-10">
                        Criado com ❤️ por B7Web
                    </div>
                </div>
            </div>
        </div>

    </section>
</section>

<?php $this->render('../partials/footer'); ?>
