<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

</head>

<?php echo form_open(); ?>

<?php echo form_error('catalognumber')?>
<?php echo form_input(['type' => 'text', 'name' => 'catalognumber'],set_value('catalognumber',''),['placeholder' => 'Katalógus száma']); ?><br/>
<?php echo form_error('name')?>
<?php echo form_input(['type' => 'text', 'name' => 'name'],set_value('name',''),['placeholder' => 'Név']); ?><br/>
<?php echo form_error('description')?>
<?php echo form_textarea(['name' => 'description'], set_value('description',''), ['cols' => 10, 'rows' => 5, 'placeholder' => 'Leírás']); ?><br/>
<?php echo form_error('active')?>
<?php echo form_dropdown(['name' => 'active'], $status); ?><br/>
<?php echo form_error('books_id')?>
<?php echo form_dropdown(['name' => 'books_id'], $books);?><br/>
<?php echo form_button(['type' => 'submit', 'name' => 'submit'], 'Mentés'); ?>

<?php echo form_close(); ?>

<?php echo anchor(base_url('catalogs/list'), 'Vissza a listához');?>