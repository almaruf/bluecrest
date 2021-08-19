# README

### Problem Definition
A sample API script that provides a monthly payment schedule between the membership start date and the next X months. For example, if I subscribed to my membership on Jan 7th 2021, my schedule for the next six months is: Feb 7th, Mar 7th, Apr 7th, May 7th, Jun 7th and Jul 7th.

### Language Used: PHP7

### Installation Instructions:
This is a simple PHP script that you can copy into any directory inside your localhost and run without any framework dependency. There is a test.php script for any non coder to visit and make requests to the API. Please change the base URL on the test script based on your script location.

### Fact sheet
* To reduce dependency on any framework and installation issues I have used basic PHP to build this script
* The script handles all the provided use cases well, but there is not enough input validation and escaping.
* The code assumes the user will provide both the input parameters, ignores anything other than that.
* The use of strtotime() & date() functions will cause issues for 32-bit platform with  dates from 2038, which is fairly in future for this script so I just kept using it. In future we should use  DateTIme() class.


## links
I have build an online test script for anyone to check the script here: http://tools.almaruf.com/test.php?subscriptionStartDate=1998-01-07&scheduleInMonths=2


