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
    let name = document.getElementById("name");
    let email = document.getElementById("email");
    let password = document.getElementById("password");
    let passwordConfirm = document.getElementById("password-confirm");
    let soreBtn = document.getElementById("store-btn");

    // =======================================================================
    // 分換算を00:00表示に変更する処理の関数
    // =======================================================================
    function ChangeDisplayTimeFunc(totalMinutes) {
        let hour = String(Math.floor(totalMinutes / 60)).padStart(2, "0");
        let minute = String(totalMinutes - hour * 60).padStart(2, "0");
        let displayTime = hour + ":" + minute;

        return displayTime;
    }

    // =======================================================================
    // 席次表の他のユーザの描画処理の関数
    // =======================================================================
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

    // =======================================================================
    // ユーザー名と学習内容だけを変更するフォーム
    // =======================================================================
    yourInfoBtn.addEventListener("click", () => {
        // navDropdown.innerHTML = yourName.value;

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
                console.log(res.status);
                return res.json();
            })
            .then((result) => {
                if (result.errors) {
                    console.log(result);
                    let errorMessage = document.getElementById("change-message");

                    errorMessage.innerHTML = `
                    <ul>
                        <li>${result.errors.name || ""}</li>
                        <li>${result.errors.content || ""}</li>
                    </ul>
                    `;
                } else {
                    yourNameOutput.innerHTML = yourName.value;
                    learningContentOutput.innerHTML = learningContent.value;
                    let completeMessage = document.getElementById("change-message");
                    completeMessage.innerHTML = `
                        <p class="text-primary">${'変更が完了しました！'}</p>
                    `;
                }
            })
            .catch((error) => {
                console.error("失敗", error);
            });
    });

    // =======================================================================
    // 新規会員登録フォーム(ユーザー名とEメールアドレス、パスワード)
    // =======================================================================
    soreBtn?.addEventListener("click", () => {
        yourNameOutput.innerHTML = name.value;
        // navDropdown.innerHTML = name.value;

        // 会員登録のボタンを押した時にデータベースへ
        let url = "/user/store";
        console.log(url);
        fetch(url, {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": document.querySelector('input[name="_token"]')
                    .value,
                "Content-Type": "application/json",
            },
            body: JSON.stringify({
                name: name.value,
                email: email.value,
                password: password.value,
                password_confirmation: passwordConfirm.value,
            }),
        })
            .then((res) => {
                console.log(res.status);
                return res.json();
            })
            .then((result) => {
                if (result.errors) {
                    console.log(result);
                    let errorMessage = document.getElementById("error-message");

                    errorMessage.innerHTML = `
                    <ul>
                        <li>${result.errors.name || ""}</li>
                        <li>${result.errors.email || ""}</li>
                        <li>${result.errors.password || ""}</li>
                        <li>${result.errors.password_confirmation || ""}</li>
                    </ul>
                    `;
                } else {
                    let createAccountForm = document.getElementById(
                        "create-account-form"
                    );
                    let registrationCompleted = document.getElementById(
                        "registration-completed"
                    );
                    createAccountForm.remove();
                    registrationCompleted.style.display = "block";
                }
            })
            .catch((error) => console.error("失敗", error));
    });

    // =======================================================================
    // ユーザーの総勉強時間を1分ごとにデータベースに格納する
    // =======================================================================
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

    // =======================================================================
    // 初めて画面を開いた時、DBから取得した他のオンラインユーザの勉強時間の表示を分換算から00:00表示に加工
    // =======================================================================
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

    // =======================================================================
    // 30分おきにオンラインの他ユーザを入れ替えて席次表を更新
    // =======================================================================
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

    // =======================================================================
    // ウインドウを閉じたユーザのusersテーブルのis_onlineを0にして学習記録をrecordテーブルに登録
    // =======================================================================
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
