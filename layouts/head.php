<meta charset="UTF-8">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
<title>
    <?php
        $upper  = ucfirst($page ?? 'Dashboard');
        $judul = str_replace('-',' ',$upper);
        echo $judul;
    ?>
</title>

<!-- General CSS Files -->
<link rel="stylesheet" href="<?= BASE_URL ?>/assets/bs/css/bootstrap.min.css">
<link rel="stylesheet" href="<?= BASE_URL ?>/assets/fontawesome-free/css/all.min.css">

<!-- CSS Libraries -->

<!-- Template CSS -->
<link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style.css">
<link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/components.css">

<link rel="stylesheet" href="<?= BASE_URL . '/assets/datatables-bs4/css/dataTables.bootstrap4.min.css'?>">
<link rel="stylesheet" href="<?= BASE_URL . '/assets/datatables-responsive/css/responsive.bootstrap4.min.css'?>">
<link rel="stylesheet" href="<?= BASE_URL . '/assets/sweetalert2/sweetalert2.all.min.js'?>">
<link rel="stylesheet" href="<?= BASE_URL . '/assets/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css'?>">
<script src="<?= BASE_URL ?>/assets/js/jquery-3.6.1.min.js"></script>
