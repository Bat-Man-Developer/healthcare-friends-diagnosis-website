<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>WORDBRAIN-S33</title>
</head>
<body>
    <div class="container">
        <h1>WORDBRAIN-S33 LLM</h1>
        <p style="color: red; font-weight: bold; text-align: center;">Note: Python code wont run on a free server</p>
        <div class="chat-container" id="chatContainer"></div>
        <div class="input-container">
            <input type="text" id="userInput" placeholder="Type your message...">
            <button onclick="sendMessage()">Send</button>
        </div>
    </div>

    <script>
        const chatContainer = document.getElementById('chatContainer');
        const userInput = document.getElementById('userInput');

        async function sendMessage() {
            const message = userInput.value.trim();
            if (!message) return;

            addMessage(message, 'user-message');
            userInput.value = '';
            userInput.focus();

            const loadingDiv = addMessage('Thinking', 'ai-message loading');

            try {
                const response = await fetch('api.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ input: message })
                });

                const data = await response.json();
                loadingDiv.remove();

                if (data.status === 'success') {
                    addMessage(data.response, 'ai-message');
                } else {
                    addMessage('Error: Unable to generate response', 'ai-message');
                }
            } catch (error) {
                loadingDiv.remove();
                addMessage('Error: Unable to connect to the server', 'ai-message');
            }
        }

        function addMessage(text, className) {
            const messageDiv = document.createElement('div');
            messageDiv.className = `message ${className}`;
            messageDiv.textContent = text;
            chatContainer.appendChild(messageDiv);
            chatContainer.scrollTop = chatContainer.scrollHeight;
            return messageDiv;
        }

        userInput.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') {
                sendMessage();
            }
        });

        // Add subtle parallax effect on mouse move
        document.addEventListener('mousemove', (e) => {
            const container = document.querySelector('.container');
            const xAxis = (window.innerWidth / 2 - e.pageX) / 100;
            const yAxis = (window.innerHeight / 2 - e.pageY) / 100;
            container.style.transform = `rotateY(${xAxis}deg) rotateX(${yAxis}deg)`;
        });
    </script>
</body>
</html>