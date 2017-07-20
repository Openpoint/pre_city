<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/php/settings.php');
try {
	$dbh = new PDO('pgsql:dbname='.$settings->dbase['db_name'].';host='.$settings->dbase['host'].';port='.$settings->dbase['port'].'',$settings->dbase['username'],$settings->dbase['password'],
	array(PDO::ATTR_PERSISTENT => true));
} catch (PDOException $e) {
	//header('Location:'.$settings->installfile);
	print_r($e);
}

class dbase {
    function dbase($dbh) {
        $this->dbh=$dbh;
    }
    public $success;	
	public function query($sql,$strings){
		try {  
			$this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);			
			$this->dbh->beginTransaction();			
			$stmt = $this->dbh->prepare($sql);
			if(isset($strings)){
				foreach($strings as $string){
					$stmt->bindParam($string['token'], $string['value']);
				}				
			}
			$stmt->execute();
			$this->dbh->commit();
			$this->success=true;
					  
		} catch (Exception $e) {
			$this->dbh->rollBack();
			$stmt->fail=true;
			$stmt->message="Failed: " . $e->getMessage();
		}
		return $stmt;
				
	}
}

?>
