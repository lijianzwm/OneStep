<?php
/**
 * Created by PhpStorm.
 * User: lijian
 * Date: 16/6/1
 * Time: 下午3:41
 */

namespace Home\Controller;


use Common\Service\DateService;

class NoteController extends CommonController{
    public function todayNote(){
        $userid = session("user")['id'];
        $date = DateService::getTodayDate();
        $note = M("note")->where("userid='$userid' and date='$date'")->find();
        if( $note ){
            $this->assign("note", $note);
        }
        $this->assign("date", $date);
        $this->display("editNote");
    }

    public function noteList(){
        $userid = session("user")['id'];
        $todayDate = DateService::getTodayDate();
        $noteList = M("note")->where("userid='$userid' and date<'$todayDate'")->find();
        if( $noteList ){
            $this->assign("noteList", $noteList);
        }
        $this->display();
    }

    public function modifyNote(){
        $noteid = I("noteid");
        $note = M("note")->where("id='$noteid'")->find();
        if( $note ){
            $this->assign("note", $note);
            $this->display("editNote");
        }else{
            $this->error("无此笔记!");
        }
    }

    public function editNoteHandler(){
        $date = I("date");
        $content = I("content");
        $note = M("note")->where("date='$date'")->find();
        if( $note ){
            $note['content'] = $content;
            M("note")->save($note);
            echoSuccess("保存成功!");
        }else {
            $note['date'] = $date;
            $note['content'] = $content;
            $note['userid'] = session("user")['id'];
            if( M("note")->add($note) ){
                echoSuccess("保存成功!");
            }else{
                echoError("保存失败!");
            }
        }
    }

    public function review(){
        $dates = DateService::getReviewDates();
        $table = C("DB_PREFIX") . "note";
        $userid = session("user")['id'];
        $content = "";
        $sql = "select * from $table where date in ( ";
        foreach( $dates as $date ){
            $sql .= "'".$date."', ";
        }
        $sql = substr($sql, 0, strlen($sql)-2);
        $sql .= " )";
        $notes = M()->query($sql);
        foreach( $notes as $note ){
            $content .= $note['content'];
        }
        $this->assign("content", $content);
        $this->display();
    }
}