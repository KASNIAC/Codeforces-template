<?php
require_once('commands.php');

if ($argc < 3) {
   die("Usage: php 'contest_name' 'number_contest' 'char_last_problem_MAYUS'\n");
}

$division = $argv[1];
$contest = $argv[2];
$limit = $argv[3];

shell_exec(MKDIR." $division");
if (file_exists("$division")) {
   shell_exec(MKDIR." $division\\$contest");
   if (file_exists("$division\\$contest")) {
      shell_exec(COPY." compila.php $division\\$contest"); // I don't check, its absence is not that serious
      shell_exec(COPY." commands.php $division\\$contest"); // I don't check, its absence is not that serious
      
      for ($c = 'A'; $c <= $limit; ++$c) {
         shell_exec(MKDIR." $division\\$contest\\$c");
         if (file_exists("$division\\$contest\\$c")) {
            shell_exec(COPY." template.cpp $division\\$contest\\$c\\$c.cpp");

            if (file_exists("$division\\$contest\\$c\\$c.cpp")) {
               if(OS == "WINDOWS") {
                  shell_exec("type NUL > $division\\$contest\\$c\\01.in");
                  shell_exec("type NUL > $division\\$contest\\$c\\01.out");
               } else if(OS == "LINUX"){
                  shell_exec("type > $division\\$contest\\$c\\01.in");
                  shell_exec("type > $division\\$contest\\$c\\01.out");
               }
            } else {
               die("Could not create file $c.cpp");
            }
         } else {
            die("Error creating directory $c");
         }
      }
   } else {
      die("Error creating directory $contest into $division direcotry");
   }
} else {
   die("Error creating directory $division");
}