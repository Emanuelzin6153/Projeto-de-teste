<?php
// Script simples para popular o banco SQLite a partir de `escritorios.json`.
// Uso: php migrate.php

require_once __DIR__ . '/config.php';

if (!file_exists(__DIR__ . '/escritorios.json')) {
    echo "Arquivo escritorio.json não encontrado. Coloque seus dados em `escritorios.json`.\n";
    exit(1);
}

$json = file_get_contents(__DIR__ . '/escritorios.json');
$data = json_decode($json, true);

if (!is_array($data) || count($data) === 0) {
    echo "Nenhum registro válido em `escritorios.json`. Forneça um array de objetos.\n";
    exit(1);
}

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

$insert = $pdo->prepare('INSERT INTO offices (name,address,latitude,longitude,phone,raw) VALUES (?,?,?,?,?,?)');

$count = 0;
foreach ($data as $item) {
    $name = $item['name'] ?? ($item['nome'] ?? null);
    $address = $item['address'] ?? ($item['endereco'] ?? null);
    $lat = isset($item['latitude']) ? floatval($item['latitude']) : (isset($item['lat']) ? floatval($item['lat']) : null);
    $lng = isset($item['longitude']) ? floatval($item['longitude']) : (isset($item['lng']) ? floatval($item['lng']) : null);
    $phone = $item['phone'] ?? ($item['telefone'] ?? null);
    $raw = json_encode($item, JSON_UNESCAPED_UNICODE);

    $insert->execute([$name, $address, $lat, $lng, $phone, $raw]);
    $count++;
}

echo "Importados: $count escritórios para " . DB_FILE . "\n";
