<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

</head>

<?php echo validation_errors(); ?> 
<?php echo form_open(); ?>

<?php echo form_input
(
        ['type'=>'text', 'name' => 'buildings_name'/*, 'required'=>'required', 'minlength'=>2*/], //típus
        set_value('buildings_name',$record->name), //alapérték
        ['style'=>'color:blue','placeholder'=>'buildings name'] // ha például osztályhoz akarom hozzárendelni ,vagy stílushoz akkor ez az extra paraméter kell
)
?>
<br/>
<?php echo form_textarea
(
        ['type'=>'text', 'name'=>'buildings_description'],
        set_value('buildings_description',$record->description),
        ['placeholder'=>'Building description']
);
?>
<br/>

<?php
echo form_dropdown
(
        ['name' => 'buildings_active'],
        $status,
        [ $record->active]
);
?>

<br/>
<?php echo form_button
(
    ['type'=>'submit','name'=>'save'],
        'Save'
);
?>

<?php echo form_close(); ?>

<?php echo anchor(base_url('buildings/list'), 'Vissza az épület listához');?>