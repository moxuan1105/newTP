function jumpHref(obj) {
    var href = obj.attr('lay-href');

    if (undefined !== href) {
        $("iframe").attr("src",href);
    }
}

$('li dl a').click(function () {
    jumpHref($(this))   
})

layui.use(['element'], function () {
    let element = layui.element;
})