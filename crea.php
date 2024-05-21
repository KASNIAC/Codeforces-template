<?php
require_once('comandos.php');

if ($argc < 3) {
   echo "Usage: php '#division' '#concurso' 'char_ultimo_problema'\n";
   exit(1);
}

$division = $argv[1];
$concurso = $argv[2];
$limite = $argv[3];

shell_exec(MKDIR." $division");

if (file_exists("$division")) {
   shell_exec(MKDIR." $division\\$concurso");

   if (file_exists("$division\\$concurso")) {
      shell_exec(COPY." compila.php $division\\$concurso");

      for ($c = 'A'; $c <= $limite; ++$c) {
         shell_exec(MKDIR." $division\\$concurso\\$c");
         if (file_exists("$division\\$concurso\\$c")) {
            shell_exec(COPY." template.cpp $division\\$concurso\\$c\\$c.cpp");

            if (file_exists("$division\\$concurso\\$c\\$c.cpp")) {
               if(OS == "WINDOWS") {
                  shell_exec("type NUL > $division\\$concurso\\$c\\01.in");
                  shell_exec("type NUL > $division\\$concurso\\$c\\01.out");
               } else if(OS == "LINUX"){
                  shell_exec("type > $division\\$concurso\\$c\\01.in");
                  shell_exec("type > $division\\$concurso\\$c\\01.out");
               }
            } else {
               die("No se pudo crear el archivo $c.cpp");
            }  


         } else {
            die("Error al crear la carpeta $c");
         }
      }
   } else {
      die("Error al crear la carpeta $concurso dentro de la carpeta $division");
   }
} else {
   die("Error al crear la carpeta $division");
}
