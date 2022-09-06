<?php
include_once "../base.php";

// 防呆
// !empty==不為空值==有值
if(!empty($_POST['subject'])){ // 有資料就寫入
    $Que->save(['text'=>$_POST['subject'],'count'=>0,'subject_id'=>0]); // 寫入資料
    $subject_id=$Que->find(['text'=>$_POST['subject']])['id']; // 上述寫入主題後 撈出剛剛寫入的那筆資料的id

    if(!empty($_POST['option'])){ // 判斷option有無內容
        foreach($_POST['option'] as $opt){ // 有就用迴圈寫入
            $Que->save(['text'=>$opt,'count'=>0,'subject_id'=>$subject_id]); // 再存起來
        }
    }
}

to("../back.php?do=que");
?>
