Local setup to run IGFIA permanently on Windows (XAMPP)

Goal
- Configure Apache (XAMPP) VirtualHost and Windows hosts entry so the IGFIA project is served by Apache continuously (survives terminal closure and reboots while Apache service is running).

Steps (summary)
1. Make sure XAMPP is installed at C:\xampp and Apache is installed and running.
2. Open PowerShell as Administrator.
3. From the project folder run the helper script:

   cd C:\xampp\htdocs\IGFIA\scripts
   .\setup-xampp-vhost.ps1 -SiteName igfia.local -ProjectPath 'C:\xampp\htdocs\IGFIA' -Port 80

4. If the script restarted Apache you can now open http://igfia.local. Otherwise open the XAMPP Control Panel and restart Apache.

Notes and troubleshooting
- Hosts changes require Administrator rights.
- If you already have another site using port 80, pick another port and pass it to the script (e.g. -Port 8080) and open http://igfia.local:8080.
- Ensure Laravel file permissions: storage and bootstrap/cache must be writable by Apache user. On Windows with XAMPP this is usually OK, but if you see permission errors, set them manually.
- For production deployment (public internet) follow proper deployment steps (Nginx/Apache + php-fpm on a Linux server, SSL, backups).

Optional extra (recommended):
- Install mkcert and generate local certificates for https, then configure Apache VirtualHost for SSL.

If you want, I can:
- Walk you through running the script as Administrator step-by-step.
- Attempt to run parts of the script from here (I cannot elevate to admin without your permission and environment), but I can edit project files and prepare them.

