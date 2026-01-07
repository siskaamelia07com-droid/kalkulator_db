<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kalkulator Lucu 🧮</title>

    <style>
        body {
            background: linear-gradient(135deg, #ff9a9e, #fad0c4);
            font-family: 'Comic Sans MS', cursive;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .calculator {
            background: #fff;
            border-radius: 25px;
            padding: 20px;
            width: 260px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
            animation: float 2s infinite ease-in-out;
        }

        @keyframes float {
            0% { transform: translateY(0); }
            50% { transform: translateY(-5px); }
            100% { transform: translateY(0); }
        }

        .display {
            background: #222;
            color: #0f0;
            font-size: 28px;
            padding: 15px;
            border-radius: 15px;
            margin-bottom: 15px;
            text-align: right;
            min-height: 40px;
            overflow-x: auto;
        }

        .buttons {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 10px;
        }

        button {
            font-size: 20px;
            padding: 15px;
            border: none;
            border-radius: 15px;
            cursor: pointer;
            background: #ffb703;
            box-shadow: 0 5px #fb8500;
            transition: all 0.1s ease;
        }

        button:active {
            transform: scale(0.9);
            box-shadow: 0 2px #fb8500;
        }

        .operator {
            background: #8ecae6;
            box-shadow: 0 5px #219ebc;
        }

        .equal {
            background: #90db6b;
            box-shadow: 0 5px #4caf50;
            grid-column: span 2;
        }

        .clear {
            background: #ff6b6b;
            box-shadow: 0 5px #d62828;
            grid-column: span 2;
        }
    </style>
</head>
<body>

<div class="calculator">
    <div class="display" id="display">0</div>

    <div class="buttons">
        <button class="operator" onclick="press('+')">+</button>
        <button class="operator" onclick="press('*')">x</button>
        <button class="operator" onclick="press('-')">-</button>
        <button class="operator" onclick="press('/')">:</button>
        <button onclick="press('1')">1</button>
        <button onclick="press('2')">2</button>
        <button onclick="press('3')">3</button>
        <button class="operator" onclick="persen()">%</button>
        <button onclick="press('4')">4</button>
        <button onclick="press('5')">5</button>
        <button onclick="press('6')">6</button>
        <button class="operator" onclick="hapus()">⌫</button>
        <button onclick="press('7')">7</button>
        <button onclick="press('8')">8</button>
        <button onclick="press('9')">9</button>
        <button class="operator" onclick="press(',')">,</button>
        <button onclick="press('0')">0</button>
        <button class="operator" onclick="press('.')">.</button>
        <button class="operator" onclick="press('(')">(</button>
        <button class="operator" onclick="press(')')">)</button>
        <button class="equal" onclick="calculate()">=</button>
        <button class="clear" onclick="clearDisplay()">C</button>
    </div>
</div>

<!-- Suara klik -->
<audio id="clickSound">
    <source src="https://www.soundjay.com/buttons/sounds/button-16.mp3" type="audio/mpeg">
</audio>

<script>
let expression = "";

function playSound() {
    const sound = document.getElementById("clickSound");
    sound.currentTime = 0;
    sound.play();
}

function press(value) {
    playSound();

    // Jika koma ditekan, ubah jadi titik (agar bisa dihitung)
    if (value === ',') value = '.';

    if (expression === "0") expression = "";
    expression += value;
    document.getElementById("display").innerText = expression;
}

function calculate() {
    playSound();
    try {
        let result = eval(expression);
        document.getElementById("display").innerText = result;

        // Kirim ke PHP
        fetch("", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            },
            body: "ekspresi=" + encodeURIComponent(expression) +
                  "&hasil=" + encodeURIComponent(result)
        });

        expression = result.toString();
    } catch {
        document.getElementById("display").innerText = "Error 😵";
        expression = "";
    }
}


function clearDisplay() {
    playSound();
    expression = "";
    document.getElementById("display").innerText = "0";
}

function hapus() {
    playSound();
    expression = expression.slice(0, -1);
    document.getElementById("display").innerText = expression || "0";
}

function persen() {
    playSound();
    if (!expression) return;

    let lastNumber = expression.match(/(\d+\.?\d*)$/);
    if (lastNumber) {
        let percent = parseFloat(lastNumber[0]) / 100;
        expression = expression.replace(/(\d+\.?\d*)$/, percent);
        document.getElementById("display").innerText = expression;
    }
}
</script>



</body>
</html>