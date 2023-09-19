document.addEventListener("DOMContentLoaded", function () {
    // クリックされた要素を取得
    var clickTarget = document.getElementById("yourClickTarget"); // クリック対象の要素のIDを指定

    // クリックイベントをリッスン
    clickTarget.addEventListener("click", function () {
        // クリックされた要素のテキストを取得
        var element = document.getElementById("comment_id");

        // 入力欄にクリックされたテキストを追加
        var inputField = document.getElementById("yourInputField"); // 入力欄のIDを指定
        inputField.value += "@" + element;
    });
});
