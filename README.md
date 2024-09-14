## O-DINOR Clothing Website
O-DINOR is a clothing website designed to provide a seamless shopping experience for customers. Built using PHP, MySQL, HTML, CSS, and JavaScript, this project features a modern interface, user account management, and a robust admin panel for managing inventory, orders, and customer interactions.

### Table of Contents
Features
<br>
Installation<br>
Usage<br>
Configuration<br>
Contributing<br>
License<br>
Acknowledgements<br><br>

### Features<br>

#### Product Management: Manage clothing items, categories, sizes, colors, and stock levels.
#### Order Processing: Handle customer orders, including checkout and payment processing.
#### Admin Panel: Secure admin access to manage products, view orders, and update statuses.
#### Responsive Design: Fully responsive layout, ensuring a great experience on all devices.<br>

### Installation

Clone the repository

Copy code<br>
git clone https://github.com/AkashMaheema/o-dinor-new.git<br>
cd o-dinor-new<br>

### Set up the database

Create a MySQL database.
Import the provided SQL file (o_dinor.sql) located in the folder.
Configure the environment

update with your database credentials.
(configdb.php)

Copy code
composer install
Set up the server

Make sure your server (Apache, xampp, etc.) is configured to serve this project.
Point the server’s document root to the public directory of your project.
Usage

###Access the application

Visit your website URL (http://localhost/o-dinor-new/o-Dinor_front/index.php) to access the store.<br>
Admin Access (http://localhost/o-dinor-new/o-Dinor_back/login.php)<br>

#### Log in to the admin panel using default admin credentials:
Username: admin<br>
Password: 123<br>

### Manage Products and Orders

Use the admin panel to add, update, or delete products, and manage customer orders.<br>

#### Configuration
Environment Variables

Configure the database and other settings in the configdb.php file:<br>

DB_HOST=localhost<br>
DB_NAME=o_dinor<br>
DB_USER=yourusername<br>
DB_PASS=yourpassword<br>

### File Permissions

Ensure that the uploads and cache directories are writable by the web server.

### Acknowledgements
Thanks to all contributors and open-source libraries used in this project.<br>
Special thanks to Group AU for design/technical support.<br>

### Demo Version 
O-Dinor Official Website : http://18.141.194.228/o-Dinor_front/
<br>
O-Dinor Admin Panel : http://18.141.194.228/o-Dinor_back/login.php
