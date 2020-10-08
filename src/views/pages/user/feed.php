<?php $this->render('../partials/header', ['user' => $user]) ?>

<div class="flash <?= "flash-{$flash['status']}" ?? '' ?>" style="<?= (!empty($flash['message']))? 'display:block' : '' ?>">
    <?= $flash['message'] ?? '' ?>
</div>

<section class="container main">

    <?php $this->render('../partials/sidebar', ['activeMenu' => 'home']) ?>

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
