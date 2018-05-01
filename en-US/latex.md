# LaTeX

![](https://raw.githubusercontent.com/JaxsonWang/WP-Editor.MD/master/Interface-logo.jpg)

### Inline

```latex 
    $$E=mc^2$$
    
    Inline $$E=mc^2$$,Inline$$E=mc^2$$Inline。
    
    $$c = \pm\sqrt{a^2 + b^2}$$
    
    $$x > y$$
    
    $$f(x) = x^2$$
    
    $$\alpha = \sqrt{1-e^2}$$
    
    $$(\sqrt{3x-1}+(1+x)^2)$$
                 
    $$\sin(\alpha)^{\theta}=\sum_{i=0}^{n}(x^i + \cos(f))$$
    
    $$\dfrac{-b \pm\sqrt{b^2 - 4ac}}{2a}$$
    
    $$f(x) = \int_{-\infty}^\infty\hat f(\xi)\,e^{2 \pi i \xi x}\,d\xi$$
    
    $$\displaystyle \frac{1}{\Bigl(\sqrt{\phi \sqrt{5}}-\phi\Bigr) e^{\frac25 \pi}} = 1+\frac{e^{-2\pi}} {1+\frac{e^{-4\pi}} {1+\frac{e^{-6\pi}} {1+\frac{e^{-8\pi}} {1+\cdots} } } }$$
    
    $$\displaystyle \left( \sum\_{k=1}^n a\_k b\_k \right)^2 \leq \left( \sum\_{k=1}^n a\_k^2 \right) \left( \sum\_{k=1}^n b\_k^2 \right)$$
    
    $$a^2$$
    
    $$a^{2+2}$$
    
    $$a_2$$
    
    $${x_2}^3$$
    
    $$x_2^3$$
    
    $$10^{10^{8}}$$
    
    $$a_{i,j}$$
    
    $$_nP_k$$
    
    $$c = \pm\sqrt{a^2 + b^2}$$
    
    $$\frac{1}{2}=0.5$$
    
    $$\dfrac{k}{k-1} = 0.5$$
    
    $$\dbinom{n}{k} \binom{n}{k}$$
    
    $$\oint_C x^3\, dx + 4y^2\, dy$$
    
    $$\bigcap_1^n p   \bigcup_1^k p$$
    
    $$e^{i \pi} + 1 = 0$$
    
    $$\left ( \frac{1}{2} \right )$$
    
    $$x_{1,2}=\frac{-b\pm\sqrt{\color{Red}b^2-4ac}}{2a}$$
    
    $${\color{Blue}x^2}+{\color{YellowOrange}2x}-{\color{OliveGreen}1}$$
    
    $$\textstyle \sum_{k=1}^N k^2$$
    
    $$\dfrac{ \tfrac{1}{2}[1-(\tfrac{1}{2})^n] }{ 1-\tfrac{1}{2} } = s_n$$
    
    $$\binom{n}{k}$$
    
    $$0+1+2+3+4+5+6+7+8+9+10+11+12+13+14+15+16+17+18+19+20+\cdots$$
    
    $$\sum_{k=1}^N k^2$$
    
    $$\textstyle \sum_{k=1}^N k^2$$
    
    $$\prod_{i=1}^N x_i$$
    
    $$\textstyle \prod_{i=1}^N x_i$$
    
    $$\coprod_{i=1}^N x_i$$
    
    $$\textstyle \coprod_{i=1}^N x_i$$
    
    $$\int_{1}^{3}\frac{e^3/x}{x^2}\, dx$$
    
    $$\int_C x^3\, dx + 4y^2\, dy$$
    
    $${}_1^2\!\Omega_3^4$$
```
    
### Multi line
    
> \`\`\`math or \`\`\`latex or \`\`\`katex
   
```latex
    ```math
    f(x) = \int_{-\infty}^\infty
        \hat f(\xi)\,e^{2 \pi i \xi x}
        \,d\xi
    ```
    
    ```math
    \displaystyle
    \left( \sum\_{k=1}^n a\_k b\_k \right)^2
    \leq
    \left( \sum\_{k=1}^n a\_k^2 \right)
    \left( \sum\_{k=1}^n b\_k^2 \right)
    ```
    
    ```math
    \dfrac{ 
        \tfrac{1}{2}[1-(\tfrac{1}{2})^n] }
        { 1-\tfrac{1}{2} } = s_n
    ```
    
    ```katex
    \displaystyle 
        \frac{1}{
            \Bigl(\sqrt{\phi \sqrt{5}}-\phi\Bigr) e^{
            \frac25 \pi}} = 1+\frac{e^{-2\pi}} {1+\frac{e^{-4\pi}} {
            1+\frac{e^{-6\pi}}
            {1+\frac{e^{-8\pi}}
             {1+\cdots} }
            } 
        }
    ```
    
    ```latex
    f(x) = \int_{-\infty}^\infty
        \hat f(\xi)\,e^{2 \pi i \xi x}
        \,d\xi
    ```
```

### KaTeX vs MathJax

[https://jsperf.com/katex-vs-mathjax](https://jsperf.com/katex-vs-mathjax "KaTeX vs MathJax")