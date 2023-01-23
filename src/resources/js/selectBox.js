// ctrlとshiftキーを無効にして、mousedownによって複数選択可能にする
function keyInvalid() {
    $('#secondary option').on('mousedown', function(e) {
        if (!e.ctrlKey && !e.shiftKey) {
            var selected = $(this).prop('selected');
            $(this).prop('selected', (!selected) ? true : false);
            $(this).parent().focus();

            e.preventDefault();
        }
    });
}
// セレクトボックスの連動
// 親カテゴリのselect要素が変更になるとイベントが発生
$(function() {

    keyInvalid();

    $("#primary").on('change', function () {
        var cate_val = $(this).val();
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            url: "/fetch/category",
            type: "POST",
            data: {'category_val' : cate_val},
            datatype: "JSON",
        })
        .done(function (data) {
            // 子カテゴリのoptionを一旦削除
            $('#secondary option').remove();

            // DBから受け取ったデータを子カテゴリのoptionにセット
            $.each(data, function (key, value) {
                $("#secondary").append(
                    $('<option>').val(value.id).text(value.name));
            });
            
            keyInvalid();
        })
        .fail(function () {
            console.log("失敗");
        });
    });
});
