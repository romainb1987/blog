<?php
  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Accueil extends CI_controller{
    
    
    private $titre_defaut;
    const NB_COMM_PAGE = 5;
    
    public function __construct(){
        
        parent::__construct();
        
        //initialisation du titre et du model 
        $this->titre_defaut = "mon blog de vadrouille";     
        $this->load->model('admin_model');
        $this->load->model('billet_model');
        
    }
    
    
    //recupération d'une variable $_GET si il y en a une sinon init a 1
    public function index($g_nb_comm = 1){
        
        $this->view($g_nb_comm);
    }
    
    
    
    public function view($g_nb_comm = 1){
        
        //compte du nombre de comm dans la BDD
        $nb_commentaire_total = $this->billet_model->count();
        
        //verif si le parametre passé a index est cohérent
        if($g_nb_comm >1){
            //verif si le parametre n'est pas supérieur au nombre total de commentaires
            if($g_nb_comm <= $nb_commentaire_total){
                
                //dans ce cas on note le numéro de commentaire
                $nb_commentaire = intval($g_nb_comm);
            }
            //dans les autres cas init du nombre a 1
            else{
                $nb_commentaire = 1;
            }
                
        }
        else{
            $nb_commentaire = 1;
        }
        
        //config de la pagination
        $this->pagination->initialize(array('base_url' => base_url().'index.php/accueil/view/',
                                           'total_rows' => $nb_commentaire_total,
                                           'per_page'=> self::NB_COMM_PAGE));

        
        //creation de la pagination
        $data['pagination'] = $this->pagination->create_links();
        $data['titre'] = $this->titre_defaut;
        //recupération de la liste des billets param nombre par page ; numero du billet voulu -1
        $data['comms'] = $this->billet_model->liste_Comm(self::NB_COMM_PAGE, $nb_commentaire-1);
        
        $data['nb_commentaires'] =  $nb_commentaire_total;
        //chargement de la vue accueil et passage des parametres 
        $this->load->view('accueil',$data);
    }
    
    public function connect(){
        
        //chargement library formulaire 
        $this->load->library('form_validation');
        $this->load->helper('form');
        
        //definition des regles des gestion des erreurs 
        $this->form_validation->set_error_delimiters('<p class="alert alert-danger">','</p>');
        $this->form_validation->set_rules('pseudo','Pseudo','trim|required|min_length[3]|max_length[52]|alpha_dash|encode_php_tags');
        $this->form_validation->set_rules('password','Mot de passe','trim|required|min_length[5]|max_length[25]|encode_php_tags');
        
        
        //si le formulaire est validé et les données envoyées correctes
        if($this->form_validation->run() == true){
            //recupération des données
            $pseudo =$this->input->post('pseudo');
            $mdp =$this->input->post('password');
            
            
            //lancement de verif_admin()
            if($this->admin_model->verif_admin($pseudo,$mdp) ){
                //si identité ok chargement controller de ac_admin 
                redirect(base_url(). 'index.php/acc_admin');
                
            
            
            //sinon retour page accueil
            }else{
           redirect(base_url());
            
            }  
        //si le formulaire n'est pas validé alors on l'affiche   
        }else{
            $data['titre'] = $this->titre_defaut = 'Connexion administrateur';
            $this->load->view('form_connect',$data);
        }
        
    }
}


