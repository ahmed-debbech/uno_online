<?php
class Connector {
	private static $instance = NULL;
	public static function getConnexion() {
	       	if (!isset(self::$instance)) {
				include("keys.php");
		self::$instance = new PDO('mysql:host=localhost;dbname='.$dbName, $username, $pass);
		}
	return self::$instance;
	}
}
?>