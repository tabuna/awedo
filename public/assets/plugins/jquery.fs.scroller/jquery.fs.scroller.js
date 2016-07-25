;
(function ($, window) {
    "use strict";
    var namespace = "scroller", $body = null, classes = {
        base: "scroller",
        content: "scroller-content",
        bar: "scroller-bar",
        track: "scroller-track",
        handle: "scroller-handle",
        isHorizontal: "scroller-horizontal",
        isSetup: "scroller-setup",
        isActive: "scroller-active"
    }, events = {
        start: "touchstart." + namespace + " mousedown." + namespace,
        move: "touchmove." + namespace + " mousemove." + namespace,
        end: "touchend." + namespace + " mouseup." + namespace
    };
    var options = {customClass: "", duration: 0, handleSize: 0, horizontal: false, trackMargin: 0};
    var pub = {
        defaults: function (opts) {
            options = $.extend(options, opts || {});
            return (typeof this === 'object') ? $(this) : true;
        }, destroy: function () {
            return $(this).each(function (i, el) {
                var data = $(el).data(namespace);
                if (data) {
                    data.$scroller.removeClass([data.customClass, classes.base, classes.isActive].join(" "));
                    data.$bar.remove();
                    data.$content.contents().unwrap();
                    data.$content.off(classify(namespace));
                    data.$scroller.off(classify(namespace)).removeData(namespace);
                }
            });
        }, scroll: function (pos, dur) {
            return $(this).each(function (i) {
                var data = $(this).data(namespace), duration = dur || options.duration;
                if (typeof pos !== "number") {
                    var $el = $(pos);
                    if ($el.length > 0) {
                        var offset = $el.position();
                        if (data.horizontal) {
                            pos = offset.left + data.$content.scrollLeft();
                        } else {
                            pos = offset.top + data.$content.scrollTop();
                        }
                    } else {
                        pos = data.$content.scrollTop();
                    }
                }
                var styles = data.horizontal ? {scrollLeft: pos} : {scrollTop: pos};
                data.$content.stop().animate(styles, duration);
            });
        }, reset: function () {
            return $(this).each(function (i) {
                var data = $(this).data(namespace);
                if (data) {
                    data.$scroller.addClass(classes.isSetup);
                    var barStyles = {}, trackStyles = {}, handleStyles = {}, handlePosition = 0, isActive = true;
                    if (data.horizontal) {
                        data.barHeight = data.$content[0].offsetHeight - data.$content[0].clientHeight;
                        data.frameWidth = data.$content.outerWidth();
                        data.trackWidth = data.frameWidth - (data.trackMargin * 2);
                        data.scrollWidth = data.$content[0].scrollWidth;
                        data.ratio = data.trackWidth / data.scrollWidth;
                        data.trackRatio = data.trackWidth / data.scrollWidth;
                        data.handleWidth = (data.handleSize > 0) ? data.handleSize : data.trackWidth * data.trackRatio;
                        data.scrollRatio = (data.scrollWidth - data.frameWidth) / (data.trackWidth - data.handleWidth);
                        data.handleBounds = {left: 0, right: data.trackWidth - data.handleWidth};
                        data.$content.css({paddingBottom: data.barHeight + data.paddingBottom});
                        var scrollLeft = data.$content.scrollLeft();
                        handlePosition = scrollLeft * data.ratio;
                        isActive = (data.scrollWidth <= data.frameWidth);
                        barStyles = {width: data.frameWidth};
                        trackStyles = {
                            width: data.trackWidth,
                            marginLeft: data.trackMargin,
                            marginRight: data.trackMargin
                        };
                        handleStyles = {width: data.handleWidth};
                    } else {
                        data.barWidth = data.$content[0].offsetWidth - data.$content[0].clientWidth;
                        data.frameHeight = data.$content.outerHeight();
                        data.trackHeight = data.frameHeight - (data.trackMargin * 2);
                        data.scrollHeight = data.$content[0].scrollHeight;
                        data.ratio = data.trackHeight / data.scrollHeight;
                        data.trackRatio = data.trackHeight / data.scrollHeight;
                        data.handleHeight = (data.handleSize > 0) ? data.handleSize : data.trackHeight * data.trackRatio;
                        data.scrollRatio = (data.scrollHeight - data.frameHeight) / (data.trackHeight - data.handleHeight);
                        data.handleBounds = {top: 0, bottom: data.trackHeight - data.handleHeight};
                        var scrollTop = data.$content.scrollTop();
                        handlePosition = scrollTop * data.ratio;
                        isActive = (data.scrollHeight <= data.frameHeight);
                        barStyles = {height: data.frameHeight};
                        trackStyles = {
                            height: data.trackHeight,
                            marginBottom: data.trackMargin,
                            marginTop: data.trackMargin
                        };
                        handleStyles = {height: data.handleHeight};
                    }
                    if (isActive) {
                        data.$scroller.removeClass(classes.isActive);
                    } else {
                        data.$scroller.addClass(classes.isActive);
                    }
                    data.$bar.css(barStyles);
                    data.$track.css(trackStyles);
                    data.$handle.css(handleStyles);
                    position(data, handlePosition);
                    data.$scroller.removeClass(classes.isSetup);
                }
            });
        }
    };

    function init(opts) {
        opts = $.extend({}, options, opts || {});
        if ($body === null) {
            $body = $("body");
        }
        var $items = $(this);
        for (var i = 0, count = $items.length; i < count; i++) {
            build($items.eq(i), opts);
        }
        return $items;
    }

    function build($scroller, opts) {
        if (!$scroller.hasClass(classes.base)) {
            opts = $.extend({}, opts, $scroller.data(namespace + "-options"));
            var html = '';
            html += '<div class="' + classes.bar + '">';
            html += '<div class="' + classes.track + '">';
            html += '<div class="' + classes.handle + '">';
            html += '</div></div></div>';
            opts.paddingRight = parseInt($scroller.css("padding-right"), 10);
            opts.paddingBottom = parseInt($scroller.css("padding-bottom"), 10);
            $scroller.addClass([classes.base, opts.customClass].join(" ")).wrapInner('<div class="' + classes.content + '" />').prepend(html);
            if (opts.horizontal) {
                $scroller.addClass(classes.isHorizontal);
            }
            var data = $.extend({
                $scroller: $scroller,
                $content: $scroller.find(classify(classes.content)),
                $bar: $scroller.find(classify(classes.bar)),
                $track: $scroller.find(classify(classes.track)),
                $handle: $scroller.find(classify(classes.handle))
            }, opts);
            data.trackMargin = parseInt(data.trackMargin, 10);
            data.$content.on("scroll." + namespace, data, onScroll);
            data.$scroller.on(events.start, classify(classes.track), data, onTrackDown).on(events.start, classify(classes.handle), data, onHandleDown).data(namespace, data);
            pub.reset.apply($scroller);
            $(window).one("load", function () {
                pub.reset.apply($scroller);
            });
        }
    }

    function onScroll(e) {
        e.preventDefault();
        e.stopPropagation();
        var data = e.data, handleStyles = {};
        if (data.horizontal) {
            var scrollLeft = data.$content.scrollLeft();
            if (scrollLeft < 0) {
                scrollLeft = 0;
            }
            var handleLeft = scrollLeft / data.scrollRatio;
            if (handleLeft > data.handleBounds.right) {
                handleLeft = data.handleBounds.right;
            }
            handleStyles = {left: handleLeft};
        } else {
            var scrollTop = data.$content.scrollTop();
            if (scrollTop < 0) {
                scrollTop = 0;
            }
            var handleTop = scrollTop / data.scrollRatio;
            if (handleTop > data.handleBounds.bottom) {
                handleTop = data.handleBounds.bottom;
            }
            handleStyles = {top: handleTop};
        }
        data.$handle.css(handleStyles);
    }

    function onTrackDown(e) {
        e.preventDefault();
        e.stopPropagation();
        var data = e.data, oe = e.originalEvent, offset = data.$track.offset(), touch = (typeof oe.targetTouches !== "undefined") ? oe.targetTouches[0] : null, pageX = (touch) ? touch.pageX : e.clientX, pageY = (touch) ? touch.pageY : e.clientY;
        if (data.horizontal) {
            data.mouseStart = pageX;
            data.handleLeft = pageX - offset.left - (data.handleWidth / 2);
            position(data, data.handleLeft);
        } else {
            data.mouseStart = pageY;
            data.handleTop = pageY - offset.top - (data.handleHeight / 2);
            position(data, data.handleTop);
        }
        onStart(data);
    }

    function onHandleDown(e) {
        e.preventDefault();
        e.stopPropagation();
        var data = e.data, oe = e.originalEvent, touch = (typeof oe.targetTouches !== "undefined") ? oe.targetTouches[0] : null, pageX = (touch) ? touch.pageX : e.clientX, pageY = (touch) ? touch.pageY : e.clientY;
        if (data.horizontal) {
            data.mouseStart = pageX;
            data.handleLeft = parseInt(data.$handle.css("left"), 10);
        } else {
            data.mouseStart = pageY;
            data.handleTop = parseInt(data.$handle.css("top"), 10);
        }
        onStart(data);
    }

    function onStart(data) {
        data.$content.off(classify(namespace));
        $body.on(events.move, data, onMouseMove).on(events.end, data, onMouseUp);
    }

    function onMouseMove(e) {
        e.preventDefault();
        e.stopPropagation();
        var data = e.data, oe = e.originalEvent, pos = 0, delta = 0, touch = (typeof oe.targetTouches !== "undefined") ? oe.targetTouches[0] : null, pageX = (touch) ? touch.pageX : e.clientX, pageY = (touch) ? touch.pageY : e.clientY;
        if (data.horizontal) {
            delta = data.mouseStart - pageX;
            pos = data.handleLeft - delta;
        } else {
            delta = data.mouseStart - pageY;
            pos = data.handleTop - delta;
        }
        position(data, pos);
    }

    function onMouseUp(e) {
        e.preventDefault();
        e.stopPropagation();
        var data = e.data;
        data.$content.on("scroll.scroller", data, onScroll);
        $body.off(".scroller");
    }

    function onTouchEnd(e) {
        e.preventDefault();
        e.stopPropagation();
        var data = e.data;
        data.$content.on("scroll.scroller", data, onScroll);
        $body.off(".scroller");
    }

    function position(data, pos) {
        var handleStyles = {};
        if (data.horizontal) {
            if (pos < data.handleBounds.left) {
                pos = data.handleBounds.left;
            }
            if (pos > data.handleBounds.right) {
                pos = data.handleBounds.right;
            }
            var scrollLeft = Math.round(pos * data.scrollRatio);
            handleStyles = {left: pos};
            data.$content.scrollLeft(scrollLeft);
        } else {
            if (pos < data.handleBounds.top) {
                pos = data.handleBounds.top;
            }
            if (pos > data.handleBounds.bottom) {
                pos = data.handleBounds.bottom;
            }
            var scrollTop = Math.round(pos * data.scrollRatio);
            handleStyles = {top: pos};
            data.$content.scrollTop(scrollTop);
        }
        data.$handle.css(handleStyles);
    }

    function classify(text) {
        return "." + text;
    }

    $.fn[namespace] = function (method) {
        if (pub[method]) {
            return pub[method].apply(this, Array.prototype.slice.call(arguments, 1));
        } else if (typeof method === 'object' || !method) {
            return init.apply(this, arguments);
        }
        return this;
    };
    $[namespace] = function (method) {
        if (method === "defaults") {
            pub.defaults.apply(this, Array.prototype.slice.call(arguments, 1));
        }
    };
})(jQuery);