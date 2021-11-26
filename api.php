<?php

class Api extends Rest
{

	public function __construct()
	{
		parent::__construct();
	}

	public function generateToken()
	{
		$email = $this->validateParameter('email', $this->param['email'], STRING);
		$password = $this->validateParameter('password', $this->param['password'], STRING);
		try {
			$stmt = $this->dbConn->prepare("SELECT * FROM users WHERE email = :email AND password = :password");
			$stmt->bindParam(":email", $email);
			$stmt->bindParam(":password", $password);
			$stmt->execute();
			$user = $stmt->fetch(PDO::FETCH_ASSOC);
			if (!is_array($user)) {
				$this->returnResponse(INVALID_USER_PASSWORD, "Email or Password is incorrect.");
			}

			if ($user['is_active'] == 0) {
				$this->returnResponse(USER_NOT_ACTIVE, "User is not activated. Please contact to admin.");
			}

			$paylod = [
				'iat' => time(),
				'iss' => 'localhost',
				'exp' => time() + (60 * 60),
				'userId' => $user['id']
			];

			$token = JWT::encode($paylod, SECRETE_KEY);

			$data = ['token' => $token];
			$this->returnResponse(SUCCESS_RESPONSE, $data);
		} catch (Exception $e) {
			$this->throwError(JWT_PROCESSING_ERROR, $e->getMessage());
		}
	}

	public function addUser()
	{

		$name = $this->validateParameter('name', $this->param['name'], STRING);
		$email = $this->validateParameter('email', $this->param['email'], STRING);
		$password = $this->validateParameter('password', $this->param['password'], STRING);
		$cellphone = $this->validateParameter('cellphone', $this->param['cellphone'], STRING);
		if (array_key_exists('role', $this->param)) {
			$role = $this->validateParameter('role', $this->param['role'], STRING);
		} else {
			$role = 'creator';
		}

		$user = new User;

		$user->setName($name);
		$user->setEmail($email);
		$user->setPassword($password);
		$user->setCellphone($cellphone);
		$user->setRole($role);

		if (!$user->insertUser()) {
			$message = 'Failed to insert.';
		} else {
			$message = "Inserted successfully.";
		}

		$this->returnResponse(SUCCESS_RESPONSE, $message);
	}

	public function getUserDetails()
	{
		$userId = $this->validateParameter('userId', $this->param['id'], INTEGER);

		$user = new User;
		$user->setId($userId);
		$userResponse = $user->getUserDetailsById();
		if (!is_array($userResponse)) {
			$this->returnResponse(SUCCESS_RESPONSE, ['message' => 'Customer details not found.']);
		}

		$response['name'] 	= $userResponse['name'];
		$response['email'] 			= $userResponse['email'];
		$response['cellphone'] 		= $userResponse['cellphone'];
		$response['role'] 		= $userResponse['role'];
		$response['is_active'] 		= $userResponse['is_active'];

		$this->returnResponse(SUCCESS_RESPONSE, $response);
	}

	public function updateUser()
	{

		$user = new User;

		$userId = $this->validateParameter('id', $this->param['id'], INTEGER);
		$user->setId($userId);

		if (array_key_exists('name', $this->param)) {
			$name = $this->validateParameter('name', $this->param['name'], STRING, false);
			$user->setName($name);
		}

		if (array_key_exists('password', $this->param)) {
			$password = $this->validateParameter('password', $this->param['password'], STRING, false);
			$user->setPassword($password);
		}

		if (array_key_exists('cellphone', $this->param)) {
			$cellphone = $this->validateParameter('cellphone', $this->param['cellphone'], STRING, false);
			$user->setCellphone($cellphone);
		}

		if (array_key_exists('role', $this->param)) {
			$role = $this->validateParameter('role', $this->param['role'], STRING);
			$user->setRole($role);
		}

		if (!$user->updateUser()) {
			$message = 'Failed to update.';
		} else {
			$message = "Updated successfully.";
		}

		$this->returnResponse(SUCCESS_RESPONSE, $message);
	}

	public function deleteCustomer()
	{
		$customerId = $this->validateParameter('customerId', $this->param['customerId'], INTEGER);

		$cust = new Customer;
		$cust->setId($customerId);

		if (!$cust->delete()) {
			$message = 'Failed to delete.';
		} else {
			$message = "deleted successfully.";
		}

		$this->returnResponse(SUCCESS_RESPONSE, $message);
	}
}
