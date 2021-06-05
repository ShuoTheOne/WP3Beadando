<h1><?=$title?></h1>

<?php if($records == null || empty($records)): ?>
    <p>Nincs rögzítve egyetlen könyv sem</p>
<?php else: ?>
    <table>
        <thead>
            <tr>  
                <th>Épület neve</th>
                <th>Könyv kódja</th>
                <th>Könyv neve</th>
                <th>Műveletek</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($records as $record): ?>
            <tr>
                <td> <?=$record->buildings_name?> </td>
                <td> <?=$record->booknumber?> </td>
                <td> <?=$record->name?> </td>
                <td>
                    <?php echo anchor(base_url('books/list/'.$record->id), 'Részletek'); ?>
                    <?php echo anchor(base_url('books/delete/'.$record->id), 'Törlés'); ?>
                    <?php echo anchor(base_url('books/update/'.$record->id), 'Szerkesztés'); ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    
    <p>Lekérdezett rekordok: <?=count($records)?></p>
    
<?php endif; ?>

