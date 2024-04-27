<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style/style.css">
    <title>Connexion</title>
    <style>
    body {
        margin: 0;
        padding: 0;
    }
    .container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }
    .box {
        background: rgba(255, 255, 255, 0.8);
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        max-width: 400px;
        width: 100%;
    }
    .box header {
        text-align: center;
        font-size: 24px;
        margin-bottom: 20px;
    }
    .logo-container {
        position: absolute;
        top: 20px;
        left: 20px;
    }
    .logo {
        width: 150px; /* Ajustez la taille selon vos besoins */
        height: auto;
    }
    .field {
        margin-bottom: 20px;
    }
    .field label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }
    .field input[type="text"],
    .field input[type="password"] {
        width: 100%;
        padding: 10px;
        border-radius: 5px;
        border: 1px solid #ccc;
    }
    .field input[type="submit"] {
        background-color: #4caf50; 
        color: white;
        padding: 10px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        width: 100%;
    }
    .field input[type="submit"]:hover {
        background-color: #45a049; 
    }
    .links {
        text-align: center;
    }
    .links a {
        color: #4caf50;
        text-decoration: none;
    }
    .links a:hover {
        text-decoration: underline;
    }
    .message {
        background-color: #f44336; 
        color: white;
        padding: 10px 20px;
        border-radius: 5px;
        margin-bottom: 20px;
        text-align: center;
    }

    .btn {
        display: inline-block;
        padding: 10px 20px;
        font-size: 16px;
        cursor: pointer;
        text-align: center;
        text-decoration: none;
        border: none;
        border-radius: 5px;
        background-color: #4CAF50;
        color: white;
        }

        .btn:hover {
        background-color: #45a049;
        }

        .btn:active {
        background-color: #3e8e41;
        }

    

    </style>
</head>
<body>
    <div class="logo-container">
        <img src="https://data.gov.tn/media/images/logo_transtu-removebg-preview.2e16d0ba.fill-341x308.png" alt="Logo" class="logo">
    </div>
    <div class="container">
        <div class="box form-box">
            <?php 

            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "copy_stage";

            $con = mysqli_connect($servername, $username, $password, $dbname);

            if(isset($_POST['submit'])){

                $email = mysqli_real_escape_string($con,$_POST['email']);
                $password = mysqli_real_escape_string($con,$_POST['password']);

                $result = mysqli_query($con,"SELECT * FROM admin WHERE Email='$email' AND Password='$password' ") or die("Erreur de sélection");
                $row = mysqli_fetch_assoc($result);

                if(is_array($row) && !empty($row)){

                    $_SESSION['valid'] = $row['email'];
                    $_SESSION['id'] = $row['id'];
                }else{
                    echo "<div class='message'>
                      <p>Adresse ou mot de passe incorrect</p>
                       </div> <br>";
                   echo "<a href='connexion.php'><button class='btn'>Retourner</button>";
         
                }

                if(isset($_SESSION['valid'])){
                    header("Location:vue/dashboard.php");
                }
                

              }else{

            
            ?>
            <header>Connexion</header>
            <form action="" method="post">
                <div class="field input">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" class="form_style" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="password">Mot de passe</label>
                    <input type="password" name="password" id="password" class="form_style" autocomplete="off" required>
                </div>

                <div class="field">
                    
                    <input type="submit" class="btn" name="submit" value="Connexion" required>
                </div>

            </form>
        </div>
        <?php } ?>
    </div>
</body>
</html>
