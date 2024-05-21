<?php
if ($argc < 2) {
   echo "Usage: php 'nombre'\n";
   exit(1);
}

$nombre = $argv[1];

$output = shell_exec("g++ $nombre\\$nombre.cpp -O3 -o $nombre\\$nombre.exe");

if (file_exists("$nombre\\$nombre.exe")) {
   echo "Compilation successful. Executable created as $nombre.exe\n\n";
   
   echo "Testing: \n\n";
   $case = 1;
   while(true){
      $case = $case < 10 ? "0".$case : $case;

      if(file_exists("$nombre\\$case.in")) {
         echo "----- Case #$case -----\n";
         shell_exec("$nombre\\$nombre.exe < $nombre\\$case.in > $nombre\\$case.txt");
         echo shell_exec("fc $nombre\\$case.out $nombre\\$case.txt");
      } else {
         break;
      }
      ++$case;
   }
} else {
   echo "Compilation failed:\n";
   echo $output;
}
?>