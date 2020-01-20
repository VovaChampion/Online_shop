
<?php include "templates/header.php"; ?>

    <div class="contact">
        <form method="post" class="contact-form" action="contact_page.php">
            <div class="row">
                <div class="col-25">
                    <label for="name">Name</label>
                </div>
                <div class="col-75">
                    <input type="text" id="name" name="name" placeholder="Your name ..." required>
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="email">E-mail address</label>
                </div>
                <div class="col-75">
                    <input type="email" id="email" name="email" placeholder="Your email ..." required>
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="number">Telephone number</label>
                </div>
                <div class="col-75">
                    <input type="number" id="number" name="number" placeholder="Your telephone number..." required>
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="subject">Comments</label>
                </div>
                <div class="col-75">
                    <textarea id="subject" name="subject" placeholder="Write your question here ..." style="height:200px" required></textarea>
                </div>
            </div>
            <div class="row">
                <input type="submit" value="Submit">
            </div>
        </form>

        <address>Lets us know if we are not match your expectations<br> 
        via phone: 555-66-77 <br> 
        email: info@likebatman.com <br> 
        </address>

    </div>
    <?php
    if(isset($_POST["submit"])) {

        $email_to = "vova.champion@gmail.com";
        $email_subject = "You have recieved a new message";

        function died($error) {
            echo "We are very sorry, but there were error(s) found with the form you submitted. ";
            echo "These errors appear below.<br /><br />";
            echo $error."<br /><br />";
            echo "Please go back and fix these errors.<br /><br />";
            die();
        }
        
        // validation expected data exists
        if(!isset($_POST['name']) ||
            !isset($_POST['email']) ||
            !isset($_POST['number']) ||
            !isset($_POST['subject'])) {
            died('We are sorry, but there appears to be a problem with the form you submitted.');       
        }

        $name = $_POST['name'];
        $email = $_POST['email'];
        $number = $_POST['number'];
        $subject = $_POST['subject'];
    
        $error_message = "";
        $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';

        if(!preg_match($email_exp,$email)) {
            $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
        }
        
            $string_exp = "/^[A-Za-z .'-]+$/";
        
        if(!preg_match($string_exp,$name)) {
            $error_message .= 'The First Name you entered does not appear to be valid.<br />';
        }
        
        if(strlen($subject) < 2) {
            $error_message .= 'The Comments you entered do not appear to be valid.<br />';
        }
        
        if(strlen($error_message) > 0) {
            died($error_message);
        }
        
            $email_message = "Form details below.\n\n";

            function clean_string($string) {
                $bad = array("content-type","bcc:","to:","cc:","href");
                return str_replace($bad,"",$string);
            }
        
            $email_message .= "Name: " . clean_string($name)."\n";
            $email_message .= "Email: " . clean_string($email)."\n";
            $email_message .= "Telephone: " . clean_string($number)."\n";
            $email_message .= "Comments: " . clean_string($subject)."\n";
        
        // create email headers
        $headers = 'From: '. $email . "\r\n".
        'Reply-To: '. $email . "\r\n" .
        'X-Mailer: PHP/' . phpversion();
        mail($email_to, $email_subject, $email_message, $headers); 
        ?>
    
    <!-- include your own success html here -->
    <!-- <div class="container">
        <p> Thank you for contacting us. We will be in touch with you very soon. </p>
    </div> -->
    
    <?php
    
    }

    ?>
<?php include "templates/footer.php"; ?>