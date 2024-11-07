/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
/* global base_url */

var url = '';

function addTab(title, url) {
    if ($('#main-tab').tabs('exists', title)) {
        $('#main-tab').tabs('select', title);
    } else {
        $('#main-tab').tabs('add', {
            title: title,
            href: base_url + url,
            closable: true,
            fit: true,
            cache: true,
            tabHeight: 20
        });
    }
}

function myFormatDate(_date, row) {
    if (_date !== null) {
        var ss = (_date.split('-'));
        var y = parseInt(ss[0], 10);
        var m = parseInt(ss[1], 10);
        var d = parseInt(ss[2], 10);
        return (d < 10 ? ('0' + d) : d) + '-' + (m < 10 ? ('0' + m) : m) + '-' + y;
    } else {
        return '';
    }

}

function myFormatDateTime(_date_time, row) {
    if (_date_time !== null) {
        var dt = _date_time.split(' ');
        var ss = (dt[0].split('-'));
        var y = parseInt(ss[0], 10);
        var m = parseInt(ss[1], 10);
        var d = parseInt(ss[2], 10);
        return (d < 10 ? ('0' + d) : d) + '-' + (m < 10 ? ('0' + m) : m) + '-' + y + ' ' + dt[1].substring(1, 8);
        ;
    } else {
        return '';
    }
}
function myformatter(date) {
    var y = date.getFullYear();
    var m = date.getMonth() + 1;
    var d = date.getDate();
    return y + '-' + (m < 10 ? ('0' + m) : m) + '-' + (d < 10 ? ('0' + d) : d);
}
function myparser(s) {
    if (!s)
        return new Date();
    var ss = (s.split('-'));
    var y = parseInt(ss[0], 10);
    var m = parseInt(ss[1], 10);
    var d = parseInt(ss[2], 10);
    if (!isNaN(y) && !isNaN(m) && !isNaN(d)) {
        return new Date(y, m - 1, d);
    } else {
        return new Date();
    }
}

function formatPrice(num, row) {
    if (num !== null) {
        var x = '' + num;
        var parts = x.toString().split(".");
        return parts[0].replace(/\B(?=(\d{3})+(?=$))/g, ",") + (parts[1] ? "." + parts[1] : ".00");
    } else {
        return "";
    }
}

document.write('<script type="text/javascript" src="js/UOM.js"></script>');
document.write('<script type="text/javascript" src="js/po.js"></script>');
document.write('<script type="text/javascript" src="js/supplier.js"></script>');
document.write('<script type="text/javascript" src="js/good_receive.js"></script>');
document.write('<script type="text/javascript" src="js/good_receive_ts.js"></script>');




$.fn.serializeObject = function ()
{
    var o = {};
    var a = this.serializeArray();
    $.each(a, function () {
        if (o[this.name]) {
            if (!o[this.name].push) {
                o[this.name] = [o[this.name]];
            }
            o[this.name].push(this.value || '');
        } else {
            o[this.name] = this.value || '';
        }
    });
    return o;
};

open_target = function (method, url, data, target) {
    var form = document.createElement("form");
    form.action = url;
    form.method = method;
    form.target = target || "_self";
    if (data) {
        for (var key in data) {
            var input = document.createElement("textarea");
            input.name = key;
            input.value = typeof data[key] === "object" ? JSON.stringify(data[key]) : data[key];
            form.appendChild(input);
        }
    }
    form.style.display = 'none';
    document.body.appendChild(form);
    form.submit();
};

function popupCenter(url, title, w, h) {
    var left = (screen.width / 2) - (w / 2);
    var top = (screen.height / 2) - (h / 2);
    return window.open(url, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, copyhistory=no, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);
}


