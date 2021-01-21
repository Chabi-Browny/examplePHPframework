<div class="login-box">
    <h3>Lépj be</h3>
    <div class="form-box">
        <form method="post" action="<?php echo BASEURL;?>/login/trylogin" >
            <label for="em">E-mail</label>
            <input id="em" type="text" name="usemail"><br>
            <label for="pw">Jelszó</label>
            <input id="pw" type="password" name="paw"><br>
            <input type="submit" name="logn" value="Belép">
        </form>
    </div>
    <div class="emsg">
        <?php if(!empty($this->currentViewData['formE'])){ echo $this->currentViewData['formE']; }?>
    </div>
</div>