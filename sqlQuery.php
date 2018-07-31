
<?php
	//include "common/_connection.php"; //comment to use csc
	include "common/_connectionAzure.php"; //uncomment to use azure

	function sqlQuery($sql, $params)
	{
		try
		{
			$conn = Db::getInstance(); //comment to use csc
			//$conn = DbAzure::getInstance();	//uncomment to use azure

			//check for params
			if($params == "none"){
				$result = sqlsrv_query($conn, $sql);
			} else {
				$result = sqlsrv_query($conn, $sql, $params);
			}

			if ($result === false) {
					die(print_r(sqlsrv_errors(), true));
			}else{
				$json = array();

				do {
				     while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
				     	$json[] = $row;
				     }
				} while ( sqlsrv_next_result($result) );

				sqlsrv_free_stmt($result);
				sqlsrv_close($conn);

				return json_encode($json);
			}
		}
		catch(Exception $e)
		{
			echo("Error!");
		}
	}
?>
