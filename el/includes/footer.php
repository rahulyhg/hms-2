<div class="footer">
    <div class="footer_resize">
      <p class="lf">&copy; Copyright <a href="index.php">Hospital Management System.</a></p>
      <ul class="fmenu">
        <li <?php echo (basename($_SERVER['SCRIPT_NAME']) == "index.php") ? "class='active'" : "" ?>><a href="index.php">Αρχική</a></li>
        <li <?php echo (basename($_SERVER['SCRIPT_NAME']) == "statistics.php") ? "class='active'" : "" ?>><a href="statistics.php">Στατιστικά</a></li>
        <li <?php echo (basename($_SERVER['SCRIPT_NAME']) == "appointments.php") ? "class='active'" : "" ?>><a href="appointments.php" target="_blank">Ραντεβού</a></li>
        <li <?php echo (basename($_SERVER['SCRIPT_NAME']) == "contact.php") ? "class='active'" : "" ?>><a href="contact.php">Επικοινωνία</a></li>
      </ul>
      <div class="clr"></div>
    </div>
  </div>
<?php DB::Close(); ?>  