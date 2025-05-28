<?php

require_once(__DIR__ . "/../utility/UCookie.php");

class CFrontController{
    
    public function run($requestUri){
        // Parse the request URI
        ob_start();
        // echo $requestUri;
        echo $requestUri . "<br>";
        //$requestUri = trim($requestUri, '/');
        $uriParts = explode('/', $requestUri);
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
        
        
        
        ob_clean(); // UNCOMMENT THIS TO SHOW DEBUG ECHOS TO BROWSER


        call_user_func_array([$controllerClass, $methodName], $params);
    }
}