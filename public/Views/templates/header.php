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
    <nav class="navbar navbar-expand-lg nav-fill w-80 navbar-dark" style="background-color: #191c1e;">
    <a class="navbar-brand">
    <img src="/images/g5-logo-crop.webp" width="55" height="55" alt=""></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="home">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="syllabus">Syllabus</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="logout">Logout</a>
            </li>
            </ul>
        </div>
    </nav>
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