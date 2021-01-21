
<nav>
    <a href="<?php echo BASEURL;?>">public</a>
    
    <?php 
    if( isset($this->currentViewData['islogd'])){ 
    ?>
    <a href="<?php echo BASEURL;?>/member">protected</a>
    <a href="<?php echo BASEURL;?>/login/logout">kilépés</a>
    <?php }
    else{
    ?>
    <a href="<?php echo BASEURL;?>/login">login</a>
    <?php }?>
</nav>