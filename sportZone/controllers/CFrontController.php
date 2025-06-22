<?php

require_once __DIR__ . "/../../vendor/autoload.php";

/*
The front controller is the main entry point of the server. All requests made to the server pass though the run()
method of this class. 
The run method parses the uri and splits it into tokens separated by "/". The behaviour implemented here
is to treat the first token as a controller class name, the second token as a method name to execute on that controller,
and all following tokens as arguments to that method.

For example: localhost/user/login will execute the method CUser.login()
For example: localhost/image/get/1 will execute the method CImage.get(1)
In general, localhost/<clsname>/<mtdname>/<arg1>/<arg2>/... will execute CClsname.mtdname(arg1, arg2, ...)

This creates a 1:1 mapping between urls provided to the server and the various methods located 
in the controller classes. Each request to the server maps to exactly one method call.
A single use case might consist in multiple subsequent requests to the server.

Login usecase example:
    1) host/user/login => shows login form. When sumbit is clicked, post form data to 2)
    2) host/user/checkLogin => receives login data from the form and decides if the user login was succesfull. In which case, 3)
    3) host/user/home => routes the user to the homepage
*/
class CFrontController{
    
    public function run($requestUri){
        // Parse the request URI
        
        ob_start();
        // echo $requestUri;
        echo $requestUri . "<br>";
        $path = parse_url($requestUri, PHP_URL_PATH);
        $uriParts = explode('/', $path);
        array_shift($uriParts);
        var_dump($uriParts);
        echo "<br><br>";
       
        // Extract controller and method names
        $controllerName = !empty($uriParts[0]) ? ucfirst($uriParts[0]) : 'User';
        var_dump($controllerName);
        $methodName = (!empty($uriParts[1]) ? $uriParts[1] : 'login');
        echo "Requested controller: " . $controllerName . "<br>";
        echo "Requested method: " . $methodName . "<br>";

        // Load the controller class
        $controllerClass = 'C' . $controllerName;
        // var_dump($controllerClass);
        $controllerFile = __DIR__ . "/{$controllerClass}.php";
        // var_dump($controllerFile);

        if (!file_exists($controllerFile)) {
            echo "<br> Controller ". $controllerClass ." not found <br>";
            // Controller not found, handle appropriately (e.g., show 404 page)
            //header('Location: /Agora/User/home')
            exit;
        }
        
        require_once $controllerFile;
        if (!class_exists($controllerClass)) {
            echo "<br> Controller class ". $controllerClass ." not found <br>";
            // Controller not found, handle appropriately (e.g., show 404 page)
            //header('Location: /Agora/User/home')
            exit;            
        }

        if (!method_exists($controllerClass, $methodName)) {
            echo "<br> Method ". $methodName ." not found <br>";
            // Method not found, handle appropriately (e.g., show 404 page)
            //header('Location: /Agora/User/home')
            exit;
        }

        $params = array_slice($uriParts, 2); // Get optional parameters
        echo "Calling " . "$controllerClass" . "." . "$methodName" . " with parameters: " . print_r($params, true) . "<br>";
        
        
        
        ob_clean(); // COMMENT THIS TO SHOW DEBUG ECHOS TO BROWSER


        call_user_func_array([$controllerClass, $methodName], $params);
    }
}