<?php
/**
 * Created by PhpStorm.
 * User: lijian
 * Date: 16/6/1
 * Time: 下午4:03
 */

namespace Common\Service;


class DateService{
    public static function getTodayDate(){
        return date('Y-m-d',time());
    }

    public static function getPreDate($num){
        return date("Y-m-d",strtotime("-$num day"));
    }

    public static function getReviewDates(){
        //复习几天前的内容
        $day = array( '1', '2', '4', '7', '15', '30', '90', '180' );
        $dates = array();
        foreach( $day as $d ){
            array_push($dates, self::getPreDate($d));
        }
        return $dates;
    }

}