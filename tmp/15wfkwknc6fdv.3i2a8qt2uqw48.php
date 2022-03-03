<!DOCTYPE html>

<!--HTML Components from https://getbootstrap.com/docs/5.1/examples/ using Bootstrap CDN-->

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">
    <title><?= ($html_title) ?></title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> <!--CDN for jquery library needed for ajax functions-->
    <script src="<?= ($BASE) ?>/app/assets/js/f3sample.js"></script>                                        <!--Used in ajax/jquery in MainController-->
    <!-- Bootstrap core CSS  - updated by WG to the CDN link from https://getbootstrap.com/docs/5.1/getting-started/introduction/-->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet"> <!--from https://www.bootstrapcdn.com/ -->
    <!-- Custom styles for this template -->
    <link href="<?= ($BASE) ?>/app/assets/css/base.css" rel="stylesheet">
    <link href="<?= ($BASE) ?>/app/assets/css/dashboard.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= ($BASE) ?>/app/assets/css/theme.css" type="text/css"/>
    <link rel="stylesheet" href="<?= ($BASE) ?>/app/assets/css/StyleSheet.css">
    <link rel="icon" href="<?= ($BASE) ?>/favicon.ico">
</head>
</head>
<body>
<?php echo $this->render('navigation.html',NULL,get_defined_vars(),0); ?>
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">

    <?php echo $this->render('header.html',NULL,get_defined_vars(),0); ?>
    <?php echo $this->render($content,NULL,get_defined_vars(),0); ?>
    <?php echo $this->render('footer.html',NULL,get_defined_vars(),0); ?>

</div>
</body>
</html>
