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
		$create = "create table if not exists users ( userId int primary key auto_increment, username varchar(50),password varchar(50) NOT NULL, createDate date,email varchar(100) NOT NULL UNIQUE,isActive char(1) default 'N' ,fullname varchar(200),mobile varchar(10) )" ;
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

	$key_size =  strlen($this->key);
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



?>
