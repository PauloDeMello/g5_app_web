<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/general.css">

    <title>Syllabus</title>

    <script type="text/javascript" src="js/infoGetter.js"></script>
    <script> 

      var profileJsonPromise = GetJson("profile"); 
      profileJsonPromise.then((data) => {
        UpdateProfilePageElements(data);
      });

      var profileImagePromise = GetImage("profile_picture"); 
      profileImagePromise.then((data) => {
      UpdateProfilePicElement(data);
      });
      
    </script>
</head>
<body> 
  <div class="container">
    <div class="thumbnail_wrapper">
    <img id=profile_picture alt="\public\images\apple-icon-180.png" class="img-thumbnail" style="vertical-align: middle;" ></img>
    <?php foreach ($errors as $error): ?>
      <li><?= esc($error) ?></li>
    <?php endforeach ?>
  </div>
    <div class="dropdown">
    <div class="thumbnail_wrapper">
    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" style="display: flex; justify-content: center;"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      Change Profile Picture
    </button>
    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
      <?= form_open_multipart('profile/upload'); ?>
          <input type="file" name="userfile">
          <br><br>
          <input type="submit" value="upload">
          <br><br>
        </div>
    </div>
  </div>
    <h1 id=name style="margin: auto;"></h1>
  </div>
</body>
</html>