document.addEventListener("DOMContentLoaded", function () {
    // クリックされた要素を取得
    let clickTargets = document.getElementsByClassName("yourClickTarget");

    // クリックイベントハンドラを定義
    function clickHandler(i) {
        return function () {
            // クリックされた要素のテキストを取得
            comment_id = "comment_id_" + i ;
            var get_element = document.getElementById(comment_id);
            var text = get_element.textContent;
            // 入力欄にクリックされたテキストを追加
            var inputField = document.getElementById("yourInputField");
            inputField.value += "@" + text;
        };
    }

    // 各要素にクリックイベントを追加
    for (let i = 0; i < clickTargets.length; i++) {
        clickTargets[i].addEventListener("click", clickHandler(i));
    }

    function showInfo(text,i) {
        const infoBox = document.getElementById('show_box_'+i);
        infoBox.textContent = text;
        infoBox.style.display = 'block';
    }

    function hideInfo(i) {
        const infoBox = document.getElementById('show_box_'+i);
        infoBox.style.display = 'none';
    }
    let element = document.getElementsByClassName("infobox");

    for (let i = 0; i < element.length; i++) {
        // マウスオーバーイベントの追加
        element[i].addEventListener('mouseover',function () {
            showInfo("税金払いたくない",i);
        }); 
        
        // マウスアウトイベントの追加
        element[i].addEventListener('mouseout',function () {
            hideInfo(i);
        });
    }
    
});



