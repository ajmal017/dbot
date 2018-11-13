# Trading bot - Dbot
PHP trading bot framework

## Requirements
Dbot requires PHP version 7.2 or greater, mysql server also required for data storage. 
This project includes automatic trading with basic strategies. All testing and coding was done on Mac OSX so this will work on other linux system but I will
never bother to do this for Windows. For Windows users you are on your own.

### Befor you start
This project needs php extension trader.
Create one folder and in that folder you can install it by the following commands.
Before you run the migration and seeder setup your .env file.

### Set up commands
```
1. git clone https://github.com/deakzsolt/dbot.git
2. composer update
3. php artisan migrate
4. php artisan db:seed
5. echo "* * * * * `which php` `pwd`/artisan schedule:run >> /dev/null 2>&1" | /usr/bin/crontab
``` 

### Install php extension trader
First check is the trader extension set in the php by running:
```
php -m
```
If you see trader in the list then you are good to go.

To install a php extension trader run the following command
```
sudo pecl install trader
```
Check the end of the installation and if it states that the extension must be added to php.ini then do so.
In my case I did have to add the extension=trader.so to php.ini.
When this is done open a new terminal window and test there with "php -m" command is the extension there.

#### Import data
Now when all is set we need data in order to start the trading bot.
The import:history command expect's 2 parameters, pair and exchange. 
The exchange parameter is set as default poloniex while the pair can be multiple trading pairs.
For example here is one command:
```
php artisan import:history USDT_BTC,BTC_ETC,USDT_ETH,USDT_ETC,USDT_ZEC,BTC_ZEC,USDT_ZRX
```
Check on the exchange from where the pairs are imported what are the predefined symbols for the API.
 
___
> This project is still under development and it is not 100% functional!
___