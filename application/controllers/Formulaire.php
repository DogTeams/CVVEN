<?php 
class Formulaire extends CI_Controller {
    public function __construct() 
    {
        parent::__construct();
        // Load contact model
        $this->load->model('reservations_model');
        $this->load->model('users_model');
        $this->load->database();
        $this->load->library('session');
        $this->load->helper(array('form', 'url'));
    }
    public function index(){
        $this->load->view('templates/header');
    }
    /**
     * Donne accès à la page d'inscription et permet d'analyzer le contenu du formulaire pour des sousis de sécurité
     * 
     */
    public function inscription()
    {
        
        $this->load->library('form_validation');
                
        $this->form_validation->set_rules('user', 'Utilisateur', 'required|min_length[5]|max_length[15]',
            array('required' => "Un nom d'utilisateur est obligatoire",
                'min_length' => "Le nom d'utilisateur est trop court",
                'max_length' => "Le nom d'utilisateur est trop long")
            );
        $this->form_validation->set_rules('mdp', 'Mot de passe', 'required',
                array('required' => 'Un mot de passe est obligatoire')
        );
        $this->form_validation->set_rules('mdp2', 'Confirmation du mot de passe', 'required',
                array('required' =>'La comfirmation du mot de passe est obligatoire')
        );
        $this->form_validation->set_rules('email', 'Email', 'required',
            array('required' =>'Un Email valide est obligatoire')
        );
        $this->form_validation->set_rules('ville', 'Ville', 'required',
            array('required' =>'La ville est obligatoire')
        );
        $this->form_validation->set_rules('cp', 'Code postal', 'required|min_length[5]|max_length[5]',
            array('required' =>'Le code postal est obligatoire',
            'min_length' => "Le code postal est trop court",
            'max_length' => "Le code postal est trop long")
        );
        $this->form_validation->set_rules('telephone', 'Numéro de téléphone', 'required|min_length[10]|max_length[10]',
            array('required' =>'Un numéro de téléphone valide est obligatoire',
                'min_length' =>"Le numéro de téléphone est trop court",
                'max_length' =>"Le numéro de téléphone est trop long")
        );

        if ($this->form_validation->run() == FALSE)
        {
            $this->load->view('templates/header');
            $this->load->view('formulaire'); //Redirige la personne au formulaire car une erreur a été trouvé
        }
        else
        {
            $this->users_model->insertUser();
            $this->load->view('templates/header');
            $this->load->view('FormulaireSucc'); //redirige la personne a la page suivante une fois le formulaire rempli correctement
        }
    }
    public function connexion()
    {

        $this->load->library('form_validation');
        $this->form_validation->set_rules('email', 'Email', 'required',
            array('required' =>'Un Email valide est obligatoire')
        );
        $this->form_validation->set_rules('mdp', 'Mot de passe', 'required',
        array('required' => 'Un mot de passe est obligatoire')
);
        if ($this->form_validation->run() == FALSE)
        {
            $this->load->view('templates/header');
            $this->load->view('connexion'); //Redirige la personne au formulaire car une erreur a été trouvé
        }
        else
        {
            $verif = $this->users_model->connexion();
            if($verif){
                $this->load->view('templates/header');
                $this->load->view('test');
            }
            if(!$verif){
                $data['error'] = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Erreur</strong> Identifiants incorrecte. email ou/et mot de passe</div>';
                $this->load->view('templates/header');
                $this->load->view('connexion',$data);
                
            }
             
        }
    }
    public function logout(){
        $_SESSION['id'] = null;
        $this->session->sess_destroy();
        $this->load->view('templates/header');
        $this->load->view('connexion');
    }
    public function annulation(){
        $this->reservations_model->annulation($_SESSION['id']);
        $this->listeReserv();
    }
    public function reserv()
    {

        $this->load->library('form_validation');

        $this->form_validation->set_rules('date', 'Date', 'required',
        array('required' => '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Attention</strong> La date est obligatoire.
      </div>')
        );
        $this->form_validation->set_rules('nbPersonne', 'NbPersonne', 'required',
        array('required' => '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Attention</strong> Le nombre de personne est obligatoire.
      </div>')
        );

        if ($this->form_validation->run() == FALSE)
        {
            $this->load->view('templates/header');
            $this->load->view('reserv'); //Redirige la personne au formulaire car une erreur a été trouvé
        }
        else
        {
            $this->reservations_model->insertReserv();
            $this->load->view('templates/header');
            $this->load->view('reserv'); //redirige la personne a la page suivante une fois le formulaire rempli correctement
        }
    }
    public function listeReserv(){
        if(isset($_SESSION['id'])){
            if(($query = $this->reservations_model->list($_SESSION['id']))!=null){
            foreach($query as $res){
                $idres[] = $res->idres;
                $datedebut[] = $res->datedebut;
                $datefin[] = $res->datefin;
                $tarif[] = $res->tarif;
                $etatres[] = $res->etatres;
                $nbclient[] = $res->nbclient;
            }
            $data['idres'] = $idres;
            $data['datedebut'] = $datedebut;
            $data['datefin'] = $datefin;
            $data['tarif'] = $tarif;
            $data['etatres'] = $etatres;
            $data['nbclient'] = $nbclient;
            $this->load->view('templates/header');
            $this->load->view('listeReserv',$data);
            }
            else{
                $this->load->view('templates/header');
                $this->load->view('listeReserv');
            }
        }
        else{
            $this->load->view('templates/header');
            $this->load->view('listeReserv');
        }

    }
    public function users(){
        if(isset($_SESSION['id'])){
            if(($query = $this->users_model->getInfo($_SESSION['id']))!=null){
            foreach($query as $res){
                $idclient = $res->idclient;
                $identifiant = $res->identifiant;
                $nom = $res->nom;
                $prenom = $res->prenom;
                $courriel = $res->courriel;
                $ville = $res->ville;
                $codepostal = $res->codepostal;
                $telephone = $res->telephone;
            }
            $data['idclient'] = $idclient;
            $data['identifiant'] = $identifiant;
            $data['nom'] = $nom;
            $data['prenom'] = $prenom;
            $data['courriel'] = $courriel;
            $data['ville'] = $ville;
            $data['codepostal'] = $codepostal;
            $data['telephone'] = $telephone;
            $this->load->view('templates/header');
            $this->load->view('users',$data);
            }
            else{
                $this->load->view('templates/header');
                $this->load->view('users',$data);
            }
        }
        else{
            $this->load->view('templates/header');
            $this->load->view('users');
        }
    }
    public function replacepassword(){
        $this->load->library('form_validation');
        $this->form_validation->set_rules('old_mdp', 'Ancien mot de passe', 'required',
            array('required' =>'Votre mot de passe est obligatoire')
        );
        $this->form_validation->set_rules('new_mdp', 'Mot de passe', 'required',
            array('required' => 'Un mot de passe est obligatoire')
        );
        $this->form_validation->set_rules('new_mdp_comfirm', 'Mot de passe', 'required',
            array('required' => 'La comfirmation du mot de passe est obligatoire')
        );
        if ($this->form_validation->run() == FALSE)
        {
            $this->load->view('templates/header');
            $this->load->view('replacepassword'); //Redirige la personne au formulaire car une erreur a été trouvé
        }
        else
        {
            $verif = $this->users_model->replacepassword($_SESSION['id']);
            if($verif){
                $this->load->view('templates/header');
                $this->load->view('replacepassword');
            }
            if(!$verif){
                $data['error'] = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Erreur</strong> </div>';
                $this->load->view('templates/header');
                $this->load->view('replacepassword',$data);
                
            }
             
        }
    }
    public function adminRes(){
        if(isset($_SESSION['id'])){
            if(isset($_SESSION['admin'])){
                if(($query = $this->reservations_model->listAll())!=null){
                foreach($query as $res){
                    $idclient[] = $res->idclient;
                    $prenom[] = $res->prenom;
                    $nom[] = $res->nom;
                    $idres[] = $res->idres;
                    $datedebut[] = $res->datedebut;
                    $datefin[] = $res->datefin;
                    $tarif[] = $res->tarif;
                    $etatres[] = $res->etatres;
                    $nbclient[] = $res->nbclient;
                }
                $data['idclient'] = $idclient;
                $data['prenom'] = $prenom;
                $data['nom'] = $nom;
                $data['idres'] = $idres;
                $data['datedebut'] = $datedebut;
                $data['datefin'] = $datefin;
                $data['tarif'] = $tarif;
                $data['etatres'] = $etatres;
                $data['nbclient'] = $nbclient;
                $this->load->view('templates/header');
                $this->load->view('admin/reservation',$data);
                }
                else{
                    $this->load->view('templates/header');
                    $this->load->view('admin/reservation');
                }
            }
            else{
                $this->load->view('templates/header');
                $this->load->view('admin/reservation');
            }
        }
    }
    public function validationRes(){
        $this->reservations_model->validation($_POST['id']);
        $this->adminRes();
    }
    public function modificationRes(){
        if(isset($_SESSION['id'])){
            if(isset($_SESSION['admin'])){
                if(($query = $this->reservations_model->getRes($_POST['id']))!=null){
                foreach($query as $res){
                    $idres = $res->idres;
                    $datedebut = $res->datedebut;
                    $datefin = $res->datefin;
                    $tarif = $res->tarif;
                    $etatres = $res->etatres;
                    $nbclient = $res->nbclient;
                }
                $data['idres'] = $idres;
                $data['datedebut'] = $datedebut;
                $data['datefin'] = $datefin;
                $data['tarif'] = $tarif;
                $data['etatres'] = $etatres;
                $data['nbclient'] = $nbclient;
                $this->load->view('templates/header');
                $this->load->view('admin/modification',$data);
                }
                else{
                    $this->load->view('templates/header');
                    $this->load->view('admin/modification');
                }
            }
            else{
                $this->load->view('templates/header');
                $this->load->view('admin/modification');
            }
        }
    }
    public function updateRes(){

    }
}
