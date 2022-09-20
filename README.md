# restApi in PHP

A very simple and dependecy free rest api for php servers.
 
#index.php 

Contains database connection for easy access and changes. Database can be change across the aplication if needed in the same way.

#composer.json

A simple way to include all classes and keep track of them. Feel free to use it!

#app_json 

Insted of using env of non security threathening data, use and json as config.

# How it works?

Add a route in /src/Routes.php 
wich will point to an controller file and method 

#EXEMPLE:
#Class    Method     path    method   controller@method secured_with_auth?
#  ▼        ▼         ▼         ▼               ▼               ▼
#Router::addRoute("/login",   "POST",      "User@login",     false);

#Controller classes
No extends or anything could stop a developer meke it's own custom objects. All You need is to create file.php inside of /src/controller/
If file has a diffrent name that the class is required to pe added that exception in composer.json! That way the application knows how to import that one.
