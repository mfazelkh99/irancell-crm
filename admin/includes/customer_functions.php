<?php

require_once "../config.php";

function getCustomers(
    $search = "",
    $status = "",
    $platform = "",
    $sort = "newest"
){

    global $conn;

    $sql = "SELECT *
            FROM users
            WHERE 1=1";

    $params = [];

    if($search != ""){

        $sql .= " AND (

            fullname LIKE ?

            OR contact_number LIKE ?

            OR desired_number LIKE ?

            OR user_id LIKE ?

        )";

        $search = "%{$search}%";

        $params[] = $search;
        $params[] = $search;
        $params[] = $search;
        $params[] = $search;

    }

    if($status != ""){

        $sql .= " AND status=?";

        $params[] = $status;

    }

    if($platform != ""){

        $sql .= " AND platform=?";

        $params[] = $platform;

    }

    switch($sort){

        case "oldest":

            $sql .= " ORDER BY created_at ASC";

            break;

        case "name":

            $sql .= " ORDER BY fullname ASC";

            break;

        case "updated":

            $sql .= " ORDER BY updated_at DESC";

            break;

        default:

            $sql .= " ORDER BY created_at DESC";

    }

    $stmt = $conn->prepare($sql);

    $stmt->execute($params);

    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);

}

function countCustomers(){

    global $conn;

    $result = $conn->query("SELECT COUNT(*) AS total FROM users");
    $row = $result->fetch_assoc();
    return $row['total'];

}

function getCustomer($id){

    global $conn;

    $stmt = $conn->prepare("
        SELECT *
        FROM users
        WHERE id = ?
        LIMIT 1
    ");

    $stmt->bind_param("i", $id);

    $stmt->execute();

    return $stmt->get_result()->fetch_assoc();

}

function getCustomerNotes($customerId){

    global $conn;

    $stmt = $conn->prepare("
        SELECT *
        FROM customer_notes
        WHERE customer_id = ?
        ORDER BY created_at DESC
    ");

    $stmt->bind_param("i", $customerId);

    $stmt->execute();

    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

}

function addCustomerNote($customerId,$adminId,$note){

    global $conn;

    $type = "note";

    $stmt = $conn->prepare("
        INSERT INTO customer_notes
        (
            customer_id,
            admin_id,
            type,
            note
        )
        VALUES
        (
            ?,NULL,?,?
        )
    ");

    $stmt->bind_param(
        "iss",
        $customerId,
        $type,
        $note
    );

    return $stmt->execute();

}

?>
