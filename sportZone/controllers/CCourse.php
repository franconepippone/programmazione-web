<?php
require_once __DIR__ . "/../../vendor/autoload.php";

class CCourse {

     public static function createCourse() {
        // Qui puoi aggiungere la logica per salvare il corso (es. validazione, chiamata a un model, ecc.)

        $view = new VCourse();
        $view->showCreateResult();
    }

    public static function searchForm() {
        $view = new VCourse();
        $view->showSearchForm();
    }

    public static function showCourses() {
        
        $view = new VCourse();
        $view->showSearchResults();
    }

    public static function courseDetail($course_id) {
        $view = new VCourse();
        $view->showDetails($course_id);
    }

    public static function enrollForm($course_id) {
        $view = new VCourse();
        $view->showEnrollForm($course_id);
    }

    public static function manageForm($course_id) {
        $view = new VCourse();
        $view->showManageForm($course_id);
    }

    public static function createForm() {
        $view = new VCourse();
        $view->showCreateForm();
    }

   
}