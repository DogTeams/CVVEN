<?php
class users_model extends CI_Model {
    public $identifiant;
    public $nom;
    public $prenom;
    public $courriel;
    public $mdp;
    public $Ville;
    public $codepostal;
    public $telephone;

    public function insertUser()
    {
        $this->identifiant = $_POST['user'];
        $this->nom = $_POST['nom'];
        $this->prenom = $_POST['prenom'];
        $this->courriel = $_POST['email'];
        $this->mdp = $this->verifMdp($_POST['mdp'],$_POST['mdp2']);
        $this->Ville = $_POST['ville'];
        $this->codepostal = $_POST['cp'];
        $this->telephone = $_POST['telephone'];

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
            $this->Ville = $res->Ville;
            $this->codepostal = $res->codepostal;
            $this->telephone = $res->telephone;
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
            $this->session->set_userdata('co', true);
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
    public function replacepassword($id){
        $this->getUser($id);
        if($this->mdp == md5($_POST['old_mdp'])){
            if($this->verifMdp($_POST['new_mdp'],$_POST['new_mdp_comfirm'])){
                $this->mdp = md5($_POST['new_mdp']);
                $this->db->update('client', $this, array('idclient' => $id));
                return true;
            }
            else{return false;}
        }
        else{return false;}
    }
}