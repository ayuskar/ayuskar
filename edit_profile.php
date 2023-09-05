<?php 
session_start();
  if (! isset( $_SESSION['user'])){
    $_SESSION['msg'] = "First,sign in to access of the page.";
    header('location: login.php');
    exit;
  }
  include('db_connection.php');
  // fetch the data from the database
  $user_id =  $_SESSION['user']['id'];
  $select_query = "SELECT * FROM `gorkhaaM` 
  WHERE `id` = '$user_id'";
  $result = mysqli_query($db_connection, $select_query);
  $user = mysqli_fetch_assoc($result);
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit profile page</title>
    <style >
    	/* Reset some default styles for better consistency */
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

/* Body styles */
body {
  font-family: Arial, sans-serif;
  line-height: 1.6;
  background-color: #f2f2f2;
  padding:10px;
}


/* Main section styles */
.editform {
  max-width: 600px;
  margin: 50px auto;
  padding: 20px;
border:5px solid #ddd;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  border-radius: 5px;
  font-family:'Times New Roman';
}

h2 {
  text-align: center;
  margin-bottom: 20px;
  color:white;
  font-family:'Garamond';
  font-weight:Bold;
  font-size:24px;
}

/* Form styles */
form {
  display: grid;
  gap: 15px;
}

label {
  font-weight: bold;
  color:#fdff00;
}

input[type="text"],
input[type="email"],
input[type="password"],
input[type="phone"] {
  width: 100%;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 5px;
  text-transform:none;
}

/* Gender radio button styles */
.gender {
  display: flex;
  gap: 10px;
  align-items: center;
}

/* Submit button styles */
input[type="submit"] {
  background-color: #333;
  color: #fff;
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

input[type="submit"]:hover {
  background-color: #555;
}

/* Footer styles */
footer {
  text-align: center;
  padding: 10px;
  color: #fff;
}

/* Responsive styles for smaller screens */
@media screen and (max-width: 768px) {
  section {
    max-width: 90%;
  }
}
.introduction {
    background-color: #f7f7f7; /* Choose a background color that fits your design */
    padding: 50px 0;
    text-align: center;
}

.introduction h3 {
    font-size: 24px;
    color: #333;
    max-width: 800px;
    margin: 0 auto;
}
/* Fixed footer styles */
.fixed-footer {
    position: fixed;
    bottom: -130px;
    left:-5% ;
    width: 100%;
   
    text-align: center;
    padding: 10px 0;
    z-index: 100; /* Make sure it's on top of other content */
}

/* Social icons styles */
.social-icons {
    margin-top: 10px;
}

.social-icons a {
    color: #fff;
    font-size: 24px;
    margin: 0 15px;
    transition: color 0.3s ease;
}

.social-icons a:hover {
    color: #f00; /* Change the color on hover if needed */
}


    </style>
</head>
<body>
<?php require('header.php'); ?>
    <?php
    if(isset($_SESSION['msg'])){
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
}
?>


 <div class="editform">
    <form action="edit_processing.php" method="post">
    <div class="personname">
        <h2>Edit Profile</h2>
        <label>Name: </label>
        <input type="text" name="name" value="<?php echo $user['name']; ?>">
    </div>
    <div>
        <label> Figure</label>
        
    <label>Image:</label>
    <img src="data:image/jpeg;base64,<?php echo base64_encode($user['image']); ?>" alt="photo" width="100">

    </div>
    <div>
        <label> Address</label>
        <input type="text" name="address" value="<?php echo $user['address']; ?>">
    </div>
    <div>
        <label>Email </label>
        <input type="email" name="email" value="<?php echo $user['email']; ?>">
    </div>
    <div>
        <label>Old Password</label>
        <input type="password" name="old_password" required placeholder="old_password">
    </div>
    <div>
        <label>New Password</label>
        <input type="password" name="new_password" placeholder="new_password">
    </div>
    <div>
        <label>Re-type New Password</label>
        <input type="password" name="confirm_password" placeholder="confirm_password">
    </div>
    <div>
        <label>Phonenumber</label>
        <input type="text" name="phone" value="<?php echo $user['phone']; ?>">
    </div>
    <div>
        <label>Gender</label>
        <div class="gender">
            <label><input type="radio" name="gender" value="1" <?php if($user['gender'] == 1) { echo 'checked'; } ?>>Male</label>
            <label><input type="radio" name="gender" value="2" <?php if($user['gender'] == 2) { echo 'checked'; } ?>>Female</label>
        </div>
    </div>
    <div>
        <input type="submit" name="update" value="Update">   
      <a href="membershipinfor.php"class="btn btn-primary"> See the membership info</a>
    </div>
    </form>
  
<footer class="fixed-footer">
        <p> "Empowering Minds, Elevating Spirits - Unleashing Potential with every Punch and Kick. © 2023 Gorkha Martial Arts. All Rights and Fights Reserved."</p>
    <div class="social-icons">
        <a href="https://www.facebook.com" target="_blank"><i class="fab fa-facebook"></i></a>
        <a href="https://www.instagram.com" target="_blank"><i class="fab fa-instagram"></i></a>
    </div>
</footer>
</div>
    
