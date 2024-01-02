<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WebChat ID</title>
    <link rel="icon" type="image/x-icon" href="<?=base_url('public/images/favicon.png')?>">
    <link rel="stylesheet" href="<?=base_url('public/bootstrap/css/bootstrap.min.css')?>">
    <link rel="stylesheet" href="<?=base_url('public/css/style.css')?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="<?=base_url('public/js/owl-carousel/assets/owl.carousel.min.css')?>">

    <script src="<?=base_url('public/js/jquery.min.js')?>"></script>
</head>
<body>

    <?php echo $this->include('frontend/components/header'); ?>
    <?php echo $this->include('frontend/modul/'.$page); ?>
    <?php echo $this->include('frontend/components/footer'); ?>
    <?php echo $this->include('frontend/components/script'); ?>
</body>
</html>