levels = [
    { cards: 6, matches: 2, rows: 2, cols: 3 },
    { cards: 12, matches: 2, rows: 3, cols: 4 },
    { cards: 9, matches: 3, rows: 3, cols: 3 },
    { cards: 20, matches: 4, rows: 4, cols: 5 },
] // Array of levels with the number of cards they contain, how many cards there are in a match, 


// All facial elements used to generate emojis
const eyes = ["normal", "closed", "laughing", "long", "rolling", "winking"],
    mouths = ["open", "sad", "smiling", "straight", "surprise", "teeth"],
    skins = ["yellow", "green", "red"],
    emojiElements = ["Skin", "Eyes", "Mouth"];

let currentLevel = 0,
    temp_attempts = 0,
    temp_time = 0;

let matched = 0;
let cardOne, cardTwo, cardThree, cardFour, timerId;
let disableDeck = false;
let musicPlaying = false;

// HTML Elements
const gameBoard = document.getElementById('gameboard'),
    startBtn = document.getElementById('start-game'),
    cardWrapper = document.getElementById('wrapper'),
    timeTag = document.querySelector(".time b"),
    attemptsTag = document.querySelector(".attempts b"),
    levelTag = document.querySelector(".level b"),
    endScreen = document.getElementById('gameover'),
    winTag = document.querySelector(".gameover p"),
    endMessage = document.querySelector(".gameover h1"),
    submitButton = document.getElementById("submit-score")
root = document.documentElement;

// Function that runs on start
function setupGame() {
    gameBoard.style.backgroundColor = "grey";
    submitButton.disabled = true;
    currentLevel = 0;
    attempts = 0;
    startTimer();
    toggleMusic();
    attemptsTag.innerHTML = attempts;
    endScreen.style.visibility = 'hidden';
    startBtn.style.visibility = 'hidden';
    gameBoard.style.visibility = 'visible';
    startGame();
}


// Generates image from unique photo id
function generateEmoji(id, cardSkin, cardEyes, cardMouth) {
    cardSkin.src = `assets/emoji/skin/${skins[id[0]]}.png`;
    cardEyes.src = `assets/emoji/eyes/${eyes[id[1]]}.png`;
    cardMouth.src = `assets/emoji/mouth/${mouths[id[2]]}.png`;
}

// Function that outputs an array containing the id of all the generated cards, shuffled
function generateCards(numberOfCards, matches) {
    let out = [];
    for (i = 0; i < numberOfCards / matches;) {
        let id = [];
        id.push(Math.floor(Math.random() * 3));
        id.push(Math.floor(Math.random() * 6));
        id.push(Math.floor(Math.random() * 6));

        // Check for duplicates
        let idString = id.join(',');
        if (out.map(card => card.join(',')).includes(idString)) {
            continue
        } else {
            i++;
            for (y = 0; y < matches; y++) {
                out.push(id);
            }
        }
    }
    return out;
}

// Function used to shuffle the card ids using the Fisher-Yates algorithm.
function shuffleCards(cards) {
    for (let i = cards.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [cards[i], cards[j]] = [cards[j], cards[i]];
    }
    return cards;
}


function startGame() {
    matched = 0;
    let numberOfCards = levels[currentLevel].cards;
    matches = levels[currentLevel].matches;
    let cols = levels[currentLevel].cols;
    root.style.setProperty('--card-height', `calc(100% / ${cols} - 10px)`);

    let allCardIds = generateCards(numberOfCards, matches);
    allCardIds = shuffleCards(allCardIds);
    // highScores = findHighScores();
    cardWrapper.innerHTML = '';

    
    // Generate random cards (no duplicates) and place two randomly in the grid
    for (let i = 0; i < numberOfCards; i++) {
        let id = allCardIds[i];
        let cardElement = document.createElement('li');
        cardElement.classList.add('card');
        cardElement.setAttribute('data-id', id);

        const front = document.createElement('div');
        front.classList.add('view', 'front-view');
        front.innerHTML = '<span class="material-symbols-outlined">question_mark</span>'; // Add inner HTML to front of card

        const back = document.createElement('div');
        back.classList.add('view', 'back-view');

        const cardEmoji = document.createElement('div');
        let cardSkin = document.createElement('img');
        let cardEyes = document.createElement('img');
        let cardMouth = document.createElement('img');

        generateEmoji(id, cardSkin, cardEyes, cardMouth);

        cardEmoji.appendChild(cardSkin);
        cardEmoji.appendChild(cardEyes);
        cardEmoji.appendChild(cardMouth);
        cardEmoji.classList.add('emoji')

        back.appendChild(cardEmoji);
        cardElement.appendChild(front);
        cardElement.appendChild(back);
        cardWrapper.appendChild(cardElement);
        console.log('Success')

    }
    const cards = document.querySelectorAll(".card");

    // Event listener to flip cards
    cards.forEach(card => {
        card.addEventListener("click", flipCard);
    });
}

// Function defining flip behaviour 
function flipCard({ target: clickedCard }) {
    if (![cardOne, cardTwo, cardThree, cardFour].includes(clickedCard) && !disableDeck) {
        clickedCard.classList.add("flip");
        if (!cardOne) {
            return cardOne = clickedCard;
        } else if (!cardTwo) {
            cardTwo = clickedCard;
            return matches === 2 ? handleCardCheck(cardOne, cardTwo) : null;

        } else if (!cardThree) {
            cardThree = clickedCard
            return matches === 3 ? handleCardCheck(cardOne, cardTwo, cardThree) : null;
        }
        cardFour = clickedCard;
        disableDeck = true;
        handleCardCheck(cardOne, cardTwo, cardThree, cardFour)
    }
}

// Function that checks if two cards match using their unique ID
function handleCardCheck() {
    disableDeck = true;
    let args = Array.from(arguments);
    let cardsSelected = [args[0].dataset.id];
    let match = true;

    args.forEach(card => {
        if (card.dataset.id === cardsSelected[cardsSelected.length - 1] && match === true) {
            cardsSelected.push(card.dataset.id);
        } else {
            match = false;
        }
    });
    score = time - temp_time + 3 * (attempts - temp_attempts)
    if (match) {
        matched++;
        if (matched === levels[currentLevel].cards / levels[currentLevel].matches) {
            let levelScore = document.getElementById(`level${currentLevel + 1}`)
            levelScore.innerHTML = `${score}`;
            levelTag.innerHTML = currentLevel + 1;
            if (currentLevel < levels.length - 1) {
                setTimeout(() => {
                    currentLevel++;
                    temp_time = time
                    temp_attempts = attempts;
                    return startGame();
                }, 1000)
            } else {
                gameOver(false);
            }
        }
        args.forEach(card => {
            card.removeEventListener("click", flipCard);
        });
        cardOne = cardTwo = cardThree = cardFour = "";
        return disableDeck = false;
    }
    setTimeout(() => {
        args.forEach(card => {
            card.classList.add("shake");
        });
    }, 400);
    setTimeout(() => {
        args.forEach(card => {
            card.classList.remove("shake", "flip");
        })
        cardOne = cardTwo = cardThree = cardFour = "";
        disableDeck = false;
    }, 1200);
    attempts++
    attemptsTag.innerHTML = attempts;
    if (attempts == 30) {
        gameOver(true);
    } else if (attempts == 25) {
        gameBoard.style.backgroundColor = "red";
    }
}

function startTimer() {
    time = 0;
    temp_time = 0;
    clearInterval(timerId);

    timerId = setInterval(function () {
        time++;
        timeTag.innerText = time;
    }, 1000);
}

function stopTimer() {
    clearInterval(timerId);
    return time;
}

function toggleMusic() {
    if (!musicPlaying) {
        music = new Audio('assets/music.mp3');
        music.play()
        musicPlaying = true;
    } else {
        music.pause()
    }
}

function gameOver(loss) {
    toggleMusic();
    finalTime = stopTimer();
    score = finalTime + 3 * attempts
    if (!loss) {
        winTag.innerHTML = `Time taken: ${finalTime}s | Attempts: ${attempts} | <b>Your score: ${score}</b>`;
        endMessage.innerHTML = "You Win!";
        if (avatarId !== "") {
            submitButton.disabled = false;
        }
        gameBoard.style.visibility = 'hidden';
        endScreen.style.visibility = 'visible';
    } else {
        winTag.innerHTML = "You had too many attempts...";
        endMessage.innerHTML = "You Lost!";
        gameBoard.style.visibility = 'hidden';
        endScreen.style.visibility = 'visible';
    }
}


submitButton.addEventListener('click', (event) => {
    event.preventDefault();
    const url = 'leaderboard.php';
    let data = {
        "time": finalTime,
        "score": score,
        "name": username
    };

    fetch(url, {
        method: 'POST',
        body: JSON.stringify(data),
        headers: {
            'Content-Type': 'application/json'
        }
    })
    submitButton.disabled = true;
});
