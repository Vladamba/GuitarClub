let questions = [{
    question: "Boobs or ass?",
    answers: ["boobs", "ass", "both", "dicks"],
},
{
    question: "Bass or poebalu?",
    answers: ["boobs", "ass", "bass", "i am dumb"],
},
{
    question: "% or $?",
    answers: ["#", "%", "both", "$"],
}];

let currentQuestion = 0;
let points = 0;
let buttons = new Array(questions[0].answers.length);

function start(){
    currentQuestion = 0;
    points = 0;
    for (let i = 0; i < buttons.length; i++){
        buttons[i] = document.createElement("button");
        buttons[i].onclick = function(){endQuestion(i)};
        document.getElementById("answersContainer").append(buttons[i]);
    }
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
    for (let i = 0; i < buttons.length; i++){
        buttons[i].remove();
    }
    document.getElementById("headerText").innerHTML = "You got " + points + " points";
}