<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><link rel="stylesheet" href="__PUBLIC__/css/admin/common.css" type="text/css" /><title>左侧导航栏</title></head><script  type="text/javascript">var preClassName = "";
	function list_sub_detail(Id, item) {
		if (preClassName != "") {
			getObject(preClassName).className = "left_back"
		}
		if (getObject(Id).className == "left_back") {
			getObject(Id).className = "left_back_onclick";
			outlookbar.getbyitem(item);
			preClassName = Id
		}
	}
	function getObject(objectId) {
		if (document.getElementById && document.getElementById(objectId)) {
			return document.getElementById(objectId)
		} else if (document.all && document.all(objectId)) {
			return document.all(objectId)
		} else if (document.layers && document.layers[objectId]) {
			return document.layers[objectId]
		} else {
			return false
		}
	}
	function outlook() {
		this.titlelist = new Array();
		this.itemlist = new Array();
		this.addtitle = addtitle;
		this.additem = additem;
		this.getbytitle = getbytitle;
		this.getbyitem = getbyitem;
		this.getdefaultnav = getdefaultnav
	}
	function theitem(intitle, insort, inkey, inisdefault) {
		this.sortname = insort;
		this.key = inkey;
		this.title = intitle;
		this.isdefault = inisdefault
	}
	function addtitle(intitle, sortname, inisdefault) {
		outlookbar.itemlist[outlookbar.titlelist.length] = new Array();
		outlookbar.titlelist[outlookbar.titlelist.length] = new theitem(
				intitle, sortname, 0, inisdefault);
		return (outlookbar.titlelist.length - 1)
	}
	function additem(intitle, parentid, inkey) {
		if (parentid >= 0 && parentid <= outlookbar.titlelist.length) {
			insort = "item_" + parentid;
			outlookbar.itemlist[parentid][outlookbar.itemlist[parentid].length] = new theitem(
					intitle, insort, inkey, 0);
			return (outlookbar.itemlist[parentid].length - 1)
		} else
			additem = -1
	}
	function getdefaultnav(sortname) {
		var output = "";
		for (i = 0; i < outlookbar.titlelist.length; i++) {
			if (outlookbar.titlelist[i].isdefault == 1
					&& outlookbar.titlelist[i].sortname == sortname) {
				output += "<div class=list_tilte id=sub_sort_" + i
						+ " onclick=\"hideorshow('sub_detail_" + i + "')\">";
				output += "<span>" + outlookbar.titlelist[i].title + "</span>";
				output += "</div>";
				output += "<div class=list_detail id=sub_detail_" + i + "><ul>";
				for (j = 0; j < outlookbar.itemlist[i].length; j++) {
					output += "<li id=" + outlookbar.itemlist[i][j].sortname
							+ j + " onclick=\"changeframe('"
							+ outlookbar.itemlist[i][j].title + "','"
							+ outlookbar.titlelist[i].title + "','"
							+ outlookbar.itemlist[i][j].key + "')\"><a href=#>"
							+ outlookbar.itemlist[i][j].title + "</a></li>"
				}
				output += "</ul></div>"
			}
		}
		getObject('right_main_nav').innerHTML = output
	}
	function getbytitle(sortname) {
		var output = "<ul>";
		for (i = 0; i < outlookbar.titlelist.length; i++) {
			if (outlookbar.titlelist[i].sortname == sortname) {
				output += "<li id=left_nav_" + i
						+ " onclick=\"list_sub_detail(id,'"
						+ outlookbar.titlelist[i].title
						+ "')\" class=left_back>"
						+ outlookbar.titlelist[i].title + "</li>"
			}
		}
		output += "</ul>";
		getObject('left_main_nav').innerHTML = output
	}
	function getbyitem(item) {
		var output = "";
		for (i = 0; i < outlookbar.titlelist.length; i++) {
			if (outlookbar.titlelist[i].title == item) {
				output = "<div class=list_tilte id=sub_sort_" + i
						+ " onclick=\"hideorshow('sub_detail_" + i + "')\">";
				output += "<span>" + outlookbar.titlelist[i].title + "</span>";
				output += "</div>";
				output += "<div class=list_detail id=sub_detail_" + i
						+ " style='display:block;'><ul>";
				for (j = 0; j < outlookbar.itemlist[i].length; j++) {
					output += "<li id=" + outlookbar.itemlist[i][j].sortname
							+ "_" + j + " onclick=\"changeframe('"
							+ outlookbar.itemlist[i][j].title + "','"
							+ outlookbar.titlelist[i].title + "','"
							+ outlookbar.itemlist[i][j].key + "')\"><a href=#>"
							+ outlookbar.itemlist[i][j].title + "</a></li>"
				}
				output += "</ul></div>"
			}
		}
		getObject('right_main_nav').innerHTML = output
	}
	function changeframe(item, sortname, src) {
		if (item != "" && sortname != "") {
			window.top.frames['navFrame'].getObject('show_text').innerHTML = sortname
					+ "&nbsp;&nbsp;<img src=__PUBLIC__/images/admin/images/slide.gif broder=0 />&nbsp;&nbsp;"
					+ item
		}
		if (src != "") {
			window.top.frames['mainFrame'].location = src
		}
	}
	function hideorshow(divid) {
		subsortid = "sub_sort_" + divid.substring(11);
		if (getObject(divid).style.display == "none") {
			getObject(divid).style.display = "block";
			getObject(subsortid).className = "list_tilte"
		} else {
			getObject(divid).style.display = "none";
			getObject(subsortid).className = "list_tilte_onclick"
		}
	}
	function initinav(sortname) {
		outlookbar.getdefaultnav(sortname);
		outlookbar.getbytitle(sortname);
		//window.top.frames['mainFrame'].location = "mainframe"
	}
</script><body onload="initinav('起步创业')"><div id="left_content"><div id="user_info">     	欢迎您，<strong><?php echo session(C('USER_NAME')) ?></strong><br />[<a href="#">系统管理员</a>，<a href="__URL__/logout" target="_top">退出</a>]
     </div><div id="main_nav"><div id="left_main_nav"></div><div id="right_main_nav"></div></div></div></body><script type="text/javascript">//在这里进行左侧菜单栏的条目控制
	var outlookbar=new outlook();
	var t;
	t=outlookbar.addtitle('项目管理','起步创业',1)
      outlookbar.additem('项目申请',t,'point_add')
      outlookbar.additem('项目可研',t,'pointlist')
      outlookbar.additem('项目批复',t,'ProjectManager_Reply_77.jsp')
      outlookbar.additem('项目调整',t,'ProjectManager_Adjustment_77.jsp')
        
	t=outlookbar.addtitle('项目计划','起步创业',1)	
	outlookbar.additem('验收计划制定',t,'GoToAcceptancePlan.action')
	outlookbar.additem('验收计划查看/编辑',t,'inquireAcceptanceList.action')
	outlookbar.additem('投资计划制定',t,'GoToInvestmentPlan.action')
	outlookbar.additem('投资计划查看/编辑',t,'InquireInvestmentList.action')
	outlookbar.additem('采购计划制定',t,'GoToPurchasingPlan.action')
	outlookbar.additem('采购计划查看/编辑',t,'InquirePurchasingList.action')
	t=outlookbar.addtitle('组织管理','起步创业',1)
	outlookbar.additem('采购各环节负责人选定',t,'InquireNoPrincipalList.action')
	outlookbar.additem('负责人查看/编辑',t,'InquirePrincipalList.action')
	

	t=outlookbar.addtitle('创新创业赛事','助跑创业',1)
    outlookbar.additem('添加赛事',t,'competitionsdetail/type/1')
    outlookbar.additem('赛事管理',t,'index')
	
	t=outlookbar.addtitle('创业导师计划','助跑创业',1)
	outlookbar.additem('填写账户支出',t,'initExpenditureAccountAction.action')
	outlookbar.additem('查看账户支出',t,'expenditure/checkAccount.jsp')
	outlookbar.additem('修改账户支出',t,'expenditure/modifyAccount.jsp')
	
	t=outlookbar.addtitle('验收管理','加油创业',1)
	outlookbar.additem('填报验收完成信息',t,'initFillAcceptanceResultAction.action')
	outlookbar.additem('查看验收信息',t,'acceptance/checkAcceptance.jsp')
	
	
	t=outlookbar.addtitle('表格查看','腾飞创业',1)
	outlookbar.additem('按单位查看项目',t,'viewProjectInfoByTableCompanyAction.action')
	outlookbar.additem('按经费查看项目',t,'previewProjectInfoByTableFundScopeAction.action')
	outlookbar.additem('按时间查看项目',t,'viewProjectInfoByTableTimeAction.action')
	
	t=outlookbar.addtitle('图形查看','腾飞创业',1)
	outlookbar.additem('按等级查看项目',t,'viewProjectInfoByPieClassAction.action')
	outlookbar.additem('按经费查看项目',t,'viewProjectInfoByPieFundScopeAction.action')

	
	t=outlookbar.addtitle('查看信息','用户管理',1)
	outlookbar.additem('查看用户信息',t,'viewUserInfoAction.action?id=${UserID}')
	
	t=outlookbar.addtitle('添加信息','用户管理',1)
	outlookbar.additem('修改用户信息',t,'viewUserInfoAction2.action?id=${UserID}')

</script></html>