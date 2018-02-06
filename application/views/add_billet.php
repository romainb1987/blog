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
                <?php echo anchor('index.php/acc_admin','Retour','retour'); ?>
            </div>
        </div>    
    <div>
        
    <div class="container">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">



                       <div>
                        <?php echo form_open('index.php/acc_admin/add'); ?>
                        <form method="post" action="">
                            <label for="titre">Titre :</label>
                            <input type="text" name="titre" value="<?php echo set_value('titre'); ?>" />
                            <?php echo form_error('titre'); ?>

                            <label for="commentaire">commentaire :</label>
                             <textarea name="commentaire" row="12" cols="100" value="<?php echo set_value('commentaire'); ?>"></textarea>
                             <?php echo form_error('commentaire'); ?>
                             
                            <label for="date">date :</label>
                            <input type="date" name="date"value="<?php echo set_value('date'); ?>"/>
                             <?php echo form_error('date'); ?> 

                            <input type="submit" value="ajouter le billet"/>
        
        
                        </form> 

   
            </div>
        </div>
    </div>
</body>    

</html>
