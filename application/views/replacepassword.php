
<html>
    <head>
        <title>Changer de mot de passe</title>
    </head>
    <body>
        <div class="container">
            <?php 
            echo validation_errors(); 
            if(isset($error)){
                echo $error;
            }
            if(isset($valide)){
                echo $valide;
            }
            ?>
            <?php echo form_open('User/replacepassword'); ?>
            <table>
                <tr>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Ancien mot de passe</span>
                        </div>
                        <input class="form-control" type="password" name="old_mdp" value="" />
                    </div>
                </tr>
                <tr>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Nouveau mot de passe</span>
                        </div>
                        <input class="form-control" type="password" name="new_mdp" value="" />
                    </div>
                </tr>
                <tr>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Saisir à nouveau le mot de passe</span>
                        </div>
                        <input class="form-control" type="password" name="new_mdp_comfirm" value="" />
                    </div>
                </tr>
                <tr>
                    <div class="input-group mb-3">
                        <input class="form-control btn-primary" type="submit" value="Valider" />
                    </div>
                </tr>
            </table>
        </div>
    </body>
</html>