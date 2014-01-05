<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo __('QSFinance :: '); ?>
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		//echo $this->Html->meta('icon');
		
		echo $this->Html->css('bootstrap');
		echo $this->Html->css('overridings');
        //echo $this->Html->css('jquery/overcast/jquery-ui.min');  
        echo $this->Html->css('font-awesome.min.css');
        echo $this->Html->script('jquery-2.0.2.min'); // Include jQuery library
        echo $this->Html->script('jquery-ui-1.10.3.custom.min'); // Include jQuery library
        echo $this->Html->script('bootstrap'); // Include jQuery library
		echo $scripts_for_layout;
	?>
</head>
<body>

	<div id="wrap">
		<?php echo $this->element('topmenu/container'); ?>	
		    
		<div id="content">
			<?php echo $this->Session->flash(); ?>
			<?php echo $this->Session->flash('auth'); ?>

			  <div class="container">
			    <?php echo $this->element('breadcrumb'); ?>	  
		        <div class="page-header">
		          <h1>Placeholder</h1>
		        </div>
		        <?php echo $content_for_layout; ?>
		      </div>			
		</div>
		<div id="push"></div>
	</div>
<div id="footer">
      <div class="container">
        <p>Huidige versie: <?php echo $this->element('version'); ?></p>
      </div>
    </div>
  	<?php //echo $this->element('sql_dump'); ?>
</body>
</html>