<?php
  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Acc_admin extends CI_controller{
    
    
    private $titre_defaut;
    
    public function __construct(){
        
        parent::__construct();
        
        //initialisation du titre et du model 
        $this->titre_defaut = "Espace de gestion";
        $this->load->model('billet_model');
        //chargement library formulaire 
        $this->load->library('form_validation');
        $this->load->helper('form');
    }
    
    
    //initi par défaut lance view
    public function index(){
        
        $this->view();
    }
    
    
    
    public function view(){

        //lance la vue par défaut 
        $data['titre'] = $this->titre_defaut;

        $this->load->view('acc_admin',$data);
    }
    
    
    //function d'ajout d'un nouveau billet
    public function add(){

        //definition des regles des gestion des erreurs 
        $this->form_validation->set_error_delimiters('<p class="alert alert-danger">','</p>');
        $this->form_validation->set_rules('titre','Titre','trim|required|min_length[3]|max_length[52]|encode_php_tags');
        $this->form_validation->set_rules('commentaire','commentaire','trim|required|min_length[5]|max_length[6000],encode_php_tags');
        $this->form_validation->set_rules('date','date','regex_match[/[0-2][0-9][0-9][0-9]-[0-1][0-2]-[0-3][0-9]/]');
        
        
        //si le formulaire est validé et les données envoyées correctes
        if($this->form_validation->run()){
            //recupération des données
            $titre =$this->input->post('titre');
            $commentaire =$this->input->post('commentaire');
            $date = $this->input->post('date');
            
            //si date non renseignée alors mise en date du jour
            if(($date) == ''){
                $dt = new DateTime();
                $date = $dt->format('Y-m-d');           
            }
            
            //ajout du nouveau billet
            if($this->billet_model->add_billet($titre,$commentaire,$date) ){
            

                redirect(base_url(). 'index.php/acc_admin');
                
            
            
            //sinon retour page accueil
            }else{
           redirect(base_url(). 'index.php/acc_admin');
            
            }
            
        // si le form n'est pas validé on charge simplement la vue avec le formulaire     
        }else{
            $data['titre'] = $this->titre_defaut = 'Ajouter un billet';
            $this->load->view('add_billet',$data);
        }
        
        
    } 
    
    //function de recupération de la totalité des billets pour la liste déroulante
    //prend en parametre param qui indique si la demande vient de modifier == 1 ou supprimer == 0
    public function add_liste($param){
        
        //test $param
        if(is_numeric($param)){
            
            
        //l'id du billet selectionné doit être obligatoire
        $this->form_validation->set_rules('id','id','required');
        
            //si le formulaire est envoyé 
            if ($this->form_validation->run() == true){
               //recup de l'id pour envoie à la fonction d'update
                $id = $this->input->post('id');
                
                //param definit soit pour les modif soit pour les suppressions
                if($param == 1){
                $this->update($id);
                }
                
                if($param == 0){
                $this->billet_model->delete_billet($id);
                 redirect(base_url(). 'index.php/acc_admin');
                }
                
                else{
                    return false;
                }

            }   

            //si pas de validation du formulaire 
            else{

            //modif du titre et recupération de la liste des billet
                $data['titre'] = $this->titre_defaut = 'selection du billet';
                $data['liste'] = $this->billet_model->liste_comm($nb = null, $debut = null);
                $data['param'] = $param;
                //liste envoyée ensuite à la vue
                $this->load->view('acc_admin',$data);            


            }
        }
    
    }
    
    //fonction de modification du billet avec un id     
    public function update($id){
 
         //definition des regles des gestion des erreurs 
        $this->form_validation->set_error_delimiters('<p class="alert alert-danger">','</p>');
        $this->form_validation->set_rules('titre','Titre','trim|required|min_length[3]|max_length[52]|encode_php_tags');
        $this->form_validation->set_rules('commentaire','commentaire','trim|required|min_length[5]|max_length[6000],encode_php_tags');
        $this->form_validation->set_rules('date','date','regex_match[/[0-2][0-9][0-9][0-9]-[0-1][0-2]-[0-3][0-9]/]');
        
            
        if($this->form_validation->run()){
            //recupération des données
            $titre =$this->input->post('titre');
            $commentaire =$this->input->post('commentaire');
            $date = $this->input->post('date');
           
            
            //si date non renseignée alors mise en date du jour
            if(($date) == ''){
                $dt = new DateTime();
                $date = $dt->format('Y-m-d');           
            }
             
            

            //modification du billet en fonction de l'id paramétré
            if($this->billet_model->update_billet($id,$titre,$commentaire,$date) ){
                
               
                //si retour modif en true redirection acc admin
                redirect(base_url(). 'index.php/acc_admin');
                
            
            
            //sinon retour page accueil
            }else{
                redirect(base_url(). 'index.php/acc_admin');
            
            }  
            
            
            
            
        //si pas de validation du formulaire chargement du formulaire
        }else{
            
            
            //recupération du billet à modifier (1 billet, $debut = id du dit billet)
            $liste = $this->billet_model->liste_comm(1,$id);
            
            foreach ($liste as $row){
            
            $data['titre'] = $this->titre_defaut = 'modifier le billet '.$row->titre;
            $data['liste'] = $row;
            
            }
            
            //envoie des données à la vue pour initialiser la liste déroulante
            $this->load->view('update_billet',$data);            
            
            
       }
        
    }
}



