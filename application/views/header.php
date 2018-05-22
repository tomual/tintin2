<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>tintin</title>

    <meta name="author" content="LayoutIt!">

    <link href="<?php echo base_url('css/grid-layout.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('css/style.css') ?>" rel="stylesheet">

</head>
<body>
<div class="grid-container">
    <div data-area="header">
        <div class="title"><a href="<?php echo base_url() ?>">tintin</a></div>
        <?php if ($this->user): ?>
            <div class="menu-authed"><a href="<?php echo base_url("tickets/user/{$this->user->user_id}") ?>"><?php echo $this->user->first_name ?></a> | <a href="<?php echo base_url('user/logout') ?>">Log Out</a></div>
        <?php else: ?>
            <div class="menu-guest"><a href="<?php echo base_url('user/login') ?>">Log In</a> | <a href="<?php echo base_url('user/signup') ?>">Sign Up</a></div>
        <?php endif ?>
    </div>
    <div data-area="nav">
        <nav>
            <ul>
                <li><a href="<?php echo base_url() ?>">Home</a></li>
                <li><a href="<?php echo base_url('ticket/new') ?>">New Ticket</a></li>
                <li><a href="">Tickets List</a></li>
                <li><a href="">Search</a></li>
                <li><a href="">Settings</a></li>
            </ul>
        </nav>
    </div>
    <div data-area="recent">
        <h3>Recent Tickets</h3>
        <table>
            <tr>
                <td>No recent tickets</td>
            </tr>
        </table>
    </div>
    <div data-area="main">