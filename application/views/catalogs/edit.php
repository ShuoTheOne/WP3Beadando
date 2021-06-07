<?php echo validation_errors(); ?> 
<?php echo form_open(); ?>

<?php echo form_input
(
        ['type'=>'text', 'name' => 'catalogs_name'/*, 'required'=>'required', 'minlength'=>2*/], //típus
        set_value('catalogs_name',$record->name), //alapérték
        ['style'=>'color:blue','placeholder'=>'catalogs name'] // ha például osztályhoz akarom hozzárendelni ,vagy stílushoz akkor ez az extra paraméter kell
)
?>
<br/>
<?php echo form_textarea
(
        ['type'=>'text', 'name'=>'catalogs_description'],
        set_value('catalogs_description',$record->description),
        ['placeholder'=>'Catalog description']
);
?>
<br/>

<?php
echo form_dropdown
(
        ['name' => 'catalogs_active'],
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

<?php echo anchor(base_url('catalogs/list'), 'Vissza a listához');?>