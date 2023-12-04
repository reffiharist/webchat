<?php
 
namespace App\Models;
 
use CodeIgniter\Model;
 
class Datatable extends Model
{
    public $db;
    public $builder;
 
    public function __construct()
    {
        parent::__construct();
        $this->db = \Config\Database::connect();
    }
 
    protected function _get_datatables_query($table, $column_order, $column_search, $order)
    {
        $this->builder = $this->db->table($table);
        //jika ingin join formatnya adalah sebagai berikut :
        //$this->builder->join('tabel_lain','tabel_lain.kolom_yang_sama = pengguna.kolom_yang_sama','left');
        //end Join
        $i = 0;

        foreach ($column_search as $item) {
            if ($_POST['search']['value']) {
                if ($i === 0) {
                    $this->builder->groupStart();
                    $this->builder->like($item, $_POST['search']['value']);
                } else {
                    $this->builder->orLike($item, $_POST['search']['value']);
                }

                if (count($column_search) - 1 == $i){
                    $this->builder->groupEnd();
                }
            }

            $i++;
        }

        if (isset($_POST['order'])) {
            $this->builder->orderBy($column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($order)) {
            $order = $order;
            $this->builder->orderBy(key($order), $order[key($order)]);
        }

    }
 
    public function get_datatables($param = [])
    {
        $table = isset($param['table']) ? $param['table'] : FALSE;
        $columnOrder = isset($param['columnOrder']) ? $param['columnOrder'] : FALSE;
        $columnSearch = isset($param['columnSearch']) ? $param['columnSearch'] : FALSE;
        $order = isset($param['order']) ? $param['order'] : FALSE;
        $where = isset($param['where']) ? $param['where'] : FALSE;

        $this->_get_datatables_query($table, $columnOrder, $columnSearch, $order);

        if ($_POST['length'] != -1) {
            $this->builder->limit($_POST['length'], $_POST['start']);
        }

        if ($where) {
            $this->builder->where($where);
        }

        $query = $this->builder->get();

        return $query->getResult();
    }
 
    public function count_filtered($param = [])
    {
        $table = isset($param['table']) ? $param['table'] : FALSE;
        $columnOrder = isset($param['columnOrder']) ? $param['columnOrder'] : FALSE;
        $columnSearch = isset($param['columnSearch']) ? $param['columnSearch'] : FALSE;
        $order = isset($param['order']) ? $param['order'] : FALSE;
        $where = isset($param['where']) ? $param['where'] : FALSE;

        $this->_get_datatables_query($table, $columnOrder, $columnSearch, $order);

        if ($where) {
            $this->builder->where($where);
        }
        
        $this->builder->get();

        return $this->builder->countAll();
    }
 
    public function count_all($param = [])
    {
        $table = isset($param['table']) ? $param['table'] : FALSE;
        $where = isset($param['where']) ? $param['where'] : FALSE;

        if ($where) {
            $this->builder->where($where);
        }
        
        $this->builder->from($table);

        return $this->builder->countAll();
    }
}