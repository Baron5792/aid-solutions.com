<?php
    include __DIR__ . "/./partials/header.php";
    

    if (isset($_SESSION['user'])) {
        if (isset($_GET['job-id']) && isset($_GET['id'])) {
            $chatId = $_GET['job-id'];
            $userId = $_GET['id'];

            // fetch the job owner's details
            $queryOwner = mysqli_query($connection, "SELECT * FROM job WHERE job_id= '$chatId' LIMIT 1");
            if (mysqli_num_rows($queryOwner) == 1) {
                $data = mysqli_fetch_assoc($queryOwner);
                $owner = $data['contact_name'];
            }
        }

        else {
            header('location: ' . URL . "user/dashboard.php");
        }


    }

    else {
        header('location: ' . URL . 'account/login.php');
    }
?>

<script>
    document.getElementById("title_title").innerHTML = "Chat on aid-solutions";
</script>

<style>
    .chatbox-modal {
        background-color: #f9f9f9;
        border: 1px solid #ddd;
        border-radius: 0px 0px 10px 10px;
        max-width: 600px;
        margin: 0px auto;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        display: block;
    }

    .chatbox-header {
        background-color: #F0F0F0;
        color: white;
        padding: 15px;
        /* text-align: center; */
        border-bottom: 1px solid #ddd;
    }

    .chatbox-messages {
        padding: 15px;
        max-height: 300px;
        overflow-y: auto;
    }

    .message {
        margin-bottom: 10px;
        padding: 2px 10px 1px 10px;
        border-radius: 3px;
        position: relative;
        width: fit-content;
        max-width: 75%;
    }

    .message.received {
        background-color: #e9ecef;
        align-self: flex-start;
    }

    .message.sent {
        background-color: #007bff;
        color: white;
        align-self: flex-end;
        margin-left: auto;
    }

    /* .time {
        font-size: 0.8rem;
        color: #666;
        margin-top: 5px;
        display: block;
        text-align: right;
    } */

    .chatbox-input {
        display: flex;
        border-top: 1px solid #ddd;
        padding: 10px;
    }

    .chatbox-input input {
        flex: 1;
        border: none;
        padding: 10px;
        border-radius: 5px;
        outline: none;
    }

    .chatbox-input button {
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 5px;
        padding: 10px;
        margin-left: 10px;
        cursor: pointer;
    }

    .chatbox-input button i {
        font-size: 1.2rem;
    }

</style>




<div class="chatbox-modal">
    <div class="chatbox-header">
        <h4><?= $owner ?> <span class="fas fa-check-circle text-primary" style="font-size: 15px"></span></h4>
        
    </div>
    <div class="chatbox-messages" id="chatbox-messages">
            <!-- Existing messages will be loaded here via PHP -->
                <!-- admin -->
                <?php
                    $fetchChat = mysqli_query($connection, "SELECT * FROM chat WHERE user_id= '$userId' AND job_id= '$chatId'");
                    if (mysqli_num_rows($fetchChat) > 0) {
                        foreach ($fetchChat as $row) {
                            $message = $row['message'];
                            $track = $row['track'];
                            $date = $row['date'];
                            $formattedDate = date('h:i A', strtotime($date));
                ?>

                        <!-- admins chat -->
                        <?php if ($track == "2"): ?>
                            <div class="message received">
                                <p><?= $message ?></p>
                            </div>

                        <!-- users chat -->
                        <?php elseif ($track == "1"): ?>
                            <div class="message sent">
                                <p><?= $message ?></p>
                                <span class="time"><?= $formattedDate ?></span>
                            </div>
                        <?php endif ?>
                <?php
                        }
                        
                        
                    }

                    else {
                        echo "Newer messages would appear here";
                    }
                ?>
                        
    </div>
    <div class="chatbox-input">
        <input type="text" id="message-input" placeholder="Type your message...">
        <button id="send-message" type="submit"><i class="fas fa-paper-plane"></i></button>
    </div>
</div>




<script>
    window.onload = function() {
        setTimeout(function() {
            const chatboxMessages = document.getElementById('chatbox-messages');
            chatboxMessages.scrollTop = chatboxMessages.scrollHeight;
            // console.log('Scroll position:', chatboxMessages.scrollTop);  // Debugging line
        }, 100);
    };


    document.getElementById('send-message').addEventListener('click', function() {
        const message = document.getElementById('message-input').value;
        const userId = <?= $userId ?>;
        const jobId = <?= $chatId ?>;

        if (message.trim() !== '') {
            // Send the message using Fetch API
            fetch('send_message.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    user_id: userId,
                    job_id: jobId,
                    message: message
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Append the new message to the chatbox
                    const chatboxMessages = document.getElementById('chatbox-messages');
                    const newMessage = `
                        <div class="message sent">
                            <p>${message}</p>
                            <span class="time">${data.time}</span>
                        </div>
                    `;
                    chatboxMessages.innerHTML += newMessage;
                    chatboxMessages.scrollTop = chatboxMessages.scrollHeight;

                    // Clear the input field
                    document.getElementById('message-input').value = '';
                } else {
                    alert('Failed to send message.');
                }
            });
        }
    });
</script>



<?php 
    include __DIR__ . "/./partials/footer.php";
?>