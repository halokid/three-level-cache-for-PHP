<?php
/**
 * @JJyy
 * @todo three cache for php
 * APC, redis, static page
 */

class Three_Cache
{
    private $_adater = array();
    private $_redis = '';
    private $_cache_dir = '';
    
    function __construct()
    {
        // $this->_adater = $arr;
    }
    
    
    /**
     * @todo set first cache APC env
     */
    function set_first_adater()
    {
        /**
         * some APC setting here
         */
        $this->_adater[] = 1;
    }
    
    /**
     * @todo set second cache redis env
     */
    function set_second_adater($host, $port)
    {
        $r = new Redis();
        $r->connect($host, $port);
        $this->_adater[] = 2;
        // return $r;
        $this->_redis = $r;
    }
    
    /**
     * @todo set third cache static pages env
     */
    function set_third_adater($cache_dir)
    {
        if(is_writable($cache_dir)) { //$cache_dir end with the "/"
            $this->_adater[] = 3;
            $this->_cache_dir = $cache_dir;
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
     * @param $k, $v, if time==null , it means the cache forever
     * @return bool
     */
    function set($key, $value, $time==null)
    {
        foreach( $this->_adater as $i) {
            if( $i == 1) //APC set
            {
                apc_store($key, $value, $time);
            }
            else if($i==2)  //redis set
            {
                if( $time == null )
                {
                    $this->_redis->set($key, $value);
                }
                else
                {
                    $this->_redis->setex($key, $time, $value);
                }
            }
            else if( $i== 3) //basic page set
            {
                //the key is the static page filename
                //will store in _cache_dir
                $f = fopen( $this->_cache_dir.$key, 'a' );
                fwrite($f, $value);
                fclose($f);
            }
        }
    }
    
    /**
     * @todo get value for key
     * @param $key
     * @return $value
     */
    function get($key)
    {
        $v='';
        foreach( $this->_adater as $i ) {
            if( $i==1) //APC
            {
                if( $v=apc_fetch($key) )
                    break;
            }
            else if ( $i==2) //redis
            {
                if( $v=$this->_redis->get($key) )
                    break;
            }
            else if($i==3) //static page
            {
                $f = fopen($this->_cache_dir.$key, 'r');
                $v = fread($f, filesize($f));
                fclose($f);
            }
        }
        return $v;
    }
}

?>


































