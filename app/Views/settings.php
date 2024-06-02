<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/general.css">
    <title>Home</title>

    <body>


  </div>
  <div class="container d-flex justify-content-center p-5">
        <div class="card col-12 col-md-5 shadow-sm">
            <div class="card-body">
                <h5 class="card-title mb-5"><?= "Settings" ?></h5>
                <hr>
        <h6> Change profile picture: </h6>

      <?= form_open_multipart('settings/upload'); ?>
          <input type="file" name="userfile" style="float: left; display: inline-block;">
          <input type="submit" value="upload" style="float: right; display: inline-block;">
        </div> 

        <?php if (session('error') !== null) : ?>
          <div class="alert alert-danger" role="alert"><?= session('error') ?></div>
            <?php elseif (session('errors') !== null) : ?>
                <div class="alert alert-danger" role="alert">
                    <?php if (is_array(session('errors'))) : ?>
                        <?php foreach (session('errors') as $error) : ?>
                            <?= $error ?>
                            <br>
                        <?php endforeach ?>
                    <?php else : ?>
                        <?= session('errors') ?>
                    <?php endif ?>
                </div>
            <?php endif ?>

        <?php if (session('message') !== null) : ?>
                <div class="alert alert-success" role="alert"><?= session('message') ?></div>
                <?php endif ?> 
                <hr>
</div>
</div>
</body>
</head>