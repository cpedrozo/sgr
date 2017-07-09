// palabras repetidas
/\b(\w+)\b(\s\1)+

// trim string
/^[\s]*(.*?)[\s]*$

// eliminar espacios y tabulaciones
/([\ \t]+(?=[\ \t])|^\s+|\s+$)/g

// contraseñas validas
^(?=.*[A-Z].*[A-Z])(?=.*[!@#$&*])(?=.*[0-9].*[0-9])(?=.*[a-z].*[a-z].*[a-z]).{8}$
