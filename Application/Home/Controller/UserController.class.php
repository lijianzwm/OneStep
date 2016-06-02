<?php
/**
 * Created by PhpStorm.
 * User: lijian
 * Date: 16/6/1
 * Time: 下午3:44
 */

namespace Home\Controller;


use Common\Service\CheckService;
use Think\Controller;

class UserController extends Controller{
    public function login(){
        $this->display();
    }

    public function loginVolidate(){

        $username = I("username");
        $password = I("password");

        CheckService::checkUsernameFormat($username);
        CheckService::checkPasswordFormat($password);

        $password = md5($password);

        $user = M("user")->where("username='$username' and password='$password'")->find();
        if( $user ){
            session("user", $user);
            echoSuccess("登录成功!");
        }else{
            echoError("用户名或密码错误!");
        }
    }

    public function regist(){
        $this->display();
    }

    public function registHandler(){
        $username = I("username");
        $password = I("password");
        $nickname = I("nickname");

        CheckService::checkUsernameFormat($username);
        CheckService::checkPasswordFormat($password);
        CheckService::checkNickname($nickname);
        CheckService::checkUsernameUsed($username);


        $user['username'] = $username;
        $user['nickname'] = $nickname;
        $user['password'] = md5($password);

        $userid = M("user")->add($user);

        if ( $userid ) {
            $user = M("user")->where("id='$userid'")->find();
            session("user", $user);
            echoSuccess("注册成功!");
        }else{
            echoError("注册失败!");
        }
    }

    public function logout(){
        session("user", null );
        $this->success("注销成功!",U("Index/index"));
    }

}