<?php

//_____________User Routes declaration_____________\\
Router::addRoute("/login", "POST", "User@login", false);
Router::addRoute("/fetchuser", "GET", "User@fetchUser", true);
