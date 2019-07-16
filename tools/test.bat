@ECHO OFF
setlocal enabledelayedexpansion
D:
cd D:\drive\onedrive\Desktop\t1
for %%f in (*.zip) do (
  Copy /b D:\drive\onedrive\Desktop\t2\t1.3gp + "%%f" "%%f.3gp"
)
pause