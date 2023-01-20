<?= $this->extend('templates/admin_template') ?>
<?= $this->section('content') ?>
<?php
$session = \Config\Services::session();
?>
<div style="height: 90vh;">
    <h2>Welcome <?= $session->get('users')['fname']; ?></h2>
</div>

<?= $this->endSection() ?>