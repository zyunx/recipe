/* 
cbright.c - Change screen's brightness. 

Copyright (C) 2014 Zhang Yun<cloud2han9@163.com>

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/


/*
 * cbright.c - Change screen's brightness. 
 * To be useful, you need chown to make the executable file's owner
 * be root, and chmod to add setuid capablility.
 */
#include <stdlib.h>
#include <stdio.h>
#include <stdint.h>
#include <string.h>
#include <unistd.h>
/*#include <sys/stat.h>*/
#include <fcntl.h>

int usage();

int main(int argc, char **argv)
{
	int fd;
	char *degree;

	if (argc > 1) {
		degree = argv[1];
	} else
	{
		usage();
		exit(EXIT_FAILURE);
	}

	fd = open("/sys/class/backlight/acpi_video0/brightness",
			O_WRONLY);
	if (-1 == fd)
	{
		perror("Can't open file: ");
		exit(EXIT_FAILURE);
	}
	write(fd, degree, strlen(degree) + 1);
	close(fd);
	return 0;
}

int usage()
{
	printf("cbright -- Chnage screen's brightness.\
		Usage:\n\tcbright [degree]");
	return 0;
}
