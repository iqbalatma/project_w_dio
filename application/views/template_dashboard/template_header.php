<?php
    // 
    // lebih ringkas tp msh ada eror blm diselesaiin 
    // 
    // <!DOCTYPE html>
    // <html lang="en">

    // <head>
    // 	<meta charset="utf-8">
    // 	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    // 	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    //     <meta name="author" content="Dio Ilham Djatiadi">
    //     <meta name="author" content="Iqbal Atma Muliawan">

    //     <title>$title;</title>
    //     <link rel="icon" href="base_url('assets/Atlantis-Lite-master/assets/img/icon.ico')" type="image/x-icon" />

    //     <!-- CSS Files -->
    //     <link rel="stylesheet" href="base_url(); /../assets/Atlantis-Lite-master/assets/css/bootstrap.min.css" media="print" onload="this.media='all'; this.onload=null;">
    //     <link rel="stylesheet" href="base_url(); /../assets/Atlantis-Lite-master/assets/css/atlantis.min.css" media="print" onload="this.media='all'; this.onload=null;">

    //     <!-- Fonts and icons -->
    //     <script src="base_url(); /../assets/Atlantis-Lite-master/assets/js/plugin/webfont/webfont.min.js"></script>
    //     <script>
    //         WebFont.load({
    //             google: {
    //                 "families": ["Lato:300,400,700,900"]
    //             },
    //             custom: {
    //                 "families": ["Font Awesome 5 Solid"],
    //                 urls: ['base_url(); /../assets/Atlantis-Lite-master/assets/css/fonts.min.css']
    //             },
    //             active: function() {
    //                 sessionStorage.fonts = true;
    //             }
    //         });
    //     </script>

    //     <!-- Sweet Alert -->
    //     <script async src="base_url('assets/js/sweetalert/sweetalert.min.js')"></script>

    //     <!-- CSS Just for demo purpose, don't include it in your project -->
    //     <!-- <link rel="stylesheet" href="../assets/css/demo.css"> -->
    // </head>
    // <body>
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Dio Ilham Djatiadi">
    <meta name="author" content="Iqbal Atma Muliawan">

    <title><?= $title; ?></title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <link rel="icon" href="<?= base_url(); ?>/../assets/Atlantis-Lite-master/assets/img/icon.ico" type="image/x-icon" />
    <!-- <link rel="icon" href="<?= base_url('assets/img/default.png') ?>" type="image/x-icon" /> -->

    <!-- Fonts and icons -->
    <script src="<?= base_url(); ?>/../assets/Atlantis-Lite-master/assets/js/plugin/webfont/webfont.min.js"></script>
    <script>
        WebFont.load({
            google: {
                "families": ["Lato:300,400,700,900"]
            },
            custom: {
                "families": ["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"],
                urls: ['<?= base_url(); ?>/../assets/Atlantis-Lite-master/assets/css/fonts.min.css']
            },
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="<?= base_url(); ?>/../assets/Atlantis-Lite-master/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/../assets/Atlantis-Lite-master/assets/css/atlantis.min.css">
    <?php if (isset($datatables)) { ?>
        <!-- Datatables -->
        <link rel="stylesheet" href="<?= base_url('assets/css/datatables/jquery.dataTables.min.css') ?>">
        <link rel="stylesheet" href="<?= base_url('assets/css/datatables/responsive.dataTables.min.css') ?>">
    <?php } ?>
    <?php if (isset($select2)) { ?>
        <!-- Select2 -->
        <link rel="stylesheet" href="<?= base_url('vendor/select2/select2/dist/css/select2.min.css') ?>">
    <?php } ?>
    
    <?php // SCROLLBAR STYLING ?>
    <style>
        <?php // The emerging W3C standard that is currently Firefox-only ?>
        * {
            scrollbar-width: thin;
            scrollbar-color: #444444 #777777;
        }
        <?php // Works on Chrome/Edge/Safari ?>
        *::-webkit-scrollbar {
            width: 10px;
        }
        *::-webkit-scrollbar-track {
            background: lightgrey;
        }
        *::-webkit-scrollbar-thumb {
            background-color: darkgrey;
            border-radius: 10px;
            border: 3px solid darkgrey;
        }
        html {
            scroll-behavior: smooth;
        }
    </style>

    <!-- Sweet Alert -->
    <script src="<?= base_url('assets/js/sweetalert/sweetalert.min.js') ?>"></script>


    <!-- CSS Just for demo purpose, don't include it in your project -->
    <!-- <link rel="stylesheet" href="../assets/css/demo.css"> -->
</head>

<body>