<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Comandos</title>
</head>
<body>
    <div id="outputDiv"></div>
    <script>
        const xhr = new XMLHttpRequest();
        xhr.open('GET', 'commands.json');
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    const commands = JSON.parse(xhr.responseText);
                    for (const [name, command] of Object.entries(commands)) {
                        const button = document.createElement('button');
                        //button.textContent = name;
                        const icon = document.createElement('img');
                        icon.src = command.icon;
                        icon.alt = name;
                        button.prepend(icon);
                        button.addEventListener('click', () => {
                            sendCommand(name);
                        });
                        document.body.appendChild(button);
                    }
                } else {
                    console.log('Error al cargar los comandos');
                }
            }
        };
        xhr.send();

        function sendCommand(command) {
            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'server.php');
            xhr.setRequestHeader('Content-Type', 'text/plain');
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        document.getElementById('outputDiv').innerHTML = xhr.responseText;
                    } else {
                        document.getElementById('outputDiv').innerHTML = 'Error al enviar la solicitud';
                    }
                }
            };
            xhr.send(command);
        }
    </script>
</body>
</html>
