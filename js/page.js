$(document).ready(function () {
    var page = 0; //当前页
    var total = 0;
    var pages = 1;

    $('#btSearch').click(function () {
        page = 1;
        pages = 1;
        total = 0;
        Load();
        return false;
    });
    $('#title').change(function () {
        if ($('#title').is(":checked")) {
            $('#title').attr("checked", true);
        } else {
            $('#title').attr("checked", false);
        }
    });
    $('#description').change(function () {
        if ($('#description').is(":checked")) {
            $('#description').attr("checked", true);
        } else {
            $('#description').attr("checked", false);
        }
    });
    $('#artist').change(function () {
        if ($('#artist').is(":checked")) {
            $('#artist').attr("checked", true);
        } else {
            $('#artist').attr("checked", false);
        }
    });
    $('#heat').change(function () {
        if ($('#heat').is(":checked")) {
            $('#heat').attr("checked", true);
            $('#price').attr("checked", false);
        } else {
            $('#heat').attr("checked", false);
            $('#price').attr("checked", true);
        }
    });

    function Load() {
        var key = $('#key').val();//查询条件
        $('#key').value = key;
        let title = 0;
        let description = 0;
        let artist = 0;
        let order = 0;

        if ($('#title').is(":checked")) {
            title = 1;
        }
        if ($('#description').is(":checked")) {
            description = 1;
        }
        if ($('#artist').is(":checked")) {
            artist = 1;
        }
        if ($('#heat').is(":checked")) {
            order = 1;
        }

        $.ajax({
            url: "./page.php",
            data: {
                page: page,
                key: key,
                title: title,
                description: description,
                artist: artist,
                order: order
            },
            type: "POST",
            dataType: "JSON",
            success: function (data0) {
                var str = "";
                var data = eval(data0);
                for (var k in data) {
                    str += "<li class='col-md-4'><a href='detail.php?id=" + data[k].artworkID + "' class='img-responsive'><img src='./img/" +
                        data[k].imageFileName + "' alt='" + data[k].title + "'><div class='caption'><div class='blur'></div><div class='caption-text'><h1>" +
                        data[k].title + "</h1></div></div></a></li>";
                }
                $("#ul").html(str);
            }
        });

        $.ajax({
            url: "./totalPage.php",
            data: {
                page: page,
                key: key,
                title: title,
                description: description,
                artist: artist,
                order: order
            },
            type: "POST",
           dataType: "JSON",
            success: function (data0) {
                var data = eval(data0);
                total = data.length;
                pages = (total % 15 === 0) ? (total / 15) : ((total - (total % 15)) / 15 + 1);
                $('#currentPage').html("第" + page + "/" + pages + "页");
            }
        });
    }


    $('#firstPage').click(function () {
        page = 1;
        Load();
    });

    $('#prePage').click(function () {
        page = (page === 1) ? 1 : (page - 1);
        Load();

    });

    $('#nextPage').click(function () {
        page = (page === pages) ? page : (page + 1);
        Load();

    });

    $('#lastPage').click(function () {

        page = pages;
        Load();

    });

    $('input[name=label]').change(
        function () {
            if ($('#heat').is(":checked")) {
                $('#heat').attr("checked", true);
                $('#price').attr("checked", false);
            } else {
                $('#heat').attr("checked", false);
                $('#price').attr("checked", true);
            }
            Load();
        }
    );
});