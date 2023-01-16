<?php ob_start();?>
<link rel="stylesheet" href="assets/css/style.css">

<div class="container-fluid px-4 py-2">
    <div class="row d-flex justify-content-center">
        <div class="col-xl-6 text-center"><div class="card">
                <h5 class="mb-4">Intranet Landry-Sintec AVI</h5>
            <form name="form2" action='index.php?action=createUser&id=<?=$id?>' method='post'>
            <div class="row">
                <div class="col-sm-6 flex-column d-flex"> 
                    <label class="form-control-label px-3" for="Nom">Nom</label>
                    <input type="text" id="Nom" name='nom' required/>
                </div>
                <div class="col-sm-6 flex-column d-flex">
                    <label class="form-control-label px-3" for="Prenom">Prenom</label>  
                    <input type="text" id="Prenom" name='prenom' required/>
                  </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 flex-column d-flex"> 
                        <label class="form-control-label px-3" for="email">Email</label>
                        <input type="email" id="email" name='email' required/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 flex-column d-flex">
                        <label class=form-control-label px-3" for="username">Nom d'utilisateur</label>
                        <input type="text" id="username" name='username' required/>
                  </div>
                    <div class="col-sm-6 flex-column d-flex">
                        <label class="form-control-label px-3" for="password">Mot de passe</label>
                        <input type="password" id="password" name='password' required/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 flex-column d-flex">
                        <label class="form-label select-label">Choisissez le poste</label>
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
                    </div>
                    <div class="col-sm-6 flex-column d-flex">
                        <label class="form-label select-label">Choisissez le manager</label>
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
                <div class="row">
                    <div class="form-group col-sm-12">
                        <input class="btn btn-primary" type="submit" value="Créer" />
                    </div>
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php $content = ob_get_clean(); ?>

<?php require('templates/layout.php') ?>
