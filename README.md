# Si-Test
Proyecto para la toma de 6 test (1 de lógica y 5 de comprensión lectora) a postulantes para una beca académica. Desarrollado con PHP y MySQL.
Existen dos roles: postulantes y voluntario(quien controla la toma de test al usuario postulante mediante reunión via zoom por ejemplo).

El usuario con rol "postulante" ingresa a la web con su DNI y la clave que le brinda el usuario voluntario. Accede a un menú en el cual tiene en principio el test de lógica. Al finalizarlo (ya sea porque lo terminó o porque se le
acabó el tiempo), se le habilitan los 5 botones de acceso a los distintos test de comprensión lectora.
Una vez que el usuario "postulante" ingresa al test, el botón de acceso al mismo del menú principal se le inhabilita.
Al finalizar los 6 test, se cierra su sesión y se resetea la clave de acceso.

El usuario con rol "voluntario" ingresa de la misma manera a la web, pero su menú es diferente. Además de poder realizar los test la cantidad de veces que lo desee ya que los botones de acceso no se le inhabiitan,
posee opciones de administrador:
- crear nuevos usuarios, asignándole rol "voluntario" o "postulante.
- consultar contraseñas de usuarios o resetearselas (el proyecto no requiere confidencialidad de contraseñas entre los usuarios de rol voluntario, por tal motivo es que la consulta permite saber la contraseña de cualquier usuario. Lo requerido es controlar el acceso solo de usuario con rol postulante).
- consultar el avance de cada usuario por dni (pudiendo ver por test si el usuario aún no ingresó al mismo, si ingresó y salió sin terminarlo, o si ingresó y lo terminó).
- habilitar o bloquear test a un usuario por dni (también permite modificar la cantidad de minutos disponible por usuario para el test de lógica - el único que es por tiempo-).
- consultar los resultados obtenidos por usuario por dni por test.

Nota: El resultado de comprensión lectora es un solo valor por los 5 test.

Si bien la página ya se está utilizando para la toma de test, aún falta agregar algunas opciones y mejorar el código php, por ejemplo implementando funciones y no el código puro para las validaciones.
