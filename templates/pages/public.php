
<?php 
$this->setLayout('layout');
?>

<?php 
$this->startBlock('content');
?>

<h1>Welcome on <?php if(!empty($title)){ echo $title; } ?></h1>

<?php 
$this->endBlock();
?>
<p>what??</p>