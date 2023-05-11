<?php

$commands_file = 'commands.json';
$commands = json_decode(file_get_contents($commands_file), true);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $content = file_get_contents('php://input');
    if (isset($commands[$content])) {
        $command = $commands[$content]['command'] . ' &';
        $output = array();
        exec($command, $output);
        foreach ($output as $line) {
            echo htmlspecialchars($line) . "<br>";
        }
    } else {
        echo "Comando no válido";
    }
}

?>
