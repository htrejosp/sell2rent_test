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
    <link rel="stylesheet" type="text/css" href="../css/dataTables.bootstrap5.min.css"/>
    <link rel="stylesheet" type="text/css" href="../css/main.css"/>
    <script type="text/javascript" src="../js/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="../js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="../js/dataTables.bootstrap5.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {
        $('#datatable').DataTable();
        $("#add_user").click(function (e) { 
            window.open("userForm.php","_self");
            e.preventDefault();
        });
        $(".edit").click(function (e) { 
            window.open("userForm.php?action=edit&id="+$(this).attr("idreg"),"_self");
            e.preventDefault();
        });
        $(".delete").click(function (e) { 
            window.open("userForm.php?action=delete&id="+$(this).attr("idreg"),"_self");
            e.preventDefault();
        });
        $("#reset").click(function (e) { 
            $.ajax({
              type:'POST',
              url: "../service/actions.php",
              data:"action=reset",
              success: function(html){                
                  if(html){          
                      returnAction=jQuery.parseJSON(html);
                      if(returnAction.success==1){
                        alert(returnAction.message);
                        window.history.go(0);
                      }
                      else{
                        alert("Error reset session");
                      }
                  }
              }   
            });
            e.preventDefault();
        });
       
    } );
    
    </script>
</head>
<body>
<section class="pb-4">
    <div class="bg-white border rounded-5" style="padding:10px">
        <div class="btn btn-mini btn-primary" id="add_user">Add User</div>  <div class="btn btn-mini btn-danger" id="reset">Reset session</div><br><br>
        <table id="datatable" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Register Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php
            foreach ($_SESSION["data"] as $key => $value) {
                echo("<tr>");
                echo("<td>".$key."</td>");
                echo("<td>".$value["firstName"]."</td>");
                echo("<td>".$value["lastName"]."</td>");
                echo("<td>".$value["dateTime"]."</td>");
                echo("<td><div class='btn btn-mini btn-info edit' idreg='".$key."'><i class='fa fa-edit'></i></div><div class='btn btn-mini btn-danger delete' idreg='".$key."'><i class='fa fa-trash'></i></div></td>");

                echo("</tr>"); 
            }
            ?>
            </tbody>
        </table>    
    </div>
</section>
</body>