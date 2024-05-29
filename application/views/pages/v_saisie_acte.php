
<?php if (!isset($detail)) $detail = array(); ?>   
<?php if (!isset($acte)) $acte = array(); ?>   
<?php if (!isset($id)) $id = array(); ?>   
<div class="content-wrapper">
    <div class="row">
    <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Saisie Acte</h4>
                  <p class="card-description">
                    Patient : 
                  </p>
                  <form class="forms-sample" action="<?php echo site_url('CT_Paiement_acte/')?>"  method="POST">
                  <input type="hidden" name="id" class="form-control" id="exampleInputUsername2" value="<?php echo $id; ?>">
                    <div class="form-group row">
                      <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Acte</label>
                      <div class="col-sm-9">
                        <select class="form-control" name="acte" id="exampleSelectGender">
                          <?php foreach ($acte as $a) { ?>
                                <option value="<?php echo $a->id_acte_depense;?>"><?php echo $a->code;?> - <?php echo $a->nom;?></option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Montant</label>
                      <div class="col-sm-9">
                        <input type="numer" min="0"name="montant" class="form-control" id="exampleInputUsername2" placeholder="montant">
                      </div>
                    </div>
                    <button type="submit" class="btn btn-info mr-2">Valider</button>
                  </form>
                  <br>
                  <a href="<?php echo site_url('CT_Paiement_acte/facture')?>?id=<?php echo $id; ?>" target='_blank'  class="btn btn-danger ">Facture Actuel</a>
                </div>
              </div>
            </div>
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Tous les Actes</h4>
                  <p class="card-description">
                    Actes <code>.effectués</code>
                  </p>
                  <div class="table-responsive pt-3">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>Code.</th>
                          <th>Acte</th>
                          <th>Payer</th>
                          <th>Date de paiement</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($detail as $d) { ?>
                            <tr>
                                <td><?php echo $d->code ; ?></td>
                                <td><?php echo $d->acte ; ?></td>
                                <td><?php echo number_format($d->prix,2, ',', ' ') ; ?></td>
                                <td><?php echo $d->date_paiement_acte ; ?></td>
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