<?php 
error_reporting(0);
include "config.php";

$sql = "SELECT * FROM student";

$result = $conn->query($sql);
$msg="";

?>

<!DOCTYPE html>

<html>

<head>
 <title>View Page</title>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">

 <!-- jQuery library -->
 <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>

 <!-- Popper JS -->
 <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

 <!-- Latest compiled JavaScript -->
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<style>
    #customers {
      font-family: Arial, Helvetica, sans-serif;
      border-collapse: collapse;
      width: 100%;
    }

    #customers td, #customers th {
      border: 1px solid #ddd;
      padding: 8px;
    }

    #customers tr:nth-child(even){background-color: #f2f2f2;}

    #customers tr:hover {background-color: #ddd;}

    #customers th {
      padding-top: 12px;
      padding-bottom: 12px;
      text-align: left;
      background-color: #04AA6D;
      color: white;
    }
</style>
<body>
  
    <div class="jumbotron">
           <h2 style="text-align:center;">View Record In Table</h2><hr>
           <button type="button" class="btn btn-primary"><a href="http://localhost/curdaptron/" style="text-decoration: none;color: white;">Add Record</a></button>

        <table class="table" id="customers">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th>Gender</th>
                    <th>Address</th>
                    <th>Country</th>
                    <th>File</th>
                    <th>Action </th>
                </tr>
            </thead>

            <tbody> 
                <?php
                    if ($result->num_rows > 0) {

                        while ($row = $result->fetch_assoc()) { ?>

                        <tr>
                            <td><?php echo $row['id']; ?></td>

                            <td><?php echo $row['name']; ?></td>

                            <td><?php echo $row['email']; ?></td>

                            <td><?php echo $row['mobile']; ?></td>

                            <td><?php echo $row['gender']; ?></td>

                            <td><?php echo $row['address']; ?></td>

                            <td><?php echo $row['country']; ?></td>

                            <td> <img src="student/<?php echo $row['file']; ?>"height="80" width="80" >   </td>

                            <td>
                                <a href="delete.php?id=<?php echo $row['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a>
                               <a href="update.php?id=<?php echo $row['id']; ?>" class="btn btn-success"   onclick="return confirm('Are you sure you want to update this item?');">Update</a>
                           </td>
                        </tr>                       
                 <?php   }
                    }
                ?>                
            </tbody>
       </table>
    </div> 
    <script type="text/javascript">
           $(document).on('click', '#onclick', function(){
            var result = confirm('Do you want to confirm Delete The Data...');
            if(!result){
                return false;
            }
        })
    </script>
</body>

</html>