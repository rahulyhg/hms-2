<?php require_once('config/config.php'); ?>
<?php require_once(INCLUDES_DIR . '/header.php'); ?>
<?php __autoload('email'); ?>

<body>
<div class="main">

  <?php require_once(INCLUDES_DIR . "/top_menu.php"); ?>

  <div class="content">
    <div class="content_resize">
      <div class="mainbar">
        <div class="article">
        <?php
          if(isset($_POST['submitMail']) && !empty($_POST['submitMail']))
          Validate::contactFormValidation($_POST);
        ?>
          <h2>Contact</h2>
          <p>You can use the form below to communicate with your parties.</p>
        </div>
        <div class="article">
          <h2>Send  mail</h2>
          <form action="contact.php" method="post" name="contactEmail">
          <ol><li>
            <label for="name">Name (required)</label>
            <input id="name" name="name" class="text" value="<?php echo (!empty(Validate::$errors) && sizeof(Validate::$errors) > 0) || (!empty(Validate::$empty) && sizeof(Validate::$empty) > 0) ? strip_tags(trim($_POST['name'])) : '' ?>" />
          </li><li>
            <label for="email">Email Address (required)</label>
            <input id="email" name="email" class="text" value="<?php echo (!empty(Validate::$errors) && sizeof(Validate::$errors) > 0) || (!empty(Validate::$empty) && sizeof(Validate::$empty) > 0) ? strip_tags(trim($_POST['email'])) : '' ?>" />
          </li><li>
            <label for="subject">Subject</label>
            <input id="subject" name="subject" class="text" value="<?php echo (!empty(Validate::$errors) && sizeof(Validate::$errors) > 0) || (!empty(Validate::$empty) && sizeof(Validate::$empty) > 0) ? strip_tags(trim($_POST['subject'])) : '' ?>" />
          </li><li>
            <label for="message">Your Message</label>
            <textarea id="message" name="message" rows="8" cols="50"><?php echo (!empty(Validate::$errors) && sizeof(Validate::$errors) > 0) || (!empty(Validate::$empty) && sizeof(Validate::$empty) > 0) ? strip_tags(trim($_POST['message'])) : '' ?></textarea>
          </li><li>
            <input type="hidden" name="submitMail" id="submitMail" value="contact email" />           
            <a href="javascript:document.contactEmail.submit()" >
            <img src="images/submit.gif" class="send" border="0" alt="Submit this form" name="submitMail" />
            </a>
            <div class="clr"></div>
          </li></ol>
          </form>
        </div>
      </div>
      <div class="sidebar">
        <div class="searchform">
          <?php echo (isset($_SESSION['id_employee']) && !empty($_SESSION['id_employee'])) ? "<img src='images/userpic.gif' align='top' />&nbsp;Welcome ".$_SESSION['firstname']." ".$_SESSION['lastname']."!&nbsp;&nbsp;<a href='index.php?ToDo=logout'>(Logout)</a>" : ""; ?>
        </div>
         <?php require_once(INCLUDES_DIR . '/mainmenu.php'); ?>
      </div>
      <div class="clr"></div>
    </div>
  </div>

  <div class="fbg">

      <div class="clr"></div>
    </div>
  </div>
    <?php require_once(INCLUDES_DIR . '/footer.php'); ?>
  </div>
</div>
</body>
</html>