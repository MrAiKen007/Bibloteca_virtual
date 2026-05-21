<?php
$data = [
    'nome' => 'Test User',
    'email' => 'test' . time() . '@example.com',
    'password' => '12345678'
];

$options = [
    'http' => [
        'header'  => "Content-type: application/json\r\n",
        'method'  => 'POST',
        'content' => json_encode($data),
    ],
];

$context  = stream_context_create($options);
$result = file_get_contents('http://127.0.0.1/dashboard/Bibloteca_virtual/biblioteca/public/api/registo', false, $context);

echo "Resposta:\n";
print_r(json_decode($result, true));
echo "\nHeaders:\n";
print_r($http_response_header);
