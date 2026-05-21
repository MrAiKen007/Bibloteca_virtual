<?php
$data = [
    'nome' => 'Test User',
    'email' => 'gkleber187@gmail.com', // Duplicate email
    'password' => '12345678'
];

$options = [
    'http' => [
        'header'  => "Content-type: application/json\r\n",
        'method'  => 'POST',
        'content' => json_encode($data),
        'ignore_errors' => true
    ],
];

$context  = stream_context_create($options);
$result = file_get_contents('http://127.0.0.1/dashboard/Bibloteca_virtual/biblioteca/public/api/registo', false, $context);

echo "Resposta:\n";
echo $result . "\n";
print_r(json_decode($result, true));
