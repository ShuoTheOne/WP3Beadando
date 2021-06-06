<h1><?=$title?></h1>
<h2>Id</h2>
<p><?=$record->id?></p>
<h2>Building id</h2>
<p><?=$record->buildings_id?></p>
<h2>Book number</h2>
<p><?=$record->booknumber?></p>
<h2>Name</h2>
<p><?=$record->name?></p>
<h2>Description</h2>
<p><?=($record->description == NULL ? 'No description' : $record->description) ?></p>
<h2>Active</h2>
<p><?=($record->active == 1 ? 'Active record' : 'Inactive record') ?></p>

<?php echo anchor(base_url('books/list'), 'Vissza a listához');?>