ren "nyc_trip_notes.txt" "nycTripNotes.txt"

ren *.zip ???-hikingTrip.*

ren *.3gp *.zip

Copy /b t1.3gp + t1.zip t2.3gp


for /r %i in (*) do echo %i

for /r %i in (*) do Copy /b D:\drive\onedrive\Desktop\t2\t1.3gp + %i t2.3gp