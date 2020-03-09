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
    }
    public function inscription()
    {
        $this->load->helper(array('form', 'url'));

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
        $this->load->helper(array('form', 'url'));

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
            $this->users_model->connexion();
            $this->load->view('templates/header');
            $this->load->view('test'); //redirige la personne a la page suivante une fois le formulaire rempli correctement
        }
    }
    public function logout(){
        $this->load->helper(array('form', 'url'));
        $this->session->sess_destroy();
        $this->load->view('templates/header');
        $this->load->view('connexion'); //Redirige la personne au formulaire car une erreur a été trouvé

    }
    public function reserv()
    {
        $this->load->helper(array('form', 'url'));

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
        $this->load->helper(array('form', 'url'));
        $this->load->view('templates/header');
        $this->load->view('listeReserv');
    }
}
