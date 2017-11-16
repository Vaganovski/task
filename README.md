login: user
pass: user

nginx rewrite rule:
rewrite ^/(.*)$ /index.php?$1 last;