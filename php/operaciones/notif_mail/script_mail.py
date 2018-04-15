#!/usr/bin/python

import psycopg2

def enviarMail(msg_body, toaddr, asunto):
    import smtplib
    from email.MIMEMultipart import MIMEMultipart
    from email.MIMEText import MIMEText
    fromaddr = "alertamultired@gmail.com"
    msg = MIMEMultipart()
    msg['From'] = fromaddr
    msg['To'] = toaddr
    # msg['Cc'] = fromaddr
    msg['Subject'] = asunto

    body = msg_body
    msg.attach(MIMEText(body, 'html'))

    server = smtplib.SMTP('smtp.gmail.com', 587)
    server.starttls()
    server.login(fromaddr, "mradmin.")
    text = msg.as_string()
    server.sendmail(fromaddr, msg["To"].split(","), text)
    server.quit()

def get_mail():
    conn = None
    try:
        # connect to the PostgreSQL database
        conn = psycopg2.connect(host="localhost",database="desarrollo", user="postgres", password="desarrollo1")
        # create a cursor object for execution
        cur = conn.cursor()
        # another way to call a stored procedure
        # cur.execute("SELECT * FROM get_parts_by_vendor( %s); ",(vendor_id,))
        cur.callproc('sgr.get_registros_pendientes_mail', ())
        # process the result set
        row = cur.fetchone()
        lista={}
        while row is not None:
            if row[2] not in lista:
                lista[row[2]] = []
            lista[row[2]].append([row[0], row[1]])
            row = cur.fetchone()
        for mail in lista:
            unmail={}
            unmail['para']=mail
            unmail['asunto']='Operaciones pendientes en Recepcion'
            unmail['cuerpo']='<b>Tiene las siguientes operaciones pendientes: </b><br/><br/>'
            for elementos in lista[mail]:
                unmail['cuerpo']=unmail['cuerpo']+elementos[0]+' para el departamento de '+elementos[1]+'<br/>'
            unmail['cuerpo']=unmail['cuerpo']+'<br/><I>Este es un mensaje automatico del servidor, no lo responda</I>.'
            enviarMail(unmail['cuerpo'],unmail['para'],unmail['asunto'])
        # close the communication with the PostgreSQL database server
        cur.close()
    except (Exception, psycopg2.DatabaseError) as error:
        print(error)
    finally:
        if conn is not None:
            conn.close()

get_mail()

# enviarMail('un mensaje')
