<h1><?=$title?></h1>
<h2>Id</h2>
<p><?=$record->id?></p>
<h2>Book id</h2>
<p><?=$record->books_id?></p>
<h2>Catalog number</h2>
<p><?=$record->catalognumber?></p>
<h2>Name</h2>
<p><?=$record->name?></p>
<h2>Description</h2>
<p><?=($record->description == NULL ? 'No description' : $record->description) ?></p>
<h2>Active</h2>
<p><?=($record->active == 1 ? 'Active record' : 'Inactive record') ?></p>

<?php echo anchor(base_url('catalogs/list'), 'Vissza a listához');?>