<h1><strong>Download MSQL backups</strong></h1>
<?php
    foreach($files as $file){
        echo $this->Html->link($file, array('controller' => 'backup', 'action' => 'downloadmysql', $file)).'<br/>';        
    }
?>