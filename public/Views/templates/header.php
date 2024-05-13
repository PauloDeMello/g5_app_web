<head>     
    <link rel="manifest" href="/manifest.json" crossorigin="use-credentials">
    <link rel="stylesheet" href="/css/navbar.css">

    <script>
        if ('serviceWorker' in navigator) {
        }
    </script>
</head>


<body>

   <div class="topnav" id="myTopnav">
    <a href="home">Home</a>
    <a href="syllabus">Syllabus</a>
    <a href="logout">Logout</a>
    <a href="javascript:void(0);" class="icon" onclick="myFunction()">
        <i class="fa fa-bars"></i>
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