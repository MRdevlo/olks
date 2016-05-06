<?php
require($_SERVER["DOCUMENT_ROOT"] . "config.php");
  class func
  {
    public function mysql_con ()
    {
    require($_SERVER["DOCUMENT_ROOT"] . "config.php");
			$mysqli = new mysqli($config["dbserver"], $config["dbuser"], $config["dbpassword"], $config["dbname"]);
			if ($mysqli->connect_error) {
			
			} else {
				return $mysqli;
			}
		}
		public function aktiv($key, $hash){
	$identifier = str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789");	require($_SERVER["DOCUMENT_ROOT"] . "config.php");
				$ts = time();
			$lip = $_SERVER['REMOTE_ADDR'];
			$mysqli = $this->mysql_con();
			$key = $mysqli->real_escape_string($key);
			$abfrage = "SELECT * FROM `" . $config["dbprefix"] . "_key` WHERE `key` = '$key';";
			$res = $mysqli->query($abfrage);
			if ( $res->num_rows > 0){
			$row = $res->fetch_object();
			if ($row->activations >= $row->licens_counter)
			{
			return 300;
			}
			$key_id = $row->ID;
			$sw_id = $row->software;
			 $abfrage ="SELECT * FROM `" . $config["dbprefix"] . "_hash` WHERE `Software_ID` = '$sw_id' AND `hash` = '$hash'";
			 $res = $mysqli->query($abfrage);
			 	if ($res->num_rows > 0){
			 $abfrage ="INSERT INTO `" . $config["dbprefix"] . "_Identifier` (`Key_ID`, `Identifier`) VALUE ('$key_id', '$identifier'); ";
			 $abfrage .= "UPDATE `" . $config["dbprefix"] . "_key` SET `activations` =`activations` + 1 , `last_aktivation` = '$ts', `last_IP` = '$lip' WHERE `key` = '$key';";
			 if ($mysqli->multi_query($abfrage)){
			 return $identifier;
			 } else {
				return false;
			}
			} else {
				return 200;
			}
			} else {
				return 300;
			}
		}
		public function login($user, $password){
		if (!isset($_SESSION)){
		session_start();
		}
		require($_SERVER["DOCUMENT_ROOT"] . "config.php");
		$mysqli = $this->mysql_con();
		$user = $mysqli->real_escape_string($user);
		$table = $config["dbprefix"] . "_user";
		$abfrage = "SELECT * FROM `$table` WHERE `username` = '$user'";
		if ($res = $mysqli->query($abfrage)){
		$row = $res->fetch_object();
		if (password_verify($password, $row->password)){
		$_SESSION["User_ID"] = $row->ID;
		$_SESSION["Username"] = $row->username;
		 return true;
		} else {
		 return 0;
		}
		} else {
		return $mysqli->error;
		}
				
		}
		public function get_key()
		{
		require($_SERVER["DOCUMENT_ROOT"] . "config.php");
		$mysqli = $this->mysql_con();
		$table = $config["dbprefix"] . "_key";
		$abfrage = "SELECT * FROM `$table`";
		if ($res = $mysqli->query($abfrage)){
		$i = 0;
		while ($row = $res->fetch_object()) {
		$conte[$i]["ID"] = $row->ID;
		$conte[$i]["key"] =  $row->key;
		$conte[$i]["activations"] = $row->activations ;
		$conte[$i]["licens_counter"] = $row->licens_counter ;
		$i ++;
		}
		return $conte;
		} 
		echo $mysqli->error;
		exit;
		}
		public function get_software()
		{
		require($_SERVER["DOCUMENT_ROOT"] . "config.php");
		$mysqli = $this->mysql_con();
		$table = $config["dbprefix"] . "_software";
		$abfrage = "SELECT * FROM `$table`";
		if ($res = $mysqli->query($abfrage)){
		$i = 0;
		while ($row = $res->fetch_object()) {
		$conte[$i]["ID"] = $row->ID;
		$conte[$i]["software"] =  $row->software;
		$conte[$i]["Hash"] = $row->Hash ;
		$conte[$i]["key_prefix"] = $row->key_prefix ;
		$i ++;
		}
		return $conte;
		} 
		echo $mysqli->error;
		exit;
		}
		
		public function get_hash()
		{
		require($_SERVER["DOCUMENT_ROOT"] . "config.php");
		$mysqli = $this->mysql_con();
		$table = $config["dbprefix"] . "_hash";
		$abfrage = "SELECT * FROM `$table`";
		if ($res = $mysqli->query($abfrage)){
		$i = 0;
		while ($row = $res->fetch_object()) {
		$conte[$i]["ID"] = $row->ID;
		$conte[$i]["hash"] =  $row->hash;
		$conte[$i]["Software_ID"] = $row->Software_ID ;
		$i ++;
		}
		return $conte;
		} 
		echo $mysqli->error;
		exit;
		}
		
		public function get_user()
		{
		require($_SERVER["DOCUMENT_ROOT"] . "config.php");
		$mysqli = $this->mysql_con();
		$table = $config["dbprefix"] . "_user";
		$abfrage = "SELECT * FROM `$table`";
		if ($res = $mysqli->query($abfrage)){
		$i = 0;
		while ($row = $res->fetch_object()) {
		$conte[$i]["ID"] = $row->ID;
		$conte[$i]["name"] =  $row->username ;
		$i ++;
		}
		return $conte;
		} 
		echo $mysqli->error;
		exit;
		}
		public function get_group()
		{
		require($_SERVER["DOCUMENT_ROOT"] . "config.php");
		$mysqli = $this->mysql_con();
		$table = $config["dbprefix"] . "_group";
		$abfrage = "SELECT * FROM `$table`";
		if ($res = $mysqli->query($abfrage)){
		$i = 0;
		while ($row = $res->fetch_object()) {
		$conte[$i]["groupID"] = $row->groupID;
		$conte[$i]["groupName"] =  $row->groupName ;
		$i ++;
		}
		return $conte;
		} 
		echo $mysqli->error;
		exit;
		}
		public function get_user_group($userID)
		{
		require($_SERVER["DOCUMENT_ROOT"] . "config.php");
		$mysqli = $this->mysql_con();
		$table = $config["dbprefix"] . "_user";
		$abfrage = "SELECT * FROM `$table` WHERE `ID` = '$userID'";
		if ($res = $mysqli->query($abfrage)){
		$row = $res->fetch_object();
		return $row->groupID;
		} 
		echo $mysqli->error;
		exit;
		}
		
		 public function get_group_user($groupID)
		{
		require($_SERVER["DOCUMENT_ROOT"] . "config.php");
		$mysqli = $this->mysql_con();
		$table = $config["dbprefix"] . "_user";
		$abfrage = "SELECT * FROM `$table` WHERE `groupID` = '$groupID'";
		if ($res = $mysqli->query($abfrage)){
		$i = 0;
		while ($row = $res->fetch_object()) {
		$conte[$i]["ID"] = $row->ID;
		$conte[$i]["name"] =  $row->username ;
		$i ++;
		}
		return $conte;
		} 
		echo $mysqli->error;
		exit;
		}
		
		public function set_key($sw, $licens, $lt)
		{
		require($_SERVER["DOCUMENT_ROOT"] . "config.php");
		$mysqli = $this->mysql_con();
		$table = $config["dbprefix"] . "_key";
		$soft = $this->get_software();
		for ($i = 0 ; $i < count($soft) ; $i++){
		if ($soft[$i]["ID"] == $sw){
		$key_prefix = $soft[$i]["key_prefix"];
		}
		}
		$key = str_split( str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"), 5 );
		$key_in = $key_prefix . "-" . $key[0] . '-' . $key[1] . '-' . $key[2] . '-' . $key[3] ;
		
		$abfrage = "INSERT INTO `$table` (`key`, `software`, `licens_counter`, `Life_Time`) VALUE ('$key_in', '$sw', '$licens', '$lt')";
		if ($res = $mysqli->query($abfrage)){
		return true;
		} 
		return $mysqli->error;
		}
		public function set_software($name, $prefix)
		{
		require($_SERVER["DOCUMENT_ROOT"] . "config.php");
		$mysqli = $this->mysql_con();
		$table = $config["dbprefix"] . "_software";
		
		$abfrage = "INSERT INTO `$table` (`software`, `key_prefix`) VALUE ('$name', '$prefix')";
		if ($res = $mysqli->query($abfrage)){
		return true;
		} 
		return $mysqli->error;
		}
		
		public function set_user($user, $password)
		{
		require($_SERVER["DOCUMENT_ROOT"] . "config.php");
		$mysqli = $this->mysql_con();
		$pw = password_hash($password, PASSWORD_BCRYPT) ;
		$table = $config["dbprefix"] . "_user";
		
		$abfrage = "INSERT INTO `$table` (`username`, `password`) VALUE ('$user', '$pw')";
		if ($res = $mysqli->query($abfrage)){
		return true;
		} 
		return $mysqli->error;
		}
		public function set_hash($id, $md5sum)
		{
		require($_SERVER["DOCUMENT_ROOT"] . "config.php");
		$mysqli = $this->mysql_con();
		$table = $config["dbprefix"] . "_hash";
		
		$abfrage = "INSERT INTO `$table` (`hash`, `Software_ID`) VALUE ('$md5sum', '$id')";
		if ($res = $mysqli->query($abfrage)){
		return true;
		} 
		return $mysqli->error;
		}
		
		public function set_group_user($user, $groupid)
		{
		require($_SERVER["DOCUMENT_ROOT"] . "config.php");
		$mysqli = $this->mysql_con();
		$table = $config["dbprefix"] . "_user";
		
		$abfrage = "UPDATE `$table` SET `groupID` = '$groupid' WHERE `ID` = '$user'";
		if ($res = $mysqli->query($abfrage)){
		return true;
		} 
		return $mysqli->error;
		}
		
		public function del_user($id){
		require($_SERVER["DOCUMENT_ROOT"] . "config.php");
		$mysqli = $this->mysql_con();
		 $table = $config["dbprefix"] . "_user";
		 $abfrage = "DELETE FROM  `$table` WHERE `ID` = '$id'";
		if ($res = $mysqli->query($abfrage)){
		return true;
		} 
		return $mysqli->error;
		}
		public function del_software($id){
		require($_SERVER["DOCUMENT_ROOT"] . "config.php");
		$mysqli = $this->mysql_con();
		 $table = $config["dbprefix"] . "_software";
		 $abfrage = "DELETE FROM  `$table` WHERE `ID` = '$id'";
		if ($res = $mysqli->query($abfrage)){
		return true;
		} 
		return $mysqli->error;
		}
		
		public function del_hash($id){
		require($_SERVER["DOCUMENT_ROOT"] . "config.php");
		$mysqli = $this->mysql_con();
		 $table = $config["dbprefix"] . "_hash";
		 $abfrage = "DELETE FROM  `$table` WHERE `ID` = '$id'";
		if ($res = $mysqli->query($abfrage)){
		return true;
		} 
		return $mysqli->error;
		}
		
	/*	public function check_lccount()
		{
		 require($_SERVER["DOCUMENT_ROOT"] . "config.php");
		$mysqli = $this->mysql_con();
		 $table = $config["dbprefix"] . "_key";
		 $abfrage "SELECT * FROM `$table` WHERE `activations` > `licens_counter` ";
		 if ($res = $mysqli->query($abfrage)){
		$belltxt = "";
		while ($row = $res->fetch_object())
		{
		$belltxt .= '<li>
                             <span class="label label-default">Alert Badge</span>
                        </li>'
		}
		} 
		return $mysqli->error;
		}*/
		public function get_rights($uid)
		{
		 require($_SERVER["DOCUMENT_ROOT"] . "config.php");
		$mysqli = $this->mysql_con();
		 $abfrage = "SELECT final.rightID, final.rightName, IF(SUM(final.hasRight)>=1, 1, 0) AS hasRight FROM (
    (SELECT r.rightID, r.rightName, IF(SUM(counter)>=1, 1, 0) AS hasRight
    FROM " . $config["dbprefix"] . "_rights r 
        LEFT JOIN 
            (SELECT rr.*, 1 AS counter
            FROM " . $config["dbprefix"] . "_group_rights rr, " . $config["dbprefix"] . "_user ar
            WHERE ar.groupID = rr.groupID
            AND ar.ID = '$uid') rr 
        ON r.rightID = rr.rightID
    GROUP BY r.rightID)

    UNION

    (SELECT r.rightID, r.rightName, a.adjustment AS hasRight
    FROM " . $config["dbprefix"] . "_rights r, " . $config["dbprefix"] . "_user_rights_adjust a
    WHERE   r.rightID = a.rightID
        AND a.accountID = 1)
    ) AS final
GROUP BY final.rightID";
if ($res = $mysqli->query($abfrage)){
		 while ($row = $res->fetch_object()) {
		$conte[$row->rightName]["rightID"] =  $row->rightID;
		$conte[$row->rightName]["hasRight"] = $row->hasRight ;
		}
		return $conte;
		} 
		return $mysqli->error;
		}
		public function user_have_right($right)
		{
		 if (!isset($_SESSION)){
		session_start();
		}
		 
		 $uid = $_SESSION["User_ID"];
		 $resright = $this->get_rights($uid);
		 if ($resright[$right]["hasRight"] == 1)
		 {
		  return true;
		 } else {
		  return false;
		 }
		}
}
?>