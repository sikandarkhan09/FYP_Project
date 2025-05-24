function sendMessage() {
    const message = document.getElementById('message').value;
    const receiver = document.getElementById('receiver').value;

    if (!receiver || !message) return;

    fetch('send_message.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `receiver_id=${receiver}&message=${encodeURIComponent(message)}`
    })
    .then(() => {
        document.getElementById('message').value = '';
        fetchMessages();
    });
}

function fetchMessages() {
    const receiver = document.getElementById('receiver').value;
    if (!receiver) return;

    fetch('fetch_messages.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `receiver_id=${receiver}`
    })
    .then(response => response.json())
    .then(messages => {
        const chatBox = document.getElementById('chat-box');
        chatBox.innerHTML = '';
        messages.forEach(msg => {
            const div = document.createElement('div');
            div.textContent = `${msg.timestamp} - ${msg.sender_id === userId ? 'You' : 'Them'}: ${msg.message}`;
            chatBox.appendChild(div);
        });
        chatBox.scrollTop = chatBox.scrollHeight;
    });
}

setInterval(fetchMessages, 3000);