$(document).ready(function () {
    $("#h3").mouseover(function () {
        $(this).css("cursor", "pointer");
    });
    $("#btn_1").click(function () {
        $("#goods_1").hide();
        $("#goods_01").show();
        alert("删除成功");
    });
    $("#btn_2").click(function () {
        $("#goods_2").hide();
        $("#goods_02").show();
        alert("删除成功");
    });
    $("#btn_01").click(function () {
        $("#goods_1").show();
        $("#goods_01").hide();
        alert("已恢复");
    });
    $("#btn_02").click(function () {
        $("#goods_2").show();
        $("#goods_02").hide();
        alert("已恢复");
    });
    $("#btn_3").click(function () {
        alert("已成功拍下")
    });
    $("#btn_3").dblclick(function () {
        alert("购买失败")
    });
    $(".des").click(function () {
        window.location.href = "../Description/Description.html";
    });
    $(".des").mouseover(function () {
        $(this).css("cursor", "pointer");
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