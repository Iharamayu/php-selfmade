function deleteUser(userId) {
    if (confirm("本当にアカウントを削除しますか？")) {
        // CSRFトークンを取得
        var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        // Ajaxリクエストを作成
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "/delete-user/" + userId, true);
        xhr.setRequestHeader('Content-Type', 'application/json');
        xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);

        xhr.onload = function () {
            if (xhr.status == 200) {
                var response = JSON.parse(xhr.responseText);
                alert(response.message);
                // アカウントが正常に削除された場合、トップレベルのルートにリダイレクトする
                window.location.href = '/';
            } else {
                alert("アカウントの削除中にエラーが発生しました。");
            }
        };
        xhr.send();
    }
}





