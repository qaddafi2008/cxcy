<?php if (!defined('THINK_PATH')) exit();?>﻿
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"><html><head><meta http-equiv="content-type" content="text/html; charset=utf-8" /><title>添加赛事</title><link rel="stylesheet" href="__PUBLIC__/css/admin/common.css"
	type="text/css" /><link rel="stylesheet" href="__PUBLIC__/css/admin/main.css"
	type="text/css" /><script type="text/javascript" src="__PUBLIC__/ckeditor/ckeditor.js"></script><script type="text/javascript"
	src="__PUBLIC__/js/My97DatePicker/WdatePicker.js"></script></head><body><form action=""><input type="hidden" id="type" name="type" value=<?php echo ($type); ?> /><table class="form_table"><tr><td class="first_td">标题：</td><td class="second_td"><input id="subject" name="subject"
					class="my_text" type="text" /></td></tr><tr><td class="first_td">发布时间：</td><td class="second_td"><input id="createtime" name="createtime"
					class="my_text" type="text" /><img
					onclick="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss',el:'createtime'})"
					src="__PUBLIC__/js/My97DatePicker/skin/datePicker.gif" width="16" /></td></tr><tr><td class="first_td">赛事描述：</td><td class="second_td"><textarea class="ckeditor" cols="100%"
						id="ckresponsibility" name="ckresponsibility" rows="9"></textarea></td></tr><tr><td class="first_td">上传附件：</td><td class="second_td"><input class="my_text" type="text"
					id="attachmentpath" name="attachmentpath" /></td></tr></table><center><input class="my_button" type="submit" value="确 认 ">&nbsp;&nbsp;&nbsp;&nbsp;
			<input class="my_button" type="reset" value="重 置 "></center></form></body></html>