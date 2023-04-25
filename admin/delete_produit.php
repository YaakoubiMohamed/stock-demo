<?php
include "bd.php";

// Get record ID from URL parameter
$id = $_GET['id'];
echo $id;
// Query to delete record from table
$sql = "DELETE FROM categorie WHERE id = $id";

// Execute query
if (mysqli_query($conn, $sql)) {
    // Record deleted successfully
    header("Location: categories.php");
} else {
    // Error deleting record
    echo "Error: " . mysqli_error($conn);
}

// Close connection
mysqli_close($conn);
?>
