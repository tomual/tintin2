<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>tintin</title>

    <meta name="author" content="LayoutIt!">

    <link href="https://tabler.github.io/tabler/assets/css/dashboard.css" rel="stylesheet"/>
    <link href="<?php echo base_url('css/tabler.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('css/style.css') ?>" rel="stylesheet">

</head>
<body>
<div class="wrapper">
    <div class="right">
        <?php if ($this->user): ?>
            <div class="title o-auto">
                <svg class="mt-9" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="32" height="32" viewBox="0 0 32 32">
                    <g>
                    </g>
                    <path d="M17.927 12l2.68-10.28c0.040-0.126 0.060-0.261 0.060-0.4 0-0.726-0.587-1.32-1.314-1.32-0.413 0-0.78 0.187-1.019 0.487l-13.38 17.353c-0.18 0.227-0.287 0.513-0.287 0.827 0 0.733 0.6 1.333 1.333 1.333h8.073l-2.68 10.28c-0.041 0.127-0.060 0.261-0.060 0.4 0.001 0.727 0.587 1.32 1.314 1.32 0.413 0 0.78-0.186 1.020-0.487l13.379-17.353c0.181-0.227 0.287-0.513 0.287-0.827 0-0.733-0.6-1.333-1.333-1.333h-8.073z"></path>
                </svg>
                <h2 class="mt-2"><a href="<?php echo base_url() ?>">tintin</a></h2>
                <div class="menu-authed">
                    <div class="item-action dropdown">
                        <a href="javascript:void(0)" data-toggle="dropdown" class="icon" aria-expanded="false"><?php echo $this->user->first_name ?> <i class="fe fe-chevron-down"></i></a>
                        <div class="dropdown-menu" x-placement="bottom-end" style="position: absolute; transform: translate3d(-181px, 21px, 0px); top: 0px; left: 0px; will-change: transform;">
                            <a href="javascript:void(0)" class="dropdown-item">Action </a>
                            <a href="javascript:void(0)" class="dropdown-item">Another action </a>
                            <a href="javascript:void(0)" class="dropdown-item">Something else here</a>
                            <div class="dropdown-divider"></div>
                            <a href="<?php echo base_url('user/logout') ?>" class="dropdown-item">Log Out</a>
                        </div>
                    </div>
                </div>
                <nav class="mt-9">
                    <ul>
                        <li><a href="<?php echo base_url() ?>">Home</a></li>
                        <li><a href="<?php echo base_url('ticket/new') ?>">New Ticket</a></li>
                        <li><a href="<?php echo base_url('ticket/all') ?>">Tickets List</a></li>
                        <li><a href="<?php echo base_url('project/all') ?>">Projects</a></li>
                        <li><a href="">Search</a></li>
                        <li><a href="">Settings</a></li>
                    </ul>
                </nav>
            </div>
            <div class="recent">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Recent Tickets</h4>
                    </div>
                    <div class="hide-scroll-parent">
                        <div class="hide-scroll-child">
                            <table class="table card-table">
                                <tbody>
                                <?php foreach ($this->updated as $updated_ticket): ?>
                                    <tr>
                                        <td>
                                            <a href="<?php echo base_url("ticket/view/{$updated_ticket->ticket_id}") ?>" class="text-inherit"><?php echo $updated_ticket->title ?></a>
                                            <div class="small text-muted"><?php echo get_status_label($updated_ticket->status_id) ?> &middot; Last updated <?php echo time_elapsed_string($updated_ticket->updated_at) ?></div>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="title o-auto title-guest">
                <svg class="mt-9" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="32" height="32" viewBox="0 0 32 32">
                    <g>
                    </g>
                    <path d="M17.927 12l2.68-10.28c0.040-0.126 0.060-0.261 0.060-0.4 0-0.726-0.587-1.32-1.314-1.32-0.413 0-0.78 0.187-1.019 0.487l-13.38 17.353c-0.18 0.227-0.287 0.513-0.287 0.827 0 0.733 0.6 1.333 1.333 1.333h8.073l-2.68 10.28c-0.041 0.127-0.060 0.261-0.060 0.4 0.001 0.727 0.587 1.32 1.314 1.32 0.413 0 0.78-0.186 1.020-0.487l13.379-17.353c0.181-0.227 0.287-0.513 0.287-0.827 0-0.733-0.6-1.333-1.333-1.333h-8.073z"></path>
                </svg>
                <h2 class="mt-2"><a href="<?php echo base_url() ?>">tintin</a></h2>
                <div class="menu-guest"><a href="<?php echo base_url('user/login') ?>">Log In</a> | <a href="<?php echo base_url('user/signup') ?>">Sign Up</a></div>
                <nav class="mt-9">
                    <ul>
                        <li><a href="<?php echo base_url() ?>">Home</a></li>
                        <li><a href="<?php echo base_url('ticket/new') ?>">Features</a></li>
                        <li><a href="<?php echo base_url('ticket/all') ?>">Screenshots</a></li>
                        <li><a href="">About</a></li>
                    </ul>
                </nav>
            </div>
        <?php endif ?>
    </div>
    <div class="main">