<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Creation / Edition</title>
</head>
<body>
    <ul>
        <?php foreach ($errors as $error):?>
            <li><?php echo $error ?></li>
        <?php endforeach ?>
    </ul>
    
    <h3>INSCRIPTION</h3>

<form action="<?php echo BASE_URL ?>/products/save" method="POST">  



    <span> Designation </span><br>
    <input type="text" name="label" value="<?php echo $product->getLabel()?>" ><br>

    <span> Prix </span><br>
    <input type="text" name="price" value="<?php echo $product->getPrice()?>"><br> 

    <span> Vue </span><br>
    <input type="text" name="image_url" value="<?php echo $product->getImage_url()?>"><br> 
    <?php if ($id=$product->getId()){ ?>
        <input type="hidden" name="id" value="<?php echo $id?>">
        <?php
    } ?>


    <br><input type="submit" name="valider">
</form>


</body>
</html>
