<!-- Elemento raiz do PhotoSwipe. Deve ter class pswp. -->
<div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
    <!-- Fundo de PhotoSwipe. É um elemento separado, pois a opacidade de animação é mais rápida que rgba (). -->
    <div class="pswp__bg"></div>
    <!-- Slides wrapper Slides com estouro:oculto overflow:hidden. -->
    <div class="pswp__scroll-wrap">
        <!-- Comtainer que contém os slides. O PhotoSwipe mantém apenas 3 deles no DOM para economizar memória. Não modifique esses elementos 3 pswp__item, os dados são adicionados posteriormente. -->
        <div class="pswp__container">
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
        </div>
        <!-- Padrão (PhotoSwipeUI_Default) interface em cima da área de deslizamento. Pode ser mudado. -->
        <div class="pswp__ui pswp__ui--hidden">
            <div class="pswp__top-bar">
                <!-- Controls are self-explanatory. Ordem pode ser alterada. -->
                <div class="pswp__counter"></div>
                <button class="pswp__button pswp__button--close" title="Fechar (Esc)"></button>
                <button class="pswp__button pswp__button--share" title="Compartilhar"></button>
                <button class="pswp__button pswp__button--fs" title="Tela Cheia"></button>
                <button class="pswp__button pswp__button--zoom" title="Ampliar"></button>
                <!-- Preloader demo http: //codepen.io/dimsemenov/pen/yyBWoR -->
                <!-- element will get class pswp__preloader--active when preloader is running -->
                <div class="pswp__preloader">
                    <div class="pswp__preloader__icn">
                        <div class="pswp__preloader__cut">
                            <div class="pswp__preloader__donut"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                <div class="pswp__share-tooltip"></div>
            </div>
            <button class="pswp__button pswp__button--arrow--left" title="Anterior (arrow left)"> </button>
            <button class="pswp__button pswp__button--arrow--right" title="Proximo (arrow right)"> </button>
            <div class="pswp__caption">
                <div class="pswp__caption__center"></div>
            </div>
        </div>
    </div>
</div>
