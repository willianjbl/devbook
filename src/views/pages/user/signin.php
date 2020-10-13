<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8" />
    <title>Devbook - Sign in</title>
    <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1"/>
    <link rel="stylesheet" href="<?= "$base/assets/css/signin.css"?>" />
</head>
<body>
    <header>
        <div class="container">
            <a href=""><img src="<?= "$base/assets/images/devsbook_logo.png" ?>" /></a>
        </div>
    </header>
    <section class="container main">
        <form method="POST" action="<?= "$base/signin" ?>">
            <?php $this->render('../partials/flash', ['flash' => $flash]) ?>
            
            <input placeholder="Digite seu e-mail" class="input" type="email" name="email" />

            <input placeholder="Digite sua senha" class="input" type="password" name="password" />

            <input class="button" type="submit" value="Acessar o sistema" />

            <a href="<?= "$base/signup" ?>">Ainda não tem conta? Cadastre-se</a>
        </form>
    </section>
    <script src="<?= "$base/assets/js/view/user/signin.js" ?>"></script>
</body>
</html>
