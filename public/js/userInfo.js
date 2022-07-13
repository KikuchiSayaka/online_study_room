"use strict";
{
    let yourName = document.getElementById("your-name");
    let learningContent = document.getElementById("learning-content");
    let yourNameOutput = document.getElementById("your-name-output");
    let learningContentOutput = document.getElementById(
        "learning-content-output"
    );
    let yourInfoBtn = document.getElementById("your-info-btn");
    let navDropdown = document.getElementById("navbarDropdown");
    let otherUserTimes = document.querySelectorAll(
        ".seat.other.seatChange .time"
    );
    let mySeat = document.querySelector("#yourData");

    // 分換算を00:00表示に変更する処理の関数
    function ChangeDisplayTimeFunc(totalMinutes) {
        let hour = String(Math.floor(totalMinutes / 60)).padStart(2, "0");
        let minute = String(totalMinutes - hour * 60).padStart(2, "0");
        let displayTime = hour + ":" + minute;

        return displayTime;
    }

    // 他のユーザの描画処理の関数
    function otherUserUpdate(users) {
        // usersの配列をusers定数に入れる。is_online===1のユーザだけの配列
        // const users = data.users;

        // 自分以外の席seatChangeクラスを取得して配列にする
        let seatChange = [...document.querySelectorAll(".seatChange")];

        // 一旦、全部消す。
        for (let i = 0; i < seatChange.length; i++) {
            seatChange[i].remove();
        }
        // is_online="1"のユーザの席を挿入していく
        for (let i = 0; i < users.length; i++) {
            let displayTime = ChangeDisplayTimeFunc(users[i].total_minutes);
            mySeat.insertAdjacentHTML(
                "afterend",
                `
                <div class="seat other seatChange">
                    <h3 class="guest_name fw-bold">${users[i].name}</h3>
                    <div class="learning_content">${users[i].learning_content}}</div>
                    <div class="time">${displayTime}</div>
                </div>
                `
            );
        }

        // オンラインユーザ描画後に一番最後の席の人を取得
        let lastOnlineUserSeat = document.querySelector(
            ".seat.other.seatChange:last-child"
        );

        for (let i = 0; i < 7 - users.length; i++) {
            // 一番最後の席の人lastOnlineUserSeatの後に挿入
            lastOnlineUserSeat.insertAdjacentHTML(
                "afterend",
                `
                <div class="seat vacancy seatChange">
                    <h3 class="guest_name fw-bold">空室</h3>
                    <div class="learning_content"></div>
                    <div class="time"></div>
                </div>
                `
            );
        }
    }

    // ユーザー名と学習内容を変更したい時のフォーム処理
    yourInfoBtn.addEventListener("click", () => {
        yourNameOutput.innerHTML = yourName.value;
        learningContentOutput.innerHTML = learningContent.value;
        navDropdown.innerHTML = yourName.value;

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

        // .then((response) => {
        //     return response.json();
        // })
        // .then((data) => {
        //     console.log(data);
        // })
        // .catch((err) => {
        //     console.log(err);
        // });
    });

    // ユーザーの総勉強時間を1分ごとにデータベースに格納する
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

    // 初めて画面を開いた時、DBから取得した他のオンラインユーザの勉強時間をの表示を分換算から00:00に加工
    window.addEventListener("load", firstOpenOtherTimefunc());

    function firstOpenOtherTimefunc() {
        otherUserTimes.forEach(function (time) {
            let otherTime = time.innerHTML;
            // let hour = String(Math.floor(otherTime / 60)).padStart(2, "0");
            // let minute = String(otherTime - hour * 60).padStart(2, "0");

            // time.innerHTML = hour + ":" + minute;

            time.innerHTML = ChangeDisplayTimeFunc(otherTime);
        });
    }

    // 30分おきにオンラインの他ユーザを入れ替えて席次表を更新
    let updateOtherUserList = setInterval(OtherUserList, 1800000);

    function OtherUserList() {
        let url = "/room/other-list";

        fetch(url, {
            method: "GET",
            headers: {
                "X-CSRF-TOKEN": document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute("content"),
                "Content-Type": "application/json",
            },
        })
            .then((response) => {
                return response.json();
            })
            .then((data) => {
                // responseで返ってきたdataの中のusers(is_online===1のユーザだけの配列)を引数にして関数otherUserUpdateを動かす
                otherUserUpdate(data.users);
            })
            .catch((err) => {
                console.log(err);
            });
    }

    // ウインドウを閉じたユーザのusersテーブルのis_online=0に、学習記録をrecordテーブルに登録
    window.addEventListener("beforeunload", (event) => {
        let url = "/user/record";

        fetch(url, {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute("content"),
                "Content-Type": "application/json",
            },
        })
            .then((res) => {
                console.log(res);
                console.log("成功");
            })
            .catch((err) => console.log(err));
    });
}
