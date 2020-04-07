<html>
    <head>
        <title>Formulaire d'authentification</title>
    </head>
    <body>
        <div class="container">
            <?php 
            echo validation_errors(); 
            if(isset($error)){
                echo $error;
            }
            ?>
            <?php echo form_open('User/connexion'); ?>
            <table>
                <tr>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">E-mail</span>
                        </div>
                        <input class="form-control" type="email" name="email" value="" />
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
                        <input class="form-control btn-primary" type="submit" value="Valider" />
                    </div>
                </tr>
            </table>
        </div>
    </body>
</html>