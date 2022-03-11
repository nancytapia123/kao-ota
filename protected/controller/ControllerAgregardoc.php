<?php
class ControllerAgregardoc extends Controller {
    function __construct($view, $conf, $var, $acc) {
        parent::__construct($view, $conf, $var, $acc);
    }
     public function main() {
    	foreach ($this->var as $key => $value) {
            $this->data[$key] = $value;
            $$key = $value;
        }
        //indexModel::bd($this->conf)->controlAcceso(["1","2"]);

        $this->data["tipodocumento"] = indexModel::bd($this->conf)->getDominio("tipo_documento");
        $this->view->show("agregarDoc.html", $this->data, $this->accion);
    }
}
?>
