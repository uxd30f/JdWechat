/*

 * menu 分屏和菜单 字段（最后一个始终是开始菜单的数据）
 * apps app 数组集合
 * app:{
 * 		appid: "101", //app编号
 * 		isicon: 1, //是否显示图标在任务栏 1代表显示
 * 		icon: "&#xe638;", //字体图标的unicode 编码 可用阿里字体图标库http://www.iconfont.cn/
 * 		iconclass: "layui-icon", //字体图标调用项目class 支持 layui-icon(项目的主要框架 www.layui.com) iconfont
 * 		iconbg: "#51555e", //app背景色
 * 		name: "\u5f39\u51fa\u5c42", //app标题
 * 		url: "http://layer.layui.com", //app打开的地址
 * 		height: "", //设置高度 默认不需要
 * 		width: "", //设置宽度 默认不需要
 * 		full: 1 //打开是否全屏
 * 	}
 */
var desktpData = {
    menu: [{
        menuid: "m001",
        "name": "1",
        app: [ "m109","m101", "m106", "m103", "m104", "108", "m105"]
    }, {
        menuid: "m004",
        "name": "opening",
        app: ["m101", "m103", "m104", "m105", "m106"]
    }],
    apps: {
        m109: {
            appid: "101",
            isicon: 1,
            icon: "&#xe628;",
            iconclass: "layui-icon",
            iconbg: "#5FB878",
            name: "角色管理",
            url: "AddAdmin",
            height: "",
            width: "",
            full: 0
        },
        m101: {
            appid: "101",
            isicon: 1,
            icon: "&#xe628;",
            iconclass: "layui-icon",
            iconbg: "#5FB878",
            name: "修改密码",
            url: "UpdatePassword",
            height: "",
            width: "",
            full: 0
        },
        m103: {
            appid: "103",
            isicon: 1,
            icon: "&#xe609;",
            iconclass: "layui-icon",
            iconbg: "#5FB878",
            name: "发布任务",
            url: "admin/releaseTask",
            height: "",
            width: ""
        },
        m104: {
            appid: "104",
            isicon: 1,
            icon: "&#xe60a;",
            iconclass: "layui-icon",
            iconbg: "#5FB878",
            name: "任务信息",
            url: "admin/seeQrCode",
            height: "",
            width: ""
        },
        m105: {
            appid: "105",
            icon: "&#xe638;",
            iconclass: "layui-icon",
            iconbg: "#5FB878",
            name: "扫码签到",
            url: "Reg",
            isicon: 1,
            height: "",
            width: ""
        },
        m106: {
            appid: "106",
            icon: "&#xe612;",
            iconclass: "layui-icon",
            iconbg: "#5FB878",
            name: "所有用户",
            url: "GetAllStudents",
            isicon: 1,
            height: "",
            width: ""
        },
        108: {
            appid: "108",
            icon: "&#xe62a;",
            iconclass: "layui-icon",
            iconbg: "#5FB878",
            name: "活动记录",
            url: "ActivityRecord",
            isicon: 1,
            height: "",
            width: ""
        }
    }
};
