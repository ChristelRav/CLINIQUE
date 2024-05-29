<?php if (!isset($acte)) $acte = array(); ?>   
<?php if (!isset($depense)) $depense = array(); ?> 
<link rel="stylesheet" href="<?php echo base_url("assets/css/popup.css"); ?>" >
<div class="content-wrapper">
    <div class="row">
            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Insertion Acte_depense</h4>
                  <form class="form-inline" action="<?php echo site_url('CTA_Acte_Depense/save_AD')?>"  method="POST">
                    <label class="sr-only" for="inlineFormInputName2">Name</label>
                    <p><input type="text" name="code" class="form-control mb-2 mr-sm-2" id="inlineFormInputName2" placeholder="code">
                    <input type="text" name="nom" class="form-control mb-2 mr-sm-2" id="inlineFormInputGroupUsername2" placeholder="Designation"></p>
                    <p><input type="number" name="budget" min="0" class="form-control mb-2 mr-sm-2" id="inlineFormInputName2" placeholder="budget">
                    <select class="form-control mb-2 mr-sm-2" name="type">
                          <option value="1">Acte</option>
                          <option value="5">Dépense</option>
                    </select></p>
                    <p><button type="submit" class="btn btn-info mb-2">Submit</button></p>
                  </form>
                </div>
              </div>
            </div>
    </div>
    <div class="row">
            <div class="col-lg-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Liste des types actes</h4>
                  <p class="card-description">
                    Liste <code>.ACTE</code>
                  </p>
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>Code.</th>
                          <th>Désignation</th>
                          <th>Montant</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($acte as $a) { ?>
                        <tr>
                          <td><?php echo $a->code;?></td>
                          <td><?php echo $a->nom;?></td>
                          <td><?php echo number_format($a->budget,2,',',' ');?></td>
                          <td><button type="submit" class="btn btn-warning mr-2"  href="javascript:void(0);" onclick="openPopupUPF(<?php echo htmlspecialchars(json_encode( $a)); ?>)">  <i class="mdi mdi-pencil mx-0"></i></button></td>
                        </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Liste des types dépenses</h4>
                  <p class="card-description">
                    Liste <code>.DEPENSE</code>
                  </p>
                  <div class="table-responsive">
                    <table class="table ">
                      <thead>
                        <tr>
                          <th>Code.</th>
                          <th>Désignation</th>
                          <th>Montant</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($depense as $d) { ?>
                        <tr>
                          <td><?php echo $d->code;?></td>
                          <td><?php echo $d->nom;?></td>
                          <td><?php echo number_format($d->budget,2,',',' ');?></td>
                          <td><a type="submit" class="btn btn-warning mr-2" href="javascript:void(0);" onclick="openPopup(<?php echo htmlspecialchars(json_encode( $d)); ?>)"> <i class="mdi mdi-pencil mx-0"></i></a></td>
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

          
  <script src="<?php echo base_url("assets/js/popup.js"); ?>"></script>
<?php $this->load->view('pages/v_a_popup_acte'); ?>