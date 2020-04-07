<?php 
if(isset($_SESSION['id'])){
    if(isset($idclient)){
?>
    <table class="table">
        <tr>
            <thead class="thead-dark"><th>Identifiant</th> <th>mot de passe</th> <th>Nom</th> <th>Prénom</th> <th>email</th> <th>Ville</th> <th>Code postal</th> <th>Téléphone</th></thead>
        </tr>
<?php
    echo '<tr> <td>'.$identifiant.'</td> 
    <td>'.form_open('/User/replacepassword').'
        <button type="submit" class="btn btn-primary">Changer de mot de passe</button>
        '.form_close().'
    </td> <td>'.$nom.'</td> <td>'.$prenom.'</td> <td>'.$courriel.'</td> <td>'.$ville.'</td> <td>'.$codepostal.'</td> <td>'.$telephone.'</td> </tr> </table>';    
    }
}

