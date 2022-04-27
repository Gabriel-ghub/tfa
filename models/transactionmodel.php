<?php

class TransactionModel extends Model{
    private $id_gasto;
    private $concepto;
    private $fecha;
    private $monto;


    public function __construct()
    {
        parent::__construct();
        
    }

    public function makeTransaction(){
        try{
            $query = $this->prepare('INSERT INTO gastos(concepto,fecha,monto VALUES(:concepto,:fecha,:monto)');
            $query->execute(['concepto'=>$this->concepto,
                            'fecha'=>$this->fecha,
                            'monto'=>$this->monto
            ]);
            return true;
        }catch(PDOException $e){
            error_log('USERMODEL::save->PDOException '.$e);
            return false;
        }
    }
}


?>
