
<?php
$nameErr = $emailErr = $addresserr = $mobilerr = "";
$name = $email = $address = $mobile = $website = "";
$msg = "";
if(isset($_POST['submit'])){
  include('fun.php');

     if(empty($_POST["name"])){
      $msg = $msg."Name is required <br>";
    } else {
      $name = test_input($_POST["name"]);
      if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
        $msg = $msg."Only letters and white space allowed in Name<br>";
      }
    }
     if(empty($_POST["email"])){
      $msg = $msg."Email is required <br>";
    } else {
      $email = test_input($_POST["email"]);
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $msg = $msg."Invalid email format<br>";
      }
    }
    if(empty($_POST["mobile"])){
      $msg = $msg."Mobile is required <br>";
    } else {
      $mobile = test_input($_POST["mobile"]);
      if (!preg_match("/^[0-9]*$/",$mobile)) {
        $msg = $msg."Only Digits Allowed in Mobile<br>";
      }
    }
     if(empty($_POST["address"])){
      $msg = $msg."Address is required <br>";
    } else {
      $address = test_input($_POST["address"]);
      if (preg_match('/^\\d+ [a-zA-Z ]+, \\d+ [a-zA-Z ]+, [a-zA-Z ]+$/', $address)) {
        $msg = $msg."Only letters and white space allowed in Address <br>";
      }
    }

      // $name=($_POST["name"]);
      // $email=($_POST["email"]);
      // $mobile=($_POST["mobile"]);
      
      // $address=($_POST["address"]);
    $gender=($_POST["gender"]);
    $country=($_POST["country"]);
    $filename = $_FILES["image"]["name"];
    $tempname = $_FILES["image"]["tmp_name"];
    $file ="student/".$filename;
    move_uploaded_file($tempname, $file);

    if($msg==""){
       include('config.php');
       $sql = "INSERT INTO `student`( name,email,mobile,gender,address,country,file) VALUES ('$name','$email','$mobile','$gender','$address','$country','$filename')";
      
      if(mysqli_query($conn, $sql)) {
       
         header('Location: view.php');
         $msg="Registration  successfull";
      } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
      }
   }
  
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Form</title>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">

 <!-- jQuery library -->
 <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>

 <!-- Popper JS -->
 <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

 <!-- Latest compiled JavaScript -->
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
 <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>

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
input[type=email], select {
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
  <div>
      <h2 style="text-align:center;">HTML FORM</h2><hr>
       <button type="button" class="btn btn-primary"><a href="http://localhost/curdaptron/view.php" style="text-decoration: none;color: white;">View Record</a></button>
 </div>
 <div>
    <span class="error" style="color: red;"> <?php echo $msg;?></span>
 </div>

  <div>
    <form  method="post" id="myform" enctype="multipart/form-data" onsubmit="return vld();">
      <label for="name">Name</label>
      <input type="text" id="name" name="name" placeholder="Your name..">
        <span class="error"> <?php echo $nameErr;?></span>  <br>
     
  
      <label for="Email">Email</label>
      <input type="text" id="email" name="email" placeholder="Your Email" >
    

      <label for="Mobile">Mobile</label>
      <input type="text" id="mobile" name="mobile" placeholder="Your mobile">

      <fieldset data-role="controlgroup">
        <legend>Choose your gender</legend>
        <label for="male">Male</label>
        <input type="radio" name="gender" id="male" value="male" checked>
        <label for="female">Female</label>
        <input type="radio" name="gender" id="female" value="female">
      </fieldset><br>

      <label for="Address">Address</label>
      <input type="text" id="address" name="address" placeholder="Your address">

      <label for="country">Country</label>
      <select id="country" name="country">
       <option value="australia">Australia</option>
        <option value="canada">Canada</option>
        <option value="china">china</option>
        <option value="india">india</option>
        <option value="usa">USA</option>
        <option value="pakistan">Pakistan</option>
      </select>

      <label for="name"> Photo upload</label> <br>
      <input type="file" name="image" id="image"> <br><br>
      <input type="submit" value="submit" id="submit" name="submit">
    </form>
  </div>
  <script type="text/javascript">
$(document).ready(function() {
    $('#myform').submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: '',
            data: $(this).serialize(),
            success: function(response)
            
       });
     });
});
</script>

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
    var image=document.getElementById("image").value;
       image=image.trim();
    if(image==""){
      alert("Plesse Choose File...");
      document.getElementById("image").focus();
      document.getElementById("image").value="";
      return false;
    }

    }      
  </script>
</body>
</html>
