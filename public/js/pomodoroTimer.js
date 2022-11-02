'use strict'
{
    let remainingSeconds = 25 * 60;
    let flag = 1;
    let pomodoroTimerVariable = setInterval(pomodoroTimer, 1000);

    function pomodoroTimer() {
        console.log('remainingSeconds' + remainingSeconds);
        --remainingSeconds;
        let minute = String(Math.floor(remainingSeconds / 60)).padStart(2, '0');
        let seconds = String(remainingSeconds - minute * 60).padStart(2, '0');
        document.getElementById("pomodoro-timer").innerHTML = minute + ":" + seconds;

        if (remainingSeconds === 0) {
            if (flag === 1) {
                flag = 2;
                remainingSeconds = 5 * 60;
                document.getElementById("work-or-rest").style.color = "#e70000";
                document.getElementById("pomodoro-timer").style.color = "#e70000";
                document.getElementById("work-or-rest").innerHTML = '休憩';
            } else {
                flag === 1;
                remainingSeconds = 25 * 60;
                document.getElementById("work-or-rest").style.color = "#969696";
                document.getElementById("pomodoro-timer").style.color = "#000";
                document.getElementById("work-or-rest").innerHTML = '学習';
            }
        }
        return remainingSeconds;
    }
}
