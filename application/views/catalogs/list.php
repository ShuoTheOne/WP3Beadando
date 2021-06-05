<h1><?=$title?></h1>

<?php if($records == null || empty($records)): ?>
    <p>Nincs rögzítve egyetlen katalógus sem</p>
<?php else: ?>
    <table>
        <thead>
            <tr>
                <th>Könyv neve</th>
                <th>Katalógus kódja</th>
                <th>Katalógus neve</th>
                <th>Műveletek</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($records as $record): ?>
            <tr>
                <td> <?=$record->books_name?> </td>
                <td> <?=$record->catalognumber?> </td>
                <td> <?=$record->name?> </td>
                <td>
                    <?php echo anchor(base_url('catalogs/list/'.$record->id), 'Részletek'); ?>
                    <?php echo anchor(base_url('catalogs/delete/'.$record->id), 'Törlés'); ?>
                    <?php echo anchor(base_url('catalogs/update/'.$record->id), 'Szerkesztés'); ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    
    <p>Lekérdezett rekordok: <?=count($records)?></p>
    
<?php endif; ?>

