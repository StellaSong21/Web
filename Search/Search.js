$(document).ready(function () {
    $("#h1").click(function () {
        $("#back").show();
        $("#login").show();
    });
    $("#h1").mouseover(function () {
        $(this).css("cursor", "pointer");
    });
    $("#login_in").click(function () {
        if ($("#cancel_1").val() === "1") {
            alert("用户不存在！");
            return false;
        } else if ($("#cancel_2").val() === "123456") {
            alert("密码错误！");
            return false;
        } else if ($("#cancel_1").val() === "") {
            alert("请输入用户名！");
            return false;
        } else if ($("#cancel_2").val() === "") {
            alert("请输入密码！");
            return false;
        } else if ($("#cancel_3").val() === "") {
            alert("请输入验证码！");
            return false;
        } else if ($("#cancel_3").val() !== ran) {
            alert("验证码错误！");
            return false;
        } else {
            $(".label").val("");
            $("#login").hide();
            $("#back").hide();
            $("#h1").hide();
            $("#h4").hide();
            $(".h2").show();
            $("#check").text("验证码：");
            $("#check").css({
                "border": "none",
                "background-color": "inherit",
            });
            alert("登陆成功");
        }
    });
    $(".cancel").click(function () {
        $(".label").val("");
        $(".error").css("visibility", "hidden");
        $("#check").text("验证码：");
        $("#check").css({
            "border": "none",
            "background-color": "inherit",
        });
        $("#login").hide();
        $("#back").hide();
    });
    $("#h4").click(function () {
        $("#back").show();
        $("#login_out").show();
    });
    $("#h4").mouseover(function () {
        $(this).css("cursor", "pointer");
    });
    $("#register").click(function () {
        if ($("#cancel_4").val() === "huxiao2") {
            alert("用户名已存在")
        } else if ($("#cancel_4").val().length >= 6 && $("#cancel_4").val().length <= 9 &&
            $("#cancel_5").val().length >= 6 && $("#cancel_5").val().length <= 16 && /^[a-zA-Z]\w{5,15}$/.test($("#cancel_5").val())
            && $("#cancel_6").val() === $("#cancel_5").val() && /^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/.test($("#cancel_7").val())) {
            $(".label").val("");
            $("#login_out").hide();
            $("#back").hide();
            $("#h1").hide();
            $("#h4").hide();
            $(".h2").show();
            alert("注册成功");
        } else {
            $(".label").val("");
            $("#login_out").hide();
            $("#back").hide();
            alert("注册失败，信息未填写完整");
        }
    });
    $(".cancel_0").click(function () {
        $(".label").val("");
        $(".error").css("visibility", "hidden");
        $("#login_out").hide();
        $("#back").hide();
    });
    $("#cancel_1").blur(function () {
        if ($("#cancel_1").val() === "") {
            $('.error_1').css("visibility", "visible");
        }
    });
    $("#cancel_2").blur(function () {
        if ($("#cancel_2").val() === "") {
            $('.error_2').css("visibility", "visible");
        } else {
            $('.error_2').css("visibility", "hidden");
        }
    });
    $("#cancel_3").blur(function () {
        if ($("#cancel_3").val() === "") {
            $('.error_3').css("visibility", "visible");
        } else {
            $('.error_3').css("visibility", "hidden");
        }
    });
    $("#cancel_3").click(function () {
        $("#check").text(function () {
            ran = "";
            for (i = 0; i < 4; i++) {
                ran += Math.floor(Math.random() * 9 + 1);
            }
            return ran;
        });
        $("#check").css({
            "border": "solid 1px black",
            "background-color": "white",
            "padding": "2px",
            "margin-left": "5px",
            "text-align": "center"
        });
    });
    $("#cancel_4").blur(function () {
        if ($(this).val() === "") {
            $('.error_4').css("visibility", "visible");
            $('.error_9').hide();
        } else if ($("#cancel_4").val().length < 6 || $("#cancel_4").val().length > 9 || /^(0|[1-9][0-9]*)$/.test($("#cancel_4").val()) || /^[A-Za-z]+$/.test($("#cancel_4").val())) {
            $('.error_9').show();
            $('.error_4').css("visibility", "hidden");
        } else {
            $('.error_4').css("visibility", "hidden");
            $('.error_9').hide();
        }
    });
    $("#cancel_5").blur(function () {
        if ($(this).val() === "") {
            $('.error_5').css("visibility", "visible");
            $('.error_10').hide();
        } else if ($("#cancel_5").val().length < 6 || $("#cancel_5").val().length > 16 || !/^[a-zA-Z]\w{5,15}$/.test($("#cancel_5").val())) {
            $('.error_5').css("visibility", "hidden");
            $('.error_10').show();
        } else if ($("#cancel_5").val() === $("#cancel_4").val()) {
            $('.error_5').css("visibility", "visible");
            $('.error_10').hide();
        }
        else {
            $('.error_5').css("visibility", "hidden");
            $('.error_10').hide();
        }
    });
    $("#cancel_6").blur(function () {
        if ($(this).val() === "") {
            $('.error_6').css("visibility", "visible");
            $('.error_7').hide();
        } else if ($("#cancel_6").val() !== $("#cancel_5").val()) {
            $('.error_6').css("visibility", "hidden");
            $('.error_7').show();
        } else {
            $('.error_6').css("visibility", "hidden");
            $('.error_7').hide();
        }
    });
    $("#cancel_7").blur(function () {
        if ($("#cancel_7").val() === "") {
            $('.error_8').css("visibility", "visible");
            $('.error_12').hide();
        } else if (!/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/.test($("#cancel_7").val())) {
            $('.error_8').css("visibility", "hidden");
            $('.error_12').show();
        } else {
            $('.error_8').css("visibility", "hidden");
            $('.error_12').hide();
        }
    });
    $("#h3").mouseover(function () {
        $(this).css("cursor", "pointer");
    });
    $("#h3").click(function () {
        $("#h1").show();
        $("#h4").show();
        $(".hide").hide();
    });
    $(".look").click(function () {
        window.location.href = "../Description/Description.html";
    });
    $("#search2").click(function () {
        if ($("#search1").val() !== "") {
            window.location.href = "Search.html";
        }
        else {
            window.location.href = "Search_null.html";
        }
    });
});