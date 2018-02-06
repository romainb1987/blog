

<h1>
	Test
</h1>

<p>
	<a href="<?php echo site_url(); ?>">accueil</a>
	<br />
	
	<a href="<?php echo site_url('test'); ?>">accueil</a> du test
<p><?php echo site_url('test');?></p>
	<br />
	
	<a href="<?php echo site_url('test/secret'); ?>">page secrète</a>
	<br />
	
	<a href="<?php echo site_url(array('test', 'secret')); ?>">page secrète</a>
</p>

