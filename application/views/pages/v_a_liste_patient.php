
<?php if (!isset($list)) $list = array(); ?>   
<div class="content-wrapper">
    <div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Liste patients</h4>
                  <p class="card-description">
                    Liste <code>.Tous les patient</code>
                  </p>
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th># id</th>
                          <th>Nom</th>
                          <th>genre</th>
                          <th>date de naissance</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($list as $row) { ?>
                            <tr>
                            <td><?php echo $row->id_patient ;?></td>
                            <td><?php echo $row->nom ;?></td>
                            <td><?php echo $row->genre ;?></td>
                            <td><?php echo $row->date_naissance ;?></td>
                            <td><a href="<?php echo site_url('CT_Patient/detail_acte')?>?id=<?php echo$row->id_patient; ?>"  type="submit" class="btn btn-info mr-2">Acte</a></td>
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