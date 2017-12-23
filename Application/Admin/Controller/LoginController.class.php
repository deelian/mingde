<?php 
namespace Admin\Controller;

use Think\Controller;
use Admin\Controller\VerifyController;

/**
* 登录注册控制器
*/
class LoginController extends Controller
{

	public function login()
	{
		$this->display();
	}

	public function loginCheck()
	{
		if (IS_AJAX) {
//			 $this->ajaxReturn(I());
			// echo "string";
			$verify = A('Verify');
			if($verify->checkVerify(I('subData')['verify'])){
				jRet([
					'code'	=> '200',
					'msg'	=> '验证通过！正在进入系统……',
					'url'	=> U('Index/index')
				]);
			}else{
				jRet([
					'code'	=> '501',
					'msg'	=> '验证码输入有误！我给你换一张吧'
				]);
			}

		}
	}

}

?>