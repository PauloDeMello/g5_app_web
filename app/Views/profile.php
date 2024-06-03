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
  <div class="container py-0" style="display: inline-block align-items: center;">
    <div class="media col-md-10 col-lg-8 col-xl-7 p-0 my-4 mx-auto" style="display: flex; align-items: center;">
    <div container style="margin: auto; display: flex; align-items: center; gap: 1em;">
      <img id=profile_picture class="img-thumbnail" width="100" height="100" style="border-radius: 50%;"></img>
      <h4 id=name style="margin-top: 0; margin-bottom: 0; text-align: center; font-weight: normal;"></h4>
      <img id=belt class="img-thumbnail" width="100" height="100" src="/images/belts/Purple.png" style="background-color: transparent; border-radius: 50%;"></img>
      </div>
    </div>
    </div>
    <hr>
  </body>
</html>