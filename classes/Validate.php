<?php
require_once('Email.php');
require_once('Employee.php');
require_once('Tools.php');

/**
  * Validation class, Validate.php
  * Check fields and data validity
  * @category classes
  *
  * @author John Mitros
  * @copyright John Mitros
  *
  */

class Validate
{
    public static $empty;
    public static $errors;
    public static $rowsAffected;
    
 	/**
	* Check for e-mail validity
	*
	* @param string $email e-mail address to validate
	* @return boolean Validity is ok or not
	*/
	static public function isEmail($email)
    {
    	return preg_match('/^[a-z0-9!#$%&\'*+\/=?^`{}|~_-]+[.a-z0-9!#$%&\'*+\/=?^`{}|~_-]*@[a-z0-9]+[._a-z0-9-]*\.[a-z0-9]+$/ui', $email);
    }

	/**
	* Check for MD5 string validity
	*
	* @param string $md5 MD5 string to validate
	* @return boolean Validity is ok or not
	*/
	static public function isMd5($md5)
	{
		return preg_match('/^[a-z0-9]{32}$/ui', $md5);
	}

	/**
	* Check for SHA1 string validity
	*
	* @param string $sha1 SHA1 string to validate
	* @return boolean Validity is ok or not
	*/
	static public function isSha1($sha1)
	{
		return preg_match('/^[a-z0-9]{40}$/ui', $sha1);
	}

	/**
	* Check for a float number validity
	*
	* @param float $float Float number to validate
	* @return boolean Validity is ok or not
	*/
    static public function isFloat($float)
    {
		return strval(floatval($float)) == strval($float);
	}
	
    static public function isUnsignedFloat($float)
    {
			return strval(floatval($float)) == strval($float) AND $float >= 0;
	}

	/**
	* Check for a float number validity
	*
	* @param float $float Float number to validate
	* @return boolean Validity is ok or not
	*/
    static public function isOptFloat($float)
    {
		return empty($float) OR self::isFloat($float);
	}

	/**
	* Check for an image size validity
	*
	* @param string $size Image size to validate
	* @return boolean Validity is ok or not
	*/
	static public function isImageSize($size)
	{
		return preg_match('/^[0-9]{1,4}$/ui', $size);
	}

	static public function isOptId($id)
	{
		return empty($id) OR self::isUnsignedId($id);
	}

	/**
	* Check for name validity
	*
	* @param string $name Name to validate
	* @return boolean Validity is ok or not
	*/
	static public function isName($name)
	{
		return preg_match('/^[^0-9!<>,;?=+()@#"�{}_$%:]*$/ui', stripslashes($name));
	}

	/**
	* Check for sender name validity
	*
	* @param string $mailName Sender name to validate
	* @return boolean Validity is ok or not
	*/
	static public function isMailName($mailName)
	{
		return preg_match('/^[^<>;=#{}]*$/ui', $mailName);
	}

	/**
	* Check for e-mail subject validity
	*
	* @param string $mailSubject e-mail subject to validate
	* @return boolean Validity is ok or not
	*/
	static public function isMailSubject($mailSubject)
	{
		return preg_match('/^[^<>;{}]*$/ui', $mailSubject);
	}

	/**
	* Check for icon file validity
	*
	* @param string $icon Icon filename to validate
	* @return boolean Validity is ok or not
	*/
	static public function isIconFile($icon)
	{
		return preg_match('/^[a-z0-9_-]+\.[gif|jpg|jpeg|png]$/ui', $icon);
	}

	/**
	* Check for ico file validity
	*
	* @param string $icon Icon filename to validate
	* @return boolean Validity is ok or not
	*/
	static public function isIcoFile($icon)
	{
		return preg_match('/^[a-z0-9_-]+\.ico$/ui', $icon);
	}

	/**
	* Check for image type name validity
	*
	* @param string $type Image type name to validate
	* @return boolean Validity is ok or not
	*/
	static public function isImageTypeName($type)
	{
		return preg_match('/^[a-z0-9_ -]+$/ui', $type);
	}

	/**
	* Check for price validity
	*
	* @param string $price Price to validate
	* @return boolean Validity is ok or not
	*/
	static public function isPrice($price)
	{
		return preg_match('/^[0-9]{1,10}(\.[0-9]{1,9})?$/ui', $price);
	}

	/**
	* Check for gender code (ISO) validity
	*
	* @param string $isoCode Gender code (ISO) to validate
	* @return boolean Validity is ok or not
	*/
	static public function isGenderName($genderName)
	{
		return preg_match('/^[a-z.]+$/ui', $genderName);
	}

	/**
	* Check for a message validity
	*
	* @param string $message Message to validate
	* @return boolean Validity is ok or not
	*/
	static public function isMessage($message)
	{
		return preg_match('/^([^<>{}]|<br \/>)*$/ui', $message);
	}

	/**
	* Check for a country name validity
	*
	* @param string $name Country name to validate
	* @return boolean Validity is ok or not
	*/
	static public function isCountryName($name)
	{
		return preg_match('/^[a-z -]+$/ui', $name);
	}
    
    /**
	* Check for a varchar name validity
	*
	* @param string $name Field name to validate
	* @return boolean Validity is ok or not
	*/
	static public function isVarchar($varchar)
	{
		return preg_match('/^[\p{L}\s0-9]{0,50}$/ui', $varchar);
	}
    
    static public function isText($text)
	{
		return preg_match('/^[\p{L}\s]{0,300}$/ui', $text);
	}

	/**
	* Check for a link (url-rewriting only) validity
	*
	* @param string $link Link to validate
	* @return boolean Validity is ok or not
	*/
	static public function isLinkRewrite($link)
	{
		return empty($link) OR preg_match('/^[_a-z0-9-]+$/ui', $link);
	}

	/**
	* Check for a postal address validity
	*
	* @param string $address Address to validate
	* @return boolean Validity is ok or not
	*/   
    static public function isAddress($address)
	{
	   //return preg_match('/^[A-Z a-z ]{0,50}$/ui', $address);
       return preg_match('/^[\p{L}\s ]{0,50}$/ui', $address);
	}
    
    static public function isActiveName($activeName)
	{
	   //return preg_match('/^[A-Za-z]{0,50}$/ui', $activeName);
       return preg_match('/^[\p{L}\s]{0,50}$/ui', $activeName);
	}
    
    static public function isCharName($charName)
	{
	   return preg_match('/^[A-Z a-z]{0,50}$/ui', $charName);
	}

	/**
	* Check for city name validity
	*
	* @param string $city City name to validate
	* @return boolean Validity is ok or not
	*/
	static public function isCityName($city)
	{
		return preg_match('/^[^!<>;?=+@#"�{}_$%]*$/ui', $city);
	}

	/**
	* Check for search query validity
	*
	* @param string $search Query to validate
	* @return boolean Validity is ok or not
	*/
	static public function isValidSearch($search)
	{
		return preg_match('/^[^<>;=#{}]{0,64}$/ui', $search);
	}

	/**
	* Check for standard name validity
	*
	* @param string $name Name to validate
	* @return boolean Validity is ok or not
	*/
	static public function isGenericName($name)
	{
		return empty($name) OR preg_match('/^[^<>;=#{}]*$/ui', $name);
	}

	/**
	* Check for HTML field validity (no XSS please !)
	*
	* @param string $html HTML field to validate
	* @return boolean Validity is ok or not
	*/
	static public function isCleanHtml($html)
	{
		$jsEvent = 'onmousedown|onmousemove|onmmouseup|onmouseover|onmouseout|onload|onunload|onfocus|onblur|onchange|onsubmit|ondblclick|onclick|onkeydown|onkeyup|onkeypress|onmouseenter|onmouseleave';
		return (!preg_match('/<[ \t\n]*script/ui', $html) && !preg_match('/<.*('.$jsEvent.')[ \t\n]*=/ui', $html)  && !preg_match('/.*script\:/ui', $html));
	}

	/**
	* Check for password validity
	*
	* @param string $passwd Password to validate
	* @return boolean Validity is ok or not
	*/
	static public function isPasswd($passwd, $size = 5)
	{
		return preg_match('/^[.a-z_0-9-!@#$%\^&*()]{'.$size.',32}$/ui', $passwd);
	}

	static public function isPasswdAdmin($passwd)
	{
		return self::isPasswd($passwd, 8);
	}

	/**
	* Check for configuration key validity
	*
	* @param string $configName Configuration key to validate
	* @return boolean Validity is ok or not
	*/
	static public function isConfigName($configName)
	{
		return preg_match('/^[a-z_0-9-]+$/ui', $configName);
	}

	/**
	* Check for date validity
	*
	* @param string $date Date to validate
	* @return boolean Validity is ok or not
	*/
	static public function isDate($date)
	{
		if (!preg_match('/^([0-9]{4})-((0?[1-9])|(1[0-2]))-((0?[1-9])|([1-2][0-9])|(3[01]))( [0-9]{2}:[0-9]{2}:[0-9]{2})?$/ui', $date, $matches))
			return false;
		return checkdate(intval($matches[2]), intval($matches[5]), intval($matches[0]));
	}

	/**
	* Check for birthDate validity
	*
	* @param string $date birthdate to validate
	* @return boolean Validity is ok or not
	*/
	static public function isBirthDate($date)
	{
	 	if (empty($date) || $date == '0000-00-00')
	 		return true;
	 	if (preg_match('/^([0-9]{4})-((0?[1-9])|(1[0-2]))-((0?[1-9])|([1-2][0-9])|(3[01]))( [0-9]{2}:[0-9]{2}:[0-9]{2})?$/ui', $date, $birthDate)) {
			 if ($birthDate[1] >= date('Y') - 9)
	 			return false;
	 		return true;
	 	}
		return false;
	}

	/**
	* Check for boolean validity
	*
	* @param boolean $bool Boolean to validate
	* @return boolean Validity is ok or not
	*/
	static public function isBool($bool)
	{
		return is_null($bool) OR is_bool($bool) OR preg_match('/^[0|1]{1}$/ui', $bool);
	}

	/**
	* Check for phone number validity
	*
	* @param string $phoneNumber Phone number to validate
	* @return boolean Validity is ok or not
	*/
	static public function isPhoneNumber($phoneNumber)
	{
		return preg_match('/^[+0-9.()-]{17}$/ui', $phoneNumber);
	}

	/**
	* Check for postal code validity
	*
	* @param string $postcode Postal code to validate
	* @return boolean Validity is ok or not
	*/    
    static public function isPostCode($postcode)
	{
		return preg_match('/^[0-9]{5}$/ui', $postcode);
	}
    
    static public function isZipCode($zipcode)
	{
		return preg_match('/^[0-9]{1,4}$/ui', $zipcode);
	}

	/**
	* Check for table or identifier validity
	* Mostly used in database for ordering : ASC / DESC
	*
	* @param string $orderWay Keyword to validate
	* @return boolean Validity is ok or not
	*/
	static public function isOrderWay($orderWay)
	{
		return ($orderWay === 'ASC' | $orderWay === 'DESC' | $orderWay === 'asc' | $orderWay === 'desc');
	}

	/**
	* Check for table or identifier validity
	* Mostly used in database for table names and id_table
	*
	* @param string $table Table/identifier to validate
	* @return boolean Validity is ok or not
	*/
	static public function isTableOrIdentifier($table)
	{
		return preg_match('/^[a-z0-9_-]+$/ui', $table);
	}

	/**
	* Check for an integer validity
	*
	* @param integer $id Integer to validate
	* @return boolean Validity is ok or not
	*/
	static public function isInt($value)
	{
		return ((string)(int)$value === (string)$value OR $value === false);
	}

	/**
	* Check for an integer validity (unsigned)
	*
	* @param integer $id Integer to validate
	* @return boolean Validity is ok or not
	*/
	static public function isUnsignedInt($value)
	{
		return (self::isInt($value) AND $value < 4294967296 AND $value >= 0);
	}

	/**
	* Check for an integer validity (unsigned)
	* Mostly used in database for auto-increment
	*
	* @param integer $id Integer to validate
	* @return boolean Validity is ok or not
	*/
	static public function isUnsignedId($id)
	{
		return self::isUnsignedInt($id); /* Because an id could be equal to zero when there is no association */
	}

	static public function isNullOrUnsignedId($id)
	{
		return is_null($id) OR self::isUnsignedId($id);
	}

	/**
	* Check object validity
	*
	* @param integer $object Object to validate
	* @return boolean Validity is ok or not
	*/
	static public function isLoadedObject($object)
	{
		return is_object($object) AND $object->id;
	}

	/**
	* Check url validity
	*
	* @param string $url to validate
	* @return boolean Validity is ok or not
	*/
	static public function isUrl($url)
	{
		return preg_match('/^([[:alnum:]]|[:#%&_=\(\)\.\? \+\-@\/])+$/ui', $url);
	}

	/**
	* Check absolute url validity
	*
	* @param string $url to validate
	* @return boolean Validity is ok or not
	*/
	static public function isAbsoluteUrl($url)
	{
		if (!empty($url))
			return preg_match('/^https?:\/\/([[:alnum:]]|[:#%&_=\(\)\.\? \+\-@\/])+$/ui', $url);
		return true;
	}

	/**
	* Check for standard name file validity
	*
	* @param string $name Name to validate
	* @return boolean Validity is ok or not
	*/
	static public function isFileName($name)
	{
		return preg_match('/^[a-z0-9_.-]*$/ui', $name);
	}

	static public function isProtocol($protocol)
	{
		return preg_match('/^http(s?):\/\/$/ui', $protocol);
	}


	static public function isSubDomainName($subDomainName)
	{
		return preg_match('/^[[:alnum:]]*$/ui', $subDomainName);
	}
	
	/**
	* Check if the value is a sort direction value (DESC/ASC)
	*
	* @param char $value
	* @return boolean Validity is ok or not
	*/
	static public function IsSortDirection($value)
	{
		return (!is_null($value) AND ($value === 'ASC' OR $value === 'DESC'));
	}

	/**
	* Check if $data is a cookie object
	*
	* @param mixed $data to validate
	* @return bool
	*/
	static public function isCookie($data)
	{
		return (is_object($data) AND get_class($data) == 'Cookie');
	}

	/**
	* String display method validity
	*
	* @param string $data Data to validate
	* @return boolean Validity is ok or not
	*/
	static public function isString($data)
	{
		return is_string($data);
	}
    
    public static function patientValidation($postData)
    {
    self::$empty = "";
    self::$errors = "";
    $required = array("First_Name", "Last_Name", "Addmission_Date", "Birth_Date", "Blood_Group", "Address", "Address_Nr", "Post_Code", "Phone", "Insurance_Company", "Charges");
    
    foreach($postData as $key => $value)
    {
        if(in_array($key, $required))
        {
            if(empty($value))
            self::$empty .= "<b>".str_replace("_", " ", $key)."</b>"."<br />";
            elseif(!empty($value))
            {
                if($key == "First_Name" && !Validate::isActiveName($value))
                self::$errors .= "<b>First Name</b> is invalid<br />";
                if($key == "Last_Name" && !Validate::isActiveName($value))
                self::$errors .= "<b>Last Name</b> is invalid<br />";
                if($key == "Addmission_Date" && !Validate::isDate($value))
                self::$errors .=  "<b>Addmission Date</b> is invalid<br />";
                if($key == "Birth_Date" && !Validate::isDate($value))
                self::$errors .= "<b>Date of Birth</b> is invalid<br />";
                if($key == "Address" && !Validate::isAddress($value))
                self::$errors .= "<b>Address</b> is invalid<br />";
                if($key == "Address_Nr" && !Validate::isZipCode($value))
                self::$errors .= "<b>Address Nr.</b> must be a number up to 4 characters long <br />";
                if($key == "Post_Code" && !Validate::isPostCode($value))
                self::$errors .= "<b>Post Code</b> is invalid <br />";
                if($key == "Phone" && !Validate::isPhoneNumber($value))
                self::$errors .= "<b>Phone</b> must be in this format +2310.(XXX)-(XXX) <br />";
                if($key == "Insurance_Company" && !Validate::isActiveName($value))
                self::$errors .= "<b>Insurance Company</b> must be a string <br />";
                if($key == "Charges" && !Validate::isPrice($value))
                self::$errors .= "<b>Charges</b> must be a numeric value. For decimals use dots instead of commas <br />";
            }
        }

        if($key == "category" && $value == "Please select one")
        self::$empty .= "<b>".ucfirst($key)."</b><br />";
        if($key == "Civil_Status" && $value == "Please select one")
        self::$empty .= "<b>".str_replace("_", " ", $key)."</b><br />";
        if($key == "urgency" && $value == "Please select one")
        self::$empty .= "<b>".ucfirst($key)."</b><br />";
        if($key == "doctor" && $value == "Please select one")
        self::$empty .= "<b>".ucfirst($key)."</b><br />";
    }
    if(!empty(self::$empty) && sizeof(self::$empty) > 0)
    echo "<div class='ui-state-error ui-corner-all' style='padding: 0 .7em;'>
            <p>
            <span class='ui-icon ui-icon-alert' style='float: left; margin-right: .3em;'></span>
            Please provide information for the following empty fields <br /> <strong>".self::$empty."</strong> <br />
            </p>
          </div>";
    if(!empty(self::$errors) && sizeof(self::$errors) > 0)
    echo "<div class='ui-state-error ui-corner-all' style='padding: 0 .7em;'>
            <p>
            <span class='ui-icon ui-icon-alert' style='float: left; margin-right: .3em;'></span>
            Please correct the following errors and resubmit <br /> <strong>".self::$errors."</strong>
            </p>
          </div>";
    if(empty(self::$empty) && empty(self::$errors))
    self::$rowsAffected = DB::Execute("INSERT INTO `hms_support`.`patient` (`id_patient`, `id_category`, `id_lang`, `urgency`, `firstName`, `lastName`, `registrationDate`, `birthDate`, `sex`, `bloodGroup`, `civilStatus`, `address`, `postCode`,  `insuranceType`, `insuranceCompany`, `phone`, `diagnosis`,`id_doctor`,`charges`) 
    VALUES (NULL, '$_POST[category]', '$_POST[id_lang]', '$_POST[urgency]', '$_POST[First_Name]', '$_POST[Last_Name]', '$_POST[Addmission_Date]', '$_POST[Birth_Date]', '$_POST[sex]', '$_POST[Blood_Group]', '$_POST[Civil_Status]', '$_POST[Address]', '$_POST[Post_Code]', '$_POST[insuranceType]', '$_POST[Insurance_Company]', '$_POST[Phone]', '$_POST[diagnosis]', '$_POST[doctor]', '$_POST[Charges]')");
    
    if(self::$rowsAffected > 0)
    echo "<div class='ui-state-highlight ui-corner-all' style='margin-top: 20px; padding: 0 .7em;'>
         <p>
           <span class='ui-icon ui-icon-info' style='float: left; margin-right: .3em;'></span>
           Patient created successfuly. <strong> ".self::$rowsAffected ." </strong> row inserted.
         </p>
        </div>";
    }
    
    public static function doctorValidation($doctorData)
    {
    self::$empty = "";
    self::$errors = "";
    $required = array("First_Name", "Last_Name", "Employment_Date", "Release_Date", "Specialization", "Email", "Phone", "Salary");
    
    foreach($doctorData as $key => $value)
    {
        if(in_array($key, $required))
        {
            if(empty($value))
            self::$empty .= "<b>".str_replace("_", " ", $key)."</b>"."<br />";
            elseif(!empty($value))
            {
                if($key == "First_Name" && !Validate::isActiveName($value))
                self::$errors .= "<b>First Name</b> is invalid<br />";
                if($key == "Last_Name" && !Validate::isActiveName($value))
                self::$errors .= "<b>Last Name</b> is invalid<br />";
                if($key == "Employment_Date" && !Validate::isDate($value))
                self::$errors .=  "<b>Employment Date</b> is invalid<br />";
                if($key == "Release_Date" && !Validate::isDate($value))
                self::$errors .= "<b>Release Date</b> is invalid<br />";
                if($key == "Specialization" && !Validate::isActiveName($value))
                self::$errors .= "<b>Specialization</b> is invalid <br />";
				if($key == "Email" && !Validate::isEmail($value))
                self::$errors .= "<b>E-mail address</b> is invalid <br />";
                if($key == "Phone" && !Validate::isPhoneNumber($value))
                self::$errors .= "<b>Phone</b> must be in this format +2310.(XXX)-(XXX) <br />";
                if($key == "Salary" && !Validate::isPrice($value))
                self::$errors .= "<b>Salary</b> must be a numeric value. For decimals use dots instead of commas <br />";
            }
        }

        if($key == "department" && $value == "Please select one")
        self::$empty .= "<b>".ucfirst($key)."</b><br />";
        if($key == "Civil_Status" && $value == "Please select one")
        self::$empty .= "<b>".str_replace("_", " ", $key)."</b><br />";
    }
    if(!empty(self::$empty) && sizeof(self::$empty) > 0)
    echo "<div class='ui-state-error ui-corner-all' style='padding: 0 .7em;'>
            <p>
            <span class='ui-icon ui-icon-alert' style='float: left; margin-right: .3em;'></span>
            Please provide information for the following empty fields <br /> <strong>".self::$empty."</strong> <br />
            </p>
          </div>";
    if(!empty(self::$errors) && sizeof(self::$errors) > 0)
    echo "<div class='ui-state-error ui-corner-all' style='padding: 0 .7em;'>
            <p>
            <span class='ui-icon ui-icon-alert' style='float: left; margin-right: .3em;'></span>
            Please correct the following errors and resubmit <br /> <strong>".self::$errors."</strong>
            </p>
          </div>";
    if(empty(self::$empty) && empty(self::$errors))
    self::$rowsAffected = DB::Execute("INSERT INTO `hms_support`.`doctor` (`id_doctor`, `id_department`, `id_lang`, `doctorName`, `doctorSurname`, `specialization`, `employmentDate`, `releaseDate`, `salary`, `sex`, `civilStatus`, `phone`, `email`) 
    VALUES (NULL, '$_POST[department]', '$_POST[id_lang]', '$_POST[First_Name]', '$_POST[Last_Name]', '$_POST[Specialization]', '$_POST[Employment_Date]', '$_POST[Release_Date]', '$_POST[Salary]', '$_POST[sex]', '$_POST[Civil_Status]',  '$_POST[Phone]', '$_POST[Email]')");
    
    if(self::$rowsAffected > 0)
    echo "<div class='ui-state-highlight ui-corner-all' style='margin-top: 20px; padding: 0 .7em;'>
         <p>
           <span class='ui-icon ui-icon-info' style='float: left; margin-right: .3em;'></span>
           Doctor created successfuly. <strong> ".self::$rowsAffected ." </strong> row inserted.
         </p>
        </div>";
    }
    
     public static function vaccinationValidation($vaccinationData)
    {
    self::$empty = "";
    self::$errors = "";
    $required = array("Vaccination_Date");
    
    foreach($vaccinationData as $key => $value)
    {
        if(in_array($key, $required))
        {
            if(empty($value))
            self::$empty .= "<b>".str_replace("_", " ", $key)."</b>"."<br />";
            elseif(!empty($value))
            {
                if($key == "Vaccination_Date" && !Validate::isDate($value))
                self::$errors .=  "<b>Date</b> is invalid<br />";
            }
        }

        if($key == "doctor" && $value == "Please select one")
        self::$empty .= "<b>".ucfirst($key)."</b><br />";
        if($key == "patient" && $value == "Please select one")
        self::$empty .= "<b>".ucfirst($key)."</b><br />";
         if($key == "vaccination" && $value == "Please select one")
        self::$empty .= "<b>".ucfirst($key)."</b><br />";
    }
    if(!empty(self::$empty) && sizeof(self::$empty) > 0)
    echo "<div class='ui-state-error ui-corner-all' style='padding: 0 .7em;'>
            <p>
            <span class='ui-icon ui-icon-alert' style='float: left; margin-right: .3em;'></span>
            Please provide information for the following empty fields <br /> <strong>".self::$empty."</strong> <br />
            </p>
          </div>";
    if(!empty(self::$errors) && sizeof(self::$errors) > 0)
    echo "<div class='ui-state-error ui-corner-all' style='padding: 0 .7em;'>
            <p>
            <span class='ui-icon ui-icon-alert' style='float: left; margin-right: .3em;'></span>
            Please correct the following errors and resubmit <br /> <strong>".self::$errors."</strong>
            </p>
          </div>";
    if(empty(self::$empty) && empty(self::$errors))
    self::$rowsAffected = DB::Execute("INSERT INTO `hms_support`.`pvaccination` (`id_pvaccination`, `id_patient`, `id_doctor`, `id_lang`, `vaccinationDate`, `vaccine`) 
    VALUES (NULL, '$_POST[patient]', '$_POST[doctor]', '$_POST[id_lang]', '$_POST[Vaccination_Date]', '$_POST[vaccination]')");
    
    if(self::$rowsAffected > 0)
    echo "<div class='ui-state-highlight ui-corner-all' style='margin-top: 20px; padding: 0 .7em;'>
         <p>
           <span class='ui-icon ui-icon-info' style='float: left; margin-right: .3em;'></span>
           Vaccination created successfuly. <strong> ".self::$rowsAffected ." </strong> row inserted.
         </p>
        </div>";
    }
    
    public static function plabtestValidation($plabtestData)
    {
    self::$empty = "";
    self::$errors = "";
    $required = array("Test_Date", "Test_Cost");
    
    foreach($plabtestData as $key => $value)
    {
        if(in_array($key, $required))
        {
            if(empty($value))
            self::$empty .= "<b>".str_replace("_", " ", $key)."</b>"."<br />";
            elseif(!empty($value))
            {
                if($key == "Test_Date" && !Validate::isDate($value))
                self::$errors .=  "<b>Test Date</b> is invalid<br />";
                if($key == "Test_Cost" && !Validate::isPrice($value))
                self::$errors .=  "<b>Test Cost</b> must be a numeric value. In case of decimals use dots not commas<br />";
            }
        }

        if($key == "doctor" && $value == "Please select one")
        self::$empty .= "<b>".ucfirst($key)."</b><br />";
        if($key == "patient" && $value == "Please select one")
        self::$empty .= "<b>".ucfirst($key)."</b><br />";
         if($key == "Test_Type" && $value == "Please select one")
        self::$empty .= "<b>".str_replace("_", " ", $key)."</b><br />";
    }
    if(!empty(self::$empty) && sizeof(self::$empty) > 0)
    echo "<div class='ui-state-error ui-corner-all' style='padding: 0 .7em;'>
            <p>
            <span class='ui-icon ui-icon-alert' style='float: left; margin-right: .3em;'></span>
            Please provide information for the following empty fields <br /> <strong>".self::$empty."</strong> <br />
            </p>
          </div>";
    if(!empty(self::$errors) && sizeof(self::$errors) > 0)
    echo "<div class='ui-state-error ui-corner-all' style='padding: 0 .7em;'>
            <p>
            <span class='ui-icon ui-icon-alert' style='float: left; margin-right: .3em;'></span>
            Please correct the following errors and resubmit <br /> <strong>".self::$errors."</strong>
            </p>
          </div>";
    if(empty(self::$empty) && empty(self::$errors))
    self::$rowsAffected = DB::Execute("INSERT INTO `hms_support`.`plabtest` (`id_plabtest`, `id_patient`, `id_doctor`, `id_lang`, `testType`, `testDate`, `testCost`, `result`) 
    VALUES (NULL, '$_POST[patient]', '$_POST[doctor]', '$_POST[id_lang]', '$_POST[Test_Type]', '$_POST[Test_Date]', '$_POST[Test_Cost]', '$_POST[result]')");
    
    if(self::$rowsAffected > 0)
    echo "<div class='ui-state-highlight ui-corner-all' style='margin-top: 20px; padding: 0 .7em;'>
         <p>
           <span class='ui-icon ui-icon-info' style='float: left; margin-right: .3em;'></span>
           Lab test created successfuly. <strong> ".self::$rowsAffected ." </strong> row inserted.
         </p>
        </div>";
    }
    
    public static function prescriptionValidation($prescriptionData)
    {
    self::$empty = "";
    self::$errors = "";
    $required = array("Prescription_Date", "Prescription_");
    
    foreach($prescriptionData as $key => $value)
    {
        if(in_array($key, $required))
        {
            if(empty($value))
            self::$empty .= "<b>".str_replace("_", " ", $key)."</b>"."<br />";
            elseif(!empty($value))
            {
                if($key == "Prescription_Date" && !Validate::isDate($value))
                self::$errors .=  "<b>Prescription Date</b> is invalid<br />";
                if($key == "Prescription_" && !Validate::isText($value))
                self::$errors .=  "<b>Prescription</b> must contain only alphabetical characters up to 300<br />";
            }
        }

        if($key == "doctor" && $value == "Please select one")
        self::$empty .= "<b>".ucfirst($key)."</b><br />";
        if($key == "patient" && $value == "Please select one")
        self::$empty .= "<b>".ucfirst($key)."</b><br />";
    }
    if(!empty(self::$empty) && sizeof(self::$empty) > 0)
    echo "<div class='ui-state-error ui-corner-all' style='padding: 0 .7em;'>
            <p>
            <span class='ui-icon ui-icon-alert' style='float: left; margin-right: .3em;'></span>
            Please provide information for the following empty fields <br /> <strong>".self::$empty."</strong> <br />
            </p>
          </div>";
    if(!empty(self::$errors) && sizeof(self::$errors) > 0)
    echo "<div class='ui-state-error ui-corner-all' style='padding: 0 .7em;'>
            <p>
            <span class='ui-icon ui-icon-alert' style='float: left; margin-right: .3em;'></span>
            Please correct the following errors and resubmit <br /> <strong>".self::$errors."</strong>
            </p>
          </div>";
    if(empty(self::$empty) && empty(self::$errors))
    self::$rowsAffected = DB::Execute("INSERT INTO `hms_support`.`prescription` (`id_prescription`, `id_patient`, `id_doctor`, `id_lang`, `prescriptionDate`, `product`, `prescription`) 
    VALUES (NULL, '$_POST[patient]', '$_POST[doctor]', '$_POST[id_lang]', '$_POST[Prescription_Date]', '$_POST[product]', '$_POST[Prescription_]')");
    
    if(self::$rowsAffected > 0)
    echo "<div class='ui-state-highlight ui-corner-all' style='margin-top: 20px; padding: 0 .7em;'>
         <p>
           <span class='ui-icon ui-icon-info' style='float: left; margin-right: .3em;'></span>
           Prescription created successfuly. <strong> ".self::$rowsAffected ." </strong> row inserted.
         </p>
        </div>";
    }
    
    public static function purchaseValidation($parchaseData)
    {
    self::$empty = "";
    self::$errors = "";
    $required = array("Purchase_Date", "Quantity_", "Unit_Price");
    
    foreach($parchaseData as $key => $value)
    {
        if(in_array($key, $required))
        {
            if(empty($value))
            self::$empty .= "<b>".str_replace("_", " ", $key)."</b>"."<br />";
            elseif(!empty($value))
            {
                if($key == "Purchase_Date" && !Validate::isDate($value))
                self::$errors .=  "<b>Purchase Date</b> is invalid<br />";
                if($key == "Quantity_" && !Validate::isInt($value))
                self::$errors .=  "<b>Quantity</b> must be an integer value<br />";
                if($key == "Unit_Price" && !Validate::isPrice($value))
                self::$errors .=  "<b>Unit Price</b> must be numeric value. For decimals use dots not commas<br />";
            }
        }
        
        if($key == "supplier" && $value == "Please select one")
        self::$empty .= "<b>".ucfirst($key)."</b><br />";
        if($key == "Pharmacy_Product" && $value == "Please select one")
        self::$empty .= "<b>".str_replace("_", " ", $key)."</b><br />";
        
        if($key == "Discount" && !empty($value))
        {
            if(!Validate::isPrice($value))
            self::$errors .= "<b>".$key."</b> must be a numeric value<br /><br />";
        }
        
        if($key == "Tax" && !empty($value))
        {
            if(!Validate::isPrice($value))
            self::$errors .= "<b>".$key."</b> must be a numeric value<br /><br />";
        }
    }
    if(!empty(self::$empty) && sizeof(self::$empty) > 0)
    echo "<div class='ui-state-error ui-corner-all' style='padding: 0 .7em;'>
            <p>
            <span class='ui-icon ui-icon-alert' style='float: left; margin-right: .3em;'></span>
            Please provide information for the following empty fields <br /> <strong>".self::$empty."</strong> <br />
            </p>
          </div>";
    if(!empty(self::$errors) && sizeof(self::$errors) > 0)
    echo "<div class='ui-state-error ui-corner-all' style='padding: 0 .7em;'>
            <p>
            <span class='ui-icon ui-icon-alert' style='float: left; margin-right: .3em;'></span>
            Please correct the following errors and resubmit <br /> <strong>".self::$errors."</strong>
            </p>
          </div>";
    if(empty(self::$empty) && empty(self::$errors))
    self::$rowsAffected = DB::Execute("INSERT INTO `hms_support`.`pharmacy_pur` (`id_pharmacy_pur`, `id_lang`, `purchaseDate`, `supplier`, `pharmacyProduct`, `id_doctor`, `quantity`, `unitPrice`, `status`, `discount`, `tax`) 
    VALUES (NULL, '$_POST[id_lang]', '$_POST[Purchase_Date]', '$_POST[supplier]', '$_POST[Pharmacy_Product]', '$_POST[doctor]', '$_POST[Quantity_]', '$_POST[Unit_Price]', '$_POST[status]', '$_POST[Discount]', '$_POST[Tax]')");
    
    if(self::$rowsAffected > 0)
    echo "<div class='ui-state-highlight ui-corner-all' style='margin-top: 20px; padding: 0 .7em;'>
         <p>
           <span class='ui-icon ui-icon-info' style='float: left; margin-right: .3em;'></span>
           Purchase created successfuly. <strong> ".self::$rowsAffected ." </strong> row inserted.
         </p>
        </div>";
    }
    
    public static function employeeValidation($employeeData)
    {
    self::$empty = "";
    self::$errors = "";
    $required = array("First_Name", "Last_Name", "Password", "Email", "Profile");
    
    foreach($employeeData as $key => $value)
    {
        if(in_array($key, $required))
        {
            if(empty($value))
            self::$empty .= "<b>".str_replace("_", " ", $key)."</b>"."<br />";
            elseif(!empty($value))
            {
                if($key == "First_Name" && !Validate::isActiveName($value))
                self::$errors .= "<b>First Name</b> is invalid<br />";
                if($key == "Last_Name" && !Validate::isActiveName($value))
                self::$errors .= "<b>Last Name</b> is invalid<br />";
                if($key == "Password" && !Validate::isPasswdAdmin($value))
                self::$errors .= "<b>Password</b> must be at least 8 characters long<br />";
                if($key == "Email" && !Validate::isEmail($value))
                self::$errors .=  "<b>E-mail address</b> is invalid<br />";
                if($key == "Email" && Employee::employeeExists($value))
                self::$errors .=  "There is already a registered user with <b> ".$value." </b> E-mail address<br />";
                
            }
        }

        if($key == "Profile" && $value == "Please select one")
        self::$empty .= "<b>".$key."</b><br />";
    }
    if(!empty(self::$empty) && sizeof(self::$empty) > 0)
    echo "<div class='ui-state-error ui-corner-all' style='padding: 0 .7em;'>
            <p>
            <span class='ui-icon ui-icon-alert' style='float: left; margin-right: .3em;'></span>
            Please provide information for the following empty fields <br /> <strong>".self::$empty."</strong> <br />
            </p>
          </div>";
    if(!empty(self::$errors) && sizeof(self::$errors) > 0)
    echo "<div class='ui-state-error ui-corner-all' style='padding: 0 .7em;'>
            <p>
            <span class='ui-icon ui-icon-alert' style='float: left; margin-right: .3em;'></span>
            Please correct the following errors and resubmit <br /> <strong>".self::$errors."</strong>
            </p>
          </div>";
    if(empty(self::$empty) && empty(self::$errors))
    self::$rowsAffected = DB::Execute("INSERT INTO `hms_support`.`employee` (`id_employee`, `id_profile`, `lastname`, `firstname`, `email`, `passwd`, `last_passwd_gen`, `stats_date_from`, `stats_date_to`, `active`) 
    VALUES (NULL, '$_POST[Profile]', '$_POST[Last_Name]', '$_POST[First_Name]', '$_POST[Email]', '".Tools::encrypt($_POST['Password'])."', '".date("Y-m-d H:i:s")."', '".date("Y-m-d")."', '".date("Y-m-d")."', '$_POST[Status]')");
    
    if(self::$rowsAffected > 0)
    echo "<div class='ui-state-highlight ui-corner-all' style='margin-top: 20px; padding: 0 .7em;'>
         <p>
           <span class='ui-icon ui-icon-info' style='float: left; margin-right: .3em;'></span>
           Employee created successfuly. <strong> ".self::$rowsAffected ." </strong> row inserted.
         </p>
        </div>";
    }
    
    public static function contactFormValidation($formData)
    {
        $required = array("name", "email");
        $good_data = array();
        self::$empty = "";
        self::$errors = "";
                        
			foreach($formData as $key => $value)
			{
				if(in_array($key, $required) && empty($value))
				{
					self::$empty .= "<b>".ucfirst($key)."<b><br />";
				}
                elseif(!empty($value))
                {
                    if($key == "name" && !Validate::isActiveName($value))
                    self::$errors .= "<b>".ucfirst($key)."</b> contain errors <br />";
                    if($key == "email" && !Validate::isEmail($value))
                    self::$errors .= "<b>".ucfirst($key)."</b> is invalid <br />";
                    if($key == "subject" && !Validate::isVarchar($value))
                    self::$errors .= "<b>".ucfirst($key)."</b> contain errors <br />";			
				}
				
			}
            
            if(!empty(self::$empty) && @count(self::$empty) > 0)
            {
                echo "<div class='ui-state-error ui-corner-all' style='padding: 0 .7em;'>
                      <p>
                      <span class='ui-icon ui-icon-alert' style='float: left; margin-right: .3em;'></span>
                Please provide information for the following empty fields <br /> <strong>".self::$empty."</strong> <br />
                      </p>
                      </div>";
            }
            
            if(!empty(self::$errors) && @count(self::$errors) > 0)
            {
                echo "<div class='ui-state-error ui-corner-all' style='padding: 0 .7em;'>
                      <p>
                      <span class='ui-icon ui-icon-alert' style='float: left; margin-right: .3em;'></span>
                      Please correct the following errors and resubmit <br /> <strong>".self::$errors."</strong>
                      </p>
                      </div>";
            }
            if(empty(self::$empty) && empty(self::$errors))
            {
                foreach($formData as $key => $value)
                {
                    $good_data[$key] = stripslashes(strip_tags(trim($formData[$key])));
                }
                
                $mail = new EMAIL();
                
                $to[] = $good_data['email'];
              
                $mail->addTo($to);
               
                $mail->addFrom("info@hms.com");
               
                $mail->addSubject($good_data['subject']);
                $mail->addSenderName($good_data['name']);
                $mail->addBody($good_data['message']);
              
                $mail->setContentType("html");
               
                $mail->send();               
            }
    }
    
    public static function intranetEmailValidation($intranetData)
    {
        $required = array("name", "email");
        $good_data = array();
        self::$empty = "";
        self::$errors = "";
                        
			foreach($intranetData as $key => $value)
			{
				if(in_array($key, $required) && empty($value))
				{
					self::$empty .= "<b>".ucfirst($key)."<b><br />";
				}
                elseif(!empty($value))
                {
                    if($key == "name" && !Validate::isActiveName($value))
                    self::$errors .= "<b>".ucfirst($key)."</b> contain errors <br />";
                    if($key == "email" && !Validate::isEmail($value))
                    self::$errors .= "<b>".ucfirst($key)."</b> is invalid <br />";
                    if($key == "subject" && !Validate::isVarchar($value))
                    self::$errors .= "<b>".ucfirst($key)."</b> contain errors <br />";			
				}
                
                if($key == "department" && $value == "Please select one")
                self::$empty .= "<b>".ucfirst($key)."</b><br />";
				
			}
            
            if(!empty(self::$empty) && @count(self::$empty) > 0)
            {
                echo "<div class='ui-state-error ui-corner-all' style='padding: 0 .7em;'>
                      <p>
                      <span class='ui-icon ui-icon-alert' style='float: left; margin-right: .3em;'></span>
                Please provide information for the following empty fields <br /> <strong>".self::$empty."</strong> <br />
                      </p>
                      </div>";
            }
            
            if(!empty(self::$errors) && @count(self::$errors) > 0)
            {
                echo "<div class='ui-state-error ui-corner-all' style='padding: 0 .7em;'>
                      <p>
                      <span class='ui-icon ui-icon-alert' style='float: left; margin-right: .3em;'></span>
                      Please correct the following errors and resubmit <br /> <strong>".self::$errors."</strong>
                      </p>
                      </div>";
            }
            if(empty(self::$empty) && empty(self::$errors))
            {
                foreach($intranetData as $key => $value)
                {
                    $good_data[$key] = stripslashes(strip_tags(trim($intranetData[$key])));
                }
                
				$to = array();
				$stmt = DB::getInstance()->query("select * from doctor where doctor.id_department = $good_data[department]");
				while($row = $stmt->fetch(PDO::FETCH_ASSOC))
				{
					$to[] = $row['email'];
				}
				DB::Close();
				
                $mail = new EMAIL();
                
                //$to[] = $good_data['email'];
              
                $mail->addTo($to);
             
                $mail->addFrom($good_data['email']);
            
                $mail->addSubject($good_data['subject']);
                $mail->addSenderName($good_data['name']);
                $mail->addBody($good_data['editor1']);
           
                $mail->setContentType("html");
                
                $mail->send();
            }
    }
}