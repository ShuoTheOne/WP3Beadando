<?php echo form_open(); ?>

<?php echo form_input
(
        ['type'=>'text', 'name' => 'library_name'],
        '',
        ['style'=>'color:red','placeholder'=>'Library name'] // ha például osztályhoz akarom hozzárendelni ,vagy stílushoz akkor ez az extra paraméter kell
)
?>
<br/>
<?php echo form_textarea
(
        ['name'=>'library_name'],
        '',
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