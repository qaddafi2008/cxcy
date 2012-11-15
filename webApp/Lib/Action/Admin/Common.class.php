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
	
	//添加后缀形式的文件上传，确保不冲突，以  ### 为分隔,只删除已经存在的同名文件
	public static function uploadFile($suffix) {
		if(!$_FILES ["file"]) return "nofile";
		if (($_FILES ["file"] ["size"] < 10 * 1024 * 1024)) {

			if ($_FILES ["file"] ["error"] > 0) {
				return "error";
			} else {
				$destfile = "./Uploads/" . $_FILES ["file"] ["name"]."###".$suffix;
				$destfile = Common::utf82gbk($destfile);
				if(file_exists($destfile))
					unlink($destfile);
				
				if(move_uploaded_file ( $_FILES ["file"] ["tmp_name"], $destfile))//上传附件
					return "success";
				else
					return "error";
			}
		} else {
			//echo "Invalid file";
			return "Invalidsize";
		}
	}
	
	public static function copyfile($source,$dest){
		$sfile = Common::utf82gbk("./Uploads/".$source);
		$dfile = Common::utf82gbk("./Uploads/".$dest);
		return copy($sfile,$dfile);
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
	
	//删除文件名的###后辍
	public static function removesuffix($filename)
	{
		$index = strrpos($filename,"###");
		return substr($filename,0,$index);
	}
	
	//删除文件名为“$filename###$suffix”的文件
	public static function removeOneFile($filename,$suffix)
	{
		$destfile = "./Uploads/" . $filename."###".$suffix;
		$destfile = Common::utf82gbk($destfile);
		return unlink($destfile);
	}
	
	public static function removeFileDirectly($file){
		$destfile = "./Uploads/".$file;
		return unlink($destfile);
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
	
	//下载文件名为“$filename###$suffix”的文件
	public static function downloadFile($file_name,$suffix)
	{
		$real_file_name = $file_name."###".$suffix;     //下载文件名  
		$file_dir = "./Uploads/";        //下载文件存放目录
		$destfile =  Common::utf82gbk($file_dir . $real_file_name);
		//$destfile = $file_dir . $real_file_name;
		//检查文件是否存在  
		if (! file_exists ( $destfile )) {
			//echo $file_name;
			return "nofile";
			//$this->error('找不到文件！'.$destfile); 
		} else {  
			//打开文件  
			$file = fopen ( $destfile, "r" );  
			//输入文件标签   
			Header ( "Content-type: application/octet-stream" );  
			Header ( "Accept-Ranges: bytes" );  
			Header ( "Accept-Length: " . filesize ( $destfile ) );  
			Header ( "Content-Disposition: attachment; filename=" . Common::utf82gbk($file_name) );  
			//输出文件内容   
			//读取文件内容并直接输出到浏览器  
			echo fread ( $file, filesize ( $destfile ) );  
			fclose ( $file );    
		}
	}
}
?>