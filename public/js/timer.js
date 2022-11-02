"use strict";
{
    let totalSeconds = 0;

    // ユーザのタイマーカウントアップ
    // 1秒ごとに関数countUpTimerを実行する。setIntervalはwindowで提供される
    let timerVariable = setInterval(countUpTimer, 1000);

    function countUpTimer() {
        ++totalSeconds;
        let hour = String(Math.floor(totalSeconds / 3600)).padStart(2, "0");
        let minute = String(
            Math.floor((totalSeconds - hour * 3600) / 60)
        ).padStart(2, "0");
        let seconds = String(
            totalSeconds - (hour * 3600 + minute * 60)
        ).padStart(2, "0");

        document.getElementById("timer").innerHTML =
            hour + ":" + minute + ":" + seconds;
        document.getElementById("room_timer").innerHTML =
            hour + ":" + minute + ":" + seconds;
    }

    // 休憩, 再開ボタンの処理
    const stop = document.getElementById("stop");
    let pauseFlag = 0;

    stop.addEventListener("click", () => {
        if (pauseFlag === 0) {
            window.clearInterval(timerVariable);
            stop.innerHTML = "再開";
            pauseFlag = 1;
        } else {
            timerVariable = setInterval(countUpTimer, 1000);
            stop.innerHTML = "休憩";
            pauseFlag = 0;
        }
    });

    // 他のオンラインユーザのタイマーを1分ごとに時間を+1分カウントアップさせる
    let otherUserTimeCountUp = setInterval(otherUserCountUpFunc, 60000);

    function otherUserCountUpFunc() {
        let otherUserTimes = document.querySelectorAll(
            ".seat.other.seatChange .time"
        );
        console.log(otherUserTimes);
        for (let i = 0; i < otherUserTimes.length; i++) {
            // 取得した他ユーザの時間を：で時間と分に分けて配列に格納
            let totalTimeArr = otherUserTimes[i].innerHTML.split(":");

            let otherMin = Number(totalTimeArr[1]);
            let otherHour = Number(totalTimeArr[0]);

            // 分の部分へ＋1分追加
            otherMin = otherMin + 1;

            // もし60分になったら、時間へ＋1
            if (otherMin === 60) {
                otherHour = otherHour + 1;
                otherMin = 1;
            }

            // 文字列に変換して表示を2桁に
            otherMin = String(otherMin).padStart(2, "0");
            otherHour = String(otherHour).padStart(2, "0");

            // 時間の表示部分を更新
            otherUserTimes[i].innerHTML = otherHour + ":" + otherMin;
        }
    }

    // ポモドーロタイマー
    // 秒換算なので25 * 60
    let remainingSeconds = 25 * 60;
    let pomodoroFlag = 1;
    let pomodoroTimerVariable = setInterval(pomodoroTimer, 1000);

    function pomodoroTimer() {
        --remainingSeconds;
        let minute = String(Math.floor(remainingSeconds / 60)).padStart(2, '0');
        let seconds = String(remainingSeconds - minute * 60).padStart(2, '0');
        document.getElementById("pomodoro-timer").innerHTML = minute + ":" + seconds;

        if (remainingSeconds === 0) {
            if (pomodoroFlag === 1) {
                pomodoroFlag = 2;
                remainingSeconds = 5 * 60;
                document.getElementById("work-or-rest").style.color = "#e70000";
                document.getElementById("pomodoro-timer").style.color = "#e70000";
                document.getElementById("work-or-rest").innerHTML = '休憩';
            } else {
                pomodoroFlag === 1;
                remainingSeconds = 25 * 60;
                document.getElementById("work-or-rest").style.color = "#969696";
                document.getElementById("pomodoro-timer").style.color = "#000";
                document.getElementById("work-or-rest").innerHTML = '学習';
            }
        }
        return remainingSeconds;
    }
}
