up:
	vagrant up

down:
	vagrant halt

clean:
	vagrant destroy
	rm -rf .vagrant

reload:
	vagrant reload

ssh:
	vagrant ssh

generate-ssl:
	mkdir .ssl
	openssl req -x509 -newkey rsa:4096 -nodes -out .ssl/cert.pem -keyout .ssl/key.pem -days 3650

ssh-config:
	vagrant ssh-config
	
info:
	vagrant ssh -c "php --version"
	vagrant ssh -c "mysql --version"

create-project:
	composer create-project laravel/laravel ./www
	vagrant ssh -c "php artisan key:generate"
	
	

