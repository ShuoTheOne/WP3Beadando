<h1><?=$title?></h1>
<?php echo anchor(base_url('library/insert'), 'Könyv beszúrása');?>
<?php if($records == null || empty($records)): ?>
    <p>Nincs rögzítve egyetlen könyvtár sem</p>
<?php else: ?>
    <table>
        <thead>
            <tr>
                <!-- <th>Azonosító</th> -->   
                <th>Név</th>
                <th>Műveletek</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($records as $record): ?>
            <tr>
                <!-- <td> <?=$record->id?> </td> --> 
                <td> <?=$record->name?> </td>
                <td>
                    <?php echo anchor(base_url('library/list/'.$record->id), 'Részletek'); ?>
                    <?php echo anchor(base_url('library/delete/'.$record->id), 'Törlés'); ?>
                    <?php echo anchor(base_url('library/update/'.$record->id), 'Szerkesztés'); ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    
    <p>Lekérdezett rekordok: <?=count($records)?></p>
    
<?php endif; ?>

<?php echo anchor(base_url('books/list'), 'Könyvek');?> <br/>
<?php echo anchor(base_url('buildings/list'), 'Épületek');?> <br/>
<?php echo anchor(base_url('catalogs/list'), 'Katalógusok');?> <br/>
