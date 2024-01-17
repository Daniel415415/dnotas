<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Notas_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function obtenerNotas($id,$id_cat=null)
    {

        $query = $this->db->query("SET lc_time_names = 'es_ES'");
        $this->db->where('id_usuario', $id);
       
        if($id_cat!=null && $id_cat!='undefined'){
            $this->db->where('id_categoria', $id_cat);
        }
        $query = $this->db->get('notav');
        // var_dump($query);
        // die();
        // if($query->num_rows()>0) 
        return $query->result();
        // else return false;
    }
    function obtenerNotasBorradas($id)
    {
        $query = $this->db->query("SET lc_time_names = 'es_ES'");
        $this->db->where('id_usuario', $id);
        $query = $this->db->get('notav_borradas');
        // var_dump($query);
        // die();
        // if($query->num_rows()>0) 
        return $query->result();
        // else return false;
    }
    function insertarNota($data)
    {
        $this->db->insert('nota', $data);
        $sql = $this->db->last_query();
        return $sql;
        // else return false;
    }
    function seleccionarUltimaNota($id)
    {
        $query = $this->db->query("SET lc_time_names = 'es_ES'");
        $this->db->where('id_usuario', $id);
        $this->db->order_by('id_nota', 'desc');
        $this->db->limit(1);
        $query = $this->db->get('notav');
        // var_dump($query->row());
        // die();
        // if($query->num_rows()>0) 
        return $query->row();
        // else return false;
    }



    function updateNota($id_nota, $data)
    {
        $this->db->where('id_nota', $id_nota);
        $this->db->update('nota', $data);
    }
    function eliminarNota($id_nota)
    {
        $this->db->where('id_nota', $id_nota);
        $this->db->delete('nota');

        // else return false;
    }
    function consultar_usuario($correo, $contraseña)
    {
        $this->db->where('correo', $correo);
        $this->db->where('contraseña', $contraseña);
        $query = $this->db->get('usuarios');
        // var_dump($this->db->last_query());
        // die();
        return $query->result();
    }
    function insertarUsuario($data)
    {
        $this->db->insert('usuarios', $data);
        $sql = $this->db->last_query();
        return $sql;
        // else return false;
    }
    function obtenerCategorias($id_usuario)
    {
        $this->db->where('id_usuario', $id_usuario);
        $this->db->where('eliminada', 'no');
        $query = $this->db->get('categorias');
        return $query->result();
    }
    function asignarCategoria($data)
    {
        $this->db->where('id_nota', $data['id_nota']);
        $this->db->where('id_usuario', $data['id_usuario']);
       $this->db->set('id_categoria', $data['id_categoria']);
       $query= $this->db->update('nota', $data);
       
    }





    function obtener_todas_notas($filtros)
    {
        $whereArray = [];
        $filtrar = false;

        $response = [
            'total' => 0,
            'resultArray' => null,
        ];
        //debug($filtros);die;

        if (is_numeric($filtros['limit']))
            $this->db->limit($filtros['limit']);

        if (is_numeric($filtros['offset']))
            $this->db->limit($filtros['limit'], $filtros['offset']);

        // foreach ($filtros['filter'] as $key => $value) {
        //     //debug($key);
        //     $filtroData = explode('-', $key);
        //     //debug($filtroData);
        //     if (!empty($value)) {
        //         $filtrar = true;
        //         $where = "({$filtroData[0]}.{$filtroData[1]} like '%{$value}%')";
        //         array_push($whereArray, $where);
        //     }
        // }
        // //debug($filtros['filter']);

        // //$where = "({$this->tabla}.borrado = 0)";

        // if ($filtrar) {
        //     $where .= " and (";
        //     for ($i = 0; $i <= count($whereArray) - 1; $i++) {
        //         $where .= $whereArray[$i];
        //         if ($i < count($whereArray) - 1)
        //             $where .= " and ";
        //     }
        //     $where .= ")";
        // }

        $select = ("nota.id_nota,
            nota.titulo_nota,
            nota.descripcion_nota,
            usuarios.nombre_us,
            usuarios.id_us"
        );
        $this->db->select($select);
        $this->db->from('nota');
        $this->db->join('usuarios', 'usuarios.id_us=nota.id_usuario');
        //$this->db->where($where);
        $query = $this->db->get();

        $this->db->select($select);
        $this->db->from('nota');
        $this->db->join('usuarios', 'usuarios.id_us=nota.id_usuario');

        $numRows = $this->db->get()->num_rows();

        $response['total'] = $numRows;
        $response['resultArray'] = $query->result_array();

        return $response;
    }

    function insertarCategoria($data)
    {
        $this->db->insert('categorias', $data);
        $sql = $this->db->last_query();
        return $sql;
        // else return false;
    }
    function eliminarCat($id_cat, $id_usuario)
    {
        $this->db->where('id_cat', $id_cat);
        $this->db->where('id_usuario', $id_usuario);
        $this->db->update('categorias', ['eliminada' => 'si']);
    }
   
    function eliminarNotasCategoria($id_cat, $id_usuario)
    {
        $this->db->where('id_categoria', $id_cat);
        $this->db->where('id_usuario', $id_usuario);

        $this->db->update('nota', ['eliminada' => 'si']);
    }
    
}
