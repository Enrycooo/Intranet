<?php ob_start();?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"/>
<link rel="stylesheet" href="assets/css/style.css">


<div class="container-fluid px-1 py-5 mx-auto">
    <div class="row d-flex justify-content-center">
        <div class="col-xl-7 col-lg-8 col-md-9 col-11 text-center"><div class="card">
                <h5 class="text-center mb-4">Intranet Landry-Sintec AVI</h5>
                <form name="form3" class="form-card" action='index.php?action=createConges&id=<?=$id?>' method='post'>
                    <div class="row justify-content-between text-left">
                        <div class="form-group col-sm-6 flex-column d-flex"> 
                            <label class="form-control-label px-3">Date de début<span class="text-danger"></span></label> 
                            <input type="date" id="date_fin" name="date_debut"> 
                        </div>
                        <div class="form-group col-sm-6 flex-column d-flex"> 
                            <label class="form-control-label px-3">Date de fin<span class="text-danger"></span></label> 
                            <input type="date" id="date_fin" name="date_fin"> 
                        </div>
                    </div>
                    <div class="row justify-content-between text-left">
                        <div class="form-group col-sm-6 flex-column d-flex"> 
                            <label class="form-control-label px-3">Raison<span class="text-danger"></span></label>
                            <select class="select form-control-lg" name="id_raison">
                                <option value="0" disabled>Choisissez une raison</option>
                                <?php
                                foreach($raisons as $raison){
                                ?>
                                <option value="<?= htmlspecialchars($raison->id_raison) ?>">
                                <?= htmlspecialchars($raison->libelle) ?></option>
                                <?php
                                } 
                                ?>
                             </select>
                        </div>
                        <div class="form-group col-sm-6 flex-column d-flex"> 
                            <label class="form-control-label px-3">Duree<span class="text-danger"></span></label> 
                            <input type="text" id="duree" name="duree"> 
                        </div>
                    </div>
                    <div class="row justify-content-between text-left">
                        <div class="form-group col-12 flex-column d-flex"> 
                            <label class="form-control-label px-3">Commentaire<span class="text-danger"></span></label>
                            <input type="text" id="commentaire" name="commentaire"> 
                        </div>
                    </div>
                    <div class="row justify-content-end">
                        <div class="form-group col-sm-6"> 
                            <button type="submit" class="btn-block btn-primary">Faire la demande</button> 
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('layout.php') ?>