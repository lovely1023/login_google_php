<?php
class User
{
    private $dbHost = 'localhost';
    /*private $dbUsername = 'test';
    private $dbPassword = 'test';
    private $dbName = 'test';*/
    private $dbUsername = 'root';
    private $dbPassword = '';
    private $dbName = 'google_login';
    private $userTbl = 'users';
    
    public function __construct()
    {
        /*if (!isset($this->db)) {
            // Connect to the database
            $conn = new mysqli($this->dbHost, $this->dbUsername, $this->dbPassword, $this->dbName);
            if ($conn->connect_error) {
                die('Failed to connect with MySQL: '.$conn->connect_error);
            } else {
                $this->db = $conn;
            }
        }*/
    }
    
    //public function checkUser($userData = array())
    public function checkUser($userEmail)
    {
        /*if (!empty($userData)) {
            // Check whether user data already exists in database
            $prevQuery = "SELECT * FROM ".$this->userTbl." WHERE oauth_provider = '".$userData['oauth_provider']."' AND oauth_uid = '".$userData['oauth_uid']."'";
            $prevResult = $this->db->query($prevQuery);
            if ($prevResult->num_rows > 0) {
                // Update user data if already exists
                $query = "UPDATE ".$this->userTbl." SET first_name = '".$userData['first_name']."', last_name = '".$userData['last_name']."', email = '".$userData['email']."', gender = '".$userData['gender']."', locale = '".$userData['locale']."', picture = '".$userData['picture']."', link = '".$userData['link']."', modified = NOW() WHERE oauth_provider = '".$userData['oauth_provider']."' AND oauth_uid = '".$userData['oauth_uid']."'";
                $update = $this->db->query($query);
            } else {
                // Insert user data
                $query = "INSERT INTO ".$this->userTbl." SET oauth_provider = '".$userData['oauth_provider']."', oauth_uid = '".$userData['oauth_uid']."', first_name = '".$userData['first_name']."', last_name = '".$userData['last_name']."', email = '".$userData['email']."', gender = '".$userData['gender']."', locale = '".$userData['locale']."', picture = '".$userData['picture']."', link = '".$userData['link']."', created = NOW(), modified = NOW()";
                $insert = $this->db->query($query);
            }
            // Get the user data from the database
            $result = $this->db->query($prevQuery);
            $userData = $result->fetch_assoc();
        }*/
        // Return the user data
        //$_POST["password"]=md5($_POST["password"]);
        //$res = false;
		$_POST["status"]=1;
		$data=loginCheck(doSelect("*","ambit_customer",array('email'=>$userEmail)));
		if(!empty($data) && $data[0]['status']==1){
			foreach ($data as $key => $v) {
				$_SESSION["ac_id"]=$v["ac_id"];
				$_SESSION["name"]=$v["name"];
				//echo '1 || ';
				//Add Cart Details
				
				if(isset($_SESSION["add2cart"]) && trim($_SESSION["add2cart"])!="")												{
			    $cart_details=explode("//",$_SESSION["add2cart"]);
				foreach($cart_details as $key1=>$val){
					$pro_id=explode("||",$val);
					$price			=currency_price(currency($pro_id[0]),trim(getPrice($pro_id[0]))*trim($pro_id[1]));
					$discount		=currency_price(currency($pro_id[0]),trim(getDiscount($pro_id[0]))*trim($pro_id[1]));
					$tax			=currency_price(currency($pro_id[0]),trim(getTax($pro_id[0]))*trim($pro_id[1]));
					$shipping_cost	=currency_price(currency($pro_id[0]),trim(getShippingCost($pro_id[0]))*trim($pro_id[1]));
					$field			=array("aad_cart_ac_id"=>$v["ac_id"],"aad_cart_apa_id"=>$pro_id[0],"currency"=>put_currency(),"price"=>$price,"discount"=>$discount,"tax"=>$tax,"shipping_cost"=>$shipping_cost,"quantity"=>$pro_id[1]);
				    doInsert($field,'ambit_add2cart');
				}
			    unset($_SESSION["add2cart"]);
			}
			}
       // $userDetails=getDetails(doSelect("name","ambit_customer",array("ac_id"=>$id)));
		}
        return $data;
    }
   
}
