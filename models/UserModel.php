<?php
class UserModel {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // public function saveUser($name, $country, $state, $city) {
    //     $stmt = $this->conn->prepare("INSERT INTO users (name, country, state, city) VALUES (?, ?, ?, ?)");
    //     $stmt->bind_param("ssss", $name, $country, $state, $city);
    //     $stmt->execute();
    //     $stmt->close();
    // }

    public function saveUser($name, $country, $state, $city) {
        $stmt = $this->conn->prepare("INSERT INTO users (name, country, state, city) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $country, $state, $city); // Full names are passed
        $stmt->execute();
        $stmt->close();
    }
    
}
?>

