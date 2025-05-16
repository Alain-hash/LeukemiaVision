<?php
// Set your chatbot API URL here
$chatbot_api_url = 'http://localhost:5000/chatbot.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LeukemiaVision Chatbot</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }
        .chat-container {
            max-width: 600px;
            margin: 20px auto;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            height: 435px;
        }
        .chat-header {
            background-color: #003366;
            color: white;
            padding: 15px;
            border-radius: 8px 8px 0 0;
            text-align: center;
        }
        .chat-messages {
            flex: 1;
            overflow-y: auto;
            padding: 15px;
        }
        .message {
            margin-bottom: 10px;
            padding: 8px 12px;
            border-radius: 18px;
            max-width: 70%;
            word-wrap: break-word;
        }
        .user-message {
            background-color: #DCF8C6;
            color: #003366;
            margin-left: auto;
        }
        .bot-message {
            background-color: #E2E2E2;
            color: #660033;
        }
        .chat-input {
            display: flex;
            padding: 15px;
            border-top: 1px solid #ddd;
        }
        .chat-input input {
            flex: 1;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }
        .chat-input button {
            background-color: #003366;
            color: white;
            border: none;
            padding: 10px 15px;
            margin-left: 10px;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
        }
        .chat-input button:hover {
            background-color: #002855;
        }
    </style>
</head>
<body>
    <div class="chat-container">
       
        <div class="chat-messages" id="chatMessages">
            <div class="message bot-message">Welcome to LeukemiaVision Chatbot! How can I help you?</div>
        </div>
        <div class="chat-input">
            <input type="text" id="userInput" placeholder="Type your message here..." autofocus>
            <button id="sendButton">Send</button>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const chatMessages = document.getElementById('chatMessages');
            const userInput = document.getElementById('userInput');
            const sendButton = document.getElementById('sendButton');
            const chatbotApiUrl = "<?php echo $chatbot_api_url; ?>";

            function addMessage(message, isUser) {
                const messageDiv = document.createElement('div');
                messageDiv.classList.add('message', isUser ? 'user-message' : 'bot-message');
                messageDiv.textContent = message;
                chatMessages.appendChild(messageDiv);
                chatMessages.scrollTop = chatMessages.scrollHeight;
            }

            async function sendMessage() {
                const message = userInput.value.trim();
                if (!message) return;

                addMessage(message, true);
                userInput.value = '';

                try {
                    const response = await fetch(chatbotApiUrl, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({ message: message })
                    });

                    const data = await response.json();
                    if (data.response) {
                        addMessage(data.response, false);
                    } else {
                        addMessage('Sorry, I did not understand that.', false);
                    }
                } catch (error) {
                    console.error('Error:', error);
                    addMessage('Sorry, I encountered an error. Please try again.', false);
                }
            }

            sendButton.addEventListener('click', sendMessage);
            userInput.addEventListener('keypress', function (e) {
                if (e.key === 'Enter') {
                    sendMessage();
                }
            });
        });
    </script>
</body>
</html>
