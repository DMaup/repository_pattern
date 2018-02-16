<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
</head>
<body>
    <ul>
        <?php foreach ($errors as $error):?>
            <li><?php echo $error ?></li>
        <?php endforeach ?>
    </ul>

    <h3>LOGIN</h3>

<form action="<?php echo BASE_URL ?>/users/login/" method="POST"> 

    <span> Utilisateur </span><br>
    <input type="text" name="username" value="<?php echo $user->getUsername()?>" ><br>

    <span> Mot de passe </span><br>
    <input type="password" name="password" value="<?php echo $user->getPassword()?>"><br> 

    <?php /*if ($id=$user->getId()){ ?> -->
        <input type="hidden" name="id" value="<?php echo $id?>">
        <?php
        } */?>


    <br><input type="submit" name="login" value="Entrer">
</form>


</body>
</html>
