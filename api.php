<?php
// API simples em PHP usando SQLite e autenticação por chave (X-API-Key).
require_once __DIR__ . '/config.php';

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');

if (!is_dir(__DIR__ . '/data')) {
	mkdir(__DIR__ . '/data', 0755, true);
}

$pdo = new PDO('sqlite:' . DB_FILE);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$pdo->exec(
	"CREATE TABLE IF NOT EXISTS offices (
		id INTEGER PRIMARY KEY AUTOINCREMENT,
		name TEXT,
		address TEXT,
		latitude REAL,
		longitude REAL,
		phone TEXT,
		raw TEXT
	)"
);

function getRequestHeader($name) {
	$headers = function_exists('getallheaders') ? getallheaders() : [];
	foreach ($headers as $k => $v) {
		if (strtolower($k) === strtolower($name)) return $v;
	}
	return null;
}

$apiKey = getRequestHeader('X-API-Key') ?? ($_GET['api_key'] ?? null);
if ($apiKey !== API_KEY) {
	http_response_code(401);
	echo json_encode(['error' => 'Unauthorized']);
	exit;
}

$method = $_SERVER['REQUEST_METHOD'];
$id = isset($_GET['id']) ? intval($_GET['id']) : null;

try {
	if ($method === 'GET') {
		if ($id) {
			$stmt = $pdo->prepare('SELECT * FROM offices WHERE id = ?');
			$stmt->execute([$id]);
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			if (!$row) { http_response_code(404); echo json_encode(['error'=>'Not found']); exit; }
			echo json_encode($row);
			exit;
		}

		$stmt = $pdo->query('SELECT id,name,address,latitude,longitude,phone FROM offices');
		$all = $stmt->fetchAll(PDO::FETCH_ASSOC);
		echo json_encode($all);
		exit;
	}

	if ($method === 'POST') {
		$input = json_decode(file_get_contents('php://input'), true);
		if (!is_array($input)) { http_response_code(400); echo json_encode(['error'=>'Invalid JSON']); exit; }
		$name = $input['name'] ?? null;
		if (!$name) { http_response_code(422); echo json_encode(['error'=>'Missing name']); exit; }
		$address = $input['address'] ?? null;
		$lat = isset($input['latitude']) ? floatval($input['latitude']) : null;
		$lng = isset($input['longitude']) ? floatval($input['longitude']) : null;
		$phone = $input['phone'] ?? null;
		$raw = json_encode($input, JSON_UNESCAPED_UNICODE);

		$stmt = $pdo->prepare('INSERT INTO offices (name,address,latitude,longitude,phone,raw) VALUES (?,?,?,?,?,?)');
		$stmt->execute([$name,$address,$lat,$lng,$phone,$raw]);
		$newId = $pdo->lastInsertId();
		http_response_code(201);
		echo json_encode(['id' => $newId]);
		exit;
	}

	http_response_code(405);
	echo json_encode(['error'=>'Method not allowed']);
} catch (Exception $e) {
	http_response_code(500);
	echo json_encode(['error' => 'Server error', 'message' => $e->getMessage()]);
}

