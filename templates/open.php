<!DOCTYPE html>

<?php check_auth(); ?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo get_src("static/css/style.css") ?>" />
    <?php echo $pageInfo["css"] ?>
    <title>Website <?php echo $pageInfo['title']?></title>
</head>

<body>