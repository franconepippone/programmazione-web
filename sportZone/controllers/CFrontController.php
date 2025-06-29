<?php

require_once __DIR__ . "/../../vendor/autoload.php";

use App\Enum\UserSex;

#[\Attribute(\Attribute::TARGET_METHOD)]
class PathUrl {
    public const HIDDEN = '__hidden__';
    public function __construct(public string $path) {}
}

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
        
        //$this->createDummyFields();
        //$this->createDummyCourses();
        
        //$this->createDummyFields();
        //$this->createDummyCourses();
        
        
        //$this->createDummyFields();
        //$this->createDummyUsers();
        //CHelper::createUsers();
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
        $controllerMethodKey = (!empty($uriParts[1]) ? $uriParts[1] : 'login');
        echo "Requested controller: " . $controllerName . "<br>";
        echo "Requested method key: " . $controllerMethodKey . "<br>";

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

        $map = self::generateMethodsUrlMap($controllerClass);
        //print_r($map);

        if (!array_key_exists($controllerMethodKey, $map)) {
            echo "<br> No method mapped to ". $controllerMethodKey ." key in controller ". $controllerClass ."<br>";
            // Method not found, handle appropriately (e.g., show 404 page)
            //header('Location: /Agora/User/home')
            exit;
        }
        
        $methodName = $map[$controllerMethodKey];
        $params = array_slice($uriParts, 2); // Get optional parameters
        echo "Calling " . "$controllerClass" . "." . "$methodName" . " with parameters: " . print_r($params, true) . "<br>";
        
        
        
        ob_clean(); // COMMENT THIS TO SHOW DEBUG ECHOS TO BROWSER


        call_user_func_array([$controllerClass, $methodName], $params);
    }

    /**
     * Generates a map of method names to their URL paths based on the PathUrl attribute.
     * 
     * @param string $className The name of the class to inspect.
     * @return array An associative array mapping URL paths to method names.
     */
    private function generateMethodsUrlMap(string $className): array {
        $map = [];
        $refClass = new ReflectionClass($className);
        foreach ($refClass->getMethods(ReflectionMethod::IS_PUBLIC) as $method) {
            // Skip constructor, destructor, and static methods
            if ($method->isConstructor() || $method->isDestructor()) {
                continue;
            }
            $attrs = $method->getAttributes(PathUrl::class);
            if (!empty($attrs)) {
                $customName = $attrs[0]->newInstance()->path;
                if ($customName === PathUrl::HIDDEN) {
                    continue; // Skip hidden methods
                }
                $map[$customName] = $method->getName();
            } else {
                $map[$method->getName()] = $method->getName();
            }
        }
        return $map;
    }
    



    private static function createDummyUsers(){
        $employee = (new EEmployee())
            ->setName('Maria')
            ->setSurname('Rossi')
            ->setEmail('cirddo')
            ->setBirthDate(new DateTime('1990-01-01'))
            ->setSex(UserSex::MALE)
            ->setUsername('maria.rossi')
            ->setPassword('password123'); // Assuming you have a setPassword method

       FPersistentManager::getInstance()->uploadObj($employee);
       $admin = (new EAdmin())
            ->setName('cria')
            ->setSurname('Rossi')
            ->setEmail('cieeero')
            ->setBirthDate(new DateTime('1990-01-01'))
            ->setSex(UserSex::MALE)
            ->setUsername('moria.rossi')
            ->setPassword('password123'); // Assuming you have a setPassword method

       FPersistentManager::getInstance()->uploadObj($admin);
        }
    
    //creo campi fittizi
    
    public static function createDummyFields(){
        $fields = [];

        $field1 = new EField();
        $field1->setSport('Calcio')
        ->setName('ahhhh') 
        ->setTerrainType('Erba sintetica')
        ->setIsIndoor(false)
        ->setCost(50.0)
        ->setLatitude(0)
        ->setLongitude(0);
        $fields[] = $field1;

        $field2 = new EField();
        $field2->setSport('Tennis')
        ->setName('ahhhh')
        ->setTerrainType('Cemento')
        ->setIsIndoor(true)
        ->setCost(40.0)
        ->setLatitude(0)
        ->setLongitude(0);
        $fields[] = $field2;

        $field3 = new EField();
        $field3->setSport('Basket')
        ->setName('ahhhh')
        ->setTerrainType('Parquet')
        ->setIsIndoor(true)
        ->setCost(60.0)
        ->setLatitude(0)
        ->setLongitude(0);
        $fields[] = $field3;

        $field4 = new EField();
        $field4->setSport('Padel')
        ->setName('ahhhh')
        ->setTerrainType('Erba sintetica')
        ->setIsIndoor(false)
        ->setCost(55.0)
        ->setLatitude(0)
        ->setLongitude(0);
        $fields[] = $field4;
        foreach ($fields as $field) {
            FPersistentManager::getInstance()->uploadObj($field);
        }
        
    }

    public function createDummyCourses($instructor){
        $field = new EField();
        $field->setSport('Padel')
        ->setName('ahhhh')
        ->setTerrainType('Erba sintetica')
        ->setIsIndoor(false)
        ->setCost(55.0)
        ->setLatitude(0)
        ->setLongitude(0);
        FPersistentManager::getInstance()->uploadObj($field);
        
        $courses = [];
        $days = ["monday", "saturday"];
        $course1 = new ECourse();
        $course1->setTitle('Corso Calcio Base');
        $course1->setDaysOfWeek($days);
        $course1->setStartDate(new \DateTime('2025-07-01'));
        $course1->setEndDate(new \DateTime('2025-07-31'));
        $course1->setDescription('Corso per principianti che vogliono imparare le basi del calcio.');
        $course1->setTimeSlot('09:00-11:00');
        $course1->setInstructor($instructor);
        $course1->setEnrollmentCost(100.0); // <-- usa il nome corretto del setter
        $course1->setMaxParticipantsCount(20);
        $course1->setField($field);
        $courses[] = $course1;

        

        $course2 = new ECourse();
        $course2->setDaysOfWeek($days);
        $course2->setTitle('Corso Calcio Avanzato');
        $course2->setStartDate(new \DateTime('2025-08-01'));
        $course2->setEndDate(new \DateTime('2025-08-31'));
        $course2->setDescription('Per ragazzi che vogliono migliorare la tecnica.');
        $course2->setTimeSlot('11:30-13:30');
        $course1->setInstructor($instructor);
        $course2->setEnrollmentCost(120.0); // <-- usa il nome corretto del setter
        $course2->setMaxParticipantsCount(18);
        $course2->setField($field);
        $courses[] = $course2;
        foreach ($courses as $course) {
            FPersistentManager::getInstance()->uploadObj($course);
        }
        $instructor->addCourse($course1);
        $instructor->addCourse($course2);
    }
    
}
    

