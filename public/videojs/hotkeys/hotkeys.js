!function (e, t) { "use strict"; e.videojs_hotkeys = { version: "0.2.5" }; var r = function (e) { var t = this, r = { volumeStep: .1, seekStep: 5, enableMute: !0, enableFullscreen: !0, enableNumbers: !0 }; e = e || {}; var l = e.volumeStep || r.volumeStep, n = e.seekStep || r.seekStep, u = e.enableMute || r.enableMute, a = e.enableFullscreen || r.enableFullscreen, s = e.enableNumbers || r.enableNumbers; t.el().hasAttribute("tabIndex") || t.el().setAttribute("tabIndex", "-1"), t.on("play", function () { var e = t.el().querySelector(".iframeblocker"); e && "" == e.style.display && (e.style.display = "block", e.style.bottom = "39px") }); var c = function (e) { var r = e.which; if (t.controls()) { { document.activeElement } switch (r) { case 32: e.preventDefault(), t.paused() ? t.play() : t.pause(); break; case 37: e.preventDefault(); var c = t.currentTime() - n; t.currentTime() <= n && (c = 0), t.currentTime(c); break; case 39: e.preventDefault(), t.currentTime(t.currentTime() + n); break; case 40: e.preventDefault(), t.volume(t.volume() - l); break; case 38: e.preventDefault(), t.volume(t.volume() + l); break; case 77: u && t.muted(t.muted() ? !1 : !0); break; case 70: a && (t.isFullscreen() ? t.exitFullscreen() : t.requestFullscreen()); break; default: if ((r > 47 && 59 > r || r > 95 && 106 > r) && s) { var i = 48; r > 95 && (i = 96); var o = r - i; e.preventDefault(), t.currentTime(t.duration() * o * .1) } } } }, i = function () { t.controls() && a && (t.isFullscreen() ? t.exitFullscreen() : t.requestFullscreen()) }; return t.on("keydown", c), t.on("dblclick", i), this }; t.plugin("hotkeys", r) } (window, window.videojs);