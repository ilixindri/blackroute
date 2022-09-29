# blackroute
Internet Provider System
## Codes
### Principais
```
php artisan cache:clear && php artisan config:clear && php artisan view:clear && php artisan route:clear
php artisan migrate:refresh --seed
php artisan clear-compiled && composer dump-autoload && php artisan optimize
npm run watch
npm install && npm run dev
```
### Others
```
php artisan make:model Agreement
php artisan make:migration create_agreement_table
```
### Develop
 - Install Qodana (JetBrains)
#### Docker to Qodana (run before docker)
```
sudo apt install -y ca-certificates curl gnupg lsb-release
sudo mkdir -p /etc/apt/keyrings
curl -fsSL https://download.docker.com/linux/ubuntu/gpg | sudo gpg --dearmor -o /etc/apt/keyrings/docker.gpg
echo "deb [arch=$(dpkg --print-architecture) signed-by=/etc/apt/keyrings/docker.gpg] https://download.docker.com/linux/ubuntu $(lsb_release -cs) stable" | sudo tee /etc/apt/sources.list.d/docker.list > /dev/null
sudo apt update -y
```
