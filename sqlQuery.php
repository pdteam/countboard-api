
<?php
	//include creds
	
	function sqlQuery($sql, $params)
	{
		// make creds global so they are accessible within the function
//		include "sqlCreds.php";


		try  
		{  
			/*
			$serverName = $sqlServer;  
			$connectionOptions = array("Database"=>$sqlDatabase,  
				"Uid"=>$sqlUid, "PWD"=>$sqlPWD);  
				
			$conn = sqlsrv_connect($serverName, $connectionOptions);  
			*/
			
			$serverName = "countboard.database.windows.net"; //serverName\instanceName
			$connectionInfo = array( "Database"=>"countboard", "UID"=>"e7646c78-5ff9-4b4d-8d10-8cb4b5bed0dd", "PWD"=>"StandAndBeCounted!");
			$conn = sqlsrv_connect( $serverName, $connectionInfo);

			//check for params	
			if($params == "none"){$queryReview = sqlsrv_query($conn, $sql);}
			else {$queryReview = sqlsrv_query($conn, $sql, $params);}
			


$json = array();
 
do {
     while ($row = sqlsrv_fetch_array($queryReview, SQLSRV_FETCH_ASSOC)) {
     $json[] = $row;
     }
} while ( sqlsrv_next_result($queryReview) );
 
/* Run the tabular results through json_encode() */
/* And ensure numbers don't get cast to trings */
return json_encode($json);

			
			
		//	echo $queryReview;
		//$queryReview = sqlsrv_query($conn, $sql, $params);
		//$queryReview = sqlsrv_query($conn, $sql);
			//($queryReview);//return the data if there is any
			sqlsrv_free_stmt($queryReview);  
			sqlsrv_close($conn);
		}  
		catch(Exception $e)  
		{  
			echo("Error!");  
		}
	}
?>
