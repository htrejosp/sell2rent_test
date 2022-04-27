<?php
if (!is_writable(session_save_path())) {
    echo 'Session path "'.session_save_path().'" is not writable for PHP!'; 
}
session_start();
$idsession = session_id();
$fieldsForm = array('firstName','lastName','dateTime');
$return = array('success' => 0, 'message'=> "Not action selected",'redirect'=>"userList","sessid"=>$idsession);
if(@$_REQUEST["action"]=="reset"){
    session_destroy();
    $return = array('success' => 1, 'message'=> "Reset Session",'redirect'=>"userList","sessid"=>$idsession);
}
if(@$_REQUEST["action"]=="add"){
    if(!isset($_SESSION["currid"])){
        $_SESSION["currid"]=1;
        $_SESSION["data"]=array();
    }
    else{
        $_SESSION["currid"]++;
    }
    $currid=$_SESSION["currid"];
    add_session($currid);
}
else if(@$_REQUEST["action"]=="edit"){
    if(@$_REQUEST["id"]){
        if($_SESSION["data"][$_REQUEST["id"]]){
            edit_session($_REQUEST["id"]);
        }
        else{
            $return = array('success' => 0, 'message'=> "The selected Id for edit not exist in session",'redirect'=>"userList","sessid"=>$idsession);    
        }
    }
    else{
        $return = array('success' => 0, 'message'=> "Please send a Id for edit",'redirect'=>"userList","sessid"=>$idsession);
    } 
}
else if(@$_REQUEST["action"]=="delete"){
    if(@$_REQUEST["id"]){
        if($_SESSION["data"][$_REQUEST["id"]]){
            delete_session($_REQUEST["id"]);
        }
        else{
            $return = array('success' => 0, 'message'=> "The selected Id for delete not exist in session",'redirect'=>"userList","sessid"=>$idsession);    
        }
    }
    else{
        $return = array('success' => 0, 'message'=> "Please send a Id for delete",'redirect'=>"userList","sessid"=>$idsession);
    }
}

function add_session($id){
    global $fieldsForm,$return,$idsession;
    foreach($fieldsForm AS $key=>$value){
        $_SESSION["data"][$id][$value]=$_REQUEST[$value];    
    }
    $return = array('success' => 1, 'message'=> "User added",'redirect'=>"userList","id"=>$id,"sessid"=>$idsession);
}
function edit_session($id){
    global $fieldsForm,$return,$idsession;
    foreach($fieldsForm AS $key=>$value){
        $_SESSION["data"][$id][$value]=$_REQUEST[$value];    
    }
    $return = array('success' => 1, 'message'=> "User edited",'redirect'=>"userList","id"=>$id,"sessid"=>$idsession);
}
function delete_session($id){
    global $fieldsForm,$return,$idsession;
    unset($_SESSION["data"][$id]);
    if(!@$_SESSION["data"][$id]){
        $return = array('success' => 1, 'message'=> "User deleted",'redirect'=>"userList","id"=>$id,"sessid"=>$idsession);
    }
    else{
        $return = array('success' => 0, 'message'=> "User not be erased ",'redirect'=>"userList","id"=>$id,"sessid"=>$idsession);
    }
}
echo(json_encode($return));

?>