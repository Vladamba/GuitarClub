let questions = [{
    question: "If your string break, you will..?",
    answers: ["Change this string", "Change all strings", "Break other strings and change them", "Play without using the broken string"],
},
{
    question: "What type of girls/boys do you like?",
    answers: ["Blond with blue eyes", "Warm soul", "Has a lot of money", "Don't give a damn"],
},
{
    question: "What do you do in your free time?",
    answers: ["Play my guitar", "Play my 8 string guitar", "Play my bass", "Sleep"],
}];

let currentQuestion = 0;
let points = 0;
let buttons = new Array(questions[0].answers.length);

function start(){
    currentQuestion = 0;
    points = 0;
    document.getElementById("mainButton").classList.add("hide");
    for (let i = 0; i < buttons.length; i++){
        buttons[i] = document.createElement("button");
        buttons[i].classList.add("button");
        buttons[i].onclick = function(){endQuestion(i)};
        document.getElementById("answersContainer").append(buttons[i]);
    }
    document.getElementById("image").src = "";
    document.getElementById("image").classList.remove("active");
    startQuestion();
}

function startQuestion(){
    if (currentQuestion === questions.length){
        end();
    }
    else{
        document.getElementById("headerText").innerHTML = "Question " + (currentQuestion + 1) + " / " + questions.length;
        document.getElementById("questionText").innerHTML = questions[currentQuestion].question;
        for (let i = 0; i < buttons.length; i++){
            buttons[i].innerHTML = questions[currentQuestion].answers[i];
        }
    }
}

function endQuestion(point){
    points += point;
    currentQuestion++;
    startQuestion();
}

function end(){
    document.getElementById("mainButton").classList.remove("hide");
    for (let i = 0; i < buttons.length; i++){
        buttons[i].remove();
    }
    document.getElementById("headerText").innerHTML = "Test completed. You got " + points + " points"
    document.getElementById("questionText").innerHTML = "You are ";
    if (points < 3){
        document.getElementById("questionText").innerHTML += "small pick";
        document.getElementById("image").src = "1pick.jpg";
    } else {
        if (points < 6) {
            document.getElementById("questionText").innerHTML += "medium pick";
            document.getElementById("image").src = "2pick.jpg";
        } else {
            if (points < 9) {
                document.getElementById("questionText").innerHTML += "hard pick";
                document.getElementById("image").src = "3pick.jpg";
            } else {
                document.getElementById("questionText").innerHTML += "stupid pick";
                document.getElementById("image").src = "4pick.jpg";
            }
        }
    }
    document.getElementById("image").classList.add("active");
}