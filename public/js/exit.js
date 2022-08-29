"use strict";
{
    let navDropdown = document.getElementById("navbarDropdown");

    let name = document.getElementById("name");
    let email = document.getElementById("email");
    let password = document.getElementById("password");
    let passwordConfirm = document.getElementById("password-confirm");
    let soreBtn = document.getElementById("store-btn");

    // =======================================================================
    // 新規会員登録フォーム(ユーザー名とEメールアドレス、パスワード)
    // =======================================================================
    soreBtn?.addEventListener("click", () => {
        navDropdown.innerHTML = name.value;

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
                            <li>${
                                result.errors.password_confirmation || ""
                            }</li>
                        </ul>
                    `;
                }
            })
            .catch((error) => console.error("失敗", error));
    });
}
