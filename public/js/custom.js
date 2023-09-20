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
        };
    }

    // 各要素にクリックイベントを追加
    for (var i = 1; i <= clickTargets.length; i++) {
        clickTargets[i].addEventListener("click", clickHandler(i));
    }

    function showInfo(text) {
        const infoBox = document.getElementById('infoBox');
        infoBox.textContent = text;
        infoBox.style.display = 'block';
    }

    function hideInfo() {
        const infoBox = document.getElementById('infoBox');
        infoBox.style.display = 'none';
    }

    for (let i = 1; i <= clickTargets.length; i++) {
        const element = document.getElementById(`infoBox_${i}`);
        console.log(`infoBox_${i}`)
        // マウスオーバーイベントの追加
        element.addEventListener('mouseover', function() {
            // マウスオーバー時の処理をここに記述
            showInfo(text);
        });
        
        // マウスアウトイベントの追加
        element.addEventListener('mouseout', function() {
            // マウスアウト時の処理をここに記述
            hideInfo();
        });
    }
    
});



