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

                <div class="box feed-new">
                    <div class="box-body">
                        <div class="feed-new-editor m-10 row">
                            <div class="feed-new-avatar">
                                <img src="<?= $base ?>/media/avatars/<?= $user->getAvatar() ?>" />
                            </div>
                            <div class="feed-new-input-placeholder">O que você está pensando, <?= $user->getName() ?>?</div>
                            <div class="feed-new-input" contenteditable="true"></div>
                            <div class="feed-new-send">
                                <img src="<?= $base ?>/assets/images/send.png" />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="box feed-item">
                    <div class="box-body">
                        <div class="feed-item-head row mt-20 m-width-20">
                            <div class="feed-item-head-photo">
                                <a href=""><img src="<?= $base ?>/media/avatars/<?= $user->getAvatar() ?>" /></a>
                            </div>
                            <div class="feed-item-head-info">
                                <a href="<?= "$base/perfil/{$user->getId()}" ?>"><span class="fidi-name"><?= $user->getName() ?></span></a>
                                <span class="fidi-action">fez um post</span>
                                <br/>
                                <span class="fidi-date">07/03/2020</span>
                            </div>
                            <div class="feed-item-head-btn">
                                <img src="<?= $base ?>/assets/images/more.png" />
                            </div>
                        </div>
                        <div class="feed-item-body mt-10 m-width-20">
                            Pessoal, tudo bem! Busco parceiros para empreender comigo em meu software.<br/><br/>
                            Acabei de aprová-lo na Appstore. É um sistema de atendimento via WhatsApp multi-atendentes para auxiliar empresas.<br/><br/>
                            Este sistema permite que vários funcionários/colaboradores da empresa atendam um mesmo número de WhatsApp, mesmo que estejam trabalhando remotamente, sendo que cada um acessa com um login e senha particular....
                        </div>
                        <div class="feed-item-buttons row mt-20 m-width-20">
                            <div class="like-btn on">56</div>
                            <div class="msg-btn">3</div>
                        </div>
                        <div class="feed-item-comments">
                            
                            <div class="fic-item row m-height-10 m-width-20">
                                <div class="fic-item-photo">
                                    <a href="<?= "$base/perfil/{$user->getId()}" ?>"><img src="<?= $base ?>/media/avatars/<?= $user->getAvatar() ?>" /></a>
                                </div>
                                <div class="fic-item-info">
                                    <a href="<?= "$base/perfil/{$user->getId()}" ?>"><?= $user->getName() ?></a>
                                    Comentando no meu próprio post
                                </div>
                            </div>

                            <div class="fic-item row m-height-10 m-width-20">
                                <div class="fic-item-photo">
                                    <a href="<?= "$base/perfil/{$user->getId()}" ?>"><img src="<?= $base ?>/media/avatars/<?= $user->getAvatar() ?>" /></a>
                                </div>
                                <div class="fic-item-info">
                                    <a href="<?= "$base/perfil/{$user->getId()}" ?>"><?= $user->getName() ?></a>
                                    Muito legal, parabéns!
                                </div>
                            </div>

                            <div class="fic-answer row m-height-10 m-width-20">
                                <div class="fic-item-photo">
                                    <a href="<?= "$base/perfil/{$user->getId()}" ?>"><img src="<?= $base ?>/media/avatars/<?= $user->getAvatar() ?>" /></a>
                                </div>
                                <input type="text" class="fic-item-field" placeholder="Escreva um comentário" />
                            </div>

                        </div>
                    </div>
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
