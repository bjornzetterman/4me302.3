<?php
session_start();
      $config   = dirname(__FILE__) . '/library/config.php';
      require_once( "library/Hybrid/Auth.php" );
	  require_once("functions.php");
if(isset($_GET['provider']))
{
try{
	$provider = $_GET['provider'];
	$_SESSION['authprovider']= $provider;
    $hybridauth = new Hybrid_Auth( $config );
    $authProvider = $hybridauth->authenticate($provider);
    $user_profile = $authProvider->getUserProfile();
    if($user_profile && isset($user_profile->identifier))
    {
	//echo $provider;
		switch($provider){
			case 'Facebook';
				
				//we asume that facebook means patient.
				$user = gettable("User","3");// we assume that it is USERISD #3. This is not nice but since i dont control the email in the example databse i cant use email to connect easily.
				//echo $user->userID[0]->Role_IDrole; //need to be typecasted to string...
				//print_r($user);
				//$_SESSION['username'] = (string) $user->userID[0]->username;
				//$_SESSION['email'] = (string) $user->userID[0]->email;
				//$_SESSION['RoleId'] = (string) $user->userID[0]->Role_IDrole;
				//$_SESSION['OrganizationId'] = (string) $user->userID[0]->Organization;;
				//	echo "<hr />";
				//	print_r($_SESSION);

			break;
			
			case 'Twitter';
				$user = gettable("User","1");
			break;
		
			case 'Google';
				$user = gettable("User","2");
			break;
			
			default;
				echo 'Ehhm something wrong?';
			break;
		}
				$organization = gettable("Organization",(string) $user->userID[0]->Organization);
				$role = gettable("Role",(string) $user->userID[0]->Role_IDrole);
			
			$_SESSION['userid'] = (string) $user->userID[0][id];
			$_SESSION['username'] = (string) $user->userID[0]->username;
			$_SESSION['email'] = (string) $user->userID[0]->email;
			$_SESSION['RoleId'] = (string) $user->userID[0]->Role_IDrole;
			$_SESSION['Organization'] = (string) $organization->OrganizationID[0]->name;
			$_SESSION['Role'] = (string) $role->roleID[0]->name;
			
			//$t = getTherapies("1");
		//	print_r($t);
		//print_r($user_profile);
		echo "<hr />";
		echo "USER ID :".$_SESSION['userid'] . "<br />";
		echo "<b>provider </b> :". $_SESSION['authprovider'] . "<br />";
        echo "<b>Name</b> :".$user_profile->displayName."<br>";
        echo "<b>Identifier</b> :".$user_profile->identifier."<br>";
     //   echo "<b>Image</b> :".$user_profile->photoURL."<br> ";
        echo "<img src='".$user_profile->photoURL."'/><br>";
        echo "<b>Email</b> :".$user_profile->email."<br>";
		echo "<a href=main.php> To the meny </a>   ";
        echo "<br> <a href='logout.php'>Logout</a>";
		
		
		
    }           
 
    }
    catch( Exception $e )
    { 
         switch( $e->getCode() )
         {
                case 0 : echo "Unspecified error."; break;
                case 1 : echo "Hybridauth configuration error."; break;
                case 2 : echo "Provider not properly configured."; break;
                case 3 : echo "Unknown or disabled provider."; break;
                case 4 : echo "Missing provider application credentials."; break;
                case 5 : echo "Authentication failed The user has canceled the authentication or the provider refused the connection.";
                         break;
                case 6 : echo "User profile request failed. Most likely the user is not connected to the provider and he should to authenticate again.";
                         $authProvider->logout();
                         break;
                case 7 : echo "User not connected to the provider.";
                         $authProvider->logout();
                         break;
                case 8 : echo "Provider does not support this feature."; break;
        }
 
        echo "<br /><br /><b>Original error message:</b> " . $e->getMessage();
 
        echo "<hr /><h3>Trace</h3> <pre>" . $e->getTraceAsString() . "</pre>";
 
    }
	
 
}
?>