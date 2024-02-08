<?php echo  $this->extend('user/templates/dashboardchat_template'); ?>

<?php echo  $this->section('content'); ?>
<?php
$public_url=base_url()."/public/frontend/";
echo $getUserId=$session->get('idUserH');
?>

  <?php echo  $this->include('user/templates/chat_template'); ?>
<?php echo  $this->endSection(); ?>