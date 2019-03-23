# Quiz
This is a group project for a Database II course. We are using PHP OCI for backend and *a very big blank* for frontend.

# Setup

First you have to install the required programs:

* [*`Xampp`*](https://www.apachefriends.org/hu/index.html)

* [*`Oracle database`*](https://www.oracle.com/technetwork/database/enterprise-edition/downloads/index.html)

  During installation remember your global database name and password! To check your database open cmd and type in: `sqlplus system` and then your own password.

* [*`Instantclient 12_2`*](https://www.oracle.com/technetwork/topics/winx64soft-089540.html)

  Put this folder into *C:\Oracle* and add *C:\Oracle\instantclient_12_1* to your PATH system variable.

To have a connection to your local database, give your connection the name: **system** and the password: **Aladar12**. Change your php.ini file from xampp by clicking on Config ->  PHP(php.ini) and uncomment these lines: `the extension=oci8_12c` `extension=php_oci8_12c.dll`.
After starting Apache you should be able to access your database from the code. 

After this, clone the repository in your *xampp\htdocs* folder and you are good to go.

# What we learned

* Oracle database
* PHP OCI
