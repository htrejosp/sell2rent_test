<?php
if (!is_writable(session_save_path())) {
    echo 'Session path "'.session_save_path().'" is not writable for PHP!'; 
}
session_start();
$idsession = session_id();
?>
<html>
    <head>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"/>
    <link rel="stylesheet" type="text/css" href="../css/main.css"/>
    <script type="text/javascript" src="../js/jquery-3.6.0.min.js"></script>
    <script type="text/javascript">
      $(document).ready(function(){
        var currentdate = new Date();
        var datetime = currentdate.getFullYear() + "-"
                + (currentdate.getMonth()+1)  + "-" 
                + currentdate.getDate()+ " "  
                + currentdate.getHours() + ":"  
                + currentdate.getMinutes() + ":" 
                + currentdate.getSeconds();

        $("#dateTime").val(datetime);
      });
      $(document).on("click","#submit",function(){
        var formData=$("#form").serialize();
        console.log(formData);
        $.ajax({
              type:'POST',
              url: "../service/actions.php",
              data:formData,
              success: function(html){                
                  if(html){          
                      returnAction=jQuery.parseJSON(html);
                      console.log(returnAction);
                      if(returnAction.success==1){
                        window.open("../user/userList.php","_self");
                      }
                      else{
                        alert("Error action");
                      }
                  }
              }   
        });
      });
    </script>
    </head>
<body>
  <?php
  $id=0;
  $firstName="";
  $lastName="";
  $action="add";
  $readonly="";
  $label_button="Add User";
  if(@$_REQUEST["id"] && @$_REQUEST["action"]=="edit"&& $_SESSION["data"][$_REQUEST["id"]]){
      $action="edit";
      $readonly="";
      $label_button="Edit User";
      $id=$_REQUEST["id"];
      $firstName=$_SESSION["data"][$id]["firstName"];
      $lastName=$_SESSION["data"][$id]["lastName"];
  }
  if(@$_REQUEST["id"] && @$_REQUEST["action"]=="delete"&& $_SESSION["data"][$_REQUEST["id"]]){
    $action="delete";
    $readonly="readonly";
    $label_button="Delete User";
    $id=$_REQUEST["id"];
    $firstName=$_SESSION["data"][$id]["firstName"];
    $lastName=$_SESSION["data"][$id]["lastName"];

  }
  ?>
<section class="pb-4">
  <div class="bg-white border rounded-5">
    <section class="w-100 p-4 pb-4">
      <form class="row g-3 needs-validation" novalidate="" id="form">
        <div class="col-md-4">
          <div class="form-outline">
            <input type="hidden" name="action" id="action" value="<?php echo($action); ?>" required="">
            <input type="hidden" name="id" id="id" value="<?php echo($id); ?>" required="" >
            <input type="text" class="form-control active" id="firstName" name="firstName"  value="<?php echo($firstName);?>" <?php echo($readonly);?> required="" >
            <label for="firstName" class="form-label" style="margin-left: 0px;">First name</label>
            <div class="valid-feedback">Looks good!</div>
          <div class="form-notch"><div class="form-notch-leading" style="width: 9px;"></div><div class="form-notch-middle" style="width: 68.8px;"></div><div class="form-notch-trailing"></div></div></div>
        </div>
        <div class="col-md-4">
          <div class="form-outline">
            <input type="text" class="form-control active" id="lastName" name="lastName" value="<?php echo($lastName);?>" <?php echo($readonly);?> required="">
            <label for="lastName" class="form-label" style="margin-left: 0px;">Last name</label>
            <div class="valid-feedback">Looks good!</div>
          <div class="form-notch"><div class="form-notch-leading" style="width: 9px;"></div><div class="form-notch-middle" style="width: 68px;"></div><div class="form-notch-trailing"></div></div></div>
        </div>
        <div class="col-md-4">
          <div class="form-outline">
            <input type="text" class="form-control active" name="dateTime" readonly id="dateTime" value="" required="">
            <label for="dateTime" class="form-label" style="margin-left: 0px;">Date Time</label>
            <div class="valid-feedback">Looks good!</div>
          <div class="form-notch"><div class="form-notch-leading" style="width: 9px;"></div><div class="form-notch-middle" style="width: 68px;"></div><div class="form-notch-trailing"></div></div></div>
        </div>
        <div class="col-12">
          <button class="btn btn-primary" type="button" id="submit"><?php echo($label_button); ?></button>
        </div>
      </form>
    </section>
    
  </div>
</section>
</body>
