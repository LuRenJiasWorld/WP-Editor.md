# 🎉 Conguatulations! You have successfully upgraded WP Editor.md to version 10.2.1 🎉

> After five months of waiting, WP Editor.md's new version has been officially launched, which contains tons of new features.

## 0. Urgent Fixes（Added in version 10.2.1）

* Fix the issue causing blank post when it contains `$` in some cases. （[#488](https://github.com/LuRenJiasWorld/WP-Editor.md/issues/488)，Thanks[@Clloz](https://github.com/Clloz)、[@aixiangfei](https://github.com/aixiangfei)）
* Fix some PHP Warnings. （[#486](https://github.com/LuRenJiasWorld/WP-Editor.md/issues/486)，Thanks[@RichardZhang2019](https://github.com/RichardZhang2019)）

> Changelog below were introduced in version 10.2.0.

## 1. Experience Enhancements

* Using webpack to build JavaScript code, reducing the final `.min.js` size by 30%, making WP Editor.md to load faster.
* Image uploading to sm.ms now supports binding to sm.ms user account, and also add sm.ms image management functionality into the settings page of WP Editor.md.
* Reformat the code, enhancing the maintainability, security and performance, also makes it more easily to add more feature.
* Supports mouse hover tip in editor toolbar, makes it more easily to know each button's meaning in the toolbar.
* Add markdown highlight support, just like Typora, now you can use `==highlight==` to highlight any text you want. ([#467](https://github.com/LuRenJiasWorld/WP-Editor.md/issues/467))
* Add loading screen when uploading image, to prevent unexpected user actions to interrupt the uploading process.
* Supports previewing in Editor / Markdown / Code Highlight settings, helps you find your favorite style more efficiently.
* Display the release note after a successful update (like this one), to help you know more about the newest updates.

## 2. Bug Fixes

* Fix custom code highlightin style can't property displayed in editor.
* Fix markdown comment infinite loading issue. ([#455](https://github.com/LuRenJiasWorld/WP-Editor.md/issues/455))
* WP Editor.md will no longer extract and renderding the LaTeX code in `<pre>` tag.
* WP Editor.md will no longer recursively rendering the `$` sign in LaTeX code. ([#411](https://github.com/LuRenJiasWorld/WP-Editor.md/issues/411))
* Fix issue causing "Open links in new page" function failed to work. ([#457](https://github.com/LuRenJiasWorld/WP-Editor.md/issues/457))
* Fix redundant filename when copy an image file and paste it into editor when image pasting is enabled.
* Fix issue in comments management causing comments invisible.
* Fix issue when the editor window is set to fullscreen then set it back to normal mode, the editor will not auto adapt screen width.
* Further fix the issue causing all post content invisible by the `$` sign. ([#420](https://github.com/LuRenJiasWorld/WP-Editor.md/issues/420))
* Fix the issue that the `_` sign in LaTeX formula would be incorrectly rendered as `<em>` like it in Markdown. ([#411](https://github.com/LuRenJiasWorld/WP-Editor.md/issues/411))
* Fix the slow loading issue when your server has a poor internet connection.
* Fix the issue causing markdown comment load infinitely when MindMap was enabled.

## 3. Security Reinforcements

* Editor will not preview the labels unrelated to typography like `<form>``<audio>` `<video>` `<scripts>` and more. ([#428](https://github.com/LuRenJiasWorld/WP-Editor.md/issues/428))

## 4. Other

* Merge Editor.md source code into the editor. (Original author @pandao had not working on this for nearly four years, but WP Editor.md will still add more features into it)
* Add license in every open source project dependency, enhancing the open source quality of WP Editor.md.
* Update dependency into the newest version to avoid any security issue.
* Edit some localization text. ([#458，Thanks to @zkl2333](https://github.com/LuRenJiasWorld/WP-Editor.md/issues/458))
* Compatibility work to make it works with WordPress 5.5.

> It has been too busy for me to fulfilled the bimonthly new version promised before in time, and I'd like to express my apologies to you. By the end of 2020, two more versions of WP Editor.md (10.3.0 and 10.3.1, respectively) will be released to address the issues that many users have been focusing on for some time, then further improve performance, adding more useful new features.

> Thank you all for your support and trust in WP Editor.md. Wish you have a successful academic achievement or a happy work! If you have any other questions or suggestions, please feel free to mention them in the Issue. I will reply in time and solve them in the future version :)
