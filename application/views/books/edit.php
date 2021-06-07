<?php echo validation_errors(); ?> 
<?php echo form_open(); ?>

<?php echo form_input
(
        ['type'=>'text', 'name' => 'books_name'/*, 'required'=>'required', 'minlength'=>2*/], //típus
        set_value('books_name',$record->name), //alapérték
        ['style'=>'color:blue','placeholder'=>'books name'] // ha például osztályhoz akarom hozzárendelni ,vagy stílushoz akkor ez az extra paraméter kell
)
?>
<br/>
<?php echo form_textarea
(
        ['type'=>'text', 'name'=>'books_description'],
        set_value('books_description',$record->description),
        ['placeholder'=>'Book description']
);
?>
<br/>

<?php
echo form_dropdown
(
        ['name' => 'books_active'],
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

<?php echo anchor(base_url('books/list'), 'Vissza a listához');?>