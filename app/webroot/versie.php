<?php
//Zet het SVN buildnummer & trunk/brach/tag in het systeem

    $build = "0000";
    $source = "UNSET";
    Configure::write('Versie.build',$build);
    Configure::write('Versie.source',$source);
