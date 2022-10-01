<?php
/**
*@method query
*/
class DB {
    private static $servername = "91.206.207.211";
    private static $username = "scoala19_web";
    private static $password = "a3b830eda3b830ed";
    private static $dbname = "scoala19_platform";
    
    /**
    *@param $sql:string
    *@param $data:array
    *@return array|dictionary
    */
    public static function query($sql, $data=[]){
        
        //create a connection\\
        $conn = new PDO('mysql:host='.self::$servername.';dbname='.self::$dbname, self::$username, self::$password);
        
        //prepare a query\\
        $result = $conn->prepare($sql);
        
        //return an error if something is wrong or return the result.
        if(!$result->execute($data)){
            header('HTTP/1.1 500 Server error');
            return ["status_code"=>500, "message"=>"Server side error!", $result->errorInfo()];

        }
        else{
            return $result->fetchAll(PDO::FETCH_ASSOC);
        }
    }

    /**
     * Sets database connection parameters
     * @param string
     * @param string
     * @param string
     * @param string
     * @return null
     */
    public static function setDB($servername, $username, $password, $dbname){
        self::$servername = $servername; 
        self::$username = $username;
        self::$password = $password;
        self::$dbname = $dbname;
    }

    /**
     * Sets DB database name
     * @param string
     * @return null
     */
    public static function setDBname($dbname){
        self::$dbname = $dbname;
    }
}
