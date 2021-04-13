# [chatapp](http://chatapp.erickferreira.ml)


### Simple realtime chat app

#### the idea of his app is to better UNDERSTAND how realtime app with socket works

### Login

![login](https://github.com/erickferreir4/chatapp/blob/master/app/assets/imgs/login.png?raw=true)

### Register

![register](https://github.com/erickferreir4/chatapp/blob/master/app/assets/imgs/register.png?raw=true)

### Chat

![Chat](https://github.com/erickferreir4/chatapp/blob/master/app/assets/imgs/chat.png?raw=true)


#### This app was created, thinking about database storage with php sqlite and socket with Ratchet, with a focus on LEARNING.

some techniques that were applied in the development

```
- Factory Method
    
    ConnectionFactory.php with switch in PDO


- Log

    LoggerHTML.php and LoggerTXT.php for logging transactions in /tmp
    

- Gateways

    TableDataMapper
        LoginController.php domain to LoginModel.php
        RegisterController.php domain to RegisterModel.php
        ApiController.php domain to ApiModel.php


- Transaction

    Transaction.php for greater control of database persistence


- Interface

    to have a contract with the following classes:

        ILogger.php for LoggerHTML.php and LoggerTXT.php
        IAssets.php for Assets.php and AssetsCdn.php


- Dependency Injection

    TemplateTrait.php created the setAssets method to inject similar Assets classes
    Transaction.php created the setLogger method to inject similar logger classes
    

- Trait

    TemplateTrait.php was created to have the same methods in view controllers
    ModelTrait.php was created to have the same different control methods
    UserTrait.php was created to have the same different control methods
    LoggedTrait.php was created to have the same different control methods


- Composer/socket

    was used together with the docker for socket dependecie
    autoload is used for automatic class loading


- Docker

    used to create a container for the application
    
```

