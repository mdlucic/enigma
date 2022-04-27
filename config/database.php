<?php
// database class 
use Dotenv\Dotenv;

require __DIR__ . '/../vendor/autoload.php';
$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();
class DBConn
{

	//This still needs some working on
	/**
	 *
	 *@user = mysql user
	 *@password = mysql password
	 *@dbc = mysql:host=<your hostname>;dbname=<your database>;charset=UTF8;
	 *
	 */

	public function connect()
	{
		$conn = new PDO($_ENV['DBC'], $_ENV['DB_USER'], $_ENV['DB_PASS']);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		return $conn;
	}
}
