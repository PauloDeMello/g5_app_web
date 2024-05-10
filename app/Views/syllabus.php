<style>
<?php include 'CSS/syllabus.css'; ?>
</style>

<?php
/*
echo "$name <br>";
echo "$beltName belt <br>";




foreach ($syllabus as $technique) {
    echo "$technique <br>";
  }
*/
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Syllabus</title>
</head>

  <body>
    <h1> Welcome <?= $name ?> : <?= $class ?> </h1>
    <div class="table-wrapper">
        <table class="fl-table">
            <thead>
            <tr>
                <th><?= $beltName ?> Belt Syllabus</th>
            </tr>
            </thead>
            <tbody>
              <?php foreach($syllabus as $technique): ?>
                <tr>
                    <td><?= $technique; ?></td>
                </tr>
              <?php endforeach; ?>
        </table>
    </div>
  </body>
</html>