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

      var infoJsonPromise = GetInfoJson(); 
      infoJsonPromise.then((data) => {
        UpdateHomePageElements(data);
      });

    </script>
</head>

<body>
    <h1 id="name"> </h1>
</body>
</html>