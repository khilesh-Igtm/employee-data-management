<!-- connection is a file that makes a connection between my code and the database -->
<!-- i have imported my connection file here -->
<?php
include("connection.php");
?>


<!-- This php code is for search button means if someone hits search button
then what should code do -->
<!-- 1) If someone clicks the search button as the button name is specified as searchdata , it starts
checking the data of ID input field bcz it's name is specified as search and it's value will now be stored in
search varibale then  we did a query where we check in our table that whose id is same as $search , if we find that
make a connection or get the data and store all data in $result variable in array format -->
<?php
if(isset($_POST['searchdata'])){
    $search = $_POST['search'];
    $query = "SELECT * from form where id = '$search'";
    $data = mysqli_query($conn,$query);
    $result = mysqli_fetch_assoc($data);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Software Development</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="center">

        <form action="#" method="POST">
        <h1>Employee Data Entry Automation Software</h1>

        <div class="form">
            <input type="text" name="search" class="textfield" placeholder="Search ID"
            value="<?php if(isset($_POST['searchdata'])){echo $result['id'];} ?>">
            <input type="text" name="name" class="textfield" placeholder="Employee Name"
            value="<?php if(isset($_POST['searchdata'])){echo $result['emp_name'];} ?>">
            
            <select class="textfield" name="gender">
                <option value="Not Selected">Select Gender</option>
                <option value="Male"
                <?php
                if($result['emp_gender']=='Male'){
                    echo "selected";
                }
                ?>
                >Male</option>
                <option value="Female"
                 <?php
                if($result['emp_gender']=='Female'){
                    echo "selected";
                }
                ?>
                >Female</option>
                <option value="Other"
                 <?php
                if($result['emp_gender']=='Other'){
                    echo "selected";
                }
                ?>
                >Other</option>
            </select>

            <input type="text" name="email" class="textfield" placeholder="Email Address"
            value="<?php if(isset($_POST['searchdata'])){echo $result['emp_email'];} ?>">
              
            <select class="textfield" name="department">
                <option value="Not Selected">Select Department</option>
                <option value="IT"
                 <?php
                if($result['emp_department']=='IT'){
                    echo "selected";
                }
                ?>
                >IT</option>
                <option value="Accounts"
                 <?php
                if($result['emp_department']=='Accounts'){
                    echo "selected";
                }
                ?>
                >Accounts</option>
                <option value="Sales"
                  <?php
                if($result['emp_department']=='Sales'){
                    echo "selected";
                }
                ?>
                >Sales</option>
                <option value="HR"
                  <?php
                if($result['emp_department']=='HR'){
                    echo "selected";
                }
                ?>
                >HR</option>
                <option value="Marketing"
                  <?php
                if($result['emp_department']=='Marketing'){
                    echo "selected";
                }
                ?>
                >Marketing</option>
            </select>

            <textarea placeholder="Address" name="address"><?php if(isset($_POST['searchdata'])){echo $result['emp_address'];} ?>
            </textarea>
            <input type="submit" name="searchdata" value="Search" class="btn">
            <input type="submit" name="save" value="Save" class="btn" style="background-color:green;">
            <input type="submit" name="update" value="Modify" class="btn" style="background-color:orange;">
            <input type="submit" name="delete" value="Delete" class="btn" style="background-color:red;" onclick="return checkdelete()">
            <input type="reset" value="Clear" class="btn" style="background-color:blue;">
        </div>
        </form>
    </div>
</body>
</html>

<!-- this js code is for making confirmation whether you want to delete the record or not. This is done to avoid the deleting or updation
of data if button gets clicked accidently -->
<script>
    function checkdelete(){
        return confirm('Are you sure you want to delete this record?');
    }

</script>



<!-- This PHP code part is for save button means if someone hits save button then what
should happen will be decided using this below code -->
<?php

// this means , if save button is clicked then whatever is written in input box of name, gender,
// department,email,address store it in their respective name varibale.
if(isset($_POST['save'])){

    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $department = $_POST['department'];
    $address = $_POST['address'];

    $query = "INSERT INTO form (emp_name,emp_gender,emp_email,emp_department,emp_address)
    VALUES ('$name','$gender','$email','$department','$address')";

    $data = mysqli_query($conn,$query);
    if($data){
        echo "<script> alert('Data saved to database')</script>";
    }else{
        echo "<script> alert('Failed to save data')</script>";
    }
}

?>

<!-- This is for deleting part means we first access the particular data from database using id
and the moment we click on delete button after accessing the data , the data will be deleted from 
form and the database -->

<?php
if(isset($_POST['delete'])){
    $id = $_POST['search'];
    $query = "DELETE from form where id = '$id'";
    $data = mysqli_query($conn,$query);

    if($data){
        echo "<script> alert('Record Deleted')</script>";
    }
    else{
        echo "<script> alert('Failed Deletion')</script>";
    }
}
?>

<!-- for modifying/updating the data , this is done by 1st accessing the data fronm database
and then update it -->

<?php
if(isset($_POST['update'])){
    $id = $_POST['search'];
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $department = $_POST['department'];
    $address = $_POST['address'];

    $query = "UPDATE form SET emp_name='$name',emp_gender='$gender',
    emp_email='$email',emp_department='$department',emp_address='$address' 
    WHERE id ='$id'";

    $data = mysqli_query($conn,$query);
    if($data){
        echo "<script> alert('Data Updated')</script>";
    }
    else{
        echo "<script> alert('Failed Updation')</script>";
    }
}
?>