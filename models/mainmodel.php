<?php

class MainModel extends Model{
    public $datos = [];
    function __construct(){
        parent::__construct();
    }

    function cargaGastos(){
        $query = $this->prepare("SELECT * FROM GASTOS ORDER BY FECHA DESC");
        $query->execute();

        while($result = $query->fetch(PDO::FETCH_ASSOC)){
            array_push($this->datos,$result);
        }
        return $this->datos;
    }

    function deleteById($id){

        $query = $this->prepare("DELETE FROM GASTOS WHERE id_gasto = :id");
        $query->execute([
            'id' => $id
        ]);

        if($query->rowCount()>0){
            return true;
        }else{
            return false;
        }
    }




}

?>