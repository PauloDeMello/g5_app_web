<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="/css/bootstrap.css">
    <link rel="stylesheet" href="/css/general.css">

    <title>Profile</title>

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
    <img id=profile_picture class="img-thumbnail" style="vertical-align: middle;" width="100" height="100"></img>
    </div>
    <h1 id=name style="margin: auto;"></h1>
  </div>
</body>
</html>