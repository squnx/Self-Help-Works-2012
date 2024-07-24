<?php 
class ProfileClass
    { 
    var $Host     = MYSQL_HOST; 
    var $Database = MYSQL_DB; 
    var $User     = MYSQL_USER; 
    var $Password = MYSQL_PASSWORD; 
     
    var $Link_ID  = 0;  
    var $Query_ID = 0;  
    var $Record   = array();  
    var $Row;           
    var $LoginError = ""; 

    var $Errno    = 0;  
    var $Error    = ""; 
     
//********************************************* 
//    Connects to the database 
//********************************************* 
    function connect() 
        { 
        if( 0 == $this->Link_ID ) 
            $this->Link_ID=mysql_connect( $this->Host, $this->User, $this->Password ); 
        if( !$this->Link_ID ) 
            $this->halt( "Link-ID == false, connect failed" ); 
        if( !mysql_query( sprintf( "use %s", $this->Database ), $this->Link_ID ) ) 
            $this->halt( "cannot use database ".$this->Database ); 
        }

//********************************************* 
//    Queries the database 
//********************************************* 
    function query( $Query_String ) 
        { 
        $this->connect(); 
        $this->Query_ID = mysql_query( $Query_String,$this->Link_ID ); 
        $this->Row = 0; 
        $this->Errno = mysql_errno(); 
        $this->Error = mysql_error(); 
        if( !$this->Query_ID ) 
            $this->halt( "Invalid SQL: ".$Query_String ); 
        return $this->Query_ID; 
        }

//********************************************* 
//    If error, halts the program 
//********************************************* 
    function halt( $msg ) 
        { 
        printf( "</td></tr></table><b>Database error:</b> %s<br>n", $msg ); 
        printf( "<b>MySQL Error</b>: %s (%s)<br>n", $this->Errno, $this->Error ); 
        die( "Session halted." ); 
        }

//********************************************* 
//    Retrieves the next record in a recordset 
//********************************************* 
    function nextRecord() 
        { 
        @ $this->Record = mysql_fetch_array( $this->Query_ID ); 
        $this->Row += 1; 
        $this->Errno = mysql_errno(); 
        $this->Error = mysql_error(); 
        $stat = is_array( $this->Record ); 
        if( !$stat ) 
            { 
            @ mysql_free_result( $this->Query_ID ); 
            $this->Query_ID = 0; 
            } 
        return $stat; 
        } 

//********************************************* 
//    Retrieves a single record 
//********************************************* 
    function singleRecord() 
        { 
        $this->Record = mysql_fetch_array( $this->Query_ID ); 
        $stat = is_array( $this->Record ); 
        return $stat; 
        }  

//********************************************* 
//    Returns the number of rows  in a recordset 
//********************************************* 
    function numRows() 
        { 
        return mysql_num_rows( $this->Query_ID ); 
        } 
         
    } // end class ProfileClass
	
class BillingClass
    { 
    var $Host     = MYSQL_HOST; 
    var $Database = MYSQL_DB; 
    var $User     = MYSQL_USER; 
    var $Password = MYSQL_PASSWORD; 
     
    var $Link_ID  = 0;  
    var $Query_ID = 0;  
    var $Record   = array();  
    var $Row;           
    var $LoginError = ""; 

    var $Errno    = 0;  
    var $Error    = ""; 
     
//********************************************* 
//    Connects to the database 
//********************************************* 
    function connect() 
        { 
        if( 0 == $this->Link_ID ) 
            $this->Link_ID=mysql_connect( $this->Host, $this->User, $this->Password ); 
        if( !$this->Link_ID ) 
            $this->halt( "Link-ID == false, connect failed" ); 
        if( !mysql_query( sprintf( "use %s", $this->Database ), $this->Link_ID ) ) 
            $this->halt( "cannot use database ".$this->Database ); 
        }

//********************************************* 
//    Queries the database 
//********************************************* 
    function query( $Query_String ) 
        { 
        $this->connect(); 
        $this->Query_ID = mysql_query( $Query_String,$this->Link_ID ); 
        $this->Row = 0; 
        $this->Errno = mysql_errno(); 
        $this->Error = mysql_error(); 
        if( !$this->Query_ID ) 
            $this->halt( "Invalid SQL: ".$Query_String ); 
        return $this->Query_ID; 
        }

//********************************************* 
//    If error, halts the program 
//********************************************* 
    function halt( $msg ) 
        { 
        printf( "</td></tr></table><b>Database error:</b> %s<br>n", $msg ); 
        printf( "<b>MySQL Error</b>: %s (%s)<br>n", $this->Errno, $this->Error ); 
        die( "Session halted." ); 
        }

//********************************************* 
//    Retrieves the next record in a recordset 
//********************************************* 
    function nextRecord() 
        { 
        @ $this->Record = mysql_fetch_array( $this->Query_ID ); 
        $this->Row += 1; 
        $this->Errno = mysql_errno(); 
        $this->Error = mysql_error(); 
        $stat = is_array( $this->Record ); 
        if( !$stat ) 
            { 
            @ mysql_free_result( $this->Query_ID ); 
            $this->Query_ID = 0; 
            } 
        return $stat; 
        } 

//********************************************* 
//    Retrieves a single record 
//********************************************* 
    function singleRecord() 
        { 
        $this->Record = mysql_fetch_array( $this->Query_ID ); 
        $stat = is_array( $this->Record ); 
        return $stat; 
        }  

//********************************************* 
//    Returns the number of rows  in a recordset 
//********************************************* 
    function numRows() 
        { 
        return mysql_num_rows( $this->Query_ID ); 
        } 
         
    } // end class BillingClass
	
class FeatureSetClass
    { 
    var $Host     = MYSQL_HOST; 
    var $Database = MYSQL_DB; 
    var $User     = MYSQL_USER; 
    var $Password = MYSQL_PASSWORD; 
     
    var $Link_ID  = 0;  
    var $Query_ID = 0;  
    var $Record   = array();  
    var $Row;           
    var $LoginError = ""; 

    var $Errno    = 0;  
    var $Error    = ""; 
     
//********************************************* 
//    Connects to the database 
//********************************************* 
    function connect() 
        { 
        if( 0 == $this->Link_ID ) 
            $this->Link_ID=mysql_connect( $this->Host, $this->User, $this->Password ); 
        if( !$this->Link_ID ) 
            $this->halt( "Link-ID == false, connect failed" ); 
        if( !mysql_query( sprintf( "use %s", $this->Database ), $this->Link_ID ) ) 
            $this->halt( "cannot use database ".$this->Database ); 
        }

//********************************************* 
//    Queries the database 
//********************************************* 
    function query( $Query_String ) 
        { 
        $this->connect(); 
        $this->Query_ID = mysql_query( $Query_String,$this->Link_ID ); 
        $this->Row = 0; 
        $this->Errno = mysql_errno(); 
        $this->Error = mysql_error(); 
        if( !$this->Query_ID ) 
            $this->halt( "Invalid SQL: ".$Query_String ); 
        return $this->Query_ID; 
        }

//********************************************* 
//    If error, halts the program 
//********************************************* 
    function halt( $msg ) 
        { 
        printf( "</td></tr></table><b>Database error:</b> %s<br>n", $msg ); 
        printf( "<b>MySQL Error</b>: %s (%s)<br>n", $this->Errno, $this->Error ); 
        die( "Session halted." ); 
        }

//********************************************* 
//    Retrieves the next record in a recordset 
//********************************************* 
    function nextRecord() 
        { 
        @ $this->Record = mysql_fetch_array( $this->Query_ID ); 
        $this->Row += 1; 
        $this->Errno = mysql_errno(); 
        $this->Error = mysql_error(); 
        $stat = is_array( $this->Record ); 
        if( !$stat ) 
            { 
            @ mysql_free_result( $this->Query_ID ); 
            $this->Query_ID = 0; 
            } 
        return $stat; 
        } 

//********************************************* 
//    Retrieves a single record 
//********************************************* 
    function singleRecord() 
        { 
        $this->Record = mysql_fetch_array( $this->Query_ID ); 
        $stat = is_array( $this->Record ); 
        return $stat; 
        }  

//********************************************* 
//    Returns the number of rows  in a recordset 
//********************************************* 
    function numRows() 
        { 
        return mysql_num_rows( $this->Query_ID ); 
        } 
         
    } // end class FeatureSetClass
	
class FeatureSetLabelClass
    { 
    var $Host     = MYSQL_HOST; 
    var $Database = MYSQL_DB; 
    var $User     = MYSQL_USER; 
    var $Password = MYSQL_PASSWORD; 
     
    var $Link_ID  = 0;  
    var $Query_ID = 0;  
    var $Record   = array();  
    var $Row;           
    var $LoginError = ""; 

    var $Errno    = 0;  
    var $Error    = ""; 
     
//********************************************* 
//    Connects to the database 
//********************************************* 
    function connect() 
        { 
        if( 0 == $this->Link_ID ) 
            $this->Link_ID=mysql_connect( $this->Host, $this->User, $this->Password ); 
        if( !$this->Link_ID ) 
            $this->halt( "Link-ID == false, connect failed" ); 
        if( !mysql_query( sprintf( "use %s", $this->Database ), $this->Link_ID ) ) 
            $this->halt( "cannot use database ".$this->Database ); 
        }

//********************************************* 
//    Queries the database 
//********************************************* 
    function query( $Query_String ) 
        { 
        $this->connect(); 
        $this->Query_ID = mysql_query( $Query_String,$this->Link_ID ); 
        $this->Row = 0; 
        $this->Errno = mysql_errno(); 
        $this->Error = mysql_error(); 
        if( !$this->Query_ID ) 
            $this->halt( "Invalid SQL: ".$Query_String ); 
        return $this->Query_ID; 
        }

//********************************************* 
//    If error, halts the program 
//********************************************* 
    function halt( $msg ) 
        { 
        printf( "</td></tr></table><b>Database error:</b> %s<br>n", $msg ); 
        printf( "<b>MySQL Error</b>: %s (%s)<br>n", $this->Errno, $this->Error ); 
        die( "Session halted." ); 
        }

//********************************************* 
//    Retrieves the next record in a recordset 
//********************************************* 
    function nextRecord() 
        { 
        @ $this->Record = mysql_fetch_array( $this->Query_ID ); 
        $this->Row += 1; 
        $this->Errno = mysql_errno(); 
        $this->Error = mysql_error(); 
        $stat = is_array( $this->Record ); 
        if( !$stat ) 
            { 
            @ mysql_free_result( $this->Query_ID ); 
            $this->Query_ID = 0; 
            } 
        return $stat; 
        } 

//********************************************* 
//    Retrieves a single record 
//********************************************* 
    function singleRecord() 
        { 
        $this->Record = mysql_fetch_array( $this->Query_ID ); 
        $stat = is_array( $this->Record ); 
        return $stat; 
        }  

//********************************************* 
//    Returns the number of rows  in a recordset 
//********************************************* 
    function numRows() 
        { 
        return mysql_num_rows( $this->Query_ID ); 
        } 
         
    } // end class FeatureSetLabelClass
	
?>