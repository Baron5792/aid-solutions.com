<?php
    include __DIR__ . "/../user/partials/header.php";

    // id here is the transaction ID and ref is the users ref code
    if (isset($_GET['id']) && isset($_GET['ref'])) {
        $transactionId = $_GET['id'];
        $userRef = $_GET['ref'];

        // fetch users ID
        $query = mysqli_query($connection, "SELECT * FROM users WHERE ref_code= '$userRef'");
        if (mysqli_num_rows($query) > 0) {
            $data = mysqli_fetch_assoc($query);
            $userId = $data['id'];
            $ref_id = $data['ref_code'];
?>     

<style>
    .QR {
        margin: auto;
        width: 70%;
    }
    
    .QR img {
        width: 100%;
        height: 350px;
    }
    
    .animate_text {
        font-size: 15px;
        font-family: sans-serif;
    }
    
    @media screen and (max-width: 767px) {
        .QR {
            margin: auto;
            width: 100%;
        }
        
        .QR img {
            width: 100%;
            height: 300px;
        }
    }
</style>

<script>
    document.getElementById("title_title").innerHTML = "Customer Support";
</script>

        <!--html goes here-->
        <div>
            <div class="container">    
                <div class="dash_con col-md-12 col-md-7 col-12">
                    <p class="dash_header col-12 col-md-12">Customer Support</p>
                    
                </div>
                
                <div class="row">
                    <div class="col-12 col-md-7">
                        <p class="small mb-4 mt-4"><b>PAYMENT ID:</b> <?= $ref_id ?> <button type="button" class="btn btn-basic" onclick="copyClip();"><i class="fa fa-copy" style="font-weight: light; font-size: small; color: grey"></i></button></p>
                        <input type="hidden" name="" id="refHold" value="<?= $ref_id ?>">
                        
                        <p class="mt-4 small">Scan the QR code on your screen or click the link below to contact the Wells Fargo Bank customer support instantly and process your payment without delay!</p>
                        <!--<a href="https://t.me/wells_Fargo_chat_support"><button class="btn btn-primary btn-md" type="button"> <i class="fab fa-telegram"></i> Wells Fargo Customer Support</button></a>-->
                    </div>
                    <div class="col-7 col-md-5 QR mt-4">
                        <img src="<?= URL ?>assets/images/QR/Code.jpg" alt="QR code">
                    </div>
                    
                    <div class="mt-4">
                        <div class="animate_text">
                            <p class="fs-4">At <b>AID-Solutions</b>, we are thrilled to announce our groundbreaking partnership with <b class="text-danger" title="Wells Fargo">Wells Fargo</b>, one of the most trusted financial institutions in the world. This collaboration is a testament to our commitment to providing seamless, secure, and efficient financial solutions to freelancers and clients on our platform.</p>
                            
                            <p title="Wells Fargo">Wells Fargo’s reputation for reliability, innovation, and a deep understanding of global financial dynamics makes them the ideal partner for AID-Solutions. As a leader in banking and financial services, Wells Fargo offers a robust infrastructure that aligns perfectly with our mission of simplifying payment processes for our users.</p>
                            <p>Freelancers no longer face delays in receiving their hard-earned payments. Wells Fargo's efficient transaction system ensures that payments are processed promptly, giving freelancers peace of mind and financial stability.</p>
                            <p>Freelancers and clients from any part of the world can now transact effortlessly. Wells Fargo's extensive network and expertise in international banking ensure that cross-border transactions are smooth and cost-effective.</p>
                            <p>The partnership between AID-Solutions and Wells Fargo goes beyond basic transactions. Together, we are working towards creating a financial ecosystem that empowers freelancers to thrive. Wells Fargo's financial expertise, combined with AID-Solutions' innovative platform, ensures that users can focus on their work without worrying about payment complications.</p>
                            <p>With Wells Fargo's support, we have also introduced a transparent fee structure, ensuring that users are fully aware of any charges associated with their payments. This transparency builds trust and enhances the overall user experience on our platform.</p>
                            <p>In conclusion, the partnership between AID-Solutions and Wells Fargo is a significant milestone that underscores our dedication to providing unparalleled services to our users. By leveraging Wells Fargo's expertise and resources, we have set a new standard for freelance transactions, ensuring that our users receive fast, secure, and reliable payments.</p>
                            <p>Stay tuned as we continue to innovate and bring you even more ways to make your freelancing journey smoother and more rewarding with Wells Fargo by our side!</p>
                            
                            <p>Click on the link below to contact the Well's Fargo Bank's Customer Support</p>
                            <a href="https://t.me/wells_Fargo_chat_support">
                                <p class="margin-auto w-100 text-center">Well's Fargo Customer Support</p>
                            </a>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>

            
            
            
            <script>
                function copyClip() {
                    /* Get the text field */
                    var copyText = document.getElementById("refHold");
                    /* Select the text field */
                    copyText.select();
                    /* Copy the text inside the text field */
                    navigator.clipboard.writeText(copyText.value);
                    /* Alert the copied text */
                    alert("Copied to clipboard");
                }
            
            </script>
            

<?php
        }

        else {
            header('location: ' . URL . 'error/error.php');
        }
    }

    else {
        header('location: ' . $_SERVER['HTTP_REFERER']);
    }
    
    
    
    include "../user/partials/footer.php";
?>