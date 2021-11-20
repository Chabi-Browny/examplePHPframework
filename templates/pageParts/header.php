
<nav>
    <a href="<?php echo $baseUrl?>">public</a>
    
    <?php 
    if( isset($this->currentViewData['islogd'])){ 
    ?>
    <a href="<?php echo $baseUrl?>/member">protected</a>
    <a href="<?php echo $baseUrl?>/login/logout">logout</a>
    <?php }
    else{
    ?>
    <a href="<?php echo $baseUrl?>/login">login</a>
    <?php }?>
</nav>