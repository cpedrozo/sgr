./ejecutar-sql-contra-base.sh "drop-database.sql" no
cd ../..
cat Power_Architect/script_db/listado_de_archivos | tr '\n' '\0' | xargs -n 1 -0 ./Power_Architect/script_db/ejecutar-sql-contra-base.sh
