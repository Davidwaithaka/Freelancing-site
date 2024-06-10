<?php 
// Database connection and insertion
$servername = "Localhost";
$username = "root";
$password = "Routesoft-Admin";
$dbname = "freelancing";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $subject = $_POST['subject'];
    $type = $_POST['Type'];
    $additional_details = $_POST['Additional_details'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if file is a actual file or fake file 
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 5000000) { // 5MB limit
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if($fileType != "jpg" && $fileType != "png" && $fileType != "jpeg"
    && $fileType != "pdf" && $fileType != "docx") {
        echo "Sorry, only JPG, JPEG, PNG, PDF & DOCX files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
        }
      }
            

            $sql = "INSERT INTO academic (subject, Tutoring_type, Additional_details, upload_files)
            VALUES ('$subject', '$type', '$additional_details', '$target_file')";

            if ($conn->query($sql) === TRUE) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }

            $conn->close();
        } else {
            echo "Sorry, there was an error uploading your file.";
        } 
        ?>   
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" type="text/css" href="Freelancing space.css">
            <style>
                body {
                  background-color:beige;
                  font-family: Arial, sans-serif;
                  margin: 0;
                }
            
                .navbar {
                  display: block;
                  background-color: green;
                  padding: 10px;
                  color: white;
                }
            
                .navbar h1 {
                  text-align: center;
                }
            
                a {
                  text-decoration: none;
                  color: black;
                  font-weight: bold;
                  padding: 5px 10px;
                  border: 1px solid black;
                  border-radius: 5px;
                }
            
                form {
                  display: grid;
                  grid-gap: 10px;
                  width: 400px;
                  margin: 0 auto;
                  padding: 15px;
                  border: 1px solid #ccc;
                  border-radius: 5px;
                }
            
                label {
                  display: block;
                  font-weight: bold;
                }
            
                input[type="text"],
                input[type="file"] {
                  width: 100%;
                  padding: 5px;
                  border: 1px solid #ccc;
                  border-radius: 3px;
                }
            
                input[type="submit"] {
                  width: 120px;
                  padding: 10px;
                  background-color: green;
                  color: white;
                  border: none;
                  border-radius: 5px;
                  cursor: pointer;
                }
            
                .footer {
                  text-align: center;
                  padding: 10px;
                  background-color:green;
                  margin-top: 20px;
                }
            
                .footer h4 {
                  text-align: left;
                }
            
                .footer ul {
                  list-style: none;
                  padding: 0;
                  margin: 0;
                }
            
                .footer li {
                  margin-bottom: 5px;
                }
            
                .footer a {
                  color: black;
                }
              </style>
            <title>Academic Writing Services</title>
        </head>
        <body>
            <div class="navbar">
                <h1 style="text-align:center;">Welcome to Academic Writing Services</h1>
            </div>
            <a href="Freelancing space.html">Back to main page</a>
            <p>Fill the required details below to receive quality and timely writing services delivery</p>
            <form action="academic.php" method="post" enctype="multipart/form-data">
                <label for="subject">Subject</label>
                <input type="text" name="subject" id="subject" required>
                
                <label for="Type">Type of writing <i>e.g essay, research, thesis etc</i></label>
                <input type="text" name="Type" id="Type" required>
                
                <label for="Additional_details">Additional details</label>
                <input type="text" name="Additional_details" id="Additional_details" required><br>
                
                <label for="fileToUpload">Upload your document</label>
                <input type="file" name="fileToUpload" id="fileToUpload">
                
                <input type="submit" value="Place Order" name="submit">
            </form>
            
            <div class="footer">
                <h4 style="text-align: left;">Reach to us through:
                    <ul>
                        <li>+254704629251</li>
                        <li>davidwaithaka2018@gmail.com</li>
                        <li><a href="http://www.facebook.com">facebook</a></li>
                        <li><a href="http://www.twitter.com">twitter</a></li>
                    </ul>
                </h4>
                <p style="text-align:center;"><b>© Copyright 2024 powered by D Software Technologies DST</b></p>
            </div>
            </body>
        </html>
        

