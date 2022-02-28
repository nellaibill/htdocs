<?php
fn_GetPrintConfig();
function finditemcategoryname($xNo) {
	$result = mysql_query ( "SELECT *  FROM m_itemcategory where itemcategoryno=$xNo" ) or die ( mysql_error () );
	while ( $row = mysql_fetch_array ( $result ) ) {
		$GLOBALS ['xItemCategoryName'] = $row ['itemcategoryname'];
	}
}
function findsizename($xNo) {
	$result = mysql_query ( "SELECT *  FROM m_size where sizeno=$xNo" ) or die ( mysql_error () );
	while ( $row = mysql_fetch_array ( $result ) ) {
		$GLOBALS ['xSizeName'] = $row ['sizename'];
		$GLOBALS ['xSizeTotal'] = $row ['totalsize'];
	}
}
function findgsmname($xNo) {
	$result = mysql_query ( "SELECT *  FROM m_gsm where gsmno=$xNo" ) or die ( mysql_error () );
	while ( $row = mysql_fetch_array ( $result ) ) {
		$GLOBALS ['xGsmName'] = $row ['gsmname'];
	}
}
function fn_GetPrintConfig() {
	$result = mysql_query ( "select *  FROM config_print where id=1" ) or die ( mysql_error () );
	while ( $row = mysql_fetch_array ( $result ) ) {
		$GLOBALS ['xPrintBillType'] = $row ['print_bill_type'];
		$GLOBALS ['xPrintFormat'] = $row ['print_format'];
	}
}
function findcustomerdata($xNo) {
	$result = mysql_query ( "SELECT *  FROM inv_customer
			where customerid=$xNo" ) or die ( mysql_error () );
	while ( $row = mysql_fetch_array ( $result ) ) {
		$GLOBALS ['xCustomerName'] = $row ['customername'];
		$GLOBALS ['xCustomerAddress1'] = $row ['customeraddressline1'];
		$GLOBALS ['xCustomerAddress2'] = $row ['customeraddressline2'];
		$GLOBALS ['xCustomerAddress3'] = $row ['customeraddressline3'];
		$GLOBALS ['xCustomerCstNo'] = $row ['customercstno'];
		$GLOBALS ['xCustomerTinNo'] = $row ['customertinno'];
		$GLOBALS ['xCustomerCexNo'] = $row ['customercexno'];
	}
}
function findmanufacturerdata($xNo) {
	$result = mysql_query ( "SELECT *  FROM inv_manufacturer
			where manufacturerno=$xNo" ) or die ( mysql_error () );
	while ( $row = mysql_fetch_array ( $result ) ) {
		$GLOBALS ['$xManufacturerName'] = $row ['manufacturername'];
		$GLOBALS ['$xAddress'] = $row ['address'];
		$GLOBALS ['$xCexNo'] = $row ['cexno'];
		$GLOBALS ['$xRange'] = $row ['range'];
		$GLOBALS ['$xDivision'] = $row ['division'];
		$GLOBALS ['$xCommisionerate'] = $row ['commisionerate'];
		$GLOBALS ['$xDescription'] = $row ['description'];
		$GLOBALS ['$xTarrifNo'] = $row ['tarrifno'];
	}
}
function fn_RupeeFormat($value) {
	return ' ' . number_format ( $value, 2 );
}
function moneyFormatIndia($num) {
	$explrestunits = "";
	if (strlen ( $num ) > 3) {
		$lastthree = substr ( $num, strlen ( $num ) - 3, strlen ( $num ) );
		$restunits = substr ( $num, 0, strlen ( $num ) - 3 ); // extracts the last three digits
		$restunits = (strlen ( $restunits ) % 2 == 1) ? "0" . $restunits : $restunits; // explodes the remaining digits in 2's formats, adds a zero in the beginning to maintain the 2's grouping.
		$expunit = str_split ( $restunits, 2 );
		for($i = 0; $i < sizeof ( $expunit ); $i ++) {
			// creates each of the 2's group and adds a comma to the end
			if ($i == 0) {
				$explrestunits .= ( int ) $expunit [$i] . ","; // if is first value , convert into integer
			} else {
				$explrestunits .= $expunit [$i] . ",";
			}
		}
		$thecash = $explrestunits . $lastthree;
	} else {
		$thecash = $num;
	}
	return $thecash; // writes the final format where $currency is the currency symbol.
}
function convert_number_to_words($number) {
	$hyphen = '-';
	$conjunction = ' and ';
	$separator = ', ';
	$negative = 'negative ';
	$decimal = ' and paise ';
	$dictionary = array (
			0 => 'zero',
			1 => 'one',
			2 => 'two',
			3 => 'three',
			4 => 'four',
			5 => 'five',
			6 => 'six',
			7 => 'seven',
			8 => 'eight',
			9 => 'nine',
			10 => 'ten',
			11 => 'eleven',
			12 => 'twelve',
			13 => 'thirteen',
			14 => 'fourteen',
			15 => 'fifteen',
			16 => 'sixteen',
			17 => 'seventeen',
			18 => 'eighteen',
			19 => 'nineteen',
			20 => 'twenty',
			30 => 'thirty',
			40 => 'fourty',
			50 => 'fifty',
			60 => 'sixty',
			70 => 'seventy',
			80 => 'eighty',
			90 => 'ninety',
			100 => 'hundred',
			1000 => 'thousand',
			1000000 => 'million',
			1000000000 => 'billion',
			1000000000000 => 'trillion',
			1000000000000000 => 'quadrillion',
			1000000000000000000 => 'quintillion' 
	);
	
	if (! is_numeric ( $number )) {
		return false;
	}
	
	if (($number >= 0 && ( int ) $number < 0) || ( int ) $number < 0 - PHP_INT_MAX) {
		// overflow
		trigger_error ( 'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX, E_USER_WARNING );
		return false;
	}
	
	if ($number < 0) {
		return $negative . convert_number_to_words ( abs ( $number ) );
	}
	
	$string = $fraction = null;
	
	if (strpos ( $number, '.' ) !== false) {
		list ( $number, $fraction ) = explode ( '.', $number );
	}
	
	switch (true) {
		case $number < 21 :
			$string = $dictionary [$number];
			break;
		case $number < 100 :
			$tens = (( int ) ($number / 10)) * 10;
			$units = $number % 10;
			$string = $dictionary [$tens];
			if ($units) {
				$string .= $hyphen . $dictionary [$units];
			}
			break;
		case $number < 1000 :
			$hundreds = $number / 100;
			$remainder = $number % 100;
			$string = $dictionary [$hundreds] . ' ' . $dictionary [100];
			if ($remainder) {
				$string .= $conjunction . convert_number_to_words ( $remainder );
			}
			break;
		default :
			$baseUnit = pow ( 1000, floor ( log ( $number, 1000 ) ) );
			$numBaseUnits = ( int ) ($number / $baseUnit);
			$remainder = $number % $baseUnit;
			$string = convert_number_to_words ( $numBaseUnits ) . ' ' . $dictionary [$baseUnit];
			if ($remainder) {
				$string .= $remainder < 100 ? $conjunction : $separator;
				$string .= convert_number_to_words ( $remainder );
			}
			break;
	}
	
	if (null !== $fraction && is_numeric ( $fraction )) {
		$string .= $decimal;
		$words = array ();
		foreach ( str_split ( ( string ) $fraction ) as $number ) {
			$words [] = $dictionary [$number];
		}
		$string .= implode ( ' ', $words );
	}
	
	return $string;
}
function getStringOfAmount1($num) {
	$count = 0;
	global $ones, $tens, $triplets;
	$ones = array (
			'',
			' One',
			' Two',
			' Three',
			' Four',
			' Five',
			' Six',
			' Seven',
			' Eight',
			' Nine',
			' Ten',
			' Eleven',
			' Twelve',
			' Thirteen',
			' Fourteen',
			' Fifteen',
			' Sixteen',
			' Seventeen',
			' Eighteen',
			' Nineteen' 
	);
	$tens = array (
			'',
			'',
			' Twenty',
			' Thirty',
			' Forty',
			' Fifty',
			' Sixty',
			' Seventy',
			' Eighty',
			' Ninety' 
	);
	
	$triplets = array (
			'',
			' Thousand',
			' Million',
			' Billion',
			' Trillion',
			' Quadrillion',
			' Quintillion',
			' Sextillion',
			' Septillion',
			' Octillion',
			' Nonillion' 
	);
	return convertNum1 ( $num );
}
function getStringOfAmount($num) {
	$count = 0;
	global $ones, $tens, $triplets;
	$ones = array (
			'',
			' One',
			' Two',
			' Three',
			' Four',
			' Five',
			' Six',
			' Seven',
			' Eight',
			' Nine',
			' Ten',
			' Eleven',
			' Twelve',
			' Thirteen',
			' Fourteen',
			' Fifteen',
			' Sixteen',
			' Seventeen',
			' Eighteen',
			' Nineteen' 
	);
	$tens = array (
			'',
			'',
			' Twenty',
			' Thirty',
			' Forty',
			' Fifty',
			' Sixty',
			' Seventy',
			' Eighty',
			' Ninety' 
	);
	
	$triplets = array (
			'',
			' Thousand',
			' Million',
			' Billion',
			' Trillion',
			' Quadrillion',
			' Quintillion',
			' Sextillion',
			' Septillion',
			' Octillion',
			' Nonillion' 
	);
	return convertNum ( $num );
}

/**
 * Function to dislay tens and ones
 */
function commonloop($val, $str1 = '', $str2 = '') {
	global $ones, $tens;
	$string = '';
	if ($val == 0)
		$string .= $ones [$val];
	else if ($val < 20)
		$string .= $str1 . $ones [$val] . $str2;
	else
		$string .= $str1 . $tens [( int ) ($val / 10)] . $ones [$val % 10] . $str2;
	return $string;
}

/**
 * returns the number as an anglicized string
 */
function convertNum($num) {
	$num = ( int ) $num; // make sure it's an integer
	
	if ($num < 0)
		return 'negative' . convertTri ( - $num, 0 );
	
	if ($num == 0)
		return 'Zero';
	return convertTri ( $num, 0 );
}
function convertNum1($num) {
	$num = ( int ) $num; // make sure it's an integer
	
	if ($num < 0)
		return 'negative' . convertTri ( - $num, 0 );
	
	if ($num == 0)
		return 'Zero';
	return convertTri1 ( $num, 0 );
}

/**
 * recursive fn, converts numbers to words
 */
function convertTri($num, $tri) {
	global $ones, $tens, $triplets, $count;
	$test = $num;
	$count ++;
	// chunk the number, ...rxyy
	// init the output string
	$str = '';
	// to display hundred & digits
	if ($count == 1) {
		$r = ( int ) ($num / 1000);
		$x = ($num / 100) % 10;
		$y = $num % 100;
		// do hundreds
		if ($x > 0) {
			$str = $ones [$x] . ' Hundred';
			// do ones and tens
			$str .= commonloop ( $y, ' and ', '' );
		} else if ($r > 0) {
			// do ones and tens
			$str .= commonloop ( $y, ' and ', '' );
		} else {
			// do ones and tens
			$str .= commonloop ( $y );
		}
	}  // To display lakh and thousands
else if ($count == 2) {
		$r = ( int ) ($num / 10000);
		$x = ($num / 100) % 100;
		$y = $num % 100;
		$str .= commonloop ( $x, '', ' Lakh ' );
		$str .= commonloop ( $y );
		if ($str != '')
			$str .= $triplets [$tri];
	}  // to display till hundred crore
else if ($count == 3) {
		$r = ( int ) ($num / 1000);
		$x = ($num / 100) % 10;
		$y = $num % 100;
		// do hundreds
		if ($x > 0) {
			$str = $ones [$x] . ' Hundred';
			// do ones and tens
			$str .= commonloop ( $y, ' and ', ' Crore ' );
		} else if ($r > 0) {
			// do ones and tens
			$str .= commonloop ( $y, ' and ', ' Crore ' );
		} else {
			// do ones and tens
			$str .= commonloop ( $y );
		}
	} else {
		$r = ( int ) ($num / 1000);
	}
	// add triplet modifier only if there
	// is some output to be modified...
	// continue recursing?
	if ($r > 0)
		return convertTri ( $r, $tri + 1 ) . $str;
	else
		return $str;
}
function convertTri1($num, $tri) {
	global $ones, $tens, $triplets, $count;
	$test = $num;
	$count ++;
	// chunk the number, ...rxyy
	// init the output string
	$str = '';
	// to display hundred & digits
	if ($count == 1) {
		$r = ( int ) ($num / 1000);
		$x = ($num / 100) % 10;
		$y = $num % 100;
		// do hundreds
		if ($x > 0) {
			$str = $ones [$x] . ' Hundred';
			// do ones and tens
			$str .= commonloop ( $y, ' and ', '' );
		} else if ($r > 0) {
			// do ones and tens
			$str .= commonloop ( $y, ' and ', '' );
		} else {
			// do ones and tens
			$str .= commonloop ( $y );
		}
	}  // To display lakh and thousands
else if ($count == 2) {
		$r = ( int ) ($num / 10000);
		$x = ($num / 100) % 100;
		$y = $num % 100;
		$str .= commonloop ( $x, '', ' Lakh ' );
		$str .= commonloop ( $y );
		if ($str != '')
			$str .= $triplets [$tri];
	}  // to display till hundred crore
else if ($count == 3) {
		$r = ( int ) ($num / 1000);
		$x = ($num / 100) % 10;
		$y = $num % 100;
		// do hundreds
		if ($x > 0) {
			$str = $ones [$x] . ' Hundred';
			// do ones and tens
			$str .= commonloop ( $y, ' and ', ' Crore ' );
		} else if ($r > 0) {
			// do ones and tens
			$str .= commonloop ( $y, ' and ', ' Crore ' );
		} else {
			// do ones and tens
			$str .= commonloop ( $y );
		}
	} else {
		$r = ( int ) ($num / 1000);
	}
	// add triplet modifier only if there
	// is some output to be modified...
	// continue recursing?
	if ($r > 0)
		return convertTri ( $r, $tri + 1 ) . $str;
	else
		return $str;
}

// example of usage
// echo "564 : ".getStringOfAmount(111445)."<br>";
// echo "892 : ".convertNum(892);
?>