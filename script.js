function checkInput() {
    const errorMessage = document.getElementById('error-message');
    let username = document.getElementById("username").value;
    const bannedChars = /[!"@#%&*()+=^{}[\]\-;:'"<>?]/g;
    if (bannedChars.test(username)) {
        errorMessage.textContent = 'Invalid characters detected'; // stop invalid character input
        return false;
    } else {
        errorMessage.textContent = '';
        // clear error message text
        avatarId = avatarId.join("")
        console.log(`Avatar ID: ${avatarId}`)
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'registration.php');
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.send('avatarId=' + encodeURIComponent(JSON.stringify(avatarId)) + '&username=' + encodeURIComponent(username));
    }
}

const eyes = ["normal", "closed", "laughing", "long", "rolling", "winking"];
const mouths = ["open", "sad", "smiling", "straight", "surprise", "teeth"];
const skins = ["yellow", "green", "red"];

const headPreview = document.getElementById('colour-preview');
const eyesPreview = document.getElementById('eyes-preview');
const mouthPreview = document.getElementById('mouth-preview');

const headSelector = document.getElementById('colour-selector');
const eyesSelector = document.getElementById('eyes-selector');
const mouthSelector = document.getElementById('mouth-selector');

let skinIndex = 0;
let eyesIndex = 0;
let mouthIndex = 0;
let avatarId = [0, 0, 0];

updateAvatarPreview();


function updateAvatarPreview() {
    headPreview.src = `assets/emoji/skin/${skins[skinIndex]}.png`;
    eyesPreview.src = `assets/emoji/eyes/${eyes[eyesIndex]}.png`;
    mouthPreview.src = `assets/emoji/mouth/${mouths[mouthIndex]}.png`;
    avatarId = [skinIndex, eyesIndex, mouthIndex];
}

headSelector.addEventListener('click', function (event) {
    if (event.target.innerText === 'chevron_left') {
        skinIndex--;
        if (skinIndex < 0) skinIndex = skins.length - 1;
    } else if (event.target.innerText === 'chevron_right') {
        skinIndex++;
        if (skinIndex === skins.length) skinIndex = 0;
    };
    updateAvatarPreview();
    return;
})

eyesSelector.addEventListener('click', function (event) {
    if (event.target.innerText === 'chevron_left') {
        eyesIndex--;
        if (eyesIndex < 0) eyesIndex = eyes.length - 1;
    } else if (event.target.innerText === 'chevron_right') {
        eyesIndex++;
        if (eyesIndex === eyes.length) eyesIndex = 0;
    };
    updateAvatarPreview();
    return;
})

mouthSelector.addEventListener('click', function (event) {
    if (event.target.innerText === 'chevron_left') {
        mouthIndex--;
        if (mouthIndex < 0) mouthIndex = mouths.length - 1;
    } else if (event.target.innerText === 'chevron_right') {
        mouthIndex++;
        if (mouthIndex === 6) mouthIndex = 0;
    };
    updateAvatarPreview();
    return;
})