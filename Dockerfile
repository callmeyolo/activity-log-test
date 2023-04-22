# 使用官方的 PHP 镜像作为基础镜像
FROM php:8-apache

# 安装 PDO MySQL 扩展
RUN docker-php-ext-install mysqli

# 安装 Node.js 和 npm
RUN curl -sL https://deb.nodesource.com/setup_16.x | bash -
RUN apt-get install -y nodejs

# 安装 Sass
RUN npm install -g sass

# 安装 Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# 为 Apache 配置一个虚拟主机
COPY ./vhost.conf /etc/apache2/sites-available/000-default.conf

# 启用 Apache 的重写模块
RUN a2enmod rewrite

# 将源代码复制到容器中的工作目录
COPY . /var/www/html

# 编译 SCSS 文件
RUN sass style.scss style.css

# 修改文件权限
RUN chown -R www-data:www-data /var/www/html

# 暴露端口
EXPOSE 80
