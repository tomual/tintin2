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
		<div class="title">tintin</div>
        <div class="menu-guest"><a href="<?php base_url('login') ?>">Log In</a> | <a href="<?php base_url('signup') ?>">Sign Up</a></div>
        <div class="menu-authed"><a href="<?php base_url('tickets/user/tom3') ?>">Tom</a> | <a href="<?php base_url('logout') ?>">Log Out</a></div>
	</div>
	<div data-area="nav">
		<nav>
            <ul>
                <li><a href="">Home</a></li>
                <li><a href="">New Ticket</a></li>
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