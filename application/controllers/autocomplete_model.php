<?php
class Autocomplete_model extends Model 
{
    function Autocomplete_model()
    {
        parent::Model();
    }
    function getData()
    {
        $this->db->select('*')->from('airports');
        $query = $this->db->get();
        return $query;
    }
}  

?>