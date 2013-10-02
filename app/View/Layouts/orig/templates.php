<?if( $sg == 'banner' ):?>
    <?php if (JRequest::getVar('view') == 'frontpage'):?>
    <!-- SIDE BEGIN --><!-- SIDE END -->
    <?php endif?>
<?else:?>
     <?php echo $this->App->getCfg('sitename'); ?>, Powered by <a href="http://joomla.org/" class="sgfooter" target="_blank">Joomla!</a>
    
    <?php $menu = &JSite::getMenu();
    if ($menu->getActive() == $menu->getDefault()) :?>
        <!-- FOOTER BEGIN --><a href="http://www.siteground.com/cpanel-hosting.htm" target="_blank">cPanel hosting by SiteGround</a><!-- FOOTER END -->
    <?php endif ?>
    
<?endif;?>
