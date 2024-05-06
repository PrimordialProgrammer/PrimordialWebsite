<?php
class User{
	private $DB_SERVER='172.16.0.214';
	private $DB_USERNAME='group2';
	private $DB_PASSWORD='123456';
	private $DB_DATABASE='group2';
	private $conn;
	public function __construct(){
		$this->conn = new PDO("mysql:host=".$this->DB_SERVER.";dbname=".$this->DB_DATABASE,$this->DB_USERNAME,$this->DB_PASSWORD);
		
	}
	
	public function new_user($email,$password,$lastname,$firstname, $access){
		

		$NOW = new DateTime('now', new DateTimeZone('Asia/Manila'));
		$NOW = $NOW->format('Y-m-d H:i:s');

		$data = [
			[$lastname,$firstname,$email,$password,$NOW,$NOW,'1', $access],
		];
		$stmt = $this->conn->prepare("INSERT INTO tbl_users (user_lastname, user_firstname, user_email, user_password, user_date_added, user_time_added, user_status, user_access) VALUES (?,?,?,?,?,?,?,?)");
		try {
			$this->conn->beginTransaction();
			foreach ($data as $row)
			{
				$stmt->execute($row);
			}
			$this->conn->commit();
		}catch (Exception $e){
			$this->conn->rollback();
			throw $e;
		}

		return true;

	}

	public function update_user($lastname, $firstname, $access, $id)
{
    $sql = "UPDATE tbl_users SET user_firstname=:user_firstname, user_lastname=:user_lastname, user_access=:user_access WHERE user_id=:user_id";
    $q = $this->conn->prepare($sql);
    $q->execute(array(':user_firstname' => $firstname, ':user_lastname' => $lastname, ':user_access' => $access, ':user_id' => $id));
    return true;
}


	public function list_users(){
		$sql="SELECT * FROM tbl_users";
		$q = $this->conn->query($sql) or die("failed!");
		while($r = $q->fetch(PDO::FETCH_ASSOC)){
		$data[]=$r;
		}
		if(empty($data)){
		   return false;
		}else{
			return $data;	
		}
}

	function get_user_id($email){
		$sql="SELECT user_id FROM tbl_users WHERE user_email = :email";	
		$q = $this->conn->prepare($sql);
		$q->execute(['email' => $email]);
		$user_id = $q->fetchColumn();
		return $user_id;
	}
	function get_user_email($id){
		$sql="SELECT user_email FROM tbl_users WHERE user_id = :id";	
		$q = $this->conn->prepare($sql);
		$q->execute(['id' => $id]);
		$user_email = $q->fetchColumn();
		return $user_email;
	}
	function get_user_firstname($id){
		$sql="SELECT user_firstname FROM tbl_users WHERE user_id = :id";	
		$q = $this->conn->prepare($sql);
		$q->execute(['id' => $id]);
		$user_firstname = $q->fetchColumn();
		return $user_firstname;
	}
	function fetch_user_access($id){
        $sql="SELECT user_access FROM tbl_users WHERE user_id = :id";    
        $q = $this->conn->prepare($sql);
        $q->execute(['id' => $id]);
        $this->user_access = $q->fetchColumn();
        return $this->user_access;
    }
	function get_user_lastname($id){
		$sql="SELECT user_lastname FROM tbl_users WHERE user_id = :id";	
		$q = $this->conn->prepare($sql);
		$q->execute(['id' => $id]);
		$user_lastname = $q->fetchColumn();
		return $user_lastname;
	}
	function get_user_access($id){
		$sql="SELECT user_access FROM tbl_users WHERE user_id = :id";	
		$q = $this->conn->prepare($sql);
		$q->execute(['id' => $id]);
		$user_access = $q->fetchColumn();
		return $user_access;
	}
	function get_user_status($id){
		$sql="SELECT user_status FROM tbl_users WHERE user_id = :id";	
		$q = $this->conn->prepare($sql);
		$q->execute(['id' => $id]);
		$user_status = $q->fetchColumn();
		return $user_status;
	}
	function get_session(){
		if(isset($_SESSION['login']) && $_SESSION['login'] == true){
			return true;
		}else{
			return false;
		}
	}
	public function check_login($email,$password){
		
		$sql = "SELECT count(*) FROM tbl_users WHERE user_email = :email AND user_password = :password"; 
		$q = $this->conn->prepare($sql);
		$q->execute(['email' => $email,'password' => $password ]);
		$number_of_rows = $q->fetchColumn();
		

	
		if($number_of_rows == 1){
			
			$_SESSION['login']=true;
			$_SESSION['user_email']=$email;
			return true;
		}else{
			return false;
		}
	}
	public function delete_user($user_id) {
        $sql = "DELETE FROM tbl_users WHERE user_id = :user_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);

        try {
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
	public function getUserData($email) {
        $sql = "SELECT * FROM tbl_users WHERE user_email = :email";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['email' => $email]);
        $user_data = $stmt->fetch(PDO::FETCH_ASSOC);

        // Set the user_access property
        $this->user_access = $user_data['user_access'];

        return $user_data;
    }
	public function set_session() {
        $_SESSION['login'] = true;
        $_SESSION['user_email'] = $this->user_email;  // Assuming you have a property for user_email

        // You can set other session variables if needed

        return true;
    }
	public function list_class_members() {
		$sql = "SELECT ID, firstname, lastname, grade FROM tbl_class";
		$q = $this->conn->query($sql) or die("failed!");
	
		while ($r = $q->fetch(PDO::FETCH_ASSOC)) {
			$data[] = $r;
		}
	
		if (empty($data)) {
			return false;
		} else {
			return $data;
		}
	}

public function add_class_member($firstname, $lastname, $grade) {
	$sql = "INSERT INTO tbl_class (firstname, lastname, grade) VALUES (:firstname, :lastname, :grade)";
	$stmt = $this->conn->prepare($sql);
	$stmt->bindParam(':firstname', $firstname, PDO::PARAM_STR);
	$stmt->bindParam(':lastname', $lastname, PDO::PARAM_STR);
	$stmt->bindParam(':grade', $grade, PDO::PARAM_STR);

	try {
		$stmt->execute();
		return true;
	} catch (PDOException $e) {
		return false;
	}
}
public function edit_class_member($id, $firstname, $lastname, $grade) {
	$sql = "UPDATE tbl_class SET firstname = :firstname, lastname = :lastname, grade = :grade WHERE ID = :id";
	$stmt = $this->conn->prepare($sql);
	$stmt->bindParam(':id', $id, PDO::PARAM_INT);
	$stmt->bindParam(':firstname', $firstname, PDO::PARAM_STR);
	$stmt->bindParam(':lastname', $lastname, PDO::PARAM_STR);
	$stmt->bindParam(':grade', $grade, PDO::PARAM_STR);

	try {
		$stmt->execute();
		return true;
	} catch (PDOException $e) {
		return false;
	}
}
public function delete_class_member($id) {
    $sql = "DELETE FROM tbl_class WHERE ID = :id";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}
public function get_total_donated_amount() {
	$sql = "SELECT SUM(amount) AS total_amount FROM donations";
	$result = $this->conn->query($sql);
	$row = $result->fetch(PDO::FETCH_ASSOC);

	if ($row && isset($row['total_amount'])) {
		return $row['total_amount'];
	}

	return false;
}
public function get_donation_history() {
	$sql = "SELECT donation_date, status, message FROM donation_history ORDER BY donation_date DESC";
	$stmt = $this->conn->prepare($sql);
	$stmt->execute();

	$history = [];
	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		$history[] = $row;
	}

	return $history;
}
public function make_donation($amount) {
	$sql = "INSERT INTO donations (amount) VALUES (:amount)";
	$stmt = $this->conn->prepare($sql);
	$stmt->bindParam(':amount', $amount, PDO::PARAM_STR);

	try {
		$this->conn->beginTransaction();
		$stmt->execute();
		$donationId = $this->conn->lastInsertId();
		$this->conn->commit();
		return $donationId;
	} catch (Exception $e) {
		$this->conn->rollback();
		throw $e;
	}
}

public function insert_donation_history($donationId, $status, $message) {
	$sql = "INSERT INTO donation_history (donation_id, status, message, donation_date) 
			VALUES (:donation_id, :status, :message, NOW())";
	$stmt = $this->conn->prepare($sql);
	$stmt->bindParam(':donation_id', $donationId, PDO::PARAM_INT);
	$stmt->bindParam(':status', $status, PDO::PARAM_STR);
	$stmt->bindParam(':message', $message, PDO::PARAM_STR);

	try {
		$stmt->execute();
		return true;
	} catch (Exception $e) {
		return false;
	}
}
}