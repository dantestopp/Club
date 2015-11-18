Club
===

A Footballclub Managment Tool

##Requirements
- MYSQL
- PHP >= 5.5.0

##Login

Username: test@test.com

Password: test

##Subdirectory
If you want to host the tool from a subdirectory you need to ajust the config.php file:
<pre>

$config = [
    ...
    "web" => [
        "base_url" => "<b>/subdirectory</b>"
      ]
  ];
</pre>
