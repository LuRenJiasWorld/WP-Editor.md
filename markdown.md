# Title 1

## Title 2

### Title 3

#### Title 4

##### Title 5

###### Title 6

**粗体**

~~删除线~~

> 引用块

1. 有序列表
1. 有序列表
    1. 有序列表
    1. 有序列表
1. 有序列表

---

* 无序列表
* 无序列表
    * 无序列表
    * 无序列表
* 无序列表

[超链接](https://github.com/JaxsonWang/WP-Editor.MD)

![图片加载](https://raw.githubusercontent.com/JaxsonWang/WP-Editor.MD/master/Interface-logo.jpg)

```html
<header class="mui-bar mui-bar-nav">
    <span id="openMenu" class="mui-icon mui-icon-bars mui-icon-left-nav mui-pull-left"></span>
    <h1 class="mui-title">XXXX</h1>
    <span id="search" class="mui-icon mui-icon-search mui-icon-right-nav mui-pull-right"></span>
</header>
```

```css
html body {
    font-family: Helvetica;
}

html,body {
    background: rgba(255,255,255,1);
}
```

```javascript
//首页选项卡文章进入详细页说明
mui('.list1-table-view').on('tap', '.list1-table-view-cell', function () {
    mui.openWindow({
        id: 'article',
        url: 'template/food/article.html'
    })
});
```

```php
//保存设置数据
public function user_personalopts_update() {
	global $current_user;
	update_user_option( $current_user->ID, 'rich_editing', 'false', true );
}
```

```java
public String catelogMana()
	{
		String sql="from TCatelog where catelogDel='no'";
		List cateLogList=catelogDAO.getHibernateTemplate().find(sql);
		Map request=(Map)ServletActionContext.getContext().get("request");
		request.put("cateLogList", cateLogList);
		return ActionSupport.SUCCESS;
	}
```

| Interface | Hash Table | Resizable Array | Balanced Tree | Linked List | Hash Table + Linked List |
| --- | --- | --- | --- | --- | --- |
| Set | HashSet |  | TreeSet |  | LinkedHashSet |
| List |  | ArrayList | | LinkedList |  |
| Deque |  | ArrayDeque | | LinkedList |  |
| Map | HashMap |  |TreeMap |  |LinkedHashMap |