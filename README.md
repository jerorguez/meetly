# Meetly
![](https://i.imgur.com/uknsMYu.png)
![](https://i.imgur.com/fZMnFuW.png)

---

## Overview

Mini-project created in web application development studios.

**Meetly** is an application for the management and creation of events programmed in PHP and MySQL.

---

## Usage requirements

To run the application you only need to have PHP, Xampp and Composer installed.

Once you have composer installed you simply need to run the command `composer install` in the terminal from the root of the project.

When you install the dependencies you only need to create the includes folder in the root of the project and in it create the `.env` file that will store the necessary variables for the database connection.

![](https://i.imgur.com/95ToX6O.png)

```bash
# Environment variables for database connection
DH_HOST = "[localhost/server]"
DB_USER = "[myUsername]"
DB_PASS = "[myPasswd]"
DB_NAME = "[databaseName]"
```

**Note**: If running locally the file must be opened from the `public/` directory.

The project documentation can be found inside `doxygen/html/`.

---
Jerobel Rodriguez - [@jerorguez](https://github.com/jerorguez)