<?php $this->renderPartial('header', ['user' => $user]) ?>
<?php $this->renderPartial('flash', ['flash' => $flash]) ?>

<section class="container main">

    <?php $this->renderPartial('sidebars/menu', ['activeMenu' => 'home']) ?>

    <section class="feed mt-10">        
        <div class="row">
            <div class="column pr-5">

                <?php $this->renderPartial('feed/feed-post', ['user' => $user]) ?>
                <?php $this->renderPartial('feed/feed-item', ['user' => $user, 'feed' => $feed['posts']]) ?>
                <?php \src\helpers\PageHelper::pagination($base, $feed['pageCount'], $feed['currentPage']) ?>

            </div>
            <div class="column side pl-5">

                <?php $this->renderPartial('sidebars/patrocinio') ?>
                
            </div>
        </div>
    </section>
</section>

<?php $this->renderPartial('footer'); ?>
