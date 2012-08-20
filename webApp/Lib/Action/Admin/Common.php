<?php
/*
 * Common类，用于
* 1、文件上传（加相应后缀）
* 2、utf-8编码转GBK（用于上传的保存文件名）
* 3、GBK转utf-8（用于下载）
*/
class Common{
	public static function upload($suffix) {//添加后缀形式的文件上传，确保不冲突，以  ### 为分隔
		if(!$_FILES ["file"]) return "nofile";
		if (($_FILES ["file"] ["size"] < 10 * 1024 * 1024)) {

			if ($_FILES ["file"] ["error"] > 0) {
				//echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
				return ERROR;
			} else {
				$destfile = "./Uploads/" . $_FILES ["file"] ["name"]."###".$suffix;
				Common::removefile($suffix);//删除本模块下的附件
				move_uploaded_file ( $_FILES ["file"] ["tmp_name"], Common::utf82gbk($destfile));//上传附件

				return SUCCESS;
			}
		} else {
			//echo "Invalid file";
			return "Invalidsize";
		}
	}
	//删除以suffix为后缀产文件
	public static function removefile($suffix)
	{
		$dir_res = opendir("./Uploads/");
		while($filename = (readdir($dir_res))){
			$temp = explode("###",($filename));
			if ($temp[count($temp)-1] == $suffix)
			{
				unlink("./Uploads/".$filename);
			}
		}
	}
	//utf-8转gbk
	public static function utf82gbk($name)
	{
		return iconv("utf-8","gbk",$name);
	}
	//gbk转utf-8
	public static function gbk2utf8($name)
	{
		return iconv("gbk","utf8",$name);
	}
}
?>