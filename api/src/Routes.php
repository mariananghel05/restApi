<?php

//_____________User Routes declaration_____________\\
Router::addRoute("/login", "POST", "User@login", false);
Router::addRoute("/init", "GET", "User@init", false);
Router::addRoute("/fetchuser", "GET", "User@fetchUser", true);
