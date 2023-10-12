<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validate input
    $username = $_POST['username'];
    // perform validation, e.g. check if username is not empty or already exists in a database
    $valid = checkInput();
    if ($valid) {
        $_SESSION['username'] = $username;
        $_SESSION['avatarId'] = json_decode($_POST['avatarId']);
    } else {
        $error = "Invalid username";
    }
}

function checkInput() {
    $username = $_POST['username'];
    $forbidden_characters = array('!', '@', '#', '%', '&', '*', '(', ')', '+', '=', '^', '{', '}', '[', ']', '—', ';', ':', '“', '’', '<', '>', '?', '/');
    foreach ($forbidden_characters as $character) {
        if (strpos($username, $character) !== false) {
            return false;
        }
    }
    return true;
}
?>

<script>
    userId = "";
</script>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
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
                    <li class="nav-item" name="home"><a href="index.php" class="nav-link ">Home</a></li>
                </ul>
            </div>
            <div class="col-10">
                <ul class="nav nav-pills justify-content-end">
                    <li class="nav-item" name="memory"><a href="pairs.php" class="nav-link">Play Pairs</a></li>
                    <li class="nav-item" name="register"><a href="registration.php" class="nav-link active"
                            aria-current="page">Register</a></li>
                </ul>
            </div>
        </header>
    </div>

    <div id="main">
        <div class="content rounded text-center p-4">
            <form onsubmit="return checkInput()">
                <div class="form-group">
                    <label for="exampleInputEmail1" class="h2">Register & Build an Avatar</label>
                    <input type="username" class="form-control mt-3 mb-1" name = "username"id="username" placeholder="Enter username...">
                    <div id="error-message" class="text-danger"></div>
                </div>
                <div class="avatar-container">
                    <div id="avatar-preview">
                        <img id="colour-preview" src="assets/emoji/skin/yellow.png">
                        <img id="eyes-preview" src="assets/emoji/eyes/normal.png">
                        <img id="mouth-preview" src="assets/emoji/mouth/open.png">
                    </div>
                    <div class="avatar-selector">
                        <div id="colour-selector">
                            <button type="button" class="material-symbols-outlined btn btn-secondary btn-sm">
                                chevron_left
                            </button>
                            <p>Colour</p>
                            <button type="button" class="material-symbols-outlined btn btn-secondary btn-sm">
                                chevron_right
                            </button>
                        </div>

                        <div id="eyes-selector">
                            <button type="button" class="material-symbols-outlined btn btn-secondary btn-sm">
                                chevron_left
                            </button>
                            <p>Eyes</p>
                            <button type="button" class="material-symbols-outlined btn btn-secondary btn-sm">
                                chevron_right
                            </button>
                        </div>

                        <div id="mouth-selector">
                            <button type="button" class="material-symbols-outlined btn btn-secondary btn-sm">
                                chevron_left
                            </button>
                            <p>Mouth</p>
                            <button type="button" class="material-symbols-outlined btn btn-secondary btn-sm">
                                chevron_right
                            </button>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mt-3" >Submit</button>
        </div>

    </div>
    </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
    <script src="script.js"></script>
</body>

</html>