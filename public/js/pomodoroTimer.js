'use strict'
{
    let pomodoroTimerVariable = setInterval(pomodoroTimer, 1000);
    let remainingSeconds = 1 * 60;

    function pomodoroTimer(){
        --remainingSeconds;
        let minute = String(Math.floor(remainingSeconds / 60)).padStart(2, '0');
        let seconds = String(remainingSeconds - minute * 60).padStart(2, '0');

        document.getElementById("pomodoro-timer").innerHTML = minute + ":" + seconds;

        if(remainingSeconds === 0){
            remainingSeconds = 5 * 60;
            --remainingSeconds;
            let minute = String(Math.floor(remainingSeconds / 60)).padStart(2, '0');
            let seconds = String(remainingSeconds - minute * 60).padStart(2, '0');
            document.getElementById("pomodoro-timer").innerHTML = minute + ":" + seconds;
        }
    }
}

