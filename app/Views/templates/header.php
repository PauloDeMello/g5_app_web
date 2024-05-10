<style>
    <?php include 'navbar.css'; ?>
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<body>
<   div> <link rel="manifest" href="/manifest.json"  crossorigin="use-credentials"/> <div>
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