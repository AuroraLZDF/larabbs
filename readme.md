


# 5.5.*

# 扩展包

## laravel-debugbar 调试工具

### 安装
- 使用 Composer 安装该扩展包：
```bash
composer require barryvdh/laravel-debugbar --dev
```
- 接下来运行以下命令生成此扩展包的配置文件 `config/debugbar.php`：
```bash
php artisan vendor:publish --provider="Barryvdh\Debugbar\ServiceProvider"
```
- 打开 config/debugbar.php，将 enabled 的值设置为：
```php
'enabled' => env('APP_DEBUG', false),
```


## Intervention Image 图片处理

### 简介
Intervention/image 是为 Laravel 定制的图片处理工具, 它提供了一套易于表达的方式来创建、编辑图片。

### 安装
- 使用 composer 安装:
```bash
composer require intervention/image
```
- 图片处理库的配置

此扩展包默认使用 PHP 的 GD 库来进行图像处理, 但由于 GD 库对图像的处理效率要稍逊色于 imagemagick 库, 因此这里推荐替换为 imagemagick 库来进行图像处理.

开始之前, 你得先确定本地已经安装好 GD 或 Imagick.

在使用 Intervention Image 的时候, 你只需要给 ImageManager 传一个数组参数就可以完成 GD 和 Imagick 库之间的互相切换.

如下所示:
```bash
php artisan vendor:publish --provider="Intervention\Image\ImageServiceProviderLaravel5"
```
运行上面的命令后, 会在项目中生成 `config/image.php` 配置文件, 打开此文件并将 driver 修改成 imagick
```php
return array(
    'driver' => 'imagick'
);
```

### 特色功能
- 读取图片、创建图片、编辑图片、保存图片到文件系统
- 图片上传
- 图片缓存
- 图片过滤功能: 将图片按照统一规则进行转换
- 图片动态处理: 根据访问图片的 URL 参数自动调整图片大小

[官方文档](http://image.intervention.io/)


## laravel-permission 权限控制

### 安装
- 使用 composer 安装:
```bash
composer require spatie/laravel-permission
```
- 接下来运行以下命令生成数据库迁移文件：
```bash
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider" --tag="migrations"
```
- 执行 `php artisan migrate` 
```bash
php artisan migrate
```
- 接下来运行以下命令生成此扩展包的配置文件 `config/permission.php`：
```bash
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider" --tag="config"
```


## Laravel-ide-helper 高效的 IDE 智能提示插件

### 安装
- 使用 Composer 安装该扩展包：
```bash
composer require barryvdh/laravel-ide-helper --dev
```
- 在 `app/Providers/AppServiceProvider.php` 文件的 `register()` 方法注册 ide-helper 
```php
public function register()
{
    // 非生产环境
    if ($this->app->environment() !== 'production') {
        $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
    }
    // ...
}
```
- 接下来运行以下命令生成代码对应文档：
```bash
php artisan ide-helper:generate
```
- 注意：必须首先清除 `bootstrap/compiled.php`，因此在生成之前运行 `php artisan clear-compiled` 清除编译（以及 之后运行`php artisan optimize` ）。
可以配置 `composer.json` 在每次提交后执行此操作：
```json
"scripts":{
    "post-update-cmd": [
        "Illuminate\\Foundation\\ComposerScripts::postUpdate",
        "php artisan ide-helper:generate",
        "php artisan ide-helper:meta",
        "php artisan optimize"
    ]
},
```
- 接下来运行以下命令生成此扩展包的配置文件 `config/ide-helper.php`：
```bash
php artisan vendor:publish --provider="Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider" --tag=config
```

## Laravel Excel v2.1.* for Laravel 5 Excel扩展包

### 安装
- 使用 Composer 安装该扩展包：
```bash
composer require "maatwebsite/excel:~2.1.0"
```
- 接下来运行以下命令生成此扩展包的配置文件 `config/permission.php`：
```bash
php artisan vendor:publish --provider="Maatwebsite\Excel\ExcelServiceProvider"
```
[官方文档](https://laravel-excel.maatwebsite.nl/)


## Snappy PDF/Image PDF/图片 扩展包
### 注
需要先安装 `Wkhtmltopdf` windows 忽略
### 安装
- 使用 Composer 安装该扩展包：
```bash
composer require barryvdh/laravel-snappy
```
- 接下来运行以下命令生成此扩展包的配置文件 `config/permission.php`：
```bash
php artisan vendor:publish --provider="Barryvdh\Snappy\ServiceProvider"
```


## Agent 客户端 User Agent 解析工具（基于 Mobiledetect）
### 安装
- 使用 Composer 安装该扩展包：
```bash
composer require jenssegers/agent
```


## GeoIP 获取 IP 地理信息
### 安装
- 使用 Composer 安装该扩展包：
```bash
composer require torann/geoip
```
- 生成配置文件
```bash
php artisan vendor:publish --provider="Torann\GeoIP\GeoIPServiceProvider" --tag=config
```
- 更新 IP 地址库
```bash
php artisan geoip:update
```
### 基本使用
```php
$location = GeoIP::getLocation();
```
结果如下：
```php
array (
    "ip" => "127.0.0.0"
    "iso_code" => "US"
    "country" => "United States"
    "city" => "New Haven"
    "state" => "CT"
    "state_name" => "Connecticut"
    "postal_code" => "06510"
    "lat" => 41.31
    "lon" => -72.92
    "timezone" => "America/New_York"
    "continent" => "NA"
    "currency" => "USD"
    "default" => true
    "cached" => false
);
```


## Simple QrCode
### 使用 Composer 安装该扩展包：
```bash
composer require simplesoftwareio/simple-qrcode
```


## Envoy Task Runner    优雅的 SSH 远程任务执行工具
- 使用 Composer 安装该扩展包：
```bash
composer global require laravel/envoy
composer global update
```
- 安装完成后测试：
```bash
$ envoy --version
Laravel Envoy 1.4.1 
```
- 初始化并创建 `deploy` 任务

首先, 在你的 小项目 跟目录下, 执行以下命令进行初始化
```bash
$ envoy init vagrant@192.168.10.10
Envoy file created!
```
上面的命令会在此文件夹下生成一个 `Envoy.blade.php` 的文件, 内容如下
```php
@servers(['web' => 'vagrant@192.168.10.10'])

@task('deploy')
    cd /path/to/site
    git pull origin master
@endtask
```
- 运行
```bash
envoy run deploy
```

## 添加自定义函数
- 修改 `composer.json` 里 `files` 这部分：
```json
"autoload": {
    "classmap": [
      "database"
    ],
    "psr-4": {
      "App\\": "app/"
    },
    "files": [
      "bootstrap/helpers.php"
    ]
  }
```
- 然后执行 `composer dump-autoload`
```bash
composer dump-autoload
```



