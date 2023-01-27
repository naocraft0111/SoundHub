// function loadMoreData(page)
// {
//     $.ajax({
//         url: '?page=' + page,
//         type:'get',
//         beforeSend: function()
//         {
//             $(".ajax-load").show()
//         }
//     })
//     .done(function(data) {
//         if(data.html == ""){
//             $('.ajax-load').html("No more records found");
//             return;
//         }
//         $('.ajax-load').hide();
//         $("#post-data").append(data.html);
//     })
//     .fail(function(jqXHR, ajaxOptions, thrownError) {
//         alert("Server not responding...");
//     });
// }

// var page = 1;
// $(window).scroll(function(){
//     if($(window).scrollTop() + $(window).height() >= $(document).height()) {
//         page++;
//         loadMoreData(page);
//     }
// });
$(function() {
    var pageCount = '{{ $articles->lastPage() }}';
    var nowPage = 1;
    //無限読み込みInfiniteScroll
    $('.scroll').infinitescroll({	//無限読み込みをさせたい要素を囲う親のクラス名を指定
    navSelector  : ".more",//次のページを読み込むリンクを囲んでいるクラス名を指定
    nextSelector : ".more a",//次のページにリンクする要素を指定
    itemSelector : "#post-data",//無限スクロールで表示をさせたい要素を指定
    animate: true,
        loading: {
        finishedMsg: "全ての記事が読み込まれました", //全ての要素が読み込まれた後の終了メッセージ
        msgText: "読み込み中", //ローディング中の表示テキスト
        img: 'images/loader.gif', //ローディング中の画像を指定
        },
    },
    function(newElements) {
        var $newElems = $(newElements);
        $("#infscr-loading").remove();
        if (nowPage < pageCount) {
            $(".more").appendTo(".scroll");
            $(".more").css({display: 'block'});
        }
        nowPage++;
    });


    // クリック時の動作
    $('.more a').click(function(){
        $('.scroll').infinitescroll('retrieve');
        return false;
    });
});


