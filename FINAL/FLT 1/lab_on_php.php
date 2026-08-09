<?php
// Initialize error variables to empty strings
$nameErr = "";
$ageErr = "";
$emailErr = "";
$membershipErr = "";
$departmentErr = "";
$contactErr = "";
$successMsg = "";

// Check if the submit button was clicked
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $hasError = false;

    // 1. Validate Name
    if (empty($_POST["name"])) {
        $nameErr = "Name is required";
        $hasError = true;
    } else {
        $name = $_POST["name"];
        // Check if name only has letters and spaces
        if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
            $nameErr = "Only letters and spaces are allowed.";
            $hasError = true;
        }
    }

    // 2. Validate Age
    if (empty($_POST["age"])) {
        $ageErr = "Age is required";
        $hasError = true;
    } else {
        $age = $_POST["age"];
        if (!is_numeric($age) || $age < 18 || $age > 30) {
            $ageErr = "Age must be between 18 and 30.";
            $hasError = true;
        }
    }

    // 3. Validate Email
    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
        $hasError = true;
    } else {
        $email = $_POST["email"];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format.";
            $hasError = true;
        }
    }

    // 4. Validate Membership
    if (empty($_POST["membership"])) {
        $membershipErr = "Please select a membership type.";
        $hasError = true;
    }

    // 5. Validate Department
    if (empty($_POST["department"])) {
        $departmentErr = "Please select your department.";
        $hasError = true;
    }

    // 6. Validate Contact Number
    if (empty($_POST["contact"])) {
        $contactErr = "Phone number is required";
        $hasError = true;
    } else {
        $contact = $_POST["contact"];
        // Check for exactly 11 digits
        if (!preg_match("/^[0-9]{11}$/", $contact)) {
            $contactErr = "Phone number must contain exactly 11 digits.";
            $hasError = true;
        }
    }

    // If no errors were found, show success message
    if ($hasError == false) {
        $successMsg = "Registration successful!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registration Form</title>
</head>
<body>

    <h2>Student Technology Club Registration</h2>

    <h3 style="color: green;"><?php echo $successMsg; ?></h3>

    <form method="POST" action="">
        
        <b>Student Name:</b><br>
        <input type="text" name="name"> 
        <span style="color: red;"><?php echo $nameErr; ?></span>
        <br><br>

        <b>Student Age:</b><br>
        <input type="number" name="age"> 
        <span style="color: red;"><?php echo $ageErr; ?></span>
        <br><br>

        <b>University Email:</b><br>
        <input type="email" name="email"> 
        <span style="color: red;"><?php echo $emailErr; ?></span>
        <br><br>

        <b>Membership Type:</b><br>
        <input type="radio" name="membership" value="Regular Member"> Regular Member
        <input type="radio" name="membership" value="Executive Member"> Executive Member
        <input type="radio" name="membership" value="Volunteer"> Volunteer
        <span style="color: red;"><?php echo $membershipErr; ?></span>
        <br><br>

        <b>Department:</b><br>
        <select name="department">
            <option value="">-- Select Department --</option>
            <option value="CSE">CSE</option>
            <option value="EEE">EEE</option>
            <option value="BBA">BBA</option>
            <option value="English">English</option>
            <option value="Architecture">Architecture</option>
        </select>
        <span style="color: red;"><?php echo $departmentErr; ?></span>
        <br><br>

        <b>Contact Number:</b><br>
        <input type="text" name="contact"> 
        <span style="color: red;"><?php echo $contactErr; ?></span>
        <br><br>

        <button type="submit">Register</button>

    </form>

</body>
</html>