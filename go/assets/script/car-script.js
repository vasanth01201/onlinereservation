! function() {
  'use strict';

  function t(t, e, s) {
      var i;
      return function() {
          var n = this,
              o = arguments,
              a = function() {
                  i = null, s || t.apply(n, o)
              },
              r = s && !i;
          clearTimeout(i), i = setTimeout(a, e), r && t.apply(n, o)
      }
  }

  function e(t, e) {
      var i = {
          selector: '.slider',
          ease: 'SlowMo',
          easeType: 'easeOut',
          duration: 1,
          nextHtml: '',
          prevHtml: '',
          arrows: 0,
          keyboard: !0,
          pagination: 1,
          onLeave: null,
          afterLoad: null
      };
      return this.el = document.querySelector(t), this.settings = s.extend(i, e), this.body = document.querySelector('body'), this.container = this.el.querySelector(this.settings.selector + '__container'), this.items = this.el.querySelectorAll(this.settings.selector + '__item'), this.init(), this
  }
        
  var s = {
      extend: function(t, e) {
          'object' != typeof e && (e = {});
          for (var s in e) t.hasOwnProperty(s) && (t[s] = e[s]);
          return t
      },
      setStyle: function(t, e, s) {
          t.style[e.charAt(0).toLowerCase() + e.slice(1)] = s
      },
      setVendor: function(t, e, s) {
          t.style[e.charAt(0).toLowerCase() + e.slice(1)] = s, t.style['webkit' + e] = s, t.style['moz' + e] = s, t.style['ms' + e] = s, t.style['o' + e] = s
      },
      hasClass: function(t, e) {
          return t.classList ? t.classList.contains(e) : !!t.className.match(new RegExp('(\\s|^)' + e + '(\\s|$)'))
      },
      addClass: function(t, e) {
          t.classList ? t.classList.add(e) : s.hasClass(t, e) || (t.className += ' ' + e)
      },
      removeClass: function(t, e) {
          if (t.classList) t.classList.remove(e);
          else if (s.hasClass(t, e)) {
              var i = new RegExp('(\\s|^)' + e + '(\\s|$)');
              t.className = t.className.replace(i, ' ')
          }
      }
  };

  e.prototype.init = function() {
      this.index = 0, this.slideWidth = parseInt(getComputedStyle(this.container).width), this.build(), this.bindEvents(), this.makeActive(this.index), 'function' == typeof this.settings.afterLoad && this.settings.afterLoad(this.index)
  }, e.prototype.build = function() {
      this.settings.arrows && this.appendArrows(), this.settings.pagination && this.appendPagination()
  }, e.prototype.bindEvents = function() {
      var t = this;
      if (this.settings.keyboard && document.addEventListener('keydown', this.keyboard.bind(this)), this.settings.arrows && (this.settings.nextHtml.addEventListener('click', this.moveToNext.bind(this)), this.settings.prevHtml.addEventListener('click', this.moveToPrev.bind(this))), this.settings.pagination)
          for (var e = document.querySelectorAll('.slider-navigation li a'), s = 0; s < e.length; s++) ! function(i) {
              e[s].addEventListener('click', function(e) {
                  t.move(i), e.preventDefault()
              })
          }(s);
      window.addEventListener('resize', this.resize.bind(this), !1)
  }, e.prototype.makeActive = function(t) {
      for (var e = document.querySelectorAll('.slider-navigation li a'), i = 0; i < this.items.length; i++) s.removeClass(this.items[i], 'is-active'), s.removeClass(e[i], 'is-active');
      s.addClass(this.items[t], 'is-active'), s.addClass(e[t], 'is-active')
  }, e.prototype.move = function(t) {
      var e = new TimelineLite,
          i = this,
          n = document.querySelector('.slider-navigation');
          
      return s.hasClass(this.items[t], 'is-active') || (e.eventCallback('onStart', function() {
        //   s.setStyle(i.settings.prevHtml, 'pointerEvents', 'none'), s.setStyle(i.settings.nextHtml, 'pointerEvents', 'none'), s.setStyle(n, 'pointerEvents', 'none')
      }), 'function' == typeof i.settings.onLeave && e.add(i.settings.onLeave(i.index)), e.to(this.container, this.settings.duration, {
          x: -t * this.slideWidth,
          ease: this.settings.ease + '.' + this.settings.easeType
      }, '-=0.5'), 'function' == typeof i.settings.afterLoad && e.add(i.settings.afterLoad(t)), e.eventCallback('onComplete', function() {
        //   s.setStyle(i.settings.prevHtml, 'pointerEvents', 'auto'), s.setStyle(i.settings.nextHtml, 'pointerEvents', 'auto'), s.setStyle(n, 'pointerEvents', 'auto'), console.log(n)
      })), this.index = t, this.makeActive(this.index), e
  }, e.prototype.moveToNext = function(t) {
      this.index + 1 < this.items.length && this.move(this.index + 1)
  }, e.prototype.moveToPrev = function() {
      this.index > 0 && this.move(this.index - 1)
  }, e.prototype.keyboard = function(t) {
      37 === t.keyCode && this.moveToPrev(), 39 === t.keyCode && this.moveToNext()
  }, e.prototype.appendArrows = function() {
      var t = document.createElement('div');
      t.setAttribute('class', 'slider-controls');
      var e = document.createElement('button');
      e.setAttribute('type', 'button'), e.setAttribute('class', 'next');
      var s = document.createElement('button');
      s.setAttribute('type', 'button'), s.setAttribute('class', 'previous'), this.el.appendChild(t);
      var i = this.el.querySelector('.slider-controls');
      i.appendChild(e), i.appendChild(s), this.settings.nextHtml = e, this.settings.prevHtml = s
  }, e.prototype.appendPagination = function() {
      for (var t = '', e = 0; e < this.items.length; e++) t += '<li><a data-index="' + e + '" href="#' + e + '"></a></li>';
      var s = document.createElement('ul');
    //   console.log(this);
      s.setAttribute('class', 'slider-navigation'),
       s.innerHTML = t, this.body.appendChild(s)
  }, e.prototype.resize = t(function() {
      var t = this;
      t.slideWidth = parseInt(getComputedStyle(this.container).width);
      var e = t.slideWidth * t.index + 1;
      s.setVendor(t.container, 'Transform', 'matrix(1, 0, 0, 1, -' + e + ', 0)')
  }, 10), window.TuinSlider = e
}(window);

if (document.querySelector('#slider')) {
    new TuinSlider('#slider', {
        onLeave: function(e) {
            var t = new TimelineLite,
                o = document.querySelectorAll('.slider__item'),
                r = o[e],
                a = r.querySelectorAll('.title'),
                i = r.querySelector('.burger'),
                y = r.querySelector('.astronaut'),
                c = r.querySelectorAll('.cup');
            return 0 === e && t.staggerTo(a, .8, {
                y: -100,
                opacity: 0,
                ease: Power3.easeOut
            }, .5).to(i, .6, {
                x: 200,
                opacity: 0,
                ease: Power3.easeOut
            }), 1 === e && t.staggerTo(a, .8, {
                y: 100,
                opacity: 0,
                ease: Power3.easeOut
            }, .5).to(y, .5, {
                y: -100,
                opacity: 0
            }, '=-1'), 2 === e && t.staggerTo(a, .8, {
                y: -100,
                opacity: 0,
                ease: Power3.easeOut
            }, .5).to(c, .5, {
                x: 100,
                opacity: 0
            }), t
        },
        afterLoad: function(e) {
            var t = new TimelineLite,
                o = document.querySelectorAll('.slider__item'),
                r = o[e],
                a = r.querySelectorAll('.title'),
                i = r.querySelector('.slider__content');
            TweenLite.set(i, {
                visibility: 'visible'
            });
            var y = r.querySelector('.burger'),
                c = r.querySelector('.astronaut'),
                l = r.querySelectorAll('.cup');
            return 0 === e && t.staggerFromTo(a, 1, {
                y: 100,
                opacity: 0
            }, {
                y: 0,
                opacity: 1,
                ease: Power3.easeOut
            }, .5).fromTo(y, 1.5, {
                x: 100,
                opacity: 0
            }, {
                x: 0,
                opacity: 1,
                ease: Power3.easeOut
            }, '-=0.6'), 1 === e && t.staggerFromTo(a, .8, {
                y: -100,
                opacity: 0
            }, {
                y: 0,
                opacity: 1,
                ease: Power3.easeOut
            }, .5).fromTo(c, .5, {
                y: 100,
                opacity: 0
            }, {
                y: 0,
                opacity: 1
            }, '=-1'), 2 === e && t.staggerFromTo(a, .8, {
                y: 100,
                opacity: 0
            }, {
                y: 0,
                opacity: 1,
                ease: Power3.easeOut
            }, .5).staggerFromTo(l, 1.5, {
                x: 100,
                opacity: 0
            }, {
                x: 0,
                opacity: 1,
                ease: Power3.easeOut
            }, .5), t
        }
      });
}




