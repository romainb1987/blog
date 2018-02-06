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
    <div id="content">
        <h1><?php echo $titre;?></h1>
    </div>
    
    
    <div>
        <p>
                <?php echo anchor('index.php/acc_admin/add','Ajouter un billet','add_billet'); ?>
				
	</p>
    </div>        
    <div>
        <p>
                <?php echo anchor('index.php/acc_admin/add_liste/1','Modifier un billet','update_billet'); ?>
                <?php 
                    if(isset($liste) AND $param == 1){
                        echo form_open('index.php/acc_admin/add_liste/1'); 
                ?>
                            <label for="id">Selectionner le billet à modifier :</label>
                                <select name="id">
                                    <?php
                             
                                        foreach ($liste as $billet){
                                            echo '<option name="'.$billet->id.'" value="'.$billet->id.'" '.set_select('billet',$billet->id).'>'.$billet->titre;
                                    }?>
                                </select>
 
                        <?php 
                        echo form_submit('envoi', 'modifier');
                        echo form_close();
                    } 
                        ?>
				
	</p>
    </div>
    <div>
        <p>
                <?php echo anchor('index.php/acc_admin/add_liste/0','Supprimer un billet','delete_billet'); ?>
                <?php 
                    if(isset($liste) AND $param == 0){
                        echo form_open('index.php/acc_admin/add_liste/0'); 
                ?>
                            <label for="id">Selectionner le billet à modifier :</label>
                                <select name="id">
                                    <?php
                                        foreach ($liste as $billet){
                                            echo '<option name="'.$billet->id.'" value="'.$billet->id.'" '.set_select('billet',$billet->id).'>'.$billet->titre;
                                    }?>
                                </select>
 
                        <?php 
                        echo form_submit('envoi', 'Supprimer');
                        echo form_close();
                    } 
                ?>
	
				
	</p>
    </div>
    <div>
        <p>
                <?php echo anchor('index.php/accueil','retour','disconnect'); ?>
        </p>        
    </div>
   
</body>    

</html>