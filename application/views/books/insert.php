<?php echo form_open(); ?>

<?php echo form_error('booknumber')?>
<?php echo form_input(['type' => 'text', 'name' => 'booknumber'],set_value('booknumber',''),['placeholder' => 'Könyv kód']); ?><br/>
<?php echo form_error('name')?>
<?php echo form_input(['type' => 'text', 'name' => 'name'],set_value('name',''),['placeholder' => 'Név']); ?><br/>
<?php echo form_error('description')?>
<?php echo form_textarea(['name' => 'description'], set_value('description',''), ['cols' => 10, 'rows' => 5, 'placeholder' => 'Leírás']); ?><br/>
<?php echo form_error('active')?>
<?php echo form_dropdown(['name' => 'active'], $status); ?><br/>
<?php echo form_error('buildings_id')?>
<?php echo form_dropdown(['name' => 'buildings_id'], $buildings);?><br/>
<?php echo form_button(['type' => 'submit', 'name' => 'submit'], 'Mentés'); ?>

<?php echo form_close(); ?>

<?php echo anchor(base_url('books/list'), 'Vissza a listához');?>