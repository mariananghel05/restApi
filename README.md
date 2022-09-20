<h1 align="center"> Very simple restApi in PHP </h1>

<h2> A very simple and dependecy free rest api for php servers. <h2>
 
# index.php

<p> Contains database connection for easy access and changes. Database can be change across the aplication if needed in the same way.</p> 

 <h3> composer.json </h3>

<p> A simple way to include all classes and keep track of them. Feel free to use it!

<h3> app_json </h3>

<p> Insted of using env of non security threathening data, use and json as config.

<h3> How it works? </h3>

Add a route in /src/Routes.php 
wich will point to an controller file and method 

# EXEMPLE:
 <h2 color="red">Router::addRoute("/login", "POST", "User@login", false); </h2>
 <h2> <br>
 class + class method = "Router::addRoute"<br>
  path = "/login"<br>
  method = "POST"<br>
  controller class name @ controller class method target = "User@login"<br>
  is require auth to view = false<br>
 </h2>
<h3> Controller classes </h3>
No extends or anything could stop a developer make it's own custom objects. All You need is to create file.php inside of /src/controller/
If file has a diffrent name that the class is required to pe added that exception in composer.json! That way the application knows how to import that one.

 # How about body request?
 <h3> All informations sent trought POST method, as json or anykind is as $var['name_of_variable']<br>
  All methods from Routes.php should have 1 parameter named $vars,  even if not used.
  path name in addRotue() accept costum variables of type int ex: /user/{id}
  if I wanna get the id from url(/user/12) I have it avaible in method as $vars['id'], if /user/{user_id} then $vars['user_id'].
