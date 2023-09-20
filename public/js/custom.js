document.addEventListener("DOMContentLoaded", function () {
    // クリックされた要素を取得
    var clickTargets = document.getElementsByClassName("yourClickTarget");

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
            // 戻ってしまった。。
        };
    }

    // 各要素にクリックイベントを追加
    for (var i = 0; i < clickTargets.length; i++) {
        clickTargets[i].addEventListener("click", clickHandler(i+1));
    }
    
    
});

