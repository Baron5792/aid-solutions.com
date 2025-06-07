<?php
    include __DIR__ . "/./partials/header.php";

    if (isset($_GET['chat-id']) && isset($_GET['userId'])) {
        $chatId = $_GET['chat-id'];
        $userId = $_GET['userId'];
        // query user's name
        $user = mysqli_query($connection, "SELECT * FROM users WHERE id= '$userId'");
        if (mysqli_num_rows($user) == 1) {
            $data = mysqli_fetch_assoc($user);
            $owner = $data['lastname'] . " " . $data['firstname'];
        }
?>

<style>
    .chatbox {
        background-color: #f9f9f9;
        border: 1px solid #ddd;
        border-radius: 0px 0px 10px 10px;
        max-width: 600px;
        margin: 0px auto;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        overflow: hidden;
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
        <div class="chatbox">
            <div class="chatbox-header">
                <h3>Chat with: <?= $owner ?></h3>
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
                                <?php if ($track == "1"): ?>
                                    <div class="message received">
                                        <p><?= $message ?></p>
                                    </div>

                                <!-- users chat -->
                                <?php elseif ($track == "2"): ?>
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


            <!-- chatbox -->
            <form action="<?= URL ?>admin/send-message_logic.php" method="POST">
                <input type="hidden" name="userId" value="<?= $userId ?>">
                <input type="hidden" name="jobId" value="<?= $chatId ?>">
                <div class="chatbox-input">
                    <input type="text" name="message" id="message-input" placeholder="Type your message...">
                    <button id="send-message" name="submit" type="submit"><i class="fas fa-paper-plane"></i></button>
                </div>
            </form>
        </div>



<script>
        window.onload = function() {
        setTimeout(function() {
            const chatboxMessages = document.getElementById('chatbox-messages');
            chatboxMessages.scrollTop = chatboxMessages.scrollHeight;
            // console.log('Scroll position:', chatboxMessages.scrollTop);  // Debugging line
        }, 100);
    };
</script>
<?php
    }  else {
        header('location: ' . URL . 'account/login.php');
    }
?>