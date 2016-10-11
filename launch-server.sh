#!/bin/bash
# Check if gedit is running

run=$( ps aux | grep "server.php" | wc -l )
test=1

if [ $run != $test ]
then
        echo "Server is already running !"
else
    echo "Server is not running."
	echo "Run server.php on bg"
	nohup php server.php & "\r"
fi

