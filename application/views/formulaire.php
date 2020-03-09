<html>
    <head>
        <title>Formulaire d'inscription</title>
    </head>
    <body>
        <div class="container">
            <?php echo validation_errors(); ?>
            <?php echo form_open('Formulaire/inscription'); ?>
                <table class="table">
                <tr>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Identifiant</span>
                        </div>
                        <input class="form-control" type="text" name="user" value="" />
                    </div>
                </tr>
                <tr>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Nom</span>
                        </div>
                        <input class="form-control" type="text" name="nom" value="" />
                    </div>
                </tr>
                <tr>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Prénom</span>
                        </div>
                        <input class="form-control" type="text" name="prenom" value="" />
                    </div>
                </tr>
                <tr>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">mot de passe</span>
                        </div>
                        <input class="form-control" type="password" name="mdp" value="" />
                    </div>
                </tr>
                <tr>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Comfirmation mot de passe</span>
                        </div>
                        <input class="form-control" type="password" name="mdp2" value="" />
                    </div>
                </tr>
                <tr>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">email</span>
                        </div>
                        <input class="form-control" type="email" name="email" value="" />
                    </div>
                </tr>
                <tr>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Ville</span>
                        </div>
                        <input class="form-control" type="text" name="ville" value="" />
                    </div>
                </tr>
                <tr>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Code Postal</span>
                        </div>
                        <input class="form-control" type="text" name="cp" value=""/>
                    </div>
                </tr>
                <tr>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Numéro de téléphone</span>
                        </div>
                        <input class="form-control" type="text" name="telephone" value="" />
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