<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>


## SENIORITY ASSESSMENT PROJECT

YOU MUST DEVELOP A SYSTEM TO MANAGE A COURSE PLATFORM. YOU MUST MANAGE DATA OF STUDENTS, TEACHERS, SUBJECTS AND PAYMENTS.


## ENTIDADES BASE

- STUDENTS
- TEACHERS
- SUBJECTS
- PAYMENTS
- ADMIN


Debes determinar los roles de acceso para cada entidad, diseñar la base de datos y las tablas de cada entidad con los campos que creas oportunos y necesarios.


## Admins role

Debería poder agregar estudiantes, maestros, materias y pagos. La entidad STUDENT debe tener la información básica y poder registrar los pagos mensuales de cuotas por asignatura , este dato puedellevarse dentro o fuera de la entidad segun consideren, poder llevar el control de las materias que esta cursando, solo puede tomar 5 materias a la vez, mostrar cuánto tiene que pagar por mes y llevar la calificacion de cada asigantura para cada materia. La entidad TEACHERS debe tener la información básica del maestro, llevar dentro o fuera de la entidad cuanto tiene que cobrar por las materias que imparte, su cuota es del 80% del valor de la cuota que paga el alumno, no puede impartir más de 5 materias por semana. La entidad SUBJECTS debe tener minimo una descripción y costo mensual de la misma El administrador debe poder relacionar a los alumnos con las asignaturas que va a cursar y a los profesor con las asiganturas que imparten, esto puede ser visto por maestros para ver que asiganturas imparte y estudiantes para saber cuales debe cursar.


## Teacher role

Debe poder editar el perfil del estudiante y en cada asignatura que este tiene tomada pueda colocar las notas correspondientes, como asi tambien saber cuantos alumnos tiene por clase. Poder ver según la cantidad de asignaturas que imparte y estudiantes cuanto debe cobrar al mes. Tiene que poder tomar o borrar asiganturas que tiene asignadas.


## Student role

Debe poder ver las asignaturas que debe cursar, solo agregar pero no quitar de su perfil asignaturas, ver cuanto debe pagar mensual según cuales tome.


##  REQUISITOS PREVIOS
 
 - <a href="https://www.mysql.com/">MySQL</a>
 - <a href="https://www.php.net/downloads/">PHP 8.1</a>
 - <a href="https://getcomposer.org/">Composer</a>
 - <a href="https://www.apache.org/">APACHE</a>


## Acceso a través de servidor en producción

<a href="http://desafiocursos.ddns.net:8000">Courses platform</a>

## Credenciales:

- Admin

    ``` sh
    usuario: admin@gmail.com
    contraseña: 12345678
	```


Para acceder a los demás usuarios registrados se puede navegar en las secciones Admins, Teachers, Students para verificar la dirección de correo con la que están registrados. Las contraseñas para todos los usuarios es '12345678'

## Instalación en entorno local

 - Clonar el repositorio, preferentemente en  ```/var/www/```:
	
	``` sh
	git clone https://github.com/andresmza/seniority_assessment_project.git
	```

- Una vez dentro del directorio del proyecto ejecutar los siguientes comandos:

    ``` sh
	composer install
	composer update
    cp .env.example .env
    php artisan key:generate
	```

- Crear la base de datos:

    ``` sh
	CREATE DATABASE desafio;
	```

- Ejecutar las migraciones:

    ``` sh
	php artisan migrate --seed
	```

- Ejecutar los siguientes comandos:

    ``` sh
	npm install -g npm@8.19.2
    npm run dev
	```


##  Diagrama Entidad Relación

![DER](https://raw.githubusercontent.com/andresmza/seniority_assessment_project/master/public/diagrama_entidad_relacion.png)