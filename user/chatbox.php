
    <style>
        /* Styles for Chat Icon */
        .chat-icon {
            position: fixed;
            bottom: 70px;
            left: 20px;
            width: 60px;
            height: 60px;
            background-color: #007bff;
            color: white;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            z-index: 1000;
        }

        .chatbox {
            position: fixed;
            bottom: 130px;
            left: 20px;
            width: 90%;
            max-width: 350px;
            /*border: 1px solid #ddd;*/
            border-radius: 10px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            background-color: white;
            display: none;
            z-index: 1000;
        }

        .chatbox-header {
            padding: 10px;
            background-color: white;
            color: black;
            font-weight: bold;
            /*text-align: center;*/
            border-bottom: 1px solid #ddd;
        }
        
        .chatbox-header h5 {
            margin-bottom: 0px;
        }
        
        .status-indicator {
          width: 10px;
          height: 10px;
          border-radius: 50%;
          margin-right: 5px;
        }
        
        .online {
          background-color: green; /* Green color for online status */
        }

        .chatbox-messages {
            height: 200px;
            overflow-y: auto; /* Enables scrolling */
            padding: 10px;
            background-color: #F8F9FA;
            font-size: small;
        }

        .chatbox-input {
            padding: 10px;
            border-top: 1px solid #ddd;
            background-color: #f8f9fa;
        }

        .message {
            margin-bottom: 10px;
        }

        .message.user {
            text-align: right; /* Aligns user messages to the right */
            color: blue;
            font-size: small;
        }

        .message.bot {
            text-align: left;
            color: grey;
        }

        .typing-indicator {
            display: none;
            color: gray;
            font-style: italic;
        }
        
        @media screen and (min-width: 0px) and (max-width: 767px) {
            .chat-icon {
                position: fixed;
                bottom: 90px;
                left: 10px;
                width: 50px;
                height: 50px;
                background-color: #007bff;
                color: white;
                border-radius: 50%;
                display: flex;
                justify-content: center;
                align-items: center;
                cursor: pointer;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
                z-index: 1000;
            }
            
            .chatbox {
                bottom: 113px;
            }
        }
        
        @media screen and (max-width: 768px) {
            .chat-icon {
                bottom: 60px;
            }
            
            .chatbox {
                bottom: 110px;
                left: 10px;
            }
        }
    </style>

    <div class="chat-icon" onclick="toggleChatbox()">
        <i class="fas fa-comment-dots"></i> <!-- Font Awesome icon -->
    </div>



    <div class="chatbox" id="chatbox">
        <div class="chatbox-header">
            <h5>Aid-Solutions <i class="status-indicator online"></i></h5>
            <small>Typically replies in a few seconds</small>
        </div>
        <div class="chatbox-messages text-secondary" id="messages">
            <!-- Messages will appear here -->
            <div id="typingIndicator" class="typing-indicator">Bot is typing...</div>
        </div>
        <div class="chatbox-input">
            <input type="text" id="userInput" class="form-control" placeholder="Type your message..." />
            <button class="btn btn-primary mt-2 btn-sm w-100" onclick="sendMessage()">Start Conversation</button>
            <div class="mt-2">
                <p class="small text-center"><i class="fas fa-globe"></i> Powered by Chatwoot</p>
            </div>
        </div>
    </div>
    
    
    

    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script>
        function toggleChatbox() {
            const chatbox = document.getElementById('chatbox');
            chatbox.style.display = (chatbox.style.display === 'none' || chatbox.style.display === '') ? 'block' : 'none';
        }

        function sendMessage() {
            const userMessage = document.getElementById('userInput').value;
            if (userMessage.trim() === '') return; // Prevent empty messages

            displayMessage('you: ' + userMessage, 'user');
            document.getElementById('userInput').value = ''; // Clear input field

            // Show typing indicator
            const typingIndicator = document.getElementById('typingIndicator');
            typingIndicator.style.display = 'block';

            // Simulated delay for bot response
            setTimeout(() => {
                typingIndicator.style.display = 'none'; // Hide typing indicator
                const botResponse = getBotResponse(userMessage);
                displayMessage('bot: ' + botResponse, 'bot');
            }, 4000);
        }

        function displayMessage(message, sender) {
            const messagesDiv = document.getElementById('messages');
            const messageElement = document.createElement('div');
            messageElement.className = 'message ' + sender;
            messageElement.textContent = message;
            messagesDiv.appendChild(messageElement);

            // Ensure new messages are visible
            messagesDiv.scrollTop = messagesDiv.scrollHeight;
        }

        function getBotResponse(message) {
            if (message.toLowerCase().includes('payment')) {
                return 'Go to My profile page and click on the withdraw funds button to proceed with your payment';
            }
            
            if (message.toLowerCase().includes('paid')) {
                return 'On AID, users get paid by completing assigned tasks successfully. After a job is reviewed and approved by the client, users can claim their payment. To initiate a withdrawal, they should go to the “My Profile” page and follow the provided steps to request their funds.';
            }

            else if (message.toLowerCase().includes('hello') || message.toLowerCase().includes("hi")) {
                return 'Hello and Welcome to Aid-Solutions, how can I assist you today?';
            } 
            
            else if (message.toLowerCase().includes('hey') || message.toLowerCase().includes("hi")) {
                return 'Hello and Welcome to Aid-Solutions, how can I assist you today?';
            } 
            
            else if (message.toLowerCase().includes("pay")) {
                return 'Payments are made when a user has completed a task successfully. Go to the My profile page to claim your payment';
            } 
            
            else if (message.toLowerCase().includes('apply')) {
                return 'To apply for a job, click on the job you’re interested in and follow the instructions to submit your application.';
            }
            
            else if (message.toLowerCase().includes('withdraw')) {
                return 'To withdraw funds, go to My Profile > Withdraw Funds. Make sure your payment details are up to date.';
            }
            
            else if (message.toLowerCase().includes("good")) {
                return 'Payments are made when a user has completed a task successfully. Go to the My profile page to claim your payment';
            } 
            
            else if (message.toLowerCase().includes('help')) {
                return 'I’m here to help! Please ask me specific questions about jobs, payments, profile setup, and more.';
            }
            
            else if (message.toLowerCase().includes('deadline')) {
                return 'Each job has its own deadline. Check the job details to see the submission date and plan accordingly.';
            }
            
            else if (message.toLowerCase().includes('support')) {
                return 'For further assistance, you can contact our support team via the Help section or email support@aid-solutions.com.';
            }
            
            else if (message.toLowerCase().includes('resume') || message.toLowerCase().includes('cv')) {
                return 'You can upload your resume in the My Profile section. A strong resume increases your chances of getting hired!';
            }
            
            else if (message.toLowerCase().includes('transaction')) {
                return 'Transaction details and history can be viewed under My Profile > Withdraw Funds > Transactions. Keep track of all your earnings here!';
            }
            
            else if (message.toLowerCase().includes('rating') || message.toLowerCase().includes('review')) {
                return 'Your rating is based on job completion and client feedback. Consistently deliver quality work to maintain a high rating!';
            }
                        
            else {
                return 'If you’re unable to find an answer here, please visit our Contact Us page for further assistance. Our support team is ready to help!';
            }
        }
    </script>

