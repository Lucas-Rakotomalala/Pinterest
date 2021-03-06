<?php
session_start();
require_once('./config/configuration.php'); // Fichier où l'on a toute les constantes
require_once(PATH_LIB . 'bd.php'); // Fichier qui gère l'execution des requetes, l'envoie ..
require_once(PATH_LIB . 'utilisateur.php'); // Fichier où l'on a mis les fonctions liés à la table utilisateur
require_once(PATH_LIB . 'discussion.php'); // 
require_once(PATH_LIB . 'add_funct.php'); // Toute les fonctions que l'on a déclaré jusqu'à maintenant

$link = getConnection($dbHost, $dbUser, $dbPwd, $dbName);
if (isset($_POST["logout"])) {

  $link = getConnection($dbHost, $dbUser, $dbPwd, $dbName);
  $check = getUser($_SESSION["pseudo"], $_SESSION["mdp"], $link);

  if (getUser($_SESSION["pseudo"], $_SESSION["mdp"], $link) == TRUE) {
    setDisconnected($_SESSION["pseudo"], $link);
    session_unset();
    header('Location: home.php');
    exit();
  }
}


?>
<?php include(PATH_VIEWS . 'v_head.php'); ?>

<body>

  <?php include(PATH_VIEWS . 'header.php'); ?>

  <div class="container shadow_container">
    <div class="title_container">
      <h1 style="padding-top: 1rem;">You have successfully add this Picture !</h1>
    </div>
    <div class="photo-grid" style="margin: 1rem 1rem;">
      <?php
        echo last_image_post($link); // Fonction dans lib/addfucntion.php qui affiche le php de la dernière image ajouté de la page addImage.php
      ?>
    </div>
  </div>
  <hr class="solid">
  <div class="title_container">
    <h3 style="color: black;">More content related to your picture</h3>
  </div>
  <div class="photo-grid">
    <?php 
      echo get_image_off_cat($link); // On affiche les images qui sont dans la même catégorie que l'image que l'utilisateur a ajouté.
    ?>
  </div>
</body>

</html>