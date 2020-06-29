<?php
class Connector {
	private static $instance = NULL;
	public static function getConnexion() {
	       	if (!isset(self::$instance)) {
		self::$instance = new PDO('mysql:host=localhost;dbname=uno_online', 'root', '');
		}
	return self::$instance;
	}
}
?>