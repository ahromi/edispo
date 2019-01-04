<?php
class Autocomplete extends Controller {
 
    function Autocomplete()
    {
        parent::Controller();    
 
        // load models
        $this->load->model('autocomplete_model');
    }
 
    function index()
    {
        $this->load->view('autocomplete', array());
    }
 
    function get_Names()
    {
        $q = strtolower($_POST["q"]);
        if (!$q) return;
 
        // form dropdown and myql get countries
        $airports = $this->autocomplete_model->getData();
 
        // go foreach
        foreach($airports->result() as $airport)
        {
            $items[$airport->callname] = $airport->country;
        }
 
        echo "[";
        foreach ($items as $key=>$value) {
            if (strpos(strtolower($key), $q) !== false) {
                echo "{ name: \"$key\", to: \"$value\" }, ";
            }
        }
        echo "]"; 
    }
}  
?>