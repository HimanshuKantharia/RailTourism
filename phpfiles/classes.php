<?php
	require 'connectdb.php';

/**
* 
*/
class users
{	
	private $userId;
	private $username;
	private $password;
	private $email;
	private $isActive;
	private $mobile;
	private $fullname;
	public  $iv_size;
//	$this->key=pack('H*', "piy04b7e103a0cd8b54763051cef08bc55ush029fdebae5e1d417e2goh2i00l3");

	public function __construct()
	{
		$create = "create table if not exists users ( userId int primary key auto_increment, username varchar(50),password varchar(500) NOT NULL, createDate date,email varchar(100) NOT NULL UNIQUE,isActive char(1) default 'N' ,fullname varchar(200),mobile varchar(10) )" ;
		$conn = new connect();
		$conn->exeQuery($create);

		$this->iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC);
		
	}
	public function getDetails($email)
	{
		$conn = new connect();
		$que = 'SELECT * from users where email = "'.$email. '"';
		$result = $conn->exeQuery($que);
		$row = $result->fetch_assoc();
		$this->userId = $row['userId'];
		$this->username= $row['username'];
		$this->password = $row['password'];
		$this->email = $row['email'];
		$this->isActive= $row['isActive'];
		$this->mobile = $row['mobile'];
		$this->fullname = $row['fullname'];
	}

	public function createUser($username,$password,$email,$fullname,$mobile)
	{	

		$key=pack('H*', "bcb04b7e103a0cd8b54763051cef08bc55abe029fdebae5e1d417e2ffb2a00a3");

	$key_size =  strlen($key);
    //echo "Key size: " . $key_size . "\n";
    
    //$plaintext = "This string was AES-256 / CBC / ZeroBytePadding encrypted.";

    # create a random IV to use with CBC encoding
    //$this->iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC);
    $iv = mcrypt_create_iv($this->iv_size, MCRYPT_RAND);
    
    # creates a cipher text compatible with AES (Rijndael block size = 128)
    # to keep the text confidential 
    # only suitable for encoded input that never ends with value 00h
    # (because of default zero padding)
    $ciphertext = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $key,
                                 $password, MCRYPT_MODE_CBC, $iv);

    $ciphertext = $iv . $ciphertext;
    
    # encode the resulting cipher text so it can be represented by a string
    $cipherpass = base64_encode($ciphertext);


		$conn = new connect();
		$que = 'INSERT INTO users(username,password,createDate,email,fullname,mobile) VALUES ("'.$username.'","' .$cipherpass. '","' .date("Y-m-d").  '","'  .$email. '","' .$fullname. '","' .$mobile. '")'   ;
		if($conn->exeQuery($que)){
						echo "Account successfully created! verify your email then you can login otherwise not!";
						$this->getDetails($email);
						$uid = $this->userId;
						$umail = $email;
						$uname = $this->fullname;

						$code = rand(1234,9876); // random code for activation.

						$cookie_name = 	$uid;
						$cookie_value = $code;
						setcookie($cookie_name,$cookie_value,time()+86400,"/");

						$msg = 'Confirmation of Account \nDear  '.$uname.'  Click this link to confirm Your registration\n http://www.piyblogger.6te.net/rail/confirm.php?uid='.$uid.'&code='.$code; 

						$this->sendMAIL($umail,"Registration",$msg);

					}
		else
			echo " there is error in query or in any input or pls provide unique email";

	}

	public function sendMAIL($email,$sub,$msg)
	{
		$to = $email;
		$subject = $sub;

		// Always set content-type when sending HTML email
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		$message = $msg;

		//"Dear ".$row['fullname']." please write this one time code ".$code." to site and recover your password";
		// More headers
		$headers .= 'From: <webmaster@railways.com>' . "\r\n";
		$headers .= 'Cc: rs@railways.com' . "\r\n";

		if(mail($to,$subject,$message,$headers))
		{
		echo "<h3>mail has been send to ".$to." check it now.</h3>";
		}
		else
			echo "mail is failed ";



	}

	

	public function login($email,$password)
	{
		$query = 'SELECT * from users where email = "' .$email. '"';
		$conn = new connect();
		$result = $conn->exeQuery($query); 
		$row = $result->fetch_assoc();
		//session_start();
		$_SESSION['noUser'] ='';
		if($row)
		{  	$key=pack('H*', "bcb04b7e103a0cd8b54763051cef08bc55abe029fdebae5e1d417e2ffb2a00a3");
			$ciphertext_dec = base64_decode($row['password']);
		    
		    # retrieves the IV, iv_size should be created using mcrypt_get_iv_size()
		    $iv_dec = substr($ciphertext_dec, 0, $this->iv_size);
		    
		    # retrieves the cipher text (everything except the $iv_size in the front)
		    $ciphertext_dec = substr($ciphertext_dec, $this->iv_size);

		    # may remove 00h valued characters from end of plain text
		    $plainpass = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $key,
		                                    $ciphertext_dec, MCRYPT_MODE_CBC, $iv_dec);
		   

		    	//echo strcmp($plainpass,$password);
		    if(trim($plainpass) == trim($password)){
		    	
			$_SESSION['userId'] = $row['userId'];
			echo "successfully loged IN";
			echo $_SESSION['userId'];
			//header("location:../login.php");
				}
				else{
					
					$_SESSION['noUser'] = "User not exist,check the password";
				}
		}
		else
		{
			
			$_SESSION['noUser'] = "User not exist,check the email";
			//header("location:../login.php");
		}
	}

}




/**
* 
*/
class Book
{	private $bookid;
	public $t_jdate ;
    public  $t_name ;
	public	$t_class;
	public	$t_from ;
	public	$t_to;
	public	$t_deptime;
	public	$t_arrtime;


	public function __construct()
	{	

		$que = "create table if not exists book(bookid int primary key auto_increment,userId int , t_no int,t_name varchar(200),t_class varchar(10),bookDate date, t_jdate date,t_from varchar(100), t_to varchar(100),CONSTRAINT FOREIGN KEY (userId) REFERENCES users(userId) ON DELETE SET NULL ON UPDATE CASCADE )";

		$pro = "create table if not exists bookDetail (detailid int primary key auto_increment,bookid int, p_name varchar(200), p_age varchar(10), p_gender varchar(10), p_idcard varchar (100),p_idno varchar(50),CONSTRAINT FOREIGN KEY (bookid) REFERENCES book(bookid) ON DELETE CASCADE ON UPDATE CASCADE ) ";

		$fare = "create table if not exists fareDetail (fareId int primary key auto_increment , bookid int ,Tkt_fare varchar (50),Cat_charge varchar(50),Ser_charge varchar(10),totalFare varchar(60) ,CONSTRAINT FOREIGN KEY (bookid) REFERENCES book(bookid) ON DELETE CASCADE ON UPDATE CASCADE )";

		$conn = new connect();
		$conn->exeQuery($que);
		$conn->exeQuery($pro);
		$conn->exeQuery($fare);
	}

/*
$book->insertTkt($userId,$t_no,$t_name,$t_class,$t_from,$t_to,$t_jdate);
		$book->insertPdetail($_POST['p_name'],$_POST['p_age'],$_POST['p_idno'],$_POST['p_idcard'],$_POST['p_gender']);

*/

	function insertTkt($userId,$t_no,$t_name,$t_class,$t_from,$t_to,$t_jdate)
	{  	

		//$t_jdate = '2016-'.$t_jdate;
		$que = 'insert into book(userId,t_no,t_name,t_class,bookDate,t_jdate,t_from,t_to) VALUES ("'.$userId.'","'.$t_no.'","'.$t_name.'","'.$t_class.'","'.date("Y-m-d").'","'.$t_jdate.'","'.$t_from.'","'.$t_to.'")';

		$conn = new connect();

		if($conn->exeQuery($que)){
			echo "reord insert successfully";
			$qid = 'select MAX(bookid) as bookid from book';
			$res = $conn->exeQuery($qid);
			$row = $res->fetch_assoc();
			$this->bookid = $row['bookid'];
			return $row['bookid'];
		}
		else{
			echo"error in insert";
			return 0;
		}

	}

	function insertPdetail($p_name,$p_age,$p_idno,$p_idcard,$p_gender)
	{	$conn = new connect();
		$que = 'INSERT into bookDetail(bookid,p_name,p_age,p_gender,p_idcard,p_idno) VALUES ("'.$this->bookid.'","'.$p_name.'","'.$p_age.'","'.$p_gender.'","'.$p_idcard.'","'.$p_idno.'")';
		if($conn->exeQuery($que))
		{
			
		}
		else {
			echo "error in book detail";
			
		}
	}


	function insertFare($tFare ,$catCharge,$servCharge,$totalFare)
	{
		$conn = new  connect();
		$que = 'INSERT into fareDetail(bookid,Tkt_fare ,Cat_charge ,Ser_charge,totalFare) VALUES ("'.$this->bookid.'","'.$tFare.'","'.$catCharge.'","'.$servCharge.'","'.$totalFare.'")';
		if($conn->exeQuery($que))
		{
			echo "record successfully booked";

		}
		else
			echo "error in fare";
	}




}






?>
