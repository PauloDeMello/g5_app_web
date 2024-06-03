<head>     
    <link rel="manifest" href="/manifest.json" crossorigin="use-credentials">
    <link rel="stylesheet" href="/css/bootstrap.css">

    <script>
         if ("serviceWorker" in navigator) {
            navigator.serviceWorker
                .register("/service-worker.js")
                .then((registration) => {
                    registration.addEventListener("updatefound", () => {
                        // If updatefound is fired, it means that there's
                        // a new service worker being installed.
                        const installingWorker = registration.installing;
                        console.log(
                            "A new service worker is being installed:",
                            installingWorker,
                        );

                        // You can listen for changes to the installing service worker's
                        // state via installingWorker.onstatechange
                    });
                })
                .catch((error) => {
                    console.error(`Service worker registration failed: ${error}`);
                });
        } else {
            console.error("Service workers are not supported.");
        }
    </script>
</head>


<body>
   <style> .navbar-brand {font-family: edo-sz} </style>
    <div>    
    <header class="navbar navbar-expand-md navbar-dark bd-navbar border-bottom border-top border-light" style="z-index: 1000; top: 0px; width: 100%; position: fixed; background-color: #191c1e;">
    <nav class="container-xxl flex-wrap flex-md-nowrap" aria-label="Main navigation">
    <a class="navbar-brand">
    <img src="/images/g5-logo-crop.webp" width="45" height="45" alt=""></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="true" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon" > </span>
    </button>
        <div class="navbar-collapse collapse" id="navbarNav">
            <ul class="navbar-nav flex-row flex-wrap bd-navbar-nav pt-2 py-md-0">
            <li class="nav-item col-6 col-md-auto">
                <a class="nav-link" href="home">Home</a>
            </li>
            <li class="nav-item col-6 col-md-auto">
                <a class="nav-link" href="profile">Profile</a>
            </li>
            <li class="nav-item col-6 col-md-auto">
                <a class="nav-link" href="syllabus">Syllabus</a>
            </li>
            </ul>
            <hr class="d-md-none text-white-50">
            <ul class="navbar-nav flex-row flex-wrap bd-navbar-nav pt-2 py-md-0 ms-md-auto">
            <li class="nav-item col-6 col-md-auto">
                <a class="nav-link " href="settings">Settings</a>
            </li>
            <li class="nav-item col-6 col-md-auto">
                <a class="nav-link " href="logout">Logout</a>
            </li>
            </ul>
            <br>
        </div>
    </nav>
    </header>
    </div>
<script>
    /* Toggle between adding and removing the "responsive" class to topnav when the user clicks on the icon */
    function myFunction() 
    {
        var x = document.getElementById("myTopnav");
        if (x.className === "topnav") {
            x.className += " responsive";
        } else 
        {
            x.className = "topnav";
        }        
    }
</script>
 <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="/js/jquery-3.2.1.slim.min.js"></script>
    <script src="/js/popper.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    
</body