<?php

class Connection {
	private static $host = "localhost";
	private static $username = "root";
	private static $password = "";
	private static $db = "sw-db";
	private static $connection = null;

	public static function connect() {
		if (self::$connection === null) {
			self::$connection = mysqli_connect(self::$host, self::$username, self::$password, self::$db);
		}
		return self::$connection;
	}
}