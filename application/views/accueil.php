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
    <!-- classe container pour le titre du blog // affiche aussi le lien vers la page de connexion admin (temp)   -->
    <div class="container">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <h1><?php echo $titre;?></h1>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-1">
                <img src="<?php echo base_url();?>assets/img/adminicon.png"  width="32" height="32" />
                <?php echo anchor('index.php/accueil/connect','Admin','connexion'); ?>
            </div>
        </div>    
    </div>
        <p>Il y a actuellement <?php echo $phrase = $nb_commentaires <= 1 ? $phrase = $nb_commentaires .' article' : $phrase = $nb_commentaires .' articles';?> <br />
          
	</p>
        
     <!-- classe container/ row du bootstrap pour centrer l'affichage des billets, mise en place de la pagination,
     foreach pour charger les billets  -->    
    <div class="container">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div id="pagination">
                    <?php echo $pagination; ?>          
                </div>

                    <?php foreach($comms as $comm): ?> 
                        <div class="billet">
                                <div id="num_<?php echo $comm->id;?>">    
                                    <a href="#num_<?php echo $comm->id; ?>"></a>
                                    <h3> <?php echo $comm->titre; ?></h3>
                                    <p><?php echo $comm->commentaire; ?></p>
                                    <p class="text-right"><?php echo $comm->date; ?></p>
                                </div>
                        </div>    
                    <?php endforeach; ?>

                <div id="pagination">
                    <?php echo $pagination; ?>      
                </div>   
            </div>
        </div>
    </div>
</body>    

</html>