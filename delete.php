<?php
include 'database.php';  

if (isset($_GET['id'])) {
    
    $program_id = $con->real_escape_string($_GET['id']); 

    
    $con->begin_transaction();

    try {
        
        $sql1 = "DELETE FROM t1 WHERE program_id = ?";
        $stmt1 = $con->prepare($sql1);
        $stmt1->bind_param("s", $program_id);
        $stmt1->execute();

        
        $sql2 = "DELETE FROM t2 WHERE program_id = ?";
        $stmt2 = $con->prepare($sql2);
        $stmt2->bind_param("s", $program_id);
        $stmt2->execute();

        
        $sql3 = "DELETE FROM t3 WHERE program_id = ?";
        $stmt3 = $con->prepare($sql3);
        $stmt3->bind_param("s", $program_id);
        $stmt3->execute();


        $con->commit();

        
        header("Location: view.php?message=Program and related tasks deleted successfully");
        exit();
    } catch (Exception $e) {
        
        $con->rollback();
        echo "Error deleting records: " . htmlspecialchars($e->getMessage());
    }

    
    $stmt1->close();
    $stmt2->close();
    $stmt3->close();
}

$cozn->close();
?>
