"use strict";
{
    let yourName = document.getElementById("your-name");
    let learningContent = document.getElementById("learning-content");
    let yourNameOutput = document.getElementById("your-name-output");
    let learningContentOutput = document.getElementById(
        "learning-content-output"
    );
    let yourInfoBtn = document.getElementById("your-info-btn");
    let otherUserTimes = document.querySelectorAll(".OtherUserTotalTime");

    yourInfoBtn.addEventListener("click", () => {
        yourNameOutput.innerHTML = yourName.value;
        learningContentOutput.innerHTML = learningContent.value;

        // 入力ボタンを押した時に席次表だけでなく、データベースも一緒に更新
        let url = "/user/update";

        fetch(url, {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": document.querySelector('input[name="_token"]')
                    .value,
                "Content-Type": "application/json",
            },
            body: JSON.stringify({
                name: yourName.value,
                content: learningContent.value,
            }),
        })
            .then((res) => {
                console.log(res);
            })
            .catch((err) => console.log(err));
    });

    // 総勉強時間をデータベースに格納する

    let updateTime = setInterval(updateTotalTime, 60000);

    function updateTotalTime() {
        let totalTime = document.getElementById("timer").innerHTML;
        let totalTimeArr = totalTime.split(":");

        // 秒数totalTimeArr[2]は捨てて、時間と分だけ取得し、分単位に計算し直す
        let totalMinutes = totalTimeArr[0] * 60 + totalTimeArr[1];

        let url = "/user/learning-time-update";

        fetch(url, {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute("content"),
                "Content-Type": "application/json",
            },
            body: JSON.stringify({
                totalTime: totalMinutes,
            }),
        })
            .then((res) => {
                console.log(res);
            })
            .catch((err) => console.log(err));
    }

    // 他のオンラインユーザの勉強時間を計算して当てはめる
    window.addEventListener("load", updateOtherTimefunc());

    function updateOtherTimefunc() {
        otherUserTimes.forEach(function (t) {
            let otherTime = t.innerHTML;
            let hour = String(Math.floor(otherTime / 60)).padStart(2, "0");
            let minute = String(otherTime - hour * 60).padStart(2, "0");

            t.innerHTML = hour + ":" + minute;
        });
    }
}
