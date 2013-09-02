<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo __('Quaestor Chantallus :: '); ?>
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('cake.generic');
		echo $this->Html->css('cake.boekhouden');
		echo $this->Html->css('boekhouden');
                echo $this->Html->css('jquery/black-tie/jquery-ui.min');   
                echo $this->Html->script('jquery-2.0.2.min'); // Include jQuery library
                echo $this->Html->script('jquery-ui-1.10.3.custom.min'); // Include jQuery library
		echo $scripts_for_layout;
	?>
</head>
<body>
	<div id="container">
		<div id="header">
			<h1><?php echo $this->Html->link(__('Met trots ontwikkeld door Stefanius.nl'), 'http://stefanius.nl'); ?></h1>
		</div>
		<div id="content">

			<?php echo $this->Session->flash(); ?>
			<?php echo $this->Session->flash('auth'); ?>
			<div id="leftbar">
				<?php echo $this->element('leftbar'); ?>
			</div>
			
			<div id="main">
				<?php echo $content_for_layout; ?>
			</div>

		</div>
		<div id="footer">
			<?php echo "Build: ".Configure::read('Versie.source')."-".Configure::read('Versie.build'); ?>
		</div>
	</div>
	<?php echo $this->element('sql_dump'); ?>
</body>
</html>

<?php

    
?>