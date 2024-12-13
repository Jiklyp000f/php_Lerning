<?php
class Calculate{
    public $a;
    public $b;

    public function sum($a, $b){
        return $a+$b;
    }
    public function sub($a, $b){
        return $a-$b;
    }
    public function mul($a, $b){
        return $a*$b;
    }
    public function div($a, $b){
        try{return $a/$b;}
        catch(Exception $e){
            echo $e->getMessage();
        }
    }

}

    

?>