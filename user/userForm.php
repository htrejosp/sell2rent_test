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
<section class="pb-4">
  <div class="bg-white border rounded-5">
    <section class="w-100 p-4 pb-4">
      <form class="row g-3 needs-validation" novalidate="" id="form">
        <div class="col-md-4">
          <div class="form-outline">
            <input type="hidden" name="action" id="action" value="add" required="">
            <input type="hidden" name="currid" id="id" value="" required="">
            <input type="text" class="form-control active" id="firstName" name="firstName"  value="" required="">
            <label for="firstName" class="form-label" style="margin-left: 0px;">First name</label>
            <div class="valid-feedback">Looks good!</div>
          <div class="form-notch"><div class="form-notch-leading" style="width: 9px;"></div><div class="form-notch-middle" style="width: 68.8px;"></div><div class="form-notch-trailing"></div></div></div>
        </div>
        <div class="col-md-4">
          <div class="form-outline">
            <input type="text" class="form-control active" id="lastName" name="lastName" value="" required="">
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
          <button class="btn btn-primary" type="button" id="submit">Submit</button>
        </div>
      </form>
    </section>
    
  </div>
</section>
</body>
