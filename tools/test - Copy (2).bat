@ECHO OFF
setlocal enabledelayedexpansion
D:
cd D:\drive\onedrive\Desktop\t1
for %%f in (D:\drive\onedrive\Desktop\t1\*.zip) do (
  set /p val=<%%f
  echo "fullname: %%f"
  echo "name: %%~nf"
  echo "contents: !val!"
  
  Copy /b D:\drive\onedrive\Desktop\t2\t1.3gp + %%f %%~nf.3gp
)
pause