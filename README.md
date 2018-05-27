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

PHP7 Mongdb 扩展安装
>http://www.runoob.com/mongodb/php7-mongdb-tutorial.html