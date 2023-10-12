<?php
session_start();
?>
<script>
avatarId = "";
</script>
<?php

if (isset($_SESSION['username'])) {

?>
<script>
    document.addEventListener('DOMContentLoaded', updateHeader);
    function updateHeader() {
        const headerElement = document.getElementById('register');
        headerElement.innerHTML = '<a href="leaderboard.php" class="nav-link">Leaderboard</a>';
        const submitBtn = document.getElementById('submit-score');
        submitBtn.disabled = false;
        username = "<?php echo $_SESSION['username']; ?>";
        avatarId = "<?php echo $_SESSION['avatarId']; ?>";
        console.log(avatarId)
        updateNavEmoji();
    }
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
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Play Pairs</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
</head>

<body>
    <div class="container">
        <header class="d-flex flex-wrap justify-content-between py-3">
            <div class="col-2">
                <ul class="nav nav-pills">
                    <li class="nav-item" name="home"><a href="index.php" class="nav-link">Home</a></li>
                    <li class="navEmoji mx-3">
                        <img id="colour-preview" src="assets/emoji/skin/yellow.png">
                        <img id="eyes-preview" src="assets/emoji/eyes/normal.png">
                        <img id="mouth-preview" src="assets/emoji/mouth/open.png">
                    </li>
                </ul>
            </div>
            <div class="col-10">
                <ul class="nav nav-pills justify-content-end">
                    <li class="nav-item" name="memory"><a href="pairs.php" class="nav-link active"
                            aria-current="page">Play Pairs</a></li>
                    <li class="nav-item" name="register" id="register"><a href="registration.php"
                            class="nav-link">Register</a></li>
                </ul>
            </div>
        </header>
    </div>

    <div id="main">
        <button id="start-game" class="btn btn-primary p-3" onclick="setupGame()">
            <h1>Start the Game</h1>
        </button>
        <div id="gameover" class="gameover rounded p-4">
            <h1>You Win!</h1>
            <p>Time taken: Attempts: <b>Total score: </b></p>


            <div class="buttons pb-3">
                <button id="try-again" class="btn btn-secondary p-3" onclick="setupGame()">
                    <h3>Try Again</h3>
                </button>
                <button type="submit" id="submit-score" class="btn btn-secondary p-3" disabled>
                    <h3>Submit Score</h3>
                </button>
            </div>
            <p style="white-space: pre;">Scores per level:
Level 1: <b id="level1">0</b>
Level 2: <b id="level2">0</b>
Level 3: <b id="level3">0</b>
Level 4: <b id="level4">0</b>
            </p>
        </div>
        <div id="gameboard" class="rounded">
            <ul id="stats" class="p-0 m-0">
                <il class="level p-2">Level: <b>1</b></il>
                <il class="attempts p-2">Attempts: <b>0</b></il>
                <il class="time p-2">Time: <b>0</b>s</il>
            </ul>
            <ul id="wrapper" class="cards m-0">
            </ul>
        </div>
    </div>

    <script src="pairs.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>

</body>

</html>