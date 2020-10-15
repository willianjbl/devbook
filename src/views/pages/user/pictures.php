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

                            <?php foreach ($profile->pictures as $picrture): ?>
                                <div class="user-photo-item">
                                    <a href="#modal-<?= $picrture->getId() ?>" rel="modal:open">
                                        <img src="<?= "$base/media/uploads/{$picrture->getBody()}" ?>" />
                                    </a>
                                    <div id="modal-1" style="display:none">
                                        <img src="<?= "$base/media/uploads/{$picrture->getBody()}" ?>" />
                                    </div>
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
