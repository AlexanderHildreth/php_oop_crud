<?php
include_once __DIR__ . '/system/config/partials.php';

$page_title = "Register";
include_once $header;

$_SESSION['error'] = '';
$_SESSION['success'] = '';

require 'views/register.html';

include_once $footer;