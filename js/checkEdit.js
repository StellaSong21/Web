$(function(){
    $("#image").change(function(evt){
        var reader = new FileReader();
        var that = $(this);
        var _src;
        reader.onload = function(e){
            _src = e.target.result;
            console.log(_src);
            that.siblings("#div").children("#img").attr("src",_src);
        };
        reader.readAsDataURL(this.files[0]);
    })
});

function checkTitle() {
    var check;
    var title = document.getElementById("title").value;
    if (title == "" || title == undefined || title == null || !title) {
        document.getElementById("text1").innerHTML = "* 请填写艺术品名字";
        document.getElementById("title").focus();
        check = false;
    }else{
        check = true;
        document.getElementById("text1").innerHTML = "";
    }
    return check;
}
function checkArtist() {
    var check;
    var artist = document.getElementById("artist").value;
    if (artist == "" || artist == undefined || artist == null || !artist) {
        document.getElementById("text2").innerHTML = "* 请填写艺术品作者";
        document.getElementById("artist").focus();
        check = false;
    }else{
        check = true;
        document.getElementById("text2").innerHTML = "";
    }
    return check;
}
function checkPrice() {
    var check;
    var reg = /^[1-9]\d*$/;
    var price = document.getElementById("price").value;
    if (price == "" || price == undefined || price == null || !price) {
        document.getElementById("text3").innerHTML = "* 请填写艺术品价格";
        document.getElementById("price").focus();
        check = false;
    }else if(!reg.test(price)){
        document.getElementById("text3").innerHTML = "* 请填写艺术品价格为正整数";
        document.getElementById("price").focus();
        check = false;
    }
    else{
        check = true;
        document.getElementById("text3").innerHTML = "";
    }
    return check;
}

function checkDescription() {
    var check;
    var description = document.getElementById("description").value;
    if (description == "" || description == undefined || description == null || !description) {
        document.getElementById("text4").innerHTML = "* 请填写艺术品介绍";
        document.getElementById("description").focus();
        check = false;
    }else{
        check = true;
        document.getElementById("text4").innerHTML = "";
    }
    return check;
}
function checkYearOfWork() {
    var check;
    var reg = /^[1-9]\d*$/;
    var yearOfWork = document.getElementById("yearOfWork").value;
    if (yearOfWork == "" || yearOfWork == undefined || yearOfWork == null || !yearOfWork) {
        document.getElementById("text5").innerHTML = "* 请填写艺术品介绍";
        document.getElementById("description").focus();
        check = false;
    }else if(!reg.test(yearOfWork)){
        document.getElementById("text5").innerHTML = "* 请填写艺术品价格为正整数";
        document.getElementById("yearOfWork").focus();
        check = false;
    } else{
        check = true;
        document.getElementById("text5").innerHTML = "";
    }
    return check;
}
function checkWidth() {
    var check;
    var reg = /^[1-9]\d*$/;
    var width = document.getElementById("width").value;
    if (width == "" || width == undefined || width == null || !width) {
        document.getElementById("text6").innerHTML = "* 请填写艺术品宽度";
        document.getElementById("description").focus();
        check = false;
    }else if(!reg.test(width)){
        document.getElementById("text6").innerHTML = "* 请填写艺术品宽度为正整数";
        document.getElementById("width").focus();
        check = false;
    }
    else{
        check = true;
        document.getElementById("text6").innerHTML = "";
    }
    return check;
}
function checkHeight() {
    var check;
    var reg = /^[1-9]\d*$/;
    var height = document.getElementById("height").value;
    if (height == "" || height == undefined || height == null || !height) {
        document.getElementById("text7").innerHTML = "* 请填写艺术品长度";
        document.getElementById("description").focus();
        check = false;
    }else if(!reg.test(height)){
        document.getElementById("text7").innerHTML = "* 请填写艺术品长度为正整数";
        document.getElementById("height").focus();
        check = false;
    }
    else{
        check = true;
        document.getElementById("text7").innerHTML = "";
    }
    return check;
}
function checkGenre() {
    var check;
    var genre = document.getElementById("genre").value;
    if (genre == "" || genre == undefined || genre == null || !genre) {
        document.getElementById("text9").innerHTML = "* 请填写艺术品流派";
        document.getElementById("genre").focus();
        check = false;
    }else{
        check = true;
        document.getElementById("text9").innerHTML = "";
    }
    return check;
}

function checkImage() {
    var check;
    var image = document.getElementById("image").value;
    var index =image.indexOf(".");
    var suffix = image.substring(index);
    if(!image || image == "" || image == undefined || image == null){
        document.getElementById("text8").innerHTML = "* 请添加艺术品图片";
        document.getElementById("image").focus();
        check = false;
    } else if(suffix != ".bmp" && suffix != ".png" && suffix != ".gif" && suffix != ".jpg" && suffix != ".jpeg"){
        document.getElementById("text8").innerHTML = "* 请添加一个图片文件";
        document.getElementById("image").value="";
        document.getElementById("image").focus();
        check = false;
    }else{
        check = true;
        document.getElementById("text8").innerHTML = "";
    }
    return check;
}


function publish() {
    if(checkTitle() && checkArtist() && checkPrice() && checkDescription() && checkYearOfWork() && checkWidth() && checkHeight() && checkGenre() && checkImage()) {
        return true;
    }else{
        return false;
    }
}