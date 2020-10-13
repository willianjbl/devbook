<?php $this->render('../partials/header', ['user' => $user]) ?>

<?php $this->render('../partials/flash', ['flash' => $flash]) ?>

<section class="container main">

    <?php $this->render('../partials/sidebar', ['activeMenu' => 'home']) ?>

    <section class="feed mt-10">        
        <div class="row">
            <div class="column pr-5">

                <?php $this->render('../partials/feed/feed-post', ['user' => $user]) ?>

                <?php $this->render('../partials/feed/feed-item', ['user' => $user, 'feed' => $feed['posts']]) ?>

                <?php \src\helpers\PageHelper::pagination($base, $feed['pageCount'], $feed['currentPage']) ?>

            </div>
            <div class="column side pl-5">
                <div class="box banners">
                    <div class="box-header">
                        <div class="box-header-text">Patrocinios</div>
                        <div class="box-header-buttons">
                            
                        </div>
                    </div>
                    <div class="box-body">
                        <a href=""><img src="https://thumbs.dreamstime.com/b/php-logo-icon-tab-85497655.jpg" /></a>
                        <a href=""><img src="https://th.bing.com/th/id/OIP.Gz1bkrk2rcGu7Xnrbj9pFgHaEK?pid=Api&rs=1" /></a>
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
