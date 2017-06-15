# Issue

![](./../Interface-logo.jpg)

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
```

**If you get conflicts between PHP 5 and PHP 5.3 packages, you could try to see if the php53-xml package exists instead.**

---