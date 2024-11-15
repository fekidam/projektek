$(document).ready(async function () {
    $("#menu").menu();

    const playerNameKey = 'currentPlayerName';
    const topScoresKey = 'topScores';
    let playerName = localStorage.getItem(playerNameKey);
    let topScores = JSON.parse(localStorage.getItem(topScoresKey)) || [];


    const predefinedLevels = [
        [
            [0, 1, 1, 0, 0],
            [0, 0, 0, 1, 1],
            [1, 0, 0, 1, 1],
            [0, 0, 0, 1, 0],
            [0, 1, 0, 1, 0]
        ],
        [
            [1, 1, 1, 1, 0],
            [1, 1, 0, 0, 0],
            [0, 0, 1, 0, 0],
            [1, 0, 1, 1, 1],
            [1, 1, 1, 1, 0]
        ],
        [
            [1, 0, 0, 0, 1],
            [0, 0, 1, 0, 0],
            [0, 1, 1, 1, 0],
            [1, 0, 1, 1, 0],
            [1, 0, 0, 1, 0]
        ],
        [
            [1, 1, 0, 0, 1],
            [0, 1, 1, 0, 1],
            [1, 0, 1, 0, 1],
            [1, 0, 0, 1, 0],
            [0, 1, 0, 1, 1]
        ],
        [
            [0, 0, 0, 1, 0],
            [0, 0, 0, 1, 0],
            [0, 0, 0, 0, 0],
            [0, 1, 0, 1, 0],
            [0, 1, 0, 0, 0]
        ],
        [
            [1, 0, 0, 0, 0],
            [0, 0, 1, 1, 0],
            [0, 1, 0, 0, 0],
            [1, 0, 0, 0, 0],
            [0, 0, 0, 1, 1]
        ],
        [
            [0, 1, 0, 0, 1],
            [1, 1, 0, 1, 1],
            [1, 1, 1, 1, 0],
            [0, 0, 0, 1, 1],
            [0, 1, 0, 0, 0]
        ],
        [
            [1, 0, 1, 0, 1],
            [0, 1, 1, 1, 1],
            [1, 1, 0, 0, 0],
            [1, 1, 1, 0, 1],
            [0, 0, 0, 0, 0]
        ],
        [
            [0, 0, 0, 1, 0],
            [1, 1, 1, 0, 0],
            [1, 1, 1, 0, 0],
            [1, 0, 1, 0, 1],
            [1, 1, 0, 1, 0]
        ],
        [
            [1, 1, 0, 0, 1],
            [1, 1, 1, 0, 1],
            [1, 1, 1, 1, 1],
            [1, 0, 0, 1, 1],
            [0, 1, 1, 0, 0]
        ],
    ];

    const backgroundMusic = new Audio('Audio/secrets-of-the-old-library-140000.mp3');
    const clickSound = new Audio('Audio/tap-notification-180637.mp3');
    const menuSound = new Audio('Audio/shooting-sound-fx-159024.mp3');
    const successSound = new Audio('Audio/cute-level-up-3-189853.mp3');

    backgroundMusic.loop = true;
    backgroundMusic.volume = 0.3;

    $("#audio-enable-dialog").dialog({
        autoOpen: true,
        modal: true,
        buttons: {
            "Engedélyez": function () {
                $(this).dialog("close");
                backgroundMusic.play().then(() => {
                    $('#volume-control').show();
                    promptForNameAndStartGame();
                }).catch(err => console.error("Audio playback error:", err));
            }
        }
    });

    $('#volume-slider').on('input', function () {
        const volume = this.value;
        backgroundMusic.volume = volume;
        clickSound.volume = volume;
        menuSound.volume = volume;
        successSound.volume = volume;

        updateVolumeIcon(volume);
    });

    function updateVolumeIcon(volume) {
        if (volume === 0) {
            $('#speaker-icon').removeClass('fa-volume-down fa-volume-up').addClass('fa-volume-off');
        } else if (volume < 0.5) {
            $('#speaker-icon').removeClass('fa-volume-up fa-volume-off').addClass('fa-volume-down');
        } else {
            $('#speaker-icon').removeClass('fa-volume-down fa-volume-off').addClass('fa-volume-up');
        }
    }

    $('#speaker-icon').click(function () {
        toggleMute();
    });

    function toggleMute() {
        const isMuted = !backgroundMusic.muted;
        backgroundMusic.muted = isMuted;
        clickSound.muted = isMuted;
        menuSound.muted = isMuted;
        successSound.muted = isMuted;

        $('#speaker-icon').toggleClass('fa-volume-off', isMuted);
        $('#speaker-icon').toggleClass('fa-volume-up', !isMuted && backgroundMusic.volume > 0.5);
        $('#speaker-icon').toggleClass('fa-volume-down', !isMuted && backgroundMusic.volume <= 0.5);
    }

    $("#menu a, #level-selector button").click(function () {
        menuSound.currentTime = 0;
        menuSound.play();
    });

    $("#gameCanvas").click(function () {
        clickSound.currentTime = 0;
        clickSound.play();
    });

    $('#start-game').click(function () {
        backgroundMusic.play()
            .then(() => {
                $('#volume-control').show();
                $('#start-game').hide();
            })
            .catch(error => console.error("Audio play failed", error));
    });

    $("#toggle-sound").click(function () {
        toggleSounds();
    });

    function toggleSounds() {
        const isMuted = backgroundMusic.muted;
        backgroundMusic.muted = !isMuted;
        clickSound.muted = !isMuted;
        successSound.muted = !isMuted;
    }

    function promptForNameAndStartGame() {
        if (!playerName) {
            $("#name-entry-dialog").dialog({
                modal: true,
                buttons: {
                    "Mentés": function () {
                        const inputName = $("#player-name").val().trim();
                        if (inputName) {
                            playerName = inputName;
                            localStorage.setItem(playerNameKey, playerName);
                            saveScore(playerName, 0);
                            $(this).dialog("close");
                            startGame();
                        } else {
                            alert("Kérlek add meg a neved!");
                        }
                    }
                }
            }).dialog("open");
        } else {
            startGame();
        }
    }


    function updateScoreboard() {
        const listHtml = topScores.map(entry => `<li>${entry.name}: ${entry.score}</li>`).join('');
        $('#top-scores-list').html(listHtml);
    }

    function saveScore(name, score) {
        if (!name) {
            console.error("Hiányzó játékos név.");
            return;
        }

        const lowerName = name.toLowerCase();
        const playerIndex = topScores.findIndex(p => p.name.toLowerCase() === lowerName);
        if (playerIndex > -1) {
            topScores[playerIndex].score += score;
        } else {
            topScores.push({ name, score });
        }

        topScores.sort((a, b) => b.score - a.score);
        localStorage.setItem(topScoresKey, JSON.stringify(topScores));
        updateScoreboard();
    }


    let moves = 0;
    let gridSize = 5;
    let currentLevel = 1;
    let totalLevels = 10;
    let initialGameBoard;
    const canvas = document.getElementById('gameCanvas');
    const ctx = canvas.getContext('2d');
    const cellSize = canvas.width / gridSize;
    let gameBoard = [...Array(gridSize)].map(e => Array(gridSize).fill(0));

    let startTime = Date.now();
    let timerInterval = setInterval(function () {
        const elapsedTime = Date.now() - startTime;
        $('#time-value').text(formatTime(elapsedTime));
    }, 1000);

    function restartTimer() {
        clearInterval(timerInterval);
        startTime = Date.now();
        timerInterval = setInterval(function () {
            var elapsedTime = Date.now() - startTime;
            $('#time-value').text(formatTime(elapsedTime));
        }, 1000);
    }

    function formatTime(milliseconds) {
        var seconds = Math.floor(milliseconds / 1000);
        var minutes = Math.floor(seconds / 60);
        seconds %= 60;
        return `${minutes}:${seconds < 10 ? '0' + seconds : seconds}`;
    }


    function drawGameBoard() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        for (let row = 0; row < gridSize; row++) {
            for (let col = 0; col < gridSize; col++) {
                drawButton(ctx, col, row, gameBoard[row][col]);
            }
        }
        checkGameCompletion();
    }


    function drawButton(ctx, col, row, state, highlight = false) {
        const x = col * cellSize;
        const y = row * cellSize;
        const radius = cellSize / 2 - 10;
        const innerRadius = radius - 5;
        const outerRadius = radius + 5;

        const gradient = ctx.createRadialGradient(x + cellSize / 2, y + cellSize / 2, innerRadius, x + cellSize / 2, y + cellSize / 2, outerRadius);
        gradient.addColorStop(0, state ? '#FFD700' : '#000000');
        gradient.addColorStop(1, state ? '#FFFF00' : '#555555');

        ctx.beginPath();
        ctx.arc(x + cellSize / 2, y + cellSize / 2, radius, 0, 2 * Math.PI, false);
        ctx.fillStyle = gradient;
        ctx.fill();

        if (highlight) {
            ctx.strokeStyle = '#FF0000';
            ctx.lineWidth = 5;
            ctx.stroke();
        }

        ctx.lineWidth = 2;
        ctx.strokeStyle = '#550055';
        ctx.stroke();
    }

    canvas.addEventListener('mousemove', function (event) {
        const rect = canvas.getBoundingClientRect();
        const x = event.clientX - rect.left;
        const y = event.clientY - rect.top;
        const col = Math.floor(x / cellSize);
        const row = Math.floor(y / cellSize);

        drawGameBoard();
        if (x >= 0 && x <= canvas.width && y >= 0 && y <= canvas.height) {
            drawButton(ctx, col, row, gameBoard[row][col], true);
        }
    });

    canvas.addEventListener('mouseleave', function () {
        drawGameBoard();
    });

    async function toggleButton(row, col, highlight = false) {

        if (row < 0 || col < 0 || row >= gridSize || col >= gridSize) {
            return;
        }


        if (highlight) {
            drawButton(ctx, col, row, gameBoard[row][col], true);
            await new Promise(resolve => setTimeout(resolve, 300));
        }

        gameBoard[row][col] ^= 1;

        if (col > 0) gameBoard[row][col - 1] ^= 1;
        if (col < gridSize - 1) gameBoard[row][col + 1] ^= 1;
        if (row > 0) gameBoard[row - 1][col] ^= 1;
        if (row < gridSize - 1) gameBoard[row + 1][col] ^= 1;

        drawGameBoard();
        if (highlight) await new Promise(resolve => setTimeout(resolve, 300));
    }

    canvas.addEventListener('click', function (event) {
        const rect = canvas.getBoundingClientRect();
        const x = event.clientX - rect.left;
        const y = event.clientY - rect.top;
        const col = Math.floor(x / cellSize);
        const row = Math.floor(y / cellSize);

        toggleButton(row, col);
        drawGameBoard();
        moves++;
        $('#moves-value').text(moves);
    });

    function startGame() {
        loadLevel(1);
    }

    function resetGame() {
        gameBoard = initialGameBoard.map(row => row.slice());
        moves = 0;
        $('#moves-value').text(moves);
        restartTimer();
        drawGameBoard();
    }


    function updateLevelDisplay() {
        $('#current-level').text(currentLevel);
    }

    $('#first-level').click(function () {
        shakeButton('first-level');
        currentLevel = 1;
        updateLevelDisplay();
        loadLevel(currentLevel);
    });

    $('#prev-level').click(function () {
        shakeButton('prev-level');
        if (currentLevel > 1) {
            currentLevel--;
            updateLevelDisplay();
            loadLevel(currentLevel);
        }
    });

    $('#next-level').click(function () {
        shakeButton('next-level');
        if (currentLevel < totalLevels) {
            currentLevel++;
            updateLevelDisplay();
            loadLevel(currentLevel);
        }
    });

    $('#last-level').click(function () {
        shakeButton('last-level');
        currentLevel = totalLevels;
        updateLevelDisplay();
        loadLevel(currentLevel);
    });

    let scoreUpdated = false;

    function resetProgressTracking() {
        scoreUpdated = false;
    }

    function calculateScore(maxSteps, usedSteps) {
        const basePoints = 10;
        const bonusPoints = Math.max(0, maxSteps - usedSteps);
        return basePoints + bonusPoints;
    }


    function setScore(name, newPoints) {
        const lowerName = name.toLowerCase();
        const playerIndex = topScores.findIndex(p => p.name.toLowerCase() === lowerName);

        if (playerIndex > -1) {
            topScores[playerIndex].score += newPoints;
        } else {
            topScores.push({ name, score: newPoints });
        }

        topScores.sort((a, b) => b.score - a.score);
        localStorage.setItem(topScoresKey, JSON.stringify(topScores));
        updateScoreboard();
    }


    function checkGameCompletion() {
        if (gameBoard.every(row => row.every(cell => cell === 0))) {
            const maxSteps = 20;
            const earnedPoints = calculateScore(maxSteps, moves);

            setScore(playerName, earnedPoints);

            successSound.play();

            if (!$("#congratulations-dialog").dialog("isOpen")) {
                $("#congratulations-dialog").dialog("open");
            }

            restartTimer();
            resetProgressTracking();
        }
    }



    $("#congratulations-dialog").dialog({
        autoOpen: false,
        modal: true,
        buttons: {
            "Újra": function () {
                $(this).dialog("close");
                resetGame();
            },
            "Kilépés": function () {
                $(this).dialog("close");
                if (currentLevel < totalLevels) {
                    currentLevel++;
                } else {
                    currentLevel = 1;
                }
                updateLevelDisplay();
                loadLevel(currentLevel);
            }
        }
    });

    function generateLevels(numberOfLevels, gridSize) {
        const savedLevels = localStorage.getItem('gameLevels');
        if (savedLevels) {
            initialStates = JSON.parse(savedLevels);
            return initialStates;
        }

        let levels = [];
        for (let i = 0; i < numberOfLevels; i++) {
            const level = [...Array(gridSize)].map(e => Array(gridSize).fill(0).map(() => Math.round(Math.random())));
            levels.push(level);
        }

        localStorage.setItem('gameLevels', JSON.stringify(levels));
        initialStates = levels.map(level => level.map(row => [...row]));
        return levels;
    }

    function loadLevel(level) {
        if (level < 1 || level > predefinedLevels.length) {
            console.error("Invalid level number");
            return;
        }

        initialGameBoard = JSON.parse(JSON.stringify(predefinedLevels[level - 1]));
        gameBoard = initialGameBoard.map(row => row.slice());
        moves = 0;
        $('#moves-value').text(moves);
        restartTimer();
        drawGameBoard();
    }

    $("#menu a").click(function () {
        const menuItemText = $(this).text();
        switch (menuItemText) {
            case "Alaphelyzet":
                gameBoard = initialGameBoard.map(row => row.slice());
                resetGame();
                break;
            case "Véletlenszerű":
                const randomLevel = Math.floor(Math.random() * predefinedLevels.length) + 1;
                currentLevel = randomLevel;
                $('#current-level').text(currentLevel);
                loadLevel(currentLevel);
                break;
            case "Megoldás":
                solvePuzzle();
                break;
            case "Segítség":
                $("#help-dialog").dialog("open");
                break;
        }
    });

    $("#help-dialog").dialog({
        autoOpen: false,
        modal: true,
        width: 400,
        buttons: {
            "Close": function () {
                $(this).dialog("close");
            }
        }
    });

    $("#name-entry-dialog").dialog({
        autoOpen: false,
        modal: true,
        buttons: {
            "Mentés": function () {
                const inputName = $("#player-name").val().trim();
                if (inputName) {
                    playerName = inputName;
                    localStorage.setItem(playerNameKey, playerName);
                    saveScore(playerName, 0);
                    updateScoreboard();
                    $(this).dialog("close");
                } else {
                    alert("Kérlek add meg a neved!");
                }
            }
        }
    });
    async function solvePuzzle() {
        let changesMade = false;
        do {
            changesMade = false;
            for (let row = 0; row < gridSize - 1; row++) {
                for (let col = 0; col < gridSize; col++) {
                    if (gameBoard[row][col] === 1) {
                        await toggleButton(row + 1, col, true);
                        changesMade = true;
                        await new Promise(resolve => setTimeout(resolve, 500));
                    }
                }
            }

            if (await evaluateAndToggleFirstRow()) {
                changesMade = true;
                await new Promise(resolve => setTimeout(resolve, 500));
            }

            drawGameBoard();
        } while (changesMade);

        if (isBoardClear()) {
            setTimeout(function () {
                clearInterval(timerInterval);
                startTime = Date.now();
                timerInterval = setInterval(function () {
                    const elapsedTime = Date.now() - startTime;
                    $('#time-value').text(formatTime(elapsedTime));
                }, 1000);
            }, 500);
        }
    }

    function isBoardClear() {
        return gameBoard.every(row => row.every(cell => cell === 0));
    }

    async function evaluateAndToggleFirstRow() {
        const lastRow = gameBoard[gridSize - 1];
        let changeMade = false;

        async function toggleAndWait(row, col) {
            await toggleButton(row, col);
            changeMade = true;
            await new Promise(resolve => setTimeout(resolve, 500));
        }

        if (lastRow[0] && lastRow[1] && lastRow[2]) await toggleAndWait(0, 1);
        if (lastRow[0] && lastRow[1] && lastRow[3] && lastRow[4]) await toggleAndWait(0, 2);
        if (lastRow[0] && lastRow[2] && lastRow[3]) await toggleAndWait(0, 4);
        if (lastRow[0] && lastRow[4]) {
            await toggleAndWait(0, 0);
            await toggleAndWait(0, 1);
        }
        if (lastRow[1] && lastRow[2] && lastRow[4]) await toggleAndWait(0, 0);
        if (lastRow[1] && lastRow[3]) {
            await toggleAndWait(0, 0);
            await toggleAndWait(0, 3);
        }
        if (lastRow[2] && lastRow[3] && lastRow[4]) await toggleAndWait(0, 3);

        return changeMade;
    }

    $('#congratulations-dialog').on("dialogclose", function () {
        promptForNameAndStartGame();
    });


    function shakeButton(buttonId) {
        const button = document.getElementById(buttonId);
        if (button) {
            button.classList.add('shake');
            setTimeout(() => button.classList.remove('shake'), 400);
        }
    }


    generateLevels(totalLevels, gridSize);
    updateScoreboard();
    loadLevel(currentLevel);
    drawGameBoard();

});

