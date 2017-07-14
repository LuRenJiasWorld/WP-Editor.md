# Issue

![](https://raw.githubusercontent.com/JaxsonWang/WP-Editor.MD/master/Interface-logo.jpg)

## 插件问题收集

---

### Class 'DOMDocument' not found

报错如下：`PHP Fatal error:  Class 'DOMDocument' not found in /wp-content/plugins/wp-editormd/jetpack/markdown/xsshtml.class.php on line 95`

你需要安装DOM扩展，Debian/Ubuntu环境下：

```bash
sudo apt-get install php5-dom
```

Centos / Fedora / Red Hat环境下:

```bash
yum install php-xml
yum install php-dom
```

**If you get conflicts between PHP 5 and PHP 5.3 packages, you could try to see if the php53-xml package exists instead.**

输入`php -m`命令查看使用含有`dom`和`xml`参数，没有请如上安装！

安装成功后请重启php进程和web服务程序进程！

---