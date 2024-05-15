<head>     
    <link rel="manifest" href="/manifest.json" crossorigin="use-credentials">
    <link rel="stylesheet" href="/css/navbar.css">

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

   <div class="topnav" id="myTopnav">
    <a href="home">Home</a>
    <a href="syllabus">Syllabus</a>
    <a href="logout">Logout</a>
    <a href="javascript:void(0);" class="icon" onclick="myFunction()">
        <i class="gg-menu"></i>
    </a>
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

</body