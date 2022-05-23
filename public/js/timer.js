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
    let otherUserTime = setInterval(otherUserCountUpFunc, 60000);

    function otherUserCountUpFunc() {
        let OtherUserTotalTime = document.querySelectorAll(
            ".OtherUserTotalTime"
        );

        for (let i = 0; i < OtherUserTotalTime.length; i++) {
            // 取得した他ユーザの時間を：で時間と分に分けて配列に格納
            let totalTimeArr = OtherUserTotalTime[i].innerHTML.split(":");

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
            OtherUserTotalTime[i].innerHTML = otherHour + ":" + otherMin;
        }
    }
}
