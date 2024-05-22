# Create file directory:
console$ php create.php <contest_name> <number_of_contest> <char_last_problem_MAYUS>

# Example: 
console$ php create.php Div3 567 H

<br><br>
# Once you are into /contest_name/number_of_contest you can use compile.php just like this:
console/contest_name/number_of_contest$ php compile.php <name_of_problem>

You have to be careful because compile.php uses a file.cpp into a folder with the same name, so if you want to add a new file to debug or something like that you must to create it into a folder with the same name.

# Example "/temp/temp.cpp" so now you can do something like this:
console/contest_name/number_of_contest$ php compile.php temp

# Add compilation flags:
Into compile.php you can add your own flags compilation in case you need it.
