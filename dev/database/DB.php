<?php
//⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜\\
//⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜   DB   ⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜\\
//⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜\\

/**
*@method query
*/
class DB {
    private static $servername;
    private static $username;
    private static $password;
    private static $dbname;
    
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
        
        try
        {        
            //return an error if something is wrong or return the result.
            if(!$result->execute($data)){
                header('HTTP/1.1 500 Server error');
                echo json_encode(["status_code"=>500, "message"=>"Server side error!"]);
            }
            else{
                return $result->fetchAll(PDO::FETCH_ASSOC);
            }
        }
        catch (Throwable $t)
        { 
            return $t->errorInfo;
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