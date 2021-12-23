
* Pedir cita médica (al paciente)
url: citas/create.php
parametros ejemplo:
{  
    "paciente_id":1,
    "fecha":"2021-12-22",
    "hora":"17:34"
}


* Confirmar cita (al médico)
url: /citas/update.php
parametros ejemplo:
{
    "id":8,
    "doctor_id":1,
    "aprobado":"SI"
}
* Listar mis citas del día (al médico)
url: citas/read_today.php?doctor_id=1



Adicionalmente podemos listar,crear eliminar actualizar buscar, doctores y pacientes

Pacientes
* listar
url:pacientes/read.php

* crear
url:pacientes/create.php
parametros ejemplo:
{
    "nombre":"abraham",
    "cedula":"1878999"
}

* eliminar
url:pacientes/delete.php
{
    "id":26
}
parametros ejemplo:
{
    "id":26
}

* mostrar
url:pacientes/read_one.php?id=1

* buscar
url:pacientes/search.php?s=abraham
* actualizar
url:pacientes/update.php
parametros ejemplo:
{
    "id":"1",
    "nombre":"pedro",
    "cedula":"18778541"
}

Doctores

* listar
url:doctores/read.php

* crear
url:doctores/create.php
parametros ejemplo:
{
    "nombre":"edgar",
    "cedula":"13778546"
}

* eliminar
url:doctores/delete.php
parametros ejemplo:
{
    "id":6
}

* mostrar
url:doctores/read_one.php?id=620

* buscar
url:doctores/search.php?s=nombre
* actualizar
url:doctores/update.php
parametros ejemplo:
{
    "id":1,
    "nombre":"edgar molina",
    "cedula":"151515"
}