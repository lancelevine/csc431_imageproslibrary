# Image Processing Library

The goal of this project is to provide a database that will scalably manage collections of images. The images will be easily searchable through an intuitive UI and the system will have an API to access images by various processing pipelines. The UI will provide users with an annotation service, a service to view both collections of images and individual images, and a download service to download single or multiple images. 

+ index.php Contains the bulk of the code.
+ style/style.css contains the majority of the CSS styling

In order to deploy this code, all that is needed is a server that has PHP and MySQL installed. The files can simply be copied into the public_html folder of the server. The new database name, username, and password must be changed in all PHP files that interact with the database. It is also necessary to run the SQL commands in the sqlcommands.sql file in order to set up the database properly.
