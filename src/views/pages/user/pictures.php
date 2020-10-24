<?php $this->renderPartial('header', ['user' => $user]) ?>
<?php $this->renderPartial('flash', ['flash' => $flash]) ?>

<section class="container main">

    <?php $this->renderPartial('sidebars/menu', ['activeMenu' => 'pictures']) ?>

    <section class="feed">

        <?php $this->renderPartial('profile/profile-details', [
            'user' => $user,
            'profile' => $profile,
            'following' => $following
        ]) ?>
        
        <div class="row">
            <div class="column">                
                <div class="box">
                    <div class="box-body">
                        <div class="full-user-photos">

                            <?= (count($profile->pictures) === 0)? 'Não há fotos para exibir.' : '' ?>

                            <?php foreach ($profile->pictures as $picture): ?>
                                <div class="user-photo-item">
                                    <a href="<?= "$base/media/uploads/{$picture->getBody()}" ?>" class="glightbox" data-gallery="Minha Galeria">
                                        <img src="<?= "$base/media/uploads/{$picture->getBody()}" ?>" alt="<?= "$base/media/uploads/{$picture->getBody()}" ?>">
                                    </a>
                                </div>
                            <?php endforeach; ?>

                        </div>
                    </div>
                </div>
            </div>            
        </div>
    </section>
</section>

<?php $this->renderPartial('footer') ?>
