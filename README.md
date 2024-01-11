# laravel-workerman

This project uses the [Laravel9.0 framework](https://laravel.com/) and [Linkerman](https://github.com/zhanguangcheng/linkerman) (based on [Workerman](https://www.workerman.net)) to build a project template.

The purpose is to run the Laravel9.0 framework in Workerman to implement the resident memory to improve the performance.

## Requirements

- PHP >= 8.0

## Installation

```bash
git clone https://github.com/zhanguangcheng/laravel-workerman.git
cd laravel-workerman
composer install
```

## Start the service

Add to php.ini file
```ini
disable_functions=set_time_limit,header,header_remove,headers_sent,headers_list,http_response_code,setcookie,setrawcookie,session_start,session_write_close,session_status,session_id,session_name,session_save_path,session_regenerate_id,session_unset,session_destroy,session_set_cookie_params,session_get_cookie_params,is_uploaded_file,move_uploaded_file
```

```bash
php server.php start
```

## Security Vulnerabilities

If you discover a security vulnerability within yii2-workerman, Please submit an [issue](https://github.com/zhanguangcheng/laravel-workerman/issues) or send an e-mail to zhanguangcheng at 14712905@qq.com. All security vulnerabilities will be
promptly addressed.

