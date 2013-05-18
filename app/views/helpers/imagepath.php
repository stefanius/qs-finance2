<?php

class ImagepathHelper extends AppHelper {

    function getFiles($path) {
		$dir = WWW_ROOT.$path;
		
		$i=0;
		if (is_dir($dir)) {
			if ($dh = opendir($dir)) {
				while (($file = readdir($dh)) !== false) {
					if($file != '.' && $file != '..'){
						$returnValue[$i] =  '<img src="'.$this->webroot.$path.$file.'"/>';
						$i++;
					}
				}
				closedir($dh);
			}
		}else{
			$returnValue[$i] = "hoppa";
		}

        return $returnValue;
    }
}
?>
