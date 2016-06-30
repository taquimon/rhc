<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
/**
 * Description of Account_Model
 *
 * @author Edwin Taquichiri
 */
class Partido_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->__exposedFields = array(
            'idCuenta',
            'titulo',
            'descripcion',
            'monto',
            'idSucursal ',
            'idUsuario',
            'esEntrada',
            'fechaAplicacionInicio',
            'fechaAplicacionFin',
            'fechaCreacion',
            'categoria'
        );
    }

    /**
     * Get the list of Partidos
     *
     * @return array
     */
    public function getPartidoList($gestion = null, $disciplina = null)
    {

        $this->db->select('*')
        ->from('partido p')
        ->where('YEAR(fecha)',$gestion);
        if($disciplina != null){
            $this->db->where('iddisciplina',$disciplina);
        }


        $query = $this->db->get();

        $result = $query->result();

        return $result;
    }

    public function getPartidoById($idpartido)
    {
        $query = $this->db->select()
            ->where('idpartido', $idpartido)
            ->get('partido');

        $partido = $query->first_row();

        if (!$partido) {
            throw new Exception("No se encontro el partido [$idpartido].");
        }

        return $partido;
    }

    public function insert($data)
    {

        $data ['fechaCreacion'] = date('Y-m-d H:i:s');
        $result = $this->db->insert('partido', $data);

        return $result;

    }

    /**
     * This method insert new data into club
     */
    public function updatePartido($idPartido, $data)
    {

        $this->db->where('idpartido', $idPartido);
        $result = $this->db->update('partido', $data);


        return $result;

    }
    public function getRanking($disciplina, $idclub, $gestion = null)
    {
        $query = $this->db->select()                
                ->where('YEAR(fecha)',$gestion)
                ->where("(equipo1 = {$idclub} OR equipo2 = {$idclub})")
                //->or_where('equipo2', $idclub)
                ->get('partido');
        
        $result = $query->result();

        return $result;
    }
}
