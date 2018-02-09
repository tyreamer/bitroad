<?PHP
/*
    Registration/Login script from HTML Form Guide
    V1.0

    This program is free software published under the
    terms of the GNU Lesser General Public License.
    http://www.gnu.org/copyleft/lesser.html
    

This program is distributed in the hope that it will
be useful - WITHOUT ANY WARRANTY; without even the
implied warranty of MERCHANTABILITY or FITNESS FOR A
PARTICULAR PURPOSE.

For updates, please visit:
http://www.html-form-guide.com/php-form/php-registration-form.html
http://www.html-form-guide.com/php-form/php-login-form.html

*/
require_once("class.phpmailer.php");
require_once("formvalidator.php");

class FGMembersite
{
    var $admin_email;
    var $from_address;
    
    var $connectName;
    var $pwd;
    var $database;
    var $tablename;
    var $connection;
    var $rand_key;
    
    var $error_message;
		
    //-----Initialization -------
    function FGMembersite()
    {
        $this->sitename = 'thebitroad.com';
        $this->rand_key = '0iQx5oBk66oVZep';
    }
    
    function InitDB($host,$cname,$pwd,$database,$tablename)
    {
        $this->db_host  = $host;
        $this->connectName = $cname;
        $this->pwd  = $pwd;
        $this->database  = $database;
        $this->tablename = $tablename;
    }
	
    function SetAdminEmail($email)
    {
        $this->admin_email = $email;
    }
    
    function SetWebsiteName($sitename)
    {
        $this->sitename = $sitename;
    }
    
    function SetRandomKey($key)
    {
        $this->rand_key = $key;
    }
    
    //-------Main Operations ----------------------
    
    function CheckLogin()
    {
         if(!isset($_SESSION)){ session_start(); }

         $sessionvar = $this->GetLoginSessionVar();
         
         if(empty($_SESSION[$sessionvar]))
         {
            return false;
         }
         return true;
    }
	
	  
    function UserEmail()
    {
        return isset($_SESSION['email_of_user'])?$_SESSION['email_of_user']:'';
    }
    

function humanTiming ($time){
	
	$time = (time() - 25200) - $time; // to get the time since that moment (adjusted for mysql time)
	$time = ($time<1)? 1 : $time;
	$tokens = array (
		31536000 => 'yr',
		2592000 => 'mo',
		604800 => 'wk',
		86400 => 'd',
		3600 => 'hr',
		60 => 'min',
		1 => 'sec'
	);

	foreach ($tokens as $unit => $text) {
		if ($time < $unit) continue;
		$numberOfUnits = floor($time / $unit);
		return $numberOfUnits.' '.$text.(($numberOfUnits>1)?'':'');
	}
}

function humanNumbers($num) {
  $x = round($num);
  $x_number_format = number_format($x);
  $x_array = explode(',', $x_number_format);
  $x_parts = array('k', 'm', 'b', 't');
  $x_count_parts = count($x_array) - 1;
  $x_display = $x;
  $x_display = $x_array[0] . ((int) $x_array[1][0] !== 0 ? '.' . $x_array[1][0] : '');
  $x_display .= $x_parts[$x_count_parts - 1];
  return $x_display;
}
	
    function LogOut()
    {
        session_start();
        
        $sessionvar = $this->GetLoginSessionVar();
        
        $_SESSION[$sessionvar]=NULL;	
        
        unset($_SESSION[$sessionvar]);
		session_destroy();
    }
    
    
	function imageResizing ( $uploadDir, $file, $maxWidth = 800, $maxHeight = 800){

		$ext = substr($file,-3,3);

		$src_img = imagecreatefromjpeg($uploadDir.$file);

		$maxSize = $maxWidth;
		
		// This will resize either width or height depending on which is wrong
		// If the image is smaller it won't resize at all.
		
		  $src_size = getimagesize($uploadDir.$file);
		   $width = $src_size[0];
		   $height = $src_size[1];
		
		   if($width > $maxSize || $height > $maxHeight) {
		
			  if($width > $height) {
				$z = $width;
				$i = 0;
				while($z > $maxSize) {
				  --$z; ++$i;
				}
				$dest_width = $z;
				$dest_height = $height - ($height * ($i / $width));
			  }
			  
			  else {
		
				$z = $height;
				$i = 0;
				while($z > $maxHeight) {
				  --$z; ++$i;
				}
				$dest_width = $width - ($width * ($i / $height));
				$dest_height = $z;
			  }
		
		  }
		  
		  else {
		
			 $dest_width = $width;
			 $dest_height = $height;
		  }
	
		$dest_img = imagecreatetruecolor($dest_width, $dest_height);
		imagecopyresampled($dest_img, $src_img, 0, 0, 0, 0, $dest_width, $dest_height,$src_size[0],$src_size[1]);
		$medImg = imagejpeg($dest_img, $uploadDir.$file,100);	
		
		imagedestroy($src_img);
	}
		
	function GetRegions() {
		 if(!$this->GetUserFromEmail($this->UserEmail(),$user_rec))
        {
        } 
		$myQuery = mysql_query("SELECT region FROM Location GROUP BY region DESC", $this->connection);
				
		$locationArr = array();
		
		while ($row = mysql_fetch_assoc($myQuery))
		{
			array_push($locationArr, $row);
		}
		
		return $locationArr;
	}
	
	
	function GetStates($region) {
		
		if(!$this->GetUserFromEmail($this->UserEmail(),$user_rec))
        {
        } 
		$myQuery = mysql_query("SELECT state FROM Location where region='".$region."' GROUP BY state ASC", $this->connection);
				
		$locationArr = array();
		
		while ($row = mysql_fetch_assoc($myQuery))
		{
			array_push($locationArr, $row);
		}
		
		return $locationArr;
	}
	
	function GetCities($state) {
		 if(!$this->GetUserFromEmail($this->UserEmail(),$user_rec))
        {
        } 
		$myQuery = mysql_query("SELECT url_name, location_name FROM Location WHERE state = '".$state."' ORDER BY location_name ASC", $this->connection);
				
		$locationArr = array();
		
		while ($row = mysql_fetch_assoc($myQuery))
		{
			array_push($locationArr, $row);
		}
		
		return $locationArr;
	}
	
	function GetAllCities(){
		 if(!$this->GetUserFromEmail($this->UserEmail(),$user_rec))
        {
        } 
		$myQuery = mysql_query("SELECT url_name, location_name FROM Location ORDER BY location_name ASC", $this->connection);
				
		$locationArr = array();
		
		while ($row = mysql_fetch_assoc($myQuery))
		{
			array_push($locationArr, $row);
		}
		
		return $locationArr;
	}
	
	function GetLocationName($location_url_name) {
		 if(!$this->GetUserFromEmail($this->UserEmail(),$user_rec))
        {
        } 
		$myQuery = mysql_query("SELECT location_name,state FROM Location WHERE url_name = '$location_url_name'", $this->connection);
		
		if ($row = mysql_fetch_assoc($myQuery))
		{
			$returnVal = $row['location_name'].', '.$row['state'];			
			return $returnVal;
		}		

		else 
		{
		  return false;
		}
	}
		
	function NotSpamming($phone, $category, $location, $ip) 
	{
		if(!$this->GetUserFromEmail($this->UserEmail(),$user_rec))
        {          
        } 
		
		$myQuery = mysql_query("SELECT post_id 
									FROM Post
										WHERE (author_phone = '$phone'
											  AND 
											  category = '$category'
											  AND
											  location = '$location'
											  AND
											  DATE_SUB(CURDATE(), INTERVAL 2 DAY))
											  OR (ip = '$ip'
												  AND 
												  category = '$category'
												  AND
												  location = '$location'
												  AND
												  DATE_SUB(CURDATE(), INTERVAL 2 DAY))", $this->connection);
		//they are posting too often
		if ($row = mysql_fetch_assoc($myQuery))
		{
			return false;
		}	
		
		else 
		{
			return true;
		}
		
	}
		
	function InsertNewPost($postArr) {
		if(!$this->GetUserFromEmail($this->UserEmail(),$user_rec))
        {
        } 			
		
		$sql = "Insert into Post
					(chat_name,
					 title, 
					 category, 
					 description, 
					 img_folder,
					 price,
					 currency,
					 location,
					 specific_location,
					 author_email,
					 author_phone,
					 noSpam,
					 displayPhone,
					 ip)
								 
				Values (
					'".$postArr['chat_name']."',
					'".$postArr['title']."',
					'".$postArr['category']."',
					'".$postArr['description']."',
					'".$postArr['img_folder']."',
					".$postArr['price'].",
					'".$postArr['currency']."',
					'".$postArr['location']."',
					'".$postArr['spec_location']."',
					'".$postArr['author_email']."',
					'".$postArr['author_phone']."',
					".$postArr['noSpam'].",
					".$postArr['displayPhone'].",
					'".$postArr['ipAddress']."'
				)"; 
								
				if(!mysql_query( $sql ,$this->connection))
				{					
					return false;
				}
		
		//Get location from the name, state combination
		$myQuery = mysql_query("SELECT MAX(post_id) as pid from Post", $this->connection);	
		if ($row = mysql_fetch_assoc($myQuery))
		{
			$id = $row['pid'];
			return $id;	
		}
		else 
		{
			return false;
		}
			
	}

//Population of currencies and images
/*   
function insertCurrency($currArr) {
	if(!$this->GetUserFromEmail($this->UserEmail(),$user_rec))
        {
        }
	
		
	for ($i=0; $i < sizeOf($currArr); $i++)
	{
		$image = $currArr[$i][1];
		$coin =$currArr[$i][0];
		
		$sql = "INSERT INTO currency
				(currency_name, currency_image)
					VALUES ('$coin', '$image')";
		
		if(!mysql_query( $sql ,$this->connection))
		{					
			return false;
		}
		else {
			continue;
		}		
	} 
	
} */
  
	
	function GetCategories() {
		if(!$this->GetUserFromEmail($this->UserEmail(),$user_rec))
        {
        } 
		$myQuery = mysql_query("SELECT category_id, category_name FROM category ORDER BY category_id ASC", $this->connection);
				
		$catArr = array();
		
		while ($row = mysql_fetch_assoc($myQuery))
		{
			array_push($catArr, $row);
		}
		
		return $catArr;
	}
	
	function GetSubCategories($category_id) {
		if(!$this->GetUserFromEmail($this->UserEmail(),$user_rec))
        {
        } 
		$myQuery = mysql_query("SELECT subcategory_id, subcategory_name FROM subcategory where category_id = $category_id ORDER BY subcategory_name ASC", $this->connection);
				
		$subcatArr = array();
		
		while ($row = mysql_fetch_assoc($myQuery))
		{
			array_push($subcatArr, $row);
		}
		
		return $subcatArr;
	}
	
	
	function GetPost($post_id) {
		if(!$this->GetUserFromEmail($this->UserEmail(),$user_rec))
        {          
        } 
		
		$myQuery = mysql_query("SELECT * FROM Post where post_id = $post_id", $this->connection);
			
		if ($row = mysql_fetch_assoc($myQuery))
		{
			return $row;
		}		
	}
	
	function GetCategoryPosts($category, $loc, $offset, $key, $currency, $orderBy, $orderSort, $spec_loc) {
		if(!$this->GetUserFromEmail($this->UserEmail(),$user_rec))
        {          
        } 
		
		//Construct the query
		$query = "SELECT post_id, title, date, price, currency, specific_location
									FROM  `Post` 
									WHERE category = '$category'
										  AND location = '$loc'";
		
			//Check for search param
			if (strlen($key) != 0) 
			{				
				$query .= " AND title LIKE '%$key%'";
			}
			
			//Check for currency param
			if (strlen($currency) != 0) 
			{
				$query .= " AND currency = '$currency'";
			}
			
			//Check for specific location param
			if (strlen($spec_loc) != 0) 
			{
				$query .= " AND specific_location = '$spec_loc'";
			}
				
			//Check for offset based on page #
			if (strlen($orderBy) != 0) {
				$query .= " ORDER BY $orderBy $orderSort LIMIT 100";
			}
			
			else  {
				//100 posts per page
				$query .= " ORDER BY date DESC LIMIT 100";
			}
			
			//Check for offset based on page #
			if (strlen($offset) != 0) {
				$query .= " OFFSET $offset";
			}
			
		$myQuery = mysql_query($query, $this->connection);
		
		$postArr = array();
		
		while ($row = mysql_fetch_assoc($myQuery))
		{
			array_push($postArr, $row);
		}
		
		return $postArr;		
	} 
	
	function GetPostsFromArray($postIds, $key) {
		if(!$this->GetUserFromEmail($this->UserEmail(),$user_rec))
        {          
        } 

		if ($key == '') {
		$myQuery = mysql_query("SELECT *
									FROM  `Post` 
										WHERE post_id IN (".implode(',',$postIds).")
										ORDER BY date DESC", $this->connection);
		}

		else {
		$myQuery = mysql_query("SELECT *
									FROM  `Post` 
										WHERE post_id IN (".implode(',',$postIds).")
										AND title LIKE '%$key%'
											ORDER BY date DESC", $this->connection);
		}
								
		$postArr = array();
		
		while ($row = mysql_fetch_assoc($myQuery))
		{
			array_push($postArr, $row);
		}
		
		return $postArr;						
		
	}
	
	function GetRecentPosts($location) {
		if(!$this->GetUserFromEmail($this->UserEmail(),$user_rec))
        {          
        } 

		$myQuery = mysql_query("SELECT *
									FROM  `Post` 
										WHERE location = '$location'
										ORDER BY date DESC
											LIMIT 100", $this->connection);
								
		$postArr = array();
		
		while ($row = mysql_fetch_assoc($myQuery))
		{
			array_push($postArr, $row);
		}
		
		return $postArr;						
		
	}
			
	
	
	
    //-------Public Helper functions -------------
    function GetSelfScript()
    {
        return htmlentities($_SERVER['PHP_SELF']);
    }    
    
    function SafeDisplay($value_name)
    {
        if(empty($_POST[$value_name]))
        {
            return'';
        }
        return htmlentities($_POST[$value_name]);
    }
    
    function RedirectToURL($url)
    {
        header("Location: $url");
        exit;
    }
    
    function GetSpamTrapInputName()
    {
        return 'sp'.md5('KHGdnbvsgst'.$this->rand_key);
    }
    
    function GetErrorMessage()
    {
        if(empty($this->error_message))
        {
            return '';
        }
        $errormsg = nl2br(htmlentities($this->error_message));
        return $errormsg;
    }    
    //-------Private Helper functions-----------
    
    function HandleError($err)
    {
        $this->error_message .= $err."\r\n";
    }
    
    function HandleDBError($err)
    {
        $this->HandleError($err."\r\n mysqlerror:".mysql_error());
    }
    
    function GetFromAddress()
    {
        if(!empty($this->from_address))
        {
            return $this->from_address;
        }

        $host = $_SERVER['SERVER_NAME'];

        $from ="nobody@$host";
        return $from;
    } 
    
    function GetLoginSessionVar()
    {
        $retvar = md5($this->rand_key);
        $retvar = 'usr_'.substr($retvar,0,10);
        return $retvar;
    }
    
    function CheckLoginInDB($connectName,$password)
    {
        if(!$this->DBLogin())
        {
            $this->HandleError("Database login failed!");
            return false;
        }          
        $connectName = $this->SanitizeForSQL($connectName);

  	$nresult = mysql_query("SELECT * FROM $this->tablename WHERE connectName = '$connectName'", $this->connection) or die(mysql_error());
        // check for result 
        $no_of_rows = mysql_num_rows($nresult);
        if ($no_of_rows > 0) {
            $nresult = mysql_fetch_array($nresult);
            $salt = $nresult['salt'];
            $encrypted_password = $nresult['password'];
            $hash = $this->checkhashSSHA($salt, $password);
         
           
        }        

        $qry = "Select name, email from $this->tablename where connectName='$connectName' and password='$hash' and confirmcode='y'";
        
        $result = mysql_query($qry,$this->connection);
        
        if(!$result || mysql_num_rows($result) <= 0)
        {
            $this->HandleError("Error logging in. The connectName or password does not match");
            return false;
        }
        
        $row = mysql_fetch_assoc($result);
        
        
        $_SESSION['name_of_user']  = $row['name'];
        $_SESSION['email_of_user'] = $row['email'];
		$_SESSION['connectName'] = $row['connectName'];
		
		
		date_default_timezone_set('America/Los_Angeles');
		
        return true;
    }

 public function checkhashSSHA($salt, $password) {
 
        $hash = base64_encode(sha1($password . $salt, true) . $salt);
 
        return $hash;
    }
    
    function UpdateDBRecForConfirmation(&$user_rec)
    {
        if(!$this->DBLogin())
        {
            $this->HandleError("Database login failed!");
            return false;
        }   
        $confirmcode = $this->SanitizeForSQL($_GET['code']);
        
        $result = mysql_query("Select name, email from $this->tablename where confirmcode='$confirmcode'",$this->connection);   
        if(!$result || mysql_num_rows($result) <= 0)
        {
            $this->HandleError("Wrong confirm code.");
            return false;
        }
        $row = mysql_fetch_assoc($result);
        $user_rec['name'] = $row['name'];
        $user_rec['email']= $row['email'];
        
        $qry = "Update $this->tablename Set confirmcode='y' Where  confirmcode='$confirmcode'";
        
        if(!mysql_query( $qry ,$this->connection))
        {
            $this->HandleDBError("Error inserting data to the table\nquery:$qry");
            return false;
        }      
        return true;
    }
    
    function ResetUserPasswordInDB($user_rec)
    {
        $new_password = substr(md5(uniqid()),0,10);
        
        if(false == $this->ChangePasswordInDB($user_rec,$new_password))
        {
            return false;
        }
        return $new_password;
    }
    
    function ChangePasswordInDB($user_rec, $newpwd)
    {
        $newpwd = $this->SanitizeForSQL($newpwd);

        $hash = $this->hashSSHA($newpwd);

	$new_password = $hash["encrypted"];

	$salt = $hash["salt"];
        
        $qry = "Update $this->tablename Set password='".$new_password."', salt='".$salt."' Where  id_user=".$user_rec['id_user']."";
        
        if(!mysql_query( $qry ,$this->connection))
        {
            $this->HandleDBError("Error updating the password \nquery:$qry");
            return false;
        }     
        return true;
    }
    
    function GetUserFromEmail($email,&$user_rec)
    {
        if(!$this->DBLogin())
        {
            $this->HandleError("Database login failed!");
            return false;
        }   
        $email = $this->SanitizeForSQL($email);
        
        $result = mysql_query("Select * from $this->tablename where email='$email'",$this->connection);  

        if(!$result || mysql_num_rows($result) <= 0)
        {
            $this->HandleError("There is no user with email: $email");
            return false;
        }
        $user_rec = mysql_fetch_assoc($result);

        
        return true;
    }
    
    function SendUserWelcomeEmail(&$user_rec)
    {
        $mailer = new PHPMailer();
        
        $mailer->CharSet = 'utf-8';
        
        $mailer->AddAddress($user_rec['email'],$user_rec['name']);
        
        $mailer->Subject = "Welcome to ".$this->sitename;

        $mailer->From = $this->GetFromAddress();        
        
        $mailer->Body ="Hello ".$user_rec['name']."\r\n\r\n".
        "Welcome! Your registration  with ".$this->sitename." is completed.\r\n".
        "\r\n".
        "Regards,\r\n".
        "Webmaster\r\n".
        $this->sitename;

        if(!$mailer->Send())
        {
            $this->HandleError("Failed sending user welcome email.");
            return false;
        }
        return true;
    }
    
    function SendAdminIntimationOnRegComplete(&$user_rec)
    {
        if(empty($this->admin_email))
        {
            return false;
        }
        $mailer = new PHPMailer();
        
        $mailer->CharSet = 'utf-8';
        
        $mailer->AddAddress($this->admin_email);
        
        $mailer->Subject = "Registration Completed: ".$user_rec['name'];

        $mailer->From = $this->GetFromAddress();         
        
        $mailer->Body ="A new user registered at ".$this->sitename."\r\n".
        "Name: ".$user_rec['name']."\r\n".
        "Email address: ".$user_rec['email']."\r\n";
        
        if(!$mailer->Send())
        {
            return false;
        }
        return true;
    }
	
	function AlertFlaggedPost($post_id)
    {
        if(empty($this->admin_email))
        {
            return false;
        }
        $mailer = new PHPMailer();
        
        $mailer->CharSet = 'utf-8';
        
        $mailer->AddAddress($this->admin_email);
        
        $mailer->Subject = "ALERT: Post $post_id was flagged";

        $mailer->From = $this->GetFromAddress();         
        
        $mailer->Body ="A new flag was created on Post ID# $post_id.  for ".$this->sitename." \r\n Link to the listing: http://www.".$this->sitename."/post.php?id=$post_id";
        
        if(!$mailer->Send())
        {
            return false;
        }
        return true;
    }
    
    function GetResetPasswordCode($email)
    {
		return substr(md5($email.$this->sitename.$this->rand_key),0,10);
    }
    
    function SendResetPasswordLink($user_rec)
    {
        $email = $user_rec['email'];
        
        $mailer = new PHPMailer();
        
        $mailer->CharSet = 'utf-8';
        
        $mailer->AddAddress($email,$user_rec['name']);
        
        $mailer->Subject = "Your reset password request at ".$this->sitename;

        $mailer->From = $this->GetFromAddress();
        
        $link = $this->GetAbsoluteURLFolder().
                '/resetpwd.php?email='.
                urlencode($email).'&code='.
                urlencode($this->GetResetPasswordCode($email));
				
        $mailer->Body ="Hello ".$user_rec['name'].",\r\n\r\n".
        "There was a request to reset your password at ".$this->sitename."\r\n".
        "Please click the link below to complete the request: \r\n".$link."\r\n".
        "\nRegards,\r\n".
        "Webmaster\r\n".
        $this->sitename;
        
        if(!$mailer->Send())
        {
            return false;
        }
        return true;
    }
    
    function SendNewPassword($user_rec, $new_password)
    {
        $email = $user_rec['email'];
        
        $mailer = new PHPMailer();
        
        $mailer->CharSet = 'utf-8';
        
        $mailer->AddAddress($email,$user_rec['name']);
        
        $mailer->Subject = "Your new password for ".$this->sitename;

        $mailer->From = $this->GetFromAddress();
        
        $mailer->Body ="Hello ".$user_rec['name']."\r\n\r\n".
        "Your password is reset successfully. ".
        "Here is your updated login:\r\n".
        "Connect Name:".$user_rec['connectName']."\r\n".
        "password:$new_password\r\n".
        "\r\n".
        "Login here: ".$this->GetAbsoluteURLFolder()."/login.php\r\n".
        "\r\n".
        "Regards,\r\n".
        "Webmaster\r\n".
        $this->sitename;
        
        if(!$mailer->Send())
        {
            return false;
        }
        return true;
    }    
    
    function ValidateRegistrationSubmission()
    {
        //This is a hidden input field. Humans won't fill this field.
        if(!empty($_POST[$this->GetSpamTrapInputName()]) )
        {
            //The proper error is not given intentionally
            $this->HandleError("Automated submission prevention: case 2 failed");
            return false;
        }
        
        $validator = new FormValidator();
        $validator->addValidation("name","req","Please fill in your name");
        $validator->addValidation("email","email","The input for Email should be a valid email value");
        $validator->addValidation("email","req","Please fill in Email");
		$validator->addValidation("connectName","req","Please fill in Connect Name");
        $validator->addValidation("password","req","Please fill in Password");

        
        if(!$validator->ValidateForm())
        {
            $error='';
            $error_hash = $validator->GetErrors();
            foreach($error_hash as $inpname => $inp_err)
            {
                $error .= $inpname.':'.$inp_err."\n";
            }
            $this->HandleError($error);
            return false;
        }        
        return true;
    }
    
    function CollectRegistrationSubmission(&$formvars)
    {
        $formvars['name'] = $this->Sanitize($_POST['name']);
		$formvars['connectName'] = $this->Sanitize($_POST['connectName']);
        $formvars['email'] = $this->Sanitize($_POST['email']);
        $formvars['password'] = $this->Sanitize($_POST['password']);
		$formvars['photo'] = $this->Sanitize($_POST['photo']);   
    }
    
    function SendUserConfirmationEmail(&$formvars)
    {
        $mailer = new PHPMailer();
        
        $mailer->CharSet = 'utf-8';
        
        $mailer->AddAddress($formvars['email'],$formvars['name']);
        
        $mailer->Subject = "Your registration with ".$this->sitename;

        $mailer->From = $this->GetFromAddress();        
        
        $confirmcode = $formvars['confirmcode'];
        
        $confirm_url = $this->GetAbsoluteURLFolder().'/confirmreg.php?code='.$confirmcode;
        
        $mailer->Body ="Hello ".$formvars['name']."\r\n\r\n".
        "Thanks for your registration with ".$this->sitename."\r\n".
        "Please click the link below to confirm your registration.\r\n".
        "$confirm_url\r\n".
        "\r\n".
        "Regards,\r\n".
        "The Bitroad Team\r\n".
        $this->sitename;

        if(!$mailer->Send())
        {
            $this->HandleError("Failed sending registration confirmation email.");
            return false;
        }
		
		
		if(!isset($_SESSION)){ session_start(); }
        
        $_SESSION[$this->GetLoginSessionVar()] = $connectName;
		$_SESSION['email_of_user'] = $formvars['email'];
		
        return true;
    }
	
	function ResendEmail() {
		
		$user_rec = array();
        if(!$this->GetUserFromEmail($this->UserEmail(),$user_rec))
        {
            return false;
        }
		
		$mailer = new PHPMailer();
        
        $mailer->CharSet = 'utf-8';
        
        $mailer->AddAddress($user_rec['email'], $user_rec['name']);
        
        $mailer->Subject = "Your registration with ".$this->sitename;

        $mailer->From = $this->GetFromAddress();        
        
        $confirmcode = $user_rec['confirmcode'];
        
        $confirm_url = $this->GetAbsoluteURLFolder().'/confirmreg.php?code='.$confirmcode;
        
        $mailer->Body ="Hello ".$user_rec['name']."\r\n\r\n".
        "Thanks for your registration with ".$this->sitename."\r\n".
        "Please click the link below to confirm your registration.\r\n".
        "$confirm_url\r\n".
        "\r\n".
        "Regards,\r\n".
        "The Bitroad Team\r\n".
        $this->sitename;

        if(!$mailer->Send())
        {
            $this->HandleError("Failed sending registration confirmation email.");
            return false;
        }
		
		
		if(!isset($_SESSION)){ session_start(); }
        
        $_SESSION[$this->GetLoginSessionVar()] = $connectName;
		$_SESSION['email_of_user'] = $user_rec['email'];
		
        return true;
	}
	
	
    function GetAbsoluteURLFolder()
    {
        $scriptFolder = (isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] == 'on')) ? 'https://' : 'http://';

        $urldir ='';
        $pos = strrpos($_SERVER['REQUEST_URI'],'/');
        if(false !==$pos)
        {
            $urldir = substr($_SERVER['REQUEST_URI'],0,$pos);
        }

        $scriptFolder .= $_SERVER['HTTP_HOST'].$urldir;

        return $scriptFolder;
    }
    
    function SendAdminIntimationEmail(&$formvars)
    {
        if(empty($this->admin_email))
        {
            return false;
        }
        $mailer = new PHPMailer();
        
        $mailer->CharSet = 'utf-8';
        
        $mailer->AddAddress($this->admin_email);
        
        $mailer->Subject = "New registration: ".$formvars['name'];

        $mailer->From = $this->GetFromAddress();         
        
        $mailer->Body ="A new user registered at ".$this->sitename."\r\n".
        "Name: ".$formvars['name']."\r\n".
        "Email address: ".$formvars['email']."\r\n".
        "Connect Name: ".$formvars['connectName'];
        
        if(!$mailer->Send())
        {
            return false;
        }
        return true;
    }
    
    function SaveToDatabase(&$formvars)
    {
        if(!$this->DBLogin())
        {
            $this->HandleError("Database login failed!");
            return false;
        }
        if(!$this->Ensuretable())
        {
            return false;
        }
        if(!$this->IsFieldUnique($formvars,'email'))
        {
            $this->HandleError("This email is already registered");
            return false;
        }
        
	if(!$this->IsFieldUnique($formvars,'connectName'))
        {
            $this->HandleError("This Connect Name is already used. Please try another.");
            return false;
        } 
              
        if(!$this->InsertIntoDB($formvars))
        {
            $this->HandleError("Inserting to Database failed!");
            return false;
        }
        return true;
    }
    
    function IsFieldUnique($formvars,$fieldname)
    {
        $field_val = $this->SanitizeForSQL($formvars[$fieldname]);
        $qry = "select connectName from $this->tablename where $fieldname='".$field_val."'";
        $result = mysql_query($qry,$this->connection);   
        if($result && mysql_num_rows($result) > 0)
        {
            return false;
        }
        return true;
    }
    
    function DBLogin()
    {

        $this->connection = mysql_connect($this->db_host,$this->connectName,$this->pwd);

        if(!$this->connection)
        {   
            $this->HandleDBError("Database Login failed! Please make sure that the DB login credentials provided are correct");
            return false;
        }
        if(!mysql_select_db($this->database, $this->connection))
        {
            $this->HandleDBError('Failed to select database: '.$this->database.' Please make sure that the database name provided is correct');
            return false;
        }
        if(!mysql_query("SET NAMES 'UTF8'",$this->connection))
        {
            $this->HandleDBError('Error setting utf8 encoding');
            return false;
        }
        return true;
    }    
    
    function Ensuretable()
    {
        $result = mysql_query("SHOW COLUMNS FROM $this->tablename");   
        if(!$result || mysql_num_rows($result) <= 0)
        {
            return $this->CreateTable();
        }
        return true;
    }
    
    function CreateTable()
    {
       
    	$qry = "Create Table $this->tablename (".
                "id_user INT NOT NULL AUTO_INCREMENT ,".
                "name VARCHAR( 128 ) NOT NULL ,".
                "email VARCHAR( 64 ) NOT NULL ,".
                "phone_number VARCHAR( 16 ) NOT NULL ,".
                "connectName VARCHAR( 16 ) NOT NULL ,".
				"salt VARCHAR( 50 ) NOT NULL ,".
                "password VARCHAR( 80 ) NOT NULL ,".
                "confirmcode VARCHAR(32) ,".
				"points BIGINT(20) ,".
                "PRIMARY KEY ( id_user )".
                ")";
	
                
        if(!mysql_query($qry,$this->connection))
        {
            $this->HandleDBError("Error creating the table \nquery was\n $qry");
            return false;
        }
        return true;
    }
	
	function  CreatePost($text, $link, $image) {
		$text = addslashes($text);
		
		$user_rec = array();
        if(!$this->GetUserFromEmail($this->UserEmail(),$user_rec))
        {
            return false;
        }  
		
		$sql = "Insert into post
					(author_id, 
					 post_text,
					 views, 
					 post_image,
					 post_points, 
					 post_link)
								 
				Values (
					".$user_rec['id_user'].",
					'".$text."',
					0,
					'".$image."',
					0,
					'".$link."'
				)";
														
				if(!mysql_query( $sql ,$this->connection))
				{
					return false;
				}
				
			return true;
	}
	
	function  Comment($text, $post_id) {
		
		$text = addslashes($text);
		$user_rec = array();
        
		if(!$this->GetUserFromEmail($this->UserEmail(),$user_rec))
        {
            return false;
        }  
		
		$sql = "Insert into comment
					(comment_text, 
					 post_id,
					 sender_id)
								 
				Values (
					'".$text."',
					'".$post_id."',
					'".$user_rec['id_user']."'							
				)";
														
		if(!mysql_query( $sql ,$this->connection))
		{
			return false;
		}
		

		//Notify the author
		$result = mysql_query("Select author_id from post where post_id=".$post_id." ",$this->connection);  

        if(!$result || mysql_num_rows($result) <= 0)
        {
            return false;
        }
        $row = mysql_fetch_assoc($result);
        
        $user = $row['author_id'];
		$type = "post||comment";
		
		if ($user != $sender) {
			$this->NotifyUser($user, $type, $post_id, $text, $sender);
		}
		
		return true;
	}
	
	function  SendMessage($text, $toUser) 
	{
		
		$text = addslashes($text);
		$user_rec = array();
        if(!$this->GetUserFromEmail($this->UserEmail(),$user_rec))
        {
            return false;
        }  
		
		//Find or Create the message string
		$result = mysql_query("Select * from user_message_string where ((userA_id =".$user_rec['id_user']." AND userB_id = ".$toUser.") OR (userB_id =".$user_rec['id_user']." AND userA_id = ".$toUser."))", $this->connection);
				
				if(!$result || mysql_num_rows($result) <= 0)
				{
					//Create a message string
					$insert_query = "Insert into user_message_string (user_message_string_id, userA_id, userB_id) Values (NULL, '".$user_rec['id_user']."', '".$toUser."')";
					if(!mysql_query( $insert_query ,$this->connection))
					{
						$this->HandleDBError("Error inserting data to the table\nquery:$insert_query");
						return false;
					}
					
					//Find the id of the message string we just created
					$result = mysql_query("Select * from user_message_string where ((userA_id =".$user_rec['id_user']." AND userB_id = ".$toUser.") OR (userB_id =".$user_rec['id_user']." AND userA_id = ".$toUser."))", $this->connection);
				
					if(!$result || mysql_num_rows($result) <= 0)
					{
						return false;
					}
					
					$row = mysql_fetch_assoc($result);
					$conversation_id = $row['user_message_string_id'];
					
					//Add the message to the string
					$insert_query = "Insert into message (message_id, sender_id, sent_time, message_text, message_string_id) Values (NULL, '".$user_rec['id_user']."', CURRENT_TIMESTAMP, '".$text."', '".$conversation_id."')";
					if(!mysql_query( $insert_query ,$this->connection))
					{
						$this->HandleDBError("Error inserting data to the table\nquery:$insert_query");
						return false;
					}
				}
				
				else {
					$row = mysql_fetch_assoc($result);
					$conversation_id = $row['user_message_string_id'];
					
					//Add the message to the string
					$insert_query = "Insert into message (message_id, sender_id, sent_time, message_text, message_string_id) Values (NULL, '".$user_rec['id_user']."', CURRENT_TIMESTAMP, '".$text."', '".$conversation_id."')";
					if(!mysql_query( $insert_query ,$this->connection))
					{
						$this->HandleDBError("Error inserting data to the table\nquery:$insert_query");
						return false;
					}
				}
				
			$this->AddAlert('message', $toUser);
				
			return true;
	}
	
	 function Redirect($url, $permanent = false)
	{
		if (headers_sent() === false)
		{
			header('Location: ' . $url, true, ($permanent === true) ? 301 : 302);
		}

		exit();
	}
    
    function InsertIntoDB(&$formvars)
    {
    
        $confirmcode = $this->MakeConfirmationMd5($formvars['email']);

        $formvars['confirmcode'] = $confirmcode;

		$hash = $this->hashSSHA($formvars['password']);

		$encrypted_password = $hash["encrypted"];
        
 

		$salt = $hash["salt"];
 
        $insert_query = 'insert into '.$this->tablename.'(
		name,
		email,
		connectName,	
		password,
		salt,
		confirmcode,
		points
		)
		values
		(
		"' . $this->SanitizeForSQL($formvars['name']) . '",
		"' . $this->SanitizeForSQL($formvars['email']) . '",
		"' . $this->SanitizeForSQL($formvars['connectName']) . '",
		"' . $encrypted_password . '",
		"' . $salt . '",
		"' . $confirmcode . '",
		"    0  "
		)';  

 
        if(!mysql_query( $insert_query ,$this->connection))
        {
            //$this->HandleDBError("Error inserting data to the table\nquery:$insert_query");
			$this->HandleDBError("There was a problem, please try again.");
            return false;
        }        
        return true;
    }
    function hashSSHA($password) {
 
        $salt = sha1(rand());
        $salt = substr($salt, 0, 10);
        $encrypted = base64_encode(sha1($password . $salt, true) . $salt);
        $hash = array("salt" => $salt, "encrypted" => $encrypted);
        return $hash;
    }
    function MakeConfirmationMd5($email)
    {
        $randno1 = rand();
        $randno2 = rand();
        return md5($email.$this->rand_key.$randno1.''.$randno2);
    }
	function Alert($message) {
		echo '<script language="javascript">';
		echo 'alert("'.$message.'")';
		echo '</script>';
	}
	
    function SanitizeForSQL($str)
    {
        if( function_exists( "mysql_real_escape_string" ) )
        {
              $ret_str = mysql_real_escape_string( $str );
        }
        else
        {
              $ret_str = addslashes( $str );
        }
        return $ret_str;
    }
    
 /*
    Sanitize() function removes any potential threat from the
    data submitted. Prevents email injections or any other hacker attempts.
    if $remove_nl is true, newline chracters are removed from the input.
    */
    function Sanitize($str,$remove_nl=true)
    {
        $str = $this->StripSlashes($str);

        if($remove_nl)
        {
            $injections = array('/(\n+)/i',
                '/(\r+)/i',
                '/(\t+)/i',
                '/(%0A+)/i',
                '/(%0D+)/i',
                '/(%08+)/i',
                '/(%09+)/i'
                );
            $str = preg_replace($injections,'',$str);
        }

        return $str;
    }    
    function StripSlashes($str)
    {
        if(get_magic_quotes_gpc())
        {
            $str = stripslashes($str);
        }
        return $str;
    }    
}
?>
