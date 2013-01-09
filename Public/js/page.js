var href = window.location.href;
//当前url
$(document).ready(function() {

    var ishomepage = true;
    $.each($("#menu>li>a"), function(j, item) {
        $(this).attr("class", "but");
    });

    $.each($("#menu>li>dl>dd>a"), function(i, item) {
        if (href.indexOf($(this).attr("href")) != -1) {
            ishomepage = false;
            $(this).parent("dd").parent("dl").parent("li").children("a:first").attr("class", "but_active");
        }
    });

    if (ishomepage) {
        $("#menu>li>a:first").attr("class", "but_active");
    }

    //sidebar一级菜单跟随点击的颜色变化
    $.each($("#list>li>a"), function(i, item) {
        $(this).removeClass("color_active");
        $(this).parent("li").addClass("hover");
        if (href.indexOf($(this).attr("href")) != -1) {
            $(this).addClass("color_active");
            $(this).parent("li").removeClass("hover");
            $(this).parent("li").children("dl").show();
        }
    });

    //sidebar二级菜单跟随点击的颜色变化
    $.each($("#list>li>dl>dd>a"), function(i, item) {
        $(this).click(function() {
            $.each($("#list>li>dl>dd>a"), function(i, item) {
                $(this).removeClass("color_active");
            });
            $(this).addClass("color_active");
            $(this).parent("dd").parent("dl").parent("li").removeClass("hover");
            $(this).parent("dd").parent("dl").parent("li").children("a").addClass("color_active");
            $(this).parent("dd").parent("dl").parent("li").children("dl").show();
        });
    });

    //登陆框
    $(".signin").click(function(e) {
        e.preventDefault();
        $("fieldset#signin_menu").toggle();
        $(".signin").toggleClass("menu-open");
    });

    $("fieldset#signin_menu").mouseup(function() {
        return false
    });
    $(document).mouseup(function(e) {
        if ($(e.target).parent("a.signin").length == 0) {
            $(".signin").removeClass("menu-open");
            $("fieldset#signin_menu").hide();
        }
    });

    //下拉式菜单，主菜单
    $("#menu li").hover(function() {
        $(this).children("dl").slideDown(100)
    }, function() {
        $(this).children("dl").slideUp(100)
    });

    //下拉式菜单，sidebar菜单
    $("#list .hover").hover(function() {
        $(this).children("dl").slideDown(100)
    }, function() {
        $(this).children("dl").slideUp(100)
    });

    
    //sidebar跟随滚动条滚动
    var offset = $("#main_block").offset();
    if (offset != null) {
        var basetop = offset.top;
        //sidebar的基准top
        $(window).scroll(function() {
            var scrolltop = $(window).scrollTop();
            if (scrolltop > basetop) {
                $("#sidebar").animate({
                    top : scrolltop + "px"
                }, {
                    duration : 300,
                    queue : false
                });
            } else {
                $("#sidebar").animate({
                    top : basetop + "px"
                }, {
                    duration : 300,
                    queue : false
                });

            }
        });
    }

    //创业导师部分
    var titlefilter = "all";
    var majorfilter = "all";
    var areafilter = "all";
    var teacherselected;
    initForCYDS();
    initForCYDSTeacher();

    //国际交流活动
    initForGJJL();
    initForCXSS();
    
});

$(function() {
    $('#forgot_username_link').tipsy({
        gravity : 'w'
    });

});

//腾飞创业部分首页的页面内跳转
function forwardto(dest) {
    var atemp = $("#list>li>dl>dd>a:contains(" + dest + ")");
    var hreftemp = $(atemp).parent().parent().parent().children("a:first").attr("href");
    if (href.indexOf(hreftemp) == -1) {
        top.location = hreftemp;
    }

    $.each($("#main_block .title"), function(i, item) {
        if ($(this).text() == dest) {
            var scrolltop = $(this).offset().top + "px";
            $('html, body').animate({
                scrollTop : scrolltop
            }, {
                duration : 300,
                queue : false
            });
        }
    });
}

function initForCYDSTeacher() {
    //tips初始化
    $("#tips").hide();

    $("#sssubmit").click(function() {
        var selected = 0;
        $.each($("#studentselectertable tbody :checked"), function() {
            selected++;
        });
        if (selected > 0) {
            $("#ssform").submit();
        } else {
            $("#tips").html("请选择学生！");
            $("#tips").show();
        }
    });

    $("#epsubmit").click(function() {
        if ($("#teachername").val() != "") {
            $("#teacherprofileform").submit();
        } else {
            $("#tips").html("姓名不能为空！");
            $("#tips").show();
        }
    });
}

//创业导师部分学生页面的初始化
function initForCYDS() {
    //$('table#teacherselectertable').columnFilters({excludeColumns:[0]});
    //tips初始化
    $("#tips").hide();
    //选择职称
    $("#titleselecter").change(function() {
        checkTeacherFilter();
    });

    //选择研究方向
    $("#majorselecter").change(function() {
        checkTeacherFilter();
    });

    //选择研究领域
    $("#areaselecter").change(function() {
        checkTeacherFilter();
    });

    //导师选择框动作
    teacherselected = 0;
    $("#teacherselectertable input:checkbox").each(function() {
        $(this).click(function() {
            if ($(this).attr("checked") == "checked") {
                teacherselected++;
                $(this).parent("td").parent("tr").children(".intentionrow").children("[type='text']").removeAttr("disabled");
                if (teacherselected >= 4) {
                    $.each($("#teacherselectertable input:checkbox"), function() {
                        if ($(this).attr("checked") == "checked") {
                        } else {
                            $(this).attr("disabled", "disabled");
                        }
                    });
                }
            } else {
                $(this).parent("td").parent("tr").children(".intentionrow").children("[type='text']").attr("disabled", "disabled");
                teacherselected = (teacherselected == 0 ? 0 : teacherselected - 1);
                if (teacherselected == 3) {
                    $.each($("#teacherselectertable input:checkbox"), function() {
                        if ($(this).attr("checked") == "checked") {
                        } else {
                            $(this).removeAttr("disabled");
                        }
                    });
                }
            }
        });
    });
    //reset动作
    $("#tsreset").click(function() {
        teacherselected = 0;
        $.each($("#teacherselectertable input:checkbox"), function() {
            $(this).removeAttr("disabled", "disabled");
        });
        $.each($("#teacherselectertable input:text"), function() {
            $(this).attr("disabled", "disabled");
        });
    });

    //submit动作
    $("#tssubmit").click(function() {
        var score = 0;
        var temp = 0;
        var ok = true;
        $.each($("#teacherselectertable input:text:enabled"), function() {
            temp = parseInt($(this).attr("value"), 10);
            if (temp <= 0) {
                ok = false;
            } else {
                score += temp;
            }
        });
        //alert(score);
        if (ok && score == 100) {
            $("#tsform").submit();
        } else {
            $("#tips").html("请将100分值分给你的选项！");
            $("#tips").show(100);
        }
    });

    //导师信息对话框的设计
    setTeacherInfoBox();
    setTeacherNameClick();
}

//设置点击导师弹出导师信息
function setTeacherNameClick() {
    $.each($(".namerow a"), function() {
        $(this).click(function() {
            var tid = $(this).parent("td").parent("tr").children("td").children(":checkbox").val();
            var tname = $(this).parent("td").parent("tr").children(".namerow").text();
            var ttitle = $(this).parent("td").parent("tr").children(".titlerow").text();
            var tmajor = $(this).parent("td").parent("tr").children(".majorrow").text();
            var tarea = $(this).parent("td").parent("tr").children(".arearow").text();

            $("#teacherinfotabel .namefield").html(tname);
            $("#teacherinfotabel .titlefield").html(ttitle);
            $("#teacherinfotabel .majorfield").html(tmajor);
            $("#teacherinfotabel .areafield").html(tarea);

            getTeacherInfo(tid);
        });
    });
}

//根据导师id获取导师信息
function getTeacherInfo(id) {
    $.ajax({
        method : "get",
        url : $("#baseurl").val() + "/getDescriptionById/" + id,
        cache : false,
        success : function(msg) {
            //对返回的数据进行处理
            setTeacherInfoBox();
            var msgtemp = eval('(' + msg + ')');
            msgtemp = eval(msgtemp.data);
            $("#teacherinfotabel .descriptionfield").html(msgtemp.teacherdescription == null ? "暂无" : msgtemp.teacherdescription);
            $("#teacherinfobox").dialog("open");
        }
    });
}

//根据导师id获取导师信息
function getTeacherFullInfo(id) {
    $.ajax({
        method : "get",
        url : $("#baseurl").val() + "/getDescriptionById/" + id,
        cache : false,
        success : function(msg) {
            //对返回的数据进行处理
            if (msg == null || msg == "") {
                msg = "暂无";
            }
            setTeacherInfoBox();
            showTeacherInfo(msg);
        }
    });

}

//显示导师信息
function showTeacherInfo(message) {
    var msg = eval('(' + message + ')');
    msg = eval(msg.data);

    $("#teacherinfotabel .namefield").html(msg.teachername);
    $("#teacherinfotabel .titlefield").html(msg.teachertitle);
    $("#teacherinfotabel .majorfield").html(msg.major);
    $("#teacherinfotabel .areafield").html(msg.area);
    $("#teacherinfotabel .descriptionfield").html(msg.teacherdescription);
    $("#teacherinfobox").dialog("open");
}

//导师信息对话框的设置
function setTeacherInfoBox() {
    //设置消息框
    $("#teacherinfobox").dialog({
        title : "导师信息",
        modal : true,
        autoOpen : false,
        height : 480,
        width : 640,
        minHeight : 240,
        minWidth : 320,
        maxHeight : 800,
        maxWidth : 1024,
        show : {
            effect : 'fade',
            speed : 250
        },
        hide : {
            effect : 'fade',
            duration : 250
        },
        buttons : {
            "确定" : function() {
                $(this).dialog('close');
            }
        }
    });
}

//创业导师计划用于筛选的下拉列表的检查
function checkTeacherFilter() {
    titlefilter = $("#titleselecter").children('option:selected').val();
    majorfilter = $("#majorselecter").children('option:selected').val();
    areafilter = $("#areaselecter").children('option:selected').val();
    if (titlefilter == "all" && areafilter == "all" && majorfilter == "all") {
        $("#teacherselectertable tr").show();
    } else {
        $("#teacherselectertable tr").show();
        if (titlefilter != "all") {
            $.each($(".titlerow:visible"), function() {
                if ($(this).text() != titlefilter) {
                    $(this).parent("tr").hide();
                }
            });
        }
        if (majorfilter != "all") {
            $.each($(".majorrow:visible"), function() {
                if ($(this).text() != majorfilter) {
                    $(this).parent("tr").hide();
                }
            });
        }
        if (areafilter != "all") {
            $.each($(".arearow:visible"), function() {
                if ($(this).text() != areafilter) {
                    $(this).parent("tr").hide();
                }
            });
        }
    }
}

function writeObj(obj) {
    var description = "";
    for (var i in obj) {
        var property = obj[i];
        description += i + " = " + property + "\n";
    }
    alert(description);
}

function ShowObjProperty(Obj) {
    var PropertyList = '';
    var PropertyCount = 0;
    for (i in Obj) {
        if (Obj.i != null)
            PropertyList = PropertyList + i + '属性：' + Obj.i + '\r\n';
        else
            PropertyList = PropertyList + i + '方法\r\n';
    }
    alert(PropertyList);
}

function initForGJJL() {
    setBaomingBox();
    $("#baomingpage").hide();
}

//报名
function baoming(id) {
    $("#baomingpage #actid").attr("value", id);
    $("#baomingpage").dialog("open");
}

//报名信息对话框的设置
function setBaomingBox() {
    //设置消息框
    $("#baomingpage").dialog({
        title : "提交材料",
        modal : true,
        autoOpen : false,
        height : 320,
        width : 480,
        minHeight : 240,
        minWidth : 320,
        maxHeight : 800,
        maxWidth : 1024,
        show : {
            effect : 'fade',
            speed : 250
        },
        hide : {
            effect : 'fade',
            duration : 250
        },
        buttons : {
            "提交" : function() {
                if ($("#baomingfile").attr("value") != "" && $("#baomingfile").attr("value") != null) {
                    $("#baomingform").submit();
                } else {
                    alert("请选择上传的文件！");
                }
            },
            "取消" : function() {
                $(this).dialog('close');
            }
        }
    });
}

function initForCXSS() {
    setTijiaoBox();

}

function tijiao() {
    setTijiaoBox();
    $("#tijiaopage").dialog("open");
}

//报名信息对话框的设置
function setTijiaoBox() {
    //设置消息框
    $("#tijiaopage").dialog({
        title : "提交材料",
        modal : true,
        autoOpen : false,
        height : 320,
        width : 480,
        minHeight : 240,
        minWidth : 320,
        maxHeight : 800,
        maxWidth : 1024,
        show : {
            effect : 'fade',
            speed : 250
        },
        hide : {
            effect : 'fade',
            duration : 250
        },
        buttons : {
            "提交" : function() {
                if ($("#tijiaofile").attr("value") != "" && $("#tijiaofile").attr("value") != null) {
                    $("#tijiaoform").submit();
                } else {
                    alert("请选择上传的文件！");
                }
            },
            "取消" : function() {
                $(this).dialog('close');
            }
        }
    });
	
	//为个人信息更新按钮添加点击事件
	$("#updateInfobtn").click(function(){
		var newname = $("#sname").val();
		if("" == newname)
			alert("姓名不能为空！");
		else if($("#hname").val() == newname)
			alert("请修改后再点击按钮！");
		else
			$("#infoForm").submit();
	});
	
	//为个人修改密码按钮添加点击事件
	$("#updatePswdbtn").click(function(){
		if($('#npswd').val() == ''){
			alert('新密码不能为空！');
		}else if($('#pswd').val() == $('#npswd').val()){
			alert('新旧密码不能一样！');
		}else if($('#snpswd').val() != $('#npswd').val())
			alert('两次输入的新密码不同！');
		else
		    $("#passwordForm").submit();
	});
}

