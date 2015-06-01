<?php
/**
 * @todo three cache for php
 * APC, redis, static page
 */

class Three_Cache
{
    function __construct(){}
    
    public $cache_adater = array(); //array(1,2,3)
    
    /**
     * @todo set first cache APC env
     */
    function set_first_adater()
    {
        /**
         * some APC setting here
         */
        $this->cache_adater[] = 1;
    }
    
    /**
     * @todo set second cache redis env
     */
    function set_second_adater($host, $port)
    {
        $r = new Redis();
        $r->connect($host, $port);
        $this->cache_adater[] = 2;
        return $r;
    }
    
    /**
     * @todo set third cache static pages env
     */
    function set_third_adater($cache_dir)
    {
        if(is_writable($cache_dir)) {
            $this->cache_adater[] = 3;
        }
        else {
            echo "third cache_dir cannot write";
        }
    }
    
    /**
     * @todo get adater env 
     * @param $adater_number
     * @return str
     */
    function get_adater_env($adater_number)
    {
         
    }
    
    
    /**
     * @todo store key-value, set keys
     * @param $k, $v
     * @return bool
     */
    function set($key, $value)
    {
        
    }
    
    /**
     * @todo get value for key
     * @param $key
     * @return $value
     */
    function get($key)
    {
        
    }
}

?>


































