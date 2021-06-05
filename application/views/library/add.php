
<?php echo validation_errors(); ?> 
<?php echo form_open(); ?>

<?php echo form_input
(
        ['type'=>'text', 'name' => 'library_name'/*, 'required'=>'required', 'minlength'=>2*/], //típus
        set_value('library_name',''), //alapérték
        ['style'=>'color:blue','placeholder'=>'Library name'] // ha például osztályhoz akarom hozzárendelni ,vagy stílushoz akkor ez az extra paraméter kell
)
?>
<br/>
<?php echo form_textarea
(
        ['type'=>'text', 'name'=>'library_description'],
        set_value('library_description',''),
        ['placeholder'=>'Library description']
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