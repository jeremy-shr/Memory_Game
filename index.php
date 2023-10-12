<?php
session_start();

if (isset($_SESSION['username'])) {
?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const welcomeMessage = document.getElementById('register');
        welcomeMessage.innerHTML = '<a href="leaderboard.php" class="nav-link">Leaderboard</a>';
        playBtn = document.getElementById('play-button')
        playBtn.style.visibility = "visible";
        updateNavEmoji();
    });

    function updateNavEmoji() {
        let emoji = document.querySelector(".navEmoji")
        let userId = "<?php echo $_SESSION['avatarId']; ?>";
        const avHead = document.getElementById('colour-preview');
        const avEyes = document.getElementById('eyes-preview');
        const avMouth = document.getElementById('mouth-preview');

        const eyes = ["normal", "closed", "laughing", "long", "rolling", "winking"];
        const mouths = ["open", "sad", "smiling", "straight", "surprise", "teeth"];
        const skins = ["yellow", "green", "red"];
        avHead.src = `assets/emoji/skin/${skins[userId[0]]}.png`;
        avEyes.src = `assets/emoji/eyes/${eyes[userId[1]]}.png`;
        avMouth.src = `assets/emoji/mouth/${mouths[userId[2]]}.png`;
        emoji.style.visibility = "visible";
    }
</script>
<?php
} else {
    ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        playBtn = document.getElementById('play-button')
        playBtn.remove()
        const text = document.getElementById('sign-in-prompt');
        text.innerHTML = "You're not using a registered session? <a href=\"registration.php\">Register now!</a>";
    });
</script>
<?php
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <header class="d-flex flex-wrap justify-content-between py-3">
            <div class="col-2">
                <ul class="nav nav-pills">
                    <li class="nav-item" name="home"><a href="index.php" class="nav-link active"
                            aria-current="page">Home</a></li>
                    <li class="navEmoji mx-3">
                        <img id="colour-preview" src="assets/emoji/skin/yellow.png">
                        <img id="eyes-preview" src="assets/emoji/eyes/normal.png">
                        <img id="mouth-preview" src="assets/emoji/mouth/open.png">
                    </li>
                </ul>
            </div>
            <div class="col-10">
                <ul class="nav nav-pills justify-content-end">
                    <li class="nav-item" name="memory"><a href="pairs.php" class="nav-link">Play Pairs</a></li>
                    <li id="register" class="nav-item" name="register"><a href="registration.php"
                            class="nav-link">Register</a></li>
                </ul>
            </div>
        </header>
    </div>

    <div id="main">
        <div class="content rounded">
            <h1 class="p-3 rounded">Welcome To Pairs</h1>
            <p id="sign-in-prompt">
            </p>
            <a href="pairs.php" id="play-button" style="visibility:hidden"><button class="btn btn-primary btn-lg glow-button mb-3">Click here to play!</button></a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
</body>

</html>