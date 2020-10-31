<?php
/**
 * Probar driver de SQL Server con PHP y PDO
 * 
 * @author parzibyte
 */
    try{
        $cnx = new PDO("sqlsrv:server=DESKTOP-K7SRFDS\SQLEXPRESS;database=KIMERA", "", "");
    }
    catch(PDOException $e){
        die("Error connecting to SQL server" . $e->getMessage());
    }

    echo "<p>Connected to SQL Server</p>\n";

    $query = "SELECT TOP 5 * FROM dbo.Lic_Licencias";

    $stat = $cnx->query( $query );
    while ( $row = $stat->fetch(PDO::FETCH_ASSOC)){
        print($row["Lic_Id"]);
    }
?>