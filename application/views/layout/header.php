<!DOCTYPE html>
<html lang="en">
<head>
	<title><?php echo $page_title; ?> - Cloudlog</title>

	<!-- CSS Files -->
	<link href="<?php echo base_url(); ?>assets/css/bootstrap.css" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo base_url();?>css/main.css" type="text/css" />
	
	<!-- Javascript -->
	<script src="<?php echo base_url(); ?>assets/js/jquery.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/bootstrap-dropdown.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/bootstrap-tab.js"></script>
	
	<script type="text/javascript" src="<?php echo base_url(); ?>js/global.js"></script>
	<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=true"></script>
	
	<!-- Sticky Footer IE -->
	<!--[if !IE 7]>
	<style type="text/css">
		#wrap {display:table;height:100%}
	</style>
	<![endif]-->
	
	<!-- Theming Code Goes Here -->
	
	<!-- Icons -->
	<link rel="icon" href="<?php echo base_url(); ?>/CloudLog.ico" type="image/x-icon" /> 
	<link rel="shortcut icon" href="<?php echo base_url(); ?>/CloudLog.ico" type="image/x-icon" />
	
	<style type="text/css" media="screen">
		.content {
			margin-top: 50px;
		}
	</style>
	
</head>

<body> 

	<!-- Header -->

<div class="navbar navbar-inverse navbar-fixed-top">
	<div class="navbar-inner">
		<div class="container">
			<a class="brand" href="<?php echo site_url(); ?>">Cloudlog</a>
			<ul class="nav">
				<li class="active"><a href="<?php echo site_url('logbook');?>" title="Logbook">Logbook</a></li>
			
				<?php if(($this->config->item('use_auth') && ($this->session->userdata('user_type') >= 2)) || $this->config->item('use_auth') === FALSE) { ?>
					<!-- QSOs Dropdown -->	
					<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">QSOs <b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li><a href="<?php echo site_url('qso');?>" title="qso">Live QSOs</a></li>
							<li class="divider"></li>
							<li><a href="<?php echo site_url('qso/manual');?>" title="Notes">Post QSOs</a></li>
						</ul>
					</li>
				<?php } ?>
				
				<?php if(($this->config->item('use_auth') && ($this->session->userdata('user_type') >= 2)) || $this->config->item('use_auth') === FALSE){ ?>
					<!-- Notes Dropdown -->	
					<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">Notes <b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li><a href="<?php echo site_url('notes');?>" title="Notes">View Notes</a></li>
							<li class="divider"></li>
							<li><a href="<?php echo site_url('notes/add');?>" title="Notes">Create Note</a></li>
						</ul>
					</li>
				<?php } ?>
				
				
				<?php if(($this->config->item('use_auth') && $this->session->userdata('user_type') >= 99) || $this->config->item('use_auth') === FALSE) { ?>
					<!-- Tools Dropdown -->	
					<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">Tools <b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li><a href="<?php echo site_url('statistics');?>" title="Statistics">Statistics</a></li>
							<li><a href="<?php echo site_url('dxcluster');?>" title="DX Cluster">Cluster</a></li>
							<li><a href="<?php echo site_url('awards');?>" title="">Awards</a></li>
						</ul>
					</li>
					
					<!-- Admin Dropdown -->	
					<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">Admin <b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li><a href="<?php echo site_url('user');?>" title="Users">Users</a></li>
							<li><a href="<?php echo site_url('radio');?>" title="Backup">Radios</a></li>
							<li><a href="<?php echo site_url('backup');?>" title="Backup">Backup</a></li>
							<li><a href="<?php echo site_url('adif/import');?>" title="ADIF Import">ADIF Import</a></li>
							<!-- <li><a href="<?php echo site_url('adif/export');?>" title="ADIF Export">ADIF Export</a></li> -->
							<li><a href="<?php echo site_url('export');?>" title="Data Export">Data Export</a></li>
							<li><a href="<?php echo site_url('api/help');?>" title="API">API</a></li>
							<li><a href="<?php echo site_url('lotw/import');?>" title="LoTW Import">LoTW Import</a></li>
							<li><a href="<?php echo site_url('lotw/export');?>" title="LoTW Export">LoTW Export</a></li>
						</ul>
					</li>
				<?php } ?>
				
				<form class="navbar-form pull-left" method="post" action="<?php echo site_url('search'); ?>"><input type="text" name="callsign" placeholder="Search Callsign"></form>
				
				<?php if(($this->config->item('use_auth')) && ($this->session->userdata('user_type') >= 2)) { ?>
					<li class="dropdown pull-right">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">Logged in as <?php echo $this->session->userdata('user_callsign'); ?> <b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li><a href="<?php echo site_url('user/profile');?>" title="Profile">Profile</a></li>
							<li><a href="<?php echo site_url('user/logout');?>" title="Logout">Logout</a></li>
						</ul>
					</li>
				<?php } else { ?>
					<form method="post" action="<?php echo site_url('user/login'); ?>" class="navbar-form">
						<input class="input-small" type="text" name="user_name" placeholder="Username">
						<input class="input-small" type="password" name="user_password" placeholder="Password">
						<input type="hidden" name="id" value="<?php echo $this->uri->segment(3); ?>" />
						<button class="btn" type="submit">Sign in</button>
					</form>
				<?php } ?>
			  
			</ul>
		</div>
	</div>
</div>
