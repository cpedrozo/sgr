echo " "
echo "Info: Ejecutando archivo $1"
EJECUTO="no"
if [ -z "$2" ]; then
  psql -h localhost -p 5432 -U postgres -q -d desarrollo -f "$1" && EJECUTO="si"
else
  psql -h localhost -p 5432 -U postgres -q -f "$1" && EJECUTO="si"
fi
if [ $EJECUTO = "no" ]; then
    echo "ERROR! $1; ver arriba."
else
    echo "Ok $1"
fi
