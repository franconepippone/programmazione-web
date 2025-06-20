# 📘 Controllori e URL

## FieldController (Responsabile: **AMERICO**)

| Metodo       | URL                         | Azione                      |
|--------------|-----------------------------|-----------------------------|
| searchForm   | `/field/searchForm`         | Mostra form di ricerca      |
| showResults  | `/field/showResults`        | Mostra lista filtrata       |
| details      | `/field/details/<campo>`    | Dettagli campo              |

---

## ReservationController (Responsabile: **ALICE**)

| Metodo              | URL                                   | Azione                               |
|---------------------|----------------------------------------|--------------------------------------|
| createForm          | `/reservation/createForm`             | Mostra form prenotazione             |
| finalizeReservation | `/reservation/finalizeReservation`    | Conclude la prenotazione (no pagamento) |
| cancelReservation   | `/reservation/cancelReservation/<id>` | Cancella prenotazione                |

---

## OnlinePaymentController (Responsabile: **AMERICO**)

| Metodo        | URL                               | Azione               |
|---------------|------------------------------------|----------------------|
| payForm       | `/onlinepayment/payForm`          | Mostra form pagamento|
| processPayment| `/onlinepayment/processPayment`   | Processa pagamento   |

---

## CourseController (Responsabile: **KEVIN**)

| Metodo         | URL                                | Azione                 |
|----------------|-------------------------------------|------------------------|
| showCourses    | `/course/showCourses`              | Lista corsi filtrata   |
| courseDetail   | `/course/courseDetail/<corso>`     | Dettagli corso         |
| enrollForm     | `/course/enrollForm/<corso>`       | Form iscrizione        |
| manageForm     | `/course/manageForm/<corso>`       | Form gestione corso    |
| createForm     | `/course/createForm`               | Form creazione corso   |
| createCourse   | `/course/createCourse`             | Salva corso            |

---

## UserHomeController (Responsabile: **AMERICO**)

| Metodo      | URL                        | Azione                        |
|-------------|-----------------------------|-------------------------------|
| home        | `/user/home`               | Dashboard utente              |
| myCourses   | `/user/myCourses`          | Visualizza corsi iscritti     |
| dashboard   | `/user/dashboard`          | Dashboard personale           |
| editEmail   | `/user/editEmail`          | Modifica email                |

---

## InstructorController (Responsabile: **KEVIN**)

| Metodo            | URL                                 | Azione            |
|-------------------|--------------------------------------|-------------------|
| manageMyCourses   | `/instructor/manageMyCourses`       | Gestione corsi    |
| updateCourse      | `/instructor/updateCourse/<id>`     | Aggiorna corso    |

---

## EmployeeController (Responsabile: **ALICE**)

| Metodo              | URL                                   | Azione                  |
|---------------------|----------------------------------------|-------------------------|
| showReservations    | `/employee/showReservations`          | Elenco prenotazioni     |
| viewReservation     | `/employee/viewReservation/<id>`      | Visualizza prenotazione |
| confirmPayment      | `/employee/confirmPayment/<id>`       | Conferma pagamento      |
| cancelReservation   | `/employee/cancelReservation/<id>`    | Annulla prenotazione    |
| createCourseForm    | `/employee/createCourseForm`          | Form nuovo corso        |
| createCourse        | `/employee/createCourse`              | Salva nuovo corso       |

---

## AdminController

| Metodo             | URL                               | Azione                   |
|--------------------|------------------------------------|--------------------------|
| statsView          | `/admin/statsView`                | Menu statistiche         |
| statsCourses       | `/admin/statsCourses`             | Statistiche corsi        |
| statsReservations  | `/admin/statsReservations`        | Statistiche prenotazioni |
| createProfileForm  | `/admin/createProfileForm`        | Form creazione profilo   |
| createProfile      | `/admin/createProfile`            | Salva nuovo profilo      |
| manageUsers        | `/admin/manageUsers`              | Elenco utenti            |
| editUser           | `/admin/editUser/<id>`            | Modifica profilo         |
