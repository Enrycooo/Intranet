<?php ob_start();?>
<?php
 if($_SESSION['username'] !== "" && $_SESSION['password'] !== ""){
    $user = $_SESSION['username'];
    $password = $_SESSION['password'];
    header("Location: index.php?action=connected&user=$user");
 }else{
     header("index.php");
 }
 ?>
&nbsp;
<section class="vh-100 gradient-custom">
  <div class="container py-5 h-100">
    <div class="row justify-content-center align-items-center h-100">
      <div class="col-12 col-lg-9 col-xl-7">
        <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
          <div class="card-body p-4 p-md-5">
            <h3 class="mb-4 pb-2 pb-md-0 mb-md-5">Créer un utilisateur</h3>
            <form name="form2" action='index.php?action=createUser&id=<?=$id?>' method='post'>

              <div class="row">
                <div class="col-md-6 mb-4">

                  <div class="form-outline">
                    <label class="form-label" for="Nom">Nom</label>
                    <input type="text" id="Nom" class="form-control form-control-lg" name='nom' required/>
                  </div>

                </div>
                <div class="col-md-6 mb-4">

                  <div class="form-outline">
                    <label class="form-label" for="Prenom">Prenom</label>  
                    <input type="text" id="Prenom" class="form-control form-control-lg" name='prenom' required/>
                  </div>

                </div>
              </div>

              <div class="row">
                <div class="col-md-6 mb-4 d-flex align-items-center">

                  <div class="form-outline">
                    <label class="form-label" for="email">Email</label>
                    <input type="email" id="email" class="form-control form-control-lg" name='email' required/>
                  </div>

                </div>
              </div>

              <div class="row">
                <div class="col-md-6 mb-4 pb-2">

                  <div class="form-outline">
                    <label class="form-label" for="username">Nom d'utilisateur</label>
                    <input type="text" id="username" class="form-control form-control-lg" name='username' required/>
                  </div>

                </div>
                <div class="col-md-6 mb-4 pb-2">

                  <div class="form-outline">
                    <label class="form-label" for="password">Mot de passe</label>
                    <input type="password" id="password" class="form-control form-control-lg" name='password' required/>
                  </div>

                </div>
              </div>

              <div class="row">
                  <div class="col-12">
                    <label class="form-label select-label">Choisissez le poste</label>
                    
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <label class="form-label select-label">Choisissez le manager</label>
                    
                  </div>
                <div class="col-12">

                  <select class="select form-control-lg" name="id_poste">
                    <?php
                    foreach($postes as $poste){ 
                        ?>
                    <option value="<?= htmlspecialchars($poste->id_poste) ?>">
                    <?= htmlspecialchars($poste->libelle) ?></option>
                    <?php
                    } 
                    ?>
                  </select>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    
                    <select class="select form-control-lg" name="id_manager">
                    <?php
                    foreach($managers as $manager){
                        ?>
                    <option value="<?= htmlspecialchars($manager->id_manager) ?>">
                    <?= htmlspecialchars($manager->prenom)." ".htmlspecialchars($manager->nom)?></option>
                    <?php
                    } 
                    ?>
                  </select>
                    
                </div>
              </div>

              <div class="mt-4 pt-2">
                <input class="btn btn-primary btn-lg" type="submit" value="Créer" />
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php $content = ob_get_clean(); ?>

<?php require('layout.php') ?>
