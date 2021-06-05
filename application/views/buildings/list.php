<h1><?=$title?></h1>

<?php if($records == null || empty($records)): ?>
    <p>Nincs rögzítve egyetlen épület sem</p>
<?php else: ?>
    <table>
        <thead>
            <tr> 
                <th>Könyvtár neve</th>
                <th>Épület kódja</th>
                <th>Épület neve</th>
                <th>Műveletek</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($records as $record): ?>
            <tr>
                <td> <?=$record->library_name?> </td>
                <td> <?=$record->kod?> </td>
                <td> <?=$record->name?> </td>
                <td>
                    <?php echo anchor(base_url('buildings/list/'.$record->id), 'Részletek'); ?>
                    <?php echo anchor(base_url('buildings/delete/'.$record->id), 'Törlés'); ?>
                    <?php echo anchor(base_url('buildings/update/'.$record->id), 'Szerkesztés'); ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    
    <p>Lekérdezett rekordok: <?=count($records)?></p>
    
<?php endif; ?>

