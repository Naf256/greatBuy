<?php
require_once('../model/User.php');

class AuthenticationController {
    private $userModel;

    public function __construct() {
        $this->userModel = new UserModel();
    }

	public function getAllUsers() {
		return  $this->userModel->getAllUsers();
	}

    public function login($username, $password) {
        $user = $this->userModel->getUserByUsername($username);
        if ($user && $password == $user['password']) {
            session_start();
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];
            // Redirect to dashboard or homepage
            header('Location: index.php');
            exit();
        } else {
            // Handle invalid credentials
			$_SESSION['error_login'] = "invalid username or password";
        }
    }

	public function register($name, $username, $password, $role, $email, $phone_number, $address) {
		$userRegistered = $this->userModel->addUser($name, $username, $password, $role, $email, $phone_number, $address);

		if ($userRegistered) {
			session_start();
			$user = $this->userModel->getUserByUsername($username);
			$_SESSION['user_id'] = $user['user_id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];
			header('Location: index.php');
			exit();
		} else {
			$_SESSION['error_register'] = "invalid credentials or username not unique";
		}
	}
	
	public function emailExists($email) {
		$user = $this->userModel->getUserByEmail($email);
		if ($user) {
			session_start();
			$_SESSION['user_id'] = $user['user_id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];
			header('Location: reset_password.php');
			exit();
		} else {

			$_SESSION['error_email'] = "Email Not Found";
		}
	}

	public function changePassword($username, $newPassword) {
		$updated = $this->userModel->updateUserPassword($username, $newPassword);
	
		if ($updated) {
			session_start();
			$user = $this->userModel->getUserByUsername($username);
			$_SESSION['user_id'] = $user['user_id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];
			header('Location: index.php');
			exit();
		} else {
			$_SESSION['error'] = "Error Changing Password";
		}
	}

	public function fetchUserInfo($username) {
		$user = $this->userModel->getUserByUsername($username);
		return $user;
	}

    public function logout() {
        session_start();
        session_unset();
        session_destroy();
        // Redirect to login page
        header('Location: login.php');
        exit();
    }
}
?>
