$(function(){
  $("a").on("touchstart", function (e){
            $(this).addClass("tapBg");
        });
  $("a").on("touchend", function (e){
        $(this).removeClass("tapBg");
    });
  $("a").on("touchmove", function (e){
        $(this).removeClass("tapBg");
    });

  $("#brand").on("touchstart", function (e){
      $(this).css({"border-radius": "5px", "background": "#AFA6A6"});
    });
  $("#brand").on("touchend", function (e){
      $(this).css({"background": "none"});
    });
})

//点击标签，出现点击效果
function tapStyle(targetDom){
  $(targetDom).on("touchstart", function (e){
            $(this).addClass("tapBg");
        });
  $(targetDom).on("touchend", function (e){
        $(this).removeClass("tapBg");
    });
  $(targetDom).on("touchmove", function (e){
        $(this).removeClass("tapBg");
    });
}