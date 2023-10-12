When VM is running, the game can be played at:
http://ml-lab-4d78f073-aa49-4f0e-bce2-31e5254052c7.ukwest.cloudapp.azure.com:55487/MemoryGame/index.php

## Features

Landing Page:
- Content shown depends on whether or not user is logged in (points to either the game or registration)

Registration Page:
- Username validity check
- Complex implementation (User selects avatar features from infinite carousel)
- Live avatar preview
- Creates session variables on POST for avatarid and username

Pairs Game:
- 4 levels of increasing difficulty
- More cards as you go on, player has to match groups of 3 and 4.
- Card emojis are randomised from features
- Card flipping animation on click
- Card shake animation on incorrect guess
- Music plays when start, ends when game over.
- Game board includes: level, timer (live), attempts
- Score = time taken (s) + 3 * (incorrect matching attempts)
- Lower score = better
- Lose condition: more than 30 attempts
- Background goes red for last 5 attempts 
- When player loses, they are shown losing screen, with score submit button disabled
- Total score is recorded and can be submitted upon win
- Scores for each level are stored and shown at end screen
- Submit button is disabled after 1 click to not crowd leaderboard
- Try again button
- Different end screens depending on win or loss

Leaderboard:
- Scores from past sessions recorded in json file (allows for multiple users)
- Table includes placement, score, time and username
- Only the 10 highest scores will be displayed

Global:
- Responsive
- All buttons have hover functionality
- Same visual theme throughout
- Navbar: When user session is registered, register becomes leaderboard and custom user avatar is shown
- Navbar highlights current page
