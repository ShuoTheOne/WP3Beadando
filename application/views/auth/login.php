<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

</head>

<h1><?php echo lang('login_heading');?></h1>
<p><?php echo lang('login_subheading');?></p>

<div id="infoMessage"><?php echo $message;?></div>

<?php echo form_open("auth/login");?>

  <p>
    <?php echo lang('login_identity_label', 'identity');?>
    <?php echo form_input($identity);?>
  </p>

  <p>
    <?php echo lang('login_password_label', 'password');?>
    <?php echo form_input($password);?>
  </p>

  <p>
    <?php echo lang('login_remember_label', 'remember');?>
    <?php echo form_checkbox('remember', '1', FALSE, 'id="remember"');?>
  </p>


  <p><?php echo form_submit('submit', lang('login_submit_btn'));?></p>

<?php echo form_close();?>

<p><a href="forgot_password"><?php echo lang('login_forgot_password');?></a></p>