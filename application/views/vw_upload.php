<!DOCTYPE html>
<html lang ="en">
    <head>
        <meta charset ="UTF-8">
        <meta name ="viewport" content ="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie-edge">
            
    </head>
    
    <body>
        <h2>Fájl feltöltése</h2>
        <form action="upload_file" method="post" enctype="multipart/form-data">
            <input type="file" name="image" id="image">
            <input type="submit" value="Feltöltés">
        </form>

    </body
    
    <?php if(!empty($files)){ foreach($files as $frow){ ?>
<div class="file-box">
    <div class="box-content">
        <h5><?php echo $frow['title']; ?></h5>
        <div class="preview">
            <embed src="<?php echo base_url().'uploads/files/'.$frow['file_name']; ?>">
        </div>
        <a href="<?php echo base_url().'files/download/'.$frow['id']; ?>" class="dwn">Download</a>
    </div>
</div>
<?php } } ?>
    
</html>