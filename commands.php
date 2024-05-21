<?php
   if (strtoupper(substr(PHP_OS, 0, 3)) == 'WIN') { // Windows
      $OS = "WINDOWS";
      $MKDIR = "mkdir";
      $COPY = "copy";
      $CMP = "fc";
   } else { // Linux
      $OS = "LINUX";
      $MKDIR = "mkdir";
      $COPY = "cp";
      $CMP = "diff";
   }
?>