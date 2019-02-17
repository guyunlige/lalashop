
安装composer :  composer install

生成 .env :   copy .env.example  .env

             cp .env.example  .env

composer dump-autoload
生成laravel秘钥： php artisan key:generate

git config --global user.email
git config --global user.name

---------------------------------
github ssl 证书：

env GIT_SSL_NO_VERIFY=true git clone https://<host_name/git/project.git
git config http.sslVerify "false"

=================================================
一，artisan 基本用法：

1，创建数据库表

php artisan make:migration create_user_table --create=user

执行迁移  --  php artisan migrate

2，创建model：

php  artisan  make:model  Model\Home\Index

3,创建控制器

php artisan make:controller Home/IndexController
 
4，中间件  (暂时没用，2019-1-31)
 
php artisan make:middleware CheckLogin
 
5，生成laravel秘钥：
 
php artisan key:generate

---------------------------------------------------------------------

二，常见的配置位置总结

1，用来存放生成HTML文件缓存：

laravel_cms\storage\framework\views\

---------------------------------------------------------------------



1，创建一个controller控制器的artisan的命令

(1)默认在Controllers/UserController:
  php artisan make:controller UserController

(2)在Controllers/Home/UserController:
  php artisan make:controller Home/UserController
   

2,创建一个model的命令：
 位置：app/Model:
     php artisan make:model  Model\User
     或者
     php artisan make:model User


3,定义中间件 在app\http:
php artisan make:middleware CheckLogin

-------------------------------------------------

4，创建迁移目录：

php artisan make:migration create_user_table
php artisan make:migration create_user_table --create=users

// 修改表的命令
php artisan make:migration add_votes_to_users_table --table=users

创建列：
Schema::create('users', function ($table) {
    $table->increments('id');
    $table->string('name');
});

-------------------------------------------------
5,导出laravel中提供的分页视图

php artisan vendor :publish –tag=laravel-pagination


#################################################

安装composer :  composer install

生成 .env :   copy .env.example  .env

             cp .env.example  .env

生成laravel秘钥： php artisan key:generate

npm install

++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

1.创建数据迁移之前请先配置好数据库信息 /config/database.php

2.php artisan make:migration create_table_users --create=users

（1）create_table_users 数据迁移文件名称，如下图所示



（2）--create=users 要创建的表名为users

3.php artisan migrate --pretend

--pretend 查看数据库执行语句，并不直接创建数据表

4.php artisan migrate 创建数据表

5.php artisan migrate:rollback 将上一步生成的数据表删除，删除操作的实现与migrations表相关


一，laravel使用artisan创建迁移后手动删除迁移文件报错解决方法

 在laravel项目中，使用php artisan make:migration xxx 创建了数据库迁移文件，测试时手动删除了该迁移文件就会报错：

  [ErrorException]
  include(D:\projects\lav53\vendor\composer/../../database/migrations/2017_03_28_113253_change_sex_on_users_table.php): failed to open stream: No such file or directory

原因：

  在执行 artisan 命令后，会在 vendor/composer/autoload_classmap.php 和 vendor/composer/autoload_static.php 这两个文件里加上新生成的类和文件的映射，因为有了这个映射， artisan 命令就没有再生成新的文件


  解决方法：

     解决方法1、执行composer update；

     解决方法2、删除上面两个文件中含有报错信息的那行

     解决方法3、创建新的迁移文件
	 
二，iframe 内联框架  解决页面多个弹窗问题，layUI同一页面弹框切换  跨域问题

https://www.jianshu.com/p/9c15a8adce4a

配置：npm install anywhere -g



