<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);
    // Add the username to the data

    // Get the current scores from the JSON file
    $json_file = file_get_contents('scores.json');
    $scores = json_decode($json_file, true);
    // Add the new score to the scores array
    $scores['users'][] = $data;
    // Save the updated scores to the JSON file
    file_put_contents('scores.json', json_encode($scores));
}

$json = file_get_contents('scores.json');

// Decode the JSON data into an associative array
$fullData = json_decode($json, true);
$name = $_SESSION['username'];
$users = json_encode($fullData['users']);
file_put_contents('scores.json', json_encode($fullData));
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leaderboard</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <header class="d-flex flex-wrap justify-content-between py-3">
            <div class="col-2">
                <ul class="nav nav-pills">
                    <li class="nav-item" name="home"><a href="index.php" class="nav-link">Home</a></li>
                    <li class="navEmoji" style="visibility:visible">
                        <img id="colour-preview" src="assets/emoji/skin/yellow.png">
                        <img id="eyes-preview" src="assets/emoji/eyes/normal.png">
                        <img id="mouth-preview" src="assets/emoji/mouth/open.png">
                    </li>
                </ul>
            </div>
            <div class="col-10">
                <ul class="nav nav-pills justify-content-end">
                    <li class="nav-item" name="memory"><a href="pairs.php" class="nav-link">Play Pairs</a></li>
                    <li class="nav-item" name="leaderboard"><a href="leaderboard.php" class="nav-link active"
                            aria-current="page">Leaderboard</a>
                    </li>
                </ul>
            </div>
        </header>
    </div>

    <div id="main">

        <table class="table table-striped table-bordered">
            <thead>
                <tr class="bg-primary text-white">
                    <th scope="col">#</th>
                    <th scope="col">Score</th>
                    <th scope="col">User</th>
                    <th scope="col">Time Taken (s)</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
    <script>
        function getSortedUsersByScore(usersObj) {
            // Sort users by score in ascending order
            usersObj.sort((a, b) => a.score - b.score);

            return usersObj;
        };
        usersNew = JSON.parse('<?php echo $users; ?>');
        console.log(usersNew)
        const userList = getSortedUsersByScore(usersNew);
        console.log('This is the user list:')
        console.log(userList);

        let leaderboard = document.querySelector('.table tbody')
        console.log(<?php $name; ?>)
        userId = "<?php echo $_SESSION['avatarId']; ?>";
        console.log(userId)

        // Taking only the top 10 scores
        if (userList.length > 10) userList.length = 10;

        for (i = 0; i < userList.length; i++) {
            let row = document.createElement('tr');
            let num = document.createElement('th');
            row.classList.add('bg-secondary');
            num.attributes.scope = "row";
            num.innerHTML = i + 1;
            let userScore = document.createElement('td');
            userScore.innerHTML = userList[i].score;
            let username = document.createElement('td');
            username.innerHTML = userList[i].name;
            let userTime = document.createElement('td');
            userTime.innerHTML = userList[i].time;

            row.appendChild(num);
            row.appendChild(userScore);
            row.appendChild(username);
            row.appendChild(userTime);

            leaderboard.appendChild(row);
        }
        const avHead = document.getElementById('colour-preview');
        const avEyes = document.getElementById('eyes-preview');
        const avMouth = document.getElementById('mouth-preview');

        const eyes = ["normal", "closed", "laughing", "long", "rolling", "winking"];
        const mouths = ["open", "sad", "smiling", "straight", "surprise", "teeth"];
        const skins = ["yellow", "green", "red"];

        if (userId !== "") {
            avHead.src = `assets/emoji/skin/${skins[userId[0]]}.png`;
            avEyes.src = `assets/emoji/eyes/${eyes[userId[1]]}.png`;
            avMouth.src = `assets/emoji/mouth/${mouths[userId[2]]}.png`;
        }

    </script>
</body>

</html>