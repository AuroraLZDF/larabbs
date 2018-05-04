/*********************************************************************
 *                                                                   *
 *                                                                   *
 *                                                                   *
 *********************************************************************/

/**
 * 显示 2 秒后隐藏
 * @param obj
 * @param message
 */
function fnTimeCountDown(obj, message) {
    var i = 2;
    var func = {
        _hide: function () {
            obj.hide('slow');
        },
        _show: function () {
            if (message) {
                obj.html(message);
            }
            obj.show();
            i--;
        },
        _timeout: function () {
            if (i > 0) {
                func._show();
                setTimeout(func._timeout, 1000);
            } else {
                func._hide();
            }
        }
    };
    func._timeout();
}

/**
 * 异步提交
 * @param obj
 * @param str
 * @returns {boolean}
 */
function formAjax(obj, str) {
    var method = obj.attr('method');
    var action = obj.attr('action');

    if (action.indexOf('?') === -1) {
        action = action + '?_t=' + Math.random();
    } else {
        action = action + '&_t=' + Math.random();
    }

    $.ajax({
        type: method.toLowerCase(),
        url: action,
        data: obj.serialize(),
        cache: false,
        dataType: 'json',
        success: function (data) {
            console.log(data);
            if (data.func) {
                eval(data.func + "()");
            }

            if (data.code == 1) {
                $(str).css('background-color', 'green');
                fnTimeCountDown($(str), data.message);
                if (data.url) {
                    location.href = data.url;
                }
            } else {
                $(str).css('background-color', 'red');
                fnTimeCountDown($(str), data.message);
            }
        },
        error: function () {
            $(str).css('background-color', 'red');
            fnTimeCountDown($(str), '网络错误，请查看网络！');
        }
    });
    return false;
}


$(function () {
    $('.formAjax').submit(function () {
        formAjax($(this), '.error-tip-right');
        // 必须，不然默认submit事件会直接跳转
        return false;
    });

    $('.diy-delete').click(function () {
        var url = $(this).data('url');
        var data = $(this).data('json');

        swal({
            title: "您确定要删除这条信息吗",
            text: "删除后将无法恢复，请谨慎操作！",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "删除",
            closeOnConfirm: false
        }, function () {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,
                data: data,
                type: 'DELETE',
                dataType: 'json',
                success: function (data) {
                    if (data.code == 1) {
                        swal("删除成功！", data.message, "success");
                        //额外绑定一个事件，当确定执行之后返回成功的页面的确定按钮，
                        // 点击之后刷新当前页面或者跳转其他页面
                        $('.confirm').click(function () {
                            location.reload();
                        });
                    } else {
                        swal("删除失败！", data.message, "error");
                        $('.confirm').click(function () {
                            //location.reload();
                            return false;
                        });
                    }
                }
            });
        });
    });
});