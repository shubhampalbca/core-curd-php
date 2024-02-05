<?php 

include "config.php";
include "fun.php";
 $msg="";
    if (isset($_POST['submit'])) {

         $id = $_GET['id']; 

         $name =$_POST["name"];

         $email =$_POST['email'];

          $mobile =$_POST['mobile'];

          $gender =$_POST['gender'];

          $address =$_POST['address'];

          $country =$_POST['country'];

          if (!empty($_FILES["image"]["name"]))
          {
           $filename = $_FILES["image"]["name"];
           $tempname = $_FILES["image"]["tmp_name"];
           $file ="student/".$filename;
           move_uploaded_file($tempname, $file);
         }
         else{
              $filename=$_POST['oldimage'];
         }
         
          $sql = "UPDATE `student` SET `name`='$name',`email`='$email',`mobile`='$mobile',`gender`='$gender',`address`='$address',`country`='$country',`file`='$filename' WHERE `id`='$id'"; 

          $result = $conn->query($sql); 

        if ($result == TRUE) {

          header('Location: view.php?$msg=Record updated successfully');

            //echo "Record updated successfully.";
        }
        else{

            echo "Error:" . $sql . "<br>" . $conn->error;

        }
    } 

    if( isset($_GET['id']) ){
    $studentid=test_input($_GET['id']);
    $sql = "SELECT * FROM student where id='$studentid' ";
    $result=mysqli_query($conn, $sql);
    $num=mysqli_num_rows($result);
    if($num==1){
      $arr=mysqli_fetch_assoc($result);
   
    }else{
      echo " no Record found";
    } 
  }

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Update Form</title>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">

 <!-- jQuery library -->
 <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>

 <!-- Popper JS -->
 <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

 <!-- Latest compiled JavaScript -->
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

</head>
<style>

input[type=text], select {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

input[type=submit] {
  width: 100%;
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

input[type=submit]:hover {
  background-color: #45a049;
}

div {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
}
</style>
<body>

<h3>UPDATE FORM IN </h3>
<div>
  <form action="" method="post" id="myform" enctype="multipart/form-data" onsubmit="return vld();">
   <label for="name">Name</label>
   <input type="text" id="name" name="name" value="<?php echo $arr['name']; ?>" placeholder="Your name.." >
   <label for="Email">Email</label>
   <input type="text" id="email" name="email"  value="<?php echo $arr['email']; ?>" placeholder="Your Email">
   <label for="Email">Mobile</label>
   <input type="text" id="mobile" name="mobile"  value="<?php echo $arr['mobile']; ?>" placeholder="Your mobile">
   <fieldset data-role="controlgroup">
     <legend>Choose your gender</legend>
     <label for="male">Male</label>
     <input type="radio" name="gender" id="male" value="male" <?php  if($arr["gender"]=='male') { echo "checked" ;}?> >
      <label for="female">Female</label>
      <input type="radio" name="gender" id="female" value="female" <?php  if($arr["gender"]=='female') { echo "checked" ;}?> >
    </fieldset><br>

   <label for="Address">Address</label>
   <input type="text" id="address" name="address"  value="<?php echo $arr['address']; ?>" placeholder="Your address">

    <label for="country">Country</label>
    <select id="country" name="country">
      <option value="australia"  <?php if($arr["country"]=='australia') {echo "selected"; }?>>Australia</option>
      <option value="canada"  <?php if($arr["country"]=='canada') {echo "selected"; }?>>Canada</option>
      <option value="china"  <?php if($arr["country"]=='china') {echo "selected"; }?>>China</option>
      <option value="india"  <?php if($arr["country"]=='india') {echo "selected"; }?>>India</option>
      <option value="usa"  <?php if($arr["country"]=='usa') {echo "selected"; }?>>Usa</option>
      <option value="pakistan"  <?php if($arr["country"]=='pakistan') {echo "selected"; }?>>Pakistan</option>
   </select>
    <label for="name"> Photo upload</label> <br>
    <input type="file" name="image" id="image"> <br><br>
    <input type="hidden" name="oldimage"  value="<?php echo $arr['file']; ?>">

<td> <img src="student/<?php echo $arr['file']; ?>" height="50" width="50" > </td> 

   <input type="submit" class="btn btn-primary" value="Submit" name="submit" id="submit">
  </form>
</div>
  <script type="text/javascript">

    $(document).ready(function() {
      
      var form =$('#myform');

      $('#submit').click(function(){

        $.ajax({  

           url: '',
           type: 'post',  
          data: dataString,
           success: function(response) {
          content.html(response);
          }
      });

      });
    });

    function vld(){
     var name=document.getElementById("name").value;
    name=name.trim();
    if(name==""){
      alert("Plz Enter Name");
      document.getElementById("name").focus();
      document.getElementById("name").value="";
      return false;
    }
    if(name.length<3){
      alert("Atleast 3 char Name");
      document.getElementById("name").focus();
      return false;
    }

    var email=document.getElementById("email").value;
    email=email.trim();
    if(email==""){
      alert("Plz Enter Email Id");
      document.getElementById("email").focus();
      document.getElementById("email").value="";
      return false;
    }else{
      x=email;
      var atpos = x.indexOf("@");
      var dotpos = x.lastIndexOf(".");
      if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length) {
        alert("Not a valid e-mail address");
        return false;
      }
    }

    var mobile=document.getElementById("mobile").value;
    mobile=mobile.trim();
    if(mobile==""){
      alert("Plz Enter Mobile Number");
      document.getElementById("mobile").focus();
      document.getElementById("mobile").value="";
      return false;
    }
    if( isNaN(mobile) ){
      alert("Enter Only Digits 0-9");
      document.getElementById("mobile").focus();
      document.getElementById("mobile").value="";
      return false;
    }
    if(mobile.length!=10){
      alert("Only 10 digit Mobile Number");
      document.getElementById("mobile").focus();
      return false;
    }
    if(mobile[0]<6){
      alert("Enter Valid Mobile Number");
      document.getElementById("mobile").focus();
      return false;
    }
     var address=document.getElementById("address").value;
    address=address.trim();
    if(address==""){
      alert("Plz Enter Your Address");
      document.getElementById("address").focus();
      document.getElementById("address").value="";
      return false;
    }
    if(address.length<3){
      alert("Must be 3 char in your address");
      document.getElementById("address").focus();
      return false;
    }

    }      
  </script>

</body>
</html>
