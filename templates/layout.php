<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php if(!empty($title)){ echo $title; }?></title>
        <link rel="stylesheet" type="text/css" href="<?php echo $baseUrl?>/assets/css/style.css">
    </head>
    <body>
        <div class="">
            <div class="conent-box">
                <div class="content">
                    <?php 
                        echo $this->setContentPart('header');
                    ?>
                </div>
            </div>
            <hr/>
            <div class="conent-box">
                <div class="content">
                    <?= $this->getBlock('content'); ?>
                </div>
            </div>
            <hr/>
            <div class="conent-box">
                <div class="content">  
                    <?php
                        echo $this->setContentPart('footer');
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>
