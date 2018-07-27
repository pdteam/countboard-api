<?php
require_once '_connection.php';

class Audit
{
    public $id;
    public $eventType;
    public $eventTS;
    public $accountNt;
    public $ipAddress;
    public $desc;

    public function __construct()
    {
    }

    //create
    public static function addEvent($eventType, $accountNt, $ipAddress, $desc)
    {
        $conn = Db::getInstance();

        $sql = 'INSERT INTO [dbo].[SECURITY_AUDIT] (EVENT_TYPE, ACCOUNT_NT, IP_ADDRESS, DESCRIPTION) VALUES (?,?,?,?)';
        $params = array($eventType, $accountNt, $ipAddress, $desc);
        $result = sqlsrv_query($conn, $sql, $params);

        if ($result === false) {
            die(print_r(sqlsrv_errors(), true));
        }
    }

    //get
    public static function getAllEvents()
    {
        $list = [];
        $conn = Db::getInstance();

        $sql = "SELECT * FROM SECURITY_AUDIT ORDER BY ID DESC";
        $result = sqlsrv_query($conn, $sql);

        if ($result === false) {
            die(print_r(sqlsrv_errors(), true));

        } else {
            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                $list[] = createAudit(
                    $row["ID"],
                    $row["EVENT_TS"],
                    $row["EVENT_TYPE"],
                    $row["ACCOUNT_NT"],
                    $row["IP_ADDRESS"],
                    $row["DESCRIPTION"]
                );
            }
        }

        return json_encode(['data' => $list]);
    }
}

function createAudit($id, $eventType, $eventTS, $accountNt, $ipAddress)
{
    $instance = new Audit();
    $instance->id = $id;
    $instance->eventType = $eventType;
    $instance->eventTS = $eventTS;
    $instance->accountNt = $accountNt;
    $instance->ipAddress = $ipAddress;
    $instance->desc = $desc;

    return $instance;
}
?>
