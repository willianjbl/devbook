<?php $this->renderPartial('header', ['user' => $user]) ?>

<?php $this->renderPartial('flash', ['flash' => $flash]) ?>

<section class="container main">

    <?php $this->renderPartial('sidebars/menu', ['activeMenu' => 'settings']) ?>

    <section class="feed mt-10">       
        <div class="row">
            <div class="column pl-5">
                
                <form action="<?= "$base/settings" ?>" method="post">
                    <label for="name">Nome:</label>
                    <input type="text" id="name" name="name" value="<?= $user->getName() ?>" required>
                    <label for="email">E-mail:</label>
                    <input type="email" id="email" name="email" value="<?= $user->getEmail() ?>" required>
                    <label for="birthdate">Data de Nascimento:</label>
                    <input type="text" id="birthdate" name="birthdate" value="<?=  \src\helpers\DateHelper::brazilianDateConvert($user->getBirthDate()) ?>" required>
                    <label for="city">Cidade:</label>
                    <input type="text" id="city" name="city" value="<?= $user->getCity() ?>">
                    <label for="work">Trabalho:</label>
                    <input type="text" id="work" name="work" value="<?= $user->getWork() ?>">
                    <label for="password">Senha:</label>
                    <input type="password" id="password" name="password">
                    <label for="repassword">Redigite sua Senha:</label>
                    <input type="password" id="repassword" name="repassword">

                    <button class="button" type="submit">Salvar</button>
                </form>

            </div>
            <div class="column side pl-5">
                <?php $this->renderPartial('sidebars/patrocinio') ?>
            </div>
        </div>
    </section>
</section>

<script src="https://unpkg.com/imask"></script>
<script src="<?= "$base/assets/js/view/user/signup.js" ?>"></script>
<?php $this->renderPartial('footer'); ?>
