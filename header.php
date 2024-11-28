<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/header.css">
    <title>Header</title>
</head>

<body>
    <div class="header">
        <img src="../img/logoghr.png" alt="Logo">
        <div class="progress-container">
            <div class="progress-bar" id="myBar"></div>
        </div>
        <input title="Logout no sistema!" class="sair" type="button" value="Sair" onclick="window.location.href='../index.php'">
    </div>


</body>
<script>
    window.onscroll = function() {
        myFunction()
    };

    function myFunction() {
        var winScroll = document.body.scrollTop || document.documentElement.scrollTop;
        var height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
        var scrolled = (winScroll / height) * 100;
        document.getElementById("myBar").style.width = scrolled + "%";
    }
</script>

</html>