#!/usr/bin/expect -f
# IFUP Server

spawn ssh gautierg@dev.etudiant-eemi.com
expect {
	"assword:" {send "149073\r"; exp_continue } 
	"$ " {send "cd perso/ifup/; sh launch-server.sh\r"; exp_continue}
	"$ " {send "exit\r"}
}
interact
