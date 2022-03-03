<!DOCTYPE html>

<!--HTML Components from https://getbootstrap.com/docs/5.1/examples/ using Bootstrap CDN-->

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">
    <title><?= ($html_title) ?></title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> <!--CDN for jquery library needed for ajax functions-->
    <script src="<?= ($BASE) ?>/app/assets/js/f3sample.js"></script>                                        <!--Used in ajax/jquery in MainController-->
    <!-- Bootstrap core CSS  - updated by WG to the CDN link from https://getbootstrap.com/docs/5.1/getting-started/introduction/-->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet"> <!--from https://www.bootstrapcdn.com/ -->
    <!-- Custom styles for this template -->
    <link href="<?= ($BASE) ?>/app/assets/css/base.css" rel="stylesheet">
    <link href="<?= ($BASE) ?>/app/assets/css/dashboard.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= ($BASE) ?>/app/assets/css/theme.css" type="text/css"/>
    <link rel="stylesheet" href="<?= ($BASE) ?>/app/assets/css/StyleSheet.css">
    <link rel="icon" href="<?= ($BASE) ?>/favicon.ico">
</head>
</head>
<body>
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
<?php echo $this->render('header.html',NULL,get_defined_vars(),0); ?>
<b>This form is in Register.html. It is not called by Template.html</b>


<script>
    // capture whether any image was provided to opt out of processing a null image in pagecontroller
    function validateForm() {
        var imageoffered = document.forms["Register"]["pic_file"].value;
        if (imageoffered == "" || imageoffered == null) {
            document.getElementById('imageprovided').value = 0;
            // return false;
        }
    }

    //Set dob default to today in format required by SQL
    document.getElementById('dob').placeholder = new Date().toISOString();

</script>
<form id="Register" name="Register" enctype="multipart/form-data" method="POST" action="<?= ($BASE) ?>/NewUser" onsubmit = "return validateForm()">

    <p>Please enter your details:</p>
    <input name="forename" type="text" placeholder="First name" id="forename" value="" required size="35"/><br>
    <input name="surname" type="text" placeholder="Last name" id="surname" size="35" /><br>
    <input name="postcode" type="text" placeholder="Home Postcode" id="postcode" size="35" /><br>
<!--    get some regex validation-->

    <input name="email" type="email" placeholder="Email address (this will be your login)" id="email" size="35" required/><br>

<!--    need a method to send email to user confirming their identity (added new field to users - 'confirmed'-->
    <input name="password" type="password" placeholder="Account Password (min 5 characters)" id="password" minlength="5" size="35" required/>
<!--    need to include some password verification process-->

    <br>
    <br>
    <label for="gender">Gender</label><br>
    <select id="gender" name="gender">
        <option value="Not disclosed">I don't want to say</option>
        <option value="Male">Male</option>
        <option value="Female">Female</option>
        <option value="Non-binary">Non-binary</option>
    </select>


    <p>Date of birth </p>
    <input name="dob" type="date" placeholder="dd-mm-yyy" id="dob" size="30" value="1900-09-19"/>
    <br>


    <p>Your picture </p>
    <img id = "pic" src="<?= ($BASE) ?>/app/assets/images/Person.png" width="100" alt="Placeholder picture"><br>
    <input hidden name="imageprovided" type="text" placeholder="imageprovided" id="imageprovided" size="1" value="1" />
    - need to figure out a script to replace this with the uploaded image
    <input name="pic_file" type="file" placeholder="Your photo (jpeg, png or gif with size < 2 Mb)', 'image/gif'" id="pic_file" size="30" />


    <p>Facebook username </p>
    <input name="facebook_username" type="text" placeholder="Facebook username" id="facebook_username" size="30" />
    <br>    <br>
    <!--- how or where do we add the prefix "https://www.facebook.com/" to this trimmed field? Also, some validation... is this you? --->


    <label for="hidden">Visibility</label><br>
    <select id="hidden" name="hidden">
        <option value="No">Let other people see that I've joined an event</option>
        <option value="Yes">Hide me from other users seeing I've joined an event</option>
    </select>


    <br>    <br>
    <input type="submit" name="Submit" value="Submit" />
    <input type="reset"/>

</form>
<?php echo $this->render('footer.html',NULL,get_defined_vars(),0); ?>
</body>
</html>
