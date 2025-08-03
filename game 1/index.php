<!DOCTYPE html>
<html lang="en">

<head>
    <title>Game 1</title>
    
    <!-- Style section ekak - game eke layout, background, character, box, score display walata CSS denna -->
    <style>

/* Body ekata margin nathi karanawa */
.body {
    margin: 0;
}

/* Background div ekata game background image ekak denna, position, size, repeat, overflow set karanawa */
.background {
    width: 100%;
    height: 100vh;
    background-image: url(resources/background.jpg);
    background-size: cover;
    background-repeat: repeat-x;
    overflow-x: hidden;
    position: absolute;
}

/* Girl character image ekata height ekak, margin top ekak, position ekak denna */
.girl {
    height: 230px;
    margin-top: 452px;
    position: absolute;
}

/* Box (obstacle) ekata size, position, background gif ekak denna */
.box {
    width: 250px;
    height: 250px;
    position: absolute;
    margin-top: 500px;
    background-image: url(resources/roope-sorvo-stonelionrun.gif);
    background-size: contain;
    background-repeat: no-repeat;
}

/* Score display ekata font size, weight, margin, position denna */
.score {
    font-size: 50px;
    font-weight: bold;
    margin-left: 30px;
    margin-top: 20px;
    position: absolute;
}

  </style>
</head>

<!-- Body ekata class ekak denna, game start karaddi animation functions call karanawa, key press event ekak handle karanawa -->
<body class="body" onload="idleAnimationStart(); createBox();" onkeypress="keyCheck(event)">
    <!-- Background div ekak - girl character ekath, score ekath meka athule -->
    <div class="background" id="background">
        <img src="resources/Idle (1).png" class="girl" id="girl"/>
        <div class="score" id="score">0</div>
    </div>

    
    <script>
//  SOUND EFFECTS 
// run.wav - duwana sound eka
// jump.wav - uda panina sound eka
// dead.wav - marena sound eka
var runSound = new Audio('resources/run.wav'); // Run sound
var jumpSound = new Audio('resources/jump.wav'); // Jump sound
var deadSound = new Audio('resources/dead.wav'); // Dead sound
// 

// Girl character image element eka ganna
var girl = document.getElementById("girl");

//  IDLE ANIMATION 
// Idle animation walata image number track karanawa
var idleImageNumber = 1;
var idleAnimationNumber = 0;

// Idle animation function ekak - girl character idle images animate karanawa
function idleAnimation() {
    idleImageNumber++;
    if (idleImageNumber == 11) idleImageNumber = 1;
    girl.src = "resources/Idle (" + idleImageNumber + ").png";
}

// Idle animation start karana function ekak - interval ekak set karanawa//
function idleAnimationStart() {
    idleAnimationNumber = setInterval(idleAnimation, 200);
}


//  RUN ANIMATION 
// Run animation walata image number track karanawa
var runImageNumber = 1;
var runAnimationNumber = 0;

// Run animation function ekak - girl character run images animate karanawa
function runAnimation() {
    runImageNumber++;
    if (runImageNumber == 11) runImageNumber = 1;
    girl.src = "resources/Run (" + runImageNumber + ").png";
}
// Run animation start karana function ekak - interval ekak set karanawa, idle animation stop karanawa, run sound play karanawa
function runAnimationStart() {
    runAnimationNumber = setInterval(runAnimation, 100);
    clearInterval(idleAnimationNumber);
    
    // duwana sound eka play wenawa//
    runSound.currentTime = 0;
    runSound.play();
}


//  JUMP ANIMATION 
// Jump animation walata image number, animation number, girl margin top track karanawa
var jumpImageNumber = 1;
var jumpAnimationNumber = 0;
var girlMarginTop = 452;

// Jump animation function ekak - girl character jump images animate karanawa, margin top update karanawa
function jumpAnimation() {
    jumpImageNumber++;
    if (jumpImageNumber <= 6) {
        girlMarginTop -= 35;
    } else {
        girlMarginTop += 35;
    }
    if (jumpImageNumber == 11) {
        jumpImageNumber = 1;
        clearInterval(jumpAnimationNumber);
        jumpAnimationNumber = 0;
        runAnimationStart();
    }
    girl.style.marginTop = girlMarginTop + "px";
    girl.src = "resources/Jump (" + jumpImageNumber + ").png";
}
// Jump animation start karana function ekak - idle/run animation stop karanawa, jump interval ekak set karanawa, jump sound play karanawa
function jumpAnimationStart() {
    clearInterval(idleAnimationNumber);
    clearInterval(runAnimationNumber);
    runImageNumber = 0;
    jumpImageNumber = 1;
    jumpAnimationNumber = setInterval(jumpAnimation, 100);

    // uda panina sound eka play wenawa//
    jumpSound.currentTime = 0;
    jumpSound.play();
}



// User key press ekak karama event eka handle karanawa
function keyCheck(event) {
    var keyCode = event.which;
    if (keyCode == 13) {
        // Enter key ekata run animation, background move, box animation start karanawa
        if (runAnimationNumber == 0) runAnimationStart();
        if (moveBackgroundAnimatoinId == 0) moveBackgroundAnimatoinId = setInterval(moveBackground, 100);
        if (boxAnimationIdValue == 0) boxAnimationIdValue = setInterval(boxAnimation, 100);
    }
    if (keyCode == 32) {

        // Space key ekata jump animation, background move, box animation start karanawa//
        if (jumpAnimationNumber == 0) jumpAnimationStart();
        if (moveBackgroundAnimatoinId == 0) moveBackgroundAnimatoinId = setInterval(moveBackground, 100);
        if (boxAnimationIdValue == 0) boxAnimationIdValue = setInterval(boxAnimation, 100);
    }
}


//  BACKGROUND & SCORE 
// Background image position X, background move animation id, score variable hadanawa
var backgroundImagePositionX = 0;
var moveBackgroundAnimatoinId = 0;
var score = 0;

// Background move karana function ekak - background image position update karanawa, score wadi karanawa//
function moveBackground() {
    backgroundImagePositionX -= 20;
    document.getElementById("background").style.backgroundPositionX = backgroundImagePositionX + "px";
    score++;
    document.getElementById("score").innerHTML = score;
}


//BOX ANIMATION //
// Box animation id, box margin left variable hadanawa
var boxAnimationIdValue = 0;
var boxMarginLeft = 1550;

// Box create karana function ekak - 20 box create karanawa, margin left set karanawa, background eke append karanawa
function createBox() {
    for (let i = 0; i < 20; i++) {
        let box = document.createElement("div");
        box.className = "box";
        box.id = "box" + i;
        box.style.marginLeft = boxMarginLeft + "px";
        document.getElementById("background").appendChild(box);
        boxMarginLeft += i < 7 ? 1000 : 550;
    }
}
// Box animation function ekak - box walata margin left update karanawa, collision check karanawa
function boxAnimation() {
    for (let i = 0; i < 20; i++) {
        let box = document.getElementById("box" + i);
        if (box) {
            let currentMarginLeft = parseInt(getComputedStyle(box).marginLeft);
            let newMarginLeft = currentMarginLeft - 25;
            box.style.marginLeft = newMarginLeft + "px";

            // Girl character box ekata hit unoth game stop karanawa, dead animation start karanawa
            if (newMarginLeft > 50 && newMarginLeft < 150 && girlMarginTop > 430) {
                clearInterval(idleAnimationNumber);
                clearInterval(runAnimationNumber);
                clearInterval(jumpAnimationNumber);
                clearInterval(moveBackgroundAnimatoinId);
                clearInterval(boxAnimationIdValue);
                runAnimationNumber = -1;
                jumpAnimationNumber = -1;
                moveBackgroundAnimatoinId = -1;
                boxAnimationIdValue = -1;

                deadAnimationNumber = setInterval(girlDeadAnimation, 100);
            }
        }
    }
}


//  DEAD ANIMATION 
// Dead animation walata image number, animation number hadanawa//
var deadImageNumber = 0;
var deadAnimationNumber = 0;

// Girl dead animation function ekak - dead images animate karanawa, sound play karanawa, 1s passe score page ekata redirect karanawa//
function girlDeadAnimation() {
    deadImageNumber++;
    if (deadImageNumber >= 10) {
        clearInterval(deadAnimationNumber);
        deadImageNumber = 10;
        girl.src = "resources/Dead (" + deadImageNumber + ").png";

        // marena sound eka play wenawa//
        deadSound.currentTime = 0;
        deadSound.play();
        setTimeout(function () {
            window.location.href = "score.php?score=" + score;
        }, 1000);
        return;
    }
    girl.src = "resources/Dead (" + deadImageNumber + ").png";
}


    </script>
</body>
</html>
