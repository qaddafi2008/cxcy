<?php

class CompetitionAction extends Action {
	
	public function detail() {
		//var_dump($_GET);
		$module = $_GET ['_URL_'] [3];
		$submodule = $_GET ['_URL_'] [4];
		if ($module == "cxss") {
			$contition = array ('comtype' => 1 );
			$competitions = M ( 'competitions' );
			$temp = $competitions->where ( $condition )->select ();
			$this->assign ( "competition", $temp [0] );
		
		//echo $module;
		}
		$this->display ();
	}
	public function submit() {
		//print_r($_FILES);
		$module = $_GET ['_URL_'] [3];
		$submodule = $_GET ['_URL_'] [4];
		if ($module == "cxss" && ! $submodule) {
			$competition = array ('comid' => $_POST ["comid"], 'subject' => $_POST ["subject"], 'createtime' => $_POST ['createtime'], 'description' => $_POST ['description'] );
			if (! isset ( $_POST ['alreadyfile'] )) {
				$competition ['attachmentpath'] = "";
			}
			if ($this->upload () == SUCCESS) {
				$competition ['attachmentpath'] = $_FILES ["file"] ["name"];
			}
			$competitions = M ( 'competitions' );
			$result = $competitions->save ( $competition );
		}
		if ($result) {
			// 成功后返回客户端新增的用户ID，并返回提示信息和操作状态
			$this->ajaxReturn ( $result, "(更新成功！)", 1 );
		} else {
			// 错误后返回错误的操作状态和提示信息
			$this->ajaxReturn ( 0, "(未更新！)", 0 );
		}
	
		//$this->display("view");
	//redirect(U('/Admin/Tengfei/view/mid/3'), 5, '页面跳转中...');
	}
	
	protected function upload() {
		
		if (($_FILES ["file"] ["size"] < 10 * 1024 * 1024)) {
			
			if ($_FILES ["file"] ["error"] > 0) {
				//echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
				return ERROR;
			} else {
				if (file_exists ( "./Uploads/" . $_FILES ["file"] ["name"] )) {
					echo $_FILES ["file"] ["name"] . " already exists. ";
					unlink("./Uploads/" . $_FILES ["file"] ["name"]);
				} else {
					move_uploaded_file ( $_FILES ["file"] ["tmp_name"], "./Uploads/" . $_FILES ["file"] ["name"] );
					//echo "Stored in: " . "./Uploads/" . $_FILES ["file"] ["name"];
				}
				return SUCCESS;
			}
		} else {
			//echo "Invalid file";
			return "Invalid";
		}
	}

}