<div class="row">
    <div class="box flex-1 border-top-flat">
        <div class="box-body">
            <div class="profile-cover" style="background-image: url('<?= "$base/media/covers/{$profile->getCover()}" ?>');"></div>
            <div class="profile-info m-20 row">
                <div class="profile-info-avatar">
                    <a href="<?= "$base/profile/{$profile->getId()}" ?>"><img src="<?= "$base/media/avatars/{$profile->getAvatar()}" ?>" /></a>
                </div>
                <div class="profile-info-name">
                    <div class="profile-info-name-text"><a href="<?= "$base/profile/{$profile->getId()}" ?>"><?= $profile->getName() ?></a></div>
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