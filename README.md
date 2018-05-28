# job_demo

## 运行方法
1. git clone
2. composer install
3. php bin/console server:run

## 启动MongoDB

启动服务器端
```
mongod
```
结束服务器端`Control+C`

启动客户端
```
mongo [--host 127.0.0.1:27017]
```

## MongoDB学习

显示所有数据库的列表，至少有一条记录才会显示
```
show dbs
```
当前数据库
```
db
```
切换/创建数据库，如果不存在将自动创建
```
use <database_name>
```
删除数据库
```
db.dropDatabase()
```
插入数据
```
db.COLLECTION_NAME.insert(document)
```
查看数据
```
db.COLLECTION_NAME.find()
```
更新数据
```
db.COLLECTION_NAME.update()
```
删除数据
```
db.COLLECTION_NAME.deleteOne()
db.COLLECTION_NAME.deleteMany()
```

## PHP7中使用MongoDB

doctrine-project文档语句有问题，已替换为下方语句。
>http://symfony.com/doc/current/bundles/DoctrineMongoDBBundle/index.html
>https://www.doctrine-project.org/projects/doctrine-mongodb-odm/en/latest/reference/introduction.html#using-php-7
```
composer config "platform.ext-mongodb" "1.2.0" && composer require "alcaeus/mongo-php-adapter"
```

Mac安装pear
>https://www.jianshu.com/p/598c0fd84719

将go-pear.phar放置于/usr/local进行安装

PHP7 Mongdb 扩展安装
>http://www.runoob.com/mongodb/php7-mongdb-tutorial.html

```
sudo pecl install mongodb
```

brew install homebrew/php/php71-mongodb

## 备用：直接用git clone 手动编译

>http://php.net/manual/zh/mongodb.installation.manual.php

## 启用mongodb模块
```
cd /etc
sudo cp php.ini.default php.ini
sudo vim php.ini
```
添加一行
```
extension = mongodb.so
```
查看是否有mongodb模块
```
php -m
```


## Mac OS X 11中的/usr/bin 的“Operation not permitted”

>https://www.jianshu.com/p/22b89f19afd6

重启按住Command+R进入恢复模式，在终端输入。

关闭Rootless
```
csrutil disable
```
开启Rootless
```
csrutil enable
```

https://stackoverflow.com/questions/17049568/symfony2-generatebundle-is-not-defined

## generate:bundle 无法使用解决方法

Command "generate:bundle" is not defined.  

>https://stackoverflow.com/questions/17049568/symfony2-generatebundle-is-not-defined

安装sensio/generator-bundle
```
composer require sensio/generator-bundle
```

## MongoDB Driver 操作方法

>http://www.runoob.com/mongodb/php7-mongdb-tutorial.html
>http://php.net/manual/en/book.mongodb.php


