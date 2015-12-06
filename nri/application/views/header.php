<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>NRI Global Inc</title>
        <link href="<?php echo base_url('assets/css/nri.css'); ?>" type="text/css" rel="stylesheet">
        <script src="<?php echo base_url('assets/js/jquery-2.1.4.min.js'); ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('assets/js/nri.js'); ?>" type="text/javascript"></script>
    </head>
    <body>
        <div id="container">
            <header>
                <h1 id="title"><span class="nri">NRI</span> <span class="global">Global</span> Inventory System</h1>
                <nav>
                    <ul>
                        <li><a href="<?php echo base_url(); ?>">Upload</a></li>
                        <li><a href="<?php echo base_url('inventory/expenses'); ?>">Expenses</a></li>
                    </ul>
                </nav>
            </header>
            <div id="main-content">
            