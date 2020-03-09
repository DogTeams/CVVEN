<?php
if(isset($_SESSION['co'])){

?>
<html>
    <head>
        <title>Formulaire de Réservation</title>
    </head>
    <body>
        <div class="container">
            <?php echo validation_errors(); ?>
            <?php echo form_open('Formulaire/reserv'); ?>
            <input type="hidden" value="<?php echo $this->session->id; ?>" name="id">
                <table class="table">
                    <tr>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">Date</span>
                            </div>
                            <input class="form-control" type="date" name="date" value="" />
                        </div>
                    </tr>
                    <tr>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">Nombre de personne</span>
                            </div>
                            <input class="form-control" type="number" name="nbPersonne" value="" min="0" />
                        </div>
                    </tr>
                    <tr>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">Pension/demi-pension</span>
                            </div>
                        <select class="form-control" name="pension">
                            <option value="0">Pension</option>
                            <option value="1">demi-pension</option>
                        </select>
                        </div>
                    </tr>
                    <tr>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">Ménage?</span>
                            </div>
                        <select class="form-control" name="pension">
                            <option value="0">Non</option>
                            <option value="1">Oui</option>
                        </select>
                        </div>
                    </tr>
                    <tr>
                        <div class="input-group mb-3">
                            <input class="form-control btn-primary" type="submit" value="Valider" />
                        </div>
                    </tr>
                </table>
            <?php echo form_close(); ?>
        </div>
    </body>
</html>
<?php
}