# 🎉 祝賀您升級到10.2.1版本！ 🎉

> 時隔五個月，WP Editor.md正式發佈10.2.1版本，包含大量更新。

更新內容如下：

## 0. 緊急修復（10.2.1版本引入）

* 修復特定情況下包含`$`的文本無法正常顯示的問題（[#488](https://github.com/LuRenJiasWorld/WP-Editor.md/issues/488)，鳴謝[@Clloz](https://github.com/Clloz)、[@aixiangfei](https://github.com/aixiangfei)）
* 修復由於代碼邏輯有誤導致PHP警告的問題（[#486](https://github.com/LuRenJiasWorld/WP-Editor.md/issues/486)，鳴謝[@RichardZhang2019](https://github.com/RichardZhang2019)）

> 以下內容由10.2.0版本引入

## 1. 體驗提升

* 使用Webpack進行代碼構建，體積縮小30%，頁麵加載速度更快
* 圖床功能支援與sm.ms用戶綁定，並支援sm.ms圖床管理功能，便於更高效管理上載的圖片
* 整理代碼格式，完善註釋，去除冗餘代碼，便於理解、維護、二次開發
* 編輯器支援滑鼠懸浮提示，便於快速了解工具欄各按鈕的用途
* 新增高亮文法支援，與Typora功能一緻，現在可以使用`==高亮==`來實現高亮文本（[#467](https://github.com/LuRenJiasWorld/WP-Editor.md/issues/467)）
* 粘貼圖片時新增Loading視窗，避免誤操作導緻粘貼上載失敗
* 設定菜單選擇編輯器/預覽/代碼高亮樣式時支援預覽，幫助您更快找到喜歡的樣式
* 升級後將為您跳轉到發行註記頁麵，幫助您更快了解最新版本的更新內容

## 2. 故障修複

* 修複自定義風格在後臺無法正常預覽的問題
* 修複評論功能相關故障（[#455](https://github.com/LuRenJiasWorld/WP-Editor.md/issues/455)）
* 不再誤解析pre標簽中的LaTeX代碼
* 不對多行LaTeX中的$符號進行循環解析（[#411](https://github.com/LuRenJiasWorld/WP-Editor.md/issues/411)）
* 修複特殊情況下新標簽頁打開鏈接功能無法生效的BUG（[#457](https://github.com/LuRenJiasWorld/WP-Editor.md/issues/457)）
* 修複粘貼圖片時連帶文件名一同粘貼到編輯器的問題
* 修複後臺評論無法預覽的問題
* 修複全屏後視窗大小無法自適應的BUG
* 進一步解決正文中`$`符號被誤識別為LaTeX公式導緻文章空白的BUG（[#420](https://github.com/LuRenJiasWorld/WP-Editor.md/issues/420)）
* 解決包含`_`的LaTeX公式被誤解析為`<em>`的BUG（[#411](https://github.com/LuRenJiasWorld/WP-Editor.md/issues/411)）
* 修複服務器外網不通情況下靜態資源版本檢查功能未設定超時導緻加載緩慢的問題
* 修複在開啓思維導圖情況下無法啓用前端評論功能的問題

## 3. 安全加固

* 後臺編輯器預覽時不再渲染如`<form>`、`<audio>`、`<video>`、`<scripts>`等與排版無關的標簽（[#428](https://github.com/LuRenJiasWorld/WP-Editor.md/issues/428)）

## 4. 其他

* 合並Editor.md代碼到本項目主幹（原作者@pandao已不再更新，合並便於二次開發，在未來版本實現更多功能）
* 新增依賴庫相關開源協議與版權信息，規範本項目開源質量
* 升級相關依賴庫到最新版本，避免安全隱患
* 修改在地化相關文本（[#458，感謝@zkl2333](https://github.com/LuRenJiasWorld/WP-Editor.md/issues/458)）
* 兼容WordPress 5.5版本

> 由於此前工作較忙，此前承諾的兩月一版未能及時履約，在這裏嚮各位錶示歉意。到2020年底之前，本編輯器會再發佈兩個版本（分別是10.3.0與10.3.1），解決過去一段時間各位用戶集中反饋的問題，並進一步提升性能，加入更多實用的新功能。
> 感謝大家對WP Editor.md的支援與信賴，祝大家學業順利，工作愉快！如果有其他問題或建議，歡迎在Issue中及時提出，我會及時回複，並在未來版本予以解決:)
