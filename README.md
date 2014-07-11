
try to develop a very simple php framework, so as to improve my technical skills

#example of rewrite rule
<VirtualHost *:82>
    DocumentRoot "/home/linsehngwu/mysite/framework/"
    ServerName wuls.stenote.com
    DirectoryIndex index.php
    RewriteEngine On
    RewriteCond %{REQUEST_URI} !^.*\.css$
    RewriteRule ^(\/([a-z]*))*(\.[a-z]*|[0-9]*)*(\/)?$ /index.php
</VirtualHost>

<Directory /home/linsehngwu/mysite/framework>
    Order Allow,Deny
    Allow from All
    DirectoryIndex index.php
</Directory>
    ~                        
