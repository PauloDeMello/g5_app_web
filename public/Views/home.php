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
    <h1 id="name" ></h1>
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