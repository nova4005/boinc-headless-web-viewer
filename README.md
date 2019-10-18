# boinc-headless-web-viewer


This will allow you to view the tasks running on headless boinc boxes through a webpage. You can set this up on a server and put inside your web root.

This is based on running an Apache webserver. If you want to use Nginx you would just needt to adjust for not using an htaccess file and block access to the config.json file.

To set up the site to use the JSON file to store your computer credentials just rename the config.json.example to config.json. Make sure you are using Apache as your webserver as it has an htaccess rule to block viewing of the JSON file from the web. If you are using a different web server such as NGINX you can look up and set up protections for that file.