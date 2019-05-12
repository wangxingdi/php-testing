<?php
/* ----------INSTRUCTIONS -----------*/
/* BE VERY CAREFUL WHEN GIVING DATABASE INFORMATION OTHERWISE YOUR SITE WON'T RUN PROPERYL. 
 # EDIT THE BELOW INFORMATION WITH YOUR DATABASE DETAILS. KEEP THE SINGLE QUOTES, DON'T REMOVE THEM.
 # localhost - Change it only if your host is not a localhost. If you're not sure, don't change it and try your luck. If the site is not working, check the email that contains your hosting purchase details. That may contain the host name. If that doesn't, please contact your server provider or just contact us and we will help.
 # username_of_your_db_user - Put the username of the user that you created to access your database.
 # password_of_your_db_user - Put the password of your user that you created to access your database.
 # your_db_name - Put the name of the database that you newly created for your website.
 # DON'T CHANGE ANY OTHER CODE.
*/
$mysqli = new mysqli();
$mysqli->connect('localhost', 'username_of_your_db_user', 'password_of_your_db_user', 'your_db_name');
if ($mysqli->connect_errno) { echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error; }
?>