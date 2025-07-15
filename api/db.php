<?php
session_start();
date_default_timezone_set("Asia/Taipei");

function dd($array){
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}

function q($sql){
    $dsn="mysql:host=localhost;dbname=db10;charset=utf8";
    $pdo=new PDO($dsn,'root','');
    return $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
} 

function to($url){
    header("location:".$url);
}

class DB{
    private $pdo;
    private $dsn="mysql:host=localhost;dbname=db10;charset=utf8";
    private $table;

    public function __construct($table){
        $this->table=$table;
        $this->pdo=new PDO($this->dsn,'root','');
    }

    function all(...$arg){
        $sql="select * from $this->table ";
        if(isset($arg[0])){
            if(is_array($arg[0])){
                $tmp=$this->array2sql($arg[0]);
                $sql=$sql." where ".join(" and ",$tmp);
            }else{
                $sql .=$arg[0];
            }
        }
        
        if (isset($arg[1])) {
            $sql .=$arg[1];
        }
        
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    function count(...$arg){
        $sql="select count(*) from $this->table ";
        if(isset($arg[0])){
            if(is_array($arg[0])){
                $tmp=$this->array2sql($arg[0]);
                $sql=$sql." where ".join(" and ",$tmp);
            }else{
                $sql .=$arg[0];
            }
        }
        
        if (isset($arg[1])) {
            $sql .=$arg[1];
        }
        
        return $this->pdo->query($sql)->fetchColumn();
    }

     function sum($cols,...$arg){
        $sql="select sum($cols) from $this->table ";
        if(isset($arg[0])){
            if(is_array($arg[0])){
                $tmp=$this->array2sql($arg[0]);
                $sql=$sql." where ".join(" and ",$tmp);
            }else{
                $sql .=$arg[0];
            }
        }
        
        if (isset($arg[1])) {
            $sql .=$arg[1];
        }
        
        return $this->pdo->query($sql)->fetchColumn();
    }
    
    function find($id){
        $sql="select * from $this->table ";
        if(is_array($id)){
            $tmp=$this->array2sql($id);
            $sql=$sql." where ".join(" and ",$tmp);
        }else{
            $sql .= " where `id`='$id'";
        }
        return $this->pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
    }
    

    function save($array){
        if(isset($array['id'])){
            $sql="update $this->table set ";
            $tmp=$this->array2sql($array);
            $sql .=join(" , ",$tmp) . " where `id`='{$array['id']}'";
        }else{
            $cols=join("`,`",array_keys($array));
            $value=join("','",$array);
            $sql="insert into $this->table (`$cols`) value('$value')";
        }
        return $this->pdo->exec($sql);
    }

    function del($id){
    $sql="delete from $this->table ";
        if(is_array($id)){

            $tmp=$this->array2sql($id);
            $sql=$sql." where ".join(" and ",$tmp);
        }else{
            $sql .= " where `id`='$id'";
        }
        return $this->pdo->exec($sql);
    }

    private function array2sql($array){
        $tmp=[];
        foreach($array as $key => $value){
            $tmp[]="`$key`='$value'";
        }
        return $tmp;
    }
}

$User=new DB('users');
$Visit=new DB('visit');
$News=new DB('news');
$Que=new DB('que');

if(!isset($_SESSION['visit'])){
    //第一次來訪，檢查有無今日日期
    $today=$Visit->find(['date'=>date("Y-m-d")]);
    if (empty($today)) {
        $Visit->save(['date'=>date("Y-m-d"),'visit'=>1]);
    }else{
        $today['visit']++;
        $Visit->save($today);
    }
    $_SESSION['visit']=1;
}



