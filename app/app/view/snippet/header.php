<!DOCTYPE html>
<html>
<head>
<title><?php echo $page_title; ?> - Mondial Security</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<link type="text/css" rel="stylesheet" href="/css/main.css">
<link type="text/css" rel="stylesheet" href="/css/mobile.css">
<link type="text/css" rel="stylesheet" href="/css/jquery-ui.min.css">
<link type="text/css" rel="stylesheet" href="/css/dropzone.css">
<?php foreach ($styles as $style) { ?>
<link type="text/css" rel="stylesheet" href="/css/<?php echo $style; ?>">
<?php } ?>
<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,600,600i,700,700i" rel="stylesheet">
<script src="/script/jquery.js"></script>
<script src="/script/jquery-ui.min.js"></script>
<script src="/script/dropzone.js"></script>
<script src="/script/main.js"></script>
<script src="/script/shift.js"></script>
<script src="/script/user.js"></script>
<script src="/script/dialog.js"></script>
<?php foreach ($scripts as $script) { ?>
<script src="/script/<?php echo $script; ?>"></script>
<?php } ?>
</head>
<body>
<?php if ($user->is_signed_in()) include(VIEW_NAV); ?>
