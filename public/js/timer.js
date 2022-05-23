"use strict";
{
    let totalSeconds = 0;
    let otherUserTotalSeconds = 0;

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
    let flag = 0;

    stop.addEventListener("click", () => {
        if (flag === 0) {
            window.clearInterval(timerVariable);
            stop.innerHTML = "再開";
            flag = 1;
        } else {
            timerVariable = setInterval(countUpTimer, 1000);
            stop.innerHTML = "休憩";
            flag = 0;
        }
    });

    // 他のオンラインユーザのタイマーカウントアップ
    let otherUserTime = setInterval(otherUserCountUpFunc, 1000);
    function otherUserCountUpFunc() {
        let OtherUserTotalTime = document.querySelectorAll(
            ".OtherUserTotalTime"
        );
        // console.log(OtherUserTotalTime[0].innerHTML);
        for (let i = 0; i < OtherUserTotalTime.length; i++) {
            let totalTimeArr = OtherUserTotalTime[i].innerHTML.split(":");
            // console.log(totalTimeArr[1]);
        }
    }
}
