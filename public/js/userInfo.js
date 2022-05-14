"use strict";
{
    let yourName = document.getElementById("your-name");
    let learningContent = document.getElementById("learning-content");
    let yourNameOutput = document.getElementById("your-name-output");
    let learningContentOutput = document.getElementById(
        "learning-content-output"
    );
    let yourInfoBtn = document.getElementById("your-info-btn");

    yourInfoBtn.addEventListener("click", () => {
        yourNameOutput.innerHTML = yourName.value;
        learningContentOutput.innerHTML = learningContent.value;

        // 入力ボタンを押した時に席次表だけでなく、データベースも一緒に更新
        let url = "/user/update";
        // console.log(document.querySelector('input[name="_token"]').value);

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
        let totalTimeArrangement = totalTime.split(":");

        let totalMinutes =
            totalTimeArrangement[0] * 360 +
            totalTimeArrangement[1] * 60 +
            totalTimeArrangement[2];

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
}
