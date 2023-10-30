<?php
/*se puede decir que es como una clase abstracta pues en el index nunca se instancia Opercion directamente*/
class Operacion {
    protected $valor1;
    protected $valor2;
    protected $resultado;

    public function __construct(){
        $this->valor1 = 0;
        $this->valor2 = 0;
        $this->resultado = 0;
    }

    public function setValor1($val){
        $this->valor1 = $val;
    }
    
    public function setValor2($val){
        $this->valor2 = $val;
    }
    
    public function getResultado(){
        return $this->resultado;
    }
}

/*hereda de Operacion, asumimos que metodos y atributos se heredan a la sig clase*/
class Suma extends Operacion{
    public function operar(){
        $this->resultado = $this->valor1 + $this->valor2;
    }
}

class Resta extends Operacion{
    public function operar(){
        $this->resultado = $this->valor1 - $this->valor2;
    }
}
?>