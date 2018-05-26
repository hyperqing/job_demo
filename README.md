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
db.<database_name>.insert(object)
```

