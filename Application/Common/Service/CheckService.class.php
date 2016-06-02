<?php

/**
 * Created by PhpStorm.
 * User: lijian
 * Date: 16/6/1
 * Time: 下午3:45
 */

namespace Common\Service;

class CheckService{

    /**
     * 返回校验结果
     * @param $status 0:成功; 1:失败
     * @param $msg
     * @return mixed
     */
    private static function returnResult( $status, $msg ){
        $result['error_code'] = $status;
        $result['msg'] = $msg;
        return $result;
    }

    private static function success($msg){
        return self::returnResult(0, $msg);
    }

    private static function error($msg){
        echoError($msg);
    }

    /**
     * 校验账号是否合法,如果是英文和数字:3<长度<15,如果是中文:1<长度<8,中英数混合:2<长度<9
     * @param $username
     * @return mixed
     */
    public static function checkUsernameFormat( $username ){
        $char = '/^[A-Za-z0-9_]+$/';
        $chinese = '/^[\x{4e00}-\x{9fa5}]+$/u';
        $mixed = '/^[\x{4e00}-\x{9fa5}A-Za-z0-9_]+$/u';
        //如果全都是字符
        if( preg_match($char, $username) ){
            if( strlen($username ) > 15 ){
                echoError("用户名过长!");
            }else if( strlen($username)< 3 ){
                echoError("用户名过短!");
            }else{
                return self::success("用户名格式正确!");
            }
        }

        //如果全都是中文
        if( preg_match($chinese, $username) ){
            if( mb_strlen($username, 'UTF8') > 8 ){
                echoError("用户名过长!");
            }else if( mb_strlen($username, 'UTF8') < 1 ){
                echoError("用户名过短!");
            }else{
                return self::success("用户名格式正确!");
            }
        }

        //如果是中文和字符混合
        if( preg_match($mixed, $username) ){
            if( mb_strlen($username, 'UTF8') > 9 ){
                echoError("用户名过长!");
            }else if( mb_strlen($username, 'UTF8') < 2 ){
                echoError("用户名过短!");
            }else{
                return self::success("用户名格式正确!");
            }
        }
        echoError("用户名只能由中文,数字和大小写字母组成!");
    }

    public static function checkUsernameUsed( $username ){
        if (M("user")->where("username='$username'")->find()) {
            echoError("用户名已经被使用过!");
        }else{
            return self::success("用户名未被使用!");
        }
    }

    /**
     * 校验密码格式是否合法
     * @param $password
     * @return mixed
     */
    public static function checkPasswordFormat( $password ){
        $patrn = '/^(\w){6,20}$/';
        if (preg_match($patrn, $password)) {
            return self::success("密码格式正确!");
        }else{
            echoError("密码须由6-20个字母、数字、下划线组成!");
        }
    }

    public static function checkNickname( $nickname ){
        $char = '/^[A-Za-z0-9_]+$/';
        $chinese = '/^[\x{4e00}-\x{9fa5}]+$/u';
        $mixed = '/^[\x{4e00}-\x{9fa5}A-Za-z0-9_]+$/u';
        //如果全都是字符
        if( preg_match($char, $nickname) ){
            if( strlen($nickname ) > 15 ){
                echoError("昵称过长!");
            }else if( strlen($nickname)< 3 ){
                echoError("昵称过短!");
            }else{
                return self::success("昵称格式正确!");
            }
        }

        //如果全都是中文
        if( preg_match($chinese, $nickname) ){
            if( mb_strlen($nickname, 'UTF8') > 8 ){
                echoError("昵称过长!");
            }else if( mb_strlen($nickname, 'UTF8') < 1 ){
                echoError("昵称过短!");
            }else{
                return self::success("昵称格式正确!");
            }
        }

        //如果是中文和字符混合
        if( preg_match($mixed, $nickname) ){
            if( mb_strlen($nickname, 'UTF8') > 9 ){
                echoError("昵称名过长!");
            }else if( mb_strlen($nickname, 'UTF8') < 2 ){
                echoError("昵称名过短!");
            }else{
                return self::success("昵称格式正确!");
            }
        }
        echoError("昵称只能由中文,数字和大小写字母组成!");
    }

}