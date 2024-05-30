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

      var syllabusJsonPromise = GetJson("syllabus"); 
      syllabusJsonPromise.then((data) => {
        UpdateSyllabusPageElements(data);
      });
      
    </script>
</head>
<body> 

  <?php foreach ($errors as $error): ?>
      <li><?= esc($error) ?></li>
  <?php endforeach ?>
  <?= helper('form'); ?>
  <?= form_open_multipart('profile/upload'); ?>
      <input type="file" name="userfile" size="20">
      <br><br>
      <input type="submit" value="upload">
  </form>
</body>
</html>