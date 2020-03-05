# Qlinic
Team 529B's project for APSC100 Module 3

The purpose of this repository is to facilitate the storage and development of source code surrounding the Qlinic appliciaton.

# Filestructure
Understanding the filestructure is key to developing the application. Here is a rough rundown, noting some key files:
```
├───api   ------------  This folder contains the PHP scripts used by the API
│  ├───.tests   ------  These are special scripts used to test the API
│  ├───appointments  -  This contains the API files for appointments
│  └───queue   -------  This contains the API files for queueing
├───backend   --------  This contains the PHP scripts used to interface with the backend
│  ├───appointments.php This contains the backend functions to interface with the appointment tables
│  ├───config.php  ---  This is a files that can be used to store config values, and is included by utils
│  ├───queue.php   ---  This contains the backend functions to interface with the queueing tables
│  ├───utils.php   ---  This contains a variety of utilites, such as useful constants and a database connection
├───public   ---------  This contains any files to be accessed by the public
│  ├───appointments --  This contains the frontend pages for appointment booking
│  ├───queue   -------  This contains the frontend pages for queueing
│  ├───RIO   ---------  This contains the frontend pages for the receptionist interface
│  ├───images   ------  This contains any images used by the frontend
|  │  ├───logo.svg ---  The website logo
│  ├───scripts   -----  This contains the various script files used by the frontend
|  │  ├───dialog.js  -  This is a script used to generate dialog boxes
│  ├───shared   ------  This contains any elements used on multiple pages (like the header)
|  │  ├───header.php -  This is the file containing the header
|  │  ├───meta.html  -  This file contains metadata shared by all pages
│  └───styles   ------  This contains the stylesheets used by various pages
|  │  ├───main.css  --  The primary stylesheet for all pages
```
