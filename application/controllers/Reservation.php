<?php
class Reservation extends CI_Controller{
    public function __construct() 
    {
        parent::__construct();
        // Load contact model
        $this->load->model('reservations_model');
        $this->load->database();
        $this->load->library('session');
        $this->load->helper(array('form', 'url'));
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
    public function gestionreserv(){
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
    public function validation(){
        $this->reservations_model->validation($_POST['id']);
        $this->gestionreserv();
    }
    public function modification(){
        $this->load->library('form_validation');
        $this->form_validation->set_rules('datedebut', 'Date', 'required',
        array('required' => '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Attention</strong> La date est obligatoire.
        </div>'));
        if(isset($_SESSION['id'])){
            if(isset($_SESSION['admin'])){
                if($this->form_validation->run() == FALSE){
                    if(($query = $this->reservations_model->getRes($_POST['id']))!=null){
                        foreach($query as $res){
                            $idres = $res->idres;
                            $datedebut = $res->datedebut;
                            $datefin = $res->datefin;
                            $tarif = $res->tarif;
                            $etatres = $res->etatres;
                            $idclient = $res->idclient;
                            $nbclient = $res->nbclient;
                        }
                        $data['idres'] = $idres;
                        $data['datedebut'] = $datedebut;
                        $data['datefin'] = $datefin;
                        $data['tarif'] = $tarif;
                        $data['etatres'] = $etatres;
                        $data['idclient'] = $idclient;
                        $data['nbclient'] = $nbclient;
                    }
                    $this->load->view('templates/header');
                    $this->load->view('admin/modification',$data);
                }
                else{
                    $this->reservations_model->update();
                    $this->load->view('templates/header');
                    $this->load->view('test');
                }
            }
        }
    }
}
   