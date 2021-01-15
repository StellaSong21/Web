$(document).ready(function () {
    //轮播速度 5秒
    (function () {
        $('#views').carousel({interval: 7000})
    })();
    //前端的登陆 注册验证
    {
        //取消
        $('.cancel').click(function () {
            $("input").val("");
            $(".error").css("visibility", "hidden");
            $('#btLogin').attr("disabled", true);
            $('#btRegister').attr("disabled", true);
            history.back(-1);
        });

        //用户名
        $('#c').blur(function () {
            if ($('#c').val() === "") {
                $('.error_1').css("visibility", "visible");
            }
            else {
                $('.error_1').css("visibility", "hidden");
                if ($('#d').val() !== "") {
                    $('#btLogin').attr("disabled", false);
                }
            }
        });
        //密码
        $('#d').blur(function () {
            if ($('#d').val() === "") {
                $('.error_2').css("visibility", "visible");
            } else {
                $('.error_2').css("visibility", "hidden");
                if ($('#c').val() !== '') {
                    $('#btLogin').attr("disabled", false);
                }
            }
        });

        //用户名
        $('#g').blur(function () {
            if ($('#g').val() === '' || $("#g").val().length < 6 || $("#g").val().length > 9 || /^(0|[1-9][0-9]*)$/.test($("#g").val()) || /^[A-Za-z]+$/.test($("#g").val())) {
                $('.error_3').css("visibility", "visible");
            }
            else {
                $('.error_3').css("visibility", "hidden");
                if (register()) {
                    $('#btRegister').attr("disabled", false);
                }
            }
        });
        //密码
        $('#h').blur(function () {
            if ($("#h").val() === '' || $("#h").val().length < 6 || $("#h").val().length > 16 || /^(0|[1-9][0-9]*)$/.test($("#h").val()) || $("#h").val() === $("#g").val()) {
                $('.error_4').css("visibility", "visible");
            }
            else {
                $('.error_4').css("visibility", "hidden");
                if (register()) {
                    $('#btRegister').attr("disabled", false);
                }
            }
        });
        //再次输入密码
        $('#i').blur(function () {
            if ($("#i").val() === '' || $("#i").val() !== $("#h").val()) {
                $('.error_5').css("visibility", "visible");
            }
            else {
                $('.error_5').css("visibility", "hidden");
                if (register()) {
                    $('#btRegister').attr("disabled", false);
                }
            }
        });
        //邮箱
        $('#j').blur(function () {
            if ($("#j").val() === '' || !/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/.test($("#j").val())) {
                $('.error_6').css("visibility", "visible");
            }
            else {
                $('.error_6').css("visibility", "hidden");
                if (register()) {
                    $('#btRegister').attr("disabled", false);
                }
            }
        });
        //电话
        $('#k').blur(function () {
            if ($("#k").val() === '' || !/^\d{3,4}-\d{7,8}$/.test($("#k").val())) {
                $('.error_7').css("visibility", "visible");
            }
            else {
                $('.error_7').css("visibility", "hidden");
                if (register()) {
                    $('#btRegister').attr("disabled", false);
                }
            }
        });
        //地址
        $('#l').blur(function () {
            if ($("#l").val() === '') {
                $('.error_8').css("visibility", "visible");
            }
            else {
                $('.error_8').css("visibility", "hidden");
                if (register()) {
                    $('#btRegister').attr("disabled", false);
                }
            }
        });

        //前端判断是否注册
        function register() {
            if ($('#g').val() === '' || $("#g").val().length < 6 || $("#g").val().length > 9 || /^(0|[1-9][0-9]*)$/.test($("#g").val()) || /^[A-Za-z]+$/.test($("#g").val())
                || $("#h").val() === '' || $("#h").val().length < 6 || $("#h").val().length > 16 || /^(0|[1-9][0-9]*)$/.test($("#h").val()) || $("#h").val() === $("#g").val()
                || $("#i").val() === '' || $("#i").val() !== $("#h").val()
                || $("#j").val() === '' || !/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/.test($("#j").val())
                || $("#k").val() === '' || !/^\d{3,4}-\d{7,8}$/.test($("#k").val())
                || $("#l").val() === '') {
                return false;
            }
            else {
                return true;
            }
        }
    }

    //登陆
    $("#login").submit(function () {
        login();
        history.go(-1);
        return false;
    });

    //AJAX登陆
    function login() {
        $.ajax({
            type: "POST",
            url: "checkLogin.php",
            data: "&id=" + $('#c').val() + "&p=" + $('#d').val(),
            success: function (msg) {
                if (msg === "success") {
                    window.location.href = "./home.php";
                } else {
                    $('#login').hide();
                    $('#checkLogin').show();
                }
            }
        });
    }

    $('.ok').click(function () {
        $('#login').show();
        $('#checkLogin').hide();
        $('#checkRegister').hide();
    });

    $('#f').click(function () {
        $.ajax({
            url: "out.php"
        })
    });

    //注册
    $("#register").submit(function () {
        checkRegister();
        return false;
    });

    //AJAX注册
    function checkRegister() {
        $.ajax({
            type: "POST",
            url: "checkRegister.php",
            data: $('#register').serialize(),
            success: function (msg) {
                if (msg === "success") {
                    window.location.href = "./home.php";
                } else {
                    $('#register').hide();
                    $('#checkRegister').show();
                }
            }
        });
    }

    $('#top').click(function () {
        $('.recharge').show();
        $('#back0').show();
    });

    $('#btCancel').click(function () {
            $('#number').val('');
            $('.recharge').hide();
            $('#back0').hide();
        }
    );

    $('.recharge').submit(function () {
        if ($('#number').val() > 0) {
            var add = parseInt($('#number').val());
            var old = parseInt($('#balance').html());
            $('#balance').html(add + old);
            reCharge();
        }
        return false;
    });

    function reCharge() {
        $.ajax({
            type: "POST",
            url: "./recharge.php",
            data: {
                money: $('#number').val()
            },
            success: function (msg) {
                if (msg === "success") {
                    $('#number').val('');
                    $('.recharge').hide();
                    $('#back0').hide();
                }
            }
        });
        $('#number').val('');
    }

    var add = 0;
    $('#addCarts').one('click', function (e) {
        if (add % 2 === 1) {
            return;
        }
        $('#addCarts').attr("disabled", true);
        addCarts();

        return false;
    });


    function addCarts() {
        $.ajax({
            type: "POST",
            url: "./addToCarts.php",
            data: {
                artworkID: $('img').attr("id")
            },
            success: function (m) {
                $('#msg').html("成功加入购物车");
                $('#back0').show();
                $('#already').show();
                add++;
            }
        })
    }

    $('#btAlready').click(function () {
        $('#msg').html('');
        $('#back0').hide();
        $('#already').hide();
        $('#balance0').hide();
    });

    $('.delete').click(function () {
        $("[value=" + deleteCarts($(this).val()) + "]").css("display", "none");
        location.reload();
        return false;
    });

    function deleteCarts(title) {
        $.ajax({
            type: "POST",
            url: "./deleteCarts.php",
            data: {title: title},
            success: function () {
                let id0 = title + "0";
                return id0;
            }
        })
    }

    $('#payment').click(function () {
            checkPayment();
            checkBalance();
            return false;
        }
    );

    function checkPayment() {
        $.ajax({
            type: "POST",
            url: "./checkPayment.php",
            data: {},
            success: function (array) {
                if (array !== '') {
                    var change = array.split("/");
                    for (let i = 0; i < change.length; i++) {
                        deleteChange(change[i]);
                    }
                }
            }
        })
    }

    function deleteChange(change) {
        $.ajax({
            type: "POST",
            url: "./deleteCarts.php",
            data: {
                title: change
            },
            success: function () {
                let id0 = change + "0";
                $("[value=" + id0 + "]").css("display", "none");
            }
        })
    }

    function checkBalance() {
        $.ajax({
            type: "POST",
            url: "./checkBalance.php",
            data: {},
            success: function (m) {
                if (m === "true") {
                    changeBalance();
                } else {
                    $('#back0').show();
                    $('#balance0').show();
                }
            }
        })
    }

    function changeBalance() {
        $.ajax({
            type: "POST",
            url: "./trade.php",
            data: {},
            success: function (m) {
                location.reload();
            }
        })
    }


    $('.btDelete').click(function () {
        $('#back0').show();
        $('#deleteAnyway').show();
        let id = $(this).attr("id");
        $('#btDelete').click(function () {
            $.ajax({
                type: "POST",
                url: "./deleteWork.php",
                data: {
                    id: id
                },
                success: function (m) {
                    $('#deleteAnyway').hide();
                    if (m === "success") {
                        $('#back0').hide();
                    }
                    else {
                        $('#fail').show();
                    }
                }
            });
            return false;
        });
        $('#btFail').click(function () {
            $('#fail').hide();
            $('#back0').hide();
        });
    });


});