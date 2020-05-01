#### Requirements

 - PHP >= 7.1.3
 - Mysql
 - composer
 
#### Deployment
 
 - run `composer install`
 - run `php artisan key:generate`
 - Edit .env file and set db credentials
 - run `php artisan migrate`
 
#### Apache virtual-host settings example
**Apache must point to the directory - "public"**
```$xslt
<VirtualHost *:80>
    ServerAdmin webmaster@dummy-host.example.com
    DocumentRoot "d:/projects/apiendpoint1/public"
    ServerName apiendpoint1.loc
    ServerAlias www.apiendpoint1.tld
    ErrorLog "logs/apiendpoint1-error.log"
    CustomLog "logs/apiendpoint1-client.log" common
	
	<Directory d:/projects/apiendpoint1/public>
		Options FollowSymLinks Indexes
		AllowOverride All                  
		Require all granted 
	</Directory>
	
</VirtualHost>
```
