<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Club
 *
 * @author phantom
 */
class Club extends MY_Controller {
    
    public function __construct()
    {
        parent::__construct();
        
        $this->load->model('club_model', 'clubModel');
    }
    public function index()
    {
        
        $clubs = $this->clubModel->getClubList();
        
        $this->data   = $clubs;
        $this->middle = 'clubs/clubList';
        $this->layout();
    }
    public function ajaxListClub($disciplina = "Todos"){
        
        $filters = array();
        if(isset($this->request['disciplina'])){
            $filters['iddisciplina'] = $this->request['disciplina'];
            if($filters['iddisciplina']=='Todos'){
                $filters = null;
            }
        }

        $clubs = $this->clubModel->getClubList($filters);
        
        foreach($clubs as $club){
            $link = $club->idclub;
            $club->buttons =  '<a href="javascript:loadClubData('.$link.')" class="button cycle-button bg-cobalt fg-white"><span class="mif-pencil"></span></a>' ;   
        } 
        $data['recordsTotal'] = count($clubs);
        $data['data'] = $clubs;
        
        echo json_encode($data);
    }

    public function ajaxGetAllClubs(){
        $clubs = $this->clubModel->getAllClubs();

        $data['recordsTotal'] = count($clubs);
        $data['data'] = $clubs;
        
        echo json_encode($data);

    }
    /**
    * Get the name of clubes
    */
    public function ajaxGetClubNames(){
        $clubs = $this->clubModel->getAllClubs();
        
        foreach($clubs as $club){
            $dataNames[] = array(
            'id' => $club->idclub,
            'name' => strtoupper($club->name)
           );        
        }                 
        
        echo json_encode($dataNames);
    }
    public function jsonGuardarNuevo()
    {
        $result = new stdClass();
        try{            
            $data['name']        = $this->request['name'];
            $data['description'] = $this->request['description'];
            //$data['zona']        = $this->request['zona'];
            //print_r($data);
            $userData = $this->clubModel->insert($data);

            if ($userData) {
                $result->message = html_message("Se agrego correctamente el nuevo Club","success");
            }

        } catch (Exception $e) {
            $result->message = "No se pudo agregar los datos ".$e->getMessage();
        }
        echo json_encode($result);
    }
    
    public function jsonGuardarClub()
    {
        $result = new stdClass();
        try{            
            $data['name']        = $this->request['name'];
            $data['description'] = $this->request['description'];
            //$data['zona']        = $this->request['zona'];
            
            $idClub = $this->request['idClub'];
            //print_r($data);
            $userData = $this->clubModel->updateClub($idClub, $data);

            if ($userData) {
                $result->message = html_message("Se actualizo correctamente los datos del Club","success");
            }

        } catch (Exception $e) {
            $result->message = "No se pudo actualizar los datos ".$e->getMessage();
        }
        echo json_encode($result);
    }
    
    public function ajaxGetClubById()
    {
        $clubId = $this->request['clubId'];
        
        $clubData = $this->clubModel->getClubById($clubId);
        
        echo json_encode($clubData);
    }
}
