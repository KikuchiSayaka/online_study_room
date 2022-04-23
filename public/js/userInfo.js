'use strict';
{
let yourName = document.getElementById('your-name');
let learningContent = document.getElementById('learning-content');
let yourNameOutput = document.getElementById('your-name-output');
let learningContentOutput = document.getElementById('learning-content-output');
let yourInfoBtn = document.getElementById('your-info-btn');


    yourInfoBtn.addEventListener("click", () => {
        yourNameOutput.innerHTML = yourName.value;
        learningContentOutput.innerHTML = learningContent.value;

        // 入力ボタンを押した時にデータベースも一緒に更新

        let url = '/user/update';

        // console.log(document.querySelector('input[name="_token"]').value);

        fetch(url, {
            method: 'POST',
            headers: {
            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
            'Content-Type': 'application/json'
            },
            body: JSON.stringify({
            name: yourName.value,
            content: learningContent.value,
            })
        })
        .then(res => {
            console.log(res)
            })
            .catch(err => console.log(err));
    });

}
