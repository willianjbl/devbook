<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8" />
    <title>Devbook - Sign up</title>
    <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1"/>
    <link rel="stylesheet" href="<?= "$base/assets/css/signin.css" ?>" />
</head>
<body>
    <header>
        <div class="container">
            <a href=""><img src="<?= "$base/assets/images/devsbook_logo.png" ?>" /></a>
        </div>
    </header>
    
    <?php $this->renderPartial('flash', ['flash' => $flash]) ?>
    
    <section class="container main">
        <form method="POST" action="<?= "$base/signup" ?>">
            <h2>Sign Up</h2>
            <hr style="margin: 15px 0px">
            <input placeholder="Digite seu nome" class="input" type="text" name="name" />
            <input placeholder="Digite seu e-mail" class="input" type="email" name="email" />
            <input placeholder="Digite sua senha" class="input" type="password" name="password" />
            <input placeholder="Re-digite sua senha" class="input" type="password" name="repassword" />
            <input placeholder="Digite sua data de nascimento" class="input" type="text" name="birthdate" id="birthdate" />
            <input class="button" type="submit" value="Cadastre-se" />
        </form>
    </section>
    <script src="https://unpkg.com/imask"></script>
    <script src="<?= "$base/assets/js/view/user/signup.js" ?>"></script>
</body>
</html>
