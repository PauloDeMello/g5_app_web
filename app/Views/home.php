<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/general.css">
    <title>Home</title>

    <script type="text/javascript" src="js/infoGetter.js"></script>
    <script> 

      var infoJsonPromise = GetJson("info"); 
      infoJsonPromise.then((data) => {
        UpdateHomePageInfo(data);
      });

    </script>

    <script type="text/javascript" src="js/infoGetter.js"></script>
    <script> 

      var AnnouncementsJsonPromise = GetJson("announcements"); 
      AnnouncementsJsonPromise.then((data) => {
        UpdateHomePageAnnouncements(data);
      });

    </script>
</head>

<body>
<div class="container py-0" style="display: inline-block align-items: center;">
    <div class="media col-md-10 col-lg-8 col-xl-7 p-0 my-4 mx-auto" style="display: flex; align-items: center;">
      <div container="" style="margin: auto; display: flex; align-items: center; gap: 1em;">
        <h4 id="name" style="text-align: center;"></h4>
        <img id=belt class="img-thumbnail" width="70" height="70" src="/images/belts/Purple.png" style="background-color: transparent; border-radius: 50%;"></img>
      </div>
    </div>
</div>

    <hr>
    <div class="col-md-6" style="margin: auto; width: 80%;">
      <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
        <div class="col p-4 d-flex flex-column position-static">
          <h3 id="ATitle"></h3> 
          <hr>
          <text id="AMessage"></text>
          <hr>
          <h7 id="ADate"></h7>
        </div>
      </div>
    </div>
</body>
</html>