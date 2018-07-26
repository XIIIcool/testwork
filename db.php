<?php

define('DB_HOST', 'localhost');
define('DB_NAME', '');
define('DB_USER', '');
define('DB_PASS', '');
define('DB_CHAR', 'utf8');

class DB
{
    protected static $instance = null;
    final private function __construct() {}
    final private function __clone() {}
    public static function instance()
    {
        if (self::$instance === null)
        {
			$opt  = array(
				PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
				PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
				PDO::ATTR_EMULATE_PREPARES   => TRUE,
				PDO::ATTR_STATEMENT_CLASS    => array('myPDOStatement'),
			);
            $dsn = 'mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset='.DB_CHAR;
            self::$instance = new PDO($dsn, DB_USER, DB_PASS, $opt);
        }
        return self::$instance;
    }
    public static function __callStatic($method, $args) {
        return call_user_func_array(array(self::instance(), $method), $args);
    }
}
class myPDOStatement extends PDOStatement
{
	function execute($data = array())
	{
		parent::execute($data);
		return $this;
	}
}

class Users {
	
	public function countCityUsers($groupuser = 1){
		$sql = "SELECT COUNT(`country`.`id`) as countrysum, `country`.`id`, `country`.`name`FROM `users`,`region` LEFT JOIN `city` ON `city`.`region_id` = `region`.`id` LEFT JOIN `country` ON `country`.`id` = `region`.`country_id` WHERE `users`.`city` = `city`.`id` AND `users`.`groupuser` = '".$groupuser."'  AND `country`.`id` IN (21,0,1,81) GROUP BY `country`.`id`";
		$query = DB::prepare($sql)->execute();
                $query = $query->fetchAll(PDO::FETCH_OBJ);
                $city = [];
                foreach($query as $item){
                    $city[$item->id] = $item->countrysum;
                }
                return $city;
	}
        
        public function checkUser($email){
            $sql = "SELECT * FROM `users` WHERE `users`.`email` = ?";
            $query = DB::prepare($sql)->execute([$email]);
            if($query->rowCount()>0){
                return false;
            } else {
                return true;
            }
        }
        
        public function createUser($email,$phone,$city,$groupuser,$status = 1){
            
            if($this->checkUser($email)){
                $sql = "INSERT INTO `users` (`email`, `phone`, `city`, `groupuser`,`status`) VALUES (?, ?, ?, ?,?)";
           
                $query = DB::prepare($sql)->execute([$email,$phone,$city,$groupuser,$status]);
              
                return DB::lastInsertId();
            } else {
                return false;
            }    
        }
        
        public function insertUserCategories($data = []){
            if(!empty($data)){
               
                $error = 0;
                $args = array_fill(0, count($data), '?');

                $query = "INSERT INTO `catuser` (`usersid`,`catid`) VALUES (?,?)";
                 
                $stmt = DB::prepare($query);

                foreach ($data as $row) 
                {
                   if(!$stmt->execute($row)){
                       $error++;
                   }
                }
                if($error == 0){
                    return true;
                }
            }
        }
	
}

class Ajax {
    public function getListCity($text){
        $sql = "SELECT `city`.`id` as id,`city`.`name` as text, `country`.`name` FROM `city`,`region`LEFT JOIN `country` ON `country`.`id` = `region`.`country_id` WHERE `city`.`region_id` = `region`.`id` AND `city`.`name` LIKE ?";
        
        $query = DB::prepare($sql)->execute(['%'.$text.'%']);
    //    print_r($query->errorInfo());    
        return $query->fetchAll(PDO::FETCH_OBJ);
    }
    public function getListCategories($name){
        //$sql = "SELECT * FROM `categories` ORDER BY `categories`.`name` ASC LIMIT 50";
        $sql = "SELECT `c`.`id` as idpar1,`c`.`name` as parent1name,`c`.`parent` as parent1,`c2`.`id` as idpar2,`c2`.`name` as parent2name,`c2`.`parent` as parent2, `c3`.`id`,`c3`.`name` as name,`c3`.`parent`
FROM `categories` `c` JOIN `categories` `c2` ON `c2`.`parent`=`c`.`id` JOIN `categories` `c3` ON `c3`.`parent`=`c2`.`id`
WHERE `c3`.`name` LIKE ? LIMIT 50";
        $query = DB::prepare($sql)->execute(['%'.$name.'%']);

        return $query->fetchAll(PDO::FETCH_OBJ);
    }
}

?>