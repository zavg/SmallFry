<?php

/**
 * Description of mySQL
 *
 * @author nlubin
 */
class mySQL extends mysqli  {
    
    private $_result;    
    
    /**
     * Start a mysqli connection
     * @param string $server
     * @param string $username
     * @param string $password
     * @param string $dbname 
     */
    function __construct($server, $username, $password, $dbname)    {
        parent::__construct($server, $username, $password);
        $this->select_db($dbname);
        if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_error());
            exit();
        }
    }
    
    /**
     * Run a mysql query
     * @param string $query
     * @return mysqli_result 
     */
    function run_query($query)  {
        $this->_last_query = $query;
        $this->_result = $this->query($query);
        if($this->_result)  {
            return $this->_result;
        }
        else    {
            return false;
        }
    }
    
    /**
     *
     * @param mysqli_result $result
     * @return mixed 
     */
    function get_row($result = null)   {
        
        if($result == null){
            $result = $this->_result;
        }
        
        if($result instanceof mysqli_stmt){
            return $this->get_bound_row($result);
        }
        else {
//            var_dump($result);
            if($result && $row = $result->fetch_array())  {
                return $row;
            }
            elseif($result != null)  {
                $result->free();
            }

            return false;
        }
    }
    
    /**
     *
     * @param mysqli_result $result
     * @return mixed 
     */
    function get_num_rows($result = null)   {
        if($result == null){
            $result = $this->_result;
        }
        if(!$result) return false;
        return $result->num_rows;
    }
    
    /**
     *
     * @return int 
     */
    function get_last_insert_id(){
        return $this->insert_id;
    }
    
    /**
     *
     * @param mysqli_result $result
     * @return bool
     */
    function close_result($result = null)   {
        if($result == null){
            $result = $this->_result;
        }
        if(!$result) return false;
        return $result->close();
    }
    
    /**
     *
     * @return string
     */
    function get_last_error()   {
        return $this->error . "<pre>\nQuery:\n" . $this->_last_query . "</pre>";
    }
    
    function start_transaction(){
        $this->autocommit(FALSE);
        /* @var $query mysqli_result */
        $query = $this->query("START TRANSACTION");
    }
    
    /**
     *
     * @return bool
     */
    function rollback(){
        $rb = parent::rollback();
        return $rb;
    }
    
    /**
     *
     * @return bool
     */
    function commit(){
        $cm = parent::commit();
        return $cm;
    }
        
}

?>