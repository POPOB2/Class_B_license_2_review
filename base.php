<?php
session_start();
date_default_timezone_set('Asia/Taipei');
class DB{
    // protected $dsn='mysql:host=localhost; charset=utf8; dbname=class_b_2';
    // protected $user='root';
    // protected $pw='';
    protected $dsn='mysql:host=localhost; charset=utf8; dbname=s1110203';
    protected $user='s1110203';
    protected $pw='s1110203';
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
// 1. 去掉 ...
// 2. 有很多$id要換成$arg, 用CTRL+D快選上一次處理
// 3. 把$id[0] 的 [0]陣列刪除
// 4. 刪除所有isset
// 5. 將else的$sql.=內容改為 "WHERE `id`='$id'" ;
// 6. return 的ftech全部 改為 fetch

// public function all(...$arg){                // 更改 : all -> find , ...$arg -> $id
    public function find($id){
        $sql="select * from $this->table";
        // if(isset($id[0])){                // 刪除
            // if(is_array($id[0])){                   // 更改 : $arg[0] -> $id, 去除[0]
            if(is_array($id)){                   
                // foreach($id[0] as $key => $value){  // 更改 : $arg[0] -> $id, 去除[0]
                foreach($id as $key => $value){  
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
// 1. 將查詢全部 改成 刪除
// 2. return的 查詢 改為 執行, 並把執行($sql) 後面的fetch等內容刪除
    
// public function find(...$id){                //  更改 : find(...$id) -> del($id){
public function del($id){                         
//  $sql="select * from $this->table";          //  更改 : select * -> DELERE
    $sql="DELETE from $this->table";
    
    if(is_array($id)){
        foreach($id as $key => $value){
            $tmp[]="`$key`='$value'";
        }
        $sql.=" WHERE ".join(" AND ",$tmp);
    }else{
        $sql.=" WHERE `id`='$id'";
    }
    // return $this->pdo->query($sql)->fetch(PDO::FETCH_ASSOC);   // 更改 : query -> exec // 刪除 : ->fetch(PDO::FETCH_ASSOC)
    return $this->pdo->exec($sql);
}
// +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// ---------------------------------------------------------------------------------------------------------------------------------------------------------

// 總結 : 
// 1. 刪除$sql
// 2. 將if的is_array($id)改為isset($array['id'])
// 3. 將foreach的 $id 改為 $array
// 4. 再if和else的最後執行區域, 寫上更新 與 新增 的$sql=sql語法


public function save($array){
     // $sql="DELETE from $this->table";      // 刪除
     // if(is_array($id)){                    // 更改 : is_array($id) -> isset($array['id'])
        if(isset($array['id'])){
         // foreach($id as $key => $value){   // 更改 : $id -> $array
            foreach($array as $key => $value){
                $tmp[]="`$key`='$value'";
            }
         // $sql.="WHERE".join("AND",$tmp);      // 更改為以下內容
            $sql=" UPDATE $this->table SET "
            .join(',',$tmp)
            ." WHERE `id`='{$array['id']}'";
        }else{
            
         // $sql.="WHERE `id`=`$array`";         // 更改為以下內容
            $sql=" INSERT INTO $this->table 
            (`".join("`,`",array_keys($array))."`)
            values('".join("','",$array)."')";
        }
        return $this->pdo->exec($sql);
    }

// +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// ---------------------------------------------------------------------------------------------------------------------------------------------------------
// 總結 : 
// 1. 再function math 的(...$arg)內 於前面 新增 $math,$col,
// 2. 將$sql語法 * 改為 $math($col)
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
            $sql.=" WHERE ".join(" AND ",$tmp);
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
public function q($sql){
    return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
}
}  // Class DB的結尾




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



// ------------------------------------------------------DB------------------------------------------------------

$Total=new DB('total'); // 計算拜訪總人數的資料表
$User=new DB('user');
$News=new DB('news');
$Que=new DB('que');

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
