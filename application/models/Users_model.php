<?php
class users_model extends CI_Model {
    private $identifiant;
    private $nom;
    private $prenom;
    private $courriel;
    private $mdp;
    private $ville;
    private $codepostal;
    private $telephone;
    private $isadmin;

    public function insertUser()
    {
        $this->identifiant = $_POST['user'];
        $this->nom = $_POST['nom'];
        $this->prenom = $_POST['prenom'];
        $this->courriel = $_POST['email'];
        $this->mdp = $this->verifMdp($_POST['mdp'],$_POST['mdp2']);
        $this->ville = $_POST['ville'];
        $this->codepostal = $_POST['cp'];
        $this->telephone = $_POST['telephone'];
        $this->isadmin  = false;

        $this->db->insert('client',$this);
    }  
    public function getUser($id){
        $query = $this->db->query('SELECT * FROM client WHERE idclient = '.$id);
        foreach($query->result() as $res){
            $this->identifiant = $res->identifiant;
            $this->nom = $res->nom;
            $this->prenom = $res->prenom;
            $this->courriel = $res->courriel;
            $this->mdp = $res->mdp;
            $this->ville = $res->ville;
            $this->codepostal = $res->codepostal;
            $this->telephone = $res->telephone;
            $this->isadmin = $res->isadmin;
        }
    }
    public function verifMdp($mdp,$mdp2){
        if($mdp==$mdp2){
            return md5($mdp);
        }
    }
    public function connexion(){
        $query = $this->db->query('SELECT * FROM client WHERE  mdp=? AND courriel =?', array(md5($_POST['mdp']), $_POST['email']));
        if($query->result()!=null){
            $this->session;
            $this->session->userdata();
            foreach($query->result() as $row){
                $this->session->set_userdata('id', $row->idclient);
            }
            if($this->isAdmin($_SESSION['id'])){
                $this->session->set_userdata('admin', true);
            }
            else{
                $this->session->set_userdata('admin', false);
            }
            return true;
        }
        else{
            return false;
        }
    }
    public function getInfo($id){
        $query = $this->db->query('SELECT * FROM client WHERE idclient = '.$id);
        return $query->result();
    }
    public function replacepassword(){
        $this->getUser($_SESSION['id']);
        if($this->mdp == md5($_POST['old_mdp'])){
            if($this->verifMdp($_POST['new_mdp'],$_POST['new_mdp_comfirm'])){
                $this->mdp = md5($_POST['new_mdp']);
                $this->db->update('client', $this, array('idclient' => $_SESSION['id']));
                return true;
            }
            else{return false;}
        }
        else{return false;}
    }

    public function isAdmin($id){
        $query = $this->getUser($id);
        if($this->isadmin){
            return true;
        }
        else{
            return false;
        }
    }
}