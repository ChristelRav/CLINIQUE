
<?php if (!isset($mois)) $mois = array(); ?>   
<?php if (!isset($depense)) $depense = array(); ?> 
<?php if (!isset($list)) $list = array(); ?> 
<div class="content-wrapper">
    <div class="row">
    <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">CSV Dépense</h4>
                  <p class="card-description">Données CSV</p>
                  <form class="forms-sample"  action="<?php echo site_url('CT_Depense/import_csv')?>"  method="POST"  enctype="multipart/form-data">
                    <div class="form-group">
                      <input type="file" name="csv_file" class="file-upload-default">
                      <div class="input-group col-xs-12">
                        <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                        <span class="input-group-append">
                          <button class="file-upload-browse btn btn-info" type="button">Import</button>
                        </span>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-info">valider</button>
                  </form>
                </div>
              </div>
            </div>
    </div>
    <div class="row">
            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Saisie de dépense</h4>
                  <form class="form-sample"  action="<?php echo site_url('CT_Depense/inserer_depense')?>"  method="POST">
                    <p class="card-description">Dépense(s)</p>
                    <div class="row">
                        <div class="col-md-2">  
                        </div>
                        <div class="col-md-8">
                            <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Type de dépense</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="depense">
                                     <?php foreach ($depense as $d) { ?>
                                     <option value="<?php  echo $d->id_acte_depense;?>"><?php  echo $d->code;?> - <?php  echo $d->nom;?></option>
                                     <?php } ?>
                                </select>
                            </div>
                            </div>
                        </div>
                        <div class="col-md-4">  
                        </div>
                    </div>
                    <div class="row">
                      <div class="col-md-3">
                        <div class="form-group row">
                          <div class="col-sm-9">
                            <input type="number" name="jour" min="01" max="31" class="form-control" placeholder="jour"/>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                            <div class="form-group row">
                                <?php for ($i=0; $i < count($mois); $i++) {  $val = $i+1; ?>
                                <div class="col-sm-5">
                                    <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input" name="mois[]" id="membershipRadios1" value="<?php echo $val; ?>" >
                                       <?php echo $mois[$i]; ?>
                                    </label>
                                    </div>
                                </div>
                                
                                <?php } ?>
                            </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group row">
                          <div class="col-sm-9">
                            <input type="number" min="2020" max="<?php echo date("Y");?>" name="an" class="form-control" placeholder="année" />
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">  
                        </div>
                        <div class="col-md-8">
                            <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Montant</label>
                            <div class="col-sm-9">
                                <input type="number" min="0" name="montant" class="form-control" placeholder="montant" />
                            </div>
                            </div>
                        </div>
                        <div class="col-md-4">  
                        </div>
                    </div>
                    <button type="submit" class="btn btn-info mr-2">valider</button>
                  </form>
                </div>
              </div>
            </div>
    </div>      
    <div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Dépenses</h4>
                  <p class="card-description">
                    Saisie <code>.des dépenses</code>
                  </p>
                  <div class="table-responsive pt-3">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>Code.</th>
                          <th>Désignation</th>
                          <th>Montant</th>
                          <th>Date dépense</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($list as $row) { ?>
                          <tr>
                            <td><?php echo $row->code; ?></td>
                            <td><?php echo $row->nom; ?></td>
                            <td><?php echo $row->montant; ?></td>
                            <td><?php echo $row->date_paiement_depense; ?></td>
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