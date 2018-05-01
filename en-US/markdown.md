# Markdown

![](https://raw.githubusercontent.com/JaxsonWang/WP-Editor.md/docs/screenshots/Interface-logo.jpg)

It is recommended to copy the source code file to the editor to view the study!

[Source File](https://raw.githubusercontent.com/JaxsonWang/WP-Editor.md/docs/zh-CN/markdown.md)

more markdown info: [wordpress markdown](https://en.support.wordpress.com/markdown-quick-reference/)

---

Title:

# Title 1

## Title 2

### Title 3

#### Title 4

##### Title 5

###### Title 6

---

**Bold**

`code`

~~Strikethrough~~

> Reference

---

1. Ordered list
1. Ordered list
    1. Ordered list
    1. Ordered list
1. Ordered list

---

* Unordered list
* Unordered list
    * Unordered list
    * Unordered list
* Unordered list

---

[Hyperlink](https://github.com/JaxsonWang/WP-Editor.MD "Title")

---

Hi everyone, my name is Jaxson. Welcome to my [Github] and [Blog]

[Github]: https://github.com "Github"
[Blog]: https://iiong.com "Blog"

---

![Image](https://raw.githubusercontent.com/JaxsonWang/WP-Editor.md/docs/screenshots/Interface-logo.jpg "Logo")

---

![Alt][1]

[1]: https://raw.githubusercontent.com/JaxsonWang/WP-Editor.md/docs/screenshots/Interface-logo.jpg "Logo"

---

[![alt text](https://raw.githubusercontent.com/JaxsonWang/WP-Editor.md/docs/screenshots/Interface-logo.jpg)](https://iiong.com "Logo")

---

Footnotes(current editor does not support):

This is a beautiful [^1] footnotes!

[^1]: explanation.

---

Abbreviations(current editor does not support):

Markdown converts text to HTML.

*[HTML]: HyperText Markup Language

---

Syntax highlighting:

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
//This is just a note
mui('.list1-table-view').on('tap', '.list1-table-view-cell', function () {
	mui.openWindow({
		id: 'article',
		url: 'template/food/article.html'
	})
});
```

```php
//This is just a note
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

---

```seq
    A->B: Message
    B->C: Message
    C->A: Message
```

```sequence
    A->B: Message
    B->C: Message
    C->A: Message
```

---

```flow
    st=>start: User login
    op=>operation: Operation
    cond=>condition: Successful Yes or No?
    e=>end: Into admin
    st->op->cond
    cond(yes)->e
    cond(no)->op
```

---

Form:

| Interface | Hash Table | Resizable Array | Balanced Tree | Linked List | Hash Table + Linked List |
|    ---    |    ---     |      ---        |      ---      |      ---    |           ---            |
|Set        |HashSet     |                 |TreeSet        |             |LinkedHashSet             |
|List       |            |ArrayList        |               |LinkedList   |                          |
|Deque      |            |ArrayDeque       |               |LinkedList   |                          |
|Map        |HashMap     |                 |TreeMap        |             |LinkedHashMap             |

---

Form,Content centered or right:

| Interface | Hash Table | Resizable Array | Balanced Tree | Linked List | Hash Table + Linked List |
|   :---:   |   :---:    |     :---:       |      ---:     |      ---:   |           ---:           |
|Set        |HashSet     |                 |TreeSet        |             |LinkedHashSet             |
|List       |            |ArrayList        |               |LinkedList   |                          |
|Deque      |            |ArrayDeque       |               |LinkedList   |                          |
|Map        |HashMap     |                 |TreeMap        |             |LinkedHashMap             |