/*! Magnific Popup - v1.0.0 - 2015-01-03
 * http://dimsemenov.com/plugins/magnific-popup/
 * Copyright (c) 2015 Dmitry Semenov; */
;(function (factory) {
    if (typeof define === 'function' && define.amd) {
        // AMD. Register as an anonymous module.
        define(['jquery'], factory);
    } else if (typeof exports === 'object') {
        // Node/CommonJS
        factory(require('jquery'));
    } else {
        // Browser globals
        factory(window.jQuery || window.Zepto);
    }
}(function($) {

    /*>>core*/
    /**
     *
     * Magnific Popup Core JS file
     *
     */


    /**
     * Private static constants
     */
    var CLOSE_EVENT = 'Close',
        BEFORE_CLOSE_EVENT = 'BeforeClose',
        AFTER_CLOSE_EVENT = 'AfterClose',
        BEFORE_APPEND_EVENT = 'BeforeAppend',
        MARKUP_PARSE_EVENT = 'MarkupParse',
        OPEN_EVENT = 'Open',
        CHANGE_EVENT = 'Change',
        NS = 'mfp',
        EVENT_NS = '.' + NS,
        READY_CLASS = 'mfp-ready',
        REMOVING_CLASS = 'mfp-removing',
        PREVENT_CLOSE_CLASS = 'mfp-prevent-close';


    /**
     * Private vars
     */
    /*jshint -W079 */
    var mfp, // As we have only one instance of MagnificPopup object, we define it locally to not to use 'this'
        MagnificPopup = function(){},
        _isJQ = !!(window.jQuery),
        _prevStatus,
        _window = $(window),
        _document,
        _prevContentType,
        _wrapClasses,
        _currPopupType;


    /**
     * Private functions
     */
    var _mfpOn = function(name, f) {
            mfp.ev.on(NS + name + EVENT_NS, f);
        },
        _getEl = function(className, appendTo, html, raw) {
            var el = document.createElement('div');
            el.className = 'mfp-'+className;
            if(html) {
                el.innerHTML = html;
            }
            if(!raw) {
                el = $(el);
                if(appendTo) {
                    el.appendTo(appendTo);
                }
            } else if(appendTo) {
                appendTo.appendChild(el);
            }
            return el;
        },
        _mfpTrigger = function(e, data) {
            mfp.ev.triggerHandler(NS + e, data);

            if(mfp.st.callbacks) {
                // converts "mfpEventName" to "eventName" callback and triggers it if it's present
                e = e.charAt(0).toLowerCase() + e.slice(1);
                if(mfp.st.callbacks[e]) {
                    mfp.st.callbacks[e].apply(mfp, $.isArray(data) ? data : [data]);
                }
            }
        },
        _getCloseBtn = function(type) {
            if(type !== _currPopupType || !mfp.currTemplate.closeBtn) {
                mfp.currTemplate.closeBtn = $( mfp.st.closeMarkup.replace('%title%', mfp.st.tClose ) );
                _currPopupType = type;
            }
            return mfp.currTemplate.closeBtn;
        },
        // Initialize Magnific Popup only when called at least once
        _checkInstance = function() {
            if(!$.magnificPopup.instance) {
                /*jshint -W020 */
                mfp = new MagnificPopup();
                mfp.init();
                $.magnificPopup.instance = mfp;
            }
        },
        // CSS transition detection, http://stackoverflow.com/questions/7264899/detect-css-transitions-using-javascript-and-without-modernizr
        supportsTransitions = function() {
            var s = document.createElement('p').style, // 's' for style. better to create an element if body yet to exist
                v = ['ms','O','Moz','Webkit']; // 'v' for vendor

            if( s['transition'] !== undefined ) {
                return true;
            }

            while( v.length ) {
                if( v.pop() + 'Transition' in s ) {
                    return true;
                }
            }

            return false;
        };



    /**
     * Public functions
     */
    MagnificPopup.prototype = {

        constructor: MagnificPopup,

        /**
         * Initializes Magnific Popup plugin.
         * This function is triggered only once when $.fn.magnificPopup or $.magnificPopup is executed
         */
        init: function() {
            var appVersion = navigator.appVersion;
            mfp.isIE7 = appVersion.indexOf("MSIE 7.") !== -1;
            mfp.isIE8 = appVersion.indexOf("MSIE 8.") !== -1;
            mfp.isLowIE = mfp.isIE7 || mfp.isIE8;
            mfp.isAndroid = (/android/gi).test(appVersion);
            mfp.isIOS = (/iphone|ipad|ipod/gi).test(appVersion);
            mfp.supportsTransition = supportsTransitions();

            // We disable fixed positioned lightbox on devices that don't handle it nicely.
            // If you know a better way of detecting this - let me know.
            mfp.probablyMobile = (mfp.isAndroid || mfp.isIOS || /(Opera Mini)|Kindle|webOS|BlackBerry|(Opera Mobi)|(Windows Phone)|IEMobile/i.test(navigator.userAgent) );
            _document = $(document);

            mfp.popupsCache = {};
        },

        /**
         * Opens popup
         * @param  data [description]
         */
        open: function(data) {

            var i;

            if(data.isObj === false) {
                // convert jQuery collection to array to avoid conflicts later
                mfp.items = data.items.toArray();

                mfp.index = 0;
                var items = data.items,
                    item;
                for(i = 0; i < items.length; i++) {
                    item = items[i];
                    if(item.parsed) {
                        item = item.el[0];
                    }
                    if(item === data.el[0]) {
                        mfp.index = i;
                        break;
                    }
                }
            } else {
                mfp.items = $.isArray(data.items) ? data.items : [data.items];
                mfp.index = data.index || 0;
            }

            // if popup is already opened - we just update the content
            if(mfp.isOpen) {
                mfp.updateItemHTML();
                return;
            }

            mfp.types = [];
            _wrapClasses = '';
            if(data.mainEl && data.mainEl.length) {
                mfp.ev = data.mainEl.eq(0);
            } else {
                mfp.ev = _document;
            }

            if(data.key) {
                if(!mfp.popupsCache[data.key]) {
                    mfp.popupsCache[data.key] = {};
                }
                mfp.currTemplate = mfp.popupsCache[data.key];
            } else {
                mfp.currTemplate = {};
            }



            mfp.st = $.extend(true, {}, $.magnificPopup.defaults, data );
            mfp.fixedContentPos = mfp.st.fixedContentPos === 'auto' ? !mfp.probablyMobile : mfp.st.fixedContentPos;

            if(mfp.st.modal) {
                mfp.st.closeOnContentClick = false;
                mfp.st.closeOnBgClick = false;
                mfp.st.showCloseBtn = false;
                mfp.st.enableEscapeKey = false;
            }


            // Building markup
            // main carousel are created only once
            if(!mfp.bgOverlay) {

                // Dark overlay
                mfp.bgOverlay = _getEl('bg').on('click'+EVENT_NS, function() {
                    mfp.close();
                });

                mfp.wrap = _getEl('wrap').attr('tabindex', -1).on('click'+EVENT_NS, function(e) {
                    if(mfp._checkIfClose(e.target)) {
                        mfp.close();
                    }
                });

                mfp.container = _getEl('container', mfp.wrap);
            }

            mfp.contentContainer = _getEl('content');
            if(mfp.st.preloader) {
                mfp.preloader = _getEl('preloader', mfp.container, mfp.st.tLoading);
            }


            // Initializing modules
            var modules = $.magnificPopup.modules;
            for(i = 0; i < modules.length; i++) {
                var n = modules[i];
                n = n.charAt(0).toUpperCase() + n.slice(1);
                mfp['init'+n].call(mfp);
            }
            _mfpTrigger('BeforeOpen');


            if(mfp.st.showCloseBtn) {
                // Close button
                if(!mfp.st.closeBtnInside) {
                    mfp.wrap.append( _getCloseBtn() );
                } else {
                    _mfpOn(MARKUP_PARSE_EVENT, function(e, template, values, item) {
                        values.close_replaceWith = _getCloseBtn(item.type);
                    });
                    _wrapClasses += ' mfp-close-btn-in';
                }
            }

            if(mfp.st.alignTop) {
                _wrapClasses += ' mfp-align-top';
            }



            if(mfp.fixedContentPos) {
                mfp.wrap.css({
                    overflow: mfp.st.overflowY,
                    overflowX: 'hidden',
                    overflowY: mfp.st.overflowY
                });
            } else {
                mfp.wrap.css({
                    top: _window.scrollTop(),
                    position: 'absolute'
                });
            }
            if( mfp.st.fixedBgPos === false || (mfp.st.fixedBgPos === 'auto' && !mfp.fixedContentPos) ) {
                mfp.bgOverlay.css({
                    height: _document.height(),
                    position: 'absolute'
                });
            }



            if(mfp.st.enableEscapeKey) {
                // Close on ESC key
                _document.on('keyup' + EVENT_NS, function(e) {
                    if(e.keyCode === 27) {
                        mfp.close();
                    }
                });
            }

            _window.on('resize' + EVENT_NS, function() {
                mfp.updateSize();
            });


            if(!mfp.st.closeOnContentClick) {
                _wrapClasses += ' mfp-auto-cursor';
            }

            if(_wrapClasses)
                mfp.wrap.addClass(_wrapClasses);


            // this triggers recalculation of layout, so we get it once to not to trigger twice
            var windowHeight = mfp.wH = _window.height();


            var windowStyles = {};

            if( mfp.fixedContentPos ) {
                if(mfp._hasScrollBar(windowHeight)){
                    var s = mfp._getScrollbarSize();
                    if(s) {
                        windowStyles.marginRight = s;
                    }
                }
            }

            if(mfp.fixedContentPos) {
                if(!mfp.isIE7) {
                    windowStyles.overflow = 'hidden';
                } else {
                    // ie7 double-scroll bug
                    $('body, html').css('overflow', 'hidden');
                }
            }



            var classesToadd = mfp.st.mainClass;
            if(mfp.isIE7) {
                classesToadd += ' mfp-ie7';
            }
            if(classesToadd) {
                mfp._addClassToMFP( classesToadd );
            }

            // add content
            mfp.updateItemHTML();

            _mfpTrigger('BuildControls');

            // remove scrollbar, add margin e.t.c
            $('html').css(windowStyles);

            // add everything to DOM
            mfp.bgOverlay.add(mfp.wrap).prependTo( mfp.st.prependTo || $(document.body) );

            // Save last focused element
            mfp._lastFocusedEl = document.activeElement;

            // Wait for next cycle to allow CSS transition
            setTimeout(function() {

                if(mfp.content) {
                    mfp._addClassToMFP(READY_CLASS);
                    mfp._setFocus();
                } else {
                    // if content is not defined (not loaded e.t.c) we add class only for BG
                    mfp.bgOverlay.addClass(READY_CLASS);
                }

                // Trap the focus in popup
                _document.on('focusin' + EVENT_NS, mfp._onFocusIn);

            }, 16);

            mfp.isOpen = true;
            mfp.updateSize(windowHeight);
            _mfpTrigger(OPEN_EVENT);

            return data;
        },

        /**
         * Closes the popup
         */
        close: function() {
            if(!mfp.isOpen) return;
            _mfpTrigger(BEFORE_CLOSE_EVENT);

            mfp.isOpen = false;
            // for CSS3 animation
            if(mfp.st.removalDelay && !mfp.isLowIE && mfp.supportsTransition )  {
                mfp._addClassToMFP(REMOVING_CLASS);
                setTimeout(function() {
                    mfp._close();
                }, mfp.st.removalDelay);
            } else {
                mfp._close();
            }
        },

        /**
         * Helper for close() function
         */
        _close: function() {
            _mfpTrigger(CLOSE_EVENT);

            var classesToRemove = REMOVING_CLASS + ' ' + READY_CLASS + ' ';

            mfp.bgOverlay.detach();
            mfp.wrap.detach();
            mfp.container.empty();

            if(mfp.st.mainClass) {
                classesToRemove += mfp.st.mainClass + ' ';
            }

            mfp._removeClassFromMFP(classesToRemove);

            if(mfp.fixedContentPos) {
                var windowStyles = {marginRight: ''};
                if(mfp.isIE7) {
                    $('body, html').css('overflow', '');
                } else {
                    windowStyles.overflow = '';
                }
                $('html').css(windowStyles);
            }

            _document.off('keyup' + EVENT_NS + ' focusin' + EVENT_NS);
            mfp.ev.off(EVENT_NS);

            // clean up DOM elements that aren't removed
            mfp.wrap.attr('class', 'mfp-wrap').removeAttr('style');
            mfp.bgOverlay.attr('class', 'mfp-bg');
            mfp.container.attr('class', 'mfp-container');

            // remove close button from target element
            if(mfp.st.showCloseBtn &&
                (!mfp.st.closeBtnInside || mfp.currTemplate[mfp.currItem.type] === true)) {
                if(mfp.currTemplate.closeBtn)
                    mfp.currTemplate.closeBtn.detach();
            }


            if(mfp._lastFocusedEl) {
                $(mfp._lastFocusedEl).focus(); // put tab focus back
            }
            mfp.currItem = null;
            mfp.content = null;
            mfp.currTemplate = null;
            mfp.prevHeight = 0;

            _mfpTrigger(AFTER_CLOSE_EVENT);
        },

        updateSize: function(winHeight) {

            if(mfp.isIOS) {
                // fixes iOS nav bars https://github.com/dimsemenov/Magnific-Popup/issues/2
                var zoomLevel = document.documentElement.clientWidth / window.innerWidth;
                var height = window.innerHeight * zoomLevel;
                mfp.wrap.css('height', height);
                mfp.wH = height;
            } else {
                mfp.wH = winHeight || _window.height();
            }
            // Fixes #84: popup incorrectly positioned with position:relative on body
            if(!mfp.fixedContentPos) {
                mfp.wrap.css('height', mfp.wH);
            }

            _mfpTrigger('Resize');

        },

        /**
         * Set content of popup based on current index
         */
        updateItemHTML: function() {
            var item = mfp.items[mfp.index];

            // Detach and perform modifications
            mfp.contentContainer.detach();

            if(mfp.content)
                mfp.content.detach();

            if(!item.parsed) {
                item = mfp.parseEl( mfp.index );
            }

            var type = item.type;

            _mfpTrigger('BeforeChange', [mfp.currItem ? mfp.currItem.type : '', type]);
            // BeforeChange event works like so:
            // _mfpOn('BeforeChange', function(e, prevType, newType) { });

            mfp.currItem = item;





            if(!mfp.currTemplate[type]) {
                var markup = mfp.st[type] ? mfp.st[type].markup : false;

                // allows to modify markup
                _mfpTrigger('FirstMarkupParse', markup);

                if(markup) {
                    mfp.currTemplate[type] = $(markup);
                } else {
                    // if there is no markup found we just define that template is parsed
                    mfp.currTemplate[type] = true;
                }
            }

            if(_prevContentType && _prevContentType !== item.type) {
                mfp.container.removeClass('mfp-'+_prevContentType+'-holder');
            }

            var newContent = mfp['get' + type.charAt(0).toUpperCase() + type.slice(1)](item, mfp.currTemplate[type]);
            mfp.appendContent(newContent, type);

            item.preloaded = true;

            _mfpTrigger(CHANGE_EVENT, item);
            _prevContentType = item.type;

            // Append container back after its content changed
            mfp.container.prepend(mfp.contentContainer);

            _mfpTrigger('AfterChange');
        },


        /**
         * Set HTML content of popup
         */
        appendContent: function(newContent, type) {
            mfp.content = newContent;

            if(newContent) {
                if(mfp.st.showCloseBtn && mfp.st.closeBtnInside &&
                    mfp.currTemplate[type] === true) {
                    // if there is no markup, we just append close button element inside
                    if(!mfp.content.find('.mfp-close').length) {
                        mfp.content.append(_getCloseBtn());
                    }
                } else {
                    mfp.content = newContent;
                }
            } else {
                mfp.content = '';
            }

            _mfpTrigger(BEFORE_APPEND_EVENT);
            mfp.container.addClass('mfp-'+type+'-holder');

            mfp.contentContainer.append(mfp.content);
        },




        /**
         * Creates Magnific Popup data object based on given data
         * @param  {int} index Index of item to parse
         */
        parseEl: function(index) {
            var item = mfp.items[index],
                type;

            if(item.tagName) {
                item = { el: $(item) };
            } else {
                type = item.type;
                item = { data: item, src: item.src };
            }

            if(item.el) {
                var types = mfp.types;

                // check for 'mfp-TYPE' class
                for(var i = 0; i < types.length; i++) {
                    if( item.el.hasClass('mfp-'+types[i]) ) {
                        type = types[i];
                        break;
                    }
                }

                item.src = item.el.attr('data-mfp-src');
                if(!item.src) {
                    item.src = item.el.attr('href');
                }
            }

            item.type = type || mfp.st.type || 'inline';
            item.index = index;
            item.parsed = true;
            mfp.items[index] = item;
            _mfpTrigger('ElementParse', item);

            return mfp.items[index];
        },


        /**
         * Initializes single popup or a group of popups
         */
        addGroup: function(el, options) {
            var eHandler = function(e) {
                e.mfpEl = this;
                mfp._openClick(e, el, options);
            };

            if(!options) {
                options = {};
            }

            var eName = 'click.magnificPopup';
            options.mainEl = el;

            if(options.items) {
                options.isObj = true;
                el.off(eName).on(eName, eHandler);
            } else {
                options.isObj = false;
                if(options.delegate) {
                    el.off(eName).on(eName, options.delegate , eHandler);
                } else {
                    options.items = el;
                    el.off(eName).on(eName, eHandler);
                }
            }
        },
        _openClick: function(e, el, options) {
            var midClick = options.midClick !== undefined ? options.midClick : $.magnificPopup.defaults.midClick;


            if(!midClick && ( e.which === 2 || e.ctrlKey || e.metaKey ) ) {
                return;
            }

            var disableOn = options.disableOn !== undefined ? options.disableOn : $.magnificPopup.defaults.disableOn;

            if(disableOn) {
                if($.isFunction(disableOn)) {
                    if( !disableOn.call(mfp) ) {
                        return true;
                    }
                } else { // else it's number
                    if( _window.width() < disableOn ) {
                        return true;
                    }
                }
            }

            if(e.type) {
                e.preventDefault();

                // This will prevent popup from closing if element is inside and popup is already opened
                if(mfp.isOpen) {
                    e.stopPropagation();
                }
            }


            options.el = $(e.mfpEl);
            if(options.delegate) {
                options.items = el.find(options.delegate);
            }
            mfp.open(options);
        },


        /**
         * Updates text on preloader
         */
        updateStatus: function(status, text) {

            if(mfp.preloader) {
                if(_prevStatus !== status) {
                    mfp.container.removeClass('mfp-s-'+_prevStatus);
                }

                if(!text && status === 'loading') {
                    text = mfp.st.tLoading;
                }

                var data = {
                    status: status,
                    text: text
                };
                // allows to modify status
                _mfpTrigger('UpdateStatus', data);

                status = data.status;
                text = data.text;

                mfp.preloader.html(text);

                mfp.preloader.find('a').on('click', function(e) {
                    e.stopImmediatePropagation();
                });

                mfp.container.addClass('mfp-s-'+status);
                _prevStatus = status;
            }
        },


        /*
         "Private" helpers that aren't private at all
         */
        // Check to close popup or not
        // "target" is an element that was clicked
        _checkIfClose: function(target) {

            if($(target).hasClass(PREVENT_CLOSE_CLASS)) {
                return;
            }

            var closeOnContent = mfp.st.closeOnContentClick;
            var closeOnBg = mfp.st.closeOnBgClick;

            if(closeOnContent && closeOnBg) {
                return true;
            } else {

                // We close the popup if click is on close button or on preloader. Or if there is no content.
                if(!mfp.content || $(target).hasClass('mfp-close') || (mfp.preloader && target === mfp.preloader[0]) ) {
                    return true;
                }

                // if click is outside the content
                if(  (target !== mfp.content[0] && !$.contains(mfp.content[0], target))  ) {
                    if(closeOnBg) {
                        // last check, if the clicked element is in DOM, (in case it's removed onclick)
                        if( $.contains(document, target) ) {
                            return true;
                        }
                    }
                } else if(closeOnContent) {
                    return true;
                }

            }
            return false;
        },
        _addClassToMFP: function(cName) {
            mfp.bgOverlay.addClass(cName);
            mfp.wrap.addClass(cName);
        },
        _removeClassFromMFP: function(cName) {
            this.bgOverlay.removeClass(cName);
            mfp.wrap.removeClass(cName);
        },
        _hasScrollBar: function(winHeight) {
            return (  (mfp.isIE7 ? _document.height() : document.body.scrollHeight) > (winHeight || _window.height()) );
        },
        _setFocus: function() {
            (mfp.st.focus ? mfp.content.find(mfp.st.focus).eq(0) : mfp.wrap).focus();
        },
        _onFocusIn: function(e) {
            if( e.target !== mfp.wrap[0] && !$.contains(mfp.wrap[0], e.target) ) {
                mfp._setFocus();
                return false;
            }
        },
        _parseMarkup: function(template, values, item) {
            var arr;
            if(item.data) {
                values = $.extend(item.data, values);
            }
            _mfpTrigger(MARKUP_PARSE_EVENT, [template, values, item] );

            $.each(values, function(key, value) {
                if(value === undefined || value === false) {
                    return true;
                }
                arr = key.split('_');
                if(arr.length > 1) {
                    var el = template.find(EVENT_NS + '-'+arr[0]);

                    if(el.length > 0) {
                        var attr = arr[1];
                        if(attr === 'replaceWith') {
                            if(el[0] !== value[0]) {
                                el.replaceWith(value);
                            }
                        } else if(attr === 'img') {
                            if(el.is('img')) {
                                el.attr('src', value);
                            } else {
                                el.replaceWith( '<img src="'+value+'" class="' + el.attr('class') + '" />' );
                            }
                        } else {
                            el.attr(arr[1], value);
                        }
                    }

                } else {
                    template.find(EVENT_NS + '-'+key).html(value);
                }
            });
        },

        _getScrollbarSize: function() {
            // thx David
            if(mfp.scrollbarSize === undefined) {
                var scrollDiv = document.createElement("div");
                scrollDiv.style.cssText = 'width: 99px; height: 99px; overflow: scroll; position: absolute; top: -9999px;';
                document.body.appendChild(scrollDiv);
                mfp.scrollbarSize = scrollDiv.offsetWidth - scrollDiv.clientWidth;
                document.body.removeChild(scrollDiv);
            }
            return mfp.scrollbarSize;
        }

    }; /* MagnificPopup core prototype end */




    /**
     * Public static functions
     */
    $.magnificPopup = {
        instance: null,
        proto: MagnificPopup.prototype,
        modules: [],

        open: function(options, index) {
            _checkInstance();

            if(!options) {
                options = {};
            } else {
                options = $.extend(true, {}, options);
            }


            options.isObj = true;
            options.index = index || 0;
            return this.instance.open(options);
        },

        close: function() {
            return $.magnificPopup.instance && $.magnificPopup.instance.close();
        },

        registerModule: function(name, module) {
            if(module.options) {
                $.magnificPopup.defaults[name] = module.options;
            }
            $.extend(this.proto, module.proto);
            this.modules.push(name);
        },

        defaults: {

            // Info about options is in docs:
            // http://dimsemenov.com/plugins/magnific-popup/documentation.html#options

            disableOn: 0,

            key: null,

            midClick: false,

            mainClass: '',

            preloader: true,

            focus: '', // CSS selector of input to focus after popup is opened

            closeOnContentClick: false,

            closeOnBgClick: true,

            closeBtnInside: true,

            showCloseBtn: true,

            enableEscapeKey: true,

            modal: false,

            alignTop: false,

            removalDelay: 0,

            prependTo: null,

            fixedContentPos: 'auto',

            fixedBgPos: 'auto',

            overflowY: 'auto',

            closeMarkup: '<button title="%title%" type="button" class="mfp-close">&times;</button>',

            tClose: 'Close (Esc)',

            tLoading: 'Loading...'

        }
    };



    $.fn.magnificPopup = function(options) {
        _checkInstance();

        var jqEl = $(this);

        // We call some API method of first param is a string
        if (typeof options === "string" ) {

            if(options === 'open') {
                var items,
                    itemOpts = _isJQ ? jqEl.data('magnificPopup') : jqEl[0].magnificPopup,
                    index = parseInt(arguments[1], 10) || 0;

                if(itemOpts.items) {
                    items = itemOpts.items[index];
                } else {
                    items = jqEl;
                    if(itemOpts.delegate) {
                        items = items.find(itemOpts.delegate);
                    }
                    items = items.eq( index );
                }
                mfp._openClick({mfpEl:items}, jqEl, itemOpts);
            } else {
                if(mfp.isOpen)
                    mfp[options].apply(mfp, Array.prototype.slice.call(arguments, 1));
            }

        } else {
            // clone options obj
            options = $.extend(true, {}, options);

            /*
             * As Zepto doesn't support .data() method for objects
             * and it works only in normal browsers
             * we assign "options" object directly to the DOM element. FTW!
             */
            if(_isJQ) {
                jqEl.data('magnificPopup', options);
            } else {
                jqEl[0].magnificPopup = options;
            }

            mfp.addGroup(jqEl, options);

        }
        return jqEl;
    };


//Quick benchmark
    /*
     var start = performance.now(),
     i,
     rounds = 1000;

     for(i = 0; i < rounds; i++) {

     }
     console.log('Test #1:', performance.now() - start);

     start = performance.now();
     for(i = 0; i < rounds; i++) {

     }
     console.log('Test #2:', performance.now() - start);
     */


    /*>>core*/

    /*>>inline*/

    var INLINE_NS = 'inline',
        _hiddenClass,
        _inlinePlaceholder,
        _lastInlineElement,
        _putInlineElementsBack = function() {
            if(_lastInlineElement) {
                _inlinePlaceholder.after( _lastInlineElement.addClass(_hiddenClass) ).detach();
                _lastInlineElement = null;
            }
        };

    $.magnificPopup.registerModule(INLINE_NS, {
        options: {
            hiddenClass: 'hide', // will be appended with `mfp-` prefix
            markup: '',
            tNotFound: 'Content not found'
        },
        proto: {

            initInline: function() {
                mfp.types.push(INLINE_NS);

                _mfpOn(CLOSE_EVENT+'.'+INLINE_NS, function() {
                    _putInlineElementsBack();
                });
            },

            getInline: function(item, template) {

                _putInlineElementsBack();

                if(item.src) {
                    var inlineSt = mfp.st.inline,
                        el = $(item.src);

                    if(el.length) {

                        // If target element has parent - we replace it with placeholder and put it back after popup is closed
                        var parent = el[0].parentNode;
                        if(parent && parent.tagName) {
                            if(!_inlinePlaceholder) {
                                _hiddenClass = inlineSt.hiddenClass;
                                _inlinePlaceholder = _getEl(_hiddenClass);
                                _hiddenClass = 'mfp-'+_hiddenClass;
                            }
                            // replace target inline element with placeholder
                            _lastInlineElement = el.after(_inlinePlaceholder).detach().removeClass(_hiddenClass);
                        }

                        mfp.updateStatus('ready');
                    } else {
                        mfp.updateStatus('error', inlineSt.tNotFound);
                        el = $('<div>');
                    }

                    item.inlineElement = el;
                    return el;
                }

                mfp.updateStatus('ready');
                mfp._parseMarkup(template, {}, item);
                return template;
            }
        }
    });

    /*>>inline*/

    /*>>ajax*/
    var AJAX_NS = 'ajax',
        _ajaxCur,
        _removeAjaxCursor = function() {
            if(_ajaxCur) {
                $(document.body).removeClass(_ajaxCur);
            }
        },
        _destroyAjaxRequest = function() {
            _removeAjaxCursor();
            if(mfp.req) {
                mfp.req.abort();
            }
        };

    $.magnificPopup.registerModule(AJAX_NS, {

        options: {
            settings: null,
            cursor: 'mfp-ajax-cur',
            tError: '<a href="%url%">The content</a> could not be loaded.'
        },

        proto: {
            initAjax: function() {
                mfp.types.push(AJAX_NS);
                _ajaxCur = mfp.st.ajax.cursor;

                _mfpOn(CLOSE_EVENT+'.'+AJAX_NS, _destroyAjaxRequest);
                _mfpOn('BeforeChange.' + AJAX_NS, _destroyAjaxRequest);
            },
            getAjax: function(item) {

                if(_ajaxCur) {
                    $(document.body).addClass(_ajaxCur);
                }

                mfp.updateStatus('loading');

                var opts = $.extend({
                    url: item.src,
                    success: function(data, textStatus, jqXHR) {
                        var temp = {
                            data:data,
                            xhr:jqXHR
                        };

                        _mfpTrigger('ParseAjax', temp);

                        mfp.appendContent( $(temp.data), AJAX_NS );

                        item.finished = true;

                        _removeAjaxCursor();

                        mfp._setFocus();

                        setTimeout(function() {
                            mfp.wrap.addClass(READY_CLASS);
                        }, 16);

                        mfp.updateStatus('ready');

                        _mfpTrigger('AjaxContentAdded');
                    },
                    error: function() {
                        _removeAjaxCursor();
                        item.finished = item.loadError = true;
                        mfp.updateStatus('error', mfp.st.ajax.tError.replace('%url%', item.src));
                    }
                }, mfp.st.ajax.settings);

                mfp.req = $.ajax(opts);

                return '';
            }
        }
    });







    /*>>ajax*/

    /*>>image*/
    var _imgInterval,
        _getTitle = function(item) {
            if(item.data && item.data.title !== undefined)
                return item.data.title;

            var src = mfp.st.image.titleSrc;

            if(src) {
                if($.isFunction(src)) {
                    return src.call(mfp, item);
                } else if(item.el) {
                    return item.el.attr(src) || '';
                }
            }
            return '';
        };

    $.magnificPopup.registerModule('image', {

        options: {
            markup: '<div class="mfp-figure">'+
            '<div class="mfp-close"></div>'+
            '<figure>'+
            '<div class="mfp-img"></div>'+
            '<figcaption>'+
            '<div class="mfp-bottom-bar">'+
            '<div class="mfp-title"></div>'+
            '<div class="mfp-counter"></div>'+
            '</div>'+
            '</figcaption>'+
            '</figure>'+
            '</div>',
            cursor: 'mfp-zoom-out-cur',
            titleSrc: 'title',
            verticalFit: true,
            tError: '<a href="%url%">The image</a> could not be loaded.'
        },

        proto: {
            initImage: function() {
                var imgSt = mfp.st.image,
                    ns = '.image';

                mfp.types.push('image');

                _mfpOn(OPEN_EVENT+ns, function() {
                    if(mfp.currItem.type === 'image' && imgSt.cursor) {
                        $(document.body).addClass(imgSt.cursor);
                    }
                });

                _mfpOn(CLOSE_EVENT+ns, function() {
                    if(imgSt.cursor) {
                        $(document.body).removeClass(imgSt.cursor);
                    }
                    _window.off('resize' + EVENT_NS);
                });

                _mfpOn('Resize'+ns, mfp.resizeImage);
                if(mfp.isLowIE) {
                    _mfpOn('AfterChange', mfp.resizeImage);
                }
            },
            resizeImage: function() {
                var item = mfp.currItem;
                if(!item || !item.img) return;

                if(mfp.st.image.verticalFit) {
                    var decr = 0;
                    // fix box-sizing in ie7/8
                    if(mfp.isLowIE) {
                        decr = parseInt(item.img.css('padding-top'), 10) + parseInt(item.img.css('padding-bottom'),10);
                    }
                    item.img.css('max-height', mfp.wH-decr);
                }
            },
            _onImageHasSize: function(item) {
                if(item.img) {

                    item.hasSize = true;

                    if(_imgInterval) {
                        clearInterval(_imgInterval);
                    }

                    item.isCheckingImgSize = false;

                    _mfpTrigger('ImageHasSize', item);

                    if(item.imgHidden) {
                        if(mfp.content)
                            mfp.content.removeClass('mfp-loading');

                        item.imgHidden = false;
                    }

                }
            },

            /**
             * Function that loops until the image has size to display elements that rely on it asap
             */
            findImageSize: function(item) {

                var counter = 0,
                    img = item.img[0],
                    mfpSetInterval = function(delay) {

                        if(_imgInterval) {
                            clearInterval(_imgInterval);
                        }
                        // decelerating interval that checks for size of an image
                        _imgInterval = setInterval(function() {
                            if(img.naturalWidth > 0) {
                                mfp._onImageHasSize(item);
                                return;
                            }

                            if(counter > 200) {
                                clearInterval(_imgInterval);
                            }

                            counter++;
                            if(counter === 3) {
                                mfpSetInterval(10);
                            } else if(counter === 40) {
                                mfpSetInterval(50);
                            } else if(counter === 100) {
                                mfpSetInterval(500);
                            }
                        }, delay);
                    };

                mfpSetInterval(1);
            },

            getImage: function(item, template) {

                var guard = 0,

                    // image load complete handler
                    onLoadComplete = function() {
                        if(item) {
                            if (item.img[0].complete) {
                                item.img.off('.mfploader');

                                if(item === mfp.currItem){
                                    mfp._onImageHasSize(item);

                                    mfp.updateStatus('ready');
                                }

                                item.hasSize = true;
                                item.loaded = true;

                                _mfpTrigger('ImageLoadComplete');

                            }
                            else {
                                // if image complete check fails 200 times (20 sec), we assume that there was an error.
                                guard++;
                                if(guard < 200) {
                                    setTimeout(onLoadComplete,100);
                                } else {
                                    onLoadError();
                                }
                            }
                        }
                    },

                    // image error handler
                    onLoadError = function() {
                        if(item) {
                            item.img.off('.mfploader');
                            if(item === mfp.currItem){
                                mfp._onImageHasSize(item);
                                mfp.updateStatus('error', imgSt.tError.replace('%url%', item.src) );
                            }

                            item.hasSize = true;
                            item.loaded = true;
                            item.loadError = true;
                        }
                    },
                    imgSt = mfp.st.image;


                var el = template.find('.mfp-img');
                if(el.length) {
                    var img = document.createElement('img');
                    img.className = 'mfp-img';
                    if(item.el && item.el.find('img').length) {
                        img.alt = item.el.find('img').attr('alt');
                    }
                    item.img = $(img).on('load.mfploader', onLoadComplete).on('error.mfploader', onLoadError);
                    img.src = item.src;

                    // without clone() "error" event is not firing when IMG is replaced by new IMG
                    // TODO: find a way to avoid such cloning
                    if(el.is('img')) {
                        item.img = item.img.clone();
                    }

                    img = item.img[0];
                    if(img.naturalWidth > 0) {
                        item.hasSize = true;
                    } else if(!img.width) {
                        item.hasSize = false;
                    }
                }

                mfp._parseMarkup(template, {
                    title: _getTitle(item),
                    img_replaceWith: item.img
                }, item);

                mfp.resizeImage();

                if(item.hasSize) {
                    if(_imgInterval) clearInterval(_imgInterval);

                    if(item.loadError) {
                        template.addClass('mfp-loading');
                        mfp.updateStatus('error', imgSt.tError.replace('%url%', item.src) );
                    } else {
                        template.removeClass('mfp-loading');
                        mfp.updateStatus('ready');
                    }
                    return template;
                }

                mfp.updateStatus('loading');
                item.loading = true;

                if(!item.hasSize) {
                    item.imgHidden = true;
                    template.addClass('mfp-loading');
                    mfp.findImageSize(item);
                }

                return template;
            }
        }
    });



    /*>>image*/

    /*>>zoom*/
    var hasMozTransform,
        getHasMozTransform = function() {
            if(hasMozTransform === undefined) {
                hasMozTransform = document.createElement('p').style.MozTransform !== undefined;
            }
            return hasMozTransform;
        };

    $.magnificPopup.registerModule('zoom', {

        options: {
            enabled: false,
            easing: 'ease-in-out',
            duration: 300,
            opener: function(element) {
                return element.is('img') ? element : element.find('img');
            }
        },

        proto: {

            initZoom: function() {
                var zoomSt = mfp.st.zoom,
                    ns = '.zoom',
                    image;

                if(!zoomSt.enabled || !mfp.supportsTransition) {
                    return;
                }

                var duration = zoomSt.duration,
                    getElToAnimate = function(image) {
                        var newImg = image.clone().removeAttr('style').removeAttr('class').addClass('mfp-animated-image'),
                            transition = 'all '+(zoomSt.duration/1000)+'s ' + zoomSt.easing,
                            cssObj = {
                                position: 'fixed',
                                zIndex: 9999,
                                left: 0,
                                top: 0,
                                '-webkit-backface-visibility': 'hidden'
                            },
                            t = 'transition';

                        cssObj['-webkit-'+t] = cssObj['-moz-'+t] = cssObj['-o-'+t] = cssObj[t] = transition;

                        newImg.css(cssObj);
                        return newImg;
                    },
                    showMainContent = function() {
                        mfp.content.css('visibility', 'visible');
                    },
                    openTimeout,
                    animatedImg;

                _mfpOn('BuildControls'+ns, function() {
                    if(mfp._allowZoom()) {

                        clearTimeout(openTimeout);
                        mfp.content.css('visibility', 'hidden');

                        // Basically, all code below does is clones existing image, puts in on top of the current one and animated it

                        image = mfp._getItemToZoom();

                        if(!image) {
                            showMainContent();
                            return;
                        }

                        animatedImg = getElToAnimate(image);

                        animatedImg.css( mfp._getOffset() );

                        mfp.wrap.append(animatedImg);

                        openTimeout = setTimeout(function() {
                            animatedImg.css( mfp._getOffset( true ) );
                            openTimeout = setTimeout(function() {

                                showMainContent();

                                setTimeout(function() {
                                    animatedImg.remove();
                                    image = animatedImg = null;
                                    _mfpTrigger('ZoomAnimationEnded');
                                }, 16); // avoid blink when switching images

                            }, duration); // this timeout equals animation duration

                        }, 16); // by adding this timeout we avoid short glitch at the beginning of animation


                        // Lots of timeouts...
                    }
                });
                _mfpOn(BEFORE_CLOSE_EVENT+ns, function() {
                    if(mfp._allowZoom()) {

                        clearTimeout(openTimeout);

                        mfp.st.removalDelay = duration;

                        if(!image) {
                            image = mfp._getItemToZoom();
                            if(!image) {
                                return;
                            }
                            animatedImg = getElToAnimate(image);
                        }


                        animatedImg.css( mfp._getOffset(true) );
                        mfp.wrap.append(animatedImg);
                        mfp.content.css('visibility', 'hidden');

                        setTimeout(function() {
                            animatedImg.css( mfp._getOffset() );
                        }, 16);
                    }

                });

                _mfpOn(CLOSE_EVENT+ns, function() {
                    if(mfp._allowZoom()) {
                        showMainContent();
                        if(animatedImg) {
                            animatedImg.remove();
                        }
                        image = null;
                    }
                });
            },

            _allowZoom: function() {
                return mfp.currItem.type === 'image';
            },

            _getItemToZoom: function() {
                if(mfp.currItem.hasSize) {
                    return mfp.currItem.img;
                } else {
                    return false;
                }
            },

            // Get element postion relative to viewport
            _getOffset: function(isLarge) {
                var el;
                if(isLarge) {
                    el = mfp.currItem.img;
                } else {
                    el = mfp.st.zoom.opener(mfp.currItem.el || mfp.currItem);
                }

                var offset = el.offset();
                var paddingTop = parseInt(el.css('padding-top'),10);
                var paddingBottom = parseInt(el.css('padding-bottom'),10);
                offset.top -= ( $(window).scrollTop() - paddingTop );


                /*

                 Animating left + top + width/height looks glitchy in Firefox, but perfect in Chrome. And vice-versa.

                 */
                var obj = {
                    width: el.width(),
                    // fix Zepto height+padding issue
                    height: (_isJQ ? el.innerHeight() : el[0].offsetHeight) - paddingBottom - paddingTop
                };

                // I hate to do this, but there is no another option
                if( getHasMozTransform() ) {
                    obj['-moz-transform'] = obj['transform'] = 'translate(' + offset.left + 'px,' + offset.top + 'px)';
                } else {
                    obj.left = offset.left;
                    obj.top = offset.top;
                }
                return obj;
            }

        }
    });



    /*>>zoom*/

    /*>>iframe*/

    var IFRAME_NS = 'iframe',
        _emptyPage = '//about:blank',

        _fixIframeBugs = function(isShowing) {
            if(mfp.currTemplate[IFRAME_NS]) {
                var el = mfp.currTemplate[IFRAME_NS].find('iframe');
                if(el.length) {
                    // reset src after the popup is closed to avoid "video keeps playing after popup is closed" bug
                    if(!isShowing) {
                        el[0].src = _emptyPage;
                    }

                    // IE8 black screen bug fix
                    if(mfp.isIE8) {
                        el.css('display', isShowing ? 'block' : 'none');
                    }
                }
            }
        };

    $.magnificPopup.registerModule(IFRAME_NS, {

        options: {
            markup: '<div class="mfp-iframe-scaler">'+
            '<div class="mfp-close"></div>'+
            '<iframe class="mfp-iframe" src="//about:blank" frameborder="0" allowfullscreen></iframe>'+
            '</div>',

            srcAction: 'iframe_src',

            // we don't care and support only one default type of URL by default
            patterns: {
                youtube: {
                    index: 'youtube.com',
                    id: 'v=',
                    src: '//www.youtube.com/embed/%id%?autoplay=1'
                },
                vimeo: {
                    index: 'vimeo.com/',
                    id: '/',
                    src: '//player.vimeo.com/video/%id%?autoplay=1'
                },
                gmaps: {
                    index: '//maps.google.',
                    src: '%id%&output=embed'
                }
            }
        },

        proto: {
            initIframe: function() {
                mfp.types.push(IFRAME_NS);

                _mfpOn('BeforeChange', function(e, prevType, newType) {
                    if(prevType !== newType) {
                        if(prevType === IFRAME_NS) {
                            _fixIframeBugs(); // iframe if removed
                        } else if(newType === IFRAME_NS) {
                            _fixIframeBugs(true); // iframe is showing
                        }
                    }// else {
                    // iframe source is switched, don't do anything
                    //}
                });

                _mfpOn(CLOSE_EVENT + '.' + IFRAME_NS, function() {
                    _fixIframeBugs();
                });
            },

            getIframe: function(item, template) {
                var embedSrc = item.src;
                var iframeSt = mfp.st.iframe;

                $.each(iframeSt.patterns, function() {
                    if(embedSrc.indexOf( this.index ) > -1) {
                        if(this.id) {
                            if(typeof this.id === 'string') {
                                embedSrc = embedSrc.substr(embedSrc.lastIndexOf(this.id)+this.id.length, embedSrc.length);
                            } else {
                                embedSrc = this.id.call( this, embedSrc );
                            }
                        }
                        embedSrc = this.src.replace('%id%', embedSrc );
                        return false; // break;
                    }
                });

                var dataObj = {};
                if(iframeSt.srcAction) {
                    dataObj[iframeSt.srcAction] = embedSrc;
                }
                mfp._parseMarkup(template, dataObj, item);

                mfp.updateStatus('ready');

                return template;
            }
        }
    });



    /*>>iframe*/

    /*>>gallery*/
    /**
     * Get looped index depending on number of slides
     */
    var _getLoopedId = function(index) {
            var numSlides = mfp.items.length;
            if(index > numSlides - 1) {
                return index - numSlides;
            } else  if(index < 0) {
                return numSlides + index;
            }
            return index;
        },
        _replaceCurrTotal = function(text, curr, total) {
            return text.replace(/%curr%/gi, curr + 1).replace(/%total%/gi, total);
        };

    $.magnificPopup.registerModule('gallery', {

        options: {
            enabled: false,
            arrowMarkup: '<button title="%title%" type="button" class="mfp-arrow mfp-arrow-%dir%"></button>',
            preload: [0,2],
            navigateByImgClick: true,
            arrows: true,

            tPrev: 'Previous (Left arrow key)',
            tNext: 'Next (Right arrow key)',
            tCounter: '%curr% of %total%'
        },

        proto: {
            initGallery: function() {

                var gSt = mfp.st.gallery,
                    ns = '.mfp-gallery',
                    supportsFastClick = Boolean($.fn.mfpFastClick);

                mfp.direction = true; // true - next, false - prev

                if(!gSt || !gSt.enabled ) return false;

                _wrapClasses += ' mfp-gallery';

                _mfpOn(OPEN_EVENT+ns, function() {

                    if(gSt.navigateByImgClick) {
                        mfp.wrap.on('click'+ns, '.mfp-img', function() {
                            if(mfp.items.length > 1) {
                                mfp.next();
                                return false;
                            }
                        });
                    }

                    _document.on('keydown'+ns, function(e) {
                        if (e.keyCode === 37) {
                            mfp.prev();
                        } else if (e.keyCode === 39) {
                            mfp.next();
                        }
                    });
                });

                _mfpOn('UpdateStatus'+ns, function(e, data) {
                    if(data.text) {
                        data.text = _replaceCurrTotal(data.text, mfp.currItem.index, mfp.items.length);
                    }
                });

                _mfpOn(MARKUP_PARSE_EVENT+ns, function(e, element, values, item) {
                    var l = mfp.items.length;
                    values.counter = l > 1 ? _replaceCurrTotal(gSt.tCounter, item.index, l) : '';
                });

                _mfpOn('BuildControls' + ns, function() {
                    if(mfp.items.length > 1 && gSt.arrows && !mfp.arrowLeft) {
                        var markup = gSt.arrowMarkup,
                            arrowLeft = mfp.arrowLeft = $( markup.replace(/%title%/gi, gSt.tPrev).replace(/%dir%/gi, 'left') ).addClass(PREVENT_CLOSE_CLASS),
                            arrowRight = mfp.arrowRight = $( markup.replace(/%title%/gi, gSt.tNext).replace(/%dir%/gi, 'right') ).addClass(PREVENT_CLOSE_CLASS);

                        var eName = supportsFastClick ? 'mfpFastClick' : 'click';
                        arrowLeft[eName](function() {
                            mfp.prev();
                        });
                        arrowRight[eName](function() {
                            mfp.next();
                        });

                        // Polyfill for :before and :after (adds elements with classes mfp-a and mfp-b)
                        if(mfp.isIE7) {
                            _getEl('b', arrowLeft[0], false, true);
                            _getEl('a', arrowLeft[0], false, true);
                            _getEl('b', arrowRight[0], false, true);
                            _getEl('a', arrowRight[0], false, true);
                        }

                        mfp.container.append(arrowLeft.add(arrowRight));
                    }
                });

                _mfpOn(CHANGE_EVENT+ns, function() {
                    if(mfp._preloadTimeout) clearTimeout(mfp._preloadTimeout);

                    mfp._preloadTimeout = setTimeout(function() {
                        mfp.preloadNearbyImages();
                        mfp._preloadTimeout = null;
                    }, 16);
                });


                _mfpOn(CLOSE_EVENT+ns, function() {
                    _document.off(ns);
                    mfp.wrap.off('click'+ns);

                    if(mfp.arrowLeft && supportsFastClick) {
                        mfp.arrowLeft.add(mfp.arrowRight).destroyMfpFastClick();
                    }
                    mfp.arrowRight = mfp.arrowLeft = null;
                });

            },
            next: function() {
                mfp.direction = true;
                mfp.index = _getLoopedId(mfp.index + 1);
                mfp.updateItemHTML();
            },
            prev: function() {
                mfp.direction = false;
                mfp.index = _getLoopedId(mfp.index - 1);
                mfp.updateItemHTML();
            },
            goTo: function(newIndex) {
                mfp.direction = (newIndex >= mfp.index);
                mfp.index = newIndex;
                mfp.updateItemHTML();
            },
            preloadNearbyImages: function() {
                var p = mfp.st.gallery.preload,
                    preloadBefore = Math.min(p[0], mfp.items.length),
                    preloadAfter = Math.min(p[1], mfp.items.length),
                    i;

                for(i = 1; i <= (mfp.direction ? preloadAfter : preloadBefore); i++) {
                    mfp._preloadItem(mfp.index+i);
                }
                for(i = 1; i <= (mfp.direction ? preloadBefore : preloadAfter); i++) {
                    mfp._preloadItem(mfp.index-i);
                }
            },
            _preloadItem: function(index) {
                index = _getLoopedId(index);

                if(mfp.items[index].preloaded) {
                    return;
                }

                var item = mfp.items[index];
                if(!item.parsed) {
                    item = mfp.parseEl( index );
                }

                _mfpTrigger('LazyLoad', item);

                if(item.type === 'image') {
                    item.img = $('<img class="mfp-img" />').on('load.mfploader', function() {
                        item.hasSize = true;
                    }).on('error.mfploader', function() {
                        item.hasSize = true;
                        item.loadError = true;
                        _mfpTrigger('LazyLoadError', item);
                    }).attr('src', item.src);
                }


                item.preloaded = true;
            }
        }
    });

    /*
     Touch Support that might be implemented some day

     addSwipeGesture: function() {
     var startX,
     moved,
     multipleTouches;

     return;

     var namespace = '.mfp',
     addEventNames = function(pref, down, move, up, cancel) {
     mfp._tStart = pref + down + namespace;
     mfp._tMove = pref + move + namespace;
     mfp._tEnd = pref + up + namespace;
     mfp._tCancel = pref + cancel + namespace;
     };

     if(window.navigator.msPointerEnabled) {
     addEventNames('MSPointer', 'Down', 'Move', 'Up', 'Cancel');
     } else if('ontouchstart' in window) {
     addEventNames('touch', 'start', 'move', 'end', 'cancel');
     } else {
     return;
     }
     _window.on(mfp._tStart, function(e) {
     var oE = e.originalEvent;
     multipleTouches = moved = false;
     startX = oE.pageX || oE.changedTouches[0].pageX;
     }).on(mfp._tMove, function(e) {
     if(e.originalEvent.touches.length > 1) {
     multipleTouches = e.originalEvent.touches.length;
     } else {
     //e.preventDefault();
     moved = true;
     }
     }).on(mfp._tEnd + ' ' + mfp._tCancel, function(e) {
     if(moved && !multipleTouches) {
     var oE = e.originalEvent,
     diff = startX - (oE.pageX || oE.changedTouches[0].pageX);

     if(diff > 20) {
     mfp.next();
     } else if(diff < -20) {
     mfp.prev();
     }
     }
     });
     },
     */


    /*>>gallery*/

    /*>>retina*/

    var RETINA_NS = 'retina';

    $.magnificPopup.registerModule(RETINA_NS, {
        options: {
            replaceSrc: function(item) {
                return item.src.replace(/\.\w+$/, function(m) { return '@2x' + m; });
            },
            ratio: 1 // Function or number.  Set to 1 to disable.
        },
        proto: {
            initRetina: function() {
                if(window.devicePixelRatio > 1) {

                    var st = mfp.st.retina,
                        ratio = st.ratio;

                    ratio = !isNaN(ratio) ? ratio : ratio();

                    if(ratio > 1) {
                        _mfpOn('ImageHasSize' + '.' + RETINA_NS, function(e, item) {
                            item.img.css({
                                'max-width': item.img[0].naturalWidth / ratio,
                                'width': '100%'
                            });
                        });
                        _mfpOn('ElementParse' + '.' + RETINA_NS, function(e, item) {
                            item.src = st.replaceSrc(item, ratio);
                        });
                    }
                }

            }
        }
    });

    /*>>retina*/

    /*>>fastclick*/
    /**
     * FastClick event implementation. (removes 300ms delay on touch devices)
     * Based on https://developers.google.com/mobile/articles/fast_buttons
     *
     * You may use it outside the Magnific Popup by calling just:
     *
     * $('.your-el').mfpFastClick(function() {
 *     console.log('Clicked!');
 * });
     *
     * To unbind:
     * $('.your-el').destroyMfpFastClick();
     *
     *
     * Note that it's a very basic and simple implementation, it blocks ghost click on the same element where it was bound.
     * If you need something more advanced, use plugin by FT Labs https://github.com/ftlabs/fastclick
     *
     */

    (function() {
        var ghostClickDelay = 1000,
            supportsTouch = 'ontouchstart' in window,
            unbindTouchMove = function() {
                _window.off('touchmove'+ns+' touchend'+ns);
            },
            eName = 'mfpFastClick',
            ns = '.'+eName;


        // As Zepto.js doesn't have an easy way to add custom events (like jQuery), so we implement it in this way
        $.fn.mfpFastClick = function(callback) {

            return $(this).each(function() {

                var elem = $(this),
                    lock;

                if( supportsTouch ) {

                    var timeout,
                        startX,
                        startY,
                        pointerMoved,
                        point,
                        numPointers;

                    elem.on('touchstart' + ns, function(e) {
                        pointerMoved = false;
                        numPointers = 1;

                        point = e.originalEvent ? e.originalEvent.touches[0] : e.touches[0];
                        startX = point.clientX;
                        startY = point.clientY;

                        _window.on('touchmove'+ns, function(e) {
                            point = e.originalEvent ? e.originalEvent.touches : e.touches;
                            numPointers = point.length;
                            point = point[0];
                            if (Math.abs(point.clientX - startX) > 10 ||
                                Math.abs(point.clientY - startY) > 10) {
                                pointerMoved = true;
                                unbindTouchMove();
                            }
                        }).on('touchend'+ns, function(e) {
                            unbindTouchMove();
                            if(pointerMoved || numPointers > 1) {
                                return;
                            }
                            lock = true;
                            e.preventDefault();
                            clearTimeout(timeout);
                            timeout = setTimeout(function() {
                                lock = false;
                            }, ghostClickDelay);
                            callback();
                        });
                    });

                }

                elem.on('click' + ns, function() {
                    if(!lock) {
                        callback();
                    }
                });
            });
        };

        $.fn.destroyMfpFastClick = function() {
            $(this).off('touchstart' + ns + ' click' + ns);
            if(supportsTouch) _window.off('touchmove'+ns+' touchend'+ns);
        };
    })();

    /*>>fastclick*/
    _checkInstance(); }));

/** FIM 1 MAGNIFC-POPUP */

/**
 * Owl Carousel v2.2.0
 * Copyright 2013-2016 David Deutsch
 * Licensed under MIT (https://github.com/OwlCarousel2/OwlCarousel2/blob/master/LICENSE)
 */
/**
 * Owl carousel
 * @version 2.1.6
 * @author Bartosz Wojciechowski
 * @author David Deutsch
 * @license The MIT License (MIT)
 * @todo Lazy Load Icon
 * @todo prevent animationend bubling
 * @todo itemsScaleUp
 * @todo Test Zepto
 * @todo stagePadding calculate wrong active classes
 */
;(function($, window, document, undefined) {

    /**
     * Creates a carousel.
     * @class The Owl Carousel.
     * @public
     * @param {HTMLElement|jQuery} element - The element to create the carousel for.
     * @param {Object} [options] - The options
     */
    function Owl(element, options) {

        /**
         * Current settings for the carousel.
         * @public
         */
        this.settings = null;

        /**
         * Current options set by the caller including defaults.
         * @public
         */
        this.options = $.extend({}, Owl.Defaults, options);

        /**
         * Plugin element.
         * @public
         */
        this.$element = $(element);

        /**
         * Proxied event handlers.
         * @protected
         */
        this._handlers = {};

        /**
         * References to the running plugins of this carousel.
         * @protected
         */
        this._plugins = {};

        /**
         * Currently suppressed events to prevent them from beeing retriggered.
         * @protected
         */
        this._supress = {};

        /**
         * Absolute current position.
         * @protected
         */
        this._current = null;

        /**
         * Animation speed in milliseconds.
         * @protected
         */
        this._speed = null;

        /**
         * Coordinates of all items in pixel.
         * @todo The name of this member is missleading.
         * @protected
         */
        this._coordinates = [];

        /**
         * Current breakpoint.
         * @todo Real media queries would be nice.
         * @protected
         */
        this._breakpoint = null;

        /**
         * Current width of the plugin element.
         */
        this._width = null;

        /**
         * All real items.
         * @protected
         */
        this._items = [];

        /**
         * All cloned items.
         * @protected
         */
        this._clones = [];

        /**
         * Merge values of all items.
         * @todo Maybe this could be part of a plugin.
         * @protected
         */
        this._mergers = [];

        /**
         * Widths of all items.
         */
        this._widths = [];

        /**
         * Invalidated parts within the update process.
         * @protected
         */
        this._invalidated = {};

        /**
         * Ordered list of workers for the update process.
         * @protected
         */
        this._pipe = [];

        /**
         * Current state information for the drag operation.
         * @todo #261
         * @protected
         */
        this._drag = {
            time: null,
            target: null,
            pointer: null,
            stage: {
                start: null,
                current: null
            },
            direction: null
        };

        /**
         * Current state information and their tags.
         * @type {Object}
         * @protected
         */
        this._states = {
            current: {},
            tags: {
                'initializing': [ 'busy' ],
                'animating': [ 'busy' ],
                'dragging': [ 'interacting' ]
            }
        };

        $.each([ 'onResize', 'onThrottledResize' ], $.proxy(function(i, handler) {
            this._handlers[handler] = $.proxy(this[handler], this);
        }, this));

        $.each(Owl.Plugins, $.proxy(function(key, plugin) {
            this._plugins[key.charAt(0).toLowerCase() + key.slice(1)]
                = new plugin(this);
        }, this));

        $.each(Owl.Workers, $.proxy(function(priority, worker) {
            this._pipe.push({
                'filter': worker.filter,
                'run': $.proxy(worker.run, this)
            });
        }, this));

        this.setup();
        this.initialize();
    }

    /**
     * Default options for the carousel.
     * @public
     */
    Owl.Defaults = {
        items: 3,
        loop: false,
        center: false,
        rewind: false,

        mouseDrag: true,
        touchDrag: true,
        pullDrag: true,
        freeDrag: false,

        margin: 0,
        stagePadding: 0,

        merge: false,
        mergeFit: true,
        autoWidth: false,

        startPosition: 0,
        rtl: false,

        smartSpeed: 250,
        fluidSpeed: false,
        dragEndSpeed: false,

        responsive: {},
        responsiveRefreshRate: 200,
        responsiveBaseElement: window,

        fallbackEasing: 'swing',

        info: false,

        nestedItemSelector: false,
        itemElement: 'div',
        stageElement: 'div',

        refreshClass: 'owl-refresh',
        loadedClass: 'owl-loaded',
        loadingClass: 'owl-loading',
        rtlClass: 'owl-rtl',
        responsiveClass: 'owl-responsive',
        dragClass: 'owl-drag',
        itemClass: 'owl-item',
        stageClass: 'owl-stage',
        stageOuterClass: 'owl-stage-outer',
        grabClass: 'owl-grab'
    };

    /**
     * Enumeration for width.
     * @public
     * @readonly
     * @enum {String}
     */
    Owl.Width = {
        Default: 'default',
        Inner: 'inner',
        Outer: 'outer'
    };

    /**
     * Enumeration for types.
     * @public
     * @readonly
     * @enum {String}
     */
    Owl.Type = {
        Event: 'event',
        State: 'state'
    };

    /**
     * Contains all registered plugins.
     * @public
     */
    Owl.Plugins = {};

    /**
     * List of workers involved in the update process.
     */
    Owl.Workers = [ {
        filter: [ 'width', 'settings' ],
        run: function() {
            this._width = this.$element.width();
        }
    }, {
        filter: [ 'width', 'items', 'settings' ],
        run: function(cache) {
            cache.current = this._items && this._items[this.relative(this._current)];
        }
    }, {
        filter: [ 'items', 'settings' ],
        run: function() {
            this.$stage.children('.cloned').remove();
        }
    }, {
        filter: [ 'width', 'items', 'settings' ],
        run: function(cache) {
            var margin = this.settings.margin || '',
                grid = !this.settings.autoWidth,
                rtl = this.settings.rtl,
                css = {
                    'width': 'auto',
                    'margin-left': rtl ? margin : '',
                    'margin-right': rtl ? '' : margin
                };

            !grid && this.$stage.children().css(css);

            cache.css = css;
        }
    }, {
        filter: [ 'width', 'items', 'settings' ],
        run: function(cache) {
            var width = (this.width() / this.settings.items).toFixed(3) - this.settings.margin,
                merge = null,
                iterator = this._items.length,
                grid = !this.settings.autoWidth,
                widths = [];

            cache.items = {
                merge: false,
                width: width
            };

            while (iterator--) {
                merge = this._mergers[iterator];
                merge = this.settings.mergeFit && Math.min(merge, this.settings.items) || merge;

                cache.items.merge = merge > 1 || cache.items.merge;

                widths[iterator] = !grid ? this._items[iterator].width() : width * merge;
            }

            this._widths = widths;
        }
    }, {
        filter: [ 'items', 'settings' ],
        run: function() {
            var clones = [],
                items = this._items,
                settings = this.settings,
                // TODO: Should be computed from number of min width items in stage
                view = Math.max(settings.items * 2, 4),
                size = Math.ceil(items.length / 2) * 2,
                repeat = settings.loop && items.length ? settings.rewind ? view : Math.max(view, size) : 0,
                append = '',
                prepend = '';

            repeat /= 2;

            while (repeat--) {
                // Switch to only using appended clones
                clones.push(this.normalize(clones.length / 2, true));
                append = append + items[clones[clones.length - 1]][0].outerHTML;
                clones.push(this.normalize(items.length - 1 - (clones.length - 1) / 2, true));
                prepend = items[clones[clones.length - 1]][0].outerHTML + prepend;
            }

            this._clones = clones;

            $(append).addClass('cloned').appendTo(this.$stage);
            $(prepend).addClass('cloned').prependTo(this.$stage);
        }
    }, {
        filter: [ 'width', 'items', 'settings' ],
        run: function() {
            var rtl = this.settings.rtl ? 1 : -1,
                size = this._clones.length + this._items.length,
                iterator = -1,
                previous = 0,
                current = 0,
                coordinates = [];

            while (++iterator < size) {
                previous = coordinates[iterator - 1] || 0;
                current = this._widths[this.relative(iterator)] + this.settings.margin;
                coordinates.push(previous + current * rtl);
            }

            this._coordinates = coordinates;
        }
    }, {
        filter: [ 'width', 'items', 'settings' ],
        run: function() {
            var padding = this.settings.stagePadding,
                coordinates = this._coordinates,
                css = {
                    'width': Math.ceil(Math.abs(coordinates[coordinates.length - 1])) + padding * 2,
                    'padding-left': padding || '',
                    'padding-right': padding || ''
                };

            this.$stage.css(css);
        }
    }, {
        filter: [ 'width', 'items', 'settings' ],
        run: function(cache) {
            var iterator = this._coordinates.length,
                grid = !this.settings.autoWidth,
                items = this.$stage.children();

            if (grid && cache.items.merge) {
                while (iterator--) {
                    cache.css.width = this._widths[this.relative(iterator)];
                    items.eq(iterator).css(cache.css);
                }
            } else if (grid) {
                cache.css.width = cache.items.width;
                items.css(cache.css);
            }
        }
    }, {
        filter: [ 'items' ],
        run: function() {
            this._coordinates.length < 1 && this.$stage.removeAttr('style');
        }
    }, {
        filter: [ 'width', 'items', 'settings' ],
        run: function(cache) {
            cache.current = cache.current ? this.$stage.children().index(cache.current) : 0;
            cache.current = Math.max(this.minimum(), Math.min(this.maximum(), cache.current));
            this.reset(cache.current);
        }
    }, {
        filter: [ 'position' ],
        run: function() {
            this.animate(this.coordinates(this._current));
        }
    }, {
        filter: [ 'width', 'position', 'items', 'settings' ],
        run: function() {
            var rtl = this.settings.rtl ? 1 : -1,
                padding = this.settings.stagePadding * 2,
                begin = this.coordinates(this.current()) + padding,
                end = begin + this.width() * rtl,
                inner, outer, matches = [], i, n;

            for (i = 0, n = this._coordinates.length; i < n; i++) {
                inner = this._coordinates[i - 1] || 0;
                outer = Math.abs(this._coordinates[i]) + padding * rtl;

                if ((this.op(inner, '<=', begin) && (this.op(inner, '>', end)))
                    || (this.op(outer, '<', begin) && this.op(outer, '>', end))) {
                    matches.push(i);
                }
            }

            this.$stage.children('.active').removeClass('active');
            this.$stage.children(':eq(' + matches.join('), :eq(') + ')').addClass('active');

            if (this.settings.center) {
                this.$stage.children('.center').removeClass('center');
                this.$stage.children().eq(this.current()).addClass('center');
            }
        }
    } ];

    /**
     * Initializes the carousel.
     * @protected
     */
    Owl.prototype.initialize = function() {
        this.enter('initializing');
        this.trigger('initialize');

        this.$element.toggleClass(this.settings.rtlClass, this.settings.rtl);

        if (this.settings.autoWidth && !this.is('pre-loading')) {
            var imgs, nestedSelector, width;
            imgs = this.$element.find('img');
            nestedSelector = this.settings.nestedItemSelector ? '.' + this.settings.nestedItemSelector : undefined;
            width = this.$element.children(nestedSelector).width();

            if (imgs.length && width <= 0) {
                this.preloadAutoWidthImages(imgs);
            }
        }

        this.$element.addClass(this.options.loadingClass);

        // create stage
        this.$stage = $('<' + this.settings.stageElement + ' class="' + this.settings.stageClass + '"/>')
            .wrap('<div class="' + this.settings.stageOuterClass + '"/>');

        // append stage
        this.$element.append(this.$stage.parent());

        // append content
        this.replace(this.$element.children().not(this.$stage.parent()));

        // check visibility
        if (this.$element.is(':visible')) {
            // update view
            this.refresh();
        } else {
            // invalidate width
            this.invalidate('width');
        }

        this.$element
            .removeClass(this.options.loadingClass)
            .addClass(this.options.loadedClass);

        // register event handlers
        this.registerEventHandlers();

        this.leave('initializing');
        this.trigger('initialized');
    };

    /**
     * Setups the current settings.
     * @todo Remove responsive classes. Why should adaptive designs be brought into IE8?
     * @todo Support for media queries by using `matchMedia` would be nice.
     * @public
     */
    Owl.prototype.setup = function() {
        var viewport = this.viewport(),
            overwrites = this.options.responsive,
            match = -1,
            settings = null;

        if (!overwrites) {
            settings = $.extend({}, this.options);
        } else {
            $.each(overwrites, function(breakpoint) {
                if (breakpoint <= viewport && breakpoint > match) {
                    match = Number(breakpoint);
                }
            });

            settings = $.extend({}, this.options, overwrites[match]);
            if (typeof settings.stagePadding === 'function') {
                settings.stagePadding = settings.stagePadding();
            }
            delete settings.responsive;

            // responsive class
            if (settings.responsiveClass) {
                this.$element.attr('class',
                    this.$element.attr('class').replace(new RegExp('(' + this.options.responsiveClass + '-)\\S+\\s', 'g'), '$1' + match)
                );
            }
        }

        this.trigger('change', { property: { name: 'settings', value: settings } });
        this._breakpoint = match;
        this.settings = settings;
        this.invalidate('settings');
        this.trigger('changed', { property: { name: 'settings', value: this.settings } });
    };

    /**
     * Updates option logic if necessery.
     * @protected
     */
    Owl.prototype.optionsLogic = function() {
        if (this.settings.autoWidth) {
            this.settings.stagePadding = false;
            this.settings.merge = false;
        }
    };

    /**
     * Prepares an item before add.
     * @todo Rename event parameter `content` to `item`.
     * @protected
     * @returns {jQuery|HTMLElement} - The item container.
     */
    Owl.prototype.prepare = function(item) {
        var event = this.trigger('prepare', { content: item });

        if (!event.data) {
            event.data = $('<' + this.settings.itemElement + '/>')
                .addClass(this.options.itemClass).append(item)
        }

        this.trigger('prepared', { content: event.data });

        return event.data;
    };

    /**
     * Updates the view.
     * @public
     */
    Owl.prototype.update = function() {
        var i = 0,
            n = this._pipe.length,
            filter = $.proxy(function(p) { return this[p] }, this._invalidated),
            cache = {};

        while (i < n) {
            if (this._invalidated.all || $.grep(this._pipe[i].filter, filter).length > 0) {
                this._pipe[i].run(cache);
            }
            i++;
        }

        this._invalidated = {};

        !this.is('valid') && this.enter('valid');
    };

    /**
     * Gets the width of the view.
     * @public
     * @param {Owl.Width} [dimension=Owl.Width.Default] - The dimension to return.
     * @returns {Number} - The width of the view in pixel.
     */
    Owl.prototype.width = function(dimension) {
        dimension = dimension || Owl.Width.Default;
        switch (dimension) {
            case Owl.Width.Inner:
            case Owl.Width.Outer:
                return this._width;
            default:
                return this._width - this.settings.stagePadding * 2 + this.settings.margin;
        }
    };

    /**
     * Refreshes the carousel primarily for adaptive purposes.
     * @public
     */
    Owl.prototype.refresh = function() {
        this.enter('refreshing');
        this.trigger('refresh');

        this.setup();

        this.optionsLogic();

        this.$element.addClass(this.options.refreshClass);

        this.update();

        this.$element.removeClass(this.options.refreshClass);

        this.leave('refreshing');
        this.trigger('refreshed');
    };

    /**
     * Checks window `resize` event.
     * @protected
     */
    Owl.prototype.onThrottledResize = function() {
        window.clearTimeout(this.resizeTimer);
        this.resizeTimer = window.setTimeout(this._handlers.onResize, this.settings.responsiveRefreshRate);
    };

    /**
     * Checks window `resize` event.
     * @protected
     */
    Owl.prototype.onResize = function() {
        if (!this._items.length) {
            return false;
        }

        if (this._width === this.$element.width()) {
            return false;
        }

        if (!this.$element.is(':visible')) {
            return false;
        }

        this.enter('resizing');

        if (this.trigger('resize').isDefaultPrevented()) {
            this.leave('resizing');
            return false;
        }

        this.invalidate('width');

        this.refresh();

        this.leave('resizing');
        this.trigger('resized');
    };

    /**
     * Registers event handlers.
     * @todo Check `msPointerEnabled`
     * @todo #261
     * @protected
     */
    Owl.prototype.registerEventHandlers = function() {
        if ($.support.transition) {
            this.$stage.on($.support.transition.end + '.owl.core', $.proxy(this.onTransitionEnd, this));
        }

        if (this.settings.responsive !== false) {
            this.on(window, 'resize', this._handlers.onThrottledResize);
        }

        if (this.settings.mouseDrag) {
            this.$element.addClass(this.options.dragClass);
            this.$stage.on('mousedown.owl.core', $.proxy(this.onDragStart, this));
            this.$stage.on('dragstart.owl.core selectstart.owl.core', function() { return false });
        }

        if (this.settings.touchDrag){
            this.$stage.on('touchstart.owl.core', $.proxy(this.onDragStart, this));
            this.$stage.on('touchcancel.owl.core', $.proxy(this.onDragEnd, this));
        }
    };

    /**
     * Handles `touchstart` and `mousedown` events.
     * @todo Horizontal swipe threshold as option
     * @todo #261
     * @protected
     * @param {Event} event - The event arguments.
     */
    Owl.prototype.onDragStart = function(event) {
        var stage = null;

        if (event.which === 3) {
            return;
        }

        if ($.support.transform) {
            stage = this.$stage.css('transform').replace(/.*\(|\)| /g, '').split(',');
            stage = {
                x: stage[stage.length === 16 ? 12 : 4],
                y: stage[stage.length === 16 ? 13 : 5]
            };
        } else {
            stage = this.$stage.position();
            stage = {
                x: this.settings.rtl ?
                    stage.left + this.$stage.width() - this.width() + this.settings.margin :
                    stage.left,
                y: stage.top
            };
        }

        if (this.is('animating')) {
            $.support.transform ? this.animate(stage.x) : this.$stage.stop()
            this.invalidate('position');
        }

        this.$element.toggleClass(this.options.grabClass, event.type === 'mousedown');

        this.speed(0);

        this._drag.time = new Date().getTime();
        this._drag.target = $(event.target);
        this._drag.stage.start = stage;
        this._drag.stage.current = stage;
        this._drag.pointer = this.pointer(event);

        $(document).on('mouseup.owl.core touchend.owl.core', $.proxy(this.onDragEnd, this));

        $(document).one('mousemove.owl.core touchmove.owl.core', $.proxy(function(event) {
            var delta = this.difference(this._drag.pointer, this.pointer(event));

            $(document).on('mousemove.owl.core touchmove.owl.core', $.proxy(this.onDragMove, this));

            if (Math.abs(delta.x) < Math.abs(delta.y) && this.is('valid')) {
                return;
            }

            event.preventDefault();

            this.enter('dragging');
            this.trigger('drag');
        }, this));
    };

    /**
     * Handles the `touchmove` and `mousemove` events.
     * @todo #261
     * @protected
     * @param {Event} event - The event arguments.
     */
    Owl.prototype.onDragMove = function(event) {
        var minimum = null,
            maximum = null,
            pull = null,
            delta = this.difference(this._drag.pointer, this.pointer(event)),
            stage = this.difference(this._drag.stage.start, delta);

        if (!this.is('dragging')) {
            return;
        }

        event.preventDefault();

        if (this.settings.loop) {
            minimum = this.coordinates(this.minimum());
            maximum = this.coordinates(this.maximum() + 1) - minimum;
            stage.x = (((stage.x - minimum) % maximum + maximum) % maximum) + minimum;
        } else {
            minimum = this.settings.rtl ? this.coordinates(this.maximum()) : this.coordinates(this.minimum());
            maximum = this.settings.rtl ? this.coordinates(this.minimum()) : this.coordinates(this.maximum());
            pull = this.settings.pullDrag ? -1 * delta.x / 5 : 0;
            stage.x = Math.max(Math.min(stage.x, minimum + pull), maximum + pull);
        }

        this._drag.stage.current = stage;

        this.animate(stage.x);
    };

    /**
     * Handles the `touchend` and `mouseup` events.
     * @todo #261
     * @todo Threshold for click event
     * @protected
     * @param {Event} event - The event arguments.
     */
    Owl.prototype.onDragEnd = function(event) {
        var delta = this.difference(this._drag.pointer, this.pointer(event)),
            stage = this._drag.stage.current,
            direction = delta.x > 0 ^ this.settings.rtl ? 'left' : 'right';

        $(document).off('.owl.core');

        this.$element.removeClass(this.options.grabClass);

        if (delta.x !== 0 && this.is('dragging') || !this.is('valid')) {
            this.speed(this.settings.dragEndSpeed || this.settings.smartSpeed);
            this.current(this.closest(stage.x, delta.x !== 0 ? direction : this._drag.direction));
            this.invalidate('position');
            this.update();

            this._drag.direction = direction;

            if (Math.abs(delta.x) > 3 || new Date().getTime() - this._drag.time > 300) {
                this._drag.target.one('click.owl.core', function() { return false; });
            }
        }

        if (!this.is('dragging')) {
            return;
        }

        this.leave('dragging');
        this.trigger('dragged');
    };

    /**
     * Gets absolute position of the closest item for a coordinate.
     * @todo Setting `freeDrag` makes `closest` not reusable. See #165.
     * @protected
     * @param {Number} coordinate - The coordinate in pixel.
     * @param {String} direction - The direction to check for the closest item. Ether `left` or `right`.
     * @return {Number} - The absolute position of the closest item.
     */
    Owl.prototype.closest = function(coordinate, direction) {
        var position = -1,
            pull = 30,
            width = this.width(),
            coordinates = this.coordinates();

        if (!this.settings.freeDrag) {
            // check closest item
            $.each(coordinates, $.proxy(function(index, value) {
                // on a left pull, check on current index
                if (direction === 'left' && coordinate > value - pull && coordinate < value + pull) {
                    position = index;
                    // on a right pull, check on previous index
                    // to do so, subtract width from value and set position = index + 1
                } else if (direction === 'right' && coordinate > value - width - pull && coordinate < value - width + pull) {
                    position = index + 1;
                } else if (this.op(coordinate, '<', value)
                    && this.op(coordinate, '>', coordinates[index + 1] || value - width)) {
                    position = direction === 'left' ? index + 1 : index;
                }
                return position === -1;
            }, this));
        }

        if (!this.settings.loop) {
            // non loop boundries
            if (this.op(coordinate, '>', coordinates[this.minimum()])) {
                position = coordinate = this.minimum();
            } else if (this.op(coordinate, '<', coordinates[this.maximum()])) {
                position = coordinate = this.maximum();
            }
        }

        return position;
    };

    /**
     * Animates the stage.
     * @todo #270
     * @public
     * @param {Number} coordinate - The coordinate in pixels.
     */
    Owl.prototype.animate = function(coordinate) {
        var animate = this.speed() > 0;

        this.is('animating') && this.onTransitionEnd();

        if (animate) {
            this.enter('animating');
            this.trigger('translate');
        }

        if ($.support.transform3d && $.support.transition) {
            this.$stage.css({
                transform: 'translate3d(' + coordinate + 'px,0px,0px)',
                transition: (this.speed() / 1000) + 's'
            });
        } else if (animate) {
            this.$stage.animate({
                left: coordinate + 'px'
            }, this.speed(), this.settings.fallbackEasing, $.proxy(this.onTransitionEnd, this));
        } else {
            this.$stage.css({
                left: coordinate + 'px'
            });
        }
    };

    /**
     * Checks whether the carousel is in a specific state or not.
     * @param {String} state - The state to check.
     * @returns {Boolean} - The flag which indicates if the carousel is busy.
     */
    Owl.prototype.is = function(state) {
        return this._states.current[state] && this._states.current[state] > 0;
    };

    /**
     * Sets the absolute position of the current item.
     * @public
     * @param {Number} [position] - The new absolute position or nothing to leave it unchanged.
     * @returns {Number} - The absolute position of the current item.
     */
    Owl.prototype.current = function(position) {
        if (position === undefined) {
            return this._current;
        }

        if (this._items.length === 0) {
            return undefined;
        }

        position = this.normalize(position);

        if (this._current !== position) {
            var event = this.trigger('change', { property: { name: 'position', value: position } });

            if (event.data !== undefined) {
                position = this.normalize(event.data);
            }

            this._current = position;

            this.invalidate('position');

            this.trigger('changed', { property: { name: 'position', value: this._current } });
        }

        return this._current;
    };

    /**
     * Invalidates the given part of the update routine.
     * @param {String} [part] - The part to invalidate.
     * @returns {Array.<String>} - The invalidated parts.
     */
    Owl.prototype.invalidate = function(part) {
        if ($.type(part) === 'string') {
            this._invalidated[part] = true;
            this.is('valid') && this.leave('valid');
        }
        return $.map(this._invalidated, function(v, i) { return i });
    };

    /**
     * Resets the absolute position of the current item.
     * @public
     * @param {Number} position - The absolute position of the new item.
     */
    Owl.prototype.reset = function(position) {
        position = this.normalize(position);

        if (position === undefined) {
            return;
        }

        this._speed = 0;
        this._current = position;

        this.suppress([ 'translate', 'translated' ]);

        this.animate(this.coordinates(position));

        this.release([ 'translate', 'translated' ]);
    };

    /**
     * Normalizes an absolute or a relative position of an item.
     * @public
     * @param {Number} position - The absolute or relative position to normalize.
     * @param {Boolean} [relative=false] - Whether the given position is relative or not.
     * @returns {Number} - The normalized position.
     */
    Owl.prototype.normalize = function(position, relative) {
        var n = this._items.length,
            m = relative ? 0 : this._clones.length;

        if (!this.isNumeric(position) || n < 1) {
            position = undefined;
        } else if (position < 0 || position >= n + m) {
            position = ((position - m / 2) % n + n) % n + m / 2;
        }

        return position;
    };

    /**
     * Converts an absolute position of an item into a relative one.
     * @public
     * @param {Number} position - The absolute position to convert.
     * @returns {Number} - The converted position.
     */
    Owl.prototype.relative = function(position) {
        position -= this._clones.length / 2;
        return this.normalize(position, true);
    };

    /**
     * Gets the maximum position for the current item.
     * @public
     * @param {Boolean} [relative=false] - Whether to return an absolute position or a relative position.
     * @returns {Number}
     */
    Owl.prototype.maximum = function(relative) {
        var settings = this.settings,
            maximum = this._coordinates.length,
            iterator,
            reciprocalItemsWidth,
            elementWidth;

        if (settings.loop) {
            maximum = this._clones.length / 2 + this._items.length - 1;
        } else if (settings.autoWidth || settings.merge) {
            iterator = this._items.length;
            reciprocalItemsWidth = this._items[--iterator].width();
            elementWidth = this.$element.width();
            while (iterator--) {
                reciprocalItemsWidth += this._items[iterator].width() + this.settings.margin;
                if (reciprocalItemsWidth > elementWidth) {
                    break;
                }
            }
            maximum = iterator + 1;
        } else if (settings.center) {
            maximum = this._items.length - 1;
        } else {
            maximum = this._items.length - settings.items;
        }

        if (relative) {
            maximum -= this._clones.length / 2;
        }

        return Math.max(maximum, 0);
    };

    /**
     * Gets the minimum position for the current item.
     * @public
     * @param {Boolean} [relative=false] - Whether to return an absolute position or a relative position.
     * @returns {Number}
     */
    Owl.prototype.minimum = function(relative) {
        return relative ? 0 : this._clones.length / 2;
    };

    /**
     * Gets an item at the specified relative position.
     * @public
     * @param {Number} [position] - The relative position of the item.
     * @return {jQuery|Array.<jQuery>} - The item at the given position or all items if no position was given.
     */
    Owl.prototype.items = function(position) {
        if (position === undefined) {
            return this._items.slice();
        }

        position = this.normalize(position, true);
        return this._items[position];
    };

    /**
     * Gets an item at the specified relative position.
     * @public
     * @param {Number} [position] - The relative position of the item.
     * @return {jQuery|Array.<jQuery>} - The item at the given position or all items if no position was given.
     */
    Owl.prototype.mergers = function(position) {
        if (position === undefined) {
            return this._mergers.slice();
        }

        position = this.normalize(position, true);
        return this._mergers[position];
    };

    /**
     * Gets the absolute positions of clones for an item.
     * @public
     * @param {Number} [position] - The relative position of the item.
     * @returns {Array.<Number>} - The absolute positions of clones for the item or all if no position was given.
     */
    Owl.prototype.clones = function(position) {
        var odd = this._clones.length / 2,
            even = odd + this._items.length,
            map = function(index) { return index % 2 === 0 ? even + index / 2 : odd - (index + 1) / 2 };

        if (position === undefined) {
            return $.map(this._clones, function(v, i) { return map(i) });
        }

        return $.map(this._clones, function(v, i) { return v === position ? map(i) : null });
    };

    /**
     * Sets the current animation speed.
     * @public
     * @param {Number} [speed] - The animation speed in milliseconds or nothing to leave it unchanged.
     * @returns {Number} - The current animation speed in milliseconds.
     */
    Owl.prototype.speed = function(speed) {
        if (speed !== undefined) {
            this._speed = speed;
        }

        return this._speed;
    };

    /**
     * Gets the coordinate of an item.
     * @todo The name of this method is missleanding.
     * @public
     * @param {Number} position - The absolute position of the item within `minimum()` and `maximum()`.
     * @returns {Number|Array.<Number>} - The coordinate of the item in pixel or all coordinates.
     */
    Owl.prototype.coordinates = function(position) {
        var multiplier = 1,
            newPosition = position - 1,
            coordinate;

        if (position === undefined) {
            return $.map(this._coordinates, $.proxy(function(coordinate, index) {
                return this.coordinates(index);
            }, this));
        }

        if (this.settings.center) {
            if (this.settings.rtl) {
                multiplier = -1;
                newPosition = position + 1;
            }

            coordinate = this._coordinates[position];
            var delta = (this.settings.rtl) ? (this._coordinates[0] + this._coordinates[this._coordinates.length - 1]) : 0;
            coordinate += (this.width() - coordinate + (this._coordinates[newPosition] || delta)) / 2 * multiplier;
        } else {
            coordinate = this._coordinates[newPosition] || 0;
        }

        coordinate = Math.ceil(coordinate);

        return coordinate;
    };

    /**
     * Calculates the speed for a translation.
     * @protected
     * @param {Number} from - The absolute position of the start item.
     * @param {Number} to - The absolute position of the target item.
     * @param {Number} [factor=undefined] - The time factor in milliseconds.
     * @returns {Number} - The time in milliseconds for the translation.
     */
    Owl.prototype.duration = function(from, to, factor) {
        if (factor === 0) {
            return 0;
        }

        return Math.min(Math.max(Math.abs(to - from), 1), 6) * Math.abs((factor || this.settings.smartSpeed));
    };

    /**
     * Slides to the specified item.
     * @public
     * @param {Number} position - The position of the item.
     * @param {Number} [speed] - The time in milliseconds for the transition.
     */
    Owl.prototype.to = function(position, speed) {
        var current = this.current(),
            revert = null,
            distance = position - this.relative(current),
            direction = (distance > 0) - (distance < 0),
            items = this._items.length,
            minimum = this.minimum(),
            maximum = this.maximum();

        if (this.settings.loop) {
            if (!this.settings.rewind && Math.abs(distance) > items / 2) {
                distance += direction * -1 * items;
            }

            position = current + distance;
            revert = ((position - minimum) % items + items) % items + minimum;

            if (revert !== position && revert - distance <= maximum && revert - distance > 0) {
                current = revert - distance;
                position = revert;
                this.reset(current);
            }
        } else if (this.settings.rewind) {
            maximum += 1;
            position = (position % maximum + maximum) % maximum;
        } else {
            position = Math.max(minimum, Math.min(maximum, position));
        }

        this.speed(this.duration(current, position, speed));
        this.current(position);

        if (this.$element.is(':visible')) {
            this.update();
        }
    };

    /**
     * Slides to the next item.
     * @public
     * @param {Number} [speed] - The time in milliseconds for the transition.
     */
    Owl.prototype.next = function(speed) {
        speed = speed || false;
        this.to(this.relative(this.current()) + 1, speed);
    };

    /**
     * Slides to the previous item.
     * @public
     * @param {Number} [speed] - The time in milliseconds for the transition.
     */
    Owl.prototype.prev = function(speed) {
        speed = speed || false;
        this.to(this.relative(this.current()) - 1, speed);
    };

    /**
     * Handles the end of an animation.
     * @protected
     * @param {Event} event - The event arguments.
     */
    Owl.prototype.onTransitionEnd = function(event) {

        // if css2 animation then event object is undefined
        if (event !== undefined) {
            event.stopPropagation();

            // Catch only owl-stage transitionEnd event
            if ((event.target || event.srcElement || event.originalTarget) !== this.$stage.get(0)) {
                return false;
            }
        }

        this.leave('animating');
        this.trigger('translated');
    };

    /**
     * Gets viewport width.
     * @protected
     * @return {Number} - The width in pixel.
     */
    Owl.prototype.viewport = function() {
        var width;
        if (this.options.responsiveBaseElement !== window) {
            width = $(this.options.responsiveBaseElement).width();
        } else if (window.innerWidth) {
            width = window.innerWidth;
        } else if (document.documentElement && document.documentElement.clientWidth) {
            width = document.documentElement.clientWidth;
        } else {
            throw 'Can not detect viewport width.';
        }
        return width;
    };

    /**
     * Replaces the current content.
     * @public
     * @param {HTMLElement|jQuery|String} content - The new content.
     */
    Owl.prototype.replace = function(content) {
        this.$stage.empty();
        this._items = [];

        if (content) {
            content = (content instanceof jQuery) ? content : $(content);
        }

        if (this.settings.nestedItemSelector) {
            content = content.find('.' + this.settings.nestedItemSelector);
        }

        content.filter(function() {
            return this.nodeType === 1;
        }).each($.proxy(function(index, item) {
            item = this.prepare(item);
            this.$stage.append(item);
            this._items.push(item);
            this._mergers.push(item.find('[data-merge]').addBack('[data-merge]').attr('data-merge') * 1 || 1);
        }, this));

        this.reset(this.isNumeric(this.settings.startPosition) ? this.settings.startPosition : 0);

        this.invalidate('items');
    };

    /**
     * Adds an item.
     * @todo Use `item` instead of `content` for the event arguments.
     * @public
     * @param {HTMLElement|jQuery|String} content - The item content to add.
     * @param {Number} [position] - The relative position at which to insert the item otherwise the item will be added to the end.
     */
    Owl.prototype.add = function(content, position) {
        var current = this.relative(this._current);

        position = position === undefined ? this._items.length : this.normalize(position, true);
        content = content instanceof jQuery ? content : $(content);

        this.trigger('add', { content: content, position: position });

        content = this.prepare(content);

        if (this._items.length === 0 || position === this._items.length) {
            this._items.length === 0 && this.$stage.append(content);
            this._items.length !== 0 && this._items[position - 1].after(content);
            this._items.push(content);
            this._mergers.push(content.find('[data-merge]').addBack('[data-merge]').attr('data-merge') * 1 || 1);
        } else {
            this._items[position].before(content);
            this._items.splice(position, 0, content);
            this._mergers.splice(position, 0, content.find('[data-merge]').addBack('[data-merge]').attr('data-merge') * 1 || 1);
        }

        this._items[current] && this.reset(this._items[current].index());

        this.invalidate('items');

        this.trigger('added', { content: content, position: position });
    };

    /**
     * Removes an item by its position.
     * @todo Use `item` instead of `content` for the event arguments.
     * @public
     * @param {Number} position - The relative position of the item to remove.
     */
    Owl.prototype.remove = function(position) {
        position = this.normalize(position, true);

        if (position === undefined) {
            return;
        }

        this.trigger('remove', { content: this._items[position], position: position });

        this._items[position].remove();
        this._items.splice(position, 1);
        this._mergers.splice(position, 1);

        this.invalidate('items');

        this.trigger('removed', { content: null, position: position });
    };

    /**
     * Preloads images with auto width.
     * @todo Replace by a more generic approach
     * @protected
     */
    Owl.prototype.preloadAutoWidthImages = function(images) {
        images.each($.proxy(function(i, element) {
            this.enter('pre-loading');
            element = $(element);
            $(new Image()).one('load', $.proxy(function(e) {
                element.attr('src', e.target.src);
                element.css('opacity', 1);
                this.leave('pre-loading');
                !this.is('pre-loading') && !this.is('initializing') && this.refresh();
            }, this)).attr('src', element.attr('src') || element.attr('data-src') || element.attr('data-src-retina'));
        }, this));
    };

    /**
     * Destroys the carousel.
     * @public
     */
    Owl.prototype.destroy = function() {

        this.$element.off('.owl.core');
        this.$stage.off('.owl.core');
        $(document).off('.owl.core');

        if (this.settings.responsive !== false) {
            window.clearTimeout(this.resizeTimer);
            this.off(window, 'resize', this._handlers.onThrottledResize);
        }

        for (var i in this._plugins) {
            this._plugins[i].destroy();
        }

        this.$stage.children('.cloned').remove();

        this.$stage.unwrap();
        this.$stage.children().contents().unwrap();
        this.$stage.children().unwrap();

        this.$element
            .removeClass(this.options.refreshClass)
            .removeClass(this.options.loadingClass)
            .removeClass(this.options.loadedClass)
            .removeClass(this.options.rtlClass)
            .removeClass(this.options.dragClass)
            .removeClass(this.options.grabClass)
            .attr('class', this.$element.attr('class').replace(new RegExp(this.options.responsiveClass + '-\\S+\\s', 'g'), ''))
            .removeData('owl.carousel');
    };

    /**
     * Operators to calculate right-to-left and left-to-right.
     * @protected
     * @param {Number} [a] - The left side operand.
     * @param {String} [o] - The operator.
     * @param {Number} [b] - The right side operand.
     */
    Owl.prototype.op = function(a, o, b) {
        var rtl = this.settings.rtl;
        switch (o) {
            case '<':
                return rtl ? a > b : a < b;
            case '>':
                return rtl ? a < b : a > b;
            case '>=':
                return rtl ? a <= b : a >= b;
            case '<=':
                return rtl ? a >= b : a <= b;
            default:
                break;
        }
    };

    /**
     * Attaches to an internal event.
     * @protected
     * @param {HTMLElement} element - The event source.
     * @param {String} event - The event name.
     * @param {Function} listener - The event handler to attach.
     * @param {Boolean} capture - Wether the event should be handled at the capturing phase or not.
     */
    Owl.prototype.on = function(element, event, listener, capture) {
        if (element.addEventListener) {
            element.addEventListener(event, listener, capture);
        } else if (element.attachEvent) {
            element.attachEvent('on' + event, listener);
        }
    };

    /**
     * Detaches from an internal event.
     * @protected
     * @param {HTMLElement} element - The event source.
     * @param {String} event - The event name.
     * @param {Function} listener - The attached event handler to detach.
     * @param {Boolean} capture - Wether the attached event handler was registered as a capturing listener or not.
     */
    Owl.prototype.off = function(element, event, listener, capture) {
        if (element.removeEventListener) {
            element.removeEventListener(event, listener, capture);
        } else if (element.detachEvent) {
            element.detachEvent('on' + event, listener);
        }
    };

    /**
     * Triggers a public event.
     * @todo Remove `status`, `relatedTarget` should be used instead.
     * @protected
     * @param {String} name - The event name.
     * @param {*} [data=null] - The event data.
     * @param {String} [namespace=carousel] - The event namespace.
     * @param {String} [state] - The state which is associated with the event.
     * @param {Boolean} [enter=false] - Indicates if the call enters the specified state or not.
     * @returns {Event} - The event arguments.
     */
    Owl.prototype.trigger = function(name, data, namespace, state, enter) {
        var status = {
            item: { count: this._items.length, index: this.current() }
        }, handler = $.camelCase(
            $.grep([ 'on', name, namespace ], function(v) { return v })
                .join('-').toLowerCase()
        ), event = $.Event(
            [ name, 'owl', namespace || 'carousel' ].join('.').toLowerCase(),
            $.extend({ relatedTarget: this }, status, data)
        );

        if (!this._supress[name]) {
            $.each(this._plugins, function(name, plugin) {
                if (plugin.onTrigger) {
                    plugin.onTrigger(event);
                }
            });

            this.register({ type: Owl.Type.Event, name: name });
            this.$element.trigger(event);

            if (this.settings && typeof this.settings[handler] === 'function') {
                this.settings[handler].call(this, event);
            }
        }

        return event;
    };

    /**
     * Enters a state.
     * @param name - The state name.
     */
    Owl.prototype.enter = function(name) {
        $.each([ name ].concat(this._states.tags[name] || []), $.proxy(function(i, name) {
            if (this._states.current[name] === undefined) {
                this._states.current[name] = 0;
            }

            this._states.current[name]++;
        }, this));
    };

    /**
     * Leaves a state.
     * @param name - The state name.
     */
    Owl.prototype.leave = function(name) {
        $.each([ name ].concat(this._states.tags[name] || []), $.proxy(function(i, name) {
            this._states.current[name]--;
        }, this));
    };

    /**
     * Registers an event or state.
     * @public
     * @param {Object} object - The event or state to register.
     */
    Owl.prototype.register = function(object) {
        if (object.type === Owl.Type.Event) {
            if (!$.event.special[object.name]) {
                $.event.special[object.name] = {};
            }

            if (!$.event.special[object.name].owl) {
                var _default = $.event.special[object.name]._default;
                $.event.special[object.name]._default = function(e) {
                    if (_default && _default.apply && (!e.namespace || e.namespace.indexOf('owl') === -1)) {
                        return _default.apply(this, arguments);
                    }
                    return e.namespace && e.namespace.indexOf('owl') > -1;
                };
                $.event.special[object.name].owl = true;
            }
        } else if (object.type === Owl.Type.State) {
            if (!this._states.tags[object.name]) {
                this._states.tags[object.name] = object.tags;
            } else {
                this._states.tags[object.name] = this._states.tags[object.name].concat(object.tags);
            }

            this._states.tags[object.name] = $.grep(this._states.tags[object.name], $.proxy(function(tag, i) {
                return $.inArray(tag, this._states.tags[object.name]) === i;
            }, this));
        }
    };

    /**
     * Suppresses events.
     * @protected
     * @param {Array.<String>} events - The events to suppress.
     */
    Owl.prototype.suppress = function(events) {
        $.each(events, $.proxy(function(index, event) {
            this._supress[event] = true;
        }, this));
    };

    /**
     * Releases suppressed events.
     * @protected
     * @param {Array.<String>} events - The events to release.
     */
    Owl.prototype.release = function(events) {
        $.each(events, $.proxy(function(index, event) {
            delete this._supress[event];
        }, this));
    };

    /**
     * Gets unified pointer coordinates from event.
     * @todo #261
     * @protected
     * @param {Event} - The `mousedown` or `touchstart` event.
     * @returns {Object} - Contains `x` and `y` coordinates of current pointer position.
     */
    Owl.prototype.pointer = function(event) {
        var result = { x: null, y: null };

        event = event.originalEvent || event || window.event;

        event = event.touches && event.touches.length ?
            event.touches[0] : event.changedTouches && event.changedTouches.length ?
                event.changedTouches[0] : event;

        if (event.pageX) {
            result.x = event.pageX;
            result.y = event.pageY;
        } else {
            result.x = event.clientX;
            result.y = event.clientY;
        }

        return result;
    };

    /**
     * Determines if the input is a Number or something that can be coerced to a Number
     * @protected
     * @param {Number|String|Object|Array|Boolean|RegExp|Function|Symbol} - The input to be tested
     * @returns {Boolean} - An indication if the input is a Number or can be coerced to a Number
     */
    Owl.prototype.isNumeric = function(number) {
        return !isNaN(parseFloat(number));
    };

    /**
     * Gets the difference of two vectors.
     * @todo #261
     * @protected
     * @param {Object} - The first vector.
     * @param {Object} - The second vector.
     * @returns {Object} - The difference.
     */
    Owl.prototype.difference = function(first, second) {
        return {
            x: first.x - second.x,
            y: first.y - second.y
        };
    };

    /**
     * The jQuery Plugin for the Owl Carousel
     * @todo Navigation plugin `next` and `prev`
     * @public
     */
    $.fn.owlCarousel = function(option) {
        var args = Array.prototype.slice.call(arguments, 1);

        return this.each(function() {
            var $this = $(this),
                data = $this.data('owl.carousel');

            if (!data) {
                data = new Owl(this, typeof option == 'object' && option);
                $this.data('owl.carousel', data);

                $.each([
                    'next', 'prev', 'to', 'destroy', 'refresh', 'replace', 'add', 'remove'
                ], function(i, event) {
                    data.register({ type: Owl.Type.Event, name: event });
                    data.$element.on(event + '.owl.carousel.core', $.proxy(function(e) {
                        if (e.namespace && e.relatedTarget !== this) {
                            this.suppress([ event ]);
                            data[event].apply(this, [].slice.call(arguments, 1));
                            this.release([ event ]);
                        }
                    }, data));
                });
            }

            if (typeof option == 'string' && option.charAt(0) !== '_') {
                data[option].apply(data, args);
            }
        });
    };

    /**
     * The constructor for the jQuery Plugin
     * @public
     */
    $.fn.owlCarousel.Constructor = Owl;

})(window.Zepto || window.jQuery, window, document);

/**
 * AutoRefresh Plugin
 * @version 2.1.0
 * @author Artus Kolanowski
 * @author David Deutsch
 * @license The MIT License (MIT)
 */
;(function($, window, document, undefined) {

    /**
     * Creates the auto refresh plugin.
     * @class The Auto Refresh Plugin
     * @param {Owl} carousel - The Owl Carousel
     */
    var AutoRefresh = function(carousel) {
        /**
         * Reference to the core.
         * @protected
         * @type {Owl}
         */
        this._core = carousel;

        /**
         * Refresh interval.
         * @protected
         * @type {number}
         */
        this._interval = null;

        /**
         * Whether the element is currently visible or not.
         * @protected
         * @type {Boolean}
         */
        this._visible = null;

        /**
         * All event handlers.
         * @protected
         * @type {Object}
         */
        this._handlers = {
            'initialized.owl.carousel': $.proxy(function(e) {
                if (e.namespace && this._core.settings.autoRefresh) {
                    this.watch();
                }
            }, this)
        };

        // set default options
        this._core.options = $.extend({}, AutoRefresh.Defaults, this._core.options);

        // register event handlers
        this._core.$element.on(this._handlers);
    };

    /**
     * Default options.
     * @public
     */
    AutoRefresh.Defaults = {
        autoRefresh: true,
        autoRefreshInterval: 500
    };

    /**
     * Watches the element.
     */
    AutoRefresh.prototype.watch = function() {
        if (this._interval) {
            return;
        }

        this._visible = this._core.$element.is(':visible');
        this._interval = window.setInterval($.proxy(this.refresh, this), this._core.settings.autoRefreshInterval);
    };

    /**
     * Refreshes the element.
     */
    AutoRefresh.prototype.refresh = function() {
        if (this._core.$element.is(':visible') === this._visible) {
            return;
        }

        this._visible = !this._visible;

        this._core.$element.toggleClass('owl-hidden', !this._visible);

        this._visible && (this._core.invalidate('width') && this._core.refresh());
    };

    /**
     * Destroys the plugin.
     */
    AutoRefresh.prototype.destroy = function() {
        var handler, property;

        window.clearInterval(this._interval);

        for (handler in this._handlers) {
            this._core.$element.off(handler, this._handlers[handler]);
        }
        for (property in Object.getOwnPropertyNames(this)) {
            typeof this[property] != 'function' && (this[property] = null);
        }
    };

    $.fn.owlCarousel.Constructor.Plugins.AutoRefresh = AutoRefresh;

})(window.Zepto || window.jQuery, window, document);

/**
 * Lazy Plugin
 * @version 2.1.0
 * @author Bartosz Wojciechowski
 * @author David Deutsch
 * @license The MIT License (MIT)
 */
;(function($, window, document, undefined) {

    /**
     * Creates the lazy plugin.
     * @class The Lazy Plugin
     * @param {Owl} carousel - The Owl Carousel
     */
    var Lazy = function(carousel) {

        /**
         * Reference to the core.
         * @protected
         * @type {Owl}
         */
        this._core = carousel;

        /**
         * Already loaded items.
         * @protected
         * @type {Array.<jQuery>}
         */
        this._loaded = [];

        /**
         * Event handlers.
         * @protected
         * @type {Object}
         */
        this._handlers = {
            'initialized.owl.carousel change.owl.carousel resized.owl.carousel': $.proxy(function(e) {
                if (!e.namespace) {
                    return;
                }

                if (!this._core.settings || !this._core.settings.lazyLoad) {
                    return;
                }

                if ((e.property && e.property.name == 'position') || e.type == 'initialized') {
                    var settings = this._core.settings,
                        n = (settings.center && Math.ceil(settings.items / 2) || settings.items),
                        i = ((settings.center && n * -1) || 0),
                        position = (e.property && e.property.value !== undefined ? e.property.value : this._core.current()) + i,
                        clones = this._core.clones().length,
                        load = $.proxy(function(i, v) { this.load(v) }, this);

                    while (i++ < n) {
                        this.load(clones / 2 + this._core.relative(position));
                        clones && $.each(this._core.clones(this._core.relative(position)), load);
                        position++;
                    }
                }
            }, this)
        };

        // set the default options
        this._core.options = $.extend({}, Lazy.Defaults, this._core.options);

        // register event handler
        this._core.$element.on(this._handlers);
    };

    /**
     * Default options.
     * @public
     */
    Lazy.Defaults = {
        lazyLoad: false
    };

    /**
     * Loads all resources of an item at the specified position.
     * @param {Number} position - The absolute position of the item.
     * @protected
     */
    Lazy.prototype.load = function(position) {
        var $item = this._core.$stage.children().eq(position),
            $elements = $item && $item.find('.owl-lazy');

        if (!$elements || $.inArray($item.get(0), this._loaded) > -1) {
            return;
        }

        $elements.each($.proxy(function(index, element) {
            var $element = $(element), image,
                url = (window.devicePixelRatio > 1 && $element.attr('data-src-retina')) || $element.attr('data-src');

            this._core.trigger('load', { element: $element, url: url }, 'lazy');

            if ($element.is('img')) {
                $element.one('load.owl.lazy', $.proxy(function() {
                    $element.css('opacity', 1);
                    this._core.trigger('loaded', { element: $element, url: url }, 'lazy');
                }, this)).attr('src', url);
            } else {
                image = new Image();
                image.onload = $.proxy(function() {
                    $element.css({
                        'background-image': 'url(' + url + ')',
                        'opacity': '1'
                    });
                    this._core.trigger('loaded', { element: $element, url: url }, 'lazy');
                }, this);
                image.src = url;
            }
        }, this));

        this._loaded.push($item.get(0));
    };

    /**
     * Destroys the plugin.
     * @public
     */
    Lazy.prototype.destroy = function() {
        var handler, property;

        for (handler in this.handlers) {
            this._core.$element.off(handler, this.handlers[handler]);
        }
        for (property in Object.getOwnPropertyNames(this)) {
            typeof this[property] != 'function' && (this[property] = null);
        }
    };

    $.fn.owlCarousel.Constructor.Plugins.Lazy = Lazy;

})(window.Zepto || window.jQuery, window, document);

/**
 * AutoHeight Plugin
 * @version 2.1.0
 * @author Bartosz Wojciechowski
 * @author David Deutsch
 * @license The MIT License (MIT)
 */
;(function($, window, document, undefined) {

    /**
     * Creates the auto height plugin.
     * @class The Auto Height Plugin
     * @param {Owl} carousel - The Owl Carousel
     */
    var AutoHeight = function(carousel) {
        /**
         * Reference to the core.
         * @protected
         * @type {Owl}
         */
        this._core = carousel;

        /**
         * All event handlers.
         * @protected
         * @type {Object}
         */
        this._handlers = {
            'initialized.owl.carousel refreshed.owl.carousel': $.proxy(function(e) {
                if (e.namespace && this._core.settings.autoHeight) {
                    this.update();
                }
            }, this),
            'changed.owl.carousel': $.proxy(function(e) {
                if (e.namespace && this._core.settings.autoHeight && e.property.name == 'position'){
                    this.update();
                }
            }, this),
            'loaded.owl.lazy': $.proxy(function(e) {
                if (e.namespace && this._core.settings.autoHeight
                    && e.element.closest('.' + this._core.settings.itemClass).index() === this._core.current()) {
                    this.update();
                }
            }, this)
        };

        // set default options
        this._core.options = $.extend({}, AutoHeight.Defaults, this._core.options);

        // register event handlers
        this._core.$element.on(this._handlers);
    };

    /**
     * Default options.
     * @public
     */
    AutoHeight.Defaults = {
        autoHeight: false,
        autoHeightClass: 'owl-height'
    };

    /**
     * Updates the view.
     */
    AutoHeight.prototype.update = function() {
        var start = this._core._current,
            end = start + this._core.settings.items,
            visible = this._core.$stage.children().toArray().slice(start, end),
            heights = [],
            maxheight = 0;

        $.each(visible, function(index, item) {
            heights.push($(item).height());
        });

        maxheight = Math.max.apply(null, heights);

        this._core.$stage.parent()
            .height(maxheight)
            .addClass(this._core.settings.autoHeightClass);
    };

    AutoHeight.prototype.destroy = function() {
        var handler, property;

        for (handler in this._handlers) {
            this._core.$element.off(handler, this._handlers[handler]);
        }
        for (property in Object.getOwnPropertyNames(this)) {
            typeof this[property] != 'function' && (this[property] = null);
        }
    };

    $.fn.owlCarousel.Constructor.Plugins.AutoHeight = AutoHeight;

})(window.Zepto || window.jQuery, window, document);

/**
 * Video Plugin
 * @version 2.1.0
 * @author Bartosz Wojciechowski
 * @author David Deutsch
 * @license The MIT License (MIT)
 */
;(function($, window, document, undefined) {

    /**
     * Creates the video plugin.
     * @class The Video Plugin
     * @param {Owl} carousel - The Owl Carousel
     */
    var Video = function(carousel) {
        /**
         * Reference to the core.
         * @protected
         * @type {Owl}
         */
        this._core = carousel;

        /**
         * Cache all video URLs.
         * @protected
         * @type {Object}
         */
        this._videos = {};

        /**
         * Current playing item.
         * @protected
         * @type {jQuery}
         */
        this._playing = null;

        /**
         * All event handlers.
         * @todo The cloned content removale is too late
         * @protected
         * @type {Object}
         */
        this._handlers = {
            'initialized.owl.carousel': $.proxy(function(e) {
                if (e.namespace) {
                    this._core.register({ type: 'state', name: 'playing', tags: [ 'interacting' ] });
                }
            }, this),
            'resize.owl.carousel': $.proxy(function(e) {
                if (e.namespace && this._core.settings.video && this.isInFullScreen()) {
                    e.preventDefault();
                }
            }, this),
            'refreshed.owl.carousel': $.proxy(function(e) {
                if (e.namespace && this._core.is('resizing')) {
                    this._core.$stage.find('.cloned .owl-video-frame').remove();
                }
            }, this),
            'changed.owl.carousel': $.proxy(function(e) {
                if (e.namespace && e.property.name === 'position' && this._playing) {
                    this.stop();
                }
            }, this),
            'prepared.owl.carousel': $.proxy(function(e) {
                if (!e.namespace) {
                    return;
                }

                var $element = $(e.content).find('.owl-video');

                if ($element.length) {
                    $element.css('display', 'none');
                    this.fetch($element, $(e.content));
                }
            }, this)
        };

        // set default options
        this._core.options = $.extend({}, Video.Defaults, this._core.options);

        // register event handlers
        this._core.$element.on(this._handlers);

        this._core.$element.on('click.owl.video', '.owl-video-play-icon', $.proxy(function(e) {
            this.play(e);
        }, this));
    };

    /**
     * Default options.
     * @public
     */
    Video.Defaults = {
        video: false,
        videoHeight: false,
        videoWidth: false
    };

    /**
     * Gets the video ID and the type (YouTube/Vimeo/vzaar only).
     * @protected
     * @param {jQuery} target - The target containing the video data.
     * @param {jQuery} item - The item containing the video.
     */
    Video.prototype.fetch = function(target, item) {
        var type = (function() {
                if (target.attr('data-vimeo-id')) {
                    return 'vimeo';
                } else if (target.attr('data-vzaar-id')) {
                    return 'vzaar'
                } else {
                    return 'youtube';
                }
            })(),
            id = target.attr('data-vimeo-id') || target.attr('data-youtube-id') || target.attr('data-vzaar-id'),
            width = target.attr('data-width') || this._core.settings.videoWidth,
            height = target.attr('data-height') || this._core.settings.videoHeight,
            url = target.attr('href');

        if (url) {

            /*
             Parses the id's out of the following urls (and probably more):
             https://www.youtube.com/watch?v=:id
             https://youtu.be/:id
             https://vimeo.com/:id
             https://vimeo.com/channels/:channel/:id
             https://vimeo.com/groups/:group/videos/:id
             https://app.vzaar.com/videos/:id

             Visual example: https://regexper.com/#(http%3A%7Chttps%3A%7C)%5C%2F%5C%2F(player.%7Cwww.%7Capp.)%3F(vimeo%5C.com%7Cyoutu(be%5C.com%7C%5C.be%7Cbe%5C.googleapis%5C.com)%7Cvzaar%5C.com)%5C%2F(video%5C%2F%7Cvideos%5C%2F%7Cembed%5C%2F%7Cchannels%5C%2F.%2B%5C%2F%7Cgroups%5C%2F.%2B%5C%2F%7Cwatch%5C%3Fv%3D%7Cv%5C%2F)%3F(%5BA-Za-z0-9._%25-%5D*)(%5C%26%5CS%2B)%3F
             */

            id = url.match(/(http:|https:|)\/\/(player.|www.|app.)?(vimeo\.com|youtu(be\.com|\.be|be\.googleapis\.com)|vzaar\.com)\/(video\/|videos\/|embed\/|channels\/.+\/|groups\/.+\/|watch\?v=|v\/)?([A-Za-z0-9._%-]*)(\&\S+)?/);

            if (id[3].indexOf('youtu') > -1) {
                type = 'youtube';
            } else if (id[3].indexOf('vimeo') > -1) {
                type = 'vimeo';
            } else if (id[3].indexOf('vzaar') > -1) {
                type = 'vzaar';
            } else {
                throw new Error('Video URL not supported.');
            }
            id = id[6];
        } else {
            throw new Error('Missing video URL.');
        }

        this._videos[url] = {
            type: type,
            id: id,
            width: width,
            height: height
        };

        item.attr('data-video', url);

        this.thumbnail(target, this._videos[url]);
    };

    /**
     * Creates video thumbnail.
     * @protected
     * @param {jQuery} target - The target containing the video data.
     * @param {Object} info - The video info object.
     * @see `fetch`
     */
    Video.prototype.thumbnail = function(target, video) {
        var tnLink,
            icon,
            path,
            dimensions = video.width && video.height ? 'style="width:' + video.width + 'px;height:' + video.height + 'px;"' : '',
            customTn = target.find('img'),
            srcType = 'src',
            lazyClass = '',
            settings = this._core.settings,
            create = function(path) {
                icon = '<div class="owl-video-play-icon"></div>';

                if (settings.lazyLoad) {
                    tnLink = '<div class="owl-video-tn ' + lazyClass + '" ' + srcType + '="' + path + '"></div>';
                } else {
                    tnLink = '<div class="owl-video-tn" style="opacity:1;background-image:url(' + path + ')"></div>';
                }
                target.after(tnLink);
                target.after(icon);
            };

        // wrap video content into owl-video-wrapper div
        target.wrap('<div class="owl-video-wrapper"' + dimensions + '></div>');

        if (this._core.settings.lazyLoad) {
            srcType = 'data-src';
            lazyClass = 'owl-lazy';
        }

        // custom thumbnail
        if (customTn.length) {
            create(customTn.attr(srcType));
            customTn.remove();
            return false;
        }

        if (video.type === 'youtube') {
            path = "//img.youtube.com/vi/" + video.id + "/hqdefault.jpg";
            create(path);
        } else if (video.type === 'vimeo') {
            $.ajax({
                type: 'GET',
                url: '//vimeo.com/api/v2/video/' + video.id + '.json',
                jsonp: 'callback',
                dataType: 'jsonp',
                success: function(data) {
                    path = data[0].thumbnail_large;
                    create(path);
                }
            });
        } else if (video.type === 'vzaar') {
            $.ajax({
                type: 'GET',
                url: '//vzaar.com/api/videos/' + video.id + '.json',
                jsonp: 'callback',
                dataType: 'jsonp',
                success: function(data) {
                    path = data.framegrab_url;
                    create(path);
                }
            });
        }
    };

    /**
     * Stops the current video.
     * @public
     */
    Video.prototype.stop = function() {
        this._core.trigger('stop', null, 'video');
        this._playing.find('.owl-video-frame').remove();
        this._playing.removeClass('owl-video-playing');
        this._playing = null;
        this._core.leave('playing');
        this._core.trigger('stopped', null, 'video');
    };

    /**
     * Starts the current video.
     * @public
     * @param {Event} event - The event arguments.
     */
    Video.prototype.play = function(event) {
        var target = $(event.target),
            item = target.closest('.' + this._core.settings.itemClass),
            video = this._videos[item.attr('data-video')],
            width = video.width || '100%',
            height = video.height || this._core.$stage.height(),
            html;

        if (this._playing) {
            return;
        }

        this._core.enter('playing');
        this._core.trigger('play', null, 'video');

        item = this._core.items(this._core.relative(item.index()));

        this._core.reset(item.index());

        if (video.type === 'youtube') {
            html = '<iframe width="' + width + '" height="' + height + '" src="//www.youtube.com/embed/' +
                video.id + '?autoplay=1&v=' + video.id + '" frameborder="0" allowfullscreen></iframe>';
        } else if (video.type === 'vimeo') {
            html = '<iframe src="//player.vimeo.com/video/' + video.id +
                '?autoplay=1" width="' + width + '" height="' + height +
                '" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
        } else if (video.type === 'vzaar') {
            html = '<iframe frameborder="0"' + 'height="' + height + '"' + 'width="' + width +
                '" allowfullscreen mozallowfullscreen webkitAllowFullScreen ' +
                'src="//view.vzaar.com/' + video.id + '/player?autoplay=true"></iframe>';
        }

        $('<div class="owl-video-frame">' + html + '</div>').insertAfter(item.find('.owl-video'));

        this._playing = item.addClass('owl-video-playing');
    };

    /**
     * Checks whether an video is currently in full screen mode or not.
     * @todo Bad style because looks like a readonly method but changes members.
     * @protected
     * @returns {Boolean}
     */
    Video.prototype.isInFullScreen = function() {
        var element = document.fullscreenElement || document.mozFullScreenElement ||
            document.webkitFullscreenElement;

        return element && $(element).parent().hasClass('owl-video-frame');
    };

    /**
     * Destroys the plugin.
     */
    Video.prototype.destroy = function() {
        var handler, property;

        this._core.$element.off('click.owl.video');

        for (handler in this._handlers) {
            this._core.$element.off(handler, this._handlers[handler]);
        }
        for (property in Object.getOwnPropertyNames(this)) {
            typeof this[property] != 'function' && (this[property] = null);
        }
    };

    $.fn.owlCarousel.Constructor.Plugins.Video = Video;

})(window.Zepto || window.jQuery, window, document);

/**
 * Animate Plugin
 * @version 2.1.0
 * @author Bartosz Wojciechowski
 * @author David Deutsch
 * @license The MIT License (MIT)
 */
;(function($, window, document, undefined) {

    /**
     * Creates the animate plugin.
     * @class The Navigation Plugin
     * @param {Owl} scope - The Owl Carousel
     */
    var Animate = function(scope) {
        this.core = scope;
        this.core.options = $.extend({}, Animate.Defaults, this.core.options);
        this.swapping = true;
        this.previous = undefined;
        this.next = undefined;

        this.handlers = {
            'change.owl.carousel': $.proxy(function(e) {
                if (e.namespace && e.property.name == 'position') {
                    this.previous = this.core.current();
                    this.next = e.property.value;
                }
            }, this),
            'drag.owl.carousel dragged.owl.carousel translated.owl.carousel': $.proxy(function(e) {
                if (e.namespace) {
                    this.swapping = e.type == 'translated';
                }
            }, this),
            'translate.owl.carousel': $.proxy(function(e) {
                if (e.namespace && this.swapping && (this.core.options.animateOut || this.core.options.animateIn)) {
                    this.swap();
                }
            }, this)
        };

        this.core.$element.on(this.handlers);
    };

    /**
     * Default options.
     * @public
     */
    Animate.Defaults = {
        animateOut: false,
        animateIn: false
    };

    /**
     * Toggles the animation classes whenever an translations starts.
     * @protected
     * @returns {Boolean|undefined}
     */
    Animate.prototype.swap = function() {

        if (this.core.settings.items !== 1) {
            return;
        }

        if (!$.support.animation || !$.support.transition) {
            return;
        }

        this.core.speed(0);

        var left,
            clear = $.proxy(this.clear, this),
            previous = this.core.$stage.children().eq(this.previous),
            next = this.core.$stage.children().eq(this.next),
            incoming = this.core.settings.animateIn,
            outgoing = this.core.settings.animateOut;

        if (this.core.current() === this.previous) {
            return;
        }

        if (outgoing) {
            left = this.core.coordinates(this.previous) - this.core.coordinates(this.next);
            previous.one($.support.animation.end, clear)
                .css( { 'left': left + 'px' } )
                .addClass('animated owl-animated-out')
                .addClass(outgoing);
        }

        if (incoming) {
            next.one($.support.animation.end, clear)
                .addClass('animated owl-animated-in')
                .addClass(incoming);
        }
    };

    Animate.prototype.clear = function(e) {
        $(e.target).css( { 'left': '' } )
            .removeClass('animated owl-animated-out owl-animated-in')
            .removeClass(this.core.settings.animateIn)
            .removeClass(this.core.settings.animateOut);
        this.core.onTransitionEnd();
    };

    /**
     * Destroys the plugin.
     * @public
     */
    Animate.prototype.destroy = function() {
        var handler, property;

        for (handler in this.handlers) {
            this.core.$element.off(handler, this.handlers[handler]);
        }
        for (property in Object.getOwnPropertyNames(this)) {
            typeof this[property] != 'function' && (this[property] = null);
        }
    };

    $.fn.owlCarousel.Constructor.Plugins.Animate = Animate;

})(window.Zepto || window.jQuery, window, document);

/**
 * Autoplay Plugin
 * @version 2.1.0
 * @author Bartosz Wojciechowski
 * @author Artus Kolanowski
 * @author David Deutsch
 * @license The MIT License (MIT)
 */
;(function($, window, document, undefined) {

    /**
     * Creates the autoplay plugin.
     * @class The Autoplay Plugin
     * @param {Owl} scope - The Owl Carousel
     */
    var Autoplay = function(carousel) {
        /**
         * Reference to the core.
         * @protected
         * @type {Owl}
         */
        this._core = carousel;

        /**
         * The autoplay timeout.
         * @type {Timeout}
         */
        this._timeout = null;

        /**
         * Indicates whenever the autoplay is paused.
         * @type {Boolean}
         */
        this._paused = false;

        /**
         * All event handlers.
         * @protected
         * @type {Object}
         */
        this._handlers = {
            'changed.owl.carousel': $.proxy(function(e) {
                if (e.namespace && e.property.name === 'settings') {
                    if (this._core.settings.autoplay) {
                        this.play();
                    } else {
                        this.stop();
                    }
                } else if (e.namespace && e.property.name === 'position') {
                    //console.log('play?', e);
                    if (this._core.settings.autoplay) {
                        this._setAutoPlayInterval();
                    }
                }
            }, this),
            'initialized.owl.carousel': $.proxy(function(e) {
                if (e.namespace && this._core.settings.autoplay) {
                    this.play();
                }
            }, this),
            'play.owl.autoplay': $.proxy(function(e, t, s) {
                if (e.namespace) {
                    this.play(t, s);
                }
            }, this),
            'stop.owl.autoplay': $.proxy(function(e) {
                if (e.namespace) {
                    this.stop();
                }
            }, this),
            'mouseover.owl.autoplay': $.proxy(function() {
                if (this._core.settings.autoplayHoverPause && this._core.is('rotating')) {
                    this.pause();
                }
            }, this),
            'mouseleave.owl.autoplay': $.proxy(function() {
                if (this._core.settings.autoplayHoverPause && this._core.is('rotating')) {
                    this.play();
                }
            }, this),
            'touchstart.owl.core': $.proxy(function() {
                if (this._core.settings.autoplayHoverPause && this._core.is('rotating')) {
                    this.pause();
                }
            }, this),
            'touchend.owl.core': $.proxy(function() {
                if (this._core.settings.autoplayHoverPause) {
                    this.play();
                }
            }, this)
        };

        // register event handlers
        this._core.$element.on(this._handlers);

        // set default options
        this._core.options = $.extend({}, Autoplay.Defaults, this._core.options);
    };

    /**
     * Default options.
     * @public
     */
    Autoplay.Defaults = {
        autoplay: false,
        autoplayTimeout: 5000,
        autoplayHoverPause: false,
        autoplaySpeed: false
    };

    /**
     * Starts the autoplay.
     * @public
     * @param {Number} [timeout] - The interval before the next animation starts.
     * @param {Number} [speed] - The animation speed for the animations.
     */
    Autoplay.prototype.play = function(timeout, speed) {
        this._paused = false;

        if (this._core.is('rotating')) {
            return;
        }

        this._core.enter('rotating');

        this._setAutoPlayInterval();
    };

    /**
     * Gets a new timeout
     * @private
     * @param {Number} [timeout] - The interval before the next animation starts.
     * @param {Number} [speed] - The animation speed for the animations.
     * @return {Timeout}
     */
    Autoplay.prototype._getNextTimeout = function(timeout, speed) {
        if ( this._timeout ) {
            window.clearTimeout(this._timeout);
        }
        return window.setTimeout($.proxy(function() {
            if (this._paused || this._core.is('busy') || this._core.is('interacting') || document.hidden) {
                return;
            }
            this._core.next(speed || this._core.settings.autoplaySpeed);
        }, this), timeout || this._core.settings.autoplayTimeout);
    };

    /**
     * Sets autoplay in motion.
     * @private
     */
    Autoplay.prototype._setAutoPlayInterval = function() {
        this._timeout = this._getNextTimeout();
    };

    /**
     * Stops the autoplay.
     * @public
     */
    Autoplay.prototype.stop = function() {
        if (!this._core.is('rotating')) {
            return;
        }

        window.clearTimeout(this._timeout);
        this._core.leave('rotating');
    };

    /**
     * Stops the autoplay.
     * @public
     */
    Autoplay.prototype.pause = function() {
        if (!this._core.is('rotating')) {
            return;
        }

        this._paused = true;
    };

    /**
     * Destroys the plugin.
     */
    Autoplay.prototype.destroy = function() {
        var handler, property;

        this.stop();

        for (handler in this._handlers) {
            this._core.$element.off(handler, this._handlers[handler]);
        }
        for (property in Object.getOwnPropertyNames(this)) {
            typeof this[property] != 'function' && (this[property] = null);
        }
    };

    $.fn.owlCarousel.Constructor.Plugins.autoplay = Autoplay;

})(window.Zepto || window.jQuery, window, document);

/**
 * Navigation Plugin
 * @version 2.1.0
 * @author Artus Kolanowski
 * @author David Deutsch
 * @license The MIT License (MIT)
 */
;(function($, window, document, undefined) {
    'use strict';

    /**
     * Creates the navigation plugin.
     * @class The Navigation Plugin
     * @param {Owl} carousel - The Owl Carousel.
     */
    var Navigation = function(carousel) {
        /**
         * Reference to the core.
         * @protected
         * @type {Owl}
         */
        this._core = carousel;

        /**
         * Indicates whether the plugin is initialized or not.
         * @protected
         * @type {Boolean}
         */
        this._initialized = false;

        /**
         * The current paging indexes.
         * @protected
         * @type {Array}
         */
        this._pages = [];

        /**
         * All DOM elements of the user interface.
         * @protected
         * @type {Object}
         */
        this._controls = {};

        /**
         * Markup for an indicator.
         * @protected
         * @type {Array.<String>}
         */
        this._templates = [];

        /**
         * The carousel element.
         * @type {jQuery}
         */
        this.$element = this._core.$element;

        /**
         * Overridden methods of the carousel.
         * @protected
         * @type {Object}
         */
        this._overrides = {
            next: this._core.next,
            prev: this._core.prev,
            to: this._core.to
        };

        /**
         * All event handlers.
         * @protected
         * @type {Object}
         */
        this._handlers = {
            'prepared.owl.carousel': $.proxy(function(e) {
                if (e.namespace && this._core.settings.dotsData) {
                    this._templates.push('<div class="' + this._core.settings.dotClass + '">' +
                        $(e.content).find('[data-dot]').addBack('[data-dot]').attr('data-dot') + '</div>');
                }
            }, this),
            'added.owl.carousel': $.proxy(function(e) {
                if (e.namespace && this._core.settings.dotsData) {
                    this._templates.splice(e.position, 0, this._templates.pop());
                }
            }, this),
            'remove.owl.carousel': $.proxy(function(e) {
                if (e.namespace && this._core.settings.dotsData) {
                    this._templates.splice(e.position, 1);
                }
            }, this),
            'changed.owl.carousel': $.proxy(function(e) {
                if (e.namespace && e.property.name == 'position') {
                    this.draw();
                }
            }, this),
            'initialized.owl.carousel': $.proxy(function(e) {
                if (e.namespace && !this._initialized) {
                    this._core.trigger('initialize', null, 'navigation');
                    this.initialize();
                    this.update();
                    this.draw();
                    this._initialized = true;
                    this._core.trigger('initialized', null, 'navigation');
                }
            }, this),
            'refreshed.owl.carousel': $.proxy(function(e) {
                if (e.namespace && this._initialized) {
                    this._core.trigger('refresh', null, 'navigation');
                    this.update();
                    this.draw();
                    this._core.trigger('refreshed', null, 'navigation');
                }
            }, this)
        };

        // set default options
        this._core.options = $.extend({}, Navigation.Defaults, this._core.options);

        // register event handlers
        this.$element.on(this._handlers);
    };

    /**
     * Default options.
     * @public
     * @todo Rename `slideBy` to `navBy`
     */
    Navigation.Defaults = {
        nav: false,
        navText: [ 'prev', 'next' ],
        navSpeed: false,
        navElement: 'div',
        navContainer: false,
        navContainerClass: 'owl-nav',
        navClass: [ 'owl-prev', 'owl-next' ],
        slideBy: 1,
        dotClass: 'owl-dot',
        dotsClass: 'owl-dots',
        dots: true,
        dotsEach: false,
        dotsData: false,
        dotsSpeed: false,
        dotsContainer: false
    };

    /**
     * Initializes the layout of the plugin and extends the carousel.
     * @protected
     */
    Navigation.prototype.initialize = function() {
        var override,
            settings = this._core.settings;

        // create DOM structure for relative navigation
        this._controls.$relative = (settings.navContainer ? $(settings.navContainer)
            : $('<div>').addClass(settings.navContainerClass).appendTo(this.$element)).addClass('disabled');

        this._controls.$previous = $('<' + settings.navElement + '>')
            .addClass(settings.navClass[0])
            .html(settings.navText[0])
            .prependTo(this._controls.$relative)
            .on('click', $.proxy(function(e) {
                this.prev(settings.navSpeed);
            }, this));
        this._controls.$next = $('<' + settings.navElement + '>')
            .addClass(settings.navClass[1])
            .html(settings.navText[1])
            .appendTo(this._controls.$relative)
            .on('click', $.proxy(function(e) {
                this.next(settings.navSpeed);
            }, this));

        // create DOM structure for absolute navigation
        if (!settings.dotsData) {
            this._templates = [ $('<div>')
                .addClass(settings.dotClass)
                .append($('<span>'))
                .prop('outerHTML') ];
        }

        this._controls.$absolute = (settings.dotsContainer ? $(settings.dotsContainer)
            : $('<div>').addClass(settings.dotsClass).appendTo(this.$element)).addClass('disabled');

        this._controls.$absolute.on('click', 'div', $.proxy(function(e) {
            var index = $(e.target).parent().is(this._controls.$absolute)
                ? $(e.target).index() : $(e.target).parent().index();

            e.preventDefault();

            this.to(index, settings.dotsSpeed);
        }, this));

        // override public methods of the carousel
        for (override in this._overrides) {
            this._core[override] = $.proxy(this[override], this);
        }
    };

    /**
     * Destroys the plugin.
     * @protected
     */
    Navigation.prototype.destroy = function() {
        var handler, control, property, override;

        for (handler in this._handlers) {
            this.$element.off(handler, this._handlers[handler]);
        }
        for (control in this._controls) {
            this._controls[control].remove();
        }
        for (override in this.overides) {
            this._core[override] = this._overrides[override];
        }
        for (property in Object.getOwnPropertyNames(this)) {
            typeof this[property] != 'function' && (this[property] = null);
        }
    };

    /**
     * Updates the internal state.
     * @protected
     */
    Navigation.prototype.update = function() {
        var i, j, k,
            lower = this._core.clones().length / 2,
            upper = lower + this._core.items().length,
            maximum = this._core.maximum(true),
            settings = this._core.settings,
            size = settings.center || settings.autoWidth || settings.dotsData
                ? 1 : settings.dotsEach || settings.items;

        if (settings.slideBy !== 'page') {
            settings.slideBy = Math.min(settings.slideBy, settings.items);
        }

        if (settings.dots || settings.slideBy == 'page') {
            this._pages = [];

            for (i = lower, j = 0, k = 0; i < upper; i++) {
                if (j >= size || j === 0) {
                    this._pages.push({
                        start: Math.min(maximum, i - lower),
                        end: i - lower + size - 1
                    });
                    if (Math.min(maximum, i - lower) === maximum) {
                        break;
                    }
                    j = 0, ++k;
                }
                j += this._core.mergers(this._core.relative(i));
            }
        }
    };

    /**
     * Draws the user interface.
     * @todo The option `dotsData` wont work.
     * @protected
     */
    Navigation.prototype.draw = function() {
        var difference,
            settings = this._core.settings,
            disabled = this._core.items().length <= settings.items,
            index = this._core.relative(this._core.current()),
            loop = settings.loop || settings.rewind;

        this._controls.$relative.toggleClass('disabled', !settings.nav || disabled);

        if (settings.nav) {
            this._controls.$previous.toggleClass('disabled', !loop && index <= this._core.minimum(true));
            this._controls.$next.toggleClass('disabled', !loop && index >= this._core.maximum(true));
        }

        this._controls.$absolute.toggleClass('disabled', !settings.dots || disabled);

        if (settings.dots) {
            difference = this._pages.length - this._controls.$absolute.children().length;

            if (settings.dotsData && difference !== 0) {
                this._controls.$absolute.html(this._templates.join(''));
            } else if (difference > 0) {
                this._controls.$absolute.append(new Array(difference + 1).join(this._templates[0]));
            } else if (difference < 0) {
                this._controls.$absolute.children().slice(difference).remove();
            }

            this._controls.$absolute.find('.active').removeClass('active');
            this._controls.$absolute.children().eq($.inArray(this.current(), this._pages)).addClass('active');
        }
    };

    /**
     * Extends event data.
     * @protected
     * @param {Event} event - The event object which gets thrown.
     */
    Navigation.prototype.onTrigger = function(event) {
        var settings = this._core.settings;

        event.page = {
            index: $.inArray(this.current(), this._pages),
            count: this._pages.length,
            size: settings && (settings.center || settings.autoWidth || settings.dotsData
                ? 1 : settings.dotsEach || settings.items)
        };
    };

    /**
     * Gets the current page position of the carousel.
     * @protected
     * @returns {Number}
     */
    Navigation.prototype.current = function() {
        var current = this._core.relative(this._core.current());
        return $.grep(this._pages, $.proxy(function(page, index) {
            return page.start <= current && page.end >= current;
        }, this)).pop();
    };

    /**
     * Gets the current succesor/predecessor position.
     * @protected
     * @returns {Number}
     */
    Navigation.prototype.getPosition = function(successor) {
        var position, length,
            settings = this._core.settings;

        if (settings.slideBy == 'page') {
            position = $.inArray(this.current(), this._pages);
            length = this._pages.length;
            successor ? ++position : --position;
            position = this._pages[((position % length) + length) % length].start;
        } else {
            position = this._core.relative(this._core.current());
            length = this._core.items().length;
            successor ? position += settings.slideBy : position -= settings.slideBy;
        }

        return position;
    };

    /**
     * Slides to the next item or page.
     * @public
     * @param {Number} [speed=false] - The time in milliseconds for the transition.
     */
    Navigation.prototype.next = function(speed) {
        $.proxy(this._overrides.to, this._core)(this.getPosition(true), speed);
    };

    /**
     * Slides to the previous item or page.
     * @public
     * @param {Number} [speed=false] - The time in milliseconds for the transition.
     */
    Navigation.prototype.prev = function(speed) {
        $.proxy(this._overrides.to, this._core)(this.getPosition(false), speed);
    };

    /**
     * Slides to the specified item or page.
     * @public
     * @param {Number} position - The position of the item or page.
     * @param {Number} [speed] - The time in milliseconds for the transition.
     * @param {Boolean} [standard=false] - Whether to use the standard behaviour or not.
     */
    Navigation.prototype.to = function(position, speed, standard) {
        var length;

        if (!standard && this._pages.length) {
            length = this._pages.length;
            $.proxy(this._overrides.to, this._core)(this._pages[((position % length) + length) % length].start, speed);
        } else {
            $.proxy(this._overrides.to, this._core)(position, speed);
        }
    };

    $.fn.owlCarousel.Constructor.Plugins.Navigation = Navigation;

})(window.Zepto || window.jQuery, window, document);

/**
 * Hash Plugin
 * @version 2.1.0
 * @author Artus Kolanowski
 * @author David Deutsch
 * @license The MIT License (MIT)
 */
;(function($, window, document, undefined) {
    'use strict';

    /**
     * Creates the hash plugin.
     * @class The Hash Plugin
     * @param {Owl} carousel - The Owl Carousel
     */
    var Hash = function(carousel) {
        /**
         * Reference to the core.
         * @protected
         * @type {Owl}
         */
        this._core = carousel;

        /**
         * Hash index for the items.
         * @protected
         * @type {Object}
         */
        this._hashes = {};

        /**
         * The carousel element.
         * @type {jQuery}
         */
        this.$element = this._core.$element;

        /**
         * All event handlers.
         * @protected
         * @type {Object}
         */
        this._handlers = {
            'initialized.owl.carousel': $.proxy(function(e) {
                if (e.namespace && this._core.settings.startPosition === 'URLHash') {
                    $(window).trigger('hashchange.owl.navigation');
                }
            }, this),
            'prepared.owl.carousel': $.proxy(function(e) {
                if (e.namespace) {
                    var hash = $(e.content).find('[data-hash]').addBack('[data-hash]').attr('data-hash');

                    if (!hash) {
                        return;
                    }

                    this._hashes[hash] = e.content;
                }
            }, this),
            'changed.owl.carousel': $.proxy(function(e) {
                if (e.namespace && e.property.name === 'position') {
                    var current = this._core.items(this._core.relative(this._core.current())),
                        hash = $.map(this._hashes, function(item, hash) {
                            return item === current ? hash : null;
                        }).join();

                    if (!hash || window.location.hash.slice(1) === hash) {
                        return;
                    }

                    window.location.hash = hash;
                }
            }, this)
        };

        // set default options
        this._core.options = $.extend({}, Hash.Defaults, this._core.options);

        // register the event handlers
        this.$element.on(this._handlers);

        // register event listener for hash navigation
        $(window).on('hashchange.owl.navigation', $.proxy(function(e) {
            var hash = window.location.hash.substring(1),
                items = this._core.$stage.children(),
                position = this._hashes[hash] && items.index(this._hashes[hash]);

            if (position === undefined || position === this._core.current()) {
                return;
            }

            this._core.to(this._core.relative(position), false, true);
        }, this));
    };

    /**
     * Default options.
     * @public
     */
    Hash.Defaults = {
        URLhashListener: false
    };

    /**
     * Destroys the plugin.
     * @public
     */
    Hash.prototype.destroy = function() {
        var handler, property;

        $(window).off('hashchange.owl.navigation');

        for (handler in this._handlers) {
            this._core.$element.off(handler, this._handlers[handler]);
        }
        for (property in Object.getOwnPropertyNames(this)) {
            typeof this[property] != 'function' && (this[property] = null);
        }
    };

    $.fn.owlCarousel.Constructor.Plugins.Hash = Hash;

})(window.Zepto || window.jQuery, window, document);

/**
 * Support Plugin
 *
 * @version 2.1.0
 * @author Vivid Planet Software GmbH
 * @author Artus Kolanowski
 * @author David Deutsch
 * @license The MIT License (MIT)
 */
;(function($, window, document, undefined) {

    var style = $('<support>').get(0).style,
        prefixes = 'Webkit Moz O ms'.split(' '),
        events = {
            transition: {
                end: {
                    WebkitTransition: 'webkitTransitionEnd',
                    MozTransition: 'transitionend',
                    OTransition: 'oTransitionEnd',
                    transition: 'transitionend'
                }
            },
            animation: {
                end: {
                    WebkitAnimation: 'webkitAnimationEnd',
                    MozAnimation: 'animationend',
                    OAnimation: 'oAnimationEnd',
                    animation: 'animationend'
                }
            }
        },
        tests = {
            csstransforms: function() {
                return !!test('transform');
            },
            csstransforms3d: function() {
                return !!test('perspective');
            },
            csstransitions: function() {
                return !!test('transition');
            },
            cssanimations: function() {
                return !!test('animation');
            }
        };

    function test(property, prefixed) {
        var result = false,
            upper = property.charAt(0).toUpperCase() + property.slice(1);

        $.each((property + ' ' + prefixes.join(upper + ' ') + upper).split(' '), function(i, property) {
            if (style[property] !== undefined) {
                result = prefixed ? property : true;
                return false;
            }
        });

        return result;
    }

    function prefixed(property) {
        return test(property, true);
    }

    if (tests.csstransitions()) {
        /* jshint -W053 */
        $.support.transition = new String(prefixed('transition'))
        $.support.transition.end = events.transition.end[ $.support.transition ];
    }

    if (tests.cssanimations()) {
        /* jshint -W053 */
        $.support.animation = new String(prefixed('animation'))
        $.support.animation.end = events.animation.end[ $.support.animation ];
    }

    if (tests.csstransforms()) {
        /* jshint -W053 */
        $.support.transform = new String(prefixed('transform'));
        $.support.transform3d = tests.csstransforms3d();
    }

})(window.Zepto || window.jQuery, window, document);

<!--FIM-2 owl.carousel.js  -->


! function(a, b) {
    "function" == typeof define && define.amd ? define(b) : "object" == typeof exports ? module.exports = b() : a.PhotoSwipe = b()
}(this, function() {
    "use strict";
    var a = function(a, b, c, d) {
        var e = {
            features: null,
            bind: function(a, b, c, d) {
                var e = (d ? "remove" : "add") + "EventListener";
                b = b.split(" ");
                for (var f = 0; f < b.length; f++) b[f] && a[e](b[f], c, !1);
            },
            isArray: function(a) {
                return a instanceof Array
            },
            createEl: function(a, b) {
                var c = document.createElement(b || "div");
                return a && (c.className = a), c
            },
            getScrollY: function() {
                var a = window.pageYOffset;
                return void 0 !== a ? a : document.documentElement.scrollTop
            },
            unbind: function(a, b, c) {
                e.bind(a, b, c, !0)
            },
            removeClass: function(a, b) {
                var c = new RegExp("(\\s|^)" + b + "(\\s|$)");
                a.className = a.className.replace(c, " ").replace(/^\s\s*/, "").replace(/\s\s*$/, "")
            },
            addClass: function(a, b) {
                e.hasClass(a, b) || (a.className += (a.className ? " " : "") + b)
            },
            hasClass: function(a, b) {
                return a.className && new RegExp("(^|\\s)" + b + "(\\s|$)").test(a.className)
            },
            getChildByClass: function(a, b) {
                for (var c = a.firstChild; c;) {
                    if (e.hasClass(c, b)) return c;
                    c = c.nextSibling
                }
            },
            arraySearch: function(a, b, c) {
                for (var d = a.length; d--;)
                    if (a[d][c] === b) return d;
                return -1
            },
            extend: function(a, b, c) {
                for (var d in b)
                    if (b.hasOwnProperty(d)) {
                        if (c && a.hasOwnProperty(d)) continue;
                        a[d] = b[d]
                    }
            },
            easing: {
                sine: {
                    out: function(a) {
                        return Math.sin(a * (Math.PI / 2))
                    },
                    inOut: function(a) {
                        return -(Math.cos(Math.PI * a) - 1) / 2
                    }
                },
                cubic: {
                    out: function(a) {
                        return --a * a * a + 1
                    }
                }
            },
            detectFeatures: function() {
                if (e.features) return e.features;
                var a = e.createEl(),
                    b = a.style,
                    c = "",
                    d = {};
                if (d.oldIE = document.all && !document.addEventListener, d.touch = "ontouchstart" in window, window.requestAnimationFrame && (d.raf = window.requestAnimationFrame, d.caf = window.cancelAnimationFrame), d.pointerEvent = navigator.pointerEnabled || navigator.msPointerEnabled, !d.pointerEvent) {
                    var f = navigator.userAgent;
                    if (/iP(hone|od)/.test(navigator.platform)) {
                        var g = navigator.appVersion.match(/OS (\d+)_(\d+)_?(\d+)?/);
                        g && g.length > 0 && (g = parseInt(g[1], 10), g >= 1 && 8 > g && (d.isOldIOSPhone = !0))
                    }
                    var h = f.match(/Android\s([0-9\.]*)/),
                        i = h ? h[1] : 0;
                    i = parseFloat(i), i >= 1 && (4.4 > i && (d.isOldAndroid = !0), d.androidVersion = i), d.isMobileOpera = /opera mini|opera mobi/i.test(f)
                }
                for (var j, k, l = ["transform", "perspective", "animationName"], m = ["", "webkit", "Moz", "ms", "O"], n = 0; 4 > n; n++) {
                    c = m[n];
                    for (var o = 0; 3 > o; o++) j = l[o], k = c + (c ? j.charAt(0).toUpperCase() + j.slice(1) : j), !d[j] && k in b && (d[j] = k);
                    c && !d.raf && (c = c.toLowerCase(), d.raf = window[c + "RequestAnimationFrame"], d.raf && (d.caf = window[c + "CancelAnimationFrame"] || window[c + "CancelRequestAnimationFrame"]))
                }
                if (!d.raf) {
                    var p = 0;
                    d.raf = function(a) {
                        var b = (new Date).getTime(),
                            c = Math.max(0, 16 - (b - p)),
                            d = window.setTimeout(function() {
                                a(b + c)
                            }, c);
                        return p = b + c, d
                    }, d.caf = function(a) {
                        clearTimeout(a)
                    }
                }
                return d.svg = !!document.createElementNS && !!document.createElementNS("http://www.w3.org/2000/svg", "svg").createSVGRect, e.features = d, d
            }
        };
        e.detectFeatures(), e.features.oldIE && (e.bind = function(a, b, c, d) {
            b = b.split(" ");
            for (var e, f = (d ? "detach" : "attach") + "Event", g = function() {
                c.handleEvent.call(c)
            }, h = 0; h < b.length; h++)
                if (e = b[h])
                    if ("object" == typeof c && c.handleEvent) {
                        if (d) {
                            if (!c["oldIE" + e]) return !1
                        } else c["oldIE" + e] = g;
                        a[f]("on" + e, c["oldIE" + e])
                    } else a[f]("on" + e, c)
        });
        var f = this,
            g = 25,
            h = 3,
            i = {
                allowPanToNext: !0,
                spacing: .12,
                bgOpacity: 1,
                mouseUsed: !1,
                loop: !0,
                pinchToClose: !0,
                closeOnScroll: !0,
                closeOnVerticalDrag: !0,
                verticalDragRange: .75,
                hideAnimationDuration: 333,
                showAnimationDuration: 333,
                showHideOpacity: !1,
                focus: !0,
                escKey: !0,
                arrowKeys: !0,
                mainScrollEndFriction: .35,
                panEndFriction: .35,
                isClickableElement: function(a) {
                    return "A" === a.tagName
                },
                getDoubleTapZoom: function(a, b) {
                    return a ? 1 : b.initialZoomLevel < .7 ? 1 : 1.33
                },
                maxSpreadZoom: 1.33,
                modal: !0,
                scaleMode: "fit"
            };
        e.extend(i, d);
        var j, k, l, m, n, o, p, q, r, s, t, u, v, w, x, y, z, A, B, C, D, E, F, G, H, I, J, K, L, M, N, O, P, Q, R, S, T, U, V, W, X, Y, Z, $, _, aa, ba, ca, da, ea, fa, ga, ha, ia, ja, ka, la = function() {
                return {
                    x: 0,
                    y: 0
                }
            },
            ma = la(),
            na = la(),
            oa = la(),
            pa = {},
            qa = 0,
            ra = {},
            sa = la(),
            ta = 0,
            ua = !0,
            va = [],
            wa = {},
            xa = !1,
            ya = function(a, b) {
                e.extend(f, b.publicMethods), va.push(a)
            },
            za = function(a) {
                var b = _b();
                return a > b - 1 ? a - b : 0 > a ? b + a : a
            },
            Aa = {},
            Ba = function(a, b) {
                return Aa[a] || (Aa[a] = []), Aa[a].push(b)
            },
            Ca = function(a) {
                var b = Aa[a];
                if (b) {
                    var c = Array.prototype.slice.call(arguments);
                    c.shift();
                    for (var d = 0; d < b.length; d++) b[d].apply(f, c)
                }
            },
            Da = function() {
                return (new Date).getTime()
            },
            Ea = function(a) {
                ia = a, f.bg.style.opacity = a * i.bgOpacity
            },
            Fa = function(a, b, c, d, e) {
                (!xa || e && e !== f.currItem) && (d /= e ? e.fitRatio : f.currItem.fitRatio), a[E] = u + b + "px, " + c + "px" + v + " scale(" + d + ")"
            },
            Ga = function(a) {
                da && (a && (s > f.currItem.fitRatio ? xa || (lc(f.currItem, !1, !0), xa = !0) : xa && (lc(f.currItem), xa = !1)), Fa(da, oa.x, oa.y, s))
            },
            Ha = function(a) {
                a.container && Fa(a.container.style, a.initialPosition.x, a.initialPosition.y, a.initialZoomLevel, a)
            },
            Ia = function(a, b) {
                b[E] = u + a + "px, 0px" + v
            },
            Ja = function(a, b) {
                if (!i.loop && b) {
                    var c = m + (sa.x * qa - a) / sa.x,
                        d = Math.round(a - sb.x);
                    (0 > c && d > 0 || c >= _b() - 1 && 0 > d) && (a = sb.x + d * i.mainScrollEndFriction)
                }
                sb.x = a, Ia(a, n)
            },
            Ka = function(a, b) {
                var c = tb[a] - ra[a];
                return na[a] + ma[a] + c - c * (b / t)
            },
            La = function(a, b) {
                a.x = b.x, a.y = b.y, b.id && (a.id = b.id)
            },
            Ma = function(a) {
                a.x = Math.round(a.x), a.y = Math.round(a.y)
            },
            Na = null,
            Oa = function() {
                Na && (e.unbind(document, "mousemove", Oa), e.addClass(a, "pswp--has_mouse"), i.mouseUsed = !0, Ca("mouseUsed")), Na = setTimeout(function() {
                    Na = null
                }, 100)
            },
            Pa = function() {
                e.bind(document, "keydown", f), N.transform && e.bind(f.scrollWrap, "click", f), i.mouseUsed || e.bind(document, "mousemove", Oa), e.bind(window, "resize scroll", f), Ca("bindEvents")
            },
            Qa = function() {
                e.unbind(window, "resize", f), e.unbind(window, "scroll", r.scroll), e.unbind(document, "keydown", f), e.unbind(document, "mousemove", Oa), N.transform && e.unbind(f.scrollWrap, "click", f), U && e.unbind(window, p, f), Ca("unbindEvents")
            },
            Ra = function(a, b) {
                var c = hc(f.currItem, pa, a);
                return b && (ca = c), c
            },
            Sa = function(a) {
                return a || (a = f.currItem), a.initialZoomLevel
            },
            Ta = function(a) {
                return a || (a = f.currItem), a.w > 0 ? i.maxSpreadZoom : 1
            },
            Ua = function(a, b, c, d) {
                return d === f.currItem.initialZoomLevel ? (c[a] = f.currItem.initialPosition[a], !0) : (c[a] = Ka(a, d), c[a] > b.min[a] ? (c[a] = b.min[a], !0) : c[a] < b.max[a] ? (c[a] = b.max[a], !0) : !1)
            },
            Va = function() {
                if (E) {
                    var b = N.perspective && !G;
                    return u = "translate" + (b ? "3d(" : "("), void(v = N.perspective ? ", 0px)" : ")")
                }
                E = "left", e.addClass(a, "pswp--ie"), Ia = function(a, b) {
                    b.left = a + "px"
                }, Ha = function(a) {
                    var b = a.fitRatio > 1 ? 1 : a.fitRatio,
                        c = a.container.style,
                        d = b * a.w,
                        e = b * a.h;
                    c.width = d + "px", c.height = e + "px", c.left = a.initialPosition.x + "px", c.top = a.initialPosition.y + "px"
                }, Ga = function() {
                    if (da) {
                        var a = da,
                            b = f.currItem,
                            c = b.fitRatio > 1 ? 1 : b.fitRatio,
                            d = c * b.w,
                            e = c * b.h;
                        a.width = d + "px", a.height = e + "px", a.left = oa.x + "px", a.top = oa.y + "px"
                    }
                }
            },
            Wa = function(a) {
                var b = "";
                i.escKey && 27 === a.keyCode ? b = "close" : i.arrowKeys && (37 === a.keyCode ? b = "prev" : 39 === a.keyCode && (b = "next")), b && (a.ctrlKey || a.altKey || a.shiftKey || a.metaKey || (a.preventDefault ? a.preventDefault() : a.returnValue = !1, f[b]()))
            },
            Xa = function(a) {
                a && (X || W || ea || S) && (a.preventDefault(), a.stopPropagation())
            },
            Ya = function() {
                f.setScrollOffset(0, e.getScrollY())
            },
            Za = {},
            $a = 0,
            _a = function(a) {
                Za[a] && (Za[a].raf && I(Za[a].raf), $a--, delete Za[a])
            },
            ab = function(a) {
                Za[a] && _a(a), Za[a] || ($a++, Za[a] = {})
            },
            bb = function() {
                for (var a in Za) Za.hasOwnProperty(a) && _a(a)
            },
            cb = function(a, b, c, d, e, f, g) {
                var h, i = Da();
                ab(a);
                var j = function() {
                    if (Za[a]) {
                        if (h = Da() - i, h >= d) return _a(a), f(c), void(g && g());
                        f((c - b) * e(h / d) + b), Za[a].raf = H(j)
                    }
                };
                j()
            },
            db = {
                shout: Ca,
                listen: Ba,
                viewportSize: pa,
                options: i,
                isMainScrollAnimating: function() {
                    return ea
                },
                getZoomLevel: function() {
                    return s
                },
                getCurrentIndex: function() {
                    return m
                },
                isDragging: function() {
                    return U
                },
                isZooming: function() {
                    return _
                },
                setScrollOffset: function(a, b) {
                    ra.x = a, M = ra.y = b, Ca("updateScrollOffset", ra)
                },
                applyZoomPan: function(a, b, c, d) {
                    oa.x = b, oa.y = c, s = a, Ga(d)
                },
                init: function() {
                    if (!j && !k) {
                        var c;
                        f.framework = e, f.template = a, f.bg = e.getChildByClass(a, "pswp__bg"), J = a.className, j = !0, N = e.detectFeatures(), H = N.raf, I = N.caf, E = N.transform, L = N.oldIE, f.scrollWrap = e.getChildByClass(a, "pswp__scroll-wrap"), f.container = e.getChildByClass(f.scrollWrap, "pswp__container"), n = f.container.style, f.itemHolders = y = [{
                            el: f.container.children[0],
                            wrap: 0,
                            index: -1
                        }, {
                            el: f.container.children[1],
                            wrap: 0,
                            index: -1
                        }, {
                            el: f.container.children[2],
                            wrap: 0,
                            index: -1
                        }], y[0].el.style.display = y[2].el.style.display = "none", Va(), r = {
                            resize: f.updateSize,
                            scroll: Ya,
                            keydown: Wa,
                            click: Xa
                        };
                        var d = N.isOldIOSPhone || N.isOldAndroid || N.isMobileOpera;
                        for (N.animationName && N.transform && !d || (i.showAnimationDuration = i.hideAnimationDuration = 0), c = 0; c < va.length; c++) f["init" + va[c]]();
                        if (b) {
                            var g = f.ui = new b(f, e);
                            g.init()
                        }
                        Ca("firstUpdate"), m = m || i.index || 0, (isNaN(m) || 0 > m || m >= _b()) && (m = 0), f.currItem = $b(m), (N.isOldIOSPhone || N.isOldAndroid) && (ua = !1), a.setAttribute("aria-hidden", "false"), i.modal && (ua ? a.style.position = "fixed" : (a.style.position = "absolute", a.style.top = e.getScrollY() + "px")), void 0 === M && (Ca("initialLayout"), M = K = e.getScrollY());
                        var l = "pswp--open ";
                        for (i.mainClass && (l += i.mainClass + " "), i.showHideOpacity && (l += "pswp--animate_opacity "), l += G ? "pswp--touch" : "pswp--notouch", l += N.animationName ? " pswp--css_animation" : "", l += N.svg ? " pswp--svg" : "", e.addClass(a, l), f.updateSize(), o = -1, ta = null, c = 0; h > c; c++) Ia((c + o) * sa.x, y[c].el.style);
                        L || e.bind(f.scrollWrap, q, f), Ba("initialZoomInEnd", function() {
                            f.setContent(y[0], m - 1), f.setContent(y[2], m + 1), y[0].el.style.display = y[2].el.style.display = "block", i.focus && a.focus(), Pa()
                        }), f.setContent(y[1], m), f.updateCurrItem(), Ca("afterInit"), ua || (w = setInterval(function() {
                            $a || U || _ || s !== f.currItem.initialZoomLevel || f.updateSize()
                        }, 1e3)), e.addClass(a, "pswp--visible")
                    }
                },
                close: function() {
                    j && (j = !1, k = !0, Ca("close"), Qa(), bc(f.currItem, null, !0, f.destroy))
                },
                destroy: function() {
                    Ca("destroy"), Wb && clearTimeout(Wb), a.setAttribute("aria-hidden", "true"), a.className = J, w && clearInterval(w), e.unbind(f.scrollWrap, q, f), e.unbind(window, "scroll", f), yb(), bb(), Aa = null
                },
                panTo: function(a, b, c) {
                    c || (a > ca.min.x ? a = ca.min.x : a < ca.max.x && (a = ca.max.x), b > ca.min.y ? b = ca.min.y : b < ca.max.y && (b = ca.max.y)), oa.x = a, oa.y = b, Ga()
                },
                handleEvent: function(a) {
                    a = a || window.event, r[a.type] && r[a.type](a)
                },
                goTo: function(a) {
                    a = za(a);
                    var b = a - m;
                    ta = b, m = a, f.currItem = $b(m), qa -= b, Ja(sa.x * qa), bb(), ea = !1, f.updateCurrItem()
                },
                next: function() {
                    f.goTo(m + 1)
                },
                prev: function() {
                    f.goTo(m - 1)
                },
                updateCurrZoomItem: function(a) {
                    if (a && Ca("beforeChange", 0), y[1].el.children.length) {
                        var b = y[1].el.children[0];
                        da = e.hasClass(b, "pswp__zoom-wrap") ? b.style : null
                    } else da = null;
                    ca = f.currItem.bounds, t = s = f.currItem.initialZoomLevel, oa.x = ca.center.x, oa.y = ca.center.y, a && Ca("afterChange")
                },
                invalidateCurrItems: function() {
                    x = !0;
                    for (var a = 0; h > a; a++) y[a].item && (y[a].item.needsUpdate = !0)
                },
                updateCurrItem: function(a) {
                    if (0 !== ta) {
                        var b, c = Math.abs(ta);
                        if (!(a && 2 > c)) {
                            f.currItem = $b(m), xa = !1, Ca("beforeChange", ta), c >= h && (o += ta + (ta > 0 ? -h : h), c = h);
                            for (var d = 0; c > d; d++) ta > 0 ? (b = y.shift(), y[h - 1] = b, o++, Ia((o + 2) * sa.x, b.el.style), f.setContent(b, m - c + d + 1 + 1)) : (b = y.pop(), y.unshift(b), o--, Ia(o * sa.x, b.el.style), f.setContent(b, m + c - d - 1 - 1));
                            if (da && 1 === Math.abs(ta)) {
                                var e = $b(z);
                                e.initialZoomLevel !== s && (hc(e, pa), lc(e), Ha(e))
                            }
                            ta = 0, f.updateCurrZoomItem(), z = m, Ca("afterChange")
                        }
                    }
                },
                updateSize: function(b) {
                    if (!ua && i.modal) {
                        var c = e.getScrollY();
                        if (M !== c && (a.style.top = c + "px", M = c), !b && wa.x === window.innerWidth && wa.y === window.innerHeight) return;
                        wa.x = window.innerWidth, wa.y = window.innerHeight, a.style.height = wa.y + "px"
                    }
                    if (pa.x = f.scrollWrap.clientWidth, pa.y = f.scrollWrap.clientHeight, Ya(), sa.x = pa.x + Math.round(pa.x * i.spacing), sa.y = pa.y, Ja(sa.x * qa), Ca("beforeResize"), void 0 !== o) {
                        for (var d, g, j, k = 0; h > k; k++) d = y[k], Ia((k + o) * sa.x, d.el.style), j = m + k - 1, i.loop && _b() > 2 && (j = za(j)), g = $b(j), g && (x || g.needsUpdate || !g.bounds) ? (f.cleanSlide(g), f.setContent(d, j), 1 === k && (f.currItem = g, f.updateCurrZoomItem(!0)), g.needsUpdate = !1) : -1 === d.index && j >= 0 && f.setContent(d, j), g && g.container && (hc(g, pa), lc(g), Ha(g));
                        x = !1
                    }
                    t = s = f.currItem.initialZoomLevel, ca = f.currItem.bounds, ca && (oa.x = ca.center.x, oa.y = ca.center.y, Ga(!0)), Ca("resize")
                },
                zoomTo: function(a, b, c, d, f) {
                    b && (t = s, tb.x = Math.abs(b.x) - oa.x, tb.y = Math.abs(b.y) - oa.y, La(na, oa));
                    var g = Ra(a, !1),
                        h = {};
                    Ua("x", g, h, a), Ua("y", g, h, a);
                    var i = s,
                        j = {
                            x: oa.x,
                            y: oa.y
                        };
                    Ma(h);
                    var k = function(b) {
                        1 === b ? (s = a, oa.x = h.x, oa.y = h.y) : (s = (a - i) * b + i, oa.x = (h.x - j.x) * b + j.x, oa.y = (h.y - j.y) * b + j.y), f && f(b), Ga(1 === b)
                    };
                    c ? cb("customZoomTo", 0, 1, c, d || e.easing.sine.inOut, k) : k(1)
                }
            },
            eb = 30,
            fb = 10,
            gb = {},
            hb = {},
            ib = {},
            jb = {},
            kb = {},
            lb = [],
            mb = {},
            nb = [],
            ob = {},
            pb = 0,
            qb = la(),
            rb = 0,
            sb = la(),
            tb = la(),
            ub = la(),
            vb = function(a, b) {
                return a.x === b.x && a.y === b.y
            },
            wb = function(a, b) {
                return Math.abs(a.x - b.x) < g && Math.abs(a.y - b.y) < g
            },
            xb = function(a, b) {
                return ob.x = Math.abs(a.x - b.x), ob.y = Math.abs(a.y - b.y), Math.sqrt(ob.x * ob.x + ob.y * ob.y)
            },
            yb = function() {
                Y && (I(Y), Y = null)
            },
            zb = function() {
                U && (Y = H(zb), Pb())
            },
            Ab = function() {
                return !("fit" === i.scaleMode && s === f.currItem.initialZoomLevel)
            },
            Bb = function(a, b) {
                return a ? a.className && a.className.indexOf("pswp__scroll-wrap") > -1 ? !1 : b(a) ? a : Bb(a.parentNode, b) : !1
            },
            Cb = {},
            Db = function(a, b) {
                return Cb.prevent = !Bb(a.target, i.isClickableElement), Ca("preventDragEvent", a, b, Cb), Cb.prevent
            },
            Eb = function(a, b) {
                return b.x = a.pageX, b.y = a.pageY, b.id = a.identifier, b
            },
            Fb = function(a, b, c) {
                c.x = .5 * (a.x + b.x), c.y = .5 * (a.y + b.y)
            },
            Gb = function(a, b, c) {
                if (a - P > 50) {
                    var d = nb.length > 2 ? nb.shift() : {};
                    d.x = b, d.y = c, nb.push(d), P = a
                }
            },
            Hb = function() {
                var a = oa.y - f.currItem.initialPosition.y;
                return 1 - Math.abs(a / (pa.y / 2))
            },
            Ib = {},
            Jb = {},
            Kb = [],
            Lb = function(a) {
                for (; Kb.length > 0;) Kb.pop();
                return F ? (ka = 0, lb.forEach(function(a) {
                    0 === ka ? Kb[0] = a : 1 === ka && (Kb[1] = a), ka++
                })) : a.type.indexOf("touch") > -1 ? a.touches && a.touches.length > 0 && (Kb[0] = Eb(a.touches[0], Ib), a.touches.length > 1 && (Kb[1] = Eb(a.touches[1], Jb))) : (Ib.x = a.pageX, Ib.y = a.pageY, Ib.id = "", Kb[0] = Ib), Kb
            },
            Mb = function(a, b) {
                var c, d, e, g, h = 0,
                    j = oa[a] + b[a],
                    k = b[a] > 0,
                    l = sb.x + b.x,
                    m = sb.x - mb.x;
                return c = j > ca.min[a] || j < ca.max[a] ? i.panEndFriction : 1, j = oa[a] + b[a] * c, !i.allowPanToNext && s !== f.currItem.initialZoomLevel || (da ? "h" !== fa || "x" !== a || W || (k ? (j > ca.min[a] && (c = i.panEndFriction, h = ca.min[a] - j, d = ca.min[a] - na[a]), (0 >= d || 0 > m) && _b() > 1 ? (g = l, 0 > m && l > mb.x && (g = mb.x)) : ca.min.x !== ca.max.x && (e = j)) : (j < ca.max[a] && (c = i.panEndFriction, h = j - ca.max[a], d = na[a] - ca.max[a]), (0 >= d || m > 0) && _b() > 1 ? (g = l, m > 0 && l < mb.x && (g = mb.x)) : ca.min.x !== ca.max.x && (e = j))) : g = l, "x" !== a) ? void(ea || Z || s > f.currItem.fitRatio && (oa[a] += b[a] * c)) : (void 0 !== g && (Ja(g, !0), Z = g === mb.x ? !1 : !0), ca.min.x !== ca.max.x && (void 0 !== e ? oa.x = e : Z || (oa.x += b.x * c)), void 0 !== g)
            },
            Nb = function(a) {
                if (!("mousedown" === a.type && a.button > 0)) {
                    if (Zb) return void a.preventDefault();
                    if (!T || "mousedown" !== a.type) {
                        if (Db(a, !0) && a.preventDefault(), Ca("pointerDown"), F) {
                            var b = e.arraySearch(lb, a.pointerId, "id");
                            0 > b && (b = lb.length), lb[b] = {
                                x: a.pageX,
                                y: a.pageY,
                                id: a.pointerId
                            }
                        }
                        var c = Lb(a),
                            d = c.length;
                        $ = null, bb(), U && 1 !== d || (U = ga = !0, e.bind(window, p, f), R = ja = ha = S = Z = X = V = W = !1, fa = null, Ca("firstTouchStart", c), La(na, oa), ma.x = ma.y = 0, La(jb, c[0]), La(kb, jb), mb.x = sa.x * qa, nb = [{
                            x: jb.x,
                            y: jb.y
                        }], P = O = Da(), Ra(s, !0), yb(), zb()), !_ && d > 1 && !ea && !Z && (t = s, W = !1, _ = V = !0, ma.y = ma.x = 0, La(na, oa), La(gb, c[0]), La(hb, c[1]), Fb(gb, hb, ub), tb.x = Math.abs(ub.x) - oa.x, tb.y = Math.abs(ub.y) - oa.y, aa = ba = xb(gb, hb))
                    }
                }
            },
            Ob = function(a) {
                if (a.preventDefault(), F) {
                    var b = e.arraySearch(lb, a.pointerId, "id");
                    if (b > -1) {
                        var c = lb[b];
                        c.x = a.pageX, c.y = a.pageY
                    }
                }
                if (U) {
                    var d = Lb(a);
                    if (fa || X || _) $ = d;
                    else if (sb.x !== sa.x * qa) fa = "h";
                    else {
                        var f = Math.abs(d[0].x - jb.x) - Math.abs(d[0].y - jb.y);
                        Math.abs(f) >= fb && (fa = f > 0 ? "h" : "v", $ = d)
                    }
                }
            },
            Pb = function() {
                if ($) {
                    var a = $.length;
                    if (0 !== a)
                        if (La(gb, $[0]), ib.x = gb.x - jb.x, ib.y = gb.y - jb.y, _ && a > 1) {
                            if (jb.x = gb.x, jb.y = gb.y, !ib.x && !ib.y && vb($[1], hb)) return;
                            La(hb, $[1]), W || (W = !0, Ca("zoomGestureStarted"));
                            var b = xb(gb, hb),
                                c = Ub(b);
                            c > f.currItem.initialZoomLevel + f.currItem.initialZoomLevel / 15 && (ja = !0);
                            var d = 1,
                                e = Sa(),
                                g = Ta();
                            if (e > c)
                                if (i.pinchToClose && !ja && t <= f.currItem.initialZoomLevel) {
                                    var h = e - c,
                                        j = 1 - h / (e / 1.2);
                                    Ea(j), Ca("onPinchClose", j), ha = !0
                                } else d = (e - c) / e, d > 1 && (d = 1), c = e - d * (e / 3);
                            else c > g && (d = (c - g) / (6 * e), d > 1 && (d = 1), c = g + d * e);
                            0 > d && (d = 0), aa = b, Fb(gb, hb, qb), ma.x += qb.x - ub.x, ma.y += qb.y - ub.y, La(ub, qb), oa.x = Ka("x", c), oa.y = Ka("y", c), R = c > s, s = c, Ga()
                        } else {
                            if (!fa) return;
                            if (ga && (ga = !1, Math.abs(ib.x) >= fb && (ib.x -= $[0].x - kb.x), Math.abs(ib.y) >= fb && (ib.y -= $[0].y - kb.y)), jb.x = gb.x, jb.y = gb.y, 0 === ib.x && 0 === ib.y) return;
                            if ("v" === fa && i.closeOnVerticalDrag && !Ab()) {
                                ma.y += ib.y, oa.y += ib.y;
                                var k = Hb();
                                return S = !0, Ca("onVerticalDrag", k), Ea(k), void Ga()
                            }
                            Gb(Da(), gb.x, gb.y), X = !0, ca = f.currItem.bounds;
                            var l = Mb("x", ib);
                            l || (Mb("y", ib), Ma(oa), Ga())
                        }
                }
            },
            Qb = function(a) {
                if (N.isOldAndroid) {
                    if (T && "mouseup" === a.type) return;
                    a.type.indexOf("touch") > -1 && (clearTimeout(T), T = setTimeout(function() {
                        T = 0
                    }, 600))
                }
                Ca("pointerUp"), Db(a, !1) && a.preventDefault();
                var b;
                if (F) {
                    var c = e.arraySearch(lb, a.pointerId, "id");
                    if (c > -1)
                        if (b = lb.splice(c, 1)[0], navigator.pointerEnabled) b.type = a.pointerType || "mouse";
                        else {
                            var d = {
                                4: "mouse",
                                2: "touch",
                                3: "pen"
                            };
                            b.type = d[a.pointerType], b.type || (b.type = a.pointerType || "mouse")
                        }
                }
                var g, h = Lb(a),
                    j = h.length;
                if ("mouseup" === a.type && (j = 0), 2 === j) return $ = null, !0;
                1 === j && La(kb, h[0]), 0 !== j || fa || ea || (b || ("mouseup" === a.type ? b = {
                    x: a.pageX,
                    y: a.pageY,
                    type: "mouse"
                } : a.changedTouches && a.changedTouches[0] && (b = {
                        x: a.changedTouches[0].pageX,
                        y: a.changedTouches[0].pageY,
                        type: "touch"
                    })), Ca("touchRelease", a, b));
                var k = -1;
                if (0 === j && (U = !1, e.unbind(window, p, f), yb(), _ ? k = 0 : -1 !== rb && (k = Da() - rb)), rb = 1 === j ? Da() : -1, g = -1 !== k && 150 > k ? "zoom" : "swipe", _ && 2 > j && (_ = !1, 1 === j && (g = "zoomPointerUp"), Ca("zoomGestureEnded")), $ = null, X || W || ea || S)
                    if (bb(), Q || (Q = Rb()), Q.calculateSwipeSpeed("x"), S) {
                        var l = Hb();
                        if (l < i.verticalDragRange) f.close();
                        else {
                            var m = oa.y,
                                n = ia;
                            cb("verticalDrag", 0, 1, 300, e.easing.cubic.out, function(a) {
                                oa.y = (f.currItem.initialPosition.y - m) * a + m, Ea((1 - n) * a + n), Ga()
                            }), Ca("onVerticalDrag", 1)
                        }
                    } else {
                        if ((Z || ea) && 0 === j) {
                            var o = Tb(g, Q);
                            if (o) return;
                            g = "zoomPointerUp"
                        }
                        if (!ea) return "swipe" !== g ? void Vb() : void(!Z && s > f.currItem.fitRatio && Sb(Q))
                    }
            },
            Rb = function() {
                var a, b, c = {
                    lastFlickOffset: {},
                    lastFlickDist: {},
                    lastFlickSpeed: {},
                    slowDownRatio: {},
                    slowDownRatioReverse: {},
                    speedDecelerationRatio: {},
                    speedDecelerationRatioAbs: {},
                    distanceOffset: {},
                    backAnimDestination: {},
                    backAnimStarted: {},
                    calculateSwipeSpeed: function(d) {
                        nb.length > 1 ? (a = Da() - P + 50, b = nb[nb.length - 2][d]) : (a = Da() - O, b = kb[d]), c.lastFlickOffset[d] = jb[d] - b, c.lastFlickDist[d] = Math.abs(c.lastFlickOffset[d]), c.lastFlickDist[d] > 20 ? c.lastFlickSpeed[d] = c.lastFlickOffset[d] / a : c.lastFlickSpeed[d] = 0, Math.abs(c.lastFlickSpeed[d]) < .1 && (c.lastFlickSpeed[d] = 0), c.slowDownRatio[d] = .95, c.slowDownRatioReverse[d] = 1 - c.slowDownRatio[d], c.speedDecelerationRatio[d] = 1
                    },
                    calculateOverBoundsAnimOffset: function(a, b) {
                        c.backAnimStarted[a] || (oa[a] > ca.min[a] ? c.backAnimDestination[a] = ca.min[a] : oa[a] < ca.max[a] && (c.backAnimDestination[a] = ca.max[a]), void 0 !== c.backAnimDestination[a] && (c.slowDownRatio[a] = .7, c.slowDownRatioReverse[a] = 1 - c.slowDownRatio[a], c.speedDecelerationRatioAbs[a] < .05 && (c.lastFlickSpeed[a] = 0, c.backAnimStarted[a] = !0, cb("bounceZoomPan" + a, oa[a], c.backAnimDestination[a], b || 300, e.easing.sine.out, function(b) {
                            oa[a] = b, Ga()
                        }))))
                    },
                    calculateAnimOffset: function(a) {
                        c.backAnimStarted[a] || (c.speedDecelerationRatio[a] = c.speedDecelerationRatio[a] * (c.slowDownRatio[a] + c.slowDownRatioReverse[a] - c.slowDownRatioReverse[a] * c.timeDiff / 10), c.speedDecelerationRatioAbs[a] = Math.abs(c.lastFlickSpeed[a] * c.speedDecelerationRatio[a]), c.distanceOffset[a] = c.lastFlickSpeed[a] * c.speedDecelerationRatio[a] * c.timeDiff, oa[a] += c.distanceOffset[a])
                    },
                    panAnimLoop: function() {
                        return Za.zoomPan && (Za.zoomPan.raf = H(c.panAnimLoop), c.now = Da(), c.timeDiff = c.now - c.lastNow, c.lastNow = c.now, c.calculateAnimOffset("x"), c.calculateAnimOffset("y"), Ga(), c.calculateOverBoundsAnimOffset("x"), c.calculateOverBoundsAnimOffset("y"), c.speedDecelerationRatioAbs.x < .05 && c.speedDecelerationRatioAbs.y < .05) ? (oa.x = Math.round(oa.x), oa.y = Math.round(oa.y), Ga(), void _a("zoomPan")) : void 0
                    }
                };
                return c
            },
            Sb = function(a) {
                return a.calculateSwipeSpeed("y"), ca = f.currItem.bounds, a.backAnimDestination = {}, a.backAnimStarted = {}, Math.abs(a.lastFlickSpeed.x) <= .05 && Math.abs(a.lastFlickSpeed.y) <= .05 ? (a.speedDecelerationRatioAbs.x = a.speedDecelerationRatioAbs.y = 0, a.calculateOverBoundsAnimOffset("x"), a.calculateOverBoundsAnimOffset("y"), !0) : (ab("zoomPan"), a.lastNow = Da(), void a.panAnimLoop())
            },
            Tb = function(a, b) {
                var c;
                ea || (pb = m);
                var d;
                if ("swipe" === a) {
                    var g = jb.x - kb.x,
                        h = b.lastFlickDist.x < 10;
                    g > eb && (h || b.lastFlickOffset.x > 20) ? d = -1 : -eb > g && (h || b.lastFlickOffset.x < -20) && (d = 1)
                }
                var j;
                d && (m += d, 0 > m ? (m = i.loop ? _b() - 1 : 0, j = !0) : m >= _b() && (m = i.loop ? 0 : _b() - 1, j = !0), (!j || i.loop) && (ta += d, qa -= d, c = !0));
                var k, l = sa.x * qa,
                    n = Math.abs(l - sb.x);
                return c || l > sb.x == b.lastFlickSpeed.x > 0 ? (k = Math.abs(b.lastFlickSpeed.x) > 0 ? n / Math.abs(b.lastFlickSpeed.x) : 333, k = Math.min(k, 400), k = Math.max(k, 250)) : k = 333, pb === m && (c = !1), ea = !0, Ca("mainScrollAnimStart"), cb("mainScroll", sb.x, l, k, e.easing.cubic.out, Ja, function() {
                    bb(), ea = !1, pb = -1, (c || pb !== m) && f.updateCurrItem(), Ca("mainScrollAnimComplete")
                }), c && f.updateCurrItem(!0), c
            },
            Ub = function(a) {
                return 1 / ba * a * t
            },
            Vb = function() {
                var a = s,
                    b = Sa(),
                    c = Ta();
                b > s ? a = b : s > c && (a = c);
                var d, g = 1,
                    h = ia;
                return ha && !R && !ja && b > s ? (f.close(), !0) : (ha && (d = function(a) {
                    Ea((g - h) * a + h)
                }), f.zoomTo(a, 0, 200, e.easing.cubic.out, d), !0)
            };
        ya("Gestures", {
            publicMethods: {
                initGestures: function() {
                    var a = function(a, b, c, d, e) {
                        A = a + b, B = a + c, C = a + d, D = e ? a + e : ""
                    };
                    F = N.pointerEvent, F && N.touch && (N.touch = !1), F ? navigator.pointerEnabled ? a("pointer", "down", "move", "up", "cancel") : a("MSPointer", "Down", "Move", "Up", "Cancel") : N.touch ? (a("touch", "start", "move", "end", "cancel"), G = !0) : a("mouse", "down", "move", "up"), p = B + " " + C + " " + D, q = A, F && !G && (G = navigator.maxTouchPoints > 1 || navigator.msMaxTouchPoints > 1), f.likelyTouchDevice = G, r[A] = Nb, r[B] = Ob, r[C] = Qb, D && (r[D] = r[C]), N.touch && (q += " mousedown", p += " mousemove mouseup", r.mousedown = r[A], r.mousemove = r[B], r.mouseup = r[C]), G || (i.allowPanToNext = !1)
                }
            }
        });
        var Wb, Xb, Yb, Zb, $b, _b, ac, bc = function(b, c, d, g) {
                Wb && clearTimeout(Wb), Zb = !0, Yb = !0;
                var h;
                b.initialLayout ? (h = b.initialLayout, b.initialLayout = null) : h = i.getThumbBoundsFn && i.getThumbBoundsFn(m);
                var j = d ? i.hideAnimationDuration : i.showAnimationDuration,
                    k = function() {
                        _a("initialZoom"), d ? (f.template.removeAttribute("style"), f.bg.removeAttribute("style")) : (Ea(1), c && (c.style.display = "block"), e.addClass(a, "pswp--animated-in"), Ca("initialZoom" + (d ? "OutEnd" : "InEnd"))), g && g(), Zb = !1
                    };
                if (!j || !h || void 0 === h.x) return Ca("initialZoom" + (d ? "Out" : "In")), s = b.initialZoomLevel, La(oa, b.initialPosition), Ga(), a.style.opacity = d ? 0 : 1, Ea(1), void(j ? setTimeout(function() {
                    k()
                }, j) : k());
                var n = function() {
                    var c = l,
                        g = !f.currItem.src || f.currItem.loadError || i.showHideOpacity;
                    b.miniImg && (b.miniImg.style.webkitBackfaceVisibility = "hidden"), d || (s = h.w / b.w, oa.x = h.x, oa.y = h.y - K, f[g ? "template" : "bg"].style.opacity = .001, Ga()), ab("initialZoom"), d && !c && e.removeClass(a, "pswp--animated-in"), g && (d ? e[(c ? "remove" : "add") + "Class"](a, "pswp--animate_opacity") : setTimeout(function() {
                        e.addClass(a, "pswp--animate_opacity")
                    }, 30)), Wb = setTimeout(function() {
                        if (Ca("initialZoom" + (d ? "Out" : "In")), d) {
                            var f = h.w / b.w,
                                i = {
                                    x: oa.x,
                                    y: oa.y
                                },
                                l = s,
                                m = ia,
                                n = function(b) {
                                    1 === b ? (s = f, oa.x = h.x, oa.y = h.y - M) : (s = (f - l) * b + l, oa.x = (h.x - i.x) * b + i.x, oa.y = (h.y - M - i.y) * b + i.y), Ga(), g ? a.style.opacity = 1 - b : Ea(m - b * m)
                                };
                            c ? cb("initialZoom", 0, 1, j, e.easing.cubic.out, n, k) : (n(1), Wb = setTimeout(k, j + 20))
                        } else s = b.initialZoomLevel, La(oa, b.initialPosition), Ga(), Ea(1), g ? a.style.opacity = 1 : Ea(1), Wb = setTimeout(k, j + 20)
                    }, d ? 25 : 90)
                };
                n()
            },
            cc = {},
            dc = [],
            ec = {
                index: 0,
                errorMsg: '<div class="pswp__error-msg"><a href="%url%" target="_blank">The image</a> could not be loaded.</div>',
                forceProgressiveLoading: !1,
                preload: [1, 1],
                getNumItemsFn: function() {
                    return Xb.length
                }
            },
            fc = function() {
                return {
                    center: {
                        x: 0,
                        y: 0
                    },
                    max: {
                        x: 0,
                        y: 0
                    },
                    min: {
                        x: 0,
                        y: 0
                    }
                }
            },
            gc = function(a, b, c) {
                var d = a.bounds;
                d.center.x = Math.round((cc.x - b) / 2), d.center.y = Math.round((cc.y - c) / 2) + a.vGap.top, d.max.x = b > cc.x ? Math.round(cc.x - b) : d.center.x, d.max.y = c > cc.y ? Math.round(cc.y - c) + a.vGap.top : d.center.y, d.min.x = b > cc.x ? 0 : d.center.x, d.min.y = c > cc.y ? a.vGap.top : d.center.y
            },
            hc = function(a, b, c) {
                if (a.src && !a.loadError) {
                    var d = !c;
                    if (d && (a.vGap || (a.vGap = {
                            top: 0,
                            bottom: 0
                        }), Ca("parseVerticalMargin", a)), cc.x = b.x, cc.y = b.y - a.vGap.top - a.vGap.bottom, d) {
                        var e = cc.x / a.w,
                            f = cc.y / a.h;
                        a.fitRatio = f > e ? e : f;
                        var g = i.scaleMode;
                        "orig" === g ? c = 1 : "fit" === g && (c = a.fitRatio), c > 1 && (c = 1), a.initialZoomLevel = c, a.bounds || (a.bounds = fc())
                    }
                    if (!c) return;
                    return gc(a, a.w * c, a.h * c), d && c === a.initialZoomLevel && (a.initialPosition = a.bounds.center), a.bounds
                }
                return a.w = a.h = 0, a.initialZoomLevel = a.fitRatio = 1, a.bounds = fc(), a.initialPosition = a.bounds.center, a.bounds
            },
            ic = function(a, b, c, d, e, f) {
                b.loadError || d && (b.imageAppended = !0, lc(b, d), c.appendChild(d), f && setTimeout(function() {
                    b && b.loaded && b.placeholder && (b.placeholder.style.display = "none", b.placeholder = null)
                }, 500))
            },
            jc = function(a) {
                a.loading = !0, a.loaded = !1;
                var b = a.img = e.createEl("pswp__img", "img"),
                    c = function() {
                        a.loading = !1, a.loaded = !0, a.loadComplete ? a.loadComplete(a) : a.img = null, b.onload = b.onerror = null, b = null
                    };
                return b.onload = c, b.onerror = function() {
                    a.loadError = !0, c()
                }, b.src = a.src, b
            },
            kc = function(a, b) {
                return a.src && a.loadError && a.container ? (b && (a.container.innerHTML = ""), a.container.innerHTML = i.errorMsg.replace("%url%", a.src), !0) : void 0
            },
            lc = function(a, b, c) {
                if (a.src) {
                    b || (b = a.container.lastChild);
                    var d = c ? a.w : Math.round(a.w * a.fitRatio),
                        e = c ? a.h : Math.round(a.h * a.fitRatio);
                    a.placeholder && !a.loaded && (a.placeholder.style.width = d + "px", a.placeholder.style.height = e + "px"), b.style.width = d + "px", b.style.height = e + "px"
                }
            },
            mc = function() {
                if (dc.length) {
                    for (var a, b = 0; b < dc.length; b++) a = dc[b], a.holder.index === a.index && ic(a.index, a.item, a.baseDiv, a.img, !1, a.clearPlaceholder);
                    dc = []
                }
            };
        ya("Controller", {
            publicMethods: {
                lazyLoadItem: function(a) {
                    a = za(a);
                    var b = $b(a);
                    b && (!b.loaded && !b.loading || x) && (Ca("gettingData", a, b), b.src && jc(b))
                },
                initController: function() {
                    e.extend(i, ec, !0), f.items = Xb = c, $b = f.getItemAt, _b = i.getNumItemsFn, ac = i.loop, _b() < 3 && (i.loop = !1), Ba("beforeChange", function(a) {
                        var b, c = i.preload,
                            d = null === a ? !0 : a >= 0,
                            e = Math.min(c[0], _b()),
                            g = Math.min(c[1], _b());
                        for (b = 1;
                             (d ? g : e) >= b; b++) f.lazyLoadItem(m + b);
                        for (b = 1;
                             (d ? e : g) >= b; b++) f.lazyLoadItem(m - b)
                    }), Ba("initialLayout", function() {
                        f.currItem.initialLayout = i.getThumbBoundsFn && i.getThumbBoundsFn(m)
                    }), Ba("mainScrollAnimComplete", mc), Ba("initialZoomInEnd", mc), Ba("destroy", function() {
                        for (var a, b = 0; b < Xb.length; b++) a = Xb[b], a.container && (a.container = null), a.placeholder && (a.placeholder = null), a.img && (a.img = null), a.preloader && (a.preloader = null), a.loadError && (a.loaded = a.loadError = !1);
                        dc = null
                    })
                },
                getItemAt: function(a) {
                    return a >= 0 && void 0 !== Xb[a] ? Xb[a] : !1
                },
                allowProgressiveImg: function() {
                    return i.forceProgressiveLoading || !G || i.mouseUsed || screen.width > 1200
                },
                setContent: function(a, b) {
                    i.loop && (b = za(b));
                    var c = f.getItemAt(a.index);
                    c && (c.container = null);
                    var d, g = f.getItemAt(b);
                    if (!g) return void(a.el.innerHTML = "");
                    Ca("gettingData", b, g), a.index = b, a.item = g;
                    var h = g.container = e.createEl("pswp__zoom-wrap");
                    if (!g.src && g.html && (g.html.tagName ? h.appendChild(g.html) : h.innerHTML = g.html), kc(g), hc(g, pa), !g.src || g.loadError || g.loaded) g.src && !g.loadError && (d = e.createEl("pswp__img", "img"), d.style.opacity = 1, d.src = g.src, lc(g, d), ic(b, g, h, d, !0));
                    else {
                        if (g.loadComplete = function(c) {
                                if (j) {
                                    if (a && a.index === b) {
                                        if (kc(c, !0)) return c.loadComplete = c.img = null, hc(c, pa), Ha(c), void(a.index === m && f.updateCurrZoomItem());
                                        c.imageAppended ? !Zb && c.placeholder && (c.placeholder.style.display = "none", c.placeholder = null) : N.transform && (ea || Zb) ? dc.push({
                                            item: c,
                                            baseDiv: h,
                                            img: c.img,
                                            index: b,
                                            holder: a,
                                            clearPlaceholder: !0
                                        }) : ic(b, c, h, c.img, ea || Zb, !0)
                                    }
                                    c.loadComplete = null, c.img = null, Ca("imageLoadComplete", b, c)
                                }
                            }, e.features.transform) {
                            var k = "pswp__img pswp__img--placeholder";
                            k += g.msrc ? "" : " pswp__img--placeholder--blank";
                            var l = e.createEl(k, g.msrc ? "img" : "");
                            g.msrc && (l.src = g.msrc), lc(g, l), h.appendChild(l), g.placeholder = l
                        }
                        g.loading || jc(g), f.allowProgressiveImg() && (!Yb && N.transform ? dc.push({
                            item: g,
                            baseDiv: h,
                            img: g.img,
                            index: b,
                            holder: a
                        }) : ic(b, g, h, g.img, !0, !0))
                    }
                    Yb || b !== m ? Ha(g) : (da = h.style, bc(g, d || g.img)), a.el.innerHTML = "", a.el.appendChild(h)
                },
                cleanSlide: function(a) {
                    a.img && (a.img.onload = a.img.onerror = null), a.loaded = a.loading = a.img = a.imageAppended = !1
                }
            }
        });
        var nc, oc = {},
            pc = function(a, b, c) {
                var d = document.createEvent("CustomEvent"),
                    e = {
                        origEvent: a,
                        target: a.target,
                        releasePoint: b,
                        pointerType: c || "touch"
                    };
                d.initCustomEvent("pswpTap", !0, !0, e), a.target.dispatchEvent(d)
            };
        ya("Tap", {
            publicMethods: {
                initTap: function() {
                    Ba("firstTouchStart", f.onTapStart), Ba("touchRelease", f.onTapRelease), Ba("destroy", function() {
                        oc = {}, nc = null
                    })
                },
                onTapStart: function(a) {
                    a.length > 1 && (clearTimeout(nc), nc = null)
                },
                onTapRelease: function(a, b) {
                    if (b && !X && !V && !$a) {
                        var c = b;
                        if (nc && (clearTimeout(nc), nc = null, wb(c, oc))) return void Ca("doubleTap", c);
                        if ("mouse" === b.type) return void pc(a, b, "mouse");
                        var d = a.target.tagName.toUpperCase();
                        if ("BUTTON" === d || e.hasClass(a.target, "pswp__single-tap")) return void pc(a, b);
                        La(oc, c), nc = setTimeout(function() {
                            pc(a, b), nc = null
                        }, 300)
                    }
                }
            }
        });
        var qc;
        ya("DesktopZoom", {
            publicMethods: {
                initDesktopZoom: function() {
                    L || (G ? Ba("mouseUsed", function() {
                        f.setupDesktopZoom()
                    }) : f.setupDesktopZoom(!0))
                },
                setupDesktopZoom: function(b) {
                    qc = {};
                    var c = "wheel mousewheel DOMMouseScroll";
                    Ba("bindEvents", function() {
                        e.bind(a, c, f.handleMouseWheel)
                    }), Ba("unbindEvents", function() {
                        qc && e.unbind(a, c, f.handleMouseWheel)
                    }), f.mouseZoomedIn = !1;
                    var d, g = function() {
                            f.mouseZoomedIn && (e.removeClass(a, "pswp--zoomed-in"), f.mouseZoomedIn = !1), 1 > s ? e.addClass(a, "pswp--zoom-allowed") : e.removeClass(a, "pswp--zoom-allowed"), h()
                        },
                        h = function() {
                            d && (e.removeClass(a, "pswp--dragging"), d = !1)
                        };
                    Ba("resize", g), Ba("afterChange", g), Ba("pointerDown", function() {
                        f.mouseZoomedIn && (d = !0, e.addClass(a, "pswp--dragging"))
                    }), Ba("pointerUp", h), b || g()
                },
                handleMouseWheel: function(a) {
                    if (s <= f.currItem.fitRatio) return i.modal && (!i.closeOnScroll || $a || U ? a.preventDefault() : E && Math.abs(a.deltaY) > 2 && (l = !0, f.close())), !0;
                    if (a.stopPropagation(), qc.x = 0, "deltaX" in a) 1 === a.deltaMode ? (qc.x = 18 * a.deltaX, qc.y = 18 * a.deltaY) : (qc.x = a.deltaX, qc.y = a.deltaY);
                    else if ("wheelDelta" in a) a.wheelDeltaX && (qc.x = -.16 * a.wheelDeltaX), a.wheelDeltaY ? qc.y = -.16 * a.wheelDeltaY : qc.y = -.16 * a.wheelDelta;
                    else {
                        if (!("detail" in a)) return;
                        qc.y = a.detail
                    }
                    Ra(s, !0);
                    var b = oa.x - qc.x,
                        c = oa.y - qc.y;
                    (i.modal || b <= ca.min.x && b >= ca.max.x && c <= ca.min.y && c >= ca.max.y) && a.preventDefault(), f.panTo(b, c)
                },
                toggleDesktopZoom: function(b) {
                    b = b || {
                            x: pa.x / 2 + ra.x,
                            y: pa.y / 2 + ra.y
                        };
                    var c = i.getDoubleTapZoom(!0, f.currItem),
                        d = s === c;
                    f.mouseZoomedIn = !d, f.zoomTo(d ? f.currItem.initialZoomLevel : c, b, 333), e[(d ? "remove" : "add") + "Class"](a, "pswp--zoomed-in")
                }
            }
        });
        var rc, sc, tc, uc, vc, wc, xc, yc, zc, Ac, Bc, Cc, Dc = {
                history: !0,
                galleryUID: 1
            },
            Ec = function() {
                return Bc.hash.substring(1)
            },
            Fc = function() {
                rc && clearTimeout(rc), tc && clearTimeout(tc)
            },
            Gc = function() {
                var a = Ec(),
                    b = {};
                if (a.length < 5) return b;
                var c, d = a.split("&");
                for (c = 0; c < d.length; c++)
                    if (d[c]) {
                        var e = d[c].split("=");
                        e.length < 2 || (b[e[0]] = e[1])
                    }
                if (i.galleryPIDs) {
                    var f = b.pid;
                    for (b.pid = 0, c = 0; c < Xb.length; c++)
                        if (Xb[c].pid === f) {
                            b.pid = c;
                            break
                        }
                } else b.pid = parseInt(b.pid, 10) - 1;
                return b.pid < 0 && (b.pid = 0), b
            },
            Hc = function() {
                if (tc && clearTimeout(tc), $a || U) return void(tc = setTimeout(Hc, 500));
                uc ? clearTimeout(sc) : uc = !0;
                var a = m + 1,
                    b = $b(m);
                b.hasOwnProperty("pid") && (a = b.pid);
                var c = xc + "&gid=" + i.galleryUID + "&pid=" + a;
                yc || -1 === Bc.hash.indexOf(c) && (Ac = !0);
                var d = Bc.href.split("#")[0] + "#" + c;
                Cc ? "#" + c !== window.location.hash && history[yc ? "replaceState" : "pushState"]("", document.title, d) : yc ? Bc.replace(d) : Bc.hash = c, yc = !0, sc = setTimeout(function() {
                    uc = !1
                }, 60)
            };
        ya("History", {
            publicMethods: {
                initHistory: function() {
                    if (e.extend(i, Dc, !0), i.history) {
                        Bc = window.location, Ac = !1, zc = !1, yc = !1, xc = Ec(), Cc = "pushState" in history, xc.indexOf("gid=") > -1 && (xc = xc.split("&gid=")[0], xc = xc.split("?gid=")[0]), Ba("afterChange", f.updateURL), Ba("unbindEvents", function() {
                            e.unbind(window, "hashchange", f.onHashChange)
                        });
                        var a = function() {
                            wc = !0, zc || (Ac ? history.back() : xc ? Bc.hash = xc : Cc ? history.pushState("", document.title, Bc.pathname + Bc.search) : Bc.hash = ""), Fc()
                        };
                        Ba("unbindEvents", function() {
                            l && a()
                        }), Ba("destroy", function() {
                            wc || a()
                        }), Ba("firstUpdate", function() {
                            m = Gc().pid
                        });
                        var b = xc.indexOf("pid=");
                        b > -1 && (xc = xc.substring(0, b), "&" === xc.slice(-1) && (xc = xc.slice(0, -1))), setTimeout(function() {
                            j && e.bind(window, "hashchange", f.onHashChange)
                        }, 40)
                    }
                },
                onHashChange: function() {
                    return Ec() === xc ? (zc = !0, void f.close()) : void(uc || (vc = !0, f.goTo(Gc().pid), vc = !1))
                },
                updateURL: function() {
                    Fc(), vc || (yc ? rc = setTimeout(Hc, 800) : Hc())
                }
            }
        }), e.extend(f, db)
    };
    return a
}), ! function(a, b) {
    "function" == typeof define && define.amd ? define(b) : "object" == typeof exports ? module.exports = b() : a.PhotoSwipeUI_Default = b()
}(this, function() {
    "use strict";
    var a = function(a, b) {
        var c, d, e, f, g, h, i, j, k, l, m, n, o, p, q, r, s, t, u, v = this,
            w = !1,
            x = !0,
            y = !0,
            z = {
                barsSize: {
                    top: 44,
                    bottom: "auto"
                },
                closeElClasses: ["item", "caption", "zoom-wrap", "ui", "top-bar"],
                timeToIdle: 4e3,
                timeToIdleOutside: 1e3,
                loadingIndicatorDelay: 1e3,
                addCaptionHTMLFn: function(a, b) {
                    return a.title ? (b.children[0].innerHTML = a.title, !0) : (b.children[0].innerHTML = "", !1)
                },
                closeEl: !0,
                captionEl: !0,
                fullscreenEl: !0,
                zoomEl: !0,
                shareEl: !0,
                counterEl: !0,
                arrowEl: !0,
                preloaderEl: !0,
                tapToClose: !1,
                tapToToggleControls: !0,
                clickToCloseNonZoomable: !0,
                shareButtons: [{
                    id: "facebook",
                    label: "Share on Facebook",
                    url: "https://www.facebook.com/sharer/sharer.php?u={{url}}"
                }, {
                    id: "twitter",
                    label: "Tweet",
                    url: "https://twitter.com/intent/tweet?text={{text}}&url={{url}}"
                }, {
                    id: "pinterest",
                    label: "Pin it",
                    url: "http://www.pinterest.com/pin/create/button/?url={{url}}&media={{image_url}}&description={{text}}"
                }, {
                    id: "download",
                    label: "Download image",
                    url: "{{raw_image_url}}",
                    download: !0
                }],
                getImageURLForShare: function() {
                    return a.currItem.src || ""
                },
                getPageURLForShare: function() {
                    return window.location.href
                },
                getTextForShare: function() {
                    return a.currItem.title || ""
                },
                indexIndicatorSep: " / "
            },
            A = function(a) {
                if (r) return !0;
                a = a || window.event, q.timeToIdle && q.mouseUsed && !k && K();
                for (var c, d, e = a.target || a.srcElement, f = e.className, g = 0; g < S.length; g++) c = S[g], c.onTap && f.indexOf("pswp__" + c.name) > -1 && (c.onTap(), d = !0);
                if (d) {
                    a.stopPropagation && a.stopPropagation(), r = !0;
                    var h = b.features.isOldAndroid ? 600 : 30;
                    s = setTimeout(function() {
                        r = !1
                    }, h)
                }
            },
            B = function() {
                return !a.likelyTouchDevice || q.mouseUsed || screen.width > 1200
            },
            C = function(a, c, d) {
                b[(d ? "add" : "remove") + "Class"](a, "pswp__" + c)
            },
            D = function() {
                var a = 1 === q.getNumItemsFn();
                a !== p && (C(d, "ui--one-slide", a), p = a)
            },
            E = function() {
                C(i, "share-modal--hidden", y)
            },
            F = function() {
                return y = !y, y ? (b.removeClass(i, "pswp__share-modal--fade-in"), setTimeout(function() {
                    y && E()
                }, 300)) : (E(), setTimeout(function() {
                    y || b.addClass(i, "pswp__share-modal--fade-in")
                }, 30)), y || H(), !1
            },
            G = function(b) {
                b = b || window.event;
                var c = b.target || b.srcElement;
                return a.shout("shareLinkClick", b, c), c.href ? c.hasAttribute("download") ? !0 : (window.open(c.href, "pswp_share", "scrollbars=yes,resizable=yes,toolbar=no,location=yes,width=550,height=420,top=100,left=" + (window.screen ? Math.round(screen.width / 2 - 275) : 100)), y || F(), !1) : !1
            },
            H = function() {
                for (var a, b, c, d, e, f = "", g = 0; g < q.shareButtons.length; g++) a = q.shareButtons[g], c = q.getImageURLForShare(a), d = q.getPageURLForShare(a), e = q.getTextForShare(a), b = a.url.replace("{{url}}", encodeURIComponent(d)).replace("{{image_url}}", encodeURIComponent(c)).replace("{{raw_image_url}}", c).replace("{{text}}", encodeURIComponent(e)), f += '<a href="' + b + '" target="_blank" class="pswp__share--' + a.id + '"' + (a.download ? "download" : "") + ">" + a.label + "</a>", q.parseShareButtonOut && (f = q.parseShareButtonOut(a, f));
                i.children[0].innerHTML = f, i.children[0].onclick = G
            },
            I = function(a) {
                for (var c = 0; c < q.closeElClasses.length; c++)
                    if (b.hasClass(a, "pswp__" + q.closeElClasses[c])) return !0
            },
            J = 0,
            K = function() {
                clearTimeout(u), J = 0, k && v.setIdle(!1)
            },
            L = function(a) {
                a = a ? a : window.event;
                var b = a.relatedTarget || a.toElement;
                b && "HTML" !== b.nodeName || (clearTimeout(u), u = setTimeout(function() {
                    v.setIdle(!0)
                }, q.timeToIdleOutside))
            },
            M = function() {
                q.fullscreenEl && (c || (c = v.getFullscreenAPI()), c ? (b.bind(document, c.eventK, v.updateFullscreen), v.updateFullscreen(), b.addClass(a.template, "pswp--supports-fs")) : b.removeClass(a.template, "pswp--supports-fs"))
            },
            N = function() {
                q.preloaderEl && (O(!0), l("beforeChange", function() {
                    clearTimeout(o), o = setTimeout(function() {
                        a.currItem && a.currItem.loading ? (!a.allowProgressiveImg() || a.currItem.img && !a.currItem.img.naturalWidth) && O(!1) : O(!0)
                    }, q.loadingIndicatorDelay)
                }), l("imageLoadComplete", function(b, c) {
                    a.currItem === c && O(!0)
                }))
            },
            O = function(a) {
                n !== a && (C(m, "preloader--active", !a), n = a)
            },
            P = function(a) {
                var c = a.vGap;
                if (B()) {
                    var g = q.barsSize;
                    if (q.captionEl && "auto" === g.bottom)
                        if (f || (f = b.createEl("pswp__caption pswp__caption--fake"), f.appendChild(b.createEl("pswp__caption__center")), d.insertBefore(f, e), b.addClass(d, "pswp__ui--fit")), q.addCaptionHTMLFn(a, f, !0)) {
                            var h = f.clientHeight;
                            c.bottom = parseInt(h, 10) || 44
                        } else c.bottom = g.top;
                    else c.bottom = "auto" === g.bottom ? 0 : g.bottom;
                    c.top = g.top
                } else c.top = c.bottom = 0
            },
            Q = function() {
                q.timeToIdle && l("mouseUsed", function() {
                    b.bind(document, "mousemove", K), b.bind(document, "mouseout", L), t = setInterval(function() {
                        J++, 2 === J && v.setIdle(!0)
                    }, q.timeToIdle / 2)
                })
            },
            R = function() {
                l("onVerticalDrag", function(a) {
                    x && .95 > a ? v.hideControls() : !x && a >= .95 && v.showControls()
                });
                var a;
                l("onPinchClose", function(b) {
                    x && .9 > b ? (v.hideControls(), a = !0) : a && !x && b > .9 && v.showControls()
                }), l("zoomGestureEnded", function() {
                    a = !1, a && !x && v.showControls()
                })
            },
            S = [{
                name: "caption",
                option: "captionEl",
                onInit: function(a) {
                    e = a
                }
            }, {
                name: "share-modal",
                option: "shareEl",
                onInit: function(a) {
                    i = a
                },
                onTap: function() {
                    F()
                }
            }, {
                name: "button--share",
                option: "shareEl",
                onInit: function(a) {
                    h = a
                },
                onTap: function() {
                    F()
                }
            }, {
                name: "button--zoom",
                option: "zoomEl",
                onTap: a.toggleDesktopZoom
            }, {
                name: "counter",
                option: "counterEl",
                onInit: function(a) {
                    g = a
                }
            }, {
                name: "button--close",
                option: "closeEl",
                onTap: a.close
            }, {
                name: "button--arrow--left",
                option: "arrowEl",
                onTap: a.prev
            }, {
                name: "button--arrow--right-columns",
                option: "arrowEl",
                onTap: a.next
            }, {
                name: "button--fs",
                option: "fullscreenEl",
                onTap: function() {
                    c.isFullscreen() ? c.exit() : c.enter()
                }
            }, {
                name: "preloader",
                option: "preloaderEl",
                onInit: function(a) {
                    m = a
                }
            }],
            T = function() {
                var a, c, e, f = function(d) {
                    if (d)
                        for (var f = d.length, g = 0; f > g; g++) {
                            a = d[g], c = a.className;
                            for (var h = 0; h < S.length; h++) e = S[h], c.indexOf("pswp__" + e.name) > -1 && (q[e.option] ? (b.removeClass(a, "pswp__element--disabled"), e.onInit && e.onInit(a)) : b.addClass(a, "pswp__element--disabled"))
                        }
                };
                f(d.children);
                var g = b.getChildByClass(d, "pswp__top-bar");
                g && f(g.children)
            };
        v.init = function() {
            b.extend(a.options, z, !0), q = a.options, d = b.getChildByClass(a.scrollWrap, "pswp__ui"), l = a.listen, R(), l("beforeChange", v.update), l("doubleTap", function(b) {
                var c = a.currItem.initialZoomLevel;
                a.getZoomLevel() !== c ? a.zoomTo(c, b, 333) : a.zoomTo(q.getDoubleTapZoom(!1, a.currItem), b, 333)
            }), l("preventDragEvent", function(a, b, c) {
                var d = a.target || a.srcElement;
                d && d.className && a.type.indexOf("mouse") > -1 && (d.className.indexOf("__caption") > 0 || /(SMALL|STRONG|EM)/i.test(d.tagName)) && (c.prevent = !1)
            }), l("bindEvents", function() {
                b.bind(d, "pswpTap click", A), b.bind(a.scrollWrap, "pswpTap", v.onGlobalTap), a.likelyTouchDevice || b.bind(a.scrollWrap, "mouseover", v.onMouseOver)
            }), l("unbindEvents", function() {
                y || F(), t && clearInterval(t), b.unbind(document, "mouseout", L), b.unbind(document, "mousemove", K), b.unbind(d, "pswpTap click", A), b.unbind(a.scrollWrap, "pswpTap", v.onGlobalTap), b.unbind(a.scrollWrap, "mouseover", v.onMouseOver), c && (b.unbind(document, c.eventK, v.updateFullscreen), c.isFullscreen() && (q.hideAnimationDuration = 0, c.exit()), c = null)
            }), l("destroy", function() {
                q.captionEl && (f && d.removeChild(f), b.removeClass(e, "pswp__caption--empty")), i && (i.children[0].onclick = null), b.removeClass(d, "pswp__ui--over-close"), b.addClass(d, "pswp__ui--hidden"), v.setIdle(!1)
            }), q.showAnimationDuration || b.removeClass(d, "pswp__ui--hidden"), l("initialZoomIn", function() {
                q.showAnimationDuration && b.removeClass(d, "pswp__ui--hidden")
            }), l("initialZoomOut", function() {
                b.addClass(d, "pswp__ui--hidden")
            }), l("parseVerticalMargin", P), T(), q.shareEl && h && i && (y = !0), D(), Q(), M(), N()
        }, v.setIdle = function(a) {
            k = a, C(d, "ui--idle", a)
        }, v.update = function() {
            x && a.currItem ? (v.updateIndexIndicator(), q.captionEl && (q.addCaptionHTMLFn(a.currItem, e), C(e, "caption--empty", !a.currItem.title)), w = !0) : w = !1, y || F(), D()
        }, v.updateFullscreen = function(d) {
            d && setTimeout(function() {
                a.setScrollOffset(0, b.getScrollY())
            }, 50), b[(c.isFullscreen() ? "add" : "remove") + "Class"](a.template, "pswp--fs")
        }, v.updateIndexIndicator = function() {
            q.counterEl && (g.innerHTML = a.getCurrentIndex() + 1 + q.indexIndicatorSep + q.getNumItemsFn())
        }, v.onGlobalTap = function(c) {
            c = c || window.event;
            var d = c.target || c.srcElement;
            if (!r)
                if (c.detail && "mouse" === c.detail.pointerType) {
                    if (I(d)) return void a.close();
                    b.hasClass(d, "pswp__img") && (1 === a.getZoomLevel() && a.getZoomLevel() <= a.currItem.fitRatio ? q.clickToCloseNonZoomable && a.close() : a.toggleDesktopZoom(c.detail.releasePoint))
                } else if (q.tapToToggleControls && (x ? v.hideControls() : v.showControls()), q.tapToClose && (b.hasClass(d, "pswp__img") || I(d))) return void a.close()
        }, v.onMouseOver = function(a) {
            a = a || window.event;
            var b = a.target || a.srcElement;
            C(d, "ui--over-close", I(b))
        }, v.hideControls = function() {
            b.addClass(d, "pswp__ui--hidden"), x = !1
        }, v.showControls = function() {
            x = !0, w || v.update(), b.removeClass(d, "pswp__ui--hidden")
        }, v.supportsFullscreen = function() {
            var a = document;
            return !!(a.exitFullscreen || a.mozCancelFullScreen || a.webkitExitFullscreen || a.msExitFullscreen)
        }, v.getFullscreenAPI = function() {
            var b, c = document.documentElement,
                d = "fullscreenchange";
            return c.requestFullscreen ? b = {
                enterK: "requestFullscreen",
                exitK: "exitFullscreen",
                elementK: "fullscreenElement",
                eventK: d
            } : c.mozRequestFullScreen ? b = {
                enterK: "mozRequestFullScreen",
                exitK: "mozCancelFullScreen",
                elementK: "mozFullScreenElement",
                eventK: "moz" + d
            } : c.webkitRequestFullscreen ? b = {
                enterK: "webkitRequestFullscreen",
                exitK: "webkitExitFullscreen",
                elementK: "webkitFullscreenElement",
                eventK: "webkit" + d
            } : c.msRequestFullscreen && (b = {
                    enterK: "msRequestFullscreen",
                    exitK: "msExitFullscreen",
                    elementK: "msFullscreenElement",
                    eventK: "MSFullscreenChange"
                }), b && (b.enter = function() {
                return j = q.closeOnScroll, q.closeOnScroll = !1, "webkitRequestFullscreen" !== this.enterK ? a.template[this.enterK]() : void a.template[this.enterK](Element.ALLOW_KEYBOARD_INPUT)
            }, b.exit = function() {
                return q.closeOnScroll = j, document[this.exitK]()
            }, b.isFullscreen = function() {
                return document[this.elementK]
            }), b
        }
    };
    return a
}), ! function(a) {
    "use strict";
    "function" == typeof define && define.amd ? define(["jquery"], a) : "undefined" != typeof exports ? module.exports = a(require("jquery")) : a(jQuery)
}(function(a) {
    "use strict";
    var b = window.Slick || {};
    b = function() {
        function b(b, d) {
            var e, f, g, h = this;
            if (h.defaults = {
                    accessibility: !0,
                    adaptiveHeight: !1,
                    appendArrows: a(b),
                    appendDots: a(b),
                    arrows: !0,
                    asNavFor: null,
                    prevArrow: '<button type="button" data-role="none" class="slick-prev">Previous</button>',
                    nextArrow: '<button type="button" data-role="none" class="slick-next">Next</button>',
                    autoplay: !1,
                    autoplaySpeed: 3e3,
                    centerMode: !1,
                    centerPadding: "50px",
                    cssEase: "ease",
                    customPaging: function(a, b) {
                        return '<button type="button" data-role="none">' + (b + 1) + "</button>"
                    },
                    dots: !1,
                    dotsClass: "slick-dots",
                    draggable: !0,
                    easing: "linear",
                    edgeFriction: .35,
                    fade: !1,
                    focusOnSelect: !1,
                    infinite: !0,
                    initialSlide: 0,
                    lazyLoad: "ondemand",
                    mobileFirst: !1,
                    pauseOnHover: !0,
                    pauseOnDotsHover: !1,
                    respondTo: "window",
                    responsive: null,
                    rtl: !1,
                    slide: "",
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    speed: 500,
                    swipe: !0,
                    swipeToSlide: !1,
                    touchMove: !0,
                    touchThreshold: 5,
                    useCSS: !0,
                    variableWidth: !1,
                    vertical: !1,
                    waitForAnimate: !0
                }, h.initials = {
                    animating: !1,
                    dragging: !1,
                    autoPlayTimer: null,
                    currentDirection: 0,
                    currentLeft: null,
                    currentSlide: 0,
                    direction: 1,
                    $dots: null,
                    listWidth: null,
                    listHeight: null,
                    loadIndex: 0,
                    $nextArrow: null,
                    $prevArrow: null,
                    slideCount: null,
                    slideWidth: null,
                    $slideTrack: null,
                    $slides: null,
                    sliding: !1,
                    slideOffset: 0,
                    swipeLeft: null,
                    $list: null,
                    touchObject: {},
                    transformsEnabled: !1
                }, a.extend(h, h.initials), h.activeBreakpoint = null, h.animType = null, h.animProp = null, h.breakpoints = [], h.breakpointSettings = [], h.cssTransitions = !1, h.hidden = "hidden", h.paused = !1, h.positionProp = null, h.respondTo = null, h.shouldClick = !0, h.$slider = a(b), h.$slidesCache = null, h.transformType = null, h.transitionType = null, h.visibilityChange = "visibilitychange", h.windowWidth = 0, h.windowTimer = null, e = a(b).data("slick") || {}, h.options = a.extend({}, h.defaults, e, d), h.currentSlide = h.options.initialSlide, h.originalSettings = h.options, f = h.options.responsive || null, f && f.length > -1) {
                h.respondTo = h.options.respondTo || "window";
                for (g in f) f.hasOwnProperty(g) && (h.breakpoints.push(f[g].breakpoint), h.breakpointSettings[f[g].breakpoint] = f[g].settings);
                h.breakpoints.sort(function(a, b) {
                    return h.options.mobileFirst === !0 ? a - b : b - a
                })
            }
            "undefined" != typeof document.mozHidden ? (h.hidden = "mozHidden", h.visibilityChange = "mozvisibilitychange") : "undefined" != typeof document.msHidden ? (h.hidden = "msHidden", h.visibilityChange = "msvisibilitychange") : "undefined" != typeof document.webkitHidden && (h.hidden = "webkitHidden", h.visibilityChange = "webkitvisibilitychange"), h.autoPlay = a.proxy(h.autoPlay, h), h.autoPlayClear = a.proxy(h.autoPlayClear, h), h.changeSlide = a.proxy(h.changeSlide, h), h.clickHandler = a.proxy(h.clickHandler, h), h.selectHandler = a.proxy(h.selectHandler, h), h.setPosition = a.proxy(h.setPosition, h), h.swipeHandler = a.proxy(h.swipeHandler, h), h.dragHandler = a.proxy(h.dragHandler, h), h.keyHandler = a.proxy(h.keyHandler, h), h.autoPlayIterator = a.proxy(h.autoPlayIterator, h), h.instanceUid = c++, h.htmlExpr = /^(?:\s*(<[\w\W]+>)[^>]*)$/, h.init(), h.checkResponsive(!0)
        }
        var c = 0;
        return b
    }(), b.prototype.addSlide = b.prototype.slickAdd = function(b, c, d) {
        var e = this;
        if ("boolean" == typeof c) d = c, c = null;
        else if (0 > c || c >= e.slideCount) return !1;
        e.unload(), "number" == typeof c ? 0 === c && 0 === e.$slides.length ? a(b).appendTo(e.$slideTrack) : d ? a(b).insertBefore(e.$slides.eq(c)) : a(b).insertAfter(e.$slides.eq(c)) : d === !0 ? a(b).prependTo(e.$slideTrack) : a(b).appendTo(e.$slideTrack), e.$slides = e.$slideTrack.children(this.options.slide), e.$slideTrack.children(this.options.slide).detach(), e.$slideTrack.append(e.$slides), e.$slides.each(function(b, c) {
            a(c).attr("data-slick-index", b)
        }), e.$slidesCache = e.$slides, e.reinit()
    }, b.prototype.animateHeight = function() {
        var a = this;
        if (1 === a.options.slidesToShow && a.options.adaptiveHeight === !0 && a.options.vertical === !1) {
            var b = a.$slides.eq(a.currentSlide).outerHeight(!0);
            a.$list.animate({
                height: b
            }, a.options.speed)
        }
    }, b.prototype.animateSlide = function(b, c) {
        var d = {},
            e = this;
        e.animateHeight(), e.options.rtl === !0 && e.options.vertical === !1 && (b = -b), e.transformsEnabled === !1 ? e.options.vertical === !1 ? e.$slideTrack.animate({
            left: b
        }, e.options.speed, e.options.easing, c) : e.$slideTrack.animate({
            top: b
        }, e.options.speed, e.options.easing, c) : e.cssTransitions === !1 ? (e.options.rtl === !0 && (e.currentLeft = -e.currentLeft), a({
            animStart: e.currentLeft
        }).animate({
            animStart: b
        }, {
            duration: e.options.speed,
            easing: e.options.easing,
            step: function(a) {
                a = Math.ceil(a), e.options.vertical === !1 ? (d[e.animType] = "translate(" + a + "px, 0px)", e.$slideTrack.css(d)) : (d[e.animType] = "translate(0px," + a + "px)", e.$slideTrack.css(d))
            },
            complete: function() {
                c && c.call()
            }
        })) : (e.applyTransition(), b = Math.ceil(b), d[e.animType] = e.options.vertical === !1 ? "translate3d(" + b + "px, 0px, 0px)" : "translate3d(0px," + b + "px, 0px)", e.$slideTrack.css(d), c && setTimeout(function() {
            e.disableTransition(), c.call()
        }, e.options.speed))
    }, b.prototype.asNavFor = function(b) {
        var c = this,
            d = null !== c.options.asNavFor ? a(c.options.asNavFor).slick("getSlick") : null;
        null !== d && d.slideHandler(b, !0)
    }, b.prototype.applyTransition = function(a) {
        var b = this,
            c = {};
        c[b.transitionType] = b.options.fade === !1 ? b.transformType + " " + b.options.speed + "ms " + b.options.cssEase : "opacity " + b.options.speed + "ms " + b.options.cssEase, b.options.fade === !1 ? b.$slideTrack.css(c) : b.$slides.eq(a).css(c)
    }, b.prototype.autoPlay = function() {
        var a = this;
        a.autoPlayTimer && clearInterval(a.autoPlayTimer), a.slideCount > a.options.slidesToShow && a.paused !== !0 && (a.autoPlayTimer = setInterval(a.autoPlayIterator, a.options.autoplaySpeed))
    }, b.prototype.autoPlayClear = function() {
        var a = this;
        a.autoPlayTimer && clearInterval(a.autoPlayTimer)
    }, b.prototype.autoPlayIterator = function() {
        var a = this;
        a.options.infinite === !1 ? 1 === a.direction ? (a.currentSlide + 1 === a.slideCount - 1 && (a.direction = 0), a.slideHandler(a.currentSlide + a.options.slidesToScroll)) : (0 === a.currentSlide - 1 && (a.direction = 1), a.slideHandler(a.currentSlide - a.options.slidesToScroll)) : a.slideHandler(a.currentSlide + a.options.slidesToScroll)
    }, b.prototype.buildArrows = function() {
        var b = this;
        b.options.arrows === !0 && b.slideCount > b.options.slidesToShow && (b.$prevArrow = a(b.options.prevArrow), b.$nextArrow = a(b.options.nextArrow), b.htmlExpr.test(b.options.prevArrow) && b.$prevArrow.appendTo(b.options.appendArrows), b.htmlExpr.test(b.options.nextArrow) && b.$nextArrow.appendTo(b.options.appendArrows), b.options.infinite !== !0 && b.$prevArrow.addClass("slick-disabled"))
    }, b.prototype.buildDots = function() {
        var b, c, d = this;
        if (d.options.dots === !0 && d.slideCount > d.options.slidesToShow) {
            for (c = '<ul class="' + d.options.dotsClass + '">', b = 0; b <= d.getDotCount(); b += 1) c += "<li>" + d.options.customPaging.call(this, d, b) + "</li>";
            c += "</ul>", d.$dots = a(c).appendTo(d.options.appendDots), d.$dots.find("li").first().addClass("slick-active")
        }
    }, b.prototype.buildOut = function() {
        var b = this;
        b.$slides = b.$slider.children(b.options.slide + ":not(.slick-cloned)").addClass("slick-slide"), b.slideCount = b.$slides.length, b.$slides.each(function(b, c) {
            a(c).attr("data-slick-index", b)
        }), b.$slidesCache = b.$slides, b.$slider.addClass("slick-slider"), b.$slideTrack = 0 === b.slideCount ? a('<div class="slick-track"/>').appendTo(b.$slider) : b.$slides.wrapAll('<div class="slick-track"/>').parent(), b.$list = b.$slideTrack.wrap('<div class="slick-list"/>').parent(), b.$slideTrack.css("opacity", 0), (b.options.centerMode === !0 || b.options.swipeToSlide === !0) && (b.options.slidesToScroll = 1), a("img[data-lazy]", b.$slider).not("[src]").addClass("slick-loading"), b.setupInfinite(), b.buildArrows(), b.buildDots(), b.updateDots(), b.options.accessibility === !0 && b.$list.prop("tabIndex", 0), b.setSlideClasses("number" == typeof this.currentSlide ? this.currentSlide : 0), b.options.draggable === !0 && b.$list.addClass("draggable")
    }, b.prototype.checkResponsive = function(b) {
        var c, d, e, f = this,
            g = f.$slider.width(),
            h = window.innerWidth || a(window).width();
        if ("window" === f.respondTo ? e = h : "slider" === f.respondTo ? e = g : "min" === f.respondTo && (e = Math.min(h, g)), f.originalSettings.responsive && f.originalSettings.responsive.length > -1 && null !== f.originalSettings.responsive) {
            d = null;
            for (c in f.breakpoints) f.breakpoints.hasOwnProperty(c) && (f.originalSettings.mobileFirst === !1 ? e < f.breakpoints[c] && (d = f.breakpoints[c]) : e > f.breakpoints[c] && (d = f.breakpoints[c]));
            null !== d ? null !== f.activeBreakpoint ? d !== f.activeBreakpoint && (f.activeBreakpoint = d, "unslick" === f.breakpointSettings[d] ? f.unslick() : (f.options = a.extend({}, f.originalSettings, f.breakpointSettings[d]), b === !0 && (f.currentSlide = f.options.initialSlide), f.refresh())) : (f.activeBreakpoint = d, "unslick" === f.breakpointSettings[d] ? f.unslick() : (f.options = a.extend({}, f.originalSettings, f.breakpointSettings[d]), b === !0 && (f.currentSlide = f.options.initialSlide), f.refresh())) : null !== f.activeBreakpoint && (f.activeBreakpoint = null, f.options = f.originalSettings, b === !0 && (f.currentSlide = f.options.initialSlide), f.refresh())
        }
    }, b.prototype.changeSlide = function(b, c) {
        var d, e, f, g = this,
            h = a(b.target);
        switch (h.is("a") && b.preventDefault(), f = 0 !== g.slideCount % g.options.slidesToScroll, d = f ? 0 : (g.slideCount - g.currentSlide) % g.options.slidesToScroll, b.data.message) {
            case "previous":
                e = 0 === d ? g.options.slidesToScroll : g.options.slidesToShow - d, g.slideCount > g.options.slidesToShow && g.slideHandler(g.currentSlide - e, !1, c);
                break;
            case "next":
                e = 0 === d ? g.options.slidesToScroll : d, g.slideCount > g.options.slidesToShow && g.slideHandler(g.currentSlide + e, !1, c);
                break;
            case "index":
                var i = 0 === b.data.index ? 0 : b.data.index || a(b.target).parent().index() * g.options.slidesToScroll;
                g.slideHandler(g.checkNavigable(i), !1, c);
                break;
            default:
                return
        }
    }, b.prototype.checkNavigable = function(a) {
        var b, c, d = this;
        if (b = d.getNavigableIndexes(), c = 0, a > b[b.length - 1]) a = b[b.length - 1];
        else
            for (var e in b) {
                if (a < b[e]) {
                    a = c;
                    break
                }
                c = b[e]
            }
        return a
    }, b.prototype.clickHandler = function(a) {
        var b = this;
        b.shouldClick === !1 && (a.stopImmediatePropagation(), a.stopPropagation(), a.preventDefault())
    }, b.prototype.destroy = function() {
        var b = this;
        b.autoPlayClear(), b.touchObject = {}, a(".slick-cloned", b.$slider).remove(), b.$dots && b.$dots.remove(), b.$prevArrow && "object" != typeof b.options.prevArrow && b.$prevArrow.remove(), b.$nextArrow && "object" != typeof b.options.nextArrow && b.$nextArrow.remove(), b.$slides.removeClass("slick-slide slick-active slick-center slick-visible").removeAttr("data-slick-index").css({
            position: "",
            left: "",
            top: "",
            zIndex: "",
            opacity: "",
            width: ""
        }), b.$slider.removeClass("slick-slider"), b.$slider.removeClass("slick-initialized"), b.$list.off(".slick"), a(window).off(".slick-" + b.instanceUid), a(document).off(".slick-" + b.instanceUid), b.$slider.html(b.$slides)
    }, b.prototype.disableTransition = function(a) {
        var b = this,
            c = {};
        c[b.transitionType] = "", b.options.fade === !1 ? b.$slideTrack.css(c) : b.$slides.eq(a).css(c)
    }, b.prototype.fadeSlide = function(a, b) {
        var c = this;
        c.cssTransitions === !1 ? (c.$slides.eq(a).css({
            zIndex: 1e3
        }), c.$slides.eq(a).animate({
            opacity: 1
        }, c.options.speed, c.options.easing, b)) : (c.applyTransition(a), c.$slides.eq(a).css({
            opacity: 1,
            zIndex: 1e3
        }), b && setTimeout(function() {
            c.disableTransition(a), b.call()
        }, c.options.speed))
    }, b.prototype.filterSlides = b.prototype.slickFilter = function(a) {
        var b = this;
        null !== a && (b.unload(), b.$slideTrack.children(this.options.slide).detach(), b.$slidesCache.filter(a).appendTo(b.$slideTrack), b.reinit())
    }, b.prototype.getCurrent = b.prototype.slickCurrentSlide = function() {
        var a = this;
        return a.currentSlide
    }, b.prototype.getDotCount = function() {
        var a = this,
            b = 0,
            c = 0,
            d = 0;
        if (a.options.infinite === !0) d = Math.ceil(a.slideCount / a.options.slidesToScroll);
        else if (a.options.centerMode === !0) d = a.slideCount;
        else
            for (; b < a.slideCount;) ++d, b = c + a.options.slidesToShow, c += a.options.slidesToScroll <= a.options.slidesToShow ? a.options.slidesToScroll : a.options.slidesToShow;
        return d - 1
    }, b.prototype.getLeft = function(a) {
        var b, c, d, e = this,
            f = 0;
        return e.slideOffset = 0, c = e.$slides.first().outerHeight(), e.options.infinite === !0 ? (e.slideCount > e.options.slidesToShow && (e.slideOffset = -1 * e.slideWidth * e.options.slidesToShow, f = -1 * c * e.options.slidesToShow), 0 !== e.slideCount % e.options.slidesToScroll && a + e.options.slidesToScroll > e.slideCount && e.slideCount > e.options.slidesToShow && (a > e.slideCount ? (e.slideOffset = -1 * (e.options.slidesToShow - (a - e.slideCount)) * e.slideWidth, f = -1 * (e.options.slidesToShow - (a - e.slideCount)) * c) : (e.slideOffset = -1 * e.slideCount % e.options.slidesToScroll * e.slideWidth, f = -1 * e.slideCount % e.options.slidesToScroll * c))) : a + e.options.slidesToShow > e.slideCount && (e.slideOffset = (a + e.options.slidesToShow - e.slideCount) * e.slideWidth, f = (a + e.options.slidesToShow - e.slideCount) * c), e.slideCount <= e.options.slidesToShow && (e.slideOffset = 0, f = 0), e.options.centerMode === !0 && e.options.infinite === !0 ? e.slideOffset += e.slideWidth * Math.floor(e.options.slidesToShow / 2) - e.slideWidth : e.options.centerMode === !0 && (e.slideOffset = 0, e.slideOffset += e.slideWidth * Math.floor(e.options.slidesToShow / 2)), b = e.options.vertical === !1 ? -1 * a * e.slideWidth + e.slideOffset : -1 * a * c + f, e.options.variableWidth === !0 && (d = e.slideCount <= e.options.slidesToShow || e.options.infinite === !1 ? e.$slideTrack.children(".slick-slide").eq(a) : e.$slideTrack.children(".slick-slide").eq(a + e.options.slidesToShow), b = d[0] ? -1 * d[0].offsetLeft : 0, e.options.centerMode === !0 && (d = e.options.infinite === !1 ? e.$slideTrack.children(".slick-slide").eq(a) : e.$slideTrack.children(".slick-slide").eq(a + e.options.slidesToShow + 1), b = d[0] ? -1 * d[0].offsetLeft : 0, b += (e.$list.width() - d.outerWidth()) / 2)), b
    }, b.prototype.getOption = b.prototype.slickGetOption = function(a) {
        var b = this;
        return b.options[a]
    }, b.prototype.getNavigableIndexes = function() {
        var a, b = this,
            c = 0,
            d = 0,
            e = [];
        for (b.options.infinite === !1 ? (a = b.slideCount - b.options.slidesToShow + 1, b.options.centerMode === !0 && (a = b.slideCount)) : (c = -1 * b.slideCount, d = -1 * b.slideCount, a = 2 * b.slideCount); a > c;) e.push(c), c = d + b.options.slidesToScroll, d += b.options.slidesToScroll <= b.options.slidesToShow ? b.options.slidesToScroll : b.options.slidesToShow;
        return e
    }, b.prototype.getSlick = function() {
        return this
    }, b.prototype.getSlideCount = function() {
        var b, c, d, e = this;
        return d = e.options.centerMode === !0 ? e.slideWidth * Math.floor(e.options.slidesToShow / 2) : 0, e.options.swipeToSlide === !0 ? (e.$slideTrack.find(".slick-slide").each(function(b, f) {
            return f.offsetLeft - d + a(f).outerWidth() / 2 > -1 * e.swipeLeft ? (c = f, !1) : void 0
        }), b = Math.abs(a(c).attr("data-slick-index") - e.currentSlide) || 1) : e.options.slidesToScroll
    }, b.prototype.goTo = b.prototype.slickGoTo = function(a, b) {
        var c = this;
        c.changeSlide({
            data: {
                message: "index",
                index: parseInt(a)
            }
        }, b)
    }, b.prototype.init = function() {
        var b = this;
        a(b.$slider).hasClass("slick-initialized") || (a(b.$slider).addClass("slick-initialized"), b.buildOut(), b.setProps(), b.startLoad(), b.loadSlider(), b.initializeEvents(), b.updateArrows(), b.updateDots()), b.$slider.trigger("init", [b])
    }, b.prototype.initArrowEvents = function() {
        var a = this;
        a.options.arrows === !0 && a.slideCount > a.options.slidesToShow && (a.$prevArrow.on("click.slick", {
            message: "previous"
        }, a.changeSlide), a.$nextArrow.on("click.slick", {
            message: "next"
        }, a.changeSlide))
    }, b.prototype.initDotEvents = function() {
        var b = this;
        b.options.dots === !0 && b.slideCount > b.options.slidesToShow && a("li", b.$dots).on("click.slick", {
            message: "index"
        }, b.changeSlide), b.options.dots === !0 && b.options.pauseOnDotsHover === !0 && b.options.autoplay === !0 && a("li", b.$dots).on("mouseenter.slick", function() {
            b.paused = !0, b.autoPlayClear()
        }).on("mouseleave.slick", function() {
            b.paused = !1, b.autoPlay()
        })
    }, b.prototype.initializeEvents = function() {
        var b = this;
        b.initArrowEvents(), b.initDotEvents(), b.$list.on("touchstart.slick mousedown.slick", {
            action: "start"
        }, b.swipeHandler), b.$list.on("touchmove.slick mousemove.slick", {
            action: "move"
        }, b.swipeHandler), b.$list.on("touchend.slick mouseup.slick", {
            action: "end"
        }, b.swipeHandler), b.$list.on("touchcancel.slick mouseleave.slick", {
            action: "end"
        }, b.swipeHandler), b.$list.on("click.slick", b.clickHandler), b.options.autoplay === !0 && (a(document).on(b.visibilityChange, function() {
            b.visibility()
        }), b.options.pauseOnHover === !0 && (b.$list.on("mouseenter.slick", function() {
            b.paused = !0, b.autoPlayClear()
        }), b.$list.on("mouseleave.slick", function() {
            b.paused = !1, b.autoPlay()
        }))), b.options.accessibility === !0 && b.$list.on("keydown.slick", b.keyHandler), b.options.focusOnSelect === !0 && a(b.$slideTrack).children().on("click.slick", b.selectHandler), a(window).on("orientationchange.slick.slick-" + b.instanceUid, function() {
            b.checkResponsive(), b.setPosition()
        }), a(window).on("resize.slick.slick-" + b.instanceUid, function() {
            a(window).width() !== b.windowWidth && (clearTimeout(b.windowDelay), b.windowDelay = window.setTimeout(function() {
                b.windowWidth = a(window).width(), b.checkResponsive(), b.setPosition()
            }, 50))
        }), a("*[draggable!=true]", b.$slideTrack).on("dragstart", function(a) {
            a.preventDefault()
        }), a(window).on("load.slick.slick-" + b.instanceUid, b.setPosition), a(document).on("ready.slick.slick-" + b.instanceUid, b.setPosition)
    }, b.prototype.initUI = function() {
        var a = this;
        a.options.arrows === !0 && a.slideCount > a.options.slidesToShow && (a.$prevArrow.show(), a.$nextArrow.show()), a.options.dots === !0 && a.slideCount > a.options.slidesToShow && a.$dots.show(), a.options.autoplay === !0 && a.autoPlay()
    }, b.prototype.keyHandler = function(a) {
        var b = this;
        37 === a.keyCode && b.options.accessibility === !0 ? b.changeSlide({
            data: {
                message: "previous"
            }
        }) : 39 === a.keyCode && b.options.accessibility === !0 && b.changeSlide({
                data: {
                    message: "next"
                }
            })
    }, b.prototype.lazyLoad = function() {
        function b(b) {
            a("img[data-lazy]", b).each(function() {
                var b = a(this),
                    c = a(this).attr("data-lazy");
                b.load(function() {
                    b.animate({
                        opacity: 1
                    }, 200)
                }).css({
                    opacity: 0
                }).attr("src", c).removeAttr("data-lazy").removeClass("slick-loading")
            })
        }
        var c, d, e, f, g = this;
        g.options.centerMode === !0 ? g.options.infinite === !0 ? (e = g.currentSlide + (g.options.slidesToShow / 2 + 1), f = e + g.options.slidesToShow + 2) : (e = Math.max(0, g.currentSlide - (g.options.slidesToShow / 2 + 1)), f = 2 + (g.options.slidesToShow / 2 + 1) + g.currentSlide) : (e = g.options.infinite ? g.options.slidesToShow + g.currentSlide : g.currentSlide, f = e + g.options.slidesToShow, g.options.fade === !0 && (e > 0 && e--, f <= g.slideCount && f++)), c = g.$slider.find(".slick-slide").slice(e, f), b(c), g.slideCount <= g.options.slidesToShow ? (d = g.$slider.find(".slick-slide"), b(d)) : g.currentSlide >= g.slideCount - g.options.slidesToShow ? (d = g.$slider.find(".slick-cloned").slice(0, g.options.slidesToShow), b(d)) : 0 === g.currentSlide && (d = g.$slider.find(".slick-cloned").slice(-1 * g.options.slidesToShow), b(d))
    }, b.prototype.loadSlider = function() {
        var a = this;
        a.setPosition(), a.$slideTrack.css({
            opacity: 1
        }), a.$slider.removeClass("slick-loading"), a.initUI(), "progressive" === a.options.lazyLoad && a.progressiveLazyLoad()
    }, b.prototype.next = b.prototype.slickNext = function() {
        var a = this;
        a.changeSlide({
            data: {
                message: "next"
            }
        })
    }, b.prototype.pause = b.prototype.slickPause = function() {
        var a = this;
        a.autoPlayClear(), a.paused = !0
    }, b.prototype.play = b.prototype.slickPlay = function() {
        var a = this;
        a.paused = !1, a.autoPlay()
    }, b.prototype.postSlide = function(a) {
        var b = this;
        b.$slider.trigger("afterChange", [b, a]), b.animating = !1, b.setPosition(), b.swipeLeft = null, b.options.autoplay === !0 && b.paused === !1 && b.autoPlay()
    }, b.prototype.prev = b.prototype.slickPrev = function() {
        var a = this;
        a.changeSlide({
            data: {
                message: "previous"
            }
        })
    }, b.prototype.progressiveLazyLoad = function() {
        var b, c, d = this;
        b = a("img[data-lazy]", d.$slider).length, b > 0 && (c = a("img[data-lazy]", d.$slider).first(), c.attr("src", c.attr("data-lazy")).removeClass("slick-loading").load(function() {
            c.removeAttr("data-lazy"), d.progressiveLazyLoad()
        }).error(function() {
            c.removeAttr("data-lazy"), d.progressiveLazyLoad()
        }))
    }, b.prototype.refresh = function() {
        var b = this,
            c = b.currentSlide;
        b.destroy(), a.extend(b, b.initials), b.init(), b.changeSlide({
            data: {
                message: "index",
                index: c
            }
        }, !0)
    }, b.prototype.reinit = function() {
        var b = this;
        b.$slides = b.$slideTrack.children(b.options.slide).addClass("slick-slide"), b.slideCount = b.$slides.length, b.currentSlide >= b.slideCount && 0 !== b.currentSlide && (b.currentSlide = b.currentSlide - b.options.slidesToScroll), b.slideCount <= b.options.slidesToShow && (b.currentSlide = 0), b.setProps(), b.setupInfinite(), b.buildArrows(), b.updateArrows(), b.initArrowEvents(), b.buildDots(), b.updateDots(), b.initDotEvents(), b.options.focusOnSelect === !0 && a(b.$slideTrack).children().on("click.slick", b.selectHandler), b.setSlideClasses(0), b.setPosition(), b.$slider.trigger("reInit", [b])
    }, b.prototype.removeSlide = b.prototype.slickRemove = function(a, b, c) {
        var d = this;
        return "boolean" == typeof a ? (b = a, a = b === !0 ? 0 : d.slideCount - 1) : a = b === !0 ? --a : a, d.slideCount < 1 || 0 > a || a > d.slideCount - 1 ? !1 : (d.unload(), c === !0 ? d.$slideTrack.children().remove() : d.$slideTrack.children(this.options.slide).eq(a).remove(), d.$slides = d.$slideTrack.children(this.options.slide), d.$slideTrack.children(this.options.slide).detach(), d.$slideTrack.append(d.$slides), d.$slidesCache = d.$slides, void d.reinit())
    }, b.prototype.setCSS = function(a) {
        var b, c, d = this,
            e = {};
        d.options.rtl === !0 && (a = -a), b = "left" == d.positionProp ? Math.ceil(a) + "px" : "0px", c = "top" == d.positionProp ? Math.ceil(a) + "px" : "0px", e[d.positionProp] = a, d.transformsEnabled === !1 ? d.$slideTrack.css(e) : (e = {}, d.cssTransitions === !1 ? (e[d.animType] = "translate(" + b + ", " + c + ")", d.$slideTrack.css(e)) : (e[d.animType] = "translate3d(" + b + ", " + c + ", 0px)", d.$slideTrack.css(e)))
    }, b.prototype.setDimensions = function() {
        var a = this;
        if (a.options.vertical === !1 ? a.options.centerMode === !0 && a.$list.css({
                    padding: "0px " + a.options.centerPadding
                }) : (a.$list.height(a.$slides.first().outerHeight(!0) * a.options.slidesToShow), a.options.centerMode === !0 && a.$list.css({
                padding: a.options.centerPadding + " 0px"
            })), a.listWidth = a.$list.width(), a.listHeight = a.$list.height(), a.options.vertical === !1 && a.options.variableWidth === !1) a.slideWidth = Math.ceil(a.listWidth / a.options.slidesToShow), a.$slideTrack.width(Math.ceil(a.slideWidth * a.$slideTrack.children(".slick-slide").length));
        else if (a.options.variableWidth === !0) {
            var b = 0;
            a.slideWidth = Math.ceil(a.listWidth / a.options.slidesToShow), a.$slideTrack.children(".slick-slide").each(function() {
                b += a.listWidth
            }), a.$slideTrack.width(Math.ceil(b) + 1)
        } else a.slideWidth = Math.ceil(a.listWidth), a.$slideTrack.height(Math.ceil(a.$slides.first().outerHeight(!0) * a.$slideTrack.children(".slick-slide").length));
        var c = a.$slides.first().outerWidth(!0) - a.$slides.first().width();
        a.options.variableWidth === !1 && a.$slideTrack.children(".slick-slide").width(a.slideWidth - c)
    }, b.prototype.setFade = function() {
        var b, c = this;
        c.$slides.each(function(d, e) {
            b = -1 * c.slideWidth * d, c.options.rtl === !0 ? a(e).css({
                position: "relative",
                right: b,
                top: 0,
                zIndex: 800,
                opacity: 0
            }) : a(e).css({
                position: "relative",
                left: b,
                top: 0,
                zIndex: 800,
                opacity: 0
            })
        }), c.$slides.eq(c.currentSlide).css({
            zIndex: 900,
            opacity: 1
        })
    }, b.prototype.setHeight = function() {
        var a = this;
        if (1 === a.options.slidesToShow && a.options.adaptiveHeight === !0 && a.options.vertical === !1) {
            var b = a.$slides.eq(a.currentSlide).outerHeight(!0);
            a.$list.css("height", b)
        }
    }, b.prototype.setOption = b.prototype.slickSetOption = function(a, b, c) {
        var d = this;
        d.options[a] = b, c === !0 && (d.unload(), d.reinit())
    }, b.prototype.setPosition = function() {
        var a = this;
        a.setDimensions(), a.setHeight(), a.options.fade === !1 ? a.setCSS(a.getLeft(a.currentSlide)) : a.setFade(), a.$slider.trigger("setPosition", [a])
    }, b.prototype.setProps = function() {
        var a = this,
            b = document.body.style;
        a.positionProp = a.options.vertical === !0 ? "top" : "left", "top" === a.positionProp ? a.$slider.addClass("slick-vertical") : a.$slider.removeClass("slick-vertical"), (void 0 !== b.WebkitTransition || void 0 !== b.MozTransition || void 0 !== b.msTransition) && a.options.useCSS === !0 && (a.cssTransitions = !0), void 0 !== b.OTransform && (a.animType = "OTransform", a.transformType = "-o-transform", a.transitionType = "OTransition",
        void 0 === b.perspectiveProperty && void 0 === b.webkitPerspective && (a.animType = !1)), void 0 !== b.MozTransform && (a.animType = "MozTransform", a.transformType = "-moz-transform", a.transitionType = "MozTransition", void 0 === b.perspectiveProperty && void 0 === b.MozPerspective && (a.animType = !1)), void 0 !== b.webkitTransform && (a.animType = "webkitTransform", a.transformType = "-webkit-transform", a.transitionType = "webkitTransition", void 0 === b.perspectiveProperty && void 0 === b.webkitPerspective && (a.animType = !1)), void 0 !== b.msTransform && (a.animType = "msTransform", a.transformType = "-ms-transform", a.transitionType = "msTransition", void 0 === b.msTransform && (a.animType = !1)), void 0 !== b.transform && a.animType !== !1 && (a.animType = "transform", a.transformType = "transform", a.transitionType = "transition"), a.transformsEnabled = null !== a.animType && a.animType !== !1
    }, b.prototype.setSlideClasses = function(a) {
        var b, c, d, e, f = this;
        f.$slider.find(".slick-slide").removeClass("slick-active").removeClass("slick-center"), c = f.$slider.find(".slick-slide"), f.options.centerMode === !0 ? (b = Math.floor(f.options.slidesToShow / 2), f.options.infinite === !0 && (a >= b && a <= f.slideCount - 1 - b ? f.$slides.slice(a - b, a + b + 1).addClass("slick-active") : (d = f.options.slidesToShow + a, c.slice(d - b + 1, d + b + 2).addClass("slick-active")), 0 === a ? c.eq(c.length - 1 - f.options.slidesToShow).addClass("slick-center") : a === f.slideCount - 1 && c.eq(f.options.slidesToShow).addClass("slick-center")), f.$slides.eq(a).addClass("slick-center")) : a >= 0 && a <= f.slideCount - f.options.slidesToShow ? f.$slides.slice(a, a + f.options.slidesToShow).addClass("slick-active") : c.length <= f.options.slidesToShow ? c.addClass("slick-active") : (e = f.slideCount % f.options.slidesToShow, d = f.options.infinite === !0 ? f.options.slidesToShow + a : a, f.options.slidesToShow == f.options.slidesToScroll && f.slideCount - a < f.options.slidesToShow ? c.slice(d - (f.options.slidesToShow - e), d + e).addClass("slick-active") : c.slice(d, d + f.options.slidesToShow).addClass("slick-active")), "ondemand" === f.options.lazyLoad && f.lazyLoad()
    }, b.prototype.setupInfinite = function() {
        var b, c, d, e = this;
        if (e.options.fade === !0 && (e.options.centerMode = !1), e.options.infinite === !0 && e.options.fade === !1 && (c = null, e.slideCount > e.options.slidesToShow)) {
            for (d = e.options.centerMode === !0 ? e.options.slidesToShow + 1 : e.options.slidesToShow, b = e.slideCount; b > e.slideCount - d; b -= 1) c = b - 1, a(e.$slides[c]).clone(!0).attr("id", "").attr("data-slick-index", c - e.slideCount).prependTo(e.$slideTrack).addClass("slick-cloned");
            for (b = 0; d > b; b += 1) c = b, a(e.$slides[c]).clone(!0).attr("id", "").attr("data-slick-index", c + e.slideCount).appendTo(e.$slideTrack).addClass("slick-cloned");
            e.$slideTrack.find(".slick-cloned").find("[id]").each(function() {
                a(this).attr("id", "")
            })
        }
    }, b.prototype.selectHandler = function(b) {
        var c = this,
            d = parseInt(a(b.target).parents(".slick-slide").attr("data-slick-index"));
        return d || (d = 0), c.slideCount <= c.options.slidesToShow ? (c.$slider.find(".slick-slide").removeClass("slick-active"), c.$slides.eq(d).addClass("slick-active"), c.options.centerMode === !0 && (c.$slider.find(".slick-slide").removeClass("slick-center"), c.$slides.eq(d).addClass("slick-center")), void c.asNavFor(d)) : void c.slideHandler(d)
    }, b.prototype.slideHandler = function(a, b, c) {
        var d, e, f, g, h = null,
            i = this;
        return b = b || !1, i.animating === !0 && i.options.waitForAnimate === !0 || i.options.fade === !0 && i.currentSlide === a || i.slideCount <= i.options.slidesToShow ? void 0 : (b === !1 && i.asNavFor(a), d = a, h = i.getLeft(d), g = i.getLeft(i.currentSlide), i.currentLeft = null === i.swipeLeft ? g : i.swipeLeft, i.options.infinite === !1 && i.options.centerMode === !1 && (0 > a || a > i.getDotCount() * i.options.slidesToScroll) ? void(i.options.fade === !1 && (d = i.currentSlide, c !== !0 ? i.animateSlide(g, function() {
            i.postSlide(d)
        }) : i.postSlide(d))) : i.options.infinite === !1 && i.options.centerMode === !0 && (0 > a || a > i.slideCount - i.options.slidesToScroll) ? void(i.options.fade === !1 && (d = i.currentSlide, c !== !0 ? i.animateSlide(g, function() {
            i.postSlide(d)
        }) : i.postSlide(d))) : (i.options.autoplay === !0 && clearInterval(i.autoPlayTimer), e = 0 > d ? 0 !== i.slideCount % i.options.slidesToScroll ? i.slideCount - i.slideCount % i.options.slidesToScroll : i.slideCount + d : d >= i.slideCount ? 0 !== i.slideCount % i.options.slidesToScroll ? 0 : d - i.slideCount : d, i.animating = !0, i.$slider.trigger("beforeChange", [i, i.currentSlide, e]), f = i.currentSlide, i.currentSlide = e, i.setSlideClasses(i.currentSlide), i.updateDots(), i.updateArrows(), i.options.fade === !0 ? (c !== !0 ? i.fadeSlide(e, function() {
            i.postSlide(e)
        }) : i.postSlide(e), void i.animateHeight()) : void(c !== !0 ? i.animateSlide(h, function() {
            i.postSlide(e)
        }) : i.postSlide(e))))
    }, b.prototype.startLoad = function() {
        var a = this;
        a.options.arrows === !0 && a.slideCount > a.options.slidesToShow && (a.$prevArrow.hide(), a.$nextArrow.hide()), a.options.dots === !0 && a.slideCount > a.options.slidesToShow && a.$dots.hide(), a.$slider.addClass("slick-loading")
    }, b.prototype.swipeDirection = function() {
        var a, b, c, d, e = this;
        return a = e.touchObject.startX - e.touchObject.curX, b = e.touchObject.startY - e.touchObject.curY, c = Math.atan2(b, a), d = Math.round(180 * c / Math.PI), 0 > d && (d = 360 - Math.abs(d)), 45 >= d && d >= 0 ? e.options.rtl === !1 ? "left" : "right" : 360 >= d && d >= 315 ? e.options.rtl === !1 ? "left" : "right" : d >= 135 && 225 >= d ? e.options.rtl === !1 ? "right" : "left" : "vertical"
    }, b.prototype.swipeEnd = function() {
        var a, b = this;
        if (b.dragging = !1, b.shouldClick = b.touchObject.swipeLength > 10 ? !1 : !0, void 0 === b.touchObject.curX) return !1;
        if (b.touchObject.edgeHit === !0 && b.$slider.trigger("edge", [b, b.swipeDirection()]), b.touchObject.swipeLength >= b.touchObject.minSwipe) switch (b.swipeDirection()) {
            case "left":
                a = b.options.swipeToSlide ? b.checkNavigable(b.currentSlide + b.getSlideCount()) : b.currentSlide + b.getSlideCount(), b.slideHandler(a), b.currentDirection = 0, b.touchObject = {}, b.$slider.trigger("swipe", [b, "left"]);
                break;
            case "right":
                a = b.options.swipeToSlide ? b.checkNavigable(b.currentSlide - b.getSlideCount()) : b.currentSlide - b.getSlideCount(), b.slideHandler(a), b.currentDirection = 1, b.touchObject = {}, b.$slider.trigger("swipe", [b, "right"])
        } else b.touchObject.startX !== b.touchObject.curX && (b.slideHandler(b.currentSlide), b.touchObject = {})
    }, b.prototype.swipeHandler = function(a) {
        var b = this;
        if (!(b.options.swipe === !1 || "ontouchend" in document && b.options.swipe === !1 || b.options.draggable === !1 && -1 !== a.type.indexOf("mouse"))) switch (b.touchObject.fingerCount = a.originalEvent && void 0 !== a.originalEvent.touches ? a.originalEvent.touches.length : 1, b.touchObject.minSwipe = b.listWidth / b.options.touchThreshold, a.data.action) {
            case "start":
                b.swipeStart(a);
                break;
            case "move":
                b.swipeMove(a);
                break;
            case "end":
                b.swipeEnd(a)
        }
    }, b.prototype.swipeMove = function(a) {
        var b, c, d, e, f, g = this;
        return f = void 0 !== a.originalEvent ? a.originalEvent.touches : null, !g.dragging || f && 1 !== f.length ? !1 : (b = g.getLeft(g.currentSlide), g.touchObject.curX = void 0 !== f ? f[0].pageX : a.clientX, g.touchObject.curY = void 0 !== f ? f[0].pageY : a.clientY, g.touchObject.swipeLength = Math.round(Math.sqrt(Math.pow(g.touchObject.curX - g.touchObject.startX, 2))), c = g.swipeDirection(), "vertical" !== c ? (void 0 !== a.originalEvent && g.touchObject.swipeLength > 4 && a.preventDefault(), e = (g.options.rtl === !1 ? 1 : -1) * (g.touchObject.curX > g.touchObject.startX ? 1 : -1), d = g.touchObject.swipeLength, g.touchObject.edgeHit = !1, g.options.infinite === !1 && (0 === g.currentSlide && "right" === c || g.currentSlide >= g.getDotCount() && "left" === c) && (d = g.touchObject.swipeLength * g.options.edgeFriction, g.touchObject.edgeHit = !0), g.swipeLeft = g.options.vertical === !1 ? b + d * e : b + d * (g.$list.height() / g.listWidth) * e, g.options.fade === !0 || g.options.touchMove === !1 ? !1 : g.animating === !0 ? (g.swipeLeft = null, !1) : void g.setCSS(g.swipeLeft)) : void 0)
    }, b.prototype.swipeStart = function(a) {
        var b, c = this;
        return 1 !== c.touchObject.fingerCount || c.slideCount <= c.options.slidesToShow ? (c.touchObject = {}, !1) : (void 0 !== a.originalEvent && void 0 !== a.originalEvent.touches && (b = a.originalEvent.touches[0]), c.touchObject.startX = c.touchObject.curX = void 0 !== b ? b.pageX : a.clientX, c.touchObject.startY = c.touchObject.curY = void 0 !== b ? b.pageY : a.clientY, void(c.dragging = !0))
    }, b.prototype.unfilterSlides = b.prototype.slickUnfilter = function() {
        var a = this;
        null !== a.$slidesCache && (a.unload(), a.$slideTrack.children(this.options.slide).detach(), a.$slidesCache.appendTo(a.$slideTrack), a.reinit())
    }, b.prototype.unload = function() {
        var b = this;
        a(".slick-cloned", b.$slider).remove(), b.$dots && b.$dots.remove(), b.$prevArrow && "object" != typeof b.options.prevArrow && b.$prevArrow.remove(), b.$nextArrow && "object" != typeof b.options.nextArrow && b.$nextArrow.remove(), b.$slides.removeClass("slick-slide slick-active slick-visible").css("width", "")
    }, b.prototype.unslick = function() {
        var a = this;
        a.destroy()
    }, b.prototype.updateArrows = function() {
        var a, b = this;
        a = Math.floor(b.options.slidesToShow / 2), b.options.arrows === !0 && b.options.infinite !== !0 && b.slideCount > b.options.slidesToShow && (b.$prevArrow.removeClass("slick-disabled"), b.$nextArrow.removeClass("slick-disabled"), 0 === b.currentSlide ? (b.$prevArrow.addClass("slick-disabled"), b.$nextArrow.removeClass("slick-disabled")) : b.currentSlide >= b.slideCount - b.options.slidesToShow && b.options.centerMode === !1 ? (b.$nextArrow.addClass("slick-disabled"), b.$prevArrow.removeClass("slick-disabled")) : b.currentSlide >= b.slideCount - 1 && b.options.centerMode === !0 && (b.$nextArrow.addClass("slick-disabled"), b.$prevArrow.removeClass("slick-disabled")))
    }, b.prototype.updateDots = function() {
        var a = this;
        null !== a.$dots && (a.$dots.find("li").removeClass("slick-active"), a.$dots.find("li").eq(Math.floor(a.currentSlide / a.options.slidesToScroll)).addClass("slick-active"))
    }, b.prototype.visibility = function() {
        var a = this;
        document[a.hidden] ? (a.paused = !0, a.autoPlayClear()) : (a.paused = !1, a.autoPlay())
    }, a.fn.slick = function() {
        var a, c = this,
            d = arguments[0],
            e = Array.prototype.slice.call(arguments, 1),
            f = c.length,
            g = 0;
        for (g; f > g; g++)
            if ("object" == typeof d || "undefined" == typeof d ? c[g].slick = new b(c[g], d) : a = c[g].slick[d].apply(c[g].slick, e), "undefined" != typeof a) return a;
        return c
    }, a(function() {
        a("[data-slick]").slick()
    })
}),



/* FIM

/*!
 * Justified Gallery - v3.5.4
 * http://miromannino.github.io/Justified-Gallery/
 * Copyright (c) 2015 Miro Mannino
 * Licensed under the MIT license.
 */



! function(a) {
    a.fn.justifiedGallery = function(b) {
        function c(a, b, c) {
            var d;
            return d = a > b ? a : b, 100 >= d ? c.settings.sizeRangeSuffixes.lt100 : 240 >= d ? c.settings.sizeRangeSuffixes.lt240 : 320 >= d ? c.settings.sizeRangeSuffixes.lt320 : 500 >= d ? c.settings.sizeRangeSuffixes.lt500 : 640 >= d ? c.settings.sizeRangeSuffixes.lt640 : c.settings.sizeRangeSuffixes.lt1024
        }

        function d(a, b) {
            return -1 !== a.indexOf(b, a.length - b.length)
        }

        function e(a, b) {
            return a.substring(0, a.length - b.length)
        }

        function f(a, b) {
            var c = !1;
            for (var e in b.settings.sizeRangeSuffixes)
                if (0 !== b.settings.sizeRangeSuffixes[e].length) {
                    if (d(a, b.settings.sizeRangeSuffixes[e])) return b.settings.sizeRangeSuffixes[e]
                } else c = !0;
            if (c) return "";
            throw "unknown suffix for " + a
        }

        function g(a, b, d, g) {
            var h = a.match(g.settings.extension),
                i = null != h ? h[0] : "",
                j = a.replace(g.settings.extension, "");
            return j = e(j, f(j, g)), j += c(b, d, g) + i
        }

        function h(b) {
            var c = a(b.currentTarget).find(".caption");
            b.data.settings.cssAnimation ? c.addClass("caption-visible").removeClass("caption-hidden") : c.stop().fadeTo(b.data.settings.captionSettings.animationDuration, b.data.settings.captionSettings.visibleOpacity)
        }

        function i(b) {
            var c = a(b.currentTarget).find(".caption");
            b.data.settings.cssAnimation ? c.removeClass("caption-visible").removeClass("caption-hidden") : c.stop().fadeTo(b.data.settings.captionSettings.animationDuration, b.data.settings.captionSettings.nonVisibleOpacity)
        }

        function j(a, b, c) {
            c.settings.cssAnimation ? (a.addClass("entry-visible"), b()) : a.stop().fadeTo(c.settings.imagesAnimationDuration, 1, b)
        }

        function k(a, b) {
            b.settings.cssAnimation ? a.removeClass("entry-visible") : a.stop().fadeTo(0, 0)
        }

        function l(a) {
            var b = a.find("> img");
            return 0 === b.length && (b = a.find("> a > img")), b
        }

        function m(b, c, d, e, f, k, m) {
            function n() {
                p !== q && o.attr("src", q)
            }
            var o = l(b);
            o.css("width", e), o.css("height", f), o.css("margin-left", -e / 2), o.css("margin-top", -f / 2), b.width(e), b.height(k), b.css("top", d), b.css("left", c);
            var p = o.attr("src"),
                q = g(p, e, f, m);
            o.one("error", function() {
                o.attr("src", o.data("jg.originalSrc"))
            }), "skipped" === o.data("jg.loaded") ? x(p, function() {
                j(b, n, m), o.data("jg.loaded", !0)
            }) : j(b, n, m);
            var r = b.data("jg.captionMouseEvents");
            if (m.settings.captions === !0) {
                var s = b.find(".caption");
                if (0 === s.length) {
                    var t = o.attr("alt");
                    "undefined" == typeof t && (t = b.attr("title")), "undefined" != typeof t && (s = a('<div class="caption">' + t + "</div>"), b.append(s))
                }
                0 !== s.length && (m.settings.cssAnimation || s.stop().fadeTo(m.settings.imagesAnimationDuration, m.settings.captionSettings.nonVisibleOpacity), "undefined" == typeof r && (r = {
                    mouseenter: h,
                    mouseleave: i
                }, b.on("mouseenter", void 0, m, r.mouseenter), b.on("mouseleave", void 0, m, r.mouseleave), b.data("jg.captionMouseEvents", r)))
            } else "undefined" != typeof r && (b.off("mouseenter", void 0, m, r.mouseenter), b.off("mouseleave", void 0, m, r.mouseleave), b.removeData("jg.captionMouseEvents"))
        }

        function n(a, b) {
            var c, d, e, f, g, h, i = a.settings,
                j = !0,
                k = 0,
                m = a.galleryWidth - 2 * a.border - (a.buildingRow.entriesBuff.length - 1) * i.margins,
                n = m / a.buildingRow.aspectRatio,
                o = a.buildingRow.width / m > i.justifyThreshold;
            if (b && "hide" === i.lastRow && !o) {
                for (c = 0; c < a.buildingRow.entriesBuff.length; c++) d = a.buildingRow.entriesBuff[c], i.cssAnimation ? d.removeClass("entry-visible") : d.stop().fadeTo(0, 0);
                return -1
            }
            for (b && !o && "nojustify" === i.lastRow && (j = !1), c = 0; c < a.buildingRow.entriesBuff.length; c++) e = l(a.buildingRow.entriesBuff[c]), f = e.data("jg.imgw") / e.data("jg.imgh"), j ? (g = c === a.buildingRow.entriesBuff.length - 1 ? m : n * f, h = n) : (g = i.rowHeight * f, h = i.rowHeight), m -= Math.round(g), e.data("jg.jimgw", Math.round(g)), e.data("jg.jimgh", Math.ceil(h)), (0 === c || k > h) && (k = h);
            return i.fixedHeight && k > i.rowHeight && (k = i.rowHeight), {
                minHeight: k,
                justify: j
            }
        }

        function o(a) {
            a.lastAnalyzedIndex = -1, a.buildingRow.entriesBuff = [], a.buildingRow.aspectRatio = 0, a.buildingRow.width = 0, a.offY = a.border
        }

        function p(a, b) {
            var c, d, e, f, g = a.settings,
                h = a.border;
            if (f = n(a, b), e = f.minHeight, b && "hide" === g.lastRow && -1 === e) return a.buildingRow.entriesBuff = [], a.buildingRow.aspectRatio = 0, void(a.buildingRow.width = 0);
            g.maxRowHeight > 0 && g.maxRowHeight < e ? e = g.maxRowHeight : 0 === g.maxRowHeight && 1.5 * g.rowHeight < e && (e = 1.5 * g.rowHeight);
            for (var i = 0; i < a.buildingRow.entriesBuff.length; i++) c = a.buildingRow.entriesBuff[i], d = l(c), m(c, h, a.offY, d.data("jg.jimgw"), d.data("jg.jimgh"), e, a), h += d.data("jg.jimgw") + g.margins;
            a.$gallery.height(a.offY + e + a.border + (a.spinner.active ? a.spinner.$el.innerHeight() : 0)), (!b || e <= a.settings.rowHeight && f.justify) && (a.offY += e + a.settings.margins, a.buildingRow.entriesBuff = [], a.buildingRow.aspectRatio = 0, a.buildingRow.width = 0, a.$gallery.trigger("jg.rowflush"))
        }

        function q(a) {
            a.checkWidthIntervalId = setInterval(function() {
                var b = parseInt(a.$gallery.width(), 10);
                a.galleryWidth !== b && (a.galleryWidth = b, o(a), u(a, !0))
            }, a.settings.refreshTime)
        }

        function r(a) {
            clearInterval(a.intervalId), a.intervalId = setInterval(function() {
                a.phase < a.$points.length ? a.$points.eq(a.phase).fadeTo(a.timeslot, 1) : a.$points.eq(a.phase - a.$points.length).fadeTo(a.timeslot, 0), a.phase = (a.phase + 1) % (2 * a.$points.length)
            }, a.timeslot)
        }

        function s(a) {
            clearInterval(a.intervalId), a.intervalId = null
        }

        function t(a) {
            a["yield"].flushed = 0, null !== a.imgAnalyzerTimeout && clearTimeout(a.imgAnalyzerTimeout)
        }

        function u(a, b) {
            t(a), a.imgAnalyzerTimeout = setTimeout(function() {
                v(a, b)
            }, .001), v(a, b)
        }

        function v(b, c) {
            for (var d, e = b.settings, f = b.lastAnalyzedIndex + 1; f < b.entries.length; f++) {
                var g = a(b.entries[f]),
                    h = l(g);
                if (h.data("jg.loaded") === !0 || "skipped" === h.data("jg.loaded")) {
                    d = f >= b.entries.length - 1;
                    var i = b.galleryWidth - 2 * b.border - (b.buildingRow.entriesBuff.length - 1) * e.margins,
                        j = h.data("jg.imgw") / h.data("jg.imgh");
                    if (i / (b.buildingRow.aspectRatio + j) < e.rowHeight && (p(b, d), ++b["yield"].flushed >= b["yield"].every)) return void u(b, c);
                    b.buildingRow.entriesBuff.push(g), b.buildingRow.aspectRatio += j, b.buildingRow.width += j * e.rowHeight, b.lastAnalyzedIndex = f
                } else if ("error" !== h.data("jg.loaded")) return
            }
            b.buildingRow.entriesBuff.length > 0 && p(b, !0), b.spinner.active && (b.spinner.active = !1, b.$gallery.height(b.$gallery.height() - b.spinner.$el.innerHeight()), b.spinner.$el.detach(), s(b.spinner)), t(b), b.$gallery.trigger(c ? "jg.resize" : "jg.complete")
        }

        function w(a) {
            function b(a) {
                if ("string" != typeof d.sizeRangeSuffixes[a]) throw "sizeRangeSuffixes." + a + " must be a string"
            }

            function c(a, b) {
                if ("string" == typeof a[b]) {
                    if (a[b] = parseFloat(a[b], 10), isNaN(a[b])) throw "invalid number for " + b
                } else {
                    if ("number" != typeof a[b]) throw b + " must be a number";
                    if (isNaN(a[b])) throw "invalid number for " + b
                }
            }
            var d = a.settings;
            if ("object" != typeof d.sizeRangeSuffixes) throw "sizeRangeSuffixes must be defined and must be an object";
            if (b("lt100"), b("lt240"), b("lt320"), b("lt500"), b("lt640"), b("lt1024"), c(d, "rowHeight"), c(d, "maxRowHeight"), d.maxRowHeight > 0 && d.maxRowHeight < d.rowHeight && (d.maxRowHeight = d.rowHeight), c(d, "margins"), c(d, "border"), "nojustify" !== d.lastRow && "justify" !== d.lastRow && "hide" !== d.lastRow) throw 'lastRow must be "nojustify", "justify" or "hide"';
            if (c(d, "justifyThreshold"), d.justifyThreshold < 0 || d.justifyThreshold > 1) throw "justifyThreshold must be in the interval [0,1]";
            if ("boolean" != typeof d.cssAnimation) throw "cssAnimation must be a boolean";
            if (c(d.captionSettings, "animationDuration"), c(d, "imagesAnimationDuration"), c(d.captionSettings, "visibleOpacity"), d.captionSettings.visibleOpacity < 0 || d.captionSettings.visibleOpacity > 1) throw "captionSettings.visibleOpacity must be in the interval [0, 1]";
            if (c(d.captionSettings, "nonVisibleOpacity"), d.captionSettings.visibleOpacity < 0 || d.captionSettings.visibleOpacity > 1) throw "captionSettings.nonVisibleOpacity must be in the interval [0, 1]";
            if ("boolean" != typeof d.fixedHeight) throw "fixedHeight must be a boolean";
            if ("boolean" != typeof d.captions) throw "captions must be a boolean";
            if (c(d, "refreshTime"), "boolean" != typeof d.randomize) throw "randomize must be a boolean"
        }

        function x(b, c, d) {
            if (c || d) {
                var e = new Image,
                    f = a(e);
                c && f.one("load", function() {
                    f.off("load error"), c(e)
                }), d && f.one("error", function() {
                    f.off("load error"), d(e)
                }), e.src = b
            }
        }
        var y = {
            sizeRangeSuffixes: {
                lt100: "",
                lt240: "",
                lt320: "",
                lt500: "",
                lt640: "",
                lt1024: ""
            },
            rowHeight: 120,
            maxRowHeight: 0,
            margins: 1,
            border: -1,
            lastRow: "nojustify",
            justifyThreshold: .75,
            fixedHeight: !1,
            waitThumbnailsLoad: !0,
            captions: !0,
            cssAnimation: !1,
            imagesAnimationDuration: 500,
            captionSettings: {
                animationDuration: 500,
                visibleOpacity: .7,
                nonVisibleOpacity: 0
            },
            rel: null,
            target: null,
            extension: /\.[^.\\/]+$/,
            refreshTime: 100,
            randomize: !1
        };
        return this.each(function(c, d) {
            var e = a(d);
            e.addClass("justified-gallery");
            var f = e.data("jg.context");
            if ("undefined" == typeof f) {
                if ("undefined" != typeof b && null !== b && "object" != typeof b) throw "The argument must be an object";
                var g = a('<div class="spinner"><span></span><span></span><span></span></div>'),
                    h = a.extend({}, y, b),
                    i = h.border >= 0 ? h.border : h.margins;
                f = {
                    settings: h,
                    imgAnalyzerTimeout: null,
                    entries: null,
                    buildingRow: {
                        entriesBuff: [],
                        width: 0,
                        aspectRatio: 0
                    },
                    lastAnalyzedIndex: -1,
                    "yield": {
                        every: 2,
                        flushed: 0
                    },
                    border: i,
                    offY: i,
                    spinner: {
                        active: !1,
                        phase: 0,
                        timeslot: 150,
                        $el: g,
                        $points: g.find("span"),
                        intervalId: null
                    },
                    checkWidthIntervalId: null,
                    galleryWidth: e.width(),
                    $gallery: e
                }, e.data("jg.context", f)
            } else if ("norewind" === b)
                for (var j = 0; j < f.buildingRow.entriesBuff.length; j++) k(f.buildingRow.entriesBuff[j], f);
            else f.settings = a.extend({}, f.settings, b), f.border = f.settings.border >= 0 ? f.settings.border : f.settings.margins, o(f);
            if (w(f), f.entries = e.find("> a, > div:not(.spinner)").toArray(), 0 !== f.entries.length) {
                f.settings.randomize && (f.entries.sort(function() {
                    return 2 * Math.random() - 1
                }), a.each(f.entries, function() {
                    a(this).appendTo(e)
                }));
                var m = !1,
                    n = !1;
                a.each(f.entries, function(b, c) {
                    var d = a(c),
                        g = l(d);
                    if (d.addClass("jg-entry"), g.data("jg.loaded") !== !0 && "skipped" !== g.data("jg.loaded")) {
                        null !== f.settings.rel && d.attr("rel", f.settings.rel), null !== f.settings.target && d.attr("target", f.settings.target);
                        var h = "undefined" != typeof g.data("safe-src") ? g.data("safe-src") : g.attr("src");
                        g.data("jg.originalSrc", h), g.attr("src", h);
                        var i = parseInt(g.attr("width"), 10),
                            j = parseInt(g.attr("height"), 10);
                        if (f.settings.waitThumbnailsLoad !== !0 && !isNaN(i) && !isNaN(j)) return g.data("jg.imgw", i), g.data("jg.imgh", j), g.data("jg.loaded", "skipped"), n = !0, u(f, !1), !0;
                        g.data("jg.loaded", !1), m = !0, f.spinner.active === !1 && (f.spinner.active = !0, e.append(f.spinner.$el), e.height(f.offY + f.spinner.$el.innerHeight()), r(f.spinner)), x(h, function(a) {
                            g.data("jg.imgw", a.width), g.data("jg.imgh", a.height), g.data("jg.loaded", !0), u(f, !1)
                        }, function() {
                            g.data("jg.loaded", "error"), u(f, !1)
                        })
                    }
                }), m || n || u(f, !1), q(f)
            }
        })
    }
}

(jQuery),

    function() {
        function a() {}

        function b(a, b) {
            for (var c = a.length; c--;)
                if (a[c].listener === b) return c;
            return -1
        }

        function c(a) {
            return function() {
                return this[a].apply(this, arguments)
            }
        }
        var d = a.prototype,
            e = this,
            f = e.EventEmitter;
        d.getListeners = function(a) {
            var b, c, d = this._getEvents();
            if ("object" == typeof a) {
                b = {};
                for (c in d) d.hasOwnProperty(c) && a.test(c) && (b[c] = d[c])
            } else b = d[a] || (d[a] = []);
            return b
        }, d.flattenListeners = function(a) {
            var b, c = [];
            for (b = 0; a.length > b; b += 1) c.push(a[b].listener);
            return c
        }, d.getListenersAsObject = function(a) {
            var b, c = this.getListeners(a);
            return c instanceof Array && (b = {}, b[a] = c), b || c
        }, d.addListener = function(a, c) {
            var d, e = this.getListenersAsObject(a),
                f = "object" == typeof c;
            for (d in e) e.hasOwnProperty(d) && -1 === b(e[d], c) && e[d].push(f ? c : {
                listener: c,
                once: !1
            });
            return this
        }, d.on = c("addListener"), d.addOnceListener = function(a, b) {
            return this.addListener(a, {
                listener: b,
                once: !0
            })
        }, d.once = c("addOnceListener"), d.defineEvent = function(a) {
            return this.getListeners(a), this
        }, d.defineEvents = function(a) {
            for (var b = 0; a.length > b; b += 1) this.defineEvent(a[b]);
            return this
        }, d.removeListener = function(a, c) {
            var d, e, f = this.getListenersAsObject(a);
            for (e in f) f.hasOwnProperty(e) && (d = b(f[e], c), -1 !== d && f[e].splice(d, 1));
            return this
        }, d.off = c("removeListener"), d.addListeners = function(a, b) {
            return this.manipulateListeners(!1, a, b)
        }, d.removeListeners = function(a, b) {
            return this.manipulateListeners(!0, a, b)
        }, d.manipulateListeners = function(a, b, c) {
            var d, e, f = a ? this.removeListener : this.addListener,
                g = a ? this.removeListeners : this.addListeners;
            if ("object" != typeof b || b instanceof RegExp)
                for (d = c.length; d--;) f.call(this, b, c[d]);
            else
                for (d in b) b.hasOwnProperty(d) && (e = b[d]) && ("function" == typeof e ? f.call(this, d, e) : g.call(this, d, e));
            return this
        }, d.removeEvent = function(a) {
            var b, c = typeof a,
                d = this._getEvents();
            if ("string" === c) delete d[a];
            else if ("object" === c)
                for (b in d) d.hasOwnProperty(b) && a.test(b) && delete d[b];
            else delete this._events;
            return this
        }, d.removeAllListeners = c("removeEvent"), d.emitEvent = function(a, b) {
            var c, d, e, f, g = this.getListenersAsObject(a);
            for (e in g)
                if (g.hasOwnProperty(e))
                    for (d = g[e].length; d--;) c = g[e][d], c.once === !0 && this.removeListener(a, c.listener), f = c.listener.apply(this, b || []), f === this._getOnceReturnValue() && this.removeListener(a, c.listener);
            return this
        }, d.trigger = c("emitEvent"), d.emit = function(a) {
            var b = Array.prototype.slice.call(arguments, 1);
            return this.emitEvent(a, b)
        }, d.setOnceReturnValue = function(a) {
            return this._onceReturnValue = a, this
        }, d._getOnceReturnValue = function() {
            return this.hasOwnProperty("_onceReturnValue") ? this._onceReturnValue : !0
        }, d._getEvents = function() {
            return this._events || (this._events = {})
        }, a.noConflict = function() {
            return e.EventEmitter = f, a
        }, "function" == typeof define && define.amd ? define("eventEmitter/EventEmitter", [], function() {
            return a
        }) : "object" == typeof module && module.exports ? module.exports = a : this.EventEmitter = a
    }.call(this),
    function(a) {
        function b(b) {
            var c = a.event;
            return c.target = c.target || c.srcElement || b, c
        }
        var c = document.documentElement,
            d = function() {};
        c.addEventListener ? d = function(a, b, c) {
            a.addEventListener(b, c, !1)
        } : c.attachEvent && (d = function(a, c, d) {
                a[c + d] = d.handleEvent ? function() {
                    var c = b(a);
                    d.handleEvent.call(d, c)
                } : function() {
                    var c = b(a);
                    d.call(a, c)
                }, a.attachEvent("on" + c, a[c + d])
            });
        var e = function() {};
        c.removeEventListener ? e = function(a, b, c) {
            a.removeEventListener(b, c, !1)
        } : c.detachEvent && (e = function(a, b, c) {
                a.detachEvent("on" + b, a[b + c]);
                try {
                    delete a[b + c]
                } catch (d) {
                    a[b + c] = void 0
                }
            });
        var f = {
            bind: d,
            unbind: e
        };
        "function" == typeof define && define.amd ? define("eventie/eventie", f) : a.eventie = f
    }(this),
    function(a, b) {
        "function" == typeof define && define.amd ? define(["eventEmitter/EventEmitter", "eventie/eventie"], function(c, d) {
            return b(a, c, d)
        }) : "object" == typeof exports ? module.exports = b(a, require("wolfy87-eventemitter"), require("eventie")) : a.imagesLoaded = b(a, a.EventEmitter, a.eventie)
    }(window, function(a, b, c) {
        function d(a, b) {
            for (var c in b) a[c] = b[c];
            return a
        }

        function e(a) {
            return "[object Array]" === m.call(a)
        }

        function f(a) {
            var b = [];
            if (e(a)) b = a;
            else if ("number" == typeof a.length)
                for (var c = 0, d = a.length; d > c; c++) b.push(a[c]);
            else b.push(a);
            return b
        }

        function g(a, b, c) {
            if (!(this instanceof g)) return new g(a, b);
            "string" == typeof a && (a = document.querySelectorAll(a)), this.elements = f(a), this.options = d({}, this.options), "function" == typeof b ? c = b : d(this.options, b), c && this.on("always", c), this.getImages(), j && (this.jqDeferred = new j.Deferred);
            var e = this;
            setTimeout(function() {
                e.check()
            })
        }

        function h(a) {
            this.img = a
        }

        function i(a) {
            this.src = a, n[a] = this
        }
        var j = a.jQuery,
            k = a.console,
            l = void 0 !== k,
            m = Object.prototype.toString;
        g.prototype = new b, g.prototype.options = {}, g.prototype.getImages = function() {
            this.images = [];
            for (var a = 0, b = this.elements.length; b > a; a++) {
                var c = this.elements[a];
                "IMG" === c.nodeName && this.addImage(c);
                var d = c.nodeType;
                if (d && (1 === d || 9 === d || 11 === d))
                    for (var e = c.querySelectorAll("img"), f = 0, g = e.length; g > f; f++) {
                        var h = e[f];
                        this.addImage(h)
                    }
            }
        }, g.prototype.addImage = function(a) {
            var b = new h(a);
            this.images.push(b)
        }, g.prototype.check = function() {
            function a(a, e) {
                return b.options.debug && l && k.log("confirm", a, e), b.progress(a), c++, c === d && b.complete(), !0
            }
            var b = this,
                c = 0,
                d = this.images.length;
            if (this.hasAnyBroken = !1, !d) return void this.complete();
            for (var e = 0; d > e; e++) {
                var f = this.images[e];
                f.on("confirm", a), f.check()
            }
        }, g.prototype.progress = function(a) {
            this.hasAnyBroken = this.hasAnyBroken || !a.isLoaded;
            var b = this;
            setTimeout(function() {
                b.emit("progress", b, a), b.jqDeferred && b.jqDeferred.notify && b.jqDeferred.notify(b, a)
            })
        }, g.prototype.complete = function() {
            var a = this.hasAnyBroken ? "fail" : "done";
            this.isComplete = !0;
            var b = this;
            setTimeout(function() {
                if (b.emit(a, b), b.emit("always", b), b.jqDeferred) {
                    var c = b.hasAnyBroken ? "reject" : "resolve";
                    b.jqDeferred[c](b)
                }
            })
        }, j && (j.fn.imagesLoaded = function(a, b) {
            var c = new g(this, a, b);
            return c.jqDeferred.promise(j(this))
        }), h.prototype = new b, h.prototype.check = function() {
            var a = n[this.img.src] || new i(this.img.src);
            if (a.isConfirmed) return void this.confirm(a.isLoaded, "cached was confirmed");
            if (this.img.complete && void 0 !== this.img.naturalWidth) return void this.confirm(0 !== this.img.naturalWidth, "naturalWidth");
            var b = this;
            a.on("confirm", function(a, c) {
                return b.confirm(a.isLoaded, c), !0
            }), a.check()
        }, h.prototype.confirm = function(a, b) {
            this.isLoaded = a, this.emit("confirm", this, b)
        };
        var n = {};
        return i.prototype = new b, i.prototype.check = function() {
            if (!this.isChecked) {
                var a = new Image;
                c.bind(a, "load", this), c.bind(a, "error", this), a.src = this.src, this.isChecked = !0
            }
        }, i.prototype.handleEvent = function(a) {
            var b = "on" + a.type;
            this[b] && this[b](a)
        }, i.prototype.onload = function(a) {
            this.confirm(!0, "onload"), this.unbindProxyEvents(a)
        }, i.prototype.onerror = function(a) {
            this.confirm(!1, "onerror"), this.unbindProxyEvents(a)
        }, i.prototype.confirm = function(a, b) {
            this.isConfirmed = !0, this.isLoaded = a, this.emit("confirm", this, b)
        }, i.prototype.unbindProxyEvents = function(a) {
            c.unbind(a.target, "load", this), c.unbind(a.target, "error", this)
        }, g
    }),
    function(a) {
        function b(b, d, e) {
            var f = this;
            return this.on("click.pjax", b, function(b) {
                var g = a.extend({}, p(d, e));
                g.container || (g.container = a(this).attr("data-pjax") || f), c(b, g)
            })
        }

        function c(b, c, d) {
            d = p(c, d);
            var f = b.currentTarget;
            if ("A" !== f.tagName.toUpperCase()) throw "$.fn.pjax or $.pjax.click requires an anchor element";
            if (!(b.which > 1 || b.metaKey || b.ctrlKey || b.shiftKey || b.altKey || location.protocol !== f.protocol || location.hostname !== f.hostname || f.href.indexOf("#") > -1 && o(f) == o(location) || b.isDefaultPrevented())) {
                var g = {
                        url: f.href,
                        container: a(f).attr("data-pjax"),
                        target: f
                    },
                    h = a.extend({}, g, d),
                    i = a.Event("pjax:click");
                a(f).trigger(i, [h]), i.isDefaultPrevented() || (e(h), b.preventDefault(), a(f).trigger("pjax:clicked", [h]))
            }
        }

        function d(b, c, d) {
            d = p(c, d);
            var f = b.currentTarget,
                g = a(f);
            if ("FORM" !== f.tagName.toUpperCase()) throw "$.pjax.submit requires a form element";
            var h = {
                type: (g.attr("method") || "GET").toUpperCase(),
                url: g.attr("action"),
                container: g.attr("data-pjax"),
                target: f
            };
            if ("GET" !== h.type && void 0 !== window.FormData) h.data = new FormData(f), h.processData = !1, h.contentType = !1;
            else {
                if (a(f).find(":file").length) return;
                h.data = a(f).serializeArray()
            }
            e(a.extend({}, h, d)), b.preventDefault()
        }

        function e(b) {
            function c(b, c, e) {
                e || (e = {}), e.relatedTarget = d;
                var f = a.Event(b, e);
                return h.trigger(f, c), !f.isDefaultPrevented()
            }
            b = a.extend(!0, {}, a.ajaxSettings, e.defaults, b), a.isFunction(b.url) && (b.url = b.url());
            var d = b.target,
                f = n(b.url).hash,
                h = b.context = q(b.container);
            b.data || (b.data = {}), a.isArray(b.data) ? b.data.push({
                name: "_pjax",
                value: h.selector
            }) : b.data._pjax = h.selector;
            var i;
            b.beforeSend = function(a, d) {
                if ("GET" !== d.type && (d.timeout = 0), a.setRequestHeader("X-PJAX", "true"), a.setRequestHeader("X-PJAX-Container", h.selector), !c("pjax:beforeSend", [a, d])) return !1;
                d.timeout > 0 && (i = setTimeout(function() {
                    c("pjax:timeout", [a, b]) && a.abort("timeout")
                }, d.timeout), d.timeout = 0);
                var e = n(d.url);
                f && (e.hash = f), b.requestUrl = m(e)
            }, b.complete = function(a, d) {
                i && clearTimeout(i), c("pjax:complete", [a, d, b]), c("pjax:end", [a, b])
            }, b.error = function(a, d, e) {
                var f = t("", a, b),
                    h = c("pjax:error", [a, d, e, b]);
                "GET" == b.type && "abort" !== d && h && g(f.url)
            }, b.success = function(d, i, j) {
                var l = e.state,
                    m = "function" == typeof a.pjax.defaults.version ? a.pjax.defaults.version() : a.pjax.defaults.version,
                    o = j.getResponseHeader("X-PJAX-Version"),
                    p = t(d, j, b),
                    q = n(p.url);
                if (f && (q.hash = f, p.url = q.href), m && o && m !== o) return void g(p.url);
                if (!p.contents) return void g(p.url);
                e.state = {
                    id: b.id || k(),
                    url: p.url,
                    title: p.title,
                    container: h.selector,
                    fragment: b.fragment,
                    timeout: b.timeout
                }, (b.push || b.replace) && window.history.replaceState(e.state, p.title, p.url);
                var r = a.contains(b.container, document.activeElement);
                if (r) try {
                    document.activeElement.blur()
                } catch (s) {}
                p.title && (document.title = p.title), c("pjax:beforeReplace", [p.contents, b], {
                    state: e.state,
                    previousState: l
                }), h.html(p.contents);
                var v = h.find("input[autofocus], textarea[autofocus]").last()[0];
                v && document.activeElement !== v && v.focus(), u(p.scripts);
                var w = b.scrollTo;
                if (f) {
                    var x = decodeURIComponent(f.slice(1)),
                        y = document.getElementById(x) || document.getElementsByName(x)[0];
                    y && (w = a(y).offset().top)
                }
                "number" == typeof w && a(window).scrollTop(w), c("pjax:success", [d, i, j, b])
            }, e.state || (e.state = {
                id: k(),
                url: window.location.href,
                title: document.title,
                container: h.selector,
                fragment: b.fragment,
                timeout: b.timeout
            }, window.history.replaceState(e.state, document.title)), j(e.xhr), e.options = b;
            var o = e.xhr = a.ajax(b);
            return o.readyState > 0 && (b.push && !b.replace && (v(e.state.id, l(h)), window.history.pushState(null, "", b.requestUrl)), c("pjax:start", [o, b]), c("pjax:send", [o, b])), e.xhr
        }

        function f(b, c) {
            var d = {
                url: window.location.href,
                push: !1,
                replace: !0,
                scrollTo: !1
            };
            return e(a.extend(d, p(b, c)))
        }

        function g(a) {
            window.history.replaceState(null, "", e.state.url), window.location.replace(a)
        }

        function h(b) {
            B || j(e.xhr);
            var c, d = e.state,
                f = b.state;
            if (f && f.container) {
                if (B && C == f.url) return;
                if (d) {
                    if (d.id === f.id) return;
                    c = d.id < f.id ? "forward" : "back"
                }
                var h = E[f.id] || [],
                    i = a(h[0] || f.container),
                    k = h[1];
                if (i.length) {
                    d && w(c, d.id, l(i));
                    var m = a.Event("pjax:popstate", {
                        state: f,
                        direction: c
                    });
                    i.trigger(m);
                    var n = {
                        id: f.id,
                        url: f.url,
                        container: i,
                        push: !1,
                        fragment: f.fragment,
                        timeout: f.timeout,
                        scrollTo: !1
                    };
                    if (k) {
                        i.trigger("pjax:start", [null, n]), e.state = f, f.title && (document.title = f.title);
                        var o = a.Event("pjax:beforeReplace", {
                            state: f,
                            previousState: d
                        });
                        i.trigger(o, [k, n]), i.html(k), i.trigger("pjax:end", [null, n])
                    } else e(n);
                    i[0].offsetHeight
                } else g(location.href)
            }
            B = !1
        }

        function i(b) {
            var c = a.isFunction(b.url) ? b.url() : b.url,
                d = b.type ? b.type.toUpperCase() : "GET",
                e = a("<form>", {
                    method: "GET" === d ? "GET" : "POST",
                    action: c,
                    style: "display:none"
                });
            "GET" !== d && "POST" !== d && e.append(a("<input>", {
                type: "hidden",
                name: "_method",
                value: d.toLowerCase()
            }));
            var f = b.data;
            if ("string" == typeof f) a.each(f.split("&"), function(b, c) {
                var d = c.split("=");
                e.append(a("<input>", {
                    type: "hidden",
                    name: d[0],
                    value: d[1]
                }))
            });
            else if (a.isArray(f)) a.each(f, function(b, c) {
                e.append(a("<input>", {
                    type: "hidden",
                    name: c.name,
                    value: c.value
                }))
            });
            else if ("object" == typeof f) {
                var g;
                for (g in f) e.append(a("<input>", {
                    type: "hidden",
                    name: g,
                    value: f[g]
                }))
            }
            a(document.body).append(e), e.submit()
        }

        function j(b) {
            b && b.readyState < 4 && (b.onreadystatechange = a.noop, b.abort())
        }

        function k() {
            return (new Date).getTime()
        }

        function l(a) {
            var b = a.clone();
            return b.find("script").each(function() {
                this.src || jQuery._data(this, "globalEval", !1)
            }), [a.selector, b.contents()]
        }

        function m(a) {
            return a.search = a.search.replace(/([?&])(_pjax|_)=[^&]*/g, ""), a.href.replace(/\?($|#)/, "$1")
        }

        function n(a) {
            var b = document.createElement("a");
            return b.href = a, b
        }

        function o(a) {
            return a.href.replace(/#.*/, "")
        }

        function p(b, c) {
            return b && c ? c.container = b : c = a.isPlainObject(b) ? b : {
                container: b
            }, c.container && (c.container = q(c.container)), c
        }

        function q(b) {
            if (b = a(b), b.length) {
                if ("" !== b.selector && b.context === document) return b;
                if (b.attr("id")) return a("#" + b.attr("id"));
                throw "cant get selector for pjax container!"
            }
            throw "no pjax container for " + b.selector
        }

        function r(a, b) {
            return a.filter(b).add(a.find(b))
        }

        function s(b) {
            return a.parseHTML(b, document, !0)
        }

        function t(b, c, d) {
            var e = {},
                f = /<html/i.test(b),
                g = c.getResponseHeader("X-PJAX-URL");
            if (e.url = g ? m(n(g)) : d.requestUrl, f) var h = a(s(b.match(/<head[^>]*>([\s\S.]*)<\/head>/i)[0])),
                i = a(s(b.match(/<body[^>]*>([\s\S.]*)<\/body>/i)[0]));
            else var h = i = a(s(b));
            if (0 === i.length) return e;
            if (e.title = r(h, "title").last().text(), d.fragment) {
                if ("body" === d.fragment) var j = i;
                else var j = r(i, d.fragment).first();
                j.length && (e.contents = "body" === d.fragment ? j : j.contents(), e.title || (e.title = j.attr("title") || j.data("title")))
            } else f || (e.contents = i);
            return e.contents && (e.contents = e.contents.not(function() {
                return a(this).is("title")
            }), e.contents.find("title").remove(), e.scripts = r(e.contents, "script[src]").remove(), e.contents = e.contents.not(e.scripts)), e.title && (e.title = a.trim(e.title)), e
        }

        function u(b) {
            if (b) {
                var c = a("script[src]");
                b.each(function() {
                    var b = this.src,
                        d = c.filter(function() {
                            return this.src === b
                        });
                    if (!d.length) {
                        var e = document.createElement("script"),
                            f = a(this).attr("type");
                        f && (e.type = f), e.src = a(this).attr("src"), document.head.appendChild(e)
                    }
                })
            }
        }

        function v(a, b) {
            E[a] = b, G.push(a), x(F, 0), x(G, e.defaults.maxCacheLength)
        }

        function w(a, b, c) {
            var d, f;
            E[b] = c, "forward" === a ? (d = G, f = F) : (d = F, f = G), d.push(b), (b = f.pop()) && delete E[b], x(d, e.defaults.maxCacheLength)
        }

        function x(a, b) {
            for (; a.length > b;) delete E[a.shift()]
        }

        function y() {
            return a("meta").filter(function() {
                var b = a(this).attr("http-equiv");
                return b && "X-PJAX-VERSION" === b.toUpperCase()
            }).attr("content")
        }

        function z() {
            a.fn.pjax = b, a.pjax = e, a.pjax.enable = a.noop, a.pjax.disable = A, a.pjax.click = c, a.pjax.submit = d, a.pjax.reload = f, a.pjax.defaults = {
                timeout: 650,
                push: !0,
                replace: !1,
                type: "GET",
                dataType: "html",
                scrollTo: 0,
                maxCacheLength: 20,
                version: y
            }, a(window).on("popstate.pjax", h)
        }

        function A() {
            a.fn.pjax = function() {
                return this
            }, a.pjax = i, a.pjax.enable = z, a.pjax.disable = a.noop, a.pjax.click = a.noop, a.pjax.submit = a.noop, a.pjax.reload = function() {
                window.location.reload()
            }, a(window).off("popstate.pjax", h)
        }
        var B = !0,
            C = window.location.href,
            D = window.history.state;
        D && D.container && (e.state = D), "state" in window.history && (B = !1);
        var E = {},
            F = [],
            G = [];
        a.inArray("state", a.event.props) < 0 && a.event.props.push("state"), a.support.pjax = window.history && window.history.pushState && window.history.replaceState && !navigator.userAgent.match(/((iPod|iPhone|iPad).+\bOS\s+[1-4]\D|WebApps\/.+CFNetwork)/), a.support.pjax ? z() : A()
    }(jQuery),
    function(a) {
        "use strict";
        "function" == typeof define && define.amd ? define(["jquery"], a) : a(jQuery)
    }(function(a) {
        "use strict";

        function b(a) {
            if (a instanceof Date) return a;
            if (String(a).match(g)) return String(a).match(/^[0-9]*$/) && (a = Number(a)), String(a).match(/\-/) && (a = String(a).replace(/\-/g, "/")), new Date(a);
            throw new Error("Couldn't cast `" + a + "` to a date object.")
        }

        function c(a) {
            var b = a.toString().replace(/([.?*+^$[\]\\(){}|-])/g, "\\$1");
            return new RegExp(b)
        }

        function d(a) {
            return function(b) {
                var d = b.match(/%(-|!)?[A-Z]{1}(:[^;]+;)?/gi);
                if (d)
                    for (var f = 0, g = d.length; g > f; ++f) {
                        var h = d[f].match(/%(-|!)?([a-zA-Z]{1})(:[^;]+;)?/),
                            j = c(h[0]),
                            k = h[1] || "",
                            l = h[3] || "",
                            m = null;
                        h = h[2], i.hasOwnProperty(h) && (m = i[h], m = Number(a[m])), null !== m && ("!" === k && (m = e(l, m)), "" === k && 10 > m && (m = "0" + m.toString()), b = b.replace(j, m.toString()))
                    }
                return b = b.replace(/%%/, "%")
            }
        }

        function e(a, b) {
            var c = "s",
                d = "";
            return a && (a = a.replace(/(:|;|\s)/gi, "").split(/\,/), 1 === a.length ? c = a[0] : (d = a[0], c = a[1])), 1 === Math.abs(b) ? d : c
        }
        var f = [],
            g = [],
            h = {
                precision: 100,
                elapse: !1
            };
        g.push(/^[0-9]*$/.source), g.push(/([0-9]{1,2}\/){2}[0-9]{4}( [0-9]{1,2}(:[0-9]{2}){2})?/.source), g.push(/[0-9]{4}([\/\-][0-9]{1,2}){2}( [0-9]{1,2}(:[0-9]{2}){2})?/.source), g = new RegExp(g.join("|"));
        var i = {
                Y: "years",
                m: "months",
                n: "daysToMonth",
                w: "weeks",
                d: "daysToWeek",
                D: "totalDays",
                H: "hours",
                M: "minutes",
                S: "seconds"
            },
            j = function(b, c, d) {
                this.el = b, this.$el = a(b), this.interval = null, this.offset = {}, this.options = a.extend({}, h), this.instanceNumber = f.length, f.push(this), this.$el.data("countdown-instance", this.instanceNumber), d && ("function" == typeof d ? (this.$el.on("update.countdown", d), this.$el.on("stoped.countdown", d), this.$el.on("finish.countdown", d)) : this.options = a.extend({}, h, d)), this.setFinalDate(c), this.start()
            };
        a.extend(j.prototype, {
            start: function() {
                null !== this.interval && clearInterval(this.interval);
                var a = this;
                this.update(), this.interval = setInterval(function() {
                    a.update.call(a)
                }, this.options.precision)
            },
            stop: function() {
                clearInterval(this.interval), this.interval = null, this.dispatchEvent("stoped")
            },
            toggle: function() {
                this.interval ? this.stop() : this.start()
            },
            pause: function() {
                this.stop()
            },
            resume: function() {
                this.start()
            },
            remove: function() {
                this.stop.call(this), f[this.instanceNumber] = null, delete this.$el.data().countdownInstance
            },
            setFinalDate: function(a) {
                this.finalDate = b(a)
            },
            update: function() {
                if (0 === this.$el.closest("html").length) return void this.remove();
                var b, c = void 0 !== a._data(this.el, "events"),
                    d = new Date;
                b = this.finalDate.getTime() - d.getTime(), b = Math.ceil(b / 1e3), b = !this.options.elapse && 0 > b ? 0 : Math.abs(b), this.totalSecsLeft !== b && c && (this.totalSecsLeft = b, this.elapsed = d >= this.finalDate, this.offset = {
                    seconds: this.totalSecsLeft % 60,
                    minutes: Math.floor(this.totalSecsLeft / 60) % 60,
                    hours: Math.floor(this.totalSecsLeft / 60 / 60) % 24,
                    days: Math.floor(this.totalSecsLeft / 60 / 60 / 24) % 7,
                    daysToWeek: Math.floor(this.totalSecsLeft / 60 / 60 / 24) % 7,
                    daysToMonth: Math.floor(this.totalSecsLeft / 60 / 60 / 24 % 30.4368),
                    totalDays: Math.floor(this.totalSecsLeft / 60 / 60 / 24),
                    weeks: Math.floor(this.totalSecsLeft / 60 / 60 / 24 / 7),
                    months: Math.floor(this.totalSecsLeft / 60 / 60 / 24 / 30.4368),
                    years: Math.abs(this.finalDate.getFullYear() - d.getFullYear())
                }, this.options.elapse || 0 !== this.totalSecsLeft ? this.dispatchEvent("update") : (this.stop(), this.dispatchEvent("finish")))
            },
            dispatchEvent: function(b) {
                var c = a.Event(b + ".countdown");
                c.finalDate = this.finalDate, c.elapsed = this.elapsed, c.offset = a.extend({}, this.offset), c.strftime = d(this.offset), this.$el.trigger(c)
            }
        }), a.fn.countdown = function() {
            var b = Array.prototype.slice.call(arguments, 0);
            return this.each(function() {
                var c = a(this).data("countdown-instance");
                if (void 0 !== c) {
                    var d = f[c],
                        e = b[0];
                    j.prototype.hasOwnProperty(e) ? d[e].apply(d, b.slice(1)) : null === String(e).match(/^[$A-Z_][0-9A-Z_$]*$/i) ? (d.setFinalDate.call(d, e), d.start()) : a.error("Method %s does not exist on jQuery.countdown".replace(/\%s/gi, e))
                } else new j(this, b[0], b[1])
            })
        }
    }), ! function(a, b) {
    "use strict";
    "function" == typeof define && define.amd ? define("jquery-bridget/jquery-bridget", ["jquery"], function(c) {
        b(a, c)
    }) : "object" == typeof module && module.exports ? module.exports = b(a, require("jquery")) : a.jQueryBridget = b(a, a.jQuery)
}(window, function(a, b) {
    "use strict";

    function c(c, f, h) {
        function i(a, b, d) {
            var e, f = "$()." + c + '("' + b + '")';
            return a.each(function(a, i) {
                var j = h.data(i, c);
                if (!j) return void g(c + " not initialized. Cannot call methods, i.e. " + f);
                var k = j[b];
                if (!k || "_" == b.charAt(0)) return void g(f + " is not a valid method");
                var l = k.apply(j, d);
                e = void 0 === e ? l : e
            }), void 0 !== e ? e : a
        }

        function j(a, b) {
            a.each(function(a, d) {
                var e = h.data(d, c);
                e ? (e.option(b), e._init()) : (e = new f(d, b), h.data(d, c, e))
            })
        }
        h = h || b || a.jQuery, h && (f.prototype.option || (f.prototype.option = function(a) {
            h.isPlainObject(a) && (this.options = h.extend(!0, this.options, a))
        }), h.fn[c] = function(a) {
            if ("string" == typeof a) {
                var b = e.call(arguments, 1);
                return i(this, a, b)
            }
            return j(this, a), this
        }, d(h))
    }

    function d(a) {
        !a || a && a.bridget || (a.bridget = c)
    }
    var e = Array.prototype.slice,
        f = a.console,
        g = "undefined" == typeof f ? function() {} : function(a) {
            f.error(a)
        };
    return d(b || a.jQuery), c
}),
    function(a, b) {
        "use strict";
        "function" == typeof define && define.amd ? define("get-size/get-size", [], function() {
            return b()
        }) : "object" == typeof module && module.exports ? module.exports = b() : a.getSize = b()
    }(window, function() {
        "use strict";

        function a(a) {
            var b = parseFloat(a),
                c = -1 == a.indexOf("%") && !isNaN(b);
            return c && b
        }

        function b() {}

        function c() {
            for (var a = {
                width: 0,
                height: 0,
                innerWidth: 0,
                innerHeight: 0,
                outerWidth: 0,
                outerHeight: 0
            }, b = 0; j > b; b++) {
                var c = i[b];
                a[c] = 0
            }
            return a
        }

        function d(a) {
            var b = getComputedStyle(a);
            return b || h("Style returned " + b + ". Are you running this code in a hidden iframe on Firefox? See http://bit.ly/getsizebug1"), b
        }

        function e() {
            if (!k) {
                k = !0;
                var b = document.createElement("div");
                b.style.width = "200px", b.style.padding = "1px 2px 3px 4px", b.style.borderStyle = "solid", b.style.borderWidth = "1px 2px 3px 4px", b.style.boxSizing = "border-box";
                var c = document.body || document.documentElement;
                c.appendChild(b);
                var e = d(b);
                f.isBoxSizeOuter = g = 200 == a(e.width), c.removeChild(b)
            }
        }

        function f(b) {
            if (e(), "string" == typeof b && (b = document.querySelector(b)), b && "object" == typeof b && b.nodeType) {
                var f = d(b);
                if ("none" == f.display) return c();
                var h = {};
                h.width = b.offsetWidth, h.height = b.offsetHeight;
                for (var k = h.isBorderBox = "border-box" == f.boxSizing, l = 0; j > l; l++) {
                    var m = i[l],
                        n = f[m],
                        o = parseFloat(n);
                    h[m] = isNaN(o) ? 0 : o
                }
                var p = h.paddingLeft + h.paddingRight,
                    q = h.paddingTop + h.paddingBottom,
                    r = h.marginLeft + h.marginRight,
                    s = h.marginTop + h.marginBottom,
                    t = h.borderLeftWidth + h.borderRightWidth,
                    u = h.borderTopWidth + h.borderBottomWidth,
                    v = k && g,
                    w = a(f.width);
                w !== !1 && (h.width = w + (v ? 0 : p + t));
                var x = a(f.height);
                return x !== !1 && (h.height = x + (v ? 0 : q + u)), h.innerWidth = h.width - (p + t), h.innerHeight = h.height - (q + u), h.outerWidth = h.width + r, h.outerHeight = h.height + s, h
            }
        }
        var g, h = "undefined" == typeof console ? b : function(a) {
                console.error(a)
            },
            i = ["paddingLeft", "paddingRight", "paddingTop", "paddingBottom", "marginLeft", "marginRight", "marginTop", "marginBottom", "borderLeftWidth", "borderRightWidth", "borderTopWidth", "borderBottomWidth"],
            j = i.length,
            k = !1;
        return f
    }),
    function(a, b) {
        "function" == typeof define && define.amd ? define("ev-emitter/ev-emitter", b) : "object" == typeof module && module.exports ? module.exports = b() : a.EvEmitter = b()
    }(this, function() {
        function a() {}
        var b = a.prototype;
        return b.on = function(a, b) {
            if (a && b) {
                var c = this._events = this._events || {},
                    d = c[a] = c[a] || [];
                return -1 == d.indexOf(b) && d.push(b), this
            }
        }, b.once = function(a, b) {
            if (a && b) {
                this.on(a, b);
                var c = this._onceEvents = this._onceEvents || {},
                    d = c[a] = c[a] || {};
                return d[b] = !0, this
            }
        }, b.off = function(a, b) {
            var c = this._events && this._events[a];
            if (c && c.length) {
                var d = c.indexOf(b);
                return -1 != d && c.splice(d, 1), this
            }
        }, b.emitEvent = function(a, b) {
            var c = this._events && this._events[a];
            if (c && c.length) {
                var d = 0,
                    e = c[d];
                b = b || [];
                for (var f = this._onceEvents && this._onceEvents[a]; e;) {
                    var g = f && f[e];
                    g && (this.off(a, e), delete f[e]), e.apply(this, b), d += g ? 0 : 1, e = c[d]
                }
                return this
            }
        }, a
    }),
    function(a, b) {
        "use strict";
        "function" == typeof define && define.amd ? define("desandro-matches-selector/matches-selector", b) : "object" == typeof module && module.exports ? module.exports = b() : a.matchesSelector = b()
    }(window, function() {
        "use strict";
        var a = function() {
            var a = Element.prototype;
            if (a.matches) return "matches";
            if (a.matchesSelector) return "matchesSelector";
            for (var b = ["webkit", "moz", "ms", "o"], c = 0; c < b.length; c++) {
                var d = b[c],
                    e = d + "MatchesSelector";
                if (a[e]) return e
            }
        }();
        return function(b, c) {
            return b[a](c)
        }
    }),
    function(a, b) {
        "function" == typeof define && define.amd ? define("fizzy-ui-utils/utils", ["desandro-matches-selector/matches-selector"], function(c) {
            return b(a, c)
        }) : "object" == typeof module && module.exports ? module.exports = b(a, require("desandro-matches-selector")) : a.fizzyUIUtils = b(a, a.matchesSelector)
    }(window, function(a, b) {
        var c = {};
        c.extend = function(a, b) {
            for (var c in b) a[c] = b[c];
            return a
        }, c.modulo = function(a, b) {
            return (a % b + b) % b
        }, c.makeArray = function(a) {
            var b = [];
            if (Array.isArray(a)) b = a;
            else if (a && "number" == typeof a.length)
                for (var c = 0; c < a.length; c++) b.push(a[c]);
            else b.push(a);
            return b
        }, c.removeFrom = function(a, b) {
            var c = a.indexOf(b); - 1 != c && a.splice(c, 1)
        }, c.getParent = function(a, c) {
            for (; a != document.body;)
                if (a = a.parentNode, b(a, c)) return a
        }, c.getQueryElement = function(a) {
            return "string" == typeof a ? document.querySelector(a) : a
        }, c.handleEvent = function(a) {
            var b = "on" + a.type;
            this[b] && this[b](a)
        }, c.filterFindElements = function(a, d) {
            a = c.makeArray(a);
            var e = [];
            return a.forEach(function(a) {
                if (a instanceof HTMLElement) {
                    if (!d) return void e.push(a);
                    b(a, d) && e.push(a);
                    for (var c = a.querySelectorAll(d), f = 0; f < c.length; f++) e.push(c[f])
                }
            }), e
        }, c.debounceMethod = function(a, b, c) {
            var d = a.prototype[b],
                e = b + "Timeout";
            a.prototype[b] = function() {
                var a = this[e];
                a && clearTimeout(a);
                var b = arguments,
                    f = this;
                this[e] = setTimeout(function() {
                    d.apply(f, b), delete f[e]
                }, c || 100)
            }
        }, c.docReady = function(a) {
            "complete" == document.readyState ? a() : document.addEventListener("DOMContentLoaded", a)
        }, c.toDashed = function(a) {
            return a.replace(/(.)([A-Z])/g, function(a, b, c) {
                return b + "-" + c
            }).toLowerCase()
        };
        var d = a.console;
        return c.htmlInit = function(b, e) {
            c.docReady(function() {
                var f = c.toDashed(e),
                    g = "data-" + f,
                    h = document.querySelectorAll("[" + g + "]"),
                    i = document.querySelectorAll(".js-" + f),
                    j = c.makeArray(h).concat(c.makeArray(i)),
                    k = g + "-options",
                    l = a.jQuery;
                j.forEach(function(a) {
                    var c, f = a.getAttribute(g) || a.getAttribute(k);
                    try {
                        c = f && JSON.parse(f)
                    } catch (h) {
                        return void(d && d.error("Error parsing " + g + " on " + a.className + ": " + h))
                    }
                    var i = new b(a, c);
                    l && l.data(a, e, i)
                })
            })
        }, c
    }),
    function(a, b) {
        "function" == typeof define && define.amd ? define("outlayer/item", ["ev-emitter/ev-emitter", "get-size/get-size"], b) : "object" == typeof module && module.exports ? module.exports = b(require("ev-emitter"), require("get-size")) : (a.Outlayer = {}, a.Outlayer.Item = b(a.EvEmitter, a.getSize))
    }(window, function(a, b) {
        "use strict";

        function c(a) {
            for (var b in a) return !1;
            return b = null, !0
        }

        function d(a, b) {
            a && (this.element = a, this.layout = b, this.position = {
                x: 0,
                y: 0
            }, this._create())
        }

        function e(a) {
            return a.replace(/([A-Z])/g, function(a) {
                return "-" + a.toLowerCase()
            })
        }
        var f = document.documentElement.style,
            g = "string" == typeof f.transition ? "transition" : "WebkitTransition",
            h = "string" == typeof f.transform ? "transform" : "WebkitTransform",
            i = {
                WebkitTransition: "webkitTransitionEnd",
                transition: "transitionend"
            }[g],
            j = {
                transform: h,
                transition: g,
                transitionDuration: g + "Duration",
                transitionProperty: g + "Property",
                transitionDelay: g + "Delay"
            },
            k = d.prototype = Object.create(a.prototype);
        k.constructor = d, k._create = function() {
            this._transn = {
                ingProperties: {},
                clean: {},
                onEnd: {}
            }, this.css({
                position: "absolute"
            })
        }, k.handleEvent = function(a) {
            var b = "on" + a.type;
            this[b] && this[b](a)
        }, k.getSize = function() {
            this.size = b(this.element)
        }, k.css = function(a) {
            var b = this.element.style;
            for (var c in a) {
                var d = j[c] || c;
                b[d] = a[c]
            }
        }, k.getPosition = function() {
            var a = getComputedStyle(this.element),
                b = this.layout._getOption("originLeft"),
                c = this.layout._getOption("originTop"),
                d = a[b ? "left" : "right"],
                e = a[c ? "top" : "bottom"],
                f = this.layout.size,
                g = -1 != d.indexOf("%") ? parseFloat(d) / 100 * f.width : parseInt(d, 10),
                h = -1 != e.indexOf("%") ? parseFloat(e) / 100 * f.height : parseInt(e, 10);
            g = isNaN(g) ? 0 : g, h = isNaN(h) ? 0 : h, g -= b ? f.paddingLeft : f.paddingRight, h -= c ? f.paddingTop : f.paddingBottom, this.position.x = g, this.position.y = h
        }, k.layoutPosition = function() {
            var a = this.layout.size,
                b = {},
                c = this.layout._getOption("originLeft"),
                d = this.layout._getOption("originTop"),
                e = c ? "paddingLeft" : "paddingRight",
                f = c ? "left" : "right",
                g = c ? "right" : "left",
                h = this.position.x + a[e];
            b[f] = this.getXValue(h), b[g] = "";
            var i = d ? "paddingTop" : "paddingBottom",
                j = d ? "top" : "bottom",
                k = d ? "bottom" : "top",
                l = this.position.y + a[i];
            b[j] = this.getYValue(l), b[k] = "", this.css(b), this.emitEvent("layout", [this])
        }, k.getXValue = function(a) {
            var b = this.layout._getOption("horizontal");
            return this.layout.options.percentPosition && !b ? a / this.layout.size.width * 100 + "%" : a + "px"
        }, k.getYValue = function(a) {
            var b = this.layout._getOption("horizontal");
            return this.layout.options.percentPosition && b ? a / this.layout.size.height * 100 + "%" : a + "px"
        }, k._transitionTo = function(a, b) {
            this.getPosition();
            var c = this.position.x,
                d = this.position.y,
                e = parseInt(a, 10),
                f = parseInt(b, 10),
                g = e === this.position.x && f === this.position.y;
            if (this.setPosition(a, b), g && !this.isTransitioning) return void this.layoutPosition();
            var h = a - c,
                i = b - d,
                j = {};
            j.transform = this.getTranslate(h, i), this.transition({
                to: j,
                onTransitionEnd: {
                    transform: this.layoutPosition
                },
                isCleaning: !0
            })
        }, k.getTranslate = function(a, b) {
            var c = this.layout._getOption("originLeft"),
                d = this.layout._getOption("originTop");
            return a = c ? a : -a, b = d ? b : -b, "translate3d(" + a + "px, " + b + "px, 0)"
        }, k.goTo = function(a, b) {
            this.setPosition(a, b), this.layoutPosition()
        }, k.moveTo = k._transitionTo, k.setPosition = function(a, b) {
            this.position.x = parseInt(a, 10), this.position.y = parseInt(b, 10)
        }, k._nonTransition = function(a) {
            this.css(a.to), a.isCleaning && this._removeStyles(a.to);
            for (var b in a.onTransitionEnd) a.onTransitionEnd[b].call(this)
        }, k.transition = function(a) {
            if (!parseFloat(this.layout.options.transitionDuration)) return void this._nonTransition(a);
            var b = this._transn;
            for (var c in a.onTransitionEnd) b.onEnd[c] = a.onTransitionEnd[c];
            for (c in a.to) b.ingProperties[c] = !0, a.isCleaning && (b.clean[c] = !0);
            if (a.from) {
                this.css(a.from);
                var d = this.element.offsetHeight;
                d = null
            }
            this.enableTransition(a.to), this.css(a.to), this.isTransitioning = !0
        };
        var l = "opacity," + e(h);
        k.enableTransition = function() {
            if (!this.isTransitioning) {
                var a = this.layout.options.transitionDuration;
                a = "number" == typeof a ? a + "ms" : a, this.css({
                    transitionProperty: l,
                    transitionDuration: a,
                    transitionDelay: this.staggerDelay || 0
                }), this.element.addEventListener(i, this, !1)
            }
        }, k.onwebkitTransitionEnd = function(a) {
            this.ontransitionend(a)
        }, k.onotransitionend = function(a) {
            this.ontransitionend(a)
        };
        var m = {
            "-webkit-transform": "transform"
        };
        k.ontransitionend = function(a) {
            if (a.target === this.element) {
                var b = this._transn,
                    d = m[a.propertyName] || a.propertyName;
                if (delete b.ingProperties[d], c(b.ingProperties) && this.disableTransition(), d in b.clean && (this.element.style[a.propertyName] = "", delete b.clean[d]), d in b.onEnd) {
                    var e = b.onEnd[d];
                    e.call(this), delete b.onEnd[d]
                }
                this.emitEvent("transitionEnd", [this])
            }
        }, k.disableTransition = function() {
            this.removeTransitionStyles(), this.element.removeEventListener(i, this, !1), this.isTransitioning = !1
        }, k._removeStyles = function(a) {
            var b = {};
            for (var c in a) b[c] = "";
            this.css(b)
        };
        var n = {
            transitionProperty: "",
            transitionDuration: "",
            transitionDelay: ""
        };
        return k.removeTransitionStyles = function() {
            this.css(n)
        }, k.stagger = function(a) {
            a = isNaN(a) ? 0 : a, this.staggerDelay = a + "ms"
        }, k.removeElem = function() {
            this.element.parentNode.removeChild(this.element), this.css({
                display: ""
            }), this.emitEvent("remove", [this])
        }, k.remove = function() {
            return g && parseFloat(this.layout.options.transitionDuration) ? (this.once("transitionEnd", function() {
                this.removeElem()
            }), void this.hide()) : void this.removeElem()
        }, k.reveal = function() {
            delete this.isHidden, this.css({
                display: ""
            });
            var a = this.layout.options,
                b = {},
                c = this.getHideRevealTransitionEndProperty("visibleStyle");
            b[c] = this.onRevealTransitionEnd, this.transition({
                from: a.hiddenStyle,
                to: a.visibleStyle,
                isCleaning: !0,
                onTransitionEnd: b
            })
        }, k.onRevealTransitionEnd = function() {
            this.isHidden || this.emitEvent("reveal")
        }, k.getHideRevealTransitionEndProperty = function(a) {
            var b = this.layout.options[a];
            if (b.opacity) return "opacity";
            for (var c in b) return c
        }, k.hide = function() {
            this.isHidden = !0, this.css({
                display: ""
            });
            var a = this.layout.options,
                b = {},
                c = this.getHideRevealTransitionEndProperty("hiddenStyle");
            b[c] = this.onHideTransitionEnd, this.transition({
                from: a.visibleStyle,
                to: a.hiddenStyle,
                isCleaning: !0,
                onTransitionEnd: b
            })
        }, k.onHideTransitionEnd = function() {
            this.isHidden && (this.css({
                display: "none"
            }), this.emitEvent("hide"))
        }, k.destroy = function() {
            this.css({
                position: "",
                left: "",
                right: "",
                top: "",
                bottom: "",
                transition: "",
                transform: ""
            })
        }, d
    }),
    function(a, b) {
        "use strict";
        "function" == typeof define && define.amd ? define("outlayer/outlayer", ["ev-emitter/ev-emitter", "get-size/get-size", "fizzy-ui-utils/utils", "./item"], function(c, d, e, f) {
            return b(a, c, d, e, f)
        }) : "object" == typeof module && module.exports ? module.exports = b(a, require("ev-emitter"), require("get-size"), require("fizzy-ui-utils"), require("./item")) : a.Outlayer = b(a, a.EvEmitter, a.getSize, a.fizzyUIUtils, a.Outlayer.Item)
    }(window, function(a, b, c, d, e) {
        "use strict";

        function f(a, b) {
            var c = d.getQueryElement(a);
            if (!c) return void(i && i.error("Bad element for " + this.constructor.namespace + ": " + (c || a)));
            this.element = c, j && (this.$element = j(this.element)), this.options = d.extend({}, this.constructor.defaults), this.option(b);
            var e = ++l;
            this.element.outlayerGUID = e, m[e] = this, this._create();
            var f = this._getOption("initLayout");
            f && this.layout()
        }

        function g(a) {
            function b() {
                a.apply(this, arguments)
            }
            return b.prototype = Object.create(a.prototype), b.prototype.constructor = b, b
        }

        function h(a) {
            if ("number" == typeof a) return a;
            var b = a.match(/(^\d*\.?\d*)(\w*)/),
                c = b && b[1],
                d = b && b[2];
            if (!c.length) return 0;
            c = parseFloat(c);
            var e = o[d] || 1;
            return c * e
        }
        var i = a.console,
            j = a.jQuery,
            k = function() {},
            l = 0,
            m = {};
        f.namespace = "outlayer", f.Item = e, f.defaults = {
            containerStyle: {
                position: "relative"
            },
            initLayout: !0,
            originLeft: !0,
            originTop: !0,
            resize: !0,
            resizeContainer: !0,
            transitionDuration: "0.4s",
            hiddenStyle: {
                opacity: 0,
                transform: "scale(0.001)"
            },
            visibleStyle: {
                opacity: 1,
                transform: "scale(1)"
            }
        };
        var n = f.prototype;
        d.extend(n, b.prototype), n.option = function(a) {
            d.extend(this.options, a)
        }, n._getOption = function(a) {
            var b = this.constructor.compatOptions[a];
            return b && void 0 !== this.options[b] ? this.options[b] : this.options[a]
        }, f.compatOptions = {
            initLayout: "isInitLayout",
            horizontal: "isHorizontal",
            layoutInstant: "isLayoutInstant",
            originLeft: "isOriginLeft",
            originTop: "isOriginTop",
            resize: "isResizeBound",
            resizeContainer: "isResizingContainer"
        }, n._create = function() {
            this.reloadItems(), this.stamps = [], this.stamp(this.options.stamp), d.extend(this.element.style, this.options.containerStyle);
            var a = this._getOption("resize");
            a && this.bindResize()
        }, n.reloadItems = function() {
            this.items = this._itemize(this.element.children)
        }, n._itemize = function(a) {
            for (var b = this._filterFindItemElements(a), c = this.constructor.Item, d = [], e = 0; e < b.length; e++) {
                var f = b[e],
                    g = new c(f, this);
                d.push(g)
            }
            return d
        }, n._filterFindItemElements = function(a) {
            return d.filterFindElements(a, this.options.itemSelector)
        }, n.getItemElements = function() {
            return this.items.map(function(a) {
                return a.element
            })
        }, n.layout = function() {
            this._resetLayout(), this._manageStamps();
            var a = this._getOption("layoutInstant"),
                b = void 0 !== a ? a : !this._isLayoutInited;
            this.layoutItems(this.items, b), this._isLayoutInited = !0
        }, n._init = n.layout, n._resetLayout = function() {
            this.getSize()
        }, n.getSize = function() {
            this.size = c(this.element)
        }, n._getMeasurement = function(a, b) {
            var d, e = this.options[a];
            e ? ("string" == typeof e ? d = this.element.querySelector(e) : e instanceof HTMLElement && (d = e), this[a] = d ? c(d)[b] : e) : this[a] = 0
        }, n.layoutItems = function(a, b) {
            a = this._getItemsForLayout(a), this._layoutItems(a, b), this._postLayout()
        }, n._getItemsForLayout = function(a) {
            return a.filter(function(a) {
                return !a.isIgnored
            })
        }, n._layoutItems = function(a, b) {
            if (this._emitCompleteOnItems("layout", a), a && a.length) {
                var c = [];
                a.forEach(function(a) {
                    var d = this._getItemLayoutPosition(a);
                    d.item = a, d.isInstant = b || a.isLayoutInstant, c.push(d)
                }, this), this._processLayoutQueue(c)
            }
        }, n._getItemLayoutPosition = function() {
            return {
                x: 0,
                y: 0
            }
        }, n._processLayoutQueue = function(a) {
            this.updateStagger(), a.forEach(function(a, b) {
                this._positionItem(a.item, a.x, a.y, a.isInstant, b)
            }, this)
        }, n.updateStagger = function() {
            var a = this.options.stagger;
            return null === a || void 0 === a ? void(this.stagger = 0) : (this.stagger = h(a), this.stagger)
        }, n._positionItem = function(a, b, c, d, e) {
            d ? a.goTo(b, c) : (a.stagger(e * this.stagger), a.moveTo(b, c))
        }, n._postLayout = function() {
            this.resizeContainer()
        }, n.resizeContainer = function() {
            var a = this._getOption("resizeContainer");
            if (a) {
                var b = this._getContainerSize();
                b && (this._setContainerMeasure(b.width, !0), this._setContainerMeasure(b.height, !1))
            }
        }, n._getContainerSize = k, n._setContainerMeasure = function(a, b) {
            if (void 0 !== a) {
                var c = this.size;
                c.isBorderBox && (a += b ? c.paddingLeft + c.paddingRight + c.borderLeftWidth + c.borderRightWidth : c.paddingBottom + c.paddingTop + c.borderTopWidth + c.borderBottomWidth), a = Math.max(a, 0), this.element.style[b ? "width" : "height"] = a + "px"
            }
        }, n._emitCompleteOnItems = function(a, b) {
            function c() {
                e.dispatchEvent(a + "Complete", null, [b])
            }

            function d() {
                g++, g == f && c()
            }
            var e = this,
                f = b.length;
            if (!b || !f) return void c();
            var g = 0;
            b.forEach(function(b) {
                b.once(a, d)
            })
        }, n.dispatchEvent = function(a, b, c) {
            var d = b ? [b].concat(c) : c;
            if (this.emitEvent(a, d), j)
                if (this.$element = this.$element || j(this.element), b) {
                    var e = j.Event(b);
                    e.type = a, this.$element.trigger(e, c)
                } else this.$element.trigger(a, c)
        }, n.ignore = function(a) {
            var b = this.getItem(a);
            b && (b.isIgnored = !0)
        }, n.unignore = function(a) {
            var b = this.getItem(a);
            b && delete b.isIgnored
        }, n.stamp = function(a) {
            a = this._find(a), a && (this.stamps = this.stamps.concat(a), a.forEach(this.ignore, this))
        }, n.unstamp = function(a) {
            a = this._find(a), a && a.forEach(function(a) {
                d.removeFrom(this.stamps, a), this.unignore(a)
            }, this)
        }, n._find = function(a) {
            return a ? ("string" == typeof a && (a = this.element.querySelectorAll(a)), a = d.makeArray(a)) : void 0
        }, n._manageStamps = function() {
            this.stamps && this.stamps.length && (this._getBoundingRect(), this.stamps.forEach(this._manageStamp, this))
        }, n._getBoundingRect = function() {
            var a = this.element.getBoundingClientRect(),
                b = this.size;
            this._boundingRect = {
                left: a.left + b.paddingLeft + b.borderLeftWidth,
                top: a.top + b.paddingTop + b.borderTopWidth,
                right: a.right - (b.paddingRight + b.borderRightWidth),
                bottom: a.bottom - (b.paddingBottom + b.borderBottomWidth)
            }
        }, n._manageStamp = k, n._getElementOffset = function(a) {
            var b = a.getBoundingClientRect(),
                d = this._boundingRect,
                e = c(a),
                f = {
                    left: b.left - d.left - e.marginLeft,
                    top: b.top - d.top - e.marginTop,
                    right: d.right - b.right - e.marginRight,
                    bottom: d.bottom - b.bottom - e.marginBottom
                };
            return f
        }, n.handleEvent = d.handleEvent, n.bindResize = function() {
            a.addEventListener("resize", this), this.isResizeBound = !0
        }, n.unbindResize = function() {
            a.removeEventListener("resize", this), this.isResizeBound = !1
        }, n.onresize = function() {
            this.resize()
        }, d.debounceMethod(f, "onresize", 100), n.resize = function() {
            this.isResizeBound && this.needsResizeLayout() && this.layout()
        }, n.needsResizeLayout = function() {
            var a = c(this.element),
                b = this.size && a;
            return b && a.innerWidth !== this.size.innerWidth
        }, n.addItems = function(a) {
            var b = this._itemize(a);
            return b.length && (this.items = this.items.concat(b)), b
        }, n.appended = function(a) {
            var b = this.addItems(a);
            b.length && (this.layoutItems(b, !0), this.reveal(b))
        }, n.prepended = function(a) {
            var b = this._itemize(a);
            if (b.length) {
                var c = this.items.slice(0);
                this.items = b.concat(c), this._resetLayout(), this._manageStamps(), this.layoutItems(b, !0), this.reveal(b), this.layoutItems(c)
            }
        }, n.reveal = function(a) {
            if (this._emitCompleteOnItems("reveal", a), a && a.length) {
                var b = this.updateStagger();
                a.forEach(function(a, c) {
                    a.stagger(c * b), a.reveal()
                })
            }
        }, n.hide = function(a) {
            if (this._emitCompleteOnItems("hide", a), a && a.length) {
                var b = this.updateStagger();
                a.forEach(function(a, c) {
                    a.stagger(c * b), a.hide()
                })
            }
        }, n.revealItemElements = function(a) {
            var b = this.getItems(a);
            this.reveal(b)
        }, n.hideItemElements = function(a) {
            var b = this.getItems(a);
            this.hide(b)
        }, n.getItem = function(a) {
            for (var b = 0; b < this.items.length; b++) {
                var c = this.items[b];
                if (c.element == a) return c
            }
        }, n.getItems = function(a) {
            a = d.makeArray(a);
            var b = [];
            return a.forEach(function(a) {
                var c = this.getItem(a);
                c && b.push(c)
            }, this), b
        }, n.remove = function(a) {
            var b = this.getItems(a);
            this._emitCompleteOnItems("remove", b), b && b.length && b.forEach(function(a) {
                a.remove(), d.removeFrom(this.items, a)
            }, this)
        }, n.destroy = function() {
            var a = this.element.style;
            a.height = "", a.position = "", a.width = "", this.items.forEach(function(a) {
                a.destroy()
            }), this.unbindResize();
            var b = this.element.outlayerGUID;
            delete m[b], delete this.element.outlayerGUID, j && j.removeData(this.element, this.constructor.namespace)
        }, f.data = function(a) {
            a = d.getQueryElement(a);
            var b = a && a.outlayerGUID;
            return b && m[b]
        }, f.create = function(a, b) {
            var c = g(f);
            return c.defaults = d.extend({}, f.defaults), d.extend(c.defaults, b), c.compatOptions = d.extend({}, f.compatOptions), c.namespace = a, c.data = f.data, c.Item = g(e), d.htmlInit(c, a), j && j.bridget && j.bridget(a, c), c
        };
        var o = {
            ms: 1,
            s: 1e3
        };
        return f.Item = e, f
    }),
    function(a, b) {
        "function" == typeof define && define.amd ? define("packery/js/rect", b) : "object" == typeof module && module.exports ? module.exports = b() : (a.Packery = a.Packery || {}, a.Packery.Rect = b())
    }(window, function() {
        "use strict";

        function a(b) {
            for (var c in a.defaults) this[c] = a.defaults[c];
            for (c in b) this[c] = b[c]
        }
        a.defaults = {
            x: 0,
            y: 0,
            width: 0,
            height: 0
        };
        var b = a.prototype;
        return b.contains = function(a) {
            var b = a.width || 0,
                c = a.height || 0;
            return this.x <= a.x && this.y <= a.y && this.x + this.width >= a.x + b && this.y + this.height >= a.y + c
        }, b.overlaps = function(a) {
            var b = this.x + this.width,
                c = this.y + this.height,
                d = a.x + a.width,
                e = a.y + a.height;
            return this.x < d && b > a.x && this.y < e && c > a.y
        }, b.getMaximalFreeRects = function(b) {
            if (!this.overlaps(b)) return !1;
            var c, d = [],
                e = this.x + this.width,
                f = this.y + this.height,
                g = b.x + b.width,
                h = b.y + b.height;
            return this.y < b.y && (c = new a({
                x: this.x,
                y: this.y,
                width: this.width,
                height: b.y - this.y
            }), d.push(c)), e > g && (c = new a({
                x: g,
                y: this.y,
                width: e - g,
                height: this.height
            }), d.push(c)), f > h && (c = new a({
                x: this.x,
                y: h,
                width: this.width,
                height: f - h
            }), d.push(c)), this.x < b.x && (c = new a({
                x: this.x,
                y: this.y,
                width: b.x - this.x,
                height: this.height
            }), d.push(c)), d
        }, b.canFit = function(a) {
            return this.width >= a.width && this.height >= a.height
        }, a
    }),
    function(a, b) {
        if ("function" == typeof define && define.amd) define("packery/js/packer", ["./rect"], b);
        else if ("object" == typeof module && module.exports) module.exports = b(require("./rect"));
        else {
            var c = a.Packery = a.Packery || {};
            c.Packer = b(c.Rect)
        }
    }(window, function(a) {
        "use strict";

        function b(a, b, c) {
            this.width = a || 0, this.height = b || 0, this.sortDirection = c || "downwardLeftToRight", this.reset()
        }
        var c = b.prototype;
        c.reset = function() {
            this.spaces = [];
            var b = new a({
                x: 0,
                y: 0,
                width: this.width,
                height: this.height
            });
            this.spaces.push(b), this.sorter = d[this.sortDirection] || d.downwardLeftToRight
        }, c.pack = function(a) {
            for (var b = 0; b < this.spaces.length; b++) {
                var c = this.spaces[b];
                if (c.canFit(a)) {
                    this.placeInSpace(a, c);
                    break
                }
            }
        }, c.columnPack = function(a) {
            for (var b = 0; b < this.spaces.length; b++) {
                var c = this.spaces[b],
                    d = c.x <= a.x && c.x + c.width >= a.x + a.width && c.height >= a.height - .01;
                if (d) {
                    a.y = c.y, this.placed(a);
                    break
                }
            }
        }, c.rowPack = function(a) {
            for (var b = 0; b < this.spaces.length; b++) {
                var c = this.spaces[b],
                    d = c.y <= a.y && c.y + c.height >= a.y + a.height && c.width >= a.width - .01;
                if (d) {
                    a.x = c.x, this.placed(a);
                    break
                }
            }
        }, c.placeInSpace = function(a, b) {
            a.x = b.x, a.y = b.y, this.placed(a)
        }, c.placed = function(a) {
            for (var b = [], c = 0; c < this.spaces.length; c++) {
                var d = this.spaces[c],
                    e = d.getMaximalFreeRects(a);
                e ? b.push.apply(b, e) : b.push(d)
            }
            this.spaces = b, this.mergeSortSpaces()
        }, c.mergeSortSpaces = function() {
            b.mergeRects(this.spaces), this.spaces.sort(this.sorter)
        }, c.addSpace = function(a) {
            this.spaces.push(a), this.mergeSortSpaces()
        }, b.mergeRects = function(a) {
            var b = 0,
                c = a[b];
            a: for (; c;) {
                for (var d = 0, e = a[b + d]; e;) {
                    if (e == c) d++;
                    else {
                        if (e.contains(c)) {
                            a.splice(b, 1), c = a[b];
                            continue a
                        }
                        c.contains(e) ? a.splice(b + d, 1) : d++
                    }
                    e = a[b + d]
                }
                b++, c = a[b]
            }
            return a
        };
        var d = {
            downwardLeftToRight: function(a, b) {
                return a.y - b.y || a.x - b.x
            },
            rightwardTopToBottom: function(a, b) {
                return a.x - b.x || a.y - b.y
            }
        };
        return b
    }),
    function(a, b) {
        "function" == typeof define && define.amd ? define("packery/js/item", ["outlayer/outlayer", "./rect"], b) : "object" == typeof module && module.exports ? module.exports = b(require("outlayer"), require("./rect")) : a.Packery.Item = b(a.Outlayer, a.Packery.Rect)
    }(window, function(a, b) {
        "use strict";
        var c = document.documentElement.style,
            d = "string" == typeof c.transform ? "transform" : "WebkitTransform",
            e = function() {
                a.Item.apply(this, arguments)
            },
            f = e.prototype = Object.create(a.Item.prototype),
            g = f._create;
        f._create = function() {
            g.call(this), this.rect = new b
        };
        var h = f.moveTo;
        return f.moveTo = function(a, b) {
            var c = Math.abs(this.position.x - a),
                d = Math.abs(this.position.y - b),
                e = this.layout.dragItemCount && !this.isPlacing && !this.isTransitioning && 1 > c && 1 > d;
            return e ? void this.goTo(a, b) : void h.apply(this, arguments)
        }, f.enablePlacing = function() {
            this.removeTransitionStyles(), this.isTransitioning && d && (this.element.style[d] = "none"), this.isTransitioning = !1, this.getSize(), this.layout._setRectSize(this.element, this.rect), this.isPlacing = !0
        }, f.disablePlacing = function() {
            this.isPlacing = !1
        }, f.removeElem = function() {
            this.element.parentNode.removeChild(this.element), this.layout.packer.addSpace(this.rect),
                this.emitEvent("remove", [this])
        }, f.showDropPlaceholder = function() {
            var a = this.dropPlaceholder;
            a || (a = this.dropPlaceholder = document.createElement("div"), a.className = "packery-drop-placeholder", a.style.position = "absolute"), a.style.width = this.size.width + "px", a.style.height = this.size.height + "px", this.positionDropPlaceholder(), this.layout.element.appendChild(a)
        }, f.positionDropPlaceholder = function() {
            this.dropPlaceholder.style[d] = "translate(" + this.rect.x + "px, " + this.rect.y + "px)"
        }, f.hideDropPlaceholder = function() {
            var a = this.dropPlaceholder.parentNode;
            a && a.removeChild(this.dropPlaceholder)
        }, e
    }),
    function(a, b) {
        "function" == typeof define && define.amd ? define(["get-size/get-size", "outlayer/outlayer", "packery/js/rect", "packery/js/packer", "packery/js/item"], b) : "object" == typeof module && module.exports ? module.exports = b(require("get-size"), require("outlayer"), require("./rect"), require("./packer"), require("./item")) : a.Packery = b(a.getSize, a.Outlayer, a.Packery.Rect, a.Packery.Packer, a.Packery.Item)
    }(window, function(a, b, c, d, e) {
        "use strict";

        function f(a, b) {
            return a.position.y - b.position.y || a.position.x - b.position.x
        }

        function g(a, b) {
            return a.position.x - b.position.x || a.position.y - b.position.y
        }

        function h(a, b) {
            var c = b.x - a.x,
                d = b.y - a.y;
            return Math.sqrt(c * c + d * d)
        }
        c.prototype.canFit = function(a) {
            return this.width >= a.width - 1 && this.height >= a.height - 1
        };
        var i = b.create("packery");
        i.Item = e;
        var j = i.prototype;
        j._create = function() {
            b.prototype._create.call(this), this.packer = new d, this.shiftPacker = new d, this.isEnabled = !0, this.dragItemCount = 0;
            var a = this;
            this.handleDraggabilly = {
                dragStart: function() {
                    a.itemDragStart(this.element)
                },
                dragMove: function() {
                    a.itemDragMove(this.element, this.position.x, this.position.y)
                },
                dragEnd: function() {
                    a.itemDragEnd(this.element)
                }
            }, this.handleUIDraggable = {
                start: function(b, c) {
                    c && a.itemDragStart(b.currentTarget)
                },
                drag: function(b, c) {
                    c && a.itemDragMove(b.currentTarget, c.position.left, c.position.top)
                },
                stop: function(b, c) {
                    c && a.itemDragEnd(b.currentTarget)
                }
            }
        }, j._resetLayout = function() {
            this.getSize(), this._getMeasurements();
            var a, b, c;
            this._getOption("horizontal") ? (a = 1 / 0, b = this.size.innerHeight + this.gutter, c = "rightwardTopToBottom") : (a = this.size.innerWidth + this.gutter, b = 1 / 0, c = "downwardLeftToRight"), this.packer.width = this.shiftPacker.width = a, this.packer.height = this.shiftPacker.height = b, this.packer.sortDirection = this.shiftPacker.sortDirection = c, this.packer.reset(), this.maxY = 0, this.maxX = 0
        }, j._getMeasurements = function() {
            this._getMeasurement("columnWidth", "width"), this._getMeasurement("rowHeight", "height"), this._getMeasurement("gutter", "width")
        }, j._getItemLayoutPosition = function(a) {
            if (this._setRectSize(a.element, a.rect), this.isShifting || this.dragItemCount > 0) {
                var b = this._getPackMethod();
                this.packer[b](a.rect)
            } else this.packer.pack(a.rect);
            return this._setMaxXY(a.rect), a.rect
        }, j.shiftLayout = function() {
            this.isShifting = !0, this.layout(), delete this.isShifting
        }, j._getPackMethod = function() {
            return this._getOption("horizontal") ? "rowPack" : "columnPack"
        }, j._setMaxXY = function(a) {
            this.maxX = Math.max(a.x + a.width, this.maxX), this.maxY = Math.max(a.y + a.height, this.maxY)
        }, j._setRectSize = function(b, c) {
            var d = a(b),
                e = d.outerWidth,
                f = d.outerHeight;
            (e || f) && (e = this._applyGridGutter(e, this.columnWidth), f = this._applyGridGutter(f, this.rowHeight)), c.width = Math.min(e, this.packer.width), c.height = Math.min(f, this.packer.height)
        }, j._applyGridGutter = function(a, b) {
            if (!b) return a + this.gutter;
            b += this.gutter;
            var c = a % b,
                d = c && 1 > c ? "round" : "ceil";
            return a = Math[d](a / b) * b
        }, j._getContainerSize = function() {
            return this._getOption("horizontal") ? {
                width: this.maxX - this.gutter
            } : {
                height: this.maxY - this.gutter
            }
        }, j._manageStamp = function(a) {
            var b, d = this.getItem(a);
            if (d && d.isPlacing) b = d.rect;
            else {
                var e = this._getElementOffset(a);
                b = new c({
                    x: this._getOption("originLeft") ? e.left : e.right,
                    y: this._getOption("originTop") ? e.top : e.bottom
                })
            }
            this._setRectSize(a, b), this.packer.placed(b), this._setMaxXY(b)
        }, j.sortItemsByPosition = function() {
            var a = this._getOption("horizontal") ? g : f;
            this.items.sort(a)
        }, j.fit = function(a, b, c) {
            var d = this.getItem(a);
            d && (this.stamp(d.element), d.enablePlacing(), this.updateShiftTargets(d), b = void 0 === b ? d.rect.x : b, c = void 0 === c ? d.rect.y : c, this.shift(d, b, c), this._bindFitEvents(d), d.moveTo(d.rect.x, d.rect.y), this.shiftLayout(), this.unstamp(d.element), this.sortItemsByPosition(), d.disablePlacing())
        }, j._bindFitEvents = function(a) {
            function b() {
                d++, 2 == d && c.dispatchEvent("fitComplete", null, [a])
            }
            var c = this,
                d = 0;
            a.once("layout", b), this.once("layoutComplete", b)
        }, j.resize = function() {
            this.isResizeBound && this.needsResizeLayout() && (this.options.shiftPercentResize ? this.resizeShiftPercentLayout() : this.layout())
        }, j.needsResizeLayout = function() {
            var b = a(this.element),
                c = this._getOption("horizontal") ? "innerHeight" : "innerWidth";
            return b[c] != this.size[c]
        }, j.resizeShiftPercentLayout = function() {
            var b = this._getItemsForLayout(this.items),
                c = this._getOption("horizontal"),
                d = c ? "y" : "x",
                e = c ? "height" : "width",
                f = c ? "rowHeight" : "columnWidth",
                g = c ? "innerHeight" : "innerWidth",
                h = this[f];
            if (h = h && h + this.gutter) {
                this._getMeasurements();
                var i = this[f] + this.gutter;
                b.forEach(function(a) {
                    var b = Math.round(a.rect[d] / h);
                    a.rect[d] = b * i
                })
            } else {
                var j = a(this.element)[g] + this.gutter,
                    k = this.packer[e];
                b.forEach(function(a) {
                    a.rect[d] = a.rect[d] / k * j
                })
            }
            this.shiftLayout()
        }, j.itemDragStart = function(a) {
            if (this.isEnabled) {
                this.stamp(a);
                var b = this.getItem(a);
                b && (b.enablePlacing(), b.showDropPlaceholder(), this.dragItemCount++, this.updateShiftTargets(b))
            }
        }, j.updateShiftTargets = function(a) {
            this.shiftPacker.reset(), this._getBoundingRect();
            var b = this._getOption("originLeft"),
                d = this._getOption("originTop");
            this.stamps.forEach(function(a) {
                var e = this.getItem(a);
                if (!e || !e.isPlacing) {
                    var f = this._getElementOffset(a),
                        g = new c({
                            x: b ? f.left : f.right,
                            y: d ? f.top : f.bottom
                        });
                    this._setRectSize(a, g), this.shiftPacker.placed(g)
                }
            }, this);
            var e = this._getOption("horizontal"),
                f = e ? "rowHeight" : "columnWidth",
                g = e ? "height" : "width";
            this.shiftTargetKeys = [], this.shiftTargets = [];
            var h, i = this[f];
            if (i = i && i + this.gutter) {
                var j = Math.ceil(a.rect[g] / i),
                    k = Math.floor((this.shiftPacker[g] + this.gutter) / i);
                h = (k - j) * i;
                for (var l = 0; k > l; l++) {
                    var m = e ? 0 : l * i,
                        n = e ? l * i : 0;
                    this._addShiftTarget(m, n, h)
                }
            } else h = this.shiftPacker[g] + this.gutter - a.rect[g], this._addShiftTarget(0, 0, h);
            var o = this._getItemsForLayout(this.items),
                p = this._getPackMethod();
            o.forEach(function(a) {
                var b = a.rect;
                this._setRectSize(a.element, b), this.shiftPacker[p](b), this._addShiftTarget(b.x, b.y, h);
                var c = e ? b.x + b.width : b.x,
                    d = e ? b.y : b.y + b.height;
                if (this._addShiftTarget(c, d, h), i)
                    for (var f = Math.round(b[g] / i), j = 1; f > j; j++) {
                        var k = e ? c : b.x + i * j,
                            l = e ? b.y + i * j : d;
                        this._addShiftTarget(k, l, h)
                    }
            }, this)
        }, j._addShiftTarget = function(a, b, c) {
            var d = this._getOption("horizontal") ? b : a;
            if (!(0 !== d && d > c)) {
                var e = a + "," + b,
                    f = -1 != this.shiftTargetKeys.indexOf(e);
                f || (this.shiftTargetKeys.push(e), this.shiftTargets.push({
                    x: a,
                    y: b
                }))
            }
        }, j.shift = function(a, b, c) {
            var d, e = 1 / 0,
                f = {
                    x: b,
                    y: c
                };
            this.shiftTargets.forEach(function(a) {
                var b = h(a, f);
                e > b && (d = a, e = b)
            }), a.rect.x = d.x, a.rect.y = d.y
        };
        var k = 120;
        j.itemDragMove = function(a, b, c) {
            function d() {
                f.shift(e, b, c), e.positionDropPlaceholder(), f.layout()
            }
            var e = this.isEnabled && this.getItem(a);
            if (e) {
                b -= this.size.paddingLeft, c -= this.size.paddingTop;
                var f = this,
                    g = new Date;
                this._itemDragTime && g - this._itemDragTime < k ? (clearTimeout(this.dragTimeout), this.dragTimeout = setTimeout(d, k)) : (d(), this._itemDragTime = g)
            }
        }, j.itemDragEnd = function(a) {
            function b() {
                d++, 2 == d && (c.element.classList.remove("is-positioning-post-drag"), c.hideDropPlaceholder(), e.dispatchEvent("dragItemPositioned", null, [c]))
            }
            var c = this.isEnabled && this.getItem(a);
            if (c) {
                clearTimeout(this.dragTimeout), c.element.classList.add("is-positioning-post-drag");
                var d = 0,
                    e = this;
                c.once("layout", b), this.once("layoutComplete", b), c.moveTo(c.rect.x, c.rect.y), this.layout(), this.dragItemCount = Math.max(0, this.dragItemCount - 1), this.sortItemsByPosition(), c.disablePlacing(), this.unstamp(c.element)
            }
        }, j.bindDraggabillyEvents = function(a) {
            this._bindDraggabillyEvents(a, "on")
        }, j.unbindDraggabillyEvents = function(a) {
            this._bindDraggabillyEvents(a, "off")
        }, j._bindDraggabillyEvents = function(a, b) {
            var c = this.handleDraggabilly;
            a[b]("dragStart", c.dragStart), a[b]("dragMove", c.dragMove), a[b]("dragEnd", c.dragEnd)
        }, j.bindUIDraggableEvents = function(a) {
            this._bindUIDraggableEvents(a, "on")
        }, j.unbindUIDraggableEvents = function(a) {
            this._bindUIDraggableEvents(a, "off")
        }, j._bindUIDraggableEvents = function(a, b) {
            var c = this.handleUIDraggable;
            a[b]("dragstart", c.start)[b]("drag", c.drag)[b]("dragstop", c.stop)
        };
        var l = j.destroy;
        return j.destroy = function() {
            l.apply(this, arguments), this.isEnabled = !1
        }, i.Rect = c, i.Packer = d, i
    }), ! function(a) {
    "use strict";
    "function" == typeof define && define.amd ? define(["jquery"], a) : a("object" == typeof exports && "function" == typeof require ? require("jquery") : jQuery)
}(function(a) {
    "use strict";

    function b(c, d) {
        var e = function() {},
            f = this,
            g = {
                ajaxSettings: {},
                autoSelectFirst: !1,
                appendTo: document.body,
                serviceUrl: null,
                lookup: null,
                onSelect: null,
                width: "auto",
                minChars: 1,
                maxHeight: 300,
                deferRequestBy: 0,
                params: {},
                formatResult: b.formatResult,
                delimiter: null,
                zIndex: 9999,
                type: "GET",
                noCache: !1,
                onSearchStart: e,
                onSearchComplete: e,
                onSearchError: e,
                preserveInput: !1,
                containerClass: "autocomplete-suggestions",
                tabDisabled: !1,
                dataType: "text",
                currentRequest: null,
                triggerSelectOnValidInput: !0,
                preventBadQueries: !0,
                lookupFilter: function(a, b, c) {
                    return -1 !== a.value.toLowerCase().indexOf(c)
                },
                paramName: "query",
                transformResult: function(b) {
                    return "string" == typeof b ? a.parseJSON(b) : b
                },
                showNoSuggestionNotice: !1,
                noSuggestionNotice: "No results",
                orientation: "bottom",
                forceFixPosition: !1
            };
        f.element = c, f.el = a(c), f.suggestions = [], f.badQueries = [], f.selectedIndex = -1, f.currentValue = f.element.value, f.intervalId = 0, f.cachedResponse = {}, f.onChangeInterval = null, f.onChange = null, f.isLocal = !1, f.suggestionsContainer = null, f.noSuggestionsContainer = null, f.options = a.extend({}, g, d), f.classes = {
            selected: "autocomplete-selected",
            suggestion: "autocomplete-suggestion"
        }, f.hint = null, f.hintValue = "", f.selection = null, f.initialize(), f.setOptions(d)
    }
    var c = function() {
            return {
                escapeRegExChars: function(a) {
                    return a.replace(/[\-\[\]\/\{\}\(\)\*\+\?\.\\\^\$\|]/g, "\\$&")
                },
                createNode: function(a) {
                    var b = document.createElement("div");
                    return b.className = a, b.style.position = "absolute", b.style.display = "none", b
                }
            }
        }(),
        d = {
            ESC: 27,
            TAB: 9,
            RETURN: 13,
            LEFT: 37,
            UP: 38,
            RIGHT: 39,
            DOWN: 40
        };
    b.utils = c, a.Autocomplete = b, b.formatResult = function(a, b) {
        var d = "(" + c.escapeRegExChars(b) + ")";
        return a.value.replace(new RegExp(d, "gi"), "<strong>$1</strong>").replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;").replace(/"/g, "&quot;").replace(/&lt;(\/?strong)&gt;/g, "<$1>")
    }, b.prototype = {
        killerFn: null,
        initialize: function() {
            var c, d = this,
                e = "." + d.classes.suggestion,
                f = d.classes.selected,
                g = d.options;
            d.element.setAttribute("autocomplete", "off"), d.killerFn = function(b) {
                0 === a(b.target).closest("." + d.options.containerClass).length && (d.killSuggestions(), d.disableKillerFn())
            }, d.noSuggestionsContainer = a('<div class="autocomplete-no-suggestion"></div>').html(this.options.noSuggestionNotice).get(0), d.suggestionsContainer = b.utils.createNode(g.containerClass), c = a(d.suggestionsContainer), c.appendTo(g.appendTo), "auto" !== g.width && c.width(g.width), c.on("mouseover.autocomplete", e, function() {
                d.activate(a(this).data("index"))
            }), c.on("mouseout.autocomplete", function() {
                d.selectedIndex = -1, c.children("." + f).removeClass(f)
            }), c.on("click.autocomplete", e, function() {
                d.select(a(this).data("index"))
            }), d.fixPositionCapture = function() {
                d.visible && d.fixPosition()
            }, a(window).on("resize.autocomplete", d.fixPositionCapture), d.el.on("keydown.autocomplete", function(a) {
                d.onKeyPress(a)
            }), d.el.on("keyup.autocomplete", function(a) {
                d.onKeyUp(a)
            }), d.el.on("blur.autocomplete", function() {
                d.onBlur()
            }), d.el.on("focus.autocomplete", function() {
                d.onFocus()
            }), d.el.on("change.autocomplete", function(a) {
                d.onKeyUp(a)
            }), d.el.on("input.autocomplete", function(a) {
                d.onKeyUp(a)
            })
        },
        onFocus: function() {
            var a = this;
            a.fixPosition(), 0 === a.options.minChars && 0 === a.el.val().length && a.onValueChange()
        },
        onBlur: function() {
            this.enableKillerFn()
        },
        abortAjax: function() {
            var a = this;
            a.currentRequest && (a.currentRequest.abort(), a.currentRequest = null)
        },
        setOptions: function(b) {
            var c = this,
                d = c.options;
            a.extend(d, b), c.isLocal = a.isArray(d.lookup), c.isLocal && (d.lookup = c.verifySuggestionsFormat(d.lookup)), d.orientation = c.validateOrientation(d.orientation, "bottom"), a(c.suggestionsContainer).css({
                "max-height": d.maxHeight + "px",
                width: d.width + "px",
                "z-index": d.zIndex
            })
        },
        clearCache: function() {
            this.cachedResponse = {}, this.badQueries = []
        },
        clear: function() {
            this.clearCache(), this.currentValue = "", this.suggestions = []
        },
        disable: function() {
            var a = this;
            a.disabled = !0, clearInterval(a.onChangeInterval), a.abortAjax()
        },
        enable: function() {
            this.disabled = !1
        },
        fixPosition: function() {
            var b = this,
                c = a(b.suggestionsContainer),
                d = c.parent().get(0);
            if (d === document.body || b.options.forceFixPosition) {
                var e = b.options.orientation,
                    f = c.outerHeight(),
                    g = b.el.outerHeight(),
                    h = b.el.offset(),
                    i = {
                        top: h.top,
                        left: h.left
                    };
                if ("auto" === e) {
                    var j = a(window).height(),
                        k = a(window).scrollTop(),
                        l = -k + h.top - f,
                        m = k + j - (h.top + g + f);
                    e = Math.max(l, m) === l ? "top" : "bottom"
                }
                if ("top" === e ? i.top += -f : i.top += g, d !== document.body) {
                    var n, o = c.css("opacity");
                    b.visible || c.css("opacity", 0).show(), n = c.offsetParent().offset(), i.top -= n.top, i.left -= n.left, b.visible || c.css("opacity", o).hide()
                }
                "auto" === b.options.width && (i.width = b.el.outerWidth() - 2 + "px"), c.css(i)
            }
        },
        enableKillerFn: function() {
            var b = this;
            a(document).on("click.autocomplete", b.killerFn)
        },
        disableKillerFn: function() {
            var b = this;
            a(document).off("click.autocomplete", b.killerFn)
        },
        killSuggestions: function() {
            var a = this;
            a.stopKillSuggestions(), a.intervalId = window.setInterval(function() {
                a.visible && (a.el.val(a.currentValue), a.hide()), a.stopKillSuggestions()
            }, 50)
        },
        stopKillSuggestions: function() {
            window.clearInterval(this.intervalId)
        },
        isCursorAtEnd: function() {
            var a, b = this,
                c = b.el.val().length,
                d = b.element.selectionStart;
            return "number" == typeof d ? d === c : document.selection ? (a = document.selection.createRange(), a.moveStart("character", -c), c === a.text.length) : !0
        },
        onKeyPress: function(a) {
            var b = this;
            if (!b.disabled && !b.visible && a.which === d.DOWN && b.currentValue) return void b.suggest();
            if (!b.disabled && b.visible) {
                switch (a.which) {
                    case d.ESC:
                        b.el.val(b.currentValue), b.hide();
                        break;
                    case d.RIGHT:
                        if (b.hint && b.options.onHint && b.isCursorAtEnd()) {
                            b.selectHint();
                            break
                        }
                        return;
                    case d.TAB:
                        if (b.hint && b.options.onHint) return void b.selectHint();
                        if (-1 === b.selectedIndex) return void b.hide();
                        if (b.select(b.selectedIndex), b.options.tabDisabled === !1) return;
                        break;
                    case d.RETURN:
                        if (-1 === b.selectedIndex) return void b.hide();
                        b.select(b.selectedIndex);
                        break;
                    case d.UP:
                        b.moveUp();
                        break;
                    case d.DOWN:
                        b.moveDown();
                        break;
                    default:
                        return
                }
                a.stopImmediatePropagation(), a.preventDefault()
            }
        },
        onKeyUp: function(a) {
            var b = this;
            if (!b.disabled) {
                switch (a.which) {
                    case d.UP:
                    case d.DOWN:
                        return
                }
                clearInterval(b.onChangeInterval), b.currentValue !== b.el.val() && (b.findBestHint(), b.options.deferRequestBy > 0 ? b.onChangeInterval = setInterval(function() {
                    b.onValueChange()
                }, b.options.deferRequestBy) : b.onValueChange())
            }
        },
        onValueChange: function() {
            var b = this,
                c = b.options,
                d = b.el.val(),
                e = b.getQuery(d);
            return b.selection && b.currentValue !== e && (b.selection = null, (c.onInvalidateSelection || a.noop).call(b.element)), clearInterval(b.onChangeInterval), b.currentValue = d, b.selectedIndex = -1, c.triggerSelectOnValidInput && b.isExactMatch(e) ? void b.select(0) : void(e.length < c.minChars ? b.hide() : b.getSuggestions(e))
        },
        isExactMatch: function(a) {
            var b = this.suggestions;
            return 1 === b.length && b[0].value.toLowerCase() === a.toLowerCase()
        },
        getQuery: function(b) {
            var c, d = this.options.delimiter;
            return d ? (c = b.split(d), a.trim(c[c.length - 1])) : b
        },
        getSuggestionsLocal: function(b) {
            var c, d = this,
                e = d.options,
                f = b.toLowerCase(),
                g = e.lookupFilter,
                h = parseInt(e.lookupLimit, 10);
            return c = {
                suggestions: a.grep(e.lookup, function(a) {
                    return g(a, b, f)
                })
            }, h && c.suggestions.length > h && (c.suggestions = c.suggestions.slice(0, h)), c
        },
        getSuggestions: function(b) {
            var c, d, e, f, g = this,
                h = g.options,
                i = h.serviceUrl;
            if (h.params[h.paramName] = b, d = h.ignoreParams ? null : h.params, h.onSearchStart.call(g.element, h.params) !== !1) {
                if (a.isFunction(h.lookup)) return void h.lookup(b, function(a) {
                    g.suggestions = a.suggestions, g.suggest(), h.onSearchComplete.call(g.element, b, a.suggestions)
                });
                g.isLocal ? c = g.getSuggestionsLocal(b) : (a.isFunction(i) && (i = i.call(g.element, b)), e = i + "?" + a.param(d || {}), c = g.cachedResponse[e]), c && a.isArray(c.suggestions) ? (g.suggestions = c.suggestions, g.suggest(), h.onSearchComplete.call(g.element, b, c.suggestions)) : g.isBadQuery(b) ? h.onSearchComplete.call(g.element, b, []) : (g.abortAjax(), f = {
                    url: i,
                    data: d,
                    type: h.type,
                    dataType: h.dataType
                }, a.extend(f, h.ajaxSettings), g.currentRequest = a.ajax(f).done(function(a) {
                    var c;
                    g.currentRequest = null, c = h.transformResult(a, b), g.processResponse(c, b, e), h.onSearchComplete.call(g.element, b, c.suggestions)
                }).fail(function(a, c, d) {
                    h.onSearchError.call(g.element, b, a, c, d)
                }))
            }
        },
        isBadQuery: function(a) {
            if (!this.options.preventBadQueries) return !1;
            for (var b = this.badQueries, c = b.length; c--;)
                if (0 === a.indexOf(b[c])) return !0;
            return !1
        },
        hide: function() {
            var b = this,
                c = a(b.suggestionsContainer);
            a.isFunction(b.options.onHide) && b.visible && b.options.onHide.call(b.element, c), b.visible = !1, b.selectedIndex = -1, clearInterval(b.onChangeInterval), a(b.suggestionsContainer).hide(), b.signalHint(null)
        },
        suggest: function() {
            if (0 === this.suggestions.length) return void(this.options.showNoSuggestionNotice ? this.noSuggestions() : this.hide());
            var b, c = this,
                d = c.options,
                e = d.groupBy,
                f = d.formatResult,
                g = c.getQuery(c.currentValue),
                h = c.classes.suggestion,
                i = c.classes.selected,
                j = a(c.suggestionsContainer),
                k = a(c.noSuggestionsContainer),
                l = d.beforeRender,
                m = "",
                n = function(a, c) {
                    var d = a.data[e];
                    return b === d ? "" : (b = d, '<div class="autocomplete-group"><strong>' + b + "</strong></div>")
                };
            return d.triggerSelectOnValidInput && c.isExactMatch(g) ? void c.select(0) : (a.each(c.suggestions, function(a, b) {
                e && (m += n(b, g, a)), m += '<div class="' + h + '" data-index="' + a + '">' + f(b, g) + "</div>"
            }), this.adjustContainerWidth(), k.detach(), j.html(m), a.isFunction(l) && l.call(c.element, j), c.fixPosition(), j.show(), d.autoSelectFirst && (c.selectedIndex = 0, j.scrollTop(0), j.children("." + h).first().addClass(i)), c.visible = !0, void c.findBestHint())
        },
        noSuggestions: function() {
            var b = this,
                c = a(b.suggestionsContainer),
                d = a(b.noSuggestionsContainer);
            this.adjustContainerWidth(), d.detach(), c.empty(), c.append(d), b.fixPosition(), c.show(), b.visible = !0
        },
        adjustContainerWidth: function() {
            var b, c = this,
                d = c.options,
                e = a(c.suggestionsContainer);
            "auto" === d.width && (b = c.el.outerWidth() - 2, e.width(b > 0 ? b : 300))
        },
        findBestHint: function() {
            var b = this,
                c = b.el.val().toLowerCase(),
                d = null;
            c && (a.each(b.suggestions, function(a, b) {
                var e = 0 === b.value.toLowerCase().indexOf(c);
                return e && (d = b), !e
            }), b.signalHint(d))
        },
        signalHint: function(b) {
            var c = "",
                d = this;
            b && (c = d.currentValue + b.value.substr(d.currentValue.length)), d.hintValue !== c && (d.hintValue = c, d.hint = b, (this.options.onHint || a.noop)(c))
        },
        verifySuggestionsFormat: function(b) {
            return b.length && "string" == typeof b[0] ? a.map(b, function(a) {
                return {
                    value: a,
                    data: null
                }
            }) : b
        },
        validateOrientation: function(b, c) {
            return b = a.trim(b || "").toLowerCase(), -1 === a.inArray(b, ["auto", "bottom", "top"]) && (b = c), b
        },
        processResponse: function(a, b, c) {
            var d = this,
                e = d.options;
            a.suggestions = d.verifySuggestionsFormat(a.suggestions), e.noCache || (d.cachedResponse[c] = a, e.preventBadQueries && 0 === a.suggestions.length && d.badQueries.push(b)), b === d.getQuery(d.currentValue) && (d.suggestions = a.suggestions, d.suggest())
        },
        activate: function(b) {
            var c, d = this,
                e = d.classes.selected,
                f = a(d.suggestionsContainer),
                g = f.find("." + d.classes.suggestion);
            return f.find("." + e).removeClass(e), d.selectedIndex = b, -1 !== d.selectedIndex && g.length > d.selectedIndex ? (c = g.get(d.selectedIndex), a(c).addClass(e), c) : null
        },
        selectHint: function() {
            var b = this,
                c = a.inArray(b.hint, b.suggestions);
            b.select(c)
        },
        select: function(a) {
            var b = this;
            b.hide(), b.onSelect(a)
        },
        moveUp: function() {
            var b = this;
            return -1 !== b.selectedIndex ? 0 === b.selectedIndex ? (a(b.suggestionsContainer).children().first().removeClass(b.classes.selected), b.selectedIndex = -1, b.el.val(b.currentValue), void b.findBestHint()) : void b.adjustScroll(b.selectedIndex - 1) : void 0
        },
        moveDown: function() {
            var a = this;
            a.selectedIndex !== a.suggestions.length - 1 && a.adjustScroll(a.selectedIndex + 1)
        },
        adjustScroll: function(b) {
            var c = this,
                d = c.activate(b);
            if (d) {
                var e, f, g, h = a(d).outerHeight();
                e = d.offsetTop, f = a(c.suggestionsContainer).scrollTop(), g = f + c.options.maxHeight - h, f > e ? a(c.suggestionsContainer).scrollTop(e) : e > g && a(c.suggestionsContainer).scrollTop(e - c.options.maxHeight + h), c.options.preserveInput || c.el.val(c.getValue(c.suggestions[b].value)), c.signalHint(null)
            }
        },
        onSelect: function(b) {
            var c = this,
                d = c.options.onSelect,
                e = c.suggestions[b];
            c.currentValue = c.getValue(e.value), c.currentValue === c.el.val() || c.options.preserveInput || c.el.val(c.currentValue), c.signalHint(null), c.suggestions = [], c.selection = e, a.isFunction(d) && d.call(c.element, e)
        },
        getValue: function(a) {
            var b, c, d = this,
                e = d.options.delimiter;
            return e ? (b = d.currentValue, c = b.split(e), 1 === c.length ? a : b.substr(0, b.length - c[c.length - 1].length) + a) : a
        },
        dispose: function() {
            var b = this;
            b.el.off(".autocomplete").removeData("autocomplete"), b.disableKillerFn(), a(window).off("resize.autocomplete", b.fixPositionCapture), a(b.suggestionsContainer).remove()
        }
    }, a.fn.devbridgeAutocomplete = function(c, d) {
        var e = "autocomplete";
        return 0 === arguments.length ? this.first().data(e) : this.each(function() {
            var f = a(this),
                g = f.data(e);
            "string" == typeof c ? g && "function" == typeof g[c] && g[c](d) : (g && g.dispose && g.dispose(), g = new b(this, c), f.data(e, g))
        })
    }
}), ! function(a) {
    "use strict";
    a.ThreeSixty = function(b, c) {
        var d, e = this,
            f = [];
        e.$el = a(b), e.el = b, e.$el.data("ThreeSixty", e), e.init = function() {
            d = a.extend({}, a.ThreeSixty.defaultOptions, c), d.disableSpin && (d.currentFrame = 1, d.endFrame = 1), e.initProgress(), e.loadImages()
        }, e.resize = function() {}, e.initProgress = function() {
            e.$el.css({
                width: d.width + "px",
                height: d.height + "px",
                "background-image": "none !important"
            }), d.styles && e.$el.css(d.styles), e.responsive(), e.$el.find(d.progress).css({
                marginTop: d.height / 2 - 15 + "px"
            }), e.$el.find(d.progress).fadeIn("slow"), e.$el.find(d.imgList).hide()
        }, e.loadImages = function() {
            var b, c, g, h;
            b = document.createElement("li"), h = d.zeroBased ? 0 : 1, c = d.imgArray ? d.imgArray[d.loadedImages] : d.domain + d.imagePath + d.filePrefix + e.zeroPad(d.loadedImages + h) + d.ext + (e.browser.isIE() ? "?" + (new Date).getTime() : ""), g = a("<img>").attr("src", c).addClass("previous-image").appendTo(b), f.push(g), e.$el.find(d.imgList).append(b), a(g).load(function() {
                e.imageLoaded()
            })
        }, e.imageLoaded = function() {
            d.loadedImages += 1, a(d.progress + " span").text(Math.floor(d.loadedImages / d.totalFrames * 100) + "%"), d.loadedImages >= d.totalFrames ? (d.disableSpin && f[0].removeClass("previous-image").addClass("current-image"), a(d.progress).fadeOut("slow", function() {
                a(this).hide(), e.showImages(), e.showNavigation()
            })) : e.loadImages()
        }, e.showImages = function() {
            e.$el.find(".txtC").fadeIn(), e.$el.find(d.imgList).fadeIn(), e.ready = !0, d.ready = !0, d.drag && e.initEvents(), e.refresh(), e.initPlugins(), d.onReady(), setTimeout(function() {
                e.responsive()
            }, 50)
        }, e.initPlugins = function() {
            a.each(d.plugins, function(b, c) {
                if ("function" != typeof a[c]) throw new Error(c + " not available.");
                a[c].call(e, e.$el, d)
            })
        }, e.showNavigation = function() {
            if (d.navigation && !d.navigation_init) {
                var b, c, f, g;
                b = a("<div/>").attr("class", "nav_bar"), c = a("<a/>").attr({
                    href: "#",
                    "class": "nav_bar_next"
                }).html("next"), f = a("<a/>").attr({
                    href: "#",
                    "class": "nav_bar_previous"
                }).html("previous"), g = a("<a/>").attr({
                    href: "#",
                    "class": "nav_bar_play"
                }).html("play"), b.append(f), b.append(g), b.append(c), e.$el.prepend(b), c.bind("mousedown touchstart", e.next), f.bind("mousedown touchstart", e.previous), g.bind("mousedown touchstart", e.play_stop), d.navigation_init = !0
            }
        }, e.play_stop = function(b) {
            b.preventDefault(), d.autoplay ? (d.autoplay = !1, a(b.currentTarget).removeClass("nav_bar_stop").addClass("nav_bar_play"), clearInterval(d.play), d.play = null) : (d.autoplay = !0, d.play = setInterval(e.moveToNextFrame, d.playSpeed), a(b.currentTarget).removeClass("nav_bar_play").addClass("nav_bar_stop"))
        }, e.next = function(a) {
            a && a.preventDefault(), d.endFrame -= 5, e.refresh()
        }, e.previous = function(a) {
            a && a.preventDefault(), d.endFrame += 5, e.refresh()
        }, e.play = function(a, b) {
            var c = a || d.playSpeed,
                f = b || d.autoplayDirection;
            d.autoplayDirection = f, d.autoplay || (d.autoplay = !0, d.play = setInterval(e.moveToNextFrame, c))
        }, e.stop = function() {
            d.autoplay && (d.autoplay = !1, clearInterval(d.play), d.play = null)
        }, e.moveToNextFrame = function() {
            1 === d.autoplayDirection ? d.endFrame -= 1 : d.endFrame += 1, e.refresh()
        }, e.gotoAndPlay = function(a) {
            if (d.disableWrap) d.endFrame = a, e.refresh();
            else {
                var b = Math.ceil(d.endFrame / d.totalFrames);
                0 === b && (b = 1);
                var c = b > 1 ? d.endFrame - (b - 1) * d.totalFrames : d.endFrame,
                    f = d.totalFrames - c,
                    g = 0;
                g = a - c > 0 ? a - c < c + (d.totalFrames - a) ? d.endFrame + (a - c) : d.endFrame - (c + (d.totalFrames - a)) : f + a > c - a ? d.endFrame - (c - a) : d.endFrame + (f + a), c !== a && (d.endFrame = g, e.refresh())
            }
        }, e.initEvents = function() {
            e.$el.bind("mousedown touchstart touchmove touchend mousemove click", function(a) {
                a.preventDefault(), "mousedown" === a.type && 1 === a.which || "touchstart" === a.type ? (d.pointerStartPosX = e.getPointerEvent(a).pageX, d.dragging = !0, d.onDragStart(d.currentFrame)) : "touchmove" === a.type ? e.trackPointer(a) : "touchend" === a.type && (d.dragging = !1, d.onDragStop(d.endFrame))
            }), a(document).bind("mouseup", function(b) {
                d.dragging = !1, d.onDragStop(d.endFrame), a(this).css("cursor", "none")
            }), a(window).bind("resize", function(a) {
                e.responsive()
            }), a(document).bind("mousemove", function(a) {
                d.dragging ? (a.preventDefault(), !e.browser.isIE && d.showCursor && e.$el.css("cursor", "url(assets/images/hand_closed.png), auto")) : !e.browser.isIE && d.showCursor && e.$el.css("cursor", "url(assets/images/hand_open.png), auto"), e.trackPointer(a)
            }), a(window).resize(function() {
                e.resize()
            })
        }, e.getPointerEvent = function(a) {
            return a.originalEvent.targetTouches ? a.originalEvent.targetTouches[0] : a
        }, e.trackPointer = function(a) {
            d.ready && d.dragging && (d.pointerEndPosX = e.getPointerEvent(a).pageX, d.monitorStartTime < (new Date).getTime() - d.monitorInt && (d.pointerDistance = d.pointerEndPosX - d.pointerStartPosX, d.pointerDistance > 0 ? d.endFrame = d.currentFrame + Math.ceil((d.totalFrames - 1) * d.speedMultiplier * (d.pointerDistance / e.$el.width())) : d.endFrame = d.currentFrame + Math.floor((d.totalFrames - 1) * d.speedMultiplier * (d.pointerDistance / e.$el.width())), d.disableWrap && (d.endFrame = Math.min(d.totalFrames - (d.zeroBased ? 1 : 0), d.endFrame), d.endFrame = Math.max(d.zeroBased ? 0 : 1, d.endFrame)), e.refresh(), d.monitorStartTime = (new Date).getTime(), d.pointerStartPosX = e.getPointerEvent(a).pageX))
        }, e.refresh = function() {
            0 === d.ticker && (d.ticker = setInterval(e.render, Math.round(1e3 / d.framerate)))
        }, e.render = function() {
            var a;
            d.currentFrame !== d.endFrame ? (a = d.endFrame < d.currentFrame ? Math.floor(.1 * (d.endFrame - d.currentFrame)) : Math.ceil(.1 * (d.endFrame - d.currentFrame)), e.hidePreviousFrame(), d.currentFrame += a, e.showCurrentFrame(), e.$el.trigger("frameIndexChanged", [e.getNormalizedCurrentFrame(), d.totalFrames])) : (window.clearInterval(d.ticker), d.ticker = 0)
        }, e.hidePreviousFrame = function() {
            f[e.getNormalizedCurrentFrame()].removeClass("current-image").addClass("previous-image")
        }, e.showCurrentFrame = function() {
            f[e.getNormalizedCurrentFrame()].removeClass("previous-image").addClass("current-image")
        }, e.getNormalizedCurrentFrame = function() {
            var a, b;
            return d.disableWrap ? (a = Math.min(d.currentFrame, d.totalFrames - (d.zeroBased ? 1 : 0)), b = Math.min(d.endFrame, d.totalFrames - (d.zeroBased ? 1 : 0)), a = Math.max(a, d.zeroBased ? 0 : 1), b = Math.max(b, d.zeroBased ? 0 : 1), d.currentFrame = a, d.endFrame = b) : (a = Math.ceil(d.currentFrame % d.totalFrames), 0 > a && (a += d.totalFrames - (d.zeroBased ? 1 : 0))), a
        }, e.getCurrentFrame = function() {
            return d.currentFrame
        }, e.responsive = function() {
            d.responsive && e.$el.css({
                height: e.$el.find(".current-image").first().css("height"),
                width: "100%"
            })
        }, e.zeroPad = function(a) {
            function b(a, b) {
                var c = a.toString();
                if (d.zeroPadding)
                    for (; c.length < b;) c = "0" + c;
                return c
            }
            var c = Math.log(d.totalFrames) / Math.LN10,
                e = 1e3,
                f = Math.round(c * e) / e,
                g = Math.floor(f) + 1;
            return b(a, g)
        }, e.browser = {}, e.browser.isIE = function() {
            var a = -1;
            if ("Microsoft Internet Explorer" === navigator.appName) {
                var b = navigator.userAgent,
                    c = new RegExp("MSIE ([0-9]{1,}[\\.0-9]{0,})");
                null !== c.exec(b) && (a = parseFloat(RegExp.$1))
            }
            return -1 !== a
        }, e.getConfig = function() {
            return d
        }, a.ThreeSixty.defaultOptions = {
            dragging: !1,
            ready: !1,
            pointerStartPosX: 0,
            pointerEndPosX: 0,
            pointerDistance: 0,
            monitorStartTime: 0,
            monitorInt: 10,
            ticker: 0,
            speedMultiplier: 7,
            totalFrames: 180,
            currentFrame: 0,
            endFrame: 0,
            loadedImages: 0,
            framerate: 60,
            domains: null,
            domain: "",
            parallel: !1,
            queueAmount: 8,
            idle: 0,
            filePrefix: "",
            ext: "png",
            height: 300,
            width: 300,
            styles: {},
            navigation: !1,
            autoplay: !1,
            autoplayDirection: 1,
            disableSpin: !1,
            disableWrap: !1,
            responsive: !1,
            zeroPadding: !1,
            zeroBased: !1,
            plugins: [],
            showCursor: !1,
            drag: !0,
            onReady: function() {},
            onDragStart: function() {},
            onDragStop: function() {},
            imgList: ".threesixty_images",
            imgArray: null,
            playSpeed: 100
        }, e.init()
    }, a.fn.ThreeSixty = function(b) {
        return Object.create(new a.ThreeSixty(this, b))
    }
}(jQuery), "function" != typeof Object.create && (Object.create = function(a) {
    "use strict";

    function b() {}
    return b.prototype = a, new b
});
var _gsScope = "undefined" != typeof module && module.exports && "undefined" != typeof global ? global : this || window;
(_gsScope._gsQueue || (_gsScope._gsQueue = [])).push(function() {
    "use strict";
    _gsScope._gsDefine("TweenMax", ["core.Animation", "core.SimpleTimeline", "TweenLite"], function(a, b, c) {
        var d = function(a) {
                var b, c = [],
                    d = a.length;
                for (b = 0; b !== d; c.push(a[b++]));
                return c
            },
            e = function(a, b, c) {
                var d, e, f = a.cycle;
                for (d in f) e = f[d], a[d] = "function" == typeof e ? e.call(b[c], c) : e[c % e.length];
                delete a.cycle
            },
            f = function(a, b, d) {
                c.call(this, a, b, d), this._cycle = 0, this._yoyo = this.vars.yoyo === !0, this._repeat = this.vars.repeat || 0, this._repeatDelay = this.vars.repeatDelay || 0, this._dirty = !0, this.render = f.prototype.render
            },
            g = 1e-10,
            h = c._internals,
            i = h.isSelector,
            j = h.isArray,
            k = f.prototype = c.to({}, .1, {}),
            l = [];
        f.version = "1.18.4", k.constructor = f, k.kill()._gc = !1, f.killTweensOf = f.killDelayedCallsTo = c.killTweensOf, f.getTweensOf = c.getTweensOf, f.lagSmoothing = c.lagSmoothing, f.ticker = c.ticker, f.render = c.render, k.invalidate = function() {
            return this._yoyo = this.vars.yoyo === !0, this._repeat = this.vars.repeat || 0, this._repeatDelay = this.vars.repeatDelay || 0, this._uncache(!0), c.prototype.invalidate.call(this)
        }, k.updateTo = function(a, b) {
            var d, e = this.ratio,
                f = this.vars.immediateRender || a.immediateRender;
            b && this._startTime < this._timeline._time && (this._startTime = this._timeline._time, this._uncache(!1), this._gc ? this._enabled(!0, !1) : this._timeline.insert(this, this._startTime - this._delay));
            for (d in a) this.vars[d] = a[d];
            if (this._initted || f)
                if (b) this._initted = !1, f && this.render(0, !0, !0);
                else if (this._gc && this._enabled(!0, !1), this._notifyPluginsOfEnabled && this._firstPT && c._onPluginEvent("_onDisable", this), this._time / this._duration > .998) {
                    var g = this._totalTime;
                    this.render(0, !0, !1), this._initted = !1, this.render(g, !0, !1)
                } else if (this._initted = !1, this._init(), this._time > 0 || f)
                    for (var h, i = 1 / (1 - e), j = this._firstPT; j;) h = j.s + j.c, j.c *= i, j.s = h - j.c, j = j._next;
            return this
        }, k.render = function(a, b, c) {
            this._initted || 0 === this._duration && this.vars.repeat && this.invalidate();
            var d, e, f, i, j, k, l, m, n = this._dirty ? this.totalDuration() : this._totalDuration,
                o = this._time,
                p = this._totalTime,
                q = this._cycle,
                r = this._duration,
                s = this._rawPrevTime;
            if (a >= n - 1e-7 ? (this._totalTime = n, this._cycle = this._repeat, this._yoyo && 0 !== (1 & this._cycle) ? (this._time = 0, this.ratio = this._ease._calcEnd ? this._ease.getRatio(0) : 0) : (this._time = r, this.ratio = this._ease._calcEnd ? this._ease.getRatio(1) : 1), this._reversed || (d = !0, e = "onComplete", c = c || this._timeline.autoRemoveChildren), 0 === r && (this._initted || !this.vars.lazy || c) && (this._startTime === this._timeline._duration && (a = 0), (0 > s || 0 >= a && a >= -1e-7 || s === g && "isPause" !== this.data) && s !== a && (c = !0, s > g && (e = "onReverseComplete")), this._rawPrevTime = m = !b || a || s === a ? a : g)) : 1e-7 > a ? (this._totalTime = this._time = this._cycle = 0, this.ratio = this._ease._calcEnd ? this._ease.getRatio(0) : 0, (0 !== p || 0 === r && s > 0) && (e = "onReverseComplete", d = this._reversed), 0 > a && (this._active = !1, 0 === r && (this._initted || !this.vars.lazy || c) && (s >= 0 && (c = !0), this._rawPrevTime = m = !b || a || s === a ? a : g)), this._initted || (c = !0)) : (this._totalTime = this._time = a, 0 !== this._repeat && (i = r + this._repeatDelay, this._cycle = this._totalTime / i >> 0, 0 !== this._cycle && this._cycle === this._totalTime / i && a >= p && this._cycle--, this._time = this._totalTime - this._cycle * i, this._yoyo && 0 !== (1 & this._cycle) && (this._time = r - this._time),
                    this._time > r ? this._time = r : this._time < 0 && (this._time = 0)), this._easeType ? (j = this._time / r, k = this._easeType, l = this._easePower, (1 === k || 3 === k && j >= .5) && (j = 1 - j), 3 === k && (j *= 2), 1 === l ? j *= j : 2 === l ? j *= j * j : 3 === l ? j *= j * j * j : 4 === l && (j *= j * j * j * j), 1 === k ? this.ratio = 1 - j : 2 === k ? this.ratio = j : this._time / r < .5 ? this.ratio = j / 2 : this.ratio = 1 - j / 2) : this.ratio = this._ease.getRatio(this._time / r)), o === this._time && !c && q === this._cycle) return void(p !== this._totalTime && this._onUpdate && (b || this._callback("onUpdate")));
            if (!this._initted) {
                if (this._init(), !this._initted || this._gc) return;
                if (!c && this._firstPT && (this.vars.lazy !== !1 && this._duration || this.vars.lazy && !this._duration)) return this._time = o, this._totalTime = p, this._rawPrevTime = s, this._cycle = q, h.lazyTweens.push(this), void(this._lazy = [a, b]);
                this._time && !d ? this.ratio = this._ease.getRatio(this._time / r) : d && this._ease._calcEnd && (this.ratio = this._ease.getRatio(0 === this._time ? 0 : 1))
            }
            for (this._lazy !== !1 && (this._lazy = !1), this._active || !this._paused && this._time !== o && a >= 0 && (this._active = !0), 0 === p && (2 === this._initted && a > 0 && this._init(), this._startAt && (a >= 0 ? this._startAt.render(a, b, c) : e || (e = "_dummyGS")), this.vars.onStart && (0 !== this._totalTime || 0 === r) && (b || this._callback("onStart"))), f = this._firstPT; f;) f.f ? f.t[f.p](f.c * this.ratio + f.s) : f.t[f.p] = f.c * this.ratio + f.s, f = f._next;
            this._onUpdate && (0 > a && this._startAt && this._startTime && this._startAt.render(a, b, c), b || (this._totalTime !== p || e) && this._callback("onUpdate")), this._cycle !== q && (b || this._gc || this.vars.onRepeat && this._callback("onRepeat")), e && (!this._gc || c) && (0 > a && this._startAt && !this._onUpdate && this._startTime && this._startAt.render(a, b, c), d && (this._timeline.autoRemoveChildren && this._enabled(!1, !1), this._active = !1), !b && this.vars[e] && this._callback(e), 0 === r && this._rawPrevTime === g && m !== g && (this._rawPrevTime = 0))
        }, f.to = function(a, b, c) {
            return new f(a, b, c)
        }, f.from = function(a, b, c) {
            return c.runBackwards = !0, c.immediateRender = 0 != c.immediateRender, new f(a, b, c)
        }, f.fromTo = function(a, b, c, d) {
            return d.startAt = c, d.immediateRender = 0 != d.immediateRender && 0 != c.immediateRender, new f(a, b, d)
        }, f.staggerTo = f.allTo = function(a, b, g, h, k, m, n) {
            h = h || 0;
            var o, p, q, r, s = 0,
                t = [],
                u = function() {
                    g.onComplete && g.onComplete.apply(g.onCompleteScope || this, arguments), k.apply(n || g.callbackScope || this, m || l)
                },
                v = g.cycle,
                w = g.startAt && g.startAt.cycle;
            for (j(a) || ("string" == typeof a && (a = c.selector(a) || a), i(a) && (a = d(a))), a = a || [], 0 > h && (a = d(a), a.reverse(), h *= -1), o = a.length - 1, q = 0; o >= q; q++) {
                p = {};
                for (r in g) p[r] = g[r];
                if (v && e(p, a, q), w) {
                    w = p.startAt = {};
                    for (r in g.startAt) w[r] = g.startAt[r];
                    e(p.startAt, a, q)
                }
                p.delay = s + (p.delay || 0), q === o && k && (p.onComplete = u), t[q] = new f(a[q], b, p), s += h
            }
            return t
        }, f.staggerFrom = f.allFrom = function(a, b, c, d, e, g, h) {
            return c.runBackwards = !0, c.immediateRender = 0 != c.immediateRender, f.staggerTo(a, b, c, d, e, g, h)
        }, f.staggerFromTo = f.allFromTo = function(a, b, c, d, e, g, h, i) {
            return d.startAt = c, d.immediateRender = 0 != d.immediateRender && 0 != c.immediateRender, f.staggerTo(a, b, d, e, g, h, i)
        }, f.delayedCall = function(a, b, c, d, e) {
            return new f(b, 0, {
                delay: a,
                onComplete: b,
                onCompleteParams: c,
                callbackScope: d,
                onReverseComplete: b,
                onReverseCompleteParams: c,
                immediateRender: !1,
                useFrames: e,
                overwrite: 0
            })
        }, f.set = function(a, b) {
            return new f(a, 0, b)
        }, f.isTweening = function(a) {
            return c.getTweensOf(a, !0).length > 0
        };
        var m = function(a, b) {
                for (var d = [], e = 0, f = a._first; f;) f instanceof c ? d[e++] = f : (b && (d[e++] = f), d = d.concat(m(f, b)), e = d.length), f = f._next;
                return d
            },
            n = f.getAllTweens = function(b) {
                return m(a._rootTimeline, b).concat(m(a._rootFramesTimeline, b))
            };
        f.killAll = function(a, c, d, e) {
            null == c && (c = !0), null == d && (d = !0);
            var f, g, h, i = n(0 != e),
                j = i.length,
                k = c && d && e;
            for (h = 0; j > h; h++) g = i[h], (k || g instanceof b || (f = g.target === g.vars.onComplete) && d || c && !f) && (a ? g.totalTime(g._reversed ? 0 : g.totalDuration()) : g._enabled(!1, !1))
        }, f.killChildTweensOf = function(a, b) {
            if (null != a) {
                var e, g, k, l, m, n = h.tweenLookup;
                if ("string" == typeof a && (a = c.selector(a) || a), i(a) && (a = d(a)), j(a))
                    for (l = a.length; --l > -1;) f.killChildTweensOf(a[l], b);
                else {
                    e = [];
                    for (k in n)
                        for (g = n[k].target.parentNode; g;) g === a && (e = e.concat(n[k].tweens)), g = g.parentNode;
                    for (m = e.length, l = 0; m > l; l++) b && e[l].totalTime(e[l].totalDuration()), e[l]._enabled(!1, !1)
                }
            }
        };
        var o = function(a, c, d, e) {
            c = c !== !1, d = d !== !1, e = e !== !1;
            for (var f, g, h = n(e), i = c && d && e, j = h.length; --j > -1;) g = h[j], (i || g instanceof b || (f = g.target === g.vars.onComplete) && d || c && !f) && g.paused(a)
        };
        return f.pauseAll = function(a, b, c) {
            o(!0, a, b, c)
        }, f.resumeAll = function(a, b, c) {
            o(!1, a, b, c)
        }, f.globalTimeScale = function(b) {
            var d = a._rootTimeline,
                e = c.ticker.time;
            return arguments.length ? (b = b || g, d._startTime = e - (e - d._startTime) * d._timeScale / b, d = a._rootFramesTimeline, e = c.ticker.frame, d._startTime = e - (e - d._startTime) * d._timeScale / b, d._timeScale = a._rootTimeline._timeScale = b, b) : d._timeScale
        }, k.progress = function(a, b) {
            return arguments.length ? this.totalTime(this.duration() * (this._yoyo && 0 !== (1 & this._cycle) ? 1 - a : a) + this._cycle * (this._duration + this._repeatDelay), b) : this._time / this.duration()
        }, k.totalProgress = function(a, b) {
            return arguments.length ? this.totalTime(this.totalDuration() * a, b) : this._totalTime / this.totalDuration()
        }, k.time = function(a, b) {
            return arguments.length ? (this._dirty && this.totalDuration(), a > this._duration && (a = this._duration), this._yoyo && 0 !== (1 & this._cycle) ? a = this._duration - a + this._cycle * (this._duration + this._repeatDelay) : 0 !== this._repeat && (a += this._cycle * (this._duration + this._repeatDelay)), this.totalTime(a, b)) : this._time
        }, k.duration = function(b) {
            return arguments.length ? a.prototype.duration.call(this, b) : this._duration
        }, k.totalDuration = function(a) {
            return arguments.length ? -1 === this._repeat ? this : this.duration((a - this._repeat * this._repeatDelay) / (this._repeat + 1)) : (this._dirty && (this._totalDuration = -1 === this._repeat ? 999999999999 : this._duration * (this._repeat + 1) + this._repeatDelay * this._repeat, this._dirty = !1), this._totalDuration)
        }, k.repeat = function(a) {
            return arguments.length ? (this._repeat = a, this._uncache(!0)) : this._repeat
        }, k.repeatDelay = function(a) {
            return arguments.length ? (this._repeatDelay = a, this._uncache(!0)) : this._repeatDelay
        }, k.yoyo = function(a) {
            return arguments.length ? (this._yoyo = a, this) : this._yoyo
        }, f
    }, !0), _gsScope._gsDefine("TimelineLite", ["core.Animation", "core.SimpleTimeline", "TweenLite"], function(a, b, c) {
        var d = function(a) {
                b.call(this, a), this._labels = {}, this.autoRemoveChildren = this.vars.autoRemoveChildren === !0, this.smoothChildTiming = this.vars.smoothChildTiming === !0, this._sortChildren = !0, this._onUpdate = this.vars.onUpdate;
                var c, d, e = this.vars;
                for (d in e) c = e[d], i(c) && -1 !== c.join("").indexOf("{self}") && (e[d] = this._swapSelfInParams(c));
                i(e.tweens) && this.add(e.tweens, 0, e.align, e.stagger)
            },
            e = 1e-10,
            f = c._internals,
            g = d._internals = {},
            h = f.isSelector,
            i = f.isArray,
            j = f.lazyTweens,
            k = f.lazyRender,
            l = _gsScope._gsDefine.globals,
            m = function(a) {
                var b, c = {};
                for (b in a) c[b] = a[b];
                return c
            },
            n = function(a, b, c) {
                var d, e, f = a.cycle;
                for (d in f) e = f[d], a[d] = "function" == typeof e ? e.call(b[c], c) : e[c % e.length];
                delete a.cycle
            },
            o = g.pauseCallback = function() {},
            p = function(a) {
                var b, c = [],
                    d = a.length;
                for (b = 0; b !== d; c.push(a[b++]));
                return c
            },
            q = d.prototype = new b;
        return d.version = "1.18.4", q.constructor = d, q.kill()._gc = q._forcingPlayhead = q._hasPause = !1, q.to = function(a, b, d, e) {
            var f = d.repeat && l.TweenMax || c;
            return b ? this.add(new f(a, b, d), e) : this.set(a, d, e)
        }, q.from = function(a, b, d, e) {
            return this.add((d.repeat && l.TweenMax || c).from(a, b, d), e)
        }, q.fromTo = function(a, b, d, e, f) {
            var g = e.repeat && l.TweenMax || c;
            return b ? this.add(g.fromTo(a, b, d, e), f) : this.set(a, e, f)
        }, q.staggerTo = function(a, b, e, f, g, i, j, k) {
            var l, o, q = new d({
                    onComplete: i,
                    onCompleteParams: j,
                    callbackScope: k,
                    smoothChildTiming: this.smoothChildTiming
                }),
                r = e.cycle;
            for ("string" == typeof a && (a = c.selector(a) || a), a = a || [], h(a) && (a = p(a)), f = f || 0, 0 > f && (a = p(a), a.reverse(), f *= -1), o = 0; o < a.length; o++) l = m(e), l.startAt && (l.startAt = m(l.startAt), l.startAt.cycle && n(l.startAt, a, o)), r && n(l, a, o), q.to(a[o], b, l, o * f);
            return this.add(q, g)
        }, q.staggerFrom = function(a, b, c, d, e, f, g, h) {
            return c.immediateRender = 0 != c.immediateRender, c.runBackwards = !0, this.staggerTo(a, b, c, d, e, f, g, h)
        }, q.staggerFromTo = function(a, b, c, d, e, f, g, h, i) {
            return d.startAt = c, d.immediateRender = 0 != d.immediateRender && 0 != c.immediateRender, this.staggerTo(a, b, d, e, f, g, h, i)
        }, q.call = function(a, b, d, e) {
            return this.add(c.delayedCall(0, a, b, d), e)
        }, q.set = function(a, b, d) {
            return d = this._parseTimeOrLabel(d, 0, !0), null == b.immediateRender && (b.immediateRender = d === this._time && !this._paused), this.add(new c(a, 0, b), d)
        }, d.exportRoot = function(a, b) {
            a = a || {}, null == a.smoothChildTiming && (a.smoothChildTiming = !0);
            var e, f, g = new d(a),
                h = g._timeline;
            for (null == b && (b = !0), h._remove(g, !0), g._startTime = 0, g._rawPrevTime = g._time = g._totalTime = h._time, e = h._first; e;) f = e._next, b && e instanceof c && e.target === e.vars.onComplete || g.add(e, e._startTime - e._delay), e = f;
            return h.add(g, 0), g
        }, q.add = function(e, f, g, h) {
            var j, k, l, m, n, o;
            if ("number" != typeof f && (f = this._parseTimeOrLabel(f, 0, !0, e)), !(e instanceof a)) {
                if (e instanceof Array || e && e.push && i(e)) {
                    for (g = g || "normal", h = h || 0, j = f, k = e.length, l = 0; k > l; l++) i(m = e[l]) && (m = new d({
                        tweens: m
                    })), this.add(m, j), "string" != typeof m && "function" != typeof m && ("sequence" === g ? j = m._startTime + m.totalDuration() / m._timeScale : "start" === g && (m._startTime -= m.delay())), j += h;
                    return this._uncache(!0)
                }
                if ("string" == typeof e) return this.addLabel(e, f);
                if ("function" != typeof e) throw "Cannot add " + e + " into the timeline; it is not a tween, timeline, function, or string.";
                e = c.delayedCall(0, e)
            }
            if (b.prototype.add.call(this, e, f), (this._gc || this._time === this._duration) && !this._paused && this._duration < this.duration())
                for (n = this, o = n.rawTime() > e._startTime; n._timeline;) o && n._timeline.smoothChildTiming ? n.totalTime(n._totalTime, !0) : n._gc && n._enabled(!0, !1), n = n._timeline;
            return this
        }, q.remove = function(b) {
            if (b instanceof a) {
                this._remove(b, !1);
                var c = b._timeline = b.vars.useFrames ? a._rootFramesTimeline : a._rootTimeline;
                return b._startTime = (b._paused ? b._pauseTime : c._time) - (b._reversed ? b.totalDuration() - b._totalTime : b._totalTime) / b._timeScale, this
            }
            if (b instanceof Array || b && b.push && i(b)) {
                for (var d = b.length; --d > -1;) this.remove(b[d]);
                return this
            }
            return "string" == typeof b ? this.removeLabel(b) : this.kill(null, b)
        }, q._remove = function(a, c) {
            b.prototype._remove.call(this, a, c);
            var d = this._last;
            return d ? this._time > d._startTime + d._totalDuration / d._timeScale && (this._time = this.duration(), this._totalTime = this._totalDuration) : this._time = this._totalTime = this._duration = this._totalDuration = 0, this
        }, q.append = function(a, b) {
            return this.add(a, this._parseTimeOrLabel(null, b, !0, a))
        }, q.insert = q.insertMultiple = function(a, b, c, d) {
            return this.add(a, b || 0, c, d)
        }, q.appendMultiple = function(a, b, c, d) {
            return this.add(a, this._parseTimeOrLabel(null, b, !0, a), c, d)
        }, q.addLabel = function(a, b) {
            return this._labels[a] = this._parseTimeOrLabel(b), this
        }, q.addPause = function(a, b, d, e) {
            var f = c.delayedCall(0, o, d, e || this);
            return f.vars.onComplete = f.vars.onReverseComplete = b, f.data = "isPause", this._hasPause = !0, this.add(f, a)
        }, q.removeLabel = function(a) {
            return delete this._labels[a], this
        }, q.getLabelTime = function(a) {
            return null != this._labels[a] ? this._labels[a] : -1
        }, q._parseTimeOrLabel = function(b, c, d, e) {
            var f;
            if (e instanceof a && e.timeline === this) this.remove(e);
            else if (e && (e instanceof Array || e.push && i(e)))
                for (f = e.length; --f > -1;) e[f] instanceof a && e[f].timeline === this && this.remove(e[f]);
            if ("string" == typeof c) return this._parseTimeOrLabel(c, d && "number" == typeof b && null == this._labels[c] ? b - this.duration() : 0, d);
            if (c = c || 0, "string" != typeof b || !isNaN(b) && null == this._labels[b]) null == b && (b = this.duration());
            else {
                if (f = b.indexOf("="), -1 === f) return null == this._labels[b] ? d ? this._labels[b] = this.duration() + c : c : this._labels[b] + c;
                c = parseInt(b.charAt(f - 1) + "1", 10) * Number(b.substr(f + 1)), b = f > 1 ? this._parseTimeOrLabel(b.substr(0, f - 1), 0, d) : this.duration()
            }
            return Number(b) + c
        }, q.seek = function(a, b) {
            return this.totalTime("number" == typeof a ? a : this._parseTimeOrLabel(a), b !== !1)
        }, q.stop = function() {
            return this.paused(!0)
        }, q.gotoAndPlay = function(a, b) {
            return this.play(a, b)
        }, q.gotoAndStop = function(a, b) {
            return this.pause(a, b)
        }, q.render = function(a, b, c) {
            this._gc && this._enabled(!0, !1);
            var d, f, g, h, i, l, m, n = this._dirty ? this.totalDuration() : this._totalDuration,
                o = this._time,
                p = this._startTime,
                q = this._timeScale,
                r = this._paused;
            if (a >= n - 1e-7) this._totalTime = this._time = n, this._reversed || this._hasPausedChild() || (f = !0, h = "onComplete", i = !!this._timeline.autoRemoveChildren, 0 === this._duration && (0 >= a && a >= -1e-7 || this._rawPrevTime < 0 || this._rawPrevTime === e) && this._rawPrevTime !== a && this._first && (i = !0, this._rawPrevTime > e && (h = "onReverseComplete"))), this._rawPrevTime = this._duration || !b || a || this._rawPrevTime === a ? a : e, a = n + 1e-4;
            else if (1e-7 > a)
                if (this._totalTime = this._time = 0, (0 !== o || 0 === this._duration && this._rawPrevTime !== e && (this._rawPrevTime > 0 || 0 > a && this._rawPrevTime >= 0)) && (h = "onReverseComplete", f = this._reversed), 0 > a) this._active = !1, this._timeline.autoRemoveChildren && this._reversed ? (i = f = !0, h = "onReverseComplete") : this._rawPrevTime >= 0 && this._first && (i = !0), this._rawPrevTime = a;
                else {
                    if (this._rawPrevTime = this._duration || !b || a || this._rawPrevTime === a ? a : e, 0 === a && f)
                        for (d = this._first; d && 0 === d._startTime;) d._duration || (f = !1), d = d._next;
                    a = 0, this._initted || (i = !0)
                } else {
                if (this._hasPause && !this._forcingPlayhead && !b) {
                    if (a >= o)
                        for (d = this._first; d && d._startTime <= a && !l;) d._duration || "isPause" !== d.data || d.ratio || 0 === d._startTime && 0 === this._rawPrevTime || (l = d), d = d._next;
                    else
                        for (d = this._last; d && d._startTime >= a && !l;) d._duration || "isPause" === d.data && d._rawPrevTime > 0 && (l = d), d = d._prev;
                    l && (this._time = a = l._startTime, this._totalTime = a + this._cycle * (this._totalDuration + this._repeatDelay))
                }
                this._totalTime = this._time = this._rawPrevTime = a
            }
            if (this._time !== o && this._first || c || i || l) {
                if (this._initted || (this._initted = !0), this._active || !this._paused && this._time !== o && a > 0 && (this._active = !0), 0 === o && this.vars.onStart && 0 !== this._time && (b || this._callback("onStart")), m = this._time, m >= o)
                    for (d = this._first; d && (g = d._next, m === this._time && (!this._paused || r));)(d._active || d._startTime <= m && !d._paused && !d._gc) && (l === d && this.pause(), d._reversed ? d.render((d._dirty ? d.totalDuration() : d._totalDuration) - (a - d._startTime) * d._timeScale, b, c) : d.render((a - d._startTime) * d._timeScale, b, c)), d = g;
                else
                    for (d = this._last; d && (g = d._prev, m === this._time && (!this._paused || r));) {
                        if (d._active || d._startTime <= o && !d._paused && !d._gc) {
                            if (l === d) {
                                for (l = d._prev; l && l.endTime() > this._time;) l.render(l._reversed ? l.totalDuration() - (a - l._startTime) * l._timeScale : (a - l._startTime) * l._timeScale, b, c), l = l._prev;
                                l = null, this.pause()
                            }
                            d._reversed ? d.render((d._dirty ? d.totalDuration() : d._totalDuration) - (a - d._startTime) * d._timeScale, b, c) : d.render((a - d._startTime) * d._timeScale, b, c)
                        }
                        d = g
                    }
                this._onUpdate && (b || (j.length && k(), this._callback("onUpdate"))), h && (this._gc || (p === this._startTime || q !== this._timeScale) && (0 === this._time || n >= this.totalDuration()) && (f && (j.length && k(), this._timeline.autoRemoveChildren && this._enabled(!1, !1), this._active = !1), !b && this.vars[h] && this._callback(h)))
            }
        }, q._hasPausedChild = function() {
            for (var a = this._first; a;) {
                if (a._paused || a instanceof d && a._hasPausedChild()) return !0;
                a = a._next
            }
            return !1
        }, q.getChildren = function(a, b, d, e) {
            e = e || -9999999999;
            for (var f = [], g = this._first, h = 0; g;) g._startTime < e || (g instanceof c ? b !== !1 && (f[h++] = g) : (d !== !1 && (f[h++] = g), a !== !1 && (f = f.concat(g.getChildren(!0, b, d)), h = f.length))), g = g._next;
            return f
        }, q.getTweensOf = function(a, b) {
            var d, e, f = this._gc,
                g = [],
                h = 0;
            for (f && this._enabled(!0, !0), d = c.getTweensOf(a), e = d.length; --e > -1;)(d[e].timeline === this || b && this._contains(d[e])) && (g[h++] = d[e]);
            return f && this._enabled(!1, !0), g
        }, q.recent = function() {
            return this._recent
        }, q._contains = function(a) {
            for (var b = a.timeline; b;) {
                if (b === this) return !0;
                b = b.timeline
            }
            return !1
        }, q.shiftChildren = function(a, b, c) {
            c = c || 0;
            for (var d, e = this._first, f = this._labels; e;) e._startTime >= c && (e._startTime += a), e = e._next;
            if (b)
                for (d in f) f[d] >= c && (f[d] += a);
            return this._uncache(!0)
        }, q._kill = function(a, b) {
            if (!a && !b) return this._enabled(!1, !1);
            for (var c = b ? this.getTweensOf(b) : this.getChildren(!0, !0, !1), d = c.length, e = !1; --d > -1;) c[d]._kill(a, b) && (e = !0);
            return e
        }, q.clear = function(a) {
            var b = this.getChildren(!1, !0, !0),
                c = b.length;
            for (this._time = this._totalTime = 0; --c > -1;) b[c]._enabled(!1, !1);
            return a !== !1 && (this._labels = {}), this._uncache(!0)
        }, q.invalidate = function() {
            for (var b = this._first; b;) b.invalidate(), b = b._next;
            return a.prototype.invalidate.call(this)
        }, q._enabled = function(a, c) {
            if (a === this._gc)
                for (var d = this._first; d;) d._enabled(a, !0), d = d._next;
            return b.prototype._enabled.call(this, a, c)
        }, q.totalTime = function(b, c, d) {
            this._forcingPlayhead = !0;
            var e = a.prototype.totalTime.apply(this, arguments);
            return this._forcingPlayhead = !1, e
        }, q.duration = function(a) {
            return arguments.length ? (0 !== this.duration() && 0 !== a && this.timeScale(this._duration / a), this) : (this._dirty && this.totalDuration(), this._duration)
        }, q.totalDuration = function(a) {
            if (!arguments.length) {
                if (this._dirty) {
                    for (var b, c, d = 0, e = this._last, f = 999999999999; e;) b = e._prev, e._dirty && e.totalDuration(), e._startTime > f && this._sortChildren && !e._paused ? this.add(e, e._startTime - e._delay) : f = e._startTime, e._startTime < 0 && !e._paused && (d -= e._startTime, this._timeline.smoothChildTiming && (this._startTime += e._startTime / this._timeScale), this.shiftChildren(-e._startTime, !1, -9999999999), f = 0), c = e._startTime + e._totalDuration / e._timeScale, c > d && (d = c), e = b;
                    this._duration = this._totalDuration = d, this._dirty = !1
                }
                return this._totalDuration
            }
            return a && this.totalDuration() ? this.timeScale(this._totalDuration / a) : this
        }, q.paused = function(b) {
            if (!b)
                for (var c = this._first, d = this._time; c;) c._startTime === d && "isPause" === c.data && (c._rawPrevTime = 0), c = c._next;
            return a.prototype.paused.apply(this, arguments)
        }, q.usesFrames = function() {
            for (var b = this._timeline; b._timeline;) b = b._timeline;
            return b === a._rootFramesTimeline
        }, q.rawTime = function() {
            return this._paused ? this._totalTime : (this._timeline.rawTime() - this._startTime) * this._timeScale
        }, d
    }, !0), _gsScope._gsDefine("TimelineMax", ["TimelineLite", "TweenLite", "easing.Ease"], function(a, b, c) {
        var d = function(b) {
                a.call(this, b), this._repeat = this.vars.repeat || 0, this._repeatDelay = this.vars.repeatDelay || 0, this._cycle = 0, this._yoyo = this.vars.yoyo === !0, this._dirty = !0
            },
            e = 1e-10,
            f = b._internals,
            g = f.lazyTweens,
            h = f.lazyRender,
            i = new c(null, null, 1, 0),
            j = d.prototype = new a;
        return j.constructor = d, j.kill()._gc = !1, d.version = "1.18.4", j.invalidate = function() {
            return this._yoyo = this.vars.yoyo === !0, this._repeat = this.vars.repeat || 0, this._repeatDelay = this.vars.repeatDelay || 0, this._uncache(!0), a.prototype.invalidate.call(this)
        }, j.addCallback = function(a, c, d, e) {
            return this.add(b.delayedCall(0, a, d, e), c)
        }, j.removeCallback = function(a, b) {
            if (a)
                if (null == b) this._kill(null, a);
                else
                    for (var c = this.getTweensOf(a, !1), d = c.length, e = this._parseTimeOrLabel(b); --d > -1;) c[d]._startTime === e && c[d]._enabled(!1, !1);
            return this
        }, j.removePause = function(b) {
            return this.removeCallback(a._internals.pauseCallback, b)
        }, j.tweenTo = function(a, c) {
            c = c || {};
            var d, e, f, g = {
                ease: i,
                useFrames: this.usesFrames(),
                immediateRender: !1
            };
            for (e in c) g[e] = c[e];
            return g.time = this._parseTimeOrLabel(a), d = Math.abs(Number(g.time) - this._time) / this._timeScale || .001, f = new b(this, d, g), g.onStart = function() {
                f.target.paused(!0), f.vars.time !== f.target.time() && d === f.duration() && f.duration(Math.abs(f.vars.time - f.target.time()) / f.target._timeScale), c.onStart && f._callback("onStart")
            }, f
        }, j.tweenFromTo = function(a, b, c) {
            c = c || {}, a = this._parseTimeOrLabel(a), c.startAt = {
                onComplete: this.seek,
                onCompleteParams: [a],
                callbackScope: this
            }, c.immediateRender = c.immediateRender !== !1;
            var d = this.tweenTo(b, c);
            return d.duration(Math.abs(d.vars.time - a) / this._timeScale || .001)
        }, j.render = function(a, b, c) {
            this._gc && this._enabled(!0, !1);
            var d, f, i, j, k, l, m, n, o = this._dirty ? this.totalDuration() : this._totalDuration,
                p = this._duration,
                q = this._time,
                r = this._totalTime,
                s = this._startTime,
                t = this._timeScale,
                u = this._rawPrevTime,
                v = this._paused,
                w = this._cycle;
            if (a >= o - 1e-7) this._locked || (this._totalTime = o, this._cycle = this._repeat), this._reversed || this._hasPausedChild() || (f = !0, j = "onComplete", k = !!this._timeline.autoRemoveChildren, 0 === this._duration && (0 >= a && a >= -1e-7 || 0 > u || u === e) && u !== a && this._first && (k = !0, u > e && (j = "onReverseComplete"))), this._rawPrevTime = this._duration || !b || a || this._rawPrevTime === a ? a : e, this._yoyo && 0 !== (1 & this._cycle) ? this._time = a = 0 : (this._time = p, a = p + 1e-4);
            else if (1e-7 > a)
                if (this._locked || (this._totalTime = this._cycle = 0), this._time = 0, (0 !== q || 0 === p && u !== e && (u > 0 || 0 > a && u >= 0) && !this._locked) && (j = "onReverseComplete", f = this._reversed), 0 > a) this._active = !1, this._timeline.autoRemoveChildren && this._reversed ? (k = f = !0, j = "onReverseComplete") : u >= 0 && this._first && (k = !0), this._rawPrevTime = a;
                else {
                    if (this._rawPrevTime = p || !b || a || this._rawPrevTime === a ? a : e, 0 === a && f)
                        for (d = this._first; d && 0 === d._startTime;) d._duration || (f = !1), d = d._next;
                    a = 0, this._initted || (k = !0)
                } else if (0 === p && 0 > u && (k = !0), this._time = this._rawPrevTime = a, this._locked || (this._totalTime = a, 0 !== this._repeat && (l = p + this._repeatDelay, this._cycle = this._totalTime / l >> 0, 0 !== this._cycle && this._cycle === this._totalTime / l && a >= r && this._cycle--, this._time = this._totalTime - this._cycle * l, this._yoyo && 0 !== (1 & this._cycle) && (this._time = p - this._time), this._time > p ? (this._time = p, a = p + 1e-4) : this._time < 0 ? this._time = a = 0 : a = this._time)), this._hasPause && !this._forcingPlayhead && !b) {
                if (a = this._time, a >= q)
                    for (d = this._first; d && d._startTime <= a && !m;) d._duration || "isPause" !== d.data || d.ratio || 0 === d._startTime && 0 === this._rawPrevTime || (m = d), d = d._next;
                else
                    for (d = this._last; d && d._startTime >= a && !m;) d._duration || "isPause" === d.data && d._rawPrevTime > 0 && (m = d), d = d._prev;
                m && (this._time = a = m._startTime, this._totalTime = a + this._cycle * (this._totalDuration + this._repeatDelay))
            }
            if (this._cycle !== w && !this._locked) {
                var x = this._yoyo && 0 !== (1 & w),
                    y = x === (this._yoyo && 0 !== (1 & this._cycle)),
                    z = this._totalTime,
                    A = this._cycle,
                    B = this._rawPrevTime,
                    C = this._time;
                if (this._totalTime = w * p, this._cycle < w ? x = !x : this._totalTime += p, this._time = q, this._rawPrevTime = 0 === p ? u - 1e-4 : u, this._cycle = w, this._locked = !0, q = x ? 0 : p, this.render(q, b, 0 === p), b || this._gc || this.vars.onRepeat && this._callback("onRepeat"), q !== this._time) return;
                if (y && (q = x ? p + 1e-4 : -1e-4, this.render(q, !0, !1)), this._locked = !1, this._paused && !v) return;
                this._time = C, this._totalTime = z, this._cycle = A, this._rawPrevTime = B
            }
            if (!(this._time !== q && this._first || c || k || m)) return void(r !== this._totalTime && this._onUpdate && (b || this._callback("onUpdate")));
            if (this._initted || (this._initted = !0), this._active || !this._paused && this._totalTime !== r && a > 0 && (this._active = !0), 0 === r && this.vars.onStart && 0 !== this._totalTime && (b || this._callback("onStart")), n = this._time, n >= q)
                for (d = this._first; d && (i = d._next, n === this._time && (!this._paused || v));)(d._active || d._startTime <= this._time && !d._paused && !d._gc) && (m === d && this.pause(), d._reversed ? d.render((d._dirty ? d.totalDuration() : d._totalDuration) - (a - d._startTime) * d._timeScale, b, c) : d.render((a - d._startTime) * d._timeScale, b, c)), d = i;
            else
                for (d = this._last; d && (i = d._prev, n === this._time && (!this._paused || v));) {
                    if (d._active || d._startTime <= q && !d._paused && !d._gc) {
                        if (m === d) {
                            for (m = d._prev; m && m.endTime() > this._time;) m.render(m._reversed ? m.totalDuration() - (a - m._startTime) * m._timeScale : (a - m._startTime) * m._timeScale, b, c), m = m._prev;
                            m = null, this.pause()
                        }
                        d._reversed ? d.render((d._dirty ? d.totalDuration() : d._totalDuration) - (a - d._startTime) * d._timeScale, b, c) : d.render((a - d._startTime) * d._timeScale, b, c)
                    }
                    d = i
                }
            this._onUpdate && (b || (g.length && h(), this._callback("onUpdate"))), j && (this._locked || this._gc || (s === this._startTime || t !== this._timeScale) && (0 === this._time || o >= this.totalDuration()) && (f && (g.length && h(), this._timeline.autoRemoveChildren && this._enabled(!1, !1), this._active = !1), !b && this.vars[j] && this._callback(j)))
        }, j.getActive = function(a, b, c) {
            null == a && (a = !0), null == b && (b = !0), null == c && (c = !1);
            var d, e, f = [],
                g = this.getChildren(a, b, c),
                h = 0,
                i = g.length;
            for (d = 0; i > d; d++) e = g[d], e.isActive() && (f[h++] = e);
            return f
        }, j.getLabelAfter = function(a) {
            a || 0 !== a && (a = this._time);
            var b, c = this.getLabelsArray(),
                d = c.length;
            for (b = 0; d > b; b++)
                if (c[b].time > a) return c[b].name;
            return null
        }, j.getLabelBefore = function(a) {
            null == a && (a = this._time);
            for (var b = this.getLabelsArray(), c = b.length; --c > -1;)
                if (b[c].time < a) return b[c].name;
            return null
        }, j.getLabelsArray = function() {
            var a, b = [],
                c = 0;
            for (a in this._labels) b[c++] = {
                time: this._labels[a],
                name: a
            };
            return b.sort(function(a, b) {
                return a.time - b.time
            }), b
        }, j.progress = function(a, b) {
            return arguments.length ? this.totalTime(this.duration() * (this._yoyo && 0 !== (1 & this._cycle) ? 1 - a : a) + this._cycle * (this._duration + this._repeatDelay), b) : this._time / this.duration()
        }, j.totalProgress = function(a, b) {
            return arguments.length ? this.totalTime(this.totalDuration() * a, b) : this._totalTime / this.totalDuration()
        }, j.totalDuration = function(b) {
            return arguments.length ? -1 !== this._repeat && b ? this.timeScale(this.totalDuration() / b) : this : (this._dirty && (a.prototype.totalDuration.call(this), this._totalDuration = -1 === this._repeat ? 999999999999 : this._duration * (this._repeat + 1) + this._repeatDelay * this._repeat), this._totalDuration)
        }, j.time = function(a, b) {
            return arguments.length ? (this._dirty && this.totalDuration(), a > this._duration && (a = this._duration), this._yoyo && 0 !== (1 & this._cycle) ? a = this._duration - a + this._cycle * (this._duration + this._repeatDelay) : 0 !== this._repeat && (a += this._cycle * (this._duration + this._repeatDelay)), this.totalTime(a, b)) : this._time
        }, j.repeat = function(a) {
            return arguments.length ? (this._repeat = a, this._uncache(!0)) : this._repeat
        }, j.repeatDelay = function(a) {
            return arguments.length ? (this._repeatDelay = a, this._uncache(!0)) : this._repeatDelay
        }, j.yoyo = function(a) {
            return arguments.length ? (this._yoyo = a, this) : this._yoyo
        }, j.currentLabel = function(a) {
            return arguments.length ? this.seek(a, !0) : this.getLabelBefore(this._time + 1e-8)
        }, d
    }, !0),
        function() {
            var a = 180 / Math.PI,
                b = [],
                c = [],
                d = [],
                e = {},
                f = _gsScope._gsDefine.globals,
                g = function(a, b, c, d) {
                    this.a = a, this.b = b, this.c = c, this.d = d, this.da = d - a, this.ca = c - a, this.ba = b - a
                },
                h = ",x,y,z,left,top,right-columns,bottom,marginTop,marginLeft,marginRight,marginBottom,paddingLeft,paddingTop,paddingRight,paddingBottom,backgroundPosition,backgroundPosition_y,",
                i = function(a, b, c, d) {
                    var e = {
                            a: a
                        },
                        f = {},
                        g = {},
                        h = {
                            c: d
                        },
                        i = (a + b) / 2,
                        j = (b + c) / 2,
                        k = (c + d) / 2,
                        l = (i + j) / 2,
                        m = (j + k) / 2,
                        n = (m - l) / 8;
                    return e.b = i + (a - i) / 4, f.b = l + n, e.c = f.a = (e.b + f.b) / 2, f.c = g.a = (l + m) / 2, g.b = m - n, h.b = k + (d - k) / 4, g.c = h.a = (g.b + h.b) / 2, [e, f, g, h]
                },
                j = function(a, e, f, g, h) {
                    var j, k, l, m, n, o, p, q, r, s, t, u, v, w = a.length - 1,
                        x = 0,
                        y = a[0].a;
                    for (j = 0; w > j; j++) n = a[x], k = n.a, l = n.d, m = a[x + 1].d, h ? (t = b[j], u = c[j], v = (u + t) * e * .25 / (g ? .5 : d[j] || .5), o = l - (l - k) * (g ? .5 * e : 0 !== t ? v / t : 0), p = l + (m - l) * (g ? .5 * e : 0 !== u ? v / u : 0), q = l - (o + ((p - o) * (3 * t / (t + u) + .5) / 4 || 0))) : (o = l - (l - k) * e * .5, p = l + (m - l) * e * .5, q = l - (o + p) / 2), o += q, p += q, n.c = r = o, 0 !== j ? n.b = y : n.b = y = n.a + .6 * (n.c - n.a), n.da = l - k, n.ca = r - k, n.ba = y - k, f ? (s = i(k, y, r, l), a.splice(x, 1, s[0], s[1], s[2], s[3]), x += 4) : x++, y = p;
                    n = a[x], n.b = y, n.c = y + .4 * (n.d - y), n.da = n.d - n.a, n.ca = n.c - n.a, n.ba = y - n.a, f && (s = i(n.a, y, n.c, n.d), a.splice(x, 1, s[0], s[1], s[2], s[3]))
                },
                k = function(a, d, e, f) {
                    var h, i, j, k, l, m, n = [];
                    if (f)
                        for (a = [f].concat(a), i = a.length; --i > -1;) "string" == typeof(m = a[i][d]) && "=" === m.charAt(1) && (a[i][d] = f[d] + Number(m.charAt(0) + m.substr(2)));
                    if (h = a.length - 2, 0 > h) return n[0] = new g(a[0][d], 0, 0, a[-1 > h ? 0 : 1][d]), n;
                    for (i = 0; h > i; i++) j = a[i][d], k = a[i + 1][d], n[i] = new g(j, 0, 0, k), e && (l = a[i + 2][d], b[i] = (b[i] || 0) + (k - j) * (k - j), c[i] = (c[i] || 0) + (l - k) * (l - k));
                    return n[i] = new g(a[i][d], 0, 0, a[i + 1][d]), n
                },
                l = function(a, f, g, i, l, m) {
                    var n, o, p, q, r, s, t, u, v = {},
                        w = [],
                        x = m || a[0];
                    l = "string" == typeof l ? "," + l + "," : h, null == f && (f = 1);
                    for (o in a[0]) w.push(o);
                    if (a.length > 1) {
                        for (u = a[a.length - 1], t = !0, n = w.length; --n > -1;)
                            if (o = w[n], Math.abs(x[o] - u[o]) > .05) {
                                t = !1;
                                break
                            }
                        t && (a = a.concat(), m && a.unshift(m), a.push(a[1]), m = a[a.length - 3])
                    }
                    for (b.length = c.length = d.length = 0, n = w.length; --n > -1;) o = w[n], e[o] = -1 !== l.indexOf("," + o + ","), v[o] = k(a, o, e[o], m);
                    for (n = b.length; --n > -1;) b[n] = Math.sqrt(b[n]), c[n] = Math.sqrt(c[n]);
                    if (!i) {
                        for (n = w.length; --n > -1;)
                            if (e[o])
                                for (p = v[w[n]], s = p.length - 1, q = 0; s > q; q++) r = p[q + 1].da / c[q] + p[q].da / b[q] || 0, d[q] = (d[q] || 0) + r * r;
                        for (n = d.length; --n > -1;) d[n] = Math.sqrt(d[n])
                    }
                    for (n = w.length, q = g ? 4 : 1; --n > -1;) o = w[n], p = v[o], j(p, f, g, i, e[o]), t && (p.splice(0, q), p.splice(p.length - q, q));
                    return v
                },
                m = function(a, b, c) {
                    b = b || "soft";
                    var d, e, f, h, i, j, k, l, m, n, o, p = {},
                        q = "cubic" === b ? 3 : 2,
                        r = "soft" === b,
                        s = [];
                    if (r && c && (a = [c].concat(a)), null == a || a.length < q + 1) throw "invalid Bezier data";
                    for (m in a[0]) s.push(m);
                    for (j = s.length; --j > -1;) {
                        for (m = s[j], p[m] = i = [], n = 0, l = a.length, k = 0; l > k; k++) d = null == c ? a[k][m] : "string" == typeof(o = a[k][m]) && "=" === o.charAt(1) ? c[m] + Number(o.charAt(0) + o.substr(2)) : Number(o), r && k > 1 && l - 1 > k && (i[n++] = (d + i[n - 2]) / 2), i[n++] = d;
                        for (l = n - q + 1, n = 0, k = 0; l > k; k += q) d = i[k], e = i[k + 1], f = i[k + 2], h = 2 === q ? 0 : i[k + 3], i[n++] = o = 3 === q ? new g(d, e, f, h) : new g(d, (2 * e + d) / 3, (2 * e + f) / 3, f);
                        i.length = n
                    }
                    return p
                },
                n = function(a, b, c) {
                    for (var d, e, f, g, h, i, j, k, l, m, n, o = 1 / c, p = a.length; --p > -1;)
                        for (m = a[p], f = m.a, g = m.d - f, h = m.c - f, i = m.b - f, d = e = 0, k = 1; c >= k; k++) j = o * k, l = 1 - j, d = e - (e = (j * j * g + 3 * l * (j * h + l * i)) * j), n = p * c + k - 1, b[n] = (b[n] || 0) + d * d
                },
                o = function(a, b) {
                    b = b >> 0 || 6;
                    var c, d, e, f, g = [],
                        h = [],
                        i = 0,
                        j = 0,
                        k = b - 1,
                        l = [],
                        m = [];
                    for (c in a) n(a[c], g, b);
                    for (e = g.length, d = 0; e > d; d++) i += Math.sqrt(g[d]), f = d % b, m[f] = i, f === k && (j += i, f = d / b >> 0, l[f] = m, h[f] = j, i = 0, m = []);
                    return {
                        length: j,
                        lengths: h,
                        segments: l
                    }
                },
                p = _gsScope._gsDefine.plugin({
                    propName: "bezier",
                    priority: -1,
                    version: "1.3.5",
                    API: 2,
                    global: !0,
                    init: function(a, b, c) {
                        this._target = a, b instanceof Array && (b = {
                            values: b
                        }), this._func = {}, this._round = {}, this._props = [], this._timeRes = null == b.timeResolution ? 6 : parseInt(b.timeResolution, 10);
                        var d, e, f, g, h, i = b.values || [],
                            j = {},
                            k = i[0],
                            n = b.autoRotate || c.vars.orientToBezier;
                        this._autoRotate = n ? n instanceof Array ? n : [
                            ["x", "y", "rotation", n === !0 ? 0 : Number(n) || 0]
                        ] : null;
                        for (d in k) this._props.push(d);
                        for (f = this._props.length; --f > -1;) d = this._props[f], this._overwriteProps.push(d), e = this._func[d] = "function" == typeof a[d], j[d] = e ? a[d.indexOf("set") || "function" != typeof a["get" + d.substr(3)] ? d : "get" + d.substr(3)]() : parseFloat(a[d]), h || j[d] !== i[0][d] && (h = j);
                        if (this._beziers = "cubic" !== b.type && "quadratic" !== b.type && "soft" !== b.type ? l(i, isNaN(b.curviness) ? 1 : b.curviness, !1, "thruBasic" === b.type, b.correlate, h) : m(i, b.type, j), this._segCount = this._beziers[d].length, this._timeRes) {
                            var p = o(this._beziers, this._timeRes);
                            this._length = p.length, this._lengths = p.lengths, this._segments = p.segments, this._l1 = this._li = this._s1 = this._si = 0, this._l2 = this._lengths[0], this._curSeg = this._segments[0], this._s2 = this._curSeg[0], this._prec = 1 / this._curSeg.length
                        }
                        if (n = this._autoRotate)
                            for (this._initialRotations = [], n[0] instanceof Array || (this._autoRotate = n = [n]), f = n.length; --f > -1;) {
                                for (g = 0; 3 > g; g++) d = n[f][g], this._func[d] = "function" == typeof a[d] ? a[d.indexOf("set") || "function" != typeof a["get" + d.substr(3)] ? d : "get" + d.substr(3)] : !1;
                                d = n[f][2], this._initialRotations[f] = (this._func[d] ? this._func[d].call(this._target) : this._target[d]) || 0
                            }
                        return this._startRatio = c.vars.runBackwards ? 1 : 0, !0
                    },
                    set: function(b) {
                        var c, d, e, f, g, h, i, j, k, l, m = this._segCount,
                            n = this._func,
                            o = this._target,
                            p = b !== this._startRatio;
                        if (this._timeRes) {
                            if (k = this._lengths, l = this._curSeg, b *= this._length, e = this._li, b > this._l2 && m - 1 > e) {
                                for (j = m - 1; j > e && (this._l2 = k[++e]) <= b;);
                                this._l1 = k[e - 1], this._li = e, this._curSeg = l = this._segments[e], this._s2 = l[this._s1 = this._si = 0]
                            } else if (b < this._l1 && e > 0) {
                                for (; e > 0 && (this._l1 = k[--e]) >= b;);
                                0 === e && b < this._l1 ? this._l1 = 0 : e++, this._l2 = k[e], this._li = e, this._curSeg = l = this._segments[e], this._s1 = l[(this._si = l.length - 1) - 1] || 0, this._s2 = l[this._si]
                            }
                            if (c = e, b -= this._l1, e = this._si, b > this._s2 && e < l.length - 1) {
                                for (j = l.length - 1; j > e && (this._s2 = l[++e]) <= b;);
                                this._s1 = l[e - 1], this._si = e
                            } else if (b < this._s1 && e > 0) {
                                for (; e > 0 && (this._s1 = l[--e]) >= b;);
                                0 === e && b < this._s1 ? this._s1 = 0 : e++, this._s2 = l[e], this._si = e
                            }
                            h = (e + (b - this._s1) / (this._s2 - this._s1)) * this._prec || 0
                        } else c = 0 > b ? 0 : b >= 1 ? m - 1 : m * b >> 0, h = (b - c * (1 / m)) * m;
                        for (d = 1 - h, e = this._props.length; --e > -1;) f = this._props[e], g = this._beziers[f][c], i = (h * h * g.da + 3 * d * (h * g.ca + d * g.ba)) * h + g.a, this._round[f] && (i = Math.round(i)), n[f] ? o[f](i) : o[f] = i;
                        if (this._autoRotate) {
                            var q, r, s, t, u, v, w, x = this._autoRotate;
                            for (e = x.length; --e > -1;) f = x[e][2], v = x[e][3] || 0, w = x[e][4] === !0 ? 1 : a, g = this._beziers[x[e][0]], q = this._beziers[x[e][1]], g && q && (g = g[c], q = q[c], r = g.a + (g.b - g.a) * h, t = g.b + (g.c - g.b) * h, r += (t - r) * h, t += (g.c + (g.d - g.c) * h - t) * h, s = q.a + (q.b - q.a) * h, u = q.b + (q.c - q.b) * h, s += (u - s) * h, u += (q.c + (q.d - q.c) * h - u) * h, i = p ? Math.atan2(u - s, t - r) * w + v : this._initialRotations[e], n[f] ? o[f](i) : o[f] = i)
                        }
                    }
                }),
                q = p.prototype;
            p.bezierThrough = l, p.cubicToQuadratic = i, p._autoCSS = !0, p.quadraticToCubic = function(a, b, c) {
                return new g(a, (2 * b + a) / 3, (2 * b + c) / 3, c)
            }, p._cssRegister = function() {
                var a = f.CSSPlugin;
                if (a) {
                    var b = a._internals,
                        c = b._parseToProxy,
                        d = b._setPluginRatio,
                        e = b.CSSPropTween;
                    b._registerComplexSpecialProp("bezier", {
                        parser: function(a, b, f, g, h, i) {
                            b instanceof Array && (b = {
                                values: b
                            }), i = new p;
                            var j, k, l, m = b.values,
                                n = m.length - 1,
                                o = [],
                                q = {};
                            if (0 > n) return h;
                            for (j = 0; n >= j; j++) l = c(a, m[j], g, h, i, n !== j), o[j] = l.end;
                            for (k in b) q[k] = b[k];
                            return q.values = o, h = new e(a, "bezier", 0, 0, l.pt, 2), h.data = l, h.plugin = i, h.setRatio = d, 0 === q.autoRotate && (q.autoRotate = !0), !q.autoRotate || q.autoRotate instanceof Array || (j = q.autoRotate === !0 ? 0 : Number(q.autoRotate), q.autoRotate = null != l.end.left ? [
                                ["left", "top", "rotation", j, !1]
                            ] : null != l.end.x ? [
                                ["x", "y", "rotation", j, !1]
                            ] : !1), q.autoRotate && (g._transform || g._enableTransforms(!1), l.autoRotate = g._target._gsTransform), i._onInitTween(l.proxy, q, g._tween), h
                        }
                    })
                }
            }, q._roundProps = function(a, b) {
                for (var c = this._overwriteProps, d = c.length; --d > -1;)(a[c[d]] || a.bezier || a.bezierThrough) && (this._round[c[d]] = b)
            }, q._kill = function(a) {
                var b, c, d = this._props;
                for (b in this._beziers)
                    if (b in a)
                        for (delete this._beziers[b], delete this._func[b], c = d.length; --c > -1;) d[c] === b && d.splice(c, 1);
                return this._super._kill.call(this, a)
            }
        }(), _gsScope._gsDefine("plugins.CSSPlugin", ["plugins.TweenPlugin", "TweenLite"], function(a, b) {
        var c, d, e, f, g = function() {
                a.call(this, "css"), this._overwriteProps.length = 0, this.setRatio = g.prototype.setRatio
            },
            h = _gsScope._gsDefine.globals,
            i = {},
            j = g.prototype = new a("css");
        j.constructor = g, g.version = "1.18.4", g.API = 2, g.defaultTransformPerspective = 0, g.defaultSkewType = "compensated", g.defaultSmoothOrigin = !0, j = "px", g.suffixMap = {
            top: j,
            right: j,
            bottom: j,
            left: j,
            width: j,
            height: j,
            fontSize: j,
            padding: j,
            margin: j,
            perspective: j,
            lineHeight: ""
        };
        var k, l, m, n, o, p, q = /(?:\-|\.|\b)(\d|\.|e\-)+/g,
            r = /(?:\d|\-\d|\.\d|\-\.\d|\+=\d|\-=\d|\+=.\d|\-=\.\d)+/g,
            s = /(?:\+=|\-=|\-|\b)[\d\-\.]+[a-zA-Z0-9]*(?:%|\b)/gi,
            t = /(?![+-]?\d*\.?\d+|[+-]|e[+-]\d+)[^0-9]/g,
            u = /(?:\d|\-|\+|=|#|\.)*/g,
            v = /opacity *= *([^)]*)/i,
            w = /opacity:([^;]*)/i,
            x = /alpha\(opacity *=.+?\)/i,
            y = /^(rgb|hsl)/,
            z = /([A-Z])/g,
            A = /-([a-z])/gi,
            B = /(^(?:url\(\"|url\())|(?:(\"\))$|\)$)/gi,
            C = function(a, b) {
                return b.toUpperCase()
            },
            D = /(?:Left|Right|Width)/i,
            E = /(M11|M12|M21|M22)=[\d\-\.e]+/gi,
            F = /progid\:DXImageTransform\.Microsoft\.Matrix\(.+?\)/i,
            G = /,(?=[^\)]*(?:\(|$))/gi,
            H = /[\s,\(]/i,
            I = Math.PI / 180,
            J = 180 / Math.PI,
            K = {},
            L = document,
            M = function(a) {
                return L.createElementNS ? L.createElementNS("http://www.w3.org/1999/xhtml", a) : L.createElement(a)
            },
            N = M("div"),
            O = M("img"),
            P = g._internals = {
                _specialProps: i
            },
            Q = navigator.userAgent,
            R = function() {
                var a = Q.indexOf("Android"),
                    b = M("a");
                return m = -1 !== Q.indexOf("Safari") && -1 === Q.indexOf("Chrome") && (-1 === a || Number(Q.substr(a + 8, 1)) > 3), o = m && Number(Q.substr(Q.indexOf("Version/") + 8, 1)) < 6, n = -1 !== Q.indexOf("Firefox"), (/MSIE ([0-9]{1,}[\.0-9]{0,})/.exec(Q) || /Trident\/.*rv:([0-9]{1,}[\.0-9]{0,})/.exec(Q)) && (p = parseFloat(RegExp.$1)), b ? (b.style.cssText = "top:1px;opacity:.55;", /^0.55/.test(b.style.opacity)) : !1
            }(),
            S = function(a) {
                return v.test("string" == typeof a ? a : (a.currentStyle ? a.currentStyle.filter : a.style.filter) || "") ? parseFloat(RegExp.$1) / 100 : 1
            },
            T = function(a) {
                window.console && console.log(a)
            },
            U = "",
            V = "",
            W = function(a, b) {
                b = b || N;
                var c, d, e = b.style;
                if (void 0 !== e[a]) return a;
                for (a = a.charAt(0).toUpperCase() + a.substr(1), c = ["O", "Moz", "ms", "Ms", "Webkit"], d = 5; --d > -1 && void 0 === e[c[d] + a];);
                return d >= 0 ? (V = 3 === d ? "ms" : c[d], U = "-" + V.toLowerCase() + "-", V + a) : null
            },
            X = L.defaultView ? L.defaultView.getComputedStyle : function() {},
            Y = g.getStyle = function(a, b, c, d, e) {
                var f;
                return R || "opacity" !== b ? (!d && a.style[b] ? f = a.style[b] : (c = c || X(a)) ? f = c[b] || c.getPropertyValue(b) || c.getPropertyValue(b.replace(z, "-$1").toLowerCase()) : a.currentStyle && (f = a.currentStyle[b]), null == e || f && "none" !== f && "auto" !== f && "auto auto" !== f ? f : e) : S(a)
            },
            Z = P.convertToPixels = function(a, c, d, e, f) {
                if ("px" === e || !e) return d;
                if ("auto" === e || !d) return 0;
                var h, i, j, k = D.test(c),
                    l = a,
                    m = N.style,
                    n = 0 > d;
                if (n && (d = -d), "%" === e && -1 !== c.indexOf("border")) h = d / 100 * (k ? a.clientWidth : a.clientHeight);
                else {
                    if (m.cssText = "border:0 solid red;position:" + Y(a, "position") + ";line-height:0;", "%" !== e && l.appendChild && "v" !== e.charAt(0) && "rem" !== e) m[k ? "borderLeftWidth" : "borderTopWidth"] = d + e;
                    else {
                        if (l = a.parentNode || L.body, i = l._gsCache, j = b.ticker.frame, i && k && i.time === j) return i.width * d / 100;
                        m[k ? "width" : "height"] = d + e
                    }
                    l.appendChild(N), h = parseFloat(N[k ? "offsetWidth" : "offsetHeight"]), l.removeChild(N), k && "%" === e && g.cacheWidths !== !1 && (i = l._gsCache = l._gsCache || {}, i.time = j, i.width = h / d * 100), 0 !== h || f || (h = Z(a, c, d, e, !0))
                }
                return n ? -h : h
            },
            $ = P.calculateOffset = function(a, b, c) {
                if ("absolute" !== Y(a, "position", c)) return 0;
                var d = "left" === b ? "Left" : "Top",
                    e = Y(a, "margin" + d, c);
                return a["offset" + d] - (Z(a, b, parseFloat(e), e.replace(u, "")) || 0)
            },
            _ = function(a, b) {
                var c, d, e, f = {};
                if (b = b || X(a, null))
                    if (c = b.length)
                        for (; --c > -1;) e = b[c], (-1 === e.indexOf("-transform") || Aa === e) && (f[e.replace(A, C)] = b.getPropertyValue(e));
                    else
                        for (c in b)(-1 === c.indexOf("Transform") || za === c) && (f[c] = b[c]);
                else if (b = a.currentStyle || a.style)
                    for (c in b) "string" == typeof c && void 0 === f[c] && (f[c.replace(A, C)] = b[c]);
                return R || (f.opacity = S(a)), d = Na(a, b, !1), f.rotation = d.rotation, f.skewX = d.skewX, f.scaleX = d.scaleX, f.scaleY = d.scaleY, f.x = d.x, f.y = d.y, Ca && (f.z = d.z, f.rotationX = d.rotationX, f.rotationY = d.rotationY, f.scaleZ = d.scaleZ), f.filters && delete f.filters, f
            },
            aa = function(a, b, c, d, e) {
                var f, g, h, i = {},
                    j = a.style;
                for (g in c) "cssText" !== g && "length" !== g && isNaN(g) && (b[g] !== (f = c[g]) || e && e[g]) && -1 === g.indexOf("Origin") && ("number" == typeof f || "string" == typeof f) && (i[g] = "auto" !== f || "left" !== g && "top" !== g ? "" !== f && "auto" !== f && "none" !== f || "string" != typeof b[g] || "" === b[g].replace(t, "") ? f : 0 : $(a, g), void 0 !== j[g] && (h = new pa(j, g, j[g], h)));
                if (d)
                    for (g in d) "className" !== g && (i[g] = d[g]);
                return {
                    difs: i,
                    firstMPT: h
                }
            },
            ba = {
                width: ["Left", "Right"],
                height: ["Top", "Bottom"]
            },
            ca = ["marginLeft", "marginRight", "marginTop", "marginBottom"],
            da = function(a, b, c) {
                if ("svg" === (a.nodeName + "").toLowerCase()) return (c || X(a))[b] || 0;
                if (a.getBBox && Ka(a)) return a.getBBox()[b] || 0;
                var d = parseFloat("width" === b ? a.offsetWidth : a.offsetHeight),
                    e = ba[b],
                    f = e.length;
                for (c = c || X(a, null); --f > -1;) d -= parseFloat(Y(a, "padding" + e[f], c, !0)) || 0, d -= parseFloat(Y(a, "border" + e[f] + "Width", c, !0)) || 0;
                return d
            },
            ea = function(a, b) {
                if ("contain" === a || "auto" === a || "auto auto" === a) return a + " ";
                (null == a || "" === a) && (a = "0 0");
                var c, d = a.split(" "),
                    e = -1 !== a.indexOf("left") ? "0%" : -1 !== a.indexOf("right") ? "100%" : d[0],
                    f = -1 !== a.indexOf("top") ? "0%" : -1 !== a.indexOf("bottom") ? "100%" : d[1];
                if (d.length > 3 && !b) {
                    for (d = a.split(", ").join(",").split(","), a = [], c = 0; c < d.length; c++) a.push(ea(d[c]));
                    return a.join(",")
                }
                return null == f ? f = "center" === e ? "50%" : "0" : "center" === f && (f = "50%"), ("center" === e || isNaN(parseFloat(e)) && -1 === (e + "").indexOf("=")) && (e = "50%"), a = e + " " + f + (d.length > 2 ? " " + d[2] : ""), b && (b.oxp = -1 !== e.indexOf("%"), b.oyp = -1 !== f.indexOf("%"), b.oxr = "=" === e.charAt(1), b.oyr = "=" === f.charAt(1), b.ox = parseFloat(e.replace(t, "")), b.oy = parseFloat(f.replace(t, "")), b.v = a), b || a
            },
            fa = function(a, b) {
                return "string" == typeof a && "=" === a.charAt(1) ? parseInt(a.charAt(0) + "1", 10) * parseFloat(a.substr(2)) : parseFloat(a) - parseFloat(b) || 0
            },
            ga = function(a, b) {
                return null == a ? b : "string" == typeof a && "=" === a.charAt(1) ? parseInt(a.charAt(0) + "1", 10) * parseFloat(a.substr(2)) + b : parseFloat(a) || 0
            },
            ha = function(a, b, c, d) {
                var e, f, g, h, i, j = 1e-6;
                return null == a ? h = b : "number" == typeof a ? h = a : (e = 360, f = a.split("_"), i = "=" === a.charAt(1), g = (i ? parseInt(a.charAt(0) + "1", 10) * parseFloat(f[0].substr(2)) : parseFloat(f[0])) * (-1 === a.indexOf("rad") ? 1 : J) - (i ? 0 : b), f.length && (d && (d[c] = b + g), -1 !== a.indexOf("short") && (g %= e, g !== g % (e / 2) && (g = 0 > g ? g + e : g - e)), -1 !== a.indexOf("_cw") && 0 > g ? g = (g + 9999999999 * e) % e - (g / e | 0) * e : -1 !== a.indexOf("ccw") && g > 0 && (g = (g - 9999999999 * e) % e - (g / e | 0) * e)), h = b + g), j > h && h > -j && (h = 0), h
            },
            ia = {
                aqua: [0, 255, 255],
                lime: [0, 255, 0],
                silver: [192, 192, 192],
                black: [0, 0, 0],
                maroon: [128, 0, 0],
                teal: [0, 128, 128],
                blue: [0, 0, 255],
                navy: [0, 0, 128],
                white: [255, 255, 255],
                fuchsia: [255, 0, 255],
                olive: [128, 128, 0],
                yellow: [255, 255, 0],
                orange: [255, 165, 0],
                gray: [128, 128, 128],
                purple: [128, 0, 128],
                green: [0, 128, 0],
                red: [255, 0, 0],
                pink: [255, 192, 203],
                cyan: [0, 255, 255],
                transparent: [255, 255, 255, 0]
            },
            ja = function(a, b, c) {
                return a = 0 > a ? a + 1 : a > 1 ? a - 1 : a, 255 * (1 > 6 * a ? b + (c - b) * a * 6 : .5 > a ? c : 2 > 3 * a ? b + (c - b) * (2 / 3 - a) * 6 : b) + .5 | 0
            },
            ka = g.parseColor = function(a, b) {
                var c, d, e, f, g, h, i, j, k, l, m;
                if (a)
                    if ("number" == typeof a) c = [a >> 16, a >> 8 & 255, 255 & a];
                    else {
                        if ("," === a.charAt(a.length - 1) && (a = a.substr(0, a.length - 1)), ia[a]) c = ia[a];
                        else if ("#" === a.charAt(0)) 4 === a.length && (d = a.charAt(1), e = a.charAt(2), f = a.charAt(3), a = "#" + d + d + e + e + f + f), a = parseInt(a.substr(1), 16), c = [a >> 16, a >> 8 & 255, 255 & a];
                        else if ("hsl" === a.substr(0, 3))
                            if (c = m = a.match(q), b) {
                                if (-1 !== a.indexOf("=")) return a.match(r)
                            } else g = Number(c[0]) % 360 / 360, h = Number(c[1]) / 100, i = Number(c[2]) / 100, e = .5 >= i ? i * (h + 1) : i + h - i * h, d = 2 * i - e, c.length > 3 && (c[3] = Number(a[3])), c[0] = ja(g + 1 / 3, d, e), c[1] = ja(g, d, e), c[2] = ja(g - 1 / 3, d, e);
                        else c = a.match(q) || ia.transparent;
                        c[0] = Number(c[0]), c[1] = Number(c[1]), c[2] = Number(c[2]), c.length > 3 && (c[3] = Number(c[3]))
                    } else c = ia.black;
                return b && !m && (d = c[0] / 255, e = c[1] / 255, f = c[2] / 255, j = Math.max(d, e, f), k = Math.min(d, e, f), i = (j + k) / 2, j === k ? g = h = 0 : (l = j - k, h = i > .5 ? l / (2 - j - k) : l / (j + k), g = j === d ? (e - f) / l + (f > e ? 6 : 0) : j === e ? (f - d) / l + 2 : (d - e) / l + 4, g *= 60), c[0] = g + .5 | 0, c[1] = 100 * h + .5 | 0, c[2] = 100 * i + .5 | 0), c
            },
            la = function(a, b) {
                var c, d, e, f = a.match(ma) || [],
                    g = 0,
                    h = f.length ? "" : a;
                for (c = 0; c < f.length; c++) d = f[c], e = a.substr(g, a.indexOf(d, g) - g), g += e.length + d.length, d = ka(d, b), 3 === d.length && d.push(1), h += e + (b ? "hsla(" + d[0] + "," + d[1] + "%," + d[2] + "%," + d[3] : "rgba(" + d.join(",")) + ")";
                return h + a.substr(g)
            },
            ma = "(?:\\b(?:(?:rgb|rgba|hsl|hsla)\\(.+?\\))|\\B#(?:[0-9a-f]{3}){1,2}\\b";
        for (j in ia) ma += "|" + j + "\\b";
        ma = new RegExp(ma + ")", "gi"), g.colorStringFilter = function(a) {
            var b, c = a[0] + a[1];
            ma.test(c) && (b = -1 !== c.indexOf("hsl(") || -1 !== c.indexOf("hsla("), a[0] = la(a[0], b), a[1] = la(a[1], b)), ma.lastIndex = 0
        }, b.defaultStringFilter || (b.defaultStringFilter = g.colorStringFilter);
        var na = function(a, b, c, d) {
                if (null == a) return function(a) {
                    return a
                };
                var e, f = b ? (a.match(ma) || [""])[0] : "",
                    g = a.split(f).join("").match(s) || [],
                    h = a.substr(0, a.indexOf(g[0])),
                    i = ")" === a.charAt(a.length - 1) ? ")" : "",
                    j = -1 !== a.indexOf(" ") ? " " : ",",
                    k = g.length,
                    l = k > 0 ? g[0].replace(q, "") : "";
                return k ? e = b ? function(a) {
                    var b, m, n, o;
                    if ("number" == typeof a) a += l;
                    else if (d && G.test(a)) {
                        for (o = a.replace(G, "|").split("|"), n = 0; n < o.length; n++) o[n] = e(o[n]);
                        return o.join(",")
                    }
                    if (b = (a.match(ma) || [f])[0], m = a.split(b).join("").match(s) || [], n = m.length, k > n--)
                        for (; ++n < k;) m[n] = c ? m[(n - 1) / 2 | 0] : g[n];
                    return h + m.join(j) + j + b + i + (-1 !== a.indexOf("inset") ? " inset" : "")
                } : function(a) {
                    var b, f, m;
                    if ("number" == typeof a) a += l;
                    else if (d && G.test(a)) {
                        for (f = a.replace(G, "|").split("|"), m = 0; m < f.length; m++) f[m] = e(f[m]);
                        return f.join(",")
                    }
                    if (b = a.match(s) || [], m = b.length, k > m--)
                        for (; ++m < k;) b[m] = c ? b[(m - 1) / 2 | 0] : g[m];
                    return h + b.join(j) + i
                } : function(a) {
                    return a
                }
            },
            oa = function(a) {
                return a = a.split(","),
                    function(b, c, d, e, f, g, h) {
                        var i, j = (c + "").split(" ");
                        for (h = {}, i = 0; 4 > i; i++) h[a[i]] = j[i] = j[i] || j[(i - 1) / 2 >> 0];
                        return e.parse(b, h, f, g)
                    }
            },
            pa = (P._setPluginRatio = function(a) {
                this.plugin.setRatio(a);
                for (var b, c, d, e, f, g = this.data, h = g.proxy, i = g.firstMPT, j = 1e-6; i;) b = h[i.v], i.r ? b = Math.round(b) : j > b && b > -j && (b = 0), i.t[i.p] = b, i = i._next;
                if (g.autoRotate && (g.autoRotate.rotation = h.rotation), 1 === a || 0 === a)
                    for (i = g.firstMPT, f = 1 === a ? "e" : "b"; i;) {
                        if (c = i.t, c.type) {
                            if (1 === c.type) {
                                for (e = c.xs0 + c.s + c.xs1, d = 1; d < c.l; d++) e += c["xn" + d] + c["xs" + (d + 1)];
                                c[f] = e
                            }
                        } else c[f] = c.s + c.xs0;
                        i = i._next
                    }
            }, function(a, b, c, d, e) {
                this.t = a, this.p = b, this.v = c, this.r = e, d && (d._prev = this, this._next = d)
            }),
            qa = (P._parseToProxy = function(a, b, c, d, e, f) {
                var g, h, i, j, k, l = d,
                    m = {},
                    n = {},
                    o = c._transform,
                    p = K;
                for (c._transform = null, K = b, d = k = c.parse(a, b, d, e), K = p, f && (c._transform = o, l && (l._prev = null, l._prev && (l._prev._next = null))); d && d !== l;) {
                    if (d.type <= 1 && (h = d.p, n[h] = d.s + d.c, m[h] = d.s, f || (j = new pa(d, "s", h, j, d.r), d.c = 0), 1 === d.type))
                        for (g = d.l; --g > 0;) i = "xn" + g, h = d.p + "_" + i, n[h] = d.data[i], m[h] = d[i], f || (j = new pa(d, i, h, j, d.rxp[i]));
                    d = d._next
                }
                return {
                    proxy: m,
                    end: n,
                    firstMPT: j,
                    pt: k
                }
            }, P.CSSPropTween = function(a, b, d, e, g, h, i, j, k, l, m) {
                this.t = a, this.p = b, this.s = d, this.c = e, this.n = i || b, a instanceof qa || f.push(this.n), this.r = j, this.type = h || 0, k && (this.pr = k, c = !0), this.b = void 0 === l ? d : l, this.e = void 0 === m ? d + e : m, g && (this._next = g, g._prev = this)
            }),
            ra = function(a, b, c, d, e, f) {
                var g = new qa(a, b, c, d - c, e, -1, f);
                return g.b = c, g.e = g.xs0 = d, g
            },
            sa = g.parseComplex = function(a, b, c, d, e, f, h, i, j, l) {
                c = c || f || "", h = new qa(a, b, 0, 0, h, l ? 2 : 1, null, !1, i, c, d), d += "", e && ma.test(d + c) && (d = [c, d], g.colorStringFilter(d), c = d[0], d = d[1]);
                var m, n, o, p, s, t, u, v, w, x, y, z, A, B = c.split(", ").join(",").split(" "),
                    C = d.split(", ").join(",").split(" "),
                    D = B.length,
                    E = k !== !1;
                for ((-1 !== d.indexOf(",") || -1 !== c.indexOf(",")) && (B = B.join(" ").replace(G, ", ").split(" "), C = C.join(" ").replace(G, ", ").split(" "), D = B.length), D !== C.length && (B = (f || "").split(" "), D = B.length), h.plugin = j, h.setRatio = l, ma.lastIndex = 0, m = 0; D > m; m++)
                    if (p = B[m], s = C[m], v = parseFloat(p), v || 0 === v) h.appendXtra("", v, fa(s, v), s.replace(r, ""), E && -1 !== s.indexOf("px"), !0);
                    else if (e && ma.test(p)) z = s.indexOf(")") + 1, z = ")" + (z ? s.substr(z) : ""), A = -1 !== s.indexOf("hsl") && R, p = ka(p, A), s = ka(s, A), w = p.length + s.length > 6, w && !R && 0 === s[3] ? (h["xs" + h.l] += h.l ? " transparent" : "transparent", h.e = h.e.split(C[m]).join("transparent")) : (R || (w = !1), A ? h.appendXtra(w ? "hsla(" : "hsl(", p[0], fa(s[0], p[0]), ",", !1, !0).appendXtra("", p[1], fa(s[1], p[1]), "%,", !1).appendXtra("", p[2], fa(s[2], p[2]), w ? "%," : "%" + z, !1) : h.appendXtra(w ? "rgba(" : "rgb(", p[0], s[0] - p[0], ",", !0, !0).appendXtra("", p[1], s[1] - p[1], ",", !0).appendXtra("", p[2], s[2] - p[2], w ? "," : z, !0), w && (p = p.length < 4 ? 1 : p[3], h.appendXtra("", p, (s.length < 4 ? 1 : s[3]) - p, z, !1))), ma.lastIndex = 0;
                    else if (t = p.match(q)) {
                        if (u = s.match(r), !u || u.length !== t.length) return h;
                        for (o = 0, n = 0; n < t.length; n++) y = t[n], x = p.indexOf(y, o), h.appendXtra(p.substr(o, x - o), Number(y), fa(u[n], y), "", E && "px" === p.substr(x + y.length, 2), 0 === n), o = x + y.length;
                        h["xs" + h.l] += p.substr(o)
                    } else h["xs" + h.l] += h.l || h["xs" + h.l] ? " " + s : s;
                if (-1 !== d.indexOf("=") && h.data) {
                    for (z = h.xs0 + h.data.s, m = 1; m < h.l; m++) z += h["xs" + m] + h.data["xn" + m];
                    h.e = z + h["xs" + m]
                }
                return h.l || (h.type = -1, h.xs0 = h.e), h.xfirst || h
            },
            ta = 9;
        for (j = qa.prototype, j.l = j.pr = 0; --ta > 0;) j["xn" + ta] = 0, j["xs" + ta] = "";
        j.xs0 = "", j._next = j._prev = j.xfirst = j.data = j.plugin = j.setRatio = j.rxp = null, j.appendXtra = function(a, b, c, d, e, f) {
            var g = this,
                h = g.l;
            return g["xs" + h] += f && (h || g["xs" + h]) ? " " + a : a || "", c || 0 === h || g.plugin ? (g.l++, g.type = g.setRatio ? 2 : 1, g["xs" + g.l] = d || "", h > 0 ? (g.data["xn" + h] = b + c, g.rxp["xn" + h] = e, g["xn" + h] = b, g.plugin || (g.xfirst = new qa(g, "xn" + h, b, c, g.xfirst || g, 0, g.n, e, g.pr), g.xfirst.xs0 = 0), g) : (g.data = {
                s: b + c
            }, g.rxp = {}, g.s = b, g.c = c, g.r = e, g)) : (g["xs" + h] += b + (d || ""), g)
        };
        var ua = function(a, b) {
                b = b || {}, this.p = b.prefix ? W(a) || a : a, i[a] = i[this.p] = this, this.format = b.formatter || na(b.defaultValue, b.color, b.collapsible, b.multi), b.parser && (this.parse = b.parser), this.clrs = b.color, this.multi = b.multi, this.keyword = b.keyword, this.dflt = b.defaultValue, this.pr = b.priority || 0
            },
            va = P._registerComplexSpecialProp = function(a, b, c) {
                "object" != typeof b && (b = {
                    parser: c
                });
                var d, e, f = a.split(","),
                    g = b.defaultValue;
                for (c = c || [g], d = 0; d < f.length; d++) b.prefix = 0 === d && b.prefix, b.defaultValue = c[d] || g, e = new ua(f[d], b)
            },
            wa = function(a) {
                if (!i[a]) {
                    var b = a.charAt(0).toUpperCase() + a.substr(1) + "Plugin";
                    va(a, {
                        parser: function(a, c, d, e, f, g, j) {
                            var k = h.com.greensock.plugins[b];
                            return k ? (k._cssRegister(), i[d].parse(a, c, d, e, f, g, j)) : (T("Error: " + b + " js file not loaded."), f)
                        }
                    })
                }
            };
        j = ua.prototype, j.parseComplex = function(a, b, c, d, e, f) {
            var g, h, i, j, k, l, m = this.keyword;
            if (this.multi && (G.test(c) || G.test(b) ? (h = b.replace(G, "|").split("|"), i = c.replace(G, "|").split("|")) : m && (h = [b], i = [c])), i) {
                for (j = i.length > h.length ? i.length : h.length, g = 0; j > g; g++) b = h[g] = h[g] || this.dflt, c = i[g] = i[g] || this.dflt, m && (k = b.indexOf(m), l = c.indexOf(m), k !== l && (-1 === l ? h[g] = h[g].split(m).join("") : -1 === k && (h[g] += " " + m)));
                b = h.join(", "), c = i.join(", ")
            }
            return sa(a, this.p, b, c, this.clrs, this.dflt, d, this.pr, e, f)
        }, j.parse = function(a, b, c, d, f, g, h) {
            return this.parseComplex(a.style, this.format(Y(a, this.p, e, !1, this.dflt)), this.format(b), f, g)
        }, g.registerSpecialProp = function(a, b, c) {
            va(a, {
                parser: function(a, d, e, f, g, h, i) {
                    var j = new qa(a, e, 0, 0, g, 2, e, !1, c);
                    return j.plugin = h, j.setRatio = b(a, d, f._tween, e), j
                },
                priority: c
            })
        }, g.useSVGTransformAttr = m || n;
        var xa, ya = "scaleX,scaleY,scaleZ,x,y,z,skewX,skewY,rotation,rotationX,rotationY,perspective,xPercent,yPercent".split(","),
            za = W("transform"),
            Aa = U + "transform",
            Ba = W("transformOrigin"),
            Ca = null !== W("perspective"),
            Da = P.Transform = function() {
                this.perspective = parseFloat(g.defaultTransformPerspective) || 0, this.force3D = g.defaultForce3D !== !1 && Ca ? g.defaultForce3D || "auto" : !1
            },
            Ea = window.SVGElement,
            Fa = function(a, b, c) {
                var d, e = L.createElementNS("http://www.w3.org/2000/svg", a),
                    f = /([a-z])([A-Z])/g;
                for (d in c) e.setAttributeNS(null, d.replace(f, "$1-$2").toLowerCase(), c[d]);
                return b.appendChild(e), e
            },
            Ga = L.documentElement,
            Ha = function() {
                var a, b, c, d = p || /Android/i.test(Q) && !window.chrome;
                return L.createElementNS && !d && (a = Fa("svg", Ga), b = Fa("rect", a, {
                    width: 100,
                    height: 50,
                    x: 100
                }), c = b.getBoundingClientRect().width, b.style[Ba] = "50% 50%", b.style[za] = "scaleX(0.5)", d = c === b.getBoundingClientRect().width && !(n && Ca), Ga.removeChild(a)), d
            }(),
            Ia = function(a, b, c, d, e, f) {
                var h, i, j, k, l, m, n, o, p, q, r, s, t, u, v = a._gsTransform,
                    w = Ma(a, !0);
                v && (t = v.xOrigin, u = v.yOrigin), (!d || (h = d.split(" ")).length < 2) && (n = a.getBBox(), b = ea(b).split(" "), h = [(-1 !== b[0].indexOf("%") ? parseFloat(b[0]) / 100 * n.width : parseFloat(b[0])) + n.x, (-1 !== b[1].indexOf("%") ? parseFloat(b[1]) / 100 * n.height : parseFloat(b[1])) + n.y]), c.xOrigin = k = parseFloat(h[0]), c.yOrigin = l = parseFloat(h[1]), d && w !== La && (m = w[0], n = w[1], o = w[2], p = w[3], q = w[4], r = w[5], s = m * p - n * o, i = k * (p / s) + l * (-o / s) + (o * r - p * q) / s, j = k * (-n / s) + l * (m / s) - (m * r - n * q) / s, k = c.xOrigin = h[0] = i, l = c.yOrigin = h[1] = j), v && (f && (c.xOffset = v.xOffset, c.yOffset = v.yOffset, v = c), e || e !== !1 && g.defaultSmoothOrigin !== !1 ? (i = k - t, j = l - u, v.xOffset += i * w[0] + j * w[2] - i, v.yOffset += i * w[1] + j * w[3] - j) : v.xOffset = v.yOffset = 0), f || a.setAttribute("data-svg-origin", h.join(" "))
            },
            Ja = function(a) {
                try {
                    return a.getBBox()
                } catch (a) {}
            },
            Ka = function(a) {
                return !!(Ea && a.getBBox && a.getCTM && Ja(a) && (!a.parentNode || a.parentNode.getBBox && a.parentNode.getCTM))
            },
            La = [1, 0, 0, 1, 0, 0],
            Ma = function(a, b) {
                var c, d, e, f, g, h = a._gsTransform || new Da,
                    i = 1e5;
                if (za ? d = Y(a, Aa, null, !0) : a.currentStyle && (d = a.currentStyle.filter.match(E), d = d && 4 === d.length ? [d[0].substr(4), Number(d[2].substr(4)), Number(d[1].substr(4)), d[3].substr(4), h.x || 0, h.y || 0].join(",") : ""), c = !d || "none" === d || "matrix(1, 0, 0, 1, 0, 0)" === d, (h.svg || a.getBBox && Ka(a)) && (c && -1 !== (a.style[za] + "").indexOf("matrix") && (d = a.style[za], c = 0), e = a.getAttribute("transform"), c && e && (-1 !== e.indexOf("matrix") ? (d = e, c = 0) : -1 !== e.indexOf("translate") && (d = "matrix(1,0,0,1," + e.match(/(?:\-|\b)[\d\-\.e]+\b/gi).join(",") + ")", c = 0))), c) return La;
                for (e = (d || "").match(q) || [], ta = e.length; --ta > -1;) f = Number(e[ta]), e[ta] = (g = f - (f |= 0)) ? (g * i + (0 > g ? -.5 : .5) | 0) / i + f : f;
                return b && e.length > 6 ? [e[0], e[1], e[4], e[5], e[12], e[13]] : e
            },
            Na = P.getTransform = function(a, c, d, f) {
                if (a._gsTransform && d && !f) return a._gsTransform;
                var h, i, j, k, l, m, n = d ? a._gsTransform || new Da : new Da,
                    o = n.scaleX < 0,
                    p = 2e-5,
                    q = 1e5,
                    r = Ca ? parseFloat(Y(a, Ba, c, !1, "0 0 0").split(" ")[2]) || n.zOrigin || 0 : 0,
                    s = parseFloat(g.defaultTransformPerspective) || 0;
                if (n.svg = !(!a.getBBox || !Ka(a)), n.svg && (Ia(a, Y(a, Ba, e, !1, "50% 50%") + "", n, a.getAttribute("data-svg-origin")), xa = g.useSVGTransformAttr || Ha), h = Ma(a), h !== La) {
                    if (16 === h.length) {
                        var t, u, v, w, x, y = h[0],
                            z = h[1],
                            A = h[2],
                            B = h[3],
                            C = h[4],
                            D = h[5],
                            E = h[6],
                            F = h[7],
                            G = h[8],
                            H = h[9],
                            I = h[10],
                            K = h[12],
                            L = h[13],
                            M = h[14],
                            N = h[11],
                            O = Math.atan2(E, I);
                        n.zOrigin && (M = -n.zOrigin, K = G * M - h[12], L = H * M - h[13], M = I * M + n.zOrigin - h[14]), n.rotationX = O * J, O && (w = Math.cos(-O), x = Math.sin(-O), t = C * w + G * x, u = D * w + H * x, v = E * w + I * x, G = C * -x + G * w, H = D * -x + H * w, I = E * -x + I * w, N = F * -x + N * w, C = t, D = u, E = v), O = Math.atan2(-A, I), n.rotationY = O * J, O && (w = Math.cos(-O), x = Math.sin(-O), t = y * w - G * x, u = z * w - H * x, v = A * w - I * x, H = z * x + H * w, I = A * x + I * w, N = B * x + N * w, y = t, z = u, A = v), O = Math.atan2(z, y), n.rotation = O * J, O && (w = Math.cos(-O), x = Math.sin(-O), y = y * w + C * x, u = z * w + D * x, D = z * -x + D * w, E = A * -x + E * w, z = u), n.rotationX && Math.abs(n.rotationX) + Math.abs(n.rotation) > 359.9 && (n.rotationX = n.rotation = 0, n.rotationY = 180 - n.rotationY), n.scaleX = (Math.sqrt(y * y + z * z) * q + .5 | 0) / q, n.scaleY = (Math.sqrt(D * D + H * H) * q + .5 | 0) / q, n.scaleZ = (Math.sqrt(E * E + I * I) * q + .5 | 0) / q, n.skewX = C || D ? Math.atan2(C, D) * J + n.rotation : n.skewX || 0, Math.abs(n.skewX) > 90 && Math.abs(n.skewX) < 270 && (o ? (n.scaleX *= -1, n.skewX += n.rotation <= 0 ? 180 : -180, n.rotation += n.rotation <= 0 ? 180 : -180) : (n.scaleY *= -1, n.skewX += n.skewX <= 0 ? 180 : -180)), n.perspective = N ? 1 / (0 > N ? -N : N) : 0, n.x = K, n.y = L, n.z = M, n.svg && (n.x -= n.xOrigin - (n.xOrigin * y - n.yOrigin * C), n.y -= n.yOrigin - (n.yOrigin * z - n.xOrigin * D))
                    } else if ((!Ca || f || !h.length || n.x !== h[4] || n.y !== h[5] || !n.rotationX && !n.rotationY) && (void 0 === n.x || "none" !== Y(a, "display", c))) {
                        var P = h.length >= 6,
                            Q = P ? h[0] : 1,
                            R = h[1] || 0,
                            S = h[2] || 0,
                            T = P ? h[3] : 1;
                        n.x = h[4] || 0, n.y = h[5] || 0, j = Math.sqrt(Q * Q + R * R), k = Math.sqrt(T * T + S * S), l = Q || R ? Math.atan2(R, Q) * J : n.rotation || 0, m = S || T ? Math.atan2(S, T) * J + l : n.skewX || 0, Math.abs(m) > 90 && Math.abs(m) < 270 && (o ? (j *= -1, m += 0 >= l ? 180 : -180, l += 0 >= l ? 180 : -180) : (k *= -1, m += 0 >= m ? 180 : -180)), n.scaleX = j, n.scaleY = k, n.rotation = l, n.skewX = m, Ca && (n.rotationX = n.rotationY = n.z = 0, n.perspective = s, n.scaleZ = 1), n.svg && (n.x -= n.xOrigin - (n.xOrigin * Q + n.yOrigin * S), n.y -= n.yOrigin - (n.xOrigin * R + n.yOrigin * T))
                    }
                    n.zOrigin = r;
                    for (i in n) n[i] < p && n[i] > -p && (n[i] = 0)
                }
                return d && (a._gsTransform = n, n.svg && (xa && a.style[za] ? b.delayedCall(.001, function() {
                    Ra(a.style, za)
                }) : !xa && a.getAttribute("transform") && b.delayedCall(.001, function() {
                        a.removeAttribute("transform")
                    }))), n
            },
            Oa = function(a) {
                var b, c, d = this.data,
                    e = -d.rotation * I,
                    f = e + d.skewX * I,
                    g = 1e5,
                    h = (Math.cos(e) * d.scaleX * g | 0) / g,
                    i = (Math.sin(e) * d.scaleX * g | 0) / g,
                    j = (Math.sin(f) * -d.scaleY * g | 0) / g,
                    k = (Math.cos(f) * d.scaleY * g | 0) / g,
                    l = this.t.style,
                    m = this.t.currentStyle;
                if (m) {
                    c = i, i = -j, j = -c, b = m.filter, l.filter = "";
                    var n, o, q = this.t.offsetWidth,
                        r = this.t.offsetHeight,
                        s = "absolute" !== m.position,
                        t = "progid:DXImageTransform.Microsoft.Matrix(M11=" + h + ", M12=" + i + ", M21=" + j + ", M22=" + k,
                        w = d.x + q * d.xPercent / 100,
                        x = d.y + r * d.yPercent / 100;
                    if (null != d.ox && (n = (d.oxp ? q * d.ox * .01 : d.ox) - q / 2, o = (d.oyp ? r * d.oy * .01 : d.oy) - r / 2, w += n - (n * h + o * i), x += o - (n * j + o * k)), s ? (n = q / 2, o = r / 2, t += ", Dx=" + (n - (n * h + o * i) + w) + ", Dy=" + (o - (n * j + o * k) + x) + ")") : t += ", sizingMethod='auto expand')", -1 !== b.indexOf("DXImageTransform.Microsoft.Matrix(") ? l.filter = b.replace(F, t) : l.filter = t + " " + b, (0 === a || 1 === a) && 1 === h && 0 === i && 0 === j && 1 === k && (s && -1 === t.indexOf("Dx=0, Dy=0") || v.test(b) && 100 !== parseFloat(RegExp.$1) || -1 === b.indexOf(b.indexOf("Alpha")) && l.removeAttribute("filter")), !s) {
                        var y, z, A, B = 8 > p ? 1 : -1;
                        for (n = d.ieOffsetX || 0, o = d.ieOffsetY || 0, d.ieOffsetX = Math.round((q - ((0 > h ? -h : h) * q + (0 > i ? -i : i) * r)) / 2 + w), d.ieOffsetY = Math.round((r - ((0 > k ? -k : k) * r + (0 > j ? -j : j) * q)) / 2 + x), ta = 0; 4 > ta; ta++) z = ca[ta], y = m[z], c = -1 !== y.indexOf("px") ? parseFloat(y) : Z(this.t, z, parseFloat(y), y.replace(u, "")) || 0, A = c !== d[z] ? 2 > ta ? -d.ieOffsetX : -d.ieOffsetY : 2 > ta ? n - d.ieOffsetX : o - d.ieOffsetY, l[z] = (d[z] = Math.round(c - A * (0 === ta || 2 === ta ? 1 : B))) + "px"
                    }
                }
            },
            Pa = P.set3DTransformRatio = P.setTransformRatio = function(a) {
                var b, c, d, e, f, g, h, i, j, k, l, m, o, p, q, r, s, t, u, v, w, x, y, z = this.data,
                    A = this.t.style,
                    B = z.rotation,
                    C = z.rotationX,
                    D = z.rotationY,
                    E = z.scaleX,
                    F = z.scaleY,
                    G = z.scaleZ,
                    H = z.x,
                    J = z.y,
                    K = z.z,
                    L = z.svg,
                    M = z.perspective,
                    N = z.force3D;
                if (((1 === a || 0 === a) && "auto" === N && (this.tween._totalTime === this.tween._totalDuration || !this.tween._totalTime) || !N) && !K && !M && !D && !C && 1 === G || xa && L || !Ca) return void(B || z.skewX || L ? (B *= I, x = z.skewX * I, y = 1e5, b = Math.cos(B) * E, e = Math.sin(B) * E, c = Math.sin(B - x) * -F, f = Math.cos(B - x) * F, x && "simple" === z.skewType && (s = Math.tan(x), s = Math.sqrt(1 + s * s), c *= s, f *= s, z.skewY && (b *= s, e *= s)), L && (H += z.xOrigin - (z.xOrigin * b + z.yOrigin * c) + z.xOffset, J += z.yOrigin - (z.xOrigin * e + z.yOrigin * f) + z.yOffset, xa && (z.xPercent || z.yPercent) && (p = this.t.getBBox(), H += .01 * z.xPercent * p.width, J += .01 * z.yPercent * p.height), p = 1e-6, p > H && H > -p && (H = 0), p > J && J > -p && (J = 0)), u = (b * y | 0) / y + "," + (e * y | 0) / y + "," + (c * y | 0) / y + "," + (f * y | 0) / y + "," + H + "," + J + ")", L && xa ? this.t.setAttribute("transform", "matrix(" + u) : A[za] = (z.xPercent || z.yPercent ? "translate(" + z.xPercent + "%," + z.yPercent + "%) matrix(" : "matrix(") + u) : A[za] = (z.xPercent || z.yPercent ? "translate(" + z.xPercent + "%," + z.yPercent + "%) matrix(" : "matrix(") + E + ",0,0," + F + "," + H + "," + J + ")");
                if (n && (p = 1e-4, p > E && E > -p && (E = G = 2e-5), p > F && F > -p && (F = G = 2e-5), !M || z.z || z.rotationX || z.rotationY || (M = 0)), B || z.skewX) B *= I, q = b = Math.cos(B), r = e = Math.sin(B), z.skewX && (B -= z.skewX * I, q = Math.cos(B), r = Math.sin(B), "simple" === z.skewType && (s = Math.tan(z.skewX * I), s = Math.sqrt(1 + s * s), q *= s, r *= s, z.skewY && (b *= s, e *= s))), c = -r, f = q;
                else {
                    if (!(D || C || 1 !== G || M || L)) return void(A[za] = (z.xPercent || z.yPercent ? "translate(" + z.xPercent + "%," + z.yPercent + "%) translate3d(" : "translate3d(") + H + "px," + J + "px," + K + "px)" + (1 !== E || 1 !== F ? " scale(" + E + "," + F + ")" : ""));
                    b = f = 1, c = e = 0
                }
                j = 1, d = g = h = i = k = l = 0, m = M ? -1 / M : 0, o = z.zOrigin, p = 1e-6, v = ",", w = "0", B = D * I, B && (q = Math.cos(B), r = Math.sin(B), h = -r, k = m * -r, d = b * r, g = e * r, j = q, m *= q, b *= q, e *= q), B = C * I, B && (q = Math.cos(B), r = Math.sin(B), s = c * q + d * r, t = f * q + g * r, i = j * r, l = m * r, d = c * -r + d * q, g = f * -r + g * q, j *= q, m *= q, c = s, f = t), 1 !== G && (d *= G, g *= G, j *= G, m *= G), 1 !== F && (c *= F, f *= F, i *= F, l *= F), 1 !== E && (b *= E, e *= E, h *= E, k *= E), (o || L) && (o && (H += d * -o, J += g * -o, K += j * -o + o), L && (H += z.xOrigin - (z.xOrigin * b + z.yOrigin * c) + z.xOffset, J += z.yOrigin - (z.xOrigin * e + z.yOrigin * f) + z.yOffset), p > H && H > -p && (H = w), p > J && J > -p && (J = w), p > K && K > -p && (K = 0)), u = z.xPercent || z.yPercent ? "translate(" + z.xPercent + "%," + z.yPercent + "%) matrix3d(" : "matrix3d(", u += (p > b && b > -p ? w : b) + v + (p > e && e > -p ? w : e) + v + (p > h && h > -p ? w : h), u += v + (p > k && k > -p ? w : k) + v + (p > c && c > -p ? w : c) + v + (p > f && f > -p ? w : f), C || D || 1 !== G ? (u += v + (p > i && i > -p ? w : i) + v + (p > l && l > -p ? w : l) + v + (p > d && d > -p ? w : d), u += v + (p > g && g > -p ? w : g) + v + (p > j && j > -p ? w : j) + v + (p > m && m > -p ? w : m) + v) : u += ",0,0,0,0,1,0,", u += H + v + J + v + K + v + (M ? 1 + -K / M : 1) + ")", A[za] = u
            };
        j = Da.prototype, j.x = j.y = j.z = j.skewX = j.skewY = j.rotation = j.rotationX = j.rotationY = j.zOrigin = j.xPercent = j.yPercent = j.xOffset = j.yOffset = 0, j.scaleX = j.scaleY = j.scaleZ = 1, va("transform,scale,scaleX,scaleY,scaleZ,x,y,z,rotation,rotationX,rotationY,rotationZ,skewX,skewY,shortRotation,shortRotationX,shortRotationY,shortRotationZ,transformOrigin,svgOrigin,transformPerspective,directionalRotation,parseTransform,force3D,skewType,xPercent,yPercent,smoothOrigin", {
            parser: function(a, b, c, d, f, h, i) {
                if (d._lastParsedTransform === i) return f;
                d._lastParsedTransform = i;
                var j, k, l, m, n, o, p, q, r, s, t = a._gsTransform,
                    u = a.style,
                    v = 1e-6,
                    w = ya.length,
                    x = i,
                    y = {},
                    z = "transformOrigin";
                if (i.display ? (l = Y(a, "display"), u.display = "block", j = Na(a, e, !0, i.parseTransform), u.display = l) : j = Na(a, e, !0, i.parseTransform), d._transform = j, "string" == typeof x.transform && za) l = N.style, l[za] = x.transform, l.display = "block", l.position = "absolute", L.body.appendChild(N), k = Na(N, null, !1), j.svg && (q = j.xOrigin, r = j.yOrigin, k.x -= j.xOffset, k.y -= j.yOffset, (x.transformOrigin || x.svgOrigin) && (m = {}, Ia(a, ea(x.transformOrigin), m, x.svgOrigin, x.smoothOrigin, !0), q = m.xOrigin, r = m.yOrigin, k.x -= m.xOffset - j.xOffset, k.y -= m.yOffset - j.yOffset), (q || r) && (s = Ma(N), k.x -= q - (q * s[0] + r * s[2]), k.y -= r - (q * s[1] + r * s[3]))), L.body.removeChild(N), k.perspective || (k.perspective = j.perspective), null != x.xPercent && (k.xPercent = ga(x.xPercent, j.xPercent)), null != x.yPercent && (k.yPercent = ga(x.yPercent, j.yPercent));
                else if ("object" == typeof x) {
                    if (k = {
                            scaleX: ga(null != x.scaleX ? x.scaleX : x.scale, j.scaleX),
                            scaleY: ga(null != x.scaleY ? x.scaleY : x.scale, j.scaleY),
                            scaleZ: ga(x.scaleZ, j.scaleZ),
                            x: ga(x.x, j.x),
                            y: ga(x.y, j.y),
                            z: ga(x.z, j.z),
                            xPercent: ga(x.xPercent, j.xPercent),
                            yPercent: ga(x.yPercent, j.yPercent),
                            perspective: ga(x.transformPerspective, j.perspective)
                        }, p = x.directionalRotation, null != p)
                        if ("object" == typeof p)
                            for (l in p) x[l] = p[l];
                        else x.rotation = p;
                    "string" == typeof x.x && -1 !== x.x.indexOf("%") && (k.x = 0, k.xPercent = ga(x.x, j.xPercent)), "string" == typeof x.y && -1 !== x.y.indexOf("%") && (k.y = 0, k.yPercent = ga(x.y, j.yPercent)), k.rotation = ha("rotation" in x ? x.rotation : "shortRotation" in x ? x.shortRotation + "_short" : "rotationZ" in x ? x.rotationZ : j.rotation - j.skewY, j.rotation - j.skewY, "rotation", y), Ca && (k.rotationX = ha("rotationX" in x ? x.rotationX : "shortRotationX" in x ? x.shortRotationX + "_short" : j.rotationX || 0, j.rotationX, "rotationX", y), k.rotationY = ha("rotationY" in x ? x.rotationY : "shortRotationY" in x ? x.shortRotationY + "_short" : j.rotationY || 0, j.rotationY, "rotationY", y)), k.skewX = ha(x.skewX, j.skewX - j.skewY), (k.skewY = ha(x.skewY, j.skewY)) && (k.skewX += k.skewY, k.rotation += k.skewY)
                }
                for (Ca && null != x.force3D && (j.force3D = x.force3D, o = !0), j.skewType = x.skewType || j.skewType || g.defaultSkewType, n = j.force3D || j.z || j.rotationX || j.rotationY || k.z || k.rotationX || k.rotationY || k.perspective, n || null == x.scale || (k.scaleZ = 1); --w > -1;) c = ya[w], m = k[c] - j[c], (m > v || -v > m || null != x[c] || null != K[c]) && (o = !0, f = new qa(j, c, j[c], m, f), c in y && (f.e = y[c]), f.xs0 = 0, f.plugin = h, d._overwriteProps.push(f.n));
                return m = x.transformOrigin, j.svg && (m || x.svgOrigin) && (q = j.xOffset, r = j.yOffset, Ia(a, ea(m), k, x.svgOrigin, x.smoothOrigin), f = ra(j, "xOrigin", (t ? j : k).xOrigin, k.xOrigin, f, z), f = ra(j, "yOrigin", (t ? j : k).yOrigin, k.yOrigin, f, z), (q !== j.xOffset || r !== j.yOffset) && (f = ra(j, "xOffset", t ? q : j.xOffset, j.xOffset, f, z), f = ra(j, "yOffset", t ? r : j.yOffset, j.yOffset, f, z)), m = xa ? null : "0px 0px"), (m || Ca && n && j.zOrigin) && (za ? (o = !0, c = Ba, m = (m || Y(a, c, e, !1, "50% 50%")) + "", f = new qa(u, c, 0, 0, f, -1, z), f.b = u[c], f.plugin = h, Ca ? (l = j.zOrigin, m = m.split(" "), j.zOrigin = (m.length > 2 && (0 === l || "0px" !== m[2]) ? parseFloat(m[2]) : l) || 0, f.xs0 = f.e = m[0] + " " + (m[1] || "50%") + " 0px", f = new qa(j, "zOrigin", 0, 0, f, -1, f.n), f.b = l, f.xs0 = f.e = j.zOrigin) : f.xs0 = f.e = m) : ea(m + "", j)), o && (d._transformType = j.svg && xa || !n && 3 !== this._transformType ? 2 : 3), f
            },
            prefix: !0
        }), va("boxShadow", {
            defaultValue: "0px 0px 0px 0px #999",
            prefix: !0,
            color: !0,
            multi: !0,
            keyword: "inset"
        }), va("borderRadius", {
            defaultValue: "0px",
            parser: function(a, b, c, f, g, h) {
                b = this.format(b);
                var i, j, k, l, m, n, o, p, q, r, s, t, u, v, w, x, y = ["borderTopLeftRadius", "borderTopRightRadius", "borderBottomRightRadius", "borderBottomLeftRadius"],
                    z = a.style;
                for (q = parseFloat(a.offsetWidth), r = parseFloat(a.offsetHeight), i = b.split(" "), j = 0; j < y.length; j++) this.p.indexOf("border") && (y[j] = W(y[j])), m = l = Y(a, y[j], e, !1, "0px"), -1 !== m.indexOf(" ") && (l = m.split(" "), m = l[0], l = l[1]), n = k = i[j], o = parseFloat(m), t = m.substr((o + "").length), u = "=" === n.charAt(1), u ? (p = parseInt(n.charAt(0) + "1", 10), n = n.substr(2), p *= parseFloat(n), s = n.substr((p + "").length - (0 > p ? 1 : 0)) || "") : (p = parseFloat(n), s = n.substr((p + "").length)), "" === s && (s = d[c] || t), s !== t && (v = Z(a, "borderLeft", o, t), w = Z(a, "borderTop", o, t), "%" === s ? (m = v / q * 100 + "%", l = w / r * 100 + "%") : "em" === s ? (x = Z(a, "borderLeft", 1, "em"), m = v / x + "em", l = w / x + "em") : (m = v + "px", l = w + "px"), u && (n = parseFloat(m) + p + s, k = parseFloat(l) + p + s)), g = sa(z, y[j], m + " " + l, n + " " + k, !1, "0px", g);
                return g
            },
            prefix: !0,
            formatter: na("0px 0px 0px 0px", !1, !0)
        }), va("borderBottomLeftRadius,borderBottomRightRadius,borderTopLeftRadius,borderTopRightRadius", {
            defaultValue: "0px",
            parser: function(a, b, c, d, f, g) {
                return sa(a.style, c, this.format(Y(a, c, e, !1, "0px 0px")), this.format(b), !1, "0px", f)
            },
            prefix: !0,
            formatter: na("0px 0px", !1, !0)
        }), va("backgroundPosition", {
            defaultValue: "0 0",
            parser: function(a, b, c, d, f, g) {
                var h, i, j, k, l, m, n = "background-position",
                    o = e || X(a, null),
                    q = this.format((o ? p ? o.getPropertyValue(n + "-x") + " " + o.getPropertyValue(n + "-y") : o.getPropertyValue(n) : a.currentStyle.backgroundPositionX + " " + a.currentStyle.backgroundPositionY) || "0 0"),
                    r = this.format(b);
                if (-1 !== q.indexOf("%") != (-1 !== r.indexOf("%")) && r.split(",").length < 2 && (m = Y(a, "backgroundImage").replace(B, ""), m && "none" !== m)) {
                    for (h = q.split(" "), i = r.split(" "), O.setAttribute("src", m), j = 2; --j > -1;) q = h[j], k = -1 !== q.indexOf("%"), k !== (-1 !== i[j].indexOf("%")) && (l = 0 === j ? a.offsetWidth - O.width : a.offsetHeight - O.height, h[j] = k ? parseFloat(q) / 100 * l + "px" : parseFloat(q) / l * 100 + "%");
                    q = h.join(" ")
                }
                return this.parseComplex(a.style, q, r, f, g)
            },
            formatter: ea
        }), va("backgroundSize", {
            defaultValue: "0 0",
            formatter: ea
        }), va("perspective", {
            defaultValue: "0px",
            prefix: !0
        }), va("perspectiveOrigin", {
            defaultValue: "50% 50%",
            prefix: !0
        }), va("transformStyle", {
            prefix: !0
        }), va("backfaceVisibility", {
            prefix: !0
        }), va("userSelect", {
            prefix: !0
        }), va("margin", {
            parser: oa("marginTop,marginRight,marginBottom,marginLeft")
        }), va("padding", {
            parser: oa("paddingTop,paddingRight,paddingBottom,paddingLeft")
        }), va("clip", {
            defaultValue: "rect(0px,0px,0px,0px)",
            parser: function(a, b, c, d, f, g) {
                var h, i, j;
                return 9 > p ? (i = a.currentStyle, j = 8 > p ? " " : ",", h = "rect(" + i.clipTop + j + i.clipRight + j + i.clipBottom + j + i.clipLeft + ")", b = this.format(b).split(",").join(j)) : (h = this.format(Y(a, this.p, e, !1, this.dflt)), b = this.format(b)), this.parseComplex(a.style, h, b, f, g)
            }
        }), va("textShadow", {
            defaultValue: "0px 0px 0px #999",
            color: !0,
            multi: !0
        }), va("autoRound,strictUnits", {
            parser: function(a, b, c, d, e) {
                return e
            }
        }), va("border", {
            defaultValue: "0px solid #000",
            parser: function(a, b, c, d, f, g) {
                return this.parseComplex(a.style, this.format(Y(a, "borderTopWidth", e, !1, "0px") + " " + Y(a, "borderTopStyle", e, !1, "solid") + " " + Y(a, "borderTopColor", e, !1, "#000")), this.format(b), f, g)
            },
            color: !0,
            formatter: function(a) {
                var b = a.split(" ");
                return b[0] + " " + (b[1] || "solid") + " " + (a.match(ma) || ["#000"])[0]
            }
        }), va("borderWidth", {
            parser: oa("borderTopWidth,borderRightWidth,borderBottomWidth,borderLeftWidth")
        }), va("float,cssFloat,styleFloat", {
            parser: function(a, b, c, d, e, f) {
                var g = a.style,
                    h = "cssFloat" in g ? "cssFloat" : "styleFloat";
                return new qa(g, h, 0, 0, e, -1, c, !1, 0, g[h], b)
            }
        });
        var Qa = function(a) {
            var b, c = this.t,
                d = c.filter || Y(this.data, "filter") || "",
                e = this.s + this.c * a | 0;
            100 === e && (-1 === d.indexOf("atrix(") && -1 === d.indexOf("radient(") && -1 === d.indexOf("oader(") ? (c.removeAttribute("filter"), b = !Y(this.data, "filter")) : (c.filter = d.replace(x, ""), b = !0)), b || (this.xn1 && (c.filter = d = d || "alpha(opacity=" + e + ")"), -1 === d.indexOf("pacity") ? 0 === e && this.xn1 || (c.filter = d + " alpha(opacity=" + e + ")") : c.filter = d.replace(v, "opacity=" + e))
        };
        va("opacity,alpha,autoAlpha", {
            defaultValue: "1",
            parser: function(a, b, c, d, f, g) {
                var h = parseFloat(Y(a, "opacity", e, !1, "1")),
                    i = a.style,
                    j = "autoAlpha" === c;
                return "string" == typeof b && "=" === b.charAt(1) && (b = ("-" === b.charAt(0) ? -1 : 1) * parseFloat(b.substr(2)) + h), j && 1 === h && "hidden" === Y(a, "visibility", e) && 0 !== b && (h = 0), R ? f = new qa(i, "opacity", h, b - h, f) : (f = new qa(i, "opacity", 100 * h, 100 * (b - h), f), f.xn1 = j ? 1 : 0, i.zoom = 1, f.type = 2, f.b = "alpha(opacity=" + f.s + ")", f.e = "alpha(opacity=" + (f.s + f.c) + ")", f.data = a, f.plugin = g, f.setRatio = Qa), j && (f = new qa(i, "visibility", 0, 0, f, -1, null, !1, 0, 0 !== h ? "inherit" : "hidden", 0 === b ? "hidden" : "inherit"), f.xs0 = "inherit", d._overwriteProps.push(f.n), d._overwriteProps.push(c)), f
            }
        });
        var Ra = function(a, b) {
                b && (a.removeProperty ? (("ms" === b.substr(0, 2) || "webkit" === b.substr(0, 6)) && (b = "-" + b), a.removeProperty(b.replace(z, "-$1").toLowerCase())) : a.removeAttribute(b))
            },
            Sa = function(a) {
                if (this.t._gsClassPT = this, 1 === a || 0 === a) {
                    this.t.setAttribute("class", 0 === a ? this.b : this.e);
                    for (var b = this.data, c = this.t.style; b;) b.v ? c[b.p] = b.v : Ra(c, b.p), b = b._next;
                    1 === a && this.t._gsClassPT === this && (this.t._gsClassPT = null)
                } else this.t.getAttribute("class") !== this.e && this.t.setAttribute("class", this.e)
            };
        va("className", {
            parser: function(a, b, d, f, g, h, i) {
                var j, k, l, m, n, o = a.getAttribute("class") || "",
                    p = a.style.cssText;
                if (g = f._classNamePT = new qa(a, d, 0, 0, g, 2), g.setRatio = Sa, g.pr = -11, c = !0, g.b = o, k = _(a, e), l = a._gsClassPT) {
                    for (m = {}, n = l.data; n;) m[n.p] = 1, n = n._next;
                    l.setRatio(1)
                }
                return a._gsClassPT = g, g.e = "=" !== b.charAt(1) ? b : o.replace(new RegExp("(?:\\s|^)" + b.substr(2) + "(?![\\w-])"), "") + ("+" === b.charAt(0) ? " " + b.substr(2) : ""), a.setAttribute("class", g.e), j = aa(a, k, _(a), i, m), a.setAttribute("class", o), g.data = j.firstMPT, a.style.cssText = p, g = g.xfirst = f.parse(a, j.difs, g, h)
            }
        });
        var Ta = function(a) {
            if ((1 === a || 0 === a) && this.data._totalTime === this.data._totalDuration && "isFromStart" !== this.data.data) {
                var b, c, d, e, f, g = this.t.style,
                    h = i.transform.parse;
                if ("all" === this.e) g.cssText = "", e = !0;
                else
                    for (b = this.e.split(" ").join("").split(","), d = b.length; --d > -1;) c = b[d], i[c] && (i[c].parse === h ? e = !0 : c = "transformOrigin" === c ? Ba : i[c].p), Ra(g, c);
                e && (Ra(g, za), f = this.t._gsTransform, f && (f.svg && (this.t.removeAttribute("data-svg-origin"), this.t.removeAttribute("transform")), delete this.t._gsTransform))
            }
        };
        for (va("clearProps", {
            parser: function(a, b, d, e, f) {
                return f = new qa(a, d, 0, 0, f, 2), f.setRatio = Ta, f.e = b, f.pr = -10, f.data = e._tween, c = !0, f
            }
        }), j = "bezier,throwProps,physicsProps,physics2D".split(","), ta = j.length; ta--;) wa(j[ta]);
        j = g.prototype, j._firstPT = j._lastParsedTransform = j._transform = null, j._onInitTween = function(a, b, h) {
            if (!a.nodeType) return !1;
            this._target = a, this._tween = h, this._vars = b, k = b.autoRound, c = !1, d = b.suffixMap || g.suffixMap, e = X(a, ""), f = this._overwriteProps;
            var j, n, p, q, r, s, t, u, v, x = a.style;
            if (l && "" === x.zIndex && (j = Y(a, "zIndex", e), ("auto" === j || "" === j) && this._addLazySet(x, "zIndex", 0)), "string" == typeof b && (q = x.cssText, j = _(a, e), x.cssText = q + ";" + b, j = aa(a, j, _(a)).difs, !R && w.test(b) && (j.opacity = parseFloat(RegExp.$1)), b = j, x.cssText = q), b.className ? this._firstPT = n = i.className.parse(a, b.className, "className", this, null, null, b) : this._firstPT = n = this.parse(a, b, null), this._transformType) {
                for (v = 3 === this._transformType, za ? m && (l = !0, "" === x.zIndex && (t = Y(a, "zIndex", e), ("auto" === t || "" === t) && this._addLazySet(x, "zIndex", 0)), o && this._addLazySet(x, "WebkitBackfaceVisibility", this._vars.WebkitBackfaceVisibility || (v ? "visible" : "hidden"))) : x.zoom = 1, p = n; p && p._next;) p = p._next;
                u = new qa(a, "transform", 0, 0, null, 2), this._linkCSSP(u, null, p), u.setRatio = za ? Pa : Oa, u.data = this._transform || Na(a, e, !0), u.tween = h, u.pr = -1, f.pop()
            }
            if (c) {
                for (; n;) {
                    for (s = n._next, p = q; p && p.pr > n.pr;) p = p._next;
                    (n._prev = p ? p._prev : r) ? n._prev._next = n: q = n, (n._next = p) ? p._prev = n : r = n, n = s
                }
                this._firstPT = q
            }
            return !0
        }, j.parse = function(a, b, c, f) {
            var g, h, j, l, m, n, o, p, q, r, s = a.style;
            for (g in b) n = b[g], h = i[g], h ? c = h.parse(a, n, g, this, c, f, b) : (m = Y(a, g, e) + "", q = "string" == typeof n, "color" === g || "fill" === g || "stroke" === g || -1 !== g.indexOf("Color") || q && y.test(n) ? (q || (n = ka(n), n = (n.length > 3 ? "rgba(" : "rgb(") + n.join(",") + ")"), c = sa(s, g, m, n, !0, "transparent", c, 0, f)) : q && H.test(n) ? c = sa(s, g, m, n, !0, null, c, 0, f) : (j = parseFloat(m), o = j || 0 === j ? m.substr((j + "").length) : "", ("" === m || "auto" === m) && ("width" === g || "height" === g ? (j = da(a, g, e), o = "px") : "left" === g || "top" === g ? (j = $(a, g, e), o = "px") : (j = "opacity" !== g ? 0 : 1, o = "")), r = q && "=" === n.charAt(1), r ? (l = parseInt(n.charAt(0) + "1", 10), n = n.substr(2), l *= parseFloat(n), p = n.replace(u, "")) : (l = parseFloat(n), p = q ? n.replace(u, "") : ""), "" === p && (p = g in d ? d[g] : o), n = l || 0 === l ? (r ? l + j : l) + p : b[g], o !== p && "" !== p && (l || 0 === l) && j && (j = Z(a, g, j, o), "%" === p ? (j /= Z(a, g, 100, "%") / 100, b.strictUnits !== !0 && (m = j + "%")) : "em" === p || "rem" === p || "vw" === p || "vh" === p ? j /= Z(a, g, 1, p) : "px" !== p && (l = Z(a, g, l, p), p = "px"), r && (l || 0 === l) && (n = l + j + p)), r && (l += j), !j && 0 !== j || !l && 0 !== l ? void 0 !== s[g] && (n || n + "" != "NaN" && null != n) ? (c = new qa(s, g, l || j || 0, 0, c, -1, g, !1, 0, m, n), c.xs0 = "none" !== n || "display" !== g && -1 === g.indexOf("Style") ? n : m) : T("invalid " + g + " tween value: " + b[g]) : (c = new qa(s, g, j, l - j, c, 0, g, k !== !1 && ("px" === p || "zIndex" === g), 0, m, n), c.xs0 = p))), f && c && !c.plugin && (c.plugin = f);
            return c
        }, j.setRatio = function(a) {
            var b, c, d, e = this._firstPT,
                f = 1e-6;
            if (1 !== a || this._tween._time !== this._tween._duration && 0 !== this._tween._time)
                if (a || this._tween._time !== this._tween._duration && 0 !== this._tween._time || this._tween._rawPrevTime === -1e-6)
                    for (; e;) {
                        if (b = e.c * a + e.s, e.r ? b = Math.round(b) : f > b && b > -f && (b = 0), e.type)
                            if (1 === e.type)
                                if (d = e.l, 2 === d) e.t[e.p] = e.xs0 + b + e.xs1 + e.xn1 + e.xs2;
                                else if (3 === d) e.t[e.p] = e.xs0 + b + e.xs1 + e.xn1 + e.xs2 + e.xn2 + e.xs3;
                                else if (4 === d) e.t[e.p] = e.xs0 + b + e.xs1 + e.xn1 + e.xs2 + e.xn2 + e.xs3 + e.xn3 + e.xs4;
                                else if (5 === d) e.t[e.p] = e.xs0 + b + e.xs1 + e.xn1 + e.xs2 + e.xn2 + e.xs3 + e.xn3 + e.xs4 + e.xn4 + e.xs5;
                                else {
                                    for (c = e.xs0 + b + e.xs1, d = 1; d < e.l; d++) c += e["xn" + d] + e["xs" + (d + 1)];
                                    e.t[e.p] = c
                                } else -1 === e.type ? e.t[e.p] = e.xs0 : e.setRatio && e.setRatio(a);
                        else e.t[e.p] = b + e.xs0;
                        e = e._next
                    } else
                    for (; e;) 2 !== e.type ? e.t[e.p] = e.b : e.setRatio(a), e = e._next;
            else
                for (; e;) {
                    if (2 !== e.type)
                        if (e.r && -1 !== e.type)
                            if (b = Math.round(e.s + e.c), e.type) {
                                if (1 === e.type) {
                                    for (d = e.l, c = e.xs0 + b + e.xs1, d = 1; d < e.l; d++) c += e["xn" + d] + e["xs" + (d + 1)];
                                    e.t[e.p] = c
                                }
                            } else e.t[e.p] = b + e.xs0;
                        else e.t[e.p] = e.e;
                    else e.setRatio(a);
                    e = e._next
                }
        }, j._enableTransforms = function(a) {
            this._transform = this._transform || Na(this._target, e, !0), this._transformType = this._transform.svg && xa || !a && 3 !== this._transformType ? 2 : 3
        };
        var Ua = function(a) {
            this.t[this.p] = this.e, this.data._linkCSSP(this, this._next, null, !0)
        };
        j._addLazySet = function(a, b, c) {
            var d = this._firstPT = new qa(a, b, 0, 0, this._firstPT, 2);
            d.e = c, d.setRatio = Ua, d.data = this
        }, j._linkCSSP = function(a, b, c, d) {
            return a && (b && (b._prev = a), a._next && (a._next._prev = a._prev), a._prev ? a._prev._next = a._next : this._firstPT === a && (this._firstPT = a._next, d = !0), c ? c._next = a : d || null !== this._firstPT || (this._firstPT = a), a._next = b, a._prev = c), a
        }, j._kill = function(b) {
            var c, d, e, f = b;
            if (b.autoAlpha || b.alpha) {
                f = {};
                for (d in b) f[d] = b[d];
                f.opacity = 1, f.autoAlpha && (f.visibility = 1)
            }
            return b.className && (c = this._classNamePT) && (e = c.xfirst, e && e._prev ? this._linkCSSP(e._prev, c._next, e._prev._prev) : e === this._firstPT && (this._firstPT = c._next), c._next && this._linkCSSP(c._next, c._next._next, e._prev), this._classNamePT = null), a.prototype._kill.call(this, f)
        };
        var Va = function(a, b, c) {
            var d, e, f, g;
            if (a.slice)
                for (e = a.length; --e > -1;) Va(a[e], b, c);
            else
                for (d = a.childNodes, e = d.length; --e > -1;) f = d[e], g = f.type, f.style && (b.push(_(f)), c && c.push(f)), 1 !== g && 9 !== g && 11 !== g || !f.childNodes.length || Va(f, b, c)
        };
        return g.cascadeTo = function(a, c, d) {
            var e, f, g, h, i = b.to(a, c, d),
                j = [i],
                k = [],
                l = [],
                m = [],
                n = b._internals.reservedProps;
            for (a = i._targets || i.target, Va(a, k, m), i.render(c, !0, !0), Va(a, l), i.render(0, !0, !0), i._enabled(!0), e = m.length; --e > -1;)
                if (f = aa(m[e], k[e], l[e]), f.firstMPT) {
                    f = f.difs;
                    for (g in d) n[g] && (f[g] = d[g]);
                    h = {};
                    for (g in f) h[g] = k[e][g];
                    j.push(b.fromTo(m[e], c, h, f))
                }
            return j
        }, a.activate([g]), g
    }, !0),
        function() {
            var a = _gsScope._gsDefine.plugin({
                    propName: "roundProps",
                    version: "1.5",
                    priority: -1,
                    API: 2,
                    init: function(a, b, c) {
                        return this._tween = c, !0
                    }
                }),
                b = function(a) {
                    for (; a;) a.f || a.blob || (a.r = 1), a = a._next
                },
                c = a.prototype;
            c._onInitAllProps = function() {
                for (var a, c, d, e = this._tween, f = e.vars.roundProps.join ? e.vars.roundProps : e.vars.roundProps.split(","), g = f.length, h = {}, i = e._propLookup.roundProps; --g > -1;) h[f[g]] = 1;
                for (g = f.length; --g > -1;)
                    for (a = f[g], c = e._firstPT; c;) d = c._next, c.pg ? c.t._roundProps(h, !0) : c.n === a && (2 === c.f && c.t ? b(c.t._firstPT) : (this._add(c.t, a, c.s, c.c), d && (d._prev = c._prev), c._prev ? c._prev._next = d : e._firstPT === c && (e._firstPT = d), c._next = c._prev = null, e._propLookup[a] = i)), c = d;
                return !1
            }, c._add = function(a, b, c, d) {
                this._addTween(a, b, c, c + d, b, !0), this._overwriteProps.push(b)
            }
        }(),
        function() {
            _gsScope._gsDefine.plugin({
                propName: "attr",
                API: 2,
                version: "0.5.0",
                init: function(a, b, c) {
                    var d;
                    if ("function" != typeof a.setAttribute) return !1;
                    for (d in b) this._addTween(a, "setAttribute", a.getAttribute(d) + "", b[d] + "", d, !1, d), this._overwriteProps.push(d);
                    return !0
                }
            })
        }(), _gsScope._gsDefine.plugin({
        propName: "directionalRotation",
        version: "0.2.1",
        API: 2,
        init: function(a, b, c) {
            "object" != typeof b && (b = {
                rotation: b
            }), this.finals = {};
            var d, e, f, g, h, i, j = b.useRadians === !0 ? 2 * Math.PI : 360,
                k = 1e-6;
            for (d in b) "useRadians" !== d && (i = (b[d] + "").split("_"), e = i[0], f = parseFloat("function" != typeof a[d] ? a[d] : a[d.indexOf("set") || "function" != typeof a["get" + d.substr(3)] ? d : "get" + d.substr(3)]()), g = this.finals[d] = "string" == typeof e && "=" === e.charAt(1) ? f + parseInt(e.charAt(0) + "1", 10) * Number(e.substr(2)) : Number(e) || 0, h = g - f, i.length && (e = i.join("_"), -1 !== e.indexOf("short") && (h %= j, h !== h % (j / 2) && (h = 0 > h ? h + j : h - j)), -1 !== e.indexOf("_cw") && 0 > h ? h = (h + 9999999999 * j) % j - (h / j | 0) * j : -1 !== e.indexOf("ccw") && h > 0 && (h = (h - 9999999999 * j) % j - (h / j | 0) * j)), (h > k || -k > h) && (this._addTween(a, d, f, f + h, d), this._overwriteProps.push(d)));
            return !0
        },
        set: function(a) {
            var b;
            if (1 !== a) this._super.setRatio.call(this, a);
            else
                for (b = this._firstPT; b;) b.f ? b.t[b.p](this.finals[b.p]) : b.t[b.p] = this.finals[b.p], b = b._next
        }
    })._autoCSS = !0, _gsScope._gsDefine("easing.Back", ["easing.Ease"], function(a) {
        var b, c, d, e = _gsScope.GreenSockGlobals || _gsScope,
            f = e.com.greensock,
            g = 2 * Math.PI,
            h = Math.PI / 2,
            i = f._class,
            j = function(b, c) {
                var d = i("easing." + b, function() {}, !0),
                    e = d.prototype = new a;
                return e.constructor = d, e.getRatio = c, d
            },
            k = a.register || function() {},
            l = function(a, b, c, d, e) {
                var f = i("easing." + a, {
                    easeOut: new b,
                    easeIn: new c,
                    easeInOut: new d
                }, !0);
                return k(f, a), f
            },
            m = function(a, b, c) {
                this.t = a, this.v = b, c && (this.next = c, c.prev = this, this.c = c.v - b, this.gap = c.t - a)
            },
            n = function(b, c) {
                var d = i("easing." + b, function(a) {
                        this._p1 = a || 0 === a ? a : 1.70158, this._p2 = 1.525 * this._p1
                    }, !0),
                    e = d.prototype = new a;
                return e.constructor = d, e.getRatio = c, e.config = function(a) {
                    return new d(a)
                }, d
            },
            o = l("Back", n("BackOut", function(a) {
                return (a -= 1) * a * ((this._p1 + 1) * a + this._p1) + 1
            }), n("BackIn", function(a) {
                return a * a * ((this._p1 + 1) * a - this._p1)
            }), n("BackInOut", function(a) {
                return (a *= 2) < 1 ? .5 * a * a * ((this._p2 + 1) * a - this._p2) : .5 * ((a -= 2) * a * ((this._p2 + 1) * a + this._p2) + 2)
            })),
            p = i("easing.SlowMo", function(a, b, c) {
                b = b || 0 === b ? b : .7, null == a ? a = .7 : a > 1 && (a = 1), this._p = 1 !== a ? b : 0, this._p1 = (1 - a) / 2, this._p2 = a, this._p3 = this._p1 + this._p2, this._calcEnd = c === !0
            }, !0),
            q = p.prototype = new a;
        return q.constructor = p, q.getRatio = function(a) {
            var b = a + (.5 - a) * this._p;
            return a < this._p1 ? this._calcEnd ? 1 - (a = 1 - a / this._p1) * a : b - (a = 1 - a / this._p1) * a * a * a * b : a > this._p3 ? this._calcEnd ? 1 - (a = (a - this._p3) / this._p1) * a : b + (a - b) * (a = (a - this._p3) / this._p1) * a * a * a : this._calcEnd ? 1 : b
        }, p.ease = new p(.7, .7), q.config = p.config = function(a, b, c) {
            return new p(a, b, c)
        }, b = i("easing.SteppedEase", function(a) {
            a = a || 1, this._p1 = 1 / a, this._p2 = a + 1
        }, !0), q = b.prototype = new a, q.constructor = b, q.getRatio = function(a) {
            return 0 > a ? a = 0 : a >= 1 && (a = .999999999), (this._p2 * a >> 0) * this._p1
        }, q.config = b.config = function(a) {
            return new b(a)
        }, c = i("easing.RoughEase", function(b) {
            b = b || {};
            for (var c, d, e, f, g, h, i = b.taper || "none", j = [], k = 0, l = 0 | (b.points || 20), n = l, o = b.randomize !== !1, p = b.clamp === !0, q = b.template instanceof a ? b.template : null, r = "number" == typeof b.strength ? .4 * b.strength : .4; --n > -1;) c = o ? Math.random() : 1 / l * n, d = q ? q.getRatio(c) : c, "none" === i ? e = r : "out" === i ? (f = 1 - c, e = f * f * r) : "in" === i ? e = c * c * r : .5 > c ? (f = 2 * c, e = f * f * .5 * r) : (f = 2 * (1 - c), e = f * f * .5 * r), o ? d += Math.random() * e - .5 * e : n % 2 ? d += .5 * e : d -= .5 * e, p && (d > 1 ? d = 1 : 0 > d && (d = 0)), j[k++] = {
                x: c,
                y: d
            };
            for (j.sort(function(a, b) {
                return a.x - b.x
            }), h = new m(1, 1, null), n = l; --n > -1;) g = j[n], h = new m(g.x, g.y, h);
            this._prev = new m(0, 0, 0 !== h.t ? h : h.next)
        }, !0), q = c.prototype = new a, q.constructor = c, q.getRatio = function(a) {
            var b = this._prev;
            if (a > b.t) {
                for (; b.next && a >= b.t;) b = b.next;
                b = b.prev
            } else
                for (; b.prev && a <= b.t;) b = b.prev;
            return this._prev = b, b.v + (a - b.t) / b.gap * b.c
        }, q.config = function(a) {
            return new c(a)
        }, c.ease = new c, l("Bounce", j("BounceOut", function(a) {
            return 1 / 2.75 > a ? 7.5625 * a * a : 2 / 2.75 > a ? 7.5625 * (a -= 1.5 / 2.75) * a + .75 : 2.5 / 2.75 > a ? 7.5625 * (a -= 2.25 / 2.75) * a + .9375 : 7.5625 * (a -= 2.625 / 2.75) * a + .984375
        }), j("BounceIn", function(a) {
            return (a = 1 - a) < 1 / 2.75 ? 1 - 7.5625 * a * a : 2 / 2.75 > a ? 1 - (7.5625 * (a -= 1.5 / 2.75) * a + .75) : 2.5 / 2.75 > a ? 1 - (7.5625 * (a -= 2.25 / 2.75) * a + .9375) : 1 - (7.5625 * (a -= 2.625 / 2.75) * a + .984375)
        }), j("BounceInOut", function(a) {
            var b = .5 > a;
            return a = b ? 1 - 2 * a : 2 * a - 1, a = 1 / 2.75 > a ? 7.5625 * a * a : 2 / 2.75 > a ? 7.5625 * (a -= 1.5 / 2.75) * a + .75 : 2.5 / 2.75 > a ? 7.5625 * (a -= 2.25 / 2.75) * a + .9375 : 7.5625 * (a -= 2.625 / 2.75) * a + .984375, b ? .5 * (1 - a) : .5 * a + .5
        })), l("Circ", j("CircOut", function(a) {
            return Math.sqrt(1 - (a -= 1) * a)
        }), j("CircIn", function(a) {
            return -(Math.sqrt(1 - a * a) - 1)
        }), j("CircInOut", function(a) {
            return (a *= 2) < 1 ? -.5 * (Math.sqrt(1 - a * a) - 1) : .5 * (Math.sqrt(1 - (a -= 2) * a) + 1)
        })), d = function(b, c, d) {
            var e = i("easing." + b, function(a, b) {
                    this._p1 = a >= 1 ? a : 1, this._p2 = (b || d) / (1 > a ? a : 1), this._p3 = this._p2 / g * (Math.asin(1 / this._p1) || 0), this._p2 = g / this._p2
                }, !0),
                f = e.prototype = new a;
            return f.constructor = e, f.getRatio = c, f.config = function(a, b) {
                return new e(a, b)
            }, e
        }, l("Elastic", d("ElasticOut", function(a) {
            return this._p1 * Math.pow(2, -10 * a) * Math.sin((a - this._p3) * this._p2) + 1
        }, .3), d("ElasticIn", function(a) {
            return -(this._p1 * Math.pow(2, 10 * (a -= 1)) * Math.sin((a - this._p3) * this._p2))
        }, .3), d("ElasticInOut", function(a) {
            return (a *= 2) < 1 ? -.5 * (this._p1 * Math.pow(2, 10 * (a -= 1)) * Math.sin((a - this._p3) * this._p2)) : this._p1 * Math.pow(2, -10 * (a -= 1)) * Math.sin((a - this._p3) * this._p2) * .5 + 1
        }, .45)), l("Expo", j("ExpoOut", function(a) {
            return 1 - Math.pow(2, -10 * a)
        }), j("ExpoIn", function(a) {
            return Math.pow(2, 10 * (a - 1)) - .001
        }), j("ExpoInOut", function(a) {
            return (a *= 2) < 1 ? .5 * Math.pow(2, 10 * (a - 1)) : .5 * (2 - Math.pow(2, -10 * (a - 1)))
        })), l("Sine", j("SineOut", function(a) {
            return Math.sin(a * h)
        }), j("SineIn", function(a) {
            return -Math.cos(a * h) + 1
        }), j("SineInOut", function(a) {
            return -.5 * (Math.cos(Math.PI * a) - 1)
        })), i("easing.EaseLookup", {
            find: function(b) {
                return a.map[b]
            }
        }, !0), k(e.SlowMo, "SlowMo", "ease,"), k(c, "RoughEase", "ease,"), k(b, "SteppedEase", "ease,"), o
    }, !0)
}), _gsScope._gsDefine && _gsScope._gsQueue.pop()(),
    function(a, b) {
        "use strict";
        var c = a.GreenSockGlobals = a.GreenSockGlobals || a;
        if (!c.TweenLite) {
            var d, e, f, g, h, i = function(a) {
                    var b, d = a.split("."),
                        e = c;
                    for (b = 0; b < d.length; b++) e[d[b]] = e = e[d[b]] || {};
                    return e
                },
                j = i("com.greensock"),
                k = 1e-10,
                l = function(a) {
                    var b, c = [],
                        d = a.length;
                    for (b = 0; b !== d; c.push(a[b++]));
                    return c
                },
                m = function() {},
                n = function() {
                    var a = Object.prototype.toString,
                        b = a.call([]);
                    return function(c) {
                        return null != c && (c instanceof Array || "object" == typeof c && !!c.push && a.call(c) === b)
                    }
                }(),
                o = {},
                p = function(d, e, f, g) {
                    this.sc = o[d] ? o[d].sc : [], o[d] = this, this.gsClass = null, this.func = f;
                    var h = [];
                    this.check = function(j) {
                        for (var k, l, m, n, q, r = e.length, s = r; --r > -1;)(k = o[e[r]] || new p(e[r], [])).gsClass ? (h[r] = k.gsClass, s--) : j && k.sc.push(this);
                        if (0 === s && f)
                            for (l = ("com.greensock." + d).split("."), m = l.pop(), n = i(l.join("."))[m] = this.gsClass = f.apply(f, h), g && (c[m] = n, q = "undefined" != typeof module && module.exports, !q && "function" == typeof define && define.amd ? define((a.GreenSockAMDPath ? a.GreenSockAMDPath + "/" : "") + d.split(".").pop(), [], function() {
                                return n
                            }) : d === b && q && (module.exports = n)), r = 0; r < this.sc.length; r++) this.sc[r].check()
                    }, this.check(!0)
                },
                q = a._gsDefine = function(a, b, c, d) {
                    return new p(a, b, c, d)
                },
                r = j._class = function(a, b, c) {
                    return b = b || function() {}, q(a, [], function() {
                        return b
                    }, c), b
                };
            q.globals = c;
            var s = [0, 0, 1, 1],
                t = [],
                u = r("easing.Ease", function(a, b, c, d) {
                    this._func = a, this._type = c || 0, this._power = d || 0, this._params = b ? s.concat(b) : s
                }, !0),
                v = u.map = {},
                w = u.register = function(a, b, c, d) {
                    for (var e, f, g, h, i = b.split(","), k = i.length, l = (c || "easeIn,easeOut,easeInOut").split(","); --k > -1;)
                        for (f = i[k], e = d ? r("easing." + f, null, !0) : j.easing[f] || {}, g = l.length; --g > -1;) h = l[g], v[f + "." + h] = v[h + f] = e[h] = a.getRatio ? a : a[h] || new a
                };
            for (f = u.prototype, f._calcEnd = !1, f.getRatio = function(a) {
                if (this._func) return this._params[0] = a, this._func.apply(null, this._params);
                var b = this._type,
                    c = this._power,
                    d = 1 === b ? 1 - a : 2 === b ? a : .5 > a ? 2 * a : 2 * (1 - a);
                return 1 === c ? d *= d : 2 === c ? d *= d * d : 3 === c ? d *= d * d * d : 4 === c && (d *= d * d * d * d), 1 === b ? 1 - d : 2 === b ? d : .5 > a ? d / 2 : 1 - d / 2
            }, d = ["Linear", "Quad", "Cubic", "Quart", "Quint,Strong"], e = d.length; --e > -1;) f = d[e] + ",Power" + e, w(new u(null, null, 1, e), f, "easeOut", !0), w(new u(null, null, 2, e), f, "easeIn" + (0 === e ? ",easeNone" : "")), w(new u(null, null, 3, e), f, "easeInOut");
            v.linear = j.easing.Linear.easeIn, v.swing = j.easing.Quad.easeInOut;
            var x = r("events.EventDispatcher", function(a) {
                this._listeners = {}, this._eventTarget = a || this
            });
            f = x.prototype, f.addEventListener = function(a, b, c, d, e) {
                e = e || 0;
                var f, i, j = this._listeners[a],
                    k = 0;
                for (null == j && (this._listeners[a] = j = []), i = j.length; --i > -1;) f = j[i], f.c === b && f.s === c ? j.splice(i, 1) : 0 === k && f.pr < e && (k = i + 1);
                j.splice(k, 0, {
                    c: b,
                    s: c,
                    up: d,
                    pr: e
                }), this !== g || h || g.wake()
            }, f.removeEventListener = function(a, b) {
                var c, d = this._listeners[a];
                if (d)
                    for (c = d.length; --c > -1;)
                        if (d[c].c === b) return void d.splice(c, 1)
            }, f.dispatchEvent = function(a) {
                var b, c, d, e = this._listeners[a];
                if (e)
                    for (b = e.length, c = this._eventTarget; --b > -1;) d = e[b], d && (d.up ? d.c.call(d.s || c, {
                        type: a,
                        target: c
                    }) : d.c.call(d.s || c))
            };
            var y = a.requestAnimationFrame,
                z = a.cancelAnimationFrame,
                A = Date.now || function() {
                        return (new Date).getTime()
                    },
                B = A();
            for (d = ["ms", "moz", "webkit", "o"], e = d.length; --e > -1 && !y;) y = a[d[e] + "RequestAnimationFrame"], z = a[d[e] + "CancelAnimationFrame"] || a[d[e] + "CancelRequestAnimationFrame"];
            r("Ticker", function(a, b) {
                var c, d, e, f, i, j = this,
                    l = A(),
                    n = b !== !1 && y ? "auto" : !1,
                    o = 500,
                    p = 33,
                    q = "tick",
                    r = function(a) {
                        var b, g, h = A() - B;
                        h > o && (l += h - p), B += h, j.time = (B - l) / 1e3, b = j.time - i, (!c || b > 0 || a === !0) && (j.frame++, i += b + (b >= f ? .004 : f - b), g = !0), a !== !0 && (e = d(r)), g && j.dispatchEvent(q)
                    };
                x.call(j), j.time = j.frame = 0, j.tick = function() {
                    r(!0)
                }, j.lagSmoothing = function(a, b) {
                    o = a || 1 / k, p = Math.min(b, o, 0)
                }, j.sleep = function() {
                    null != e && (n && z ? z(e) : clearTimeout(e), d = m, e = null, j === g && (h = !1))
                }, j.wake = function(a) {
                    null !== e ? j.sleep() : a ? l += -B + (B = A()) : j.frame > 10 && (B = A() - o + 5), d = 0 === c ? m : n && y ? y : function(a) {
                        return setTimeout(a, 1e3 * (i - j.time) + 1 | 0)
                    }, j === g && (h = !0), r(2)
                }, j.fps = function(a) {
                    return arguments.length ? (c = a, f = 1 / (c || 60), i = this.time + f, void j.wake()) : c
                }, j.useRAF = function(a) {
                    return arguments.length ? (j.sleep(), n = a, void j.fps(c)) : n
                }, j.fps(a), setTimeout(function() {
                    "auto" === n && j.frame < 5 && "hidden" !== document.visibilityState && j.useRAF(!1)
                }, 1500)
            }), f = j.Ticker.prototype = new j.events.EventDispatcher, f.constructor = j.Ticker;
            var C = r("core.Animation", function(a, b) {
                if (this.vars = b = b || {}, this._duration = this._totalDuration = a || 0, this._delay = Number(b.delay) || 0, this._timeScale = 1, this._active = b.immediateRender === !0, this.data = b.data, this._reversed = b.reversed === !0, V) {
                    h || g.wake();
                    var c = this.vars.useFrames ? U : V;
                    c.add(this, c._time), this.vars.paused && this.paused(!0)
                }
            });
            g = C.ticker = new j.Ticker, f = C.prototype, f._dirty = f._gc = f._initted = f._paused = !1, f._totalTime = f._time = 0, f._rawPrevTime = -1, f._next = f._last = f._onUpdate = f._timeline = f.timeline = null, f._paused = !1;
            var D = function() {
                h && A() - B > 2e3 && g.wake(), setTimeout(D, 2e3)
            };
            D(), f.play = function(a, b) {
                return null != a && this.seek(a, b), this.reversed(!1).paused(!1)
            }, f.pause = function(a, b) {
                return null != a && this.seek(a, b), this.paused(!0)
            }, f.resume = function(a, b) {
                return null != a && this.seek(a, b), this.paused(!1)
            }, f.seek = function(a, b) {
                return this.totalTime(Number(a), b !== !1)
            }, f.restart = function(a, b) {
                return this.reversed(!1).paused(!1).totalTime(a ? -this._delay : 0, b !== !1, !0)
            }, f.reverse = function(a, b) {
                return null != a && this.seek(a || this.totalDuration(), b), this.reversed(!0).paused(!1)
            }, f.render = function(a, b, c) {}, f.invalidate = function() {
                return this._time = this._totalTime = 0, this._initted = this._gc = !1, this._rawPrevTime = -1, (this._gc || !this.timeline) && this._enabled(!0), this
            }, f.isActive = function() {
                var a, b = this._timeline,
                    c = this._startTime;
                return !b || !this._gc && !this._paused && b.isActive() && (a = b.rawTime()) >= c && a < c + this.totalDuration() / this._timeScale
            }, f._enabled = function(a, b) {
                return h || g.wake(), this._gc = !a, this._active = this.isActive(), b !== !0 && (a && !this.timeline ? this._timeline.add(this, this._startTime - this._delay) : !a && this.timeline && this._timeline._remove(this, !0)), !1
            }, f._kill = function(a, b) {
                return this._enabled(!1, !1)
            }, f.kill = function(a, b) {
                return this._kill(a, b), this
            }, f._uncache = function(a) {
                for (var b = a ? this : this.timeline; b;) b._dirty = !0, b = b.timeline;
                return this
            }, f._swapSelfInParams = function(a) {
                for (var b = a.length, c = a.concat(); --b > -1;) "{self}" === a[b] && (c[b] = this);
                return c
            }, f._callback = function(a) {
                var b = this.vars;
                b[a].apply(b[a + "Scope"] || b.callbackScope || this, b[a + "Params"] || t)
            }, f.eventCallback = function(a, b, c, d) {
                if ("on" === (a || "").substr(0, 2)) {
                    var e = this.vars;
                    if (1 === arguments.length) return e[a];
                    null == b ? delete e[a] : (e[a] = b, e[a + "Params"] = n(c) && -1 !== c.join("").indexOf("{self}") ? this._swapSelfInParams(c) : c, e[a + "Scope"] = d), "onUpdate" === a && (this._onUpdate = b)
                }
                return this
            }, f.delay = function(a) {
                return arguments.length ? (this._timeline.smoothChildTiming && this.startTime(this._startTime + a - this._delay), this._delay = a, this) : this._delay
            }, f.duration = function(a) {
                return arguments.length ? (this._duration = this._totalDuration = a, this._uncache(!0), this._timeline.smoothChildTiming && this._time > 0 && this._time < this._duration && 0 !== a && this.totalTime(this._totalTime * (a / this._duration), !0), this) : (this._dirty = !1, this._duration)
            }, f.totalDuration = function(a) {
                return this._dirty = !1, arguments.length ? this.duration(a) : this._totalDuration
            }, f.time = function(a, b) {
                return arguments.length ? (this._dirty && this.totalDuration(), this.totalTime(a > this._duration ? this._duration : a, b)) : this._time
            }, f.totalTime = function(a, b, c) {
                if (h || g.wake(), !arguments.length) return this._totalTime;
                if (this._timeline) {
                    if (0 > a && !c && (a += this.totalDuration()), this._timeline.smoothChildTiming) {
                        this._dirty && this.totalDuration();
                        var d = this._totalDuration,
                            e = this._timeline;
                        if (a > d && !c && (a = d), this._startTime = (this._paused ? this._pauseTime : e._time) - (this._reversed ? d - a : a) / this._timeScale, e._dirty || this._uncache(!1), e._timeline)
                            for (; e._timeline;) e._timeline._time !== (e._startTime + e._totalTime) / e._timeScale && e.totalTime(e._totalTime, !0), e = e._timeline
                    }
                    this._gc && this._enabled(!0, !1), (this._totalTime !== a || 0 === this._duration) && (I.length && X(), this.render(a, b, !1), I.length && X())
                }
                return this
            }, f.progress = f.totalProgress = function(a, b) {
                var c = this.duration();
                return arguments.length ? this.totalTime(c * a, b) : c ? this._time / c : this.ratio
            }, f.startTime = function(a) {
                return arguments.length ? (a !== this._startTime && (this._startTime = a, this.timeline && this.timeline._sortChildren && this.timeline.add(this, a - this._delay)), this) : this._startTime
            }, f.endTime = function(a) {
                return this._startTime + (0 != a ? this.totalDuration() : this.duration()) / this._timeScale
            }, f.timeScale = function(a) {
                if (!arguments.length) return this._timeScale;
                if (a = a || k, this._timeline && this._timeline.smoothChildTiming) {
                    var b = this._pauseTime,
                        c = b || 0 === b ? b : this._timeline.totalTime();
                    this._startTime = c - (c - this._startTime) * this._timeScale / a
                }
                return this._timeScale = a, this._uncache(!1)
            }, f.reversed = function(a) {
                return arguments.length ? (a != this._reversed && (this._reversed = a, this.totalTime(this._timeline && !this._timeline.smoothChildTiming ? this.totalDuration() - this._totalTime : this._totalTime, !0)), this) : this._reversed
            }, f.paused = function(a) {
                if (!arguments.length) return this._paused;
                var b, c, d = this._timeline;
                return a != this._paused && d && (h || a || g.wake(), b = d.rawTime(), c = b - this._pauseTime, !a && d.smoothChildTiming && (this._startTime += c, this._uncache(!1)), this._pauseTime = a ? b : null, this._paused = a, this._active = this.isActive(), !a && 0 !== c && this._initted && this.duration() && (b = d.smoothChildTiming ? this._totalTime : (b - this._startTime) / this._timeScale, this.render(b, b === this._totalTime, !0))), this._gc && !a && this._enabled(!0, !1), this
            };
            var E = r("core.SimpleTimeline", function(a) {
                C.call(this, 0, a), this.autoRemoveChildren = this.smoothChildTiming = !0
            });
            f = E.prototype = new C, f.constructor = E, f.kill()._gc = !1, f._first = f._last = f._recent = null, f._sortChildren = !1, f.add = f.insert = function(a, b, c, d) {
                var e, f;
                if (a._startTime = Number(b || 0) + a._delay, a._paused && this !== a._timeline && (a._pauseTime = a._startTime + (this.rawTime() - a._startTime) / a._timeScale), a.timeline && a.timeline._remove(a, !0), a.timeline = a._timeline = this, a._gc && a._enabled(!0, !0), e = this._last, this._sortChildren)
                    for (f = a._startTime; e && e._startTime > f;) e = e._prev;
                return e ? (a._next = e._next, e._next = a) : (a._next = this._first, this._first = a), a._next ? a._next._prev = a : this._last = a, a._prev = e, this._recent = a, this._timeline && this._uncache(!0), this
            }, f._remove = function(a, b) {
                return a.timeline === this && (b || a._enabled(!1, !0), a._prev ? a._prev._next = a._next : this._first === a && (this._first = a._next), a._next ? a._next._prev = a._prev : this._last === a && (this._last = a._prev), a._next = a._prev = a.timeline = null, a === this._recent && (this._recent = this._last), this._timeline && this._uncache(!0)), this
            }, f.render = function(a, b, c) {
                var d, e = this._first;
                for (this._totalTime = this._time = this._rawPrevTime = a; e;) d = e._next, (e._active || a >= e._startTime && !e._paused) && (e._reversed ? e.render((e._dirty ? e.totalDuration() : e._totalDuration) - (a - e._startTime) * e._timeScale, b, c) : e.render((a - e._startTime) * e._timeScale, b, c)), e = d
            }, f.rawTime = function() {
                return h || g.wake(), this._totalTime
            };
            var F = r("TweenLite", function(b, c, d) {
                    if (C.call(this, c, d), this.render = F.prototype.render, null == b) throw "Cannot tween a null target.";
                    this.target = b = "string" != typeof b ? b : F.selector(b) || b;
                    var e, f, g, h = b.jquery || b.length && b !== a && b[0] && (b[0] === a || b[0].nodeType && b[0].style && !b.nodeType),
                        i = this.vars.overwrite;
                    if (this._overwrite = i = null == i ? T[F.defaultOverwrite] : "number" == typeof i ? i >> 0 : T[i], (h || b instanceof Array || b.push && n(b)) && "number" != typeof b[0])
                        for (this._targets = g = l(b), this._propLookup = [], this._siblings = [], e = 0; e < g.length; e++) f = g[e], f ? "string" != typeof f ? f.length && f !== a && f[0] && (f[0] === a || f[0].nodeType && f[0].style && !f.nodeType) ? (g.splice(e--, 1), this._targets = g = g.concat(l(f))) : (this._siblings[e] = Y(f, this, !1), 1 === i && this._siblings[e].length > 1 && $(f, this, null, 1, this._siblings[e])) : (f = g[e--] = F.selector(f), "string" == typeof f && g.splice(e + 1, 1)) : g.splice(e--, 1);
                    else this._propLookup = {}, this._siblings = Y(b, this, !1), 1 === i && this._siblings.length > 1 && $(b, this, null, 1, this._siblings);
                    (this.vars.immediateRender || 0 === c && 0 === this._delay && this.vars.immediateRender !== !1) && (this._time = -k, this.render(Math.min(0, -this._delay)))
                }, !0),
                G = function(b) {
                    return b && b.length && b !== a && b[0] && (b[0] === a || b[0].nodeType && b[0].style && !b.nodeType)
                },
                H = function(a, b) {
                    var c, d = {};
                    for (c in a) S[c] || c in b && "transform" !== c && "x" !== c && "y" !== c && "width" !== c && "height" !== c && "className" !== c && "border" !== c || !(!P[c] || P[c] && P[c]._autoCSS) || (d[c] = a[c], delete a[c]);
                    a.css = d
                };
            f = F.prototype = new C, f.constructor = F, f.kill()._gc = !1, f.ratio = 0, f._firstPT = f._targets = f._overwrittenProps = f._startAt = null, f._notifyPluginsOfEnabled = f._lazy = !1, F.version = "1.18.4", F.defaultEase = f._ease = new u(null, null, 1, 1), F.defaultOverwrite = "auto", F.ticker = g, F.autoSleep = 120, F.lagSmoothing = function(a, b) {
                g.lagSmoothing(a, b)
            }, F.selector = a.$ || a.jQuery || function(b) {
                    var c = a.$ || a.jQuery;
                    return c ? (F.selector = c, c(b)) : "undefined" == typeof document ? b : document.querySelectorAll ? document.querySelectorAll(b) : document.getElementById("#" === b.charAt(0) ? b.substr(1) : b)
                };
            var I = [],
                J = {},
                K = /(?:(-|-=|\+=)?\d*\.?\d*(?:e[\-+]?\d+)?)[0-9]/gi,
                L = function(a) {
                    for (var b, c = this._firstPT, d = 1e-6; c;) b = c.blob ? a ? this.join("") : this.start : c.c * a + c.s, c.r ? b = Math.round(b) : d > b && b > -d && (b = 0), c.f ? c.fp ? c.t[c.p](c.fp, b) : c.t[c.p](b) : c.t[c.p] = b, c = c._next
                },
                M = function(a, b, c, d) {
                    var e, f, g, h, i, j, k, l = [a, b],
                        m = 0,
                        n = "",
                        o = 0;
                    for (l.start = a, c && (c(l), a = l[0], b = l[1]), l.length = 0, e = a.match(K) || [], f = b.match(K) || [], d && (d._next = null, d.blob = 1, l._firstPT = d), i = f.length, h = 0; i > h; h++) k = f[h], j = b.substr(m, b.indexOf(k, m) - m), n += j || !h ? j : ",", m += j.length, o ? o = (o + 1) % 5 : "rgba(" === j.substr(-5) && (o = 1), k === e[h] || e.length <= h ? n += k : (n && (l.push(n), n = ""), g = parseFloat(e[h]), l.push(g), l._firstPT = {
                        _next: l._firstPT,
                        t: l,
                        p: l.length - 1,
                        s: g,
                        c: ("=" === k.charAt(1) ? parseInt(k.charAt(0) + "1", 10) * parseFloat(k.substr(2)) : parseFloat(k) - g) || 0,
                        f: 0,
                        r: o && 4 > o
                    }), m += k.length;
                    return n += b.substr(m), n && l.push(n), l.setRatio = L, l
                },
                N = function(a, b, c, d, e, f, g, h) {
                    var i, j, k = "get" === c ? a[b] : c,
                        l = typeof a[b],
                        m = "string" == typeof d && "=" === d.charAt(1),
                        n = {
                            t: a,
                            p: b,
                            s: k,
                            f: "function" === l,
                            pg: 0,
                            n: e || b,
                            r: f,
                            pr: 0,
                            c: m ? parseInt(d.charAt(0) + "1", 10) * parseFloat(d.substr(2)) : parseFloat(d) - k || 0
                        };
                    return "number" !== l && ("function" === l && "get" === c && (j = b.indexOf("set") || "function" != typeof a["get" + b.substr(3)] ? b : "get" + b.substr(3), n.s = k = g ? a[j](g) : a[j]()), "string" == typeof k && (g || isNaN(k)) ? (n.fp = g, i = M(k, d, h || F.defaultStringFilter, n), n = {
                        t: i,
                        p: "setRatio",
                        s: 0,
                        c: 1,
                        f: 2,
                        pg: 0,
                        n: e || b,
                        pr: 0
                    }) : m || (n.s = parseFloat(k), n.c = parseFloat(d) - n.s || 0)), n.c ? ((n._next = this._firstPT) && (n._next._prev = n), this._firstPT = n, n) : void 0
                },
                O = F._internals = {
                    isArray: n,
                    isSelector: G,
                    lazyTweens: I,
                    blobDif: M
                },
                P = F._plugins = {},
                Q = O.tweenLookup = {},
                R = 0,
                S = O.reservedProps = {
                    ease: 1,
                    delay: 1,
                    overwrite: 1,
                    onComplete: 1,
                    onCompleteParams: 1,
                    onCompleteScope: 1,
                    useFrames: 1,
                    runBackwards: 1,
                    startAt: 1,
                    onUpdate: 1,
                    onUpdateParams: 1,
                    onUpdateScope: 1,
                    onStart: 1,
                    onStartParams: 1,
                    onStartScope: 1,
                    onReverseComplete: 1,
                    onReverseCompleteParams: 1,
                    onReverseCompleteScope: 1,
                    onRepeat: 1,
                    onRepeatParams: 1,
                    onRepeatScope: 1,
                    easeParams: 1,
                    yoyo: 1,
                    immediateRender: 1,
                    repeat: 1,
                    repeatDelay: 1,
                    data: 1,
                    paused: 1,
                    reversed: 1,
                    autoCSS: 1,
                    lazy: 1,
                    onOverwrite: 1,
                    callbackScope: 1,
                    stringFilter: 1
                },
                T = {
                    none: 0,
                    all: 1,
                    auto: 2,
                    concurrent: 3,
                    allOnStart: 4,
                    preexisting: 5,
                    "true": 1,
                    "false": 0
                },
                U = C._rootFramesTimeline = new E,
                V = C._rootTimeline = new E,
                W = 30,
                X = O.lazyRender = function() {
                    var a, b = I.length;
                    for (J = {}; --b > -1;) a = I[b], a && a._lazy !== !1 && (a.render(a._lazy[0], a._lazy[1], !0), a._lazy = !1);
                    I.length = 0
                };
            V._startTime = g.time, U._startTime = g.frame, V._active = U._active = !0, setTimeout(X, 1), C._updateRoot = F.render = function() {
                var a, b, c;
                if (I.length && X(), V.render((g.time - V._startTime) * V._timeScale, !1, !1), U.render((g.frame - U._startTime) * U._timeScale, !1, !1), I.length && X(), g.frame >= W) {
                    W = g.frame + (parseInt(F.autoSleep, 10) || 120);
                    for (c in Q) {
                        for (b = Q[c].tweens, a = b.length; --a > -1;) b[a]._gc && b.splice(a, 1);
                        0 === b.length && delete Q[c]
                    }
                    if (c = V._first, (!c || c._paused) && F.autoSleep && !U._first && 1 === g._listeners.tick.length) {
                        for (; c && c._paused;) c = c._next;
                        c || g.sleep()
                    }
                }
            }, g.addEventListener("tick", C._updateRoot);
            var Y = function(a, b, c) {
                    var d, e, f = a._gsTweenID;
                    if (Q[f || (a._gsTweenID = f = "t" + R++)] || (Q[f] = {
                            target: a,
                            tweens: []
                        }), b && (d = Q[f].tweens, d[e = d.length] = b, c))
                        for (; --e > -1;) d[e] === b && d.splice(e, 1);
                    return Q[f].tweens
                },
                Z = function(a, b, c, d) {
                    var e, f, g = a.vars.onOverwrite;
                    return g && (e = g(a, b, c, d)), g = F.onOverwrite, g && (f = g(a, b, c, d)), e !== !1 && f !== !1
                },
                $ = function(a, b, c, d, e) {
                    var f, g, h, i;
                    if (1 === d || d >= 4) {
                        for (i = e.length, f = 0; i > f; f++)
                            if ((h = e[f]) !== b) h._gc || h._kill(null, a, b) && (g = !0);
                            else if (5 === d) break;
                        return g
                    }
                    var j, l = b._startTime + k,
                        m = [],
                        n = 0,
                        o = 0 === b._duration;
                    for (f = e.length; --f > -1;)(h = e[f]) === b || h._gc || h._paused || (h._timeline !== b._timeline ? (j = j || _(b, 0, o), 0 === _(h, j, o) && (m[n++] = h)) : h._startTime <= l && h._startTime + h.totalDuration() / h._timeScale > l && ((o || !h._initted) && l - h._startTime <= 2e-10 || (m[n++] = h)));
                    for (f = n; --f > -1;)
                        if (h = m[f], 2 === d && h._kill(c, a, b) && (g = !0), 2 !== d || !h._firstPT && h._initted) {
                            if (2 !== d && !Z(h, b)) continue;
                            h._enabled(!1, !1) && (g = !0)
                        }
                    return g
                },
                _ = function(a, b, c) {
                    for (var d = a._timeline, e = d._timeScale, f = a._startTime; d._timeline;) {
                        if (f += d._startTime, e *= d._timeScale, d._paused) return -100;
                        d = d._timeline
                    }
                    return f /= e, f > b ? f - b : c && f === b || !a._initted && 2 * k > f - b ? k : (f += a.totalDuration() / a._timeScale / e) > b + k ? 0 : f - b - k
                };
            f._init = function() {
                var a, b, c, d, e, f = this.vars,
                    g = this._overwrittenProps,
                    h = this._duration,
                    i = !!f.immediateRender,
                    j = f.ease;
                if (f.startAt) {
                    this._startAt && (this._startAt.render(-1, !0), this._startAt.kill()), e = {};
                    for (d in f.startAt) e[d] = f.startAt[d];
                    if (e.overwrite = !1, e.immediateRender = !0, e.lazy = i && f.lazy !== !1, e.startAt = e.delay = null, this._startAt = F.to(this.target, 0, e), i)
                        if (this._time > 0) this._startAt = null;
                        else if (0 !== h) return
                } else if (f.runBackwards && 0 !== h)
                    if (this._startAt) this._startAt.render(-1, !0), this._startAt.kill(), this._startAt = null;
                    else {
                        0 !== this._time && (i = !1), c = {};
                        for (d in f) S[d] && "autoCSS" !== d || (c[d] = f[d]);
                        if (c.overwrite = 0, c.data = "isFromStart", c.lazy = i && f.lazy !== !1, c.immediateRender = i, this._startAt = F.to(this.target, 0, c), i) {
                            if (0 === this._time) return
                        } else this._startAt._init(), this._startAt._enabled(!1), this.vars.immediateRender && (this._startAt = null)
                    }
                if (this._ease = j = j ? j instanceof u ? j : "function" == typeof j ? new u(j, f.easeParams) : v[j] || F.defaultEase : F.defaultEase, f.easeParams instanceof Array && j.config && (this._ease = j.config.apply(j, f.easeParams)), this._easeType = this._ease._type, this._easePower = this._ease._power, this._firstPT = null, this._targets)
                    for (a = this._targets.length; --a > -1;) this._initProps(this._targets[a], this._propLookup[a] = {}, this._siblings[a], g ? g[a] : null) && (b = !0);
                else b = this._initProps(this.target, this._propLookup, this._siblings, g);
                if (b && F._onPluginEvent("_onInitAllProps", this), g && (this._firstPT || "function" != typeof this.target && this._enabled(!1, !1)), f.runBackwards)
                    for (c = this._firstPT; c;) c.s += c.c, c.c = -c.c, c = c._next;
                this._onUpdate = f.onUpdate, this._initted = !0
            }, f._initProps = function(b, c, d, e) {
                var f, g, h, i, j, k;
                if (null == b) return !1;
                J[b._gsTweenID] && X(), this.vars.css || b.style && b !== a && b.nodeType && P.css && this.vars.autoCSS !== !1 && H(this.vars, b);
                for (f in this.vars)
                    if (k = this.vars[f], S[f]) k && (k instanceof Array || k.push && n(k)) && -1 !== k.join("").indexOf("{self}") && (this.vars[f] = k = this._swapSelfInParams(k, this));
                    else if (P[f] && (i = new P[f])._onInitTween(b, this.vars[f], this)) {
                        for (this._firstPT = j = {
                            _next: this._firstPT,
                            t: i,
                            p: "setRatio",
                            s: 0,
                            c: 1,
                            f: 1,
                            n: f,
                            pg: 1,
                            pr: i._priority
                        }, g = i._overwriteProps.length; --g > -1;) c[i._overwriteProps[g]] = this._firstPT;
                        (i._priority || i._onInitAllProps) && (h = !0), (i._onDisable || i._onEnable) && (this._notifyPluginsOfEnabled = !0), j._next && (j._next._prev = j)
                    } else c[f] = N.call(this, b, f, "get", k, f, 0, null, this.vars.stringFilter);
                return e && this._kill(e, b) ? this._initProps(b, c, d, e) : this._overwrite > 1 && this._firstPT && d.length > 1 && $(b, this, c, this._overwrite, d) ? (this._kill(c, b), this._initProps(b, c, d, e)) : (this._firstPT && (this.vars.lazy !== !1 && this._duration || this.vars.lazy && !this._duration) && (J[b._gsTweenID] = !0), h)
            }, f.render = function(a, b, c) {
                var d, e, f, g, h = this._time,
                    i = this._duration,
                    j = this._rawPrevTime;
                if (a >= i - 1e-7) this._totalTime = this._time = i, this.ratio = this._ease._calcEnd ? this._ease.getRatio(1) : 1, this._reversed || (d = !0, e = "onComplete", c = c || this._timeline.autoRemoveChildren), 0 === i && (this._initted || !this.vars.lazy || c) && (this._startTime === this._timeline._duration && (a = 0), (0 > j || 0 >= a && a >= -1e-7 || j === k && "isPause" !== this.data) && j !== a && (c = !0, j > k && (e = "onReverseComplete")), this._rawPrevTime = g = !b || a || j === a ? a : k);
                else if (1e-7 > a) this._totalTime = this._time = 0, this.ratio = this._ease._calcEnd ? this._ease.getRatio(0) : 0, (0 !== h || 0 === i && j > 0) && (e = "onReverseComplete", d = this._reversed), 0 > a && (this._active = !1, 0 === i && (this._initted || !this.vars.lazy || c) && (j >= 0 && (j !== k || "isPause" !== this.data) && (c = !0), this._rawPrevTime = g = !b || a || j === a ? a : k)), this._initted || (c = !0);
                else if (this._totalTime = this._time = a, this._easeType) {
                    var l = a / i,
                        m = this._easeType,
                        n = this._easePower;
                    (1 === m || 3 === m && l >= .5) && (l = 1 - l), 3 === m && (l *= 2), 1 === n ? l *= l : 2 === n ? l *= l * l : 3 === n ? l *= l * l * l : 4 === n && (l *= l * l * l * l), 1 === m ? this.ratio = 1 - l : 2 === m ? this.ratio = l : .5 > a / i ? this.ratio = l / 2 : this.ratio = 1 - l / 2
                } else this.ratio = this._ease.getRatio(a / i);
                if (this._time !== h || c) {
                    if (!this._initted) {
                        if (this._init(), !this._initted || this._gc) return;
                        if (!c && this._firstPT && (this.vars.lazy !== !1 && this._duration || this.vars.lazy && !this._duration)) return this._time = this._totalTime = h, this._rawPrevTime = j, I.push(this), void(this._lazy = [a, b]);
                        this._time && !d ? this.ratio = this._ease.getRatio(this._time / i) : d && this._ease._calcEnd && (this.ratio = this._ease.getRatio(0 === this._time ? 0 : 1))
                    }
                    for (this._lazy !== !1 && (this._lazy = !1), this._active || !this._paused && this._time !== h && a >= 0 && (this._active = !0), 0 === h && (this._startAt && (a >= 0 ? this._startAt.render(a, b, c) : e || (e = "_dummyGS")), this.vars.onStart && (0 !== this._time || 0 === i) && (b || this._callback("onStart"))), f = this._firstPT; f;) f.f ? f.t[f.p](f.c * this.ratio + f.s) : f.t[f.p] = f.c * this.ratio + f.s, f = f._next;
                    this._onUpdate && (0 > a && this._startAt && a !== -1e-4 && this._startAt.render(a, b, c), b || (this._time !== h || d || c) && this._callback("onUpdate")), e && (!this._gc || c) && (0 > a && this._startAt && !this._onUpdate && a !== -1e-4 && this._startAt.render(a, b, c), d && (this._timeline.autoRemoveChildren && this._enabled(!1, !1), this._active = !1), !b && this.vars[e] && this._callback(e), 0 === i && this._rawPrevTime === k && g !== k && (this._rawPrevTime = 0))
                }
            }, f._kill = function(a, b, c) {
                if ("all" === a && (a = null), null == a && (null == b || b === this.target)) return this._lazy = !1, this._enabled(!1, !1);
                b = "string" != typeof b ? b || this._targets || this.target : F.selector(b) || b;
                var d, e, f, g, h, i, j, k, l, m = c && this._time && c._startTime === this._startTime && this._timeline === c._timeline;
                if ((n(b) || G(b)) && "number" != typeof b[0])
                    for (d = b.length; --d > -1;) this._kill(a, b[d], c) && (i = !0);
                else {
                    if (this._targets) {
                        for (d = this._targets.length; --d > -1;)
                            if (b === this._targets[d]) {
                                h = this._propLookup[d] || {}, this._overwrittenProps = this._overwrittenProps || [], e = this._overwrittenProps[d] = a ? this._overwrittenProps[d] || {} : "all";
                                break
                            }
                    } else {
                        if (b !== this.target) return !1;
                        h = this._propLookup, e = this._overwrittenProps = a ? this._overwrittenProps || {} : "all"
                    }
                    if (h) {
                        if (j = a || h, k = a !== e && "all" !== e && a !== h && ("object" != typeof a || !a._tempKill), c && (F.onOverwrite || this.vars.onOverwrite)) {
                            for (f in j) h[f] && (l || (l = []), l.push(f));
                            if ((l || !a) && !Z(this, c, b, l)) return !1
                        }
                        for (f in j)(g = h[f]) && (m && (g.f ? g.t[g.p](g.s) : g.t[g.p] = g.s, i = !0), g.pg && g.t._kill(j) && (i = !0), g.pg && 0 !== g.t._overwriteProps.length || (g._prev ? g._prev._next = g._next : g === this._firstPT && (this._firstPT = g._next), g._next && (g._next._prev = g._prev), g._next = g._prev = null), delete h[f]), k && (e[f] = 1);
                        !this._firstPT && this._initted && this._enabled(!1, !1)
                    }
                }
                return i
            }, f.invalidate = function() {
                return this._notifyPluginsOfEnabled && F._onPluginEvent("_onDisable", this), this._firstPT = this._overwrittenProps = this._startAt = this._onUpdate = null, this._notifyPluginsOfEnabled = this._active = this._lazy = !1, this._propLookup = this._targets ? {} : [], C.prototype.invalidate.call(this), this.vars.immediateRender && (this._time = -k, this.render(Math.min(0, -this._delay))), this
            }, f._enabled = function(a, b) {
                if (h || g.wake(), a && this._gc) {
                    var c, d = this._targets;
                    if (d)
                        for (c = d.length; --c > -1;) this._siblings[c] = Y(d[c], this, !0);
                    else this._siblings = Y(this.target, this, !0)
                }
                return C.prototype._enabled.call(this, a, b), this._notifyPluginsOfEnabled && this._firstPT ? F._onPluginEvent(a ? "_onEnable" : "_onDisable", this) : !1
            }, F.to = function(a, b, c) {
                return new F(a, b, c)
            }, F.from = function(a, b, c) {
                return c.runBackwards = !0, c.immediateRender = 0 != c.immediateRender, new F(a, b, c)
            }, F.fromTo = function(a, b, c, d) {
                return d.startAt = c, d.immediateRender = 0 != d.immediateRender && 0 != c.immediateRender, new F(a, b, d)
            }, F.delayedCall = function(a, b, c, d, e) {
                return new F(b, 0, {
                    delay: a,
                    onComplete: b,
                    onCompleteParams: c,
                    callbackScope: d,
                    onReverseComplete: b,
                    onReverseCompleteParams: c,
                    immediateRender: !1,
                    lazy: !1,
                    useFrames: e,
                    overwrite: 0
                })
            }, F.set = function(a, b) {
                return new F(a, 0, b)
            }, F.getTweensOf = function(a, b) {
                if (null == a) return [];
                a = "string" != typeof a ? a : F.selector(a) || a;
                var c, d, e, f;
                if ((n(a) || G(a)) && "number" != typeof a[0]) {
                    for (c = a.length, d = []; --c > -1;) d = d.concat(F.getTweensOf(a[c], b));
                    for (c = d.length; --c > -1;)
                        for (f = d[c], e = c; --e > -1;) f === d[e] && d.splice(c, 1)
                } else
                    for (d = Y(a).concat(), c = d.length; --c > -1;)(d[c]._gc || b && !d[c].isActive()) && d.splice(c, 1);
                return d
            }, F.killTweensOf = F.killDelayedCallsTo = function(a, b, c) {
                "object" == typeof b && (c = b, b = !1);
                for (var d = F.getTweensOf(a, b), e = d.length; --e > -1;) d[e]._kill(c, a)
            };
            var aa = r("plugins.TweenPlugin", function(a, b) {
                this._overwriteProps = (a || "").split(","), this._propName = this._overwriteProps[0], this._priority = b || 0, this._super = aa.prototype
            }, !0);
            if (f = aa.prototype, aa.version = "1.18.0", aa.API = 2, f._firstPT = null, f._addTween = N, f.setRatio = L, f._kill = function(a) {
                    var b, c = this._overwriteProps,
                        d = this._firstPT;
                    if (null != a[this._propName]) this._overwriteProps = [];
                    else
                        for (b = c.length; --b > -1;) null != a[c[b]] && c.splice(b, 1);
                    for (; d;) null != a[d.n] && (d._next && (d._next._prev = d._prev), d._prev ? (d._prev._next = d._next, d._prev = null) : this._firstPT === d && (this._firstPT = d._next)), d = d._next;
                    return !1
                }, f._roundProps = function(a, b) {
                    for (var c = this._firstPT; c;)(a[this._propName] || null != c.n && a[c.n.split(this._propName + "_").join("")]) && (c.r = b), c = c._next
                }, F._onPluginEvent = function(a, b) {
                    var c, d, e, f, g, h = b._firstPT;
                    if ("_onInitAllProps" === a) {
                        for (; h;) {
                            for (g = h._next, d = e; d && d.pr > h.pr;) d = d._next;
                            (h._prev = d ? d._prev : f) ? h._prev._next = h: e = h, (h._next = d) ? d._prev = h : f = h, h = g
                        }
                        h = b._firstPT = e
                    }
                    for (; h;) h.pg && "function" == typeof h.t[a] && h.t[a]() && (c = !0), h = h._next;
                    return c
                }, aa.activate = function(a) {
                    for (var b = a.length; --b > -1;) a[b].API === aa.API && (P[(new a[b])._propName] = a[b]);
                    return !0
                }, q.plugin = function(a) {
                    if (!(a && a.propName && a.init && a.API)) throw "illegal plugin definition.";
                    var b, c = a.propName,
                        d = a.priority || 0,
                        e = a.overwriteProps,
                        f = {
                            init: "_onInitTween",
                            set: "setRatio",
                            kill: "_kill",
                            round: "_roundProps",
                            initAll: "_onInitAllProps"
                        },
                        g = r("plugins." + c.charAt(0).toUpperCase() + c.substr(1) + "Plugin", function() {
                            aa.call(this, c, d), this._overwriteProps = e || []
                        }, a.global === !0),
                        h = g.prototype = new aa(c);
                    h.constructor = g, g.API = a.API;
                    for (b in f) "function" == typeof a[b] && (h[f[b]] = a[b]);
                    return g.version = a.version, aa.activate([g]), g
                }, d = a._gsQueue) {
                for (e = 0; e < d.length; e++) d[e]();
                for (f in o) o[f].func || a.console.log("GSAP encountered missing dependency: com.greensock." + f)
            }
            h = !1
        }
    }("undefined" != typeof module && module.exports && "undefined" != typeof global ? global : this || window, "TweenMax"),
    function(a) {
        return "function" == typeof define && define.amd ? define(["jquery"], function(b) {
            return a(b, window, document)
        }) : "object" == typeof exports ? module.exports = a(require("jquery"), window, document) : a(jQuery, window, document)
    }(function(a, b, c) {
        "use strict";
        var d, e, f, g, h, i, j, k, l, m, n, o, p, q, r, s, t, u, v, w, x, y, z, A, B, C, D, E, F, G, H;
        z = {
            paneClass: "nano-pane",
            sliderClass: "nano-slider",
            contentClass: "nano-content",
            enabledClass: "has-scrollbar",
            flashedClass: "flashed",
            activeClass: "active",
            iOSNativeScrolling: !1,
            preventPageScrolling: !1,
            disableResize: !1,
            alwaysVisible: !1,
            flashDelay: 1500,
            sliderMinHeight: 20,
            sliderMaxHeight: null,
            documentContext: null,
            windowContext: null
        }, u = "scrollbar", t = "scroll", l = "mousedown", m = "mouseenter", n = "mousemove", p = "mousewheel", o = "mouseup", s = "resize", h = "drag", i = "enter", w = "up", r = "panedown", f = "DOMMouseScroll", g = "down", x = "wheel", j = "keydown", k = "keyup", v = "touchmove", d = "Microsoft Internet Explorer" === b.navigator.appName && /msie 7./i.test(b.navigator.appVersion) && b.ActiveXObject, e = null, D = b.requestAnimationFrame, y = b.cancelAnimationFrame, F = c.createElement("div").style, H = function() {
            var a, b, c, d, e, f;
            for (d = ["t", "webkitT", "MozT", "msT", "OT"], a = e = 0, f = d.length; f > e; a = ++e)
                if (c = d[a], b = d[a] + "ransform", b in F) return d[a].substr(0, d[a].length - 1);
            return !1
        }(), G = function(a) {
            return H === !1 ? !1 : "" === H ? a : H + a.charAt(0).toUpperCase() + a.substr(1)
        }, E = G("transform"), B = E !== !1, A = function() {
            var a, b, d;
            return a = c.createElement("div"), b = a.style, b.position = "absolute", b.width = "100px", b.height = "100px", b.overflow = t, b.top = "-9999px", c.body.appendChild(a), d = a.offsetWidth - a.clientWidth, c.body.removeChild(a), d
        }, C = function() {
            var a, c, d;
            return c = b.navigator.userAgent, (a = /(?=.+Mac OS X)(?=.+Firefox)/.test(c)) ? (d = /Firefox\/\d{2}\./.exec(c), d && (d = d[0].replace(/\D+/g, "")), a && +d > 23) : !1
        }, q = function() {
            function j(d, f) {
                this.el = d, this.options = f, e || (e = A()), this.$el = a(this.el), this.doc = a(this.options.documentContext || c), this.win = a(this.options.windowContext || b), this.body = this.doc.find("body"), this.$content = this.$el.children("." + this.options.contentClass), this.$content.attr("tabindex", this.options.tabIndex || 0), this.content = this.$content[0], this.previousPosition = 0, this.options.iOSNativeScrolling && null != this.el.style.WebkitOverflowScrolling ? this.nativeScrolling() : this.generate(), this.createEvents(), this.addEvents(), this.reset()
            }
            return j.prototype.preventScrolling = function(a, b) {
                if (this.isActive)
                    if (a.type === f)(b === g && a.originalEvent.detail > 0 || b === w && a.originalEvent.detail < 0) && a.preventDefault();
                    else if (a.type === p) {
                        if (!a.originalEvent || !a.originalEvent.wheelDelta) return;
                        (b === g && a.originalEvent.wheelDelta < 0 || b === w && a.originalEvent.wheelDelta > 0) && a.preventDefault()
                    }
            }, j.prototype.nativeScrolling = function() {
                this.$content.css({
                    WebkitOverflowScrolling: "touch"
                }), this.iOSNativeScrolling = !0, this.isActive = !0
            }, j.prototype.updateScrollValues = function() {
                var a, b;
                a = this.content, this.maxScrollTop = a.scrollHeight - a.clientHeight, this.prevScrollTop = this.contentScrollTop || 0, this.contentScrollTop = a.scrollTop, b = this.contentScrollTop > this.previousPosition ? "down" : this.contentScrollTop < this.previousPosition ? "up" : "same", this.previousPosition = this.contentScrollTop, "same" !== b && this.$el.trigger("update", {
                    position: this.contentScrollTop,
                    maximum: this.maxScrollTop,
                    direction: b
                }), this.iOSNativeScrolling || (this.maxSliderTop = this.paneHeight - this.sliderHeight, this.sliderTop = 0 === this.maxScrollTop ? 0 : this.contentScrollTop * this.maxSliderTop / this.maxScrollTop)
            }, j.prototype.setOnScrollStyles = function() {
                var a;
                B ? (a = {}, a[E] = "translate(0, " + this.sliderTop + "px)") : a = {
                    top: this.sliderTop
                }, D ? (y && this.scrollRAF && y(this.scrollRAF), this.scrollRAF = D(function(b) {
                    return function() {
                        return b.scrollRAF = null, b.slider.css(a)
                    }
                }(this))) : this.slider.css(a)
            }, j.prototype.createEvents = function() {
                this.events = {
                    down: function(a) {
                        return function(b) {
                            return a.isBeingDragged = !0, a.offsetY = b.pageY - a.slider.offset().top, a.slider.is(b.target) || (a.offsetY = 0), a.pane.addClass(a.options.activeClass), a.doc.bind(n, a.events[h]).bind(o, a.events[w]), a.body.bind(m, a.events[i]), !1
                        }
                    }(this),
                    drag: function(a) {
                        return function(b) {
                            return a.sliderY = b.pageY - a.$el.offset().top - a.paneTop - (a.offsetY || .5 * a.sliderHeight), a.scroll(), a.contentScrollTop >= a.maxScrollTop && a.prevScrollTop !== a.maxScrollTop ? a.$el.trigger("scrollend") : 0 === a.contentScrollTop && 0 !== a.prevScrollTop && a.$el.trigger("scrolltop"), !1
                        }
                    }(this),
                    up: function(a) {
                        return function(b) {
                            return a.isBeingDragged = !1, a.pane.removeClass(a.options.activeClass), a.doc.unbind(n, a.events[h]).unbind(o, a.events[w]), a.body.unbind(m, a.events[i]), !1
                        }
                    }(this),
                    resize: function(a) {
                        return function(b) {
                            a.reset()
                        }
                    }(this),
                    panedown: function(a) {
                        return function(b) {
                            return a.sliderY = (b.offsetY || b.originalEvent.layerY) - .5 * a.sliderHeight, a.scroll(), a.events.down(b), !1
                        }
                    }(this),
                    scroll: function(a) {
                        return function(b) {
                            a.updateScrollValues(), a.isBeingDragged || (a.iOSNativeScrolling || (a.sliderY = a.sliderTop, a.setOnScrollStyles()), null != b && (a.contentScrollTop >= a.maxScrollTop ? (a.options.preventPageScrolling && a.preventScrolling(b, g), a.prevScrollTop !== a.maxScrollTop && a.$el.trigger("scrollend")) : 0 === a.contentScrollTop && (a.options.preventPageScrolling && a.preventScrolling(b, w), 0 !== a.prevScrollTop && a.$el.trigger("scrolltop"))))
                        }
                    }(this),
                    wheel: function(a) {
                        return function(b) {
                            var c;
                            if (null != b) return c = b.delta || b.wheelDelta || b.originalEvent && b.originalEvent.wheelDelta || -b.detail || b.originalEvent && -b.originalEvent.detail, c && (a.sliderY += -c / 3), a.scroll(), !1
                        }
                    }(this),
                    enter: function(a) {
                        return function(b) {
                            var c;
                            if (a.isBeingDragged) return 1 !== (b.buttons || b.which) ? (c = a.events)[w].apply(c, arguments) : void 0
                        }
                    }(this)
                }
            }, j.prototype.addEvents = function() {
                var a;
                this.removeEvents(), a = this.events, this.options.disableResize || this.win.bind(s, a[s]), this.iOSNativeScrolling || (this.slider.bind(l, a[g]), this.pane.bind(l, a[r]).bind("" + p + " " + f, a[x])), this.$content.bind("" + t + " " + p + " " + f + " " + v, a[t])
            }, j.prototype.removeEvents = function() {
                var a;
                a = this.events, this.win.unbind(s, a[s]), this.iOSNativeScrolling || (this.slider.unbind(), this.pane.unbind()), this.$content.unbind("" + t + " " + p + " " + f + " " + v, a[t])
            }, j.prototype.generate = function() {
                var c, d, f, g, h, i, j;
                return g = this.options, i = g.paneClass, j = g.sliderClass, c = g.contentClass, (h = this.$el.children("." + i)).length || h.children("." + j).length || this.$el.append('<div class="' + i + '"><div class="' + j + '" /></div>'), this.pane = this.$el.children("." + i), this.slider = this.pane.find("." + j), 0 === e && C() ? (f = b.getComputedStyle(this.content, null).getPropertyValue("padding-right").replace(/[^0-9.]+/g, ""), d = {
                    right: -14,
                    paddingRight: +f + 14
                }) : e && (d = a("body").hasClass("rtl") ? {
                        left: -e
                    } : {
                        right: -e
                    }), this.$el.addClass(g.enabledClass), null != d && this.$content.css(d), this
            }, j.prototype.restore = function() {
                this.stopped = !1, this.iOSNativeScrolling || this.pane.show(), this.addEvents()
            }, j.prototype.reset = function() {
                var a, b, c, f, g, h, i, j, k, l, m, n;
                if (this.iOSNativeScrolling) return void(this.contentHeight = this.content.scrollHeight);
                if (this.$el.find("." + this.options.paneClass).length || this.generate().stop(), this.stopped && this.restore(), a = this.content, f = a.style, g = f.overflowY, d && this.$content.css({
                        height: this.$content.height()
                    }), b = a.scrollHeight + e, l = parseInt(this.$el.css("max-height"), 10), l > 0 && (this.$el.height(""), this.$el.height(a.scrollHeight > l ? l : a.scrollHeight)), i = this.pane.outerHeight(!1), k = parseInt(this.pane.css("top"), 10), h = parseInt(this.pane.css("bottom"), 10), j = i + k + h, n = Math.round(j / b * i), n < this.options.sliderMinHeight ? n = this.options.sliderMinHeight : null != this.options.sliderMaxHeight && n > this.options.sliderMaxHeight && (n = this.options.sliderMaxHeight), g === t && f.overflowX !== t && (n += e), this.maxSliderTop = j - n, this.contentHeight = b, this.paneHeight = i, this.paneOuterHeight = j, this.sliderHeight = n, this.paneTop = k, this.slider.height(n), this.events.scroll(), this.pane.show(), this.isActive = !0, a.scrollHeight === a.clientHeight || this.pane.outerHeight(!0) >= a.scrollHeight && g !== t ? (this.pane.hide(), this.isActive = !1) : this.el.clientHeight === a.scrollHeight && g === t ? this.slider.hide() : this.slider.show(), this.pane.css({
                        opacity: this.options.alwaysVisible ? 1 : "",
                        visibility: this.options.alwaysVisible ? "visible" : ""
                    }), c = this.$content.css("position"), "static" === c || "relative" === c) {
                    m = parseInt(this.$content.css("right"), 10);
                    var o = parseInt(this.$content.css("left"), 10);
                    m ? this.$content.css({
                        right: "",
                        marginRight: m
                    }) : o && this.$content.css({
                            left: "",
                            marginLeft: o
                        })
                }
                return this
            }, j.prototype.scroll = function() {
                return this.isActive ? (this.sliderY = Math.max(0, this.sliderY), this.sliderY = Math.min(this.maxSliderTop, this.sliderY), this.$content.scrollTop(this.maxScrollTop * this.sliderY / this.maxSliderTop), this.iOSNativeScrolling || (this.updateScrollValues(), this.setOnScrollStyles()), this) : void 0
            }, j.prototype.scrollBottom = function(a) {
                return this.isActive ? (this.$content.scrollTop(this.contentHeight - this.$content.height() - a).trigger(p), this.stop().restore(), this) : void 0
            }, j.prototype.scrollTop = function(a) {
                return this.isActive ? (this.$content.scrollTop(+a).trigger(p), this.stop().restore(), this) : void 0
            }, j.prototype.scrollTo = function(a) {
                return this.isActive ? (this.scrollTop(this.$el.find(a).get(0).offsetTop), this) : void 0
            }, j.prototype.stop = function() {
                return y && this.scrollRAF && (y(this.scrollRAF), this.scrollRAF = null), this.stopped = !0, this.removeEvents(), this.iOSNativeScrolling || this.pane.hide(), this
            }, j.prototype.destroy = function() {
                return this.stopped || this.stop(), !this.iOSNativeScrolling && this.pane.length && this.pane.remove(), d && this.$content.height(""), this.$content.removeAttr("tabindex"), this.$el.hasClass(this.options.enabledClass) && (this.$el.removeClass(this.options.enabledClass), this.$content.css({
                    right: ""
                })), this
            }, j.prototype.flash = function() {
                return !this.iOSNativeScrolling && this.isActive ? (this.reset(), this.pane.addClass(this.options.flashedClass), setTimeout(function(a) {
                    return function() {
                        a.pane.removeClass(a.options.flashedClass)
                    }
                }(this), this.options.flashDelay), this) : void 0
            }, j
        }(), a.fn.nanoScroller = function(b) {
            return this.each(function() {
                var c, d;
                if ((d = this.nanoscroller) || (c = a.extend({}, z, b), this.nanoscroller = d = new q(this, c)), b && "object" == typeof b) {
                    if (a.extend(d.options, b), null != b.scrollBottom) return d.scrollBottom(b.scrollBottom);
                    if (null != b.scrollTop) return d.scrollTop(b.scrollTop);
                    if (b.scrollTo) return d.scrollTo(b.scrollTo);
                    if ("bottom" === b.scroll) return d.scrollBottom(0);
                    if ("top" === b.scroll) return d.scrollTop(0);
                    if (b.scroll && b.scroll instanceof a) return d.scrollTo(b.scroll);
                    if (b.stop) return d.stop();
                    if (b.destroy) return d.destroy();
                    if (b.flash) return d.flash()
                }
                return d.reset()
            })
        }, a.fn.nanoScroller.Constructor = q
    }),
    function(a, b, c, d) {
        function e(b, c) {
            this.element = b, this.settings = a.extend({}, g, c), this._defaults = g, this._name = f, this.init()
        }
        var f = "panr",
            g = {
                sensitivity: 20,
                scale: !1,
                scaleOnHover: !0,
                scaleTo: 1.1,
                scaleDuration: .25,
                panY: !0,
                panX: !0,
                panDuration: 0,
                resetPanOnMouseLeave: !1,
                onEnter: function() {},
                onLeave: function() {}
            };
        e.prototype = {
            init: function() {
                var b, c, d, e, f, g, h = this.settings,
                    i = a(this.element),
                    j = i.width(),
                    k = (i.height(), i.width() - h.sensitivity),
                    l = (j - k) / k;
                (h.scale || !h.scaleOnHover && h.scale) && TweenMax.set(i.find("img"), {
                    scale: h.scaleTo
                }), "string" === jQuery.type(h.moveTarget) && (h.moveTarget = a(this.element).parent(h.moveTarget)), h.moveTarget || (h.moveTarget = a(this.element)), h.moveTarget.on("mousemove", function(g) {
                    b = g.pageX - i.offset().left, c = g.pageY - i.offset().top, h.panX && (e = {
                        x: -l * b
                    }), h.panY && (f = {
                        y: -l * c
                    }), d = a.extend({}, e, f), TweenMax.to(i.find("img"), h.panDuration, d)
                }), h.moveTarget.on("mouseenter", function(a) {
                    h.scaleOnHover && TweenMax.to(i.find("img"), h.scaleDuration, {
                        scale: h.scaleTo
                    }), h.onEnter(i)
                }), h.scale && (h.scaleOnHover || h.scale) ? h.resetPanOnMouseLeave && (g = {
                        x: 0,
                        y: 0
                    }) : g = {
                    scale: 1,
                    x: 0,
                    y: 0
                }, h.moveTarget.on("mouseleave", function(a) {
                    TweenMax.to(i.find("img"), h.scaleDuration, g), h.onLeave(i)
                })
            }
        }, a.fn[f] = function(b) {
            return this.each(function() {
                a.data(this, "plugin_" + f) || a.data(this, "plugin_" + f, new e(this, b))
            })
        }
    }(jQuery, window, document),
    function(a) {
        var b = a(window),
            c = b.height();
        b.resize(function() {
            c = b.height()
        }), a.fn.parallax = function(d, e, f) {
            function g() {
                var f = b.scrollTop();
                j.each(function() {
                    var b = a(this),
                        g = b.offset().top,
                        k = h(b);
                    f > g + k || g > f + c || j.css("backgroundPosition", d + " " + Math.round((i - f) * e) + "px")
                })
            }
            var h, i, j = a(this);
            j.each(function() {
                i = j.offset().top
            }), h = f ? function(a) {
                return a.outerHeight(!0)
            } : function(a) {
                return a.height()
            }, (arguments.length < 1 || null === d) && (d = "50%"), (arguments.length < 2 || null === e) && (e = .1), (arguments.length < 3 || null === f) && (f = !0), b.bind("scroll", g).resize(g), g()
        }
    }(jQuery),
    function(a, b) {
        "use strict";

        function c(c) {
            if ("undefined" == typeof c) throw new Error('Pathformer [constructor]: "element" parameter is required');
            if (c.constructor === String && (c = b.getElementById(c), !c)) throw new Error('Pathformer [constructor]: "element" parameter is not related to an existing ID');
            if (!(c.constructor instanceof a.SVGElement || /^svg$/i.test(c.nodeName))) throw new Error('Pathformer [constructor]: "element" parameter must be a string or a SVGelement');
            this.el = c, this.scan(c)
        }

        function d(a, b, c) {
            this.isReady = !1, this.setElement(a, b), this.setOptions(b), this.setCallback(c), this.isReady && this.init()
        }
        c.prototype.TYPES = ["line", "ellipse", "circle", "polygon", "polyline", "rect"], c.prototype.ATTR_WATCH = ["cx", "cy", "points", "r", "rx", "ry", "x", "x1", "x2", "y", "y1", "y2"], c.prototype.scan = function(a) {
            for (var b, c, d, e, f = a.querySelectorAll(this.TYPES.join(",")), g = 0; g < f.length; g++) c = f[g], b = this[c.tagName.toLowerCase() + "ToPath"], d = b(this.parseAttr(c.attributes)), e = this.pathMaker(c, d), c.parentNode.replaceChild(e, c)
        }, c.prototype.lineToPath = function(a) {
            var b = {},
                c = a.x1 || 0,
                d = a.y1 || 0,
                e = a.x2 || 0,
                f = a.y2 || 0;
            return b.d = "M" + c + "," + d + "L" + e + "," + f, b
        }, c.prototype.rectToPath = function(a) {
            var b = {},
                c = parseFloat(a.x) || 0,
                d = parseFloat(a.y) || 0,
                e = parseFloat(a.width) || 0,
                f = parseFloat(a.height) || 0;
            return b.d = "M" + c + " " + d + " ", b.d += "L" + (c + e) + " " + d + " ", b.d += "L" + (c + e) + " " + (d + f) + " ", b.d += "L" + c + " " + (d + f) + " Z", b
        }, c.prototype.polylineToPath = function(a) {
            var b, c, d = {},
                e = a.points.trim().split(" ");
            if (-1 === a.points.indexOf(",")) {
                var f = [];
                for (b = 0; b < e.length; b += 2) f.push(e[b] + "," + e[b + 1]);
                e = f
            }
            for (c = "M" + e[0], b = 1; b < e.length; b++) - 1 !== e[b].indexOf(",") && (c += "L" + e[b]);
            return d.d = c, d
        }, c.prototype.polygonToPath = function(a) {
            var b = c.prototype.polylineToPath(a);
            return b.d += "Z", b
        }, c.prototype.ellipseToPath = function(a) {
            var b = {},
                c = parseFloat(a.rx) || 0,
                d = parseFloat(a.ry) || 0,
                e = parseFloat(a.cx) || 0,
                f = parseFloat(a.cy) || 0,
                g = e - c,
                h = f,
                i = parseFloat(e) + parseFloat(c),
                j = f;
            return b.d = "M" + g + "," + h + "A" + c + "," + d + " 0,1,1 " + i + "," + j + "A" + c + "," + d + " 0,1,1 " + g + "," + j, b
        }, c.prototype.circleToPath = function(a) {
            var b = {},
                c = parseFloat(a.r) || 0,
                d = parseFloat(a.cx) || 0,
                e = parseFloat(a.cy) || 0,
                f = d - c,
                g = e,
                h = parseFloat(d) + parseFloat(c),
                i = e;
            return b.d = "M" + f + "," + g + "A" + c + "," + c + " 0,1,1 " + h + "," + i + "A" + c + "," + c + " 0,1,1 " + f + "," + i, b
        }, c.prototype.pathMaker = function(a, c) {
            var d, e, f = b.createElementNS("http://www.w3.org/2000/svg", "path");
            for (d = 0; d < a.attributes.length; d++) e = a.attributes[d], -1 === this.ATTR_WATCH.indexOf(e.name) && f.setAttribute(e.name, e.value);
            for (d in c) f.setAttribute(d, c[d]);
            return f
        }, c.prototype.parseAttr = function(a) {
            for (var b, c = {}, d = 0; d < a.length; d++) {
                if (b = a[d], -1 !== this.ATTR_WATCH.indexOf(b.name) && -1 !== b.value.indexOf("%")) throw new Error("Pathformer [parseAttr]: a SVG shape got values in percentage. This cannot be transformed into 'path' tags. Please use 'viewBox'.");
                c[b.name] = b.value
            }
            return c
        };
        var e, f, g;
        d.LINEAR = function(a) {
            return a
        }, d.EASE = function(a) {
            return -Math.cos(a * Math.PI) / 2 + .5
        }, d.EASE_OUT = function(a) {
            return 1 - Math.pow(1 - a, 3)
        }, d.EASE_IN = function(a) {
            return Math.pow(a, 3)
        }, d.EASE_OUT_BOUNCE = function(a) {
            var b = -Math.cos(a * (.5 * Math.PI)) + 1,
                c = Math.pow(b, 1.5),
                d = Math.pow(1 - a, 2),
                e = -Math.abs(Math.cos(c * (2.5 * Math.PI))) + 1;
            return 1 - d + e * d
        }, d.prototype.setElement = function(c, d) {
            if ("undefined" == typeof c) throw new Error('Vivus [constructor]: "element" parameter is required');
            if (c.constructor === String && (c = b.getElementById(c), !c)) throw new Error('Vivus [constructor]: "element" parameter is not related to an existing ID');
            if (this.parentEl = c, d && d.file) {
                var e = b.createElement("object");
                e.setAttribute("type", "image/svg+xml"), e.setAttribute("data", d.file), e.setAttribute("built-by-vivus", "true"), c.appendChild(e), c = e
            }
            switch (c.constructor) {
                case a.SVGSVGElement:
                case a.SVGElement:
                    this.el = c, this.isReady = !0;
                    break;
                case a.HTMLObjectElement:
                    var f, g;
                    g = this, f = function(a) {
                        if (!g.isReady) {
                            if (g.el = c.contentDocument && c.contentDocument.querySelector("svg"), !g.el && a) throw new Error("Vivus [constructor]: object loaded does not contain any SVG");
                            return g.el ? (c.getAttribute("built-by-vivus") && (g.parentEl.insertBefore(g.el, c), g.parentEl.removeChild(c), g.el.setAttribute("width", "100%"), g.el.setAttribute("height", "100%")), g.isReady = !0, g.init(), !0) : void 0
                        }
                    }, f() || c.addEventListener("load", f);
                    break;
                default:
                    throw new Error('Vivus [constructor]: "element" parameter is not valid (or miss the "file" attribute)')
            }
        }, d.prototype.setOptions = function(b) {
            var c = ["delayed", "sync", "async", "nsync", "oneByOne", "scenario", "scenario-sync"],
                e = ["inViewport", "manual", "autostart"];
            if (void 0 !== b && b.constructor !== Object) throw new Error('Vivus [constructor]: "options" parameter must be an object');
            if (b = b || {}, b.type && -1 === c.indexOf(b.type)) throw new Error("Vivus [constructor]: " + b.type + " is not an existing animation `type`");
            if (this.type = b.type || c[0], b.start && -1 === e.indexOf(b.start)) throw new Error("Vivus [constructor]: " + b.start + " is not an existing `start` option");
            if (this.start = b.start || e[0], this.isIE = -1 !== a.navigator.userAgent.indexOf("MSIE") || -1 !== a.navigator.userAgent.indexOf("Trident/") || -1 !== a.navigator.userAgent.indexOf("Edge/"), this.duration = g(b.duration, 120), this.delay = g(b.delay, null), this.dashGap = g(b.dashGap, 1), this.forceRender = b.hasOwnProperty("forceRender") ? !!b.forceRender : this.isIE, this.reverseStack = !!b.reverseStack, this.selfDestroy = !!b.selfDestroy, this.onReady = b.onReady, this.map = [], this.frameLength = this.currentFrame = this.delayUnit = this.speed = this.handle = null, this.ignoreInvisible = b.hasOwnProperty("ignoreInvisible") ? !!b.ignoreInvisible : !1, this.animTimingFunction = b.animTimingFunction || d.LINEAR, this.pathTimingFunction = b.pathTimingFunction || d.LINEAR, this.delay >= this.duration) throw new Error("Vivus [constructor]: delay must be shorter than duration")
        }, d.prototype.setCallback = function(a) {
            if (a && a.constructor !== Function) throw new Error('Vivus [constructor]: "callback" parameter must be a function');
            this.callback = a || function() {}
        }, d.prototype.mapping = function() {
            var b, c, d, e, f, h, i, j;
            for (j = h = i = 0, c = this.el.querySelectorAll("path"), b = 0; b < c.length; b++) d = c[b], this.isInvisible(d) || (f = {
                el: d,
                length: Math.ceil(d.getTotalLength())
            }, isNaN(f.length) ? a.console && console.warn && console.warn("Vivus [mapping]: cannot retrieve a path element length", d) : (this.map.push(f), d.style.strokeDasharray = f.length + " " + (f.length + 2 * this.dashGap), d.style.strokeDashoffset = f.length + this.dashGap, f.length += this.dashGap, h += f.length, this.renderPath(b)));
            for (h = 0 === h ? 1 : h, this.delay = null === this.delay ? this.duration / 3 : this.delay, this.delayUnit = this.delay / (c.length > 1 ? c.length - 1 : 1), this.reverseStack && this.map.reverse(), b = 0; b < this.map.length; b++) {
                switch (f = this.map[b], this.type) {
                    case "delayed":
                        f.startAt = this.delayUnit * b, f.duration = this.duration - this.delay;
                        break;
                    case "oneByOne":
                        f.startAt = i / h * this.duration, f.duration = f.length / h * this.duration;
                        break;
                    case "sync":
                    case "async":
                    case "nsync":
                        f.startAt = 0, f.duration = this.duration;
                        break;
                    case "scenario-sync":
                        d = f.el, e = this.parseAttr(d), f.startAt = j + (g(e["data-delay"], this.delayUnit) || 0), f.duration = g(e["data-duration"], this.duration), j = void 0 !== e["data-async"] ? f.startAt : f.startAt + f.duration, this.frameLength = Math.max(this.frameLength, f.startAt + f.duration);
                        break;
                    case "scenario":
                        d = f.el, e = this.parseAttr(d), f.startAt = g(e["data-start"], this.delayUnit) || 0, f.duration = g(e["data-duration"], this.duration), this.frameLength = Math.max(this.frameLength, f.startAt + f.duration)
                }
                i += f.length, this.frameLength = this.frameLength || this.duration
            }
        }, d.prototype.drawer = function() {
            var a = this;
            if (this.currentFrame += this.speed, this.currentFrame <= 0) this.stop(), this.reset();
            else {
                if (!(this.currentFrame >= this.frameLength)) return this.trace(), void(this.handle = e(function() {
                    a.drawer()
                }));
                this.stop(), this.currentFrame = this.frameLength, this.trace(), this.selfDestroy && this.destroy()
            }
            this.callback(this), this.instanceCallback && (this.instanceCallback(this), this.instanceCallback = null)
        }, d.prototype.trace = function() {
            var a, b, c, d;
            for (d = this.animTimingFunction(this.currentFrame / this.frameLength) * this.frameLength, a = 0; a < this.map.length; a++) c = this.map[a], b = (d - c.startAt) / c.duration, b = this.pathTimingFunction(Math.max(0, Math.min(1, b))), c.progress !== b && (c.progress = b, c.el.style.strokeDashoffset = Math.floor(c.length * (1 - b)), this.renderPath(a))
        }, d.prototype.renderPath = function(a) {
            if (this.forceRender && this.map && this.map[a]) {
                var b = this.map[a],
                    c = b.el.cloneNode(!0);
                b.el.parentNode.replaceChild(c, b.el), b.el = c
            }
        }, d.prototype.init = function() {
            this.frameLength = 0, this.currentFrame = 0, this.map = [], new c(this.el), this.mapping(), this.starter(), this.onReady && this.onReady(this)
        }, d.prototype.starter = function() {
            switch (this.start) {
                case "manual":
                    return;
                case "autostart":
                    this.play();
                    break;
                case "inViewport":
                    var b = this,
                        c = function() {
                            b.isInViewport(b.parentEl, 1) && (b.play(), a.removeEventListener("scroll", c))
                        };
                    a.addEventListener("scroll", c), c()
            }
        }, d.prototype.getStatus = function() {
            return 0 === this.currentFrame ? "start" : this.currentFrame === this.frameLength ? "end" : "progress"
        }, d.prototype.reset = function() {
            return this.setFrameProgress(0)
        }, d.prototype.finish = function() {
            return this.setFrameProgress(1)
        }, d.prototype.setFrameProgress = function(a) {
            return a = Math.min(1, Math.max(0, a)), this.currentFrame = Math.round(this.frameLength * a), this.trace(), this
        }, d.prototype.play = function(a, b) {
            if (this.instanceCallback = null, a && "function" == typeof a) this.instanceCallback = a, a = null;
            else if (a && "number" != typeof a) throw new Error("Vivus [play]: invalid speed");
            return b && "function" == typeof b && !this.instanceCallback && (this.instanceCallback = b), this.speed = a || 1, this.handle || this.drawer(), this
        }, d.prototype.stop = function() {
            return this.handle && (f(this.handle), this.handle = null), this
        }, d.prototype.destroy = function() {
            this.stop();
            var a, b;
            for (a = 0; a < this.map.length; a++) b = this.map[a], b.el.style.strokeDashoffset = null, b.el.style.strokeDasharray = null, this.renderPath(a)
        }, d.prototype.isInvisible = function(a) {
            var b, c = a.getAttribute("data-ignore");
            return null !== c ? "false" !== c : this.ignoreInvisible ? (b = a.getBoundingClientRect(), !b.width && !b.height) : !1
        }, d.prototype.parseAttr = function(a) {
            var b, c = {};
            if (a && a.attributes)
                for (var d = 0; d < a.attributes.length; d++) b = a.attributes[d],
                    c[b.name] = b.value;
            return c
        }, d.prototype.isInViewport = function(a, b) {
            var c = this.scrollY(),
                d = c + this.getViewportH(),
                e = a.getBoundingClientRect(),
                f = e.height,
                g = c + e.top,
                h = g + f;
            return b = b || 0, d >= g + f * b && h >= c
        }, d.prototype.docElem = a.document.documentElement, d.prototype.getViewportH = function() {
            var b = this.docElem.clientHeight,
                c = a.innerHeight;
            return c > b ? c : b
        }, d.prototype.scrollY = function() {
            return a.pageYOffset || this.docElem.scrollTop
        }, e = function() {
            return a.requestAnimationFrame || a.webkitRequestAnimationFrame || a.mozRequestAnimationFrame || a.oRequestAnimationFrame || a.msRequestAnimationFrame || function(b) {
                    return a.setTimeout(b, 1e3 / 60)
                }
        }(), f = function() {
            return a.cancelAnimationFrame || a.webkitCancelAnimationFrame || a.mozCancelAnimationFrame || a.oCancelAnimationFrame || a.msCancelAnimationFrame || function(b) {
                    return a.clearTimeout(b)
                }
        }(), g = function(a, b) {
            var c = parseInt(a, 10);
            return c >= 0 ? c : b
        }, "function" == typeof define && define.amd ? define([], function() {
            return d
        }) : "object" == typeof exports ? module.exports = d : a.Vivus = d
    }(window, document), ! function(a, b) {
    "object" == typeof exports && "undefined" != typeof module ? module.exports = b() : "function" == typeof define && define.amd ? define(b) : a.moment = b()
}(this, function() {
    "use strict";

    function a() {
        return sd.apply(null, arguments)
    }

    function b(a) {
        sd = a
    }

    function c(a) {
        return a instanceof Array || "[object Array]" === Object.prototype.toString.call(a)
    }

    function d(a) {
        return null != a && "[object Object]" === Object.prototype.toString.call(a)
    }

    function e(a) {
        var b;
        for (b in a) return !1;
        return !0
    }

    function f(a) {
        return void 0 === a
    }

    function g(a) {
        return "number" == typeof a || "[object Number]" === Object.prototype.toString.call(a)
    }

    function h(a) {
        return a instanceof Date || "[object Date]" === Object.prototype.toString.call(a)
    }

    function i(a, b) {
        var c, d = [];
        for (c = 0; c < a.length; ++c) d.push(b(a[c], c));
        return d
    }

    function j(a, b) {
        return Object.prototype.hasOwnProperty.call(a, b)
    }

    function k(a, b) {
        for (var c in b) j(b, c) && (a[c] = b[c]);
        return j(b, "toString") && (a.toString = b.toString), j(b, "valueOf") && (a.valueOf = b.valueOf), a
    }

    function l(a, b, c, d) {
        return sb(a, b, c, d, !0).utc()
    }

    function m() {
        return {
            empty: !1,
            unusedTokens: [],
            unusedInput: [],
            overflow: -2,
            charsLeftOver: 0,
            nullInput: !1,
            invalidMonth: null,
            invalidFormat: !1,
            userInvalidated: !1,
            iso: !1,
            parsedDateParts: [],
            meridiem: null,
            rfc2822: !1,
            weekdayMismatch: !1
        }
    }

    function n(a) {
        return null == a._pf && (a._pf = m()), a._pf
    }

    function o(a) {
        if (null == a._isValid) {
            var b = n(a),
                c = ud.call(b.parsedDateParts, function(a) {
                    return null != a
                }),
                d = !isNaN(a._d.getTime()) && b.overflow < 0 && !b.empty && !b.invalidMonth && !b.invalidWeekday && !b.nullInput && !b.invalidFormat && !b.userInvalidated && (!b.meridiem || b.meridiem && c);
            if (a._strict && (d = d && 0 === b.charsLeftOver && 0 === b.unusedTokens.length && void 0 === b.bigHour), null != Object.isFrozen && Object.isFrozen(a)) return d;
            a._isValid = d
        }
        return a._isValid
    }

    function p(a) {
        var b = l(NaN);
        return null != a ? k(n(b), a) : n(b).userInvalidated = !0, b
    }

    function q(a, b) {
        var c, d, e;
        if (f(b._isAMomentObject) || (a._isAMomentObject = b._isAMomentObject), f(b._i) || (a._i = b._i), f(b._f) || (a._f = b._f), f(b._l) || (a._l = b._l), f(b._strict) || (a._strict = b._strict), f(b._tzm) || (a._tzm = b._tzm), f(b._isUTC) || (a._isUTC = b._isUTC), f(b._offset) || (a._offset = b._offset), f(b._pf) || (a._pf = n(b)), f(b._locale) || (a._locale = b._locale), vd.length > 0)
            for (c = 0; c < vd.length; c++) d = vd[c], e = b[d], f(e) || (a[d] = e);
        return a
    }

    function r(b) {
        q(this, b), this._d = new Date(null != b._d ? b._d.getTime() : NaN), this.isValid() || (this._d = new Date(NaN)), wd === !1 && (wd = !0, a.updateOffset(this), wd = !1)
    }

    function s(a) {
        return a instanceof r || null != a && null != a._isAMomentObject
    }

    function t(a) {
        return 0 > a ? Math.ceil(a) || 0 : Math.floor(a)
    }

    function u(a) {
        var b = +a,
            c = 0;
        return 0 !== b && isFinite(b) && (c = t(b)), c
    }

    function v(a, b, c) {
        var d, e = Math.min(a.length, b.length),
            f = Math.abs(a.length - b.length),
            g = 0;
        for (d = 0; e > d; d++)(c && a[d] !== b[d] || !c && u(a[d]) !== u(b[d])) && g++;
        return g + f
    }

    function w(b) {
        a.suppressDeprecationWarnings === !1 && "undefined" != typeof console && console.warn && console.warn("Deprecation warning: " + b)
    }

    function x(b, c) {
        var d = !0;
        return k(function() {
            if (null != a.deprecationHandler && a.deprecationHandler(null, b), d) {
                for (var e, f = [], g = 0; g < arguments.length; g++) {
                    if (e = "", "object" == typeof arguments[g]) {
                        e += "\n[" + g + "] ";
                        for (var h in arguments[0]) e += h + ": " + arguments[0][h] + ", ";
                        e = e.slice(0, -2)
                    } else e = arguments[g];
                    f.push(e)
                }
                w(b + "\nArguments: " + Array.prototype.slice.call(f).join("") + "\n" + (new Error).stack), d = !1
            }
            return c.apply(this, arguments)
        }, c)
    }

    function y(b, c) {
        null != a.deprecationHandler && a.deprecationHandler(b, c), xd[b] || (w(c), xd[b] = !0)
    }

    function z(a) {
        return a instanceof Function || "[object Function]" === Object.prototype.toString.call(a)
    }

    function A(a) {
        var b, c;
        for (c in a) b = a[c], z(b) ? this[c] = b : this["_" + c] = b;
        this._config = a, this._dayOfMonthOrdinalParseLenient = new RegExp((this._dayOfMonthOrdinalParse.source || this._ordinalParse.source) + "|" + /\d{1,2}/.source)
    }

    function B(a, b) {
        var c, e = k({}, a);
        for (c in b) j(b, c) && (d(a[c]) && d(b[c]) ? (e[c] = {}, k(e[c], a[c]), k(e[c], b[c])) : null != b[c] ? e[c] = b[c] : delete e[c]);
        for (c in a) j(a, c) && !j(b, c) && d(a[c]) && (e[c] = k({}, e[c]));
        return e
    }

    function C(a) {
        null != a && this.set(a)
    }

    function D(a, b, c) {
        var d = this._calendar[a] || this._calendar.sameElse;
        return z(d) ? d.call(b, c) : d
    }

    function E(a) {
        var b = this._longDateFormat[a],
            c = this._longDateFormat[a.toUpperCase()];
        return b || !c ? b : (this._longDateFormat[a] = c.replace(/MMMM|MM|DD|dddd/g, function(a) {
            return a.slice(1)
        }), this._longDateFormat[a])
    }

    function F() {
        return this._invalidDate
    }

    function G(a) {
        return this._ordinal.replace("%d", a)
    }

    function H(a, b, c, d) {
        var e = this._relativeTime[c];
        return z(e) ? e(a, b, c, d) : e.replace(/%d/i, a)
    }

    function I(a, b) {
        var c = this._relativeTime[a > 0 ? "future" : "past"];
        return z(c) ? c(b) : c.replace(/%s/i, b)
    }

    function J(a, b) {
        var c = a.toLowerCase();
        Hd[c] = Hd[c + "s"] = Hd[b] = a
    }

    function K(a) {
        return "string" == typeof a ? Hd[a] || Hd[a.toLowerCase()] : void 0
    }

    function L(a) {
        var b, c, d = {};
        for (c in a) j(a, c) && (b = K(c), b && (d[b] = a[c]));
        return d
    }

    function M(a, b) {
        Id[a] = b
    }

    function N(a) {
        var b = [];
        for (var c in a) b.push({
            unit: c,
            priority: Id[c]
        });
        return b.sort(function(a, b) {
            return a.priority - b.priority
        }), b
    }

    function O(b, c) {
        return function(d) {
            return null != d ? (Q(this, b, d), a.updateOffset(this, c), this) : P(this, b)
        }
    }

    function P(a, b) {
        return a.isValid() ? a._d["get" + (a._isUTC ? "UTC" : "") + b]() : NaN
    }

    function Q(a, b, c) {
        a.isValid() && a._d["set" + (a._isUTC ? "UTC" : "") + b](c)
    }

    function R(a) {
        return a = K(a), z(this[a]) ? this[a]() : this
    }

    function S(a, b) {
        if ("object" == typeof a) {
            a = L(a);
            for (var c = N(a), d = 0; d < c.length; d++) this[c[d].unit](a[c[d].unit])
        } else if (a = K(a), z(this[a])) return this[a](b);
        return this
    }

    function T(a, b, c) {
        var d = "" + Math.abs(a),
            e = b - d.length,
            f = a >= 0;
        return (f ? c ? "+" : "" : "-") + Math.pow(10, Math.max(0, e)).toString().substr(1) + d
    }

    function U(a, b, c, d) {
        var e = d;
        "string" == typeof d && (e = function() {
            return this[d]()
        }), a && (Md[a] = e), b && (Md[b[0]] = function() {
            return T(e.apply(this, arguments), b[1], b[2])
        }), c && (Md[c] = function() {
            return this.localeData().ordinal(e.apply(this, arguments), a)
        })
    }

    function V(a) {
        return a.match(/\[[\s\S]/) ? a.replace(/^\[|\]$/g, "") : a.replace(/\\/g, "")
    }

    function W(a) {
        var b, c, d = a.match(Jd);
        for (b = 0, c = d.length; c > b; b++) Md[d[b]] ? d[b] = Md[d[b]] : d[b] = V(d[b]);
        return function(b) {
            var e, f = "";
            for (e = 0; c > e; e++) f += z(d[e]) ? d[e].call(b, a) : d[e];
            return f
        }
    }

    function X(a, b) {
        return a.isValid() ? (b = Y(b, a.localeData()), Ld[b] = Ld[b] || W(b), Ld[b](a)) : a.localeData().invalidDate()
    }

    function Y(a, b) {
        function c(a) {
            return b.longDateFormat(a) || a
        }
        var d = 5;
        for (Kd.lastIndex = 0; d >= 0 && Kd.test(a);) a = a.replace(Kd, c), Kd.lastIndex = 0, d -= 1;
        return a
    }

    function Z(a, b, c) {
        ce[a] = z(b) ? b : function(a, d) {
            return a && c ? c : b
        }
    }

    function $(a, b) {
        return j(ce, a) ? ce[a](b._strict, b._locale) : new RegExp(_(a))
    }

    function _(a) {
        return aa(a.replace("\\", "").replace(/\\(\[)|\\(\])|\[([^\]\[]*)\]|\\(.)/g, function(a, b, c, d, e) {
            return b || c || d || e
        }))
    }

    function aa(a) {
        return a.replace(/[-\/\\^$*+?.()|[\]{}]/g, "\\$&")
    }

    function ba(a, b) {
        var c, d = b;
        for ("string" == typeof a && (a = [a]), g(b) && (d = function(a, c) {
            c[b] = u(a)
        }), c = 0; c < a.length; c++) de[a[c]] = d
    }

    function ca(a, b) {
        ba(a, function(a, c, d, e) {
            d._w = d._w || {}, b(a, d._w, d, e)
        })
    }

    function da(a, b, c) {
        null != b && j(de, a) && de[a](b, c._a, c, a)
    }

    function ea(a, b) {
        return new Date(Date.UTC(a, b + 1, 0)).getUTCDate()
    }

    function fa(a, b) {
        return a ? c(this._months) ? this._months[a.month()] : this._months[(this._months.isFormat || oe).test(b) ? "format" : "standalone"][a.month()] : c(this._months) ? this._months : this._months.standalone
    }

    function ga(a, b) {
        return a ? c(this._monthsShort) ? this._monthsShort[a.month()] : this._monthsShort[oe.test(b) ? "format" : "standalone"][a.month()] : c(this._monthsShort) ? this._monthsShort : this._monthsShort.standalone
    }

    function ha(a, b, c) {
        var d, e, f, g = a.toLocaleLowerCase();
        if (!this._monthsParse)
            for (this._monthsParse = [], this._longMonthsParse = [], this._shortMonthsParse = [], d = 0; 12 > d; ++d) f = l([2e3, d]), this._shortMonthsParse[d] = this.monthsShort(f, "").toLocaleLowerCase(), this._longMonthsParse[d] = this.months(f, "").toLocaleLowerCase();
        return c ? "MMM" === b ? (e = ne.call(this._shortMonthsParse, g), -1 !== e ? e : null) : (e = ne.call(this._longMonthsParse, g), -1 !== e ? e : null) : "MMM" === b ? (e = ne.call(this._shortMonthsParse, g), -1 !== e ? e : (e = ne.call(this._longMonthsParse, g), -1 !== e ? e : null)) : (e = ne.call(this._longMonthsParse, g), -1 !== e ? e : (e = ne.call(this._shortMonthsParse, g), -1 !== e ? e : null))
    }

    function ia(a, b, c) {
        var d, e, f;
        if (this._monthsParseExact) return ha.call(this, a, b, c);
        for (this._monthsParse || (this._monthsParse = [], this._longMonthsParse = [], this._shortMonthsParse = []), d = 0; 12 > d; d++) {
            if (e = l([2e3, d]), c && !this._longMonthsParse[d] && (this._longMonthsParse[d] = new RegExp("^" + this.months(e, "").replace(".", "") + "$", "i"), this._shortMonthsParse[d] = new RegExp("^" + this.monthsShort(e, "").replace(".", "") + "$", "i")), c || this._monthsParse[d] || (f = "^" + this.months(e, "") + "|^" + this.monthsShort(e, ""), this._monthsParse[d] = new RegExp(f.replace(".", ""), "i")), c && "MMMM" === b && this._longMonthsParse[d].test(a)) return d;
            if (c && "MMM" === b && this._shortMonthsParse[d].test(a)) return d;
            if (!c && this._monthsParse[d].test(a)) return d
        }
    }

    function ja(a, b) {
        var c;
        if (!a.isValid()) return a;
        if ("string" == typeof b)
            if (/^\d+$/.test(b)) b = u(b);
            else if (b = a.localeData().monthsParse(b), !g(b)) return a;
        return c = Math.min(a.date(), ea(a.year(), b)), a._d["set" + (a._isUTC ? "UTC" : "") + "Month"](b, c), a
    }

    function ka(b) {
        return null != b ? (ja(this, b), a.updateOffset(this, !0), this) : P(this, "Month")
    }

    function la() {
        return ea(this.year(), this.month())
    }

    function ma(a) {
        return this._monthsParseExact ? (j(this, "_monthsRegex") || oa.call(this), a ? this._monthsShortStrictRegex : this._monthsShortRegex) : (j(this, "_monthsShortRegex") || (this._monthsShortRegex = re), this._monthsShortStrictRegex && a ? this._monthsShortStrictRegex : this._monthsShortRegex)
    }

    function na(a) {
        return this._monthsParseExact ? (j(this, "_monthsRegex") || oa.call(this), a ? this._monthsStrictRegex : this._monthsRegex) : (j(this, "_monthsRegex") || (this._monthsRegex = se), this._monthsStrictRegex && a ? this._monthsStrictRegex : this._monthsRegex)
    }

    function oa() {
        function a(a, b) {
            return b.length - a.length
        }
        var b, c, d = [],
            e = [],
            f = [];
        for (b = 0; 12 > b; b++) c = l([2e3, b]), d.push(this.monthsShort(c, "")), e.push(this.months(c, "")), f.push(this.months(c, "")), f.push(this.monthsShort(c, ""));
        for (d.sort(a), e.sort(a), f.sort(a), b = 0; 12 > b; b++) d[b] = aa(d[b]), e[b] = aa(e[b]);
        for (b = 0; 24 > b; b++) f[b] = aa(f[b]);
        this._monthsRegex = new RegExp("^(" + f.join("|") + ")", "i"), this._monthsShortRegex = this._monthsRegex, this._monthsStrictRegex = new RegExp("^(" + e.join("|") + ")", "i"), this._monthsShortStrictRegex = new RegExp("^(" + d.join("|") + ")", "i")
    }

    function pa(a) {
        return qa(a) ? 366 : 365
    }

    function qa(a) {
        return a % 4 === 0 && a % 100 !== 0 || a % 400 === 0
    }

    function ra() {
        return qa(this.year())
    }

    function sa(a, b, c, d, e, f, g) {
        var h = new Date(a, b, c, d, e, f, g);
        return 100 > a && a >= 0 && isFinite(h.getFullYear()) && h.setFullYear(a), h
    }

    function ta(a) {
        var b = new Date(Date.UTC.apply(null, arguments));
        return 100 > a && a >= 0 && isFinite(b.getUTCFullYear()) && b.setUTCFullYear(a), b
    }

    function ua(a, b, c) {
        var d = 7 + b - c,
            e = (7 + ta(a, 0, d).getUTCDay() - b) % 7;
        return -e + d - 1
    }

    function va(a, b, c, d, e) {
        var f, g, h = (7 + c - d) % 7,
            i = ua(a, d, e),
            j = 1 + 7 * (b - 1) + h + i;
        return 0 >= j ? (f = a - 1, g = pa(f) + j) : j > pa(a) ? (f = a + 1, g = j - pa(a)) : (f = a, g = j), {
            year: f,
            dayOfYear: g
        }
    }

    function wa(a, b, c) {
        var d, e, f = ua(a.year(), b, c),
            g = Math.floor((a.dayOfYear() - f - 1) / 7) + 1;
        return 1 > g ? (e = a.year() - 1, d = g + xa(e, b, c)) : g > xa(a.year(), b, c) ? (d = g - xa(a.year(), b, c), e = a.year() + 1) : (e = a.year(), d = g), {
            week: d,
            year: e
        }
    }

    function xa(a, b, c) {
        var d = ua(a, b, c),
            e = ua(a + 1, b, c);
        return (pa(a) - d + e) / 7
    }

    function ya(a) {
        return wa(a, this._week.dow, this._week.doy).week
    }

    function za() {
        return this._week.dow
    }

    function Aa() {
        return this._week.doy
    }

    function Ba(a) {
        var b = this.localeData().week(this);
        return null == a ? b : this.add(7 * (a - b), "d")
    }

    function Ca(a) {
        var b = wa(this, 1, 4).week;
        return null == a ? b : this.add(7 * (a - b), "d")
    }

    function Da(a, b) {
        return "string" != typeof a ? a : isNaN(a) ? (a = b.weekdaysParse(a), "number" == typeof a ? a : null) : parseInt(a, 10)
    }

    function Ea(a, b) {
        return "string" == typeof a ? b.weekdaysParse(a) % 7 || 7 : isNaN(a) ? null : a
    }

    function Fa(a, b) {
        return a ? c(this._weekdays) ? this._weekdays[a.day()] : this._weekdays[this._weekdays.isFormat.test(b) ? "format" : "standalone"][a.day()] : c(this._weekdays) ? this._weekdays : this._weekdays.standalone
    }

    function Ga(a) {
        return a ? this._weekdaysShort[a.day()] : this._weekdaysShort
    }

    function Ha(a) {
        return a ? this._weekdaysMin[a.day()] : this._weekdaysMin
    }

    function Ia(a, b, c) {
        var d, e, f, g = a.toLocaleLowerCase();
        if (!this._weekdaysParse)
            for (this._weekdaysParse = [], this._shortWeekdaysParse = [], this._minWeekdaysParse = [], d = 0; 7 > d; ++d) f = l([2e3, 1]).day(d), this._minWeekdaysParse[d] = this.weekdaysMin(f, "").toLocaleLowerCase(), this._shortWeekdaysParse[d] = this.weekdaysShort(f, "").toLocaleLowerCase(), this._weekdaysParse[d] = this.weekdays(f, "").toLocaleLowerCase();
        return c ? "dddd" === b ? (e = ne.call(this._weekdaysParse, g), -1 !== e ? e : null) : "ddd" === b ? (e = ne.call(this._shortWeekdaysParse, g), -1 !== e ? e : null) : (e = ne.call(this._minWeekdaysParse, g), -1 !== e ? e : null) : "dddd" === b ? (e = ne.call(this._weekdaysParse, g), -1 !== e ? e : (e = ne.call(this._shortWeekdaysParse, g), -1 !== e ? e : (e = ne.call(this._minWeekdaysParse, g), -1 !== e ? e : null))) : "ddd" === b ? (e = ne.call(this._shortWeekdaysParse, g), -1 !== e ? e : (e = ne.call(this._weekdaysParse, g), -1 !== e ? e : (e = ne.call(this._minWeekdaysParse, g), -1 !== e ? e : null))) : (e = ne.call(this._minWeekdaysParse, g), -1 !== e ? e : (e = ne.call(this._weekdaysParse, g), -1 !== e ? e : (e = ne.call(this._shortWeekdaysParse, g), -1 !== e ? e : null)))
    }

    function Ja(a, b, c) {
        var d, e, f;
        if (this._weekdaysParseExact) return Ia.call(this, a, b, c);
        for (this._weekdaysParse || (this._weekdaysParse = [], this._minWeekdaysParse = [], this._shortWeekdaysParse = [], this._fullWeekdaysParse = []), d = 0; 7 > d; d++) {
            if (e = l([2e3, 1]).day(d), c && !this._fullWeekdaysParse[d] && (this._fullWeekdaysParse[d] = new RegExp("^" + this.weekdays(e, "").replace(".", ".?") + "$", "i"), this._shortWeekdaysParse[d] = new RegExp("^" + this.weekdaysShort(e, "").replace(".", ".?") + "$", "i"), this._minWeekdaysParse[d] = new RegExp("^" + this.weekdaysMin(e, "").replace(".", ".?") + "$", "i")), this._weekdaysParse[d] || (f = "^" + this.weekdays(e, "") + "|^" + this.weekdaysShort(e, "") + "|^" + this.weekdaysMin(e, ""), this._weekdaysParse[d] = new RegExp(f.replace(".", ""), "i")), c && "dddd" === b && this._fullWeekdaysParse[d].test(a)) return d;
            if (c && "ddd" === b && this._shortWeekdaysParse[d].test(a)) return d;
            if (c && "dd" === b && this._minWeekdaysParse[d].test(a)) return d;
            if (!c && this._weekdaysParse[d].test(a)) return d
        }
    }

    function Ka(a) {
        if (!this.isValid()) return null != a ? this : NaN;
        var b = this._isUTC ? this._d.getUTCDay() : this._d.getDay();
        return null != a ? (a = Da(a, this.localeData()), this.add(a - b, "d")) : b
    }

    function La(a) {
        if (!this.isValid()) return null != a ? this : NaN;
        var b = (this.day() + 7 - this.localeData()._week.dow) % 7;
        return null == a ? b : this.add(a - b, "d")
    }

    function Ma(a) {
        if (!this.isValid()) return null != a ? this : NaN;
        if (null != a) {
            var b = Ea(a, this.localeData());
            return this.day(this.day() % 7 ? b : b - 7)
        }
        return this.day() || 7
    }

    function Na(a) {
        return this._weekdaysParseExact ? (j(this, "_weekdaysRegex") || Qa.call(this), a ? this._weekdaysStrictRegex : this._weekdaysRegex) : (j(this, "_weekdaysRegex") || (this._weekdaysRegex = ye), this._weekdaysStrictRegex && a ? this._weekdaysStrictRegex : this._weekdaysRegex)
    }

    function Oa(a) {
        return this._weekdaysParseExact ? (j(this, "_weekdaysRegex") || Qa.call(this), a ? this._weekdaysShortStrictRegex : this._weekdaysShortRegex) : (j(this, "_weekdaysShortRegex") || (this._weekdaysShortRegex = ze), this._weekdaysShortStrictRegex && a ? this._weekdaysShortStrictRegex : this._weekdaysShortRegex)
    }

    function Pa(a) {
        return this._weekdaysParseExact ? (j(this, "_weekdaysRegex") || Qa.call(this), a ? this._weekdaysMinStrictRegex : this._weekdaysMinRegex) : (j(this, "_weekdaysMinRegex") || (this._weekdaysMinRegex = Ae), this._weekdaysMinStrictRegex && a ? this._weekdaysMinStrictRegex : this._weekdaysMinRegex)
    }

    function Qa() {
        function a(a, b) {
            return b.length - a.length
        }
        var b, c, d, e, f, g = [],
            h = [],
            i = [],
            j = [];
        for (b = 0; 7 > b; b++) c = l([2e3, 1]).day(b), d = this.weekdaysMin(c, ""), e = this.weekdaysShort(c, ""), f = this.weekdays(c, ""), g.push(d), h.push(e), i.push(f), j.push(d), j.push(e), j.push(f);
        for (g.sort(a), h.sort(a), i.sort(a), j.sort(a), b = 0; 7 > b; b++) h[b] = aa(h[b]), i[b] = aa(i[b]), j[b] = aa(j[b]);
        this._weekdaysRegex = new RegExp("^(" + j.join("|") + ")", "i"), this._weekdaysShortRegex = this._weekdaysRegex, this._weekdaysMinRegex = this._weekdaysRegex, this._weekdaysStrictRegex = new RegExp("^(" + i.join("|") + ")", "i"), this._weekdaysShortStrictRegex = new RegExp("^(" + h.join("|") + ")", "i"), this._weekdaysMinStrictRegex = new RegExp("^(" + g.join("|") + ")", "i")
    }

    function Ra() {
        return this.hours() % 12 || 12
    }

    function Sa() {
        return this.hours() || 24
    }

    function Ta(a, b) {
        U(a, 0, 0, function() {
            return this.localeData().meridiem(this.hours(), this.minutes(), b)
        })
    }

    function Ua(a, b) {
        return b._meridiemParse
    }

    function Va(a) {
        return "p" === (a + "").toLowerCase().charAt(0)
    }

    function Wa(a, b, c) {
        return a > 11 ? c ? "pm" : "PM" : c ? "am" : "AM"
    }

    function Xa(a) {
        return a ? a.toLowerCase().replace("_", "-") : a
    }

    function Ya(a) {
        for (var b, c, d, e, f = 0; f < a.length;) {
            for (e = Xa(a[f]).split("-"), b = e.length, c = Xa(a[f + 1]), c = c ? c.split("-") : null; b > 0;) {
                if (d = Za(e.slice(0, b).join("-"))) return d;
                if (c && c.length >= b && v(e, c, !0) >= b - 1) break;
                b--
            }
            f++
        }
        return null
    }

    function Za(a) {
        var b = null;
        if (!Fe[a] && "undefined" != typeof module && module && module.exports) try {
            b = Be._abbr, require("./locale/" + a), $a(b)
        } catch (a) {}
        return Fe[a]
    }

    function $a(a, b) {
        var c;
        return a && (c = f(b) ? bb(a) : _a(a, b), c && (Be = c)), Be._abbr
    }

    function _a(a, b) {
        if (null !== b) {
            var c = Ee;
            if (b.abbr = a, null != Fe[a]) y("defineLocaleOverride", "use moment.updateLocale(localeName, config) to change an existing locale. moment.defineLocale(localeName, config) should only be used for creating a new locale See http://momentjs.com/guides/#/warnings/define-locale/ for more info."), c = Fe[a]._config;
            else if (null != b.parentLocale) {
                if (null == Fe[b.parentLocale]) return Ge[b.parentLocale] || (Ge[b.parentLocale] = []), Ge[b.parentLocale].push({
                    name: a,
                    config: b
                }), null;
                c = Fe[b.parentLocale]._config
            }
            return Fe[a] = new C(B(c, b)), Ge[a] && Ge[a].forEach(function(a) {
                _a(a.name, a.config)
            }), $a(a), Fe[a]
        }
        return delete Fe[a], null
    }

    function ab(a, b) {
        if (null != b) {
            var c, d = Ee;
            null != Fe[a] && (d = Fe[a]._config), b = B(d, b), c = new C(b), c.parentLocale = Fe[a], Fe[a] = c, $a(a)
        } else null != Fe[a] && (null != Fe[a].parentLocale ? Fe[a] = Fe[a].parentLocale : null != Fe[a] && delete Fe[a]);
        return Fe[a]
    }

    function bb(a) {
        var b;
        if (a && a._locale && a._locale._abbr && (a = a._locale._abbr), !a) return Be;
        if (!c(a)) {
            if (b = Za(a)) return b;
            a = [a]
        }
        return Ya(a)
    }

    function cb() {
        return Ad(Fe)
    }

    function db(a) {
        var b, c = a._a;
        return c && -2 === n(a).overflow && (b = c[fe] < 0 || c[fe] > 11 ? fe : c[ge] < 1 || c[ge] > ea(c[ee], c[fe]) ? ge : c[he] < 0 || c[he] > 24 || 24 === c[he] && (0 !== c[ie] || 0 !== c[je] || 0 !== c[ke]) ? he : c[ie] < 0 || c[ie] > 59 ? ie : c[je] < 0 || c[je] > 59 ? je : c[ke] < 0 || c[ke] > 999 ? ke : -1, n(a)._overflowDayOfYear && (ee > b || b > ge) && (b = ge), n(a)._overflowWeeks && -1 === b && (b = le), n(a)._overflowWeekday && -1 === b && (b = me), n(a).overflow = b), a
    }

    function eb(a) {
        var b, c, d, e, f, g, h = a._i,
            i = He.exec(h) || Ie.exec(h);
        if (i) {
            for (n(a).iso = !0, b = 0, c = Ke.length; c > b; b++)
                if (Ke[b][1].exec(i[1])) {
                    e = Ke[b][0], d = Ke[b][2] !== !1;
                    break
                }
            if (null == e) return void(a._isValid = !1);
            if (i[3]) {
                for (b = 0, c = Le.length; c > b; b++)
                    if (Le[b][1].exec(i[3])) {
                        f = (i[2] || " ") + Le[b][0];
                        break
                    }
                if (null == f) return void(a._isValid = !1)
            }
            if (!d && null != f) return void(a._isValid = !1);
            if (i[4]) {
                if (!Je.exec(i[4])) return void(a._isValid = !1);
                g = "Z"
            }
            a._f = e + (f || "") + (g || ""), lb(a)
        } else a._isValid = !1
    }

    function fb(a) {
        var b, c, d, e, f, g, h, i, j = {
                " GMT": " +0000",
                " EDT": " -0400",
                " EST": " -0500",
                " CDT": " -0500",
                " CST": " -0600",
                " MDT": " -0600",
                " MST": " -0700",
                " PDT": " -0700",
                " PST": " -0800"
            },
            k = "YXWVUTSRQPONZABCDEFGHIKLM";
        if (b = a._i.replace(/\([^\)]*\)|[\n\t]/g, " ").replace(/(\s\s+)/g, " ").replace(/^\s|\s$/g, ""), c = Ne.exec(b)) {
            if (d = c[1] ? "ddd" + (5 === c[1].length ? ", " : " ") : "", e = "D MMM " + (c[2].length > 10 ? "YYYY " : "YY "), f = "HH:mm" + (c[4] ? ":ss" : ""), c[1]) {
                var l = new Date(c[2]),
                    m = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"][l.getDay()];
                if (c[1].substr(0, 3) !== m) return n(a).weekdayMismatch = !0, void(a._isValid = !1)
            }
            switch (c[5].length) {
                case 2:
                    0 === i ? h = " +0000" : (i = k.indexOf(c[5][1].toUpperCase()) - 12, h = (0 > i ? " -" : " +") + ("" + i).replace(/^-?/, "0").match(/..$/)[0] + "00");
                    break;
                case 4:
                    h = j[c[5]];
                    break;
                default:
                    h = j[" GMT"]
            }
            c[5] = h, a._i = c.splice(1).join(""), g = " ZZ", a._f = d + e + f + g, lb(a), n(a).rfc2822 = !0
        } else a._isValid = !1
    }

    function gb(b) {
        var c = Me.exec(b._i);
        return null !== c ? void(b._d = new Date(+c[1])) : (eb(b), void(b._isValid === !1 && (delete b._isValid, fb(b), b._isValid === !1 && (delete b._isValid, a.createFromInputFallback(b)))))
    }

    function hb(a, b, c) {
        return null != a ? a : null != b ? b : c
    }

    function ib(b) {
        var c = new Date(a.now());
        return b._useUTC ? [c.getUTCFullYear(), c.getUTCMonth(), c.getUTCDate()] : [c.getFullYear(), c.getMonth(), c.getDate()]
    }

    function jb(a) {
        var b, c, d, e, f = [];
        if (!a._d) {
            for (d = ib(a), a._w && null == a._a[ge] && null == a._a[fe] && kb(a), null != a._dayOfYear && (e = hb(a._a[ee], d[ee]), (a._dayOfYear > pa(e) || 0 === a._dayOfYear) && (n(a)._overflowDayOfYear = !0), c = ta(e, 0, a._dayOfYear), a._a[fe] = c.getUTCMonth(), a._a[ge] = c.getUTCDate()), b = 0; 3 > b && null == a._a[b]; ++b) a._a[b] = f[b] = d[b];
            for (; 7 > b; b++) a._a[b] = f[b] = null == a._a[b] ? 2 === b ? 1 : 0 : a._a[b];
            24 === a._a[he] && 0 === a._a[ie] && 0 === a._a[je] && 0 === a._a[ke] && (a._nextDay = !0, a._a[he] = 0), a._d = (a._useUTC ? ta : sa).apply(null, f), null != a._tzm && a._d.setUTCMinutes(a._d.getUTCMinutes() - a._tzm), a._nextDay && (a._a[he] = 24)
        }
    }

    function kb(a) {
        var b, c, d, e, f, g, h, i;
        if (b = a._w, null != b.GG || null != b.W || null != b.E) f = 1, g = 4, c = hb(b.GG, a._a[ee], wa(tb(), 1, 4).year), d = hb(b.W, 1), e = hb(b.E, 1), (1 > e || e > 7) && (i = !0);
        else {
            f = a._locale._week.dow, g = a._locale._week.doy;
            var j = wa(tb(), f, g);
            c = hb(b.gg, a._a[ee], j.year), d = hb(b.w, j.week), null != b.d ? (e = b.d, (0 > e || e > 6) && (i = !0)) : null != b.e ? (e = b.e + f, (b.e < 0 || b.e > 6) && (i = !0)) : e = f
        }
        1 > d || d > xa(c, f, g) ? n(a)._overflowWeeks = !0 : null != i ? n(a)._overflowWeekday = !0 : (h = va(c, d, e, f, g), a._a[ee] = h.year, a._dayOfYear = h.dayOfYear)
    }

    function lb(b) {
        if (b._f === a.ISO_8601) return void eb(b);
        if (b._f === a.RFC_2822) return void fb(b);
        b._a = [], n(b).empty = !0;
        var c, d, e, f, g, h = "" + b._i,
            i = h.length,
            j = 0;
        for (e = Y(b._f, b._locale).match(Jd) || [], c = 0; c < e.length; c++) f = e[c], d = (h.match($(f, b)) || [])[0], d && (g = h.substr(0, h.indexOf(d)), g.length > 0 && n(b).unusedInput.push(g), h = h.slice(h.indexOf(d) + d.length), j += d.length), Md[f] ? (d ? n(b).empty = !1 : n(b).unusedTokens.push(f), da(f, d, b)) : b._strict && !d && n(b).unusedTokens.push(f);
        n(b).charsLeftOver = i - j, h.length > 0 && n(b).unusedInput.push(h), b._a[he] <= 12 && n(b).bigHour === !0 && b._a[he] > 0 && (n(b).bigHour = void 0), n(b).parsedDateParts = b._a.slice(0), n(b).meridiem = b._meridiem, b._a[he] = mb(b._locale, b._a[he], b._meridiem), jb(b), db(b)
    }

    function mb(a, b, c) {
        var d;
        return null == c ? b : null != a.meridiemHour ? a.meridiemHour(b, c) : null != a.isPM ? (d = a.isPM(c), d && 12 > b && (b += 12), d || 12 !== b || (b = 0), b) : b
    }

    function nb(a) {
        var b, c, d, e, f;
        if (0 === a._f.length) return n(a).invalidFormat = !0, void(a._d = new Date(NaN));
        for (e = 0; e < a._f.length; e++) f = 0, b = q({}, a), null != a._useUTC && (b._useUTC = a._useUTC), b._f = a._f[e], lb(b), o(b) && (f += n(b).charsLeftOver, f += 10 * n(b).unusedTokens.length, n(b).score = f, (null == d || d > f) && (d = f, c = b));
        k(a, c || b)
    }

    function ob(a) {
        if (!a._d) {
            var b = L(a._i);
            a._a = i([b.year, b.month, b.day || b.date, b.hour, b.minute, b.second, b.millisecond], function(a) {
                return a && parseInt(a, 10)
            }), jb(a)
        }
    }

    function pb(a) {
        var b = new r(db(qb(a)));
        return b._nextDay && (b.add(1, "d"), b._nextDay = void 0), b
    }

    function qb(a) {
        var b = a._i,
            d = a._f;
        return a._locale = a._locale || bb(a._l), null === b || void 0 === d && "" === b ? p({
            nullInput: !0
        }) : ("string" == typeof b && (a._i = b = a._locale.preparse(b)), s(b) ? new r(db(b)) : (h(b) ? a._d = b : c(d) ? nb(a) : d ? lb(a) : rb(a), o(a) || (a._d = null), a))
    }

    function rb(b) {
        var e = b._i;
        f(e) ? b._d = new Date(a.now()) : h(e) ? b._d = new Date(e.valueOf()) : "string" == typeof e ? gb(b) : c(e) ? (b._a = i(e.slice(0), function(a) {
            return parseInt(a, 10)
        }), jb(b)) : d(e) ? ob(b) : g(e) ? b._d = new Date(e) : a.createFromInputFallback(b)
    }

    function sb(a, b, f, g, h) {
        var i = {};
        return f !== !0 && f !== !1 || (g = f, f = void 0), (d(a) && e(a) || c(a) && 0 === a.length) && (a = void 0), i._isAMomentObject = !0, i._useUTC = i._isUTC = h, i._l = f, i._i = a, i._f = b, i._strict = g, pb(i)
    }

    function tb(a, b, c, d) {
        return sb(a, b, c, d, !1)
    }

    function ub(a, b) {
        var d, e;
        if (1 === b.length && c(b[0]) && (b = b[0]), !b.length) return tb();
        for (d = b[0], e = 1; e < b.length; ++e) b[e].isValid() && !b[e][a](d) || (d = b[e]);
        return d
    }

    function vb() {
        var a = [].slice.call(arguments, 0);
        return ub("isBefore", a)
    }

    function wb() {
        var a = [].slice.call(arguments, 0);
        return ub("isAfter", a)
    }

    function xb(a) {
        for (var b in a)
            if (-1 === Re.indexOf(b) || null != a[b] && isNaN(a[b])) return !1;
        for (var c = !1, d = 0; d < Re.length; ++d)
            if (a[Re[d]]) {
                if (c) return !1;
                parseFloat(a[Re[d]]) !== u(a[Re[d]]) && (c = !0)
            }
        return !0
    }

    function yb() {
        return this._isValid
    }

    function zb() {
        return Sb(NaN)
    }

    function Ab(a) {
        var b = L(a),
            c = b.year || 0,
            d = b.quarter || 0,
            e = b.month || 0,
            f = b.week || 0,
            g = b.day || 0,
            h = b.hour || 0,
            i = b.minute || 0,
            j = b.second || 0,
            k = b.millisecond || 0;
        this._isValid = xb(b), this._milliseconds = +k + 1e3 * j + 6e4 * i + 1e3 * h * 60 * 60, this._days = +g + 7 * f, this._months = +e + 3 * d + 12 * c, this._data = {}, this._locale = bb(), this._bubble()
    }

    function Bb(a) {
        return a instanceof Ab
    }

    function Cb(a) {
        return 0 > a ? -1 * Math.round(-1 * a) : Math.round(a)
    }

    function Db(a, b) {
        U(a, 0, 0, function() {
            var a = this.utcOffset(),
                c = "+";
            return 0 > a && (a = -a, c = "-"), c + T(~~(a / 60), 2) + b + T(~~a % 60, 2)
        })
    }

    function Eb(a, b) {
        var c = (b || "").match(a);
        if (null === c) return null;
        var d = c[c.length - 1] || [],
            e = (d + "").match(Se) || ["-", 0, 0],
            f = +(60 * e[1]) + u(e[2]);
        return 0 === f ? 0 : "+" === e[0] ? f : -f
    }

    function Fb(b, c) {
        var d, e;
        return c._isUTC ? (d = c.clone(), e = (s(b) || h(b) ? b.valueOf() : tb(b).valueOf()) - d.valueOf(), d._d.setTime(d._d.valueOf() + e), a.updateOffset(d, !1), d) : tb(b).local()
    }

    function Gb(a) {
        return 15 * -Math.round(a._d.getTimezoneOffset() / 15)
    }

    function Hb(b, c, d) {
        var e, f = this._offset || 0;
        if (!this.isValid()) return null != b ? this : NaN;
        if (null != b) {
            if ("string" == typeof b) {
                if (b = Eb(_d, b), null === b) return this
            } else Math.abs(b) < 16 && !d && (b = 60 * b);
            return !this._isUTC && c && (e = Gb(this)), this._offset = b, this._isUTC = !0, null != e && this.add(e, "m"), f !== b && (!c || this._changeInProgress ? Xb(this, Sb(b - f, "m"), 1, !1) : this._changeInProgress || (this._changeInProgress = !0, a.updateOffset(this, !0), this._changeInProgress = null)), this
        }
        return this._isUTC ? f : Gb(this)
    }

    function Ib(a, b) {
        return null != a ? ("string" != typeof a && (a = -a), this.utcOffset(a, b), this) : -this.utcOffset()
    }

    function Jb(a) {
        return this.utcOffset(0, a)
    }

    function Kb(a) {
        return this._isUTC && (this.utcOffset(0, a), this._isUTC = !1, a && this.subtract(Gb(this), "m")), this
    }

    function Lb() {
        if (null != this._tzm) this.utcOffset(this._tzm, !1, !0);
        else if ("string" == typeof this._i) {
            var a = Eb($d, this._i);
            null != a ? this.utcOffset(a) : this.utcOffset(0, !0)
        }
        return this
    }

    function Mb(a) {
        return !!this.isValid() && (a = a ? tb(a).utcOffset() : 0, (this.utcOffset() - a) % 60 === 0)
    }

    function Nb() {
        return this.utcOffset() > this.clone().month(0).utcOffset() || this.utcOffset() > this.clone().month(5).utcOffset()
    }

    function Ob() {
        if (!f(this._isDSTShifted)) return this._isDSTShifted;
        var a = {};
        if (q(a, this), a = qb(a), a._a) {
            var b = a._isUTC ? l(a._a) : tb(a._a);
            this._isDSTShifted = this.isValid() && v(a._a, b.toArray()) > 0
        } else this._isDSTShifted = !1;
        return this._isDSTShifted
    }

    function Pb() {
        return !!this.isValid() && !this._isUTC
    }

    function Qb() {
        return !!this.isValid() && this._isUTC
    }

    function Rb() {
        return !!this.isValid() && this._isUTC && 0 === this._offset
    }

    function Sb(a, b) {
        var c, d, e, f = a,
            h = null;
        return Bb(a) ? f = {
            ms: a._milliseconds,
            d: a._days,
            M: a._months
        } : g(a) ? (f = {}, b ? f[b] = a : f.milliseconds = a) : (h = Te.exec(a)) ? (c = "-" === h[1] ? -1 : 1, f = {
            y: 0,
            d: u(h[ge]) * c,
            h: u(h[he]) * c,
            m: u(h[ie]) * c,
            s: u(h[je]) * c,
            ms: u(Cb(1e3 * h[ke])) * c
        }) : (h = Ue.exec(a)) ? (c = "-" === h[1] ? -1 : 1, f = {
            y: Tb(h[2], c),
            M: Tb(h[3], c),
            w: Tb(h[4], c),
            d: Tb(h[5], c),
            h: Tb(h[6], c),
            m: Tb(h[7], c),
            s: Tb(h[8], c)
        }) : null == f ? f = {} : "object" == typeof f && ("from" in f || "to" in f) && (e = Vb(tb(f.from), tb(f.to)), f = {}, f.ms = e.milliseconds, f.M = e.months), d = new Ab(f), Bb(a) && j(a, "_locale") && (d._locale = a._locale), d
    }

    function Tb(a, b) {
        var c = a && parseFloat(a.replace(",", "."));
        return (isNaN(c) ? 0 : c) * b
    }

    function Ub(a, b) {
        var c = {
            milliseconds: 0,
            months: 0
        };
        return c.months = b.month() - a.month() + 12 * (b.year() - a.year()), a.clone().add(c.months, "M").isAfter(b) && --c.months, c.milliseconds = +b - +a.clone().add(c.months, "M"), c
    }

    function Vb(a, b) {
        var c;
        return a.isValid() && b.isValid() ? (b = Fb(b, a), a.isBefore(b) ? c = Ub(a, b) : (c = Ub(b, a), c.milliseconds = -c.milliseconds, c.months = -c.months), c) : {
            milliseconds: 0,
            months: 0
        }
    }

    function Wb(a, b) {
        return function(c, d) {
            var e, f;
            return null === d || isNaN(+d) || (y(b, "moment()." + b + "(period, number) is deprecated. Please use moment()." + b + "(number, period). See http://momentjs.com/guides/#/warnings/add-inverted-param/ for more info."), f = c, c = d, d = f), c = "string" == typeof c ? +c : c, e = Sb(c, d), Xb(this, e, a), this
        }
    }

    function Xb(b, c, d, e) {
        var f = c._milliseconds,
            g = Cb(c._days),
            h = Cb(c._months);
        b.isValid() && (e = null == e || e, f && b._d.setTime(b._d.valueOf() + f * d), g && Q(b, "Date", P(b, "Date") + g * d), h && ja(b, P(b, "Month") + h * d), e && a.updateOffset(b, g || h))
    }

    function Yb(a, b) {
        var c = a.diff(b, "days", !0);
        return -6 > c ? "sameElse" : -1 > c ? "lastWeek" : 0 > c ? "lastDay" : 1 > c ? "sameDay" : 2 > c ? "nextDay" : 7 > c ? "nextWeek" : "sameElse"
    }

    function Zb(b, c) {
        var d = b || tb(),
            e = Fb(d, this).startOf("day"),
            f = a.calendarFormat(this, e) || "sameElse",
            g = c && (z(c[f]) ? c[f].call(this, d) : c[f]);
        return this.format(g || this.localeData().calendar(f, this, tb(d)))
    }

    function $b() {
        return new r(this)
    }

    function _b(a, b) {
        var c = s(a) ? a : tb(a);
        return !(!this.isValid() || !c.isValid()) && (b = K(f(b) ? "millisecond" : b), "millisecond" === b ? this.valueOf() > c.valueOf() : c.valueOf() < this.clone().startOf(b).valueOf())
    }

    function ac(a, b) {
        var c = s(a) ? a : tb(a);
        return !(!this.isValid() || !c.isValid()) && (b = K(f(b) ? "millisecond" : b), "millisecond" === b ? this.valueOf() < c.valueOf() : this.clone().endOf(b).valueOf() < c.valueOf())
    }

    function bc(a, b, c, d) {
        return d = d || "()", ("(" === d[0] ? this.isAfter(a, c) : !this.isBefore(a, c)) && (")" === d[1] ? this.isBefore(b, c) : !this.isAfter(b, c))
    }

    function cc(a, b) {
        var c, d = s(a) ? a : tb(a);
        return !(!this.isValid() || !d.isValid()) && (b = K(b || "millisecond"), "millisecond" === b ? this.valueOf() === d.valueOf() : (c = d.valueOf(), this.clone().startOf(b).valueOf() <= c && c <= this.clone().endOf(b).valueOf()))
    }

    function dc(a, b) {
        return this.isSame(a, b) || this.isAfter(a, b)
    }

    function ec(a, b) {
        return this.isSame(a, b) || this.isBefore(a, b)
    }

    function fc(a, b, c) {
        var d, e, f, g;
        return this.isValid() ? (d = Fb(a, this), d.isValid() ? (e = 6e4 * (d.utcOffset() - this.utcOffset()), b = K(b), "year" === b || "month" === b || "quarter" === b ? (g = gc(this, d), "quarter" === b ? g /= 3 : "year" === b && (g /= 12)) : (f = this - d, g = "second" === b ? f / 1e3 : "minute" === b ? f / 6e4 : "hour" === b ? f / 36e5 : "day" === b ? (f - e) / 864e5 : "week" === b ? (f - e) / 6048e5 : f), c ? g : t(g)) : NaN) : NaN
    }

    function gc(a, b) {
        var c, d, e = 12 * (b.year() - a.year()) + (b.month() - a.month()),
            f = a.clone().add(e, "months");
        return 0 > b - f ? (c = a.clone().add(e - 1, "months"), d = (b - f) / (f - c)) : (c = a.clone().add(e + 1, "months"), d = (b - f) / (c - f)), -(e + d) || 0
    }

    function hc() {
        return this.clone().locale("en").format("ddd MMM DD YYYY HH:mm:ss [GMT]ZZ")
    }

    function ic() {
        if (!this.isValid()) return null;
        var a = this.clone().utc();
        return a.year() < 0 || a.year() > 9999 ? X(a, "YYYYYY-MM-DD[T]HH:mm:ss.SSS[Z]") : z(Date.prototype.toISOString) ? this.toDate().toISOString() : X(a, "YYYY-MM-DD[T]HH:mm:ss.SSS[Z]")
    }

    function jc() {
        if (!this.isValid()) return "moment.invalid(/* " + this._i + " */)";
        var a = "moment",
            b = "";
        this.isLocal() || (a = 0 === this.utcOffset() ? "moment.utc" : "moment.parseZone", b = "Z");
        var c = "[" + a + '("]',
            d = 0 <= this.year() && this.year() <= 9999 ? "YYYY" : "YYYYYY",
            e = "-MM-DD[T]HH:mm:ss.SSS",
            f = b + '[")]';
        return this.format(c + d + e + f)
    }

    function kc(b) {
        b || (b = this.isUtc() ? a.defaultFormatUtc : a.defaultFormat);
        var c = X(this, b);
        return this.localeData().postformat(c)
    }

    function lc(a, b) {
        return this.isValid() && (s(a) && a.isValid() || tb(a).isValid()) ? Sb({
            to: this,
            from: a
        }).locale(this.locale()).humanize(!b) : this.localeData().invalidDate()
    }

    function mc(a) {
        return this.from(tb(), a)
    }

    function nc(a, b) {
        return this.isValid() && (s(a) && a.isValid() || tb(a).isValid()) ? Sb({
            from: this,
            to: a
        }).locale(this.locale()).humanize(!b) : this.localeData().invalidDate()
    }

    function oc(a) {
        return this.to(tb(), a)
    }

    function pc(a) {
        var b;
        return void 0 === a ? this._locale._abbr : (b = bb(a), null != b && (this._locale = b), this)
    }

    function qc() {
        return this._locale
    }

    function rc(a) {
        switch (a = K(a)) {
            case "year":
                this.month(0);
            case "quarter":
            case "month":
                this.date(1);
            case "week":
            case "isoWeek":
            case "day":
            case "date":
                this.hours(0);
            case "hour":
                this.minutes(0);
            case "minute":
                this.seconds(0);
            case "second":
                this.milliseconds(0)
        }
        return "week" === a && this.weekday(0), "isoWeek" === a && this.isoWeekday(1), "quarter" === a && this.month(3 * Math.floor(this.month() / 3)), this
    }

    function sc(a) {
        return a = K(a), void 0 === a || "millisecond" === a ? this : ("date" === a && (a = "day"), this.startOf(a).add(1, "isoWeek" === a ? "week" : a).subtract(1, "ms"))
    }

    function tc() {
        return this._d.valueOf() - 6e4 * (this._offset || 0)
    }

    function uc() {
        return Math.floor(this.valueOf() / 1e3)
    }

    function vc() {
        return new Date(this.valueOf())
    }

    function wc() {
        var a = this;
        return [a.year(), a.month(), a.date(), a.hour(), a.minute(), a.second(), a.millisecond()]
    }

    function xc() {
        var a = this;
        return {
            years: a.year(),
            months: a.month(),
            date: a.date(),
            hours: a.hours(),
            minutes: a.minutes(),
            seconds: a.seconds(),
            milliseconds: a.milliseconds()
        }
    }

    function yc() {
        return this.isValid() ? this.toISOString() : null
    }

    function zc() {
        return o(this)
    }

    function Ac() {
        return k({}, n(this))
    }

    function Bc() {
        return n(this).overflow
    }

    function Cc() {
        return {
            input: this._i,
            format: this._f,
            locale: this._locale,
            isUTC: this._isUTC,
            strict: this._strict
        }
    }

    function Dc(a, b) {
        U(0, [a, a.length], 0, b)
    }

    function Ec(a) {
        return Ic.call(this, a, this.week(), this.weekday(), this.localeData()._week.dow, this.localeData()._week.doy)
    }

    function Fc(a) {
        return Ic.call(this, a, this.isoWeek(), this.isoWeekday(), 1, 4)
    }

    function Gc() {
        return xa(this.year(), 1, 4)
    }

    function Hc() {
        var a = this.localeData()._week;
        return xa(this.year(), a.dow, a.doy)
    }

    function Ic(a, b, c, d, e) {
        var f;
        return null == a ? wa(this, d, e).year : (f = xa(a, d, e), b > f && (b = f), Jc.call(this, a, b, c, d, e))
    }

    function Jc(a, b, c, d, e) {
        var f = va(a, b, c, d, e),
            g = ta(f.year, 0, f.dayOfYear);
        return this.year(g.getUTCFullYear()), this.month(g.getUTCMonth()), this.date(g.getUTCDate()), this
    }

    function Kc(a) {
        return null == a ? Math.ceil((this.month() + 1) / 3) : this.month(3 * (a - 1) + this.month() % 3)
    }

    function Lc(a) {
        var b = Math.round((this.clone().startOf("day") - this.clone().startOf("year")) / 864e5) + 1;
        return null == a ? b : this.add(a - b, "d")
    }

    function Mc(a, b) {
        b[ke] = u(1e3 * ("0." + a))
    }

    function Nc() {
        return this._isUTC ? "UTC" : ""
    }

    function Oc() {
        return this._isUTC ? "Coordinated Universal Time" : ""
    }

    function Pc(a) {
        return tb(1e3 * a)
    }

    function Qc() {
        return tb.apply(null, arguments).parseZone()
    }

    function Rc(a) {
        return a
    }

    function Sc(a, b, c, d) {
        var e = bb(),
            f = l().set(d, b);
        return e[c](f, a)
    }

    function Tc(a, b, c) {
        if (g(a) && (b = a, a = void 0), a = a || "", null != b) return Sc(a, b, c, "month");
        var d, e = [];
        for (d = 0; 12 > d; d++) e[d] = Sc(a, d, c, "month");
        return e
    }

    function Uc(a, b, c, d) {
        "boolean" == typeof a ? (g(b) && (c = b, b = void 0), b = b || "") : (b = a, c = b, a = !1, g(b) && (c = b, b = void 0), b = b || "");
        var e = bb(),
            f = a ? e._week.dow : 0;
        if (null != c) return Sc(b, (c + f) % 7, d, "day");
        var h, i = [];
        for (h = 0; 7 > h; h++) i[h] = Sc(b, (h + f) % 7, d, "day");
        return i
    }

    function Vc(a, b) {
        return Tc(a, b, "months")
    }

    function Wc(a, b) {
        return Tc(a, b, "monthsShort")
    }

    function Xc(a, b, c) {
        return Uc(a, b, c, "weekdays")
    }

    function Yc(a, b, c) {
        return Uc(a, b, c, "weekdaysShort")
    }

    function Zc(a, b, c) {
        return Uc(a, b, c, "weekdaysMin")
    }

    function $c() {
        var a = this._data;
        return this._milliseconds = df(this._milliseconds), this._days = df(this._days), this._months = df(this._months), a.milliseconds = df(a.milliseconds), a.seconds = df(a.seconds), a.minutes = df(a.minutes), a.hours = df(a.hours), a.months = df(a.months), a.years = df(a.years), this
    }

    function _c(a, b, c, d) {
        var e = Sb(b, c);
        return a._milliseconds += d * e._milliseconds, a._days += d * e._days, a._months += d * e._months, a._bubble()
    }

    function ad(a, b) {
        return _c(this, a, b, 1)
    }

    function bd(a, b) {
        return _c(this, a, b, -1)
    }

    function cd(a) {
        return 0 > a ? Math.floor(a) : Math.ceil(a)
    }

    function dd() {
        var a, b, c, d, e, f = this._milliseconds,
            g = this._days,
            h = this._months,
            i = this._data;
        return f >= 0 && g >= 0 && h >= 0 || 0 >= f && 0 >= g && 0 >= h || (f += 864e5 * cd(fd(h) + g), g = 0, h = 0), i.milliseconds = f % 1e3, a = t(f / 1e3), i.seconds = a % 60, b = t(a / 60), i.minutes = b % 60, c = t(b / 60), i.hours = c % 24, g += t(c / 24), e = t(ed(g)), h += e, g -= cd(fd(e)), d = t(h / 12), h %= 12, i.days = g, i.months = h, i.years = d, this
    }

    function ed(a) {
        return 4800 * a / 146097
    }

    function fd(a) {
        return 146097 * a / 4800
    }

    function gd(a) {
        if (!this.isValid()) return NaN;
        var b, c, d = this._milliseconds;
        if (a = K(a), "month" === a || "year" === a) return b = this._days + d / 864e5, c = this._months + ed(b), "month" === a ? c : c / 12;
        switch (b = this._days + Math.round(fd(this._months)), a) {
            case "week":
                return b / 7 + d / 6048e5;
            case "day":
                return b + d / 864e5;
            case "hour":
                return 24 * b + d / 36e5;
            case "minute":
                return 1440 * b + d / 6e4;
            case "second":
                return 86400 * b + d / 1e3;
            case "millisecond":
                return Math.floor(864e5 * b) + d;
            default:
                throw new Error("Unknown unit " + a)
        }
    }

    function hd() {
        return this.isValid() ? this._milliseconds + 864e5 * this._days + this._months % 12 * 2592e6 + 31536e6 * u(this._months / 12) : NaN
    }

    function id(a) {
        return function() {
            return this.as(a)
        }
    }

    function jd(a) {
        return a = K(a), this.isValid() ? this[a + "s"]() : NaN
    }

    function kd(a) {
        return function() {
            return this.isValid() ? this._data[a] : NaN
        }
    }

    function ld() {
        return t(this.days() / 7)
    }

    function md(a, b, c, d, e) {
        return e.relativeTime(b || 1, !!c, a, d)
    }

    function nd(a, b, c) {
        var d = Sb(a).abs(),
            e = uf(d.as("s")),
            f = uf(d.as("m")),
            g = uf(d.as("h")),
            h = uf(d.as("d")),
            i = uf(d.as("M")),
            j = uf(d.as("y")),
            k = e <= vf.ss && ["s", e] || e < vf.s && ["ss", e] || 1 >= f && ["m"] || f < vf.m && ["mm", f] || 1 >= g && ["h"] || g < vf.h && ["hh", g] || 1 >= h && ["d"] || h < vf.d && ["dd", h] || 1 >= i && ["M"] || i < vf.M && ["MM", i] || 1 >= j && ["y"] || ["yy", j];
        return k[2] = b, k[3] = +a > 0, k[4] = c, md.apply(null, k)
    }

    function od(a) {
        return void 0 === a ? uf : "function" == typeof a && (uf = a, !0)
    }

    function pd(a, b) {
        return void 0 !== vf[a] && (void 0 === b ? vf[a] : (vf[a] = b, "s" === a && (vf.ss = b - 1), !0))
    }

    function qd(a) {
        if (!this.isValid()) return this.localeData().invalidDate();
        var b = this.localeData(),
            c = nd(this, !a, b);
        return a && (c = b.pastFuture(+this, c)), b.postformat(c)
    }

    function rd() {
        if (!this.isValid()) return this.localeData().invalidDate();
        var a, b, c, d = wf(this._milliseconds) / 1e3,
            e = wf(this._days),
            f = wf(this._months);
        a = t(d / 60), b = t(a / 60), d %= 60, a %= 60, c = t(f / 12), f %= 12;
        var g = c,
            h = f,
            i = e,
            j = b,
            k = a,
            l = d,
            m = this.asSeconds();
        return m ? (0 > m ? "-" : "") + "P" + (g ? g + "Y" : "") + (h ? h + "M" : "") + (i ? i + "D" : "") + (j || k || l ? "T" : "") + (j ? j + "H" : "") + (k ? k + "M" : "") + (l ? l + "S" : "") : "P0D"
    }
    var sd, td;
    td = Array.prototype.some ? Array.prototype.some : function(a) {
        for (var b = Object(this), c = b.length >>> 0, d = 0; c > d; d++)
            if (d in b && a.call(this, b[d], d, b)) return !0;
        return !1
    };
    var ud = td,
        vd = a.momentProperties = [],
        wd = !1,
        xd = {};
    a.suppressDeprecationWarnings = !1, a.deprecationHandler = null;
    var yd;
    yd = Object.keys ? Object.keys : function(a) {
        var b, c = [];
        for (b in a) j(a, b) && c.push(b);
        return c
    };
    var zd, Ad = yd,
        Bd = {
            sameDay: "[Today at] LT",
            nextDay: "[Tomorrow at] LT",
            nextWeek: "dddd [at] LT",
            lastDay: "[Yesterday at] LT",
            lastWeek: "[Last] dddd [at] LT",
            sameElse: "L"
        },
        Cd = {
            LTS: "h:mm:ss A",
            LT: "h:mm A",
            L: "MM/DD/YYYY",
            LL: "MMMM D, YYYY",
            LLL: "MMMM D, YYYY h:mm A",
            LLLL: "dddd, MMMM D, YYYY h:mm A"
        },
        Dd = "Invalid date",
        Ed = "%d",
        Fd = /\d{1,2}/,
        Gd = {
            future: "in %s",
            past: "%s ago",
            s: "a few seconds",
            ss: "%d seconds",
            m: "a minute",
            mm: "%d minutes",
            h: "an hour",
            hh: "%d hours",
            d: "a day",
            dd: "%d days",
            M: "a month",
            MM: "%d months",
            y: "a year",
            yy: "%d years"
        },
        Hd = {},
        Id = {},
        Jd = /(\[[^\[]*\])|(\\)?([Hh]mm(ss)?|Mo|MM?M?M?|Do|DDDo|DD?D?D?|ddd?d?|do?|w[o|w]?|W[o|W]?|Qo?|YYYYYY|YYYYY|YYYY|YY|gg(ggg?)?|GG(GGG?)?|e|E|a|A|hh?|HH?|kk?|mm?|ss?|S{1,9}|x|X|zz?|ZZ?|.)/g,
        Kd = /(\[[^\[]*\])|(\\)?(LTS|LT|LL?L?L?|l{1,4})/g,
        Ld = {},
        Md = {},
        Nd = /\d/,
        Od = /\d\d/,
        Pd = /\d{3}/,
        Qd = /\d{4}/,
        Rd = /[+-]?\d{6}/,
        Sd = /\d\d?/,
        Td = /\d\d\d\d?/,
        Ud = /\d\d\d\d\d\d?/,
        Vd = /\d{1,3}/,
        Wd = /\d{1,4}/,
        Xd = /[+-]?\d{1,6}/,
        Yd = /\d+/,
        Zd = /[+-]?\d+/,
        $d = /Z|[+-]\d\d:?\d\d/gi,
        _d = /Z|[+-]\d\d(?::?\d\d)?/gi,
        ae = /[+-]?\d+(\.\d{1,3})?/,
        be = /[0-9]*['a-z\u00A0-\u05FF\u0700-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+|[\u0600-\u06FF\/]+(\s*?[\u0600-\u06FF]+){1,2}/i,
        ce = {},
        de = {},
        ee = 0,
        fe = 1,
        ge = 2,
        he = 3,
        ie = 4,
        je = 5,
        ke = 6,
        le = 7,
        me = 8;
    zd = Array.prototype.indexOf ? Array.prototype.indexOf : function(a) {
        var b;
        for (b = 0; b < this.length; ++b)
            if (this[b] === a) return b;
        return -1
    };
    var ne = zd;
    U("M", ["MM", 2], "Mo", function() {
        return this.month() + 1
    }), U("MMM", 0, 0, function(a) {
        return this.localeData().monthsShort(this, a)
    }), U("MMMM", 0, 0, function(a) {
        return this.localeData().months(this, a)
    }), J("month", "M"), M("month", 8), Z("M", Sd), Z("MM", Sd, Od), Z("MMM", function(a, b) {
        return b.monthsShortRegex(a)
    }), Z("MMMM", function(a, b) {
        return b.monthsRegex(a)
    }), ba(["M", "MM"], function(a, b) {
        b[fe] = u(a) - 1
    }), ba(["MMM", "MMMM"], function(a, b, c, d) {
        var e = c._locale.monthsParse(a, d, c._strict);
        null != e ? b[fe] = e : n(c).invalidMonth = a
    });
    var oe = /D[oD]?(\[[^\[\]]*\]|\s)+MMMM?/,
        pe = "January_February_March_April_May_June_July_August_September_October_November_December".split("_"),
        qe = "Jan_Feb_Mar_Apr_May_Jun_Jul_Aug_Sep_Oct_Nov_Dec".split("_"),
        re = be,
        se = be;
    U("Y", 0, 0, function() {
        var a = this.year();
        return 9999 >= a ? "" + a : "+" + a
    }), U(0, ["YY", 2], 0, function() {
        return this.year() % 100
    }), U(0, ["YYYY", 4], 0, "year"), U(0, ["YYYYY", 5], 0, "year"), U(0, ["YYYYYY", 6, !0], 0, "year"), J("year", "y"), M("year", 1), Z("Y", Zd), Z("YY", Sd, Od), Z("YYYY", Wd, Qd), Z("YYYYY", Xd, Rd), Z("YYYYYY", Xd, Rd), ba(["YYYYY", "YYYYYY"], ee), ba("YYYY", function(b, c) {
        c[ee] = 2 === b.length ? a.parseTwoDigitYear(b) : u(b)
    }), ba("YY", function(b, c) {
        c[ee] = a.parseTwoDigitYear(b)
    }), ba("Y", function(a, b) {
        b[ee] = parseInt(a, 10)
    }), a.parseTwoDigitYear = function(a) {
        return u(a) + (u(a) > 68 ? 1900 : 2e3)
    };
    var te = O("FullYear", !0);
    U("w", ["ww", 2], "wo", "week"), U("W", ["WW", 2], "Wo", "isoWeek"), J("week", "w"), J("isoWeek", "W"), M("week", 5), M("isoWeek", 5), Z("w", Sd), Z("ww", Sd, Od), Z("W", Sd), Z("WW", Sd, Od), ca(["w", "ww", "W", "WW"], function(a, b, c, d) {
        b[d.substr(0, 1)] = u(a)
    });
    var ue = {
        dow: 0,
        doy: 6
    };
    U("d", 0, "do", "day"), U("dd", 0, 0, function(a) {
        return this.localeData().weekdaysMin(this, a)
    }), U("ddd", 0, 0, function(a) {
        return this.localeData().weekdaysShort(this, a)
    }), U("dddd", 0, 0, function(a) {
        return this.localeData().weekdays(this, a)
    }), U("e", 0, 0, "weekday"), U("E", 0, 0, "isoWeekday"), J("day", "d"), J("weekday", "e"), J("isoWeekday", "E"), M("day", 11), M("weekday", 11), M("isoWeekday", 11), Z("d", Sd), Z("e", Sd), Z("E", Sd), Z("dd", function(a, b) {
        return b.weekdaysMinRegex(a)
    }), Z("ddd", function(a, b) {
        return b.weekdaysShortRegex(a)
    }), Z("dddd", function(a, b) {
        return b.weekdaysRegex(a)
    }), ca(["dd", "ddd", "dddd"], function(a, b, c, d) {
        var e = c._locale.weekdaysParse(a, d, c._strict);
        null != e ? b.d = e : n(c).invalidWeekday = a
    }), ca(["d", "e", "E"], function(a, b, c, d) {
        b[d] = u(a)
    });
    var ve = "Sunday_Monday_Tuesday_Wednesday_Thursday_Friday_Saturday".split("_"),
        we = "Sun_Mon_Tue_Wed_Thu_Fri_Sat".split("_"),
        xe = "Su_Mo_Tu_We_Th_Fr_Sa".split("_"),
        ye = be,
        ze = be,
        Ae = be;
    U("H", ["HH", 2], 0, "hour"), U("h", ["hh", 2], 0, Ra), U("k", ["kk", 2], 0, Sa), U("hmm", 0, 0, function() {
        return "" + Ra.apply(this) + T(this.minutes(), 2)
    }), U("hmmss", 0, 0, function() {
        return "" + Ra.apply(this) + T(this.minutes(), 2) + T(this.seconds(), 2)
    }), U("Hmm", 0, 0, function() {
        return "" + this.hours() + T(this.minutes(), 2)
    }), U("Hmmss", 0, 0, function() {
        return "" + this.hours() + T(this.minutes(), 2) + T(this.seconds(), 2)
    }), Ta("a", !0), Ta("A", !1), J("hour", "h"), M("hour", 13), Z("a", Ua), Z("A", Ua), Z("H", Sd), Z("h", Sd), Z("k", Sd), Z("HH", Sd, Od), Z("hh", Sd, Od), Z("kk", Sd, Od), Z("hmm", Td), Z("hmmss", Ud), Z("Hmm", Td), Z("Hmmss", Ud), ba(["H", "HH"], he), ba(["k", "kk"], function(a, b, c) {
        var d = u(a);
        b[he] = 24 === d ? 0 : d
    }), ba(["a", "A"], function(a, b, c) {
        c._isPm = c._locale.isPM(a), c._meridiem = a
    }), ba(["h", "hh"], function(a, b, c) {
        b[he] = u(a), n(c).bigHour = !0
    }), ba("hmm", function(a, b, c) {
        var d = a.length - 2;
        b[he] = u(a.substr(0, d)), b[ie] = u(a.substr(d)), n(c).bigHour = !0
    }), ba("hmmss", function(a, b, c) {
        var d = a.length - 4,
            e = a.length - 2;
        b[he] = u(a.substr(0, d)), b[ie] = u(a.substr(d, 2)), b[je] = u(a.substr(e)), n(c).bigHour = !0
    }), ba("Hmm", function(a, b, c) {
        var d = a.length - 2;
        b[he] = u(a.substr(0, d)), b[ie] = u(a.substr(d))
    }), ba("Hmmss", function(a, b, c) {
        var d = a.length - 4,
            e = a.length - 2;
        b[he] = u(a.substr(0, d)), b[ie] = u(a.substr(d, 2)), b[je] = u(a.substr(e))
    });
    var Be, Ce = /[ap]\.?m?\.?/i,
        De = O("Hours", !0),
        Ee = {
            calendar: Bd,
            longDateFormat: Cd,
            invalidDate: Dd,
            ordinal: Ed,
            dayOfMonthOrdinalParse: Fd,
            relativeTime: Gd,
            months: pe,
            monthsShort: qe,
            week: ue,
            weekdays: ve,
            weekdaysMin: xe,
            weekdaysShort: we,
            meridiemParse: Ce
        },
        Fe = {},
        Ge = {},
        He = /^\s*((?:[+-]\d{6}|\d{4})-(?:\d\d-\d\d|W\d\d-\d|W\d\d|\d\d\d|\d\d))(?:(T| )(\d\d(?::\d\d(?::\d\d(?:[.,]\d+)?)?)?)([\+\-]\d\d(?::?\d\d)?|\s*Z)?)?$/,
        Ie = /^\s*((?:[+-]\d{6}|\d{4})(?:\d\d\d\d|W\d\d\d|W\d\d|\d\d\d|\d\d))(?:(T| )(\d\d(?:\d\d(?:\d\d(?:[.,]\d+)?)?)?)([\+\-]\d\d(?::?\d\d)?|\s*Z)?)?$/,
        Je = /Z|[+-]\d\d(?::?\d\d)?/,
        Ke = [
            ["YYYYYY-MM-DD", /[+-]\d{6}-\d\d-\d\d/],
            ["YYYY-MM-DD", /\d{4}-\d\d-\d\d/],
            ["GGGG-[W]WW-E", /\d{4}-W\d\d-\d/],
            ["GGGG-[W]WW", /\d{4}-W\d\d/, !1],
            ["YYYY-DDD", /\d{4}-\d{3}/],
            ["YYYY-MM", /\d{4}-\d\d/, !1],
            ["YYYYYYMMDD", /[+-]\d{10}/],
            ["YYYYMMDD", /\d{8}/],
            ["GGGG[W]WWE", /\d{4}W\d{3}/],
            ["GGGG[W]WW", /\d{4}W\d{2}/, !1],
            ["YYYYDDD", /\d{7}/]
        ],
        Le = [
            ["HH:mm:ss.SSSS", /\d\d:\d\d:\d\d\.\d+/],
            ["HH:mm:ss,SSSS", /\d\d:\d\d:\d\d,\d+/],
            ["HH:mm:ss", /\d\d:\d\d:\d\d/],
            ["HH:mm", /\d\d:\d\d/],
            ["HHmmss.SSSS", /\d\d\d\d\d\d\.\d+/],
            ["HHmmss,SSSS", /\d\d\d\d\d\d,\d+/],
            ["HHmmss", /\d\d\d\d\d\d/],
            ["HHmm", /\d\d\d\d/],
            ["HH", /\d\d/]
        ],
        Me = /^\/?Date\((\-?\d+)/i,
        Ne = /^((?:Mon|Tue|Wed|Thu|Fri|Sat|Sun),?\s)?(\d?\d\s(?:Jan|Feb|Mar|Apr|May|Jun|Jul|Aug|Sep|Oct|Nov|Dec)\s(?:\d\d)?\d\d\s)(\d\d:\d\d)(\:\d\d)?(\s(?:UT|GMT|[ECMP][SD]T|[A-IK-Za-ik-z]|[+-]\d{4}))$/;
    a.createFromInputFallback = x("value provided is not in a recognized RFC2822 or ISO format. moment construction falls back to js Date(), which is not reliable across all browsers and versions. Non RFC2822/ISO date formats are discouraged and will be removed in an upcoming major release. Please refer to http://momentjs.com/guides/#/warnings/js-date/ for more info.", function(a) {
        a._d = new Date(a._i + (a._useUTC ? " UTC" : ""))
    }), a.ISO_8601 = function() {}, a.RFC_2822 = function() {};
    var Oe = x("moment().min is deprecated, use moment.max instead. http://momentjs.com/guides/#/warnings/min-max/", function() {
            var a = tb.apply(null, arguments);
            return this.isValid() && a.isValid() ? this > a ? this : a : p()
        }),
        Pe = x("moment().max is deprecated, use moment.min instead. http://momentjs.com/guides/#/warnings/min-max/", function() {
            var a = tb.apply(null, arguments);
            return this.isValid() && a.isValid() ? a > this ? this : a : p()
        }),
        Qe = function() {
            return Date.now ? Date.now() : +new Date
        },
        Re = ["year", "quarter", "month", "week", "day", "hour", "minute", "second", "millisecond"];
    Db("Z", ":"), Db("ZZ", ""), Z("Z", _d), Z("ZZ", _d), ba(["Z", "ZZ"], function(a, b, c) {
        c._useUTC = !0, c._tzm = Eb(_d, a)
    });
    var Se = /([\+\-]|\d\d)/gi;
    a.updateOffset = function() {};
    var Te = /^(\-)?(?:(\d*)[. ])?(\d+)\:(\d+)(?:\:(\d+)(\.\d*)?)?$/,
        Ue = /^(-)?P(?:(-?[0-9,.]*)Y)?(?:(-?[0-9,.]*)M)?(?:(-?[0-9,.]*)W)?(?:(-?[0-9,.]*)D)?(?:T(?:(-?[0-9,.]*)H)?(?:(-?[0-9,.]*)M)?(?:(-?[0-9,.]*)S)?)?$/;
    Sb.fn = Ab.prototype, Sb.invalid = zb;
    var Ve = Wb(1, "add"),
        We = Wb(-1, "subtract");
    a.defaultFormat = "YYYY-MM-DDTHH:mm:ssZ", a.defaultFormatUtc = "YYYY-MM-DDTHH:mm:ss[Z]";
    var Xe = x("moment().lang() is deprecated. Instead, use moment().localeData() to get the language configuration. Use moment().locale() to change languages.", function(a) {
        return void 0 === a ? this.localeData() : this.locale(a)
    });
    U(0, ["gg", 2], 0, function() {
        return this.weekYear() % 100
    }), U(0, ["GG", 2], 0, function() {
        return this.isoWeekYear() % 100
    }), Dc("gggg", "weekYear"), Dc("ggggg", "weekYear"), Dc("GGGG", "isoWeekYear"), Dc("GGGGG", "isoWeekYear"), J("weekYear", "gg"), J("isoWeekYear", "GG"), M("weekYear", 1), M("isoWeekYear", 1), Z("G", Zd), Z("g", Zd), Z("GG", Sd, Od), Z("gg", Sd, Od), Z("GGGG", Wd, Qd), Z("gggg", Wd, Qd), Z("GGGGG", Xd, Rd), Z("ggggg", Xd, Rd), ca(["gggg", "ggggg", "GGGG", "GGGGG"], function(a, b, c, d) {
        b[d.substr(0, 2)] = u(a)
    }), ca(["gg", "GG"], function(b, c, d, e) {
        c[e] = a.parseTwoDigitYear(b)
    }), U("Q", 0, "Qo", "quarter"), J("quarter", "Q"), M("quarter", 7), Z("Q", Nd), ba("Q", function(a, b) {
        b[fe] = 3 * (u(a) - 1)
    }), U("D", ["DD", 2], "Do", "date"), J("date", "D"), M("date", 9), Z("D", Sd), Z("DD", Sd, Od), Z("Do", function(a, b) {
        return a ? b._dayOfMonthOrdinalParse || b._ordinalParse : b._dayOfMonthOrdinalParseLenient
    }), ba(["D", "DD"], ge), ba("Do", function(a, b) {
        b[ge] = u(a.match(Sd)[0], 10)
    });
    var Ye = O("Date", !0);
    U("DDD", ["DDDD", 3], "DDDo", "dayOfYear"), J("dayOfYear", "DDD"), M("dayOfYear", 4), Z("DDD", Vd), Z("DDDD", Pd), ba(["DDD", "DDDD"], function(a, b, c) {
        c._dayOfYear = u(a)
    }), U("m", ["mm", 2], 0, "minute"), J("minute", "m"), M("minute", 14), Z("m", Sd), Z("mm", Sd, Od), ba(["m", "mm"], ie);
    var Ze = O("Minutes", !1);
    U("s", ["ss", 2], 0, "second"), J("second", "s"), M("second", 15), Z("s", Sd), Z("ss", Sd, Od), ba(["s", "ss"], je);
    var $e = O("Seconds", !1);
    U("S", 0, 0, function() {
        return ~~(this.millisecond() / 100)
    }), U(0, ["SS", 2], 0, function() {
        return ~~(this.millisecond() / 10)
    }), U(0, ["SSS", 3], 0, "millisecond"), U(0, ["SSSS", 4], 0, function() {
        return 10 * this.millisecond()
    }), U(0, ["SSSSS", 5], 0, function() {
        return 100 * this.millisecond()
    }), U(0, ["SSSSSS", 6], 0, function() {
        return 1e3 * this.millisecond()
    }), U(0, ["SSSSSSS", 7], 0, function() {
        return 1e4 * this.millisecond()
    }), U(0, ["SSSSSSSS", 8], 0, function() {
        return 1e5 * this.millisecond()
    }), U(0, ["SSSSSSSSS", 9], 0, function() {
        return 1e6 * this.millisecond()
    }), J("millisecond", "ms"), M("millisecond", 16), Z("S", Vd, Nd), Z("SS", Vd, Od), Z("SSS", Vd, Pd);
    var _e;
    for (_e = "SSSS"; _e.length <= 9; _e += "S") Z(_e, Yd);
    for (_e = "S"; _e.length <= 9; _e += "S") ba(_e, Mc);
    var af = O("Milliseconds", !1);
    U("z", 0, 0, "zoneAbbr"), U("zz", 0, 0, "zoneName");
    var bf = r.prototype;
    bf.add = Ve, bf.calendar = Zb, bf.clone = $b, bf.diff = fc, bf.endOf = sc, bf.format = kc, bf.from = lc, bf.fromNow = mc, bf.to = nc, bf.toNow = oc, bf.get = R, bf.invalidAt = Bc, bf.isAfter = _b, bf.isBefore = ac, bf.isBetween = bc, bf.isSame = cc, bf.isSameOrAfter = dc, bf.isSameOrBefore = ec, bf.isValid = zc, bf.lang = Xe, bf.locale = pc, bf.localeData = qc, bf.max = Pe, bf.min = Oe, bf.parsingFlags = Ac, bf.set = S, bf.startOf = rc, bf.subtract = We, bf.toArray = wc, bf.toObject = xc, bf.toDate = vc, bf.toISOString = ic, bf.inspect = jc, bf.toJSON = yc, bf.toString = hc, bf.unix = uc, bf.valueOf = tc, bf.creationData = Cc, bf.year = te, bf.isLeapYear = ra, bf.weekYear = Ec, bf.isoWeekYear = Fc, bf.quarter = bf.quarters = Kc, bf.month = ka, bf.daysInMonth = la, bf.week = bf.weeks = Ba, bf.isoWeek = bf.isoWeeks = Ca, bf.weeksInYear = Hc, bf.isoWeeksInYear = Gc, bf.date = Ye, bf.day = bf.days = Ka, bf.weekday = La, bf.isoWeekday = Ma, bf.dayOfYear = Lc, bf.hour = bf.hours = De, bf.minute = bf.minutes = Ze, bf.second = bf.seconds = $e, bf.millisecond = bf.milliseconds = af, bf.utcOffset = Hb, bf.utc = Jb, bf.local = Kb, bf.parseZone = Lb, bf.hasAlignedHourOffset = Mb, bf.isDST = Nb, bf.isLocal = Pb, bf.isUtcOffset = Qb, bf.isUtc = Rb, bf.isUTC = Rb, bf.zoneAbbr = Nc, bf.zoneName = Oc, bf.dates = x("dates accessor is deprecated. Use date instead.", Ye), bf.months = x("months accessor is deprecated. Use month instead", ka), bf.years = x("years accessor is deprecated. Use year instead", te), bf.zone = x("moment().zone is deprecated, use moment().utcOffset instead. http://momentjs.com/guides/#/warnings/zone/", Ib), bf.isDSTShifted = x("isDSTShifted is deprecated. See http://momentjs.com/guides/#/warnings/dst-shifted/ for more information", Ob);
    var cf = C.prototype;
    cf.calendar = D, cf.longDateFormat = E, cf.invalidDate = F, cf.ordinal = G, cf.preparse = Rc, cf.postformat = Rc, cf.relativeTime = H, cf.pastFuture = I, cf.set = A, cf.months = fa, cf.monthsShort = ga, cf.monthsParse = ia, cf.monthsRegex = na, cf.monthsShortRegex = ma, cf.week = ya, cf.firstDayOfYear = Aa, cf.firstDayOfWeek = za, cf.weekdays = Fa, cf.weekdaysMin = Ha, cf.weekdaysShort = Ga, cf.weekdaysParse = Ja, cf.weekdaysRegex = Na, cf.weekdaysShortRegex = Oa, cf.weekdaysMinRegex = Pa, cf.isPM = Va, cf.meridiem = Wa, $a("en", {
        dayOfMonthOrdinalParse: /\d{1,2}(th|st|nd|rd)/,
        ordinal: function(a) {
            var b = a % 10,
                c = 1 === u(a % 100 / 10) ? "th" : 1 === b ? "st" : 2 === b ? "nd" : 3 === b ? "rd" : "th";
            return a + c
        }
    }), a.lang = x("moment.lang is deprecated. Use moment.locale instead.", $a), a.langData = x("moment.langData is deprecated. Use moment.localeData instead.", bb);
    var df = Math.abs,
        ef = id("ms"),
        ff = id("s"),
        gf = id("m"),
        hf = id("h"),
        jf = id("d"),
        kf = id("w"),
        lf = id("M"),
        mf = id("y"),
        nf = kd("milliseconds"),
        of = kd("seconds"),
        pf = kd("minutes"),
        qf = kd("hours"),
        rf = kd("days"),
        sf = kd("months"),
        tf = kd("years"),
        uf = Math.round,
        vf = {
            ss: 44,
            s: 45,
            m: 45,
            h: 22,
            d: 26,
            M: 11
        },
        wf = Math.abs,
        xf = Ab.prototype;
    return xf.isValid = yb, xf.abs = $c, xf.add = ad, xf.subtract = bd, xf.as = gd, xf.asMilliseconds = ef, xf.asSeconds = ff, xf.asMinutes = gf, xf.asHours = hf, xf.asDays = jf, xf.asWeeks = kf, xf.asMonths = lf, xf.asYears = mf, xf.valueOf = hd, xf._bubble = dd, xf.get = jd, xf.milliseconds = nf, xf.seconds = of, xf.minutes = pf, xf.hours = qf, xf.days = rf, xf.weeks = ld, xf.months = sf, xf.years = tf, xf.humanize = qd, xf.toISOString = rd, xf.toString = rd, xf.toJSON = rd, xf.locale = pc, xf.localeData = qc, xf.toIsoString = x("toIsoString() is deprecated. Please use toISOString() instead (notice the capitals)", rd), xf.lang = Xe, U("X", 0, 0, "unix"), U("x", 0, 0, "valueOf"), Z("x", Zd), Z("X", ae), ba("X", function(a, b, c) {
        c._d = new Date(1e3 * parseFloat(a, 10))
    }), ba("x", function(a, b, c) {
        c._d = new Date(u(a))
    }), a.version = "2.18.1", b(tb), a.fn = bf, a.min = vb, a.max = wb, a.now = Qe, a.utc = l, a.unix = Pc, a.months = Vc, a.isDate = h, a.locale = $a, a.invalid = p, a.duration = Sb, a.isMoment = s, a.weekdays = Xc, a.parseZone = Qc, a.localeData = bb, a.isDuration = Bb, a.monthsShort = Wc, a.weekdaysMin = Zc, a.defineLocale = _a, a.updateLocale = ab, a.locales = cb, a.weekdaysShort = Yc, a.normalizeUnits = K, a.relativeTimeRounding = od, a.relativeTimeThreshold = pd, a.calendarFormat = Yb, a.prototype = bf, a
}), ! function(a, b) {
    "use strict";
    "function" == typeof define && define.amd ? define(["moment"], b) : "object" == typeof module && module.exports ? module.exports = b(require("moment")) : b(a.moment)
}(this, function(a) {
    "use strict";

    function b(a) {
        return a > 96 ? a - 87 : a > 64 ? a - 29 : a - 48
    }

    function c(a) {
        var c, d = 0,
            e = a.split("."),
            f = e[0],
            g = e[1] || "",
            h = 1,
            i = 0,
            j = 1;
        for (45 === a.charCodeAt(0) && (d = 1, j = -1), d; d < f.length; d++) c = b(f.charCodeAt(d)), i = 60 * i + c;
        for (d = 0; d < g.length; d++) h /= 60, c = b(g.charCodeAt(d)), i += c * h;
        return i * j
    }

    function d(a) {
        for (var b = 0; b < a.length; b++) a[b] = c(a[b])
    }

    function e(a, b) {
        for (var c = 0; b > c; c++) a[c] = Math.round((a[c - 1] || 0) + 6e4 * a[c]);
        a[b - 1] = 1 / 0
    }

    function f(a, b) {
        var c, d = [];
        for (c = 0; c < b.length; c++) d[c] = a[b[c]];
        return d
    }

    function g(a) {
        var b = a.split("|"),
            c = b[2].split(" "),
            g = b[3].split(""),
            h = b[4].split(" ");
        return d(c), d(g), d(h), e(h, g.length), {
            name: b[0],
            abbrs: f(b[1].split(" "), g),
            offsets: f(c, g),
            untils: h,
            population: 0 | b[5]
        }
    }

    function h(a) {
        a && this._set(g(a))
    }

    function i(a) {
        var b = a.toTimeString(),
            c = b.match(/\([a-z ]+\)/i);
        c && c[0] ? (c = c[0].match(/[A-Z]/g), c = c ? c.join("") : void 0) : (c = b.match(/[A-Z]{3,5}/g), c = c ? c[0] : void 0), "GMT" === c && (c = void 0), this.at = +a, this.abbr = c, this.offset = a.getTimezoneOffset()
    }

    function j(a) {
        this.zone = a, this.offsetScore = 0, this.abbrScore = 0
    }

    function k(a, b) {
        for (var c, d; d = 6e4 * ((b.at - a.at) / 12e4 | 0);) c = new i(new Date(a.at + d)), c.offset === a.offset ? a = c : b = c;
        return a
    }

    function l() {
        var a, b, c, d = (new Date).getFullYear() - 2,
            e = new i(new Date(d, 0, 1)),
            f = [e];
        for (c = 1; 48 > c; c++) b = new i(new Date(d, c, 1)), b.offset !== e.offset && (a = k(e, b), f.push(a), f.push(new i(new Date(a.at + 6e4)))), e = b;
        for (c = 0; 4 > c; c++) f.push(new i(new Date(d + c, 0, 1))), f.push(new i(new Date(d + c, 6, 1)));
        return f
    }

    function m(a, b) {
        return a.offsetScore !== b.offsetScore ? a.offsetScore - b.offsetScore : a.abbrScore !== b.abbrScore ? a.abbrScore - b.abbrScore : b.zone.population - a.zone.population
    }

    function n(a, b) {
        var c, e;
        for (d(b), c = 0; c < b.length; c++) e = b[c], I[e] = I[e] || {}, I[e][a] = !0
    }

    function o(a) {
        var b, c, d, e = a.length,
            f = {},
            g = [];
        for (b = 0; e > b; b++) {
            d = I[a[b].offset] || {};
            for (c in d) d.hasOwnProperty(c) && (f[c] = !0)
        }
        for (b in f) f.hasOwnProperty(b) && g.push(H[b]);
        return g
    }

    function p() {
        try {
            var a = Intl.DateTimeFormat().resolvedOptions().timeZone;
            if (a) {
                var b = H[r(a)];
                if (b) return b;
                z("Moment Timezone found " + a + " from the Intl api, but did not have that data loaded.")
            }
        } catch (c) {}
        var d, e, f, g = l(),
            h = g.length,
            i = o(g),
            k = [];
        for (e = 0; e < i.length; e++) {
            for (d = new j(t(i[e]), h), f = 0; h > f; f++) d.scoreOffsetAt(g[f]);
            k.push(d)
        }
        return k.sort(m), k.length > 0 ? k[0].zone.name : void 0
    }

    function q(a) {
        return D && !a || (D = p()), D
    }

    function r(a) {
        return (a || "").toLowerCase().replace(/\//g, "_")
    }

    function s(a) {
        var b, c, d, e;
        for ("string" == typeof a && (a = [a]), b = 0; b < a.length; b++) d = a[b].split("|"), c = d[0], e = r(c), F[e] = a[b], H[e] = c, d[5] && n(e, d[2].split(" "))
    }

    function t(a, b) {
        a = r(a);
        var c, d = F[a];
        return d instanceof h ? d : "string" == typeof d ? (d = new h(d), F[a] = d, d) : G[a] && b !== t && (c = t(G[a], t)) ? (d = F[a] = new h, d._set(c), d.name = H[a], d) : null
    }

    function u() {
        var a, b = [];
        for (a in H) H.hasOwnProperty(a) && (F[a] || F[G[a]]) && H[a] && b.push(H[a]);
        return b.sort()
    }

    function v(a) {
        var b, c, d, e;
        for ("string" == typeof a && (a = [a]), b = 0; b < a.length; b++) c = a[b].split("|"), d = r(c[0]), e = r(c[1]), G[d] = e, H[d] = c[0], G[e] = d, H[e] = c[1]
    }

    function w(a) {
        s(a.zones), v(a.links), A.dataVersion = a.version
    }

    function x(a) {
        return x.didShowError || (x.didShowError = !0, z("moment.tz.zoneExists('" + a + "') has been deprecated in favor of !moment.tz.zone('" + a + "')")), !!t(a)
    }

    function y(a) {
        return !(!a._a || void 0 !== a._tzm)
    }

    function z(a) {
        "undefined" != typeof console && "function" == typeof console.error && console.error(a)
    }

    function A(b) {
        var c = Array.prototype.slice.call(arguments, 0, -1),
            d = arguments[arguments.length - 1],
            e = t(d),
            f = a.utc.apply(null, c);
        return e && !a.isMoment(b) && y(f) && f.add(e.parse(f), "minutes"), f.tz(d), f
    }

    function B(a) {
        return function() {
            return this._z ? this._z.abbr(this) : a.call(this)
        }
    }

    function C(a) {
        return function() {
            return this._z = null, a.apply(this, arguments)
        }
    }
    var D, E = "0.5.13",
        F = {},
        G = {},
        H = {},
        I = {},
        J = a.version.split("."),
        K = +J[0],
        L = +J[1];
    (2 > K || 2 === K && 6 > L) && z("Moment Timezone requires Moment.js >= 2.6.0. You are using Moment.js " + a.version + ". See momentjs.com"), h.prototype = {
        _set: function(a) {
            this.name = a.name, this.abbrs = a.abbrs, this.untils = a.untils, this.offsets = a.offsets, this.population = a.population
        },
        _index: function(a) {
            var b, c = +a,
                d = this.untils;
            for (b = 0; b < d.length; b++)
                if (c < d[b]) return b
        },
        parse: function(a) {
            var b, c, d, e, f = +a,
                g = this.offsets,
                h = this.untils,
                i = h.length - 1;
            for (e = 0; i > e; e++)
                if (b = g[e], c = g[e + 1], d = g[e ? e - 1 : e], c > b && A.moveAmbiguousForward ? b = c : b > d && A.moveInvalidForward && (b = d), f < h[e] - 6e4 * b) return g[e];
            return g[i]
        },
        abbr: function(a) {
            return this.abbrs[this._index(a)]
        },
        offset: function(a) {
            return this.offsets[this._index(a)]
        }
    }, j.prototype.scoreOffsetAt = function(a) {
        this.offsetScore += Math.abs(this.zone.offset(a.at) - a.offset), this.zone.abbr(a.at).replace(/[^A-Z]/g, "") !== a.abbr && this.abbrScore++
    }, A.version = E, A.dataVersion = "", A._zones = F, A._links = G, A._names = H, A.add = s, A.link = v, A.load = w, A.zone = t, A.zoneExists = x, A.guess = q, A.names = u, A.Zone = h, A.unpack = g, A.unpackBase60 = c, A.needsOffset = y, A.moveInvalidForward = !0, A.moveAmbiguousForward = !1;
    var M = a.fn;
    a.tz = A, a.defaultZone = null, a.updateOffset = function(b, c) {
        var d, e = a.defaultZone;
        void 0 === b._z && (e && y(b) && !b._isUTC && (b._d = a.utc(b._a)._d, b.utc().add(e.parse(b), "minutes")), b._z = e), b._z && (d = b._z.offset(b), Math.abs(d) < 16 && (d /= 60), void 0 !== b.utcOffset ? b.utcOffset(-d, c) : b.zone(d, c))
    }, M.tz = function(b) {
        return b ? (this._z = t(b), this._z ? a.updateOffset(this) : z("Moment Timezone has no data for " + b + ". See http://momentjs.com/timezone/docs/#/data-loading/."), this) : this._z ? this._z.name : void 0
    }, M.zoneName = B(M.zoneName), M.zoneAbbr = B(M.zoneAbbr), M.utc = C(M.utc), a.tz.setDefault = function(b) {
        return (2 > K || 2 === K && 9 > L) && z("Moment Timezone setDefault() requires Moment.js >= 2.9.0. You are using Moment.js " + a.version + "."), a.defaultZone = b ? t(b) : null, a
    };
    var N = a.momentProperties;
    return "[object Array]" === Object.prototype.toString.call(N) ? (N.push("_z"), N.push("_a")) : N && (N._z = null), w({
        version: "2017b",
        zones: ["Africa/Abidjan|GMT|0|0||48e5", "Africa/Khartoum|EAT|-30|0||51e5", "Africa/Algiers|CET|-10|0||26e5", "Africa/Lagos|WAT|-10|0||17e6", "Africa/Maputo|CAT|-20|0||26e5", "Africa/Cairo|EET EEST|-20 -30|01010|1M2m0 gL0 e10 mn0|15e6", "Africa/Casablanca|WET WEST|0 -10|0101010101010101010101010101010101010101010|1H3C0 wM0 co0 go0 1o00 s00 dA0 vc0 11A0 A00 e00 y00 11A0 uM0 e00 Dc0 11A0 s00 e00 IM0 WM0 mo0 gM0 LA0 WM0 jA0 e00 Rc0 11A0 e00 e00 U00 11A0 8o0 e00 11A0 11A0 5A0 e00 17c0 1fA0 1a00|32e5", "Europe/Paris|CET CEST|-10 -20|01010101010101010101010|1GNB0 1qM0 11A0 1o00 11A0 1o00 11A0 1o00 11A0 1qM0 WM0 1qM0 WM0 1qM0 11A0 1o00 11A0 1o00 11A0 1qM0 WM0 1qM0|11e6", "Africa/Johannesburg|SAST|-20|0||84e5", "Africa/Tripoli|EET CET CEST|-20 -10 -20|0120|1IlA0 TA0 1o00|11e5", "Africa/Windhoek|WAST WAT|-20 -10|01010101010101010101010|1GQo0 11B0 1qL0 WN0 1qL0 11B0 1nX0 11B0 1nX0 11B0 1nX0 11B0 1nX0 11B0 1qL0 WN0 1qL0 11B0 1nX0 11B0 1nX0 11B0|32e4", "America/Adak|HST HDT|a0 90|01010101010101010101010|1GIc0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Rd0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Rd0 1zb0 Op0 1zb0|326", "America/Anchorage|AKST AKDT|90 80|01010101010101010101010|1GIb0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Rd0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Rd0 1zb0 Op0 1zb0|30e4", "America/Santo_Domingo|AST|40|0||29e5", "America/Araguaina|-03 -02|30 20|010|1IdD0 Lz0|14e4", "America/Fortaleza|-03|30|0||34e5", "America/Asuncion|-03 -04|30 40|01010101010101010101010|1GTf0 1cN0 17b0 1ip0 17b0 1ip0 17b0 1ip0 19X0 1fB0 19X0 1fB0 19X0 1ip0 17b0 1ip0 17b0 1ip0 19X0 1fB0 19X0 1fB0|28e5", "America/Panama|EST|50|0||15e5", "America/Bahia|-02 -03|20 30|01|1GCq0|27e5", "America/Mexico_City|CST CDT|60 50|01010101010101010101010|1GQw0 1nX0 14p0 1lb0 14p0 1lb0 14p0 1lb0 14p0 1nX0 11B0 1nX0 11B0 1nX0 14p0 1lb0 14p0 1lb0 14p0 1nX0 11B0 1nX0|20e6", "America/Managua|CST|60|0||22e5", "America/La_Paz|-04|40|0||19e5", "America/Lima|-05|50|0||11e6", "America/Denver|MST MDT|70 60|01010101010101010101010|1GI90 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Rd0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Rd0 1zb0 Op0 1zb0|26e5", "America/Campo_Grande|-03 -04|30 40|01010101010101010101010|1GCr0 1zd0 Lz0 1C10 Lz0 1C10 On0 1zd0 On0 1zd0 On0 1zd0 On0 1C10 Lz0 1C10 Lz0 1C10 On0 1zd0 On0 1zd0|77e4", "America/Cancun|CST CDT EST|60 50 50|01010102|1GQw0 1nX0 14p0 1lb0 14p0 1lb0 Dd0|63e4", "America/Caracas|-0430 -04|4u 40|01|1QMT0|29e5", "America/Chicago|CST CDT|60 50|01010101010101010101010|1GI80 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Rd0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Rd0 1zb0 Op0 1zb0|92e5", "America/Chihuahua|MST MDT|70 60|01010101010101010101010|1GQx0 1nX0 14p0 1lb0 14p0 1lb0 14p0 1lb0 14p0 1nX0 11B0 1nX0 11B0 1nX0 14p0 1lb0 14p0 1lb0 14p0 1nX0 11B0 1nX0|81e4", "America/Phoenix|MST|70|0||42e5", "America/Los_Angeles|PST PDT|80 70|01010101010101010101010|1GIa0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Rd0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Rd0 1zb0 Op0 1zb0|15e6", "America/New_York|EST EDT|50 40|01010101010101010101010|1GI70 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Rd0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Rd0 1zb0 Op0 1zb0|21e6", "America/Rio_Branco|-04 -05|40 50|01|1KLE0|31e4", "America/Fort_Nelson|PST PDT MST|80 70 70|01010102|1GIa0 1zb0 Op0 1zb0 Op0 1zb0 Op0|39e2", "America/Halifax|AST ADT|40 30|01010101010101010101010|1GI60 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Rd0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Rd0 1zb0 Op0 1zb0|39e4", "America/Godthab|-03 -02|30 20|01010101010101010101010|1GNB0 1qM0 11A0 1o00 11A0 1o00 11A0 1o00 11A0 1qM0 WM0 1qM0 WM0 1qM0 11A0 1o00 11A0 1o00 11A0 1qM0 WM0 1qM0|17e3", "America/Grand_Turk|EST EDT AST|50 40 40|010101012|1GI70 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0|37e2", "America/Havana|CST CDT|50 40|01010101010101010101010|1GQt0 1qM0 Oo0 1zc0 Oo0 1zc0 Oo0 1zc0 Rc0 1zc0 Oo0 1zc0 Oo0 1zc0 Oo0 1zc0 Oo0 1zc0 Rc0 1zc0 Oo0 1zc0|21e5", "America/Metlakatla|PST AKST AKDT|80 90 80|0121212121212121|1PAa0 Rd0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Rd0 1zb0 Op0 1zb0|14e2", "America/Miquelon|-03 -02|30 20|01010101010101010101010|1GI50 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Rd0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Rd0 1zb0 Op0 1zb0|61e2", "America/Montevideo|-02 -03|20 30|01010101|1GI40 1o10 11z0 1o10 11z0 1o10 11z0|17e5", "America/Noronha|-02|20|0||30e2", "America/Port-au-Prince|EST EDT|50 40|010101010101010101010|1GI70 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 3iN0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Rd0 1zb0 Op0 1zb0|23e5", "Antarctica/Palmer|-03 -04|30 40|010101010|1H3D0 Op0 1zb0 Rd0 1wn0 Rd0 46n0 Ap0|40", "America/Santiago|-03 -04|30 40|010101010101010101010|1H3D0 Op0 1zb0 Rd0 1wn0 Rd0 46n0 Ap0 1Nb0 Ap0 1Nb0 Ap0 1Nb0 Ap0 1Nb0 Ap0 1Nb0 Dd0 1Nb0 Ap0|62e5", "America/Sao_Paulo|-02 -03|20 30|01010101010101010101010|1GCq0 1zd0 Lz0 1C10 Lz0 1C10 On0 1zd0 On0 1zd0 On0 1zd0 On0 1C10 Lz0 1C10 Lz0 1C10 On0 1zd0 On0 1zd0|20e6", "Atlantic/Azores|-01 +00|10 0|01010101010101010101010|1GNB0 1qM0 11A0 1o00 11A0 1o00 11A0 1o00 11A0 1qM0 WM0 1qM0 WM0 1qM0 11A0 1o00 11A0 1o00 11A0 1qM0 WM0 1qM0|25e4", "America/St_Johns|NST NDT|3u 2u|01010101010101010101010|1GI5u 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Rd0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Rd0 1zb0 Op0 1zb0|11e4", "Antarctica/Casey|+11 +08|-b0 -80|010|1GAF0 blz0|10", "Antarctica/Davis|+05 +07|-50 -70|01|1GAI0|70", "Pacific/Port_Moresby|+10|-a0|0||25e4", "Pacific/Guadalcanal|+11|-b0|0||11e4", "Asia/Tashkent|+05|-50|0||23e5", "Pacific/Auckland|NZDT NZST|-d0 -c0|01010101010101010101010|1GQe0 1cM0 1fA0 1a00 1fA0 1a00 1fA0 1a00 1fA0 1a00 1fA0 1a00 1fA0 1cM0 1fA0 1a00 1fA0 1a00 1fA0 1a00 1fA0 1a00|14e5", "Asia/Baghdad|+03|-30|0||66e5", "Antarctica/Troll|+00 +02|0 -20|01010101010101010101010|1GNB0 1qM0 11A0 1o00 11A0 1o00 11A0 1o00 11A0 1qM0 WM0 1qM0 WM0 1qM0 11A0 1o00 11A0 1o00 11A0 1qM0 WM0 1qM0|40", "Asia/Dhaka|+06|-60|0||16e6", "Asia/Amman|EET EEST|-20 -30|010101010101010101010|1GPy0 4bX0 Dd0 1qM0 WM0 1qM0 11A0 1o00 11A0 1o00 11A0 1o00 11A0 1o00 11A0 1qM0 WM0 1qM0 11A0 1o00|25e5", "Asia/Kamchatka|+12|-c0|0||18e4", "Asia/Baku|+04 +05|-40 -50|010101010|1GNA0 1qM0 11A0 1o00 11A0 1o00 11A0 1o00|27e5", "Asia/Bangkok|+07|-70|0||15e6", "Asia/Barnaul|+07 +06|-70 -60|010|1N7v0 3rd0", "Asia/Beirut|EET EEST|-20 -30|01010101010101010101010|1GNy0 1qL0 11B0 1nX0 11B0 1nX0 11B0 1nX0 11B0 1qL0 WN0 1qL0 WN0 1qL0 11B0 1nX0 11B0 1nX0 11B0 1qL0 WN0 1qL0|22e5", "Asia/Manila|+08|-80|0||24e6", "Asia/Kolkata|IST|-5u|0||15e6", "Asia/Chita|+10 +08 +09|-a0 -80 -90|012|1N7s0 3re0|33e4", "Asia/Ulaanbaatar|+08 +09|-80 -90|01010|1O8G0 1cJ0 1cP0 1cJ0|12e5", "Asia/Shanghai|CST|-80|0||23e6", "Asia/Colombo|+0530|-5u|0||22e5", "Asia/Damascus|EET EEST|-20 -30|01010101010101010101010|1GPy0 1nX0 11B0 1nX0 11B0 1qL0 WN0 1qL0 WN0 1qL0 11B0 1nX0 11B0 1nX0 11B0 1nX0 11B0 1qL0 WN0 1qL0 WN0 1qL0|26e5", "Asia/Dili|+09|-90|0||19e4", "Asia/Dubai|+04|-40|0||39e5", "Asia/Famagusta|EET EEST +03|-20 -30 -30|01010101012|1GNB0 1qM0 11A0 1o00 11A0 1o00 11A0 1o00 11A0 15U0", "Asia/Gaza|EET EEST|-20 -30|01010101010101010101010|1GPy0 1a00 1fA0 1cL0 1cN0 1nX0 1210 1nz0 1220 1qL0 WN0 1qL0 11B0 1nX0 11B0 1nX0 11B0 1qL0 WN0 1qL0 WN0 1qL0|18e5", "Asia/Hong_Kong|HKT|-80|0||73e5", "Asia/Hovd|+07 +08|-70 -80|01010|1O8H0 1cJ0 1cP0 1cJ0|81e3", "Asia/Irkutsk|+09 +08|-90 -80|01|1N7t0|60e4", "Europe/Istanbul|EET EEST +03|-20 -30 -30|01010101012|1GNB0 1qM0 11A0 1o00 1200 1nA0 11A0 1tA0 U00 15w0|13e6", "Asia/Jakarta|WIB|-70|0||31e6", "Asia/Jayapura|WIT|-90|0||26e4", "Asia/Jerusalem|IST IDT|-20 -30|01010101010101010101010|1GPA0 1aL0 1eN0 1oL0 10N0 1oL0 10N0 1oL0 10N0 1rz0 W10 1rz0 W10 1rz0 10N0 1oL0 10N0 1oL0 10N0 1rz0 W10 1rz0|81e4", "Asia/Kabul|+0430|-4u|0||46e5", "Asia/Karachi|PKT|-50|0||24e6", "Asia/Kathmandu|+0545|-5J|0||12e5", "Asia/Yakutsk|+10 +09|-a0 -90|01|1N7s0|28e4", "Asia/Krasnoyarsk|+08 +07|-80 -70|01|1N7u0|10e5", "Asia/Magadan|+12 +10 +11|-c0 -a0 -b0|012|1N7q0 3Cq0|95e3", "Asia/Makassar|WITA|-80|0||15e5", "Europe/Athens|EET EEST|-20 -30|01010101010101010101010|1GNB0 1qM0 11A0 1o00 11A0 1o00 11A0 1o00 11A0 1qM0 WM0 1qM0 WM0 1qM0 11A0 1o00 11A0 1o00 11A0 1qM0 WM0 1qM0|35e5", "Asia/Novosibirsk|+07 +06|-70 -60|010|1N7v0 4eN0|15e5", "Asia/Omsk|+07 +06|-70 -60|01|1N7v0|12e5", "Asia/Pyongyang|KST KST|-90 -8u|01|1P4D0|29e5", "Asia/Rangoon|+0630|-6u|0||48e5", "Asia/Sakhalin|+11 +10|-b0 -a0|010|1N7r0 3rd0|58e4", "Asia/Seoul|KST|-90|0||23e6", "Asia/Srednekolymsk|+12 +11|-c0 -b0|01|1N7q0|35e2", "Asia/Tehran|+0330 +0430|-3u -4u|01010101010101010101010|1GLUu 1dz0 1cN0 1dz0 1cp0 1dz0 1cp0 1dz0 1cp0 1dz0 1cN0 1dz0 1cp0 1dz0 1cp0 1dz0 1cp0 1dz0 1cN0 1dz0 1cp0 1dz0|14e6", "Asia/Tokyo|JST|-90|0||38e6", "Asia/Tomsk|+07 +06|-70 -60|010|1N7v0 3Qp0|10e5", "Asia/Vladivostok|+11 +10|-b0 -a0|01|1N7r0|60e4", "Asia/Yekaterinburg|+06 +05|-60 -50|01|1N7w0|14e5", "Europe/Lisbon|WET WEST|0 -10|01010101010101010101010|1GNB0 1qM0 11A0 1o00 11A0 1o00 11A0 1o00 11A0 1qM0 WM0 1qM0 WM0 1qM0 11A0 1o00 11A0 1o00 11A0 1qM0 WM0 1qM0|27e5", "Atlantic/Cape_Verde|-01|10|0||50e4", "Australia/Sydney|AEDT AEST|-b0 -a0|01010101010101010101010|1GQg0 1fA0 1cM0 1cM0 1cM0 1cM0 1cM0 1cM0 1cM0 1cM0 1cM0 1cM0 1cM0 1fA0 1cM0 1cM0 1cM0 1cM0 1cM0 1cM0 1cM0 1cM0|40e5", "Australia/Adelaide|ACDT ACST|-au -9u|01010101010101010101010|1GQgu 1fA0 1cM0 1cM0 1cM0 1cM0 1cM0 1cM0 1cM0 1cM0 1cM0 1cM0 1cM0 1fA0 1cM0 1cM0 1cM0 1cM0 1cM0 1cM0 1cM0 1cM0|11e5", "Australia/Brisbane|AEST|-a0|0||20e5", "Australia/Darwin|ACST|-9u|0||12e4", "Australia/Eucla|+0845|-8J|0||368", "Australia/Lord_Howe|+11 +1030|-b0 -au|01010101010101010101010|1GQf0 1fAu 1cLu 1cMu 1cLu 1cMu 1cLu 1cMu 1cLu 1cMu 1cLu 1cMu 1cLu 1fAu 1cLu 1cMu 1cLu 1cMu 1cLu 1cMu 1cLu 1cMu|347", "Australia/Perth|AWST|-80|0||18e5", "Pacific/Easter|-05 -06|50 60|010101010101010101010|1H3D0 Op0 1zb0 Rd0 1wn0 Rd0 46n0 Ap0 1Nb0 Ap0 1Nb0 Ap0 1Nb0 Ap0 1Nb0 Ap0 1Nb0 Dd0 1Nb0 Ap0|30e2", "Europe/Dublin|GMT IST|0 -10|01010101010101010101010|1GNB0 1qM0 11A0 1o00 11A0 1o00 11A0 1o00 11A0 1qM0 WM0 1qM0 WM0 1qM0 11A0 1o00 11A0 1o00 11A0 1qM0 WM0 1qM0|12e5", "Pacific/Tahiti|-10|a0|0||18e4", "Pacific/Niue|-11|b0|0||12e2", "Etc/GMT+12|-12|c0|0|", "Pacific/Galapagos|-06|60|0||25e3", "Etc/GMT+7|-07|70|0|", "Pacific/Pitcairn|-08|80|0||56", "Pacific/Gambier|-09|90|0||125", "Etc/GMT-1|+01|-10|0|", "Pacific/Fakaofo|+13|-d0|0||483", "Pacific/Kiritimati|+14|-e0|0||51e2", "Etc/GMT-2|+02|-20|0|", "Etc/UCT|UCT|0|0|", "Etc/UTC|UTC|0|0|", "Europe/Astrakhan|+04 +03|-40 -30|010|1N7y0 3rd0", "Europe/London|GMT BST|0 -10|01010101010101010101010|1GNB0 1qM0 11A0 1o00 11A0 1o00 11A0 1o00 11A0 1qM0 WM0 1qM0 WM0 1qM0 11A0 1o00 11A0 1o00 11A0 1qM0 WM0 1qM0|10e6", "Europe/Chisinau|EET EEST|-20 -30|01010101010101010101010|1GNA0 1qM0 11A0 1o00 11A0 1o00 11A0 1o00 11A0 1qM0 WM0 1qM0 WM0 1qM0 11A0 1o00 11A0 1o00 11A0 1qM0 WM0 1qM0|67e4", "Europe/Kaliningrad|+03 EET|-30 -20|01|1N7z0|44e4", "Europe/Volgograd|+04 +03|-40 -30|01|1N7y0|10e5", "Europe/Moscow|MSK MSK|-40 -30|01|1N7y0|16e6", "Europe/Saratov|+04 +03|-40 -30|010|1N7y0 5810", "Europe/Simferopol|EET EEST MSK MSK|-20 -30 -40 -30|0101023|1GNB0 1qM0 11A0 1o00 11z0 1nW0|33e4", "Pacific/Honolulu|HST|a0|0||37e4", "MET|MET MEST|-10 -20|01010101010101010101010|1GNB0 1qM0 11A0 1o00 11A0 1o00 11A0 1o00 11A0 1qM0 WM0 1qM0 WM0 1qM0 11A0 1o00 11A0 1o00 11A0 1qM0 WM0 1qM0", "Pacific/Chatham|+1345 +1245|-dJ -cJ|01010101010101010101010|1GQe0 1cM0 1fA0 1a00 1fA0 1a00 1fA0 1a00 1fA0 1a00 1fA0 1a00 1fA0 1cM0 1fA0 1a00 1fA0 1a00 1fA0 1a00 1fA0 1a00|600", "Pacific/Apia|+14 +13|-e0 -d0|01010101010101010101010|1GQe0 1cM0 1fA0 1a00 1fA0 1a00 1fA0 1a00 1fA0 1a00 1fA0 1a00 1fA0 1cM0 1fA0 1a00 1fA0 1a00 1fA0 1a00 1fA0 1a00|37e3", "Pacific/Bougainville|+10 +11|-a0 -b0|01|1NwE0|18e4", "Pacific/Fiji|+13 +12|-d0 -c0|01010101010101010101010|1Goe0 1Nc0 Ao0 1Q00 xz0 1SN0 uM0 1SM0 uM0 1VA0 s00 1VA0 uM0 1SM0 uM0 1SM0 uM0 1SM0 uM0 1VA0 s00 1VA0|88e4", "Pacific/Guam|ChST|-a0|0||17e4", "Pacific/Marquesas|-0930|9u|0||86e2", "Pacific/Pago_Pago|SST|b0|0||37e2", "Pacific/Norfolk|+1130 +11|-bu -b0|01|1PoCu|25e4", "Pacific/Tongatapu|+13 +14|-d0 -e0|01010101010101|1S4d0 s00 1VA0 uM0 1SM0 uM0 1SM0 uM0 1SM0 uM0 1VA0 s00 1VA0|75e3"],
        links: ["Africa/Abidjan|Africa/Accra", "Africa/Abidjan|Africa/Bamako", "Africa/Abidjan|Africa/Banjul", "Africa/Abidjan|Africa/Bissau", "Africa/Abidjan|Africa/Conakry", "Africa/Abidjan|Africa/Dakar", "Africa/Abidjan|Africa/Freetown", "Africa/Abidjan|Africa/Lome", "Africa/Abidjan|Africa/Monrovia", "Africa/Abidjan|Africa/Nouakchott", "Africa/Abidjan|Africa/Ouagadougou", "Africa/Abidjan|Africa/Sao_Tome", "Africa/Abidjan|Africa/Timbuktu", "Africa/Abidjan|America/Danmarkshavn", "Africa/Abidjan|Atlantic/Reykjavik", "Africa/Abidjan|Atlantic/St_Helena", "Africa/Abidjan|Etc/GMT", "Africa/Abidjan|Etc/GMT+0", "Africa/Abidjan|Etc/GMT-0", "Africa/Abidjan|Etc/GMT0", "Africa/Abidjan|Etc/Greenwich", "Africa/Abidjan|GMT", "Africa/Abidjan|GMT+0", "Africa/Abidjan|GMT-0", "Africa/Abidjan|GMT0", "Africa/Abidjan|Greenwich", "Africa/Abidjan|Iceland", "Africa/Algiers|Africa/Tunis", "Africa/Cairo|Egypt", "Africa/Casablanca|Africa/El_Aaiun", "Africa/Johannesburg|Africa/Maseru", "Africa/Johannesburg|Africa/Mbabane", "Africa/Khartoum|Africa/Addis_Ababa", "Africa/Khartoum|Africa/Asmara", "Africa/Khartoum|Africa/Asmera", "Africa/Khartoum|Africa/Dar_es_Salaam", "Africa/Khartoum|Africa/Djibouti", "Africa/Khartoum|Africa/Juba", "Africa/Khartoum|Africa/Kampala", "Africa/Khartoum|Africa/Mogadishu", "Africa/Khartoum|Africa/Nairobi", "Africa/Khartoum|Indian/Antananarivo", "Africa/Khartoum|Indian/Comoro", "Africa/Khartoum|Indian/Mayotte", "Africa/Lagos|Africa/Bangui", "Africa/Lagos|Africa/Brazzaville", "Africa/Lagos|Africa/Douala", "Africa/Lagos|Africa/Kinshasa", "Africa/Lagos|Africa/Libreville", "Africa/Lagos|Africa/Luanda", "Africa/Lagos|Africa/Malabo", "Africa/Lagos|Africa/Ndjamena", "Africa/Lagos|Africa/Niamey", "Africa/Lagos|Africa/Porto-Novo", "Africa/Maputo|Africa/Blantyre", "Africa/Maputo|Africa/Bujumbura", "Africa/Maputo|Africa/Gaborone", "Africa/Maputo|Africa/Harare", "Africa/Maputo|Africa/Kigali", "Africa/Maputo|Africa/Lubumbashi", "Africa/Maputo|Africa/Lusaka", "Africa/Tripoli|Libya", "America/Adak|America/Atka", "America/Adak|US/Aleutian", "America/Anchorage|America/Juneau", "America/Anchorage|America/Nome", "America/Anchorage|America/Sitka", "America/Anchorage|America/Yakutat", "America/Anchorage|US/Alaska", "America/Campo_Grande|America/Cuiaba", "America/Chicago|America/Indiana/Knox", "America/Chicago|America/Indiana/Tell_City", "America/Chicago|America/Knox_IN", "America/Chicago|America/Matamoros", "America/Chicago|America/Menominee", "America/Chicago|America/North_Dakota/Beulah", "America/Chicago|America/North_Dakota/Center", "America/Chicago|America/North_Dakota/New_Salem", "America/Chicago|America/Rainy_River", "America/Chicago|America/Rankin_Inlet", "America/Chicago|America/Resolute", "America/Chicago|America/Winnipeg", "America/Chicago|CST6CDT", "America/Chicago|Canada/Central", "America/Chicago|US/Central", "America/Chicago|US/Indiana-Starke", "America/Chihuahua|America/Mazatlan", "America/Chihuahua|Mexico/BajaSur", "America/Denver|America/Boise", "America/Denver|America/Cambridge_Bay", "America/Denver|America/Edmonton", "America/Denver|America/Inuvik", "America/Denver|America/Ojinaga", "America/Denver|America/Shiprock", "America/Denver|America/Yellowknife", "America/Denver|Canada/Mountain", "America/Denver|MST7MDT", "America/Denver|Navajo", "America/Denver|US/Mountain", "America/Fortaleza|America/Argentina/Buenos_Aires", "America/Fortaleza|America/Argentina/Catamarca", "America/Fortaleza|America/Argentina/ComodRivadavia", "America/Fortaleza|America/Argentina/Cordoba", "America/Fortaleza|America/Argentina/Jujuy", "America/Fortaleza|America/Argentina/La_Rioja", "America/Fortaleza|America/Argentina/Mendoza", "America/Fortaleza|America/Argentina/Rio_Gallegos", "America/Fortaleza|America/Argentina/Salta", "America/Fortaleza|America/Argentina/San_Juan", "America/Fortaleza|America/Argentina/San_Luis", "America/Fortaleza|America/Argentina/Tucuman", "America/Fortaleza|America/Argentina/Ushuaia", "America/Fortaleza|America/Belem", "America/Fortaleza|America/Buenos_Aires", "America/Fortaleza|America/Catamarca", "America/Fortaleza|America/Cayenne", "America/Fortaleza|America/Cordoba", "America/Fortaleza|America/Jujuy", "America/Fortaleza|America/Maceio", "America/Fortaleza|America/Mendoza", "America/Fortaleza|America/Paramaribo", "America/Fortaleza|America/Recife", "America/Fortaleza|America/Rosario", "America/Fortaleza|America/Santarem", "America/Fortaleza|Antarctica/Rothera", "America/Fortaleza|Atlantic/Stanley", "America/Fortaleza|Etc/GMT+3", "America/Halifax|America/Glace_Bay", "America/Halifax|America/Goose_Bay", "America/Halifax|America/Moncton", "America/Halifax|America/Thule", "America/Halifax|Atlantic/Bermuda", "America/Halifax|Canada/Atlantic", "America/Havana|Cuba", "America/La_Paz|America/Boa_Vista", "America/La_Paz|America/Guyana", "America/La_Paz|America/Manaus", "America/La_Paz|America/Porto_Velho", "America/La_Paz|Brazil/West", "America/La_Paz|Etc/GMT+4", "America/Lima|America/Bogota", "America/Lima|America/Guayaquil", "America/Lima|Etc/GMT+5", "America/Los_Angeles|America/Dawson", "America/Los_Angeles|America/Ensenada", "America/Los_Angeles|America/Santa_Isabel", "America/Los_Angeles|America/Tijuana", "America/Los_Angeles|America/Vancouver", "America/Los_Angeles|America/Whitehorse", "America/Los_Angeles|Canada/Pacific", "America/Los_Angeles|Canada/Yukon", "America/Los_Angeles|Mexico/BajaNorte", "America/Los_Angeles|PST8PDT", "America/Los_Angeles|US/Pacific", "America/Los_Angeles|US/Pacific-New", "America/Managua|America/Belize", "America/Managua|America/Costa_Rica", "America/Managua|America/El_Salvador", "America/Managua|America/Guatemala", "America/Managua|America/Regina", "America/Managua|America/Swift_Current", "America/Managua|America/Tegucigalpa", "America/Managua|Canada/East-Saskatchewan", "America/Managua|Canada/Saskatchewan", "America/Mexico_City|America/Bahia_Banderas", "America/Mexico_City|America/Merida", "America/Mexico_City|America/Monterrey", "America/Mexico_City|Mexico/General", "America/New_York|America/Detroit", "America/New_York|America/Fort_Wayne", "America/New_York|America/Indiana/Indianapolis", "America/New_York|America/Indiana/Marengo", "America/New_York|America/Indiana/Petersburg", "America/New_York|America/Indiana/Vevay", "America/New_York|America/Indiana/Vincennes", "America/New_York|America/Indiana/Winamac", "America/New_York|America/Indianapolis", "America/New_York|America/Iqaluit", "America/New_York|America/Kentucky/Louisville", "America/New_York|America/Kentucky/Monticello", "America/New_York|America/Louisville", "America/New_York|America/Montreal", "America/New_York|America/Nassau", "America/New_York|America/Nipigon", "America/New_York|America/Pangnirtung", "America/New_York|America/Thunder_Bay", "America/New_York|America/Toronto", "America/New_York|Canada/Eastern", "America/New_York|EST5EDT", "America/New_York|US/East-Indiana", "America/New_York|US/Eastern", "America/New_York|US/Michigan", "America/Noronha|Atlantic/South_Georgia", "America/Noronha|Brazil/DeNoronha", "America/Noronha|Etc/GMT+2", "America/Panama|America/Atikokan", "America/Panama|America/Cayman", "America/Panama|America/Coral_Harbour", "America/Panama|America/Jamaica", "America/Panama|EST", "America/Panama|Jamaica", "America/Phoenix|America/Creston", "America/Phoenix|America/Dawson_Creek", "America/Phoenix|America/Hermosillo", "America/Phoenix|MST", "America/Phoenix|US/Arizona", "America/Rio_Branco|America/Eirunepe", "America/Rio_Branco|America/Porto_Acre", "America/Rio_Branco|Brazil/Acre", "America/Santiago|Chile/Continental", "America/Santo_Domingo|America/Anguilla", "America/Santo_Domingo|America/Antigua", "America/Santo_Domingo|America/Aruba", "America/Santo_Domingo|America/Barbados", "America/Santo_Domingo|America/Blanc-Sablon", "America/Santo_Domingo|America/Curacao", "America/Santo_Domingo|America/Dominica", "America/Santo_Domingo|America/Grenada", "America/Santo_Domingo|America/Guadeloupe", "America/Santo_Domingo|America/Kralendijk", "America/Santo_Domingo|America/Lower_Princes", "America/Santo_Domingo|America/Marigot", "America/Santo_Domingo|America/Martinique", "America/Santo_Domingo|America/Montserrat", "America/Santo_Domingo|America/Port_of_Spain", "America/Santo_Domingo|America/Puerto_Rico", "America/Santo_Domingo|America/St_Barthelemy", "America/Santo_Domingo|America/St_Kitts", "America/Santo_Domingo|America/St_Lucia", "America/Santo_Domingo|America/St_Thomas", "America/Santo_Domingo|America/St_Vincent", "America/Santo_Domingo|America/Tortola", "America/Santo_Domingo|America/Virgin", "America/Sao_Paulo|Brazil/East", "America/St_Johns|Canada/Newfoundland", "Antarctica/Palmer|America/Punta_Arenas", "Asia/Baghdad|Antarctica/Syowa", "Asia/Baghdad|Asia/Aden", "Asia/Baghdad|Asia/Bahrain", "Asia/Baghdad|Asia/Kuwait", "Asia/Baghdad|Asia/Qatar", "Asia/Baghdad|Asia/Riyadh", "Asia/Baghdad|Etc/GMT-3", "Asia/Baghdad|Europe/Minsk", "Asia/Bangkok|Asia/Ho_Chi_Minh", "Asia/Bangkok|Asia/Novokuznetsk", "Asia/Bangkok|Asia/Phnom_Penh", "Asia/Bangkok|Asia/Saigon", "Asia/Bangkok|Asia/Vientiane", "Asia/Bangkok|Etc/GMT-7", "Asia/Bangkok|Indian/Christmas", "Asia/Dhaka|Antarctica/Vostok", "Asia/Dhaka|Asia/Almaty", "Asia/Dhaka|Asia/Bishkek", "Asia/Dhaka|Asia/Dacca", "Asia/Dhaka|Asia/Kashgar", "Asia/Dhaka|Asia/Qyzylorda", "Asia/Dhaka|Asia/Thimbu", "Asia/Dhaka|Asia/Thimphu", "Asia/Dhaka|Asia/Urumqi", "Asia/Dhaka|Etc/GMT-6", "Asia/Dhaka|Indian/Chagos", "Asia/Dili|Etc/GMT-9", "Asia/Dili|Pacific/Palau", "Asia/Dubai|Asia/Muscat", "Asia/Dubai|Asia/Tbilisi", "Asia/Dubai|Asia/Yerevan", "Asia/Dubai|Etc/GMT-4", "Asia/Dubai|Europe/Samara", "Asia/Dubai|Indian/Mahe", "Asia/Dubai|Indian/Mauritius", "Asia/Dubai|Indian/Reunion", "Asia/Gaza|Asia/Hebron", "Asia/Hong_Kong|Hongkong", "Asia/Jakarta|Asia/Pontianak", "Asia/Jerusalem|Asia/Tel_Aviv", "Asia/Jerusalem|Israel", "Asia/Kamchatka|Asia/Anadyr", "Asia/Kamchatka|Etc/GMT-12", "Asia/Kamchatka|Kwajalein", "Asia/Kamchatka|Pacific/Funafuti", "Asia/Kamchatka|Pacific/Kwajalein", "Asia/Kamchatka|Pacific/Majuro", "Asia/Kamchatka|Pacific/Nauru", "Asia/Kamchatka|Pacific/Tarawa", "Asia/Kamchatka|Pacific/Wake", "Asia/Kamchatka|Pacific/Wallis", "Asia/Kathmandu|Asia/Katmandu", "Asia/Kolkata|Asia/Calcutta", "Asia/Makassar|Asia/Ujung_Pandang", "Asia/Manila|Asia/Brunei", "Asia/Manila|Asia/Kuala_Lumpur", "Asia/Manila|Asia/Kuching", "Asia/Manila|Asia/Singapore", "Asia/Manila|Etc/GMT-8", "Asia/Manila|Singapore", "Asia/Rangoon|Asia/Yangon", "Asia/Rangoon|Indian/Cocos", "Asia/Seoul|ROK", "Asia/Shanghai|Asia/Chongqing", "Asia/Shanghai|Asia/Chungking", "Asia/Shanghai|Asia/Harbin", "Asia/Shanghai|Asia/Macao", "Asia/Shanghai|Asia/Macau", "Asia/Shanghai|Asia/Taipei", "Asia/Shanghai|PRC", "Asia/Shanghai|ROC", "Asia/Tashkent|Antarctica/Mawson", "Asia/Tashkent|Asia/Aqtau", "Asia/Tashkent|Asia/Aqtobe", "Asia/Tashkent|Asia/Ashgabat", "Asia/Tashkent|Asia/Ashkhabad", "Asia/Tashkent|Asia/Atyrau", "Asia/Tashkent|Asia/Dushanbe", "Asia/Tashkent|Asia/Oral", "Asia/Tashkent|Asia/Samarkand", "Asia/Tashkent|Etc/GMT-5", "Asia/Tashkent|Indian/Kerguelen", "Asia/Tashkent|Indian/Maldives", "Asia/Tehran|Iran", "Asia/Tokyo|Japan", "Asia/Ulaanbaatar|Asia/Choibalsan", "Asia/Ulaanbaatar|Asia/Ulan_Bator", "Asia/Vladivostok|Asia/Ust-Nera", "Asia/Yakutsk|Asia/Khandyga", "Atlantic/Azores|America/Scoresbysund", "Atlantic/Cape_Verde|Etc/GMT+1", "Australia/Adelaide|Australia/Broken_Hill", "Australia/Adelaide|Australia/South", "Australia/Adelaide|Australia/Yancowinna", "Australia/Brisbane|Australia/Lindeman", "Australia/Brisbane|Australia/Queensland", "Australia/Darwin|Australia/North", "Australia/Lord_Howe|Australia/LHI", "Australia/Perth|Australia/West", "Australia/Sydney|Australia/ACT", "Australia/Sydney|Australia/Canberra", "Australia/Sydney|Australia/Currie", "Australia/Sydney|Australia/Hobart", "Australia/Sydney|Australia/Melbourne", "Australia/Sydney|Australia/NSW", "Australia/Sydney|Australia/Tasmania", "Australia/Sydney|Australia/Victoria", "Etc/UCT|UCT", "Etc/UTC|Etc/Universal", "Etc/UTC|Etc/Zulu", "Etc/UTC|UTC", "Etc/UTC|Universal", "Etc/UTC|Zulu", "Europe/Astrakhan|Europe/Ulyanovsk", "Europe/Athens|Asia/Nicosia", "Europe/Athens|EET", "Europe/Athens|Europe/Bucharest", "Europe/Athens|Europe/Helsinki", "Europe/Athens|Europe/Kiev", "Europe/Athens|Europe/Mariehamn", "Europe/Athens|Europe/Nicosia", "Europe/Athens|Europe/Riga", "Europe/Athens|Europe/Sofia", "Europe/Athens|Europe/Tallinn", "Europe/Athens|Europe/Uzhgorod", "Europe/Athens|Europe/Vilnius", "Europe/Athens|Europe/Zaporozhye", "Europe/Chisinau|Europe/Tiraspol", "Europe/Dublin|Eire", "Europe/Istanbul|Asia/Istanbul", "Europe/Istanbul|Turkey", "Europe/Lisbon|Atlantic/Canary", "Europe/Lisbon|Atlantic/Faeroe", "Europe/Lisbon|Atlantic/Faroe", "Europe/Lisbon|Atlantic/Madeira", "Europe/Lisbon|Portugal", "Europe/Lisbon|WET", "Europe/London|Europe/Belfast", "Europe/London|Europe/Guernsey", "Europe/London|Europe/Isle_of_Man", "Europe/London|Europe/Jersey", "Europe/London|GB", "Europe/London|GB-Eire", "Europe/Moscow|W-SU", "Europe/Paris|Africa/Ceuta", "Europe/Paris|Arctic/Longyearbyen", "Europe/Paris|Atlantic/Jan_Mayen", "Europe/Paris|CET", "Europe/Paris|Europe/Amsterdam", "Europe/Paris|Europe/Andorra", "Europe/Paris|Europe/Belgrade", "Europe/Paris|Europe/Berlin", "Europe/Paris|Europe/Bratislava", "Europe/Paris|Europe/Brussels", "Europe/Paris|Europe/Budapest", "Europe/Paris|Europe/Busingen", "Europe/Paris|Europe/Copenhagen", "Europe/Paris|Europe/Gibraltar", "Europe/Paris|Europe/Ljubljana", "Europe/Paris|Europe/Luxembourg", "Europe/Paris|Europe/Madrid", "Europe/Paris|Europe/Malta", "Europe/Paris|Europe/Monaco", "Europe/Paris|Europe/Oslo", "Europe/Paris|Europe/Podgorica", "Europe/Paris|Europe/Prague", "Europe/Paris|Europe/Rome", "Europe/Paris|Europe/San_Marino", "Europe/Paris|Europe/Sarajevo", "Europe/Paris|Europe/Skopje", "Europe/Paris|Europe/Stockholm", "Europe/Paris|Europe/Tirane", "Europe/Paris|Europe/Vaduz", "Europe/Paris|Europe/Vatican", "Europe/Paris|Europe/Vienna", "Europe/Paris|Europe/Warsaw", "Europe/Paris|Europe/Zagreb", "Europe/Paris|Europe/Zurich", "Europe/Paris|Poland", "Europe/Volgograd|Europe/Kirov", "Pacific/Auckland|Antarctica/McMurdo", "Pacific/Auckland|Antarctica/South_Pole", "Pacific/Auckland|NZ", "Pacific/Chatham|NZ-CHAT", "Pacific/Easter|Chile/EasterIsland", "Pacific/Fakaofo|Etc/GMT-13", "Pacific/Fakaofo|Pacific/Enderbury", "Pacific/Galapagos|Etc/GMT+6", "Pacific/Gambier|Etc/GMT+9", "Pacific/Guadalcanal|Antarctica/Macquarie", "Pacific/Guadalcanal|Etc/GMT-11", "Pacific/Guadalcanal|Pacific/Efate", "Pacific/Guadalcanal|Pacific/Kosrae", "Pacific/Guadalcanal|Pacific/Noumea", "Pacific/Guadalcanal|Pacific/Pohnpei", "Pacific/Guadalcanal|Pacific/Ponape", "Pacific/Guam|Pacific/Saipan", "Pacific/Honolulu|HST", "Pacific/Honolulu|Pacific/Johnston", "Pacific/Honolulu|US/Hawaii", "Pacific/Kiritimati|Etc/GMT-14", "Pacific/Niue|Etc/GMT+11", "Pacific/Pago_Pago|Pacific/Midway", "Pacific/Pago_Pago|Pacific/Samoa", "Pacific/Pago_Pago|US/Samoa", "Pacific/Pitcairn|Etc/GMT+8", "Pacific/Port_Moresby|Antarctica/DumontDUrville", "Pacific/Port_Moresby|Etc/GMT-10", "Pacific/Port_Moresby|Pacific/Chuuk", "Pacific/Port_Moresby|Pacific/Truk", "Pacific/Port_Moresby|Pacific/Yap", "Pacific/Tahiti|Etc/GMT+10", "Pacific/Tahiti|Pacific/Rarotonga"]
    }), a
}),
    function() {
        "use strict";

        function a(b, d) {
            function e(a, b) {
                return function() {
                    return a.apply(b, arguments)
                }
            }
            var f;
            if (d = d || {}, this.trackingClick = !1, this.trackingClickStart = 0, this.targetElement = null, this.touchStartX = 0, this.touchStartY = 0, this.lastTouchIdentifier = 0, this.touchBoundary = d.touchBoundary || 10, this.layer = b, this.tapDelay = d.tapDelay || 200, this.tapTimeout = d.tapTimeout || 700, !a.notNeeded(b)) {
                for (var g = ["onMouse", "onClick", "onTouchStart", "onTouchMove", "onTouchEnd", "onTouchCancel"], h = this, i = 0, j = g.length; j > i; i++) h[g[i]] = e(h[g[i]], h);
                c && (b.addEventListener("mouseover", this.onMouse, !0), b.addEventListener("mousedown", this.onMouse, !0), b.addEventListener("mouseup", this.onMouse, !0)), b.addEventListener("click", this.onClick, !0), b.addEventListener("touchstart", this.onTouchStart, !1), b.addEventListener("touchmove", this.onTouchMove, !1), b.addEventListener("touchend", this.onTouchEnd, !1), b.addEventListener("touchcancel", this.onTouchCancel, !1), Event.prototype.stopImmediatePropagation || (b.removeEventListener = function(a, c, d) {
                    var e = Node.prototype.removeEventListener;
                    "click" === a ? e.call(b, a, c.hijacked || c, d) : e.call(b, a, c, d)
                }, b.addEventListener = function(a, c, d) {
                    var e = Node.prototype.addEventListener;
                    "click" === a ? e.call(b, a, c.hijacked || (c.hijacked = function(a) {
                            a.propagationStopped || c(a)
                        }), d) : e.call(b, a, c, d)
                }), "function" == typeof b.onclick && (f = b.onclick, b.addEventListener("click", function(a) {
                    f(a)
                }, !1), b.onclick = null)
            }
        }
        var b = navigator.userAgent.indexOf("Windows Phone") >= 0,
            c = navigator.userAgent.indexOf("Android") > 0 && !b,
            d = /iP(ad|hone|od)/.test(navigator.userAgent) && !b,
            e = d && /OS 4_\d(_\d)?/.test(navigator.userAgent),
            f = d && /OS [6-7]_\d/.test(navigator.userAgent),
            g = navigator.userAgent.indexOf("BB10") > 0;
        a.prototype.needsClick = function(a) {
            switch (a.nodeName.toLowerCase()) {
                case "button":
                case "select":
                case "textarea":
                    if (a.disabled) return !0;
                    break;
                case "input":
                    if (d && "file" === a.type || a.disabled) return !0;
                    break;
                case "label":
                case "iframe":
                case "video":
                    return !0
            }
            return /\bneedsclick\b/.test(a.className)
        }, a.prototype.needsFocus = function(a) {
            switch (a.nodeName.toLowerCase()) {
                case "textarea":
                    return !0;
                case "select":
                    return !c;
                case "input":
                    switch (a.type) {
                        case "button":
                        case "checkbox":
                        case "file":
                        case "image":
                        case "radio":
                        case "submit":
                            return !1
                    }
                    return !a.disabled && !a.readOnly;
                default:
                    return /\bneedsfocus\b/.test(a.className)
            }
        }, a.prototype.sendClick = function(a, b) {
            var c, d;
            document.activeElement && document.activeElement !== a && document.activeElement.blur(), d = b.changedTouches[0], c = document.createEvent("MouseEvents"), c.initMouseEvent(this.determineEventType(a), !0, !0, window, 1, d.screenX, d.screenY, d.clientX, d.clientY, !1, !1, !1, !1, 0, null), c.forwardedTouchEvent = !0, a.dispatchEvent(c)
        }, a.prototype.determineEventType = function(a) {
            return c && "select" === a.tagName.toLowerCase() ? "mousedown" : "click"
        }, a.prototype.focus = function(a) {
            var b;
            d && a.setSelectionRange && 0 !== a.type.indexOf("date") && "time" !== a.type && "month" !== a.type ? (b = a.value.length, a.setSelectionRange(b, b)) : a.focus()
        }, a.prototype.updateScrollParent = function(a) {
            var b, c;
            if (b = a.fastClickScrollParent, !b || !b.contains(a)) {
                c = a;
                do {
                    if (c.scrollHeight > c.offsetHeight) {
                        b = c, a.fastClickScrollParent = c;
                        break
                    }
                    c = c.parentElement
                } while (c)
            }
            b && (b.fastClickLastScrollTop = b.scrollTop)
        }, a.prototype.getTargetElementFromEventTarget = function(a) {
            return a.nodeType === Node.TEXT_NODE ? a.parentNode : a
        }, a.prototype.onTouchStart = function(a) {
            var b, c, f;
            if (a.targetTouches.length > 1) return !0;
            if (b = this.getTargetElementFromEventTarget(a.target), c = a.targetTouches[0], d) {
                if (f = window.getSelection(), f.rangeCount && !f.isCollapsed) return !0;
                if (!e) {
                    if (c.identifier && c.identifier === this.lastTouchIdentifier) return a.preventDefault(), !1;
                    this.lastTouchIdentifier = c.identifier, this.updateScrollParent(b)
                }
            }
            return this.trackingClick = !0, this.trackingClickStart = a.timeStamp, this.targetElement = b, this.touchStartX = c.pageX, this.touchStartY = c.pageY, a.timeStamp - this.lastClickTime < this.tapDelay && a.preventDefault(), !0
        }, a.prototype.touchHasMoved = function(a) {
            var b = a.changedTouches[0],
                c = this.touchBoundary;
            return Math.abs(b.pageX - this.touchStartX) > c || Math.abs(b.pageY - this.touchStartY) > c ? !0 : !1
        }, a.prototype.onTouchMove = function(a) {
            return this.trackingClick ? ((this.targetElement !== this.getTargetElementFromEventTarget(a.target) || this.touchHasMoved(a)) && (this.trackingClick = !1, this.targetElement = null), !0) : !0
        }, a.prototype.findControl = function(a) {
            return void 0 !== a.control ? a.control : a.htmlFor ? document.getElementById(a.htmlFor) : a.querySelector("button, input:not([type=hidden]), keygen, meter, output, progress, select, textarea")
        }, a.prototype.onTouchEnd = function(a) {
            var b, g, h, i, j, k = this.targetElement;
            if (!this.trackingClick) return !0;
            if (a.timeStamp - this.lastClickTime < this.tapDelay) return this.cancelNextClick = !0, !0;
            if (a.timeStamp - this.trackingClickStart > this.tapTimeout) return !0;
            if (this.cancelNextClick = !1, this.lastClickTime = a.timeStamp, g = this.trackingClickStart, this.trackingClick = !1, this.trackingClickStart = 0, f && (j = a.changedTouches[0], k = document.elementFromPoint(j.pageX - window.pageXOffset, j.pageY - window.pageYOffset) || k, k.fastClickScrollParent = this.targetElement.fastClickScrollParent), h = k.tagName.toLowerCase(), "label" === h) {
                if (b = this.findControl(k)) {
                    if (this.focus(k), c) return !1;
                    k = b
                }
            } else if (this.needsFocus(k)) return a.timeStamp - g > 100 || d && window.top !== window && "input" === h ? (this.targetElement = null, !1) : (this.focus(k), this.sendClick(k, a), d && "select" === h || (this.targetElement = null, a.preventDefault()), !1);
            return d && !e && (i = k.fastClickScrollParent, i && i.fastClickLastScrollTop !== i.scrollTop) ? !0 : (this.needsClick(k) || (a.preventDefault(), this.sendClick(k, a)), !1)
        }, a.prototype.onTouchCancel = function() {
            this.trackingClick = !1, this.targetElement = null
        }, a.prototype.onMouse = function(a) {
            return this.targetElement ? a.forwardedTouchEvent ? !0 : a.cancelable && (!this.needsClick(this.targetElement) || this.cancelNextClick) ? (a.stopImmediatePropagation ? a.stopImmediatePropagation() : a.propagationStopped = !0, a.stopPropagation(), a.preventDefault(), !1) : !0 : !0
        }, a.prototype.onClick = function(a) {
            var b;
            return this.trackingClick ? (this.targetElement = null, this.trackingClick = !1, !0) : "submit" === a.target.type && 0 === a.detail ? !0 : (b = this.onMouse(a), b || (this.targetElement = null), b)
        }, a.prototype.destroy = function() {
            var a = this.layer;
            c && (a.removeEventListener("mouseover", this.onMouse, !0), a.removeEventListener("mousedown", this.onMouse, !0), a.removeEventListener("mouseup", this.onMouse, !0)), a.removeEventListener("click", this.onClick, !0), a.removeEventListener("touchstart", this.onTouchStart, !1), a.removeEventListener("touchmove", this.onTouchMove, !1), a.removeEventListener("touchend", this.onTouchEnd, !1), a.removeEventListener("touchcancel", this.onTouchCancel, !1)
        }, a.notNeeded = function(a) {
            var b, d, e, f;
            if ("undefined" == typeof window.ontouchstart) return !0;
            if (d = +(/Chrome\/([0-9]+)/.exec(navigator.userAgent) || [, 0])[1]) {
                if (!c) return !0;
                if (b = document.querySelector("meta[name=viewport]")) {
                    if (-1 !== b.content.indexOf("user-scalable=no")) return !0;
                    if (d > 31 && document.documentElement.scrollWidth <= window.outerWidth) return !0
                }
            }
            if (g && (e = navigator.userAgent.match(/Version\/([0-9]*)\.([0-9]*)/), e[1] >= 10 && e[2] >= 3 && (b = document.querySelector("meta[name=viewport]")))) {
                if (-1 !== b.content.indexOf("user-scalable=no")) return !0;
                if (document.documentElement.scrollWidth <= window.outerWidth) return !0
            }
            return "none" === a.style.msTouchAction || "manipulation" === a.style.touchAction ? !0 : (f = +(/Firefox\/([0-9]+)/.exec(navigator.userAgent) || [, 0])[1], f >= 27 && (b = document.querySelector("meta[name=viewport]"), b && (-1 !== b.content.indexOf("user-scalable=no") || document.documentElement.scrollWidth <= window.outerWidth)) ? !0 : "none" === a.style.touchAction || "manipulation" === a.style.touchAction ? !0 : !1)
        }, a.attach = function(b, c) {
            return new a(b, c)
        }, "function" == typeof define && "object" == typeof define.amd && define.amd ? define(function() {
            return a
        }) : "undefined" != typeof module && module.exports ? (module.exports = a.attach, module.exports.FastClick = a) : window.FastClick = a
    }(),
    function(a) {
        a(function() {
            a(window).width() <= 1024 || b.init()
        });
        var b = {
            showLogs: !1,
            round: 1e3,
            init: function() {
                return this._log("init"), this._inited ? (this._log("Already Inited"), void(this._inited = !0)) : (this._requestAnimationFrame = function() {
                    return window.requestAnimationFrame || window.webkitRequestAnimationFrame || window.mozRequestAnimationFrame || window.oRequestAnimationFrame || window.msRequestAnimationFrame || function(a, b) {
                            window.setTimeout(a, 1e3 / 60)
                        }
                }(), void this._onScroll(!0))
            },
            _inited: !1,
            _properties: ["x", "y", "z", "rotateX", "rotateY", "rotateZ", "scaleX", "scaleY", "scaleZ", "scale"],
            _requestAnimationFrame: null,
            _log: function(a) {
                this.showLogs && console.log("Parallax Scroll / " + a)
            },
            _onScroll: function(b) {
                var c = a(document).scrollTop(),
                    d = a(window).height();
                this._log("onScroll " + c), a("[data-parallax]").each(a.proxy(function(e, f) {
                    var g = a(f),
                        h = [],
                        i = !1,
                        j = g.data("style");
                    void 0 == j && (j = g.attr("style") || "", g.data("style", j));
                    var k, l = [g.data("parallax")];
                    for (k = 2; g.data("parallax" + k); k++) l.push(g.data("parallax-" + k));
                    var m = l.length;
                    for (k = 0; m > k; k++) {
                        var n = l[k],
                            o = n["from-scroll"];
                        void 0 == o && (o = Math.max(0, a(f).offset().top - d)), o = 0 | o;
                        var p = n.distance,
                            q = n["to-scroll"];
                        void 0 == p && void 0 == q && (p = d), p = Math.max(0 | p, 1);
                        var r = n.easing,
                            s = n["easing-return"];
                        if (void 0 != r && a.easing && a.easing[r] || (r = null), void 0 != s && a.easing && a.easing[s] || (s = r), r) {
                            var t = n.duration;
                            void 0 == t && (t = p), t = Math.max(0 | t, 1);
                            var u = n["duration-return"];
                            void 0 == u && (u = t), p = 1;
                            var v = g.data("current-time");
                            void 0 == v && (v = 0)
                        }
                        void 0 == q && (q = o + p), q = 0 | q;
                        var w = n.smoothness;
                        void 0 == w && (w = 30), w = 0 | w, (b || 0 == w) && (w = 1), w = 0 | w;
                        var x = c;
                        x = Math.max(x, o), x = Math.min(x, q), r && (void 0 == g.data("sens") && g.data("sens", "back"), x > o && ("back" == g.data("sens") ? (v = 1, g.data("sens", "go")) : v++), q > x && ("go" == g.data("sens") ? (v = 1, g.data("sens", "back")) : v++), b && (v = t), g.data("current-time", v)), this._properties.map(a.proxy(function(b) {
                            var c = 0,
                                d = n[b];
                            if (void 0 != d) {
                                "scale" == b || "scaleX" == b || "scaleY" == b || "scaleZ" == b ? c = 1 : d = 0 | d;
                                var e = g.data("_" + b);
                                void 0 == e && (e = c);
                                var f = (d - c) * ((x - o) / (q - o)) + c,
                                    j = e + (f - e) / w;
                                if (r && v > 0 && t >= v) {
                                    var k = c;
                                    "back" == g.data("sens") && (k = d, d = -d, r = s, t = u), j = a.easing[r](null, v, k, d, t)
                                }
                                j = Math.ceil(j * this.round) / this.round, j == e && f == d && (j = d), h[b] || (h[b] = 0), h[b] += j, e != h[b] && (g.data("_" + b, h[b]), i = !0)
                            }
                        }, this))
                    }
                    if (i) {
                        if (void 0 != h.z) {
                            var y = n.perspective;
                            void 0 == y && (y = 800);
                            var z = g.parent();
                            z.data("style") || z.data("style", z.attr("style") || ""), z.attr("style", "perspective:" + y + "px; -webkit-perspective:" + y + "px; " + z.data("style"))
                        }
                        void 0 == h.scaleX && (h.scaleX = 1), void 0 == h.scaleY && (h.scaleY = 1), void 0 == h.scaleZ && (h.scaleZ = 1), void 0 != h.scale && (h.scaleX *= h.scale, h.scaleY *= h.scale, h.scaleZ *= h.scale);
                        var A = "translate3d(" + (h.x ? h.x : 0) + "px, " + (h.y ? h.y : 0) + "px, " + (h.z ? h.z : 0) + "px)",
                            B = "rotateX(" + (h.rotateX ? h.rotateX : 0) + "deg) rotateY(" + (h.rotateY ? h.rotateY : 0) + "deg) rotateZ(" + (h.rotateZ ? h.rotateZ : 0) + "deg)",
                            C = "scaleX(" + h.scaleX + ") scaleY(" + h.scaleY + ") scaleZ(" + h.scaleZ + ")",
                            D = A + " " + B + " " + C + ";";
                        this._log(D), g.attr("style", "transform:" + D + " -webkit-transform:" + D + " " + j)
                    }
                }, this)), window.requestAnimationFrame ? window.requestAnimationFrame(a.proxy(this._onScroll, this, !1)) : this._requestAnimationFrame(a.proxy(this._onScroll, this, !1))
            }
        }
    }(jQuery);



var baselThemeModule;

(function ($) {
    "use strict";

    baselThemeModule = (function () {


        var baselTheme = {
            popupEffect: 'mfp-move-horizontal',
            shopLoadMoreBtn: '.basel-products-load-more.load-on-scroll',
            supports_html5_storage: false,
            ajaxLinks: '.basel-product-categories a, .widget_product_categories a, .widget_layered_nav_filters a, .filters-area a, body.post-type-archive-product:not(.woocommerce-account) .woocommerce-pagination a, body.tax-product_cat:not(.woocommerce-account) .woocommerce-pagination a, .basel-woocommerce-layered-nav a, .widget_product_tag_cloud a, .basel-products-shop-view a, .basel-price-filter a, .woocommerce-widget-layered-nav a, .basel-clear-filters-wrapp a, .basel-woocommerce-sort-by a',
            mainCarouselArg: {
                rtl: $('body').hasClass('rtl'),
                items: 1,
                autoplay: (basel_settings.product_slider_autoplay),
                autoplayTimeout: 3000,
                loop: (basel_settings.product_slider_autoplay),
                dots: false,
                nav: false,
                autoHeight: (basel_settings.product_slider_auto_height == 'yes'),
                navText: false,
                onRefreshed: function () {
                    $(window).resize();
                }
            }
        };

        /* Storage Handling */
        try {
            baselTheme.supports_html5_storage = ('sessionStorage' in window && window.sessionStorage !== null);

            window.sessionStorage.setItem('basel', 'test');
            window.sessionStorage.removeItem('basel');
        } catch (err) {
            baselTheme.supports_html5_storage = false;
        }

        return {

            init: function () {

                this.headerBanner();

                this.fixedHeaders();

                this.verticalHeader();

                this.splitNavHeader();

                this.visibleElements();

                this.bannersHover();

                this.parallax();

                this.googleMap();

                this.scrollTop();

                this.quickViewInit();

                this.quickShop();

                this.sidebarMenu();

                this.addToCart();

                this.productImages();

                this.productImagesGallery();

                this.stickyDetails();

                this.mfpPopup();

                this.swatchesVariations();

                this.swatchesOnGrid();

                this.blogMasonry();

                this.blogLoadMore();

                this.productsLoadMore();

                this.productsTabs();

                this.portfolioLoadMore();

                this.equalizeColumns();

                this.menuSetUp();

                this.menuOffsets();

                this.onePageMenu();

                this.mobileNavigation();

                this.simpleDropdown();

                this.woocommerceWrappTable();

                this.wishList();

                this.compare();

                this.baselCompare();

                this.promoPopup();

                this.cookiesPopup();

                this.productVideo();

                this.product360Button();

                this.btnsToolTips();

                this.stickyFooter();

                this.updateWishListNumberInit();

                this.cartWidget();

                this.ajaxFilters();

                this.shopPageInit();

                this.filtersArea();

                this.categoriesMenu();

                this.searchFullScreen();

                this.loginTabs();

                this.productAccordion();

                this.productCompact();

                this.countDownTimer();

                this.mobileFastclick();

                this.nanoScroller();

                this.woocommerceComments();

                this.woocommerceQuantity();

                this.initZoom();

                this.videoPoster();

                this.addToCartAllTypes();

                this.contentPopup();

                this.mobileSearchIcon();

                this.shopHiddenSidebar();

                this.loginSidebar();

                this.shopLoader();

                this.stickyAddToCart();

                this.stickySidebarBtn();

                this.productLoaderPosition();

                this.lazyLoading();

                this.owlCarouselInit();

                this.baselSliderLazyLoad();

                this.portfolioPhotoSwipe();

                this.sortByWidget();

                this.instagramAjaxQuery();

                $(window).resize();

                $('body').addClass('document-ready');

                $(document.body).on('updated_cart_totals', function () {
                    baselThemeModule.woocommerceWrappTable();
                });

            },


            /**
             *-------------------------------------------------------------------------------------------------------------------------------------------
             * Instagram AJAX
             *-------------------------------------------------------------------------------------------------------------------------------------------
             */
            instagramAjaxQuery: function () {
                $('.instagram-widget').each(function () {
                    var $instagram = $(this);
                    if (!$instagram.hasClass('instagram-with-error')) {
                        return;
                    }

                    var username = $instagram.data('username');
                    var atts = $instagram.data('atts');
                    var request_param = username.indexOf('#') > -1 ? 'explore/tags/' + username.substr(1) : username;

                    var url = 'https://www.instagram.com/' + request_param + '/';

                    $instagram.addClass('loading');

                    $.ajax({
                        url: url,
                        success: function (response) {
                            $.ajax({
                                url: basel_settings.ajaxurl,
                                data: {
                                    action: 'basel_instagram_ajax_query',
                                    body: response,
                                    atts: atts,
                                },
                                dataType: 'json',
                                method: 'POST',
                                success: function (response) {
                                    $instagram.parent().html(response);
                                    baselThemeModule.owlCarouselInit();
                                },
                                error: function (data) {
                                    console.log('instagram ajax error');
                                },
                            });
                        },
                        error: function (data) {
                            console.log('instagram ajax error');
                        },
                    });

                });
            },

            /**
             *-------------------------------------------------------------------------------------------------------------------------------------------
             * "Sort by" widget reinit
             *-------------------------------------------------------------------------------------------------------------------------------------------
             */
            sortByWidget: function () {
                if ($('body').hasClass('basel-ajax-shop-off')) return;

                $('.woocommerce-ordering').on('change', 'select.orderby', function () {
                    var $form = $(this).closest('form');

                    $form.find('[name="_pjax"]').remove();

                    $.pjax({
                        container: '.main-page-wrapper',
                        timeout: basel_settings.pjax_timeout,
                        url: '?' + $form.serialize(),
                        scrollTo: false
                    });
                });

                $('.woocommerce-ordering').submit(function (e) {
                    e.preventDefault(e);
                });
            },

            /**
             *-------------------------------------------------------------------------------------------------------------------------------------------
             * Portfolio photo swipe
             *-------------------------------------------------------------------------------------------------------------------------------------------
             */

            portfolioPhotoSwipe: function () {
                $(document).on('click', '.portfolio-enlarge', function (e) {
                    e.preventDefault();
                    var $parent = $(this).parents('.portfolio-entry');
                    var index = $parent.index();
                    var items = getPortfolioImages();
                    baselThemeModule.callPhotoSwipe(index, items);
                });

                var getPortfolioImages = function () {
                    var items = [];
                    $('.portfolio-entry').find('figure a img').each(function () {
                        items.push({
                            src: $(this).attr('src'),
                            w: $(this).attr('width'),
                            h: $(this).attr('height')
                        });
                    });
                    return items;
                };
            },

            /**
             *-------------------------------------------------------------------------------------------------------------------------------------------
             * Product filters
             *-------------------------------------------------------------------------------------------------------------------------------------------
             */

            productFilters: function () {
                //Select checkboxes value
                var removeValue = function ($mainInput, currentVal) {
                    if ($mainInput.length == 0) return;
                    var mainInputVal = $mainInput.val();
                    if (mainInputVal.indexOf(',') > 0) {
                        $mainInput.val(mainInputVal.replace(',' + currentVal, '').replace(currentVal + ',', ''));
                    } else {
                        $mainInput.val(mainInputVal.replace(currentVal, ''));
                    }
                }

                $('.basel-pf-checkboxes li > .pf-value').on('click', function (e) {
                    e.preventDefault();
                    var $this = $(this);
                    var $li = $this.parent();
                    var $widget = $this.parents('.basel-pf-checkboxes');
                    var $mainInput = $widget.find('.result-input');
                    var $results = $widget.find('.basel-pf-results');

                    var multiSelect = $widget.hasClass('multi_select');
                    var mainInputVal = $mainInput.val();
                    var currentText = $this.data('title');
                    var currentVal = $this.data('val');

                    if (multiSelect) {
                        if (!$li.hasClass('pf-active')) {
                            if (mainInputVal == '') {
                                $mainInput.val(currentVal);
                            } else {
                                $mainInput.val(mainInputVal + ',' + currentVal);
                            }
                            $results.prepend('<li class="selected-value" data-title="' + currentVal + '">' + currentText + '</li>');
                            $li.addClass('pf-active');
                        } else {
                            removeValue($mainInput, currentVal);
                            $results.find('li[data-title="' + currentVal + '"]').remove();
                            $li.removeClass('pf-active');
                        }
                    } else {
                        if (!$li.hasClass('pf-active')) {
                            $mainInput.val(currentVal);
                            $results.find('.selected-value').remove();
                            $results.prepend('<li class="selected-value" data-title="' + currentVal + '">' + currentText + '</li>');
                            $li.parents('.basel-scroll-content').find('.pf-active').removeClass('pf-active');
                            $li.addClass('pf-active');
                        } else {
                            $mainInput.val('');
                            $results.find('.selected-value').remove();
                            $li.removeClass('pf-active');
                        }
                    }
                });

                //Label clear
                $('.basel-pf-checkboxes').on('click', '.selected-value', function () {
                    var $this = $(this);
                    var $widget = $this.parents('.basel-pf-checkboxes');
                    var $mainInput = $widget.find('.result-input');
                    var currentVal = $this.data('title');

                    //Price filter clear
                    if (currentVal == 'price-filter') {
                        var min = $this.data('min');
                        var max = $this.data('max');
                        var $slider = $widget.find('.price_slider_widget');
                        $slider.slider('values', 0, min);
                        $slider.slider('values', 1, max);
                        $widget.find('.min_price').val('');
                        $widget.find('.max_price').val('');
                        $(document.body).trigger('filter_price_slider_slide', [min, max, min, max, $slider]);
                        return;
                    }

                    removeValue($mainInput, currentVal);
                    $widget.find('.pf-value[data-val="' + currentVal + '"]').parent().removeClass('pf-active');
                    $this.remove();
                });

                //Checkboxes value dropdown
                $('.basel-pf-checkboxes').each(function () {
                    var $this = $(this);
                    var $btn = $this.find('.basel-pf-title');
                    var $list = $btn.siblings('.basel-pf-dropdown');
                    var multiSelect = $this.hasClass('multi_select');

                    $btn.on('click', function (e) {
                        var target = e.target;
                        if ($(target).is($btn.find('.selected-value'))) return;

                        if (!$this.hasClass('opened')) {
                            $this.addClass('opened');
                            $list.slideDown(100);
                            setTimeout(function () {
                                baselThemeModule.nanoScroller();
                            }, 300);
                        } else {
                            close();
                        }
                    });

                    $(document).on('click', function (e) {
                        var target = e.target;
                        if ($this.hasClass('opened') && (multiSelect && !$(target).is($this) && !$(target).parents().is($this)) || (!multiSelect && !$(target).is($btn) && !$(target).parents().is($btn))) {
                            close();
                        }
                    });

                    var close = function () {
                        $this.removeClass('opened');
                        $list.slideUp(100);
                    }
                });

                var removeEmptyValues = function ($selector) {
                    $selector.find('.basel-pf-checkboxes').each(function () {
                        if (!$(this).find('input[type="hidden"]').val()) {
                            $(this).find('input[type="hidden"]').remove();
                        }
                    });
                }

                var changeFormAction = function ($form) {
                    var activeCat = $form.find('.basel-pf-categories .pf-active .pf-value');
                    if (activeCat.length > 0) {
                        $form.attr('action', activeCat.attr('href'));
                    }
                }

                //Price slider init
                $(document.body).on('filter_price_slider_create filter_price_slider_slide', function (event, min, max, minPrice, maxPrice, $slider) {
                    var minHtml = accounting.formatMoney(min, {
                        symbol: woocommerce_price_slider_params.currency_format_symbol,
                        decimal: woocommerce_price_slider_params.currency_format_decimal_sep,
                        thousand: woocommerce_price_slider_params.currency_format_thousand_sep,
                        precision: woocommerce_price_slider_params.currency_format_num_decimals,
                        format: woocommerce_price_slider_params.currency_format
                    });

                    var maxHtml = accounting.formatMoney(max, {
                        symbol: woocommerce_price_slider_params.currency_format_symbol,
                        decimal: woocommerce_price_slider_params.currency_format_decimal_sep,
                        thousand: woocommerce_price_slider_params.currency_format_thousand_sep,
                        precision: woocommerce_price_slider_params.currency_format_num_decimals,
                        format: woocommerce_price_slider_params.currency_format
                    });

                    $slider.siblings('.filter_price_slider_amount').find('span.from').html(minHtml);
                    $slider.siblings('.filter_price_slider_amount').find('span.to').html(maxHtml);

                    var $results = $slider.parents('.basel-pf-checkboxes').find('.basel-pf-results');
                    var value = $results.find('.selected-value');
                    if (min == minPrice && max == maxPrice) {
                        value.remove();
                    } else {
                        if (value.length == 0) {
                            $results.prepend('<li class="selected-value" data-title="price-filter" data-min="' + minPrice + '" data-max="' + maxPrice + '">' + minHtml + ' - ' + maxHtml + '</li>');
                        } else {
                            value.html(minHtml + ' - ' + maxHtml);
                        }
                    }

                    $(document.body).trigger('price_slider_updated', [min, max]);
                });

                $('.basel-pf-price-range .price_slider_widget').each(function () {
                    var $this = $(this);
                    var $minInput = $this.siblings('.filter_price_slider_amount').find('.min_price');
                    var $maxInput = $this.siblings('.filter_price_slider_amount').find('.max_price');
                    var minPrice = parseInt($minInput.data('min'));
                    var maxPrice = parseInt($maxInput.data('max'));
                    var currentMinPrice = parseInt($minInput.val());
                    var currentMaxPrice = parseInt($maxInput.val());

                    $('.price_slider_widget, .price_label').show();

                    $this.slider({
                        range: true,
                        animate: true,
                        min: minPrice,
                        max: maxPrice,
                        values: [currentMinPrice, currentMaxPrice],
                        create: function () {
                            if (currentMinPrice == minPrice && currentMaxPrice == maxPrice) {
                                $minInput.val('');
                                $maxInput.val('');
                            }
                            $(document.body).trigger('filter_price_slider_create', [currentMinPrice, currentMaxPrice, minPrice, maxPrice, $this]);
                        },
                        slide: function (event, ui) {
                            if (ui.values[0] == minPrice && ui.values[1] == maxPrice) {
                                $minInput.val('');
                                $maxInput.val('');
                            } else {
                                $minInput.val(ui.values[0]);
                                $maxInput.val(ui.values[1]);
                            }
                            $(document.body).trigger('filter_price_slider_slide', [ui.values[0], ui.values[1], minPrice, maxPrice, $this]);
                        },
                        change: function (event, ui) {
                            $(document.body).trigger('price_slider_change', [ui.values[0], ui.values[1]]);
                        }
                    });
                });

                //Submit filter form
                $('.basel-product-filters').one('click', '.basel-pf-btn button', function (e) {
                    var $form = $(this).parents('.basel-product-filters');
                    removeEmptyValues($form);
                    changeFormAction($form);

                    if (typeof ($.fn.pjax) == 'undefined') return;
                    $.pjax({
                        container: '.main-page-wrapper',
                        timeout: basel_settings.pjax_timeout,
                        url: $form.attr('action'),
                        data: $form.serialize(),
                        scrollTo: false
                    });
                    $(this).prop('disabled', true);
                });

                //Create labels after ajax
                $('.basel-pf-checkboxes .pf-active > .pf-value').each(function () {
                    var resultsWrapper = $(this).parents('.basel-pf-checkboxes').find('.basel-pf-results');
                    resultsWrapper.prepend('<li class="selected-value" data-title="' + $(this).data('val') + '">' + $(this).data('title') + '</li>');
                });

            },

            /**
             *-------------------------------------------------------------------------------------------------------------------------------------------
             * Owl carousel init function
             *-------------------------------------------------------------------------------------------------------------------------------------------
             */

            owlCarouselInit: function () {
                $('[data-owl-carousel]').each(function () {
                    var $this = $(this);
                    var $owl = $this.find('.owl-carousel');
                    var options = {
                        rtl: $('body').hasClass('rtl'),
                        items: $this.data('desktop') ? $this.data('desktop') : 1,
                        responsive: {
                            979: {
                                items: $this.data('desktop') ? $this.data('desktop') : 1
                            },
                            768: {
                                items: $this.data('desktop_small') ? $this.data('desktop_small') : 1
                            },
                            479: {
                                items: $this.data('tablet') ? $this.data('tablet') : 1
                            },
                            0: {
                                items: $this.data('mobile') ? $this.data('mobile') : 1
                            }
                        },
                        autoplay: $this.data('autoplay') == 'yes' ? true : false,
                        autoplayHoverPause: $this.data('autoplay' == 'yes') ? true : false,
                        autoplayTimeout: $this.data('speed') ? $this.data('speed') : 5000,
                        dots: $this.data('hide_pagination_control') == 'yes' ? false : true,
                        nav: $this.data('hide_prev_next_buttons') == 'yes' ? false : true,
                        autoHeight: $this.data('autoheight') == 'yes' ? true : false,
                        slideBy: $this.data('scroll_per_page') == '' ? 1 : 'page',
                        navText: false,
                        center: $this.data('center_mode') == 'yes' ? true : false,
                        loop: $this.data('wrap') == 'yes' ? true : false,
                        dragEndSpeed: $this.data('dragendspeed') ? $this.data('dragendspeed') : 200,
                        onRefreshed: function () {
                            $(window).resize();
                        }
                    };

                    if ($this.data('sliding_speed')) {
                        options.smartSpeed = $this.data('sliding_speed');
                        options.dragEndSpeed = $this.data('sliding_speed');
                    }

                    if ($this.data('animation')) {
                        options.animateOut = $this.data('animation');
                        options.mouseDrag = false;
                    }

                    if ($this.data('content_animation')) {
                        function determinePseudoActive() {
                            var id = $owl.find('.owl-item.active').find('.basel-slide').attr('id');
                            $owl.find('.owl-item.pseudo-active').removeClass('pseudo-active');
                            var $els = $owl.find('[id="' + id + '"]');
                            $els.each(function () {
                                if (!$(this).parent().hasClass('active')) {
                                    $(this).parent().addClass('pseudo-active');
                                }
                            });
                        }
                        determinePseudoActive();
                        options.onTranslated = function () {
                            determinePseudoActive();
                        };
                    }

                    $(window).on('vc_js', function () {
                        $owl.trigger('refresh.owl.carousel');
                    });

                    $owl.owlCarousel(options);

                    if ($this.data('autoheight') == 'yes') {
                        $owl.imagesLoaded(function () {
                            $owl.trigger('refresh.owl.carousel');
                        });
                    }
                });
            },

            /**
             *-------------------------------------------------------------------------------------------------------------------------------------------
             * Basel slider lazyload
             *-------------------------------------------------------------------------------------------------------------------------------------------
             */

            baselSliderLazyLoad: function () {
                $('.basel-slider').on('changed.owl.carousel', function (event) {
                    var $this = $(this);
                    var active = $this.find('.owl-item').eq(event.item.index);
                    var id = active.find('.basel-slide').attr('id');
                    var $els = $this.find('[id="' + id + '"]');

                    active.find('.basel-slide').addClass('basel-loaded');
                    $els.each(function () {
                        $(this).addClass('basel-loaded');
                    });
                });
            },

            /**
             *-------------------------------------------------------------------------------------------------------------------------------------------
             * Lazy loading
             *-------------------------------------------------------------------------------------------------------------------------------------------
             */
            lazyLoading: function () {
                if (!window.addEventListener || !window.requestAnimationFrame || !document.getElementsByClassName) return;

                // start
                var pItem = document.getElementsByClassName('basel-lazy-load'), pCount, timer;

                $(document).on('basel-images-loaded added_to_cart', function () {
                    inView();
                })

                $('.basel-scroll-content, .basel-sidebar-content').scroll(function () {
                    $(document).trigger('basel-images-loaded');
                })
                // $(document).on( 'scroll', '.basel-scroll-content', function() {
                //     $(document).trigger('basel-images-loaded');
                // })

                // WooCommerce tabs fix
                $('.wc-tabs > li').on('click', function () {
                    $(document).trigger('basel-images-loaded');
                });

                // scroll and resize events
                window.addEventListener('scroll', scroller, false);
                window.addEventListener('resize', scroller, false);

                // DOM mutation observer
                if (MutationObserver) {

                    var observer = new MutationObserver(function () {
                        // console.log('mutated', pItem.length, pCount)
                        if (pItem.length !== pCount) inView();
                    });

                    observer.observe(document.body, { subtree: true, childList: true, attributes: true, characterData: true });

                }

                // initial check
                inView();

                // throttled scroll/resize
                function scroller() {

                    timer = timer || setTimeout(function () {
                            timer = null;
                            inView();
                        }, 100);

                }


                // image in view?
                function inView() {

                    if (pItem.length) requestAnimationFrame(function () {

                        var wT = window.pageYOffset, wB = wT + window.innerHeight, cRect, pT, pB, p = 0;

                        while (p < pItem.length) {

                            cRect = pItem[p].getBoundingClientRect();
                            pT = wT + cRect.top;
                            pB = pT + cRect.height;

                            if (wT < pB && wB > pT && !pItem[p].loaded) {
                                loadFullImage(pItem[p], p);
                            }
                            else p++;

                        }

                        pCount = pItem.length;

                    });

                }


                // replace with full image
                function loadFullImage(item, i) {

                    item.onload = addedImg;

                    item.src = item.dataset.baselSrc;
                    if (typeof (item.dataset.srcset) != 'undefined') {
                        item.srcset = item.dataset.srcset;
                    }

                    item.loaded = true

                    // replace image
                    function addedImg() {

                        requestAnimationFrame(function () {
                            item.classList.add('basel-loaded')

                            var $masonry = jQuery(item).parents('.view-masonry .gallery-images, .grid-masonry, .masonry-container');
                            if ($masonry.length > 0) {
                                $masonry.isotope('layout');
                            }
                            var $categories = jQuery(item).parents('.categories-masonry');
                            if ($categories.length > 0) {
                                $categories.packery();
                            }
                        });

                    }

                }

            },

            /**
             *-------------------------------------------------------------------------------------------------------------------------------------------
             * Product loder position
             *-------------------------------------------------------------------------------------------------------------------------------------------
             */
            productLoaderPosition: function () {
                var reculc = function () {
                    $('.basel-products-loader').each(function () {
                        var $loader = $(this),
                            $loaderWrap = $loader.parent();

                        if ($loader.length == 0) return;

                        $loader.css('left', $loaderWrap.offset().left + $loaderWrap.outerWidth() / 2);
                    });
                };

                $(window).on('resize', reculc);

                reculc();
            },
            /**
             *-------------------------------------------------------------------------------------------------------------------------------------------
             * Sticky sidebar button
             *-------------------------------------------------------------------------------------------------------------------------------------------
             */

            stickySidebarBtn: function () {
                var $trigger = $('.basel-show-sidebar-btn');
                var $stickyBtn = $('.shop-sidebar-opener');

                if ($stickyBtn.length <= 0 || $trigger.length <= 0 || $(window).width() >= 1024) return;

                var stickySidebarBtnToggle = function () {
                    var btnOffset = $trigger.offset().top + $trigger.outerHeight();
                    var windowScroll = $(window).scrollTop();

                    if (btnOffset < windowScroll) {
                        $stickyBtn.addClass('basel-sidebar-btn-shown');
                    } else {
                        $stickyBtn.removeClass('basel-sidebar-btn-shown');
                    }
                };

                stickySidebarBtnToggle();

                $(window).scroll(stickySidebarBtnToggle);
                $(window).resize(stickySidebarBtnToggle);
            },

            /**
             *-------------------------------------------------------------------------------------------------------------------------------------------
             * Sticky add to cart
             *-------------------------------------------------------------------------------------------------------------------------------------------
             */

            stickyAddToCart: function () {
                var $trigger = $('.summary-inner .cart');
                var $stickyBtn = $('.basel-sticky-btn');

                if ($stickyBtn.length <= 0 || $trigger.length <= 0 || ($(window).width() <= 768 && $stickyBtn.hasClass('mobile-off'))) return;

                var summaryOffset = $trigger.offset().top + $trigger.outerHeight();
                var $scrollToTop = $('.scrollToTop');

                var stickyAddToCartToggle = function () {
                    var windowScroll = $(window).scrollTop();
                    var windowHeight = $(window).height();
                    var documentHeight = $(document).height();

                    if (summaryOffset < windowScroll && windowScroll + windowHeight != documentHeight) {
                        $stickyBtn.addClass('basel-sticky-btn-shown');
                        $scrollToTop.addClass('basel-sticky-btn-shown');

                    } else if (windowScroll + windowHeight == documentHeight || summaryOffset > windowScroll) {
                        $stickyBtn.removeClass('basel-sticky-btn-shown');
                        $scrollToTop.removeClass('basel-sticky-btn-shown');
                    }
                };

                stickyAddToCartToggle();

                $(window).scroll(stickyAddToCartToggle);

                $('.basel-sticky-add-to-cart').on('click', function (e) {
                    e.preventDefault();
                    $('html, body').animate({
                        scrollTop: $('.summary-inner').offset().top
                    }, 800);
                });

                $('.basel-sticky-btn-wishlist').on('click', function (e) {
                    if (!$(this).hasClass('exists')) e.preventDefault();
                    $('.summary-inner .basel-scroll-content > .yith-wcwl-add-to-wishlist .add_to_wishlist').trigger('click');
                });

                $('body').on('added_to_wishlist', function () {
                    $('.basel-sticky-btn-wishlist').addClass('exists');
                });
            },

            /**
             *-------------------------------------------------------------------------------------------------------------------------------------------
             * Shop loader position
             *-------------------------------------------------------------------------------------------------------------------------------------------
             */

            shopLoader: function () {

                var loaderClass = '.basel-shop-loader',
                    contentClass = '.products[data-source="main_loop"]',
                    sidebarClass = '.area-sidebar-shop',
                    sidebarLeftClass = 'sidebar-left',
                    hiddenClass = 'hidden-loader',
                    hiddenTopClass = 'hidden-from-top',
                    hiddenBottomClass = 'hidden-from-bottom';

                var loaderVerticalPosition = function () {
                    var $products = $(contentClass),
                        $loader = $products.parent().find(loaderClass);

                    if ($products.length < 1) return;

                    var offset = $(window).height() / 2,
                        scrollTop = $(window).scrollTop(),
                        holderTop = $products.offset().top - offset,
                        holderHeight = $products.height(),
                        holderBottom = holderTop + holderHeight - 100;

                    if (scrollTop < holderTop) {
                        $loader.addClass(hiddenClass + ' ' + hiddenTopClass);
                    } else if (scrollTop > holderBottom) {
                        $loader.addClass(hiddenClass + ' ' + hiddenBottomClass);
                    } else {
                        $loader.removeClass(hiddenClass + ' ' + hiddenTopClass + ' ' + hiddenBottomClass);
                    }
                };

                var loaderHorizontalPosition = function () {
                    var $products = $(contentClass),
                        $sidebar = $(sidebarClass),
                        $loader = $products.parent().find(loaderClass),
                        sidebarWidth = $sidebar.outerWidth();

                    if ($products.length < 1) return;

                    if (sidebarWidth > 0 && $sidebar.hasClass(sidebarLeftClass)) {
                        if ($('body').hasClass('rtl')) {
                            $loader.css({
                                'marginLeft': - sidebarWidth / 2 - 15
                            })
                        } else {
                            $loader.css({
                                'marginLeft': sidebarWidth / 2 - 15
                            })
                        }
                    } else if (sidebarWidth > 0) {
                        if ($('body').hasClass('rtl')) {
                            $loader.css({
                                'marginLeft': sidebarWidth / 2 - 15
                            })
                        } else {
                            $loader.css({
                                'marginLeft': - sidebarWidth / 2 - 15
                            })
                        }
                    }

                };

                $(window).off('scroll.loaderVerticalPosition');
                $(window).off('loaderHorizontalPosition');

                $(window).on('scroll.loaderVerticalPosition', loaderVerticalPosition);
                $(window).on('resize.loaderHorizontalPosition', loaderHorizontalPosition);

                loaderVerticalPosition();
                loaderHorizontalPosition();

            },

            /**
             *-------------------------------------------------------------------------------------------------------------------------------------------
             * Login sidebar
             *-------------------------------------------------------------------------------------------------------------------------------------------
             */

            loginSidebar: function () {
                var body = $('body');

                $('.login-side-opener').on('click', function (e) {
                    e.preventDefault();
                    if (isOpened()) {
                        closeWidget();
                    } else {
                        setTimeout(function () {
                            openWidget();
                        }, 10);
                    }
                });

                body.on('click touchstart', '.basel-close-side', function () {
                    if (isOpened()) closeWidget();
                });

                body.on('click', '.widget-close', function (e) {
                    e.preventDefault();
                    if (isOpened()) closeWidget();
                });

                var closeWidget = function () {
                    body.removeClass('basel-login-side-opened');
                };

                var openWidget = function () {
                    body.addClass('basel-login-side-opened');
                };

                var isOpened = function () {
                    return body.hasClass('basel-login-side-opened');
                };

            },

            /**
             *-------------------------------------------------------------------------------------------------------------------------------------------
             * Header banner
             *-------------------------------------------------------------------------------------------------------------------------------------------
             */

            headerBanner: function () {
                var banner_version = basel_settings.header_banner_version,
                    banner_btn = basel_settings.header_banner_close_btn,
                    banner_enabled = basel_settings.header_banner_enabled;
                if (Cookies.get('basel_tb_banner_' + banner_version) == 'closed' || banner_btn == false || banner_enabled == false) return;
                var banner = $('.header-banner');

                if (!$('body').hasClass('page-template-maintenance')) {
                    $('body').addClass('header-banner-display');
                }

                banner.on('click', '.close-header-banner', function (e) {
                    e.preventDefault();
                    closeBanner();
                })

                var closeBanner = function () {
                    $('body').removeClass('header-banner-display').addClass('header-banner-hide');
                    Cookies.set('basel_tb_banner_' + banner_version, 'closed', { expires: 60, path: '/' });
                };

            },

            /**
             *-------------------------------------------------------------------------------------------------------------------------------------------
             * Hidden sidebar button
             *-------------------------------------------------------------------------------------------------------------------------------------------
             */
            shopHiddenSidebar: function () {

                $('body').on('click', '.basel-show-sidebar-btn, .basel-sticky-sidebar-opener', function (e) {
                    e.preventDefault();
                    if ($('.sidebar-container').hasClass('show-hidden-sidebar')) {
                        baselThemeModule.hideShopSidebar();
                    } else {
                        showSidebar();
                    }
                });

                $('body').on('click touchstart', '.basel-close-side, .basel-close-sidebar-btn', function () {
                    baselThemeModule.hideShopSidebar();
                });

                var showSidebar = function () {
                    $('.sidebar-container').addClass('show-hidden-sidebar');
                    $('body').addClass('basel-show-hidden-sidebar');
                    $('.basel-show-sidebar-btn').addClass('btn-clicked');

                    if ($(window).width() >= 1024) {
                        $('.sidebar-inner.basel-sidebar-scroll').nanoScroller({
                            paneClass: 'basel-scroll-pane',
                            sliderClass: 'basel-scroll-slider',
                            contentClass: 'basel-sidebar-content',
                            preventPageScrolling: false
                        });
                    }
                };
            },

            hideShopSidebar: function () {
                $('.basel-show-sidebar-btn').removeClass('btn-clicked');
                $('.sidebar-container').removeClass('show-hidden-sidebar');
                $('body').removeClass('basel-show-hidden-sidebar');
                $('.sidebar-inner.basel-scroll').nanoScroller({ destroy: true });
            },

            /**
             *-------------------------------------------------------------------------------------------------------------------------------------------
             * Mobile search icon
             *-------------------------------------------------------------------------------------------------------------------------------------------
             */

            mobileSearchIcon: function () {
                var body = $('body');
                $('.mobile-search-icon.search-button').on('click', function (e) {
                    if ($(window).width() > 1024) return;

                    e.preventDefault();
                    if (!body.hasClass('act-mobile-menu')) {
                        body.addClass('act-mobile-menu');
                        $('.mobile-nav .searchform').find('input[type="text"]').focus();
                    }
                });

            },

            /**
             *-------------------------------------------------------------------------------------------------------------------------------------------
             * Content in popup element
             *-------------------------------------------------------------------------------------------------------------------------------------------
             */

            contentPopup: function () {
                $('.basel-popup-with-content').magnificPopup({
                    type: 'inline',
                    removalDelay: 500, //delay removal by X to allow out-animation
                    tClose: basel_settings.close,
                    tLoading: basel_settings.loading,
                    callbacks: {
                        beforeOpen: function () {
                            this.st.mainClass = baselTheme.popupEffect + ' content-popup-wrapper';
                        },
                        open: function () {
                            $(document).trigger('basel-images-loaded');
                        }
                    }
                });
            },

            /**
             *-------------------------------------------------------------------------------------------------------------------------------------------
             * AJAX adicionar ao carrinho para todos os tipos de produtos
             *-------------------------------------------------------------------------------------------------------------------------------------------
             */


            addToCartAllTypes: function () {
                if (basel_settings.ajax_add_to_cart == false) return;


                $('body').on('submit', 'form.cart', function (e) {
                    var $productWrapper = $(this).parents('.single-product-page');
                    if ($productWrapper.hasClass('product-type-external') || $productWrapper.hasClass('product-type-zakeke')) return;

                    e.preventDefault();

                    var $form = $(this),
                        $thisbutton = $form.find('.button'),
                        data = $form.serialize();

                    data += '&action=basel_ajax_add_to_cart';

                    if ($thisbutton.val()) {
                        data += '&add-to-cart=' + $thisbutton.val();
                    }

                    $thisbutton.removeClass('added not-added');
                    $thisbutton.addClass('loading');

                    // Trigger event
                    $(document.body).trigger('adding_to_cart', [$thisbutton, data]);

                    $.ajax({
                        url: basel_settings.ajaxurl,
                        data: data,
                        method: 'POST',
                        success: function (response) {
                            if (!response) {
                                return;
                            }

                            var this_page = window.location.toString();

                            this_page = this_page.replace('add-to-cart', 'added-to-cart');

                            if (response.error && response.product_url) {
                                window.location = response.product_url;
                                return;
                            }

                            // Redirect to cart option
                            if (wc_add_to_cart_params.cart_redirect_after_add === 'yes') {

                                window.location = wc_add_to_cart_params.cart_url;
                                return;

                            } else {

                                $thisbutton.removeClass('loading');

                                var fragments = response.fragments;
                                var cart_hash = response.cart_hash;


                                // Block fragments class
                                if (fragments) {
                                    $.each(fragments, function (key) {
                                        $(key).addClass('updating');
                                    });
                                }

                                // Replace fragments
                                if (fragments) {
                                    $.each(fragments, function (key, value) {
                                        $(key).replaceWith(value);
                                    });
                                }

                                // Show notices
                                if (response.notices.indexOf('error') > 0) {
                                    if ($('.woocommerce-error').length > 0) $('.woocommerce-error').remove();
                                    $('.single-product-content').prepend(response.notices);
                                    $thisbutton.addClass('not-added');
                                } else {
                                    if (basel_settings.add_to_cart_action == 'widget')
                                        $.magnificPopup.close();

                                    // Changes button classes
                                    $thisbutton.addClass('added');
                                    // Trigger event so themes can refresh other areas
                                    $(document.body).trigger('added_to_cart', [fragments, cart_hash, $thisbutton]);
                                }

                            }
                        },
                        error: function () {
                            console.log('ajax adding to cart error');
                        },
                        complete: function () { },
                    });

                });

            },


            initZoom: function () {
                if (basel_settings.zoom_enable != 'yes') return false;

                var $zoomTarget = $('.woocommerce-product-gallery__image:not(:first)'),
                    zoomEnabled = false;

                $($zoomTarget).each(function (index, target) {
                    var image = $(target).find('img');
                    if (image.data('large_image_width') > $('.woocommerce-product-gallery').width()) {
                        zoomEnabled = true;
                        return false;
                    }
                });

                // But only zoom if the img is larger than its container.
                if (zoomEnabled) {
                    var zoomOptions = {
                        touch: false
                    };

                    if ('ontouchstart' in window) {
                        zoomOptions.on = 'click';
                    }

                    $zoomTarget.trigger('zoom.destroy');
                    $zoomTarget.zoom(zoomOptions);
                }
            },

            videoPoster: function () {
                $('.basel-video-poster-wrapper').on('click', function () {
                    var videoWrapper = $(this),
                        video = videoWrapper.siblings('iframe'),
                        videoScr = video.attr('src'),
                        videoNewSrc = videoScr + '&autoplay=1';

                    if (videoScr.indexOf('vimeo.com') + 1) {
                        videoNewSrc = videoScr + '?autoplay=1';
                    }
                    video.attr('src', videoNewSrc);
                    videoWrapper.addClass('hidden-poster');
                })
            },

            fixedHeaders: function () {

                var getHeaderHeight = function () {
                    var headerHeight = header.outerHeight();

                    if (body.hasClass('sticky-navigation-only')) {
                        headerHeight = header.find('.navigation-wrap').outerHeight();
                    }

                    return headerHeight;
                };

                var headerSpacer = function () {
                    if (stickyHeader.hasClass(headerStickedClass)) return;
                    $('.header-spacing').height(getHeaderHeight()).css('marginBottom', 40);
                };

                var body = $("body"),
                    header = $(".main-header"),
                    stickyHeader = header,
                    headerHeight = getHeaderHeight(),
                    headerStickedClass = "act-scroll",
                    stickyClasses = '',
                    stickyStart = 0,
                    links = header.find('.main-nav .menu>li>a');

                if (!body.hasClass('enable-sticky-header') || body.hasClass('global-header-vertical') || header.length == 0) return;

                var logo = header.find(".site-logo").clone().html(),
                    navigation = header.find(".main-nav").clone().html(),
                    rightColumn = header.find(".right-column").clone().html();

                var headerClone = [
                    '<div class="sticky-header header-clone">',
                    '<div class="container">',
                    '<div class="site-logo">' + logo + '</div>',
                    '<div class="main-nav site-navigation basel-navigation">' + navigation + '</div>',
                    '<div class="right-column">' + rightColumn + '</div>',
                    '</div>',
                    '</div>',
                ].join('');


                if ($('.topbar-wrapp').length > 0) {
                    stickyStart = $('.topbar-wrapp').outerHeight();
                }

                if ($('.header-banner').length > 0 && body.hasClass('header-banner-display')) {
                    stickyStart += $('.header-banner').outerHeight();
                }

                if (body.hasClass('sticky-header-real')) {
                    var headerSpace = $('<div/>').addClass('header-spacing');
                    header.before(headerSpace);

                    $(window).on('resize', headerSpacer);

                    var timeout;

                    $(window).on("scroll", function (e) {
                        if (body.hasClass('header-banner-hide')) {
                            stickyStart = ($('.topbar-wrapp').length > 0) ? $('.topbar-wrapp').outerHeight() : 0;
                        }
                        if ($(this).scrollTop() > stickyStart) {
                            stickyHeader.addClass(headerStickedClass);
                        } else {
                            stickyHeader.removeClass(headerStickedClass);
                            clearTimeout(timeout);
                            timeout = setTimeout(function () {
                                headerSpacer();
                            }, 200);
                        }
                    });

                } else if (body.hasClass('sticky-header-clone')) {
                    header.before(headerClone);
                    stickyHeader = $('.sticky-header');
                }

                // Change header height smooth on scroll
                if (body.hasClass('basel-header-smooth')) {

                    $(window).on("scroll", function (e) {
                        var space = (120 - $(this).scrollTop()) / 2;

                        if (space >= 60) {
                            space = 60;
                        } else if (space <= 30) {
                            space = 30;
                        }
                        links.css({
                            paddingTop: space,
                            paddingBottom: space
                        });
                    });

                }

                if (body.hasClass("basel-header-overlap") || body.hasClass('sticky-navigation-only')) {
                }


                if (!body.hasClass("basel-header-overlap") && body.hasClass("sticky-header-clone")) {
                    header.attr('class').split(' ').forEach(function (el) {
                        if (el.indexOf('main-header') == -1 && el.indexOf('header-') == -1) {
                            stickyClasses += ' ' + el;
                        }
                    });

                    stickyHeader.addClass(stickyClasses);

                    stickyStart += headerHeight;

                    $(window).on("scroll", function (e) {
                        if (body.hasClass('header-banner-hide')) {
                            stickyStart = $('.topbar-wrapp').outerHeight() + headerHeight;
                        }
                        if ($(this).scrollTop() > stickyStart) {
                            stickyHeader.addClass(headerStickedClass);
                        } else {
                            stickyHeader.removeClass(headerStickedClass);
                        }
                    });
                }

                body.addClass('sticky-header-prepared');
            },

            /**
             *-------------------------------------------------------------------------------------------------------------------------------------------
             * Vertical header
             *-------------------------------------------------------------------------------------------------------------------------------------------
             */

            verticalHeader: function () {

                var $header = $('.header-vertical').first();

                if ($header.length < 1) return;

                var $body, $window, $sidebar, top = false,
                    bottom = false, windowWidth, adminOffset, windowHeight, lastWindowPos = 0,
                    topOffset = 0, bodyHeight, headerHeight, resizeTimer, Y = 0, delta,
                    headerBottom, viewportBottom, scrollStep;

                $body = $(document.body);
                $window = $(window);
                adminOffset = $body.is('.admin-bar') ? $('#wpadminbar').height() : 0;

                $window
                    .on('scroll', scroll)
                    .on('resize', function () {
                        clearTimeout(resizeTimer);
                        resizeTimer = setTimeout(resizeAndScroll, 500);
                    });

                resizeAndScroll();

                for (var i = 1; i < 6; i++) {
                    setTimeout(resizeAndScroll, 100 * i);
                }


                // Sidebar scrolling.
                function resize() {
                    windowWidth = $window.width();

                    if (1024 > windowWidth) {
                        top = bottom = false;
                        $header.removeAttr('style');
                    }
                }

                function scroll() {
                    var windowPos = $window.scrollTop();

                    if (1024 > windowWidth) {
                        return;
                    }

                    headerHeight = $header.height();
                    headerBottom = headerHeight + $header.offset().top;
                    windowHeight = $window.height();
                    bodyHeight = $body.height();
                    viewportBottom = windowHeight + $window.scrollTop();
                    delta = headerHeight - windowHeight;
                    scrollStep = lastWindowPos - windowPos;

                    // console.log('header bottom ', headerBottom);
                    // console.log('viewport bottom ', viewportBottom);
                    // console.log('Y ', Y);
                    // console.log('delta  ', delta);
                    // console.log('scrollStep  ', scrollStep);

                    // If header height larger than window viewport
                    if (delta > 0) {
                        // Scroll down
                        if (windowPos > lastWindowPos) {

                            // If bottom overflow

                            if (headerBottom > viewportBottom) {
                                Y += scrollStep;
                            }

                            if (Y < -delta) {
                                bottom = true;
                                Y = -delta;
                            }

                            top = false;

                        } else if (windowPos < lastWindowPos) { // Scroll up

                            // If top overflow

                            if ($header.offset().top < $window.scrollTop()) {
                                Y += scrollStep;
                            }

                            if (Y >= 0) {
                                top = true;
                                Y = 0;
                            }

                            bottom = false;

                        } else {

                            if (headerBottom < viewportBottom) {
                                Y = windowHeight - headerHeight;
                            }

                            if (Y >= 0) {
                                top = true;
                                Y = 0;
                            }
                        }
                    } else {
                        Y = 0;
                    }

                    // Change header Y coordinate
                    $header.css({
                        top: Y
                    });

                    lastWindowPos = windowPos;
                }

                function resizeAndScroll() {
                    resize();
                    scroll();
                }

            },


            /**
             *-------------------------------------------------------------------------------------------------------------------------------------------
             * Split navigation header
             *-------------------------------------------------------------------------------------------------------------------------------------------
             */

            splitNavHeader: function () {

                var header = $('.header-split');

                if (header.length <= 0) return;

                var navigation = header.find('.main-nav'),
                    navItems = navigation.find('.menu > li'),
                    itemsNumber = navItems.length,
                    rtl = $('body').hasClass('rtl'),
                    midIndex = parseInt(itemsNumber / 2 + 0.5 * rtl - .5),
                    midItem = navItems.eq(midIndex),
                    logo = header.find('.site-logo > .basel-logo-wrap'),
                    logoWidth,
                    leftWidth = 0,
                    rule = (!rtl) ? 'marginRight' : 'marginLeft',
                    rightWidth = 0;

                var recalc = function () {
                    logoWidth = logo.outerWidth(),
                        leftWidth = 5,
                        rightWidth = 0;

                    for (var i = itemsNumber - 1; i >= 0; i--) {
                        var itemWidth = navItems.eq(i).outerWidth();
                        if (i > midIndex) {
                            rightWidth += itemWidth;
                        } else {
                            leftWidth += itemWidth;
                        }
                    };

                    var diff = leftWidth - rightWidth;

                    if (rtl) {
                        if (leftWidth > rightWidth) {
                            navigation.find('.menu > li:first-child').css('marginRight', -diff);
                        } else {
                            navigation.find('.menu > li:last-child').css('marginLeft', diff + 5);
                        }
                    } else {
                        if (leftWidth > rightWidth) {
                            navigation.find('.menu > li:last-child').css('marginRight', diff + 5);
                        } else {
                            navigation.find('.menu > li:first-child').css('marginLeft', -diff);
                        }
                    }

                    midItem.css(rule, logoWidth);
                };

                logo.imagesLoaded(function () {
                    recalc();
                    header.addClass('menu-calculated');
                });

                $(window).on('resize', recalc);

                if (basel_settings.split_nav_fix) {
                    $(window).on('scroll', function () {
                        if (header.hasClass('act-scroll') && !header.hasClass('menu-sticky-calculated')) {
                            recalc();
                            header.addClass('menu-sticky-calculated');
                            header.removeClass('menu-calculated');
                        }
                        if (!header.hasClass('act-scroll') && !header.hasClass('menu-calculated')) {
                            recalc();
                            header.addClass('menu-calculated');
                            header.removeClass('menu-sticky-calculated');
                        }
                    });
                }

            },

            /**
             *-------------------------------------------------------------------------------------------------------------------------------------------
             * Counter shortcode method
             *-------------------------------------------------------------------------------------------------------------------------------------------
             */
            counterShortcode: function (counter) {
                if (counter.attr('data-state') == 'done' || counter.text() != counter.data('final')) {
                    return;
                }
                counter.prop('Counter', 0).animate({
                    Counter: counter.text()
                }, {
                    duration: 3000,
                    easing: 'swing',
                    step: function (now) {
                        if (now >= counter.data('final')) {
                            counter.attr('data-state', 'done');
                        }
                        counter.text(Math.ceil(now));
                    }
                });
            },

            /**
             *-------------------------------------------------------------------------------------------------------------------------------------------
             * Activate methods in viewport
             *-------------------------------------------------------------------------------------------------------------------------------------------
             */
            visibleElements: function () {

                $('.basel-counter .counter-value').each(function () {
                    $(this).waypoint(function () {
                        baselThemeModule.counterShortcode($(this));
                    }, { offset: '100%' });
                });

            },

            /**
             *-------------------------------------------------------------------------------------------------------------------------------------------
             * add class in wishlist
             *-------------------------------------------------------------------------------------------------------------------------------------------
             */

            wishList: function () {
                var body = $("body");

                body.on("click", ".add_to_wishlist", function () {

                    $(this).parent().addClass("feid-in");

                });

            },


            /**
             *-------------------------------------------------------------------------------------------------------------------------------------------
             * Compare button
             *-------------------------------------------------------------------------------------------------------------------------------------------
             */

            compare: function () {
                var body = $("body"),
                    button = $("a.compare");

                body.on("click", "a.compare", function () {
                    $(this).addClass("loading");
                });

                body.on("yith_woocompare_open_popup", function () {
                    button.removeClass("loading");
                    body.addClass("compare-opened");
                });

                body.on('click', '#cboxClose, #cboxOverlay', function () {
                    body.removeClass("compare-opened");
                });

            },

            /**
             *-------------------------------------------------------------------------------------------------------------------------------------------
             * Basel compare functions
             *-------------------------------------------------------------------------------------------------------------------------------------------
             */
            baselCompare: function () {
                var cookiesName = 'basel_compare_list';

                if (basel_settings.is_multisite) {
                    cookiesName += '_' + basel_settings.current_blog_id;
                }

                var $body = $("body"),
                    $widget = $('.basel-compare-info-widget'),
                    compareCookie = Cookies.get(cookiesName);

                if ($widget.length > 0) {
                    try {
                        var ids = JSON.parse(compareCookie);
                        $widget.find('.compare-count').text(ids.length);
                    } catch (e) {
                        console.log('cant parse cookies json');
                    }
                }
                // Add to compare action

                $body.on('click', '.basel-compare-btn a, a.basel-compare-btn', function (e) {
                    var $this = $(this),
                        id = $this.data('id'),
                        addedText = $this.data('added-text');

                    if ($this.hasClass('added')) return true;

                    e.preventDefault();

                    $this.addClass('loading');

                    jQuery.ajax({
                        url: basel_settings.compare_url,
                        data: {
                            action: 'basel_add_to_compare',
                            id: id,
                            _token: basel_settings.csrf_token
                        },
                        dataType: 'json',
                        method: 'GET',
                        success: function (response) {
                            if (response.table) {
                                updateCompare(response);
                            } else {
                                console.log('something wrong loading compare data ', response);
                            }
                        },
                        error: function (data) {
                            console.log('We cant add to compare. Something wrong with AJAX response. Probably some PHP conflict.');
                        },
                        complete: function () {
                            $this.removeClass('loading').addClass('added');

                            if ($this.find('span').length > 0) {
                                $this.find('span').text(addedText);
                            } else {
                                $this.text(addedText);
                            }
                        },
                    });

                });

                // Remove from compare action

                $body.on('click', '.basel-compare-remove', function (e) {
                    var $table = $('.basel-compare-table');

                    e.preventDefault();
                    var $this = $(this),
                        id = $this.data('id');

                    $table.addClass('loading');
                    $this.addClass('loading');

                    jQuery.ajax({
                        url: basel_settings.ajaxurl,
                        data: {
                            action: 'basel_remove_from_compare',
                            id: id
                        },
                        dataType: 'json',
                        method: 'GET',
                        success: function (response) {
                            if (response.table) {
                                updateCompare(response);
                            } else {
                                console.log('something wrong loading compare data ', response);
                            }
                        },
                        error: function (data) {
                            console.log('We cant remove product compare. Something wrong with AJAX response. Probably some PHP conflict.');
                        },
                        complete: function () {
                            $table.removeClass('loading');
                            $this.addClass('loading');
                        },
                    });

                });

                // Elements update after ajax

                function updateCompare(data) {
                    if ($widget.length > 0) {
                        $widget.find('.compare-count').text(data.count);
                    }

                    if ($('.basel-compare-table').length > 0) {
                        $('.basel-compare-table').replaceWith(data.table);
                    }

                }

            },

            /**
             *-------------------------------------------------------------------------------------------------------------------------------------------
             * Promo popup
             *-------------------------------------------------------------------------------------------------------------------------------------------
             */

            promoPopup: function () {
                var promo_version = basel_settings.promo_version;

                if ($('body').hasClass('page-template-maintenance') || basel_settings.enable_popup != 'yes' || (basel_settings.promo_popup_hide_mobile == 'yes' && $(window).width() < 768)) return;

                var popup = $('.basel-promo-popup'),
                    shown = false,
                    pages = Cookies.get('basel_shown_pages');

                var showPopup = function () {
                    $.magnificPopup.open({
                        items: {
                            src: '.basel-promo-popup'
                        },
                        type: 'inline',
                        removalDelay: 400, //delay removal by X to allow out-animation
                        tClose: basel_settings.close,
                        tLoading: basel_settings.loading,
                        callbacks: {
                            beforeOpen: function () {
                                this.st.mainClass = 'basel-popup-effect';
                            },
                            open: function () {
                                // Will fire when this exact popup is opened
                                // this - is Magnific Popup object
                            },
                            close: function () {
                                Cookies.set('basel_popup_' + promo_version, 'shown', { expires: 7, path: '/' });
                            }
                            // e.t.c.
                        }
                    });
                    $(document).trigger('basel-images-loaded');
                };

                $('.basel-open-popup').on('click', function (e) {
                    e.preventDefault();
                    showPopup();
                })

                if (!pages) pages = 0;

                if (pages < basel_settings.popup_pages) {
                    pages++;
                    Cookies.set('basel_shown_pages', pages, { expires: 7, path: '/' });
                    return false;
                }

                if (Cookies.get('basel_popup_' + promo_version) != 'shown') {
                    if (basel_settings.popup_event == 'scroll') {
                        $(window).scroll(function () {
                            if (shown) return false;
                            if ($(document).scrollTop() >= basel_settings.popup_scroll) {
                                showPopup();
                                shown = true;
                            }
                        });
                    } else {
                        setTimeout(function () {
                            showPopup();
                        }, basel_settings.popup_delay);
                    }
                }

            },


            /**
             *-------------------------------------------------------------------------------------------------------------------------------------------
             * Product video button
             *-------------------------------------------------------------------------------------------------------------------------------------------
             */

            productVideo: function () {
                $('.product-video-button a').magnificPopup({
                    tClose: basel_settings.close,
                    tLoading: basel_settings.loading,
                    type: 'iframe',
                    iframe: {
                        patterns: {
                            youtube: {
                                index: 'youtube.com/',
                                id: 'v=',
                                src: '//www.youtube.com/embed/%id%?rel=0&autoplay=1'
                            }
                        }
                    },
                    mainClass: 'mfp-fade',
                    removalDelay: 160,
                    preloader: false,
                    disableOn: false,
                    fixedContentPos: false
                });
            },


            /**
             *-------------------------------------------------------------------------------------------------------------------------------------------
             * Product 360 button
             *-------------------------------------------------------------------------------------------------------------------------------------------
             */

            product360Button: function () {
                $('.product-360-button a').magnificPopup({
                    tClose: basel_settings.close,
                    tLoading: basel_settings.loading,
                    type: 'inline',
                    mainClass: 'mfp-fade',
                    removalDelay: 160,
                    disableOn: false,
                    preloader: false,
                    fixedContentPos: false,
                    callbacks: {
                        open: function () {
                            $(window).resize()
                        },
                    },

                });
            },

            /**
             *-------------------------------------------------------------------------------------------------------------------------------------------
             * Cookies law
             *-------------------------------------------------------------------------------------------------------------------------------------------
             */

            cookiesPopup: function () {
                var cookies_version = basel_settings.cookies_version;
                if (Cookies.get('basel_cookies_' + cookies_version) == 'accepted') return;
                var popup = $('.basel-cookies-popup');

                setTimeout(function () {
                    popup.addClass('popup-display');
                    popup.on('click', '.cookies-accept-btn', function (e) {
                        e.preventDefault();
                        acceptCookies();
                    })
                }, 2500);

                var acceptCookies = function () {
                    popup.removeClass('popup-display').addClass('popup-hide');
                    Cookies.set('basel_cookies_' + cookies_version, 'accepted', { expires: 60, path: '/' });
                };
            },

            /**
             *-------------------------------------------------------------------------------------------------------------------------------------------
             * Google map
             *-------------------------------------------------------------------------------------------------------------------------------------------
             */

            googleMap: function () {
                var gmap = $(".google-map-container-with-content");

                $(window).resize(function () {
                    gmap.css({
                        'height': gmap.find('.basel-google-map.with-content').outerHeight()
                    })
                });

            },

            /**
             *-------------------------------------------------------------------------------------------------------------------------------------------
             * mobile responsive navigation
             *-------------------------------------------------------------------------------------------------------------------------------------------
             */

            woocommerceWrappTable: function () {

                var wooTable = $(".woocommerce .shop_table:not(.wishlist_table)");

                var cartTotals = $(".woocommerce .cart_totals table");

                wooTable.wrap("<div class='responsive-table'></div>");

                cartTotals.wrap("<div class='responsive-table'></div>");

            },


            /**
             *-------------------------------------------------------------------------------------------------------------------------------------------
             * Menu preparation
             *-------------------------------------------------------------------------------------------------------------------------------------------
             */

            menuSetUp: function () {
                var mainMenu = $('.basel-navigation').find('ul.menu'),
                    lis = mainMenu.find(' > li'),
                    openedClass = 'item-menu-opened';

                mainMenu.on('click', ' > .item-event-click.menu-item-has-children > a', function (e) {
                    e.preventDefault();
                    if (!$(this).parent().hasClass(openedClass)) {
                        $('.' + openedClass).removeClass(openedClass);
                    }
                    $(this).parent().toggleClass(openedClass);
                });

                $(document).on('click', function (e) {
                    var target = e.target;
                    if ($('.' + openedClass).length > 0 && !$(target).is('.item-event-hover') && !$(target).parents().is('.item-event-hover') && !$(target).parents().is('.' + openedClass + '')) {
                        mainMenu.find('.' + openedClass + '').removeClass(openedClass);
                        return false;
                    }
                });

                var menuForIPad = function () {
                    if ($(window).width() <= 1024) {
                        mainMenu.find(' > .item-event-hover').each(function () {
                            $(this).data('original-event', 'hover').removeClass('item-event-hover').addClass('item-event-click');
                        });
                    } else {
                        mainMenu.find(' > .item-event-click').each(function () {
                            if ($(this).data('original-event') == 'hover') {
                                $(this).removeClass('item-event-click').addClass('item-event-hover');
                            }
                        });
                    }
                };

                $(window).on('resize', menuForIPad);
            },

            /**
             *-------------------------------------------------------------------------------------------------------------------------------------------
             * Keep navigation dropdowns in the screen
             *-------------------------------------------------------------------------------------------------------------------------------------------
             */

            menuOffsets: function () {

                var $window = $(window),
                    $header = $('.main-header'),
                    mainMenu = $('.main-nav').find('ul.menu'),
                    lis = mainMenu.find(' > li.menu-item-design-sized');


                mainMenu.on('hover', ' > li', function (e) {
                    setOffset($(this));
                });

                var setOffset = function (li) {

                    var dropdown = li.find(' > .sub-menu-dropdown'),
                        siteWrapper = $('.website-wrapper');


                    dropdown.attr('style', '');

                    var dropdownWidth = dropdown.outerWidth(),
                        dropdownOffset = dropdown.offset(),
                        screenWidth = $window.width(),
                        bodyRight = siteWrapper.outerWidth() + siteWrapper.offset().left,
                        viewportWidth = ($('body').hasClass('wrapper-boxed') || $('body').hasClass('wrapper-boxed-small')) ? bodyRight : screenWidth;

                    if (!dropdownWidth || !dropdownOffset) return;

                    if ($('body').hasClass('rtl') && dropdownOffset.left <= 0 && li.hasClass('menu-item-design-sized') && !$header.hasClass('header-vertical')) {
                        // If right point is not in the viewport
                        var toLeft = - dropdownOffset.left;

                        dropdown.css({
                            right: - toLeft - 10
                        });

                        var beforeSelector = '.' + li.attr('class').split(' ').join('.') + '> .sub-menu-dropdown:before',
                            arrowOffset = toLeft + li.width() / 2;

                    } else if (dropdownOffset.left + dropdownWidth >= viewportWidth && li.hasClass('menu-item-design-sized') && !$header.hasClass('header-vertical')) {
                        // If right point is not in the viewport
                        var toRight = dropdownOffset.left + dropdownWidth - viewportWidth;

                        dropdown.css({
                            left: - toRight - 10
                        });

                        var beforeSelector = '.' + li.attr('class').split(' ').join('.') + '> .sub-menu-dropdown:before',
                            arrowOffset = toRight + li.width() / 2;

                    }

                    // Vertical header fit
                    if ($header.hasClass('header-vertical')) {

                        var bottom = dropdown.offset().top + dropdown.outerHeight(),
                            viewportBottom = $window.scrollTop() + $window.outerHeight();

                        if (bottom > viewportBottom) {
                            dropdown.css({
                                top: viewportBottom - bottom - 10
                            });
                        }
                    }
                };

                lis.each(function () {
                    setOffset($(this));
                    $(this).addClass('with-offsets');
                });

            },


            /**
             *-------------------------------------------------------------------------------------------------------------------------------------------
             * One page menu
             *-------------------------------------------------------------------------------------------------------------------------------------------
             */

            onePageMenu: function () {

                var scrollToRow = function (hash) {
                    var row = $('#' + hash);

                    if (row.length < 1) return;

                    var position = row.offset().top;

                    $('html, body').stop().animate({
                        scrollTop: position - basel_settings.one_page_menu_offset
                    }, 800, function () {
                        activeMenuItem(hash);
                    });
                };

                var activeMenuItem = function (hash) {
                    var itemHash;
                    $('.onepage-link').each(function () {
                        itemHash = $(this).find('> a').attr('href').split('#')[1];

                        if (itemHash == hash) {
                            $('.onepage-link').removeClass('current-menu-item');
                            $(this).addClass('current-menu-item');
                        }

                    });
                };

                $('body').on('click', '.onepage-link > a', function (e) {
                    var $this = $(this),
                        hash = $this.attr('href').split('#')[1];

                    if ($('#' + hash).length < 1) return;

                    e.preventDefault();

                    scrollToRow(hash);

                    // close mobile menu
                    $('.basel-close-side').trigger('click');
                });

                if ($('.onepage-link').length > 0) {
                    $('.entry-content > .vc_section, .entry-content > .vc_row').waypoint(function () {
                        var hash = $(this).attr('id');
                        activeMenuItem(hash);
                    }, { offset: 0 });

                    // $('.onepage-link').removeClass('current-menu-item');


                    // URL contains hash
                    var locationHash = window.location.hash.split('#')[1];

                    if (window.location.hash.length > 1) {
                        setTimeout(function () {
                            scrollToRow(locationHash);
                        }, 500);
                    }

                }
            },


            /**
             *-------------------------------------------------------------------------------------------------------------------------------------------
             * mobile responsive navigation
             *-------------------------------------------------------------------------------------------------------------------------------------------
             */

            mobileNavigation: function () {

                var body = $("body"),
                    mobileNav = $(".mobile-nav"),
                    wrapperSite = $(".website-wrapper"),
                    dropDownCat = $(".mobile-nav .site-mobile-menu .menu-item-has-children"),
                    elementIcon = '<span class="icon-sub-menu"></span>',
                    butOpener = $(".icon-sub-menu");

                dropDownCat.append(elementIcon);

                mobileNav.on("click", ".icon-sub-menu", function (e) {
                    e.preventDefault();

                    if ($(this).parent().hasClass("opener-page")) {
                        $(this).parent().removeClass("opener-page").find("> ul").slideUp(200);
                        $(this).parent().removeClass("opener-page").find(".sub-menu-dropdown .container > ul").slideUp(200);
                        $(this).parent().find('> .icon-sub-menu').removeClass("up-icon");
                    } else {
                        $(this).parent().addClass("opener-page").find("> ul").slideDown(200);
                        $(this).parent().addClass("opener-page").find(".sub-menu-dropdown .container > ul").slideDown(200);
                        $(this).parent().find('> .icon-sub-menu').addClass("up-icon");
                    }
                });


                body.on("click", ".mobile-nav-icon", function () {

                    if (body.hasClass("act-mobile-menu")) {
                        closeMenu();
                    } else {
                        openMenu();
                    }

                });

                body.on("click touchstart", ".basel-close-side", function () {
                    closeMenu();
                });

                body.on("click touchstart", ".mobile-nav .login-side-opener", function () {
                    closeMenu();
                });

                function openMenu() {
                    body.addClass("act-mobile-menu");
                }

                function closeMenu() {
                    body.removeClass("act-mobile-menu");
                }
            },

            /**
             *-------------------------------------------------------------------------------------------------------------------------------------------
             * Simple dropdown for category select on search form
             *-------------------------------------------------------------------------------------------------------------------------------------------
             */
            simpleDropdown: function () {
                $('.input-dropdown-inner').each(function () {
                    var dd = $(this);
                    var btn = dd.find('> a');
                    var input = dd.find('> input');
                    var list = dd.find('> ul'); //.dd-list-wrapper

                    $(document).on('click', function (e) {
                        var target = e.target;
                        if (dd.hasClass('dd-shown') && !$(target).is('.input-dropdown-inner') && !$(target).parents().is('.input-dropdown-inner')) {
                            hideList();
                            return false;
                        }
                    });

                    btn.on('click', function (e) {
                        e.preventDefault();

                        if (dd.hasClass('dd-shown')) {
                            hideList();
                        } else {
                            showList();
                        }
                        return false;
                    });

                    list.on('click', 'a', function (e) {
                        e.preventDefault();
                        var value = $(this).data('val');
                        var label = $(this).text();
                        list.find('.current-item').removeClass('current-item');
                        $(this).parent().addClass('current-item');
                        if (value != 0) {
                            list.find('> li:first-child').show();
                        } else if (value == 0) {
                            list.find('> li:first-child').hide();
                        }
                        btn.text(label);
                        input.val(value).trigger('cat_selected');
                        hideList();
                    });


                    function showList() {
                        dd.addClass('dd-shown');
                        list.slideDown(100);

                        // $(".dd-list-wrapper .basel-scroll").nanoScroller({
                        //     paneClass: 'basel-scroll-pane',
                        //     sliderClass: 'basel-scroll-slider',
                        //     contentClass: 'basel-scroll-content',
                        //     preventPageScrolling: false
                        // });
                    }

                    function hideList() {
                        dd.removeClass('dd-shown');
                        list.slideUp(100);
                    }
                });

            },

            /**
             *-------------------------------------------------------------------------------------------------------------------------------------------
             * Function to make columns the same height
             *-------------------------------------------------------------------------------------------------------------------------------------------
             */
            equalizeColumns: function () {

                $.fn.basel_equlize = function (options) {

                    var settings = $.extend({
                        child: "",
                    }, options);

                    var that = this;

                    if (settings.child != '') {
                        that = this.find(settings.child);
                    }

                    var resize = function () {

                        var maxHeight = 0;
                        var height;
                        that.each(function () {
                            $(this).attr('style', '');
                            if ($(window).width() > 767 && $(this).outerHeight() > maxHeight)
                                maxHeight = $(this).outerHeight();
                        });

                        that.each(function () {
                            $(this).css({
                                minHeight: maxHeight
                            });
                        });

                    }

                    $(window).on('resize', function () {
                        resize();
                    });
                    setTimeout(function () {
                        resize();
                    }, 200);
                    setTimeout(function () {
                        resize();
                    }, 500);
                    setTimeout(function () {
                        resize();
                    }, 800);
                }

                $('.equal-columns').each(function () {
                    $(this).basel_equlize({
                        child: '> [class*=col-]'
                    });
                });
            },


            /**
             *-------------------------------------------------------------------------------------------------------------------------------------------
             * Enable masonry grid for blog
             *-------------------------------------------------------------------------------------------------------------------------------------------
             */
            blogMasonry: function () {
                if (typeof ($.fn.isotope) == 'undefined' || typeof ($.fn.imagesLoaded) == 'undefined') return;
                var $container = $('.masonry-container');

                // initialize Masonry after all images have loaded
                $container.imagesLoaded(function () {
                    $container.isotope({
                        gutter: 0,
                        isOriginLeft: !$('body').hasClass('rtl'),
                        itemSelector: '.blog-design-masonry, .blog-design-mask, .masonry-item'
                    });
                });

                $('.masonry-filter').on('click', 'a', function (e) {
                    e.preventDefault();
                    $('.masonry-filter').find('.filter-active').removeClass('filter-active');
                    $(this).addClass('filter-active');
                    var filterValue = $(this).attr('data-filter');
                    $(this).parents('.portfolio-filter').siblings('.masonry-container.basel-portfolio-holder').first().isotope({
                        filter: filterValue
                    });
                });

            },


            /**
             *-------------------------------------------------------------------------------------------------------------------------------------------
             * Load more button for blog shortcode
             *-------------------------------------------------------------------------------------------------------------------------------------------
             */
            blogLoadMore: function () {

                $('.basel-blog-load-more').on('click', function (e) {
                    e.preventDefault();

                    var $this = $(this),
                        holderId = $this.data('holder-id'),
                        holder = $('.basel-blog-holder#' + holderId),
                        atts = holder.data('atts'),
                        paged = holder.data('paged');

                    $this.addClass('loading');

                    $.ajax({
                        url: basel_settings.ajaxurl,
                        data: {
                            atts: atts,
                            paged: paged,
                            action: 'basel_get_blog_shortcode'
                        },
                        dataType: 'json',
                        method: 'POST',
                        success: function (data) {
                            if (data.items) {
                                if (holder.hasClass('masonry-container')) {
                                    // initialize Masonry after all images have loaded
                                    var items = $(data.items);
                                    holder.append(items).isotope('appended', items);
                                    holder.imagesLoaded().progress(function () {
                                        holder.isotope('layout');
                                    });
                                } else {
                                    holder.append(data.items);
                                }

                                holder.data('paged', paged + 1);
                            }

                            if (data.status == 'no-more-posts') {
                                $this.hide();
                            }
                        },
                        error: function (data) {
                            console.log('ajax error');
                        },
                        complete: function () {
                            $this.removeClass('loading');
                        },
                    });

                });

            },


            /**
             *-------------------------------------------------------------------------------------------------------------------------------------------
             * Load more button for products shortcode
             *-------------------------------------------------------------------------------------------------------------------------------------------
             */
            productsLoadMore: function () {

                var process = false,
                    intervalID;

                $('.basel-products-element').each(function () {
                    var $this = $(this),
                        cache = [],
                        inner = $this.find('.basel-products-holder');

                    if (!inner.hasClass('pagination-arrows') && !inner.hasClass('pagination-more-btn')) return;

                    cache[1] = {
                        items: inner.html(),
                        status: 'have-posts'
                    };

                    $this.on('recalc', function () {
                        calc();
                    });

                    if (inner.hasClass('pagination-arrows')) {
                        $(window).resize(function () {
                            calc();
                        });
                    }

                    var calc = function () {
                        var height = inner.outerHeight();
                        $this.stop().css({ minHeight: height });
                    };

                    // sticky buttons

                    var body = $('body'),
                        btnWrap = $this.find('.products-footer'),
                        btnLeft = btnWrap.find('.basel-products-load-prev'),
                        btnRight = btnWrap.find('.basel-products-load-next'),
                        loadWrapp = $this.find('.basel-products-loader'),
                        scrollTop,
                        holderTop,
                        btnLeftOffset,
                        btnRightOffset,
                        holderBottom,
                        holderHeight,
                        holderWidth,
                        btnsHeight,
                        offsetArrow = 50,
                        offset,
                        windowWidth;

                    if (body.hasClass('rtl')) {
                        btnLeft = btnRight;
                        btnRight = btnWrap.find('.basel-products-load-prev');
                    }

                    $(window).scroll(function () {
                        buttonsPos();
                    });

                    function buttonsPos() {

                        offset = $(window).height() / 2;

                        windowWidth = $(window).outerWidth(true) + 17;

                        holderWidth = $this.outerWidth(true) + 10;

                        scrollTop = $(window).scrollTop();

                        holderTop = $this.offset().top - offset;

                        btnLeftOffset = $this.offset().left - offsetArrow;

                        btnRightOffset = btnLeftOffset + holderWidth + offsetArrow;

                        btnsHeight = btnLeft.outerHeight();

                        holderHeight = $this.height() - 50 - btnsHeight;

                        holderBottom = holderTop + holderHeight;

                        if (windowWidth <= 1047 && windowWidth >= 992 || windowWidth <= 825 && windowWidth >= 768) {
                            btnLeftOffset += 18;
                            btnRightOffset -= 18;
                        }

                        if (windowWidth < 768 || body.hasClass('wrapper-boxed') || body.hasClass('wrapper-boxed-small') || $('.main-header').hasClass('header-vertical')) {
                            btnLeftOffset += 51;
                            btnRightOffset -= 51;
                        }

                        btnLeft.css({
                            'left': btnLeftOffset + 'px'
                        });

                        // Right arrow position for vertical header
                        // if( $('.main-header').hasClass('header-vertical') && ! body.hasClass('rtl') ) {
                        //     btnRightOffset -= $('.main-header').outerWidth();
                        // } else if( $('.main-header').hasClass('header-vertical') && body.hasClass('rtl') ) {
                        //     btnRightOffset += $('.main-header').outerWidth();
                        // }

                        btnRight.css({
                            'left': btnRightOffset + 'px'
                        });


                        if (scrollTop < holderTop || scrollTop > holderBottom) {
                            btnWrap.removeClass('show-arrow');
                            loadWrapp.addClass('hidden-loader');
                        } else {
                            btnWrap.addClass('show-arrow');
                            loadWrapp.removeClass('hidden-loader');
                        }

                    };

                    $this.find('.basel-products-load-prev, .basel-products-load-next').on('click', function (e) {
                        e.preventDefault();

                        if (process || $(this).hasClass('disabled')) return; process = true;

                        clearInterval(intervalID);

                        var $this = $(this),
                            holder = $this.parent().siblings('.basel-products-holder'),
                            next = $this.parent().find('.basel-products-load-next'),
                            prev = $this.parent().find('.basel-products-load-prev'),
                            atts = holder.data('atts'),
                            paged = holder.attr('data-paged'),
                            ajaxurl = basel_settings.ajaxurl,
                            action = 'basel_get_products_shortcode',
                            method = 'POST';

                        if ($this.hasClass('basel-products-load-prev')) {
                            if (paged < 2) return;
                            paged = paged - 2;
                        }

                        paged++;

                        loadProducts('arrows', atts, ajaxurl, action, method, paged, holder, $this, cache, function (data) {
                            holder.addClass('basel-animated-products');

                            if (data.items) {
                                holder.html(data.items).attr('data-paged', paged);
                                holder.imagesLoaded().progress(function () {
                                    holder.parent().trigger('recalc');
                                });

                                $(document).trigger('basel-images-loaded');

                                baselThemeModule.btnsToolTips();
                            }

                            if ($(window).width() < 768) {
                                $('html, body').stop().animate({
                                    scrollTop: holder.offset().top - 150
                                }, 400);
                            }


                            var iter = 0;
                            intervalID = setInterval(function () {
                                holder.find('.product-grid-item').eq(iter).addClass('basel-animated');
                                iter++;
                            }, 100);

                            if (paged > 1) {
                                prev.removeClass('disabled');
                            } else {
                                prev.addClass('disabled');
                            }

                            if (data.status == 'no-more-posts') {
                                next.addClass('disabled');
                            } else {
                                next.removeClass('disabled');
                            }
                        });

                    });
                });

                baselThemeModule.clickOnScrollButton(baselTheme.shopLoadMoreBtn, false);

                $(document).off('click', '.basel-products-load-more').on('click', '.basel-products-load-more', function (e) {
                    e.preventDefault();

                    if (process) return; process = true;

                    var $this = $(this),
                        holder = $this.parent().siblings('.basel-products-holder'),
                        source = holder.data('source'),
                        action = 'basel_get_products_' + source,
                        ajaxurl = basel_settings.ajaxurl,
                        method = 'POST',
                        atts = holder.data('atts'),
                        paged = holder.data('paged');

                    paged++;

                    if (source == 'main_loop') {
                        ajaxurl = $(this).attr('href');
                        method = 'GET';
                    }

                    loadProducts('load-more', atts, ajaxurl, action, method, paged, holder, $this, [], function (data) {
                        if (data.items) {
                            if (holder.hasClass('grid-masonry')) {
                                isotopeAppend(holder, data.items);
                            } else {
                                holder.append(data.items);
                            }

                            holder.imagesLoaded().progress(function () {
                                baselThemeModule.clickOnScrollButton(baselTheme.shopLoadMoreBtn, true);
                            });

                            $(document).trigger('basel-images-loaded');

                            holder.data('paged', paged);

                            baselThemeModule.btnsToolTips();
                        }

                        if (source == 'main_loop') {
                            $this.attr('href', data.nextPage);
                            if (data.status == 'no-more-posts') {
                                $this.hide().remove();
                            }
                        }

                        if (data.status == 'no-more-posts') {
                            $this.hide().remove();
                        }
                    });

                });

                var loadProducts = function (btnType, atts, ajaxurl, action, method, paged, holder, btn, cache, callback) {
                    var data = {
                        atts: atts,
                        paged: paged,
                        action: action,
                        woo_ajax: 1
                    };

                    if (cache[paged]) {
                        holder.addClass('loading');
                        setTimeout(function () {
                            callback(cache[paged]);
                            holder.removeClass('loading');
                            process = false;
                        }, 300);
                        return;
                    }

                    holder.addClass('loading').parent().addClass('element-loading');

                    if (btnType == 'arrows') holder.addClass('loading').parent().addClass('element-loading');

                    if (action == 'basel_get_products_main_loop') {
                        var loop = holder.find('.product').last().data('loop');
                        data = {
                            loop: loop,
                            woo_ajax: 1
                        };
                    }

                    btn.addClass('loading');

                    $.ajax({
                        url: ajaxurl,
                        data: data,
                        dataType: 'json',
                        method: method,
                        success: function (data) {
                            cache[paged] = data;
                            callback(data);
                        },
                        error: function (data) {
                            console.log('ajax error');
                        },
                        complete: function () {
                            holder.removeClass('loading').parent().removeClass('element-loading');
                            btn.removeClass('loading');
                            process = false;
                            baselThemeModule.compare();
                            baselThemeModule.countDownTimer();
                        },
                    });
                };

                var isotopeAppend = function (el, items) {
                    // initialize Masonry after all images have loaded
                    var items = $(items);
                    el.append(items).isotope('appended', items);
                    el.isotope('layout');
                    setTimeout(function () {
                        el.isotope('layout');
                    }, 100);
                    el.imagesLoaded().progress(function () {
                        el.isotope('layout');
                    });
                };

            },

            /**
             *-------------------------------------------------------------------------------------------------------------------------------------------
             * Helper function that make btn click when you scroll page to it
             *-------------------------------------------------------------------------------------------------------------------------------------------
             */
            clickOnScrollButton: function (btnClass, destroy) {
                if (typeof $.waypoints != 'function') return;

                var $btn = $(btnClass);
                if (destroy) {
                    $btn.waypoint('destroy');
                }

                $btn.waypoint(function () {
                    $btn.trigger('click');
                }, { offset: '100%' });
            },

            /**
             *-------------------------------------------------------------------------------------------------------------------------------------------
             * Products tabs element AJAX loading
             *-------------------------------------------------------------------------------------------------------------------------------------------
             */
            productsTabs: function () {


                var process = false;

                $('.basel-products-tabs').each(function () {
                    var $this = $(this),
                        $inner = $this.find('.basel-tab-content'),
                        cache = [];

                    if ($inner.find('.owl-carousel').length < 1) {
                        cache[0] = {
                            html: $inner.html()
                        };
                    }

                    $this.find('.products-tabs-title li').on('click', function (e) {
                        e.preventDefault();

                        var $this = $(this),
                            atts = $this.data('atts'),
                            index = $this.index();

                        if (process || $this.hasClass('active-tab-title')) return; process = true;

                        loadTab(atts, index, $inner, $this, cache, function (data) {
                            if (data.html) {
                                $inner.html(data.html);

                                $(document).trigger('basel-images-loaded');

                                baselThemeModule.btnsToolTips();
                                baselThemeModule.shopMasonry();
                                baselThemeModule.productsLoadMore();
                                baselThemeModule.productLoaderPosition();
                            }
                        });

                    });

                    var $nav = $this.find('.tabs-navigation-wrapper'),
                        $subList = $nav.find('ul'),
                        time = 300;

                    $nav.on('click', '.open-title-menu', function () {
                        var $btn = $(this);

                        if ($subList.hasClass('list-shown')) {
                            $btn.removeClass('toggle-active');
                            $subList.removeClass('list-shown');
                        } else {
                            $btn.addClass('toggle-active');
                            $subList.addClass('list-shown');
                            setTimeout(function () {
                                $('body').one('click', function (e) {
                                    var target = e.target;
                                    if (!$(target).is('.tabs-navigation-wrapper') && !$(target).parents().is('.tabs-navigation-wrapper')) {
                                        $btn.removeClass('toggle-active');
                                        $subList.removeClass('list-shown');
                                        return false;
                                    }
                                });
                            }, 10);
                        }

                    })
                        .on('click', 'li', function () {
                            var $btn = $nav.find('.open-title-menu'),
                                text = $(this).text();

                            if ($subList.hasClass('list-shown')) {
                                $btn.removeClass('toggle-active').text(text);
                                $subList.removeClass('list-shown');
                            }
                        });

                });

                var loadTab = function (atts, index, holder, btn, cache, callback) {

                    btn.parent().find('.active-tab-title').removeClass('active-tab-title');
                    btn.addClass('active-tab-title')

                    if (cache[index]) {
                        holder.addClass('loading');
                        setTimeout(function () {
                            callback(cache[index]);
                            holder.removeClass('loading');
                            process = false;
                        }, 300);
                        return;
                    }

                    holder.addClass('loading').parent().addClass('element-loading');

                    btn.addClass('loading');

                    $.ajax({
                        url: basel_settings.ajaxurl,
                        data: {
                            atts: atts,
                            action: 'basel_get_products_tab_shortcode'
                        },
                        dataType: 'json',
                        method: 'POST',
                        success: function (data) {
                            cache[index] = data;
                            callback(data);
                        },
                        error: function (data) {
                            console.log('ajax error');
                        },
                        complete: function () {
                            holder.removeClass('loading').parent().removeClass('element-loading');
                            btn.removeClass('loading');
                            process = false;
                            baselThemeModule.compare();
                        },
                    });
                };


            },


            /**
             *-------------------------------------------------------------------------------------------------------------------------------------------
             * Load more button for portfolio shortcode
             *-------------------------------------------------------------------------------------------------------------------------------------------
             */
            portfolioLoadMore: function () {

                if (typeof $.waypoints != 'function') return;

                var waypoint = $('.basel-portfolio-load-more.load-on-scroll').waypoint(function () {
                        $('.basel-portfolio-load-more.load-on-scroll').trigger('click');
                    }, { offset: '100%' }),
                    process = false;

                $('.basel-portfolio-load-more').on('click', function (e) {
                    e.preventDefault();

                    if (process || $(this).hasClass('no-more-posts')) return;

                    process = true;

                    var $this = $(this),
                        holder = $this.parent().parent().find('.basel-portfolio-holder'),
                        source = holder.data('source'),
                        action = 'basel_get_portfolio_' + source,
                        ajaxurl = basel_settings.ajaxurl,
                        dataType = 'json',
                        method = 'POST',
                        timeout,
                        atts = holder.data('atts'),
                        paged = holder.data('paged');

                    $this.addClass('loading');

                    var data = {
                        atts: atts,
                        paged: paged,
                        action: action
                    };

                    if (source == 'main_loop') {
                        ajaxurl = $(this).attr('href');
                        method = 'GET';
                        data = {};
                    }


                    $.ajax({
                        url: ajaxurl,
                        data: data,
                        dataType: dataType,
                        method: method,
                        success: function (data) {

                            var items = $(data.items);

                            if (items) {
                                if (holder.hasClass('masonry-container')) {
                                    // initialize Masonry after all images have loaded
                                    holder.append(items).isotope('appended', items);
                                    holder.imagesLoaded().progress(function () {
                                        holder.isotope('layout');

                                        clearTimeout(timeout);

                                        timeout = setTimeout(function () {
                                            $('.basel-portfolio-load-more.load-on-scroll').waypoint('destroy');
                                            waypoint = $('.basel-portfolio-load-more.load-on-scroll').waypoint(function () {
                                                $('.basel-portfolio-load-more.load-on-scroll').trigger('click');
                                            }, { offset: '100%' });
                                        }, 1000);
                                    });
                                } else {
                                    holder.append(items);
                                }

                                holder.data('paged', paged + 1);

                                $this.attr('href', data.nextPage);
                            }

                            baselThemeModule.mfpPopup();

                            if (data.status == 'no-more-posts') {
                                $this.addClass('no-more-posts');
                                $this.hide();
                            }

                        },
                        error: function (data) {
                            console.log('ajax error');
                        },
                        complete: function () {
                            $this.removeClass('loading');
                            process = false;
                        },
                    });

                });

            },



            /**
             *-------------------------------------------------------------------------------------------------------------------------------------------
             * Enable masonry grid for shop isotope type
             *-------------------------------------------------------------------------------------------------------------------------------------------
             */
            shopMasonry: function () {
                if (typeof ($.fn.isotope) == 'undefined' || typeof ($.fn.imagesLoaded) == 'undefined') return;
                var $container = $('.elements-grid.grid-masonry');
                // initialize Masonry after all images have loaded
                $container.imagesLoaded(function () {
                    $container.isotope({
                        isOriginLeft: !$('body').hasClass('rtl'),
                        itemSelector: '.category-grid-item, .product-grid-item',
                    });
                });

                // Categories masonry
                $(window).resize(function () {
                    var $catsContainer = $('.categories-masonry');
                    var colWidth = ($catsContainer.hasClass('categories-style-masonry')) ? '.category-grid-item' : '.col-md-3.category-grid-item';
                    $catsContainer.imagesLoaded(function () {
                        $catsContainer.packery({
                            resizable: false,
                            isOriginLeft: !$('body').hasClass('rtl'),
                            // layoutMode: 'packery',
                            packery: {
                                gutter: 0,
                                columnWidth: colWidth
                            },
                            itemSelector: '.category-grid-item',
                            // masonry: {
                            // gutter: 0
                            // }
                        });
                    });
                });

            },

            /**
             *-------------------------------------------------------------------------------------------------------------------------------------------
             * MEGA MENU
             *-------------------------------------------------------------------------------------------------------------------------------------------
             */
            sidebarMenu: function () {
                var heightMegaMenu = $(".widget_nav_mega_menu").height();
                var heightMegaNavigation = $(".categories-menu-dropdown").height();
                var subMenuHeight = $(".widget_nav_mega_menu ul > li.menu-item-design-sized > .sub-menu-dropdown, .widget_nav_mega_menu ul > li.menu-item-design-full-width > .sub-menu-dropdown");
                var megaNavigationHeight = $(".categories-menu-dropdown ul > li.menu-item-design-sized > .sub-menu-dropdown, .categories-menu-dropdown ul > li.menu-item-design-full-width > .sub-menu-dropdown");
                subMenuHeight.css(
                    "min-height", heightMegaMenu + "px"
                );

                megaNavigationHeight.css(
                    "min-height", heightMegaNavigation + "px"
                );
            },


            /**
             *-------------------------------------------------------------------------------------------------------------------------------------------
             * Product thumbnail images & photo swipe gallery
             *-------------------------------------------------------------------------------------------------------------------------------------------
             */
            productImages: function () {


                // Init photoswipe

                var currentImage,
                    $productGallery = $('.woocommerce-product-gallery'),
                    $mainImages = $('.woocommerce-product-gallery__wrapper'),
                    $thumbs = $productGallery.find('.thumbnails'),
                    currentClass = 'current-image',
                    gallery = $('.photoswipe-images'),
                    PhotoSwipeTrigger = '.basel-show-product-gallery',
                    galleryType = 'photo-swipe'; // magnific photo-swipe

                $thumbs.addClass('thumbnails-ready');

                if ($productGallery.hasClass('image-action-popup')) {
                    PhotoSwipeTrigger += ', .woocommerce-product-gallery__image a';
                }

                $productGallery.on('click', '.woocommerce-product-gallery__image a', function (e) {
                    e.preventDefault();
                });

                $productGallery.on('click', PhotoSwipeTrigger, function (e) {
                    e.preventDefault();

                    currentImage = $(this).attr('href');

                    if (galleryType == 'magnific') {
                        $.magnificPopup.open({
                            type: 'image',
                            tClose: basel_settings.close,
                            tLoading: basel_settings.loading,
                            image: {
                                verticalFit: false
                            },
                            items: getProductItems(),
                            gallery: {
                                enabled: true,
                                navigateByImgClick: false
                            },
                        }, 0);
                    }

                    if (galleryType == 'photo-swipe') {

                        // build items array
                        var items = getProductItems();

                        baselThemeModule.callPhotoSwipe(getCurrentGalleryIndex(e), items);

                    }

                });

                $thumbs.on('click', '.image-link', function (e) {
                    e.preventDefault();

                    // if( $thumbs.hasClass('thumbnails-large') ) {
                    //     var index = $(e.currentTarget).index() + 1;
                    //     var items = getProductItems();
                    //     callPhotoSwipe(index, items);
                    //     return;
                    // }

                    // var href = $(this).attr('href'),
                    //     src  = $(this).attr('data-single-image'),
                    //     width = $(this).attr('data-width'),
                    //     height = $(this).attr('data-height'),
                    //     title = $(this).attr('title');

                    // $thumbs.find('.' + currentClass).removeClass(currentClass);
                    // $(this).addClass(currentClass);

                    // if( $mainImages.find('img').attr('src') == src ) return;

                    // $mainImages.addClass('loading-image').attr('href', href).find('img').attr('src', src).attr('srcset', src).one('load', function() {
                    //     $mainImages.removeClass('loading-image').data('width', width).data('height', height).attr('title', title);
                    // });

                });

                gallery.each(function () {
                    var $this = $(this);
                    $this.on('click', 'a', function (e) {
                        e.preventDefault();
                        var index = $(e.currentTarget).data('index') - 1;
                        var items = getGalleryItems($this, []);
                        baselThemeModule.callPhotoSwipe(index, items);
                    });
                })

                var getCurrentGalleryIndex = function (e) {
                    if ($mainImages.hasClass('owl-carousel'))
                        return $mainImages.find('.owl-item.active').index();
                    else return $(e.currentTarget).parent().index();
                };

                var getProductItems = function () {
                    var items = [];

                    $mainImages.find('figure a img').each(function () {
                        var src = $(this).attr('data-large_image'),
                            width = $(this).attr('data-large_image_width'),
                            height = $(this).attr('data-large_image_height'),
                            caption = $(this).data('caption');

                        items.push({
                            src: src,
                            w: width,
                            h: height,
                            title: (basel_settings.product_images_captions == 'yes') ? caption : false
                        });

                    });

                    return items;
                };

                var getGalleryItems = function ($gallery, items) {
                    var src, width, height, title;

                    $gallery.find('a').each(function () {
                        src = $(this).attr('href');
                        width = $(this).data('width');
                        height = $(this).data('height');
                        title = $(this).attr('title');
                        if (!isItemInArray(items, src)) {
                            items.push({
                                src: src,
                                w: width,
                                h: height,
                                title: title
                            });
                        }
                    });

                    return items;
                };

                var isItemInArray = function (items, src) {
                    var i;
                    for (i = 0; i < items.length; i++) {
                        if (items[i].src == src) {
                            return true;
                        }
                    }

                    return false;
                };

                /* Fix zoom for first item firstly */

                if ($productGallery.hasClass('image-action-zoom')) {
                    var zoom_target = $('.woocommerce-product-gallery__image');
                    var image_to_zoom = zoom_target.find('img');

                    // But only zoom if the img is larger than its container.
                    if (image_to_zoom.attr('width') > $('.woocommerce-product-gallery').width()) {
                        zoom_target.trigger('zoom.destroy');
                        zoom_target.zoom({
                            touch: false
                        });
                    }
                }

            },

            callPhotoSwipe: function (index, items) {
                var pswpElement = document.querySelectorAll('.pswp')[0];

                if ($('body').hasClass('rtl')) {
                    index = items.length - index - 1;
                    items = items.reverse();
                }

                // define options (if needed)
                var options = {
                    // optionName: 'option value'
                    // for example:
                    index: index, // start at first slide
                    shareButtons: [
                        { id: 'facebook', label: basel_settings.share_fb, url: 'https://www.facebook.com/sharer/sharer.php?u={{url}}' },
                        { id: 'twitter', label: basel_settings.tweet, url: 'https://twitter.com/intent/tweet?text={{text}}&url={{url}}' },
                        {
                            id: 'pinterest', label: basel_settings.pin_it, url: 'http://www.pinterest.com/pin/create/button/' +
                        '?url={{url}}&media={{image_url}}&description={{text}}'
                        },
                        { id: 'download', label: basel_settings.download_image, url: '{{raw_image_url}}', download: true }
                    ],
                    getThumbBoundsFn: function (index) {

                        // // get window scroll Y
                        // var pageYScroll = window.pageYOffset || document.documentElement.scrollTop;
                        // // optionally get horizontal scroll

                        // // get position of element relative to viewport
                        // var rect = $target.offset();

                        // // w = width
                        // return {x:rect.left, y:rect.top + pageYScroll, w:rect.width};

                    }
                };

                // Initializes and opens PhotoSwipe
                var gallery = new PhotoSwipe(pswpElement, PhotoSwipeUI_Default, items, options);
                gallery.init();
            },



            productImagesGallery: function () {

                var $mainImages = $('.woocommerce-product-gallery__image:eq(0) img'),
                    $thumbs = $('.images .thumbnails'), // magnific photo-swipe
                    $mainOwl = $('.woocommerce-product-gallery__wrapper');

                if (basel_settings.product_gallery.images_slider) {
                    if (basel_settings.product_slider_auto_height == 'yes') {
                        $('.product-images').imagesLoaded(function () {
                            initMainGallery();
                        });
                    } else {
                        initMainGallery();
                    }
                }

                if (basel_settings.product_gallery.thumbs_slider.enabled && basel_settings.product_gallery.images_slider) {
                    initThumbnailsMarkup();
                    if (basel_settings.product_gallery.thumbs_slider.position == 'left' && jQuery(window).width() > 991) {
                        initThumbnailsVertical();
                    } else {
                        initThumbnailsHorizontal();
                    }
                }


                function initMainGallery() {
                    $('.woocommerce-product-gallery__wrapper').trigger('destroy.owl.carousel');
                    $('.woocommerce-product-gallery__wrapper').addClass('owl-carousel').owlCarousel(baselTheme.mainCarouselArg);
                    $(document).trigger('basel-images-loaded');
                };

                function initThumbnailsMarkup() {
                    var markup = '';

                    $('.woocommerce-product-gallery__image').each(function () {
                        var image = $(this).data('thumb'),
                            alt = $(this).find('a > img').attr('alt'),
                            title = $(this).find('a > img').attr('title');

                        markup += '<img alt="' + alt + '" title="' + title + '" src="' + image + '" />';
                    });

                    if ($thumbs.hasClass('slick-slider')) {
                        $thumbs.slick('unslick');
                    } else if ($thumbs.hasClass('owl-carousel')) {
                        $thumbs.trigger('destroy.owl.carousel');
                    }

                    $thumbs.empty();
                    $thumbs.append(markup);

                };

                function initThumbnailsVertical() {
                    $thumbs.slick({
                        slidesToShow: basel_settings.product_gallery.thumbs_slider.items.vertical_items,
                        slidesToScroll: basel_settings.product_gallery.thumbs_slider.items.vertical_items,
                        vertical: true,
                        verticalSwiping: true,
                        infinite: false,
                    });

                    $thumbs.on('click', 'img', function (e) {
                        var i = $(this).index();
                        $mainOwl.trigger('to.owl.carousel', i);
                    });

                    $mainOwl.on('changed.owl.carousel', function (e) {
                        var i = e.item.index;
                        $thumbs.slick('slickGoTo', i);
                        $thumbs.find('.active-thumb').removeClass('active-thumb');
                        $thumbs.find('img').eq(i).addClass('active-thumb');
                    });

                    $thumbs.find('img').eq(0).addClass('active-thumb');
                };

                function initThumbnailsHorizontal() {
                    $thumbs.addClass('owl-carousel').owlCarousel({
                        rtl: $('body').hasClass('rtl'),
                        items: basel_settings.product_gallery.thumbs_slider.items.desktop,
                        responsive: {
                            979: {
                                items: basel_settings.product_gallery.thumbs_slider.items.desktop
                            },
                            768: {
                                items: basel_settings.product_gallery.thumbs_slider.items.desktop_small
                            },
                            479: {
                                items: basel_settings.product_gallery.thumbs_slider.items.tablet
                            },
                            0: {
                                items: basel_settings.product_gallery.thumbs_slider.items.mobile
                            }
                        },
                        dots: false,
                        nav: true,
                        // mouseDrag: false,
                        navText: false,
                    });

                    var $thumbsOwl = $thumbs.owlCarousel();

                    $thumbs.on('click', '.owl-item', function (e) {
                        var i = $(this).index();
                        $thumbsOwl.trigger('to.owl.carousel', i);
                        $mainOwl.trigger('to.owl.carousel', i);
                    });

                    $mainOwl.on('changed.owl.carousel', function (e) {
                        var i = e.item.index;
                        $thumbsOwl.trigger('to.owl.carousel', i);
                        $thumbs.find('.active-thumb').removeClass('active-thumb');
                        $thumbs.find('.owl-item').eq(i).addClass('active-thumb');
                    });

                    $thumbs.find('.owl-item').eq(0).addClass('active-thumb');
                };

                // Update first thumbnail on variation change

            },


            /**
             *-------------------------------------------------------------------------------------------------------------------------------------------
             * Sticky details block for special product type
             *-------------------------------------------------------------------------------------------------------------------------------------------
             */
            stickyDetails: function () {
                if (!$('body').hasClass('basel-product-design-sticky')) return;

                var details = $('.entry-summary'),
                    detailsInner = details.find('.summary-inner'),
                    detailsWidth = details.width(),
                    images = $('.product-images'),
                    thumbnails = images.find('.woocommerce-product-gallery__wrapper a'),
                    offsetThumbnils,
                    viewportHeight = $(window).height(),
                    imagesHeight = images.outerHeight(),
                    topOffset = 130,
                    maxWidth = 600,
                    innerWidth,
                    detailsHeight = details.outerHeight(),
                    scrollTop = $(window).scrollTop(),
                    imagesTop = images.offset().top,
                    detailsLeft = details.offset().left + 15,
                    imagesBottom = imagesTop + imagesHeight,
                    detailsBottom = scrollTop + topOffset + detailsHeight;


                details.css({
                    height: detailsHeight
                });

                $(window).resize(function () {
                    recalculate();
                });

                $(window).scroll(function () {
                    onscroll();
                    animateThumbnails();
                });

                images.imagesLoaded(function () {
                    recalculate();
                });


                function animateThumbnails() {
                    viewportHeight = $(window).height();

                    thumbnails.each(function () {
                        offsetThumbnils = $(this).offset().top;

                        if (scrollTop > (offsetThumbnils - viewportHeight + 20)) {
                            $(this).addClass('animate-images');
                        }

                    });
                }

                function onscroll() {
                    scrollTop = $(window).scrollTop();
                    detailsBottom = scrollTop + topOffset + detailsHeight;
                    detailsWidth = details.width();
                    detailsLeft = details.offset().left + 15;
                    imagesTop = images.offset().top;
                    imagesBottom = imagesTop + imagesHeight;

                    if (detailsWidth > maxWidth) {
                        innerWidth = (detailsWidth - maxWidth) / 2;
                        detailsLeft = detailsLeft + innerWidth;
                    }

                    // Fix after scroll the header
                    if (scrollTop + topOffset >= imagesTop) {
                        details.addClass('block-sticked');

                        detailsInner.css({
                            top: topOffset,
                            left: detailsLeft,
                            width: detailsWidth,
                            position: 'fixed',
                            transform: 'translateY(-20px)'
                        });
                    } else {
                        details.removeClass('block-sticked');
                        detailsInner.css({
                            top: 'auto',
                            left: 'auto',
                            width: 'auto',
                            position: 'relative',
                            transform: 'translateY(0px)'
                        });
                    }



                    // When rich the bottom line
                    if (detailsBottom > imagesBottom) {
                        details.addClass('hide-temporary');
                    } else {
                        details.removeClass('hide-temporary');
                    }
                };


                function recalculate() {
                    viewportHeight = $(window).height();
                    detailsHeight = details.outerHeight();
                    imagesHeight = images.outerHeight();

                    // If enought space in the viewport
                    if (detailsHeight < (viewportHeight - topOffset)) {
                        details.addClass('in-viewport').removeClass('not-in-viewport');
                    } else {
                        details.removeClass('in-viewport').addClass('not-in-viewport');
                    }
                };

            },


            /**
             *-------------------------------------------------------------------------------------------------------------------------------------------
             * Use magnific popup for images
             *-------------------------------------------------------------------------------------------------------------------------------------------
             */
            mfpPopup: function () {
                /*$('.image-link').magnificPopup({
                 type:'image'
                 });*/

                $('.gallery').magnificPopup({
                    tClose: basel_settings.close,
                    tLoading: basel_settings.loading,
                    delegate: ' > a',
                    type: 'image',
                    image: {
                        verticalFit: true
                    },
                    gallery: {
                        enabled: true,
                        navigateByImgClick: true
                    },
                });

                $('[data-rel="mfp"]').magnificPopup({
                    tClose: basel_settings.close,
                    tLoading: basel_settings.loading,
                    type: 'image',
                    image: {
                        verticalFit: true
                    },
                    gallery: {
                        enabled: false,
                        navigateByImgClick: false
                    },
                });

                $(document).on('click', '.mfp-img', function () {
                    var mfp = jQuery.magnificPopup.instance; // get instance
                    mfp.st.image.verticalFit = !mfp.st.image.verticalFit; // toggle verticalFit on and off
                    mfp.currItem.img.removeAttr('style'); // remove style attribute, to remove max-width if it was applied
                    mfp.updateSize(); // force update of size
                });
            },


            /**
             *-------------------------------------------------------------------------------------------------------------------------------------------
             * WooCommerce adding to cart
             *-------------------------------------------------------------------------------------------------------------------------------------------
             */
            addToCart: function () {
                var that = this,
                    timeoutNumber = 0;

                $('body').on('added_to_cart', function (event, fragments, cart_hash) {

                    if (basel_settings.add_to_cart_action == 'popup') {

                        var html = [
                            '<div class="added-to-cart">',
                            '<p>' + basel_settings.added_to_cart + '</p>',
                            '<a href="#" class="btn btn-style-link close-popup">' + basel_settings.continue_shopping + '</a>',
                            '<a href="' + basel_settings.cart_url + '" class="btn btn-color-primary view-cart">' + basel_settings.view_cart + '</a>',
                            '</div>',
                        ].join("");

                        $.magnificPopup.open({
                            tClose: basel_settings.close,
                            tLoading: basel_settings.loading,
                            removalDelay: 500, //delay removal by X to allow out-animation
                            callbacks: {
                                beforeOpen: function () {
                                    this.st.mainClass = baselTheme.popupEffect + '  cart-popup-wrapper';
                                },
                            },
                            items: {
                                src: '<div class="white-popup add-to-cart-popup mfp-with-anim popup-added_to_cart">' + html + '</div>',
                                type: 'inline'
                            }
                        });

                        $('.white-popup').on('click', '.close-popup', function (e) {
                            e.preventDefault();
                            $.magnificPopup.close();
                        });

                    } else if (basel_settings.add_to_cart_action == 'widget') {

                        clearTimeout(timeoutNumber);

                        var currentHeader = ($('.sticky-header.act-scroll').length > 0) ? $('.sticky-header .dropdown-wrap-cat') : $('.main-header .dropdown-wrap-cat');

                        if ($('.cart-widget-opener a').length > 0) {
                            $('.cart-widget-opener a').trigger('click');
                        } else if ($('.shopping-cart .a').length > 0) {
                            $('.shopping-cart .dropdown-wrap-cat').addClass('display-widget');
                            timeoutNumber = setTimeout(function () {
                                $('.display-widget').removeClass('display-widget');
                            }, 3500);
                        } else {
                            currentHeader.addClass('display-widget');
                            timeoutNumber = setTimeout(function () {
                                $('.display-widget').removeClass('display-widget');
                            }, 3500);
                        }
                    }

                    that.btnsToolTips();

                });
            },


            /**
             *-------------------------------------------------------------------------------------------------------------------------------------------
             * Grava wc_fragments Session Storage
             *-------------------------------------------------------------------------------------------------------------------------------------------
             */
            updateCartWidgetFromLocalStorage: function () {

                var that = this;

                if (baselTheme.supports_html5_storage) {

                    try {
                        var wc_fragments = $.parseJSON(sessionStorage.getItem(wc_cart_fragments_params.fragment_name));

                        if (wc_fragments && wc_fragments['div.widget_shopping_cart_content']) {

                            $.each(wc_fragments, function (key, value) {
                                $(key).replaceWith(value);
                            });

                            $(document.body).trigger('wc_fragments_loaded');
                        } else {
                            throw 'No fragment';
                        }

                    } catch (err) {
                        console.log('cant update cart widget');
                    }
                }

            },

            /**
             *-------------------------------------------------------------------------------------------------------------------------------------------
             * WishList Number Init
             *-------------------------------------------------------------------------------------------------------------------------------------------
             */
            updateWishListNumberInit: function () {

                if (basel_settings.wishlist == 'no' || $('.wishlist-count').length <= 0) return;

                var that = this;

                if (baselTheme.supports_html5_storage) {

                    try {
                        var wishlistNumber = sessionStorage.getItem(yith_wcwl_l10n.hash_name+'_number'),
                            cookie_hash = Cookies.get(yith_wcwl_l10n.hash_name);


                        if (wishlistNumber === null || wishlistNumber === undefined || wishlistNumber === '') {
                            wishlistNumber = 0;
                        }

                        if (cookie_hash === null || cookie_hash === undefined || cookie_hash === '') {
                            cookie_hash = 0;
                        }

                        if (wishlistNumber == cookie_hash) {
                            this.setWishListNumber(wishlistNumber);
                        } else {
                            throw 'No wishlist number';
                        }

                    } catch (err) {
                        this.updateWishListNumber();
                    }

                } else {
                    this.updateWishListNumber();
                }

                $('body').on('added_to_cart added_to_wishlist removed_from_wishlist', function () {
                    that.updateWishListNumber();
                    that.btnsToolTips();
                    that.woocommerceWrappTable();
                });

            },

            /**
             *-------------------------------------------------------------------------------------------------------------------------------------------
             * WishList Number List: Retorna o total de produtos na lista de desejo
             *-------------------------------------------------------------------------------------------------------------------------------------------
             */
            updateWishListNumber: function () {
                var that = this;
                $.ajax({
                    url: yith_wcwl_l10n.ajax_url,
                    data: {
                        action: 'basel_wishlist_number',
                        _token: yith_wcwl_l10n.csrf_token
                    },
                    method: 'POST',
                    success: function (data) {
                        that.setWishListNumber(data);
                        if (baselTheme.supports_html5_storage) {
                            sessionStorage.setItem('basel_wishlist_number', data);
                        }
                    }
                });
            },

            setWishListNumber: function (num) {
                num = ($.isNumeric(num)) ? num : 0;
                $('.wishlist-info-widget a > span').text(num);
            },


            /**
             *-------------------------------------------------------------------------------------------------------------------------------------------
             * Side shopping cart widget
             *-------------------------------------------------------------------------------------------------------------------------------------------
             */
            cartWidget: function () {
                var widget = $('.cart-widget-opener'),
                    btn = widget.find('a'),
                    body = $('body');

                widget.on('click', 'a', function (e) {
                    if (!isCart() && !isCheckout()) e.preventDefault();

                    if (isOpened()) {
                        closeWidget();
                    } else {
                        setTimeout(function () {
                            openWidget();
                        }, 10);
                    }

                });

                body.on("click touchstart", ".basel-close-side", function () {
                    if (isOpened()) {
                        closeWidget();
                    }
                });

                body.on("click", ".widget-close", function (e) {
                    e.preventDefault();
                    if (isOpened()) {
                        closeWidget();
                    }
                });

                $(document).keyup(function (e) {
                    if (e.keyCode === 27 && isOpened()) closeWidget();
                });

                var closeWidget = function () {
                    $('body').removeClass('basel-cart-opened');
                };

                var openWidget = function () {
                    if (isCart() || isCheckout()) return false;
                    $('body').addClass('basel-cart-opened');
                };

                var isOpened = function () {
                    return $('body').hasClass('basel-cart-opened');
                };

                var isCart = function () {
                    return $('body').hasClass('woocommerce-cart');
                };

                var isCheckout = function () {
                    return $('body').hasClass('woocommerce-checkout');
                };

                $(document).on('wc_fragments_refreshed wc_fragments_loaded added_to_cart', function () {
                    $(document).trigger('basel-images-loaded');
                });
            },

            /**
             *-------------------------------------------------------------------------------------------------------------------------------------------
             * Banner hover effect with jquery panr
             *-------------------------------------------------------------------------------------------------------------------------------------------
             */
            bannersHover: function () {
                $(".promo-banner.hover-4").panr({
                    sensitivity: 20,
                    scale: false,
                    scaleOnHover: true,
                    scaleTo: 1.15,
                    scaleDuration: .34,
                    panY: true,
                    panX: true,
                    panDuration: 0.5,
                    resetPanOnMouseLeave: true
                });
            },

            /**
             *-------------------------------------------------------------------------------------------------------------------------------------------
             * Parallax effect
             *-------------------------------------------------------------------------------------------------------------------------------------------
             */
            parallax: function () {
                $('.parallax-yes').each(function () {
                    var $bgobj = $(this);
                    $(window).scroll(function () {
                        var yPos = -($(window).scrollTop() / $bgobj.data('speed'));
                        var coords = 'center ' + yPos + 'px';
                        $bgobj.css({
                            backgroundPosition: coords
                        });
                    });
                });

                $('.basel-parallax').each(function () {
                    var $this = $(this);
                    if ($this.hasClass('wpb_column')) {
                        $this.find('> .vc_column-inner').parallax("50%", 0.3);
                    } else {
                        $this.parallax("50%", 0.3);
                    }
                });

            },


            /**
             *-------------------------------------------------------------------------------------------------------------------------------------------
             * Scroll top button
             *-------------------------------------------------------------------------------------------------------------------------------------------
             */
            scrollTop: function () {
                //Check to see if the window is top if not then display button
                $(window).scroll(function () {
                    if ($(this).scrollTop() > 100) {
                        $('.scrollToTop').addClass('button-show');
                    } else {
                        $('.scrollToTop').removeClass('button-show');
                    }
                });

                //Click event to scroll to top
                $('.scrollToTop').on('click', function () {
                    $('html, body').animate({
                        scrollTop: 0
                    }, 800);
                    return false;
                });
            },


            /**
             *-------------------------------------------------------------------------------------------------------------------------------------------
             * Quick View  Init
             *-------------------------------------------------------------------------------------------------------------------------------------------
             */
            quickViewInit: function () {
                var that = this;
                // Open popup with product info when click on Quick View button
                $(document).on('click', '.open-quick-view', function (e) {

                    e.preventDefault();

                    var productId = $(this).data('id'),
                        loopName = $(this).data('loop-name'),
                        loop = $(this).data('loop'),
                        prev = '',
                        next = '',
                        loopBtns = $('.quick-view').find('[data-loop-name="' + loopName + '"]'),
                        btn = $(this);

                    btn.addClass('loading');

                    if (typeof loopBtns[loop - 1] != 'undefined') {
                        prev = loopBtns.eq(loop - 1).addClass('quick-view-prev');
                        prev = $('<div>').append(prev.clone()).html();
                    }

                    if (typeof loopBtns[loop + 1] != 'undefined') {
                        next = loopBtns.eq(loop + 1).addClass('quick-view-next');
                        next = $('<div>').append(next.clone()).html();
                    }

                    that.quickViewLoad(productId, btn, prev, next);

                });
            },


            /**
             *-------------------------------------------------------------------------------------------------------------------------------------------
             * Quick View POST
             *-------------------------------------------------------------------------------------------------------------------------------------------
             */
            quickViewLoad: function (id, btn, prev, next) {
                var data = {
                    id: id,
                    action: "basel_quick_view",
                    _token: basel_settings.csrf_token
                };

                var initPopup = function (data) {
                    // Open directly via API
                    $.magnificPopup.open({
                        items: {
                            src: '<div class="mfp-with-anim white-popup popup-quick-view">' + data + '</div>', // can be a HTML string, jQuery object, or CSS selector
                            type: 'inline',
                        },
                        tClose: basel_settings.close,
                        tLoading: basel_settings.loading,
                        removalDelay: 500, //delay removal by X to allow out-animation
                        callbacks: {
                            beforeOpen: function () {
                                this.st.mainClass = baselTheme.popupEffect;
                            },
                            open: function () {
                                $('.variations_form').each(function () {
                                    $(this).wc_variation_form().find('.variations select:eq(0)').change();
                                });
                                $('.variations_form').trigger('wc_variation_form');
                                $('body').trigger('basel-quick-view-displayed');
                                baselThemeModule.swatchesVariations();

                                baselThemeModule.btnsToolTips();
                                setTimeout(function () {
                                    baselThemeModule.nanoScroller();
                                }, 300);
                            }
                        },
                    });
                }

                $.ajax({
                    url: basel_settings.quickview_url,
                    data: data,
                    method: 'POST',
                    success: function (data) {
                        if (basel_settings.quickview_in_popup_fix) {
                            $.magnificPopup.close();
                            setTimeout(function () {
                                initPopup(data);
                            }, 500);
                        } else {
                            initPopup(data);
                        }
                    },
                    complete: function () {
                        btn.removeClass('loading');
                    },
                    error: function () {
                    },
                });
            },


            /**
             *-------------------------------------------------------------------------------------------------------------------------------------------
             * Quick Shop GET
             *-------------------------------------------------------------------------------------------------------------------------------------------
             */

            quickShop: function () {

                var btnSelector = '.btn-quick-shop';

                $(document).on('click', btnSelector, function (e) {
                    e.preventDefault();

                    var $this = $(this),
                        $product = $this.parents('.product'),
                        $content = $product.find('.quick-shop-form'),
                        id = $this.data('id'),
                        loadingClass = 'btn-loading';

                    if ($this.hasClass(loadingClass)) return;


                    // Simply show quick shop form if it is already loaded with AJAX previously
                    if ($product.hasClass('quick-shop-loaded')) {
                        $product.addClass('quick-shop-shown');
                        return;
                    }

                    $this.addClass(loadingClass);
                    $product.addClass('loading-quick-shop');

                    $.ajax({
                        url: basel_settings.quickview_url,
                        data: {
                            action: 'basel_quick_shop',
                            id: id
                        },
                        method: 'get',
                        success: function (data) {

                            // insert variations form
                            $content.append(data);

                            initVariationForm($product);
                            $('body').trigger('basel-quick-view-displayed');
                            baselThemeModule.swatchesVariations();
                            baselThemeModule.btnsToolTips();

                        },
                        complete: function () {
                            $this.removeClass(loadingClass);
                            $product.removeClass('loading-quick-shop');
                            $product.addClass('quick-shop-shown quick-shop-loaded');
                        },
                        error: function () {
                        },
                    });

                })

                    .on('click', '.quick-shop-close', function () {
                        var $this = $(this),
                            $product = $this.parents('.product');

                        $product.removeClass('quick-shop-shown');

                    });

                function initVariationForm($product) {
                    $product.find('.variations_form').wc_variation_form().find('.variations select:eq(0)').change();
                    $product.find('.variations_form').trigger('wc_variation_form');
                }
            },


            /**
             *-------------------------------------------------------------------------------------------------------------------------------------------
             * ToolTips titles
             *-------------------------------------------------------------------------------------------------------------------------------------------
             */
            btnsToolTips: function () {

                $('.basel-tooltip, .product-actions-btns > a, .product-grid-item .add_to_cart_button, .quick-view a, .product-compare-button a, .product-grid-item .yith-wcwl-add-to-wishlist a').each(function () {
                    $(this).find('.basel-tooltip-label').remove();
                    $(this).addClass('basel-tooltip').prepend('<span class="basel-tooltip-label">' + $(this).text() + '</span>');
                });

            },

            /**
             *-------------------------------------------------------------------------------------------------------------------------------------------
             * Sticky footer: margin bottom for main wrapper
             *-------------------------------------------------------------------------------------------------------------------------------------------
             */
            stickyFooter: function () {

                if (!$('body').hasClass('sticky-footer-on') || $(window).width() < 991) return;

                var $footer = $('.footer-container'),
                    $page = $('.main-page-wrapper'),
                    $window = $(window);

                if ($('.basel-prefooter').length > 0) {
                    $page = $('.basel-prefooter');
                }

                var footerOffset = function () {
                    $page.css({
                        marginBottom: $footer.outerHeight()
                    })
                };

                $window.on('resize', footerOffset);

                $footer.imagesLoaded(function () {
                    footerOffset();
                });

                var footerScrollFix = function () {
                    var windowScroll = $window.scrollTop();
                    var footerOffsetTop = $(document).outerHeight() - $footer.outerHeight();

                    if (footerOffsetTop < windowScroll + $footer.outerHeight() + $window.outerHeight()) {
                        $footer.addClass('visible-footer');
                    } else {
                        $footer.removeClass('visible-footer');
                    }
                };

                footerScrollFix();
                $window.on('scroll', footerScrollFix);

            },

            /**
             *-------------------------------------------------------------------------------------------------------------------------------------------
             * Swatches variations
             *-------------------------------------------------------------------------------------------------------------------------------------------
             */
            swatchesVariations: function () {

                var $variation_forms = $('.variations_form');

                // Firefox mobile fix
                $('.variations_form .label').on('click', function (e) {
                    if ($(this).siblings('.value').hasClass('with-swatches')) {
                        e.preventDefault();
                    }
                });

                $variation_forms.each(function () {
                    var $variation_form = $(this);

                    if ($variation_form.data('swatches')) return;
                    $variation_form.data('swatches', true);

                    // If AJX
                    if (!$variation_form.data('product_variations')) {
                        $variation_form.find('.swatches-select').find('> div').addClass('swatch-enabled');
                    }

                    if ($('.swatches-select > div').hasClass('active-swatch')) {
                        $variation_form.addClass('variation-swatch-selected');
                    }

                    $variation_form.on('click', '.swatches-select > div', function () {
                        var value = $(this).data('value');
                        var id = $(this).parent().data('id');

                        $variation_form.trigger('check_variations', ['attribute_' + id, true]);
                        resetSwatches($variation_form);

                        //$variation_form.find('select#' + id).val('').trigger('change');
                        //$variation_form.trigger('check_variations');

                        if ($(this).hasClass('active-swatch')) {
                            // Removed since 2.9 version as not necessary
                            // $variation_form.find( '.variations select' ).val( '' ).change();
                            // $variation_form.trigger( 'reset_data' );
                            // $(this).removeClass('active-swatch')
                            return;
                        }

                        if ($(this).hasClass('swatch-disabled')) return;
                        $variation_form.find('select#' + id).val(value).trigger('change');
                        $(this).parent().find('.active-swatch').removeClass('active-swatch');
                        $(this).addClass('active-swatch');
                        resetSwatches($variation_form);
                    })


                    // On clicking the reset variation button
                        .on('click', '.reset_variations', function (event) {
                            $variation_form.find('.active-swatch').removeClass('active-swatch');
                            if (!isQuickView()) {
                                replaceMainGallery('default', $variation_form);
                            }
                        })

                        .on('reset_data', function () {

                            if (!$variation_form.find('.variations .value').hasClass('with-swatches') && !isQuickView()) {
                                replaceMainGallery('default', $variation_form);
                            }

                            var all_attributes_chosen = true;
                            var some_attributes_chosen = false;

                            $variation_form.find('.variations select').each(function () {
                                var attribute_name = $(this).data('attribute_name') || $(this).attr('name');
                                var value = $(this).val() || '';

                                if (value.length === 0) {
                                    all_attributes_chosen = false;
                                } else {
                                    some_attributes_chosen = true;
                                }

                            });

                            if (all_attributes_chosen) {
                                $(this).parent().find('.active-swatch').removeClass('active-swatch');
                            }

                            $variation_form.removeClass('variation-swatch-selected');

                            var $mainOwl = $('.woocommerce-product-gallery__wrapper.owl-carousel');

                            resetSwatches($variation_form);

                            if (!isQuickShop($variation_form)) {
                                scrollToTop();
                            }

                            if ($mainOwl.length === 0) return;

                            if (basel_settings.product_slider_auto_height == 'yes') {
                                if (!isQuickView() && isVariationGallery('default')) {
                                    $mainOwl.trigger('destroy.owl.carousel');
                                }
                                $('.product-images').imagesLoaded(function () {
                                    $mainOwl = $mainOwl.owlCarousel(baselTheme.mainCarouselArg);
                                    $mainOwl.trigger('refresh.owl.carousel');
                                });
                            } else {
                                $mainOwl = $mainOwl.owlCarousel(baselTheme.mainCarouselArg);
                                $mainOwl.trigger('refresh.owl.carousel');
                            }

                            $mainOwl.trigger('to.owl.carousel', 0);

                        })


                        // Update first tumbnail
                        .on('reset_image', function () {
                            var $thumb = $('.thumbnails img').first();
                            if (!isQuickView() && !isQuickShop($variation_form)) {
                                $thumb.wc_reset_variation_attr('src');
                            }
                        })
                        .on('show_variation', function (e, variation, purchasable) {
                            var $thumb = $('.thumbnails img').first();

                            var image_src = variation.image.src;

                            if (!image_src) return;

                            if (!isQuickView() && !isQuickShop($variation_form) && !replaceMainGallery(variation.variation_id, $variation_form)) {
                                $thumb.wc_set_variation_attr('src', image_src);
                                baselThemeModule.initZoom();
                            }

                            if (!isQuickView() && !isQuickShop($variation_form)) {
                                $thumb.wc_set_variation_attr('src', image_src);
                            }

                            var $mainOwl = $('.woocommerce-product-gallery__wrapper');

                            $variation_form.addClass('variation-swatch-selected');

                            if (!isQuickShop($variation_form)) {
                                scrollToTop();
                            }

                            if (!$mainOwl.hasClass('owl-carousel')) return;

                            if (basel_settings.product_slider_auto_height == 'yes') {
                                if (!isQuickView() && isVariationGallery(variation.variation_id)) {
                                    $mainOwl.trigger('destroy.owl.carousel');
                                }
                                $('.product-images').imagesLoaded(function () {
                                    $mainOwl = $mainOwl.owlCarousel(baselTheme.mainCarouselArg);
                                    $mainOwl.trigger('refresh.owl.carousel');
                                });
                            } else {
                                $mainOwl = $mainOwl.owlCarousel(baselTheme.mainCarouselArg);
                                $mainOwl.trigger('refresh.owl.carousel');
                            }

                            var $thumbs = $('.images .thumbnails');

                            $mainOwl.trigger('to.owl.carousel', 0);

                            if ($thumbs.hasClass('owl-carousel')) {
                                $thumbs.owlCarousel().trigger('to.owl.carousel', 0);
                                $thumbs.find('.active-thumb').removeClass('active-thumb');
                                $thumbs.find('.owl-item').eq(0).addClass('active-thumb');
                            } else {
                                $thumbs.slick('slickGoTo', 0);
                                $thumbs.find('.active-thumb').removeClass('active-thumb');
                                $thumbs.find('img').eq(0).addClass('active-thumb');
                            }

                        });

                })

                var resetSwatches = function ($variation_form) {

                    // If using AJAX
                    if (!$variation_form.data('product_variations')) return;

                    $variation_form.find('.variations select').each(function () {

                        var select = $(this);
                        var swatch = select.parent().find('.swatches-select');
                        var options = select.html();
                        // var options = select.data('attribute_html');
                        options = $(options);

                        swatch.find('> div').removeClass('swatch-enabled').addClass('swatch-disabled');

                        options.each(function (el) {
                            var value = $(this).val();

                            if ($(this).hasClass('enabled')) {
                                // if( ! el.disabled ) {
                                swatch.find('div[data-value="' + value + '"]').removeClass('swatch-disabled').addClass('swatch-enabled');
                            } else {
                                swatch.find('div[data-value="' + value + '"]').addClass('swatch-disabled').removeClass('swatch-enabled');
                            }

                        });

                    });
                };

                var scrollToTop = function () {
                    if (!$('body').hasClass('basel-product-design-sticky') || !$('.entry-summary').hasClass('block-sticked') || !basel_settings.sticky_desc_scroll || $(window).width() <= 1024) return;

                    $('html, body').animate({
                        scrollTop: $('.product-image-summary').offset().top - 150
                    }, 800);
                }

                var isQuickShop = function ($form) {
                    return $form.parent().hasClass('quick-shop-form');
                };

                var isQuickView = function () {
                    return $('.single-product-content').hasClass('product-quick-view');
                };

                var isVariationGallery = function (key) {
                    return typeof basel_variation_gallery_data !== 'undefined' && basel_variation_gallery_data && basel_variation_gallery_data[key];
                };

                var replaceMainGallery = function (key, $variationForm) {
                    if (!isVariationGallery(key) || isQuickShop($variationForm) && isQuickView()) {
                        return false;
                    }

                    var imagesData = basel_variation_gallery_data[key];
                    var $mainGallery = $('.woocommerce-product-gallery__wrapper');
                    $mainGallery.empty();

                    for (var index = 0; index < imagesData.length; index++) {
                        $mainGallery.append(
                            '<div class="product-image-wrap">\
									<figure data-thumb="' + imagesData[index].data_thumb + '" class="woocommerce-product-gallery__image">\
										<a href="' + imagesData[index].href + '">\
											' + imagesData[index].image + '\
										</a>\
									</figure>\
								</div>'
                        );
                    }

                    baselThemeModule.productImagesGallery();
                    $('.woocommerce-product-gallery__image').trigger('zoom.destroy');
                    if (!isQuickView()) {
                        baselThemeModule.initZoom();
                    }

                    return true;
                }

            },

            swatchesOnGrid: function () {

                $('body').on('click', '.swatch-on-grid', function () {

                    var src, srcset, image_sizes;

                    var imageSrc = $(this).data('image-src'),
                        imageSrcset = $(this).data('image-srcset'),
                        imageSizes = $(this).data('image-sizes');

                    if (typeof imageSrc == 'undefined') return;

                    var product = $(this).parents('.product-grid-item'),
                        image = product.find('.product-element-top > a > img'),
                        srcOrig = image.data('original-src'),
                        srcsetOrig = image.data('original-srcset'),
                        sizesOrig = image.data('original-sizes');

                    if (typeof srcOrig == 'undefined') {
                        image.data('original-src', image.attr('src'));
                    }

                    if (typeof srcsetOrig == 'undefined') {
                        image.data('original-srcset', image.attr('srcset'));
                    }

                    if (typeof sizesOrig == 'undefined') {
                        image.data('original-sizes', image.attr('sizes'));
                    }


                    if ($(this).hasClass('current-swatch')) {
                        src = srcOrig;
                        srcset = srcsetOrig;
                        image_sizes = sizesOrig;
                        $(this).removeClass('current-swatch');
                        product.removeClass('product-swatched');
                    } else {
                        $(this).parent().find('.current-swatch').removeClass('current-swatch');
                        $(this).addClass('current-swatch');
                        product.addClass('product-swatched');
                        src = imageSrc;
                        srcset = imageSrcset;
                        image_sizes = imageSizes;
                    }

                    if (image.attr('src') == src) return;

                    product.addClass('loading-image');

                    image.attr('src', src).attr('srcset', srcset).attr('image_sizes', image_sizes).one('load', function () {
                        product.removeClass('loading-image');
                    });

                });

            },


            /**
             *-------------------------------------------------------------------------------------------------------------------------------------------
             * Ajax filters
             *-------------------------------------------------------------------------------------------------------------------------------------------
             */
            ajaxFilters: function () {

                if (!$('body').hasClass('basel-ajax-shop-on')) return;

                var that = this,
                    filtersState = false,
                    products = $('.products');

                $('body').on('click', '.post-type-archive-product .products-footer .woocommerce-pagination a', function (e) {
                    scrollToTop();
                });

                $(document).pjax(baselTheme.ajaxLinks, '.main-page-wrapper', {
                    timeout: basel_settings.pjax_timeout,
                    scrollTo: false
                });


                $(document).on('click', '.widget_price_filter form .button', function () {
                    var form = $('.widget_price_filter form');
                    console.log(form.serialize());
                    $.pjax({
                        container: '.main-page-wrapper',
                        timeout: basel_settings.pjax_timeout,
                        url: form.attr('action'),
                        data: form.serialize(),
                        scrollTo: false
                    });

                    return false;
                });


                $(document).on('pjax:error', function (xhr, textStatus, error, options) {
                    console.log('pjax error ' + error);
                });

                $(document).on('pjax:start', function (xhr, options) {
                    $('body').addClass('basel-loading');
                    baselThemeModule.hideShopSidebar();
                });

                $(document).on('pjax:beforeReplace', function (contents, options) {
                    if ($('.filters-area').hasClass('filters-opened') && basel_settings.shop_filters_close == 'yes') {
                        filtersState = true;
                        $('body').addClass('body-filters-opened');
                    }
                });

                $(document).on('pjax:complete', function (xhr, textStatus, options) {

                    that.shopPageInit();

                    scrollToTop();

                    $(document).trigger('basel-images-loaded');

                    $('.baselmart-sidebar-content').scroll(function () {
                        $(document).trigger('basel-images-loaded');
                    })

                    $('body').removeClass('basel-loading');

                });

                $(document).on('pjax:end', function (xhr, textStatus, options) {

                    if (filtersState) {
                        $('.filters-area').css('display', 'block');
                        baselThemeModule.openFilters(200);
                        filtersState = false;
                    }

                    $('body').removeClass('basel-loading');

                });

                var scrollToTop = function () {
                    if (basel_settings.ajax_scroll == 'no') return false;

                    var $scrollTo = $(basel_settings.ajax_scroll_class),
                        scrollTo = $scrollTo.offset().top - basel_settings.ajax_scroll_offset;

                    $('html, body').stop().animate({
                        scrollTop: scrollTo
                    }, 400);
                };

            },

            /**
             *-------------------------------------------------------------------------------------------------------------------------------------------
             * init shop page JS functions
             *-------------------------------------------------------------------------------------------------------------------------------------------
             */
            shopPageInit: function () {
                this.shopMasonry();
                //this.filtersArea();
                this.ajaxSearch();
                this.btnsToolTips();
                this.compare();
                this.filterDropdowns();
                this.categoriesMenuBtns();
                this.sortByWidget();
                this.categoriesAccordion();
                this.woocommercePriceSlider();
                this.updateCartWidgetFromLocalStorage(); // refresh cart in sidebar
                this.nanoScroller();
                this.countDownTimer();
                this.shopLoader();
                this.stickySidebarBtn();
                this.productFilters();

                baselThemeModule.clickOnScrollButton(baselTheme.shopLoadMoreBtn, false);

                $('.woocommerce-ordering').on('change', 'select.orderby', function () {
                    $(this).closest('form').find('[name="_pjax"]').remove();
                    $(this).closest('form').submit();
                });

                $(document.body).on('updated_wc_div', function () {
                    $(document).trigger('basel-images-loaded');
                });

                $(document).trigger('resize.vcRowBehaviour');
            },

            /**
             *-------------------------------------------------------------------------------------------------------------------------------------------
             * Add filters dropdowns compatibility
             *-------------------------------------------------------------------------------------------------------------------------------------------
             */
            filterDropdowns: function () {
                // Init
                $('.basel-widget-layered-nav-dropdown-form').each(function () {
                    var $form = $(this);
                    var $select = $form.find('select');
                    var slug = $select.data('slug');

                    $select.change(function () {
                        var val = $(this).val();
                        $('input[name=filter_' + slug + ']').val(val);
                    });

                    if ($().selectWoo) {
                        $select.selectWoo({
                            placeholder: $select.data('placeholder'),
                            minimumResultsForSearch: 5,
                            width: '100%',
                            allowClear: $select.attr('multiple') ? false : true,
                            language: {
                                noResults: function () {
                                    return $select.data('noResults');
                                }
                            }
                        }).on('select2:unselecting', function () {
                            $(this).data('unselecting', true);
                        }).on('select2:opening', function (e) {
                            if ($(this).data('unselecting')) {
                                $(this).removeData('unselecting');
                                e.preventDefault();
                            }
                        });
                    }
                });

                function ajaxAction($element) {
                    var $form = $element.parent('.basel-widget-layered-nav-dropdown-form');
                    if (typeof ($.fn.pjax) == 'undefined') {
                        return;
                    }

                    $.pjax({
                        container: '.main-page-wrapper',
                        timeout: basel_settings.pjax_timeout,
                        url: $form.attr('action'),
                        data: $form.serialize(),
                        scrollTo: false
                    });
                }

                $('.basel-widget-layered-nav-dropdown__submit').on('click', function (e) {
                    if (!$(this).siblings('select').attr('multiple')) {
                        return;
                    }

                    ajaxAction($(this));

                    $(this).prop('disabled', true);
                });

                $('.basel-widget-layered-nav-dropdown-form select').on('change', function (e) {
                    if ($(this).attr('multiple')) {
                        return;
                    }

                    ajaxAction($(this));
                });
            },


            /**
             *-------------------------------------------------------------------------------------------------------------------------------------------
             * Back in history
             *-------------------------------------------------------------------------------------------------------------------------------------------
             */
            backHistory: function () {
                history.go(-1);

                setTimeout(function () {
                    $('.filters-area').removeClass('filters-opened').stop().hide();
                    $('.open-filters').removeClass('btn-opened');
                    if ($(window).width() < 992) {
                        $('.basel-product-categories').removeClass('categories-opened').stop().hide();
                        $('.basel-show-categories').removeClass('button-open');
                    }

                    baselThemeModule.woocommercePriceSlider();
                }, 20);


            },

            /**
             *-------------------------------------------------------------------------------------------------------------------------------------------
             * Categories menu for mobile
             *-------------------------------------------------------------------------------------------------------------------------------------------
             */
            categoriesMenu: function () {
                if ($(window).width() > 991) return;

                var categories = $('.basel-product-categories'),
                    subCategories = categories.find('li > ul'),
                    button = $('.basel-show-categories'),
                    time = 200;


                //this.categoriesMenuBtns();

                $('body').on('click', '.icon-drop-category', function () {
                    if ($(this).parent().find('> ul').hasClass('child-open')) {
                        $(this).removeClass("basel-act-icon").parent().find('> ul').slideUp(time).removeClass('child-open');
                    } else {
                        $(this).addClass("basel-act-icon").parent().find('> ul').slideDown(time).addClass('child-open');
                    }
                });

                $('body').on('click', '.basel-show-categories', function (e) {
                    e.preventDefault();

                    console.log('close click');

                    if (isOpened()) {
                        closeCats();
                    } else {
                        //setTimeout(function() {
                        openCats();
                        //}, 50);
                    }
                });

                $('body').on('click', '.basel-product-categories a', function (e) {
                    closeCats();
                    categories.stop().attr('style', '');
                });

                var isOpened = function () {
                    return $('.basel-product-categories').hasClass('categories-opened');
                };

                var openCats = function () {
                    $('.basel-product-categories').addClass('categories-opened').stop().slideDown(time);
                    $('.basel-show-categories').addClass('button-open');

                };

                var closeCats = function () {
                    $('.basel-product-categories').removeClass('categories-opened').stop().slideUp(time);
                    $('.basel-show-categories').removeClass('button-open');
                };
            },


            categoriesMenuBtns: function () {
                if ($(window).width() > 991) return;

                var categories = $('.basel-product-categories'),
                    subCategories = categories.find('li > ul'),
                    iconDropdown = '<span class="icon-drop-category"></span>';

                categories.addClass('responsive-cateogires');
                subCategories.parent().addClass('has-sub').prepend(iconDropdown);
            },


            /**
             *-------------------------------------------------------------------------------------------------------------------------------------------
             * Categories toggle accordion
             *-------------------------------------------------------------------------------------------------------------------------------------------
             */

            categoriesAccordion: function () {
                if (basel_settings.categories_toggle == 'no') return;

                var $widget = $('.widget_product_categories'),
                    $list = $widget.find('.product-categories'),
                    $openBtn = $('<div class="basel-cats-toggle" />'),
                    time = 300;

                $list.find('.cat-parent').append($openBtn);

                $list.on('click', '.basel-cats-toggle', function () {
                    var $btn = $(this),
                        $subList = $btn.prev();

                    if ($subList.hasClass('list-shown')) {
                        $btn.removeClass('toggle-active');
                        $subList.stop().slideUp(time).removeClass('list-shown');
                    } else {
                        $subList.parent().parent().find('> li > .list-shown').slideUp().removeClass('list-shown');
                        $subList.parent().parent().find('> li > .toggle-active').removeClass('toggle-active');
                        $btn.addClass('toggle-active');
                        $subList.stop().slideDown(time).addClass('list-shown');
                    }
                });

                if ($list.find('li.current-cat.cat-parent, li.current-cat-parent').length > 0) {
                    $list.find('li.current-cat.cat-parent, li.current-cat-parent').find('> .basel-cats-toggle').click();
                }

            },


            /**
             *-------------------------------------------------------------------------------------------------------------------------------------------
             * WooCommerce price filter slider with ajax
             *-------------------------------------------------------------------------------------------------------------------------------------------
             */

            woocommercePriceSlider: function () {

                // woocommerce_price_slider_params is required to continue, ensure the object exists
                if (typeof woocommerce_price_slider_params === 'undefined' || $('.price_slider_amount #min_price').length < 1 || !$.fn.slider) {
                    return false;
                }

                var $slider = $('.price_slider');
                if ($slider.slider('instance') !== undefined) return;

                // Get markup ready for slider
                $('input#min_price, input#max_price').hide();
                $('.price_slider, .price_label').show();

                // Price slider uses jquery ui
                var min_price = $('.price_slider_amount #min_price').data('min'),
                    max_price = $('.price_slider_amount #max_price').data('max'),
                    current_min_price = parseInt(min_price, 10),
                    current_max_price = parseInt(max_price, 10);

                if ($('.products').attr('data-min_price') && $('.products').attr('data-min_price').length > 0) {
                    current_min_price = parseInt($('.products').attr('data-min_price'), 10);
                }
                if ($('.products').attr('data-max_price') && $('.products').attr('data-max_price').length > 0) {
                    current_max_price = parseInt($('.products').attr('data-max_price'), 10);
                }

                $slider.slider({
                    range: true,
                    animate: true,
                    min: min_price,
                    max: max_price,
                    values: [current_min_price, current_max_price],
                    create: function () {

                        $('.price_slider_amount #min_price').val(current_min_price);
                        $('.price_slider_amount #max_price').val(current_max_price);

                        $(document.body).trigger('price_slider_create', [current_min_price, current_max_price]);
                    },
                    slide: function (event, ui) {

                        $('input#min_price').val(ui.values[0]);
                        $('input#max_price').val(ui.values[1]);

                        $(document.body).trigger('price_slider_slide', [ui.values[0], ui.values[1]]);
                    },
                    change: function (event, ui) {

                        $(document.body).trigger('price_slider_change', [ui.values[0], ui.values[1]]);
                    }
                });

                setTimeout(function () {
                    $(document.body).trigger('price_slider_create', [current_min_price, current_max_price]);
                    if ($slider.find('.ui-slider-range').length > 1) $slider.find('.ui-slider-range').first().remove();
                }, 10);
            },


            /**
             *-------------------------------------------------------------------------------------------------------------------------------------------
             * Filters area
             *-------------------------------------------------------------------------------------------------------------------------------------------
             */
            filtersArea: function () {
                var filters = $('.filters-area'),
                    btn = $('.open-filters'),
                    time = 200;

                $('body').on('click', '.open-filters', function (e) {
                    e.preventDefault();

                    if (isOpened()) {
                        closeFilters();
                    } else {
                        baselThemeModule.openFilters();
                        setTimeout(function () {
                            baselThemeModule.shopLoader();
                        }, time);
                    }

                });

                if (basel_settings.shop_filters_close == 'no') {
                    $('body').on('click', baselTheme.ajaxLinks, function () {
                        if (isOpened()) {
                            closeFilters();
                        }
                    });

                }

                var isOpened = function () {
                    filters = $('.filters-area')
                    return filters.hasClass('filters-opened');
                };

                var closeFilters = function () {
                    filters = $('.filters-area')
                    filters.removeClass('filters-opened');
                    filters.stop().slideUp(time);
                    $('.open-filters').removeClass('btn-opened');
                };
            },

            openFilters: function (time) {
                var filters = $('.filters-area')
                filters.addClass('filters-opened');
                filters.stop().slideDown(time);
                $('.open-filters').addClass('btn-opened');
                setTimeout(function () {
                    filters.addClass('filters-opened');
                    $('body').removeClass('body-filters-opened');
                    baselThemeModule.nanoScroller();
                    $(document).trigger('basel-images-loaded');
                }, time);
            },

            /**
             *-------------------------------------------------------------------------------------------------------------------------------------------
             * Ajax Search for products
             *-------------------------------------------------------------------------------------------------------------------------------------------
             */
            ajaxSearch: function () {

                var escapeRegExChars = function (value) {
                    return value.replace(/[\-\[\]\/\{\}\(\)\*\+\?\.\\\^\$\|]/g, "\\$&");
                };

                $('form.basel-ajax-search').each(function () {
                    var $this = $(this),
                        number = parseInt($this.data('count')),
                        thumbnail = parseInt($this.data('thumbnail')),
                        productCat = $this.find('[name="product_cat"]'),
                        $results = $this.parent().find('.basel-search-results'),
                        price = parseInt($this.data('price')),
                        url = basel_settings.ajaxurl + '?action=basel_ajax_search',
                        postType = $this.data('post_type');

                    if (number > 0) url += '&number=' + number;

                    url += '&post_type=' + postType;

                    $results.on('click', '.view-all-result', function () {
                        $this.submit();
                    });

                    if (productCat.length && productCat.val() !== '') {
                        url += '&product_cat=' + productCat.val();
                    }

                    $this.find('[type="text"]').devbridgeAutocomplete({
                        serviceUrl: url,
                        appendTo: $results,
                        onSelect: function (suggestion) {
                            if (suggestion.permalink.length > 0)
                                window.location.href = suggestion.permalink;
                        },
                        onSearchStart: function (query) {
                            $this.addClass('search-loading');
                        },
                        beforeRender: function (container) {

                            if (container[0].childElementCount > 2)
                                $(container).append('<div class="view-all-result"><span>' + basel_settings.all_results + '</span></div>');

                        },
                        onSearchComplete: function (query, suggestions) {
                            $this.removeClass('search-loading');
                            $(".basel-scroll").nanoScroller({
                                paneClass: 'basel-scroll-pane',
                                sliderClass: 'basel-scroll-slider',
                                contentClass: 'basel-scroll-content',
                                preventPageScrolling: true
                            });

                            $(document).trigger('basel-images-loaded');
                        },
                        formatResult: function (suggestion, currentValue) {
                            if (currentValue == '&') currentValue = "&#038;";
                            var pattern = '(' + escapeRegExChars(currentValue) + ')',
                                returnValue = '';

                            if (thumbnail && suggestion.thumbnail) {
                                returnValue += ' <div class="suggestion-thumb">' + suggestion.thumbnail + '</div>';
                            }

                            returnValue += '<h4 class="suggestion-title result-title">' + suggestion.value
                                    .replace(new RegExp(pattern, 'gi'), '<strong>$1<\/strong>')
                                    // .replace(/&/g, '&amp;')
                                    .replace(/</g, '&lt;')
                                    .replace(/>/g, '&gt;')
                                    .replace(/"/g, '&quot;')
                                    .replace(/&lt;(\/?strong)&gt;/g, '<$1>') + '</h4>';

                            if (price && suggestion.price) {
                                returnValue += ' <div class="suggestion-price price">' + suggestion.price + '</div>';
                            }

                            return returnValue;
                        }
                    });

                    if (productCat.length) {

                        var searchForm = $this.find('[type="text"]').devbridgeAutocomplete(),
                            serviceUrl = basel_settings.search_url + '?action=basel_ajax_search';

                        if (number > 0) serviceUrl += '&number=' + number;
                        serviceUrl += '&post_type=' + postType;

                        productCat.on('cat_selected', function () {
                            if (productCat.val() != '') {
                                searchForm.setOptions({
                                    serviceUrl: serviceUrl + '&product_cat=' + productCat.val()
                                });
                            } else {
                                searchForm.setOptions({
                                    serviceUrl: serviceUrl
                                });
                            }

                            searchForm.hide();
                            searchForm.onValueChange();
                        });
                    }

                });

            },


            /**
             *-------------------------------------------------------------------------------------------------------------------------------------------
             * Search full screen
             *-------------------------------------------------------------------------------------------------------------------------------------------
             */
            searchFullScreen: function () {

                var body = $('body'),
                    searchWrapper = $('.basel-search-wrapper'),
                    offset = 0;

                body.on('click', '.search-button > a', function (e) {
                    e.preventDefault();

                    if (!searchWrapper.find('.searchform').hasClass('basel-ajax-search') && $('.search-button').hasClass('basel-search-dropdown') || $(window).width() < 1024) return;

                    if ($('.sticky-header.act-scroll').length > 0) {
                        searchWrapper = $('.sticky-header .basel-search-wrapper');
                    } else {
                        searchWrapper = $('.main-header .basel-search-wrapper');
                    }
                    if (isOpened()) {
                        closeWidget();
                    } else {
                        setTimeout(function () {
                            openWidget();
                        }, 10);
                    }
                })


                body.on("click", ".basel-close-search, .main-header, .sticky-header, .topbar-wrapp, .main-page-wrapper, .header-banner", function (event) {

                    if (!$(event.target).is('.basel-close-search') && $(event.target).closest(".basel-search-wrapper").length) return;

                    if (isOpened()) {
                        closeWidget();
                    }
                });

                var closeWidget = function () {
                    $('body').removeClass('basel-search-opened');
                    searchWrapper.removeClass('search-overlap');
                };

                var openWidget = function () {
                    var bar = $('#wpadminbar').outerHeight();

                    var banner = $('.header-banner').outerHeight();

                    var offset = $('.main-header').outerHeight() + bar;

                    if (!$('.main-header').hasClass('act-scroll')) {
                        offset += $('.topbar-wrapp').outerHeight();
                        if ($('body').hasClass('header-banner-display')) {
                            offset += banner;
                        }
                    }

                    if ($('.sticky-header').hasClass('header-clone') && $('.sticky-header').hasClass('act-scroll')) {
                        offset = $('.sticky-header').outerHeight() + bar;
                    }

                    if ($('.main-header').hasClass('header-menu-top') && $('.header-spacing')) {
                        offset = $('.header-spacing').outerHeight() + bar;
                        if ($('body').hasClass('header-banner-display')) {
                            offset += banner;
                        }
                    }

                    if ($('.header-menu-top').hasClass('act-scroll')) {
                        offset = $('.header-menu-top.act-scroll .navigation-wrap').outerHeight() + bar;
                    }

                    searchWrapper.css('top', offset);

                    $('body').addClass('basel-search-opened');
                    searchWrapper.addClass('search-overlap');
                    setTimeout(function () {
                        searchWrapper.find('input[type="text"]').focus();
                        $(window).one('scroll', function () {
                            if (isOpened()) {
                                closeWidget();
                            }
                        });
                    }, 300);
                };

                var isOpened = function () {
                    return $('body').hasClass('basel-search-opened');
                };
            },


            /**
             *-------------------------------------------------------------------------------------------------------------------------------------------
             * Login tabs for my account page
             *-------------------------------------------------------------------------------------------------------------------------------------------
             */
            loginTabs: function () {
                var tabs = $('.basel-register-tabs'),
                    btn = tabs.find('.basel-switch-to-register'),
                    login = tabs.find('.col-login'),
                    title = $('.col-register-text h2'),
                    loginText = tabs.find('.login-info'),
                    register = tabs.find('.col-register'),
                    classOpened = 'active-register',
                    loginLabel = btn.data('login'),
                    registerLabel = btn.data('register');

                btn.on('click', function (e) {
                    e.preventDefault();

                    if (isShown()) {
                        hideRegister();
                    } else {
                        showRegister();
                    }

                    var scrollTo = $('.main-page-wrapper').offset().top - 100;

                    if ($(window).width() < 768) {
                        $('html, body').stop().animate({
                            scrollTop: tabs.offset().top - 50
                        }, 400);
                    }
                });

                var showRegister = function () {
                    tabs.addClass(classOpened);
                    btn.text(loginLabel);
                    if (loginText.length > 0) {
                        title.text(registerLabel);
                    }
                };

                var hideRegister = function () {
                    tabs.removeClass(classOpened);
                    btn.text(registerLabel);
                    if (loginText.length > 0) {
                        title.text(loginLabel);
                    }
                };

                var isShown = function () {
                    return tabs.hasClass(classOpened);
                };
            },


            /**
             *-------------------------------------------------------------------------------------------------------------------------------------------
             * Product accordion
             *-------------------------------------------------------------------------------------------------------------------------------------------
             */
            productAccordion: function () {
                var $accordion = $('.tabs-layout-accordion');

                var time = 300;

                var hash = window.location.hash;
                var url = window.location.href;

                if (hash.toLowerCase().indexOf('comment-') >= 0 || hash === '#reviews' || hash === '#tab-reviews') {
                    $accordion.find('.tab-title-reviews').addClass('active');
                } else if (url.indexOf('comment-page-') > 0 || url.indexOf('cpage=') > 0) {
                    $accordion.find('.tab-title-reviews').addClass('active');
                } else {
                    $accordion.find('.basel-accordion-title').first().addClass('active');
                }

                $accordion.on('click', '.basel-accordion-title', function (e) {
                    e.preventDefault();

                    var $this = $(this),
                        $panel = $this.siblings('.woocommerce-Tabs-panel');

                    if ($this.hasClass('active')) {
                        $this.removeClass('active');
                        $panel.stop().slideUp(time);
                    } else {
                        $accordion.find('.basel-accordion-title').removeClass('active');
                        $accordion.find('.woocommerce-Tabs-panel').slideUp();
                        $this.addClass('active');
                        $panel.stop().slideDown(time);
                    }

                    $(window).resize();

                    setTimeout(function () {
                        $(window).resize();
                    }, time);

                });
            },


            /**
             *-------------------------------------------------------------------------------------------------------------------------------------------
             * Compact product layout
             *-------------------------------------------------------------------------------------------------------------------------------------------
             */
            productCompact: function () {
                $(".product-design-compact .basel-scroll").nanoScroller({
                    paneClass: 'basel-scroll-pane',
                    sliderClass: 'basel-scroll-slider',
                    contentClass: 'basel-scroll-content',
                    preventPageScrolling: false
                });
            },


            /**
             *-------------------------------------------------------------------------------------------------------------------------------------------
             * Sale final date countdown
             *-------------------------------------------------------------------------------------------------------------------------------------------
             */
            countDownTimer: function () {

                $('.basel-timer').each(function () {
                    var time = moment.tz($(this).data('end-date'), $(this).data('timezone'));
                    $(this).countdown(time.toDate(), function (event) {
                        $(this).html(event.strftime(''
                            + '<span class="countdown-days">%-D <span>' + basel_settings.countdown_days + '</span></span> '
                            + '<span class="countdown-hours">%H <span>' + basel_settings.countdown_hours + '</span></span> '
                            + '<span class="countdown-min">%M <span>' + basel_settings.countdown_mins + '</span></span> '
                            + '<span class="countdown-sec">%S <span>' + basel_settings.countdown_sec + '</span></span>'));
                    });
                });

            },


            /**
             *-------------------------------------------------------------------------------------------------------------------------------------------
             * Remove click delay on mobile
             *-------------------------------------------------------------------------------------------------------------------------------------------
             */
            mobileFastclick: function () {

                if ('addEventListener' in document) {
                    document.addEventListener('DOMContentLoaded', function () {
                        FastClick.attach(document.body);
                    }, false);
                }

            },

            /**
             *-------------------------------------------------------------------------------------------------------------------------------------------
             * Init nanoscroller
             *-------------------------------------------------------------------------------------------------------------------------------------------
             */
            nanoScroller: function () {

                $(".basel-scroll").nanoScroller({
                    paneClass: 'basel-scroll-pane',
                    sliderClass: 'basel-scroll-slider',
                    contentClass: 'basel-scroll-content',
                    preventPageScrolling: false
                });

            },

            /**
             *-------------------------------------------------------------------------------------------------------------------------------------------
             * Fix comments
             *-------------------------------------------------------------------------------------------------------------------------------------------
             */
            woocommerceComments: function () {
                var hash = window.location.hash;
                var url = window.location.href;

                if (hash.toLowerCase().indexOf('comment-') >= 0 || hash === '#reviews' || hash === '#tab-reviews' || url.indexOf('comment-page-') > 0 || url.indexOf('cpage=') > 0) {

                    setTimeout(function () {
                        window.scrollTo(0, 0);
                    }, 1);

                    setTimeout(function () {
                        $('html, body').stop().animate({
                            scrollTop: $(hash).offset().top - 100
                        }, 400);
                    }, 10);

                }
            },

            /**
             *-------------------------------------------------------------------------------------------------------------------------------------------
             * Quantityt +/-
             *-------------------------------------------------------------------------------------------------------------------------------------------
             */
            woocommerceQuantity: function () {
                if (!String.prototype.getDecimals) {
                    String.prototype.getDecimals = function () {
                        var num = this,
                            match = ('' + num).match(/(?:\.(\d+))?(?:[eE]([+-]?\d+))?$/);
                        if (!match) {
                            return 0;
                        }
                        return Math.max(0, (match[1] ? match[1].length : 0) - (match[2] ? +match[2] : 0));
                    }
                }


                $(document).on('click', '.plus, .minus', function () {
                    // Get values
                    var $qty = $(this).closest('.quantity').find('.qty'),
                        currentVal = parseFloat($qty.val()),
                        max = parseFloat($qty.attr('max')),
                        min = parseFloat($qty.attr('min')),
                        step = $qty.attr('step');

                    // Format values
                    if (!currentVal || currentVal === '' || currentVal === 'NaN') currentVal = 0;
                    if (max === '' || max === 'NaN') max = '';
                    if (min === '' || min === 'NaN') min = 0;
                    if (step === 'any' || step === '' || step === undefined || parseFloat(step) === 'NaN') step = '1';

                    // Change the value
                    if ($(this).is('.plus')) {
                        if (max && (currentVal >= max)) {
                            $qty.val(max);
                        } else {
                            $qty.val((currentVal + parseFloat(step)).toFixed(step.getDecimals()));
                        }
                    } else {
                        if (min && (currentVal <= min)) {
                            $qty.val(min);
                        } else if (currentVal > 0) {
                            $qty.val((currentVal - parseFloat(step)).toFixed(step.getDecimals()));
                        }
                    }

                    // Trigger change event
                    $qty.trigger('change');
                });

            },
        }
    }());

})(jQuery);


jQuery(document).ready(function () {

    baselThemeModule.init();

});