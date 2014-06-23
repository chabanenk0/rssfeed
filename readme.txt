readme.
This is the simple rss reader, used only native php.

Configuration:
1. Create new mysql user by using mysql commands with root priviledges:
CREATE USER 'rssuser'@'localhost' IDENTIFIED BY '111';
CREATE DATABASE rssfeed;
GRANT ALL ON rssfeed.* to rssuser@localhost;

2. configure mysql login and pass in the file config.php,
edit the following lines:
    $mysqlServer = 'localhost';
    $mysqlUser   = 'rssuser';
    $mysqlPass   = '111';

3. Run create.php file for creating database structure: php create.php, or request this file from browser: http://localhost/rssfeed/create.php
After creation of the database structure, the file create.php should be removed to avoid its running by other persons.

4. Fill the file feeds.txt with the url's of the rss feeds. 

5. run the file parse.php, which updates the mysql table with new incomming records.

6. use list.php in order to watch the downloaded feeds.

The structure of the table 'news' is the following:
id - id number (key field, auto-increment)
title - the title of the news (text field);
content - contains news text (long text field)
source - number of the source feed (number of the line in feeds.txt, which corresponds to the source feed url of this news record.
date - the news publishing date, is taken from the rss data

