<?php

include('includes/db_connection.php');
include('includes/helpers.php');
include('autoloader.php');

use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\NestedValidationException;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['username']) and isset( $_POST['password'])) {

        $prospect = new stdClass;
        $prospect->username = $_POST['username'];
        $prospect->password = sha1($_POST['password']);

        $prospectValidator = v::attribute('username', v::stringType()->noWhitespace())
            ->attribute('password', v::stringType()->noWhitespace());


        try {

            $prospectValidator->assert($prospect);

        } catch(NestedValidationException $exception) {
            // TODO
//            $i = 1;
//            foreach($exception as $e)
//            {
//                $_SESSION['validation_errors-'.$i] = $e->getMessage();
//                $i++;
//                header('Location: index.php');
//                die();
//            }
        }

        $sql = "select * from user where username = '$prospect->username' and password = '$prospect->password'";

        if ($result = $conn->query($sql))
        {
            $user = $result->fetchAll();

            print_r($user);
            if (count($user) > 0)
            {
                $_SESSION['user_id'] = $user[0]['id'];
                $_SESSION['flash'] = ['class' => 'success', 'message' => "Vous êtes maintenant connecté en tant que $prospect->username"];
                header('Location: index.php');

            } else {
               $_SESSION['flash'] = ['class' => 'error', 'message' => 'Erreur lors de la tentative de connection'];
               header('Location: index.php');
            }
        }

    }

}

requireWith('includes/layout/header.php', ['title' => 'Login'])

?>

    <form action="" method="post" style="margin-top: 3rem;">
      <div>
        <label for="username">Identifiant</label>
        <input type="text" name="username">
      </div>
      <div>
        <label for="password">Mot de passe </label>
        <input type="password" name="password">
      </div>
      <div>
        <button type="submit" name="button">Se connecter</button>
      </div>
    </form>
  </body>
</html>
