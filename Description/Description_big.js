$(document).ready(function () {

    var objDemo = document.getElementById("demo");
    var objSmallBox = document.getElementById("small-box");
    var objMark = document.getElementById("mark");
    var objFloatBox = document.getElementById("float-box");
    var objBigBox = document.getElementById("big-box");
    var objBigBoxImage = objBigBox.getElementsByTagName("img")[0];

    objMark.onmouseover = function () {
        objFloatBox.style.display = "block";
        objBigBox.style.display = "block"
    };

    objMark.onmouseout = function () {
        objFloatBox.style.display = "none";
        objBigBox.style.display = "none"
    };

    objMark.onmousemove = function (ev) {

        var _event = ev || window.event;  //兼容多个浏览器的event参数模式

        var left = _event.clientX - objDemo.offsetLeft - objSmallBox.offsetLeft - objFloatBox.offsetWidth / 2;
        var top = _event.clientY - objDemo.offsetTop - objSmallBox.offsetTop - objFloatBox.offsetHeight / 2;

        //设置边界处理，防止移出小图片
        if (left < 0) {
            left = 0;
        } else if (left > (objMark.offsetWidth - objFloatBox.offsetWidth)) {
            left = objMark.offsetWidth - objFloatBox.offsetWidth;
        }

        if (top < 0) {
            top = 0;
        } else if (top > (objMark.offsetHeight - objFloatBox.offsetHeight)) {
            top = objMark.offsetHeight - objFloatBox.offsetHeight;

        }

        objFloatBox.style.left = left + "px";   //oSmall.offsetLeft的值是相对什么而言
        objFloatBox.style.top = top + "px";

        //求其比值
        var percentX = left / (objMark.offsetWidth - objFloatBox.offsetWidth);
        var percentY = top / (objMark.offsetHeight - objFloatBox.offsetHeight);

        //方向相反，小图片鼠标移动方向与大图片相反，故而是负值
        objBigBoxImage.style.left = -percentX * (objBigBoxImage.offsetWidth - objBigBox.offsetWidth) + "px";
        objBigBoxImage.style.top = -percentY * (objBigBoxImage.offsetHeight - objBigBox.offsetHeight) + "px";
    }
});