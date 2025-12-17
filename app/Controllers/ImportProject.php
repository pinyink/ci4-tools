<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class ImportProject extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();
        $crud = $db->table('kominfo_simblud.crud')->get()->getResultArray();
        foreach ($crud as $key => $value) {
            // print_r($value);
            $array = [
                'project_id' => 6,
                'namespace' => $value['namespace'],
                'controller' => $value['controller'],
                'model' => $value['model'],
                'table' => $value['table'],
                'route' =>$value['route'],
                'created_at' =>$value['created_at'],
                'updated_at' =>$value['updated_at']
            ];
            $crudField = $db->table('kominfo_simblud.crud_field')->where('crud_id', $value['id'])->get()->getResultArray();
            $db->table('cruds')->insert($array);
            $crud_id = $db->insertID();
            foreach ($crudField as $k => $v) {
                // print_r($v);
                $arr = [
                    'crud_id' => $crud_id,
                    'name' => $v['name'],
                    'label' => $v['label'],
                    'type' => $v['type'],
                    'min' => $v['min'],
                    'max' => $v['max'],
                    'settings' => $v['settings'],
                    'created_at' => $v['created_at'],
                    'updated_at' => $v['updated_at'],
                ];
                $db->table('crud_fields')->insert($arr);
            }
        }
    }
}
