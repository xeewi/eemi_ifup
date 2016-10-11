#!/bin/bash
# Check if gedit is running
if pgrep "server.sh" > /dev/null
then
	echo "Sever is already running !"
else
	cd /kunden/homepages/1/d571330168/htdocs/server/
	./server.sh
fi
