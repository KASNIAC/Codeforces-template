<?php
require_once('commands.php');

if ($argc < 2) {
   die("Usage: php 'name'\n");
}

$name = $argv[1];

if(OS == "WINDOWS") {
   $output = shell_exec("g++ $name\\$name.cpp -O3 -o $name\\$name.exe");
} else if(OS == "LINUX"){
   $output = shell_exec("g++ $name\\$name.cpp -O3 -o $name\\$name");
}

if (file_exists("$name\\$name.exe")) {
   echo "Compilation successful. Executable created as $name.exe\n\n";
   
   echo "Testing cases: \n\n";
   $case = 1;
   while(true){
      $case = $case < 10 ? "0".$case : $case;

      if(file_exists("$name\\$case.in")) {
         echo "----- Case #$case -----\n";
         if(OS == "WINDOWS") {
            shell_exec("$name\\$name.exe < $name\\$case.in > $name\\$case.txt");
         } else if(OS == "LINUX"){
            shell_exec("$name\\./$name.exe < $name\\$case.in > $name\\$case.txt");
         }
         
         // Compares the expected output (case.out) with the output produced by the program (case.txt)
         echo shell_exec(CMP." $name\\$case.out $name\\$case.txt");
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