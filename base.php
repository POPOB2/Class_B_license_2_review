<?php
session_start();
date_default_timezone_set('Asia/Taipei');
class DB{
    protected $dsn='mysql:host=localhost; charset=utf8; dbname=class_b_2';
    protected $user='root';
    protected $pw='';
    public $table;
    protected $pdo;

    function __construct($table){
        $this->table=$table;
        $this->pdo=new PDO($this->dsn,$this->user,$this->pw);
    }
// 複製改寫順序 : all -> find -> del -> save
// 回到 : all -> math
// 寫 : 萬用, 簡化導向, 偵錯 的function

// +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// ---------------------------------------------------------------------------------------------------------------------------------------------------------
    public function all(...$arg){
        $sql="select * from $this->table";
        if(isset($arg[0])){
            if(is_array($arg[0])){
                foreach($arg[0] as $key => $value){
                    $tmp[]="`$key`='$value'";
                }
                $sql.=" WHERE ".join(" AND ",$tmp);
            }else{
                $sql.=$arg[0];
            }
        }
        if(isset($arg[1])){
            $sql.=$arg[1];
    }
    return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
}
// +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// ---------------------------------------------------------------------------------------------------------------------------------------------------------
// 總結 : 
// 1. 有很多$id要換成$arg, 用CTRL+D快選上一次處理
// 2. 刪除所有isset
// 3. 將else的$sql.=內容改為 "WHERE `id`='$id'" ;
// 4. return 的ftech全部 改為 fetch

// public function all(...$arg){                // 更改 : all -> find , $id -> $arg
    public function find(...$id){
        $sql="select * from $this->table";
        // if(isset($id[0])){                // 刪除
            if(is_array($id[0])){                   // 更改 : $id -> $arg
                foreach($id[0] as $key => $value){  // 更改 : $id -> $arg
                    $tmp[]="`$key`='$value'";
                }
                $sql.=" WHERE ".join(" AND ", $tmp); // 注意空白一定要寫, 因為寫成SQL語法, 接在上方table之後
            }else{
                // $sql.=$arg[0];
                // $sql.=$id[0]; 
                $sql.=" WHERE `id`='$id'";          // 更改 : // $sql.=$arg[0]; -> $sql.="WHERE `id`='$id'";  
            }
        // }                                // 刪除
        // if(isset($id[1])){               // 刪除
            // $sql.=$id[1];                // 刪除
    // }                                    // 刪除
 // return $this->pdo->query($sql)->fetch(PDO::FETCH_ASSOC);  // 更改 : fetchAll -> fetch
    return $this->pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
}
// +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// ---------------------------------------------------------------------------------------------------------------------------------------------------------
    // 總結:
    // 1.將(...)的...刪除
    // 2.將查詢全部 改成 刪除
    // 3.return的 查詢 改為 執行, 並把執行($sql) 後面的fetch等內容刪除
    
// public function find(...$id){                //  更改 : find(...$id) -> del($id){
public function del($id){                         
//  $sql="select * from $this->table";          //  更改 : select * -> DELERE
    $sql="DELETE from $this->table";
    
    if(is_array($id[0])){
        foreach($id[0] as $key => $value){
            $tmp[]="`$key`='$value'";
        }
        $sql.="WHERE".join("AND",$tmp);
    }else{
        $sql.="WHERE `id`=`$id`";
    }
    // return $this->pdo->query($sql)->fetch(PDO::FETCH_ASSOC);   // 更改 : query -> exec // 刪除 : ->fetch(PDO::FETCH_ASSOC)
    return $this->pdo->exec($sql);
}
// +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// ---------------------------------------------------------------------------------------------------------------------------------------------------------
// 方案一.
// 複製del 把del改為save,  並把所有$id改為$array 
public function save1($array){
    // 新增ifelse判斷式後, 把foreach放進判斷的true區
    if(isset($array['id'])){
        //  並把foreach的$id[0]改成$array
        //  foreach($id[0] as $key => $value){
            foreach($array as $key => $value){
                $tmp[]="`$key`='$value'";
            }
            //  新增這段 更新用的sql語法
            $sql="UPDATE $this->table SET ".join(',',$tmp)." WHERE `id`='{$array['id']}'";
        }else{
            //  新增這段 新增用的sql語法
            $sql="INSERT INTO $this->table (`".join("`,`",array_keys($array))."`)
            values ('".join("','",$array)."')";
        }
        // if(is_array($array[0])){                   // 刪除
        //     foreach($array[0] as $key => $value){  // 取這段放到forach的true區
        //         $tmp[]="`$key`=`$value`";          // 取這段放到forach的true區
        //     }                                      // 取這段放到forach的true區
        //     $sql.="WHERE".join("AND",$tmp);        // 刪除
        // }else{                                     // 刪除
        //     $sql.="WHERE `id`=`$array`";           // 刪除
        // }                                          // 刪除

        return $this->pdo->exec($sql);
    }
// +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// ---------------------------------------------------------------------------------------------------------------------------------------------------------
// 方案二.
// 總結 : 
// 0. 將function改為save($array)
// 1. 刪除$sql
// 2. 將if的is_array($)改為isset, 其isset的內容 改為 $array['id']
// 3. 在該isset執行區域的 $id[0] 改為 $array
// 4. 再if和else的最後執行區域, 寫上更新 與 新增 的$sql=sql語法


public function save($array){
     // $sql="DELETE from $this->table";         // 刪除
     // if(is_array($id[0])){                    // 更改 : is_array -> isset , ($id[0]) -> ($array['id'])
        if(isset($array['id'])){
         // foreach($id[0] as $key => $value){   // 更改 : $id[0] -> $array
            foreach($array as $key => $value){
                $tmp[]="`$key`='$value'";
            }
         // $sql.="WHERE".join("AND",$tmp);      // 更改
            $sql="UPDATE $this->table SET ".join(',',$tmp)." WHERE `id`='{$array['id']}'";
        }else{
            
         // $sql.="WHERE `id`=`$array`";         // 更改
            $sql="insert into $this->table (`".join("`,`",array_keys($array))."`)
            values('".join("','",$array)."')";
        }
        return $this->pdo->exec($sql);
    }

// +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// ---------------------------------------------------------------------------------------------------------------------------------------------------------
// 總結 : 
// 1. 再function math 的(...$arg)內 於前面 新增 $math,$col,
// 2. 將$sql語法 查詢全部 改為 查詢$math($col)
// 3. 將最後 return 的 fetchAll...; 改為 fectchColumn();

// public function all(...$arg){            // 更改 : all -> math  // 新增 : (...$arg) -> ($math,$col,...$arg)
public function math($math,$col,...$arg){
 // $sql="select * from $this->table";      // 更改 :  * -> $math($col)
    $sql="select $math($col) from $this->table ";
    if(isset($arg[0])){
        if(is_array($arg[0])){
            foreach($arg[0] as $key => $value){
                $tmp[]="`$key`='$value'";
            }
            $sql.="WHERE".join("AND",$tmp);
        }else{
            $sql.=$arg[0];
        }
    }
    if(isset($arg[1])){
        $sql.=$arg[1];
}
// return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);    // 更改 : fetchAll(PDO::FETCH_ASSOC) -> fetchColumn()
return $this->pdo->query($sql)->fetchColumn();
}
// +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// ---------------------------------------------------------------------------------------------------------------------------------------------------------


// 萬用
function q($sql){
    return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
}
// +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// ---------------------------------------------------------------------------------------------------------------------------------------------------------
// 簡化導向
function to($url){
    header("location:".$url);
}
// +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// ---------------------------------------------------------------------------------------------------------------------------------------------------------
// 偵錯
function dd($array){
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}


}  // Class DB的結尾
// ------------------------------------------------------DB------------------------------------------------------

$Total=new DB('total'); // 計算拜訪總人數的資料表
$User=new DB('user');

// 判斷有無session
if(!isset($_SESSION['total'])){ // 若無
    $chkDate=$Total->math('count','id',['date'=>date("Y-m-d")]); // 產生 $chkDate = Total表 計算id數 , 且date欄 為 目前時間
    // 加上判斷
    if($chkDate>=1){ // 若$chkDate 有值時(true)
        $total=$Total->find(['date'=>date("Y-m-d")]); // 新增$total 為 total表 查詢單筆 ( date欄 為 目前的時間 )
        $total['total']++; // 在total欄+1
        $Total->save($total); // 對Total表 存檔 存的資料為上述目前時間+1過的值
        $_SESSION['total']=1; // 產生一組session名為total
    }else{ // 若$chkDate為0==沒有值== SESSION的total有值
        $Total->save(['date'=>date("Y-m-d"),'total'=>1]); // 把Total表 儲存 時間欄為目前時間  , total表設為1(true)
        $_SESSION['total']=1; // 產生一組session 名為total 值為1
    }
}
// +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// $Total=new DB('total');
// if(!isset($_SESSION['total'])){
//     $chkDate=$Total->math('count','id',['date'=>date("Y-m-d")]);
//     if($chkDate>=1){
//         $total=$Total->find(['date'=>date("Y-m-d")]);
//         $total['total']++;
//         $Total->save($total);
//         $_SESSION['total']=1;
//     }else{
//         $Total->save(['date'=>date("Y-m-d"),'total'=>1]);
//         $_SESSION['total']=1;
//     }
// }
// ---------------------------------------------------------------------------------------------------------------------------------------------------------





?>
