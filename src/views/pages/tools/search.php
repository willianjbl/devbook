<?php $this->renderPartial('header', ['user' => $user]) ?>
<?php $this->renderPartial('flash', ['flash' => $flash]) ?>

<section class="container main">

    <?php $this->renderPartial('sidebars/menu', ['activeMenu' => 'search']) ?>

    <section class="feed mt-10">       
        <div class="row">
            <div class="column pl-5">
                <h1>Você pesquisou por: <u><?= $searchTerm ?></u></h1>
                <div class="full-friend-list">

                    <?php foreach ($seachUsers as $searchUser): ?>
                        <div class="friend-icon">
                            <a href="<?= "$base/profile/{$searchUser->getId()}" ?>">
                                <div class="friend-icon-avatar">
                                    <img src="<?= "$base/media/avatars/{$searchUser->getAvatar()}" ?>" />
                                </div>
                                <div class="friend-icon-name">
                                    <?= $searchUser->getName() ?>
                                </div>
                            </a>
                        </div>
                    <?php endforeach;?>
                    
                </div>
            </div>
            <div class="column side pl-5">

                <?php $this->renderPartial('sidebars/patrocinio') ?>
                
            </div>
        </div>
    </section>
</section>

<?php $this->renderPartial('footer'); ?>
