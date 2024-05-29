
<?php if (!isset($mois)) $mois = array(); ?>  
<?php if (!isset($recette)) $recette = array(); ?>  
<?php if (!isset($depense)) $depense = array(); ?>  
<?php if (!isset($benefice)) $benefice = array(); ?>  
<div class="content-wrapper">
    <div class="row">
            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Formulaire de sélection</h4>
                  <p class="card-description">
                    Choix de <code>.Mois & Année</code> Tableau de bord
                  </p>
                  <form class="form-inline" action="<?php echo site_url('CTA_Dashboard/getDash')?>"  method="POST">
                    <select class="form-control  mb-2 mr-sm-2" name="mois">
                          <?php for ($i=0; $i < count($mois); $i++) { $val = $i + 1;?>
                          <option value="<?php  echo $val;?>"><?php  echo $mois[$i];?></option>
                          <?php } ?>
                    </select>
                    <input type="number" name="an" min="2020" max="<?php echo date("Y");?>"  class="form-control mb-2 mr-sm-2" id="inlineFormInputGroupUsername2" placeholder="Année">
                    <button type="submit" class="btn btn-info mb-2">séectionner</button>
                  </form>
                </div>
              </div>
            </div>
    </div>
    <div class="row">
              <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Tableau de Bord</h4>
                    <p class="card-description">
                      Statistique <code>.Recette-Dépense-Bénéfice</code>
                    </p>
                    <div class="table-responsive pt-3">
                      <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th>ACTE-DEPENSE</th>
                            <th>Réels</th>
                            <th>Budget</th>
                            <th>Réalisation(%)</th>
                            <th>Année</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                              <th>RECETTE</th>
                          </tr>
                          <?php foreach ($recette as $r) { ?>
                            <tr>
                              <td><?php echo $r->code; ?></td>
                              <td><?php echo $r->sum; ?></td>
                              <td><?php echo number_format($r->budget,2, ',', ' '); ?></td>
                              <td><?php echo number_format($r->realisation,2, ',', ' '); ?></td>
                              <td><?php echo $r->annee; ?></td>
                            </tr>
                          <?php } ?>
                          <tr>
                              <th>DEPENSE</th>
                          </tr>
                          <?php foreach ($depense as $d) { ?>
                            <tr>
                              <td><?php echo $d->code; ?></td>
                              <td><?php echo $d->sum; ?></td>
                              <td><?php echo number_format($d->budget,2, ',', ' '); ?></td>
                              <td><?php echo number_format($d->realisation,2, ',', ' '); ?></td>
                              <td><?php echo $d->annee; ?></td>
                            </tr>
                          <?php } ?>
                          <tr>
                              <th>BENEFICE</th>
                          </tr>
                          <?php foreach ($benefice as $b) { ?>
                            <tr>
                              <td><?php echo $b['type'] ; ?></td>
                              <td><?php echo $b['total'] ; ?></td>
                              <td><?php echo $b['budget'] ; ?></td>
                              <td><?php echo $b['realisation'] ; ?></td>
                              <td></td>
                            </tr>
                          <?php } ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
    </div>            
</div>