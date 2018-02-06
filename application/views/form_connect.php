<!DOCTYPE html>
<html>
<head>
    <title></title>
    
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/style.css"/>
    
        <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <h1><?php echo $titre;?></h1>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-1">
                <?php echo anchor('accueil','Accueil','retour'); ?>
            </div>
        </div>    
    <div>
        
    <div class="container">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">



                       <div>
                        <?php echo form_open('index.php/accueil/connect'); ?>
                        <form method="post" action="">
                            <label for="pseudo">Pseudo :</label>
                            <input type="text" name="pseudo" value="<?php echo set_value('pseudo'); ?>" />
                            <?php echo form_error('pseudo'); ?>

                            <label for="password">Mot de passe :</label>
                            <input type="password" name="password" value="<?php echo set_value('password'); ?>" />
                             <?php echo form_error('password'); ?>

                            <input type="submit" value="Connexion"/>
        
        
                        </form> 

   
            </div>
        </div>
    </div>
</body>    

</html>