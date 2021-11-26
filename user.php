<?php
class User
{
	private $id;
	private $name;
	private $email;
	private $password;
	private $cellphone;
	private $role;
	private $is_active;
	private $created_date;
	private $updated_date;
	private $tableName = 'users';
	private $dbConn;

	function setId($id)
	{
		$this->id = $id;
	}
	function getId()
	{
		return $this->id;
	}
	function setName($name)
	{
		$this->name = $name;
	}
	function getName()
	{
		return $this->name;
	}
	function setEmail($email)
	{
		$this->email = $email;
	}
	function getEmail()
	{
		return $this->email;
	}
	function setPassword($password)
	{
		$this->password = $password;
	}
	function getPassword()
	{
		return $this->password;
	}
	function setCellphone($cellphone)
	{
		$this->cellphone = $cellphone;
	}
	function getCellphone()
	{
		return $this->cellphone;
	}
	function setRole($role)
	{
		$this->role = $role;
	}
	function getRole()
	{
		return $this->role;
	}
	function setIsActive($is_active)
	{
		$this->is_active = $is_active;
	}
	function getIsActive()
	{
		return $this->is_active;
	}
	function setCreated_date($created_date)
	{
		$this->created_date = $created_date;
	}
	function getCreated_date()
	{
		return $this->created_date;
	}
	function setUpdated_date($updated_date)
	{
		$this->updated_date = $updated_date;
	}
	function getUpdated_date()
	{
		return $this->updated_date;
	}

	public function __construct()
	{
		$db = new DbConnect();
		$this->dbConn = $db->connect();
	}

	public function getAllUsers()
	{
		$stmt = $this->dbConn->prepare("SELECT * FROM " . $this->tableName);
		$stmt->execute();
		$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $users;
	}

	public function getAllActiveUsers()
	{
		$stmt = $this->dbConn->prepare("SELECT * FROM " . $this->tableName . " WHERE is_active = 1");
		$stmt->execute();
		$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $users;
	}

	public function getUserDetailsById()
	{

		$sql = 'SELECT * FROM ' . $this->tableName . ' WHERE id = :userId';

		$stmt = $this->dbConn->prepare($sql);
		$stmt->bindParam(':userId', $this->id);
		$stmt->execute();
		$user = $stmt->fetch(PDO::FETCH_ASSOC);
		return $user;
	}

	public function getUserDetailsByEmail()
	{

		$sql = 'SELECT * FROM ' . $this->tableName . ' WHERE email = :email';

		$stmt = $this->dbConn->prepare($sql);
		$stmt->bindParam(':email', $this->email);
		$stmt->execute();
		$user = $stmt->fetch(PDO::FETCH_ASSOC);
		return $user;
	}

	public function insertUser()
	{
		$sql = 'INSERT INTO ';

		if (null != $this->getRole()) {
			$sql .=	$this->tableName . ' (name, email, password, cellphone, role) VALUES(:name, :email, :password, :cellphone, :role)';
		} else {
			$sql .=	$this->tableName . ' (name, email, password, cellphone, role) VALUES(:name, :email, :password, :cellphone, :role)';
		}


		$stmt = $this->dbConn->prepare($sql);
		$stmt->bindParam(':name', $this->name);
		$stmt->bindParam(':email', $this->email);
		$stmt->bindParam(':password', $this->password);
		$stmt->bindParam(':cellphone', $this->cellphone);
		$stmt->bindParam(':role', $this->role);
		echo ($this->role);
		echo ($this->password);
		// print_r($stmt);

		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}

	public function updateUser()
	{

		$sql = "UPDATE $this->tableName SET";
		if (null != $this->getName()) {
			$sql .=	" name = '" . $this->getName() . "'";
		}

		if (null != $this->getPassword()) {
			if (null != $this->getName()) {
				$sql .= ', ';
			}
			$sql .=	" password = '" . $this->getPassword() . "'";
		}

		if (null != $this->getCellphone()) {
			if (null != $this->getPassword()) {
				$sql .= ', ';
			} elseif (null != $this->getName()) {
				$sql .= ', ';
			};
			$sql .=	" cellphone = '" . $this->getCellphone() . "'";
		}

		if (null != $this->getRole()) {
			if (null != $this->getCellphone()) {
				$sql .= ', ';
			} elseif (null != $this->getPassword()) {
				$sql .= ', ';
			} elseif (null != $this->getName()) {
				$sql .= ', ';
			};
			$sql .=	" role = '" . $this->getRole() . "'";
		}

		$sql .=	" WHERE id = :userId";

		$stmt = $this->dbConn->prepare($sql);
		$stmt->bindParam(':userId', $this->id);
		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}

	public function deactiveUser()
	{
		$sql = "UPDATE $this->tableName SET is_active = 0 WHERE id = :userId";
		$stmt = $this->dbConn->prepare($sql);
		$stmt->bindParam(':userId', $this->id);

		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}

	public function activeUser()
	{
		$sql = "UPDATE $this->tableName SET is_active = 1 WHERE id = :userId";
		$stmt = $this->dbConn->prepare($sql);
		$stmt->bindParam(':userId', $this->id);

		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}
}
