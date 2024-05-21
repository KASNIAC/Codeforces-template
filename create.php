<?php
require_once('commands.php');

if ($argc < 3) {
   die("Usage: php 'contest_name' 'number_contest' 'char_last_problem_MAYUS'\n");
}

$division = $argv[1];
$contest = $argv[2];
$limit = $argv[3];

shell_exec("$MKDIR $division");
if (file_exists($division)) {
   shell_exec("$MKDIR \"$division/$contest\"");
   if (file_exists("$division/$contest")) {
      shell_exec("$COPY compile.php \"$division/$contest\""); // I don't check, its absence is not that serious
      
      for ($c = 'A'; $c <= $limit; ++$c) {
         shell_exec("$MKDIR \"$division/$contest/$c\"");
         if (file_exists("$division/$contest/$c")) {
            shell_exec("$COPY template.cpp \"$division/$contest/$c/$c.cpp\"");
            
            if (file_exists("$division/$contest/$c/$c.cpp")) {
               shell_exec("$COPY 01.in \"$division/$contest/$c/01.in\""); // I don't check, its absence is not that serious
               shell_exec("$COPY 01.out \"$division/$contest/$c/01.out\""); // I don't check, its absence is not that serious
            } else {
               die("Could not copy file $c.cpp");
            }
         } else {
            die("Error creating directory $c");
         }
      }
   } else {
      die("Error creating directory $contest into $division directory");
   }
} else {
   die("Error creating directory $division");
}