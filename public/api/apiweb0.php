<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = file_get_contents('php://input');
    $data = json_decode($input, true);
    if ($data) {
        $temperature = isset($data['temperature']) ? floatval($data['temperature']) : null;
        $tds = isset($data['tds']) ? floatval($data['tds']) : null;
        $ph = isset($data['ph']) ? floatval($data['ph']) : null;

        // Konfigurasi database
        // $host = 'localhost';
        // $db = 'sensor_db';
        // $user = 'root';
        // $pass = '';
        // $dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";

        // Konfigurasi database
        $host = 'pma2.research-ai.my.id'; 
        $db = 'mbkm-shiro'; 
        $user = 'mbkm-shiro'; 
        $pass = 'shiro1234'; 
        $dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";

        try {
            // Koneksi ke database
            $pdo = new PDO($dsn, $user, $pass, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]);

            // Query untuk menyimpan data
            $query = "INSERT INTO sensor_data (temperature, tds, ph, timestamp) VALUES (:temperature, :tds, :ph, :timestamp)";
            $stmt = $pdo->prepare($query);
            $stmt->execute([
                ':temperature' => $temperature,
                ':tds' => $tds,
                ':ph' => $ph,
                ':timestamp' => date('Y-m-d H:i:s'),
            ]);

            http_response_code(200);
            echo json_encode(['status' => 'success']);
        } catch (PDOException $e) {
            http_response_code(500);
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    } else {
        http_response_code(400);
        echo json_encode(['status' => 'error', 'message' => 'Invalid JSON']);
    }
} else {
    http_response_code(405);
    echo json_encode(['status' => 'error', 'message' => 'Method Not Allowed']);
}
?>
