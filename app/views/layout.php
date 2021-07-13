<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php if(!empty($this->currentViewData['title'])){ echo $this->currentViewData['title']; }?></title>
        <link rel="stylesheet" type="text/css" href="<?php echo BASEURL?>/assets/css/style.css">
    </head>
    <body>
        <div class="">
            <div class="conent-box">
                <div class="content">
                    <?php echo $this->setViewFile('header'); ?>        
                </div>
            </div>
            <hr/>
            <div class="conent-box">
                <div class="content">
                    <?php echo $this->setViewFile($this->currentViewName); ?>        
                </div>
            </div>
            <hr/>
            <div class="conent-box">
                <div class="content">
                    <?php echo $this->setViewFile('footer'); ?>        
                </div>
            </div>
        </div>
    </body>
</html>
