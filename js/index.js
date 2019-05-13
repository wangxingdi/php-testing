/**
 * the javascript of index
 * @author wangxd
 * @date 2019-04-22
 */
$(document).ready(function () {
    $("#listNav ul li a").on("click", function (a) {
        a.preventDefault();
        var t = $(this).data("sort"), e = "";
        switch ($("#listNav ul li a").removeClass("active"), $(this).addClass("active"), t) {
            case 110:
                e = "";
                break;
            case 112:
                e = "popular/";
                break;
            case 108:
                e = "low-to-high/";
                break;
            case 104:
                e = "high-to-low/";
                break;
            default:
                e = "/"
        }
        $.ajax({
            url: "fetch_main.php", method: "POST", data: {sort: t}, success: function (a) {
                $("#display-posts-main").html(a), window.history.pushState("object or string", "Title", e);
            }
        })
    })
});
$(document).ready(function () {
    $("#listNavGifts ul li a").on("click", function (t) {
        t.preventDefault();
        var s = $(this).data("sort"), e = "";
        switch ($("#listNavGifts ul li a").removeClass("active"), $(this).addClass("active"), s) {
            case 110:
                e = "gifts-under-20-newest/";
                break;
            case 112:
                e = "gifts-under-20-popular/";
                break;
            default:
                e = "gifts-under-20-newest/"
        }
        $.ajax({
            url: "fetch_gifts.php", method: "POST", data: {sort: s}, success: function (t) {
                $("#display-posts-gifts").html(t), window.history.pushState("object or string", "Title", e);
            }
        });
    });
});
$(document).on("submit", "#formSubscribe", function (t) {
    $("#email").val();
    t.preventDefault(), $("#output-subscribe").html('<div style="font-weight:bold; padding: 4px 10px;" class="alert alert-info">Submitting...</div>').show(), $.ajax({
        type: "POST",
        url: "subscribe.php",
        dataType: "html",
        data: $(this).serialize(),
        success: function (t) {
            $("#output-subscribe").html(t).show(), $("#formSubscribe").trigger("reset"), $(".successTxt").fadeOut(1e4);
        }
    });
});
$(document).on("submit", "#mobileSubscribe", function (e) {
    $("#email-mobile").val();
    e.preventDefault(), $("#output-subscribe-mobile").html('<div style="font-weight:bold; padding: 4px 10px;" class="alert alert-info">Submitting...</div>').show(), $.ajax({
        type: "POST",
        url: "subscribe.php",
        dataType: "html",
        data: $(this).serialize(),
        success: function (e) {
            $("#output-subscribe-mobile").html(e).show(), $("#mobileSubscribe").trigger("reset"), $(".successTxt").fadeOut(1e4);
        }
    })
});