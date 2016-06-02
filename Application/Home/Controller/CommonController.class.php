<?php
/**
 * Created by PhpStorm.
 * User: lijian
 * Date: 16/6/1
 * Time: 下午3:42
 */

namespace Home\Controller;


use Think\Controller;

class CommonController extends Controller{
    public function _initialize(){
        if( !session("user") ){
            redirect(U('User/login'));
        }
    }
}