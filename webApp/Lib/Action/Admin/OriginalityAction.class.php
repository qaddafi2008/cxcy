<?php
require("Common.php");
class OriginalityAction extends Action{
	//进入创意申请表页面
	public function odeclareTable(){
		$pathOfOdeclaredTable = M('pathofodeclaredtable');
		$result = $pathOfOdeclaredTable->find();
		if($result){
			$this->assign('tableName',$result['path']);
			$this->display();
		}else{
			$this->display('uploadODeclareTable');
		}
	}
	
	//上传创意申请表
	public function doUploadODeclaredTable(){
		R('Admin/Authority/checkAdminLogin');//表示调用Admin分组下Authority模块的checkAdminLogin方法
		
		$result = Common::uploadFile('OriginalityAdmin');
		if("success" == $result){
			$pathOfOdeclaredTable = M('pathofodeclaredtable');
			$data['path'] = $_FILES ["file"] ["name"];
			if($pathOfOdeclaredTable->add($data))
				$this->success('上传成功！','odeclareTable');
			else
				$this->error('保存到数据库失败！');
		}else if("Invalidsize" == $result){
			$this->error("文件大小超过范围，上传失败！");
		}else if("error" == $result){
			$this->error("上传失败！");
		}
	}
	
	//删除创意申请表
	public function doDeleteODeclaredTable(){
		R('Admin/Authority/checkAdminLogin');//表示调用Admin分组下Authority模块的checkAdminLogin方法
		
		if(!Common::removeOneFile($_POST['tname'],'OriginalityAdmin'))
			$this->error('删除服务器中的文件失败！');
		$pathOfOdeclaredTable = M('pathofodeclaredtable');
		
		if($pathOfOdeclaredTable->where('path IS NOT NULL')->delete())
			$this->success('删除成功！');
		else
			$this->error('删除失败！');
	}
	
	//下载创意申请表
	public function downloadODeclaredTable(){
		$file_name = $_GET['tname'];
		Common::downloadFile($file_name,'OriginalityAdmin');
	}
}
?>