@echo off
For /f "tokens=2-4 delims=/ " %%a in ('date /t') do (set mydate=%%c-%%a-%%b)
For /f "tokens=1-2 delims=/:" %%a in ("%TIME%") do (set mytime=%%a%%b)
for /f "tokens=2 delims==" %%a in ('wmic OS Get localdatetime /value') do set "dt=%%a"
set "YY=%dt:~2,2%" & set "YYYY=%dt:~0,4%" & set "MM=%dt:~4,2%" & set "DD=%dt:~6,2%"
set "HH=%dt:~8,2%" & set "Min=%dt:~10,2%" & set "Sec=%dt:~12,2%"

SET backupdir=C:\xampp\htdocs\backup
SET mysqluername=backup_user
SET mysqlpassword=123456
SET database=ge_rms
SET fullstamp=%YYYY%-%MM%-%DD%_%HH%-%Min%-%Sec%

C:\xampp\mysql\bin\mysqldump.exe -ubackup_user -p123456 %database% > %backupdir%\%database%_%fullstamp%.sql