<?php

require_once __DIR__ . "/../../vendor/autoload.php";
use App\Enum\UserSex;

class CHelper {
    

    public static function createUsers() {
        $instructor = (new EInstructor())
        ->setName('Mario')
        ->setSurname('Rossi')
        ->setEmail('istruttore@sport.com')
        ->setBirthDate(new DateTime('1990-01-01'))
        ->setSex(UserSex::MALE)
        ->setUsername('instructor')
        ->setPassword('123'); // Assuming you have a setPassword method

        FPersistentManager::getInstance()->uploadObj($instructor);

        $client = (new EClient())
        ->setName('giuseppe')
        ->setSurname('Rossi')
        ->setEmail('client@sport.com')
        ->setBirthDate(new DateTime('1990-01-01'))
        ->setSex(UserSex::MALE)
        ->setUsername('client')
        ->setPassword('123'); // Assuming you have a setPassword method

        FPersistentManager::getInstance()->uploadObj($client);

        $employee = (new EEmployee())
        ->setName('arnaldo')
        ->setSurname('Rossi')
        ->setEmail('employee@sport.com')
        ->setBirthDate(new DateTime('1990-01-01'))
        ->setSex(UserSex::MALE)
        ->setUsername('employee')
        ->setPassword('123'); // Assuming you have a setPassword method

        FPersistentManager::getInstance()->uploadObj($employee);

        $admin = (new EAdmin())
        ->setName('Filippo')
        ->setSurname('Rossi')
        ->setEmail('admin@sport.com')
        ->setBirthDate(new DateTime('1990-01-01'))
        ->setSex(UserSex::MALE)
        ->setUsername('admin')
        ->setPassword('123'); // Assuming you have a setPassword method

        FPersistentManager::getInstance()->uploadObj($admin);
    }

    public static function populateDatabase() {

    }

    public static function createDummyFields(){
        $fields = [];

        $field1 = new EField();
        $field1->setSport('Calcio')
            ->setName('Campo Centrale')
            ->setTerrainType('Erba sintetica')
            ->setIsIndoor(false)
            ->setCost(50.0)
            ->setLatitude(45.4642)    // Milan approx coords
            ->setLongitude(9.1900);
        $fields[] = $field1;

        $field2 = new EField();
        $field2->setSport('Tennis')
            ->setName('Campo Tennis Nord')
            ->setTerrainType('Cemento')
            ->setIsIndoor(true)
            ->setCost(40.0)
            ->setLatitude(45.4650)
            ->setLongitude(9.1910);
        $fields[] = $field2;

        $field3 = new EField();
        $field3->setSport('Basket')
            ->setName('Palestra Sportiva')
            ->setTerrainType('Parquet')
            ->setIsIndoor(true)
            ->setCost(60.0)
            ->setLatitude(45.4660)
            ->setLongitude(9.1920);
        $fields[] = $field3;

        $field4 = new EField();
        $field4->setSport('Padel')
            ->setName('Campo Padel Sud')
            ->setTerrainType('Erba sintetica')
            ->setIsIndoor(false)
            ->setCost(55.0)
            ->setLatitude(45.4630)
            ->setLongitude(9.1890);
        $fields[] = $field4;

        foreach ($fields as $field) {
            FPersistentManager::getInstance()->uploadObj($field);
        }
    }


    public static function createDummyCourses() {
        $courses = [];

        // Example fields to assign courses to (you may want to fetch real ones from DB)
        $field1 = new EField();
        $field1->setSport('Calcio')->setName('Campo Centrale')->setTerrainType('Erba sintetica')->setIsIndoor(false)->setCost(50.0)->setLatitude(45.4642)->setLongitude(9.1900);

        $field2 = new EField();
        $field2->setSport('Tennis')->setName('Campo Tennis Nord')->setTerrainType('Cemento')->setIsIndoor(true)->setCost(40.0)->setLatitude(45.4650)->setLongitude(9.1910);

        $field3 = new EField();
        $field3->setSport('Basket')->setName('Palestra Sportiva')->setTerrainType('Parquet')->setIsIndoor(true)->setCost(60.0)->setLatitude(45.4660)->setLongitude(9.1920);

        $fields = [$field1, $field2, $field3];

        // Course 1
        $course1 = new ECourse();
        $course1->setTitle('Corso Calcio Base')
                ->setDaysOfWeek(['monday', 'wednesday'])
                ->setStartDate(new \DateTime('2025-07-01'))
                ->setEndDate(new \DateTime('2025-07-31'))
                ->setDescription('Corso per principianti che vogliono imparare le basi del calcio.')
                ->setTimeSlot('09:00-11:00')
                ->setEnrollmentCost(100.0)
                ->setMaxParticipantsCount(20)
                ->setField($field1);
        $courses[] = $course1;

        // Course 2
        $course2 = new ECourse();
        $course2->setTitle('Corso Tennis Intermedio')
                ->setDaysOfWeek(['tuesday', 'thursday'])
                ->setStartDate(new \DateTime('2025-08-01'))
                ->setEndDate(new \DateTime('2025-08-31'))
                ->setDescription('Per giocatori con esperienza che vogliono migliorare il loro gioco.')
                ->setTimeSlot('18:00-20:00')
                ->setEnrollmentCost(120.0)
                ->setMaxParticipantsCount(15)
                ->setField($field2);
        $courses[] = $course2;

        // Course 3
        $course3 = new ECourse();
        $course3->setTitle('Corso Basket Avanzato')
                ->setDaysOfWeek(['friday', 'sunday'])
                ->setStartDate(new \DateTime('2025-09-01'))
                ->setEndDate(new \DateTime('2025-09-30'))
                ->setDescription('Per giocatori che vogliono migliorare tecnica e strategia.')
                ->setTimeSlot('16:00-18:00')
                ->setEnrollmentCost(130.0)
                ->setMaxParticipantsCount(18)
                ->setField($field3);
        $courses[] = $course3;

        foreach ($courses as $course) {
            FPersistentManager::getInstance()->uploadObj($course);
        }
    }


}   