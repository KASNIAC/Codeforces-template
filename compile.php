<?php
if ($argc < 2) {
   die("Usage: php 'problem_name'\n");
}

// By doing this I avoid having multiples PHP files
if (strtoupper(substr(PHP_OS, 0, 3)) == 'WIN') { // Windows
   $OS = "WINDOWS";
   $MKDIR = "mkdir";
   $COPY = "copy";
   $CMP = "fc";
   $REMOVE = "del";
} else { // Linux
   $OS = "LINUX";
   $MKDIR = "mkdir";
   $COPY = "cp";
   $CMP = "diff";
   $REMOVE = "rm";
}

$name = $argv[1];

if($OS == "WINDOWS") {
   if(file_exists("$name/$name.exe")){
      shell_exec("$REMOVE \"$name\\$name.exe\""); // Deleting last .exe
   }

   $output = shell_exec("g++ \"$name/$name.cpp\" -O3 -o \"$name/$name.exe\"");
   $route = "$name/$name.exe";
} else if($OS == "LINUX"){
   if(file_exists("$name/$name.exe")){
      shell_exec("$REMOVE \"$name/$name.exe\""); // Deleting last .exe
   }
   
   $output = shell_exec("g++ \"$name/$name.cpp\" -O3 -o \"$name/$name\"");
   $route = "$name/$name";
}

if (file_exists($route)) {
   echo "Compilation successful. Executable created as $name.exe\n\n";
   
   echo "Testing cases: \n\n";
   $case = 1;
   while(true){
      $case = $case < 10 ? "0".$case : $case;

      if(file_exists("$name/$case.in")) {
         echo "----- Case #$case -----\n";
         if($OS == "WINDOWS") {
            shell_exec("\"$name/$name.exe\" < \"$name/$case.in\" > \"$name/$case.txt\"");

            // Compares the expected output (case.out) with the output produced by the program (case.txt)
            echo shell_exec("$CMP \"$name\\$case.out\" \"$name\\$case.txt\""), "\n"; // Using / is not working so I have to use \\
         } else if($OS == "LINUX"){
            shell_exec("\"$name/./$name\" < \"$name/$case.in\" > \"$name/$case.txt\"");

            // Compares the expected output (case.out) with the output produced by the program (case.txt)
            $res = shell_exec("$CMP \"$name/$case.out\" \"$name/$case.txt\"");
            $res = $res == "" ? "OK" : $res;
            echo $res, "\n";
         }
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