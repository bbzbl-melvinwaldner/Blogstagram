<?php

// Initialisierung
$error = '';
$message = 'Sie haben sich erfolgreich registriert.';
$firstname = $lastname = $email = $username = '';

// Wurden Daten mit "POST" gesendet?
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Benutzereingaben verarbeiten und Fehler überprüfen
    $firstname = test_input($_POST["firstname"], "Vorname", $error);
    $lastname = test_input($_POST["lastname"], "Nachname", $error);
    $email = test_input($_POST["email"], "E-Mail", $error);
    $username = test_input($_POST["username"], "Benutzername", $error);
    $password = test_input($_POST["password"], "Passwort", $error);
}

function test_input($data, $fieldname, &$error) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);

    if ($fieldname === "E-Mail" && !filter_var($data, FILTER_VALIDATE_EMAIL)) {
        $error .= "$fieldname ist keine gültige E-Mail-Adresse!<br>";
    } elseif ($fieldname === "Benutzername" && !preg_match('/^[a-zA-Z0-9]{6,}$/', $data)) {
        $error .= "$fieldname muss aus Gross- und Keinbuchstaben bestehen und mindestens 6 Zeichen lang sein!<br>";
    } elseif ($fieldname === "Passwort" && !preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/', $data)) {
        $error .= "$fieldname muss aus Gross- und Kleinbuchstaben, Zahlen, Sonderzeichen bestehen und mindestens 8 Zeichen lang sein!<br>";
    } elseif (empty($data) || strlen($data) > 30) {
        $error .= "$fieldname entspricht nicht den Vorgaben!<br>";
    }

    return $data;
}

?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registrierung</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  </head>
  <body>

    <div class="container">
      <h1>Registrierung</h1>
      <p>
        Bitte registrieren Sie sich, damit Sie diesen Dienst benutzen können.
      </p>
      <?php
        // Ausgabe der Fehlermeldungen
        if(strlen($error)){
          echo "<div class=\"alert alert-danger\" role=\"alert\">" . $error . "</div>";
        } elseif (strlen($message)){
          echo "<div class=\"alert alert-success\" role=\"alert\">" . $message . "</div>";
        }
      ?>
      <form action="" method="post">
        <!-- TODO: Clientseitige Validierung: vorname -->
        <div class="form-group">
          <label for="firstname">Vorname *</label>
          <input type="text" name="firstname" class="form-control" id="firstname"
                  value="<?php echo htmlspecialchars($firstname) ?>"
                  placeholder="Geben Sie Ihren Vornamen an." required>
        </div>
        <!-- TODO: Clientseitige Validierung: nachname -->
        <div class="form-group">
          <label for="lastname">Nachname *</label>
          <input type="text" name="lastname" class="form-control" id="lastname"
                  value="<?php echo htmlspecialchars($lastname) ?>"
                  placeholder="Geben Sie Ihren Nachnamen an" required>
        </div>
        <!-- TODO: Clientseitige Validierung: email -->
        <div class="form-group">
          <label for="email">Email *</label>
          <input type="email" name="email" class="form-control" id="email"
                  value="<?php echo $email ?>"
                  placeholder="Geben Sie Ihre Email-Adresse an." required>
        </div>
        <!-- TODO: Clientseitige Validierung: benutzername -->
        <div class="form-group">
          <label for="username">Benutzername *</label>
          <input type="text" name="username" class="form-control" id="username"
                  value="<?php echo htmlspecialchars($username) ?>"
                  placeholder="Gross- und Keinbuchstaben, min 6 Zeichen." required>
        </div>
        <!-- TODO: Clientseitige Validierung: password -->
        <div class="form-group">
          <label for="password">Password *</label>
          <input type="password" name="password" class="form-control" id="password"
                  placeholder="Gross- und Kleinbuchstaben, Zahlen, Sonderzeichen, min. 8 Zeichen, keine Umlaute" required>
        </div>
        <button type="submit" name="button" value="submit" class="btn btn-info">Senden</button>
        <button type="reset" name="button" value="reset" class="btn btn-warning">Löschen</button>
      </form>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  </body>
</html>
