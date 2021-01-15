$(document).ready(function () {
    $("button").click(function () {

    });
    $("#h3").mouseover(function () {
        $(this).css("cursor", "pointer");
    });
    $("#top").click(function () {
        $(".top").show();
        $("#back").show();
    });
    $("#sure").click(function () {
        if (!/^[1-9]\d*$/.test($("#number").val())) {
            alert("请输入合法数字");
            $("#number").val("");
        } else if ($("#number").val() > 0) {
            var a = parseFloat($("#yue").text());
            $("#yue").text(a + parseFloat($("#number").val()));
            alert("充值成功");
            $(".top").hide();
            $("#back").hide();
            $("#number").val("");
        }
    });
    $("#cancel").click(function () {
        $(".top").hide();
        $("#back").hide();
        $("#number").val("");
    });
    $("#search2").click(function () {
        if ($("#search1").val() !== "") {
            window.location.href = "../Search/Search.html";
        }
        else {
            window.location.href = "../Search/Search_null.html";
        }
    });
});