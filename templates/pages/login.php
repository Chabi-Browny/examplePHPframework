<?php
$this->setLayout('layout');

$this->startBlock('content');
?>
<div class="login-box">
    <h3><?php if(!empty($title)){ echo $title; }?></h3>
    <div class="form-box">
        <form method="post" action="<?php echo $baseUrl?>/login/trylogin" >
            <label for="em">E-mail</label>
            <input id="em" type="text" name="usemail"><br>
            <label for="pw">Password</label>
            <input id="pw" type="password" name="paw"><br>
            <input type="submit" name="logn" value="Belép">
        </form>
    </div>

    <?php if(isset($flash['logSubError'])){ echo $flash['logSubError']; } ?>
    <?php if(isset($flash['logForError'])){ echo $flash['logForError']; } ?>
</div>
<?php $this->endBlock();