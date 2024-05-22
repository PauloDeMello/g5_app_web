<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/bootstrap.css">
    <link rel="stylesheet" href="/css/general.css">
    <title>Announcements</title>
</head>

<body>
    <div class="topnav" id="myTopnav">
        <a href="admin">Home</a>
        <a href="logout">Logout</a>
    </div>
    <h1> Hi Admin </h1>
    <div class="container d-flex justify-content-center p-5">
        <div class="card col-12 col-md-5 shadow-sm">
            <div class="card-body">
            <h5 class="card-title mb-5"><?= "Post Announcement" ?></h5>
        
        <!-- TODO: add session message for successful post -->
        <?php if (session('message') !== null) : ?>
            <div class="alert alert-success" role="alert"><?= session('message') ?></div>
        <?php endif ?>
        <form action="announcements" method="POST">
        <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingTitleInput" name="title" inputmode="text" placeholder="Title" required>
                        <label for="floatingTitleInput">Title</label>
                    </div>

                    <!-- Password -->
                    <div class="form-floating mb-3">
                        <textarea class="form-control" id="floatingMessageInput" name="message" rows="4" placeholder="Message" required></textarea>
                        <label for="floatingMessageInput">Message</label>
                    </div>
        <input type="submit" class="btn btn-primary" name="submit" value="Post">
    </div>
</div>
</div>
</body