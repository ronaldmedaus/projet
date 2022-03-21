# Contenu MT ACCESS PROD

RewriteEngine On
RewriteCond %{HTTPS} off
RewriteRule (.*) https://%{HTTP_HOST}%{REQUEST_URL} (L)
RewriteCond %{HTTP_HOST} ^votredomaine$ 