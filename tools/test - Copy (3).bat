@ECHO OFF
setlocal enabledelayedexpansion
D:
cd D:\drive\onedrive\Desktop\t1
for %%f in (*.zip) do (
  echo %%~nf.3gp
  echo %%f.3gp
)
pause