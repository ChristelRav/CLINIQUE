<div id="shadow" class="overlay" onclick="closePopup()"></div>
    <div id="popupUF" class="popup">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Mise à jour Budget Annuel</h4>
                        <form class="forms-sample" action="<?php echo site_url('CTA_Acte_Depense/updateD') ?>" method="post" >
                        <input type="hidden" name="id" class="form-control" id="id" >
                            <div class="form-group row">
                                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Nom</label>
                                <div class="col-sm-9">
                                    <input type="text" name="type" class="form-control" id="type" >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Nouveau Budget</label>
                                <div class="col-sm-9">
                                    <input type="number" min="0" name="cent" class="form-control" id="cent" >
                                </div>
                            </div>
                            <button type="submit" class="btn btn-warning mr-2">Mise à jour</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



