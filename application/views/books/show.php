<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

</head>

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