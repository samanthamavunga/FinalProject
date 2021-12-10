<!--this will contain my database connection

//create connection with database
//
//$conn = new mysqli(servername,username,password,dbname);

//test connection
//if ($conn->connect_error) 
//{
   // die("Connection failed: " . $conn->connect_error);
//}


<?php
//database

//database credentials
require('db_cred.php');

/**
 *@author Samantha Mavunga
 */
class db_connection
{
	//properties
	public $db = null;
	public $results = null;

	//connect
	/**
	*Database connection
	*@return bolean
	**/
	function db_connect(){
		//connection
		$this->db = mysqli_connect(servername,username,password,dbname);
		//test the connection
		if (mysqli_connect_errno()) {
			return false;
		}else{
			return true;
		}
	}

	//execute a query
	/**
	*Query the Database
	*@param takes a connection and sql query
	*@return bolean
	**/
	function db_query($sqlQuery){
		if (!$this->db_connect()) {
			return false;
		}
		elseif ($this->db==null) {
			return false;
		}

		//run query
		$this->results = mysqli_query($this->db,$sqlQuery);
		if ($this->results == false) {
			return false;
		}else{
			return true;
		}

	}

	//fetch data
	/**
	*get select data
	*@return a record
	**/
	function db_fetch(){
		//check if result was set
		if ($this->results == null) {
			return false;
		}
		elseif ($this->results == false) {
			return false;
		}
		//return a record
		return mysqli_fetch_assoc($this->results);

	}
}
?>

